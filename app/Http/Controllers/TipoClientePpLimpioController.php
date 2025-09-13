<?php

namespace App\Http\Controllers;

use App\Models\TipoClientePpLimpio;
use Illuminate\Http\Request;

class TipoClientePpLimpioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoClientePpLimpio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoClientePpLimpio = new TipoClientePpLimpio();
        $tipoClientePpLimpio->name = $request->name;
        $tipoClientePpLimpio->desde = $request->desde;
        $tipoClientePpLimpio->hasta = $request->hasta;
        $tipoClientePpLimpio->save();
        return $tipoClientePpLimpio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoClientePpLimpio  $tipoClientePpLimpio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoClientePpLimpio $tipoClientePpLimpio)
    {
        
        return $tipoClientePpLimpio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoClientePpLimpio  $tipoClientePpLimpio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoClientePpLimpio $tipoClientePpLimpio)
    {
        $tipoClientePpLimpio->name = $request->name;

        $tipoClientePpLimpio->desde = $request->desde;
        $tipoClientePpLimpio->hasta = $request->hasta;
        $tipoClientePpLimpio->save();
        return $tipoClientePpLimpio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoClientePpLimpio  $tipoClientePpLimpio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoClientePpLimpio $tipoClientePpLimpio)
    {
        $tipoClientePpLimpio->estado = 0;
        $tipoClientePpLimpio->save();
    }
}
