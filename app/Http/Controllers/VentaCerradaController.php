<?php

namespace App\Http\Controllers;

use App\Models\VentaCerrada;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VentaCerradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaCerrada::where('estado',1)->get();
    }
    // public function fecha(Request $request)
    // {
    //     $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
    //     $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

    //     $model = VentaCerrada::with(['Venta'])->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
    //     $list = [];
    //     foreach ($model as $m ) {
    //         $m->url_pdf = url("reportes/ventas/$m->venta_id");
    //         $m->url_2_pdf = url("reportes/ventas-oficial/$m->venta_id");
    //         $m->url_3_pdf = url("reportes/ticket-ventas-oficial/$m->venta_id");
    //         $list[] = $m;
    //     }
    //     return $list;
    // }

    public function fecha(Request $request) 
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');
        $model = VentaCerrada::with(['Venta.LoteDetalleVentas', 'Venta.cliente'])
            ->whereDate('fecha','>=', $fecha_inicio)
            ->whereDate('fecha','<=', $fecha_fin)
            ->get();

        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url("reportes/ventas/$m->venta_id");
            $m->url_2_pdf = url("reportes/ventas-oficial/$m->venta_id");
            $m->url_3_pdf = url("reportes/ticket-ventas-oficial/$m->venta_id");
            $total_cajas = 0;
            $total_peso_bruto = 0;
            $total_peso_neto = 0;
            $total_tara = 0;

            if ($m->Venta && $m->Venta->LoteDetalleVentas) {
                foreach ($m->Venta->LoteDetalleVentas as $detalle) {
                    $total_cajas += intval($detalle->cajas ?? 0);
                    $total_peso_bruto += floatval($detalle->peso_bruto ?? 0);
                    $total_peso_neto += floatval($detalle->peso_neto ?? 0);
                    $total_tara += (floatval($detalle->peso_bruto ?? 0) - floatval($detalle->peso_neto ?? 0));
                }
            }
            $m->total_cajas = intval($total_cajas);
            $m->total_peso_bruto = number_format($total_peso_bruto, 3, '.', '');
            $m->total_peso_neto  = number_format($total_peso_neto, 3, '.', '');
            $m->total_tara       = number_format($total_tara, 3, '.', '');

            $list[] = $m;
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
        $ventaCerrada = new VentaCerrada();
        $ventaCerrada->name = $request->name;
        $ventaCerrada->save();
        return $ventaCerrada;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaCerrada  $ventaCerrada
     * @return \Illuminate\Http\Response
     */
    public function show(VentaCerrada $ventaCerrada)
    {

        return $ventaCerrada;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaCerrada  $ventaCerrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaCerrada $ventaCerrada)
    {
        $ventaCerrada->name = $request->name;
        $ventaCerrada->save();
        return $ventaCerrada;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaCerrada  $ventaCerrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaCerrada $ventaCerrada)
    {
        $ventaCerrada->estado = 0;
        $ventaCerrada->save();
    }
}
