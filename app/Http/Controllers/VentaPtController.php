<?php

namespace App\Http\Controllers;

use App\Models\VentaPt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VentaPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaPt::where('estado',1)->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = VentaPt::with(['Venta','Pt'])->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url("reportes/ventas/$m->venta_id");
            $m->url_2_pdf = url("reportes/ventas-oficial/$m->venta_id");
            $m->url_3_pdf = url("reportes/ticket-ventas-oficial/$m->venta_id");
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
        $ventaPt = new VentaPt();
        $ventaPt->name = $request->name;
        $ventaPt->save();
        return $ventaPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaPt  $ventaPt
     * @return \Illuminate\Http\Response
     */
    public function show(VentaPt $ventaPt)
    {

        return $ventaPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaPt  $ventaPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaPt $ventaPt)
    {
        $ventaPt->name = $request->name;
        $ventaPt->save();
        return $ventaPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaPt  $ventaPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaPt $ventaPt)
    {
        $ventaPt->estado = 0;
        $ventaPt->save();
    }
}
