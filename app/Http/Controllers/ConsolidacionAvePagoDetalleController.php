<?php

namespace App\Http\Controllers;

use App\Models\ConsolidacionAvePagoDetalle;
use Illuminate\Http\Request;

class ConsolidacionAvePagoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsolidacionAvePagoDetalle::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionPagoDetalle = new ConsolidacionAvePagoDetalle();
        $consolidacionPagoDetalle->name = $request->name;
        $consolidacionPagoDetalle->save();
        return $consolidacionPagoDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAvePagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionAvePagoDetalle $consolidacionPagoDetalle)
    {

        return $consolidacionPagoDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAvePagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $consolidacionPagoDetalle = ConsolidacionAvePagoDetalle::find($id);
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
     * @param  \App\Models\ConsolidacionAvePagoDetalle  $consolidacionPagoDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionAvePagoDetalle $consolidacionPagoDetalle)
    {
        $consolidacionPagoDetalle->estado = 0;
        $consolidacionPagoDetalle->save();
    }
}
