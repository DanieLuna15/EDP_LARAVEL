<?php

namespace App\Http\Controllers;

use App\Models\PtDetalleDescomposicion;
use Illuminate\Http\Request;

class PtDetalleDescomposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PtDetalleDescomposicion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ptDetalleDescomposicion = new PtDetalleDescomposicion();
        $ptDetalleDescomposicion->name = $request->name;
        $ptDetalleDescomposicion->save();
        return $ptDetalleDescomposicion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtDetalleDescomposicion  $ptDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function show(PtDetalleDescomposicion $ptDetalleDescomposicion)
    {
        
        return $ptDetalleDescomposicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PtDetalleDescomposicion  $ptDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PtDetalleDescomposicion $ptDetalleDescomposicion)
    {
        $ptDetalleDescomposicion->name = $request->name;
        $ptDetalleDescomposicion->save();
        return $ptDetalleDescomposicion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtDetalleDescomposicion  $ptDetalleDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtDetalleDescomposicion $ptDetalleDescomposicion)
    {
        $ptDetalleDescomposicion->estado = 0;
        $ptDetalleDescomposicion->save();
    }
}
