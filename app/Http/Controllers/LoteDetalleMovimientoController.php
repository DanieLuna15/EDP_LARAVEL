<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleMovimiento;
use Illuminate\Http\Request;

class LoteDetalleMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleMovimiento::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleMovimiento = new LoteDetalleMovimiento();
        $loteDetalleMovimiento->name = $request->name;
        $loteDetalleMovimiento->save();
        return $loteDetalleMovimiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleMovimiento  $loteDetalleMovimiento
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleMovimiento $loteDetalleMovimiento)
    {
        
        return $loteDetalleMovimiento;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleMovimiento  $loteDetalleMovimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleMovimiento $loteDetalleMovimiento)
    {
        $loteDetalleMovimiento->name = $request->name;
        $loteDetalleMovimiento->save();
        return $loteDetalleMovimiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleMovimiento  $loteDetalleMovimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleMovimiento $loteDetalleMovimiento)
    {
        $loteDetalleMovimiento->estado = 0;
        $loteDetalleMovimiento->save();
    }
}
