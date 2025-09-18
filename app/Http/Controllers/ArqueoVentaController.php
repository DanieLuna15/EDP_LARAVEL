<?php

namespace App\Http\Controllers;

use App\Models\ArqueoVenta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArqueoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArqueoVenta::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arqueoVenta = new ArqueoVenta();
        $arqueoVenta->name = $request->name;
        $arqueoVenta->banco_id = $request->input('banco_id');
        $arqueoVenta->comprobante_pago = $request->input('comprobante_pago');
        $arqueoVenta->save();
        return $arqueoVenta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArqueoVenta  $arqueoVenta
     * @return \Illuminate\Http\Response
     */
    public function show(ArqueoVenta $arqueoVenta)
    {
        
        return $arqueoVenta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArqueoVenta  $arqueoVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArqueoVenta $arqueoVenta)
    {
        $arqueoVenta->name = $request->name;
        if ($request->has('banco_id')) {
            $arqueoVenta->banco_id = $request->input('banco_id');
        }
        if ($request->has('comprobante_pago')) {
            $arqueoVenta->comprobante_pago = $request->input('comprobante_pago');
        }
        $arqueoVenta->save();
        return $arqueoVenta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArqueoVenta  $arqueoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArqueoVenta $arqueoVenta)
    {
        $arqueoVenta->estado = 0;
        $arqueoVenta->save();
    }
}
