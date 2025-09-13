<?php

namespace App\Http\Controllers;

use App\Models\VentaGasto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentaGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaGasto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaGasto = new VentaGasto();
        $ventaGasto->name = $request->name;
        $ventaGasto->save();
        return $ventaGasto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaGasto  $ventaGasto
     * @return \Illuminate\Http\Response
     */
    public function show(VentaGasto $ventaGasto)
    {
        
        return $ventaGasto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaGasto  $ventaGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaGasto $ventaGasto)
    {
        $ventaGasto->name = $request->name;
        $ventaGasto->save();
        return $ventaGasto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaGasto  $ventaGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaGasto $ventaGasto)
    {
        $ventaGasto->estado = 0;
        $ventaGasto->save();
    }
}
