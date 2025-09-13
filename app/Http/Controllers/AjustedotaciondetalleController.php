<?php

namespace App\Http\Controllers;

use App\Models\Ajustedotaciondetalle;
use Illuminate\Http\Request;

class AjustedotaciondetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ajustedotaciondetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ajustedotaciondetalle = new Ajustedotaciondetalle();
        $ajustedotaciondetalle->name = $request->name;
        $ajustedotaciondetalle->save();
        return $ajustedotaciondetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajustedotaciondetalle  $ajustedotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Ajustedotaciondetalle $ajustedotaciondetalle)
    {
        
        return $ajustedotaciondetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajustedotaciondetalle  $ajustedotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajustedotaciondetalle $ajustedotaciondetalle)
    {
        $ajustedotaciondetalle->name = $request->name;
        $ajustedotaciondetalle->save();
        return $ajustedotaciondetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajustedotaciondetalle  $ajustedotaciondetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajustedotaciondetalle $ajustedotaciondetalle)
    {
        $ajustedotaciondetalle->estado = 0;
        $ajustedotaciondetalle->save();
    }
}
