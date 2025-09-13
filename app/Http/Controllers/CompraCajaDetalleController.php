<?php

namespace App\Http\Controllers;

use App\Models\CompraCajaDetalle;
use Illuminate\Http\Request;

class CompraCajaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompraCajaDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compraCajaDetalle = new CompraCajaDetalle();
        $compraCajaDetalle->name = $request->name;
        $compraCajaDetalle->save();
        return $compraCajaDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraCajaDetalle  $compraCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(CompraCajaDetalle $compraCajaDetalle)
    {
        
        return $compraCajaDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompraCajaDetalle  $compraCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompraCajaDetalle $compraCajaDetalle)
    {
        $compraCajaDetalle->name = $request->name;
        $compraCajaDetalle->save();
        return $compraCajaDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraCajaDetalle  $compraCajaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraCajaDetalle $compraCajaDetalle)
    {
        $compraCajaDetalle->estado = 0;
        $compraCajaDetalle->save();
    }
}
