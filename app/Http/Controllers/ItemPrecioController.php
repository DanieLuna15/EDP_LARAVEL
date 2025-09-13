<?php

namespace App\Http\Controllers;

use App\Models\ItemPrecio;
use Illuminate\Http\Request;

class ItemPrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemPrecio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemPrecio = new ItemPrecio();
        $itemPrecio->name = $request->name;
        $itemPrecio->save();
        return $itemPrecio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemPrecio  $itemPrecio
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPrecio $itemPrecio)
    {
        
        return $itemPrecio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemPrecio  $itemPrecio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPrecio $itemPrecio)
    {
        $itemPrecio->name = $request->name;
        $itemPrecio->save();
        return $itemPrecio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPrecio  $itemPrecio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPrecio $itemPrecio)
    {
        $itemPrecio->estado = 0;
        $itemPrecio->save();
    }
}
