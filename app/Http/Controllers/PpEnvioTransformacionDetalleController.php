<?php

namespace App\Http\Controllers;

use App\Models\PpEnvioTransformacionDetalle;
use App\Models\TransformacionLoteDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PpEnvioTransformacionDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpEnvioTransformacionDetalle::with(['Pp'])->where([['estado',1],['is_aceptado',0]])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppEnvioTransformacionDetalle = new PpEnvioTransformacionDetalle();
        $ppEnvioTransformacionDetalle->name = $request->name;
        $ppEnvioTransformacionDetalle->save();
        return $ppEnvioTransformacionDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpEnvioTransformacionDetalle  $ppEnvioTransformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PpEnvioTransformacionDetalle $ppEnvioTransformacionDetalle)
    {

        return $ppEnvioTransformacionDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpEnvioTransformacionDetalle  $ppEnvioTransformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpEnvioTransformacionDetalle $ppEnvioTransformacionDetalle)
    {
        $ppEnvioTransformacionDetalle->name = $request->name;
        $ppEnvioTransformacionDetalle->save();
        return $ppEnvioTransformacionDetalle;
    }
    public function aceptar(Request $request, PpEnvioTransformacionDetalle $ppEnvioTransformacionDetalle)
    {
        $ppEnvioTransformacionDetalle->is_aceptado = 1;
        $ppEnvioTransformacionDetalle->save();
        $tranformacionLoteDetalle = new TransformacionLoteDetalle();
        $tranformacionLoteDetalle->transformacion_lote_id = $request->transformacion_lote_id;
        $tranformacionLoteDetalle->pp_envio_transformacion_detalle_id = $ppEnvioTransformacionDetalle->id;
        $tranformacionLoteDetalle->user_id = $request->user_id;
        $tranformacionLoteDetalle->sucursal_id = $request->sucursal_id;
        $tranformacionLoteDetalle->merma_bruto = $request->merma_bruto;
        $tranformacionLoteDetalle->merma_neto = $request->merma_neto;
        $tranformacionLoteDetalle->peso_neto_u = $request->peso_neto_u;
        $tranformacionLoteDetalle->peso_neto = $request->peso_neto;
        $tranformacionLoteDetalle->peso_bruto = $request->peso_bruto;
        $tranformacionLoteDetalle->peso_bruto_u = $request->peso_bruto_u;
        $tranformacionLoteDetalle->pollos = $request->pollos;
        $tranformacionLoteDetalle->cajas = $request->cajas;
        $tranformacionLoteDetalle->fecha_hora = Carbon::now();
        $tranformacionLoteDetalle->save();
        return $ppEnvioTransformacionDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpEnvioTransformacionDetalle  $ppEnvioTransformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpEnvioTransformacionDetalle $ppEnvioTransformacionDetalle)
    {
        $ppEnvioTransformacionDetalle->estado = 0;
        $ppEnvioTransformacionDetalle->save();
    }
}
