<?php

namespace App\Http\Controllers;

use App\Models\ProveedorCategoria;
use Illuminate\Http\Request;

class ProveedorCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProveedorCategoria::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedorCategoria = new ProveedorCategoria();
        $proveedorCategoria->categoria_id = $request->categoria_id;
        $proveedorCategoria->proveedor_compra_id = $request->proveedor_compra_id;
        $proveedorCategoria->save();
        return $proveedorCategoria;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProveedorCategoria  $proveedorCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(ProveedorCategoria $proveedorCategoria)
    {
        
        return $proveedorCategoria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProveedorCategoria  $proveedorCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProveedorCategoria $proveedorCategoria)
    {
        $proveedorCategoria->name = $request->name;
        $proveedorCategoria->save();
        return $proveedorCategoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProveedorCategoria  $proveedorCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProveedorCategoria $proveedorCategoria)
    {
        $proveedorCategoria->estado = 0;
        $proveedorCategoria->save();
    }
}
