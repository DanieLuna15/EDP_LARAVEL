<?php

namespace App\Http\Controllers;

use App\Models\ItemTransMovimiento;
use App\Models\ItemSobraTrans;
use App\Models\SubItemPtTransformacionLote;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemSobraTransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return ItemSobraTrans::with(['Item','TransformacionLote','Pt'])->where([['estado',1],['sobra',1]])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ItemSobraTrans $itemSobraTrans)
    {
        //dd($request->all());
        $DIAS = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
        $itemSobraTrans->sobra = 0;
        $itemSobraTrans->trans_secundario_id = $request->trans_id;
        $itemSobraTrans->aceptado = 1;
        $itemSobraTrans->save();
        $itemPtMovimiento = new ItemTransMovimiento();
        $itemPtMovimiento->item_id = $itemSobraTrans->item_id;
        $itemPtMovimiento->trans_id = $request->trans_id;
        $itemPtMovimiento->cajas = $itemSobraTrans->cajas;
        $itemPtMovimiento->kgb = $itemSobraTrans->kgb;
        $itemPtMovimiento->kgn = $itemSobraTrans->kgn_nuevo;
        $itemPtMovimiento->taras = $itemSobraTrans->taras;
        $itemPtMovimiento->user_id = $request->user_id;
        $itemPtMovimiento->fecha = Carbon::now()->format('Y-m-d');
        $itemPtMovimiento->hora = Carbon::now()->format('H:i:s');
        $itemPtMovimiento->motivo = "TRASPASO DE TRANS-".$request->transformacion_lote['nro'];
        $itemPtMovimiento->save();

        // $itemsTrans = new TransformacionLoteItem();
        // $itemsTrans->item_id = $itemSobraTrans->item_id;
        // $itemsTrans->transformacion_lote_id= $request->trans_id;
        // $itemsTrans->cajas = $itemSobraTrans->cajas;
        // $itemsTrans->peso_bruto = $itemSobraTrans->kgb;
        // $itemsTrans->peso_neto = $itemSobraTrans->kgn_nuevo;
        // $itemsTrans->tara = max(0, $itemSobraTrans->kgb - $itemSobraTrans->kgn_nuevo);
        // $itemsTrans->save();

        $SubItemPtTransformacionLote = new SubItemPtTransformacionLote();
        $SubItemPtTransformacionLote->fecha_hora = Carbon::now();
        $SubItemPtTransformacionLote->encargado = 'TRASPASO DE TRANS-'.$request->transformacion_lote['nro'];
        $SubItemPtTransformacionLote->item_pt_transformacion_lote_id = $itemSobraTrans->item_id ?? null;
        $SubItemPtTransformacionLote->sucursal_id = $request->sucursal_id;
        $SubItemPtTransformacionLote->transformacion_lote_id = $request->trans_id;
        $SubItemPtTransformacionLote->user_id = $request->user_id;
        $SubItemPtTransformacionLote->item_id = $itemSobraTrans->item_id ?? null;
        $SubItemPtTransformacionLote->subitem_id = $itemSobraTrans->item_id ?? null;
        $SubItemPtTransformacionLote->pt_id = $itemSobraTrans->pt_id ?? null;
        $SubItemPtTransformacionLote->cajas = $itemSobraTrans->cajas ?? 0;
        $SubItemPtTransformacionLote->peso_bruto = $itemSobraTrans->kgb ?? 0;
        $SubItemPtTransformacionLote->peso_neto = $itemSobraTrans->kgn_nuevo ?? 0;
        $SubItemPtTransformacionLote->save();

        return $itemSobraTrans;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemSobraTrans  $itemSobraTrans
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSobraTrans $itemSobraTrans)
    {

        return $itemSobraTrans;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSobraTrans  $itemSobraTrans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSobraTrans $itemSobraTrans)
    {
        $itemSobraTrans->name = $request->name;
        $itemSobraTrans->save();
        return $itemSobraTrans;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSobraTrans  $itemSobraTrans
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSobraTrans $itemSobraTrans)
    {
        $itemSobraTrans->estado = 0;
        $itemSobraTrans->save();
    }
}
