<?php

namespace App\Http\Controllers;

use App\Models\TraspasoPpDetalle;
use Illuminate\Http\Request;

class TraspasoPpDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TraspasoPpDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $traspasoPpDetalle = new TraspasoPpDetalle();
        $traspasoPpDetalle->name = $request->name;
        $traspasoPpDetalle->save();
        return $traspasoPpDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoPpDetalle  $traspasoPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoPpDetalle $traspasoPpDetalle)
    {
        
        return $traspasoPpDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoPpDetalle  $traspasoPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoPpDetalle $traspasoPpDetalle)
    {
        $traspasoPpDetalle->name = $request->name;
        $traspasoPpDetalle->save();
        return $traspasoPpDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoPpDetalle  $traspasoPpDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoPpDetalle $traspasoPpDetalle)
    {
        $traspasoPpDetalle->estado = 0;
        $traspasoPpDetalle->save();
    }
}
