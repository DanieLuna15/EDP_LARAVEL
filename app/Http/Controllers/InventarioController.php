<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Inventario::with(['Producto','MedidaProducto'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $s) {

            $list[] = $s;
        }
        $new = [];
        if(count($list)>0){
            $list = collect($list)->groupBy('producto_id');
            foreach ($list as $s) {
                $producto = $s->first()->producto;
                $producto->stock_units = $s->sum('nro');
                $producto->stock_medida = $producto->stock_units/floatval($producto->MedidaProducto->valor);
                $new[] =$producto;
              
        
            }

            return $new;
        }
        return $new;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario = new Inventario();
        $inventario->name = $request->name;
        $inventario->save();
        return $inventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        
        return $inventario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        $inventario->name = $request->name;
        $inventario->save();
        return $inventario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->estado = 0;
        $inventario->save();
    }
}
