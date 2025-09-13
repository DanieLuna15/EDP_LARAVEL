<?php

namespace App\Http\Controllers;

use App\Models\ItemPtMovimiento;
use Illuminate\Http\Request;

class ItemPtMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemPtMovimiento::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemPtMovimiento = new ItemPtMovimiento();
        $itemPtMovimiento->name = $request->name;
        $itemPtMovimiento->save();
        return $itemPtMovimiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemPtMovimiento  $itemPtMovimiento
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPtMovimiento $itemPtMovimiento)
    {
        
        return $itemPtMovimiento;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemPtMovimiento  $itemPtMovimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPtMovimiento $itemPtMovimiento)
    {
        $itemPtMovimiento->name = $request->name;
        $itemPtMovimiento->save();
        return $itemPtMovimiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPtMovimiento  $itemPtMovimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPtMovimiento $itemPtMovimiento)
    {
        $itemPtMovimiento->estado = 0;
        $itemPtMovimiento->save();
    }
}
