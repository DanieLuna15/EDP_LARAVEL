<?php

namespace App\Http\Controllers;

use App\Models\CompraInventario;
use Illuminate\Http\Request;

class CompraInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompraInventario::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compraInventario = new CompraInventario();
        $compraInventario->name = $request->name;
        $compraInventario->save();
        return $compraInventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraInventario  $compraInventario
     * @return \Illuminate\Http\Response
     */
    public function show(CompraInventario $compraInventario)
    {
        
        return $compraInventario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompraInventario  $compraInventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompraInventario $compraInventario)
    {
        $compraInventario->name = $request->name;
        $compraInventario->save();
        return $compraInventario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraInventario  $compraInventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraInventario $compraInventario)
    {
        $compraInventario->estado = 0;
        $compraInventario->save();
    }
}
