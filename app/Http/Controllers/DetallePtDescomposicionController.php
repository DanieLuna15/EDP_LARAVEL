<?php

namespace App\Http\Controllers;

use App\Models\DetallePtDescomposicion;
use Illuminate\Http\Request;

class DetallePtDescomposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetallePtDescomposicion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detallePtDescomposicion = new DetallePtDescomposicion();
        $detallePtDescomposicion->name = $request->name;
        $detallePtDescomposicion->save();
        return $detallePtDescomposicion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetallePtDescomposicion  $detallePtDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function show(DetallePtDescomposicion $detallePtDescomposicion)
    {
        
        return $detallePtDescomposicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetallePtDescomposicion  $detallePtDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePtDescomposicion $detallePtDescomposicion)
    {
        $detallePtDescomposicion->name = $request->name;
        $detallePtDescomposicion->save();
        return $detallePtDescomposicion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallePtDescomposicion  $detallePtDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallePtDescomposicion $detallePtDescomposicion)
    {
        $detallePtDescomposicion->estado = 0;
        $detallePtDescomposicion->save();
    }
}
