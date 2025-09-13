<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ValidarCaja;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ValidarCajaDetalle;
use Illuminate\Support\Facades\Log;

class ValidarCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  ValidarCaja::with(['Compra', 'Destino', 'Origen'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url("reportes/validarCajas/$m->id");
            $m->url_taco_pdf = url("reportes/validarCajasTicket/$m->id");
            $list[] = $m;
        }
        return $model;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validarCaja = new ValidarCaja();
        $validarCaja->name = $request->name;
        $validarCaja->save();
        $validarCaja->url_pdf = url("reportes/validarCajas/$validarCaja->id");
        return $validarCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValidarCaja  $validarCaja
     * @return \Illuminate\Http\Response
     */
    public function show(ValidarCaja $validarCaja)
    {
        $validarCaja->detalles = $validarCaja->ValidarCajaDetalles()->get();
        return $validarCaja;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValidarCaja  $validarCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValidarCaja $validarCaja)
    {
        $validarCaja->name = $request->name;
        $validarCaja->save();
        return $validarCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValidarCaja  $validarCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValidarCaja $validarCaja)
    {
        $validarCaja->estado = 0;
        $validarCaja->save();
    }
    public function pdf(ValidarCaja $validarCaja)
    {
        $validarCaja = $this->show($validarCaja);
        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.validacion', ["validarCaja" => $validarCaja]);
        return $pdf->stream();
    }

    public function pdfTicket(ValidarCaja $validarCaja)
    {
        $validarCaja = $this->show($validarCaja);
        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.validacionTicket', ["validarCaja" => $validarCaja])
            ->setPaper([0, 0, 227, 300], 'portrait');
        return $pdf->stream();
    }

    public function generarReportePDF()
    {
        $fecha_inicio = session('fecha_inicio');
        $fecha_fin = session('fecha_fin');

        if (!$fecha_inicio || !$fecha_fin) {
            abort(404, 'Fechas no definidas en sesión');
        }

        $detalles_raw = ValidarCajaDetalle::with(['compra', 'origen', 'destino'])
            ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
            ->where('estado', 1)
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        // Agrupar detalles por fecha
        $detalles_por_fecha = $detalles_raw->groupBy('fecha');

        $period = \Carbon\CarbonPeriod::create($fecha_inicio, $fecha_fin);
        $detalles_completos = [];

        foreach ($period as $fecha) {
            $fecha_str = $fecha->format('Y-m-d');
            $detalles_del_dia = $detalles_por_fecha->get($fecha_str, collect());

            if ($detalles_del_dia->isEmpty()) {
                // Día sin detalles: fila vacía
                $detalles_completos[$fecha_str] = [
                    [
                        'fecha' => $fecha_str,
                        'dia' => ucfirst($fecha->locale('es')->isoFormat('dddd')),
                        'nro' => 'SN',
                        'cantidad' => 0,
                        'saldo_af_lp' => 0,
                        'saldo' => 0,
                        'envio_cajas' => 0,
                        'id' => null,
                    ],
                ];
            } else {
                // Agrupar detalles por compra (venta)
                $detalles_por_compra = $detalles_del_dia->groupBy(function ($item) {
                    return optional($item->compra)->id ?? 'sin_compra';
                });

                $detalles_agrupados = [];

                foreach ($detalles_por_compra as $compra_id => $items) {
                    // Sumar cantidades (CNT CAJA LLEGADA)
                    $totalCantidad = $items->sum('cantidad');

                    // Último detalle para saldo_af_lp y saldo (los últimos valores)
                    $ultimoDetalle = $items->last();

                    $detalles_agrupados[] = [
                        'fecha' => $fecha_str,
                        'dia' => ucfirst($fecha->locale('es')->isoFormat('dddd')),
                        'nro' => optional($ultimoDetalle->compra)->nro ?? 'SN',
                        'cantidad' => $totalCantidad,
                        'saldo_af_lp' => $ultimoDetalle->destino_stock_actual ?? 0,
                        'saldo' => $ultimoDetalle->stock ?? 0,
                        'envio_cajas' => $totalCantidad, // sumatoria igual a cantidad si es lo mismo
                        'id' => $compra_id,
                    ];
                }

                $detalles_completos[$fecha_str] = $detalles_agrupados;
            }
        }

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.control_cajas', [
            'detalles_completos' => $detalles_completos,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('control_cajas_' . $fecha_inicio . '_al_' . $fecha_fin . '.pdf');
    }


    public function generarReporteSemanalPDF()
    {
        $fecha_inicio = session('fecha_inicio');
        $fecha_fin = session('fecha_fin');

        if (!$fecha_inicio || !$fecha_fin) {
            abort(404, 'Fechas no definidas en sesión');
        }

        $detalles_raw = ValidarCajaDetalle::with(['compra', 'origen', 'destino'])
            ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
            ->where('estado', 1)
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $detalles_por_fecha = $detalles_raw->groupBy('fecha');

        $period = \Carbon\CarbonPeriod::create($fecha_inicio, $fecha_fin);

        $detalles_completos = [];

        foreach ($period as $fecha) {
            $fecha_str = $fecha->format('Y-m-d');
            $detalles_del_dia = $detalles_por_fecha->get($fecha_str, collect());

            if ($detalles_del_dia->isEmpty()) {
                // Día sin detalles: fila vacía
                $detalles_completos[$fecha_str] = [
                    [
                        'fecha' => $fecha_str,
                        'dia' => ucfirst($fecha->locale('es')->isoFormat('dddd')),
                        'stock_origen' => 0,
                        'cantidad' => 0,
                        'saldo_cbba' => 0,
                        'origen' => 0,
                    ],
                ];
            } else {
                // Consolidar detalles por día en una fila
                $primerDetalle = $detalles_del_dia->first();
                $ultimoDetalle = $detalles_del_dia->last();

                $totalCantidad = $detalles_del_dia->sum(function ($item) {
                    return floatval($item->cantidad);
                });

                $detalles_completos[$fecha_str] = [
                    [
                        'fecha' => $fecha_str,
                        'dia' => ucfirst($fecha->locale('es')->isoFormat('dddd')),
                        'stock_origen' => $primerDetalle->stock,
                        'cantidad' => $totalCantidad,
                        'saldo_cbba' => $ultimoDetalle->stock - $ultimoDetalle->cantidad,
                        'origen' => 0, // fijo por ahora
                    ],
                ];
            }
        }

        // Agrupar por semana y mes, y calcular stock inicial semanal
        $detalles_por_semana = [];

        foreach ($detalles_completos as $fecha_str => $detalles) {
            $fecha = \Carbon\Carbon::parse($fecha_str);
            $semana = $fecha->weekOfYear;
            $mes = ucfirst($fecha->locale('es')->isoFormat('MMMM'));

            if (!isset($detalles_por_semana[$semana])) {
                $detalles_por_semana[$semana] = [
                    'semana' => $semana,
                    'mes' => $mes,
                    'detalles' => [],
                    'stock_inicial' => null,
                ];
            }

            if (is_null($detalles_por_semana[$semana]['stock_inicial'])) {
                $detalles_por_semana[$semana]['stock_inicial'] = $detalles[0]['stock_origen'] ?? 0;
            }

            $detalles_por_semana[$semana]['detalles'][$fecha_str] = $detalles;
        }

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.control_cajas_semanal', [
            'detalles_por_semana' => $detalles_por_semana,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('control_semanal_' . $fecha_inicio . '_al_' . $fecha_fin . '.pdf');
    }
}
