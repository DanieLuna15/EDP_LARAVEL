<?php

namespace App\Http\Controllers;

use App\Models\Transformacion;
use App\Models\TransformacionDetalleSucursal;
use App\Models\TransformacionItem;
use App\Models\TransformacionSucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class TransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transformacion::with(['TransformacionItem'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacion = new Transformacion();
        $transformacion->name = $request->name;
        $transformacion->tipo = $request->tipo;
        $transformacion->save();
        if($request->tipo == 1){

            $transformacionItem = new TransformacionItem();
            $transformacionItem->transformacion_id = $transformacion->id;
            $transformacionItem->item_id = $request->item_id;
            $transformacionItem->peso = $request->peso;
            $transformacionItem->precio = $request->precio;
            $transformacionItem->promedio = $request->promedio;
            $transformacionItem->save();

        }

        return $transformacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transformacion  $transformacion
     * @return \Illuminate\Http\Response
     */
    public function show(Transformacion $transformacion)
    {
        $transformacion->detalles = $transformacion->TransformacionDetalles;
        return $transformacion;
    }
    // public function listaSucursal($sucursal)
    // {
    //     $model =  Transformacion::where('estado',1)->get();
    //     $list = [];
    //     $sucursal_id = $sucursal;
    //     foreach($model as $item){
    //         $item->transformacion_item = $item->TransformacionItem;
    //         $item->transformacion_sucursal = $item->TransformacionSucursal()->where('sucursal_id',$sucursal_id)->first();
    //         if($item->transformacion_sucursal){
    //             $item->transformacion_item->peso = $item->transformacion_sucursal->peso;
    //             $item->transformacion_item->precio = $item->transformacion_sucursal->precio;
    //             $item->transformacion_item->promedio = $item->transformacion_sucursal->promedio;
    //         }
    //         $item->detalles = $item->TransformacionDetalles()->get()->each(function($detalle) use ($sucursal_id){
    //             $precio = $detalle->TransformacionDetalleSucursals()->where('sucursal_id',$sucursal_id);
    //             if($precio->count() > 0){
    //                 $detalle->precio = $precio->first()->precio;
    //                 $detalle->promedio = $precio->first()->promedio;
    //                 $detalle->peso = $precio->first()->peso;

    //             }

    //         });
    //         $list[] = $item;
    //     }
    //     return $list;
    // }


    public function listaSucursal($sucursal)
    {
        Log::info('>>> listaSucursal INICIADA', ['sucursal_id' => $sucursal]);

        $model =  Transformacion::where('estado',1)->get();
        $list = [];
        $sucursal_id = $sucursal;
        foreach($model as $item){
            // Log del item original
            Log::info('>>> TRANSFORMACION BASE', ['item' => $item]);

            $item->transformacion_item = $item->TransformacionItem;
            $item->transformacion_sucursal = $item->TransformacionSucursal()->where('sucursal_id',$sucursal_id)->first();
            
            // Log de transformacion_sucursal
            Log::info('>>> TRANSFORMACION SUCURSAL', ['transformacion_sucursal' => $item->transformacion_sucursal]);
            
            if($item->transformacion_sucursal){
                $item->transformacion_item->peso = $item->transformacion_sucursal->peso;
                $item->transformacion_item->precio = $item->transformacion_sucursal->precio;
                $item->transformacion_item->promedio = $item->transformacion_sucursal->promedio;
            }
            $item->detalles = $item->TransformacionDetalles()->get()->each(function($detalle) use ($sucursal_id){
                // Log del detalle
                Log::info('>>> TRANSFORMACION DETALLE BASE', ['detalle' => $detalle]);
                $precio = $detalle->TransformacionDetalleSucursals()->where('sucursal_id',$sucursal_id);
                if($precio->count() > 0){
                    $detalle->precio = $precio->first()->precio;
                    $detalle->promedio = $precio->first()->promedio;
                    $detalle->peso = $precio->first()->peso;
                    // Log del precio para detalle
                    Log::info('>>> TRANSFORMACION DETALLE SUCURSAL', [
                        'detalle_id' => $detalle->id,
                        'precio' => $detalle->precio,
                        'promedio' => $detalle->promedio,
                        'peso' => $detalle->peso
                    ]);
                }
            });

            $list[] = $item;
            // Log del item ya preparado para el $list
            Log::info('>>> TRANSFORMACION LIST APPEND', ['item' => $item]);
        }
        Log::info('>>> listaSucursal FINAL LIST', ['list' => $list]);
        return $list;
    }

    public function precio(Request $request)
    {
        
        foreach($request->transformaciones as $item){
            if($item['tipo'] == 1){
                $TransformacionSucursal = new TransformacionSucursal();
                $TransformacionSucursal->transformacion_id = $item['id'];
                $TransformacionSucursal->sucursal_id = $request->sucursal_id;
                $TransformacionSucursal->peso = $item['transformacion_item']['peso'];
                $TransformacionSucursal->precio = $item['transformacion_item']['precio'];
                $TransformacionSucursal->promedio = $item['transformacion_item']['promedio'];
                $TransformacionSucursal->fecha = Carbon::now()->addDay();
                $TransformacionSucursal->f = Carbon::now()->format('Y-m-d');
                $TransformacionSucursal->h = Carbon::now()->format('H:i:s');
                $TransformacionSucursal->cambios = 1;
                $TransformacionSucursal->save();
            }
            
           foreach($item['detalles'] as $detalle){
                $transformacionDetalleSucursal = new TransformacionDetalleSucursal();
                $transformacionDetalleSucursal->transformacion_detalle_id = $detalle['id'];
                $transformacionDetalleSucursal->sucursal_id = $request->sucursal_id;
                $transformacionDetalleSucursal->peso = $detalle['peso'];
                $transformacionDetalleSucursal->precio = $detalle['precio'];
                $transformacionDetalleSucursal->promedio = $detalle['promedio'];
                $transformacionDetalleSucursal->fecha = Carbon::now()->addDay();
                $transformacionDetalleSucursal->f = Carbon::now()->format('Y-m-d');
                $transformacionDetalleSucursal->h = Carbon::now()->format('H:i:s');
                $transformacionDetalleSucursal->cambios = 1;
                $transformacionDetalleSucursal->save();
           }
        }

       
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transformacion  $transformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transformacion $transformacion)
    {
        $transformacion->name = $request->name;
        $transformacion->tipo = $request->tipo;
        $transformacion->save();
        if($request->tipo == 1){

            $transformacionItem = new TransformacionItem();
            $transformacionItem->transformacion_id = $transformacion->id;
            $transformacionItem->item_id = $request->item_id;
            $transformacionItem->peso = $request->peso;
            $transformacionItem->precio = $request->precio;
            $transformacionItem->promedio = $request->promedio;
            $transformacionItem->save();

        }
        return $transformacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transformacion  $transformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transformacion $transformacion)
    {
        $transformacion->estado = 0;
        $transformacion->save();
    }
}
