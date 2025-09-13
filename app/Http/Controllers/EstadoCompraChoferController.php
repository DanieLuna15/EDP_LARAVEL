<?php

namespace App\Http\Controllers;

use App\Models\EstadoCompraChofer;
use Illuminate\Http\Request;

class EstadoCompraChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EstadoCompraChofer::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estadoCompraChofer = new EstadoCompraChofer();
        $estadoCompraChofer->name = $request->name;
        $estadoCompraChofer->save();
        return $estadoCompraChofer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstadoCompraChofer  $estadoCompraChofer
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoCompraChofer $estadoCompraChofer)
    {
        
        return $estadoCompraChofer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstadoCompraChofer  $estadoCompraChofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoCompraChofer $estadoCompraChofer)
    {
        $estadoCompraChofer->name = $request->name;
        $estadoCompraChofer->save();
        return $estadoCompraChofer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstadoCompraChofer  $estadoCompraChofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoCompraChofer $estadoCompraChofer)
    {
        $estadoCompraChofer->estado = 0;
        $estadoCompraChofer->save();
    }
}
