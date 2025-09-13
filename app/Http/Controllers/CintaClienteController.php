<?php

namespace App\Http\Controllers;

use App\Models\CintaCliente;
use Illuminate\Http\Request;

class CintaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CintaCliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cintaCliente = new CintaCliente();
        $cintaCliente->name = $request->name;
        $cintaCliente->inicio = $request->inicio;
        $cintaCliente->fin = $request->fin;
        $cintaCliente->save();
        return $cintaCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CintaCliente  $cintaCliente
     * @return \Illuminate\Http\Response
     */
    public function show(CintaCliente $cintaCliente)
    {
        
        return $cintaCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CintaCliente  $cintaCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CintaCliente $cintaCliente)
    {
        $cintaCliente->name = $request->name;
        $cintaCliente->inicio = $request->inicio;
        $cintaCliente->fin = $request->fin;
        $cintaCliente->save();
        return $cintaCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CintaCliente  $cintaCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CintaCliente $cintaCliente)
    {
        $cintaCliente->estado = 0;
        $cintaCliente->save();
    }
}
