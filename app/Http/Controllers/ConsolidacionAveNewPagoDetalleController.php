<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsolidacionAveNewPagoDetalle;

class ConsolidacionAveNewPagoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsolidacionAveNewPagoDetalle::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionPagoDetalle = new ConsolidacionAveNewPagoDetalle();
        $consolidacionPagoDetalle->name = $request->name;
        $consolidacionPagoDetalle->save();
        return $consolidacionPagoDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAveNewPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionAveNewPagoDetalle $consolidacionPagoDetalle)
    {

        return $consolidacionPagoDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAveNewPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $consolidacionPagoDetalle = ConsolidacionAveNewPagoDetalle::find($id);
        if (!$consolidacionPagoDetalle) {
            return response()->json(['error' => 'ConsolidacionPagoDetalle no encontrado'], 404);
        }
        $consolidacionPagoDetalle->name = $request->name;
        $consolidacionPagoDetalle->save();
        return $consolidacionPagoDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAveNewPagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionAveNewPagoDetalle $consolidacionPagoDetalle)
    {
        $consolidacionPagoDetalle->estado = 0;
        $consolidacionPagoDetalle->save();
    }
}
