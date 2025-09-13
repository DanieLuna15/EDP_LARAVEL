<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleVenta;
use Illuminate\Http\Request;

class LoteDetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleVenta::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleVenta = new LoteDetalleVenta();
        $loteDetalleVenta->name = $request->name;
        $loteDetalleVenta->save();
        return $loteDetalleVenta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleVenta  $loteDetalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleVenta $loteDetalleVenta)
    {
        
        return $loteDetalleVenta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleVenta  $loteDetalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleVenta $loteDetalleVenta)
    {
        $loteDetalleVenta->name = $request->name;
        $loteDetalleVenta->save();
        return $loteDetalleVenta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleVenta  $loteDetalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleVenta $loteDetalleVenta)
    {
        $loteDetalleVenta->estado = 0;
        $loteDetalleVenta->save();
    }
}
