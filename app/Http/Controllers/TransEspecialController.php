<?php

namespace App\Http\Controllers;

use App\Models\TransEspecial;
use App\Models\TransEspecialItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class TransEspecialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return TransEspecial::with(['TransEspecialItems','Item'])->where('estado',1)->get();
    // }
    public function index()
    {
        Log::info('>>> TransEspecialController@index INICIADA');
        $result = TransEspecial::with(['TransEspecialItems', 'Item'])
            ->where('estado', 1)
            ->get();
        Log::info('>>> TransEspecialController@index RESULTADO', [
            'result' => $result->toArray()
        ]);
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
        $transEspecial = new TransEspecial();
        $transEspecial->name = $request->name;
        $transEspecial->save();
        return $transEspecial;
    }

    public function masa(Request $request)
    {

        foreach ($request->transformaciones as $m) {
            $transEspecial = new TransEspecial();
            $transEspecial->name = $m['name'];
            $transEspecial->item_id = $m['item_id'];
            $transEspecial->precio_aprox = $m['precio_aprox'];
            $transEspecial->suma_promedio = $m['suma_promedio'];
            $transEspecial->promedio_item = $m['promedio_item'];
            $transEspecial->suma_precio = $m['suma_precio'];
            $transEspecial->suma_peso = $m['suma_peso'];
            $transEspecial->save();

            foreach ($m['trans_especial_items'] as $d) {
                $transEspecialItem = new TransEspecialItem();
                $transEspecialItem->trans_especial_id = $transEspecial->id;
                $transEspecialItem->item_id = $d['item_id'];
                $transEspecialItem->peso = $d['peso'];
                $transEspecialItem->promedio = $d['promedio'];
                $transEspecialItem->precio = $d['precio'];
                $transEspecialItem->precio_2 = $d['precio_2'];

                // Validar y asignar valores predeterminados para precios alternativos
                $transEspecialItem->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                $transEspecialItem->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                $transEspecialItem->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                $transEspecialItem->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                $transEspecialItem->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;

                // Validar y asignar valores predeterminados para estados
                $transEspecialItem->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                $transEspecialItem->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                $transEspecialItem->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                $transEspecialItem->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                $transEspecialItem->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;

                $transEspecialItem->save();
            }
        }

        // Procesar las transformaciones existentes
        foreach ($request->trans_especials as $m) {
            $transEspecial = TransEspecial::where('id', $m['id'])->get()->first();
            $transEspecial->name = $m['name'];
            $transEspecial->item_id = $m['item_id'];
            $transEspecial->precio_aprox = $m['precio_aprox'];
            $transEspecial->suma_promedio = $m['suma_promedio'];
            $transEspecial->promedio_item = $m['promedio_item'];
            $transEspecial->suma_precio = $m['suma_precio'];
            $transEspecial->suma_peso = $m['suma_peso'];
            $transEspecial->estado = $m['estado'];
            $transEspecial->save();

            foreach ($m['trans_especial_items'] as $d) {
                if (!isset($d['id'])) {
                    $transEspecialItem = new TransEspecialItem();
                    $transEspecialItem->trans_especial_id = $transEspecial->id;
                    $transEspecialItem->item_id = $d['item_id'];
                    $transEspecialItem->peso = $d['peso'];
                    $transEspecialItem->promedio = $d['promedio'];
                    $transEspecialItem->precio = $d['precio'];
                    $transEspecialItem->precio_2 = $d['precio_2'];

                    // Guardar los precios alternativos
                    $transEspecialItem->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                    $transEspecialItem->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                    $transEspecialItem->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                    $transEspecialItem->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                    $transEspecialItem->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;
                    // Guardar los estados de los precios alternativos
                    $transEspecialItem->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                    $transEspecialItem->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                    $transEspecialItem->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                    $transEspecialItem->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                    $transEspecialItem->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;

                    $transEspecialItem->save();
                } else {
                    // Actualización de transEspecialItem (si ya existe)
                    $transEspecialItem = TransEspecialItem::where('id', $d['id'])->get()->first();

                    $transEspecialItem->trans_especial_id = $transEspecial->id;
                    $transEspecialItem->item_id = $d['item_id'];
                    $transEspecialItem->peso = $d['peso'];
                    $transEspecialItem->promedio = $d['promedio'];
                    $transEspecialItem->precio = $d['precio'];
                    $transEspecialItem->precio_2 = $d['precio_2'];

                    // Actualización de los precios alternativos
                    $transEspecialItem->precio_alternativo_1 = isset($d['precio_alternativo_1']) ? $d['precio_alternativo_1'] : 0.00;
                    $transEspecialItem->precio_alternativo_2 = isset($d['precio_alternativo_2']) ? $d['precio_alternativo_2'] : 0.00;
                    $transEspecialItem->precio_alternativo_3 = isset($d['precio_alternativo_3']) ? $d['precio_alternativo_3'] : 0.00;
                    $transEspecialItem->precio_alternativo_4 = isset($d['precio_alternativo_4']) ? $d['precio_alternativo_4'] : 0.00;
                    $transEspecialItem->precio_alternativo_5 = isset($d['precio_alternativo_5']) ? $d['precio_alternativo_5'] : 0.00;
                    // Actualización de los estados de los precios alternativos
                    $transEspecialItem->estado_precio_alternativo_1 = isset($d['estado_precio_alternativo_1']) ? $d['estado_precio_alternativo_1'] : 0;
                    $transEspecialItem->estado_precio_alternativo_2 = isset($d['estado_precio_alternativo_2']) ? $d['estado_precio_alternativo_2'] : 0;
                    $transEspecialItem->estado_precio_alternativo_3 = isset($d['estado_precio_alternativo_3']) ? $d['estado_precio_alternativo_3'] : 0;
                    $transEspecialItem->estado_precio_alternativo_4 = isset($d['estado_precio_alternativo_4']) ? $d['estado_precio_alternativo_4'] : 0;
                    $transEspecialItem->estado_precio_alternativo_5 = isset($d['estado_precio_alternativo_5']) ? $d['estado_precio_alternativo_5'] : 0;
                    $transEspecialItem->estado = isset($d['estado']) ? $d['estado'] : 1;
                    $transEspecialItem->save();
                }
            }
        }

        return [
            'pdf' => url("reportes/transEspecials")
        ];
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransEspecial  $transEspecial
     * @return \Illuminate\Http\Response
     */
    public function show(TransEspecial $transEspecial)
    {

        return $transEspecial;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransEspecial  $transEspecial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransEspecial $transEspecial)
    {
        $transEspecial->name = $request->name;
        $transEspecial->save();
        return $transEspecial;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransEspecial  $transEspecial
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransEspecial $transEspecial)
    {
        $transEspecial->estado = 0;
        $transEspecial->save();
    }
    public function pdf()
    {
        $transEspecial = TransEspecial::with(['TransEspecialItems','Item'])->where('estado',1)->get();

        LOG::info($transEspecial);  
        $pdf = Pdf::loadView('reportes.pdf.cambioPrecios.transEspecial', [

        "transEspecial"=>$transEspecial,
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
