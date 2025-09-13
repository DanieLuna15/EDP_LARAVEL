<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleProducto;
use Illuminate\Http\Request;

class LoteDetalleProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleProducto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleProducto = new LoteDetalleProducto();
        $loteDetalleProducto->name = $request->name;
        $loteDetalleProducto->save();
        return $loteDetalleProducto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleProducto  $loteDetalleProducto
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleProducto $loteDetalleProducto)
    {
        
        return $loteDetalleProducto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleProducto  $loteDetalleProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleProducto $loteDetalleProducto)
    {
        $loteDetalleProducto->name = $request->name;
        $loteDetalleProducto->save();
        return $loteDetalleProducto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleProducto  $loteDetalleProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleProducto $loteDetalleProducto)
    {
        $loteDetalleProducto->estado = 0;
        $loteDetalleProducto->save();
    }
}
