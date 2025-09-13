<?php

namespace App\Http\Controllers;

use App\Models\Pp;
use Carbon\Carbon;
use App\Models\SobraPp;
use App\Models\Sucursal;
use App\Models\DetallePp;
use Illuminate\Http\Request;
use App\Models\PromedioMerma;
use App\Models\SubdetalleDescuentoAcuerdo;
use App\Models\SobraDetallePp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Models\LoteDetalleMovimiento;
use Illuminate\Support\Facades\Auth;

class PpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Pp::where('estado', 1)->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url('reportes/pp/' . $m->id);
            $m->url_informe_pdf = url('reportes/pp-informe/' . $m->id);
            $m->url_inicial_2_pdf = url('reportes/pp-inicial-2/' . $m->id);
            $m->url_inicial_total_pdf = url('reportes/pp-inicial-total/' . $m->id);
            $m->url_entrada_pdf = url('reportes/pp_entrada_lotes/' . $m->id);
            $m->url_general_pdf = url('reportes/pp_general_lotes/' . $m->id);
            $m->url_envio_pdf = url('reportes/pp_envio_lotes/' . $m->id);
            $m->url_venta_pdf = url('reportes/pp_venta_lotes/' . $m->id);
            $m->url_aceptado_pdf = url('reportes/pp_aceptado_lotes/' . $m->id);
            $m->url_cronologico_pdf = url('reportes/pp-cronologico/' . $m->id);
            $m->url_reporte_general_pdf = url('reportes/pp-reporte-general/' . $m->id);
            $m->url_reporte_venta_pdf = url('reportes/pp-reporte-venta/' . $m->id);
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
    public function actualizarDetallesMasa(Request $request)
    {
        foreach ($request->detalle_envio as $d) {
            $DetallePp = DetallePp::where('id', $d['id'])->get()->first();

            $DetallePp->pollos = $d['equivalente'];
            $DetallePp->cajas = $d['cajas'];
            $DetallePp->fecha = Carbon::now()->format('Y-m-d');
            $DetallePp->hora = Carbon::now()->format('H:i:s');
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
    public function store(Request $request)
    {
        $pp = new Pp();
        $pp->nro = $request->nro;
        $pp->fecha = Carbon::now()->format('Y-m-d');
        $pp->sucursal_id = $request->sucursal_id;
        $pp->user_id = $request->user_id;
        $pp->save();
        return $this->showPP($pp);
    }

    public function mes($fecha)
    {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pp  $pp
     * @return \Illuminate\Http\Response
     */
    public function show(Pp $pp)
    {
        $pp->mes = $this->mes($pp->fecha);
        $pp->sucursal = $pp->Sucursal;
        $pp->url_pdf = url('reportes/pp/' . $pp->id);
        $pp->url_inicial_2_pdf = url('reportes/pp-inicial-2/' . $pp->id);
        $pp->url_inicial_total_pdf = url('reportes/pp-inicial-total/' . $pp->id);
        $pp->detalle_pps = $pp->DetallePps;
        $pp->pp_traspaso_pps = $pp->PpTraspasoPps;
        $ingreso_lotes = $pp->DetallePps->each(function ($item, $key) {
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
        $pp_traspaso_pps = $pp->PpTraspasoPps->each(function ($item, $key) {
            $item->pp = $item->Pp;
            $item->user = $item->User;
            $item->cinta_cliente = $item->CintaCliente;
            $item->cajas = $item->TraspasoPp->cajas;
            $item->pollos = $item->TraspasoPp->pollos;
            $item->peso_bruto = $item->TraspasoPp->peso_bruto;
            $item->peso_neto = $item->TraspasoPp->peso_neto;
            $item->tara = $item->peso_bruto - $item->peso_neto;
            return $item;
        });
        $pp->reporte_traspasos_pps = collect($pp_traspaso_pps);
        $pp->reporte_ingresos_lotes = collect($lista_ingresos_lotes);
        return $pp;
    }
    public function showPP(Pp $pp)
    {
        $pp->mes = $this->mes($pp->fecha);
        $pp->url_pdf = url('reportes/pp/' . $pp->id);
        $pp->url_inicial_2_pdf = url('reportes/pp-inicial-2/' . $pp->id);
        $pp->url_inicial_total_pdf = url('reportes/pp-inicial-total/' . $pp->id);
        $ingreso_lotes = $pp->DetallePps->each(function ($item, $key) {
            $compra = $item->LoteDetalle->Compra;
            $item->name = $compra->ProveedorCompra->abreviatura . "-" . $compra->nro;
            $item->cinta = $item->LoteDetalle->producto;
            return $item;
        })->groupBy(['name', 'cinta']);
        $lista_ingresos_lotes = [];
        foreach ($ingreso_lotes as $key => $detalle) {
            foreach ($detalle as $k => $value) {
                $user = $value->first()->User;
                $cajas = $value->sum('cajas');
                $pollos = $value->sum('pollos');
                $peso_bruto = $value->sum('peso_bruto');
                $peso_neto = $value->sum('peso_neto');
                $lista_ingresos_lotes[] = [
                    "lote" => $key,
                    "cinta" => $k,
                    "cajas" => $cajas,
                    "user" => $user,
                    "pollos" => $pollos,
                    "peso_bruto" => $peso_bruto,
                    "peso_neto" => $peso_neto,
                    "tara" => $peso_bruto - $peso_neto
                ];
            }
        }
        $pp_traspaso_pps = $pp->PpTraspasoPps->each(function ($item, $key) {
            $item->pp = $item->Pp;
            $item->user = $item->User;
            $item->cinta_cliente = $item->CintaCliente;
            $item->cajas = $item->TraspasoPp->cajas;
            $item->pollos = $item->TraspasoPp->pollos;
            $item->peso_bruto = $item->TraspasoPp->peso_bruto;
            $item->peso_neto = $item->TraspasoPp->peso_neto;
            $item->tara = $item->peso_bruto - $item->peso_neto;
            return $item;
        });
        $pp->reporte_traspasos_pps = collect($pp_traspaso_pps);
        $pp->reporte_ingresos_lotes = collect($lista_ingresos_lotes);
        return $pp;
    }
    public function detalles(Pp $pp)
    {
        $pp->detalle_pps = $pp->DetallePps;
        return $pp;
    }
    public function detallesV1(Sucursal $sucursal)
    {
        $pps = Pp::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $value) {
            foreach ($value->DetallePps as $item) {
                $item->pp = $item->Pp;
                $list[] = $item;
            }
        }
        return $list;
    }
    public function pps(Sucursal $sucursal)
    {
        $pps = Pp::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $value) {
            $list[] = $value;
        }
        return $list;
    }
    public function showPPCronologico(Pp $pp)
    {
        $pp->mes = $this->mes($pp->fecha);
        $pp->url_pdf = url('reportes/pp/' . $pp->id);
        $pp->url_inicial_2_pdf = url('reportes/pp-inicial-2/' . $pp->id);
        $pp->url_inicial_total_pdf = url('reportes/pp-inicial-total/' . $pp->id);
        $detalle_pp_venta = $pp->VentaDetallePps()->with(['venta.user'])->get()->groupBy('cinta_cliente_id');
        $traspaso_pps_q   = $pp->TraspasoPps()->with(['Pp']);
        $despliegue_pps_q = $pp->DespleguePps()->with(['Pp']);
        $pp_traspaso_pps_q = $pp->PpTraspasoPps();
        $list = [];

        foreach ($detalle_pp_venta as $detalle) {
            $cinta = $detalle->first()->CintaCliente;
            $list[] = [
                'cinta_cliente' => $cinta,
                'detalle'       => $detalle,
                'cajas'         => $detalle->where('estado', 1)->sum('cajas'),
                'pollos'        => $detalle->where('estado', 1)->sum('pollos'),
                'peso_bruto'    => $detalle->where('estado', 1)->sum('peso_bruto'),
                'peso_neto'     => $detalle->where('estado', 1)->sum('peso_neto'),
                'tara'          => $detalle->where('estado', 1)->sum('peso_bruto') - $detalle->where('estado', 1)->sum('peso_neto'),
                'traspasos'     => (clone $pp_traspaso_pps_q)->where('cinta_cliente_id', $cinta->id)->get(),
                'despliegues'   => (clone $despliegue_pps_q)->where('cinta_cliente_id', $cinta->id)->get(),
                'sobras'        => (clone $traspaso_pps_q)->where('cinta_cliente_id_emisor', $cinta->id)->get(),
            ];
        }
        $pp->sobrante_units = (int) (clone $traspaso_pps_q)->sum('pollos');
        $pp->sobrante_kn    = (clone $traspaso_pps_q)->sum('peso_neto');
        $pp->detalle_pp_venta_list = collect($list);
        $promedioMerma = PromedioMerma::where('estado',1)->get()->first();
        $pp->promedioMerma = $promedioMerma->promedio;
        $pp_traspaso_pps_q = $pp->PpTraspasoPps();
        return $pp;
    }

    // public function detalle(Pp $pp)
    // {
    //     $pp->mes             = $this->mes($pp->fecha);
    //     $pp->detalle_pps     = $pp->DetallePps;
    //     $pp->traspaso_pps    = $pp->TraspasoPps;
    //     $pp->desplegue_pps   = $pp->DespleguePps;
    //     $pp_traspaso_pps     = $pp->PpTraspasoPps;
    //     $pp_traspaso_pps_cinta = $pp->PpTraspasoPps()->get()->groupBy('cinta_cliente_id');
    //     $desplegue_pps_cinta   = $pp->DespleguePps()->get()->groupBy('cinta_cliente_id');

    //     $pp_list_traspaso = [];
    //     foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
    //         $pp_list_traspaso[] = $pp_traspaso_pp->TraspasoPp;
    //     }

    //     $pp_list_traspaso_cinta = [];
    //     foreach ($pp_traspaso_pps_cinta as $ppTPpCinta) {
    //         $pp_list_traspaso_cinta[] = [
    //             'cinta_cliente' => $ppTPpCinta->first()?->CintaCliente,
    //             'traspaso_pps'  => $ppTPpCinta
    //         ];
    //     }

    //     $pp_list_desplegue_cinta = [];
    //     foreach ($desplegue_pps_cinta as $desplegue) {
    //         $pp_list_desplegue_cinta[] = [
    //             'cinta_cliente' => $desplegue->first()?->CintaCliente,
    //             'traspaso_pps'  => $desplegue
    //         ];
    //     }

    //     $pp->pp_traspaso_pp_cinta_list = collect($pp_list_traspaso_cinta);
    //     $pp->pp_traspaso_pp_list       = collect($pp_list_traspaso);
    //     $pp->pp_list_desplegue_cinta   = collect($pp_list_desplegue_cinta);

    //     // Sumas seguras (fuerza a numérico siempre)
    //     $cajas_ptpl      = $pp->pp_traspaso_pp_list->sum(fn($x) => (int)   ($x->cajas ?? 0));
    //     $pollos_ptpl     = $pp->pp_traspaso_pp_list->sum(fn($x) => (int)   ($x->pollos ?? 0));
    //     $peso_bruto_ptpl = $pp->pp_traspaso_pp_list->sum(fn($x) => (float) ($x->peso_bruto ?? 0));
    //     $peso_neto_ptpl  = $pp->pp_traspaso_pp_list->sum(fn($x) => (float) ($x->peso_neto ?? 0));
    //     $tara_ptpl       = $peso_bruto_ptpl - $peso_neto_ptpl;

    //     $cajas      = $cajas_ptpl;
    //     $pollos     = $pollos_ptpl;
    //     $peso_bruto = $peso_bruto_ptpl;
    //     $peso_neto  = $peso_neto_ptpl;
    //     $tara       = $tara_ptpl;

    //     $pp_ventas     = $pp->VentaDetallePps->where('estado',1);
    //     $cajas_v       = $pp_ventas->sum(fn($x) => (int)   ($x->cajas ?? 0));
    //     $pollos_v      = $pp_ventas->sum(fn($x) => (int)   ($x->pollos ?? 0));
    //     $peso_bruto_v  = $pp_ventas->sum(fn($x) => (float) ($x->peso_bruto ?? 0));
    //     $peso_neto_v   = $pp_ventas->sum(fn($x) => (float) ($x->peso_neto ?? 0));
    //     $tara_v        = $peso_bruto_v - $peso_neto_v;

    //     $cajas_t       = $pp->TraspasoPps->sum(fn($x) => (int)   ($x->cajas ?? 0));
    //     $pollos_t      = $pp->TraspasoPps->sum(fn($x) => (int)   ($x->pollos ?? 0));
    //     $peso_bruto_t  = $pp->TraspasoPps->sum(fn($x) => (float) ($x->peso_bruto ?? 0));
    //     $peso_neto_t   = $pp->TraspasoPps->sum(fn($x) => (float) ($x->peso_neto ?? 0));
    //     $tara_t        = $peso_bruto_t - $peso_neto_t;

    //     $pp->pp_envio_transformacion_detalles = $pp->PpEnvioTransformacionDetalles;

    //     foreach ($pp->DetallePps as $de) {
    //         $cajas      += (int)   ($de->cajas ?? 0);
    //         $pollos     += (int)   ($de->pollos ?? 0);
    //         $peso_bruto += (float) ($de->peso_bruto ?? 0);
    //         $peso_neto  += (float) ($de->peso_neto ?? 0);
    //         $tara       += (float) (($de->peso_bruto ?? 0) - ($de->peso_neto ?? 0));
    //     }

    //     $pp->cajas_disponibles      = $cajas - $cajas_v - $cajas_t;
    //     $pp->pollos_disponibles     = $pollos - $pollos_v - $pollos_t;
    //     $pp->peso_bruto_disponibles = $peso_bruto - $peso_bruto_v - $peso_bruto_t;
    //     $pp->peso_neto_disponibles  = $peso_neto - $peso_neto_v - $peso_neto_t;
    //     $pp->tara_disponibles       = $tara - $tara_v;
    //     $pp->venta_detalle_pps_1    = $pp->VentaDetallePps()->where('estado',1)->get();
    //     $pp->url_pdf                = url('reportes/pp/'.$pp->id);

    //     return $pp;
    // }


    public function detalle(Pp $pp)
    {
        $pp->mes               = $this->mes($pp->fecha);
        $pp->detalle_pps       = $pp->DetallePps;
        $pp->traspaso_pps      = $pp->TraspasoPps->whereNull('cinta_cliente_id_emisor');
        $pp->desplegue_pps     = $pp->DespleguePps;
        $pp_traspaso_pps       = $pp->PpTraspasoPps;
        $pp->VentaDetallePps   = $pp->VentaDetallePps;
        //$pp_traspaso_pps_cinta = $pp->PpTraspasoPps()->where('estado', 1)->get()->groupBy('cinta_cliente_id');
        //$desplegue_pps_cinta   = $pp->DespleguePps()->where('estado', 1)->get()->groupBy('cinta_cliente_id');
        $pp_traspaso_pps_cinta = $pp->PpTraspasoPps()
            ->where('estado', 1)
            ->with('TraspasoPp')
            ->get()
            ->groupBy('cinta_cliente_id');

        $desplegue_pps_cinta   = $pp->DespleguePps()->where('estado', 1)->get()->groupBy('cinta_cliente_id');


        $pp_list_traspaso = [];
        foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
            $pp_list_traspaso[] = $pp_traspaso_pp->TraspasoPp;
        }

        $pp_list_traspaso_cinta = [];
        foreach ($pp_traspaso_pps_cinta as $ppTPpCinta) {
            $pp_list_traspaso_cinta[] = [
                'cinta_cliente' => $ppTPpCinta->first()?->CintaCliente,
                'traspaso_pps'  => $ppTPpCinta
            ];
        }
        // PARA DESPLIEGUE
        $pp_list_desplegue_cinta = [];

        // Unión de cintas que aparecen en despliegues o en pptraspasopp
        $cinta_ids = collect($desplegue_pps_cinta->keys())
            ->merge($pp_traspaso_pps_cinta->keys())
            ->unique()
            ->values();

        foreach ($cinta_ids as $cintaId) {
            // Colección de despliegues (puede venir vacía)
            $desplegue = $desplegue_pps_cinta->get($cintaId, collect());

            // Intentar obtener el objeto cinta_cliente desde despliegue; si no hay, tomarlo desde pptraspasopp
            $cinta_cliente =
                optional($desplegue->first())->CintaCliente
                ?? optional($pp_traspaso_pps_cinta->get($cintaId))->first()?->CintaCliente;

            // Totales base del DESPLIEGUE (si no hay items, quedan en cero)
            $totales_cinta = $desplegue->reduce(function ($carry, $item) {
                $carry['cajas']       += (int)   ($item->cajas ?? 0);
                $carry['pollos']      += (int)   ($item->pollos ?? 0);
                $carry['peso_bruto']  += (float) ($item->peso_bruto ?? 0);
                $carry['peso_neto']   += (float) ($item->peso_neto ?? 0);
                $carry['merma_bruta'] += (float) ($item->merma_bruta ?? 0);
                $carry['merma_neta']  += (float) ($item->merma_neta ?? 0);
                return $carry;
            }, [
                'cajas' => 0,
                'pollos' => 0,
                'peso_bruto' => 0,
                'peso_neto' => 0,
                'merma_bruta' => 0,
                'merma_neta' => 0
            ]);

            // Sumar PPTRASPASOPP asignados a esta cinta
            $ppTraspGrupo = $pp_traspaso_pps_cinta->get($cintaId, collect());

            $asignados_totales = $ppTraspGrupo->reduce(function ($carry, $ppt) {
                $t = $ppt->TraspasoPp; // requiere ->with('TraspasoPp')
                if ($t) {
                    $carry['cajas']       += (int)   ($t->cajas ?? 0);
                    $carry['pollos']      += (int)   ($t->pollos ?? 0);
                    $carry['peso_bruto']  += (float) ($t->peso_bruto ?? 0);
                    $carry['peso_neto']   += (float) ($t->peso_neto ?? 0);
                    // Si no guardas mermas en TraspasoPp, calculamos merma_bruta = bruto - neto, merma_neta = 0
                    $carry['merma_bruta'] += (float) (($t->peso_bruto ?? 0) - ($t->peso_neto ?? 0));
                    $carry['merma_neta']  += 0;
                }
                return $carry;
            }, [
                'cajas' => 0,
                'pollos' => 0,
                'peso_bruto' => 0,
                'peso_neto' => 0,
                'merma_bruta' => 0,
                'merma_neta' => 0
            ]);

            // Sumar asignaciones a los totales de la cinta
            $totales_cinta['cajas']       += $asignados_totales['cajas'];
            $totales_cinta['pollos']      += $asignados_totales['pollos'];
            $totales_cinta['peso_bruto']  += $asignados_totales['peso_bruto'];
            $totales_cinta['peso_neto']   += $asignados_totales['peso_neto'];
            $totales_cinta['merma_bruta'] += $asignados_totales['merma_bruta'];
            $totales_cinta['merma_neta']  += $asignados_totales['merma_neta'];

            // Restar ventas de la misma cinta
            $ventas_ok_cinta = ($pp->VentaDetallePps ?? collect())
                ->where('estado', 1)
                ->where('cinta_cliente_id', $cintaId);

            $ventas_totales = $ventas_ok_cinta->reduce(function ($carry, $venta) {
                $carry['cajas']      += (int)   ($venta->cajas ?? 0);
                $carry['pollos']     += (int)   ($venta->pollos ?? 0);
                $carry['peso_bruto'] += (float) ($venta->peso_bruto ?? 0);
                $carry['peso_neto']  += (float) ($venta->peso_neto ?? 0);
                return $carry;
            }, ['cajas' => 0, 'pollos' => 0, 'peso_bruto' => 0, 'peso_neto' => 0]);

            $totales_cinta['cajas']      = max(0, $totales_cinta['cajas']      - $ventas_totales['cajas']);
            $totales_cinta['pollos']     = max(0, $totales_cinta['pollos']     - $ventas_totales['pollos']);
            $totales_cinta['peso_bruto'] = max(0, $totales_cinta['peso_bruto'] - $ventas_totales['peso_bruto']);
            $totales_cinta['peso_neto']  = max(0, $totales_cinta['peso_neto']  - $ventas_totales['peso_neto']);

            // Restar traspasos EMITIDOS por esa cinta
            $traspasos_totales = ['cajas' => 0, 'pollos' => 0, 'peso_bruto' => 0, 'peso_neto' => 0];
            $traspasos = $pp->TraspasoPps->where('cinta_cliente_id_emisor', $cintaId);

            if ($traspasos->isNotEmpty()) {
                $traspasos_totales = $traspasos->reduce(function ($carry, $traspaso) {
                    $carry['cajas']      += (int)   ($traspaso->cajas ?? 0);
                    $carry['pollos']     += (int)   ($traspaso->pollos ?? 0);
                    $carry['peso_bruto'] += (float) ($traspaso->peso_bruto ?? 0);
                    $carry['peso_neto']  += (float) ($traspaso->peso_neto ?? 0);
                    return $carry;
                }, $traspasos_totales);

                $totales_cinta['cajas']      = max(0, $totales_cinta['cajas']      - $traspasos_totales['cajas']);
                $totales_cinta['pollos']     = max(0, $totales_cinta['pollos']     - $traspasos_totales['pollos']);
                $totales_cinta['peso_bruto'] = max(0, $totales_cinta['peso_bruto'] - $traspasos_totales['peso_bruto']);
                $totales_cinta['peso_neto']  = max(0, $totales_cinta['peso_neto']  - $traspasos_totales['peso_neto']);
            }

            $pp_list_desplegue_cinta[] = [
                'cinta_cliente' => $cinta_cliente,
                'totales' => $totales_cinta,
                'despliegue_items' => [],
                'despliegue_sobra_items' => []
            ];
        }

        $pp->pp_list_desplegue_cinta = collect($pp_list_desplegue_cinta);
        // PARA DESPLIEGUE


        $pp->pp_traspaso_pp_cinta_list = collect($pp_list_traspaso_cinta);
        $pp->pp_traspaso_pp_list       = collect($pp_list_traspaso);

        // ========= BASE =========
        $cajas_ptpl      = $pp->pp_traspaso_pp_list->sum(fn($x) => (int)($x->cajas ?? 0));
        $pollos_ptpl     = $pp->pp_traspaso_pp_list->sum(fn($x) => (int)($x->pollos ?? 0));
        $peso_bruto_ptpl = $pp->pp_traspaso_pp_list->sum(fn($x) => (float)($x->peso_bruto ?? 0));
        $peso_neto_ptpl  = $pp->pp_traspaso_pp_list->sum(fn($x) => (float)($x->peso_neto ?? 0));
        $tara_ptpl       = $peso_bruto_ptpl - $peso_neto_ptpl;

        // $cajas      = $cajas_ptpl;
        // $pollos     = $pollos_ptpl;
        // $peso_bruto = $peso_bruto_ptpl;
        // $peso_neto  = $peso_neto_ptpl;
        // $tara       = $tara_ptpl;

        $cajas      = 0;
        $pollos     = 0;
        $peso_bruto = 0;
        $peso_neto  = 0;
        $tara       = 0;

        $pp_ventas    = $pp->VentaDetallePps->where('estado', 1);
        // $cajas_v      = (int)   $pp_ventas->sum(fn($x) => (int)($x->cajas ?? 0));
        // $pollos_v     = (int)   $pp_ventas->sum(fn($x) => (int)($x->pollos ?? 0));
        // $peso_bruto_v = (float) $pp_ventas->sum(fn($x) => (float)($x->peso_bruto ?? 0));
        // $peso_neto_v  = (float) $pp_ventas->sum(fn($x) => (float)($x->peso_neto ?? 0));
        // $tara_v       = $peso_bruto_v - $peso_neto_v;

        $cajas_v      = 0;
        $pollos_v     = 0;
        $peso_bruto_v = 0;
        $peso_neto_v  = 0;
        $tara_v       = 0;

        // $cajas_t      = (int)   $pp->TraspasoPps->sum(fn($x) => (int)($x->cajas ?? 0));
        // $pollos_t     = (int)   $pp->TraspasoPps->sum(fn($x) => (int)($x->pollos ?? 0));
        // $peso_bruto_t = (float) $pp->TraspasoPps->sum(fn($x) => (float)($x->peso_bruto ?? 0));
        // $peso_neto_t  = (float) $pp->TraspasoPps->sum(fn($x) => (float)($x->peso_neto ?? 0));
        // $tara_t       = $peso_bruto_t - $peso_neto_t;
        $cajas_t      = 0;
        $pollos_t     = 0;
        $peso_bruto_t = 0;
        $peso_neto_t  = 0;
        $tara_t       = 0;

        $pp->pp_envio_transformacion_detalles = $pp->PpEnvioTransformacionDetalles;

        foreach ($pp->DetallePps as $de) {
            $cajas      += (int)   ($de->cajas ?? 0);
            $pollos     += (int)   ($de->pollos ?? 0);
            $peso_bruto += (float) ($de->peso_bruto ?? 0);
            $peso_neto  += (float) ($de->peso_neto ?? 0);
            $tara       += (float) (($de->peso_bruto ?? 0) - ($de->peso_neto ?? 0));
        }

        // ========= NUEVO: SOBRANTES A PT =========
        // 1) Traer TODOS los envíos de sobrantes con sus detalles (para mostrarlos si quieres)
        $pp->sobra_pps = $pp->SobraPps()
            ->with(['SobraDetallePps.Item'])   // detalles + item
            ->orderBy('id', 'asc')
            ->get();

        // 2) Agregar los totales de sobrantes y RESTAR de disponibles (cajas/pesos)
        $aggSobra = SobraDetallePp::query()
            ->selectRaw('COALESCE(SUM(cajas),0) as cajas, COALESCE(SUM(peso_bruto),0) as pb, COALESCE(SUM(peso_neto),0) as pn')
            ->whereHas('SobraPp', fn($q) => $q->where('pp_id', $pp->id))
            ->first();

        $cajas_sobra      = (int)   ($aggSobra?->cajas ?? 0);
        $peso_bruto_sobra = (float) ($aggSobra?->pb    ?? 0);
        $peso_neto_sobra  = (float) ($aggSobra?->pn    ?? 0);
        $tara_sobra       = $peso_bruto_sobra - $peso_neto_sobra;
        // Nota: SobraDetallePp no tiene 'pollos' → no restamos pollos.
        $pp->retorno_pps = $pp->subdetalleDescuentoAcuerdos()
            ->with(['ventaDetallePp.Item'])
            ->where('estado', 1)
            ->orderBy('id', 'asc')
            ->get();

        $aggSubdetalle = SubdetalleDescuentoAcuerdo::query()
            ->selectRaw('COALESCE(SUM(peso),0) as peso')
            ->where('pp_id', $pp->id)
            ->where('estado', 1)
            ->first();
        $peso_subdetalle = (float) ($aggSubdetalle?->peso ?? 0);

        // ========= DISPONIBLES =========
        $pp->cajas_disponibles = max(0, $cajas - $cajas_v - $cajas_t - $cajas_sobra);
        $pp->pollos_disponibles = max(0, $pollos - $pollos_v - $pollos_t);
        $pp->peso_bruto_disponibles = max(0, $peso_bruto - $peso_bruto_v - $peso_bruto_t - $peso_bruto_sobra + $peso_subdetalle);
        $pp->peso_neto_disponibles = max(0, $peso_neto - $peso_neto_v - $peso_neto_t - $peso_neto_sobra + $peso_subdetalle);
        $pp->tara_disponibles = max(0, $tara - $tara_v - $tara_t - $tara_sobra);

        $pp->venta_detalle_pps_1 = $pp->VentaDetallePps()->where('estado', 1)->get();
        $pp->url_pdf = url('reportes/pp/' . $pp->id);

        return $pp;
    }



    public function sucursalCurso(Sucursal $sucursal)
    {
        $pp = Pp::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pp as $value) {
            $list[] = $this->showPP($value);
        }
        return $list;
    }

    // public function sucursalCursoPos(Sucursal $sucursal)
    // {
    //     $pps = Pp::where('sucursal_id', $sucursal->id)
    //             ->where([['estado', 1], ['curso', 1]])
    //             ->get();

    //     $list = [];

    //     foreach ($pps as $pp) {


    //         // Blindar el acceso a las relaciones
    //         $pp->detalle_pps = $pp->DetallePps;
    //         $pp->traspaso_pps = $pp->TraspasoPps;
    //         $pp->desplegue_pps = $pp->DespleguePps;

    //         // Blindar la colección de traspasos
    //         $pp_traspaso_pps = $pp->PpTraspasoPps;
    //         $pp_list_traspaso = [];
    //         foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
    //             $pp_list_traspaso[] = $pp_traspaso_pp->TraspasoPp;
    //         }

    //         $pp_traspaso_pps_cinta = $pp->PpTraspasoPps()->get()->groupBy('cinta_cliente_id');
    //         $pp_list_traspaso_cinta = [];
    //         foreach ($pp_traspaso_pps_cinta as $ppTPpCinta) {
    //             $cinta_cliente = $ppTPpCinta->first()?->CintaCliente;
    //             $pp_list_traspaso_cinta[] = [
    //                 'cinta_cliente' => $cinta_cliente,
    //                 'traspaso_pps' => $ppTPpCinta
    //             ];
    //         }

    //         $desplegue_pps_cinta = $pp->DespleguePps()->get()->groupBy('cinta_cliente_id');
    //         $pp_list_desplegue_cinta = [];
    //         foreach ($desplegue_pps_cinta as $desplegue) {
    //             $cinta_cliente = $desplegue->first()?->CintaCliente;
    //             $pp_list_desplegue_cinta[] = [
    //                 'cinta_cliente' => $cinta_cliente,
    //                 'traspaso_pps' => $desplegue
    //             ];
    //         }

    //         // Asignar las listas de traspasos
    //         $pp->pp_traspaso_pp_list = collect($pp_list_traspaso);
    //         $pp->pp_traspaso_pp_cinta_list = collect($pp_list_traspaso_cinta);
    //         $pp->pp_list_desplegue_cinta = collect($pp_list_desplegue_cinta);

    //         // ========= BASE =========
    //         $cajas_ptpl = (float) $pp->pp_traspaso_pp_list->sum('cajas');
    //         $pollos_ptpl = (float) $pp->pp_traspaso_pp_list->sum('pollos');
    //         $peso_bruto_ptpl = (float) $pp->pp_traspaso_pp_list->sum('peso_bruto');
    //         $peso_neto_ptpl = (float) $pp->pp_traspaso_pp_list->sum('peso_neto');
    //         $tara_ptpl = $peso_bruto_ptpl - $peso_neto_ptpl;

    //         $cajas = $cajas_ptpl;
    //         $pollos = $pollos_ptpl;
    //         $peso_bruto = $peso_bruto_ptpl;
    //         $peso_neto = $peso_neto_ptpl;
    //         $tara = $tara_ptpl;

    //         $pp_ventas = $pp->VentaDetallePps;
    //         $cajas_v = (float) $pp->VentaDetallePps->where('estado', 1)->sum('cajas');
    //         $pollos_v = (float) $pp->VentaDetallePps->where('estado', 1)->sum('pollos');
    //         $peso_bruto_v = (float) $pp->VentaDetallePps->where('estado', 1)->sum('peso_bruto');
    //         $peso_neto_v = (float) $pp->VentaDetallePps->where('estado', 1)->sum('peso_neto');
    //         $tara_v = $peso_bruto_v - $peso_neto_v;

    //         $cajas_t = (float) $pp->TraspasoPps->sum('cajas');
    //         $pollos_t = (float) $pp->TraspasoPps->sum('pollos');
    //         $peso_bruto_t = (float) $pp->TraspasoPps->sum('peso_bruto');
    //         $peso_neto_t = (float) $pp->TraspasoPps->sum('peso_neto');
    //         $tara_t = $peso_bruto_t - $peso_neto_t;

    //         foreach ($pp->DetallePps as $de) {
    //             $cajas += (float) $de->cajas;
    //             $pollos += (float) $de->pollos;
    //             $peso_bruto += (float) $de->peso_bruto;
    //             $peso_neto += (float) $de->peso_neto;
    //             $tara += (float) ($de->peso_bruto - $de->peso_neto);
    //         }

    //         $aggSobra = SobraDetallePp::query()
    //             ->selectRaw('COALESCE(SUM(cajas),0) as cajas, COALESCE(SUM(peso_bruto),0) as pb, COALESCE(SUM(peso_neto),0) as pn')
    //             ->whereHas('SobraPp', fn($q) => $q->where('pp_id', $pp->id))
    //             ->first();

    //         $cajas_sobra = (int)   ($aggSobra?->cajas ?? 0);
    //         $peso_bruto_sobra = (float) ($aggSobra?->pb    ?? 0);
    //         $peso_neto_sobra = (float) ($aggSobra?->pn    ?? 0);
    //         $tara_sobra = $peso_bruto_sobra - $peso_neto_sobra;

    //         $aggSubdetalle = SubdetalleDescuentoAcuerdo::query()
    //             ->selectRaw('COALESCE(SUM(peso),0) as peso')
    //             ->where('pp_id', $pp->id)
    //             ->where('estado', 1)
    //             ->first();
    //         $peso_subdetalle = (float) ($aggSubdetalle?->peso ?? 0);

    //         $pp->cajas_disponibles = max(0, $cajas - $cajas_v - $cajas_t - $cajas_sobra);
    //         $pp->pollos_disponibles = max(0, $pollos - $pollos_v - $pollos_t); // sin sobrantes
    //         $pp->peso_bruto_disponibles = max(0, $peso_bruto - $peso_bruto_v - $peso_bruto_t - $peso_bruto_sobra + $peso_subdetalle);
    //         $pp->peso_neto_disponibles = max(0, $peso_neto - $peso_neto_v - $peso_neto_t - $peso_neto_sobra + $peso_subdetalle);
    //         $pp->tara_disponibles = max(0, $tara - $tara_v - $tara_t - $tara_sobra);

    //         $pp->venta_detalle_pps_1 = $pp->VentaDetallePps()->where('estado', 1)->get();
    //         $pp->url_pdf = url('reportes/pp/' . $pp->id);

    //         $list[] = [
    //             'pp' => $pp,
    //             'cajas' => $pp->cajas_disponibles,
    //             'pollos' => $pp->pollos_disponibles,
    //             'peso_bruto' => $pp->peso_bruto_disponibles,
    //             'peso_neto' => $pp->peso_neto_disponibles,
    //             'tara' => $pp->tara_disponibles,
    //         ];
    //     }
    //     return $list;
    // }

    public function sucursalCursoPos(Sucursal $sucursal)
    {
        $pps = Pp::with([
            'DespleguePps.CintaCliente',
            'PpTraspasoPps',                 // pivot con cinta_cliente_id
            'PpTraspasoPps.TraspasoPp',      // por si los campos están en la relación
            'PpTraspasoPps.CintaCliente',    // <-- agregado para poder mostrar la cinta aunque no haya despliegue
            'VentaDetallePps',
            'TraspasoPps',                   // traspasos emitidos (para restar)
        ])
            ->where('sucursal_id', $sucursal->id)
            ->where([['estado', 1], ['curso', 1]])
            ->get();

        $result = [];

        foreach ($pps as $pp) {
            // 1) Agrupar DESPLIEGUES por cinta (BASE del segmento)
            $desplieguesPorCinta = ($pp->DespleguePps ?? collect())->groupBy('cinta_cliente_id');

            // 2) Agrupar ASIGNACIONES (PpTraspasoPps) por cinta
            //    Si usas estado=1 para indicar asignación efectiva, filtramos
            $ppTraspasoPivot = ($pp->PpTraspasoPps ?? collect())->where('estado', 1);
            $asignacionesPorCinta = $ppTraspasoPivot->groupBy('cinta_cliente_id');

            // 3) Conjunto de cintas a reportar = unión de cintas presentes en despliegues y/o asignaciones
            $cintas = $desplieguesPorCinta->keys()
                ->merge($asignacionesPorCinta->keys())
                ->unique()
                ->values();

            foreach ($cintas as $cintaId) {
                // BASE desde despliegue (si no hay, son ceros)
                $despliegueCol = $desplieguesPorCinta->get($cintaId, collect());
                $base_cajas       = (float) $despliegueCol->sum('cajas');
                $base_pollos      = (float) $despliegueCol->sum('pollos');
                $base_peso_bruto  = (float) $despliegueCol->sum('peso_bruto');
                $base_peso_neto   = (float) $despliegueCol->sum('peso_neto');
                $base_tara        = $base_peso_bruto - $base_peso_neto;

                // ASIGNACIONES de esa cinta (PpTraspasoPps). Sumamos desde el pivot si existen campos allí,
                // de lo contrario usamos la relación ->TraspasoPp.
                $traspCol = $asignacionesPorCinta->get($cintaId, collect());

                $asig_cajas = (float) $traspCol->sum(function ($p) {
                    return (float) ($p->cajas ?? optional($p->TraspasoPp)->cajas ?? 0);
                });
                $asig_pollos = (float) $traspCol->sum(function ($p) {
                    return (float) ($p->pollos ?? optional($p->TraspasoPp)->pollos ?? 0);
                });
                $asig_peso_bruto = (float) $traspCol->sum(function ($p) {
                    return (float) ($p->peso_bruto ?? optional($p->TraspasoPp)->peso_bruto ?? 0);
                });
                $asig_peso_neto = (float) $traspCol->sum(function ($p) {
                    return (float) ($p->peso_neto ?? optional($p->TraspasoPp)->peso_neto ?? 0);
                });
                $asig_tara = $asig_peso_bruto - $asig_peso_neto;

                // SUMAR asignaciones a la base
                $base_cajas      += $asig_cajas;
                $base_pollos     += $asig_pollos;
                $base_peso_bruto += $asig_peso_bruto;
                $base_peso_neto  += $asig_peso_neto;
                $base_tara       += $asig_tara;

                // VENTAS por cinta (resta)
                $ventas_ok_cinta = ($pp->VentaDetallePps ?? collect())
                    ->where('estado', 1)
                    ->where('cinta_cliente_id', $cintaId);

                $v_cajas       = (float) $ventas_ok_cinta->sum('cajas');
                $v_pollos      = (float) $ventas_ok_cinta->sum('pollos');
                $v_peso_bruto  = (float) $ventas_ok_cinta->sum('peso_bruto');
                $v_peso_neto   = (float) $ventas_ok_cinta->sum('peso_neto');
                $v_tara        = $v_peso_bruto - $v_peso_neto;

                // TRASPASOS EMITIDOS por esa cinta (resta) → desde TraspasoPps con cinta_cliente_id_emisor
                $traspasos_ok_cinta = ($pp->TraspasoPps ?? collect())
                    ->where('estado', 1)
                    ->where('cinta_cliente_id_emisor', $cintaId);

                $td_cajas       = (float) $traspasos_ok_cinta->sum('cajas');
                $td_pollos      = (float) $traspasos_ok_cinta->sum('pollos');
                $td_peso_bruto  = (float) $traspasos_ok_cinta->sum('peso_bruto');
                $td_peso_neto   = (float) $traspasos_ok_cinta->sum('peso_neto');
                $td_tara        = $td_peso_bruto - $td_peso_neto;

                // DISPONIBLES: base - ventas - traspasos emitidos
                $disp_cajas       = max(0, $base_cajas      - $v_cajas - $td_cajas);
                $disp_pollos      = max(0, $base_pollos     - $v_pollos - $td_pollos);
                $disp_peso_bruto  = max(0, $base_peso_bruto - $v_peso_bruto - $td_peso_bruto);
                $disp_peso_neto   = max(0, $base_peso_neto  - $v_peso_neto  - $td_peso_neto);
                $disp_tara        = max(0, $base_tara       - $v_tara - $td_tara);

                // CintaCliente para mostrar (si no hay despliegue, usamos la cargada en PpTraspasoPps)
                $cintaCliente =
                    optional($despliegueCol->first())->CintaCliente
                    ?? optional($traspCol->first())->CintaCliente;

                $result[] = [
                    'pp_id'                => $pp->id,
                    'pp'                   => $pp,
                    'cinta_cliente_id'     => $cintaId,
                    'cinta_cliente'        => $cintaCliente,
                    'cajas'                => $disp_cajas,
                    'pollos'               => $disp_pollos,
                    'peso_bruto'           => $disp_peso_bruto,
                    'peso_neto'            => $disp_peso_neto,
                    'tara'                 => $disp_tara,
                    'url_pdf'              => url('reportes/pp/' . $pp->id),

                    // IMPORTANTE: base ahora incluye (Despliegue + PpTraspasoPps)
                    'base_despliegue' => [
                        'cajas'      => $base_cajas,
                        'pollos'     => $base_pollos,
                        'peso_bruto' => $base_peso_bruto,
                        'peso_neto'  => $base_peso_neto,
                        'tara'       => $base_tara,
                    ],
                    'restas' => [
                        // Traspasos EMITIDOS (no las asignaciones)
                        'traspaso' => [
                            'cajas'      => $td_cajas,
                            'pollos'     => $td_pollos,
                            'peso_bruto' => $td_peso_bruto,
                            'peso_neto'  => $td_peso_neto,
                            'tara'       => $td_tara,
                        ],
                        'ventas' => [
                            'cajas'      => $v_cajas,
                            'pollos'     => $v_pollos,
                            'peso_bruto' => $v_peso_bruto,
                            'peso_neto'  => $v_peso_neto,
                            'tara'       => $v_tara,
                        ],
                    ],
                ];
            }
        }

        return $result;
    }






    //     public function sucursalCursoPos(Sucursal $sucursal)
    // {
    //     // Log para saber qué sucursal estamos procesando
    //     Log::info('Iniciando sucursalCursoPos', ['sucursal_id' => $sucursal->id]);

    //     $pps = Pp::where('sucursal_id', $sucursal->id)
    //         ->where([['estado', 1], ['curso', 1]])
    //         ->get();

    //     $list = [];
    //     foreach ($pps as $pp) {
    //         Log::info('Procesando PP', ['pp_id' => $pp->id]);

    //         // Cargando detalles del PP
    //         $pp->detalle_pps = $pp->DetallePps;
    //         Log::info('Detalle de PP cargado', ['detalle_pps_count' => $pp->detalle_pps->count()]);

    //         // Cargando traspasos del PP
    //         $pp_traspaso_pps = $pp->PpTraspasoPps;
    //         $pp_list_traspaso = [];
    //         foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
    //             $pp_traspaso_pp = $pp_traspaso_pp->TraspasoPp;
    //             $pp_list_traspaso[] = $pp_traspaso_pp;
    //         }
    //         $pp->pp_traspaso_pp_list = collect($pp_list_traspaso);
    //         Log::info('Traspasos cargados', ['traspasos_count' => count($pp_list_traspaso)]);

    //         // Cargando traspasos por cliente de cinta
    //         $pp_traspaso_pps_cinta = $pp->PpTraspasoPps()->get()->groupBy('cinta_cliente_id');
    //         $pp_list_traspaso_cinta = [];
    //         foreach ($pp_traspaso_pps_cinta as $ppTPpCinta) {
    //             $cinta_cliente = $ppTPpCinta->first()->CintaCliente;
    //             $pp_list_traspaso_cinta[] = [
    //                 'cinta_cliente' => $cinta_cliente,
    //                 'traspaso_pps' => $ppTPpCinta
    //             ];
    //         }
    //         $pp->pp_traspaso_pp_cinta_list = collect($pp_list_traspaso_cinta);
    //         Log::info('Traspasos por cliente de cinta cargados', ['traspasos_cinta_count' => count($pp_list_traspaso_cinta)]);

    //         // Cálculos de traspasos totales
    //         $cajas_ptpl = $pp->pp_traspaso_pp_list->sum('cajas');
    //         $pollos_ptpl = $pp->pp_traspaso_pp_list->sum('pollos');
    //         $peso_bruto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_bruto'), 2);
    //         $peso_neto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_neto'), 2);
    //         $tara_ptpl = $peso_bruto_ptpl - $peso_neto_ptpl;
    //         Log::info('Totales de traspasos calculados', [
    //             'cajas_ptpl' => $cajas_ptpl,
    //             'pollos_ptpl' => $pollos_ptpl,
    //             'peso_bruto_ptpl' => $peso_bruto_ptpl,
    //             'peso_neto_ptpl' => $peso_neto_ptpl,
    //             'tara_ptpl' => $tara_ptpl,
    //         ]);

    //         // Sumar las cajas, pollos, pesos, etc. (ventas y otros traspasos)
    //         $cajas = $cajas_ptpl;
    //         $pollos = $pollos_ptpl;
    //         $peso_bruto = $peso_bruto_ptpl;
    //         $peso_neto = $peso_neto_ptpl;
    //         $tara = $tara_ptpl;

    //         $pp_ventas = $pp->VentaDetallePps;
    //         $cajas_v = $pp->VentaDetallePps->where('estado', 1)->sum('cajas');
    //         $pollos_v = $pp->VentaDetallePps->where('estado', 1)->sum('pollos');
    //         $peso_bruto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_bruto');
    //         $peso_neto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_neto');
    //         $tara_v = $peso_bruto_v - $peso_neto_v;
    //         Log::info('Detalles de ventas calculados', [
    //             'cajas_v' => $cajas_v,
    //             'pollos_v' => $pollos_v,
    //             'peso_bruto_v' => $peso_bruto_v,
    //             'peso_neto_v' => $peso_neto_v,
    //             'tara_v' => $tara_v,
    //         ]);

    //         // Cálculos de traspasos totales (ventas y traspasos)
    //         $cajas_t = $pp->TraspasoPps->sum('cajas');
    //         $pollos_t = $pp->TraspasoPps->sum('pollos');
    //         $peso_bruto_t = $pp->TraspasoPps->sum('peso_bruto');
    //         $peso_neto_t = $pp->TraspasoPps->sum('peso_neto');
    //         $tara_t = $peso_bruto_t - $peso_neto_t;
    //         Log::info('Totales de traspasos calculados (ventas y traspasos)', [
    //             'cajas_t' => $cajas_t,
    //             'pollos_t' => $pollos_t,
    //             'peso_bruto_t' => $peso_bruto_t,
    //             'peso_neto_t' => $peso_neto_t,
    //             'tara_t' => $tara_t,
    //         ]);

    //         // Agregando detalles a la lista
    //         foreach ($pp->DetallePps as $de) {
    //             $cajas += $de->cajas;
    //             $pollos += $de->pollos;
    //             $peso_bruto += $de->peso_bruto;
    //             $peso_neto += $de->peso_neto;
    //             $tara += $de->peso_bruto - $de->peso_neto;
    //         }

    //         // Agregar el PP procesado a la lista final
    //         $list[] = [
    //             'pp' => $pp,
    //             'cajas' => $cajas - $cajas_v - $cajas_t,
    //             'pollos' => $pollos - $pollos_v - $pollos_t,
    //             'peso_bruto' => $peso_bruto - $peso_bruto_v - $peso_bruto_t,
    //             'peso_neto' => $peso_neto - $peso_neto_v - $peso_neto_t,
    //             'tara' => $tara - $tara_v - $tara_t,
    //         ];

    //         Log::info('PP procesado y agregado a la lista', ['pp_id' => $pp->id]);
    //     }

    //     // Log al finalizar el proceso
    //     Log::info('Proceso de sucursalCursoPos finalizado');

    //     return $list;
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pp  $pp
     * @return \Illuminate\Http\Response
     */
    public function retornarDetallesMasa(Request $request, Sucursal $sucursal)
    {

        $pps = Pp::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
        $list = [];
        foreach ($pps as $pp) {
            foreach ($pp->DetallePps as $detallePp) {
                $detallePp->estado = 0;
                $detallePp->save();
                $detallePp->LoteDetalleMovimiento->estado = 0;
                $detallePp->LoteDetalleMovimiento->save();
            }
        }
        return $list;
    }
    public function update(Request $request, Pp $pp)
    {
        $pp->name = $request->name;
        $pp->save();
        return $pp;
    }
    public function cerrar(Request $request, Pp $pp)
    {
        $pp->curso = 0;
        $pp->save();
        if (!empty($request->items_sobra)) {
            $sobraPp = new SobraPp();
            $sobraPp->pp_id = $pp->id;
            $sobraPp->fecha = Carbon::now()->format('Y-m-d');
            $sobraPp->save();
            foreach ($request->items_sobra as $detalle) {
                if ($detalle['peso_neto'] > 0) {

                    $sobraDetallePp = new SobraDetallePp();
                    $sobraDetallePp->sobra_pp_id = $sobraPp->id;
                    $sobraDetallePp->item_id = $detalle['id'];
                    $sobraDetallePp->cajas = $detalle['cajas'];
                    $sobraDetallePp->taras = $detalle['taras'];
                    $sobraDetallePp->peso_bruto = $detalle['peso_bruto'];
                    $sobraDetallePp->peso_neto = $detalle['peso_neto'];
                    $sobraDetallePp->save();
                }
            }
        }
        return $pp;
    }
    public function enviar(Request $request, Pp $pp)
    {
        if (!empty($request->items_sobra)) {
            $nro_envio = $pp->SobraPps()->count();
            $sobraPp = new SobraPp();
            $sobraPp->pp_id = $pp->id;
            $sobraPp->nro_traspaso = $nro_envio + 1;
            $sobraPp->fecha = Carbon::now()->format('Y-m-d');
            $sobraPp->user_id = Auth::id();
            $sobraPp->save();
            foreach ($request->items_sobra as $detalle) {
                if ($detalle['peso_neto'] > 0) {
                    $sobraDetallePp = new SobraDetallePp();
                    $sobraDetallePp->sobra_pp_id = $sobraPp->id;
                    $sobraDetallePp->item_id = $detalle['id'];
                    $sobraDetallePp->cajas = $detalle['cajas'];
                    $sobraDetallePp->taras = $detalle['taras'];
                    $sobraDetallePp->peso_bruto = $detalle['peso_bruto'];
                    $sobraDetallePp->peso_neto = $detalle['peso_neto'];
                    $sobraDetallePp->user_id = Auth::id();
                    $sobraDetallePp->fecha_hora = Carbon::now();
                    $sobraDetallePp->save();
                }
            }
        }
        return $pp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pp  $pp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pp $pp)
    {
        $pp->estado = 0;
        $pp->save();
    }
    public function pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $pdf = Pdf::loadView('reportes.pdf.pp.detalle', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pp_entrada_lotes_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.pp_entrada_lotes_pdf', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pp_general_lotes_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.pp_general_lotes_pdf', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pp_envio_lotes_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.pp_envio_lotes_pdf', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pp_aceptado_lotes_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.pp_aceptado_lotes_pdf', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pp_venta_lotes_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.pp_venta_lotes_pdf', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function PesoInicialPp(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.peso_inicial_2', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function PesoInicialTotalPp(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.peso_inicial_total', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function CronologicoPdf(Pp $pp)
    {
        $pp = $this->showPPCronologico($pp);

        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.cronologico', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function showPPCronologico2(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $pp = $this->showPPCronologico($pp);

        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        return $pp;
    }
    public function pp_reporte_general_pdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $pp = $this->showPPCronologico($pp);
        //DD($pp->detalle_pp_venta_list);
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.reporte_general', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ReportVentaPdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $pp = $this->showPPCronologico($pp);

        Log::info('Procesando PP', ['pp_id' => $pp->detalle_pp_venta_list]);

        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.reporte_general_venta', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function InformePdf(Pp $pp)
    {
        $pp = $this->showPPCronologico($pp);
        $promedioMerma = PromedioMerma::where('estado', 1)->get()->first();
        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.informe', [
            'pp' => $pp,
            "promedioMerma" => $promedioMerma->promedio,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical')->setOption('enable_php', true);
        return $pdf->stream();
    }
}
