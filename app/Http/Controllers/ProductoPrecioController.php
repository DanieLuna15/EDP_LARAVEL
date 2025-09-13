<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductoPrecio;
use Illuminate\Support\Facades\Log;
use App\Models\ProductoPrecioCambio;
use App\Models\ProductoPrecioSucursal;

class ProductoPrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductoPrecio::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $existingProduct = ProductoPrecio::where('name', $request->name)->first();
    
        if ($existingProduct) {
            return response()->json([
                'error' => 'Ya existe un precio para el producto: ' . $request->name
            ], 400);  
        }

        $productoPrecio = new ProductoPrecio();
        $productoPrecio->name = $request->name;
        $productoPrecio->precio = $request->precio;
        $productoPrecio->venta_1 = $request->venta_1;
        $productoPrecio->venta_2 = $request->venta_2;
        $productoPrecio->venta_3 = $request->venta_3;
        $productoPrecio->venta_4 = $request->venta_4;
        $productoPrecio->venta_5 = $request->venta_5;
        $productoPrecio->venta_6 = $request->venta_6;
        $productoPrecio->venta_7 = $request->venta_7;
        $productoPrecio->venta_8 = $request->venta_8;
        $productoPrecio->venta_9 = $request->venta_9;
        $productoPrecio->venta_10 = $request->venta_10;
        $productoPrecio->venta_11 = $request->venta_11;
        $productoPrecio->venta_12 = $request->venta_12;
        $productoPrecio->save();
        return response()->json($productoPrecio, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoPrecio  $productoPrecio
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoPrecio $productoPrecio)
    {

        return $productoPrecio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoPrecio  $productoPrecio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoPrecio $productoPrecio)
    {
        $existingProduct = ProductoPrecio::where('name', $request->name)
                                      ->where('id', '!=', $productoPrecio->id)
                                      ->first();

        if ($existingProduct) {
            return response()->json([
                'error' => 'Ya existe un precio para el producto: ' . $request->name
            ], 400);
        }

        $productoPrecio->name = $request->name;
        $productoPrecio->precio = $request->precio;
        $productoPrecio->venta_1 = $request->venta_1;
        $productoPrecio->venta_2 = $request->venta_2;
        $productoPrecio->venta_3 = $request->venta_3;
        $productoPrecio->venta_4 = $request->venta_4;
        $productoPrecio->venta_5 = $request->venta_5;
        $productoPrecio->venta_6 = $request->venta_6;
        $productoPrecio->venta_7 = $request->venta_7;
        $productoPrecio->venta_8 = $request->venta_8;
        $productoPrecio->venta_9 = $request->venta_9;
        $productoPrecio->venta_10 = $request->venta_10;
        $productoPrecio->venta_11 = $request->venta_11;
        $productoPrecio->venta_12 = $request->venta_12;
        $productoPrecio->descuento_1 = $request->descuento_1;
        $productoPrecio->descuento_2 = $request->descuento_2;
        $productoPrecio->descuento_3 = $request->descuento_3;
        $productoPrecio->descuento_4 = $request->descuento_4;
        $productoPrecio->descuento_5 = $request->descuento_5;
        $productoPrecio->descuento_6 = $request->descuento_6;
        $productoPrecio->descuento_7 = $request->descuento_7;
        $productoPrecio->descuento_8 = $request->descuento_8;
        $productoPrecio->descuento_9 = $request->descuento_9;
        $productoPrecio->descuento_10 = $request->descuento_10;
        $productoPrecio->descuento_11 = $request->descuento_11;
        $productoPrecio->descuento_12 = $request->descuento_12;
        $productoPrecio->descuento_13 = $request->descuento_13;

        $productoPrecio->save();
        return response()->json($productoPrecio, 200);
    }
    // public function listaSucursal($sucursal)
    // {
    //     $model =  ProductoPrecio::with('ProductoPrecioLotes')->where('estado',1)->get();
    //     $list = [];
    //     $sucursal_id = $sucursal;
    //     foreach($model as $item){

    //         $lista_precios = $item->ProductoPrecioSucursals()->where('sucursal_id',$sucursal_id)->orderBy('id','desc')->get();
    //         if($lista_precios->count()>0){
    //             $item->precio = $lista_precios->first()->precio_cbba;
    //             $item->venta_1 = $lista_precios->first()->venta_1;
    //             $item->venta_2 = $lista_precios->first()->precio;
    //             $item->venta_3 = $lista_precios->first()->venta_3;
    //             $item->venta_4 = $lista_precios->first()->venta_4;
    //             $item->venta_5 = $lista_precios->first()->venta_5;
    //             $item->venta_6 = $lista_precios->first()->venta_6;
    //             $item->venta_7 = $lista_precios->first()->venta_7;
    //             $item->venta_8 = $lista_precios->first()->venta_8;
    //             $item->descuento_1 = $lista_precios->first()->descuento_1;
    //             $item->descuento_2 = $lista_precios->first()->descuento_2;
    //             $item->descuento_3 = $lista_precios->first()->descuento_3;
    //             $item->descuento_4 = $lista_precios->first()->descuento_4;
    //             $item->descuento_5 = $lista_precios->first()->descuento_5;
    //             $item->descuento_6 = $lista_precios->first()->descuento_6;
    //             $item->descuento_7 = $lista_precios->first()->descuento_7;
    //             $item->descuento_8 = $lista_precios->first()->descuento_8;
    //             $item->descuento_9 = $lista_precios->first()->descuento_9;

    //         }else{
    //             $item->venta_2 = $item->venta_2;
    //         }
    //         $hoy = Carbon::now();
    //         $item->cambios = $item->ProductoPrecioSucursals()->where('sucursal_id',$sucursal_id)->where('fecha','>=',$hoy)->count();
    //         $item->precio_valor = $item->precio;
    //         $item->venta_1_valor = $item->venta_1;
    //         $item->venta_2_valor = $item->venta_2;
    //         $item->venta_3_valor = $item->venta_3;
    //         $item->venta_4_valor = $item->venta_4;
    //         $item->venta_5_valor = $item->venta_5;
    //         $item->venta_6_valor = $item->venta_6;
    //         $item->venta_7_valor = $item->venta_7;
    //         $item->venta_8_valor = $item->venta_8;

    //         $list[] = $item;
    //     }
    //     return $list;
    // }

    public function listaSucursal($sucursal)
    {
        $model = ProductoPrecio::with('ProductoPrecioLotes')->where('estado', 1)->get();
        $list = [];
        $sucursal_id = $sucursal;

        foreach ($model as $item) {
            $lista_precios = $item->ProductoPrecioSucursals()->where('sucursal_id', $sucursal_id)->orderBy('id', 'desc')->get();
            if ($lista_precios->count() > 0) {
                $precio = $lista_precios->first();

                $item->precio = $precio->precio_cbba;
                $item->venta_1 = $precio->venta_1;
                $item->venta_2 = $precio->precio;
                $item->venta_3 = $precio->venta_3;
                $item->venta_4 = $precio->venta_4;
                $item->venta_5 = $precio->venta_5;
                $item->venta_6 = $precio->venta_6;
                $item->venta_7 = $precio->venta_7;
                $item->venta_8 = $precio->venta_8;
                $item->venta_9 = $precio->venta_9;
                $item->venta_10 = $precio->venta_10;
                $item->venta_11 = $precio->venta_11;
                $item->venta_12 = $precio->venta_12;

                $item->descuento_1 = $precio->descuento_1;
                $item->descuento_2 = $precio->descuento_2;
                $item->descuento_3 = $precio->descuento_3;
                $item->descuento_4 = $precio->descuento_4;
                $item->descuento_5 = $precio->descuento_5;
                $item->descuento_6 = $precio->descuento_6;
                $item->descuento_7 = $precio->descuento_7;
                $item->descuento_8 = $precio->descuento_8;
                $item->descuento_9 = $precio->descuento_9;
                $item->descuento_10 = $precio->descuento_10;
                $item->descuento_11 = $precio->descuento_11;
                $item->descuento_12 = $precio->descuento_12;
                $item->descuento_13 = $precio->descuento_13;

                // Estados de precios
                $item->estado_precio_5 = $precio->estado_precio_5;
                $item->estado_precio_6 = $precio->estado_precio_6;
                $item->estado_precio_7 = $precio->estado_precio_7;
                $item->estado_precio_8 = $precio->estado_precio_8;
                $item->estado_precio_9 = $precio->estado_precio_9;
                $item->estado_precio_10 = $precio->estado_precio_10;
                $item->estado_precio_11 = $precio->estado_precio_11;
                $item->estado_precio_12 = $precio->estado_precio_12;
            } else {
                $item->venta_2 = $item->venta_2;

                $item->estado_precio_5 = 0;
                $item->estado_precio_6 = 0;
                $item->estado_precio_7 = 0;
                $item->estado_precio_8 = 0;
                $item->estado_precio_9 = 0;
                $item->estado_precio_10 = 0;
                $item->estado_precio_11 = 0;
                $item->estado_precio_12 = 0;
            }

            $hoy = Carbon::now();
            $cambios = $item->ProductoPrecioSucursals()
                ->where('sucursal_id', $sucursal_id)
                ->where('fecha', '>=', $hoy)
                ->whereIn('tipo_cambio', [1, 3])
                ->count();

            $item->cambios = $cambios;

            $item->precio_valor = $item->precio;
            $item->venta_1_valor = $item->venta_1;
            $item->venta_2_valor = $item->venta_2;
            $item->venta_3_valor = $item->venta_3;
            $item->venta_4_valor = $item->venta_4;
            $item->venta_5_valor = $item->venta_5;
            $item->venta_6_valor = $item->venta_6;
            $item->venta_7_valor = $item->venta_7;
            $item->venta_8_valor = $item->venta_8;
            $item->venta_9_valor = $item->venta_9;
            $item->venta_10_valor = $item->venta_10;
            $item->venta_11_valor = $item->venta_11;
            $item->venta_12_valor = $item->venta_12;

            $list[] = $item;
        }

        usort($list, function($a, $b) {
            $venta_1_a = $a->venta_1 ?? PHP_FLOAT_MAX;  
            $venta_1_b = $b->venta_1 ?? PHP_FLOAT_MAX;  

            return $venta_1_b <=> $venta_1_a;  
        });

        return $list;
    }

    // public function precios(Request $request)
    // {
    //     $cambioPrecio = new ProductoPrecioCambio();
    //     $cambioPrecio->sucursal_id = $request->sucursal_id;
    //     $cambioPrecio->user_id = $request->usuario_id;
    //     $cambioPrecio->fecha = date('Y-m-d');
    //     $cambioPrecio->save();

    //   foreach($request->data as $item){
    //     Log::info('Producto recibido:', $item);
    //     if($item['precio_valor'] != $item['precio'] || $item['venta_1_valor'] != $item['venta_1'] ||$item['venta_2_valor'] != $item['venta_2']  || $item['venta_3_valor'] != $item['venta_3'] || $item['venta_4_valor'] != $item['venta_4'] || $item['venta_5_valor'] != $item['venta_5'] || $item['venta_6_valor'] != $item['venta_6'] ){
    //       $itemPrecio = new ProductoPrecioSucursal();
    //       $itemPrecio->producto_precio_id = $item['id'];
    //       $itemPrecio->producto_precio_cambio_id = $cambioPrecio->id;
    //       $itemPrecio->sucursal_id = $request->sucursal_id;
    //       $itemPrecio->precio = $item['venta_2_valor'];
    //       $itemPrecio->precio_anterior = $item['venta_2'];
    //       $itemPrecio->venta_1 = $item['venta_1'];
    //         $itemPrecio->precio_cbba = $item['precio'];
    //         $itemPrecio->venta_3 = $item['venta_3'];
    //         $itemPrecio->venta_4 = $item['venta_4'];
    //         $itemPrecio->venta_5 = $item['venta_5'];
    //         $itemPrecio->venta_6 = $item['venta_6'];
    //         $itemPrecio->venta_7 = $item['venta_7_valor'];
    //         $itemPrecio->venta_8 = $item['venta_8'];
    //         $itemPrecio->descuento_1 = $item['descuento_1'];
    //         $itemPrecio->descuento_2 = $item['descuento_2'];
    //         $itemPrecio->descuento_3 = $item['descuento_3'];
    //         $itemPrecio->descuento_4 = $item['descuento_4'];
    //         $itemPrecio->descuento_5 = $item['descuento_5'];
    //         $itemPrecio->descuento_6 = $item['descuento_6'];
    //         $itemPrecio->descuento_7 = $item['descuento_7'];
    //         $itemPrecio->descuento_8 = $item['descuento_8'];
    //         $itemPrecio->descuento_9 = $item['descuento_9'];


    //         $itemPrecio->estado_precio_5 = $item['estado_precio_5'] ?? 0;
    //         $itemPrecio->estado_precio_6 = $item['estado_precio_6'] ?? 0;
    //         $itemPrecio->estado_precio_7 = $item['estado_precio_7'] ?? 0;
    //         $itemPrecio->estado_precio_8 = $item['estado_precio_8'] ?? 0;

    //       $itemPrecio->cambio = $item['cambios']+1;
    //       $itemPrecio->fecha = Carbon::now()->addDay();
    //       $itemPrecio->f = Carbon::now()->format('Y-m-d');
    //         $itemPrecio->h = Carbon::now()->format('H:i:s');

    //       $itemPrecio->save();
    //     }
    //   }
    //   $cambioPrecio->url_pdf = url('reportes/productoPrecioCambios/'.$cambioPrecio->id);
    //   return $cambioPrecio;
    // }

    function precios(Request $request)
    {

        Log::info('--- INICIO precios() ---');
        Log::info('Request recibido:', $request->all());

        $cambioPrecio = new ProductoPrecioCambio();
        $cambioPrecio->sucursal_id = $request->sucursal_id;
        $cambioPrecio->user_id = $request->usuario_id;
        $cambioPrecio->fecha = date('Y-m-d');
        $cambioPrecio->save();

        foreach ($request->data as $item) {
            Log::info('Producto recibido:', $item);

            $ultimoPrecio = ProductoPrecioSucursal::where('producto_precio_id', $item['id'])
                ->where('sucursal_id', $request->sucursal_id)
                ->orderBy('id', 'desc')
                ->first();

            $precioCambiado = (
                $item['precio_valor'] != $item['precio'] ||
                $item['venta_1_valor'] != $item['venta_1'] ||
                $item['venta_2_valor'] != $item['venta_2'] ||
                $item['venta_3_valor'] != $item['venta_3'] ||
                $item['venta_4_valor'] != $item['venta_4'] ||
                $item['venta_5_valor'] != $item['venta_5'] ||
                $item['venta_6_valor'] != $item['venta_6']
            );

            $precioAlternativoCambiado = (
                $item['venta_7_valor'] != $item['venta_7'] ||
                $item['venta_8_valor'] != $item['venta_8'] ||
                $item['venta_9_valor'] != $item['venta_9'] ||
                $item['venta_10_valor'] != $item['venta_10'] ||
                $item['venta_11_valor'] != $item['venta_11'] ||
                $item['venta_12_valor'] != $item['venta_12']
            );

            $estadoCambiado = false;
            if ($ultimoPrecio) {
                $estadoCambiado = (
                    ($item['estado_precio_5'] ?? 0) != ($ultimoPrecio->estado_precio_5 ?? 0) ||
                    ($item['estado_precio_6'] ?? 0) != ($ultimoPrecio->estado_precio_6 ?? 0) ||
                    ($item['estado_precio_7'] ?? 0) != ($ultimoPrecio->estado_precio_7 ?? 0) ||
                    ($item['estado_precio_8'] ?? 0) != ($ultimoPrecio->estado_precio_8 ?? 0) ||
                    ($item['estado_precio_9'] ?? 0) != ($ultimoPrecio->estado_precio_9 ?? 0) ||
                    ($item['estado_precio_10'] ?? 0) != ($ultimoPrecio->estado_precio_10 ?? 0) ||
                    ($item['estado_precio_11'] ?? 0) != ($ultimoPrecio->estado_precio_11 ?? 0) ||
                    ($item['estado_precio_12'] ?? 0) != ($ultimoPrecio->estado_precio_12 ?? 0)
                );
            } else {
                $estadoCambiado = true;
            }

            if ($precioCambiado || $estadoCambiado || $precioAlternativoCambiado) {
                if ($precioCambiado && $estadoCambiado) {
                    $tipoCambio = 3;
                } elseif ($precioCambiado) {
                    $tipoCambio = 1;
                } elseif ($estadoCambiado) {
                    $tipoCambio = 2; // $tipoCambio = 2;
                } elseif ($precioAlternativoCambiado) {
                    $tipoCambio = 1;  // $tipoCambio = 2;
                } else {
                    $tipoCambio = 0;
                }

                $itemPrecio = new ProductoPrecioSucursal();
                $itemPrecio->producto_precio_id = $item['id'];
                $itemPrecio->producto_precio_cambio_id = $cambioPrecio->id;
                $itemPrecio->sucursal_id = $request->sucursal_id;
                $itemPrecio->precio = $item['venta_2_valor'];
                $itemPrecio->precio_anterior = $item['venta_2'];
                $itemPrecio->venta_1 = $item['venta_1'];
                $itemPrecio->precio_cbba = $item['precio'];
                $itemPrecio->venta_3 = $item['venta_3'];
                $itemPrecio->venta_4 = $item['venta_4'];
                $itemPrecio->venta_5 = $item['venta_5'];
                $itemPrecio->venta_6 = $item['venta_6'];
                $itemPrecio->venta_7 = $item['venta_7_valor'];
                $itemPrecio->venta_8 = $item['venta_8'];
                $itemPrecio->venta_9 = $item['venta_9'];
                $itemPrecio->venta_10 = $item['venta_10'];
                $itemPrecio->venta_11 = $item['venta_11'];
                $itemPrecio->venta_12 = $item['venta_12'];
                $itemPrecio->descuento_1 = $item['descuento_1'];
                $itemPrecio->descuento_2 = $item['descuento_2'];
                $itemPrecio->descuento_3 = $item['descuento_3'];
                $itemPrecio->descuento_4 = $item['descuento_4'];
                $itemPrecio->descuento_5 = $item['descuento_5'];
                $itemPrecio->descuento_6 = $item['descuento_6'];
                $itemPrecio->descuento_7 = $item['descuento_7'];
                $itemPrecio->descuento_8 = $item['descuento_8'];
                $itemPrecio->descuento_9 = $item['descuento_9'];
                $itemPrecio->descuento_10 = $item['descuento_10'];
                $itemPrecio->descuento_11 = $item['descuento_11'];
                $itemPrecio->descuento_12 = $item['descuento_12'];
                $itemPrecio->descuento_13 = $item['descuento_13'];
                $itemPrecio->estado_precio_5 = $item['estado_precio_5'] ?? 0;
                $itemPrecio->estado_precio_6 = $item['estado_precio_6'] ?? 0;
                $itemPrecio->estado_precio_7 = $item['estado_precio_7'] ?? 0;
                $itemPrecio->estado_precio_8 = $item['estado_precio_8'] ?? 0;
                $itemPrecio->estado_precio_9 = $item['estado_precio_9'] ?? 0;
                $itemPrecio->estado_precio_10 = $item['estado_precio_10'] ?? 0;
                $itemPrecio->estado_precio_11 = $item['estado_precio_11'] ?? 0;
                $itemPrecio->estado_precio_12 = $item['estado_precio_12'] ?? 0;
                $itemPrecio->tipo_cambio = $tipoCambio;

                // Solo aumenta cambios si cambió precio
                //$itemPrecio->cambio = $precioCambiado ? $item['cambios'] + 1 : $item['cambios'];
                $itemPrecio->cambio = $precioAlternativoCambiado ? $item['cambios'] + 1 : $item['cambios'];

                $itemPrecio->fecha = Carbon::now()->addDay();
                $itemPrecio->f = Carbon::now()->format('Y-m-d');
                $itemPrecio->h = Carbon::now()->format('H:i:s');
                $itemPrecio->save();

                Log::info('ProductoPrecioSucursal guardado:', $itemPrecio->toArray());
            }
        }

        $cambioPrecio->url_pdf = url('reportes/productoPrecioCambios/' . $cambioPrecio->id);

        Log::info('url_pdf generada:', ['url_pdf' => $cambioPrecio->url_pdf]);
        Log::info('--- FIN precios() ---');

        return $cambioPrecio;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoPrecio  $productoPrecio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoPrecio $productoPrecio)
    {
        $productoPrecio->estado = 0;
        $productoPrecio->save();
    }
}
