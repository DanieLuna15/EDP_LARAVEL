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
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EnviarItemPtTransformacion;

class TransformacionLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionLote::where('estado', 1)->get()->each(function ($transformacionLote) {
            $transformacionLote->excel_url = url("reportes/transformacionLotes-excel/$transformacionLote->id");
            $transformacionLote->url_peso_total_pdf = url("reportes/transformacionLotes-peso-total/$transformacionLote->id");
            $transformacionLote->url_trans_venta_reporte_pdf = url("reportes/transformacionLotes-movimientos/$transformacionLote->id");
            $transformacionLote->url_trans_reporte_general_pdf = url("reportes/transformacionLotes-general/$transformacionLote->id");
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
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }
    public function sucursalCurso(Sucursal $sucursal)
    {
        $pt = TransformacionLote::where('sucursal_id', $sucursal->id)
            ->where([['estado', 1], ['curso', 1]])
            ->get();
        $list = [];
        foreach ($pt as $value) {
            $transformacionLote = $this->showTransformacionLote($value);
            $transformacionLote->url_peso_total_pdf = url("reportes/transformacionLotes-peso-total/$transformacionLote->id");
            $list[] = $transformacionLote;
        }
        return $list;
    }


    public function sucursalCursoPos(Sucursal $sucursal)
    {
        $transformacionLotes = TransformacionLote::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
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
        $items_entregados_2 = $transformacionLote->ItemPtTransformacionLotes()->get()->groupBy(['pt_id', 'item_id', 'encargado']);
        $subitems_list = $transformacionLote->SubItemPtTransformacionLotes()->get()->groupBy(['transformacion_lote_id', 'subitem_id']);
        $list_items = [];
        $list_items_pt = [];
        $list_subitems = [];
        $list_subitems_lista = [];
        $list_items_entregados = [];


        // $subitems_list = $transformacionLote->SubItemPtTransformacionLotes()->get()->groupBy(['pt_id','subitem_id']);

        foreach ($subitems_list as $porSubitem) {
            foreach ($porSubitem as $subitemId => $coleccion) {
                $coleccion->loadMissing('pt', 'SubItem');

                $first = $coleccion->first();
                $pt    = $first->pt;
                $sub   = $first->SubItem;

                $sum_cajas      = (int) $coleccion->sum('cajas');
                $sum_peso_bruto = (float) $coleccion->sum('peso_bruto');
                $sum_taras = (int) $coleccion->sum('taras');
                $sum_peso_neto  = (float) $coleccion->sum('peso_neto');

                $venta_transformacion = VentaTransformacion::where('transformacion_id', $transformacionLote->id)
                    ->where('subitem_id', $subitemId)
                    ->where('estado', 1)
                    ->get();

                $cajas_vendidas = (int) $venta_transformacion->sum('cajas');
                $peso_vendido   = (float) $venta_transformacion->sum('peso_bruto');
                $taras_vendidas = (int) $venta_transformacion->sum('taras');
                $peso_neto_vendido   = (float) $venta_transformacion->sum('peso_neto');

                $cajas_total = max(0, $sum_cajas - $cajas_vendidas);
                $peso_total  = max(0.0, $sum_peso_bruto - $peso_vendido);
                $taras_total = max(0, $sum_taras - $taras_vendidas);
                $peso_neto_total  = max(0.0, $sum_peso_neto - $peso_neto_vendido);


                if ($peso_neto_total > 0) {
                    $list_subitems_lista[] = [
                        "pt"               => $pt,
                        "subitem"          => $sub,
                        "total_cajas"      => $cajas_total,
                        "total_peso_bruto" => (float) number_format($peso_total, 3, '.', ''),
                        "total_taras"      => $taras_total,
                        "total_peso_neto"  => (float) number_format($peso_neto_total, 3, '.', ''),
                    ];
                }
            }
        }

        $transformacionLote->lista_subitems_transformacion = $list_subitems_lista;


        foreach ($items_entregados_2 as $pt) {
            foreach ($pt as $item) {
                foreach ($item as $encargado) {
                    $first_element = $encargado->first();
                    $subitems = [];
                    foreach ($encargado as $r) {
                        $r->SubItemPtTransformacionLotes->each(function ($s) use (&$subitems) {
                            $subitems[] = $s->subitem;
                        });
                    }

                    $list_items_entregados[] = [
                        "pt" => $first_element->pt,
                        "item" => $first_element->item,
                        "subitems" => $subitems,
                        "merma_total" => collect($subitems)->sum('merma'),
                        "encargado" => $first_element->encargado,
                        "entregados" => $encargado,
                        "total_cajas" => $encargado->sum('cajas'),
                        "total_peso_bruto" => $encargado->sum('peso_bruto'),
                        "total_peso_neto" => $encargado->sum('peso_neto'),
                    ];
                }
            }
        }
        $transformacionLote->items_entregados_format = $list_items_entregados;


        $declaradosByEntregado = collect($subitems_list)
            ->flatMap(fn($bySubitem) => collect($bySubitem)->flatMap(fn($coleccion) => $coleccion))
            ->groupBy('item_pt_transformacion_lote_id')
            ->map(function ($rows) {
                return (object) [
                    'cajas'      => (int)   $rows->sum('cajas'),
                    'peso_bruto' => (float) $rows->sum('peso_bruto'),
                    'peso_neto'  => (float) $rows->sum('peso_neto'),
                    'taras'      => (int)   $rows->sum('taras'),
                ];
            });

        foreach ($group_items_pt as $m) {
            $pt = $m->first()->Pt;
            $items = $m->groupBy('item_id');
            foreach ($items as $item) {
                $i = $item->first()->Item;
                $entregados = $items_entregados->where('pt_id', $pt->id)->where('item_id', $i->id);
                $cajas_e = $entregados->sum('cajas');
                $peso_bruto_e = sprintf("%.3f", $entregados->sum('peso_bruto'));
                $peso_neto_e = sprintf("%.3f", $entregados->sum('peso_neto'));
                $taras_e = $entregados->sum('taras');
                $cajas = max(0, $item->sum('cajas') - $cajas_e);
                $taras = max(0, $item->sum('tara') - $taras_e);
                $peso_bruto = max(0.000, $item->sum('peso_bruto') - $peso_bruto_e);
                $peso_neto = max(0.000, $item->sum('peso_neto') - $peso_neto_e);

                //if ($peso_neto > 0) {
                $list_items_pt[] = [
                    "pt" => $pt,
                    "item" => $i,
                    "cajas" => $cajas,
                    "taras" => $taras,
                    "peso_bruto" => sprintf("%.3f", $peso_bruto),
                    "peso_neto" => sprintf("%.3f", $peso_neto),
                    "list" => $item,
                    "entregados" => $transformacionLote->ItemPtTransformacionLotes()
                        ->where('pt_id', $pt->id)
                        ->where('item_id', $i->id)
                        ->get()
                        ->each(function ($q) use ($declaradosByEntregado) {
                            $d = $declaradosByEntregado->get($q->id);
                            $q->cajas      = max(0,   (int)   $q->cajas      - (int)   optional($d)->cajas);
                            $q->peso_bruto = (float) number_format(max(0.000, (float) $q->peso_bruto - (float) optional($d)->peso_bruto), 3, '.', '');
                            $q->taras      = (float) number_format(max(0.000, (float) $q->taras - (float) optional($d)->taras), 3, '.', '');
                            $q->peso_neto  = (float) number_format(max(0.000, (float) $q->peso_neto - (float) optional($d)->peso_neto), 3, '.', '');

                            $q->fecha = Carbon::parse($q->created_at)->format('d/m/Y H:i:s');
                        }),
                    "is_declarado" => $transformacionLote->ItemPtTransformacionLotes()->where('pt_id', $pt->id)->where('item_id', $i->id)->where('is_declarado', 1)->get(),
                    "lista_trozados" => []
                ];
                //}
            }
        }

        $transformacionLote->items_entregados = $items_entregados;
        $transformacionLote->list_items_pt = $list_items_pt;
        foreach ($group_items as $m) {
            $item = $m->first()->Item;
            $cajas_des = $descomponer->where('item_id', $item->id)->sum('cajas');
            $peso_bruto_des = $descomponer->where('item_id', $item->id)->sum('peso_bruto');
            $peso_neto_des = $descomponer->where('item_id', $item->id)->sum('peso_neto');

            $cajas = $m->sum('cajas') - $cajas_des;
            $taras = $m->sum('taras');
            $peso_bruto = $m->sum('peso_bruto') - $peso_bruto_des;
            $peso_neto = $m->sum('peso_neto') - $peso_neto_des;

            $list_items[] = [
                "item" => $item,
                "cajas" => $cajas,
                "taras" => $taras,
                "peso_bruto" => $peso_bruto,
                "peso_neto" => $peso_neto,
                "list" => $m
            ];
        }
        foreach ($group_subitems as $m) {
            $item = $m->first()->SubItem;

            $cajas = $m->sum('cajas');
            $taras = $m->sum('taras');
            $peso_bruto = $m->sum('peso_bruto');
            $peso_neto = $m->sum('peso_neto');

            $list_subitems[] = [
                "item" => $item,
                "cajas" => $cajas,
                "taras" => $taras,
                "peso_bruto" => $peso_bruto,
                "peso_neto" => $peso_neto,
                "list" => $m
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
    public function excelstock(TransformacionLote $transformacionLote)
    {
        $transformacionLote = $this->detalles($transformacionLote);
        $transformacionLote2 = new TransformacionLoteExport($transformacionLote);
        return Excel::download($transformacionLote2, "TRANSFORMACION LOTE-{$transformacionLote->id}-{$transformacionLote->fecha}-{$transformacionLote->sucursal->nombre}.xlsx");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionLote  $transformacionLote
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionLote $transformacionLote)
    {
        $transformacionLote = $this->detalles($transformacionLote);
        $this->hydrateInicialTransformacion($transformacionLote);
        $this->hydrateSubDescomp($transformacionLote);
        $this->hydrateTraspasosAceptadosDesdeTrans($transformacionLote);
        $this->hydrateTotalesSubitemConTraspaso($transformacionLote);
        $this->hydrateBalanceFinal($transformacionLote);
        return $transformacionLote;
    }

    protected function hydrateInicialTransformacion(TransformacionLote $t): void
    {
        $t->loadMissing([
            'TransformacionLoteItems.Item',
            'TransformacionLoteItems.Pt',
        ]);
        $aceptados = $t->TransformacionLoteItems;
        $pairs = $aceptados
            ->map(fn($r) => ['pt_id' => $r->pt_id, 'item_id' => $r->item_id])
            ->unique(fn($p) => ($p['pt_id'] ?? '0') . '-' . ($p['item_id'] ?? '0'))
            ->values();

        $ptIds   = $pairs->pluck('pt_id')->filter()->unique()->values();
        $itemIds = $pairs->pluck('item_id')->filter()->unique()->values();

        $enviados = EnviarItemPtTransformacion::with('User')
            ->whereIn('pt_id', $ptIds)
            ->whereIn('item_id', $itemIds)
            ->where('is_aceptado', 1)
            ->get();

        $enviadosIdx = $enviados
            ->sortByDesc(fn($e) => $e->fecha_hora ?? $e->created_at)
            ->groupBy(fn($e) => ($e->pt_id ?? '0') . '-' . ($e->item_id ?? '0'))
            ->map->first();

        $rows_aceptados = $aceptados
            ->sortBy('fecha_hora')
            ->values()
            ->map(function ($r) use ($enviadosIdx) {
                $tara = (float)($r->tara ?? ($r->peso_bruto - $r->peso_neto));
                $key  = ($r->pt_id ?? '0') . '-' . ($r->item_id ?? '0');

                $enviar  = $enviadosIdx->get($key);
                $usuario = optional(optional($enviar)->User)->nombre ?? '-';

                return [
                    'fecha'      => $r->created_at,
                    'pt_nro'     => optional($r->Pt)->nro,
                    'item_name'  => optional($r->Item)->name,
                    'usuario'    => $usuario,
                    'cajas'      => (int)   $r->cajas,
                    'kg_bruto'   => (float) $r->peso_bruto,
                    'tara'       => (float) $tara,
                    'kg_neto'    => (float) $r->peso_neto,
                ];
            });

        $totales_aceptados = [
            'cajas'     => (int)   $rows_aceptados->sum('cajas'),
            'kg_bruto'  => (float) $rows_aceptados->sum('kg_bruto'),
            'tara'      => (float) $rows_aceptados->sum('tara'),
            'kg_neto'   => (float) $rows_aceptados->sum('kg_neto'),
        ];

        $t->inicial_listado_aceptados = [
            'rows'    => $rows_aceptados,
            'totales' => $totales_aceptados,
        ];

        $t->inicial_resumen = [
            'aceptados' => $totales_aceptados,
            'totales'   => $totales_aceptados,
        ];


        $rows_aceptados = $aceptados
            ->sortBy('fecha_hora')
            ->values()
            ->map(function ($r) use ($enviadosIdx) {
                $tara = (float)($r->tara ?? ($r->peso_bruto - $r->peso_neto));
                $key  = ($r->pt_id ?? '0') . '-' . ($r->item_id ?? '0');

                $enviar  = $enviadosIdx->get($key);
                $usuario = optional(optional($enviar)->User)->nombre ?? '-';

                return [
                    'fecha'      => $r->created_at,
                    'pt_id'      => $r->pt_id,                 // <-- necesario para agrupar
                    'pt_nro'     => optional($r->Pt)->nro,
                    'item_id'    => $r->item_id,               // <-- necesario para agrupar
                    'item_name'  => optional($r->Item)->name,
                    'usuario'    => $usuario,
                    'cajas'      => (int)   $r->cajas,
                    'kg_bruto'   => (float) $r->peso_bruto,
                    'tara'       => (float) $tara,
                    'kg_neto'    => (float) $r->peso_neto,
                ];
            });

        $totales_aceptados = [
            'cajas'     => (int)   $rows_aceptados->sum('cajas'),
            'kg_bruto'  => (float) $rows_aceptados->sum('kg_bruto'),
            'tara'      => (float) $rows_aceptados->sum('tara'),
            'kg_neto'   => (float) $rows_aceptados->sum('kg_neto'),
        ];

        $t->inicial_listado_aceptados = [
            'rows'    => $rows_aceptados,
            'totales' => $totales_aceptados,
        ];

        $t->inicial_resumen = [
            'aceptados' => $totales_aceptados,
            'totales'   => $totales_aceptados,
        ];

        // --- TOTALES SOLO POR (PT, ITEM) ---
        $totalesPorPtItem = $rows_aceptados
            ->groupBy(fn($r) => ($r['pt_id'] ?? '0') . '-' . ($r['item_id'] ?? '0'))
            ->map(function ($grp) {
                $first = $grp->first();
                return [
                    'pt_id'     => $first['pt_id'],
                    'pt_nro'    => $first['pt_nro'],
                    'item_id'   => $first['item_id'],
                    'item_name' => $first['item_name'],
                    'cajas'     => (int)   $grp->sum('cajas'),
                    'kg_bruto'  => (float) $grp->sum('kg_bruto'),
                    'tara'      => (float) $grp->sum('tara'),
                    'kg_neto'   => (float) $grp->sum('kg_neto'),
                ];
            })
            ->values()
            ->sortBy([
                fn($a, $b) => (int)($a['pt_nro'] ?? 0) <=> (int)($b['pt_nro'] ?? 0),
                fn($a, $b) => strcasecmp($a['item_name'] ?? '', $b['item_name'] ?? ''),
            ])
            ->values();

        $t->inicial_totales_por_pt_item = $totalesPorPtItem;

        $t->inicial_totales_por_pt_item_sum = [
            'cajas'    => (int)   $totalesPorPtItem->sum('cajas'),
            'kg_bruto' => (float) $totalesPorPtItem->sum('kg_bruto'),
            'tara'     => (float) $totalesPorPtItem->sum('tara'),
            'kg_neto'  => (float) $totalesPorPtItem->sum('kg_neto'),
        ];
    }

    protected function hydrateSubDescomp(TransformacionLote $t): void
    {
        $t->loadMissing([
            'ItemPtTransformacionLotes.Item',
            'ItemPtTransformacionLotes.Pt',
            'ItemPtTransformacionLotes.SubItemPtTransformacionLotes.SubItem',
        ]);

        $entregas = $t->ItemPtTransformacionLotes;
        $gruposPtItem = $entregas
            ->groupBy(fn($r) => ($r->pt_id ?? '0') . '-' . ($r->item_id ?? '0'))
            ->map(function ($grp) {
                $first = $grp->first();

                $tot_ent = [
                    'cajas'    => (int)   $grp->sum('cajas'),
                    'kg_bruto' => (float) $grp->sum('peso_bruto'),
                    'tara'     => (float) $grp->sum('taras'),
                    'kg_neto'  => (float) $grp->sum('peso_neto'),
                ];

                // Desglose por encargado
                $porEncargado = $grp->groupBy('encargado')->map(function ($rows) {
                    // Totales entregados de este encargado
                    $ent_cajas    = (int)   $rows->sum('cajas');
                    $ent_bruto    = (float) $rows->sum('peso_bruto');
                    $ent_tara     = (float) $rows->sum('taras');
                    $ent_neto     = (float) $rows->sum('peso_neto');

                    $subs = $rows
                        ->flatMap(fn($r) => $r->SubItemPtTransformacionLotes)
                        ->groupBy('subitem_id')
                        ->map(function ($g) {
                            $f = $g->first();
                            return [
                                'fecha'      => $f->created_at,
                                'subitem_id' => $f->subitem_id,
                                'subitem'    => optional($f->SubItem)->name,
                                'cajas'      => (int)   $g->sum('cajas'),
                                'kg_bruto'   => (float) $g->sum('peso_bruto'),
                                'tara'       => (float) $g->sum('taras'),
                                'kg_neto'    => (float) $g->sum('peso_neto'),
                            ];
                        })
                        ->values()
                        ->sortBy('fecha')
                        ->values();

                    $tot_subs = [
                        'cajas'    => (int)   $subs->sum('cajas'),
                        'kg_bruto' => (float) $subs->sum('kg_bruto'),
                        'tara'     => (float) $subs->sum('tara'),
                        'kg_neto'  => (float) $subs->sum('kg_neto'),
                    ];

                    // Merma para este encargado (diferencia contra lo entregado)
                    $merma = [
                        'cajas'    => max(0,   $ent_cajas - $tot_subs['cajas']),
                        'kg_bruto' => max(0.0, $ent_bruto - $tot_subs['kg_bruto']),
                        'tara'     => max(0.0, $ent_tara  - $tot_subs['tara']),
                        'kg_neto'  => max(0.0, $ent_neto  - $tot_subs['kg_neto']),
                    ];

                    return [
                        'encargado'       => (string) ($rows->first()->encargado ?? 'S/N'),
                        'entregado'       => ['cajas' => $ent_cajas, 'kg_bruto' => $ent_bruto, 'tara' => $ent_tara, 'kg_neto' => $ent_neto],
                        'subitems'        => $subs,
                        'totales_subitem' => $tot_subs,
                        'merma'           => $merma,
                    ];
                })->values();

                // Totales subitems (sumando todos los encargados)
                $tot_subitems_all = [
                    'cajas'    => (int)   $porEncargado->sum(fn($e) => $e['totales_subitem']['cajas']),
                    'kg_bruto' => (float) $porEncargado->sum(fn($e) => $e['totales_subitem']['kg_bruto']),
                    'tara'     => (float) $porEncargado->sum(fn($e) => $e['totales_subitem']['tara']),
                    'kg_neto'  => (float) $porEncargado->sum(fn($e) => $e['totales_subitem']['kg_neto']),
                ];

                // Merma total (PT, ITEM)
                $merma_total = [
                    'cajas'    => max(0,   $tot_ent['cajas']    - $tot_subitems_all['cajas']),
                    'kg_bruto' => max(0.0, $tot_ent['kg_bruto'] - $tot_subitems_all['kg_bruto']),
                    'tara'     => max(0.0, $tot_ent['tara']     - $tot_subitems_all['tara']),
                    'kg_neto'  => max(0.0, $tot_ent['kg_neto']  - $tot_subitems_all['kg_neto']),
                ];

                return [
                    'pt_id'     => $first->pt_id,
                    'pt_nro'    => optional($first->Pt)->nro,
                    'item_id'   => $first->item_id,
                    'item_name' => optional($first->Item)->name,
                    'entregado' => $tot_ent,
                    'encargados' => $porEncargado,
                    'subitems_totales' => $tot_subitems_all,
                    'merma_total'      => $merma_total,
                ];
            })
            ->values()
            ->sortBy([
                fn($a, $b) => (int)($a['pt_nro'] ?? 0) <=> (int)($b['pt_nro'] ?? 0),
                fn($a, $b) => strcasecmp($a['item_name'] ?? '', $b['item_name'] ?? ''),
            ])
            ->values();

        $t->subdescomp_por_pt_item = $gruposPtItem;

        // Resumen global (opcional)
        $t->subdescomp_resumen_global = [
            'entregado' => [
                'cajas'    => (int)   $gruposPtItem->sum(fn($g) => $g['entregado']['cajas']),
                'kg_bruto' => (float) $gruposPtItem->sum(fn($g) => $g['entregado']['kg_bruto']),
                'tara'     => (float) $gruposPtItem->sum(fn($g) => $g['entregado']['tara']),
                'kg_neto'  => (float) $gruposPtItem->sum(fn($g) => $g['entregado']['kg_neto']),
            ],
            'subitems'  => [
                'cajas'    => (int)   $gruposPtItem->sum(fn($g) => $g['subitems_totales']['cajas']),
                'kg_bruto' => (float) $gruposPtItem->sum(fn($g) => $g['subitems_totales']['kg_bruto']),
                'tara'     => (float) $gruposPtItem->sum(fn($g) => $g['subitems_totales']['tara']),
                'kg_neto'  => (float) $gruposPtItem->sum(fn($g) => $g['subitems_totales']['kg_neto']),
            ],
            'merma'     => [
                'cajas'    => (int)   $gruposPtItem->sum(fn($g) => $g['merma_total']['cajas']),
                'kg_bruto' => (float) $gruposPtItem->sum(fn($g) => $g['merma_total']['kg_bruto']),
                'tara'     => (float) $gruposPtItem->sum(fn($g) => $g['merma_total']['tara']),
                'kg_neto'  => (float) $gruposPtItem->sum(fn($g) => $g['merma_total']['kg_neto']),
            ],
        ];


        // ---- TOTALES GLOBALES POR SUBITEM (listado de items descompuestos) ----
        $allSubs = $t->ItemPtTransformacionLotes
            ->flatMap(fn($r) => $r->SubItemPtTransformacionLotes);

        $totalesPorSubitem = $allSubs
            ->groupBy('subitem_id')
            ->map(function ($grp) {
                $f = $grp->first();
                return [
                    'subitem_id' => $f->subitem_id,
                    'subitem'    => optional($f->SubItem)->name,
                    'cajas'      => (int)   $grp->sum('cajas'),
                    'kg_bruto'   => (float) $grp->sum('peso_bruto'),
                    'tara'       => (float) $grp->sum('taras'),
                    'kg_neto'    => (float) $grp->sum('peso_neto'),
                    'conteo'     => (int)   $grp->count(), // opcional: cantidad de registros
                ];
            })
            ->values()
            ->sortBy(fn($x) => mb_strtolower($x['subitem'] ?? ''))
            ->values();

        $t->subdescomp_totales_por_subitem = $totalesPorSubitem;

        $t->subdescomp_totales_por_subitem_sum = [
            'cajas'    => (int)   $totalesPorSubitem->sum('cajas'),
            'kg_bruto' => (float) $totalesPorSubitem->sum('kg_bruto'),
            'tara'     => (float) $totalesPorSubitem->sum('tara'),
            'kg_neto'  => (float) $totalesPorSubitem->sum('kg_neto'),
        ];
    }

    protected function hydrateTraspasosAceptadosDesdeTrans(TransformacionLote $t): void
    {
        $tras = ItemSobraTrans::with([
            'Item:id,name',
            'TransformacionLote:id,nro',
            'User:id,nombre',
        ])
            ->where('trans_secundario_id', $t->id)
            ->where('aceptado', 1)
            ->orderBy('updated_at')
            ->orderBy('created_at')
            ->get();

        $rows = $tras->map(function ($r) {
            $tara = (float) ($r->taras ?? max(0, (float)$r->kgb - (float)$r->kgn_nuevo));
            return [
                'fecha'       => $r->updated_at ?? $r->created_at,
                'trans_nro'   => optional($r->TransformacionLote)->nro,
                'item_name'   => optional($r->Item)->name,
                'usuario'     => $r->user_nombre ?? optional($r->User)->nombre ?? '-',
                'cajas'       => (int)   $r->cajas,
                'kg_bruto'    => (float) $r->kgb,
                'tara'        => (float) $tara,
                'kg_neto'     => (float) $r->kgn_nuevo,

                'subitem_id'  => (int) $r->item_id,
                'subitem'     => optional($r->Item)->name,
            ];
        });

        $t->traspasos_trans_aceptados = [
            'rows' => $rows,
            'totales' => [
                'cajas'    => (int)   $rows->sum('cajas'),
                'kg_bruto' => (float) $rows->sum('kg_bruto'),
                'tara'     => (float) $rows->sum('tara'),
                'kg_neto'  => (float) $rows->sum('kg_neto'),
            ],
        ];

        $t->traspasos_totales_por_subitem = $rows
            ->groupBy('subitem_id')
            ->map(function ($g) {
                $f = $g->first();
                return [
                    'subitem_id' => $f['subitem_id'],
                    'subitem'    => $f['subitem'],
                    'cajas'      => (int)   $g->sum('cajas'),
                    'kg_bruto'   => (float) $g->sum('kg_bruto'),
                    'tara'       => (float) $g->sum('tara'),
                    'kg_neto'    => (float) $g->sum('kg_neto'),
                ];
            })
            ->values()
            ->sortBy(fn($x) => mb_strtolower($x['subitem'] ?? ''))
            ->values();
    }

    protected function hydrateTotalesSubitemConTraspaso(TransformacionLote $t): void
    {
        $subdesc = collect($t->subdescomp_totales_por_subitem ?? []);
        $traspas = collect($t->traspasos_totales_por_subitem ?? []);
        $idx = $subdesc->keyBy('subitem_id');
        foreach ($traspas as $tr) {
            if ($idx->has($tr['subitem_id'])) {
                $row = $idx->get($tr['subitem_id']);
                $row['cajas']    += $tr['cajas'];
                $row['kg_bruto'] += $tr['kg_bruto'];
                $row['tara']     += $tr['tara'];
                $row['kg_neto']  += $tr['kg_neto'];
                $idx->put($tr['subitem_id'], $row);
            } else {
                $idx->put($tr['subitem_id'], $tr);
            }
        }
        $comb = $idx->values()->sortBy(fn($x) => mb_strtolower($x['subitem'] ?? ''))->values();
        $t->subitem_totales_con_traspaso = $comb;
        $t->subitem_totales_con_traspaso_sum = [
            'cajas'    => (int)   $comb->sum('cajas'),
            'kg_bruto' => (float) $comb->sum('kg_bruto'),
            'tara'     => (float) $comb->sum('tara'),
            'kg_neto'  => (float) $comb->sum('kg_neto'),
        ];
    }

    protected function hydrateBalanceFinal(TransformacionLote $t): void
    {
        $ini = (array) ($t->inicial_listado_aceptados['totales'] ?? [
            'cajas' => 0,
            'kg_bruto' => 0.0,
            'tara' => 0.0,
            'kg_neto' => 0.0,
        ]);

        $des = (array) ($t->subdescomp_resumen_global['subitems'] ?? [
            'cajas' => 0,
            'kg_bruto' => 0.0,
            'tara' => 0.0,
            'kg_neto' => 0.0,
        ]);

        $mer = (array) ($t->subdescomp_resumen_global['merma'] ?? [
            'cajas' => 0,
            'kg_bruto' => 0.0,
            'tara' => 0.0,
            'kg_neto' => 0.0,
        ]);

        $sob = [
            'cajas'    => max(0,   (int)($ini['cajas'] - $des['cajas'] - $mer['cajas'])),
            'kg_bruto' => max(0.0, (float)$ini['kg_bruto'] - (float)$des['kg_bruto'] - (float)$mer['kg_bruto']),
            'tara'     => max(0.0, (float)$ini['tara'] - (float)$des['tara']     - (float)$mer['tara']),
            'kg_neto'  => max(0.0, (float)$ini['kg_neto'] - (float)$des['kg_neto']  - (float)$mer['kg_neto']),
        ];

        $mermaFinalGlobal = [
            'cajas'    => (int)   ($mer['cajas']    + $sob['cajas']),
            'kg_bruto' => (float) ($mer['kg_bruto'] + $sob['kg_bruto']),
            'tara'     => (float) ($mer['tara']     + $sob['tara']),
            'kg_neto'  => (float) ($mer['kg_neto']  + $sob['kg_neto']),
        ];

        $cuadre = [
            'cajas'    => (int)   ($ini['cajas']    - $des['cajas']    - $mermaFinalGlobal['cajas']),
            'kg_bruto' => (float) ($ini['kg_bruto'] - $des['kg_bruto'] - $mermaFinalGlobal['kg_bruto']),
            'tara'     => (float) ($ini['tara']     - $des['tara']     - $mermaFinalGlobal['tara']),
            'kg_neto'  => (float) ($ini['kg_neto']  - $des['kg_neto']  - $mermaFinalGlobal['kg_neto']),
        ];

        $t->balance_final = [
            'inicial'             => $ini,
            'descomp'             => $des,
            'merma'               => $mer,
            'sobrante'            => $sob,
            'merma_final_global'  => $mermaFinalGlobal,
            'cuadre'              => $cuadre,
        ];
    }

    public function showTransReporteVenta(TransformacionLote $t)
    {
        $t = $this->detalles($t);
        $this->hydrateInicialTransformacion($t);
        $this->hydrateSubDescomp($t);
        $this->hydrateTraspasosAceptadosDesdeTrans($t);
        $this->hydrateTotalesSubitemConTraspaso($t);

        $t->loadMissing([
            'VentaTransformacions.Subitem',
            'VentaTransformacions.Venta.User',
            'VentaTransformacions.Venta.Cliente',
        ]);

        $sobrantesOrigen = ItemSobraTrans::with(['Item', 'User'])
            ->where('trans_id', $t->id)
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        $inicialIdx = collect($t->subitem_totales_con_traspaso ?? [])->keyBy('subitem_id');

        // ========== 2) VENTAS AGRUPADAS POR SUBITEM ==========
        $ventas = $t->VentaTransformacions;

        $ventas_por_subitem = collect($ventas)
            ->groupBy('subitem_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy(fn($v) => optional($v->Venta)->created_at)->values()->map(function ($v) {
                    $venta  = $v->Venta;
                    $fecha  = optional($venta)->created_at;

                    $cajas    = (float) ($v->cajas       ?? 0);
                    $kg_bruto = (float) ($v->peso_bruto  ?? 0);
                    $taras    = (float) ($v->taras       ?? 0);
                    $kg_neto  = (float) ($v->peso_neto   ?? 0);
                    $precio   = (float) ($v->venta      ?? 0);
                    $total    = (float) ($v->total       ?? ($kg_neto * $precio));

                    return [
                        'venta_id'   => optional($venta)->id,
                        'fecha'      => $fecha,
                        'usuario'    => optional(optional($venta)->User)->nombre,
                        'cliente'    => optional(optional($venta)->Cliente)->nombre,
                        'cliente_id' => optional(optional($venta)->Cliente)->id,
                        'cajas'      => $cajas,
                        'kg_bruto'   => $kg_bruto,
                        'tara'       => $taras,
                        'kg_neto'    => number_format($kg_neto, 3, '.', ''),
                        'precio'     => number_format($precio, 2, '.', ''),
                        'total'      => number_format($total, 2, '.', ''),
                    ];
                });

                $tot = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                    'total'    => (float) $rows->sum('total'),
                ];

                $first = $grp->first();

                return [
                    'subitem_id'       => $first->subitem_id,
                    'subitem_name'     => optional($first->Subitem)->name,
                    'totales_vendidos' => $tot,
                    'rows'             => $rows,
                ];
            });

        // ========== 3) ENVÍOS A SIGUIENTE SUBTRANS (SOBRANTES DEL TRANS ACTUAL) AGRUPADOS ==========
        $envios_por_subitem = collect($sobrantesOrigen)
            ->groupBy('item_id')
            ->map(function ($grp, $subitem_id) {
                $rows = $grp->sortBy(fn($s) => ($s->fecha ?? '') . ' ' . ($s->hora ?? ''))->values()->map(function ($s) {
                    $fechaHora = trim(($s->fecha ?? '') . ' ' . ($s->hora ?? ''));
                    return [
                        'sobra_id'  => $s->id,
                        'fecha'     => $fechaHora ?: null,
                        'usuario'   => optional($s->User)->nombre,
                        'detalle'   => 'Sobrante (envío a siguiente SubTrans)',
                        'cajas'     => (float) $s->cajas,
                        'kg_bruto'  => (float) $s->kgb,
                        'tara'      => (float) $s->taras,
                        'kg_neto'   => number_format((float) ($s->kgn_nuevo ?? 0), 3, '.', ''),
                    ];
                });

                $tot = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                ];

                $first = $grp->first();

                return [
                    'subitem_id'         => (int) $subitem_id,
                    'subitem_name'       => optional($first->Item)->name,
                    'totales_envios_sig' => $tot,
                    'rows'               => $rows,
                ];
            });

        // ========== 4) MEZCLAR: INICIAL + VENTAS + ENVÍOS_SIG y calcular SALDO ==========
        $all_subitem_ids = collect(array_unique(array_merge(
            $inicialIdx->keys()->all(),
            $ventas_por_subitem->keys()->all(),
            $envios_por_subitem->keys()->all()
        )));

        $bloques = $all_subitem_ids->map(function ($sid) use ($inicialIdx, $ventas_por_subitem, $envios_por_subitem) {
            $ini     = (array) $inicialIdx->get($sid, ['subitem_id' => $sid, 'subitem' => null, 'cajas' => 0, 'kg_bruto' => 0, 'tara' => 0, 'kg_neto' => 0]);
            $ventas  = (array) $ventas_por_subitem->get($sid, ['subitem_id' => $sid, 'subitem_name' => null, 'totales_vendidos' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0, 'total' => 0], 'rows' => collect()]);
            $envios  = (array) $envios_por_subitem->get($sid, ['subitem_id' => $sid, 'subitem_name' => null, 'totales_envios_sig' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);

            $subitem_name = $ini['subitem'] ?? ($ventas['subitem_name'] ?? $envios['subitem_name']);

            $saldo = [
                'cajas'    => max(0, ($ini['cajas'] ?? 0)
                    - ($ventas['totales_vendidos']['cajas']    ?? 0)
                    - ($envios['totales_envios_sig']['cajas']  ?? 0)),
                'kg_bruto' => max(0, ($ini['kg_bruto'] ?? 0)
                    - ($ventas['totales_vendidos']['kg_bruto'] ?? 0)
                    - ($envios['totales_envios_sig']['kg_bruto'] ?? 0)),
                'tara'     => max(0, ($ini['tara'] ?? 0)
                    - ($ventas['totales_vendidos']['taras']    ?? 0)
                    - ($envios['totales_envios_sig']['taras']  ?? 0)),
                'kg_neto'  => number_format(
                    (($ini['kg_neto'] ?? 0)
                        - ($ventas['totales_vendidos']['kg_neto'] ?? 0)
                        - ($envios['totales_envios_sig']['kg_neto'] ?? 0)),
                    3,
                    '.',
                    ''
                ),
            ];

            return [
                'subitem_id'               => $sid,
                'subitem_name'             => $subitem_name,
                'inicial'                  => [
                    'cajas'    => (float) ($ini['cajas']    ?? 0),
                    'kg_bruto' => (float) ($ini['kg_bruto'] ?? 0),
                    'taras'    => (float) ($ini['tara']     ?? 0),
                    'kg_neto'  => (float) ($ini['kg_neto']  ?? 0),
                ],
                'ventas'                   => $ventas['rows'],
                'totales_ventas'           => $ventas['totales_vendidos'],
                'envios_sgte_trans'        => $envios['rows'],
                'totales_envios_sgte_trans' => $envios['totales_envios_sig'],
                'saldo'                    => $saldo,
            ];
        })
            ->sortBy(fn($b) => mb_strtolower($b['subitem_name'] ?? ''))
            ->values();

        $t->ventas_por_subitem_bloques = $bloques;

        // ========== 5) RESUMEN GLOBAL ==========
        $resumen = [
            'inicial' => [
                'cajas'    => (float) $bloques->sum(fn($b) => $b['inicial']['cajas']),
                'kg_bruto' => (float) $bloques->sum(fn($b) => $b['inicial']['kg_bruto']),
                'taras'    => (float) $bloques->sum(fn($b) => $b['inicial']['taras']),
                'kg_neto'  => (float) $bloques->sum(fn($b) => $b['inicial']['kg_neto']),
            ],
            'ventas' => [
                'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_ventas']['cajas']),
                'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_ventas']['kg_bruto']),
                'taras'    => (float) $bloques->sum(fn($b) => $b['totales_ventas']['taras']),
                'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_ventas']['kg_neto']),
                'total'    => (float) $bloques->sum(fn($b) => $b['totales_ventas']['total']),
            ],
            'envios_sgte_trans' => [
                'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_envios_sgte_trans']['cajas']    ?? 0),
                'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_envios_sgte_trans']['kg_bruto'] ?? 0),
                'taras'    => (float) $bloques->sum(fn($b) => $b['totales_envios_sgte_trans']['taras']    ?? 0),
                'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_envios_sgte_trans']['kg_neto']  ?? 0),
            ],
        ];
        $resumen['saldo'] = [
            'cajas'    => max(0, $resumen['inicial']['cajas'] - $resumen['ventas']['cajas'] - $resumen['envios_sgte_trans']['cajas']),
            'kg_bruto' => max(0, $resumen['inicial']['kg_bruto'] - $resumen['ventas']['kg_bruto'] - $resumen['envios_sgte_trans']['kg_bruto']),
            'taras'    => max(0, $resumen['inicial']['taras'] - $resumen['ventas']['taras'] - $resumen['envios_sgte_trans']['taras']),
            'kg_neto'  => number_format(
                $resumen['inicial']['kg_neto']
                    - $resumen['ventas']['kg_neto']
                    - $resumen['envios_sgte_trans']['kg_neto'],
                3,
                '.',
                ''
            ),
        ];

        $t->setAttribute('ventas_resumen_subtrans', $resumen);

        return $t;
    }

    public function PesoInicialTotalTrans(TransformacionLote $transformacionLote)
    {
        $transformacionLote = $this->show($transformacionLote);

        $sucursal = $transformacionLote->Sucursal;
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.transformacionLote.peso_inicial_total', [
            'trans'    => $transformacionLote,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);

        return $pdf->stream();
    }
    public function ReporteVentasMovimientosTrans(TransformacionLote $transformacionLote)
    {
        $transformacionLote = $this->showTransReporteVenta($transformacionLote);
        $sucursal = $transformacionLote->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.transformacionLote.reporte_movimiento', [
            'trans' => $transformacionLote,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }

    public function ReporteGeneralTrans(TransformacionLote $transformacionLote)
    {
        $transformacionLote = $this->show($transformacionLote);
        $transformacionLote = $this->showTransReporteVenta($transformacionLote);

        $sucursal = $transformacionLote->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.transformacionLote.reporte_general', [
            'trans' => $transformacionLote,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'portrait')->setOption('enable_php', true);
        return $pdf->stream();
    }

    public function listaSubItems()
    {
        return Item::where([['estado', 1], ['tipo', 3]])->get();
    }
    public function cerrarItem(TransformacionLote $transformacionLote, Request $request)
    {
        foreach ($transformacionLote->ItemPtTransformacionLotes()->where([['pt_id', $request->pt['id']], ['item_id', $request->item['id']]])->get() as $item) {
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
        foreach ($request->lista_subitems_transformacion as $item) {
            $itemSobraTrans = new ItemSobraTrans();
            $itemSobraTrans->trans_id = $transformacionLote->id;
            $itemSobraTrans->item_id = $item['subitem']['id'];
            $itemSobraTrans->cajas = $item['total_cajas'];
            $itemSobraTrans->taras = $item['total_taras'];
            $itemSobraTrans->pt_id = $item['pt']['id'];
            $itemSobraTrans->kgn = $item['total_peso_neto'];

            if ($item['total_cajas'] > 0) {
                $nuevo_peso_bruto = $item['peso_neto_nuevo'] + ($item['total_cajas'] * 2);
                $itemSobraTrans->kgb = $nuevo_peso_bruto ?? $item['total_peso_bruto'];
            } else {
                $itemSobraTrans->kgb = $item['peso_neto_nuevo'];
            }

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
