<?php

namespace App\Http\Controllers;

use App\Models\ProveedorCompraMedida;
use Illuminate\Http\Request;

class ProveedorCompraMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProveedorCompraMedida::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedorCompraMedida = new ProveedorCompraMedida();
        $proveedorCompraMedida->name = $request->name;
        $proveedorCompraMedida->save();
        return $proveedorCompraMedida;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProveedorCompraMedida  $proveedorCompraMedida
     * @return \Illuminate\Http\Response
     */
    public function show(ProveedorCompraMedida $proveedorCompraMedida)
    {
        
        return $proveedorCompraMedida;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProveedorCompraMedida  $proveedorCompraMedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProveedorCompraMedida $proveedorCompraMedida)
    {
        $proveedorCompraMedida->name = $request->name;
        $proveedorCompraMedida->save();
        return $proveedorCompraMedida;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProveedorCompraMedida  $proveedorCompraMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProveedorCompraMedida $proveedorCompraMedida)
    {
        $proveedorCompraMedida->estado = 0;
        $proveedorCompraMedida->save();
    }
}
