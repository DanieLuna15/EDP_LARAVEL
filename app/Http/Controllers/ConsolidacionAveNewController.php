<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CompraAve;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ConsolidacionAveNew;
use Illuminate\Support\Facades\Log;
use App\Models\ConsolidacionAveNewDetalle;
use App\Models\CambioPrecioConsolidacionAveNew;

class ConsolidacionAveNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $model = ConsolidacionAveNew::with(['ConsolidacionPagoDetalle', 'Compra'])->get();
        $model = ConsolidacionAveNew::with(['ConsolidacionPagoDetalle'])->get();
        $list = [];
        foreach ($model as $s) {
            $s->url_pdf = url("reportes/consolidacions_aves_new/{$s->id}");
            $s->url_pdf2 = url("reportes/consolidacions_aves_new2/{$s->id}");
            $s->url_cambios_pdf = url("reportes/consolidacions_aves_new-cambios-precio/{$s->id}");
            $s->detalle_pagos_url_pdf = url("reportes/consolidacions_aves_new-detalle-pagos/{$s->id}");

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
        Log::info($request->all());
        //dd($request->all());
        $consolidacion = new ConsolidacionAveNew();
        // $consolidacion->compra_ave_id = $request->compra_id;
        $consolidacion->consolidacionparam_id = $request->consolidacionparam_id;
        $consolidacion->fecha = Carbon::now()->format('Y-m-d');
        $consolidacion->valor_total = $request->valor_total;
        $consolidacion->peso_total = $request->peso_total;
        $consolidacion->detalle_gastos = $request->gastos;
        $consolidacion->valor_aves_muertas = $request->valor_aves_muertas ?? 0;
        $consolidacion->valor_por_ave_muerta = $request->valor_por_ave_muerta ?? 0;

        try {
            $consolidacion->save();
            foreach ($request->categoria_list as $aKey => $a) {
                foreach ($a['categoria_proveedor_list'] as $mKey => $m) {
                    $consolidacionDetalle = new ConsolidacionAveNewDetalle();
                    $consolidacionDetalle->consolidacion_id = $consolidacion->id;
                    $consolidacionDetalle->categoria_id = $m['categoria']['id'];
                    $consolidacionDetalle->nro_lote = $m['nro_lote'] ?? '';
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
                    // $consolidacionDetalle->compra_ave_id = $a['id'];
                    $consolidacionDetalle->pollos = $m['sumaPollos'];
                    $consolidacionDetalle->kg_total = $m['kg_total'];
                    $consolidacionDetalle->kg_criterio = $m['kg_criterio'];
                    $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'];
                    $consolidacionDetalle->cantidad_jaulas = $m['cantidad_jaulas'];
                    $consolidacionDetalle->tara = $m['tara'];
                    $consolidacionDetalle->peso_bruto = $m['peso_bruto'];
                    $consolidacionDetalle->proveedor = $m['proveedor'];
                    $consolidacionDetalle->fecha = Carbon::now()->format('Y-m-d');
                    $consolidacionDetalle->observacion = $m['observacion'] ?? null;



                    $consolidacionDetalle->save();
                }
            }

            $consolidacion->url_pdf = url("reportes/consolidacions_aves_new/$consolidacion->id");
            $consolidacion->url_pdf2 = url("reportes/consolidacions_aves_new2/$consolidacion->id");
            return $consolidacion;
        } catch (\Exception $e) {
            $consolidacion->delete();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAveNew  $consolidacion
     * @return \Illuminate\Http\Response
     */



    public function show($id)
    {
        $consolidacion = ConsolidacionAveNew::with(['Compra', 'ConsolidacionDetalles.CambioPrecioConsolidacions'])->find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidacion no encontrada'], 404);
        }

        // Verifica si hay información de compra
        if ($consolidacion->compra) {
            $consolidacion->compra = $this->compra($consolidacion->compra);
        } else {
            $consolidacion->compra = null;
        }

        // Carga los detalles de la consolidación
        $consolidacion->detalles = $consolidacion->ConsolidacionDetalles->map(function ($d) {
            $countCambios = $d->CambioPrecioConsolidacions->count();
            $d->n_cambios = $countCambios;
            return $d;
        });

        // Verifica si hay detalles de gastos
        if ($consolidacion->detalle_gastos) {
            $consolidacion->gastos = $consolidacion->detalle_gastos;
        } else {
            $consolidacion->gastos = [];
        }

        // Asegúrate de que el valor de aves muertas esté incluido
        $consolidacion->valor_por_ave_muerta = $consolidacion->valor_por_ave_muerta ?? 0;

        return $consolidacion;
    }


    public function cambioPrecioLotes(ConsolidacionAveNew $consolidacion)
    {
        //$consolidacion->compra = $this->compra($consolidacion->compra);
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
     * @param  \App\Models\ConsolidacionAveNew  $consolidacion
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request, $id)
    // {
    //     $consolidacion = ConsolidacionAveNew::find($id);
    //     if (!$consolidacion) {
    //         return response()->json(['error' => 'Consolidación no encontrada'], 404);
    //     }
    //     $consolidacion->valor_total = $request->valor_total;
    //     $consolidacion->peso_total = $request->peso_total;
    //     $consolidacion->detalle_gastos = $request->gastos_finales;

    //     $consolidacion->save();

    //     foreach ($request->categoria_list as $m) {
    //         $consolidacionDetalle = ConsolidacionAveNewDetalle::where('id', $m['id'])->first();
    //         $consolidacionDetalle->categoria_id = $m['categoria']['id'];
    //         $consolidacionDetalle->suma_total = $m['suma_total'];
    //         $consolidacionDetalle->precio_compra = $m['precio_compra'];

    //         // Si el precio ha cambiado, guardamos el cambio
    //         if ($consolidacionDetalle->precio != $m['precio']) {
    //             $nro_cambio = $consolidacionDetalle->CambioPrecioConsolidacions()->get()->count();

    //             $cambioPrecioConsolidacion = new CambioPrecioConsolidacionAveNew();
    //             $cambioPrecioConsolidacion->consolidacion_detalle_id = $consolidacionDetalle->id;
    //             $cambioPrecioConsolidacion->consolidacion_id = $consolidacion->id;
    //             $cambioPrecioConsolidacion->precio_anterior = $consolidacionDetalle->precio;
    //             $cambioPrecioConsolidacion->precio_actual = $m['precio'];
    //             $cambioPrecioConsolidacion->nro_cambio = $nro_cambio + 1;
    //             $cambioPrecioConsolidacion->fecha_cambio = Carbon::now();
    //             $cambioPrecioConsolidacion->user_id = $request['user_id'];
    //             $cambioPrecioConsolidacion->save();

    //             // Actualizamos el precio del detalle
    //             $consolidacionDetalle->precio = $m['precio'];
    //         }

    //         // Actualizamos otros valores del detalle
    //         $consolidacionDetalle->nuevo_peso = $m['nuevo_peso'];
    //         $consolidacionDetalle->nuevo_peso_2 = $m['nuevo_peso_2'];
    //         $consolidacionDetalle->oficial = $m['oficial'];
    //         $consolidacionDetalle->ajuste = $m['ajuste'];
    //         $consolidacionDetalle->nuevoajuste = $m['nuevoajuste'];
    //         $consolidacionDetalle->precio_compra = $m['precioCompra'];
    //         $consolidacionDetalle->criterio = $m['criterio'];
    //         $consolidacionDetalle->lp = $m['lp'];
    //         $consolidacionDetalle->pollos = $m['pollos'];
    //         $consolidacionDetalle->kg_total = $m['kg_total'];
    //         $consolidacionDetalle->kg_criterio = $m['kg_criterio'];
    //         $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'];
    //         $consolidacionDetalle->save();
    //     }
    //     // Guardar la URL del PDF
    //     $consolidacion->url_pdf = url("reportes/consolidacions_aves_new/$consolidacion->id");
    //     return $consolidacion;
    // }

    public function update(Request $request, $id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidación no encontrada'], 404);
        }

        $consolidacion->valor_total = $request->valor_total;
        $consolidacion->peso_total = $request->peso_total;
        $consolidacion->detalle_gastos = $request->gastos_finales;
        $consolidacion->valor_aves_muertas = $request->valor_aves_muertas ?? 0;
        $consolidacion->valor_por_ave_muerta = $request->valor_por_ave_muerta ?? 0;
        $consolidacion->save();

        $idsFromRequest = collect($request->categoria_list)
            ->filter(fn($m) => isset($m['id']))
            ->pluck('id')
            ->toArray();

        $detallesEliminados = ConsolidacionAveNewDetalle::where('consolidacion_id', $consolidacion->id)
            ->whereNotIn('id', $idsFromRequest)
            ->pluck('id')
            ->toArray();

        if (!empty($detallesEliminados)) {
            CambioPrecioConsolidacionAveNew::whereIn('consolidacion_detalle_id', $detallesEliminados)->delete();
        }

        ConsolidacionAveNewDetalle::where('consolidacion_id', $consolidacion->id)
            ->whereNotIn('id', $idsFromRequest)
            ->delete();

        foreach ($request->categoria_list as $key => $m) {
            $esNuevo = false;
            if (isset($m['id'])) {
                $consolidacionDetalle = ConsolidacionAveNewDetalle::where('id', $m['id'])->first();
            } else {
                $consolidacionDetalle = new ConsolidacionAveNewDetalle();
                $consolidacionDetalle->consolidacion_id = $consolidacion->id;
                $esNuevo = true;
            }
            $precioAnterior = $esNuevo ? 0 : $consolidacionDetalle->precio ?? 0;
            $consolidacionDetalle->categoria_id = $m['categoria']['id'];
            $consolidacionDetalle->nro_lote = $m['nro_lote'] ?? '';
            $consolidacionDetalle->suma_total = $m['suma_total'] ?? $m['sumaTotal'] ?? 0;
            $consolidacionDetalle->precio_compra = round((float)($m['oficial'] ?? 0) * (float)($m['precio'] ?? 0), 2);
            $consolidacionDetalle->precio = $m['precio'] ?? 0;
            $consolidacionDetalle->nuevo_peso = $m['nuevo_peso'] ?? 0;
            $consolidacionDetalle->nuevo_peso_2 = $m['nuevo_peso_2'] ?? 0;
            $consolidacionDetalle->oficial = $m['oficial'] ?? 0;
            $consolidacionDetalle->ajuste = $m['ajuste'] ?? 0;
            $consolidacionDetalle->nuevoajuste = $m['nuevoajuste'] ?? 0;
            $consolidacionDetalle->criterio = $m['criterio'] ?? 0;
            $consolidacionDetalle->lp = $m['lp'] ?? 0;
            $consolidacionDetalle->pollos = $m['pollos'] ?? $m['sumaPollos'] ?? 0;
            $consolidacionDetalle->kg_total = $m['kg_total'] ?? 0;
            $consolidacionDetalle->kg_criterio = $m['kg_criterio'] ?? 0;
            $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'] ?? 0;
            $consolidacionDetalle->cantidad_jaulas = $m['cantidad_jaulas'] ?? 0;
            $consolidacionDetalle->tara = $m['tara'] ?? 0;
            $consolidacionDetalle->peso_bruto = $m['peso_bruto'] ?? 0;
            $consolidacionDetalle->proveedor = $m['proveedor'] ?? '';
            $consolidacionDetalle->fecha = Carbon::now()->format('Y-m-d');
            $consolidacionDetalle->observacion = $m['observacion'] ?? null;

            $debeRegistrarCambio = false;
            $nuevoPrecio = $m['precio'] ?? 0;

            if ($esNuevo) {
                $debeRegistrarCambio = true;
                $nro_cambio = 1;
            } else {
                if ($precioAnterior != $nuevoPrecio) {
                    $debeRegistrarCambio = true;
                    $nro_cambio = $consolidacionDetalle->CambioPrecioConsolidacions()->count() + 1;
                }
            }

            $consolidacionDetalle->save();
            if ($debeRegistrarCambio) {
                $cambioPrecioConsolidacion = new CambioPrecioConsolidacionAveNew();
                $cambioPrecioConsolidacion->consolidacion_detalle_id = $consolidacionDetalle->id;
                $cambioPrecioConsolidacion->consolidacion_id = $consolidacion->id;
                $cambioPrecioConsolidacion->precio_anterior = $precioAnterior;
                $cambioPrecioConsolidacion->precio_actual = $consolidacionDetalle->precio;
                $cambioPrecioConsolidacion->nro_cambio = $nro_cambio;
                $cambioPrecioConsolidacion->fecha_cambio = Carbon::now();
                $cambioPrecioConsolidacion->user_id = $request['user_id'];
                $cambioPrecioConsolidacion->save();
            }
        }
        $consolidacion->url_pdf = url("reportes/consolidacions_aves_new/$consolidacion->id");
        $consolidacion->url_pdf2 = url("reportes/consolidacions_aves_new2/$consolidacion->id");
        return $consolidacion;
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAveNew  $consolidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        $consolidacion->estado = 0;
        $consolidacion->save();
    }
    public function pdf($id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        $consolidacion = $this->show($consolidacion->id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.consolidacion', ["consolidacion" => $consolidacion]);
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }

    public function pdf2($id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        $consolidacion = $this->show($consolidacion->id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.consolidacion_2', ["consolidacion" => $consolidacion]);
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfcambios($id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        $consolidacion = $this->cambioPrecioLotes($consolidacion);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.consolidacion-cambio-precio', ["consolidacion" => $consolidacion]);
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfdetallePagos($id)
    {
        $consolidacion = ConsolidacionAveNew::find($id);
        if (!$consolidacion) {
            return response()->json(['error' => 'Consolidación no encontrada'], 404);
        }
        $consolidacionPago = $this->show($id);
        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.detallepago', ["consolidacion" => $consolidacionPago]);
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
}
