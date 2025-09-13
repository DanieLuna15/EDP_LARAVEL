<?php

namespace App\Http\Controllers;

use App\Models\ProveedorCategoriaDetalle;
use Illuminate\Http\Request;

class ProveedorCategoriaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProveedorCategoriaDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedorCategoriaDetalle = new ProveedorCategoriaDetalle();
        $proveedorCategoriaDetalle->proveedor_compra_id = $request->proveedor_compra_id;
        $proveedorCategoriaDetalle->proveedor_categoria_id = $request->proveedor_categoria_id;
        $proveedorCategoriaDetalle->sub_medida_id = $request->sub_medida['id'];
        $proveedorCategoriaDetalle->medida_producto_id = $request->sub_medida['medida_producto_id'];
        $proveedorCategoriaDetalle->save();
        return $proveedorCategoriaDetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProveedorCategoriaDetalle  $proveedorCategoriaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(ProveedorCategoriaDetalle $proveedorCategoriaDetalle)
    {
        
        return $proveedorCategoriaDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProveedorCategoriaDetalle  $proveedorCategoriaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProveedorCategoriaDetalle $proveedorCategoriaDetalle)
    {
        $proveedorCategoriaDetalle->name = $request->name;
        $proveedorCategoriaDetalle->save();
        return $proveedorCategoriaDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProveedorCategoriaDetalle  $proveedorCategoriaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProveedorCategoriaDetalle $proveedorCategoriaDetalle)
    {
        $proveedorCategoriaDetalle->estado = 0;
        $proveedorCategoriaDetalle->save();
    }
}
