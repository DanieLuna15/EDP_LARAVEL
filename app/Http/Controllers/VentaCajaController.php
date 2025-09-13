<?php

namespace App\Http\Controllers;

use App\Models\VentaCaja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentaCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaCaja::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaCaja = new VentaCaja();
        $ventaCaja->name = $request->name;
        $ventaCaja->save();
        return $ventaCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaCaja  $ventaCaja
     * @return \Illuminate\Http\Response
     */
    public function show(VentaCaja $ventaCaja)
    {
        
        return $ventaCaja;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaCaja  $ventaCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaCaja $ventaCaja)
    {
        $ventaCaja->name = $request->name;
        $ventaCaja->save();
        return $ventaCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaCaja  $ventaCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaCaja $ventaCaja)
    {
        $ventaCaja->estado = 0;
        $ventaCaja->save();
    }
}
