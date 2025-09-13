<?php

namespace App\Http\Controllers;

use App\Models\ItemPtMovimiento;
use App\Models\ItemSobraPt;
use App\Models\ItemsPt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemSobraPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        $sobras=ItemSobraPt::with(['Item','Pt'])->where([['estado',1],['sobra',1]])->get();
        return $sobras;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ItemSobraPt $itemSobraPt)
    {
        $DIAS = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
        $itemSobraPt->sobra = 0;
        $itemSobraPt->pt_secundario_id = $request->pt_id;
        $itemSobraPt->save();
        $itemPtMovimiento = new ItemPtMovimiento();
        $itemPtMovimiento->item_id = $itemSobraPt->item_id;
        $itemPtMovimiento->pt_id = $request->pt_id;
        $itemPtMovimiento->cajas = $itemSobraPt->cajas;
        $itemPtMovimiento->kgb = $itemSobraPt->kgb;
        $itemPtMovimiento->kgn = $itemSobraPt->kgn_nuevo;
        $itemPtMovimiento->taras = $itemSobraPt->taras;
        $itemPtMovimiento->user_id = $request->user_id;
        $itemPtMovimiento->fecha = Carbon::now()->format('Y-m-d');
        $itemPtMovimiento->hora = Carbon::now()->format('H:i:s');
        $itemPtMovimiento->motivo = "TRASPASO DE PT-".$request->pt['nro'];
        $itemPtMovimiento->save();
        $itemsPt = new ItemsPt();
        $itemsPt->item_id = $itemSobraPt->item_id;
        $itemsPt->pt_id = $request->pt_id;
        $itemsPt->cajas = $itemSobraPt->cajas;
        $itemsPt->peso_bruto = $itemSobraPt->kgb;
        $itemsPt->peso_neto = $itemSobraPt->kgn_nuevo;
        $itemsPt->taras = $itemSobraPt->taras;
        $itemsPt->recep = $request->user_nombre;
        $itemsPt->pt_emisor_id = $itemSobraPt->pt_id;
        $itemsPt->user_id = $itemSobraPt->user_id;
        $itemsPt->tipo = 2;
        $itemsPt->save();
        return $itemSobraPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemSobraPt  $itemSobraPt
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSobraPt $itemSobraPt)
    {

        return $itemSobraPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSobraPt  $itemSobraPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSobraPt $itemSobraPt)
    {
        $itemSobraPt->name = $request->name;
        $itemSobraPt->save();
        return $itemSobraPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSobraPt  $itemSobraPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSobraPt $itemSobraPt)
    {
        $itemSobraPt->estado = 0;
        $itemSobraPt->save();
    }
}
