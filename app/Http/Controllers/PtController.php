<?php

namespace App\Http\Controllers;

use App\Models\ItemSobraPt;
use App\Models\Pt;
use App\Models\Sucursal;
use App\Models\DetallePt;
use App\Models\LoteDetalleMovimiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Pt::where('estado', 1)->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url('reportes/pt/' . $m->id);
            $m->url_informe_pdf = url('reportes/pt_informe_lotes/' . $m->id);
            $m->url_entrada_pdf = url('reportes/pt_entrada_lotes/' . $m->id);
            $m->url_general_pdf = url('reportes/pt_general_lotes/' . $m->id);
            $m->url_envio_pdf = url('reportes/pt_envio_lotes/' . $m->id);
            $m->url_venta_pdf = url('reportes/pt_venta_lotes/' . $m->id);
            $m->url_descomponer_pdf = url('reportes/pt_descomponer_lotes/' . $m->id);
            $m->url_items_pdf = url('reportes/pt_items_lotes/' . $m->id);
            $m->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/' . $m->id);
            $m->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/' . $m->id);
            $m->url_peso_total_pdf = url('reportes/pt/peso-total/' . $m->id);
            $m->url_pt_reporte_general_pdf = url('reportes/pt/pt-reporte-general/' . $m->id);
            $m->url_pt_ventas_pdf = url('reportes/pt/pt-ventas/' . $m->id);
            $m->url_pt_venta_reporte_pdf = url('reportes/pt/pt-movimientos-reporte/' . $m->id);
            $list[] = $m;
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
        $pt = new Pt();
        $pt->nro = $request->nro;
        $pt->fecha = Carbon::now()->format('Y-m-d');
        $pt->sucursal_id = $request->sucursal_id;
        $pt->user_id = $request->user_id;
        $pt->save();
        return $this->showPT($pt);
    }
    public function actualizarDetallesMasa(Request $request)
    {
        foreach ($request->detalle_envio as $d) {
            $DetallePp = DetallePt::where('id', $d['id'])->get()->first();

            $DetallePp->pollos = $d['equivalente'];
            $DetallePp->cajas = $d['cajas'];
            $DetallePp->fecha = Carbon::now()->format('Y-m-d');

            $DetallePp->peso_total = $d['peso_actual_bruto'];
            $DetallePp->peso_neto = $d['peso_mod_neto'];
            $DetallePp->peso_bruto = $d['peso_mod_bruto'];
            $DetallePp->merma_bruta = $d['merma_bruta'];
            $DetallePp->merma_neta = $d['merma_neta'];

            $DetallePp->save();
            $loteDetalleMovimiento = LoteDetalleMovimiento::where('id', $d['id'])->get()->first();

            $loteDetalleMovimiento->cantidad = $d['equivalente'];
            $loteDetalleMovimiento->peso_neto = $d['peso_mod_neto'];
            $loteDetalleMovimiento->peso_bruto = $d['peso_mod_bruto'];
            $loteDetalleMovimiento->cajas = $d['cajas'];
            $loteDetalleMovimiento->peso = $d['peso_actual_bruto'];

            $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleMovimiento->save();
        }
        return true;
    }
    public function detalles(Pt $pt)
    {
        $pt->detalle_pts = $pt->DetallePts;
        return $pt;
    }
    public function detallesV1(Sucursal $sucursal)
    {
        $pps = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $value) {
            foreach ($value->DetallePts as $item) {
                $item->pt = $item->Pt;
                $list[] = $item;
            }
        }
        return $list;
    }
    public function pts(Sucursal $sucursal)
    {
        $pps = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $value) {
            $list[] = $value;
        }
        return $list;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pt  $pt
     * @return \Illuminate\Http\Response
     */
    public function show(Pt $pt)
    {
        $pt->sucursal = $pt->Sucursal;
        $pt->mes = $this->mes($pt->fecha);
        $pt->url_pdf = url('reportes/pt/' . $pt->id);
        $pt->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/' . $pt->id);
        $pt->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/' . $pt->id);
        $pt->url_peso_total_pdf = url('reportes/pt/peso-total/' . $pt->id);
        $pt->detalle_pts = $pt->DetallePts;
        $pt->pt_traspaso_pps = $pt->PtTraspasoPps;
        $pt->pt_sobra_pps = $pt->PtSobraPps;

        return $pt;
    }
    public function mes($fecha)
    {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }
    public function showPT(Pt $pt)
    {
        $pt->sucursal = $pt->Sucursal;
        $pt->mes = $this->mes($pt->fecha);
        $pt->url_pdf = url('reportes/pt/' . $pt->id);
        $pt->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/' . $pt->id);
        $pt->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/' . $pt->id);
        $pt->url_peso_total_pdf = url('reportes/pt/peso-total/' . $pt->id);
        $pt->detalle_pts = $pt->DetallePts;
        $ingreso_lotes = $pt->DetallePts->each(function ($item, $key) {
            $compra = $item->LoteDetalle->Compra;
            $item->name = $compra->ProveedorCompra->abreviatura . "-" . $compra->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $lista_ingresos_lotes = [];
        foreach ($ingreso_lotes as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $lista_ingresos_lotes[] = [
                    "lote" => $key,
                    "cinta" => $k,
                    "cajas" => $cajas,
                    "pollos" => $pollos,
                    "peso_bruto" => $peso_bruto,
                    "peso_neto" => $peso_neto,
                    "tara" => $peso_bruto - $peso_neto
                ];
            }
        }
        $pt->reporte_ingresos_lotes = collect($lista_ingresos_lotes);
        return $pt;
    }
    // public function showPTReporteVenta(Pt $pt)
    // {
    //     $pt->sucursal = $pt->Sucursal;
    //     $pt->mes = $this->mes($pt->fecha);
    //     $pt->url_pdf = url('reportes/pt/' . $pt->id);
    //     $pt->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/' . $pt->id);
    //     $pt->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/' . $pt->id);
    //     $pt->url_peso_total_pdf = url('reportes/pt/peso-total/' . $pt->id);
    //     $itempt_list = $pt->ItemsPts->groupBy('item_id');

    //     $itempt_movimientos = $pt->ItemPtMovimientos();
    //     $ventaitems_pts = $pt->VentaItemsPts();
    //     $list = [];
    //     foreach ($itempt_list as $key => $value) {
    //         $ventas = $ventaitems_pts->with(['Venta'])->where('item_id', $key)->get();
    //         $movimientos = $itempt_movimientos->where('item_id', $key)->get();
    //         $list[] = [
    //             "item_id" => $key,
    //             "item" => $value->first()->Item,
    //             "ventas" => collect($ventas),
    //             "movimientos" => collect($movimientos)
    //         ];
    //     }
    //     $pt->items = collect($list);
    //     return $pt;
    // }


    public function showPTReporteVenta(Pt $pt)
    {
        $pt->sucursal            = $pt->Sucursal;
        $pt->mes                 = $this->mes($pt->fecha);
        $pt->url_pdf             = url('reportes/pt/' . $pt->id);
        $pt->url_peso_inicial_1_pdf = url('reportes/pt/peso-inicial-1/' . $pt->id);
        $pt->url_peso_inicial_2_pdf = url('reportes/pt/peso-inicial-2/' . $pt->id);
        $pt->url_peso_total_pdf  = url('reportes/pt/peso-total/' . $pt->id);

        $pt->loadMissing([
            'DescomponerPts.ItemsPts.Item',
            'ItemsPts.Item',

            'VentaItemsPts.Item',
            'VentaItemsPts.Venta.User',
            'VentaItemsPts.Venta.Cliente',

            'EnviarItemPtTransformacions.Item',
            'EnviarItemPtTransformacions.User',

            'ItemSobraPts.Item',
            'ItemSobraPts.User',
        ]);

        // ========== 1) SALDO INICIAL POR ITEM (KG/N) ==========
        $items_descomp      = $pt->DescomponerPts->flatMap(fn($d) => $d->ItemsPts);
        $items_1y2          = $pt->ItemsPts->whereIn('tipo', [1, 2]);
        $items_para_totales = $items_descomp->concat($items_1y2);

        $inicial_por_item = $items_para_totales
            ->groupBy('item_id')
            ->map(function ($grp) {
                $first = $grp->first();
                return [
                    'item_id'    => $first->item_id,
                    'item_name'  => optional($first->Item)->name,
                    'cajas'      => (float) $grp->sum('cajas'),
                    'kg_bruto'   => (float) $grp->sum('peso_bruto'),
                    'taras'      => (float) $grp->sum('taras'),
                    'kg_neto'    => (float) $grp->sum('peso_neto'),
                ];
            });

        // ========== 2) VENTAS AGRUPADAS POR ITEM ==========
        $ventas = $pt->VentaItemsPts;

        $ventas_por_item = $ventas
            ->groupBy('item_id')
            ->map(function ($grp) {
                // Normalizamos cada fila: si está anulada => todos los números a 0
                $rows = $grp->sortBy('venta.fecha')->values()->map(function ($v) {
                    $venta = $v->Venta;
                    // Consideramos anulada si la venta o el item tienen estado == 0
                    $anulada = ((int)($v->estado ?? 1) === 0) || ((int)($venta->estado ?? 1) === 0);

                    $cajas    = $anulada ? 0.0 : (float) $v->cajas;
                    $kg_bruto = $anulada ? 0.0 : (float) $v->peso_bruto;
                    $taras    = $anulada ? 0.0 : (float) $v->taras;
                    $kg_neto  = $anulada ? 0.0 : (float) $v->peso_neto;
                    $precio   = $anulada ? 0.0 : (float) ($v->precio ?? 0);
                    $total    = $anulada ? 0.0 : (float) ($v->total  ?? ($kg_neto * $precio));

                    $fecha = optional($venta)->created_at;


                    return [
                        'venta_id'   => optional($venta)->id,
                        'fecha'      => $fecha,
                        'usuario'    => optional(optional($venta)->User)->nombre,
                        'cliente'    => optional(optional($venta)->Cliente)->nombre,
                        'cliente_id' => optional(optional($venta)->Cliente)->id,
                        'anulada'    => $anulada,
                        'cajas'      => $cajas,
                        'kg_bruto'   => $kg_bruto,
                        'tara'       => $taras,
                        'kg_neto'    => round($kg_neto, 3),
                        'precio'     => round($precio, 2),
                        'total'      => round($total, 2),
                    ];
                });

                // Totales calculados DESDE las filas normalizadas (ya tienen 0 si están anuladas)
                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                    'total'    => (float) $rows->sum('total'),
                ];

                $first = $grp->first();

                return [
                    'item_id'         => $first->item_id,
                    'item_name'       => optional($first->Item)->name,
                    'totales_vendidos' => $totales,
                    'rows'            => $rows,
                ];
            });


        // ========== 2b) ENVIOS A TRANSFORMACIÓN AGRUPADOS POR ITEM ==========
        $envios = $pt->EnviarItemPtTransformacions;

        $envios_por_item = $envios
            ->groupBy('item_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy('fecha_hora')->values()->map(function ($e) {
                    return [
                        'envio_id'  => $e->id,
                        'fecha'     => $e->fecha_hora,
                        'hora'      => $e->fecha_hora ? \Carbon\Carbon::parse($e->fecha_hora)->format('H:i:s') : null,
                        'usuario'   => optional($e->User)->nombre,
                        'cajas'     => (float) $e->cajas,
                        'kg_bruto'  => (float) $e->peso_bruto,
                        'tara'      => (float) $e->taras,
                        'kg_neto'   => round((float) $e->peso_neto, 3),
                    ];
                });

                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                ];

                $first = $grp->first();

                return [
                    'item_id'          => $first->item_id,
                    'item_name'        => optional($first->Item)->name,
                    'totales_envios'   => $totales,
                    'rows'             => $rows,
                ];
            });

        // ========== 2c) SOBRANTES (TRASPASO A OTRO PT) AGRUPADOS POR ITEM ==========
        $sobrantes = $pt->ItemSobraPts;

        $sobrantes_por_item = $sobrantes
            ->groupBy('item_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy(fn($x) => $x->fecha . ' ' . $x->hora)->values()->map(function ($s) {
                    $fechaHora = trim(($s->fecha ?? '') . ' ' . ($s->hora ?? ''));
                    return [
                        'sobra_id'  => $s->id,
                        'fecha'     => $fechaHora ?: null,
                        'usuario'   => optional($s->User)->nombre,
                        'cajas'     => (float) $s->cajas,
                        'kg_bruto'  => (float) $s->kgb,
                        'tara'      => (float) $s->taras,
                        'kg_neto'   => round((float) ($s->kgn_nuevo ?? 0), 3),
                        'merma'     => round((float) ($s->merma ?? 0), 3),
                    ];
                });

                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                ];

                $first = $grp->first();

                return [
                    'item_id'           => $first->item_id,
                    'item_name'         => optional($first->Item)->name,
                    'totales_sobrantes' => $totales,
                    'rows'              => $rows,
                ];
            });


        // ========== 3) MEZCLAR “INICIAL” CON “VENTAS” Y CALCULAR SALDO ==========
        $all_item_ids = collect(array_unique(array_merge(
            $inicial_por_item->keys()->all(),
            $ventas_por_item->keys()->all(),
            $envios_por_item->keys()->all(),
            $sobrantes_por_item->keys()->all()
        )));

        $bloques = $all_item_ids->map(function ($item_id) use ($inicial_por_item, $ventas_por_item, $envios_por_item, $sobrantes_por_item) {
            $ini        = $inicial_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0]);
            $ventas     = $ventas_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_vendidos' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);
            $envios     = $envios_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_envios'   => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);
            $sobrantes  = $sobrantes_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_sobrantes' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);

            $item_name = $ini['item_name'] ?? $ventas['item_name'] ?? $envios['item_name'] ?? $sobrantes['item_name'];

            $saldo = [
                'cajas'    => max(0, ($ini['cajas'] ?? 0)
                    - ($ventas['totales_vendidos']['cajas']    ?? 0)
                    - ($envios['totales_envios']['cajas']      ?? 0)
                    - ($sobrantes['totales_sobrantes']['cajas'] ?? 0)),
                'kg_bruto' => max(0, ($ini['kg_bruto'] ?? 0)
                    - ($ventas['totales_vendidos']['kg_bruto'] ?? 0)
                    - ($envios['totales_envios']['kg_bruto']   ?? 0)
                    - ($sobrantes['totales_sobrantes']['kg_bruto'] ?? 0)),
                'taras'    => max(0, ($ini['taras'] ?? 0)
                    - ($ventas['totales_vendidos']['taras']    ?? 0)
                    - ($envios['totales_envios']['taras']      ?? 0)
                    - ($sobrantes['totales_sobrantes']['taras'] ?? 0)),
                'kg_neto'  => round(
                    ($ini['kg_neto'] ?? 0)
                        - ($ventas['totales_vendidos']['kg_neto'] ?? 0)
                        - ($envios['totales_envios']['kg_neto']   ?? 0)
                        - ($sobrantes['totales_sobrantes']['kg_neto'] ?? 0),
                ),
            ];

            return [
                'item_id'                 => $item_id,
                'item_name'               => $item_name,
                'inicial'                 => [
                    'cajas'    => (float) ($ini['cajas']    ?? 0),
                    'kg_bruto' => (float) ($ini['kg_bruto'] ?? 0),
                    'taras'    => (float) ($ini['taras']    ?? 0),
                    'kg_neto'  => (float) ($ini['kg_neto']  ?? 0),
                ],
                'ventas'                  => $ventas['rows'],
                'totales_ventas'          => $ventas['totales_vendidos'],
                'envios_transf'           => $envios['rows'],
                'totales_envios_transf'   => $envios['totales_envios'],
                'sobrantes_pt'            => $sobrantes['rows'],                 // <- NUEVO
                'totales_sobrantes_pt'    => $sobrantes['totales_sobrantes'],    // <- NUEVO
                'saldo'                   => $saldo,
            ];
        })
            ->sortBy(fn($b) => mb_strtolower($b['item_name'] ?? ''))
            ->values();

        $pt->ventas_por_item_bloques = $bloques;

        // ========== 4) RESUMEN GLOBAL ==========
        $ventas_resumen_global = [
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
            ],
        ];
        $ventas_resumen_global['envios_transf'] = [
            'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['cajas']    ?? 0),
            'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['kg_bruto'] ?? 0),
            'taras'    => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['taras']    ?? 0),
            'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['kg_neto']  ?? 0),
        ];
        $ventas_resumen_global['sobrantes_pt'] = [
            'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['cajas']    ?? 0),
            'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['kg_bruto'] ?? 0),
            'taras'    => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['taras']    ?? 0),
            'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['kg_neto']  ?? 0),
        ];
        $ventas_resumen_global['saldo'] = [
            'cajas'    => max(0, $ventas_resumen_global['inicial']['cajas']
                - $ventas_resumen_global['ventas']['cajas']
                - $ventas_resumen_global['envios_transf']['cajas']
                - $ventas_resumen_global['sobrantes_pt']['cajas']),
            'kg_bruto' => max(0, $ventas_resumen_global['inicial']['kg_bruto']
                - $ventas_resumen_global['ventas']['kg_bruto']
                - $ventas_resumen_global['envios_transf']['kg_bruto']
                - $ventas_resumen_global['sobrantes_pt']['kg_bruto']),
            'taras'    => max(0, $ventas_resumen_global['inicial']['taras']
                - $ventas_resumen_global['ventas']['taras']
                - $ventas_resumen_global['envios_transf']['taras']
                - $ventas_resumen_global['sobrantes_pt']['taras']),
            'kg_neto'  => round(
                $ventas_resumen_global['inicial']['kg_neto']
                    - $ventas_resumen_global['ventas']['kg_neto']
                    - $ventas_resumen_global['envios_transf']['kg_neto']
                    - $ventas_resumen_global['sobrantes_pt']['kg_neto'],
                3
            )
        ];

        $pt->setAttribute('ventas_resumen_global', $ventas_resumen_global);
        return $pt;
    }

    public function showPTReporteGeneral(Pt $pt)
    {

        return $pt;
    }
    public function sucursalCurso(Sucursal $sucursal)
    {
        $pt = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pt as $value) {
            $list[] = $this->showPT($value);
        }
        return $list;
    }
    public function sucursalCursoSubPt(Sucursal $sucursal)
    {
        $pt = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->first();
        if ($pt) {
            $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
            $list_items = [];

            foreach ($group_items as $m) {
                $item = $m->first()->Item;
                $cajas = $m->sum('cajas');
                $taras = $m->sum('taras');
                $peso_bruto = $m->sum('peso_bruto');
                $peso_neto = $m->sum('peso_neto');
                $list_items[] = [
                    "item" => $item,
                    "cajas" => $cajas,
                    "taras" => $taras,
                    "peso_bruto" => $peso_bruto,
                    "peso_neto" => $peso_neto,
                    "list" => $m
                ];
            }
            $pt->items = $list_items;
            return $pt;
        }
        return [];
    }
    public function sucursalCursoPos(Sucursal $sucursal)
    {
        $pts = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pts as $pt) {
            $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
            $list_items = [];
            $envio_item_pt_transformaciones = $pt->EnviarItemPtTransformacions()->get();
            foreach ($group_items as $m) {
                $item       = $m->first()->Item;
                $sumCajas   = (float) $m->sum('cajas');
                $sumTaras   = (float) $m->sum('taras');
                $sumPB      = (float) $m->sum('peso_bruto');
                $sumPN      = (float) $m->sum('peso_neto');

                $detalles   = $envio_item_pt_transformaciones->where('item_id', $m->first()->item_id);
                $envCajas   = (float) $detalles->sum('cajas');
                $envPB      = (float) $detalles->sum('peso_bruto');
                $envPN      = (float) $detalles->sum('peso_neto');

                $cajas      = max(0, $sumCajas - $envCajas);
                $peso_bruto = max(0, $sumPB    - $envPB);
                $peso_neto  = max(0, $sumPN    - $envPN);
                $taras      = max(0, $sumTaras);

                if ($peso_neto > 0) {
                    $list_items[] = [
                        "item"       => $item,
                        "cajas"      => $cajas,
                        "taras"      => $taras,
                        "peso_bruto" => $peso_bruto,
                        "peso_neto"  => $peso_neto,
                        "list"       => $m,
                    ];
                }
            }
            $pt->items = $list_items;
            $list[] = $this->showPT($pt);
        }
        return $list;
    }

    // public function cerrar(Request $request, Pt $pt)
    // {
    //     //dd($request->all());
    //     $pt->curso = 0;
    //     $pt->save();
    //     foreach($request->items as $item){
    //         if($item['peso_bruto']>0){
    //             $itemSobraPt = new ItemSobraPt();
    //             $itemSobraPt->pt_id = $pt->id;
    //             $itemSobraPt->item_id = $item['item']['id'];
    //             $itemSobraPt->cajas = $item['cajas'];
    //             $itemSobraPt->taras = $item['taras'];
    //             $itemSobraPt->kgb = $item['peso_bruto'];
    //             $itemSobraPt->kgn = $item['peso_neto'];
    //             $itemSobraPt->kgn_nuevo = $item['peso_neto_nuevo'] ?? $item['peso_neto'];
    //             $itemSobraPt->merma = $item['merma'] ?? 0;
    //             $itemSobraPt->fecha = Carbon::now()->format('Y-m-d');
    //             $itemSobraPt->hora = Carbon::now()->format('H:i:s');
    //             $itemSobraPt->dia = "";
    //             $itemSobraPt->user_id = $request->user_id;
    //             $itemSobraPt->save();
    //         }
    //     }
    //     // Traspasar items disponibles / sobrantes
    //     // $sobraPp = new SobraPp();
    //     // $sobraPp->pp_id = $pp->id;
    //     // $sobraPp->fecha = Carbon::now()->format('Y-m-d');
    //     // $sobraPp->save();
    //     // foreach($pp->items_sobra as $detalle){
    //     //     $sobraDetallePp = new SobraDetallePp();
    //     //     $sobraDetallePp->sobra_pp_id = $sobraPp->id;
    //     //     $sobraDetallePp->item_id = $detalle['id'];
    //     //     $sobraDetallePp->cajas = $detalle['cajas'];
    //     //     $sobraDetallePp->taras = $detalle['taras'];
    //     //     $sobraDetallePp->peso_bruto = $detalle['peso_bruto'];
    //     //     $sobraDetallePp->peso_neto = $detalle['peso_neto'];
    //     //     $sobraDetallePp->save();
    //     // }
    //     return $pt;
    // }

    public function cerrar(Request $request, Pt $pt)
    {
        $pt->curso = 0;
        $pt->save();
        foreach ($request->items as $item) {
            if ($item['peso_neto_nuevo'] > 0) {
                $itemSobraPt = new ItemSobraPt();
                $itemSobraPt->pt_id = $pt->id;
                $itemSobraPt->item_id = $item['item']['id'];
                $itemSobraPt->cajas = $item['cajas'];

                if ($item['cajas'] > 0) {
                    $itemSobraPt->taras = $item['cajas'] * 2;
                    $itemSobraPt->kgb = $item['peso_neto_nuevo'] + $itemSobraPt->taras;
                } else {
                    $itemSobraPt->taras = 0;
                    $itemSobraPt->kgb = $item['peso_neto_nuevo'];
                }

                $itemSobraPt->kgn = $item['peso_neto'];
                $itemSobraPt->kgn_nuevo = $item['peso_neto_nuevo'] ?? $item['peso_neto'];
                $itemSobraPt->merma = $item['merma'] ?? 0;
                $itemSobraPt->fecha = Carbon::now()->format('Y-m-d');
                $itemSobraPt->hora = Carbon::now()->format('H:i:s');
                $itemSobraPt->dia = "";
                $itemSobraPt->user_id = Auth::user()->id;
                $itemSobraPt->save();
            }
        }
        return $pt;
    }
    public function detalle(Pt $pt)
    {
        $pt->mes = $this->mes($pt->fecha);
        $pt->detalle_pts = $pt->DetallePts;

        $pt->descomponer_pts = $pt->DescomponerPts;
        $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
        $list_items = [];
        $envio_item_pt_transformaciones = $pt->EnviarItemPtTransformacions;
        foreach ($group_items as $m) {
            $detalles = $envio_item_pt_transformaciones->where('item_id', $m->first()->item_id);
            $item = $m->first()->Item;
            $cajas = $m->sum('cajas');
            $taras = $m->sum('taras');
            $peso_bruto = $m->sum('peso_bruto');
            $peso_neto = $m->sum('peso_neto');
            $taras_detalles = $detalles->sum('taras');
            $taras = max(0, ($cajas * 2) - $taras_detalles);

            $cajas      = max(0, $cajas      - $detalles->sum('cajas'));
            $peso_bruto = max(0, $peso_bruto - $detalles->sum('peso_bruto'));
            $peso_neto  = max(0, $peso_neto  - $detalles->sum('peso_neto'));

            if ($peso_neto > 0) {
                $list_items[] = [
                    "item" => $item,
                    "cajas" => $cajas,
                    "taras" => $taras,
                    "peso_bruto" => $peso_bruto,
                    "peso_neto" => $peso_neto,
                    "list" => $m
                ];
            }
        }
        $pt->items = $list_items;

        $cajas = 0;
        $pollos = 0;
        $peso_bruto = 0;
        $peso_neto = 0;
        $tara = 0;
        $traspaso = $pt->PtTraspasoPps;
        foreach ($traspaso as $t) {
            $cajas += $t->TraspasoPp->cajas;
            $pollos += $t->TraspasoPp->pollos;
            $peso_bruto += $t->TraspasoPp->peso_bruto;
            $peso_neto += $t->TraspasoPp->peso_neto;
            $tara += max(0, ($t->TraspasoPp->peso_bruto - $t->TraspasoPp->peso_neto) * ($t->TraspasoPp->cajas * 2));
        }
        $items_collection = collect($pt->items);
        $pt->tara_items = $items_collection->sum('taras');
        $pt->cajas_items = $items_collection->sum('cajas');
        $pt->peso_bruto_items = $items_collection->sum('peso_bruto');
        $pt->peso_neto_items = $items_collection->sum('peso_neto');
        $cajas_d = $pt->DescomponerPts()->sum('cajas');
        $pollos_d = $pt->DescomponerPts()->sum('pollos');
        $peso_bruto_d = $pt->DescomponerPts()->sum('peso_bruto');
        $peso_neto_d = $pt->DescomponerPts()->sum('peso_neto');
        $tara_d = $peso_bruto_d - $peso_neto_d;
        foreach ($pt->DetallePts as $de) {
            $cajas += $de->cajas;
            $pollos += $de->pollos;
            $peso_bruto += $de->peso_bruto;
            $peso_neto += $de->peso_neto;
            $tara += max(0, ($de->peso_bruto - $de->peso_neto) * ($de->cajas * 2));
        }
        $pt->cajas_disponibles = $cajas - $cajas_d;
        $pt->pollos_disponibles = $pollos - $pollos_d;
        $pt->peso_bruto_disponibles = $peso_bruto - $peso_bruto_d;
        $pt->peso_neto_disponibles = $peso_neto - $peso_neto_d;
        $pt->tara_disponibles = $tara - $tara_d;
        $pt->pollos_x_caja = (float)$pt->pollos_disponibles / ($pt->cajas_disponibles == 0 ? 1 : $pt->cajas_disponibles);
        $pt->peso_bruto_x_unitario = (float)$pt->peso_bruto_disponibles / ($pt->pollos_disponibles == 0 ? 1 : $pt->pollos_disponibles);
        $pt->peso_neto_x_unitario = (float)$pt->peso_neto_disponibles / ($pt->pollos_disponibles == 0 ? 1 : $pt->pollos_disponibles);

        $pt->url_pdf = url('reportes/pt/' . $pt->id);

        return $pt;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pt  $pt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pt $pt)
    {
        $pt->name = $request->name;
        $pt->save();
        return $pt;
    }
    public function retornarDetallesMasa(Request $request, Sucursal $sucursal)
    {
        $pps = Pt::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $pt) {
            foreach ($pt->DetallePts as $ptDetalle) {
                $ptDetalle->estado = 0;
                $ptDetalle->save();
                $ptDetalle->LoteDetalleMovimiento->estado = 0;
                $ptDetalle->LoteDetalleMovimiento->save();
            }
        }
        return $list;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pt  $pt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pt $pt)
    {
        $pt->estado = 0;
        $pt->save();
    }
    public function pdf(Pt $pt)
    {
        $pt = $this->showPT($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.detalle', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_entrada_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_entrada_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_general_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_general_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_envio_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_envio_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_venta_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_venta_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_descomponer_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_descomponer_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_informe_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
        $list_items = [];

        foreach ($group_items as $m) {
            $item = $m->first()->Item;

            $list_items[] = [
                "item" => $item,
                "list" => $m
            ];
        }
        $pt->items = $list_items;
        $pdf = Pdf::loadView('reportes.pdf.pt.informe', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pt_informe(Pt $pt)
    {
        $pt = $this->showPt($pt);
        return $pt;
    }
    public function pt_items_lotes_pdf(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
        $list_items = [];

        foreach ($group_items as $m) {
            $item = $m->first()->Item;

            $list_items[] = [
                "item" => $item,
                "list" => $m
            ];
        }
        $pt->items = $list_items;
        $pdf = Pdf::loadView('reportes.pdf.pt.pt_items_lotes_pdf', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function PesoInicialPt(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
        $list_items = [];

        foreach ($group_items as $m) {
            $item = $m->first()->Item;

            $list_items[] = [
                "item" => $item,
                "list" => $m
            ];
        }
        $pt->items = $list_items;
        $pdf = Pdf::loadView('reportes.pdf.pt.peso_inicial', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function PesoInicial2Pt(Pt $pt)
    {
        $pt = $this->showPt($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
        $list_items = [];

        foreach ($group_items as $m) {
            $item = $m->first()->Item;

            $list_items[] = [
                "item" => $item,
                "list" => $m
            ];
        }
        $pt->items = $list_items;
        $pdf = Pdf::loadView('reportes.pdf.pt.peso_inicial_2', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    // public function PesoInicialTotalPt(Pt $pt)
    // {
    //     $pt = $this->showPt($pt);
    //     $sucursal = $pt->Sucursal;

    //     $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
    //         $file->path_url = url($file->File->path);
    //     });
    //     $sucursal->image = $sucursal->file_sucursals->first();
    //     $group_items = $pt->ItemsPts()->get()->groupBy('item_id');
    //     $list_items = [];

    //     foreach ($group_items as $m) {
    //         $item = $m->first()->Item;

    //         $list_items[] = [
    //             "item"=>$item,
    //             "list"=>$m
    //         ];
    //     }
    //     $pt->items = $list_items;
    //     $pdf = Pdf::loadView('reportes.pdf.pt.peso_inicial_total',[
    //         'pt'=>$pt,
    //         'sucursal'=>$sucursal
    //     ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
    //     return $pdf->stream();
    // }


    public function PesoInicialTotalPt(Pt $pt)
    {
        $pt = $this->showPT($pt);
        $sucursal = $pt->sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pt->loadMissing([
            'PtTraspasoPps.TraspasoPp.Pp',
            'PtTraspasoPps.User',
            'ItemsPts.Item',
            'ItemsPts.PpEmisor',
            'ItemsPts.PtEmisor',
            'ItemsPts.User',
            'DetallePts'
        ]);

        $mapItem = function ($i) {

            $emisorTipo = null;
            $emisorNro  = null;


            if ((int)$i->tipo === 1 && optional($i->PpEmisor)->nro) {
                $emisorTipo = 'PP';
                $emisorNro  = $i->PpEmisor->nro;
            } elseif ((int)$i->tipo === 2 && optional($i->PtEmisor)->nro) {
                $emisorTipo = 'PT';
                $emisorNro  = $i->PtEmisor->nro;
            }

            return [
                'id'         => $i->id,
                'fecha'      => $i->created_at,
                'item_id'    => $i->item_id,
                'item_name'  => optional($i->Item)->name,
                'cajas'      => (float) $i->cajas,
                'peso_bruto' => (float) $i->peso_bruto,
                'taras'      => (float) $i->taras,
                'peso_neto'  => (float) $i->peso_neto,

                'user_id'      => $i->user_id,
                'user_name'    => optional($i->User)->nombre,

                'pp_emisor_id' => $i->pp_emisor_id,
                'pt_emisor_id' => $i->pt_emisor_id,
                'emisor_tipo'  => $emisorTipo,
                'emisor_nro'   => $emisorNro,
                'emisor_label' => $emisorTipo && $emisorNro
                    ? "{$emisorTipo} {$emisorNro}"
                    : null,

            ];
        };

        // Filtramos por tipo
        $items_1 = $pt->ItemsPts->where('tipo', 1)->values();
        $items_2 = $pt->ItemsPts->where('tipo', 2)->values();

        // Totales por tipo
        $totales_1 = [
            'cajas'      => (float) $items_1->sum('cajas'),
            'peso_bruto' => (float) $items_1->sum('peso_bruto'),
            'taras'      => (float) $items_1->sum('taras'),
            'peso_neto'  => (float) $items_1->sum('peso_neto'),
        ];

        $totales_2 = [
            'cajas'      => (float) $items_2->sum('cajas'),
            'peso_bruto' => (float) $items_2->sum('peso_bruto'),
            'taras'      => (float) $items_2->sum('taras'),
            'peso_neto'  => (float) $items_2->sum('peso_neto'),
        ];

        // Estructuras para el Blade
        $pt->listado_items_tipo_1 = [
            'items'   => $items_1->map($mapItem)->values(),
            'totales' => $totales_1,
        ];

        $pt->listado_items_tipo_2 = [
            'items'   => $items_2->map($mapItem)->values(),
            'totales' => $totales_2,
        ];

        // (Opcional) Totales combinados 1+2, por si quieres mostrar un total general
        $pt->listado_items_1y2_totales = [
            'cajas'      => $totales_1['cajas']      + $totales_2['cajas'],
            'peso_bruto' => $totales_1['peso_bruto'] + $totales_2['peso_bruto'],
            'taras'      => $totales_1['taras']      + $totales_2['taras'],
            'peso_neto'  => $totales_1['peso_neto']  + $totales_2['peso_neto'],
        ];

        //traspasos desde otro pp
        $traspasosAceptados = $pt->PtTraspasoPps
            ->filter(function ($link) {
                $t = $link->TraspasoPp;
                return $t && (int)($t->tipo) === 2 && (int)($t->aceptado ?? 0) === 1;
            })
            ->values();

        $pt->traspasos_aceptados_pp = $traspasosAceptados->map(function ($link) {
            $t = $link->TraspasoPp;
            $u = $link->User;
            return [
                'id'          => $t->id,
                'fecha'       => $t->updated_at,
                'pp'          => $t->Pp ? ['id' => $t->Pp->id, 'nro' => $t->Pp->nro ?? null] : null,
                'user'        => $u ? ($u->nombre ?? $u->name ?? null) : null,
                'cajas'       => (float) $t->cajas,
                'pollos'      => (float) $t->pollos,
                'peso_bruto'  => (float) $t->peso_bruto,
                'peso_neto'   => (float) $t->peso_neto,
                'merma_bruta' => (float) ($t->merma_bruta ?? 0),
                'merma_neta'  => (float) ($t->merma_neta ?? 0),
            ];
        })->values();
        $pt->traspasos_aceptados_pp_totales = [
            'cajas'       => $pt->traspasos_aceptados_pp->sum('cajas'),
            'pollos'      => $pt->traspasos_aceptados_pp->sum('pollos'),
            'peso_bruto'  => $pt->traspasos_aceptados_pp->sum('peso_bruto'),
            'peso_neto'   => $pt->traspasos_aceptados_pp->sum('peso_neto'),
            'merma_bruta' => $pt->traspasos_aceptados_pp->sum('merma_bruta'),
            'merma_neta'  => $pt->traspasos_aceptados_pp->sum('merma_neta'),
        ];
        //traspasos desde otro pp

        $bloques = [];
        foreach ($pt->DescomponerPts as $d) {
            $sum_cajas_h   = $d->ItemsPts->sum('cajas');
            $sum_bruto_h   = $d->ItemsPts->sum('peso_bruto');
            $sum_taras_h   = $d->ItemsPts->sum('taras');
            $sum_neto_h    = $d->ItemsPts->sum('peso_neto');

            $padre = [
                'id'         => $d->id,
                'fecha'      => $d->created_at,
                'cajas'      => (float) $d->cajas,
                'pollos'     => (float) $d->pollos,
                'peso_bruto' => (float) $d->peso_bruto,
                'peso_neto'  => (float) $d->peso_neto,
                'tara'       => (float) $d->peso_bruto - (float) $d->peso_neto,
            ];

            $merma_neta = max(0, $padre['peso_neto'] - $sum_neto_h);
            $merma_bruta = max(0, $padre['peso_bruto'] - $sum_bruto_h);
            $merma_tara  = max(0, $padre['tara'] - $sum_taras_h);
            $merma_cajas = max(0.0, $padre['cajas'] - $sum_cajas_h);

            $hijos = $d->ItemsPts->map(function ($i) {
                return [
                    'created_at' => $i->created_at,
                    'item_name'  => optional($i->Item)->name,
                    'item_id'    => $i->item_id,
                    'recep'      => $i->recep,
                    'cajas'      => (float) $i->cajas,
                    'peso_bruto' => (float) $i->peso_bruto,
                    'taras'      => (float) $i->taras,
                    'peso_neto'  => (float) $i->peso_neto,
                ];
            })->values();

            $bloques[] = [
                'padre' => $padre,
                'hijos' => $hijos,
                'totales_hijos' => [
                    'cajas'      => $sum_cajas_h,
                    'peso_bruto' => $sum_bruto_h,
                    'taras'      => $sum_taras_h,
                    'peso_neto'  => $sum_neto_h,
                ],
                'merma' => [
                    'cajas'      => $merma_cajas,
                    'peso_bruto' => $merma_bruta,
                    'taras'      => $merma_tara,
                    'peso_neto'  => $merma_neta,
                ],
            ];
        }

        $pt->bloques_descomp = collect($bloques);

        $tot_hijos = [
            'cajas'      => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['cajas']),
            'peso_bruto' => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['peso_bruto']),
            'taras'      => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['taras']),
            'peso_neto'  => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['peso_neto']),
        ];

        $tot_merma = [
            'cajas'      => $pt->bloques_descomp->sum(fn($b) => $b['merma']['cajas']),
            'peso_bruto' => $pt->bloques_descomp->sum(fn($b) => $b['merma']['peso_bruto']),
            'taras'      => $pt->bloques_descomp->sum(fn($b) => $b['merma']['taras']),
            'peso_neto'  => $pt->bloques_descomp->sum(fn($b) => $b['merma']['peso_neto']),
        ];

        $pt->totales_descomp = $tot_hijos;
        $pt->totales_merma   = $tot_merma;


        $items_descomp = $pt->DescomponerPts->flatMap(function ($d) {
            return $d->ItemsPts;
        });

        $items_1y2 = $pt->ItemsPts->whereIn('tipo', [1, 2]);
        $items_para_totales = $items_descomp->concat($items_1y2);
        $totalesPorItem = $items_para_totales
            ->groupBy('item_id')
            ->map(function ($grp) {
                $first = $grp->first();
                return [
                    'item_id'    => $first->item_id,
                    'item_name'  => optional($first->Item)->name,
                    'cajas'      => (float) $grp->sum('cajas'),
                    'peso_bruto' => (float) $grp->sum('peso_bruto'),
                    'taras'      => (float) $grp->sum('taras'),
                    'peso_neto'  => (float) $grp->sum('peso_neto'),
                    'conteo'     => $grp->count(),
                ];
            })
            ->values()
            ->sortBy(function ($x) {
                return mb_strtolower($x['item_name'] ?? '');
            })
            ->values();

        $pt->totales_por_item = $totalesPorItem;

        $pt->totales_por_item_totales = [
            'cajas'      => (float) $pt->totales_por_item->sum('cajas'),
            'peso_bruto' => round((float) $pt->totales_por_item->sum('peso_bruto'), 3),
            'taras'      => (float) $pt->totales_por_item->sum('taras'),
            'peso_neto'  => round((float) $pt->totales_por_item->sum('peso_neto'), 3),
        ];
        // Asegura tener DetallePts cargado (con sus filtros ya definidos en el modelo)


        // Colecciones separadas por tipo de peso inicial
        $pi1 = $pt->DetallePts->where('peso_inicial_tipo', 1);
        $pi2 = $pt->DetallePts->where('peso_inicial_tipo', 2);

        // Sumas de PI1
        $pi1_pollos     = (float) $pi1->sum('pollos');
        $pi1_cajas      = (float) $pi1->sum('cajas');
        $pi1_bruto      = (float) $pi1->sum('peso_bruto');
        $pi1_neto       = (float) $pi1->sum('peso_neto');
        $pi1_tara       = $pi1_bruto - $pi1_neto;

        // Sumas de PI2
        $pi2_pollos     = (float) $pi2->sum('pollos');
        $pi2_cajas      = (float) $pi2->sum('cajas');
        $pi2_bruto      = (float) $pi2->sum('peso_bruto');
        $pi2_neto       = (float) $pi2->sum('peso_neto');
        $pi2_tara       = $pi2_bruto - $pi2_neto;

        // Traspasos aceptados (ya lo tienes calculado arriba)
        $tras_cajas     = (float) ($pt->traspasos_aceptados_pp_totales['cajas']       ?? 0);
        $tras_pollos    = (float) ($pt->traspasos_aceptados_pp_totales['pollos']      ?? 0);
        $tras_bruto     = (float) ($pt->traspasos_aceptados_pp_totales['peso_bruto']  ?? 0);
        $tras_neto      = (float) ($pt->traspasos_aceptados_pp_totales['peso_neto']   ?? 0);
        $tras_tara      = (float) ($pt->traspasos_aceptados_pp_totales['merma_bruta'] ?? 0);

        // Totales “saldo general inicial” (antes de descomposición)
        $saldo_pollos   = $tras_pollos + $pi1_pollos + $pi2_pollos;
        $saldo_cajas    = $tras_cajas  + $pi1_cajas  + $pi2_cajas;
        $saldo_bruto    = $tras_bruto  + $pi1_bruto  + $pi2_bruto;
        $saldo_neto     = $tras_neto   + $pi1_neto   + $pi2_neto;
        $saldo_tara     = $saldo_bruto - $saldo_neto;

        $pt->resumen_inicial = [
            'traspasos' => [
                'cajas'      => $tras_cajas,
                'pollos'     => $tras_pollos,
                'peso_bruto' => $tras_bruto,
                'peso_neto'  => $tras_neto,
                'tara'       => $tras_tara,
            ],
            'pi1' => [
                'cajas'      => $pi1_cajas,
                'pollos'     => $pi1_pollos,
                'peso_bruto' => $pi1_bruto,
                'peso_neto'  => $pi1_neto,
                'tara'       => $pi1_tara,
            ],
            'pi2' => [
                'cajas'      => $pi2_cajas,
                'pollos'     => $pi2_pollos,
                'peso_bruto' => $pi2_bruto,
                'peso_neto'  => $pi2_neto,
                'tara'       => $pi2_tara,
            ],
            'totales' => [
                'cajas'      => $saldo_cajas,
                'pollos'     => $saldo_pollos,
                'peso_bruto' => $saldo_bruto,
                'peso_neto'  => $saldo_neto,
                'tara'       => $saldo_tara,
            ],
        ];

        // ===== BALANCE FINAL (SOBRANTE) =====
        $ini_cajas = (float)($pt->resumen_inicial['totales']['cajas']      ?? 0);
        $ini_pollos = (float)($pt->resumen_inicial['totales']['pollos']     ?? 0);
        $ini_bruto = (float)($pt->resumen_inicial['totales']['peso_bruto'] ?? 0);
        $ini_neto  = (float)($pt->resumen_inicial['totales']['peso_neto']  ?? 0);
        $ini_tara  = (float)($pt->resumen_inicial['totales']['tara']       ?? 0);

        $des_cajas = (float)($pt->totales_descomp['cajas']      ?? 0);
        $des_bruto = (float)($pt->totales_descomp['peso_bruto'] ?? 0);
        $des_taras = (float)($pt->totales_descomp['taras']      ?? 0);
        $des_neto  = (float)($pt->totales_descomp['peso_neto']  ?? 0);

        $mer_cajas = (float)($pt->totales_merma['cajas']      ?? 0);
        $mer_bruto = (float)($pt->totales_merma['peso_bruto'] ?? 0);
        $mer_taras = (float)($pt->totales_merma['taras']      ?? 0);
        $mer_neto  = (float)($pt->totales_merma['peso_neto']  ?? 0);

        $pollos_descomp = (float)$pt->DescomponerPts->sum('pollos');

        $sb_cajas = max(0, $ini_cajas - $des_cajas - $mer_cajas);
        $sb_bruto = max(0, round($ini_bruto - $des_bruto - $mer_bruto, 3));
        $sb_taras = max(0, $ini_tara  - $des_taras - $mer_taras);
        $sb_neto  = max(0, round($ini_neto  - $des_neto  - $mer_neto, 3));

        $sb_pollos = max(0, $ini_pollos - $pollos_descomp);

        $pt->resumen_sobrante = [
            'inicial' => [
                'cajas'      => $ini_cajas,
                'pollos'     => $ini_pollos,
                'peso_bruto' => $ini_bruto,
                'peso_neto'  => $ini_neto,
                'tara'       => $ini_tara,
            ],
            'descomp' => [
                'cajas'      => $des_cajas,
                'pollos'     => $pollos_descomp,
                'peso_bruto' => $des_bruto,
                'peso_neto'  => $des_neto,
                'tara'       => $des_taras,
            ],
            'merma' => [
                'cajas'      => $mer_cajas,
                'peso_bruto' => $mer_bruto,
                'peso_neto'  => $mer_neto,
                'tara'       => $mer_taras,
            ],
            'sobrante' => [
                'cajas'      => $sb_cajas,
                'pollos'     => $sb_pollos,
                'peso_bruto' => $sb_bruto,
                'peso_neto'  => $sb_neto,
                'tara'       => $sb_taras,
            ],
        ];

        $pdf = Pdf::loadView('reportes.pdf.pt.peso_inicial_total', [
            'pt'       => $pt,
            'sucursal' => $sucursal,
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ReporteVentas(Pt $pt)
    {
        $pt = $this->showPTReporteVenta($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.pt.reporte_venta', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ReporteMovimientosPt(Pt $pt)
    {
        $pt = $this->showPTReporteVenta($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.pt.reporte_movimiento_pt', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ReporteGeneral(Pt $pt)
    {
        $pt = $this->showPTReporteGeneral($pt);
        $sucursal = $pt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pt->loadMissing([
            'PtTraspasoPps.TraspasoPp.Pp',
            'PtTraspasoPps.User',
            'ItemsPts.Item',
            'ItemsPts.PpEmisor',
            'ItemsPts.PtEmisor',
            'ItemsPts.User',
            'DetallePts'
        ]);

        $mapItem = function ($i) {

            $emisorTipo = null;
            $emisorNro  = null;


            if ((int)$i->tipo === 1 && optional($i->PpEmisor)->nro) {
                $emisorTipo = 'PP';
                $emisorNro  = $i->PpEmisor->nro;
            } elseif ((int)$i->tipo === 2 && optional($i->PtEmisor)->nro) {
                $emisorTipo = 'PT';
                $emisorNro  = $i->PtEmisor->nro;
            }

            return [
                'id'         => $i->id,
                'fecha'      => $i->created_at,
                'item_id'    => $i->item_id,
                'item_name'  => optional($i->Item)->name,
                'cajas'      => (float) $i->cajas,
                'peso_bruto' => (float) $i->peso_bruto,
                'taras'      => (float) $i->taras,
                'peso_neto'  => (float) $i->peso_neto,

                'user_id'      => $i->user_id,
                'user_name'    => optional($i->User)->nombre,

                'pp_emisor_id' => $i->pp_emisor_id,
                'pt_emisor_id' => $i->pt_emisor_id,
                'emisor_tipo'  => $emisorTipo,
                'emisor_nro'   => $emisorNro,
                'emisor_label' => $emisorTipo && $emisorNro
                    ? "{$emisorTipo} {$emisorNro}"
                    : null,

            ];
        };

        // Filtramos por tipo
        $items_1 = $pt->ItemsPts->where('tipo', 1)->values();
        $items_2 = $pt->ItemsPts->where('tipo', 2)->values();

        // Totales por tipo
        $totales_1 = [
            'cajas'      => (float) $items_1->sum('cajas'),
            'peso_bruto' => (float) $items_1->sum('peso_bruto'),
            'taras'      => (float) $items_1->sum('taras'),
            'peso_neto'  => (float) $items_1->sum('peso_neto'),
        ];

        $totales_2 = [
            'cajas'      => (float) $items_2->sum('cajas'),
            'peso_bruto' => (float) $items_2->sum('peso_bruto'),
            'taras'      => (float) $items_2->sum('taras'),
            'peso_neto'  => (float) $items_2->sum('peso_neto'),
        ];

        // Estructuras para el Blade
        $pt->listado_items_tipo_1 = [
            'items'   => $items_1->map($mapItem)->values(),
            'totales' => $totales_1,
        ];

        $pt->listado_items_tipo_2 = [
            'items'   => $items_2->map($mapItem)->values(),
            'totales' => $totales_2,
        ];

        // (Opcional) Totales combinados 1+2, por si quieres mostrar un total general
        $pt->listado_items_1y2_totales = [
            'cajas'      => $totales_1['cajas']      + $totales_2['cajas'],
            'peso_bruto' => $totales_1['peso_bruto'] + $totales_2['peso_bruto'],
            'taras'      => $totales_1['taras']      + $totales_2['taras'],
            'peso_neto'  => $totales_1['peso_neto']  + $totales_2['peso_neto'],
        ];

        //traspasos desde otro pp
        $traspasosAceptados = $pt->PtTraspasoPps
            ->filter(function ($link) {
                $t = $link->TraspasoPp;
                return $t && (int)($t->tipo) === 2 && (int)($t->aceptado ?? 0) === 1;
            })
            ->values();

        $pt->traspasos_aceptados_pp = $traspasosAceptados->map(function ($link) {
            $t = $link->TraspasoPp;
            $u = $link->User;
            return [
                'id'          => $t->id,
                'fecha'       => $t->updated_at,
                'pp'          => $t->Pp ? ['id' => $t->Pp->id, 'nro' => $t->Pp->nro ?? null] : null,
                'user'        => $u ? ($u->nombre ?? $u->name ?? null) : null,
                'cajas'       => (float) $t->cajas,
                'pollos'      => (float) $t->pollos,
                'peso_bruto'  => (float) $t->peso_bruto,
                'peso_neto'   => (float) $t->peso_neto,
                'merma_bruta' => (float) ($t->merma_bruta ?? 0),
                'merma_neta'  => (float) ($t->merma_neta ?? 0),
            ];
        })->values();
        $pt->traspasos_aceptados_pp_totales = [
            'cajas'       => $pt->traspasos_aceptados_pp->sum('cajas'),
            'pollos'      => $pt->traspasos_aceptados_pp->sum('pollos'),
            'peso_bruto'  => $pt->traspasos_aceptados_pp->sum('peso_bruto'),
            'peso_neto'   => $pt->traspasos_aceptados_pp->sum('peso_neto'),
            'merma_bruta' => $pt->traspasos_aceptados_pp->sum('merma_bruta'),
            'merma_neta'  => $pt->traspasos_aceptados_pp->sum('merma_neta'),
        ];
        //traspasos desde otro pp

        $bloques = [];
        foreach ($pt->DescomponerPts as $d) {
            $sum_cajas_h   = $d->ItemsPts->sum('cajas');
            $sum_bruto_h   = $d->ItemsPts->sum('peso_bruto');
            $sum_taras_h   = $d->ItemsPts->sum('taras');
            $sum_neto_h    = $d->ItemsPts->sum('peso_neto');

            $padre = [
                'id'         => $d->id,
                'fecha'      => $d->created_at,
                'cajas'      => (float) $d->cajas,
                'pollos'     => (float) $d->pollos,
                'peso_bruto' => (float) $d->peso_bruto,
                'peso_neto'  => (float) $d->peso_neto,
                'tara'       => (float) $d->peso_bruto - (float) $d->peso_neto,
            ];

            $merma_neta = max(0, $padre['peso_neto'] - $sum_neto_h);
            $merma_bruta = max(0, $padre['peso_bruto'] - $sum_bruto_h);
            $merma_tara  = max(0, $padre['tara'] - $sum_taras_h);
            $merma_cajas = max(0.0, $padre['cajas'] - $sum_cajas_h);

            $hijos = $d->ItemsPts->map(function ($i) {
                return [
                    'created_at' => $i->created_at,
                    'item_name'  => optional($i->Item)->name,
                    'item_id'    => $i->item_id,
                    'recep'      => $i->recep,
                    'cajas'      => (float) $i->cajas,
                    'peso_bruto' => (float) $i->peso_bruto,
                    'taras'      => (float) $i->taras,
                    'peso_neto'  => (float) $i->peso_neto,
                ];
            })->values();

            $bloques[] = [
                'padre' => $padre,
                'hijos' => $hijos,
                'totales_hijos' => [
                    'cajas'      => $sum_cajas_h,
                    'peso_bruto' => $sum_bruto_h,
                    'taras'      => $sum_taras_h,
                    'peso_neto'  => $sum_neto_h,
                ],
                'merma' => [
                    'cajas'      => $merma_cajas,
                    'peso_bruto' => $merma_bruta,
                    'taras'      => $merma_tara,
                    'peso_neto'  => $merma_neta,
                ],
            ];
        }

        $pt->bloques_descomp = collect($bloques);

        $tot_hijos = [
            'cajas'      => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['cajas']),
            'peso_bruto' => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['peso_bruto']),
            'taras'      => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['taras']),
            'peso_neto'  => $pt->bloques_descomp->sum(fn($b) => $b['totales_hijos']['peso_neto']),
        ];

        $tot_merma = [
            'cajas'      => $pt->bloques_descomp->sum(fn($b) => $b['merma']['cajas']),
            'peso_bruto' => $pt->bloques_descomp->sum(fn($b) => $b['merma']['peso_bruto']),
            'taras'      => $pt->bloques_descomp->sum(fn($b) => $b['merma']['taras']),
            'peso_neto'  => $pt->bloques_descomp->sum(fn($b) => $b['merma']['peso_neto']),
        ];

        $pt->totales_descomp = $tot_hijos;
        $pt->totales_merma   = $tot_merma;


        $items_descomp = $pt->DescomponerPts->flatMap(function ($d) {
            return $d->ItemsPts;
        });

        $items_1y2 = $pt->ItemsPts->whereIn('tipo', [1, 2]);
        $items_para_totales = $items_descomp->concat($items_1y2);
        $totalesPorItem = $items_para_totales
            ->groupBy('item_id')
            ->map(function ($grp) {
                $first = $grp->first();
                return [
                    'item_id'    => $first->item_id,
                    'item_name'  => optional($first->Item)->name,
                    'cajas'      => (float) $grp->sum('cajas'),
                    'peso_bruto' => (float) $grp->sum('peso_bruto'),
                    'taras'      => (float) $grp->sum('taras'),
                    'peso_neto'  => (float) $grp->sum('peso_neto'),
                    'conteo'     => $grp->count(),
                ];
            })
            ->values()
            ->sortBy(function ($x) {
                return mb_strtolower($x['item_name'] ?? '');
            })
            ->values();

        $pt->totales_por_item = $totalesPorItem;

        $pt->totales_por_item_totales = [
            'cajas'      => (float) $pt->totales_por_item->sum('cajas'),
            'peso_bruto' => round((float) $pt->totales_por_item->sum('peso_bruto'), 3),
            'taras'      => (float) $pt->totales_por_item->sum('taras'),
            'peso_neto'  => round((float) $pt->totales_por_item->sum('peso_neto'), 3),
        ];
        // Asegura tener DetallePts cargado (con sus filtros ya definidos en el modelo)


        // Colecciones separadas por tipo de peso inicial
        $pi1 = $pt->DetallePts->where('peso_inicial_tipo', 1);
        $pi2 = $pt->DetallePts->where('peso_inicial_tipo', 2);

        // Sumas de PI1
        $pi1_pollos     = (float) $pi1->sum('pollos');
        $pi1_cajas      = (float) $pi1->sum('cajas');
        $pi1_bruto      = (float) $pi1->sum('peso_bruto');
        $pi1_neto       = (float) $pi1->sum('peso_neto');
        $pi1_tara       = $pi1_bruto - $pi1_neto;

        // Sumas de PI2
        $pi2_pollos     = (float) $pi2->sum('pollos');
        $pi2_cajas      = (float) $pi2->sum('cajas');
        $pi2_bruto      = (float) $pi2->sum('peso_bruto');
        $pi2_neto       = (float) $pi2->sum('peso_neto');
        $pi2_tara       = $pi2_bruto - $pi2_neto;

        // Traspasos aceptados (ya lo tienes calculado arriba)
        $tras_cajas     = (float) ($pt->traspasos_aceptados_pp_totales['cajas']       ?? 0);
        $tras_pollos    = (float) ($pt->traspasos_aceptados_pp_totales['pollos']      ?? 0);
        $tras_bruto     = (float) ($pt->traspasos_aceptados_pp_totales['peso_bruto']  ?? 0);
        $tras_neto      = (float) ($pt->traspasos_aceptados_pp_totales['peso_neto']   ?? 0);
        $tras_tara      = (float) ($pt->traspasos_aceptados_pp_totales['merma_bruta'] ?? 0);

        // Totales “saldo general inicial” (antes de descomposición)
        $saldo_pollos   = $tras_pollos + $pi1_pollos + $pi2_pollos;
        $saldo_cajas    = $tras_cajas  + $pi1_cajas  + $pi2_cajas;
        $saldo_bruto    = $tras_bruto  + $pi1_bruto  + $pi2_bruto;
        $saldo_neto     = $tras_neto   + $pi1_neto   + $pi2_neto;
        $saldo_tara     = $saldo_bruto - $saldo_neto;

        $pt->resumen_inicial = [
            'traspasos' => [
                'cajas'      => $tras_cajas,
                'pollos'     => $tras_pollos,
                'peso_bruto' => $tras_bruto,
                'peso_neto'  => $tras_neto,
                'tara'       => $tras_tara,
            ],
            'pi1' => [
                'cajas'      => $pi1_cajas,
                'pollos'     => $pi1_pollos,
                'peso_bruto' => $pi1_bruto,
                'peso_neto'  => $pi1_neto,
                'tara'       => $pi1_tara,
            ],
            'pi2' => [
                'cajas'      => $pi2_cajas,
                'pollos'     => $pi2_pollos,
                'peso_bruto' => $pi2_bruto,
                'peso_neto'  => $pi2_neto,
                'tara'       => $pi2_tara,
            ],
            'totales' => [
                'cajas'      => $saldo_cajas,
                'pollos'     => $saldo_pollos,
                'peso_bruto' => $saldo_bruto,
                'peso_neto'  => $saldo_neto,
                'tara'       => $saldo_tara,
            ],
        ];

        // ===== BALANCE FINAL (SOBRANTE) =====
        $ini_cajas = (float)($pt->resumen_inicial['totales']['cajas']      ?? 0);
        $ini_pollos = (float)($pt->resumen_inicial['totales']['pollos']     ?? 0);
        $ini_bruto = (float)($pt->resumen_inicial['totales']['peso_bruto'] ?? 0);
        $ini_neto  = (float)($pt->resumen_inicial['totales']['peso_neto']  ?? 0);
        $ini_tara  = (float)($pt->resumen_inicial['totales']['tara']       ?? 0);

        $des_cajas = (float)($pt->totales_descomp['cajas']      ?? 0);
        $des_bruto = (float)($pt->totales_descomp['peso_bruto'] ?? 0);
        $des_taras = (float)($pt->totales_descomp['taras']      ?? 0);
        $des_neto  = (float)($pt->totales_descomp['peso_neto']  ?? 0);

        $mer_cajas = (float)($pt->totales_merma['cajas']      ?? 0);
        $mer_bruto = (float)($pt->totales_merma['peso_bruto'] ?? 0);
        $mer_taras = (float)($pt->totales_merma['taras']      ?? 0);
        $mer_neto  = (float)($pt->totales_merma['peso_neto']  ?? 0);

        $pollos_descomp = (float)$pt->DescomponerPts->sum('pollos');

        $sb_cajas = max(0, $ini_cajas - $des_cajas - $mer_cajas);
        $sb_bruto = max(0, round($ini_bruto - $des_bruto - $mer_bruto, 3));
        $sb_taras = max(0, $ini_tara  - $des_taras - $mer_taras);
        $sb_neto  = max(0, round($ini_neto  - $des_neto  - $mer_neto, 3));

        $sb_pollos = max(0, $ini_pollos - $pollos_descomp);

        $pt->resumen_sobrante = [
            'inicial' => [
                'cajas'      => $ini_cajas,
                'pollos'     => $ini_pollos,
                'peso_bruto' => $ini_bruto,
                'peso_neto'  => $ini_neto,
                'tara'       => $ini_tara,
            ],
            'descomp' => [
                'cajas'      => $des_cajas,
                'pollos'     => $pollos_descomp,
                'peso_bruto' => $des_bruto,
                'peso_neto'  => $des_neto,
                'tara'       => $des_taras,
            ],
            'merma' => [
                'cajas'      => $mer_cajas,
                'peso_bruto' => $mer_bruto,
                'peso_neto'  => $mer_neto,
                'tara'       => $mer_taras,
            ],
            'sobrante' => [
                'cajas'      => $sb_cajas,
                'pollos'     => $sb_pollos,
                'peso_bruto' => $sb_bruto,
                'peso_neto'  => $sb_neto,
                'tara'       => $sb_taras,
            ],
        ];

        $pt->loadMissing([
            'DescomponerPts.ItemsPts.Item',
            'ItemsPts.Item',
            'VentaItemsPts.Item',
            'VentaItemsPts.Venta.User',
            'VentaItemsPts.Venta.Cliente',
            'EnviarItemPtTransformacions.Item',
            'EnviarItemPtTransformacions.User',
            'ItemSobraPts.Item',
            'ItemSobraPts.User',
        ]);

        // ========== 1) SALDO INICIAL POR ITEM (KG/N) ==========
        $items_descomp      = $pt->DescomponerPts->flatMap(fn($d) => $d->ItemsPts);
        $items_1y2          = $pt->ItemsPts->whereIn('tipo', [1, 2]);
        $items_para_totales = $items_descomp->concat($items_1y2);

        $inicial_por_item = $items_para_totales
            ->groupBy('item_id')
            ->map(function ($grp) {
                $first = $grp->first();
                return [
                    'item_id'    => $first->item_id,
                    'item_name'  => optional($first->Item)->name,
                    'cajas'      => (float) $grp->sum('cajas'),
                    'kg_bruto'   => (float) $grp->sum('peso_bruto'),
                    'taras'      => (float) $grp->sum('taras'),
                    'kg_neto'    => (float) $grp->sum('peso_neto'),
                ];
            });

        // ========== 2) VENTAS AGRUPADAS POR ITEM ==========
        $ventas = $pt->VentaItemsPts;

        $ventas_por_item = $ventas
            ->groupBy('item_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy('venta.fecha')->values()->map(function ($v) {
                    $venta = $v->Venta;
                    $anulada = ((int)($v->estado ?? 1) === 0) || ((int)($venta->estado ?? 1) === 0);
                    $cajas    = $anulada ? 0.0 : (float) $v->cajas;
                    $kg_bruto = $anulada ? 0.0 : (float) $v->peso_bruto;
                    $taras    = $anulada ? 0.0 : (float) $v->taras;
                    $kg_neto  = $anulada ? 0.0 : (float) $v->peso_neto;
                    $precio   = $anulada ? 0.0 : (float) ($v->precio ?? 0);
                    $total    = $anulada ? 0.0 : (float) ($v->total  ?? ($kg_neto * $precio));

                    $fecha = optional($venta)->created_at;


                    return [
                        'venta_id'   => optional($venta)->id,
                        'fecha'      => $fecha,
                        'usuario'    => optional(optional($venta)->User)->nombre,
                        'cliente'    => optional(optional($venta)->Cliente)->nombre,
                        'cliente_id' => optional(optional($venta)->Cliente)->id,
                        'anulada'    => $anulada,
                        'cajas'      => $cajas,
                        'kg_bruto'   => $kg_bruto,
                        'tara'       => $taras,
                        'kg_neto'    => round($kg_neto, 3),
                        'precio'     => round($precio, 2),
                        'total'      => round($total, 2),
                    ];
                });


                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                    'total'    => (float) $rows->sum('total'),
                ];

                $first = $grp->first();

                return [
                    'item_id'         => $first->item_id,
                    'item_name'       => optional($first->Item)->name,
                    'totales_vendidos' => $totales,
                    'rows'            => $rows,
                ];
            });


        // ========== 2b) ENVIOS A TRANSFORMACIÓN AGRUPADOS POR ITEM ==========
        $envios = $pt->EnviarItemPtTransformacions;

        $envios_por_item = $envios
            ->groupBy('item_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy('fecha_hora')->values()->map(function ($e) {
                    return [
                        'envio_id'  => $e->id,
                        'fecha'     => $e->fecha_hora,
                        'hora'      => $e->fecha_hora ? \Carbon\Carbon::parse($e->fecha_hora)->format('H:i:s') : null,
                        'usuario'   => optional($e->User)->nombre,
                        'cajas'     => (float) $e->cajas,
                        'kg_bruto'  => (float) $e->peso_bruto,
                        'tara'      => (float) $e->taras,
                        'kg_neto'   => round((float) $e->peso_neto, 3),
                    ];
                });

                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                ];

                $first = $grp->first();

                return [
                    'item_id'          => $first->item_id,
                    'item_name'        => optional($first->Item)->name,
                    'totales_envios'   => $totales,
                    'rows'             => $rows,
                ];
            });

        // ========== 2c) SOBRANTES (TRASPASO A OTRO PT) AGRUPADOS POR ITEM ==========
        $sobrantes = $pt->ItemSobraPts;

        $sobrantes_por_item = $sobrantes
            ->groupBy('item_id')
            ->map(function ($grp) {
                $rows = $grp->sortBy(fn($x) => $x->fecha . ' ' . $x->hora)->values()->map(function ($s) {
                    $fechaHora = trim(($s->fecha ?? '') . ' ' . ($s->hora ?? ''));
                    return [
                        'sobra_id'  => $s->id,
                        'fecha'     => $fechaHora ?: null,
                        'usuario'   => optional($s->User)->nombre,
                        'cajas'     => (float) $s->cajas,
                        'kg_bruto'  => (float) $s->kgb,
                        'tara'      => (float) $s->taras,
                        'kg_neto'   => round((float) ($s->kgn_nuevo ?? 0), 3),
                        'merma'     => round((float) ($s->merma ?? 0), 3),
                    ];
                });

                $totales = [
                    'cajas'    => (float) $rows->sum('cajas'),
                    'kg_bruto' => (float) $rows->sum('kg_bruto'),
                    'taras'    => (float) $rows->sum('tara'),
                    'kg_neto'  => (float) $rows->sum('kg_neto'),
                ];

                $first = $grp->first();

                return [
                    'item_id'           => $first->item_id,
                    'item_name'         => optional($first->Item)->name,
                    'totales_sobrantes' => $totales,
                    'rows'              => $rows,
                ];
            });


        // ========== 3) MEZCLAR “INICIAL” CON “VENTAS” Y CALCULAR SALDO ==========
        $all_item_ids = collect(array_unique(array_merge(
            $inicial_por_item->keys()->all(),
            $ventas_por_item->keys()->all(),
            $envios_por_item->keys()->all(),
            $sobrantes_por_item->keys()->all()
        )));

        $bloques = $all_item_ids->map(function ($item_id) use ($inicial_por_item, $ventas_por_item, $envios_por_item, $sobrantes_por_item) {
            $ini        = $inicial_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0]);
            $ventas     = $ventas_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_vendidos' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);
            $envios     = $envios_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_envios'   => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);
            $sobrantes  = $sobrantes_por_item->get($item_id, ['item_id' => $item_id, 'item_name' => null, 'totales_sobrantes' => ['cajas' => 0, 'kg_bruto' => 0, 'taras' => 0, 'kg_neto' => 0], 'rows' => collect()]);

            $item_name = $ini['item_name'] ?? $ventas['item_name'] ?? $envios['item_name'] ?? $sobrantes['item_name'];

            $saldo = [
                'cajas'    => max(0, ($ini['cajas'] ?? 0)
                    - ($ventas['totales_vendidos']['cajas']    ?? 0)
                    - ($envios['totales_envios']['cajas']      ?? 0)
                    - ($sobrantes['totales_sobrantes']['cajas'] ?? 0)),
                'kg_bruto' => max(0, ($ini['kg_bruto'] ?? 0)
                    - ($ventas['totales_vendidos']['kg_bruto'] ?? 0)
                    - ($envios['totales_envios']['kg_bruto']   ?? 0)
                    - ($sobrantes['totales_sobrantes']['kg_bruto'] ?? 0)),
                'taras'    => max(0, ($ini['taras'] ?? 0)
                    - ($ventas['totales_vendidos']['taras']    ?? 0)
                    - ($envios['totales_envios']['taras']      ?? 0)
                    - ($sobrantes['totales_sobrantes']['taras'] ?? 0)),
                'kg_neto'  => round(
                    ($ini['kg_neto'] ?? 0)
                        - ($ventas['totales_vendidos']['kg_neto'] ?? 0)
                        - ($envios['totales_envios']['kg_neto']   ?? 0)
                        - ($sobrantes['totales_sobrantes']['kg_neto'] ?? 0),
                ),
            ];

            return [
                'item_id'                 => $item_id,
                'item_name'               => $item_name,
                'inicial'                 => [
                    'cajas'    => (float) ($ini['cajas']    ?? 0),
                    'kg_bruto' => (float) ($ini['kg_bruto'] ?? 0),
                    'taras'    => (float) ($ini['taras']    ?? 0),
                    'kg_neto'  => (float) ($ini['kg_neto']  ?? 0),
                ],
                'ventas'                  => $ventas['rows'],
                'totales_ventas'          => $ventas['totales_vendidos'],
                'envios_transf'           => $envios['rows'],
                'totales_envios_transf'   => $envios['totales_envios'],
                'sobrantes_pt'            => $sobrantes['rows'],                 // <- NUEVO
                'totales_sobrantes_pt'    => $sobrantes['totales_sobrantes'],    // <- NUEVO
                'saldo'                   => $saldo,
            ];
        })
            ->sortBy(fn($b) => mb_strtolower($b['item_name'] ?? ''))
            ->values();

        $pt->ventas_por_item_bloques = $bloques;

        // ========== 4) RESUMEN GLOBAL ==========
        $ventas_resumen_global = [
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
            ],
        ];
        $ventas_resumen_global['envios_transf'] = [
            'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['cajas']    ?? 0),
            'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['kg_bruto'] ?? 0),
            'taras'    => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['taras']    ?? 0),
            'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_envios_transf']['kg_neto']  ?? 0),
        ];
        $ventas_resumen_global['sobrantes_pt'] = [
            'cajas'    => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['cajas']    ?? 0),
            'kg_bruto' => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['kg_bruto'] ?? 0),
            'taras'    => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['taras']    ?? 0),
            'kg_neto'  => (float) $bloques->sum(fn($b) => $b['totales_sobrantes_pt']['kg_neto']  ?? 0),
        ];
        $ventas_resumen_global['saldo'] = [
            'cajas'    => max(0, $ventas_resumen_global['inicial']['cajas']
                - $ventas_resumen_global['ventas']['cajas']
                - $ventas_resumen_global['envios_transf']['cajas']
                - $ventas_resumen_global['sobrantes_pt']['cajas']),
            'kg_bruto' => max(0, $ventas_resumen_global['inicial']['kg_bruto']
                - $ventas_resumen_global['ventas']['kg_bruto']
                - $ventas_resumen_global['envios_transf']['kg_bruto']
                - $ventas_resumen_global['sobrantes_pt']['kg_bruto']),
            'taras'    => max(0, $ventas_resumen_global['inicial']['taras']
                - $ventas_resumen_global['ventas']['taras']
                - $ventas_resumen_global['envios_transf']['taras']
                - $ventas_resumen_global['sobrantes_pt']['taras']),
            'kg_neto'  => round(
                $ventas_resumen_global['inicial']['kg_neto']
                    - $ventas_resumen_global['ventas']['kg_neto']
                    - $ventas_resumen_global['envios_transf']['kg_neto']
                    - $ventas_resumen_global['sobrantes_pt']['kg_neto'],
                3
            )
        ];

        $pt->setAttribute('ventas_resumen_global', $ventas_resumen_global);

        $pdf = Pdf::loadView('reportes.pdf.pt.reporte_general', [
            'pt' => $pt,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'portrait')->setOption('enable_php', true);
        return $pdf->stream();
    }
}
