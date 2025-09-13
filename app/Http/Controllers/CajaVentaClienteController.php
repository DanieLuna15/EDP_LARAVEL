<?php

namespace App\Http\Controllers;

use App\Models\CajaVentaCliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CajaVentaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaVentaCliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaVentaCliente = new CajaVentaCliente();
        $cajaVentaCliente->name = $request->name;
        $cajaVentaCliente->save();
        return $cajaVentaCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaVentaCliente  $cajaVentaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(CajaVentaCliente $cajaVentaCliente)
    {
        
        return $cajaVentaCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaVentaCliente  $cajaVentaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaVentaCliente $cajaVentaCliente)
    {
        $cajaVentaCliente->name = $request->name;
        $cajaVentaCliente->save();
        return $cajaVentaCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaVentaCliente  $cajaVentaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaVentaCliente $cajaVentaCliente)
    {
        $cajaVentaCliente->estado = 0;
        $cajaVentaCliente->save();
    }
}
