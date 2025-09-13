<?php

namespace App\Http\Controllers;

use App\Models\Salidadotaclidetalle;
use Illuminate\Http\Request;

class SalidadotaclidetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Salidadotaclidetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salidadotaclidetalle = new Salidadotaclidetalle();
        $salidadotaclidetalle->name = $request->name;
        $salidadotaclidetalle->save();
        return $salidadotaclidetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salidadotaclidetalle  $salidadotaclidetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Salidadotaclidetalle $salidadotaclidetalle)
    {
        
        return $salidadotaclidetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salidadotaclidetalle  $salidadotaclidetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salidadotaclidetalle $salidadotaclidetalle)
    {
        $salidadotaclidetalle->name = $request->name;
        $salidadotaclidetalle->save();
        return $salidadotaclidetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salidadotaclidetalle  $salidadotaclidetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salidadotaclidetalle $salidadotaclidetalle)
    {
        $salidadotaclidetalle->estado = 0;
        $salidadotaclidetalle->save();
    }
}
