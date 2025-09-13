<?php

namespace App\Http\Controllers;

use App\Models\ProveedorCompra;
use App\Models\ProveedorCompraMedida;
use Illuminate\Http\Request;

class ProveedorCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProveedorCompra::with(['Documento','Categoria','ProveedorCompraMedidas'])->where([['estado',1],['inactivo',1], ['tipo', 1]])->get();
    }
    public function inactivos()
    {
        return ProveedorCompra::with(['Documento','Categoria','ProveedorCompraMedidas'])->where([['estado',1],['inactivo',0], ['tipo', 1]])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ProveedorCompra = new ProveedorCompra();
        $ProveedorCompra->nombre = $request->nombre;
        $ProveedorCompra->doc = $request->doc;
        $ProveedorCompra->documento_id = $request->documento_id;
        $ProveedorCompra->categoria_id = $request->categoria_id;
        $ProveedorCompra->direccion = $request->direccion;
        $ProveedorCompra->telefono = $request->telefono;
        $ProveedorCompra->encargado = $request->encargado;
        $ProveedorCompra->abreviatura = $request->abreviatura;
        $ProveedorCompra->inactivo = $request->inactivo;
        $ProveedorCompra->tipo = 1;

        $ProveedorCompra->save();

        foreach ($request->sub_medidas as $d) {
            $proveedorCompraMedida = new ProveedorCompraMedida();
            $proveedorCompraMedida->proveedor_compra_id = $ProveedorCompra->id;
            $proveedorCompraMedida->sub_medida_id = $d['id'];
            $proveedorCompraMedida->medida_producto_id = $d['medida_producto_id'];
            $proveedorCompraMedida->save();
        }
        return $ProveedorCompra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProveedorCompra  $proveedorCompra
     * @return \Illuminate\Http\Response
     */
    public function show(ProveedorCompra $proveedorCompra)
    {
        $proveedorCompra->load(['Documento','Categoria','ProveedorCompraMedidas','ProveedorCategorias']);
        return $proveedorCompra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProveedorCompra  $proveedorCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProveedorCompra $proveedorCompra)
    {

        $proveedorCompra->nombre = $request->nombre;
        $proveedorCompra->doc = $request->doc;
        $proveedorCompra->documento_id = $request->documento_id;
        $proveedorCompra->categoria_id = $request->categoria_id;
        $proveedorCompra->direccion = $request->direccion;
        $proveedorCompra->telefono = $request->telefono;
        $proveedorCompra->encargado = $request->encargado;
        $proveedorCompra->abreviatura = $request->abreviatura;
        $proveedorCompra->inactivo = $request->inactivo;
        $proveedorCompra->save();
        foreach ($request->sub_medidas as $d) {
            if(isset($d['id'])){
                $proveedorCompraMedida = ProveedorCompraMedida::find($d['id']);
                $proveedorCompraMedida->proveedor_compra_id = $proveedorCompra->id;
                $proveedorCompraMedida->sub_medida_id = $d['sub_medida_id'];
                $proveedorCompraMedida->medida_producto_id = $d['medida_producto_id'];
                $proveedorCompraMedida->estado = $d['estado'];
                $proveedorCompraMedida->save();

            }else{
                $proveedorCompraMedida = new ProveedorCompraMedida();
                $proveedorCompraMedida->proveedor_compra_id = $proveedorCompra->id;
                $proveedorCompraMedida->sub_medida_id = $d['sub_medida']['id'];
                $proveedorCompraMedida->medida_producto_id = $d['sub_medida']['medida_producto_id'];
                $proveedorCompraMedida->estado = $d['estado'];
                $proveedorCompraMedida->save();
            }
        }
        return $proveedorCompra;
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProveedorCompra  $proveedorCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProveedorCompra $proveedorCompra)
    {
        $proveedorCompra->estado = 0;
        $proveedorCompra->save();
    }
}
