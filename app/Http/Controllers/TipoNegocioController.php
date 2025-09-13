<?php

namespace App\Http\Controllers;

use App\Models\TipoNegocio;
use Illuminate\Http\Request;

class TipoNegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoNegocio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoNegocio = new TipoNegocio();
        $tipoNegocio->name = $request->name;
        $tipoNegocio->save();
        return $tipoNegocio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoNegocio  $tipoNegocio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoNegocio $tipoNegocio)
    {
        
        return $tipoNegocio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoNegocio  $tipoNegocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoNegocio $tipoNegocio)
    {
        $tipoNegocio->name = $request->name;
        $tipoNegocio->save();
        return $tipoNegocio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoNegocio  $tipoNegocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoNegocio $tipoNegocio)
    {
        $tipoNegocio->estado = 0;
        $tipoNegocio->save();
    }
}
