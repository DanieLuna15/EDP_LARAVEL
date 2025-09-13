<?php

namespace App\Http\Controllers;

use App\Models\EntregaCaja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntregaCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EntregaCaja::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entregaCaja = new EntregaCaja();
        $entregaCaja->name = $request->name;
        $entregaCaja->save();
        return $entregaCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntregaCaja  $entregaCaja
     * @return \Illuminate\Http\Response
     */
    public function show(EntregaCaja $entregaCaja)
    {
        
        return $entregaCaja;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntregaCaja  $entregaCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntregaCaja $entregaCaja)
    {
        $entregaCaja->name = $request->name;
        $entregaCaja->save();
        return $entregaCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntregaCaja  $entregaCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntregaCaja $entregaCaja)
    {
        $entregaCaja->estado = 0;
        $entregaCaja->save();
    }
}
