<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CompraAve;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ConsolidacionAve;
use Illuminate\Support\Facades\Log;
use App\Models\ConsolidacionAveDetalle;
use App\Models\CambioPrecioConsolidacionAve;

class ConsolidacionAveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ConsolidacionAve::with(['ConsolidacionPagoDetalle', 'Compra'])->get();
        $list = [];
        foreach ($model as $s) {
            $s->url_pdf = url("reportes/consolidacions_aves/{$s->id}");
            $s->url_cambios_pdf = url("reportes/consolidacions_aves-cambios-precio/{$s->id}");
            $s->detalle_pagos_url_pdf = url("reportes/consolidacions_aves-detalle-pagos/{$s->id}");

            $list[] = $s;
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacion = new ConsolidacionAve();
        $consolidacion->compra_ave_id = $request->compra_id;
        $consolidacion->consolidacionparam_id = $request->consolidacionparam_id;
        $consolidacion->fecha = Carbon::now()->format('Y-m-d');
        $consolidacion->valor_total = $request->valor_total;
        $consolidacion->peso_total = $request->peso_total;
        $consolidacion->detalle_gastos = $request->gastos;

        try {
            $consolidacion->save();
            foreach ($request->categoria_list as $a) {
                foreach ($a['categoria_proveedor_list'] as $m) {
                    $consolidacionDetalle = new ConsolidacionAveDetalle();
                    $consolidacionDetalle->consolidacion_id = $consolidacion->id;
                    $consolidacionDetalle->categoria_id = $m['categoria']['id'];
                    $consolidacionDetalle->suma_total = $m['sumaTotal'];
                    $consolidacionDetalle->precio_compra = $m['precioCompra'];
                    $consolidacionDetalle->precio = $m['precio'];
                    $consolidacionDetalle->nuevo_peso = $m['nuevo_peso'];
                    $consolidacionDetalle->nuevo_peso_2 = $m['nuevo_peso_2'];
                    $consolidacionDetalle->oficial = $m['oficial'];
                    $consolidacionDetalle->ajuste = $m['ajuste'];
                    $consolidacionDetalle->nuevoajuste = $m['nuevoajuste'];
                    $consolidacionDetalle->criterio = $m['criterio'];
                    $consolidacionDetalle->lp = $m['lp'];
                    $consolidacionDetalle->compra_ave_id = $a['id'];
                    $consolidacionDetalle->pollos = $m['sumaPollos'];
                    $consolidacionDetalle->kg_total = $m['kg_total'];
                    $consolidacionDetalle->kg_criterio = $m['kg_criterio'];
                    $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'];
                    $consolidacionDetalle->save();
                }
            }
            $consolidacion->url_pdf = url("reportes/consolidacions_aves/$consolidacion->id");
            return $consolidacion;
        } catch (\Exception $e) {
            $consolidacion->delete();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAve  $consolidacion
     * @return \Illuminate\Http\Response
     */



    public function show($id)
    {
        $consolidacion = ConsolidacionAve::with(['Compra', 'ConsolidacionDetalles.CambioPrecioConsolidacions'])->find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidacion no encontrada'], 404);
        }
        if ($consolidacion->compra) {
            $consolidacion->compra = $this->compra($consolidacion->compra);
        } else {
            $consolidacion->compra = null;
        }
        $consolidacion->detalles = $consolidacion->ConsolidacionDetalles->map(function ($d) {
            $countCambios = $d->CambioPrecioConsolidacions->count();
            $d->n_cambios = $countCambios;
            return $d;
        });
        if ($consolidacion->detalle_gastos) {
            $consolidacion->gastos = $consolidacion->detalle_gastos;
        } else {
            $consolidacion->gastos = [];
        }
        return $consolidacion;
    }


    public function cambioPrecioLotes(ConsolidacionAve $consolidacion)
    {
        $consolidacion->compra = $this->compra($consolidacion->compra);
        $consolidacion->detalles = $consolidacion->CambioPrecioConsolidacions()->get();
        return $consolidacion;
    }
    public function compra(CompraAve $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles = $compra->CompraInventarios()->get()->groupBy('sub_medida_id');
        $list = [];
        foreach ($detalles as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list[] =  ["sub_medida" => $submedida, "list" => $sub];
        }
        $categorias = $compra->CompraInventarios()->get()->groupBy('categoria_id');
        $category_List = [];
        foreach ($categorias as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;


            $category_List[] =  [
                "categoria" => $categoria,
                "sumaTotal" => $sub->sum('valor'),
                "sumaPollos" => $sub->sum('nro'),
                "taras" => $sub->sum('cant'),
                "criterio" => 0,
                "precio" => 0,
                "nuevoajuste" => 0,
            ];
        }
        $compra->category_list = $category_List;
        $compra->detalles = $list;
        return $compra;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAve  $consolidacion
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $consolidacion = ConsolidacionAve::find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidación no encontrada'], 404);
        }
        $consolidacion->valor_total = $request->valor_total;
        $consolidacion->peso_total = $request->peso_total;
        $consolidacion->detalle_gastos = $request->gastos_finales;

        $consolidacion->save();

        foreach ($request->categoria_list as $m) {
            $consolidacionDetalle = ConsolidacionAveDetalle::where('id', $m['id'])->first();
            $consolidacionDetalle->categoria_id = $m['categoria']['id'];
            $consolidacionDetalle->suma_total = $m['suma_total'];
            $consolidacionDetalle->precio_compra = $m['precio_compra'];

            // Si el precio ha cambiado, guardamos el cambio
            if ($consolidacionDetalle->precio != $m['precio']) {
                $nro_cambio = $consolidacionDetalle->CambioPrecioConsolidacions()->get()->count();

                $cambioPrecioConsolidacion = new CambioPrecioConsolidacionAve();
                $cambioPrecioConsolidacion->consolidacion_detalle_id = $consolidacionDetalle->id;
                $cambioPrecioConsolidacion->consolidacion_id = $consolidacion->id;
                $cambioPrecioConsolidacion->precio_anterior = $consolidacionDetalle->precio;
                $cambioPrecioConsolidacion->precio_actual = $m['precio'];
                $cambioPrecioConsolidacion->nro_cambio = $nro_cambio + 1;
                $cambioPrecioConsolidacion->fecha_cambio = Carbon::now();
                $cambioPrecioConsolidacion->user_id = $request['user_id'];
                $cambioPrecioConsolidacion->save();

                // Actualizamos el precio del detalle
                $consolidacionDetalle->precio = $m['precio'];
            }

            // Actualizamos otros valores del detalle
            $consolidacionDetalle->nuevo_peso = $m['nuevo_peso'];
            $consolidacionDetalle->nuevo_peso_2 = $m['nuevo_peso_2'];
            $consolidacionDetalle->oficial = $m['oficial'];
            $consolidacionDetalle->ajuste = $m['ajuste'];
            $consolidacionDetalle->nuevoajuste = $m['nuevoajuste'];
            $consolidacionDetalle->precio_compra = $m['precioCompra'];
            $consolidacionDetalle->criterio = $m['criterio'];
            $consolidacionDetalle->lp = $m['lp'];
            $consolidacionDetalle->pollos = $m['pollos'];
            $consolidacionDetalle->kg_total = $m['kg_total'];
            $consolidacionDetalle->kg_criterio = $m['kg_criterio'];
            $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'];
            $consolidacionDetalle->save();
        }
        // Guardar la URL del PDF
        $consolidacion->url_pdf = url("reportes/consolidacions_aves/$consolidacion->id");
        return $consolidacion;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAve  $consolidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consolidacion = ConsolidacionAve::find($id);
        $consolidacion->estado = 0;
        $consolidacion->save();
    }
    public function pdf($id)
    {
        $consolidacion = ConsolidacionAve::find($id);
        $consolidacion = $this->show($consolidacion->id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion', ["consolidacion" => $consolidacion]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function pdfcambios($id)
    {
        $consolidacion = ConsolidacionAve::find($id);
        $consolidacion = $this->cambioPrecioLotes($consolidacion);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion-cambio-precio', ["consolidacion" => $consolidacion]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function pdfdetallePagos($id)
    {
        $consolidacion = ConsolidacionAve::find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidación no encontrada'], 404);
        }
        $consolidacionPago = $this->show($id); 
        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.detallepago', ["consolidacion" => $consolidacionPago]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
