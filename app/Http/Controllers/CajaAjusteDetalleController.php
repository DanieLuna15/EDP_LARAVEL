<?php

namespace App\Http\Controllers;

use App\Models\CajaAjusteDetalle;
use Illuminate\Http\Request;

class CajaAjusteDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaAjusteDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaAjusteDetalle = new CajaAjusteDetalle();
        $cajaAjusteDetalle->name = $request->name;
        $cajaAjusteDetalle->save();
        return $cajaAjusteDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaAjusteDetalle  $cajaAjusteDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(CajaAjusteDetalle $cajaAjusteDetalle)
    {
        
        return $cajaAjusteDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaAjusteDetalle  $cajaAjusteDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaAjusteDetalle $cajaAjusteDetalle)
    {
        $cajaAjusteDetalle->name = $request->name;
        $cajaAjusteDetalle->save();
        return $cajaAjusteDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaAjusteDetalle  $cajaAjusteDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaAjusteDetalle $cajaAjusteDetalle)
    {
        $cajaAjusteDetalle->estado = 0;
        $cajaAjusteDetalle->save();
    }
}
