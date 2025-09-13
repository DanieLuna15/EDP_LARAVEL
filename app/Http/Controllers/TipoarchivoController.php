<?php

namespace App\Http\Controllers;

use App\Models\Tipoarchivo;
use Illuminate\Http\Request;

class TipoarchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipoarchivo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoarchivo = new Tipoarchivo();
        $tipoarchivo->name = $request->name;
        $tipoarchivo->save();
        return $tipoarchivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipoarchivo  $tipoarchivo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipoarchivo $tipoarchivo)
    {
        
        return $tipoarchivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipoarchivo  $tipoarchivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipoarchivo $tipoarchivo)
    {
        $tipoarchivo->name = $request->name;
        $tipoarchivo->save();
        return $tipoarchivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipoarchivo  $tipoarchivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipoarchivo $tipoarchivo)
    {
        $tipoarchivo->estado = 0;
        $tipoarchivo->save();
    }
}
