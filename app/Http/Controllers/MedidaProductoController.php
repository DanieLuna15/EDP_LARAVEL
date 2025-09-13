<?php

namespace App\Http\Controllers;

use App\Models\MedidaProducto;
use Illuminate\Http\Request;

class MedidaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MedidaProducto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medidaProducto = new MedidaProducto();
        $medidaProducto->medida_id = $request->medida_id;
        $medidaProducto->producto_id = $request->producto_id;
        $medidaProducto->save();
        return $medidaProducto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedidaProducto  $medidaProducto
     * @return \Illuminate\Http\Response
     */
    public function show(MedidaProducto $medidaProducto)
    {
        
        return $medidaProducto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedidaProducto  $medidaProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedidaProducto $medidaProducto)
    {
        $medidaProducto->name = $request->name;
        $medidaProducto->save();
        return $medidaProducto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedidaProducto  $medidaProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedidaProducto $medidaProducto)
    {
        $medidaProducto->estado = 0;
        $medidaProducto->save();
    }
}
