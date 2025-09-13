<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleCompra;
use Illuminate\Http\Request;

class LoteDetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleCompra::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleCompra = new LoteDetalleCompra();
        $loteDetalleCompra->name = $request->name;
        $loteDetalleCompra->save();
        return $loteDetalleCompra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleCompra  $loteDetalleCompra
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleCompra $loteDetalleCompra)
    {
        
        return $loteDetalleCompra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleCompra  $loteDetalleCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleCompra $loteDetalleCompra)
    {
        $loteDetalleCompra->name = $request->name;
        $loteDetalleCompra->save();
        return $loteDetalleCompra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleCompra  $loteDetalleCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleCompra $loteDetalleCompra)
    {
        $loteDetalleCompra->estado = 0;
        $loteDetalleCompra->save();
    }
}
