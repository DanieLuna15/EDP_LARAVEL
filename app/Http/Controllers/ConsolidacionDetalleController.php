<?php

namespace App\Http\Controllers;

use App\Models\ConsolidacionDetalle;
use Illuminate\Http\Request;

class ConsolidacionDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsolidacionDetalle::with(['Categoria'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionDetalle = new ConsolidacionDetalle();
        $consolidacionDetalle->name = $request->name;
        $consolidacionDetalle->save();
        return $consolidacionDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionDetalle $consolidacionDetalle)
    {
        
        return $consolidacionDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionDetalle $consolidacionDetalle)
    {
        $consolidacionDetalle->name = $request->name;
        $consolidacionDetalle->save();
        return $consolidacionDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionDetalle  $consolidacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionDetalle $consolidacionDetalle)
    {
        $consolidacionDetalle->estado = 0;
        $consolidacionDetalle->save();
    }
}
