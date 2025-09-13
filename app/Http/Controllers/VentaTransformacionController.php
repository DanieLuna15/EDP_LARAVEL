<?php

namespace App\Http\Controllers;

use App\Models\VentaTransformacion;
use Illuminate\Http\Request;

class VentaTransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaTransformacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaTransformacion = new VentaTransformacion();
        $ventaTransformacion->name = $request->name;
        $ventaTransformacion->save();
        return $ventaTransformacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaTransformacion  $ventaTransformacion
     * @return \Illuminate\Http\Response
     */
    public function show(VentaTransformacion $ventaTransformacion)
    {
        
        return $ventaTransformacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaTransformacion  $ventaTransformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaTransformacion $ventaTransformacion)
    {
        $ventaTransformacion->name = $request->name;
        $ventaTransformacion->save();
        return $ventaTransformacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaTransformacion  $ventaTransformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaTransformacion $ventaTransformacion)
    {
        $ventaTransformacion->estado = 0;
        $ventaTransformacion->save();
    }
}
