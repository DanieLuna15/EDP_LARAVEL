<?php

namespace App\Http\Controllers;

use App\Models\ValidarCajaDetalle;
use Illuminate\Http\Request;

class ValidarCajaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ValidarCajaDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validarCajaDetalle = new ValidarCajaDetalle();
        $validarCajaDetalle->name = $request->name;
        $validarCajaDetalle->save();
        return $validarCajaDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValidarCajaDetalle  $validarCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ValidarCajaDetalle $validarCajaDetalle)
    {
        
        return $validarCajaDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValidarCajaDetalle  $validarCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValidarCajaDetalle $validarCajaDetalle)
    {
        $validarCajaDetalle->name = $request->name;
        $validarCajaDetalle->save();
        return $validarCajaDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValidarCajaDetalle  $validarCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValidarCajaDetalle $validarCajaDetalle)
    {
        $validarCajaDetalle->estado = 0;
        $validarCajaDetalle->save();
    }
}
