<?php

namespace App\Http\Controllers;

use App\Models\Salidotacontradeta;
use Illuminate\Http\Request;

class SalidotacontradetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Salidotacontradeta::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salidotacontradeta = new Salidotacontradeta();
        $salidotacontradeta->name = $request->name;
        $salidotacontradeta->save();
        return $salidotacontradeta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salidotacontradeta  $salidotacontradeta
     * @return \Illuminate\Http\Response
     */
    public function show(Salidotacontradeta $salidotacontradeta)
    {
        
        return $salidotacontradeta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salidotacontradeta  $salidotacontradeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salidotacontradeta $salidotacontradeta)
    {
        $salidotacontradeta->name = $request->name;
        $salidotacontradeta->save();
        return $salidotacontradeta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salidotacontradeta  $salidotacontradeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salidotacontradeta $salidotacontradeta)
    {
        $salidotacontradeta->estado = 0;
        $salidotacontradeta->save();
    }
}
