<?php

namespace App\Http\Controllers;

use App\Models\ZonaDespacho;
use Illuminate\Http\Request;

class ZonaDespachoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ZonaDespacho::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zonaDespacho = new ZonaDespacho();
        $zonaDespacho->name = $request->name;
        $zonaDespacho->save();
        return $zonaDespacho;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZonaDespacho  $zonaDespacho
     * @return \Illuminate\Http\Response
     */
    public function show(ZonaDespacho $zonaDespacho)
    {
        
        return $zonaDespacho;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZonaDespacho  $zonaDespacho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZonaDespacho $zonaDespacho)
    {
        $zonaDespacho->name = $request->name;
        $zonaDespacho->save();
        return $zonaDespacho;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZonaDespacho  $zonaDespacho
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZonaDespacho $zonaDespacho)
    {
        $zonaDespacho->estado = 0;
        $zonaDespacho->save();
    }
}
