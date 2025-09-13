<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsolidacionAveDetalle;

class ConsolidacionAveDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsolidacionAveDetalle::with(['Categoria'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionDetalle = new ConsolidacionAveDetalle();
        $consolidacionDetalle->name = $request->name;
        $consolidacionDetalle->save();
        return $consolidacionDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAveDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionAveDetalle $consolidacionDetalle)
    {
        
        return $consolidacionDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAveDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionAveDetalle $consolidacionDetalle)
    {
        $consolidacionDetalle->name = $request->name;
        $consolidacionDetalle->save();
        return $consolidacionDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAveDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionAveDetalle $consolidacionDetalle)
    {
        $consolidacionDetalle->estado = 0;
        $consolidacionDetalle->save();
    }
}
