<?php

namespace App\Http\Controllers;

use App\Models\Parametrovacacion;
use Illuminate\Http\Request;

class ParametrovacacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Parametrovacacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parametrovacacion = new Parametrovacacion();
        $parametrovacacion->desde = $request->desde;
        $parametrovacacion->hasta = $request->hasta;
        $parametrovacacion->dias = $request->dias;
        $parametrovacacion->save();
        return $parametrovacacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parametrovacacion  $parametrovacacion
     * @return \Illuminate\Http\Response
     */
    public function show(Parametrovacacion $parametrovacacion)
    {
        
        return $parametrovacacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametrovacacion  $parametrovacacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametrovacacion $parametrovacacion)
    {
        $parametrovacacion->desde = $request->desde;
        $parametrovacacion->hasta = $request->hasta;
        $parametrovacacion->dias = $request->dias;
        $parametrovacacion->save();
        return $parametrovacacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametrovacacion  $parametrovacacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametrovacacion $parametrovacacion)
    {
        $parametrovacacion->estado = 0;
        $parametrovacacion->save();
    }
}
