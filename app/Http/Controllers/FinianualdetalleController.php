<?php

namespace App\Http\Controllers;

use App\Models\Finianualdetalle;
use Illuminate\Http\Request;

class FinianualdetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finianualdetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finianualdetalle = new Finianualdetalle();
        $finianualdetalle->name = $request->name;
        $finianualdetalle->save();
        return $finianualdetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finianualdetalle  $finianualdetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Finianualdetalle $finianualdetalle)
    {
        
        return $finianualdetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finianualdetalle  $finianualdetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finianualdetalle $finianualdetalle)
    {
        $finianualdetalle->name = $request->name;
        $finianualdetalle->save();
        return $finianualdetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finianualdetalle  $finianualdetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finianualdetalle $finianualdetalle)
    {
        $finianualdetalle->estado = 0;
        $finianualdetalle->save();
    }
}
