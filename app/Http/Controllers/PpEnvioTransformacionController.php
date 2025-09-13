<?php

namespace App\Http\Controllers;

use App\Models\PpEnvioTransformacion;
use App\Models\PpEnvioTransformacionDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PpEnvioTransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpEnvioTransformacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppEnvioTransformacion = new PpEnvioTransformacion();
        $ppEnvioTransformacion->fecha_hora = Carbon::now();
        $ppEnvioTransformacion->sucursal_id = $request->sucursal_id;
        $ppEnvioTransformacion->user_id = $request->user_id;
        $ppEnvioTransformacion->pp_id = $request->pp_id;
        $ppEnvioTransformacion->save();

        foreach ($request->data as $d) {
           $ppEnvioTransformacionDetalle = new PpEnvioTransformacionDetalle();
           $ppEnvioTransformacionDetalle->pp_id = $request->pp_id;
           $ppEnvioTransformacionDetalle->user_id = $request->user_id;
           $ppEnvioTransformacionDetalle->sucursal_id = $request->sucursal_id;
           $ppEnvioTransformacionDetalle->pp_envio_transformacion_id = $ppEnvioTransformacion->id;
           $ppEnvioTransformacionDetalle->cajas = $d['cajas'];
           $ppEnvioTransformacionDetalle->pollos = $d['pollos'];
           $ppEnvioTransformacionDetalle->peso_bruto = $d['peso_bruto'];
           $ppEnvioTransformacionDetalle->peso_neto = $d['peso_neto'];
           $ppEnvioTransformacionDetalle->peso_bruto_u = $d['pb_unit'];
           $ppEnvioTransformacionDetalle->peso_neto_u = $d['pn_unit'];
           $ppEnvioTransformacionDetalle->merma_bruto = $d['merma_bruto'];
           $ppEnvioTransformacionDetalle->merma_neto = $d['merma_neto'];
           $ppEnvioTransformacionDetalle->cinta_cliente = $d['cinta_cliente'];
           $ppEnvioTransformacionDetalle->cinta_pigmento = $d['cinta_pigmento'];
           $ppEnvioTransformacionDetalle->fecha_hora = Carbon::now();
           $ppEnvioTransformacionDetalle->save();
        }
        return $ppEnvioTransformacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpEnvioTransformacion  $ppEnvioTransformacion
     * @return \Illuminate\Http\Response
     */
    public function show(PpEnvioTransformacion $ppEnvioTransformacion)
    {

        return $ppEnvioTransformacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpEnvioTransformacion  $ppEnvioTransformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpEnvioTransformacion $ppEnvioTransformacion)
    {
        $ppEnvioTransformacion->name = $request->name;
        $ppEnvioTransformacion->save();
        return $ppEnvioTransformacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpEnvioTransformacion  $ppEnvioTransformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpEnvioTransformacion $ppEnvioTransformacion)
    {
        $ppEnvioTransformacion->estado = 0;
        $ppEnvioTransformacion->save();
    }
}
