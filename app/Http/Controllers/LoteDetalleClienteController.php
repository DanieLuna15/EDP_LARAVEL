<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleCliente;
use Illuminate\Http\Request;

class LoteDetalleClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleCliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleCliente = new LoteDetalleCliente();
        $loteDetalleCliente->name = $request->name;
        $loteDetalleCliente->save();
        return $loteDetalleCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleCliente  $loteDetalleCliente
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleCliente $loteDetalleCliente)
    {
        
        return $loteDetalleCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleCliente  $loteDetalleCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleCliente $loteDetalleCliente)
    {
        $loteDetalleCliente->name = $request->name;
        $loteDetalleCliente->save();
        return $loteDetalleCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleCliente  $loteDetalleCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleCliente $loteDetalleCliente)
    {
        $loteDetalleCliente->estado = 0;
        $loteDetalleCliente->save();
    }
}
