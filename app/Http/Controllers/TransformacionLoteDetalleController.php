<?php

namespace App\Http\Controllers;

use App\Models\TransformacionLoteDetalle;
use Illuminate\Http\Request;

class TransformacionLoteDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionLoteDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionLoteDetalle = new TransformacionLoteDetalle();
        $transformacionLoteDetalle->name = $request->name;
        $transformacionLoteDetalle->save();
        return $transformacionLoteDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionLoteDetalle  $transformacionLoteDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionLoteDetalle $transformacionLoteDetalle)
    {
        
        return $transformacionLoteDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionLoteDetalle  $transformacionLoteDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionLoteDetalle $transformacionLoteDetalle)
    {
        $transformacionLoteDetalle->name = $request->name;
        $transformacionLoteDetalle->save();
        return $transformacionLoteDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionLoteDetalle  $transformacionLoteDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionLoteDetalle $transformacionLoteDetalle)
    {
        $transformacionLoteDetalle->estado = 0;
        $transformacionLoteDetalle->save();
    }
}
