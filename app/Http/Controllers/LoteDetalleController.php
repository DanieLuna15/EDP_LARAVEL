<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalle;
use Illuminate\Http\Request;

class LoteDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalle = new LoteDetalle();
        $loteDetalle->name = $request->name;
        $loteDetalle->save();
        return $loteDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalle  $loteDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalle $loteDetalle)
    {
        
        return $loteDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalle  $loteDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalle $loteDetalle)
    {
        $loteDetalle->name = $request->name;
        $loteDetalle->save();
        return $loteDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalle  $loteDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalle $loteDetalle)
    {
        $loteDetalle->estado = 0;
        $loteDetalle->save();
    }
}
