<?php

namespace App\Http\Controllers;

use App\Models\TransformacionDetalle;
use Illuminate\Http\Request;

class TransformacionDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionDetalle = new TransformacionDetalle();
        $transformacionDetalle->name = $request->name;
        $transformacionDetalle->transformacion_id = $request->transformacion_id;
        $transformacionDetalle->peso = $request->peso;
        $transformacionDetalle->precio = $request->precio;
        $transformacionDetalle->promedio = $request->promedio;

        $transformacionDetalle->save();
        return $transformacionDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionDetalle  $transformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionDetalle $transformacionDetalle)
    {
        
        return $transformacionDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionDetalle  $transformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionDetalle $transformacionDetalle)
    {
        $transformacionDetalle->name = $request->name;
        $transformacionDetalle->transformacion_id = $request->transformacion_id;
        $transformacionDetalle->peso = $request->peso;
        $transformacionDetalle->precio = $request->precio;
        $transformacionDetalle->promedio = $request->promedio;

        $transformacionDetalle->save();
        return $transformacionDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionDetalle  $transformacionDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionDetalle $transformacionDetalle)
    {
        $transformacionDetalle->estado = 0;
        $transformacionDetalle->save();
    }
}
