<?php

namespace App\Http\Controllers;

use App\Models\CajaCompra;
use App\Models\CajaInventario;
use App\Models\Compra;
use App\Models\ValidarCaja;
use App\Models\ValidarCajaDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CajaCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaCompra::with(['Caja', 'CajaInventario', 'Compra'])->where('estado', 1)->get();
    }

    public function filtrarPorFecha(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date',
        ]);

        session([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Log para verificar que los datos del request llegaron correctamente
        Log::info('Request fechas recibidas:', [
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Log para verificar que se guardaron correctamente en sesión
        Log::info('Fechas almacenadas en sesión:', [
            'fecha_inicio' => session('fecha_inicio'),
            'fecha_fin' => session('fecha_fin'),
        ]);

        $detalles = ValidarCajaDetalle::with(['compra', 'origen', 'destino'])
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->where('estado', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($detalle) {
                $fecha = Carbon::parse($detalle->fecha);
                $diaLiteral = $fecha->locale('es')->isoFormat('dddd');
                return [
                    'id' => $detalle->id,
                    'stock' => $detalle->stock,
                    'cantidad' => $detalle->cantidad,
                    'nuevo_stock' => number_format($detalle->stock - $detalle->cantidad, 3),
                    'destino_stock_anterior' => $detalle->destino_stock_anterior,
                    'destino_stock_actual' => $detalle->destino_stock_actual,
                    'dia' => ucfirst($diaLiteral),
                    'fecha' => $detalle->fecha,
                    'origen' => optional($detalle->origen)->name,
                    'destino' => optional($detalle->destino)->name,
                    'compra' => [
                        'nro' => optional($detalle->compra)->nro,
                        'id' => optional($detalle->compra)->id,
                        'fecha' => optional($detalle->compra)->fecha,
                        'fecha_salida' => optional($detalle->compra)->fecha_salida,
                        'fecha_llegada' => optional($detalle->compra)->fecha_llegada,
                        'camion' => optional($detalle->compra)->camion,
                        'placa' => optional($detalle->compra)->placa,
                        'chofer' => optional($detalle->compra)->chofer,
                    ],
                ];
            });

        $url_pdf = url('reportes/control-cajas/pdf');
        $url_pdf_semanal = url('reportes/control-cajas-semanal/pdf');

        Log::info('URL para PDF generada:', ['url_pdf' => $url_pdf]);
        Log::info('Detalles filtrados:', $detalles->toArray());

        return response()->json([
            'data' => $detalles,
            'url_pdf' => $url_pdf,
            'url_pdf_semanal' => $url_pdf_semanal,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // $cajaCompra = new CajaCompra();
        // $cajaCompra->name = $request->name;
        // $cajaCompra->save();
        // return $cajaCompra;
        $validarCaja = new ValidarCaja();
        $validarCaja->motivo = $request->motivo;

        $validarCaja->compra_id = $request->id;

        $validarCaja->origen_id = $request->almacen_o_id;
        $validarCaja->chofer = $request->chofer;
        $validarCaja->placa = $request->placa;
        $validarCaja->destino_id = $request->almacen_id;
        $validarCaja->fecha = Carbon::now()->format('Y-m-d');
        $validarCaja->save();

        $stockDestinoActual = CajaInventario::where('almacen_id', $request->almacen_id)
            ->where('estado', 1)
            ->sum('cantidad');
        $stockRestante = null;
        foreach ($request->cajas_almacens as $index => $c) {
            if ($index === 0) {
                $stockRestante = $c['cantidad_total'];
            }

            $inventario = new CajaInventario();
            $inventario->cantidad = $c['cantidad'];
            $inventario->compra = $c['caja']['compra'];
            $inventario->caja_id = $c['caja']['id'];
            $inventario->venta = $c['caja']['venta'];
            $inventario->almacen_id = $request->almacen_id;
            $inventario->motivo = "ENVIO DE LOTE";
            $inventario->tipo = 1;
            $inventario->save();
            $cajaCompra = new CajaCompra();
            $cajaCompra->caja_id = $c['caja']['id'];
            $cajaCompra->caja_inventario_id = $inventario->id;
            $cajaCompra->compra_id = $request->id;
            $cajaCompra->save();
            $inventario2 = new CajaInventario();
            $inventario2->caja_id = $c['caja']['id'];
            $inventario2->cantidad = 0 - $c['cantidad'];
            $inventario2->compra = $c['caja']['compra'];
            $inventario2->venta = $c['caja']['venta'];
            $inventario2->almacen_id = $c['almacen_id'];
            $inventario2->motivo = "VALIDACION DE LOTES";
            $inventario2->tipo = 2;
            $inventario2->save();


            $validarCajaDetalle = new ValidarCajaDetalle();
            $validarCajaDetalle->motivo = $request->motivo;
            $validarCajaDetalle->stock = $stockRestante;
            $validarCajaDetalle->cantidad = $c['cantidad'];
            $validarCajaDetalle->destino_stock_anterior = $stockDestinoActual;
            $validarCajaDetalle->destino_stock_actual = $stockDestinoActual + $c['cantidad']; // aumentamos stock destino
            $validarCajaDetalle->compra_id = $request->id;
            $validarCajaDetalle->validar_caja_id = $validarCaja->id;
            $validarCajaDetalle->destino_id = $request->almacen_id;
            $validarCajaDetalle->origen_id = $c['almacen_id'];
            $validarCajaDetalle->fecha = Carbon::now()->format('Y-m-d');
            $validarCajaDetalle->save();


            $stockRestante -= $c['cantidad'];
            $stockDestinoActual += $c['cantidad'];
        }

        $compra = Compra::find($request->id);
        $compra->validar = 1;
        $compra->save();

        $validarCaja->url_pdf = url("reportes/validarCajas/$validarCaja->id");
        $validarCaja->url_pdfTicket = url("reportes/validarCajasTicket/$validarCaja->id");
        return $validarCaja;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaCompra  $cajaCompra
     * @return \Illuminate\Http\Response
     */
    public function show(CajaCompra $cajaCompra)
    {

        return $cajaCompra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaCompra  $cajaCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaCompra $cajaCompra)
    {
        $cajaCompra->CajaInventario = $cajaCompra->CajaInventario;
        $cajaCompra->CajaInventario->cantidad = $request->caja_inventario['cantidad'];
        $cajaCompra->CajaInventario->save();
        return $cajaCompra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaCompra  $cajaCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaCompra $cajaCompra)
    {
        $cajaCompra->estado = 0;
        $cajaCompra->save();
    }
}
