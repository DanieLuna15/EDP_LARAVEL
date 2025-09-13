<?php

namespace App\Http\Controllers;

use App\Models\CambioPrecio;
use App\Models\File;
use App\Models\Item;
use App\Models\ItemFile;
use App\Models\ItemPrecio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function listaSucursal($sucursal)
    // {
    //     $model =  Item::where('estado',1)->get();
    //     $list = [];
    //     $sucursal_id = $sucursal;
    //     foreach($model as $item){
    //         $item->item_files = $item->ItemFiles()->get()->each(function($file){
    //             $file->path_url = url($file->File->path);
    //         });
    //         $item->image = $item->item_files->first();
    //         $lista_precios = $item->ItemPrecios()->where('sucursal_id',$sucursal_id)->orderBy('id','desc')->get();
    //         if($lista_precios->count()>0){
    //             $item->precio = $lista_precios->first()->precio;
    //         }else{
    //             $item->precio = $item->venta;
    //         }
    //         $hoy = date('Y-m-d');
    //         $item->cambios = $item->ItemPrecios()->where('sucursal_id',$sucursal_id)->where('fecha',$hoy)->count();
    //         $item->precio_valor = $item->precio;
    //         $list[] = $item;
    //     }
    //     return $list;
    // }


public function listaSucursal($sucursal)
{
    Log::info('=== Iniciando listaSucursal para sucursal: ' . $sucursal);

    // Obtener todos los ítems con estado 1
    $model = Item::where('estado', 1)->get();
    Log::info('Items obtenidos: ' . $model->count());

    $list = [];
    $sucursal_id = $sucursal;

    foreach ($model as $item) {
        Log::info('Procesando item: ' . $item->id);

        // Obtener los archivos relacionados con el ítem
        $item->item_files = $item->ItemFiles()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
            Log::info('Archivo relacionado con el ítem: ' . $file->path_url);
        });
        
        // Establecer la imagen principal
        $item->image = $item->item_files->first();
        if ($item->image) {
            Log::info('Imagen del ítem establecida: ' . $item->image->path_url);
        } else {
            Log::info('No se encontró imagen para el ítem.');
        }

        // Obtener precios para la sucursal
        $lista_precios = $item->ItemPrecios()->where('sucursal_id', $sucursal_id)->orderBy('id', 'desc')->get();
        Log::info('Precios encontrados para el ítem: ' . $lista_precios->count());

        // Establecer precio
        if ($lista_precios->count() > 0) {
            $item->precio = $lista_precios->first()->precio;
            Log::info('Precio asignado: ' . $item->precio);
        } else {
            $item->precio = $item->venta;
            Log::info('No se encontraron precios, usando precio de venta: ' . $item->precio);
        }

        // Obtener la cantidad de cambios para hoy
        $hoy = date('Y-m-d');
        $item->cambios = $item->ItemPrecios()->where('sucursal_id', $sucursal_id)->where('fecha', $hoy)->count();
        Log::info('Cantidad de cambios de precio para el día de hoy: ' . $item->cambios);

        // Establecer precio final
        $item->precio_valor = $item->precio;
        Log::info('Precio final asignado al ítem: ' . $item->precio_valor);

        // Agregar el ítem a la lista
        $list[] = $item;
    }

    Log::info('=== Fin de listaSucursal. Lista final de items:', ['items' => $list]);

    return $list;
}

    public function index()
    {
        $model =  Item::where('estado',1)->get();
        $list = [];
        foreach($model as $item){
            $item->item_files = $item->ItemFiles()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $item->image = $item->item_files->first();

            $list[] = $item;
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->venta = $request->venta;
        $item->merma = $request->merma;
        $item->compra = $request->compra;
        $item->tipo = $request->tipo;
        $item->save();
        return $item;
    }
    public function precios(Request $request)
    {
        $cambioPrecio = new CambioPrecio();
        $cambioPrecio->sucursal_id = $request->sucursal_id;
        $cambioPrecio->fecha = date('Y-m-d');
        $cambioPrecio->save();

      foreach($request->data as $item){
        if($item['precio_valor'] != $item['precio']){
          $itemPrecio = new ItemPrecio();
          $itemPrecio->item_id = $item['id'];
          $itemPrecio->cambio_precio_id = $cambioPrecio->id;
          $itemPrecio->sucursal_id = $request->sucursal_id;
          $itemPrecio->precio = $item['precio_valor'];
          $itemPrecio->precio_anterior = $item['precio'];
          $itemPrecio->cambio = $item['cambios']+1;
          $itemPrecio->fecha = date('Y-m-d');
          $itemPrecio->save();
        }
      }
      $cambioPrecio->url_pdf = url('reportes/cambioPrecios/'.$cambioPrecio->id);
      return $cambioPrecio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $item->item_files = $item->ItemFiles()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->merma = $request->merma;
        $item->venta = $request->venta;
        $item->compra = $request->compra;
        $item->tipo = $request->tipo;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->estado = 0;
        $item->save();
    }
    public function image(Request $request,$id)
    {


        $file = $request->file('file')->store('public/items');
        $url = Storage::url($file);

        $fileModel = new File();
        $fileModel->path = $url;
        $fileModel->save();
        $itemFile = new ItemFile();
        $itemFile->file_id = $fileModel->id;
        $itemFile->item_id = $id;
        $itemFile->save();

        return $itemFile;
    }
    public function imageDelete($id)
    {
        $file = ItemFile::find($id);
        $file->estado = 0;
        $file->save();
    }
}
