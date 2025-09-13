<?php

namespace App\Http\Controllers;

use App\Models\DetallePpDescomposicion;
use Illuminate\Http\Request;

class DetallePpDescomposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetallePpDescomposicion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detallePpDescomposicion = new DetallePpDescomposicion();
        $detallePpDescomposicion->name = $request->name;
        $detallePpDescomposicion->save();
        return $detallePpDescomposicion;
    }
    public function descomponer(Request $request, DetallePpDescomposicion $detallePpDescomposicion)
    {
        $detallePpDescomposicion->trozado = 0;
        $detallePpDescomposicion->save();
        return $detallePpDescomposicion;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetallePpDescomposicion  $detallePpDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function show(DetallePpDescomposicion $detallePpDescomposicion)
    {
        
        return $detallePpDescomposicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetallePpDescomposicion  $detallePpDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePpDescomposicion $detallePpDescomposicion)
    {
        $detallePpDescomposicion->name = $request->name;
        $detallePpDescomposicion->save();
        return $detallePpDescomposicion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallePpDescomposicion  $detallePpDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallePpDescomposicion $detallePpDescomposicion)
    {
        $detallePpDescomposicion->estado = 0;
        $detallePpDescomposicion->save();
    }
}
