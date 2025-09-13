<?php

namespace App\Http\Controllers;

use App\Models\LoteDetalleSeguimiento;
use Illuminate\Http\Request;

class LoteDetalleSeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoteDetalleSeguimiento::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
        $loteDetalleSeguimiento->name = $request->name;
        $loteDetalleSeguimiento->save();
        return $loteDetalleSeguimiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteDetalleSeguimiento  $loteDetalleSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(LoteDetalleSeguimiento $loteDetalleSeguimiento)
    {
        
        return $loteDetalleSeguimiento;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteDetalleSeguimiento  $loteDetalleSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteDetalleSeguimiento $loteDetalleSeguimiento)
    {
        $loteDetalleSeguimiento->name = $request->name;
        $loteDetalleSeguimiento->save();
        return $loteDetalleSeguimiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteDetalleSeguimiento  $loteDetalleSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteDetalleSeguimiento $loteDetalleSeguimiento)
    {
        $loteDetalleSeguimiento->estado = 0;
        $loteDetalleSeguimiento->save();
    }
}
