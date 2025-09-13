<?php

namespace App\Http\Controllers;

use App\Models\InformeDetalle;
use Illuminate\Http\Request;

class InformeDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InformeDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $informeDetalle = new InformeDetalle();
        $informeDetalle->name = $request->name;
        $informeDetalle->save();
        return $informeDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InformeDetalle  $informeDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(InformeDetalle $informeDetalle)
    {
        
        return $informeDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformeDetalle  $informeDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformeDetalle $informeDetalle)
    {
        $informeDetalle->name = $request->name;
        $informeDetalle->save();
        return $informeDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformeDetalle  $informeDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformeDetalle $informeDetalle)
    {
        $informeDetalle->estado = 0;
        $informeDetalle->save();
    }
}
