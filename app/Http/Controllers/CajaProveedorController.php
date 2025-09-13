<?php

namespace App\Http\Controllers;

use App\Models\CajaProveedor;
use Illuminate\Http\Request;

class CajaProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaProveedor::with(['Documento'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaProveedor = new CajaProveedor();
        $cajaProveedor->nombre = $request->nombre;
        $cajaProveedor->doc = $request->doc;
        $cajaProveedor->documento_id = $request->documento_id;
        $cajaProveedor->direccion = $request->direccion;
        $cajaProveedor->telefono = $request->telefono;
        $cajaProveedor->encargado = $request->encargado;
        $cajaProveedor->save();

        return $cajaProveedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaProveedor  $cajaProveedor
     * @return \Illuminate\Http\Response
     */
    public function show(CajaProveedor $cajaProveedor)
    {
        
        return $cajaProveedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaProveedor  $cajaProveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaProveedor $cajaProveedor)
    {
        $cajaProveedor->nombre = $request->nombre;
        $cajaProveedor->doc = $request->doc;
        $cajaProveedor->documento_id = $request->documento_id;
        $cajaProveedor->direccion = $request->direccion;
        $cajaProveedor->telefono = $request->telefono;
        $cajaProveedor->encargado = $request->encargado;
        $cajaProveedor->save();
        return $cajaProveedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaProveedor  $cajaProveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaProveedor $cajaProveedor)
    {
        $cajaProveedor->estado = 0;
        $cajaProveedor->save();
    }
}
