<?php

namespace App\Http\Controllers;

use App\Models\TraspasoPpEnvio;
use Illuminate\Http\Request;

class TraspasoPpEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TraspasoPpEnvio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $traspasoPpEnvio = new TraspasoPpEnvio();
        $traspasoPpEnvio->name = $request->name;
        $traspasoPpEnvio->save();
        return $traspasoPpEnvio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoPpEnvio  $traspasoPpEnvio
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoPpEnvio $traspasoPpEnvio)
    {
        
        return $traspasoPpEnvio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoPpEnvio  $traspasoPpEnvio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoPpEnvio $traspasoPpEnvio)
    {
        $traspasoPpEnvio->name = $request->name;
        $traspasoPpEnvio->save();
        return $traspasoPpEnvio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoPpEnvio  $traspasoPpEnvio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoPpEnvio $traspasoPpEnvio)
    {
        $traspasoPpEnvio->estado = 0;
        $traspasoPpEnvio->save();
    }
}
