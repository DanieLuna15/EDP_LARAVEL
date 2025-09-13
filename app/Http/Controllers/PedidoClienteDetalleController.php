<?php

namespace App\Http\Controllers;

use App\Models\PedidoClienteDetalle;
use Illuminate\Http\Request;

class PedidoClienteDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PedidoClienteDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedidoClienteDetalle = new PedidoClienteDetalle();
        $pedidoClienteDetalle->name = $request->name;
        $pedidoClienteDetalle->save();
        return $pedidoClienteDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PedidoClienteDetalle  $pedidoClienteDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoClienteDetalle $pedidoClienteDetalle)
    {
        
        return $pedidoClienteDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PedidoClienteDetalle  $pedidoClienteDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoClienteDetalle $pedidoClienteDetalle)
    {
        $pedidoClienteDetalle->name = $request->name;
        $pedidoClienteDetalle->save();
        return $pedidoClienteDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidoClienteDetalle  $pedidoClienteDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoClienteDetalle $pedidoClienteDetalle)
    {
        $pedidoClienteDetalle->estado = 0;
        $pedidoClienteDetalle->save();
    }
}
