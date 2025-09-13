<?php

namespace App\Http\Controllers;

use App\Models\ConsolidacionPagoDetalle;
use Illuminate\Http\Request;

class ConsolidacionPagoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsolidacionPagoDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionPagoDetalle = new ConsolidacionPagoDetalle();
        $consolidacionPagoDetalle->name = $request->name;
        $consolidacionPagoDetalle->save();
        return $consolidacionPagoDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionPagoDetalle $consolidacionPagoDetalle)
    {
        
        return $consolidacionPagoDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionPagoDetalle $consolidacionPagoDetalle)
    {
        $consolidacionPagoDetalle->name = $request->name;
        $consolidacionPagoDetalle->save();
        return $consolidacionPagoDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionPagoDetalle $consolidacionPagoDetalle)
    {
        $consolidacionPagoDetalle->estado = 0;
        $consolidacionPagoDetalle->save();
    }
}
