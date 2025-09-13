<?php

namespace App\Http\Controllers;

use App\Models\Pp;
use Carbon\Carbon;
use App\Models\SobraPp;
use App\Models\Sucursal;
use App\Models\DetallePp;
use Illuminate\Http\Request;
use App\Models\PromedioMerma;
use App\Models\SobraDetallePp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Models\LoteDetalleMovimiento;

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
        $traspaso_pps = $pp->TraspasoPps()->with(['Pp']);
        $list = [];
        $pp_traspaso_pps_cinta = $pp->PpTraspasoPps();
        foreach ($detalle_pp_venta as $detalle) {
            $cinta = $detalle->first()->CintaCliente;
            $list[] = [
                'cinta_cliente' => $cinta,
                'detalle' => $detalle,
                'cajas' => $detalle->where('estado', 1)->sum('cajas'),
                'pollos' => $detalle->where('estado', 1)->sum('pollos'),
                'peso_bruto' => $detalle->where('estado', 1)->sum('peso_bruto'),
                'peso_neto' => $detalle->where('estado', 1)->sum('peso_neto'),
                'tara' => $detalle->where('estado', 1)->sum('peso_bruto') - $detalle->where('estado', 1)->sum('peso_neto'),
                'traspasos' => $pp_traspaso_pps_cinta->where('cinta_cliente_id', $cinta->id)->get(),
                "sobras" => $traspaso_pps->where('cinta_cliente_id', $cinta->id)->get(),
            ];
        }
        $pp->sobrante_units = intval($traspaso_pps->get()->sum('pollos'));
        $pp->sobrante_kn = $traspaso_pps->get()->sum('peso_neto');
        $pp->detalle_pp_venta_list = collect($list);
        return $pp;
    }
    public function detalle(Pp $pp)
    {
        $pp->mes = $this->mes($pp->fecha);
        $pp->detalle_pps = $pp->DetallePps;
        $pp->traspaso_pps = $pp->TraspasoPps;
        $pp->desplegue_pps = $pp->DespleguePps;
        $pp_traspaso_pps = $pp->PpTraspasoPps;
        $pp_traspaso_pps_cinta = $pp->PpTraspasoPps()->get()->groupBy('cinta_cliente_id');
        $desplegue_pps_cinta = $pp->DespleguePps()->get()->groupBy('cinta_cliente_id');
        $pp_list_traspaso = [];
        $pp_list_traspaso_cinta = [];
        $pp_list_desplegue_cinta = [];
        foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
            $pp_traspaso_pp = $pp_traspaso_pp->TraspasoPp;
            $pp_list_traspaso[] = $pp_traspaso_pp;
        }
        foreach ($pp_traspaso_pps_cinta as $ppTPpCinta) {
            $cinta_cliente = $ppTPpCinta->first()->CintaCliente;
            $pp_list_traspaso_cinta[] = [
                'cinta_cliente' => $cinta_cliente,
                'traspaso_pps' => $ppTPpCinta
            ];
        }
        foreach ($desplegue_pps_cinta as $desplegue) {
            $cinta_cliente = $desplegue->first()->CintaCliente;
            $pp_list_desplegue_cinta[] = [
                'cinta_cliente' => $cinta_cliente,
                'traspaso_pps' => $desplegue
            ];
        }
        $pp->pp_traspaso_pp_cinta_list = collect($pp_list_traspaso_cinta);
        $pp->pp_traspaso_pp_list = collect($pp_list_traspaso);
        $pp->pp_list_desplegue_cinta = collect($pp_list_desplegue_cinta);

        $cajas_ptpl = $pp->pp_traspaso_pp_list->sum('cajas');
        $pollos_ptpl = $pp->pp_traspaso_pp_list->sum('pollos');
        $peso_bruto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_bruto'), 2);
        $peso_neto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_neto'), 2);
        $tara_ptpl = $peso_bruto_ptpl - $peso_neto_ptpl;
        $cajas = $cajas_ptpl;
        $pollos = $pollos_ptpl;
        $peso_bruto = $peso_bruto_ptpl;
        $peso_neto = $peso_neto_ptpl;
        $tara = $tara_ptpl;
        $pp_ventas = $pp->VentaDetallePps->where('estado', 1);
        $cajas_v = $pp->VentaDetallePps->where('estado', 1)->sum('cajas');
        $pollos_v = $pp->VentaDetallePps->where('estado', 1)->sum('pollos');
        $peso_bruto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_bruto');
        $peso_neto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_neto');
        $tara_v = $peso_bruto_v - $peso_neto_v;
        $cajas_t = $pp->TraspasoPps->sum('cajas');
        $pollos_t = $pp->TraspasoPps->sum('pollos');
        $peso_bruto_t = $pp->TraspasoPps->sum('peso_bruto');
        $peso_neto_t = $pp->TraspasoPps->sum('peso_neto');
        $tara_t = $peso_bruto_t - $peso_neto_t;
        $pp->pp_envio_transformacion_detalles = $pp->PpEnvioTransformacionDetalles;
        foreach ($pp->DetallePps as $de) {
            $cajas += $de->cajas;
            $pollos += $de->pollos;
            $peso_bruto += $de->peso_bruto;
            $peso_neto += $de->peso_neto;
            $tara += $de->peso_bruto - $de->peso_neto;
        }
        $pp->cajas_disponibles = $cajas - $cajas_v - $cajas_t;
        $pp->pollos_disponibles = $pollos - $pollos_v - $pollos_t;
        $pp->peso_bruto_disponibles = $peso_bruto - $peso_bruto_v - $peso_bruto_t;
        $pp->peso_neto_disponibles = $peso_neto - $peso_neto_v - $peso_neto_t;
        $pp->tara_disponibles = $tara - $tara_v;
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
    //     $pps = Pp::where('sucursal_id', $sucursal->id)->where([['estado', 1], ['curso', 1]])->get();
    //     $list = [];
    //     foreach ($pps as $pp) {
    //         $pp->detalle_pps = $pp->DetallePps;
    //         $pp_traspaso_pps = $pp->PpTraspasoPps;
    //         $pp_list_traspaso = [];

    //         foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
    //             $pp_traspaso_pp = $pp_traspaso_pp->TraspasoPp;
    //             $pp_list_traspaso[] = $pp_traspaso_pp;
    //         }
    //         $pp->pp_traspaso_pp_list = collect($pp_list_traspaso);
    //         //AUXILIAR POS
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
    //         //FIN AUXILIAR POS
    //         $cajas_ptpl = $pp->pp_traspaso_pp_list->sum('cajas');
    //         $pollos_ptpl = $pp->pp_traspaso_pp_list->sum('pollos');
    //         $peso_bruto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_bruto'), 2);
    //         $peso_neto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_neto'), 2);
    //         $tara_ptpl = $peso_bruto_ptpl - $peso_neto_ptpl;
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
    //         $cajas_t = $pp->TraspasoPps->sum('cajas');
    //         $pollos_t = $pp->TraspasoPps->sum('pollos');
    //         $peso_bruto_t = $pp->TraspasoPps->sum('peso_bruto');
    //         $peso_neto_t = $pp->TraspasoPps->sum('peso_neto');
    //         $tara_t = $peso_bruto_t - $peso_neto_t;
    //         foreach ($pp->DetallePps as $de) {
    //             $cajas += $de->cajas;
    //             $pollos += $de->pollos;
    //             $peso_bruto += $de->peso_bruto;
    //             $peso_neto += $de->peso_neto;
    //             $tara += $de->peso_bruto - $de->peso_neto;
    //         }
    //         $list[] = [
    //             'pp' => $pp,
    //             'cajas' => $cajas - $cajas_v - $cajas_t,
    //             'pollos' => $pollos - $pollos_v - $pollos_t,
    //             'peso_bruto' => $peso_bruto - $peso_bruto_v - $peso_bruto_t,
    //             'peso_neto' => $peso_neto - $peso_neto_v - $peso_neto_t,
    //             'tara' => $tara - $tara_v - $tara_t,
    //         ];
    //     }
    //     return $list;
    // }
    public function sucursalCursoPos(Sucursal $sucursal)
    {
        Log::info('Iniciando sucursalCursoPos', ['sucursal_id' => $sucursal->id]);

        $pps = Pp::where('sucursal_id', $sucursal->id)
            ->where([['estado', 1], ['curso', 1]])
            ->get();

        $list = [];
        foreach ($pps as $pp) {
            Log::info('Procesando PP', ['pp_id' => $pp->id]);

            // Cargar detalles de PP
            $pp->detalle_pps = $pp->DetallePps;
            Log::info('Detalle de PP cargado', ['detalle_pps_count' => count($pp->detalle_pps)]);

            // Cargar traspasos
            $pp_traspaso_pps = $pp->PpTraspasoPps;
            $pp_list_traspaso = [];
            foreach ($pp_traspaso_pps as $pp_traspaso_pp) {
                $pp_traspaso_pp = $pp_traspaso_pp->TraspasoPp;
                $pp_list_traspaso[] = $pp_traspaso_pp;
            }

            $pp->pp_traspaso_pp_list = collect($pp_list_traspaso);
            Log::info('Traspasos cargados', ['traspasos_count' => count($pp_list_traspaso)]);

            // Cargar despliegues
            $pp_desplegues = $pp->DespleguePps;
            $pp_list_desplegues = [];
            foreach ($pp_desplegues as $desplegue) {
                $pp_list_desplegues[] = $desplegue;
            }

            $pp->pp_desplegue_pp_list = collect($pp_list_desplegues);
            Log::info('Desplegues cargados', ['desplegues_count' => count($pp_list_desplegues)]);

            // Calcular totales de traspasos
            $cajas_ptpl = $pp->pp_traspaso_pp_list->sum('cajas');
            $pollos_ptpl = $pp->pp_traspaso_pp_list->sum('pollos');
            $peso_bruto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_bruto'), 2);
            $peso_neto_ptpl = number_format($pp->pp_traspaso_pp_list->sum('peso_neto'), 2);
            $tara_ptpl = $peso_bruto_ptpl - $peso_neto_ptpl;
            Log::info('Totales de traspasos calculados', [
                'cajas_ptpl' => $cajas_ptpl,
                'pollos_ptpl' => $pollos_ptpl,
                'peso_bruto_ptpl' => $peso_bruto_ptpl,
                'peso_neto_ptpl' => $peso_neto_ptpl,
                'tara_ptpl' => $tara_ptpl
            ]);

            // Sumar las cajas, pollos, pesos, etc.
            $cajas = $cajas_ptpl;
            $pollos = $pollos_ptpl;
            $peso_bruto = $peso_bruto_ptpl;
            $peso_neto = $peso_neto_ptpl;
            $tara = $tara_ptpl;

            // Calcular detalles de ventas y traspasos
            $pp_ventas = $pp->VentaDetallePps;
            $cajas_v = $pp->VentaDetallePps->where('estado', 1)->sum('cajas');
            $pollos_v = $pp->VentaDetallePps->where('estado', 1)->sum('pollos');
            $peso_bruto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_bruto');
            $peso_neto_v = $pp->VentaDetallePps->where('estado', 1)->sum('peso_neto');
            $tara_v = $peso_bruto_v - $peso_neto_v;

            Log::info('Detalles de ventas calculados', [
                'cajas_v' => $cajas_v,
                'pollos_v' => $pollos_v,
                'peso_bruto_v' => $peso_bruto_v,
                'peso_neto_v' => $peso_neto_v,
                'tara_v' => $tara_v
            ]);

            // Agregar los totales a la lista final
            $list[] = [
                'pp' => $pp,
                'cajas' => $cajas - $cajas_v,
                'pollos' => $pollos - $pollos_v,
                'peso_bruto' => $peso_bruto - $peso_bruto_v,
                'peso_neto' => $peso_neto - $peso_neto_v,
                'tara' => $tara - $tara_v,
                'pp_desplegue_pp_list' => $pp->pp_desplegue_pp_list, // Incluir los desplegues
            ];

            Log::info('PP procesado y agregado a la lista', ['pp_id' => $pp->id]);
        }

        Log::info('Proceso de sucursalCursoPos finalizado');

        return $list;
    }



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
        $sobraPp = new SobraPp();
        $sobraPp->pp_id = $pp->id;
        $sobraPp->fecha = Carbon::now()->format('Y-m-d');
        $sobraPp->save();
        foreach ($request->items_sobra as $detalle) {
            if ($detalle['cajas'] > 0) {

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
        return $pp;
    }
    public function enviar(Request $request, Pp $pp)
    {
        $nro_envio = $pp->SobraPps()->count();
        $sobraPp = new SobraPp();
        $sobraPp->pp_id = $pp->id;
        $sobraPp->nro_traspaso = $nro_envio + 1;
        $sobraPp->fecha = Carbon::now()->format('Y-m-d');
        $sobraPp->save();
        foreach ($request->items_sobra as $detalle) {
            if ($detalle['cajas'] > 0) {

                $sobraDetallePp = new SobraDetallePp();
                $sobraDetallePp->sobra_pp_id = $sobraPp->id;
                $sobraDetallePp->item_id = $detalle['id'];
                $sobraDetallePp->cajas = $detalle['cajas'];
                $sobraDetallePp->taras = $detalle['taras'];
                $sobraDetallePp->peso_bruto = $detalle['peso_bruto'];
                $sobraDetallePp->peso_neto = $detalle['peso_neto'];
                $sobraDetallePp->user_id = $request->user_id;
                $sobraDetallePp->fecha_hora = Carbon::now();
                $sobraDetallePp->save();
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'landscape');
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
        ])->setPaper('a4', 'vertical');
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

        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.reporte_general', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical');
        return $pdf->stream();
    }
    public function ReportVentaPdf(Pp $pp)
    {
        $pp = $this->showPP($pp);
        $pp = $this->showPPCronologico($pp);

        $sucursal = $pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pp.reporte_general_venta', [
            'pp' => $pp,
            'sucursal' => $sucursal
        ])->setPaper('a4', 'vertical');
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
        ])->setPaper('a4', 'vertical');
        return $pdf->stream();
    }
}
