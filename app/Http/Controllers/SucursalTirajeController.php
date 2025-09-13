<?php

namespace App\Http\Controllers;

use App\Models\SucursalTiraje;
use Illuminate\Http\Request;

class SucursalTirajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SucursalTiraje::with(['Comprobante', 'Sucursal'])->where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursalTiraje = new SucursalTiraje();
        $sucursalTiraje->serie = $request->serie;
        $sucursalTiraje->nro_auth = $request->nro_auth;
        $sucursalTiraje->inicio = $request->inicio;
        $sucursalTiraje->fin = $request->fin;
        $sucursalTiraje->fecha_fin = $request->fecha_fin;
        $sucursalTiraje->fecha_inicio = $request->fecha_inicio;
        $sucursalTiraje->comprobante_id = $request->comprobante_id;
        $sucursalTiraje->sucursal_id = $request->sucursal_id;
        $sucursalTiraje->save();
        return $sucursalTiraje;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SucursalTiraje  $sucursalTiraje
     * @return \Illuminate\Http\Response
     */
    public function show(SucursalTiraje $sucursalTiraje)
    {
        
        return $sucursalTiraje;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SucursalTiraje  $sucursalTiraje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SucursalTiraje $sucursalTiraje)
    {
        $sucursalTiraje->serie = $request->serie;
        $sucursalTiraje->nro_auth = $request->nro_auth;
        $sucursalTiraje->inicio = $request->inicio;
        $sucursalTiraje->fin = $request->fin;
        $sucursalTiraje->fecha_fin = $request->fecha_fin;
        $sucursalTiraje->fecha_inicio = $request->fecha_inicio;
        $sucursalTiraje->comprobante_id = $request->comprobante_id;
        $sucursalTiraje->sucursal_id = $request->sucursal_id;
        $sucursalTiraje->save();
        return $sucursalTiraje;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SucursalTiraje  $sucursalTiraje
     * @return \Illuminate\Http\Response
     */
    public function destroy(SucursalTiraje $sucursalTiraje)
    {
        $sucursalTiraje->estado = 0;
        $sucursalTiraje->save();
    }
}
