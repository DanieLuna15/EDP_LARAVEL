<?php

namespace App\Http\Controllers;

use App\Exports\TransformacionLoteExport;
use App\Models\Item;
use App\Models\TransformacionLote;
use App\Models\ItemSobraTrans;
use App\Models\Sucursal;
use App\Models\VentaTransformacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
class TransformacionLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionLote::where('estado',1)->get()->each(function($transformacionLote){
            $transformacionLote->excel_url = url("reportes/transformacionLotes-excel/$transformacionLote->id");
        });
    }
    public function store(Request $request)
    {
        $transformacionLote = new TransformacionLote();
        $transformacionLote->nro = $request->nro;
        $transformacionLote->fecha = Carbon::now()->format('Y-m-d');
        $transformacionLote->sucursal_id = $request->sucursal_id;
        $transformacionLote->user_id = $request->user_id;
        $transformacionLote->save();
        return $this->showTransformacionLote($transformacionLote);
    }
    public function showTransformacionLote(TransformacionLote $transformacionLote)
    {
        $transformacionLote->sucursal = $transformacionLote->Sucursal;
        $transformacionLote->mes = $this->mes($transformacionLote->fecha);
        // $pt->url_pdf = url('reportes/pt/'.$pt->id);
        // $pt->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/'.$pt->id);
        // $pt->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/'.$pt->id);
        // $pt->url_peso_total_pdf = url('reportes/pt/peso-total/'.$pt->id);
        // $pt->detalle_pts = $pt->DetallePts;
        // $ingreso_lotes = $pt->DetallePts->each(function ($item, $key) {
        //     $compra = $item->LoteDetalle->Compra;
        //     $item->name = $compra->ProveedorCompra->abreviatura."-".$compra->nro;
        //     $item->cinta = $item->LoteDetalle->producto;
        //     return $item;
        // })->groupBy(['name','cinta']);
        // $lista_ingresos_lotes = [];
        // foreach ($ingreso_lotes as $key => $detalle) {
        //     foreach ($detalle as $k => $value) {
        //         $cajas = $value->sum('cajas');
        //         $pollos = $value->sum('pollos');
        //         $peso_bruto = $value->sum('peso_bruto');
        //         $peso_neto = $value->sum('peso_neto');
        //         $lista_ingresos_lotes[] = [
        //             "lote"=>$key,
        //             "cinta"=>$k,
        //             "cajas" => $cajas,
        //             "pollos" => $pollos,
        //             "peso_bruto" => $peso_bruto,
        //             "peso_neto" => $peso_neto,
        //             "tara"=>$peso_bruto-$peso_neto
        //         ];

        //     }
        // }
        // $pt->reporte_ingresos_lotes = collect($lista_ingresos_lotes);
        return $transformacionLote;
    }

    public function mes($fecha)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }
    public function sucursalCurso(Sucursal $sucursal)
    {
        $pt = TransformacionLote::where('sucursal_id',$sucursal->id)->where([['estado',1],['curso',1]])->get();
        $list = [];
        foreach ($pt as $value) {
            $list[] = $this->showTransformacionLote($value);
        }
        return $list;
    }
    public function sucursalCursoPos(Sucursal $sucursal)
    {
        $transformacionLotes = TransformacionLote::where('sucursal_id',$sucursal->id)->where([['estado',1],['curso',1]])->get();
        $list = [];
        foreach ($transformacionLotes as $transformacionLote) {
            $list[] = $this->detalles($transformacionLote);
        }
        return $list;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionLote  $transformacionLote
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionLote $transformacionLote)
    {

        return $transformacionLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionLote  $transformacionLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionLote $transformacionLote)
    {
        $transformacionLote->name = $request->name;
        $transformacionLote->save();
        return $transformacionLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionLote  $transformacionLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionLote $transformacionLote)
    {
        $transformacionLote->estado = 0;
        $transformacionLote->save();
    }
    public function detalles(TransformacionLote $transformacionLote)
    {
        $transformacionLote->mes = $this->mes($transformacionLote->fecha);
        $detalle_transformacionLote = $transformacionLote->TransformacionLoteDetalles;
        $transformacionLote->cajas_disponibles = $detalle_transformacionLote->sum('cajas');
        $transformacionLote->pollos_disponibles = $detalle_transformacionLote->sum('pollos');
        $transformacionLote->peso_neto_disponibles = $detalle_transformacionLote->sum('peso_neto');
        $transformacionLote->peso_bruto_disponibles = $detalle_transformacionLote->sum('peso_bruto');
        $group_items = $transformacionLote->TransformacionLoteItems()->get()->groupBy('item_id');
        $group_items_pt = $transformacionLote->TransformacionLoteItems()->get()->groupBy(['pt_id']);
        $group_subitems = $transformacionLote->DescomponerTransformacionLotes()->get()->groupBy('subitem_id');
        $descomponer = $transformacionLote->DescomponerTransformacionLotes;
        $items_entregados = $transformacionLote->ItemPtTransformacionLotes()->get();
        $items_entregados_2 = $transformacionLote->ItemPtTransformacionLotes()->get()->groupBy(['pt_id','item_id','encargado']);
        $subitems_list = $transformacionLote->SubItemPtTransformacionLotes()->get()->groupBy(['transformacion_lote_id','subitem_id']);
        $list_items = [];
        $list_items_pt = [];
        $list_subitems = [];
        $list_subitems_lista = [];
        $list_items_entregados = [];


        // $subitems_list = $transformacionLote->SubItemPtTransformacionLotes()->get()->groupBy(['pt_id','subitem_id']);
        foreach ($subitems_list as $porSubitem) {
            foreach ($porSubitem as $subitemId => $coleccion) {
                $coleccion->loadMissing('pt','SubItem');

                $first = $coleccion->first();
                $pt    = $first->pt;
                $sub   = $first->SubItem;

                $sum_cajas      = (int) $coleccion->sum('cajas');
                $sum_peso_bruto = (float) $coleccion->sum('peso_bruto');
                $sum_peso_neto  = (float) $coleccion->sum('peso_neto');

                $venta_transformacion = VentaTransformacion::where('transformacion_id', $transformacionLote->id)
                    ->where('subitem_id', $subitemId)
                    ->where('estado', 1)
                    ->get();

                $cajas_vendidas = (int) $venta_transformacion->sum('cajas');
                $peso_vendido   = (float) $venta_transformacion->sum('peso_bruto');
                $peso_neto_vendido   = (float) $venta_transformacion->sum('peso_neto');

                $cajas_total = max(0, $sum_cajas - $cajas_vendidas);
                $peso_total  = max(0.0, $sum_peso_bruto - $peso_vendido);
                $peso_neto_total  = max(0.0, $sum_peso_neto - $peso_neto_vendido);

                if ($peso_neto_total > 0) {
                    $list_subitems_lista[] = [
                        "pt"               => $pt,
                        "subitem"          => $sub,
                        "total_cajas"      => $cajas_total,
                        "total_peso_bruto" => round($peso_total, 3),
                        "total_peso_neto"  => round($peso_neto_total, 3),
                    ];
                }
            }
        }
        $transformacionLote->lista_subitems_transformacion = $list_subitems_lista;

        foreach ($items_entregados_2 as $pt) {
            foreach ($pt as $item) {
                foreach ($item as $encargado) {
                    $first_element = $encargado->first();
                    $subitems=[];
                    foreach ($encargado as $r) {
                        $r->SubItemPtTransformacionLotes->each(function ($s) use (&$subitems) {
                            $subitems[] = $s->subitem;
                        });
                    }

                    $list_items_entregados[] = [
                        "pt"=>$first_element->pt,
                        "item"=>$first_element->item,
                        "subitems"=>$subitems,
                        "merma_total"=>collect($subitems)->sum('merma'),
                        "encargado"=>$first_element->encargado,
                        "entregados"=>$encargado,
                        "total_cajas"=>$encargado->sum('cajas'),
                        "total_peso_bruto"=>$encargado->sum('peso_bruto'),
                        "total_peso_neto"=>$encargado->sum('peso_neto'),
                    ];

                }

            }
        }
        $transformacionLote->items_entregados_format = $list_items_entregados;
        foreach ($group_items_pt as $m) {
            $pt = $m->first()->Pt;
            $items = $m->groupBy('item_id');
            foreach ($items as $item) {
                $i = $item->first()->Item;
                $entregados = $items_entregados->where('pt_id',$pt->id)->where('item_id',$i->id);
                $cajas_e = $entregados->sum('cajas');
                $peso_bruto_e = sprintf("%.3f", $entregados->sum('peso_bruto'));
                $peso_neto_e = sprintf("%.3f", $entregados->sum('peso_neto'));
                $taras_e = $entregados->sum('taras');
                $cajas = $item->sum('cajas')-$cajas_e;
                $taras = $item->sum('taras')-$taras_e;
                $peso_bruto = $item->sum('peso_bruto')-$peso_bruto_e;
                $peso_neto = $item->sum('peso_neto')-$peso_neto_e;
                $list_items_pt[] = [
                    "pt"=>$pt,
                    "item"=>$i,
                    "cajas"=>$cajas,
                    "taras"=>$taras,
                    "peso_bruto"=>sprintf("%.3f", $peso_bruto),
                    "peso_neto"=>sprintf("%.3f", $peso_neto),
                    "list"=>$item,
                    "entregados"=>$transformacionLote->ItemPtTransformacionLotes()->where('pt_id',$pt->id)->where('item_id',$i->id)->get()->each(function($q){
                        $q->fecha = Carbon::parse($q->fecha)->format('d/m/Y H:i');
                    }),
                    "is_declarado"=>$transformacionLote->ItemPtTransformacionLotes()->where('pt_id',$pt->id)->where('item_id',$i->id)->where('is_declarado',1)->get(),
                    "lista_trozados"=>[]
                ];
            }

        }
        $transformacionLote->items_entregados = $items_entregados;
        $transformacionLote->list_items_pt = $list_items_pt;
        foreach ($group_items as $m) {
            $item = $m->first()->Item;
            $cajas_des = $descomponer->where('item_id',$item->id)->sum('cajas');
            $peso_bruto_des = $descomponer->where('item_id',$item->id)->sum('peso_bruto');
            $peso_neto_des = $descomponer->where('item_id',$item->id)->sum('peso_neto');

            $cajas = $m->sum('cajas')-$cajas_des;
            $taras = $m->sum('taras');
            $peso_bruto = $m->sum('peso_bruto')-$peso_bruto_des;
            $peso_neto = $m->sum('peso_neto')-$peso_neto_des;

            $list_items[] = [
                "item"=>$item,
                "cajas"=>$cajas,
                "taras"=>$taras,
                "peso_bruto"=>$peso_bruto,
                "peso_neto"=>$peso_neto,
                "list"=>$m
            ];
        }
        foreach ($group_subitems as $m) {
            $item = $m->first()->SubItem;

            $cajas = $m->sum('cajas');
            $taras = $m->sum('taras');
            $peso_bruto = $m->sum('peso_bruto');
            $peso_neto = $m->sum('peso_neto');

            $list_subitems[] = [
                "item"=>$item,
                "cajas"=>$cajas,
                "taras"=>$taras,
                "peso_bruto"=>$peso_bruto,
                "peso_neto"=>$peso_neto,
                "list"=>$m
            ];
        }
        $transformacionLote->items = $list_items;
        $items_collection = collect($transformacionLote->items);
        $transformacionLote->sub_items = $list_subitems;

        $transformacionLote->tara_items = $items_collection->sum('taras');
        $transformacionLote->cajas_items = $items_collection->sum('cajas');
        $transformacionLote->peso_bruto_items = $items_collection->sum('peso_bruto');
        $transformacionLote->peso_neto_items = $items_collection->sum('peso_neto');
        $transformacionLote->sub_item_lista = $this->listaSubItems();
        return $transformacionLote;
    }

    // public function detalles(TransformacionLote $transformacionLote)
    // {
    //     $transformacionLote->mes = $this->mes($transformacionLote->fecha);
    //     $detalle_transformacionLote = $transformacionLote->TransformacionLoteDetalles;
    //     $transformacionLote->cajas_disponibles = $detalle_transformacionLote->sum('cajas');
    //     $transformacionLote->pollos_disponibles = $detalle_transformacionLote->sum('pollos');
    //     $transformacionLote->peso_neto_disponibles = $detalle_transformacionLote->sum('peso_neto');
    //     $transformacionLote->peso_bruto_disponibles = $detalle_transformacionLote->sum('peso_bruto');
    //     $group_items = $transformacionLote->TransformacionLoteItems()->get()->groupBy('item_id');
    //     $group_items_pt = $transformacionLote->TransformacionLoteItems()->get()->groupBy(['pt_id']);
    //     $group_subitems = $transformacionLote->DescomponerTransformacionLotes()->get()->groupBy('subitem_id');
    //     $descomponer = $transformacionLote->DescomponerTransformacionLotes;
    //     $items_entregados = $transformacionLote->ItemPtTransformacionLotes()->get();
    //     $items_entregados_2 = $transformacionLote->ItemPtTransformacionLotes()->get()->groupBy(['pt_id', 'item_id', 'encargado']);
    //     $subitems_list = $transformacionLote->SubItemPtTransformacionLotes()->get()->groupBy(['pt_id', 'subitem_id']);
    //     $list_items = [];
    //     $list_items_pt = [];
    //     $list_subitems = [];
    //     $list_subitems_lista = [];
    //     $list_items_entregados = [];
    //     foreach ($subitems_list as $pt) {
    //         foreach ($pt as $item) {
    //             $first_element = $item->first();
    //             $subitem = $first_element->SubItem;
    //             $cajas = $item->sum('cajas');
    //             $venta_transformacion = VentaTransformacion::where('transformacion_id', $transformacionLote->id)->where('subitem_id', $subitem->id)->where('estado', 1)->get();
    //             $cajas_venta_subitem = $venta_transformacion->sum('cajas');
    //             $pesos_venta_subitem = $venta_transformacion->sum('peso_bruto');
    //             $cajas_total = $cajas - $cajas_venta_subitem;
    //             $peso_total = $item->sum('peso_bruto') - $pesos_venta_subitem;
    //             if ($peso_total > 0) {
    //                 $list_subitems_lista[] = [
    //                     "pt" => $first_element->pt,
    //                     "subitem" => $subitem,
    //                     "total_cajas" => $cajas_total,
    //                     "total_peso_bruto" => $peso_total,
    //                     "total_peso_neto" => $item->sum('peso_neto'),
    //                 ];
    //             }
    //         }
    //     }
    //     //esto son las transformaciones que me muestra en el pos 3
    //     $transformacionLote->lista_subitems_transformacion = $list_subitems_lista;

    //     Log::info('[ENTREGADOS_2] Estructura agrupada - resumen', [
    //         'grupos_pt' => $items_entregados_2->keys()->all(), // lista de pt_id
    //         'total_pt'  => $items_entregados_2->count(),
    //     ]);

    //     foreach ($items_entregados_2 as $ptId => $itemsPorItem) {
    //         Log::info('[ENTREGADOS_2] PT', [
    //             'pt_id' => $ptId,
    //             'total_items_distintos' => $itemsPorItem->count(),
    //             'items_ids' => $itemsPorItem->keys()->all(), // item_id por PT
    //         ]);

    //         foreach ($itemsPorItem as $itemId => $porEncargado) {
    //             Log::info('[ENTREGADOS_2] ├─ Item', [
    //                 'pt_id' => $ptId,
    //                 'item_id' => $itemId,
    //                 'total_encargados' => $porEncargado->count(),
    //                 'encargados' => $porEncargado->keys()->all(),
    //             ]);

    //             foreach ($porEncargado as $encargadoNombre => $coleccion) {
    //                 // OJO: para evitar N+1
    //                 $coleccion->loadMissing('SubItemPtTransformacionLotes.subitem', 'pt', 'item');

    //                 $first_element = $coleccion->first();

    //                 // Reúno subitems (pueden repetirse; luego te doy únicos)
    //                 $subitems = [];
    //                 foreach ($coleccion as $r) {
    //                     $r->SubItemPtTransformacionLotes->each(function ($s) use (&$subitems) {
    //                         $subitems[] = $s->subitem;
    //                     });
    //                 }

    //                 $merma_total = collect($subitems)->sum('merma');
    //                 $subitems_ids_unicos = collect($subitems)->pluck('id')->unique()->values()->all();

    //                 $suma_cajas = $coleccion->sum('cajas');
    //                 $suma_pb    = $coleccion->sum('peso_bruto');
    //                 $suma_pn    = $coleccion->sum('peso_neto');

    //                 Log::info('[ENTREGADOS_2] │  ├─ Encargado', [
    //                     'pt_id' => $ptId,
    //                     'item_id' => $itemId,
    //                     'encargado' => $encargadoNombre,
    //                     'filas' => $coleccion->count(),
    //                     'sum_cajas' => $suma_cajas,
    //                     'sum_peso_bruto' => $suma_pb,
    //                     'sum_peso_neto' => $suma_pn,
    //                     'subitems_total' => count($subitems),
    //                     'subitems_ids_unicos' => $subitems_ids_unicos,
    //                     'merma_total' => $merma_total,
    //                     'first_element_ids' => [
    //                         'pt_id' => optional($first_element)->pt_id,
    //                         'item_id' => optional($first_element)->item_id,
    //                     ],
    //                     'first_element_fecha' => optional($first_element)->fecha,
    //                 ]);

    //                 $list_items_entregados[] = [
    //                     "pt"               => $first_element->pt,
    //                     "item"             => $first_element->item,
    //                     "subitems"         => $subitems,
    //                     "merma_total"      => $merma_total,
    //                     "encargado"        => $first_element->encargado,
    //                     "entregados"       => $coleccion,
    //                     "total_cajas"      => $suma_cajas,
    //                     "total_peso_bruto" => $suma_pb,
    //                     "total_peso_neto"  => $suma_pn,
    //                 ];
    //             }
    //         }
    //     }

    //     $transformacionLote->items_entregados_format = $list_items_entregados;

    //     Log::info('[ENTREGADOS_2] Resultado items_entregados_format', [
    //         'registros' => count($list_items_entregados),
    //         'totales_globales' => [
    //             'cajas' => collect($list_items_entregados)->sum('total_cajas'),
    //             'peso_bruto' => collect($list_items_entregados)->sum('total_peso_bruto'),
    //             'peso_neto' => collect($list_items_entregados)->sum('total_peso_neto'),
    //             'merma' => collect($list_items_entregados)->sum('merma_total'),
    //         ],
    //     ]);
    //     foreach ($group_items_pt as $m) {
    //         $pt = $m->first()->Pt;
    //         $items = $m->groupBy('item_id');
    //         foreach ($items as $item) {
    //             $i = $item->first()->Item;
    //             $entregados = $items_entregados->where('pt_id', $pt->id)->where('item_id', $i->id);
    //             $cajas_e = $entregados->sum('cajas');
    //             $peso_bruto_e = sprintf("%.3f", $entregados->sum('peso_bruto'));
    //             $peso_neto_e = sprintf("%.3f", $entregados->sum('peso_neto'));
    //             $taras_e = $entregados->sum('taras');
    //             $cajas = $item->sum('cajas') - $cajas_e;
    //             $taras = $item->sum('taras') - $taras_e;
    //             $peso_bruto = $item->sum('peso_bruto') - $peso_bruto_e;
    //             $peso_neto = $item->sum('peso_neto') - $peso_neto_e;
    //             $list_items_pt[] = [
    //                 "pt" => $pt,
    //                 "item" => $i,
    //                 "cajas" => $cajas,
    //                 "taras" => $taras,
    //                 "peso_bruto" => sprintf("%.3f", $peso_bruto),
    //                 "peso_neto" => sprintf("%.3f", $peso_neto),
    //                 "list" => $item,
    //                 "entregados" => $transformacionLote->ItemPtTransformacionLotes()->where('pt_id', $pt->id)->where('item_id', $i->id)->get()->each(function ($q) {
    //                     $q->fecha = Carbon::parse($q->fecha)->format('d/m/Y H:i');
    //                 }),
    //                 "is_declarado" => $transformacionLote->ItemPtTransformacionLotes()->where('pt_id', $pt->id)->where('item_id', $i->id)->where('is_declarado', 1)->get(),
    //                 "lista_trozados" => []
    //             ];
    //         }
    //     }
    //     $transformacionLote->items_entregados = $items_entregados;
    //     $transformacionLote->list_items_pt = $list_items_pt;
    //     foreach ($group_items as $m) {
    //         $item = $m->first()->Item;
    //         $cajas_des = $descomponer->where('item_id', $item->id)->sum('cajas');
    //         $peso_bruto_des = $descomponer->where('item_id', $item->id)->sum('peso_bruto');
    //         $peso_neto_des = $descomponer->where('item_id', $item->id)->sum('peso_neto');

    //         $cajas = $m->sum('cajas') - $cajas_des;
    //         $taras = $m->sum('taras');
    //         $peso_bruto = $m->sum('peso_bruto') - $peso_bruto_des;
    //         $peso_neto = $m->sum('peso_neto') - $peso_neto_des;

    //         $list_items[] = [
    //             "item" => $item,
    //             "cajas" => $cajas,
    //             "taras" => $taras,
    //             "peso_bruto" => $peso_bruto,
    //             "peso_neto" => $peso_neto,
    //             "list" => $m
    //         ];
    //     }
    //     foreach ($group_subitems as $m) {
    //         $item = $m->first()->SubItem;

    //         $cajas = $m->sum('cajas');
    //         $taras = $m->sum('taras');
    //         $peso_bruto = $m->sum('peso_bruto');
    //         $peso_neto = $m->sum('peso_neto');

    //         $list_subitems[] = [
    //             "item" => $item,
    //             "cajas" => $cajas,
    //             "taras" => $taras,
    //             "peso_bruto" => $peso_bruto,
    //             "peso_neto" => $peso_neto,
    //             "list" => $m
    //         ];
    //     }
    //     $transformacionLote->items = $list_items;
    //     $items_collection = collect($transformacionLote->items);
    //     $transformacionLote->sub_items = $list_subitems;

    //     $transformacionLote->tara_items = $items_collection->sum('taras');
    //     $transformacionLote->cajas_items = $items_collection->sum('cajas');
    //     $transformacionLote->peso_bruto_items = $items_collection->sum('peso_bruto');
    //     $transformacionLote->peso_neto_items = $items_collection->sum('peso_neto');
    //     $transformacionLote->sub_item_lista = $this->listaSubItems();
    //     return $transformacionLote;
    // }
    public function excelstock(TransformacionLote $transformacionLote){
        $transformacionLote = $this->detalles($transformacionLote);
        $transformacionLote2 = new TransformacionLoteExport($transformacionLote);
        return Excel::download($transformacionLote2, "TRANSFORMACION LOTE-{$transformacionLote->id}-{$transformacionLote->fecha}-{$transformacionLote->sucursal->nombre}.xlsx");

    }
    public function listaSubItems()
    {
        return Item::where([['estado',1],['tipo',3]])->get();
    }
    public function cerrarItem(TransformacionLote $transformacionLote, Request $request){
        foreach($transformacionLote->ItemPtTransformacionLotes()->where([['pt_id',$request->pt['id']],['item_id',$request->item['id']]])->get() as $item){
            $item->is_declarado = 1;
            $item->save();
        }
        return $transformacionLote;
    }
   public function cerrar(TransformacionLote $transformacionLote, Request $request)
    {
        //dd($request->lista_subitems_transformacion);
        $transformacionLote->curso = 0;
        $transformacionLote->save();

        foreach($request->lista_subitems_transformacion as $item) {
                $itemSobraTrans = new ItemSobraTrans();
                $itemSobraTrans->trans_id = $transformacionLote->id;
                $itemSobraTrans->item_id = $item['subitem']['id'];
                $itemSobraTrans->cajas = $item['total_cajas'];
                //$itemSobraTrans->taras = $item['taras'];
                $itemSobraTrans->pt_id = $item['pt']['id'];
                $itemSobraTrans->kgb = $item['total_peso_bruto'];
                $itemSobraTrans->kgn = $item['total_peso_neto'];
                $itemSobraTrans->kgn_nuevo = $item['peso_neto_nuevo'] ?? $item['total_peso_neto'];
                $itemSobraTrans->merma = $item['merma'] ?? 0;
                $itemSobraTrans->fecha = Carbon::now()->format('Y-m-d');
                $itemSobraTrans->hora = Carbon::now()->format('H:i:s');
                $itemSobraTrans->dia = "";
                $itemSobraTrans->user_id = $request->user_id;
                $itemSobraTrans->save();
        }

        return $transformacionLote;
    }

}
