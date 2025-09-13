<?php

namespace App\Http\Controllers;

use App\Models\Finivacacionaldetalle;
use Illuminate\Http\Request;

class FinivacacionaldetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finivacacionaldetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finivacacionaldetalle = new Finivacacionaldetalle();
        $finivacacionaldetalle->name = $request->name;
        $finivacacionaldetalle->save();
        return $finivacacionaldetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finivacacionaldetalle  $finivacacionaldetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Finivacacionaldetalle $finivacacionaldetalle)
    {
        
        return $finivacacionaldetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finivacacionaldetalle  $finivacacionaldetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finivacacionaldetalle $finivacacionaldetalle)
    {
        $finivacacionaldetalle->name = $request->name;
        $finivacacionaldetalle->save();
        return $finivacacionaldetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finivacacionaldetalle  $finivacacionaldetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finivacacionaldetalle $finivacacionaldetalle)
    {
        $finivacacionaldetalle->estado = 0;
        $finivacacionaldetalle->save();
    }
}
