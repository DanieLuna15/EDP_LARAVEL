<?php

namespace App\Http\Controllers;

use App\Models\TraspasoDotacionDetalle;
use Illuminate\Http\Request;

class TraspasoDotacionDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TraspasoDotacionDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $traspasoDotacionDetalle = new TraspasoDotacionDetalle();
        $traspasoDotacionDetalle->name = $request->name;
        $traspasoDotacionDetalle->save();
        return $traspasoDotacionDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoDotacionDetalle  $traspasoDotacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoDotacionDetalle $traspasoDotacionDetalle)
    {
        
        return $traspasoDotacionDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoDotacionDetalle  $traspasoDotacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoDotacionDetalle $traspasoDotacionDetalle)
    {
        $traspasoDotacionDetalle->name = $request->name;
        $traspasoDotacionDetalle->save();
        return $traspasoDotacionDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoDotacionDetalle  $traspasoDotacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoDotacionDetalle $traspasoDotacionDetalle)
    {
        $traspasoDotacionDetalle->estado = 0;
        $traspasoDotacionDetalle->save();
    }
}
