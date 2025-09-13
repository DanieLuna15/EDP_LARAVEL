<?php

namespace App\Http\Controllers;

use App\Models\Cogplanilla;
use Illuminate\Http\Request;

class CogplanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cogplanilla::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cogplanilla = new Cogplanilla();
        $cogplanilla->name = $request->name;
        $cogplanilla->save();
        return $cogplanilla;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cogplanilla  $cogplanilla
     * @return \Illuminate\Http\Response
     */
    public function show(Cogplanilla $cogplanilla)
    {
        
        return $cogplanilla;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cogplanilla  $cogplanilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cogplanilla $cogplanilla)
    {
        $cogplanilla->dias_base = $request->dias_base;
        $cogplanilla->atraso = $request->atraso;
        $cogplanilla->multiplicar = $request->multiplicar;
        $cogplanilla->sueldo_base = $request->sueldo_base;
        $cogplanilla->dividir_dia = $request->dividir_dia;
        $cogplanilla->dividir_hora = $request->dividir_hora;
        $cogplanilla->save();
        return $cogplanilla;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cogplanilla  $cogplanilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cogplanilla $cogplanilla)
    {
        $cogplanilla->estado = 0;
        $cogplanilla->save();
    }
}
