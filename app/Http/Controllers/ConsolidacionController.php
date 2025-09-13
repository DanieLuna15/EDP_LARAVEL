<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Consolidacion;
use App\Models\CambioPrecioConsolidacion;
use App\Models\ConsolidacionDetalle;
use App\Models\ConsolidacionPago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ConsolidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Consolidacion::with(['ConsolidacionPagoDetalle', 'Compra'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->url_pdf = url("reportes/consolidacions/$s->id");
            $s->url_cambios_pdf = url("reportes/consolidacions-cambios-precio/$s->id");
            $s->detalle_pagos_url_pdf = url("reportes/consolidacions-detalle-pagos/$s->id");
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
        try {

            $consolidacion = new Consolidacion();
            $consolidacion->compra_id = $request->compra_id;
            $consolidacion->consolidacionparam_id = $request->consolidacionparam_id;
            $consolidacion->fecha = Carbon::now()->format('Y-m-d');
            $consolidacion->valor_total = $request->valor_total;
            $consolidacion->peso_total = $request->peso_total;
            $consolidacion->detalle_gastos = $request->gastos;

            $consolidacion->save();

            foreach ($request->categoria_list as $a) {
                foreach ($a['categoria_proveedor_list'] as $m) {
                    $consolidacionDetalle = new ConsolidacionDetalle();
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
                    $consolidacionDetalle->compra_id = $a['id'];
                    $consolidacionDetalle->pollos = $m['sumaPollos'];
                    $consolidacionDetalle->kg_total = $m['kg_total'];
                    $consolidacionDetalle->kg_criterio = $m['kg_criterio'];
                    $consolidacionDetalle->kg_criterio_total = $m['kg_criterio_total'];

                    $consolidacionDetalle->save();
                    Log::info('Detalle de consolidación guardado', ['consolidacion_detalle_id' => $consolidacionDetalle->id]);
                }
            }

            $consolidacion->url_pdf = url("reportes/consolidacions/$consolidacion->id");

            return $consolidacion;
        } catch (\Exception $e) {
            $consolidacion->delete();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consolidacion  $consolidacion
     * @return \Illuminate\Http\Response
     */
    public function show(Consolidacion $consolidacion)
    {
        $consolidacion->compra = $this->compra($consolidacion->compra);
        $consolidacion->detalles = $consolidacion->ConsolidacionDetalles()->get()->map(function ($d) {
            $d->n_cambios = $d->CambioPrecioConsolidacions()->count();
            return $d;
        });
        if ($consolidacion->detalle_gastos) {
            $consolidacion->gastos = $consolidacion->detalle_gastos;
        } else {
            $consolidacion->gastos = [];
        }
        return $consolidacion;
    }
    public function cambioPrecioLotes(Consolidacion $consolidacion)
    {
        $consolidacion->compra = $this->compra($consolidacion->compra);
        $consolidacion->detalles = $consolidacion->CambioPrecioConsolidacions()->get();
        return $consolidacion;
    }
    public function compra(Compra $compra)
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
     * @param  \App\Models\Consolidacion  $consolidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consolidacion $consolidacion)
    {
        $consolidacion->valor_total = $request->valor_total;
        $consolidacion->peso_total = $request->peso_total;
        $consolidacion->detalle_gastos = $request->gastos_finales;
        $consolidacion->save();
        foreach ($request->categoria_list as $m) {
            $consolidacionDetalle = ConsolidacionDetalle::where('id', $m['id'])->first();
            $consolidacionDetalle->categoria_id = $m['categoria']['id'];
            $consolidacionDetalle->suma_total = $m['suma_total'];
            $consolidacionDetalle->precio_compra = $m['precio_compra'];
            if ($consolidacionDetalle->precio != $m['precio']) {
                $nro_cambio = $consolidacionDetalle->CambioPrecioConsolidacions()->get()->count();
                $cambioPrecioConsolidacion = new CambioPrecioConsolidacion();
                $cambioPrecioConsolidacion->consolidacion_detalle_id = $consolidacionDetalle->id;
                $cambioPrecioConsolidacion->consolidacion_id = $consolidacion->id;
                $cambioPrecioConsolidacion->precio_anterior = $consolidacionDetalle->precio;
                $cambioPrecioConsolidacion->precio_actual = $m['precio'];
                $cambioPrecioConsolidacion->nro_cambio = $nro_cambio + 1;
                $cambioPrecioConsolidacion->fecha_cambio = Carbon::now();
                $cambioPrecioConsolidacion->user_id = $request['user_id'];
                $cambioPrecioConsolidacion->save();
                $consolidacionDetalle->precio = $m['precio'];
            }
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

        $consolidacion->url_pdf = url("reportes/consolidacions/$consolidacion->id");
        return $consolidacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consolidacion  $consolidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consolidacion $consolidacion)
    {
        $consolidacion->estado = 0;
        $consolidacion->save();
    }
    public function pdf(Consolidacion $consolidacion)
    {
        $consolidacion = $this->show($consolidacion);

        $pdf = Pdf::loadView('reportes.pdf.almacen.consolidacion', ["consolidacion" => $consolidacion]);
        //pdf hortizontal
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfcambios(Consolidacion $consolidacion)
    {
        $consolidacion = $this->cambioPrecioLotes($consolidacion);

        $pdf = Pdf::loadView('reportes.pdf.almacen.consolidacion-cambio-precio', ["consolidacion" => $consolidacion]);
        //pdf hortizontal
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfdetallePagos(Consolidacion $consolidacion)
    {
        $consolidacionPago = $this->show($consolidacion);

        $pdf = Pdf::loadView('reportes.pdf.almacen.detallepago', ["consolidacion" => $consolidacion])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }
}
