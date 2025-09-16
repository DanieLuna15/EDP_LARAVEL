<?php

namespace App\Http\Controllers;

use App\Models\SubItemPtTransformacionLote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SubItemPtTransformacionLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubItemPtTransformacionLote::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //dd($request->all());
    //     $m = $request->items;
    //     foreach($m['lista_trozados'] as $item){
    //         $SubItemPtTransformacionLote = new SubItemPtTransformacionLote();
    //         $SubItemPtTransformacionLote->fecha_hora = Carbon::now();
    //         $SubItemPtTransformacionLote->encargado = $item['item']['encargado'];
    //         $SubItemPtTransformacionLote->item_pt_transformacion_lote_id = $item['item']['id'];
    //         $SubItemPtTransformacionLote->sucursal_id = $request->sucursal_id;
    //         $SubItemPtTransformacionLote->transformacion_lote_id = $request->transformacion_lote_id;
    //         $SubItemPtTransformacionLote->user_id = $request->user_id;
    //         $SubItemPtTransformacionLote->item_id = $item['item']['item_id'];
    //         $SubItemPtTransformacionLote->subitem_id = $item['sub_item']['id'];
    //         $SubItemPtTransformacionLote->pt_id = $item['item']['pt_id'];
    //         $SubItemPtTransformacionLote->cajas = $item['cajas_trans'];
    //         $SubItemPtTransformacionLote->peso_bruto = $item['pb_trans'];
    //         $SubItemPtTransformacionLote->peso_neto = $item['pn_trans'];
    //         $SubItemPtTransformacionLote->save();
    //     }
    //     return ;
    // }

    public function store(Request $request)
    {
        $m = $request->items ?? [];
        if (!isset($m['lista_trozados']) || !is_array($m['lista_trozados'])) {
            return;
        }

        foreach ($m['lista_trozados'] as $index => $item) {
            try {
                $SubItemPtTransformacionLote = new SubItemPtTransformacionLote();
                $SubItemPtTransformacionLote->fecha_hora = Carbon::now();
                $SubItemPtTransformacionLote->encargado = $item['item']['encargado'] ?? null;
                $SubItemPtTransformacionLote->item_pt_transformacion_lote_id = $item['item']['id'] ?? null;
                $SubItemPtTransformacionLote->sucursal_id = $request->sucursal_id;
                $SubItemPtTransformacionLote->transformacion_lote_id = $request->transformacion_lote_id;
                $SubItemPtTransformacionLote->user_id = $request->user_id;
                $SubItemPtTransformacionLote->item_id = $item['item']['item_id'] ?? null;
                $SubItemPtTransformacionLote->subitem_id = $item['sub_item']['id'] ?? null;
                $SubItemPtTransformacionLote->pt_id = $item['item']['pt_id'] ?? null;
                $SubItemPtTransformacionLote->cajas = $item['cajas_trans'] ?? 0;
                $SubItemPtTransformacionLote->peso_bruto = $item['pb_trans'] ?? 0;
                $SubItemPtTransformacionLote->taras = ($item['cajas_trans'] > 0)
                    ? $item['cajas_trans'] * 2
                    : 0;
                $SubItemPtTransformacionLote->peso_neto = $item['pn_trans'] ?? 0;

                $SubItemPtTransformacionLote->save();
            } catch (\Exception $e) {

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubItemPtTransformacionLote  $subItemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function show(SubItemPtTransformacionLote $subItemPtTransformacionLote)
    {

        return $subItemPtTransformacionLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubItemPtTransformacionLote  $subItemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubItemPtTransformacionLote $subItemPtTransformacionLote)
    {
        $subItemPtTransformacionLote->name = $request->name;
        $subItemPtTransformacionLote->save();
        return $subItemPtTransformacionLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubItemPtTransformacionLote  $subItemPtTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubItemPtTransformacionLote $subItemPtTransformacionLote)
    {
        $subItemPtTransformacionLote->estado = 0;
        $subItemPtTransformacionLote->save();
    }
}
