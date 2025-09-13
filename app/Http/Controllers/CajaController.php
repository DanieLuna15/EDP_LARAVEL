<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\CajaEntrada;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caja_entrada = CajaEntrada::where('estado',1)->where('tipo',1)->get()->sum('cantidad');
        $caja_salida = CajaEntrada::where('estado',1)->where('tipo',2)->get()->sum('cantidad');
        $caja_stock = $caja_entrada - $caja_salida;
        return Caja::where('estado',1)->get()->map(function($caja) use ($caja_stock){
            $caja->stock = $caja_stock;
            return $caja;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = new Caja();
        $caja->name = $request->name;
        $caja->compra = $request->compra;
        $caja->venta = $request->venta;
        $caja->save();
        return $caja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show(Caja $caja)
    {
        
        return $caja;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caja $caja)
    {
        $caja->name = $request->name;
        $caja->compra = $request->compra;
        $caja->venta = $request->venta;
        $caja->save();
        return $caja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
        $caja->estado = 0;
        $caja->save();
    }
}
