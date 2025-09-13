<?php

namespace App\Http\Controllers;

use App\Models\EnvioGenPtDetalle;
use Illuminate\Http\Request;

class EnvioGenPtDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EnvioGenPtDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $envioGenPtDetalle = new EnvioGenPtDetalle();
        $envioGenPtDetalle->name = $request->name;
        $envioGenPtDetalle->save();
        return $envioGenPtDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnvioGenPtDetalle  $envioGenPtDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(EnvioGenPtDetalle $envioGenPtDetalle)
    {
        
        return $envioGenPtDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnvioGenPtDetalle  $envioGenPtDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnvioGenPtDetalle $envioGenPtDetalle)
    {
        $envioGenPtDetalle->name = $request->name;
        $envioGenPtDetalle->save();
        return $envioGenPtDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnvioGenPtDetalle  $envioGenPtDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnvioGenPtDetalle $envioGenPtDetalle)
    {
        $envioGenPtDetalle->estado = 0;
        $envioGenPtDetalle->save();
    }
}
