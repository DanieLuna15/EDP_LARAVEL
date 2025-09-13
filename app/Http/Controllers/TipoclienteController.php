<?php

namespace App\Http\Controllers;

use App\Models\Tipocliente;
use Illuminate\Http\Request;

class TipoclienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipocliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipocliente = new Tipocliente();
        $tipocliente->name = $request->name;
        $tipocliente->monto = $request->monto;
        $tipocliente->desde = $request->desde;
        $tipocliente->save();
        return $tipocliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipocliente  $tipocliente
     * @return \Illuminate\Http\Response
     */
    public function show(Tipocliente $tipocliente)
    {
        
        return $tipocliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipocliente  $tipocliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipocliente $tipocliente)
    {
        $tipocliente->name = $request->name;
        $tipocliente->monto = $request->monto;
        $tipocliente->desde = $request->desde;
        $tipocliente->save();
        return $tipocliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipocliente  $tipocliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipocliente $tipocliente)
    {
        $tipocliente->estado = 0;
        $tipocliente->save();
    }
}
