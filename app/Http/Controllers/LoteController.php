<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lote;
use App\Models\Compra;
use App\Models\Categoria;
use App\Models\LoteDetalle;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Lote::with(['Compra', 'User'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url('reportes/lotes/' . $m->id);
            $m->url_seguimiento_pdf = url('reportes/lotes-seguimiento/' . $m->id);
            $m->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $m->id);
            $m->url_seguimiento_cliente_cronologico_pdf = url('reportes/lotes-seguimiento-cliente-cronologico/' . $m->id);
            $m->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico/' . $m->id);
            $m->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $m->id);
            $m->url_seguimiento_producto_pt_pp_pdf = url('reportes/lotes-seguimiento-producto-pt-pp/' . $m->id);
            $m->url_envios_pt_pp_pdf = url('reportes/envios-pt-pp/' . $m->id);
            $m->url_pdf_pp = url('reportes/lotes-pp/' . $m->id);
            $m->url_pdf_pt = url('reportes/lotes-pt/' . $m->id);
            $list[] = $m;
        }
        return $list;
    }
    public function indexV2()
    {
        $model = Lote::with(['Compra', 'User'])->where([['estado', 1], ['fin', 0]])->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url('reportes/lotes/' . $m->id);
            $m->url_seguimiento_pdf = url('reportes/lotes-seguimiento/' . $m->id);
            $m->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $m->id);
            $m->url_seguimiento_cliente_cronologico_pdf = url('reportes/lotes-seguimiento-cliente-cronologico/' . $m->id);
            $m->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico/' . $m->id);
            $m->url_seguimiento_cronologico_movimiento_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $m->id);
            $m->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $m->id);
            $m->url_seguimiento_producto_pt_pp_pdf = url('reportes/lotes-seguimiento-producto-pt-pp/' . $m->id);
            $m->url_envios_pt_pp_pdf = url('reportes/envios-pt-pp/' . $m->id);
            $m->url_pdf_pp = url('reportes/lotes-pp/' . $m->id);
            $m->url_pdf_pt = url('reportes/lotes-pt/' . $m->id);
            $list[] = $m;
        }
        return $list;
    }

    public function indexCerradas()
    {
        $model = Lote::with(['Compra', 'User'])->where([['estado', 1], ['fin', 1]])->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url('reportes/lotes/' . $m->id);
            $m->url_seguimiento_pdf = url('reportes/lotes-seguimiento/' . $m->id);
            $m->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $m->id);
            $m->url_seguimiento_cliente_cronologico_pdf = url('reportes/lotes-seguimiento-cliente-cronologico/' . $m->id);
            $m->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico/' . $m->id);
            $m->url_seguimiento_cronologico_movimiento_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $m->id);
            $m->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $m->id);
            $m->url_seguimiento_producto_pt_pp_pdf = url('reportes/lotes-seguimiento-producto-pt-pp/' . $m->id);
            $m->url_envios_pt_pp_pdf = url('reportes/envios-pt-pp/' . $m->id);
            $m->url_pdf_pp = url('reportes/lotes-pp/' . $m->id);
            $m->url_pdf_pt = url('reportes/lotes-pt/' . $m->id);
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
        $lote = new Lote();
        $lote->compra_id = $request->compra_id;
        $compra = Compra::find($request->compra_id);
        $lote->user_id = 1;
        $lote->precio_venta = $request->precio_venta;
        $lote->valor_venta = $request->valor_venta;
        $lote->pollos = $request->pollos;
        $lote->valor_compra = 0;
        $lote->cajas = $request->cajas;
        $lote->valor_peso = $request->valor_peso;
        $lote->fecha = Carbon::now()->format('Y-m-d');
        $lote->save();
        foreach ($request->lote_detalle as $l) {
            $loteDetalle = new LoteDetalle();
            $loteDetalle->lote_id = $lote->id;
            $loteDetalle->compra_id = $request->compra_id;
            $loteDetalle->cajas = $l['cajas'];
            $loteDetalle->pollos = $l['pollos'] / $l['cajas'];
            $loteDetalle->equivalente = $l['pollos'];
            $loteDetalle->peso_total = $l['valor'];
            $loteDetalle->name = $l['name'];
            $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalle->hora = Carbon::now()->format('H:i:s');
            $loteDetalle->user_id = $lote->user_id;
            $loteDetalle->tipo = "COM";
            $loteDetalle->nro = "E";
            $loteDetalle->id_nro = "{$compra->id}";
            $loteDetalle->detalle = "{$compra->id} COMPRA";
            $loteDetalle->producto = $l['producto_name'];
            $loteDetalle->pigmento = $l['pigmento'];
            $loteDetalle->categoria_id = $l['categoria']['id'];
            $loteDetalle->medida_producto_id = $l['medida_producto']['id'];
            $loteDetalle->sub_medida_id = $l['sub_medida']['id'];
            $loteDetalle->save();
        }
        $lote->url_pdf = url('reportes/lotes/' . $lote->id);
        return $lote;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function show(Lote $lote)
    {
        $lote->compra = $lote->Compra;
        $lote->lote_detalles = $lote->LoteDetalles()->get();
        $lote_detalles_cinta = $lote->LoteDetalles()->get()->groupBy('name');
        $list = [];
        foreach ($lote_detalles_cinta as $m) {
            $lote_detalle = $m->first();
            $list[] = [
                "name" => $lote_detalle->name,
                "cajas" => $m->sum('cajas'),
                "pollos" => $lote_detalle->pollos,
                "equivalente" => $m->sum('equivalente'),
                "peso_total" => $m->sum('peso_total'),
                "taras_total" => ($m->sum('cajas') * 2),
                "peso_neto" => $m->sum('peso_total') - ($m->sum('cajas') * 2),
            ];
        }
        $lote->lote_detalles_cinta = collect($list)->sortByDesc(function ($value) {
            return $value['name'];
        });
        $lote_detalles_cliente = $lote->LoteDetalleClientes()->get()->groupBy('cliente_id');
        $list = [];
        foreach ($lote_detalles_cliente as $m) {
            $lista = $m;
            $lote_detalle = $m->first();
            $list[] = [
                "lote_detalle" => $lote_detalle->Cliente,
                "detalles" => $lista,
            ];
        }
        $lote->lote_detalles_cliente = $list;

        // ! ||--------------------------------------------------------------------------------||
        // ! ||                       SEGUIMIENTO DE PRODUCTOS POR COMPRA                      ||
        // ! ||--------------------------------------------------------------------------------||
        $lote_detalles = $lote->LoteDetalles;
        $lote_detalles_seguimiento_productos = [];
        foreach ($lote_detalles as $lote_detalle) {
            $lotedetallemovimiento = collect($lote_detalle->LoteDetalleMovimientos)->sortByDesc(function ($value) {
                return $value['fecha'];
            });
            $lote_detalle_seguimiento_productos = [];
            $lote_detalle_seguimiento_productos['lote_detalle'] = $lote_detalle;
            $lote_detalle_seguimiento_productos['lote_detalle_movimientos'] = $lotedetallemovimiento;
            $lote_detalles_seguimiento_productos[] = $lote_detalle_seguimiento_productos;
        }



        // ! ||--------------------------------------------------------------------------------||
        // ! ||                   FIN DE SEGUIMIENTO DE PRODUCTOS POR COMPRA                   ||
        // ! ||--------------------------------------------------------------------------------||


        $lote->lote_detalles_seguimiento_productos = $lote_detalles_seguimiento_productos;


        $envios_pp = $lote->DetallePps->each(function ($item, $key) {
            $pp = $item->Pp;
            $item->name = $pp->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $envios_pp_lista = [];
        foreach ($envios_pp as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pp_lista[] = [
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

        $envios_pt = $lote->DetallePts->each(function ($item, $key) {
            $pt = $item->Pt;
            $item->name = $pt->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $envios_pt_lista = [];
        foreach ($envios_pt as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pt_lista[] = [
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
        $lote->reporte_envios_pp = collect($envios_pp_lista);
        $lote->reporte_envios_pt = collect($envios_pt_lista);
        return $lote;
    }
    public function pos(Lote $lote)
    {
        $lote->compra = $lote->Compra;
        $lote->lote_detalles = $lote->LoteDetalles()->get()->each(function ($lote_detalle) {
            $lote_detalle->peso_unit = $lote_detalle->peso_total / $lote_detalle->equivalente;
            $lote_detalle->pollos_movimiento = $lote_detalle->LoteDetalleMovimientos()->sum('cantidad');
            $lote_detalle->cajas_movimiento = $lote_detalle->LoteDetalleMovimientos()->sum('cajas');
            $lote_detalle->pollos_disponibles = $lote_detalle->equivalente - $lote_detalle->pollos_movimiento;
            $lote_detalle->cajas_disponibles = $lote_detalle->cajas - $lote_detalle->cajas_movimiento;
            $lote_detalle->peso_disponible =  $lote_detalle->pollos_disponibles * $lote_detalle->peso_unit;
        });
        $lote->pp_detalles = $lote->PpDetalles()->get()->each(function ($pp_detalle) {
            $pp_detalle->peso_unit = $pp_detalle->peso_total / $pp_detalle->cantidad;
            $pp_detalle->pollos_movimiento = $pp_detalle->PpPts()->sum('cantidad');
            $pp_detalle->pollos_disponibles = $pp_detalle->cantidad - $pp_detalle->pollos_movimiento;
            $pp_detalle->peso_disponible =  $pp_detalle->pollos_disponibles * $pp_detalle->peso_unit;
            $pp_detalle->cajas_total = $pp_detalle->cantidad / $pp_detalle->cajas;
            $pp_detalle->cajas_movimiento = $pp_detalle->pollos_movimiento / $pp_detalle->cajas_total;
            #convertir a numero entero
            $pp_detalle->cajas_disponibles = intval($pp_detalle->cajas - $pp_detalle->cajas_movimiento);
        });
        $lote->pt_detalles = $lote->PtDetalles()->get();

        $lote->pt_descomposicion_detalles = $lote->PtDetalleDescomposicions()->get();
        $lote->pp_descomposicion_detalles = $lote->PpDetalleDescomposicions()->get();
        return $lote;
    }
    public function pp(Lote $lote)
    {
        $lote->compra = $lote->Compra;
        $lote->lote_detalles = $lote->PpDetalles()->get();
        return $lote;
    }
    public function pt(Lote $lote)
    {
        $lote->compra = $lote->Compra;
        $lote->lote_detalles = $lote->PtDetalles()->get();
        return $lote;
    }
    public function pdf_pt(Lote $lote)
    {
        $lote = $this->pt($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lotept', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
    public function pdf_pp(Lote $lote)
    {
        $lote = $this->pp($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lotepp', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {
        $lote->name = $request->name;
        $lote->save();
        return $lote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    // public function general()
    // {
    //     $model = Lote::with(['Compra', 'User'])->where([['estado', 1], ['fin', 0]])->get();
    //     $list = [];
    //     foreach ($model as $m) {
    //         $m->dias = Carbon::parse($m->fecha)->diffInDays(Carbon::now());
    //         $lote_detalles = $m->LoteDetalles()->with('CompraInventario')->orderBy('name', 'asc')->get()->each(function ($lote_detalle) {
    //             $pollos = $lote_detalle->LoteDetalleMovimientos()->sum('cantidad');
    //             $cajas_movimiento = $lote_detalle->LoteDetalleMovimientos()->sum('cajas');
    //             $peso_movimiento = $lote_detalle->LoteDetalleMovimientos()->sum('peso_bruto');
    //             $caja_falta = $lote_detalle->LoteDetalleCompras()->sum('peso_bruto');
    //             $lote_detalle->cajas = $lote_detalle->cajas - $cajas_movimiento;
    //             $peso_bruto_unit = $lote_detalle->peso_total / ($lote_detalle->equivalente == 0 ? 1 : $lote_detalle->equivalente);
    //             $lote_detalle->equivalente = $lote_detalle->equivalente - $pollos;
    //             $lote_detalle->tipo_pollo = $lote_detalle->CompraInventario->tipo_pollo;
    //             $lote_detalle->peso_movimientos = $peso_movimiento;
    //             if ($lote_detalle->CompraInventario->tipo_pollo == 1) {
    //                 $lote_detalle->peso_total = $lote_detalle->equivalente * $peso_bruto_unit;
    //                 $lote_detalle->peso_total_2 = $lote_detalle->peso_total;
    //                 $lote_detalle->peso_total += $caja_falta;
    //             } else {
    //                 $lote_detalle->equivalente = 1;
    //                 $lote_detalle->peso_total_2 = $lote_detalle->peso_total;
    //                 $lote_detalle->peso_total += $caja_falta;
    //             }
    //         });
    //         $m->lote_detalles =  $lote_detalles;
    //         // $lote_detalles = $m->LoteDetalles()->get()->groupBy('name');
    //         // $lista = [];
    //         // foreach($lote_detalles as $lote){
    //         //     $lote_detalle = $lote->first();

    //         //     $cajas = $lote->sum('cajas');

    //         //     $equivalente = $lote->sum('equivalente');
    //         //     $lista[]=[
    //         //         "id"=>$lote_detalle->id,
    //         //         "name"=>$lote_detalle->name,
    //         //         "pollos"=>$lote_detalle->pollos,
    //         //         "equivalente"=>$equivalente,
    //         //         "cajas"=>$cajas
    //         //     ];
    //         // }

    //         // $m->lote_detalles = $lista;
    //         $list[] = $m;
    //     }
    //     return $list;
    // }

    public function general()
    {
        $producto = Producto::with('MedidaProductos.SubMedidas')->find(1);

        $ordenById = [];
        if ($producto && $producto->medidaProductos && $producto->medidaProductos->count()) {
            foreach ($producto->medidaProductos as $mp) {
                foreach (($mp->subMedidas ?? []) as $s) {
                    $curr = $ordenById[$s->id] ?? PHP_INT_MAX;
                    $ordenById[$s->id] = min($curr, (int)($s->nro_orden ?? 9999));
                }
            }
        }
        $model = Lote::with(['Compra', 'User'])
            ->where([['estado', 1], ['fin', 0]])
            ->get();
        $list = [];
        foreach ($model as $m) {
            $m->dias = Carbon::parse($m->fecha)->diffInDays(Carbon::now());
            $lote_detalles = $m->LoteDetalles()
                ->with('CompraInventario')
                ->get()
                ->each(function ($ld) {
                    $pollos           = $ld->LoteDetalleMovimientos()->sum('cantidad');
                    $cajas_movimiento = $ld->LoteDetalleMovimientos()->sum('cajas');
                    $peso_movimiento  = $ld->LoteDetalleMovimientos()->sum('peso_bruto');
                    $caja_falta       = $ld->LoteDetalleCompras()->sum('peso_bruto');

                    $ld->cajas            = $ld->cajas - $cajas_movimiento;
                    $peso_bruto_unit      = $ld->peso_total / ($ld->equivalente == 0 ? 1 : $ld->equivalente);
                    $ld->equivalente      = $ld->equivalente - $pollos;
                    $ld->tipo_pollo       = $ld->CompraInventario->tipo_pollo ?? null;
                    $ld->peso_movimientos = $peso_movimiento;

                    if (($ld->CompraInventario->tipo_pollo ?? null) == 1) {
                        $ld->peso_total   = $ld->equivalente * $peso_bruto_unit;
                        $ld->peso_total_2 = $ld->peso_total;
                        $ld->peso_total  += $caja_falta;
                    } else {
                        $ld->equivalente  = 1;
                        $ld->peso_total_2 = $ld->peso_total;
                        $ld->peso_total  += $caja_falta;
                    }
                });
            $sorted = $lote_detalles->sortBy(function ($ld) use ($ordenById) {
                $subId = $ld->sub_medida_id ?? $ld->CompraInventario->sub_medida_id ?? null;
                $rank  = $ordenById[$subId] ?? 9999;
                $name  = mb_strtoupper(trim((string)($ld->name ?? '')));
                return sprintf('%05d|%s', $rank, $name);
            })->values();
            $m->lote_detalles = $sorted;
            $ordenFinal = $sorted->map(function ($ld) use ($ordenById) {
                $subId = $ld->sub_medida_id ?? $ld->CompraInventario->sub_medida_id ?? null;
                return [
                    'detalle_id'    => $ld->id,
                    'sub_medida_id' => $subId,
                    'nro_orden'     => $ordenById[$subId] ?? 9999,
                    'name'          => $ld->name,
                ];
            })->all();

            // $lote_detalles = $m->LoteDetalles()->get()->groupBy('name');
            // $lista = [];
            // foreach($lote_detalles as $lote){
            //     $lote_detalle = $lote->first();

            //     $cajas = $lote->sum('cajas');

            //     $equivalente = $lote->sum('equivalente');
            //     $lista[]=[
            //         "id"=>$lote_detalle->id,
            //         "name"=>$lote_detalle->name,
            //         "pollos"=>$lote_detalle->pollos,
            //         "equivalente"=>$equivalente,
            //         "cajas"=>$cajas
            //     ];
            // }

            // $m->lote_detalles = $lista;
            $list[] = $m;
        }
        return $list;
    }

    public function generalCompra()
    {
        // $model = Lote::with(['Compra','User'])->where([['estado',1],['fin',0]])->get();
        // $list = [];
        // foreach($model as $m){
        //     $m->lote_detalles = $m->LoteDetalles()->get()->each(function ($lote_detalle) {
        //         $pollos = $lote_detalle->LoteDetalleMovimientos()->sum('cantidad');
        //         $cajas_movimiento = $lote_detalle->LoteDetalleMovimientos()->sum('cajas');
        //         $caja_falta = $lote_detalle->LoteDetalleCompras()->sum('peso_bruto');
        //         $lote_detalle->cajas = $lote_detalle->cajas - $cajas_movimiento;
        //         $peso_bruto_unit = $lote_detalle->peso_total / ($lote_detalle->equivalente==0?1:$lote_detalle->equivalente);
        //         $lote_detalle->equivalente = $lote_detalle->equivalente -$pollos;
        //         $lote_detalle->peso_total = $lote_detalle->equivalente * $peso_bruto_unit;
        //         $lote_detalle->peso_total += $caja_falta;
        //     });
        //     $list[] = $m;
        // }
        $model = Compra::with(['ProveedorCompra'])->where([['estado', 1], ['fin', 0]])->get();
        $list = [];
        foreach ($model as $m) {
            $m->lote_detalles = $m->CompraInventarios()->get()->each(function ($lote) {
                $lote->cajas = (int)$lote->cant;
                $lote->pollos = $lote->nro;
                $lote->peso_total = $lote->valor;
                $lote->equivalente = ((float)$lote->nro) / ((int)$lote->cant);
            });
            $list[] = $m;
        }
        return $list;
    }

    public function destroy(Lote $lote)
    {
        $lote->estado = 0;
        $lote->save();
    }
    // ! ||--------------------------------------------------------------------------------||
    // ! ||                FUNCION PARA REPORTE DE SEGUIMIENTO DE PRODUCTOS                ||
    // ! ||--------------------------------------------------------------------------------||
    public function seguiproducto(Lote $lote)
    {
        $detalles = $lote->LoteDetalles()->get()->groupBy('producto');
        $list2 = [];
        foreach ($detalles as $key => $detalle) {
            $list2[] = [
                "producto" => $key,
                "lote_detalles" => $detalle
            ];
        }
        $lote_detalles_cliente = $lote->LoteDetalleClientes()->get()->groupBy('cliente_id');
        $list = [];
        foreach ($lote_detalles_cliente as $m) {
            $lista = $m;
            $lote_detalle = $m->first();
            $list[] = [
                "lote_detalle" => $lote_detalle->Cliente,
                "detalles" => $lista,
            ];
        }
        $lote->lote_detalles_cliente = $list;
        $lote->detalles = $list2;
        return $lote;
    }
    public function seguicronologico(Lote $lote)
    {
        $detalles = $lote->LoteDetalles()->get()->groupBy('categoria_id');
        $list2 = [];
        foreach ($detalles as $key => $detalle) {
            $categoria = Categoria::find($key);
            $coleccion = collect($detalle);
            $detalle_movimientos = $coleccion->map(function ($objeto) {
                return $objeto->LoteDetalleProductos;
            });
            $detalle_movimientos = $detalle_movimientos->flatten(1);
            $list2[] = [
                "producto" => $categoria->name,
                "lote_detalles" => $detalle,
                "lista_registros" => $detalle_movimientos
            ];
        }
        $lote_detalles_cliente = $lote->LoteDetalleClientes()->get()->groupBy('cliente_id');
        $list = [];
        foreach ($lote_detalles_cliente as $m) {
            $lista = $m;
            $lote_detalle = $m->first();
            $list[] = [
                "lote_detalle" => $lote_detalle->Cliente,
                "detalles" => $lista,
            ];
        }
        $lote->lote_detalles_cliente = $list;
        $lote->detalles = $list2;

        $envios_pp = $lote->DetallePps->each(function ($item, $key) {
            $pp = $item->Pp;
            $item->name = $pp->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $envios_pp_lista = [];
        foreach ($envios_pp as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pp_lista[] = [
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

        $envios_pt = $lote->DetallePts->each(function ($item, $key) {
            $pt = $item->Pt;
            $item->name = $pt->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $envios_pt_lista = [];
        foreach ($envios_pt as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pt_lista[] = [
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
        $lote->reporte_envios_pp = collect($envios_pp_lista);
        $lote->reporte_envios_pt = collect($envios_pt_lista);
        return $lote;
    }
    public function seguicronologico_2(Lote $lote)
    {
        $detalles = $lote->LoteDetalles()->get()->groupBy('categoria_id');
        $list2 = [];
        foreach ($detalles as $key => $detalle) {
            $categoria = Categoria::find($key);
            $coleccion = collect($detalle);
            $detalle_movimientos = $coleccion->map(function ($objeto) {
                return $objeto->LoteDetalleProductos;
            });
            $detalle_movimientos = $detalle_movimientos->flatten(1);
            $list2[] = [
                "producto" => $categoria->name,
                "lote_detalles" => $detalle,
                "lista_registros" => $detalle_movimientos
            ];
        }
        $lote_detalles_cliente = $lote->LoteDetalleClientes()->get()->groupBy('cliente_id');
        $list = [];
        foreach ($lote_detalles_cliente as $m) {
            $lista = $m;
            $lote_detalle = $m->first();
            $list[] = [
                "lote_detalle" => $lote_detalle->Cliente,
                "detalles" => $lista,
            ];
        }
        $lote->lote_detalles_cliente = $list;
        $lote->detalles = $list2;
        return $lote;
    }

    public function seguicronologico_3(Lote $lote)
    {
        $detalles = $lote->LoteDetalles()->get()->groupBy('categoria_id');
        $list2 = [];
        foreach ($detalles as $key => $detalle) {
            $categoria = Categoria::find($key);
            $coleccion = collect($detalle);
            $detalle_movimientos = $coleccion->map(function ($objeto) {
                return $objeto->LoteDetalleProductos;
            });
            $detalle_movimientos = $detalle_movimientos->flatten(1);
            $list2[] = [
                "producto" => $categoria->name,
                "lote_detalles" => $detalle,
                "lista_registros" => $detalle_movimientos
            ];
        }

        $lote_detalles_cliente = $lote->LoteDetalleClientes()->get()->groupBy('cliente_id');
        $list = [];
        foreach ($lote_detalles_cliente as $m) {
            $lista = $m;
            $lote_detalle = $m->first();
            $list[] = [
                "lote_detalle" => $lote_detalle->Cliente,
                "detalles" => $lista,
            ];
        }
        $lote->lote_detalles_cliente = $list;
        $lote->detalles = $list2;

        $envios_pp = $lote->DetallePps->each(function ($item, $key) {
            $pp = $item->Pp;
            $item->name = $pp->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);

        $envios_pp_lista = [];
        foreach ($envios_pp as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pp_lista[] = [
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

        $envios_pt = $lote->DetallePts->each(function ($item, $key) {
            $pt = $item->Pt;
            $item->name = $pt->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);

        $envios_pt_lista = [];
        foreach ($envios_pt as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $envios_pt_lista[] = [
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

        $lote->reporte_envios_pp = collect($envios_pp_lista);
        $lote->reporte_envios_pt = collect($envios_pt_lista);

        // --- Aquí los logs ---
        Log::info('Detalles agrupados por producto:', $list2);
        Log::info('Detalles agrupados por cliente:', $list);
        Log::info('Reporte envíos PP:', $envios_pp_lista);
        Log::info('Reporte envíos PT:', $envios_pt_lista);

        return $lote;
    }

    public function finalizar(Lote $lote)
    {
        $lote->fin = 1;
        $lote->save();
        $compra = $lote->compra;
        $compra->fin = 1;
        $compra->save();
    }
    public function finalizarCompra(Compra $compra)
    {
        $compra->fin = 1;
        $compra->save();
    }


public function pdf(Lote $lote)
{
    Log::info('Iniciando generación de PDF para lote', ['lote_id' => $lote->id]);

    $lote = $this->show($lote);
    Log::info('Lote después de show()', ['lote' => $lote]);

    $sucursal = $lote->Compra->Sucursal;
    Log::info('Sucursal obtenida', [
        'sucursal_id' => $sucursal->id,
        'nombre' => $sucursal->nombre ?? null
    ]);

    $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
        $file->path_url = url($file->File->path);
        Log::info('Archivo de sucursal procesado', [
            'file_id' => $file->id,
            'path_url' => $file->path_url
        ]);
    });

    $sucursal->image = $sucursal->file_sucursals->first();
    Log::info('Imagen de sucursal asignada', [
        'image_id' => $sucursal->image->id ?? null,
        'image_url' => $sucursal->image->path_url ?? null
    ]);

    $compra = $lote->Compra;
    Log::info('Compra obtenida', ['compra_id' => $compra->id]);

    $pdf = Pdf::loadView('reportes.pdf.lote.lote', [
        "sucursal" => $sucursal,
        "compra" => $compra,
        "lote" => $lote
    ])->setOption('enable_php', true);

    Log::info('PDF generado correctamente');

    return $pdf->stream();
}

    public function pdfseg(Lote $lote)
    {
        $lote = $this->show($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });

        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegcliente(Lote $lote)
    {
        $lote = $this->show($lote);
        foreach ($lote->lote_detalles_cliente as $detalle) {
            Log::info('Detalle cliente', [
                'nombre'   => $detalle['lote_detalle']->nombre ?? null,
                'detalles' => $detalle['detalles']->toArray(),
            ]);
        }
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_cliente', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegcliente_cronologico(Lote $lote)
    {
        $lote = $this->seguiproducto($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_cliente_2', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }

    public function pdfsegproducto(Lote $lote)
    {
        $lote = $this->seguiproducto($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_producto', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegproducto_pp_pt(Lote $lote)
    {
        $lote = $this->seguicronologico_2($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_cronologico_pp_pt', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegcronologico(Lote $lote)
    {
        $lote = $this->seguicronologico($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;


        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_cronologico', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegcronologicoMovimiento(Lote $lote)
    {
        $lote = $this->seguicronologico_3($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.lote_seguimiento_cronologico_movimiento', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfsegcronologicoMovimientoCompra(Lote $lote)
    {
        $lote = $this->seguicronologico_3($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.almacen.lote_seguimiento_cronologico_movimiento_compra', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdfenviosptpp(Lote $lote)
    {
        $lote = $this->seguicronologico($lote);
        $sucursal = $lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.envios_pt_pp', [
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
}
