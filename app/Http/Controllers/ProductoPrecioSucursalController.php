<?php

namespace App\Http\Controllers;

use App\Models\ProductoPrecioSucursal;
use Illuminate\Http\Request;

class ProductoPrecioSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductoPrecioSucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productoPrecioSucursal = new ProductoPrecioSucursal();
        $productoPrecioSucursal->name = $request->name;
        $productoPrecioSucursal->save();
        return $productoPrecioSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoPrecioSucursal  $productoPrecioSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoPrecioSucursal $productoPrecioSucursal)
    {
        
        return $productoPrecioSucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoPrecioSucursal  $productoPrecioSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoPrecioSucursal $productoPrecioSucursal)
    {
        $productoPrecioSucursal->name = $request->name;
        $productoPrecioSucursal->save();
        return $productoPrecioSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoPrecioSucursal  $productoPrecioSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoPrecioSucursal $productoPrecioSucursal)
    {
        $productoPrecioSucursal->estado = 0;
        $productoPrecioSucursal->save();
    }
}
