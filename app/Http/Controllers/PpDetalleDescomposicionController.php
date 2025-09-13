<?php

namespace App\Http\Controllers;

use App\Models\PpDetalleDescomposicion;
use Illuminate\Http\Request;

class PpDetalleDescomposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpDetalleDescomposicion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppDetalleDescomposicion = new PpDetalleDescomposicion();
        $ppDetalleDescomposicion->name = $request->name;
        $ppDetalleDescomposicion->save();
        return $ppDetalleDescomposicion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpDetalleDescomposicion  $ppDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function show(PpDetalleDescomposicion $ppDetalleDescomposicion)
    {
        
        return $ppDetalleDescomposicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpDetalleDescomposicion  $ppDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpDetalleDescomposicion $ppDetalleDescomposicion)
    {
        $ppDetalleDescomposicion->name = $request->name;
        $ppDetalleDescomposicion->save();
        return $ppDetalleDescomposicion;
    }
    public function descomponer(Request $request, PpDetalleDescomposicion $ppDetalleDescomposicion)
    {
        $ppDetalleDescomposicion->trozado = 0;
        $ppDetalleDescomposicion->save();
        return $ppDetalleDescomposicion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpDetalleDescomposicion  $ppDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpDetalleDescomposicion $ppDetalleDescomposicion)
    {
        $ppDetalleDescomposicion->estado = 0;
        $ppDetalleDescomposicion->save();
    }
}
