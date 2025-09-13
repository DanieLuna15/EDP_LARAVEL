<?php

namespace App\Http\Controllers;

use App\Models\PollolimpioSucursal;
use Illuminate\Http\Request;

class PollolimpioSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PollolimpioSucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pollolimpioSucursal = new PollolimpioSucursal();
        $pollolimpioSucursal->name = $request->name;
        $pollolimpioSucursal->save();
        return $pollolimpioSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollolimpioSucursal  $pollolimpioSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(PollolimpioSucursal $pollolimpioSucursal)
    {
        
        return $pollolimpioSucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollolimpioSucursal  $pollolimpioSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollolimpioSucursal $pollolimpioSucursal)
    {
        $pollolimpioSucursal->name = $request->name;
        $pollolimpioSucursal->save();
        return $pollolimpioSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollolimpioSucursal  $pollolimpioSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollolimpioSucursal $pollolimpioSucursal)
    {
        $pollolimpioSucursal->estado = 0;
        $pollolimpioSucursal->save();
    }
}
