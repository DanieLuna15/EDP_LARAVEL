<?php

namespace App\Http\Controllers;

use App\Models\Finiaguinaldodetalle;
use Illuminate\Http\Request;

class FiniaguinaldodetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finiaguinaldodetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finiaguinaldodetalle = new Finiaguinaldodetalle();
        $finiaguinaldodetalle->name = $request->name;
        $finiaguinaldodetalle->save();
        return $finiaguinaldodetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finiaguinaldodetalle  $finiaguinaldodetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Finiaguinaldodetalle $finiaguinaldodetalle)
    {
        
        return $finiaguinaldodetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finiaguinaldodetalle  $finiaguinaldodetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finiaguinaldodetalle $finiaguinaldodetalle)
    {
        $finiaguinaldodetalle->name = $request->name;
        $finiaguinaldodetalle->save();
        return $finiaguinaldodetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finiaguinaldodetalle  $finiaguinaldodetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finiaguinaldodetalle $finiaguinaldodetalle)
    {
        $finiaguinaldodetalle->estado = 0;
        $finiaguinaldodetalle->save();
    }
}
