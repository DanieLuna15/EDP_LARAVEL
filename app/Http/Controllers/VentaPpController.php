<?php

namespace App\Http\Controllers;

use App\Models\VentaPp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VentaPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaPp::where('estado',1)->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = VentaPp::with(['Venta','Pp'])->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
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
        $ventaPp = new VentaPp();
        $ventaPp->name = $request->name;
        $ventaPp->save();
        return $ventaPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaPp  $ventaPp
     * @return \Illuminate\Http\Response
     */
    public function show(VentaPp $ventaPp)
    {

        return $ventaPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaPp  $ventaPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaPp $ventaPp)
    {
        $ventaPp->name = $request->name;
        $ventaPp->save();
        return $ventaPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaPp  $ventaPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaPp $ventaPp)
    {
        $ventaPp->estado = 0;
        $ventaPp->save();
    }
}
