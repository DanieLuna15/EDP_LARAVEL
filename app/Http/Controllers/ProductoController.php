<?php

namespace App\Http\Controllers;

use App\Models\MedidaProducto;
use App\Models\Producto;
use App\Models\SubMedida;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Producto::with(['MedidaProductos'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->name = $request->name;
        $producto->tipo = $request->tipo;
        $producto->complemento = $request->complemento;
        $producto->save();
        foreach ($request->medidas as $medida) {
            $medidaProducto = new MedidaProducto();
            $medidaProducto->medida_id = $medida['medida']['id'];
            $medidaProducto->producto_id = $producto->id;
            $medidaProducto->valor = $medida['valor'];
            $medidaProducto->save();
            foreach ($medida['submedidas'] as $sub) {
                $SubMedida = new SubMedida();
                $SubMedida->medida_producto_id = $medidaProducto->id;
                $SubMedida->name = $sub['name'];
                $SubMedida->valor_1 = $sub['valor_1'];
                $SubMedida->valor_2 = $sub['valor_2'];
                $SubMedida->nro_orden = $sub['nro_orden'];
                $SubMedida->save();

            }
        }
        return $producto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $producto->medida_productos = $producto->MedidaProductos()->get();
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->name = $request->name;
        $producto->complemento = $request->complemento;
        $producto->tipo = $request->tipo;
        $producto->save();

        if ($request->has('medida_productos')) {
            foreach ($request->medida_productos as $medida) {
                $medidaProducto = MedidaProducto::find($medida['id']);
                if ($medidaProducto) {
                    $medidaProducto->valor = $medida['valor'];
                    $medidaProducto->save();
                }
            }
        }

        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->estado = 0;
        $producto->save();
    }
}
