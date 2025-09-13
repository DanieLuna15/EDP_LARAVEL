<?php

namespace App\Http\Controllers;

use App\Models\TransItemDetalle;
use Illuminate\Http\Request;

class TransItemDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransItemDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transItemDetalle = new TransItemDetalle();
        $transItemDetalle->name = $request->name;
        $transItemDetalle->save();
        return $transItemDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransItemDetalle  $transItemDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(TransItemDetalle $transItemDetalle)
    {
        
        return $transItemDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransItemDetalle  $transItemDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransItemDetalle $transItemDetalle)
    {
        $transItemDetalle->name = $request->name;
        $transItemDetalle->save();
        return $transItemDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransItemDetalle  $transItemDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransItemDetalle $transItemDetalle)
    {
        $transItemDetalle->estado = 0;
        $transItemDetalle->save();
    }
}
