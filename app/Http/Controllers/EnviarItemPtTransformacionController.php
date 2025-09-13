<?php

namespace App\Http\Controllers;

use App\Models\EnviarItemPtTransformacion;
use App\Models\TransformacionLoteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EnviarItemPtTransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EnviarItemPtTransformacion::with(['Item','Pt'])->where([['estado',1],['is_aceptado',0]])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $enviarItemPtTransformacion = new EnviarItemPtTransformacion();
        $enviarItemPtTransformacion->pt_id = $request->pt_id;
        $enviarItemPtTransformacion->sucursal_id = $request->sucursal_id;
        $enviarItemPtTransformacion->user_id = $request->user_id;
        $enviarItemPtTransformacion->item_id = $request->item['id'];
        $enviarItemPtTransformacion->peso_bruto = $request->detalle_envio['peso_bruto'];
        $enviarItemPtTransformacion->peso_neto = $request->detalle_envio['peso_neto'];
        $enviarItemPtTransformacion->cajas = $request->detalle_envio['cajas'];
        if ($request->detalle_envio['cajas'] > 0) {
            $taras= $request->detalle_envio['cajas'] * 2;
            $enviarItemPtTransformacion->taras = $taras;
        }else{
            $enviarItemPtTransformacion->taras = 0;
        }
        $enviarItemPtTransformacion->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
        $enviarItemPtTransformacion->save();
        return $enviarItemPtTransformacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnviarItemPtTransformacion  $enviarItemPtTransformacion
     * @return \Illuminate\Http\Response
     */
    public function show(EnviarItemPtTransformacion $enviarItemPtTransformacion)
    {
        return $enviarItemPtTransformacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnviarItemPtTransformacion  $enviarItemPtTransformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnviarItemPtTransformacion $enviarItemPtTransformacion)
    {
        $enviarItemPtTransformacion->is_aceptado = 1;
        $enviarItemPtTransformacion->save();
        $transformacionLoteItem = new TransformacionLoteItem();
        $transformacionLoteItem->transformacion_lote_id = $request->transformacion_lote_id;
        $transformacionLoteItem->item_id = $request->item_id;
        $transformacionLoteItem->sucursal_id = $request->sucursal_id;
        $transformacionLoteItem->user_id = $request->user_id;
        $transformacionLoteItem->cajas = $request->cajas;
        $transformacionLoteItem->pt_id = $enviarItemPtTransformacion->pt_id;
        $transformacionLoteItem->peso_bruto = $request->peso_bruto;
        $transformacionLoteItem->peso_neto = $request->peso_neto;
        $transformacionLoteItem->tara = $enviarItemPtTransformacion->taras;
        $transformacionLoteItem->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
        $transformacionLoteItem->save();
        return $enviarItemPtTransformacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnviarItemPtTransformacion  $enviarItemPtTransformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnviarItemPtTransformacion $enviarItemPtTransformacion)
    {
        $enviarItemPtTransformacion->estado = 0;
        $enviarItemPtTransformacion->save();
    }
}
