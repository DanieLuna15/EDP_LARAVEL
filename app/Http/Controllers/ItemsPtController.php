<?php

namespace App\Http\Controllers;

use App\Models\ItemsPt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemsPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemsPt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemsPt = new ItemsPt();
        $itemsPt->name = $request->name;
        $itemsPt->save();
        return $itemsPt;
    }
    public function descomponer(Request $request)
    {
        $itemsPtDescuento = new ItemsPt();
        $itemsPtDescuento->fecha = Carbon::now();
        $itemsPtDescuento->cajas = 0-$request->cajas;
        $itemsPtDescuento->taras = 0-($request->peso_bruto-$request->peso_neto);
        $itemsPtDescuento->peso_bruto = 0-$request->peso_bruto;
        $itemsPtDescuento->peso_neto = 0-$request->peso_neto;
        $itemsPtDescuento->pt_id = $request->pt_id;
        $itemsPtDescuento->item_id = $request->item['item']['id'];
        $itemsPtDescuento->save();
        $itemsPt = new ItemsPt();
        $itemsPt->fecha = Carbon::now();
        $itemsPt->cajas = $request->cajas;
        $itemsPt->taras = $request->peso_bruto-$request->peso_neto;
        $itemsPt->peso_bruto = $request->peso_bruto;
        $itemsPt->peso_neto = $request->peso_neto;
        $itemsPt->pt_id = $request->pt_id;
        $itemsPt->item_id = $request->item_id;
        $itemsPt->save();
        return $itemsPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemsPt  $itemsPt
     * @return \Illuminate\Http\Response
     */
    public function show(ItemsPt $itemsPt)
    {

        return $itemsPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemsPt  $itemsPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemsPt $itemsPt)
    {
        $itemsPt->name = $request->name;
        $itemsPt->save();
        return $itemsPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemsPt  $itemsPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemsPt $itemsPt)
    {
        $itemsPt->estado = 0;
        $itemsPt->save();
    }
}
