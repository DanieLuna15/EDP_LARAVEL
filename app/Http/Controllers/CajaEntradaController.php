<?php

namespace App\Http\Controllers;

use App\Models\CajaEntrada;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CajaEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaEntrada::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaEntrada = new CajaEntrada();
        $cajaEntrada->name = $request->name;
        $cajaEntrada->save();
        return $cajaEntrada;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaEntrada  $cajaEntrada
     * @return \Illuminate\Http\Response
     */
    public function show(CajaEntrada $cajaEntrada)
    {
        
        return $cajaEntrada;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaEntrada  $cajaEntrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaEntrada $cajaEntrada)
    {
        $cajaEntrada->name = $request->name;
        $cajaEntrada->save();
        return $cajaEntrada;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaEntrada  $cajaEntrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaEntrada $cajaEntrada)
    {
        $cajaEntrada->estado = 0;
        $cajaEntrada->save();
    }
}
