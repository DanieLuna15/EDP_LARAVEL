<?php

namespace App\Http\Controllers;

use App\Models\Dotacion;
use Illuminate\Http\Request;

class DotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dotacion::with(['Familia'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Dotacion = new Dotacion();
        $Dotacion->name = $request->name;
        $Dotacion->familia_id = $request->familia_id;
        $Dotacion->codigo = $request->codigo;
        $Dotacion->costo = $request->costo;
        $Dotacion->venta = $request->venta;
        $Dotacion->stock = $request->stock;
        $Dotacion->save();
        return $Dotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dotacion  $dotacion
     * @return \Illuminate\Http\Response
     */
    public function show(Dotacion $dotacion)
    {

        return $dotacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dotacion  $dotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dotacion $dotacion)
    {
        $dotacion->name = $request->name;
        $dotacion->familia_id = $request->familia_id;
        $dotacion->codigo = $request->codigo;
        $dotacion->costo = $request->costo;
        $dotacion->venta = $request->venta;
        $dotacion->stock = $request->stock;
        $dotacion->save();
        return $dotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dotacion  $dotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dotacion $dotacion)
    {
        $dotacion->estado = 0;
        $dotacion->save();
    }
}
