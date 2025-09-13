<?php

namespace App\Http\Controllers;

use App\Models\Pollolimpio;
use App\Models\PollolimpioCambio;
use App\Models\PollolimpioSucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PollolimpioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pollolimpio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pollolimpio = new Pollolimpio();
        $pollolimpio->name = $request->name;
        $pollolimpio->precio = $request->precio;
        $pollolimpio->venta_1 = $request->venta_1;
        $pollolimpio->venta_2 = $request->venta_2;
        $pollolimpio->venta_3 = $request->venta_3;
        $pollolimpio->venta_4 = $request->venta_4;
        $pollolimpio->venta_5 = $request->venta_5;
        $pollolimpio->venta_6 = $request->venta_6;
        $pollolimpio->save();
        return $pollolimpio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pollolimpio  $pollolimpio
     * @return \Illuminate\Http\Response
     */
    public function show(Pollolimpio $pollolimpio)
    {
        
        return $pollolimpio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pollolimpio  $pollolimpio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pollolimpio $pollolimpio)
    {
        $pollolimpio->name = $request->name;
        $pollolimpio->precio = $request->precio;
        $pollolimpio->venta_1 = $request->venta_1;
        $pollolimpio->venta_2 = $request->venta_2;
        $pollolimpio->venta_3 = $request->venta_3;
        $pollolimpio->venta_4 = $request->venta_4;
        $pollolimpio->venta_5 = $request->venta_5;
        $pollolimpio->venta_6 = $request->venta_6;
        $pollolimpio->save();
        return $pollolimpio;
    }
    public function listaSucursal($sucursal)
    {
        $model =  Pollolimpio::where('estado',1)->get();
        $list = [];
        $sucursal_id = $sucursal;
        foreach($model as $item){
          
            $lista_precios = $item->PollolimpioSucursals()->where('sucursal_id',$sucursal_id)->orderBy('id','desc')->get();
            if($lista_precios->count()>0){
                $item->precio = $lista_precios->first()->precio_cbba;
                $item->venta_1 = $lista_precios->first()->venta_1;
                $item->venta_2 = $lista_precios->first()->precio;
                $item->venta_3 = $lista_precios->first()->venta_3;
                $item->venta_4 = $lista_precios->first()->venta_4;
                $item->venta_5 = $lista_precios->first()->venta_5;
                $item->venta_6 = $lista_precios->first()->venta_6;
            }else{
                $item->venta_2 = $item->venta_2;
            }
            $hoy = Carbon::now();
            $item->cambios = $item->PollolimpioSucursals()->where('sucursal_id',$sucursal_id)->where('fecha','>=',$hoy)->count();
            $item->precio_valor = $item->precio;
            $item->venta_1_valor = $item->venta_1;
            $item->venta_2_valor = $item->venta_2;
            $item->venta_3_valor = $item->venta_3;
            $item->venta_4_valor = $item->venta_4;
            $item->venta_5_valor = $item->venta_5;
            $item->venta_6_valor = $item->venta_6;
            $list[] = $item;
        }
        return $list;
    }
    public function precios(Request $request)
    {
        $cambioPrecio = new PollolimpioCambio();
        $cambioPrecio->sucursal_id = $request->sucursal_id;
        $cambioPrecio->user_id = $request->usuario_id;
        $cambioPrecio->fecha = date('Y-m-d');
        $cambioPrecio->save();
        
      foreach($request->data as $item){
        if($item['precio_valor'] != $item['precio'] || $item['venta_1_valor'] != $item['venta_1'] ||$item['venta_2_valor'] != $item['venta_2']  || $item['venta_3_valor'] != $item['venta_3'] || $item['venta_4_valor'] != $item['venta_4'] || $item['venta_5_valor'] != $item['venta_5'] || $item['venta_6_valor'] != $item['venta_6']){
          $itemPrecio = new PollolimpioSucursal();
          $itemPrecio->pollolimpio_id = $item['id'];
          $itemPrecio->pollolimpio_cambio_id = $cambioPrecio->id;
          $itemPrecio->sucursal_id = $request->sucursal_id;
          $itemPrecio->precio_cbba = $item['precio'];
          $itemPrecio->precio = $item['venta_2_valor'];
          $itemPrecio->precio_anterior = $item['venta_2'];
          $itemPrecio->cambio = $item['cambios']+1;
          
          $itemPrecio->venta_1 = $item['venta_1'];
          $itemPrecio->venta_3 = $item['venta_3'];
          $itemPrecio->venta_4 = $item['venta_4'];
          $itemPrecio->venta_5 = $item['venta_5'];
          $itemPrecio->venta_6 = $item['venta_6'];
          $itemPrecio->fecha = Carbon::now()->addDay();
          $itemPrecio->f = Carbon::now()->format('Y-m-d');
            $itemPrecio->h = Carbon::now()->format('H:i:s');
          $itemPrecio->save();
        }
      }
      $cambioPrecio->url_pdf = url('reportes/pollolimpioCambios/'.$cambioPrecio->id);
      return $cambioPrecio;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pollolimpio  $pollolimpio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pollolimpio $pollolimpio)
    {
        $pollolimpio->estado = 0;
        $pollolimpio->save();
    }
}
