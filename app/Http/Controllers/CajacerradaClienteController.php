<?php

namespace App\Http\Controllers;

use App\Models\CajacerradaCliente;
use Illuminate\Http\Request;

class CajacerradaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajacerradaCliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajacerradaCliente = new CajacerradaCliente();
        $cajacerradaCliente->name = $request->name;
        $cajacerradaCliente->desde = $request->desde;
        $cajacerradaCliente->hasta = $request->hasta;
        $cajacerradaCliente->save();
        return $cajacerradaCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajacerradaCliente  $cajacerradaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(CajacerradaCliente $cajacerradaCliente)
    {
        
        return $cajacerradaCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajacerradaCliente  $cajacerradaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajacerradaCliente $cajacerradaCliente)
    {
        $cajacerradaCliente->name = $request->name;
        $cajacerradaCliente->desde = $request->desde;
        $cajacerradaCliente->hasta = $request->hasta;
        $cajacerradaCliente->save();
        return $cajacerradaCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajacerradaCliente  $cajacerradaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajacerradaCliente $cajacerradaCliente)
    {
        $cajacerradaCliente->estado = 0;
        $cajacerradaCliente->save();
    }
}
