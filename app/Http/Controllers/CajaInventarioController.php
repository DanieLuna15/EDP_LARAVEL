<?php

namespace App\Http\Controllers;

use App\Models\CajaInventario;
use Illuminate\Http\Request;

class CajaInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaInventario::with(['Almacen','Caja'])->selectRaw('almacen_id, caja_id, sum(cantidad) as cantidad_total')
        ->groupBy('almacen_id', 'caja_id')
        ->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaInventario = new CajaInventario();
        $cajaInventario->name = $request->name;
        $cajaInventario->save();
        return $cajaInventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaInventario  $cajaInventario
     * @return \Illuminate\Http\Response
     */
    public function show(CajaInventario $cajaInventario)
    {
        
        return $cajaInventario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaInventario  $cajaInventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaInventario $cajaInventario)
    {
        $cajaInventario->name = $request->name;
        $cajaInventario->save();
        return $cajaInventario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaInventario  $cajaInventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaInventario $cajaInventario)
    {
        $cajaInventario->estado = 0;
        $cajaInventario->save();
    }
}
