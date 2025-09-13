<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\ItemPollo;
use App\Models\TransItem;
use App\Models\Pollolimpio;
use Illuminate\Http\Request;
use App\Models\PolloSucursal;
use App\Models\TransEspecial;
use App\Models\ProductoPrecio;
use App\Models\Transformacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
class PolloSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PolloSucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $polloSucursal = new PolloSucursal();
        $polloSucursal->name = $request->name;
        $polloSucursal->save();
        return $polloSucursal;
    }
    public function precio(Request $request)
    {

        $pollo = PolloSucursal::where('sucursal_id',$request->sucursal_id)->get();
        if($pollo->count()>0){
            $pollo = $pollo[0];
            $pollo->precio_cbba = $request->precio_cbba;
            $pollo->precio_lpz = $request->precio_lpz;
            $pollo->peso = $request->peso;
            $pollo->save();
            foreach($request->items as $item){
               $itemPollo = new ItemPollo();
                $itemPollo->pollo_id = $pollo->id;
                $itemPollo->item_id = $item['id'];
                $itemPollo->precio = $item['precio'];
                $itemPollo->precio_cbba = $item['precio_cbba'];
                $itemPollo->precio_lpz = $item['precio_lpz'];
                $itemPollo->peso = $item['peso'];
                $itemPollo->descuento_1 = $item['descuento_1'];
                $itemPollo->descuento_2 = $item['descuento_2'];
                $itemPollo->descuento_3 = $item['descuento_3'];
                $itemPollo->descuento_4 = $item['descuento_4'];

                // Nuevos precios alternativos
                $itemPollo->precio_alternativo_1 = $item['precio_alternativo_1'] ?? null;
                $itemPollo->precio_alternativo_2 = $item['precio_alternativo_2'] ?? null;
                $itemPollo->precio_alternativo_3 = $item['precio_alternativo_3'] ?? null;
                $itemPollo->precio_alternativo_4 = $item['precio_alternativo_4'] ?? null;
                $itemPollo->precio_alternativo_5 = $item['precio_alternativo_5'] ?? null;


                // Nuevos descuentos alternativos
                $itemPollo->descuento_alternativo_1 = $item['descuento_alternativo_1'] ?? null;
                $itemPollo->descuento_alternativo_2 = $item['descuento_alternativo_2'] ?? null;
                $itemPollo->descuento_alternativo_3 = $item['descuento_alternativo_3'] ?? null;
                $itemPollo->descuento_alternativo_4 = $item['descuento_alternativo_4'] ?? null;
                $itemPollo->descuento_alternativo_5 = $item['descuento_alternativo_5'] ?? null;


                // Nuevos estados para los precios alternativos
                $itemPollo->estado_precio_alternativo_1 = $item['estado_precio_alternativo_1'] ?? 0;
                $itemPollo->estado_precio_alternativo_2 = $item['estado_precio_alternativo_2'] ?? 0;
                $itemPollo->estado_precio_alternativo_3 = $item['estado_precio_alternativo_3'] ?? 0;
                $itemPollo->estado_precio_alternativo_4 = $item['estado_precio_alternativo_4'] ?? 0;
                $itemPollo->estado_precio_alternativo_5 = $item['estado_precio_alternativo_5'] ?? 0;


                $itemPollo->save();
            }
            return $pollo;
        } else {
            $polloSucursal = new PolloSucursal();
            $polloSucursal->sucursal_id = $request->sucursal_id;
            $polloSucursal->precio_cbba = $request->precio_cbba;
            $polloSucursal->precio_lpz = $request->precio_lpz;
            $polloSucursal->peso = $request->peso;
            $polloSucursal->save();
            foreach ($request->items as $item) {
                $itemPollo = new ItemPollo();
                $itemPollo->pollo_id = $polloSucursal->id;
                $itemPollo->item_id = $item['id'];
                $itemPollo->precio = $item['precio'];
                $itemPollo->precio_cbba = $item['precio_cbba'];
                $itemPollo->precio_lpz = $item['precio_lpz'];
                $itemPollo->peso = $item['peso'];
                $itemPollo->descuento_1 = $item['descuento_1'];
                $itemPollo->descuento_2 = $item['descuento_2'];
                $itemPollo->descuento_3 = $item['descuento_3'];
                $itemPollo->descuento_4 = $item['descuento_4'];
                // Nuevos precios alternativos
                $itemPollo->precio_alternativo_1 = $item['precio_alternativo_1'] ?? null;
                $itemPollo->precio_alternativo_2 = $item['precio_alternativo_2'] ?? null;
                $itemPollo->precio_alternativo_3 = $item['precio_alternativo_3'] ?? null;
                $itemPollo->precio_alternativo_4 = $item['precio_alternativo_4'] ?? null;
                $itemPollo->precio_alternativo_5 = $item['precio_alternativo_5'] ?? null;
                // Nuevos descuentos alternativos
                $itemPollo->descuento_alternativo_1 = $item['descuento_alternativo_1'] ?? null;
                $itemPollo->descuento_alternativo_2 = $item['descuento_alternativo_2'] ?? null;
                $itemPollo->descuento_alternativo_3 = $item['descuento_alternativo_3'] ?? null;
                $itemPollo->descuento_alternativo_4 = $item['descuento_alternativo_4'] ?? null;
                $itemPollo->descuento_alternativo_5 = $item['descuento_alternativo_5'] ?? null;
                // Nuevos estados para los precios alternativos
                $itemPollo->estado_precio_alternativo_1 = $item['estado_precio_alternativo_1'] ?? 0;
                $itemPollo->estado_precio_alternativo_2 = $item['estado_precio_alternativo_2'] ?? 0;
                $itemPollo->estado_precio_alternativo_3 = $item['estado_precio_alternativo_3'] ?? 0;
                $itemPollo->estado_precio_alternativo_4 = $item['estado_precio_alternativo_4'] ?? 0;
                $itemPollo->estado_precio_alternativo_5 = $item['estado_precio_alternativo_5'] ?? 0;
                $itemPollo->save();
            }
            return $polloSucursal;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolloSucursal  $polloSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(PolloSucursal $polloSucursal)
    {

        return $polloSucursal;
    }
    // public function listaSucursal(Sucursal $sucursal)
    // {
    //     $pollo = PolloSucursal::where('sucursal_id',$sucursal->id)->get();
    //     if($pollo->count()>0){
    //         $pollo = $pollo[0];
    //         $model =  Item::with(['SubItems'])->where([['estado',1],['tipo',2]])->get();
    //         $list = [];
    //         foreach($model as $item){
    //             $item->item_files = $item->ItemFiles()->get()->each(function($file){
    //                 $file->path_url = url($file->File->path);
    //             });
    //             $item->image = $item->item_files->first();
    //             $lista_pollos = $item->ItemPollos()->where('pollo_id',$pollo->id)->orderBy('id','desc')->get();
    //             if($lista_pollos->count()>0){
    //                 $item->precio = $lista_pollos->first()->precio;
    //                 $item->peso = $lista_pollos->first()->peso;
    //                 $item->precio_cbba = $lista_pollos->first()->precio_cbba;
    //                 $item->precio_lpz = $lista_pollos->first()->precio_lpz;
    //                 $item->descuento_1 = $lista_pollos->first()->descuento_1;
    //                 $item->descuento_2 = $lista_pollos->first()->descuento_2;
    //                 $item->descuento_3 = $lista_pollos->first()->descuento_3;
    //                 $item->descuento_4 = $lista_pollos->first()->descuento_4;

    //             }else{
    //                 $item->precio = $item->venta;
    //                 $item->peso = $pollo->peso;
    //                 $item->precio_cbba = $item->venta;
    //                 $item->precio_lpz = $item->venta;

    //             }

    //             $list[] = $item;
    //         }
    //         $pollo->url_pdf = url('reportes/pollo-promedios/'.$sucursal->id);
    //         $pollo->url_pdf_2 = url('reportes/pollo-promedios-preventista/'.$sucursal->id);
    //         $pollo->items = $list;
    //         return $pollo;
    //     }
    //     return [];
    // }

    public function listaSucursal(Sucursal $sucursal)
    {
        $pollo = PolloSucursal::where('sucursal_id', $sucursal->id)->get();
        if ($pollo->count() > 0) {
            $pollo = $pollo[0];
            $model = Item::with(['SubItems'])->where([['estado', 1], ['tipo', 2]])->get();
            $list = [];
            foreach ($model as $item) {
                $item->item_files = $item->ItemFiles()->get()->each(function ($file) {
                    $file->path_url = url($file->File->path);
                });
                $item->image = $item->item_files->first();

                $lista_pollos = $item->ItemPollos()->where('pollo_id', $pollo->id)->orderBy('id', 'desc')->get();

                if ($lista_pollos->count() > 0) {
                    $item->precio = $lista_pollos->first()->precio;
                    $item->peso = $lista_pollos->first()->peso;
                    $item->precio_cbba = $lista_pollos->first()->precio_cbba;
                    $item->precio_lpz = $lista_pollos->first()->precio_lpz;
                    $item->descuento_1 = $lista_pollos->first()->descuento_1;
                    $item->descuento_2 = $lista_pollos->first()->descuento_2;
                    $item->descuento_3 = $lista_pollos->first()->descuento_3;
                    $item->descuento_4 = $lista_pollos->first()->descuento_4;

                    $item->precio_alternativo_1 = $lista_pollos->first()->precio_alternativo_1 ?? null;
                    $item->precio_alternativo_2 = $lista_pollos->first()->precio_alternativo_2 ?? null;
                    $item->precio_alternativo_3 = $lista_pollos->first()->precio_alternativo_3 ?? null;
                    $item->precio_alternativo_4 = $lista_pollos->first()->precio_alternativo_4 ?? null;
                    $item->precio_alternativo_5 = $lista_pollos->first()->precio_alternativo_5 ?? null;

                    $item->descuento_alternativo_1 = $lista_pollos->first()->descuento_alternativo_1 ?? null;
                    $item->descuento_alternativo_2 = $lista_pollos->first()->descuento_alternativo_2 ?? null;
                    $item->descuento_alternativo_3 = $lista_pollos->first()->descuento_alternativo_3 ?? null;
                    $item->descuento_alternativo_4 = $lista_pollos->first()->descuento_alternativo_4 ?? null;
                    $item->descuento_alternativo_5 = $lista_pollos->first()->descuento_alternativo_5 ?? null;

                    $item->estado_precio_alternativo_1 = $lista_pollos->first()->estado_precio_alternativo_1 ?? 0;
                    $item->estado_precio_alternativo_2 = $lista_pollos->first()->estado_precio_alternativo_2 ?? 0;
                    $item->estado_precio_alternativo_3 = $lista_pollos->first()->estado_precio_alternativo_3 ?? 0;
                    $item->estado_precio_alternativo_4 = $lista_pollos->first()->estado_precio_alternativo_4 ?? 0;
                    $item->estado_precio_alternativo_5 = $lista_pollos->first()->estado_precio_alternativo_5 ?? 0;
                } else {
                    $item->precio = $item->venta;
                    $item->peso = $pollo->peso;
                    $item->precio_cbba = $item->venta;
                    $item->precio_lpz = $item->venta;

                    $item->estado_precio_alternativo_1 = 0;
                    $item->estado_precio_alternativo_2 = 0;
                    $item->estado_precio_alternativo_3 = 0;
                    $item->estado_precio_alternativo_4 = 0;
                    $item->estado_precio_alternativo_5 = 0;
                }
                $list[] = $item;
            }

            $pollo->url_pdf = url('reportes/pollo-promedios/' . $sucursal->id);
            $pollo->url_pdf_2 = url('reportes/pollo-promedios-preventista/' . $sucursal->id);
            $pollo->items = $list;
            return $pollo;
        }
        return [];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PolloSucursal  $polloSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PolloSucursal $polloSucursal)
    {
        $polloSucursal->name = $request->name;
        $polloSucursal->save();
        return $polloSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolloSucursal  $polloSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolloSucursal $polloSucursal)
    {
        $polloSucursal->estado = 0;
        $polloSucursal->save();
    }
    // public function pdf(Sucursal $sucursal)
    // {
    //     $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
    //         $file->path_url = url($file->File->path);
    //     });
    //     $sucursal->image = $sucursal->file_sucursals->first();
    //     $productosPrecios = $this->listaProductoPrecio($sucursal->id);
    //     $PolloLimpioSucursal = $this->PolloLimpioSucursal($sucursal->id);
    //     $transformacionSucursal = $this->transformacionSucursal($sucursal->id);
    //     $transItem = TransItem::with(['TransItemDetalles','Item'])->where('estado',1)->get();
    //     $transEspecial = TransEspecial::with(['TransEspecialItems','Item'])->where('estado',1)->get();
    //     $pollo = $this->listaSucursal($sucursal);
    //     $pdf = Pdf::loadView('reportes.pdf.pollos.promedios', [
    //         "pollo"=>$pollo,
    //         "productosPrecios"=>$productosPrecios,
    //         "polloLimpioSucursal"=>$PolloLimpioSucursal,
    //         "transformacionSucursal"=>$transformacionSucursal,
    //         "transItem"=>$transItem,
    //         "transEspecial"=>$transEspecial,
    //     "sucursal"=>$sucursal
    //     ])->setPaper('a4', 'landscape');
    //     return $pdf->stream();
    // }

    public function pdf(Sucursal $sucursal)
    {
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $productosPrecios = $this->listaProductoPrecio($sucursal->id);
        
        $producto = Producto::with('MedidaProductos.SubMedidas')->find(1);
        $orden_cintas = [];
        if ($producto && $producto->medidaProductos && count($producto->medidaProductos)) {
            $sub_medidas = $producto->medidaProductos[0]->subMedidas ?? [];
            foreach ($sub_medidas as $s) {
                $orden_cintas[$s->name] = $s->nro_orden;
            }
        }

        $productosPrecios_list = $productosPrecios;
        if (isset($productosPrecios[0]) && is_array($productosPrecios[0]) && isset($productosPrecios[0][0])) {
            $productosPrecios_list = $productosPrecios[0];
        }

        function getProductName($p)
        {
            if (isset($p["App\\Models\\ProductoPrecio"]["name"])) {
                return $p["App\\Models\\ProductoPrecio"]["name"];
            }
            if (isset($p["name"])) {
                return $p["name"];
            }
            return null;
        }

        if (is_array($productosPrecios_list) && count($productosPrecios_list)) {
            foreach ($productosPrecios_list as $idx => $p) {
                $nombre = getProductName($p);
                $order = $orden_cintas[$nombre] ?? 9999;
                Log::info("[$idx] $nombre => $order");
            }

            usort($productosPrecios_list, function ($a, $b) use ($orden_cintas) {
                $nameA = getProductName($a);
                $nameB = getProductName($b);
                $orderA = $orden_cintas[$nameA] ?? 9999;
                $orderB = $orden_cintas[$nameB] ?? 9999;
                return $orderA <=> $orderB;
            });

            foreach ($productosPrecios_list as $idx => $p) {
                $nombre = getProductName($p);
                $order = $orden_cintas[$nombre] ?? 9999;
                Log::info("[$idx] $nombre => $order");
            }
        }

        if (isset($productosPrecios[0]) && is_array($productosPrecios[0]) && isset($productosPrecios[0][0])) {
            $productosPrecios[0] = $productosPrecios_list;
        } else {
            $productosPrecios = $productosPrecios_list;
        }

        $PolloLimpioSucursal = $this->PolloLimpioSucursal($sucursal->id);
        $transformacionSucursal = $this->transformacionSucursal($sucursal->id);
        $transItem = TransItem::with(['TransItemDetalles', 'Item'])->where('estado', 1)->get();
        $transEspecial = TransEspecial::with(['TransEspecialItems', 'Item'])->where('estado', 1)->get();
        $pollo = $this->listaSucursal($sucursal);

        $pdf = Pdf::loadView('reportes.pdf.pollos.promedios', [
            "pollo" => $pollo,
            "productosPrecios" => $productosPrecios,
            "polloLimpioSucursal" => $PolloLimpioSucursal,
            "transformacionSucursal" => $transformacionSucursal,
            "transItem" => $transItem,
            "transEspecial" => $transEspecial,
            "sucursal" => $sucursal
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }






    // public function pdf_preventista(Sucursal $sucursal)
    // {
    //     $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
    //         $file->path_url = url($file->File->path);
    //     });
    //     $sucursal->image = $sucursal->file_sucursals->first();
    //     $productosPrecios = $this->listaProductoPrecio($sucursal->id);
    //     $PolloLimpioSucursal = $this->PolloLimpioSucursal($sucursal->id);
    //     $transformacionSucursal = $this->transformacionSucursal($sucursal->id);
    //     $transItem = TransItem::with(['TransItemDetalles', 'Item'])->where('estado', 1)->get();
    //     $transEspecial = TransEspecial::with(['TransEspecialItems', 'Item'])->where('estado', 1)->get();
    //     $pollo = $this->listaSucursal($sucursal);
    //     $pdf = Pdf::loadView('reportes.pdf.pollos.promedios_preventrista', [
    //         "pollo" => $pollo,
    //         "productosPrecios" => $productosPrecios,
    //         "polloLimpioSucursal" => $PolloLimpioSucursal,
    //         "transformacionSucursal" => $transformacionSucursal,
    //         "transItem" => $transItem,
    //         "transEspecial" => $transEspecial,
    //         "sucursal" => $sucursal
    //     ])->setPaper('a4', 'landscape');
    //     return $pdf->stream();
    // }


    public function pdf_preventista(Sucursal $sucursal)
    {
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $productosPrecios = $this->listaProductoPrecio($sucursal->id);

        $producto = Producto::with('MedidaProductos.SubMedidas')->find(1);
        $orden_cintas = [];
        if ($producto && $producto->medidaProductos && count($producto->medidaProductos)) {
            $sub_medidas = $producto->medidaProductos[0]->subMedidas ?? [];
            foreach ($sub_medidas as $s) {
                $orden_cintas[$s->name] = $s->nro_orden;
            }
        }


        $getProductName = function ($p) {
            if (isset($p["App\\Models\\ProductoPrecio"]["name"])) {
                return $p["App\\Models\\ProductoPrecio"]["name"];
            }
            if (isset($p["name"])) {
                return $p["name"];
            }
            return null;
        };

        $productosPrecios_list = $productosPrecios;
        if (isset($productosPrecios[0]) && is_array($productosPrecios[0]) && isset($productosPrecios[0][0])) {
            $productosPrecios_list = $productosPrecios[0];
        }

        if (is_array($productosPrecios_list) && count($productosPrecios_list)) {
            foreach ($productosPrecios_list as $idx => $p) {
                $nombre = $getProductName($p);
                $order = $orden_cintas[$nombre] ?? 9999;
                Log::info("[$idx] $nombre => $order");
            }

            usort($productosPrecios_list, function ($a, $b) use ($orden_cintas, $getProductName) {
                $nameA = $getProductName($a);
                $nameB = $getProductName($b);
                $orderA = $orden_cintas[$nameA] ?? 9999;
                $orderB = $orden_cintas[$nameB] ?? 9999;
                return $orderA <=> $orderB;
            });

            foreach ($productosPrecios_list as $idx => $p) {
                $nombre = $getProductName($p);
                $order = $orden_cintas[$nombre] ?? 9999;
                Log::info("[$idx] $nombre => $order");
            }
        }

        if (isset($productosPrecios[0]) && is_array($productosPrecios[0]) && isset($productosPrecios[0][0])) {
            $productosPrecios[0] = $productosPrecios_list;
        } else {
            $productosPrecios = $productosPrecios_list;
        }


        $PolloLimpioSucursal = $this->PolloLimpioSucursal($sucursal->id);
        $transformacionSucursal = $this->transformacionSucursal($sucursal->id);
        $transItem = TransItem::with(['TransItemDetalles', 'Item'])->where('estado', 1)->get();
        $transEspecial = TransEspecial::with(['TransEspecialItems', 'Item'])->where('estado', 1)->get();
        $pollo = $this->listaSucursal($sucursal);

        $pdf = Pdf::loadView('reportes.pdf.pollos.promedios_preventrista', [
            "pollo"=>$pollo,
            "productosPrecios"=>$productosPrecios,
            "polloLimpioSucursal"=>$PolloLimpioSucursal,
            "transformacionSucursal"=>$transformacionSucursal,
            "transItem"=>$transItem,
            "transEspecial"=>$transEspecial,
            "sucursal"=>$sucursal
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function listaProductoPrecio($sucursal)
    {
        $model = ProductoPrecio::where('estado', 1)->get();
        $list = [];
        $sucursal_id = $sucursal;
        foreach ($model as $item) {

            $lista_precios = $item->ProductoPrecioSucursals()->where('sucursal_id', $sucursal_id)->orderBy('id', 'desc')->get();
            if ($lista_precios->count() > 0) {
                $pp = $lista_precios->first();
                $item->venta_1 = $pp->venta_1;
                $item->venta_2 = $pp->precio;
                $item->venta_3 = $pp->venta_3;
                $item->venta_4 = $pp->venta_4;
                $item->venta_5 = $pp->venta_5;
                $item->estado_precio_5 = $pp->estado_precio_5;
                $item->venta_6 = $pp->venta_6;
                $item->estado_precio_6 = $pp->estado_precio_6;
                $item->venta_7 = $pp->venta_7;
                $item->estado_precio_7 = $pp->estado_precio_7;
                $item->venta_8 = $pp->venta_8;
                $item->estado_precio_8 = $pp->estado_precio_8;
                $item->venta_9 = $pp->venta_9;
                $item->estado_precio_9 = $pp->estado_precio_9;

                $item->venta_10 = $pp->venta_10;
                $item->estado_precio_10 = $pp->estado_precio_10;
                $item->venta_11 = $pp->venta_11;
                $item->estado_precio_11 = $pp->estado_precio_11;
                $item->venta_12 = $pp->venta_12;
                $item->estado_precio_12 = $pp->estado_precio_12;
                // Si tienes descuentos
                $item->descuento_1 = $pp->descuento_1;
                $item->descuento_2 = $pp->descuento_2;
                $item->descuento_3 = $pp->descuento_3;
                $item->descuento_4 = $pp->descuento_4;
                $item->descuento_5 = $pp->descuento_5;
                $item->descuento_6 = $pp->descuento_6;
                $item->descuento_7 = $pp->descuento_7;
                $item->descuento_8 = $pp->descuento_8;
                $item->descuento_9 = $pp->descuento_9;
                $item->descuento_10 = $pp->descuento_10;
                
                $item->descuento_11 = $pp->descuento_11;
                $item->descuento_12 = $pp->descuento_12;
                $item->descuento_13 = $pp->descuento_13;
            } else {
                // Valores por defecto
                $item->venta_2 = $item->venta_2;
            }
            $hoy = Carbon::now();
            $item->cambios = $item->ProductoPrecioSucursals()
                ->where('sucursal_id', $sucursal_id)
                ->where('fecha', '>=', $hoy)
                ->count();
            $item->venta_2_valor = $item->venta_2;
            $list[] = $item;
        }
        return $list;
    }

    public function PolloLimpioSucursal($sucursal)
    {
        $model =  Pollolimpio::where('estado',1)->get();
        $list = [];
        $sucursal_id = $sucursal;
        foreach($model as $item){

            $lista_precios = $item->PollolimpioSucursals()->where('sucursal_id',$sucursal_id)->orderBy('id','desc')->get();
            if($lista_precios->count()>0){
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
            $item->venta_2_valor = $item->venta_2;
            $list[] = $item;
        }
        return $list;
    }
    public function transformacionSucursal($sucursal)
    {
        $model =  Transformacion::where('estado',1)->get();
        $list = [];
        $sucursal_id = $sucursal;
        foreach($model as $item){
            $item->transformacion_item = $item->TransformacionItem;
            $item->transformacion_sucursal = $item->TransformacionSucursal()->where('sucursal_id',$sucursal_id)->first();
            if($item->transformacion_sucursal){
                $item->transformacion_item->peso = $item->transformacion_sucursal->peso;
                $item->transformacion_item->precio = $item->transformacion_sucursal->precio;
                $item->transformacion_item->promedio = $item->transformacion_sucursal->promedio;
            }
            $item->detalles = $item->TransformacionDetalles()->get()->each(function($detalle) use ($sucursal_id){
                $precio = $detalle->TransformacionDetalleSucursals()->where('sucursal_id',$sucursal_id);
                if($precio->count() > 0){
                    $detalle->precio = $precio->first()->precio;
                    $detalle->promedio = $precio->first()->promedio;
                    $detalle->peso = $precio->first()->peso;

                }

            });
            $list[] = $item;
        }
        return $list;
    }
}
