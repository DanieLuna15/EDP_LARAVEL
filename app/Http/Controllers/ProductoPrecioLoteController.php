<?php

namespace App\Http\Controllers;

use App\Models\ProductoPrecioLote;
use Illuminate\Http\Request;

class ProductoPrecioLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductoPrecioLote::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productoPrecioLote = new ProductoPrecioLote();
        $productoPrecioLote->producto_precio_id = $request->producto_precio_id;
        $productoPrecioLote->lote_id = $request->lote['id'];
        $productoPrecioLote->peso = $request->peso;
        $productoPrecioLote->precio = $request->precio;
        $productoPrecioLote->save();
        return $productoPrecioLote;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoPrecioLote  $productoPrecioLote
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoPrecioLote $productoPrecioLote)
    {

        return $productoPrecioLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoPrecioLote  $productoPrecioLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoPrecioLote $productoPrecioLote)
    {
        $productoPrecioLote->name = $request->name;
        $productoPrecioLote->save();
        return $productoPrecioLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoPrecioLote  $productoPrecioLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoPrecioLote $productoPrecioLote)
    {
        $productoPrecioLote->estado = 0;
        $productoPrecioLote->save();
    }
}
