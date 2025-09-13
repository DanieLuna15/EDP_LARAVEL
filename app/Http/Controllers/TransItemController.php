<?php

namespace App\Http\Controllers;

use App\Models\TransItem;
use App\Models\TransItemDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
class TransItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return TransItem::with(['TransItemDetalles','Item'])->where('estado',1)->get();
    // }



    public function index()
    {
        Log::info('>>> TransItemController@index INICIADA');
        $result = TransItem::with(['TransItemDetalles', 'Item'])->where('estado', 1)->get();
        Log::info('>>> TransItemController@index RESULTADO', ['result' => $result->toArray()]);
        return $result;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transItem = new TransItem();
        $transItem->name = $request->name;
        $transItem->save();
        return $transItem;
    }
    // public function masa(Request $request)
    // {
    //     foreach ($request->transformaciones as $m) {
    //         $transItem = new TransItem();
    //         $transItem->name = $m['name'];
    //         $transItem->item_id = $m['item_id'];
    //         $transItem->precio = $m['precio'];
    //         $transItem->peso = $m['peso'];
    //         $transItem->promedio = $m['promedio'];
    //         $transItem->suma_promedio = $m['suma_promedio'];
    //         $transItem->promedio_item = $m['promedio_item'];
    //         $transItem->save();
    //         foreach ($m['trans_item_detalles'] as $d) {
    //             $transItemDetalle = new TransItemDetalle();
    //             $transItemDetalle->trans_item_id = $transItem->id;
    //             $transItemDetalle->item_id = $d['item_id'];
    //             $transItemDetalle->peso = $d['peso'];
    //             $transItemDetalle->promedio = $d['promedio'];
    //             $transItemDetalle->precio = $d['precio'];
    //             $transItemDetalle->save();
    //         }
    //     }
    //     foreach ($request->trans_items as $m) {
    //         $transItem = TransItem::where('id',$m['id'])->get()->first();
    //         $transItem->name = $m['name'];
    //         $transItem->item_id = $m['item_id'];
    //         $transItem->precio = $m['precio'];
    //         $transItem->peso = $m['peso'];
    //         $transItem->promedio = $m['promedio'];
    //         $transItem->estado = $m['estado'];
    //         $transItem->suma_promedio = $m['suma_promedio'];
    //         $transItem->promedio_item = $m['promedio_item'];
    //         $transItem->save();

    //         foreach ($m['trans_item_detalles'] as $d) {
    //            if(!isset($d['id'])){
    //             $transItemDetalle = new TransItemDetalle();
    //             $transItemDetalle->trans_item_id = $transItem->id;
    //             $transItemDetalle->item_id = $d['item_id'];
    //             $transItemDetalle->peso = $d['peso'];
    //             $transItemDetalle->promedio = $d['promedio'];
    //             $transItemDetalle->precio = $d['precio'];
    //             $transItemDetalle->save();
    //            }else{
    //             $transItemDetalle = TransItemDetalle::where('id',$d['id'])->get()->first();
    //             $transItemDetalle->item_id = $d['item_id'];
    //             $transItemDetalle->peso = $d['peso'];
    //             $transItemDetalle->promedio = $d['promedio'];
    //             $transItemDetalle->precio = $d['precio'];
    //             $transItemDetalle->estado = $d['estado'];
    //             $transItemDetalle->save();
    //            }
    //         }

    //     }
    //     return [
    //         'pdf'=>url("reportes/transItems")
    //     ];

    // }
    public function masa(Request $request)
    {
        // Guardar nuevas transformaciones
        foreach ($request->transformaciones as $m) {
            $transItem = new TransItem();
            $transItem->name = $m['name'];
            $transItem->item_id = $m['item_id'];
            $transItem->precio = $m['precio'];
            $transItem->peso = $m['peso'];
            $transItem->promedio = $m['promedio'];
            $transItem->suma_promedio = $m['suma_promedio'];
            $transItem->promedio_item = $m['promedio_item'];
            $transItem->save();

            foreach ($m['trans_item_detalles'] as $d) {
                $transItemDetalle = new TransItemDetalle();
                $transItemDetalle->trans_item_id = $transItem->id;
                $transItemDetalle->item_id = $d['item_id'];
                $transItemDetalle->peso = $d['peso'];
                $transItemDetalle->promedio = $d['promedio'];
                $transItemDetalle->precio = $d['precio'];

                // Guardar precios alternativos
                $transItemDetalle->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                $transItemDetalle->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                $transItemDetalle->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                $transItemDetalle->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                $transItemDetalle->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;
                // Guardar los estados de los precios alternativos
                $transItemDetalle->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                $transItemDetalle->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                $transItemDetalle->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                $transItemDetalle->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                $transItemDetalle->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;
                $transItemDetalle->save();
            }
        }

        // Actualizar las transformaciones existentes
        foreach ($request->trans_items as $m) {
            $transItem = TransItem::where('id', $m['id'])->get()->first();
            $transItem->name = $m['name'];
            $transItem->item_id = $m['item_id'];
            $transItem->precio = $m['precio'];
            $transItem->peso = $m['peso'];
            $transItem->promedio = $m['promedio'];
            $transItem->estado = $m['estado'];
            $transItem->suma_promedio = $m['suma_promedio'];
            $transItem->promedio_item = $m['promedio_item'];
            $transItem->save();

            foreach ($m['trans_item_detalles'] as $d) {
                if (!isset($d['id'])) {
                    $transItemDetalle = new TransItemDetalle();
                    $transItemDetalle->trans_item_id = $transItem->id;
                    $transItemDetalle->item_id = $d['item_id'];
                    $transItemDetalle->peso = $d['peso'];
                    $transItemDetalle->promedio = $d['promedio'];
                    $transItemDetalle->precio = $d['precio'];

                    // Guardar precios alternativos
                    $transItemDetalle->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                    $transItemDetalle->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                    $transItemDetalle->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                    $transItemDetalle->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                    $transItemDetalle->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;
                    // Guardar los estados de los precios alternativos
                    $transItemDetalle->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                    $transItemDetalle->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                    $transItemDetalle->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                    $transItemDetalle->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                    $transItemDetalle->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;

                    $transItemDetalle->save();
                } else {
                    // Actualización de los detalles
                    $transItemDetalle = TransItemDetalle::where('id', $d['id'])->get()->first();

                    $transItemDetalle->item_id = $d['item_id'];
                    $transItemDetalle->peso = $d['peso'];
                    $transItemDetalle->promedio = $d['promedio'];
                    $transItemDetalle->precio = $d['precio'];

                    // Actualizar precios alternativos
                    $transItemDetalle->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                    $transItemDetalle->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                    $transItemDetalle->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                    $transItemDetalle->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                    $transItemDetalle->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;
                    // Actualizar estados de precios alternativos
                    $transItemDetalle->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                    $transItemDetalle->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                    $transItemDetalle->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                    $transItemDetalle->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                    $transItemDetalle->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;
                    $transItemDetalle->estado = isset($d['estado']) ? $d['estado'] : 1;  // Asegura que si no se pasa un estado se asigne un valor por defecto
                    $transItemDetalle->save();
                }
            }
        }

        return [
            'pdf' => url("reportes/transItems")
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransItem  $transItem
     * @return \Illuminate\Http\Response
     */
    public function show(TransItem $transItem)
    {

        return $transItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransItem  $transItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransItem $transItem)
    {
        $transItem->name = $request->name;
        $transItem->save();
        return $transItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransItem  $transItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransItem $transItem)
    {
        $transItem->estado = 0;
        $transItem->save();
    }
    public function pdf()
    {

        $transItem = TransItem::with(['TransItemDetalles','Item'])->where('estado',1)->get();

        $pdf = Pdf::loadView('reportes.pdf.cambioPrecios.transItem', [

            "transItem"=>$transItem,

        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
