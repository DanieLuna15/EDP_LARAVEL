<?php

namespace App\Http\Controllers;

use App\Models\ItemPtTransformacionLote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemPtTransformacionLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemPtTransformacionLote::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->items as $item){
            $itemPtTransformacionLote = new ItemPtTransformacionLote();
            $itemPtTransformacionLote->fecha_hora = Carbon::now();
            $itemPtTransformacionLote->encargado = $item['detalle']['encargado'];
            $itemPtTransformacionLote->sucursal_id = $request->sucursal_id;
            $itemPtTransformacionLote->transformacion_lote_id = $request->transformacion_lote_id;
            $itemPtTransformacionLote->user_id = $request->user_id;
            $itemPtTransformacionLote->item_id = $item['item']['id'];
            $itemPtTransformacionLote->pt_id = $item['pt']['id'];
            $itemPtTransformacionLote->cajas = $item['detalle']['cajas'];
            $itemPtTransformacionLote->peso_bruto = $item['detalle']['peso_bruto'];
            $itemPtTransformacionLote->peso_neto = $item['detalle']['peso_neto'];
            $itemPtTransformacionLote->taras = $item['detalle']['tara'];
            $itemPtTransformacionLote->save();
        }
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemPtTransformacionLote  $itemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPtTransformacionLote $itemPtTransformacionLote)
    {

        return $itemPtTransformacionLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemPtTransformacionLote  $itemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPtTransformacionLote $itemPtTransformacionLote)
    {
        $itemPtTransformacionLote->name = $request->name;
        $itemPtTransformacionLote->save();
        return $itemPtTransformacionLote;
    }
    public function cerrar(Request $request, ItemPtTransformacionLote $itemPtTransformacionLote)
    {
        $itemPtTransformacionLote->is_declarado = 1;
        $itemPtTransformacionLote->cierre= Carbon::now();
        $itemPtTransformacionLote->save();
        return $itemPtTransformacionLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPtTransformacionLote  $itemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPtTransformacionLote $itemPtTransformacionLote)
    {
        $itemPtTransformacionLote->estado = 0;
        $itemPtTransformacionLote->save();
    }
}
