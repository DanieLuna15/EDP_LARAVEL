<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proveedor::with(['Documento'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Proveedor = new Proveedor();
        $Proveedor->nombre = $request->nombre;
        $Proveedor->doc = $request->doc;
        $Proveedor->documento_id = $request->documento_id;
        $Proveedor->direccion = $request->direccion;
        $Proveedor->telefono = $request->telefono;
        $Proveedor->encargado = $request->encargado;

        $Proveedor->save();
        return $Proveedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        
        return $proveedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
       
        $proveedor->nombre = $request->nombre;
        $proveedor->doc = $request->doc;
        $proveedor->documento_id = $request->documento_id;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->encargado = $request->encargado;

        $proveedor->save();
        return $proveedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->estado = 0;
        $proveedor->save();
    }
}
