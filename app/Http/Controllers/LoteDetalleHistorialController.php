<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleHistorial;
use Illuminate\Http\Request;

class LoteDetalleHistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleHistorial::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleHistorial = new LoteDetalleHistorial();
        $loteDetalleHistorial->name = $request->name;
        $loteDetalleHistorial->save();
        return $loteDetalleHistorial;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleHistorial  $loteDetalleHistorial
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleHistorial $loteDetalleHistorial)
    {
        
        return $loteDetalleHistorial;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleHistorial  $loteDetalleHistorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleHistorial $loteDetalleHistorial)
    {
        $loteDetalleHistorial->name = $request->name;
        $loteDetalleHistorial->save();
        return $loteDetalleHistorial;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleHistorial  $loteDetalleHistorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleHistorial $loteDetalleHistorial)
    {
        $loteDetalleHistorial->estado = 0;
        $loteDetalleHistorial->save();
    }
}
