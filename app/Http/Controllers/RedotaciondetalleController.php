<?php

namespace App\Http\Controllers;

use App\Models\Redotaciondetalle;
use Illuminate\Http\Request;

class RedotaciondetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redotaciondetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $redotaciondetalle = new Redotaciondetalle();
        $redotaciondetalle->name = $request->name;
        $redotaciondetalle->save();
        return $redotaciondetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redotaciondetalle  $redotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Redotaciondetalle $redotaciondetalle)
    {
        
        return $redotaciondetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redotaciondetalle  $redotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redotaciondetalle $redotaciondetalle)
    {
        $redotaciondetalle->name = $request->name;
        $redotaciondetalle->save();
        return $redotaciondetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redotaciondetalle  $redotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redotaciondetalle $redotaciondetalle)
    {
        $redotaciondetalle->estado = 0;
        $redotaciondetalle->save();
    }
}
