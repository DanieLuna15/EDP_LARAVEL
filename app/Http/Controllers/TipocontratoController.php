<?php

namespace App\Http\Controllers;

use App\Models\Tipocontrato;
use Illuminate\Http\Request;

class TipocontratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipocontrato::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipocontrato = new Tipocontrato();
        $tipocontrato->name = $request->name;
        $tipocontrato->save();
        return $tipocontrato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function show(Tipocontrato $tipocontrato)
    {
        
        return $tipocontrato;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipocontrato $tipocontrato)
    {
        $tipocontrato->name = $request->name;
        $tipocontrato->save();
        return $tipocontrato;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipocontrato $tipocontrato)
    {
        $tipocontrato->estado = 0;
        $tipocontrato->save();
    }
}
