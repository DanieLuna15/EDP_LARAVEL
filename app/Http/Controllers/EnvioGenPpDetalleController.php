<?php

namespace App\Http\Controllers;

use App\Models\EnvioGenPpDetalle;
use Illuminate\Http\Request;

class EnvioGenPpDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EnvioGenPpDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $envioGenPpDetalle = new EnvioGenPpDetalle();
        $envioGenPpDetalle->name = $request->name;
        $envioGenPpDetalle->save();
        return $envioGenPpDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnvioGenPpDetalle  $envioGenPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(EnvioGenPpDetalle $envioGenPpDetalle)
    {
        
        return $envioGenPpDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnvioGenPpDetalle  $envioGenPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnvioGenPpDetalle $envioGenPpDetalle)
    {
        $envioGenPpDetalle->name = $request->name;
        $envioGenPpDetalle->save();
        return $envioGenPpDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnvioGenPpDetalle  $envioGenPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnvioGenPpDetalle $envioGenPpDetalle)
    {
        $envioGenPpDetalle->estado = 0;
        $envioGenPpDetalle->save();
    }
}
