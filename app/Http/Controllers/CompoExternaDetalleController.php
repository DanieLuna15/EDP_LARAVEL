<?php

namespace App\Http\Controllers;

use App\Models\CompoExternaDetalle;
use Illuminate\Http\Request;

class CompoExternaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompoExternaDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compoExternaDetalle = new CompoExternaDetalle();
        $compoExternaDetalle->name = $request->name;
        $compoExternaDetalle->compo_externa_id = $request->compo_externa_id;
        $compoExternaDetalle->peso = $request->peso;
        $compoExternaDetalle->cantidad = $request->cantidad;
        $compoExternaDetalle->compra = $request->compra;
        $compoExternaDetalle->venta = $request->venta;
        $compoExternaDetalle->principal = $request->principal;
        $compoExternaDetalle->save();
        return $compoExternaDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompoExternaDetalle  $compoExternaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(CompoExternaDetalle $compoExternaDetalle)
    {
        
        return $compoExternaDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompoExternaDetalle  $compoExternaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompoExternaDetalle $compoExternaDetalle)
    {
        $compoExternaDetalle->name = $request->name;
        $compoExternaDetalle->compo_externa_id = $request->compo_externa_id;
        $compoExternaDetalle->peso = $request->peso;
        $compoExternaDetalle->cantidad = $request->cantidad;
        $compoExternaDetalle->compra = $request->compra;
        $compoExternaDetalle->venta = $request->venta;
        $compoExternaDetalle->principal = $request->principal;
        $compoExternaDetalle->save();

        return $compoExternaDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompoExternaDetalle  $compoExternaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompoExternaDetalle $compoExternaDetalle)
    {
        $compoExternaDetalle->estado = 0;
        $compoExternaDetalle->save();
    }
}
