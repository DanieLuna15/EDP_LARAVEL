<?php

namespace App\Http\Controllers;

use App\Models\CajaMotivo;
use Illuminate\Http\Request;

class CajaMotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaMotivo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaMotivo = new CajaMotivo();
        $cajaMotivo->name = $request->name;
        $cajaMotivo->save();
        return $cajaMotivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaMotivo  $cajaMotivo
     * @return \Illuminate\Http\Response
     */
    public function show(CajaMotivo $cajaMotivo)
    {
        
        return $cajaMotivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaMotivo  $cajaMotivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaMotivo $cajaMotivo)
    {
        $cajaMotivo->name = $request->name;
        $cajaMotivo->save();
        return $cajaMotivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaMotivo  $cajaMotivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaMotivo $cajaMotivo)
    {
        $cajaMotivo->estado = 0;
        $cajaMotivo->save();
    }
}
