<?php

namespace App\Http\Controllers;

use App\Models\CambioPrecioConsolidacion;
use Illuminate\Http\Request;

class CambioPrecioConsolidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CambioPrecioConsolidacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cambioPrecioConsolidacion = new CambioPrecioConsolidacion();
        $cambioPrecioConsolidacion->name = $request->name;
        $cambioPrecioConsolidacion->save();
        return $cambioPrecioConsolidacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CambioPrecioConsolidacion  $cambioPrecioConsolidacion
     * @return \Illuminate\Http\Response
     */
    public function show(CambioPrecioConsolidacion $cambioPrecioConsolidacion)
    {
        
        return $cambioPrecioConsolidacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CambioPrecioConsolidacion  $cambioPrecioConsolidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CambioPrecioConsolidacion $cambioPrecioConsolidacion)
    {
        $cambioPrecioConsolidacion->name = $request->name;
        $cambioPrecioConsolidacion->save();
        return $cambioPrecioConsolidacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CambioPrecioConsolidacion  $cambioPrecioConsolidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(CambioPrecioConsolidacion $cambioPrecioConsolidacion)
    {
        $cambioPrecioConsolidacion->estado = 0;
        $cambioPrecioConsolidacion->save();
    }
}
