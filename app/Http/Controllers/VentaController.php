<?php

namespace App\Http\Controllers;

use App\Models\VentaAcuerdo;
use App\Models\VentaGasto;
use Carbon\Carbon;
use App\Models\Lote;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\ItemsPt;
use App\Models\VentaPp;
use App\Models\VentaPt;
use App\Models\VentaCaja;
use App\Models\PagoGlobal;
use App\Models\ArqueoVenta;
use App\Models\EntregaCaja;
use App\Models\LoteDetalle;
use App\Models\VentaCerrada;
use App\Models\VentaItemsPt;
use Illuminate\Http\Request;
use App\Models\VentaDetallePp;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CajaVentaCliente;
use App\Models\LoteDetalleVenta;
use App\Models\VentaTurnoChofer;
use App\Models\LoteDetalleCompra;
use App\Models\LoteDetalleCliente;
use App\Exports\VentaClienteExport;
use App\Models\LoteDetalleProducto;
use App\Models\VentaTransformacion;
use Illuminate\Support\Facades\Log;
use App\Models\LoteDetalleHistorial;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\EntregaCajaRecuperada;
use App\Models\LoteDetalleMovimiento;
use App\Models\LoteDetalleSeguimiento;
use App\Models\SubdetalleDescuentoAcuerdo;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Venta::get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = Venta::with(['Cliente', 'Chofer', 'VentaCaja'])->whereDate('fecha', '>=', $fecha_inicio)->whereDate('fecha', '<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m) {
            $m->url_pdf = url("reportes/ventas/$m->id");
            $m->url_2_pdf = url("reportes/ventas-oficial/$m->id");
            $m->url_3_pdf = url("reportes/ticket-ventas-oficial/$m->id");
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
        #venta_pps = pp
        #venta_items = pt
        #venta_items = pt
        #detalle_vente_lotes = lotes
        $venta = new Venta();
        $venta->fecha = Carbon::now()->format('Y-m-d');
        $venta->fecha_entrega = $request->fecha_entrega;
        $venta->hora_entrega = $request->hora_entrega;

        $venta->sucursal_id = $request->sucursal_id;
        $venta->cliente_id = $request->cliente_id;
        $venta->chofer_id = $request->chofer_id;
        $venta->observacion = $request->observacion;
        $venta->acuerdo_cliente_id = $request->acuerdo['id'];
        $venta->save();
        $cliente = Cliente::find($request->cliente_id);
        foreach ($request->venta_pps as $d) {
            $ventaDetallePp = new VentaDetallePp();
            $ventaDetallePp->fecha = Carbon::now()->format('Y-m-d');
            $ventaDetallePp->hora = Carbon::now()->format('H:i:s');
            $ventaDetallePp->cajas = $d['cajas_vender'];
            $ventaDetallePp->pollos = $d['pollos_vender'];
            $ventaDetallePp->peso_bruto = $d['peso_bruto_vender'];
            $ventaDetallePp->peso_neto = $d['peso_neto_vender'];
            $ventaDetallePp->item_id = $d['item']['id'];
            $ventaDetallePp->precio = $d['item']['venta'];
            $ventaDetallePp->pp_id = $d['pp']['id'];
            $ventaDetallePp->precio_acuerdo = $d['precio_acuerdo'];
            $ventaDetallePp->total = $d['total'];

            $ventaDetallePp->cinta_cliente_id = $request->cinta_cliente_id;
            $ventaDetallePp->cliente_id = $request->cliente_id;
            $ventaDetallePp->venta_id = $venta->id;
            $ventaDetallePp->save();
        }

        foreach ($request->venta_items as $d) {

            $itemsPt = new ItemsPt();
            $itemsPt->fecha = Carbon::now()->format('Y-m-d');
            $itemsPt->pt_id = $d['pt_id'];
            $itemsPt->item_id = $d['item']['id'];
            $itemsPt->cajas = 0 - $d['cajas_vender'];
            $itemsPt->taras = 0 - $d['tara_vender'];
            $itemsPt->peso_bruto = 0 - $d['peso_bruto_vender'];
            $itemsPt->peso_neto = 0 - $d['peso_neto_vender'];
            $itemsPt->save();
            $ventaItemsPt = new VentaItemsPt();
            $ventaItemsPt->fecha = Carbon::now()->format('Y-m-d');
            $ventaItemsPt->pt_id = $d['pt_id'];
            $ventaItemsPt->items_pt_id = $itemsPt->id;
            $ventaItemsPt->venta_id = $venta->id;
            $ventaItemsPt->item_id = $d['item']['id'];
            $ventaItemsPt->cajas = $d['cajas_vender'];
            $ventaItemsPt->taras = $d['tara_vender'];
            $ventaItemsPt->peso_bruto = $d['peso_bruto_vender'];
            $ventaItemsPt->peso_neto = $d['peso_neto_vender'];
            $ventaItemsPt->precio = $d['item']['venta'];
            $ventaItemsPt->total = $d['item']['venta'] * $d['peso_neto_vender'];
            $ventaItemsPt->save();
        }
        foreach ($request->detalle_vente_lotes as $d) {
            $loteDetalleMovimiento = new LoteDetalleMovimiento();
            $loteDetalleMovimiento->lote_detalle_id = $d['id'];
            $loteDetalleMovimiento->descripcion = 'SALIDA POR VENTA';
            $loteDetalleMovimiento->cantidad = $d['equivalente'];
            $loteDetalleMovimiento->peso_neto = $d['peso_actual_neto'];
            $loteDetalleMovimiento->peso_bruto = $d['peso_actual_bruto'];
            $loteDetalleMovimiento->cajas = $d['cajas'];
            $loteDetalleMovimiento->peso = $d['peso_total'];
            $loteDetalleMovimiento->tipo = 2;
            $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleMovimiento->save();
            $loteDetalle = LoteDetalle::find($d['id']);
            $seguimiento = $loteDetalle->LoteDetalleSeguimientos();
            $kgs_s = $seguimiento->sum('kgs_s');
            $unit_s = $seguimiento->sum('unit_s');
            $cont_s = $seguimiento->sum('cont_s');
            $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
            $loteDetalleSeguimiento->lote_detalle_id = $d['id'];
            $loteDetalleSeguimiento->nro = "NDD N°{$venta->id}";
            $loteDetalleSeguimiento->cliente = "{$cliente->id} {$cliente->nombre}";
            $loteDetalleSeguimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleSeguimiento->cont_s = $d['cajas'];
            $loteDetalleSeguimiento->cont_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
            $loteDetalleSeguimiento->unit_s = $d['equivalente'];
            $loteDetalleSeguimiento->unit_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
            $loteDetalleSeguimiento->kgs_s = $d['peso_mod_neto'];
            $loteDetalleSeguimiento->kgs_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
            $loteDetalleSeguimiento->save();
            $loteDetalleCliente = new LoteDetalleCliente();
            $loteDetalleCliente->lote_detalle_id = $d['id'];
            $loteDetalleCliente->lote_id = $d['lote_id'];
            $loteDetalleCliente->cliente_id = $cliente->id;
            $loteDetalleCliente->nro = "NDD N°{$venta->id}";
            $loteDetalleCliente->cliente = "{$cliente->id} {$cliente->nombre}";
            $loteDetalleCliente->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleCliente->hora = Carbon::now()->format('H:i:s');
            $loteDetalleCliente->user_id = 1;
            $loteDetalleCliente->peso_bruto = $d['peso_mod_bruto'];
            $loteDetalleCliente->peso_neto = $d['peso_mod_neto'];
            $loteDetalleCliente->tara = $d['peso_mod_bruto'] - $d['peso_mod_neto'];
            $loteDetalleCliente->cont_e = $loteDetalle->cajas;
            $loteDetalleCliente->cont_s = $d['cajas'];
            $loteDetalleCliente->cont_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
            $loteDetalleCliente->unit_s = $d['equivalente'];
            $loteDetalleCliente->unit_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
            $loteDetalleCliente->kgs_s = $d['peso_mod_neto'];
            $loteDetalleCliente->kgs_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
            $loteDetalleCliente->save();
            $loteDetalleProducto = new LoteDetalleProducto();
            $loteDetalleProducto->lote_detalle_id = $d['id'];
            $loteDetalleProducto->lote_id = $d['lote_id'];
            $loteDetalleProducto->producto = $d['producto'];
            $loteDetalleProducto->pigmento = $d['pigmento'];

            $loteDetalleProducto->tipo = "NDD";
            $loteDetalleProducto->nro = "S";
            $loteDetalleProducto->id_nro = "{$venta->id}";
            $loteDetalleProducto->detalle = "{$cliente->id} {$cliente->nombre}";
            $loteDetalleProducto->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleProducto->hora = Carbon::now()->format('H:i:s');
            $loteDetalleProducto->user_id = 1;
            $loteDetalleProducto->tipo_mov = 1;
            $loteDetalleProducto->peso_bruto = $d['peso_mod_bruto'];
            $loteDetalleProducto->peso_neto = $d['peso_mod_neto'];
            $loteDetalleProducto->tara = $d['peso_mod_bruto'] - $d['peso_mod_neto'];
            $loteDetalleProducto->cajas_e = $loteDetalle->cajas - $cont_s;
            $loteDetalleProducto->cajas_s = $d['cajas'];
            $loteDetalleProducto->cajas_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
            $loteDetalleProducto->und_s = $d['equivalente'];
            $loteDetalleProducto->und_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
            $loteDetalleProducto->kg_s = $d['peso_mod_neto'];
            $loteDetalleProducto->kg_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
            $loteDetalleProducto->save();
            // FIN SEGUIMIENTO
            $LoteDetalleVenta = new LoteDetalleVenta();
            $LoteDetalleVenta->pollos = $d['equivalente'];
            $LoteDetalleVenta->cajas = $d['cajas'];
            $LoteDetalleVenta->fecha = Carbon::now()->format('Y-m-d');
            $LoteDetalleVenta->peso_total = $d['peso_total'];
            $LoteDetalleVenta->peso_neto = $d['peso_mod_neto'];
            $LoteDetalleVenta->peso_bruto = $d['peso_mod_bruto'];
            $LoteDetalleVenta->merma_bruta = $d['merma_bruta'];
            $LoteDetalleVenta->merma_neta = $d['merma_neta'];
            $LoteDetalleVenta->venta_id = $venta->id;
            $LoteDetalleVenta->lote_detalle_id = $d['id'];
            $LoteDetalleVenta->precio_acuerdo = $d['valor_precio'];
            $LoteDetalleVenta->total = $d['total'];

            $LoteDetalleVenta->save();
            $loteDetalleCompra = new LoteDetalleCompra();
            $loteDetalleCompra->lote_detalle_id = $d['id'];
            $loteDetalleCompra->compra_id = $d['compra_id'];
            $loteDetalleCompra->peso_neto = $d['peso_actual_neto'] - $d['peso_mod_neto'];
            $loteDetalleCompra->peso_bruto = $d['peso_actual_bruto'] - $d['peso_mod_bruto'];
            $loteDetalleCompra->save();

            $lotaDetalleHistorial = new LoteDetalleHistorial();
            $lotaDetalleHistorial->lote_detalle_id = $d['id'];
            $lotaDetalleHistorial->lote_detalle_venta_id = $LoteDetalleVenta->id;
            $lotaDetalleHistorial->lote_detalle_producto_id = $loteDetalleProducto->id;
            $lotaDetalleHistorial->lote_detalle_cliente_id = $loteDetalleCliente->id;
            $lotaDetalleHistorial->lote_detalle_seguimiento_id = $loteDetalleSeguimiento->id;
            $lotaDetalleHistorial->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
            $lotaDetalleHistorial->lote_detalle_compra_id = $loteDetalleCompra->id;
            $lotaDetalleHistorial->venta_id = $venta->id;
            $lotaDetalleHistorial->save();
        }
        if (count($request->detalle_vente_lotes) > 0 && count($request->venta_items) == 0 && count($request->venta_pps) == 0) {
            $ventaCerrada = new VentaCerrada();
            $ventaCerrada->venta_id = $venta->id;
            $ventaCerrada->fecha = Carbon::now();
            $ventaCerrada->save();
        }
        if (count($request->detalle_vente_lotes) == 0 && count($request->venta_items) == 0 && count($request->venta_pps) > 0) {
            $pp_id = $request->venta_pps[0]['pp']['id'];
            $ventaPp = new VentaPp();
            $ventaPp->venta_id = $venta->id;
            $ventaPp->pp_id = $pp_id;
            $ventaPp->fecha = Carbon::now();
            $ventaPp->save();
        }
        if (count($request->detalle_vente_lotes) == 0 && count($request->venta_items) > 0 && count($request->venta_pps) == 0) {
            $pt_id = $request->venta_items[0]['pt_id'];
            $ventaPt = new VentaPt();
            $ventaPt->venta_id = $venta->id;
            $ventaPt->pt_id = $pt_id;
            $ventaPt->fecha = Carbon::now();
            $ventaPt->save();
        }
        foreach ($request->lotes as $d) {
            $lote = Lote::find($d['id']);
            $lote->fin = 1;
            $lote->save();
            $compra = $lote->compra;
            $compra->fin = 1;
            $compra->save();
        }
        foreach ($request->venta_transformacion as $d) {
            $ventaTransformacion = new VentaTransformacion();
            $ventaTransformacion->venta_id = $venta->id;
            $ventaTransformacion->transformacion_id = $d['tramsformacion']['id'];
            $ventaTransformacion->pt_id = $d['pt']['id'];
            $ventaTransformacion->sucursal_id = $request->sucursal_id;
            $ventaTransformacion->subitem_id = $d['subitem']['id'];
            $ventaTransformacion->cajas = $d['total_cajas'];
            $ventaTransformacion->peso_bruto = $d['total_peso_bruto'];
            $ventaTransformacion->peso_neto = $d['total_peso_neto'];
            $ventaTransformacion->save();
        }
        $venta_turno_chofer = new VentaTurnoChofer();
        $venta_turno_chofer->turno_chofer_id = $request->turno_chofer_id;
        $venta_turno_chofer->venta_id = $venta->id;
        $venta_turno_chofer->peso = $request->peso_bruto_total;
        $venta_turno_chofer->fecha = Carbon::now()->format('Y-m-d');
        $venta_turno_chofer->entregado = 1;
        $venta_turno_chofer->save();
        $venta->url_pdf = url("reportes/ventas-oficial/$venta->id");
        $venta->url_pdf_ticket = url("reportes/ventas-oficial/$venta->id");
        return $venta;
    }

    public function venta2(Request $request)
    {
        //dd($request->all());
        //dd($request->venta_items);
        try {
            $venta = DB::transaction(function () use ($request) {

                $venta = new Venta();
                $venta->fecha = Carbon::now()->format('Y-m-d');
                $venta->fecha_entrega = $request->fecha_entrega;
                $venta->hora_entrega = $request->hora_entrega;
                $venta->metodo_pago = $request->metodo_pago;
                $venta->despachado = 1;
                $venta->user_id = $request->user_id;
                $venta->preventista_id = $request->preventista_id;
                $venta->distribuidor_id = $request->distribuidor_id;
                $venta->sucursal_id = $request->sucursal_id;
                $venta->cliente_id = $request->cliente_id;
                $venta->chofer_id = $request->chofer_id;
                $venta->observacion = $request->observacion;
                $venta->total = $request->total;
                if ($request->metodo_pago == 1) {
                    $venta->pagado_total = 0;
                    $venta->pendiente_total = $request->total;
                } else {
                    $venta->pagado_total = 0;
                    $venta->pendiente_total = $request->total;
                }
                $venta->acuerdo_cliente_id = isset($request->acuerdo['id']) ? $request->acuerdo['id'] : 1;
                $venta->save();

                $cajas_cantidad = 0;
                $cliente = Cliente::find($request->cliente_id);

                $ventaCaja = new VentaCaja();
                $ventaCaja->venta_id = $venta->id;
                $ventaCaja->cliente_id = $request->cliente_id;
                $ventaCaja->cajas = $request->total_cajas;
                $ventaCaja->save();

                foreach ($request->venta_pps as $d) {
                    $item_id = isset($d['item']['id']) ? (int)$d['item']['id'] : 0;

                    $ventaDetallePp = new VentaDetallePp();
                    $ventaDetallePp->fecha = Carbon::now()->format('Y-m-d');
                    $ventaDetallePp->hora = Carbon::now()->format('H:i:s');
                    $ventaDetallePp->cajas = $d['cajas_vender'];
                    $ventaDetallePp->pollos = $d['pollos_vender'];
                    $ventaDetallePp->peso_bruto = $d['peso_bruto_vender'];
                    $ventaDetallePp->peso_neto = $d['peso_neto_vender'];
                    $ventaDetallePp->item_id = $item_id > 0 ? $item_id : 1;
                    $ventaDetallePp->precio = $d['item']['venta'];
                    $ventaDetallePp->pp_id = $d['pp']['id'];
                    $ventaDetallePp->precio_acuerdo = $d['precio_acuerdo'];
                    $ventaDetallePp->tipo_pp = (int)($d['tipo_pp'] ?? data_get($d, 'pp.tipo_pp') ?? 0);
                    $ventaDetallePp->total = $d['total'];
                    $ventaDetallePp->cinta_cliente_id = $d['cinta_cliente_id'];
                    $ventaDetallePp->cliente_id = $request->cliente_id;
                    $ventaDetallePp->venta_id = $venta->id;
                    $ventaDetallePp->save();

                    if (isset($d['subdetalle']) && $d['subdetalle']['descuento_valor'] > 0) {
                        $subdetalle = new SubdetalleDescuentoAcuerdo();
                        $subdetalle->venta_detalle_pp_id = $ventaDetallePp->id;
                        $subdetalle->item_id = $d['subdetalle']['item_id'];
                        $subdetalle->item_nombre = $d['subdetalle']['item_nombre'] ?? null;
                        $subdetalle->acuerdo_id = $d['subdetalle']['acuerdo']['id'] ?? null;
                        $subdetalle->acuerdo_nombre = $d['subdetalle']['acuerdo']['name'] ?? null;
                        $subdetalle->peso = $d['subdetalle']['peso'] ?? null;
                        $subdetalle->cantidad = $d['subdetalle']['cantidad'] ?? null;
                        $subdetalle->descuento_valor = $d['subdetalle']['descuento_valor'] ?? null;
                        $subdetalle->total_con_descuento = $d['subdetalle']['total_con_descuento'] ?? null;
                        $subdetalle->total_sin_descuento = $d['subdetalle']['total_sin_descuento'] ?? null;
                        $subdetalle->pp_id = $d['pp']['id'];
                        $subdetalle->save();
                    }
                }

                foreach ($request->venta_items as $d) {
                    $itemsPt = new ItemsPt();
                    $itemsPt->fecha = Carbon::now()->format('Y-m-d');
                    $itemsPt->pt_id = $d['pt_id'];
                    $itemsPt->item_id = $d['item']['id'];
                    $itemsPt->cajas = 0 - $d['cajas_vender'];
                    $itemsPt->taras = 0 - $d['tara_vender'];
                    $itemsPt->peso_bruto = 0 - $d['peso_bruto_vender'];
                    $itemsPt->peso_neto = 0 - $d['peso_neto_vender'];
                    $itemsPt->tipo = 4;
                    $itemsPt->save();

                    $ventaItemsPt = new VentaItemsPt();
                    $ventaItemsPt->fecha = Carbon::now()->format('Y-m-d');
                    $ventaItemsPt->pt_id = $d['pt_id'];
                    $ventaItemsPt->items_pt_id = $itemsPt->id;
                    $ventaItemsPt->venta_id = $venta->id;
                    $ventaItemsPt->item_id = $d['item']['id'];
                    $ventaItemsPt->cajas = $d['cajas_vender'];
                    $ventaItemsPt->taras = $d['tara_vender'];
                    $ventaItemsPt->peso_bruto = $d['peso_bruto_vender'];
                    $ventaItemsPt->peso_neto = $d['peso_neto_vender'];
                    $ventaItemsPt->precio = $d['item']['venta'];
                    $ventaItemsPt->total = $d['total'];
                    $ventaItemsPt->save();

                    $cajas_cantidad += $d['cajas_vender'];
                }

                foreach ($request->detalle_vente_lotes as $d) {
                    $loteDetalleMovimiento = new LoteDetalleMovimiento();
                    $loteDetalleMovimiento->lote_detalle_id = $d['id'];
                    $loteDetalleMovimiento->descripcion = 'SALIDA POR VENTA';
                    $loteDetalleMovimiento->cantidad = $d['equivalente'];
                    $loteDetalleMovimiento->peso_neto = (is_numeric($d['peso_actual_neto']) && is_finite($d['peso_actual_neto'])) ? $d['peso_actual_neto'] : 0;
                    $loteDetalleMovimiento->peso_bruto = (is_numeric($d['peso_actual_bruto']) && is_finite($d['peso_actual_bruto'])) ? $d['peso_actual_bruto'] : 0;
                    $loteDetalleMovimiento->cajas = (is_numeric($d['cajas']) && is_finite($d['cajas'])) ? $d['cajas'] : 0;
                    $loteDetalleMovimiento->peso = (is_numeric($d['peso_total']) && is_finite($d['peso_total'])) ? $d['peso_total'] : 0;
                    $loteDetalleMovimiento->tipo = 2;
                    $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
                    $loteDetalleMovimiento->save();

                    $loteDetalle = LoteDetalle::find($d['id']);
                    $seguimiento = $loteDetalle->LoteDetalleSeguimientos();
                    $kgs_s = $seguimiento->sum('kgs_s');
                    $unit_s = $seguimiento->sum('unit_s');
                    $cont_s = $seguimiento->sum('cont_s');

                    $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
                    $loteDetalleSeguimiento->lote_detalle_id = $d['id'];
                    $loteDetalleSeguimiento->nro = "NDD N°{$venta->id}";
                    $loteDetalleSeguimiento->cliente = "{$cliente->id} {$cliente->nombre}";
                    $loteDetalleSeguimiento->fecha = Carbon::now()->format('Y-m-d');
                    $loteDetalleSeguimiento->cont_s = $d['cajas'];
                    $loteDetalleSeguimiento->cont_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
                    $loteDetalleSeguimiento->unit_s = $d['equivalente'];
                    $loteDetalleSeguimiento->unit_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
                    $loteDetalleSeguimiento->kgs_s = $d['peso_mod_neto'];
                    $loteDetalleSeguimiento->kgs_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
                    $loteDetalleSeguimiento->save();

                    $loteDetalleCliente = new LoteDetalleCliente();
                    $loteDetalleCliente->lote_detalle_id = $d['id'];
                    $loteDetalleCliente->lote_id = $d['lote_id'];
                    $loteDetalleCliente->cliente_id = $cliente->id;
                    $loteDetalleCliente->nro = "NDD N°{$venta->id}";
                    $loteDetalleCliente->cliente = "{$cliente->id} {$cliente->nombre}";
                    $loteDetalleCliente->fecha = Carbon::now()->format('Y-m-d');
                    $loteDetalleCliente->hora = Carbon::now()->format('H:i:s');
                    $loteDetalleCliente->user_id = $request->user_id;
                    $loteDetalleCliente->peso_bruto = $d['peso_mod_bruto'];
                    $loteDetalleCliente->peso_neto = $d['peso_mod_neto'];
                    $loteDetalleCliente->tara = $d['peso_mod_bruto'] - $d['peso_mod_neto'];
                    $loteDetalleCliente->cont_e = $loteDetalle->cajas;
                    $loteDetalleCliente->cont_s = $d['cajas'];
                    $loteDetalleCliente->cont_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
                    $loteDetalleCliente->unit_s = $d['equivalente'];
                    $loteDetalleCliente->unit_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
                    $loteDetalleCliente->kgs_s = $d['peso_mod_neto'];
                    $loteDetalleCliente->kgs_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
                    $loteDetalleCliente->save();

                    $loteDetalleProducto = new LoteDetalleProducto();
                    $loteDetalleProducto->lote_detalle_id = $d['id'];
                    $loteDetalleProducto->lote_id = $d['lote_id'];
                    $loteDetalleProducto->producto = $d['producto'];
                    $loteDetalleProducto->pigmento = $d['pigmento'];
                    $loteDetalleProducto->tipo = "NDD";
                    $loteDetalleProducto->nro = "S";
                    $loteDetalleProducto->id_nro = "{$venta->id}";
                    $loteDetalleProducto->detalle = "{$cliente->id} {$cliente->nombre}";
                    $loteDetalleProducto->fecha = Carbon::now()->format('Y-m-d');
                    $loteDetalleProducto->hora = Carbon::now()->format('H:i:s');
                    $loteDetalleProducto->user_id = $request->user_id;
                    $loteDetalleProducto->tipo_mov = 1;
                    $loteDetalleProducto->peso_bruto = $d['peso_mod_bruto'];
                    $loteDetalleProducto->peso_neto = $d['peso_mod_neto'];
                    $loteDetalleProducto->tara = $d['peso_mod_bruto'] - $d['peso_mod_neto'];
                    $loteDetalleProducto->cajas_e = $loteDetalle->cajas - $cont_s;
                    $loteDetalleProducto->cajas_s = $d['cajas'];
                    $loteDetalleProducto->cajas_sa = $loteDetalle->cajas - ($d['cajas'] + $cont_s);
                    $loteDetalleProducto->und_s = $d['equivalente'];
                    $loteDetalleProducto->und_sa = $loteDetalle->equivalente - ($d['equivalente'] + $unit_s);
                    $loteDetalleProducto->kg_s = $d['peso_mod_neto'];
                    $loteDetalleProducto->kg_sa = ($loteDetalle->peso_total - ($loteDetalle->cajas * 2)) - ($kgs_s + $d['peso_mod_neto']);
                    $loteDetalleProducto->save();

                    $LoteDetalleVenta = new LoteDetalleVenta();
                    $LoteDetalleVenta->pollos         = $d['equivalente'];
                    $LoteDetalleVenta->cajas          = $d['cajas'];
                    $LoteDetalleVenta->fecha          = Carbon::now()->format('Y-m-d');
                    $LoteDetalleVenta->peso_total     = $d['peso_total'];
                    $LoteDetalleVenta->peso_neto      = $d['peso_mod_neto'];
                    $LoteDetalleVenta->peso_bruto     = $d['peso_mod_bruto'];
                    $LoteDetalleVenta->merma_bruta    = (is_numeric($d['merma_bruta']) && is_finite($d['merma_bruta'])) ? $d['merma_bruta'] : 0;
                    $LoteDetalleVenta->merma_neta     = (is_numeric($d['merma_neta']) && is_finite($d['merma_neta'])) ? $d['merma_neta'] : 0;
                    $LoteDetalleVenta->venta_id       = $venta->id;
                    $LoteDetalleVenta->lote_detalle_id = $d['id'];
                    $LoteDetalleVenta->precio_acuerdo = $d['valor_precio'];
                    $LoteDetalleVenta->total          = $d['total'];
                    $LoteDetalleVenta->save();

                    $loteDetalleCompra = new LoteDetalleCompra();
                    $loteDetalleCompra->lote_detalle_id = $d['id'];
                    $loteDetalleCompra->compra_id = $d['compra_id'];
                    $toNum = function ($v) {
                        $f = (float) str_replace([',', ' '], ['', ''], (string) $v);
                        return (is_infinite($f) || is_nan($f)) ? 0.0 : $f;
                    };
                    $actual_neto   = $toNum($d['peso_actual_neto']);
                    $mod_neto      = $toNum($d['peso_mod_neto']);
                    $actual_bruto  = $toNum($d['peso_actual_bruto']);
                    $mod_bruto     = $toNum($d['peso_mod_bruto']);
                    $loteDetalleCompra->peso_neto  = $actual_neto  - $mod_neto;
                    $loteDetalleCompra->peso_bruto = $actual_bruto - $mod_bruto;
                    $loteDetalleCompra->save();

                    $lotaDetalleHistorial = new LoteDetalleHistorial();
                    $lotaDetalleHistorial->lote_detalle_id = $d['id'];
                    $lotaDetalleHistorial->lote_detalle_venta_id = $LoteDetalleVenta->id;
                    $lotaDetalleHistorial->lote_detalle_producto_id = $loteDetalleProducto->id;
                    $lotaDetalleHistorial->lote_detalle_cliente_id = $loteDetalleCliente->id;
                    $lotaDetalleHistorial->lote_detalle_seguimiento_id = $loteDetalleSeguimiento->id;
                    $lotaDetalleHistorial->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
                    $lotaDetalleHistorial->lote_detalle_compra_id = $loteDetalleCompra->id;
                    $lotaDetalleHistorial->venta_id = $venta->id;
                    $lotaDetalleHistorial->save();

                    $cajas_cantidad += $d['cajas'];
                }

                if (count($request->detalle_vente_lotes) > 0 && count($request->venta_items) == 0 && count($request->venta_pps) == 0) {
                    $ventaCerrada = new VentaCerrada();
                    $ventaCerrada->venta_id = $venta->id;
                    $ventaCerrada->fecha = Carbon::now();
                    $ventaCerrada->save();
                }
                if (count($request->detalle_vente_lotes) == 0 && count($request->venta_items) == 0 && count($request->venta_pps) > 0) {
                    $pp_id = $request->venta_pps[0]['pp']['id'];
                    $ventaPp = new VentaPp();
                    $ventaPp->venta_id = $venta->id;
                    $ventaPp->pp_id = $pp_id;
                    $ventaPp->fecha = Carbon::now();
                    $ventaPp->save();
                }
                if (count($request->detalle_vente_lotes) == 0 && count($request->venta_items) > 0 && count($request->venta_pps) == 0) {
                    $pt_id = $request->venta_items[0]['pt_id'];
                    $ventaPt = new VentaPt();
                    $ventaPt->venta_id = $venta->id;
                    $ventaPt->pt_id = $pt_id;
                    $ventaPt->fecha = Carbon::now();
                    $ventaPt->save();
                }

                foreach ($request->lotes as $d) {
                    $lote = Lote::find($d['id']);
                    $lote->fin = 1;
                    $lote->save();
                    $compra = $lote->compra;
                    $compra->fin = 1;
                    $compra->save();
                }

                foreach ($request->venta_transformacion as $d) {
                    $ventaTransformacion = new VentaTransformacion();
                    $ventaTransformacion->venta_id = $venta->id;
                    $ventaTransformacion->transformacion_id = $d['tramsformacion']['id'];
                    $ventaTransformacion->pt_id = $d['pt']['id'];
                    $ventaTransformacion->sucursal_id = $request->sucursal_id;
                    $ventaTransformacion->subitem_id = $d['subitem']['id'];
                    $ventaTransformacion->cajas = $d['total_cajas'];
                    $ventaTransformacion->peso_bruto = $d['total_peso_bruto'];
                    $ventaTransformacion->taras = ($d['total_cajas'] > 0) ? $d['total_cajas'] * 2 : 0;
                    $ventaTransformacion->peso_neto = $d['total_peso_neto'];
                    $ventaTransformacion->venta = $d['subitem']['venta'] ?? 0.00;
                    $ventaTransformacion->total = $d['subtotal'];
                    $ventaTransformacion->save();
                    $cajas_cantidad += $d['total_cajas'];
                }

                foreach ($request->cart_acuerdo_items as $acuerdo) {
                    $ventaAcuerdo = new VentaAcuerdo();
                    $ventaAcuerdo->venta_id = $venta->id;
                    $ventaAcuerdo->item = $acuerdo["item"];
                    $ventaAcuerdo->cod = $acuerdo["cod"];
                    $ventaAcuerdo->cajas = $acuerdo["cajas"];
                    $ventaAcuerdo->unidad = $acuerdo["unidad"];
                    $ventaAcuerdo->peso_bruto = $acuerdo["peso_bruto"];
                    $ventaAcuerdo->peso_neto = $acuerdo["peso_neto"];
                    $ventaAcuerdo->tara = $acuerdo["tara"];
                    $ventaAcuerdo->precio_kg = $acuerdo["precio_kg"];
                    $ventaAcuerdo->total = $acuerdo["total"];
                    $ventaAcuerdo->save();
                }

                foreach ($request->cart_gastos as $gasto) {
                    $ventaGasto = new VentaGasto();
                    $ventaGasto->venta_id = $venta->id;
                    $ventaGasto->detalle = $gasto["detalle"];
                    $ventaGasto->valor = $gasto["valor"];
                    $ventaGasto->save();
                }

                $venta_turno_chofer = new VentaTurnoChofer();
                $venta_turno_chofer->turno_chofer_id = $request->turno_chofer_id;
                $venta_turno_chofer->venta_id = $venta->id;
                $venta_turno_chofer->peso = $request->peso_bruto_total;
                $venta_turno_chofer->fecha = Carbon::now()->format('Y-m-d');
                $venta_turno_chofer->entregado = 1;
                $venta_turno_chofer->save();

                $cajaVentaCliente = new CajaVentaCliente();
                $cajaVentaCliente->venta_id = $venta->id;
                $cajaVentaCliente->cliente_id = $request->cliente_id;
                $cajaVentaCliente->sucursal_id = $request->sucursal_id;
                $cajaVentaCliente->fecha = $request->fecha_entrega;
                $cajaVentaCliente->hora = $request->hora_entrega;
                $cajaVentaCliente->cantidad = $cajas_cantidad;
                $cajaVentaCliente->save();

                $ventaId = $venta->id;
                $venta = Venta::with([
                    'ventaDetallePps',
                    'ventaTransformacions',
                    'ventaItemsPts',
                    'loteDetalleVentas',
                    'ventaGastos',
                    'ventaAcuerdos',
                ])->find($ventaId);

                $venta->url_pdf = url("reportes/ventas-oficial/$venta->id");
                $venta->url_pdfTicket = url("reportes/ticket-ventas-oficial/$venta->id");
                return $venta;
            }, 3);
            return response()->json($venta, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'No se pudo registrar la venta. Se revirtió todo.',
                'error'   => $e->getMessage(),
            ], 422);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    // public function show(Venta $venta)
    // {
    //     $venta->venta_detalle_pps = $venta->VentaDetallePps()->with(['Item', 'subdetalleDescuentoAcuerdo'])->get();
    //     $venta->lote_detalle_ventas = $venta->LoteDetalleVentas()->get();
    //     $venta->venta_items = $venta->VentaItemsPts()->get();
    //     $venta->venta_transformaciones = $venta->VentaTransformacions()->get();
    //     $venta->venta_gastos           = $venta->VentaGastos()->get();
    //     $venta->venta_acuerdos         = $venta->VentaAcuerdos()->get();
    //     //dd($venta->venta_detalle_pps);

    //     // $cantidad_cajas = $venta->Cliente->VentaCajas()->sum('cajas');
    //     // $entrega_cajas  = $venta->Cliente->EntregaCajas()->sum('cajas');
    //     // $venta->cajas_pendientes_global = $cantidad_cajas - $entrega_cajas;

    //     $hasta = Carbon::parse($venta->fecha)->endOfDay();
    //     $cantidad_cajas = $venta->Cliente->VentaCajas()->where('created_at', '<=', $hasta)->sum('cajas');
    //     $entrega_cajas  = $venta->Cliente->EntregaCajas()->where('created_at', '<=', $hasta)->sum('cajas');
    //     $venta->cajas_pendientes_global_hoy = $cantidad_cajas - $entrega_cajas;
    //     $venta->cajas_venta = optional($venta->VentaCaja)->cajas ?? 0;
    //     $venta->cajas_pendientes_global_pre = max(0, $venta->cajas_pendientes_global_hoy - $venta->cajas_venta);


    //     return $venta;
    // }


    public function show(Venta $venta)
    {
        $venta->venta_detalle_pps = $venta->VentaDetallePps()->with(['Item', 'subdetalleDescuentoAcuerdo'])->get();
        $venta->lote_detalle_ventas = $venta->LoteDetalleVentas()->get();
        $venta->venta_items = $venta->VentaItemsPts()->get();
        $venta->venta_transformaciones = $venta->VentaTransformacions()->get();
        $venta->venta_gastos = $venta->VentaGastos()->get();
        $venta->venta_acuerdos = $venta->VentaAcuerdos()->get();

        // $hasta = Carbon::parse($venta->created_at);
        // $cantidad_cajas = $venta->Cliente->VentaCajas()->where('estado', 1)->where('created_at', '<=', $hasta)->sum('cajas');
        // $entrega_cajas  = $venta->Cliente->EntregaCajas()->where('created_at', '<=', $hasta)->sum('cajas');
        // $venta->cajas_pendientes_global_hoy = $cantidad_cajas - $entrega_cajas;
        // $venta->cajas_venta = optional($venta->VentaCaja)->cajas ?? 0;
        // $venta->cajas_pendientes_global_pre = max(0, $venta->cajas_pendientes_global_hoy - $venta->cajas_venta);

        $hasta = Carbon::parse($venta->created_at);
        $cantidad_cajas = $venta->Cliente->VentaCajas()->where('estado', 1)->where('created_at', '<', $hasta)->sum('cajas');
        $entrega_cajas = $venta->Cliente->EntregaCajas()->where('created_at', '<', $hasta)->sum('cajas');
        $venta->cajas_pendientes_saldo_anterior = max(0, $cantidad_cajas - $entrega_cajas);
        if ($venta->VentaCaja && $venta->VentaCaja->estado == 1) {
            $venta->cajas_pendientes_venta_hoy = max(0, $venta->VentaCaja->cajas);
        } else {
            $venta->cajas_pendientes_venta_hoy = 0;
        }
        $venta->cajas_pendientes_global_hoy = $venta->cajas_pendientes_saldo_anterior;
        $venta->cajas_venta_saldo_actual = max(0, $venta->cajas_pendientes_global_hoy + $venta->cajas_pendientes_venta_hoy);

        return $venta;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $venta->name = $request->name;
        $venta->save();
        return $venta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Venta $venta)
    // {
    //     $venta->estado = 0;
    //     $venta->save();

    //     $venta->load('ventaDetallePps.subdetalleDescuentoAcuerdo');
    //     foreach ($venta->VentaDetallePps as $d) {
    //         $d->estado = 0;

    //         $d->save();
    //         if ($d->subdetalleDescuentoAcuerdo) {
    //             $d->subdetalleDescuentoAcuerdo->estado = 0;
    //             $d->subdetalleDescuentoAcuerdo->save();
    //         }
    //         // $ventaDetallePp = new VentaDetallePp();
    //         // $ventaDetallePp->fecha = Carbon::now()->format('Y-m-d');
    //         // $ventaDetallePp->hora = Carbon::now()->format('H:i:s');
    //         // $ventaDetallePp->cajas = 0-$d->cajas;
    //         // $ventaDetallePp->pollos = 0-$d->pollos;
    //         // $ventaDetallePp->peso_bruto = 0-$d->peso_bruto;
    //         // $ventaDetallePp->peso_neto = 0-$d->peso_neto;
    //         // $ventaDetallePp->item_id = $d->item_id;
    //         // $ventaDetallePp->precio = $d->precio;
    //         // $ventaDetallePp->pp_id = $d->pp_id;
    //         // $ventaDetallePp->cinta_cliente_id = $d->cinta_cliente_id;
    //         // $ventaDetallePp->cliente_id = $d->cliente_id;
    //         // $ventaDetallePp->venta_id = $d->venta_id;
    //         // $ventaDetallePp->save();
    //     }
    //     foreach ($venta->LoteDetalleVentas as $d) {



    //         // $d->estado = 0;
    //         // $d->save();
    //         $loteDetalle = $d->LoteDetalle;
    //         $lote = $loteDetalle->Lote;
    //         $compra = $lote->Compra;
    //         $compra->fin = 0;
    //         $compra->save();
    //         $lote->fin = 0;
    //         $lote->save();
    //         $LoteDetalleHistorial = $d->LoteDetalleHistorial;
    //         $LoteDetalleMovimiento = $LoteDetalleHistorial->LoteDetalleMovimiento;
    //         $LoteDetalleMovimiento->estado = 0;
    //         $LoteDetalleMovimiento->anulado = 1;
    //         $LoteDetalleMovimiento->save();
    //         $LoteDetalleCompra = $LoteDetalleHistorial->LoteDetalleCompra;
    //         $LoteDetalleProducto = $LoteDetalleHistorial->LoteDetalleProducto;
    //         $LoteDetalleProducto->cajas_e = 0;
    //         $LoteDetalleProducto->cajas_s = 0;
    //         $LoteDetalleProducto->und_s = 0;
    //         $LoteDetalleProducto->kg_s = 0;
    //         $LoteDetalleProducto->anulado = 1;
    //         $LoteDetalleProducto->save();
    //         $LoteDetalleCliente = $LoteDetalleHistorial->LoteDetalleCliente;
    //         $LoteDetalleCliente->cont_e = 0;
    //         $LoteDetalleCliente->cont_s = 0;
    //         $LoteDetalleCliente->unit_s = 0;
    //         $LoteDetalleCliente->kgs_s = 0;
    //         $LoteDetalleCliente->anulado = 1;
    //         $LoteDetalleCliente->save();
    //         $LoteDetalleSeguimiento = $LoteDetalleHistorial->LoteDetalleSeguimiento;
    //         $LoteDetalleSeguimiento->cont_s = 0;
    //         $LoteDetalleSeguimiento->cont_s = 0;
    //         $LoteDetalleSeguimiento->unit_s = 0;
    //         $LoteDetalleSeguimiento->kgs_s = 0;
    //         $LoteDetalleSeguimiento->anulado = 1;
    //         $LoteDetalleSeguimiento->save();
    //         // $loteDetalleMovimiento = new LoteDetalleMovimiento();
    //         // $loteDetalleMovimiento->lote_detalle_id = $loteDetalle->id;
    //         // $loteDetalleMovimiento->descripcion = 'ENTRADA POR ANULACION DE VENTA';
    //         // $loteDetalleMovimiento->cantidad = 0-$LoteDetalleMovimiento->cantidad;
    //         // $loteDetalleMovimiento->peso_neto = 0-$LoteDetalleMovimiento->peso_neto;
    //         // $loteDetalleMovimiento->peso_bruto = 0-$LoteDetalleMovimiento->peso_bruto;
    //         // $loteDetalleMovimiento->cajas =  0-$LoteDetalleMovimiento->cajas;
    //         // $loteDetalleMovimiento->peso = 0-$LoteDetalleMovimiento->peso;
    //         // $loteDetalleMovimiento->tipo = 2;
    //         // $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
    //         // $loteDetalleMovimiento->save();
    //     }
    //     foreach ($venta->VentaItemsPts as $d) {
    //         $d->estado = 0;
    //         $d->save();
    //         $itemPt = $d->ItemsPt;
    //         $itemsPt = new ItemsPt();
    //         $itemsPt->fecha = Carbon::now()->format('Y-m-d');
    //         $itemsPt->pt_id = $itemPt->pt_id;
    //         $itemsPt->item_id = $itemPt->item_id;
    //         $itemsPt->cajas = abs($itemPt->cajas);
    //         $itemsPt->taras = abs($itemPt->taras);
    //         $itemsPt->peso_bruto = abs($itemPt->peso_bruto);
    //         $itemsPt->peso_neto = abs($itemPt->peso_neto);
    //         $itemsPt->save();
    //         // $ventaItemsPt = new VentaItemsPt();
    //         // $ventaItemsPt->fecha = Carbon::now()->format('Y-m-d');
    //         // $ventaItemsPt->pt_id = $d->pt_id;
    //         // $ventaItemsPt->items_pt_id = $itemsPt->id;
    //         // $ventaItemsPt->venta_id = $d->venta_id;
    //         // $ventaItemsPt->item_id = $d->item_id;
    //         // $ventaItemsPt->cajas = 0-$d->cajas;
    //         // $ventaItemsPt->taras = 0-$d->taras;
    //         // $ventaItemsPt->peso_bruto = 0-$d->peso_bruto;
    //         // $ventaItemsPt->peso_neto = 0-$d->peso_neto;
    //         // $ventaItemsPt->save();

    //     }
    //     foreach ($venta->VentaTransformacions as $d) {
    //         $d->estado = 0;
    //         $d->save();
    //     }
    //     $ventaCajas = $venta->Cliente->VentaCajas()->where('venta_id', $venta->id)->get();
    //     foreach ($ventaCajas as $ventaCaja) {
    //         $ventaCaja->estado = 0;
    //         $ventaCaja->save();
    //     }
    //     return $venta;
    // }


    public function destroy(Venta $venta)
    {
        $venta->estado = 0;

        $venta->save();
        ArqueoVenta::where('venta_id', $venta->id)->update(['estado' => 0]);

        $venta->load('ventaDetallePps.subdetalleDescuentoAcuerdo');
        foreach ($venta->VentaDetallePps as $d) {
            $d->estado = 0;

            $d->save();
            if ($d->subdetalleDescuentoAcuerdo) {
                $d->subdetalleDescuentoAcuerdo->estado = 0;
                $d->subdetalleDescuentoAcuerdo->save();
            }
        }
        // foreach ($venta->LoteDetalleVentas as $d) {
        //     $loteDetalle = $d->LoteDetalle;
        //     $lote = $loteDetalle->Lote;
        //     $compra = $lote->Compra;
        //     $compra->fin = 0;
        //     $compra->save();
        //     $lote->fin = 0;
        //     $lote->save();
        //     $LoteDetalleHistorial = $d->LoteDetalleHistorial;
        //     $LoteDetalleMovimiento = $LoteDetalleHistorial->LoteDetalleMovimiento;
        //     $LoteDetalleMovimiento->estado = 0;
        //     $LoteDetalleMovimiento->anulado = 1;
        //     $LoteDetalleMovimiento->save();
        //     $LoteDetalleCompra = $LoteDetalleHistorial->LoteDetalleCompra;
        //     $LoteDetalleProducto = $LoteDetalleHistorial->LoteDetalleProducto;
        //     // dd($LoteDetalleProducto->lote_detalle_id);
        //     $LoteDetalleProducto->cajas_e = 0;
        //     $LoteDetalleProducto->cajas_s = 0;
        //     $LoteDetalleProducto->und_s = 0;
        //     $LoteDetalleProducto->kg_s = 0;
        //     $LoteDetalleProducto->anulado = 1;
        //     $LoteDetalleProducto->save();
        //     $LoteDetalleCliente = $LoteDetalleHistorial->LoteDetalleCliente;
        //     $LoteDetalleCliente->cont_e = 0;
        //     $LoteDetalleCliente->cont_s = 0;
        //     $LoteDetalleCliente->unit_s = 0;
        //     $LoteDetalleCliente->kgs_s = 0;
        //     $LoteDetalleCliente->anulado = 1;
        //     $LoteDetalleCliente->save();
        //     $LoteDetalleSeguimiento = $LoteDetalleHistorial->LoteDetalleSeguimiento;
        //     $LoteDetalleSeguimiento->cont_e = 0;
        //     $LoteDetalleSeguimiento->cont_s = 0;
        //     $LoteDetalleSeguimiento->unit_s = 0;
        //     $LoteDetalleSeguimiento->kgs_s = 0;
        //     $LoteDetalleSeguimiento->anulado = 1;
        //     $LoteDetalleSeguimiento->save();
        // }

        foreach ($venta->LoteDetalleVentas as $d) {
            // ===== Lo tuyo: reabrir compra/lote y anular el movimiento =====
            $loteDetalle = $d->LoteDetalle;
            $lote = $loteDetalle->Lote;
            $compra = $lote->Compra;
            $compra->fin = 0;
            $compra->save();
            $lote->fin = 0;
            $lote->save();

            $LoteDetalleHistorial  = $d->LoteDetalleHistorial;
            $LoteDetalleMovimiento = $LoteDetalleHistorial->LoteDetalleMovimiento;
            $LoteDetalleMovimiento->estado  = 0;
            $LoteDetalleMovimiento->anulado = 1;
            $LoteDetalleMovimiento->save();

            $LoteDetalleCompra     = $LoteDetalleHistorial->LoteDetalleCompra;
            $LoteDetalleProducto   = $LoteDetalleHistorial->LoteDetalleProducto;
            $LoteDetalleCliente    = $LoteDetalleHistorial->LoteDetalleCliente;
            $LoteDetalleSeguimiento = $LoteDetalleHistorial->LoteDetalleSeguimiento;

            // ===== 1) Capturar DELTAS de esta venta (lo que había restado) =====
            $delta_prod_kg    = (float) ($LoteDetalleProducto->kg_s    ?? 0);
            $delta_prod_und   = (float) ($LoteDetalleProducto->und_s   ?? 0);
            $delta_prod_cajas = (float) ($LoteDetalleProducto->cajas_s ?? 0);

            $delta_cli_kgs    = (float) ($LoteDetalleCliente->kgs_s    ?? 0);
            $delta_cli_unit   = (float) ($LoteDetalleCliente->unit_s   ?? 0);
            $delta_cli_cont   = (float) ($LoteDetalleCliente->cont_s   ?? 0);

            $delta_seg_kgs    = (float) ($LoteDetalleSeguimiento->kgs_s ?? 0);
            $delta_seg_unit   = (float) ($LoteDetalleSeguimiento->unit_s ?? 0);
            $delta_seg_cont   = (float) ($LoteDetalleSeguimiento->cont_s ?? 0);

            // Para ordenar "posteriores"
            $lote_detalle_id = $LoteDetalleHistorial->lote_detalle_id;
            // Usa la fecha que tengas en esas tablas; si no, created_at del historial
            $orden_fecha = $LoteDetalleProducto->fecha
                ?? $LoteDetalleCliente->fecha
                ?? $LoteDetalleSeguimiento->fecha
                ?? ($LoteDetalleHistorial->fecha ?? $LoteDetalleHistorial->created_at);
            $orden_id    = $LoteDetalleHistorial->id;

            // ===== 2) Anular esta fila (como ya hacías) =====
            // PRODUCTO
            $LoteDetalleProducto->cajas_e = 0; // (lo dejas como venías)
            $LoteDetalleProducto->cajas_s = 0;
            $LoteDetalleProducto->cajas_sa = 0;
            $LoteDetalleProducto->und_s   = 0;
            $LoteDetalleProducto->kg_s    = 0;
            $LoteDetalleProducto->kg_sa    = 0;
            $LoteDetalleProducto->anulado = 1;
            $LoteDetalleProducto->save();

            // CLIENTE
            $LoteDetalleCliente->cont_e  = 0; // lo tuyo
            $LoteDetalleCliente->cont_s  = 0;
            $LoteDetalleCliente->cont_sa  = 0;
            $LoteDetalleCliente->unit_s  = 0;
            $LoteDetalleCliente->kgs_s   = 0;
            $LoteDetalleCliente->kgs_sa   = 0;
            $LoteDetalleCliente->anulado = 1;
            $LoteDetalleCliente->save();

            // SEGUIMIENTO
            $LoteDetalleSeguimiento->cont_e  = 0; // lo tuyo
            $LoteDetalleSeguimiento->cont_s  = 0;
            $LoteDetalleSeguimiento->cont_sa  = 0;
            $LoteDetalleSeguimiento->unit_s  = 0;
            $LoteDetalleSeguimiento->kgs_s   = 0;
            $LoteDetalleSeguimiento->kgs_sa   = 0;
            $LoteDetalleSeguimiento->anulado = 1;
            $LoteDetalleSeguimiento->save();

            // IDs base (fila actual en cada tabla)
            $lote_detalle_id = $LoteDetalleHistorial->lote_detalle_id;
            $idProd = $LoteDetalleProducto->id ?? 0;
            $idCli  = $LoteDetalleCliente->id ?? 0;
            $idSeg  = $LoteDetalleSeguimiento->id ?? 0;

            // ==== PRODUCTO: solo filas con id > idProd ====
            if (($delta_prod_kg ?? 0) || ($delta_prod_und ?? 0) || ($delta_prod_cajas ?? 0)) {
                LoteDetalleProducto::query()
                    ->where('lote_detalle_id', $lote_detalle_id)
                    ->where('id', '>', $idProd) // SOLO posteriores por ID
                    ->update([
                        'kg_sa'    => DB::raw('kg_sa + ' . ($delta_prod_kg ?: 0)),
                        'und_sa'   => DB::raw('und_sa + ' . ($delta_prod_und ?: 0)),
                        'cajas_sa' => DB::raw('cajas_sa + ' . ($delta_prod_cajas ?: 0)),
                        'cajas_e'  => DB::raw('cajas_e + ' . ($delta_prod_cajas ?: 0)),
                    ]);
            }

            // ==== CLIENTE: solo filas con id > idCli ====
            if (($delta_cli_kgs ?? 0) || ($delta_cli_unit ?? 0) || ($delta_cli_cont ?? 0)) {
                LoteDetalleCliente::query()
                    ->where('lote_detalle_id', $lote_detalle_id)
                    ->where('id', '>', $idCli)
                    ->update([
                        'kgs_sa'  => DB::raw('kgs_sa + ' . ($delta_cli_kgs ?: 0)),
                        'unit_sa' => DB::raw('unit_sa + ' . ($delta_cli_unit ?: 0)),
                        'cont_sa' => DB::raw('cont_sa + ' . ($delta_cli_cont ?: 0)),
                    ]);
            }

            // ==== SEGUIMIENTO: solo filas con id > idSeg ====
            if (($delta_seg_kgs ?? 0) || ($delta_seg_unit ?? 0) || ($delta_seg_cont ?? 0)) {
                LoteDetalleSeguimiento::query()
                    ->where('lote_detalle_id', $lote_detalle_id)
                    ->where('id', '>', $idSeg)
                    ->update([
                        'kgs_sa'  => DB::raw('kgs_sa + ' . ($delta_seg_kgs ?: 0)),
                        'unit_sa' => DB::raw('unit_sa + ' . ($delta_seg_unit ?: 0)),
                        'cont_sa' => DB::raw('cont_sa + ' . ($delta_seg_cont ?: 0)),
                    ]);
            }
        }

        foreach ($venta->VentaItemsPts as $d) {
            $d->estado = 0;
            $d->save();
            $itemPt = $d->ItemsPt;
            $itemsPt = new ItemsPt();
            $itemsPt->fecha = Carbon::now()->format('Y-m-d');
            $itemsPt->pt_id = $itemPt->pt_id;
            $itemsPt->item_id = $itemPt->item_id;
            $itemsPt->cajas = abs($itemPt->cajas);
            $itemsPt->taras = abs($itemPt->taras);
            $itemsPt->peso_bruto = abs($itemPt->peso_bruto);
            $itemsPt->peso_neto = abs($itemPt->peso_neto);
            $itemsPt->tipo = 4;
            $itemsPt->save();
        }
        foreach ($venta->VentaTransformacions as $d) {
            $d->estado = 0;
            $d->save();
        }
        $ventaCajas = $venta->Cliente->VentaCajas()->where('venta_id', $venta->id)->get();
        foreach ($ventaCajas as $ventaCaja) {
            $ventaCaja->estado = 0;
            $ventaCaja->save();
        }
        return $venta;
    }
    public function pdf(Venta $venta)
    {
        $venta = $this->show($venta);
        $sucursal = $venta->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.ventas.nota', [
            "venta" => $venta,
            "sucursal" => $sucursal
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function ventaCliente()
    {
        $venta = Venta::with(['Cliente', 'Sucursal', 'User'])->get()->map(function ($v) {
            $v->venta_detalle_pps = $v->VentaDetallePps()->with('Item')->get()->each(function ($vd) {
                $vd->hola = 1;
            });

            return $v;
        });
        $pdf = Pdf::loadView('reportes.pdf.ventas.cliente', [
            "ventas" => $venta
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function ventaClienteReport()
    {
        Carbon::setLocale('es');
        //Carbon en lenguaje español

        $fecha = Carbon::parse("2024-11-10");
        $fecha_1 = Carbon::parse("2024-11-10");
        $fecha_2 = Carbon::parse("2024-11-15");
        $fechas = [];
        while ($fecha_1->lte($fecha_2)) { // Mientras fecha_1 sea menor o igual a fecha_2
            $fechas[] = [
                "fecha" => $fecha_1->translatedFormat('Y-m-d'),
                "fecha_sort" => $fecha_1->format('d'),
                "fecha_sort_date" => strtoupper($fecha_1->translatedFormat('D'))
            ];
            $fecha_1->addDay(); // Incrementamos un día
        }
        $fecha_2 = $fecha_2->addDay();
        // return $fechas;
        $venta = Venta::with(['Cliente', 'Sucursal', 'User', 'Chofer'])->whereBetween('fecha', [$fecha, $fecha_2])->get()->map(function ($v) {
            $v->venta_detalle_pps = $v->VentaDetallePps()->with('Item')->get()->each(function ($vd) {
                $vd->grupo_text = $vd->CintaCliente->name;
                $vd->name_text = $vd->Item->name;
            });
            $v->lote_detalle_ventas = $v->LoteDetalleVentas()->get()->each(function ($vd) {
                $vd->name_text = $vd->LoteDetalle->producto;
            });
            $v->venta_items = $v->VentaItemsPts()->get()->each(function ($vd) {
                $vd->name_text = $vd->Item->name;
            });
            $v->lista_venta_detalle_pps_text = $v->venta_detalle_pps->pluck('name_text')->implode(',');
            $v->lista_grupo_pps_text = $v->venta_detalle_pps->pluck('grupo_text')->implode(',');
            $v->lista_lote_venta_text = $v->lote_detalle_ventas->pluck('name_text')->implode(',');
            $v->lista_venta_items_text = $v->venta_items->pluck('name_text')->implode(',');

            return $v;
        })->groupBy('cliente_id');
        $ventas = [];
        foreach ($venta as $key => $value) {
            $venta_model  = $value->first();
            $lista_venta_detalle_pps_text = "";
            $lista_grupo_pps_text = "";
            $lista_lote_venta_text = "";
            $lista_venta_items_text = "";

            foreach ($value as $k => $v) {
                if ($v->lista_venta_detalle_pps_text != "") {
                    $lista_venta_detalle_pps_text .= $v->lista_venta_detalle_pps_text . ",";
                }
                if ($v->lista_grupo_pps_text != "") {
                    $lista_grupo_pps_text .= $v->lista_grupo_pps_text . ",";
                }
                if ($v->lista_lote_venta_text != "") {
                    $lista_lote_venta_text .= $v->lista_lote_venta_text . ",";
                }
                if ($v->lista_venta_items_text != "") {
                    $lista_venta_items_text .= $v->lista_venta_items_text . ",";
                }
            }
            $lista_venta_detalle_pps_text = collect(explode(',', $lista_venta_detalle_pps_text))->unique()->filter()->implode(',');
            $lista_grupo_pps_text = collect(explode(',', $lista_grupo_pps_text))->unique()->filter()->implode(',');
            $lista_lote_venta_text = collect(explode(',', $lista_lote_venta_text))->unique()->filter()->implode(',');
            $lista_venta_items_text = collect(explode(',', $lista_venta_items_text))->unique()->filter()->implode(',');
            $ventas_fecha = [];
            foreach ($fechas as $f) {
                $fecha = $f['fecha'];
                $ventas_fecha[] = [
                    "fecha" => $fecha,
                    "fecha_sort" => $f['fecha_sort'],
                    "fecha_sort_date" => $f['fecha_sort_date'],
                    "ventas" => $value->where('fecha', $fecha)->count()
                ];
            }
            $ventas[] = [
                "cliente_id" => $key,
                "cliente" => $venta_model->Cliente,
                "chofer" => $venta_model->Chofer,
                "preventista" => $venta_model->User,
                "sucursal" => $venta_model->Sucursal,
                "ventas" => $value,
                "ventas_fecha" => $ventas_fecha,
                "lista_venta_detalle_pps_text" => $lista_venta_detalle_pps_text,
                "lista_grupo_pps_text" => $lista_grupo_pps_text,
                "lista_lote_venta_text" => $lista_lote_venta_text,
                "lista_venta_items_text" => $lista_venta_items_text
            ];
        }
        return [
            "ventas" => $ventas,
            "fechas" => $fechas
        ];
    }
    public function ventaClienteReport2(Request $request)
    {
        Carbon::setLocale('es');
        //Carbon en lenguaje español
        $chofer = $request->chofer;
        $preventista = $request->preventista;

        $fecha = Carbon::parse($request->fecha_inicio);
        $fecha_1 = Carbon::parse($request->fecha_inicio);
        $fecha_2 = Carbon::parse($request->fecha_fin);
        $fechas = [];
        while ($fecha_1->lte($fecha_2)) { // Mientras fecha_1 sea menor o igual a fecha_2
            $fechas[] = [
                "fecha" => $fecha_1->translatedFormat('Y-m-d'),
                "fecha_sort" => $fecha_1->format('d'),
                "fecha_sort_date" => strtoupper($fecha_1->translatedFormat('D'))
            ];
            $fecha_1->addDay(); // Incrementamos un día
        }
        $fecha_2 = $fecha_2->addDay();
        // return $fechas;
        $venta = Venta::with(['Cliente', 'Sucursal', 'User', 'Chofer'])->whereBetween('fecha', [$fecha, $fecha_2]);
        if ($chofer !== "all") {
            $venta = $venta->where('chofer_id', $chofer);
        }
        if ($preventista !== "all") {
            $venta = $venta->where('user_id', $preventista);
        }
        $venta = $venta->whereHas('Cliente', function ($query) use ($request) {
            $zona_despacho = $request->zona_despacho;
            $tipo_negocio = $request->tipo_negocio;
            $forma_pedido = $request->forma_pedido;
            if ($zona_despacho !== "all") {
                $query->where('zona_despacho_id', '=', $zona_despacho); // Ejemplo de filtro en la relación Cliente
            }
            if ($tipo_negocio !== "all") {
                $query->where('tipo_negocio_id', '=', $tipo_negocio); // Ejemplo de filtro en la relación Cliente
            }
            if ($forma_pedido !== "all") {
                $query->where('forma_pedido_id', '=', $forma_pedido); // Ejemplo de filtro en la relación Cliente
            }
        });
        $venta = $venta->get()->map(function ($v) {
            $v->venta_detalle_pps = $v->VentaDetallePps()->with('Item')->get()->each(function ($vd) {
                $vd->grupo_text = $vd->CintaCliente->name;
                $vd->name_text = $vd->Item->name;
            });
            $v->lote_detalle_ventas = $v->LoteDetalleVentas()->get()->each(function ($vd) {
                $vd->name_text = $vd->LoteDetalle->producto;
            });
            $v->venta_items = $v->VentaItemsPts()->get()->each(function ($vd) {
                $vd->name_text = $vd->Item->name;
            });
            $v->lista_venta_detalle_pps_text = $v->venta_detalle_pps->pluck('name_text')->implode(',');
            $v->lista_grupo_pps_text = $v->venta_detalle_pps->pluck('grupo_text')->implode(',');
            $v->lista_lote_venta_text = $v->lote_detalle_ventas->pluck('name_text')->implode(',');
            $v->lista_venta_items_text = $v->venta_items->pluck('name_text')->implode(',');

            return $v;
        })->groupBy('cliente_id');
        $ventas = [];
        foreach ($venta as $key => $value) {
            $venta_model  = $value->first();
            $lista_venta_detalle_pps_text = "";
            $lista_grupo_pps_text = "";
            $lista_lote_venta_text = "";
            $lista_venta_items_text = "";

            foreach ($value as $k => $v) {
                if ($v->lista_venta_detalle_pps_text != "") {
                    $lista_venta_detalle_pps_text .= $v->lista_venta_detalle_pps_text . ",";
                }
                if ($v->lista_grupo_pps_text != "") {
                    $lista_grupo_pps_text .= $v->lista_grupo_pps_text . ",";
                }
                if ($v->lista_lote_venta_text != "") {
                    $lista_lote_venta_text .= $v->lista_lote_venta_text . ",";
                }
                if ($v->lista_venta_items_text != "") {
                    $lista_venta_items_text .= $v->lista_venta_items_text . ",";
                }
            }
            $lista_venta_detalle_pps_text = collect(explode(',', $lista_venta_detalle_pps_text))->unique()->filter()->implode(',');
            $lista_grupo_pps_text = collect(explode(',', $lista_grupo_pps_text))->unique()->filter()->implode(',');
            $lista_lote_venta_text = collect(explode(',', $lista_lote_venta_text))->unique()->filter()->implode(',');
            $lista_venta_items_text = collect(explode(',', $lista_venta_items_text))->unique()->filter()->implode(',');
            $ventas_fecha = [];
            foreach ($fechas as $f) {
                $fecha = $f['fecha'];
                $ventas_fecha[] = [
                    "fecha" => $fecha,
                    "fecha_sort" => $f['fecha_sort'],
                    "fecha_sort_date" => $f['fecha_sort_date'],
                    "ventas" => $value->where('fecha', $fecha)->count()
                ];
            }
            $ventas[] = [
                "cliente_id" => $key,
                "cliente" => $venta_model->Cliente,
                "chofer" => $venta_model->Chofer,
                "preventista" => $venta_model->User,
                "sucursal" => $venta_model->Sucursal,
                "ventas" => $value,
                "ventas_fecha" => $ventas_fecha,
                "lista_venta_detalle_pps_text" => $lista_venta_detalle_pps_text,
                "lista_grupo_pps_text" => $lista_grupo_pps_text,
                "lista_lote_venta_text" => $lista_lote_venta_text,
                "lista_venta_items_text" => $lista_venta_items_text
            ];
        }
        return [
            "ventas" => $ventas,
            "fechas" => $fechas
        ];
    }
    public function pdfOficial(Venta $venta)
    {
        $esOriginal = is_null($venta->cobranza_first_printed_at);
        if ($esOriginal) {
            $venta->update([
                'cobranza_first_printed_at' => now(),
                'cobranza_print_count' => 1
            ]);
        } else {
            $venta->increment('cobranza_print_count');
        }
        $venta->tipo_impresion = $esOriginal ? '' : '(COPIA)';
        $venta = $this->show($venta)->loadMissing([
            'Tipopago',
        ]);
        //dd($venta);
        $sucursal = $venta->Sucursal;
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.ventas.nota_oficial', [
            "venta" => $venta,
            "sucursal" => $sucursal
        ])->setPaper('a4');
        return $pdf->stream();
    }


    public function pdfTicketOficial(Venta $venta)
    {
        $esOriginal = is_null($venta->ticket_cobranza_first_printed_at);
        if ($esOriginal) {
            $venta->update([
                'ticket_cobranza_first_printed_at' => now(),
                'ticket_cobranza_print_count' => 1
            ]);
        } else {
            $venta->increment('ticket_cobranza_print_count');
        }
        $venta->tipo_impresion = $esOriginal ? '' : '(COPIA)';
        $venta = $this->show($venta);
        $sucursal = $venta->Sucursal;
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_oficial', [
            "venta" => $venta,
            "sucursal" => $sucursal
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    // public function ticketCajasOficial(Venta $venta)
    // {
    //     $venta = $this->show($venta);
    //     $arqueoCajaVenta = $venta->arqueoCajaVenta()->first();
    //     $sucursal = $venta->Sucursal;

    //     $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
    //         $file->path_url = url($file->File->path);
    //     });
    //     $sucursal->image = $sucursal->file_sucursals->first();

    //     $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cajas_oficial', [
    //         "venta" => $venta,
    //         "sucursal" => $sucursal
    //     ])->setPaper([0, 0, 250, 300], 'portrait');

    //     return $pdf->stream();
    // }


    public function ticketCajasOficial($entregaCajaId, Request $request)
    {
        $entregaCaja = EntregaCaja::with(['Cliente', 'Chofer'])->findOrFail($entregaCajaId);

        if (empty($entregaCaja->venta_id)) {
            abort(422, 'La entrega no tiene una venta asociada (venta_id es NULL o 0).');
        }

        $venta = Venta::findOrFail($entregaCaja->venta_id);

        $entregaCajaRecuperada = EntregaCajaRecuperada::where('entrega_id', $entregaCaja->id)
            ->where('cliente_id', $entregaCaja->cliente_id)
            ->whereDate('fecha', $entregaCaja->fecha)
            ->first();

        // Mostrar data completa de la venta (tu helper)
        $venta = $this->show($venta);
        $sucursal = $venta->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        // ORIGINAL vs COPIA (admin)
        $esOriginal = is_null($entregaCaja->cajas_first_printed_at);
        $marca = $esOriginal ? '' : '(COPIA)';

        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cajas_oficial', [
            "venta" => $venta,
            "sucursal" => $sucursal,
            "entregaCaja" => $entregaCaja,
            "entregaCajaRecuperada" => $entregaCajaRecuperada,
            "marca" => $marca,
        ])->setPaper('a4', 'landscape');

        // Actualizar flags/contador (evita race conditions)
        if (!$request->boolean('preview')) {
            if ($esOriginal) {
                EntregaCaja::where('id', $entregaCaja->id)
                    ->whereNull('cajas_first_printed_at')
                    ->update([
                        'cajas_first_printed_at' => now(),
                        'cajas_print_count' => DB::raw('cajas_print_count + 1'),
                    ]);
            } else {
                EntregaCaja::where('id', $entregaCaja->id)->update([
                    'cajas_print_count' => DB::raw('cajas_print_count + 1'),
                ]);
            }
        }

        return $pdf->stream("cajas_oficial_entrega_{$entregaCaja->id}.pdf");
    }



    public function ticketCajasChoferOficial($entregaCajaId, Request $request)
    {
        $entregaCaja = EntregaCaja::with(['Cliente', 'Chofer'])->findOrFail($entregaCajaId);

        if (empty($entregaCaja->venta_id)) {
            abort(422, 'La entrega no tiene una venta asociada (venta_id es NULL o 0).');
        }

        $venta = Venta::findOrFail($entregaCaja->venta_id);

        $entregaCajaRecuperada = EntregaCajaRecuperada::where('entrega_id', $entregaCaja->id)
            ->where('cliente_id', $entregaCaja->cliente_id)
            ->whereDate('fecha', $entregaCaja->fecha)
            ->first();

        $venta = $this->show($venta);
        $sucursal = $venta->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        // ORIGINAL vs COPIA (chofer)
        $esOriginal = is_null($entregaCaja->cajas_chofer_first_printed_at);
        $marca = $esOriginal ? '' : '(COPIA)';

        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cajas_chofer_oficial', [
            "venta" => $venta,
            "sucursal" => $sucursal,
            "entregaCaja" => $entregaCaja,
            "entregaCajaRecuperada" => $entregaCajaRecuperada,
            "marca" => $marca,
        ])->setPaper('a4', 'landscape');

        if (!$request->boolean('preview')) {
            if ($esOriginal) {
                EntregaCaja::where('id', $entregaCaja->id)
                    ->whereNull('cajas_chofer_first_printed_at')
                    ->update([
                        'cajas_chofer_first_printed_at' => now(),
                        'cajas_chofer_print_count' => DB::raw('cajas_chofer_print_count + 1'),
                    ]);
            } else {
                EntregaCaja::where('id', $entregaCaja->id)->update([
                    'cajas_chofer_print_count' => DB::raw('cajas_chofer_print_count + 1'),
                ]);
            }
        }

        return $pdf->stream("cajas_chofer_oficial_entrega_{$entregaCaja->id}.pdf");
    }


    public function ticketCobranzasOficial(Venta $venta)
    {
        $venta = $this->show($venta);
        $arqueoVenta = $venta->arqueoVenta()->first();
        $sucursal = $venta->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cobranza_oficial', [
            "venta" => $venta,
            "arqueoVenta" => $arqueoVenta,
            "sucursal" => $sucursal
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }


    // public function ticketCobranzasGlobalOficial(Venta $venta)
    // {
    //     $venta = $this->show($venta);
    //     $arqueoVenta = $venta->arqueoVenta()->first();
    //     $sucursal = $venta->Sucursal;

    //     $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
    //         $file->path_url = url($file->File->path);
    //     });
    //     $sucursal->image = $sucursal->file_sucursals->first();
    //     $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cobranza_global_oficial', [
    //         "venta" => $venta,
    //         "arqueoVenta" => $arqueoVenta,
    //         "sucursal" => $sucursal
    //     ])->setPaper('a4', 'landscape');

    //     return $pdf->stream();
    // }

    public function ticketCobranzasIndOficial($pagoId, Request $request)
    {
        $arqueoVenta = ArqueoVenta::with([
            'venta.cliente',
            'venta.sucursal',
            'formapago',
            'user'
        ])->findOrFail($pagoId);

        $venta = $this->show($arqueoVenta->venta);
        $sucursal = $venta->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

        $esOriginal = is_null($arqueoVenta->ticket_first_printed_at);
        $marca = $esOriginal ? '' : '(COPIA)';

        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cobranza_oficial', [
            "venta"        => $venta,
            "arqueoVenta"  => $arqueoVenta,
            "sucursal"     => $sucursal,
            "marca"        => $marca,
        ])->setPaper('a4', 'landscape');

        if (!$request->boolean('preview')) {
            if ($esOriginal) {
                ArqueoVenta::where('id', $arqueoVenta->id)
                    ->whereNull('ticket_first_printed_at')
                    ->update([
                        'ticket_first_printed_at' => now(),
                        'ticket_print_count'      => DB::raw('ticket_print_count + 1'),
                    ]);
            } else {
                ArqueoVenta::where('id', $arqueoVenta->id)
                    ->update([
                        'ticket_print_count' => DB::raw('ticket_print_count + 1'),
                    ]);
            }
        }

        return $pdf->stream("cobranza_oficial_pago_{$arqueoVenta->id}.pdf");
    }

    public function ticketCobranzasGlobalOficial($pagoGlobalId)
    {

        $pagoGlobal = PagoGlobal::with([
            'arqueoVentas.venta.cliente',
            'arqueoVentas.formapago',
            'user',
            'formapago'
        ])->findOrFail($pagoGlobalId);
        $primerArqueoVenta = $pagoGlobal->arqueoVentas->first();
        $sucursal = $primerArqueoVenta && $primerArqueoVenta->venta ? $primerArqueoVenta->venta->sucursal : null;

        if ($sucursal) {
            $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
                $file->path_url = url($file->File->path);
            });
            $sucursal->image = $sucursal->file_sucursals->first();
        }
        $esOriginal = is_null($pagoGlobal->ticket_first_printed_at);
        $marca = $esOriginal ? '' : '(COPIA)';
        $pdf = Pdf::loadView('reportes.pdf.ventas.ticket_cobranza_global_oficial', [
            "pagoGlobal" => $pagoGlobal,
            "sucursal" => $sucursal,
            "marca" => $marca
        ])->setPaper('a4', 'landscape');

        if ($esOriginal) {
            PagoGlobal::where('id', $pagoGlobal->id)
                ->whereNull('ticket_first_printed_at')
                ->update([
                    'ticket_first_printed_at' => now(),
                    'ticket_print_count'      => DB::raw('ticket_print_count + 1'),
                ]);
        } else {
            PagoGlobal::where('id', $pagoGlobal->id)
                ->update([
                    'ticket_print_count' => DB::raw('ticket_print_count + 1'),
                ]);
        }

        return $pdf->stream();
    }

    public function ventaClienteReportPDF($zona, $tipo, $chofer, $user, $forma, $fecha_1, $fecha_2)
    {
        Carbon::setLocale('es');
        //Carbon en lenguaje español

        $preventista = $user;
        $fecha_1 = $fecha_1 == 'all' ? date('Y-m-d') : $fecha_1;
        $fecha_2 = $fecha_2 == 'all' ? date('Y-m-d') : $fecha_2;
        $fecha = Carbon::parse($fecha_1);
        $fecha_1 = Carbon::parse($fecha_1);
        $fecha_2 = Carbon::parse($fecha_2);
        $fechas = [];
        while ($fecha_1->lte($fecha_2)) {
            $fechas[] = [
                "fecha" => $fecha_1->translatedFormat('Y-m-d'),
                "fecha_sort" => $fecha_1->format('d'),
                "fecha_sort_date" => strtoupper($fecha_1->translatedFormat('D'))
            ];
            $fecha_1->addDay(); // Incrementamos un día
        }
        $fecha_2 = $fecha_2->addDay();
        // return $fechas;
        $venta = Venta::with(['Cliente', 'Sucursal', 'User', 'Chofer'])->whereBetween('fecha', [$fecha, $fecha_2]);
        if ($chofer !== "all") {
            $venta = $venta->where('chofer_id', $chofer);
        }
        if ($preventista !== "all") {
            $venta = $venta->where('user_id', $preventista);
        }
        $venta = $venta->whereHas('Cliente', function ($query) use ($zona, $tipo, $forma) {
            $zona_despacho = $zona;
            $tipo_negocio = $tipo;
            $forma_pedido = $forma;
            if ($zona_despacho !== "all") {
                $query->where('zona_despacho_id', '=', $zona_despacho); // Ejemplo de filtro en la relación Cliente
            }
            if ($tipo_negocio !== "all") {
                $query->where('tipo_negocio_id', '=', $tipo_negocio); // Ejemplo de filtro en la relación Cliente
            }
            if ($forma_pedido !== "all") {
                $query->where('forma_pedido_id', '=', $forma_pedido); // Ejemplo de filtro en la relación Cliente
            }
        });
        $venta = $venta->get()->map(function ($v) {
            $v->venta_detalle_pps = $v->VentaDetallePps()->with('Item')->get()->each(function ($vd) {
                $vd->grupo_text = $vd->CintaCliente->name;
                $vd->name_text = $vd->Item->name;
            });
            $v->lote_detalle_ventas = $v->LoteDetalleVentas()->get()->each(function ($vd) {
                $vd->name_text = $vd->LoteDetalle->producto;
            });
            $v->venta_items = $v->VentaItemsPts()->get()->each(function ($vd) {
                $vd->name_text = $vd->Item->name;
            });
            $v->lista_venta_detalle_pps_text = $v->venta_detalle_pps->pluck('name_text')->implode(',');
            $v->lista_grupo_pps_text = $v->venta_detalle_pps->pluck('grupo_text')->implode(',');
            $v->lista_lote_venta_text = $v->lote_detalle_ventas->pluck('name_text')->implode(',');
            $v->lista_venta_items_text = $v->venta_items->pluck('name_text')->implode(',');

            return $v;
        })->groupBy('cliente_id');
        $ventas = [];
        foreach ($venta as $key => $value) {
            $venta_model  = $value->first();
            $lista_venta_detalle_pps_text = "";
            $lista_grupo_pps_text = "";
            $lista_lote_venta_text = "";
            $lista_venta_items_text = "";

            foreach ($value as $k => $v) {
                if ($v->lista_venta_detalle_pps_text != "") {
                    $lista_venta_detalle_pps_text .= $v->lista_venta_detalle_pps_text . ",";
                }
                if ($v->lista_grupo_pps_text != "") {
                    $lista_grupo_pps_text .= $v->lista_grupo_pps_text . ",";
                }
                if ($v->lista_lote_venta_text != "") {
                    $lista_lote_venta_text .= $v->lista_lote_venta_text . ",";
                }
                if ($v->lista_venta_items_text != "") {
                    $lista_venta_items_text .= $v->lista_venta_items_text . ",";
                }
            }
            $lista_venta_detalle_pps_text = collect(explode(',', $lista_venta_detalle_pps_text))->unique()->filter()->implode(',');
            $lista_grupo_pps_text = collect(explode(',', $lista_grupo_pps_text))->unique()->filter()->implode(',');
            $lista_lote_venta_text = collect(explode(',', $lista_lote_venta_text))->unique()->filter()->implode(',');
            $lista_venta_items_text = collect(explode(',', $lista_venta_items_text))->unique()->filter()->implode(',');
            $ventas_fecha = [];
            foreach ($fechas as $f) {
                $fecha = $f['fecha'];
                $ventas_fecha[] = [
                    "fecha" => $fecha,
                    "fecha_sort" => $f['fecha_sort'],
                    "fecha_sort_date" => $f['fecha_sort_date'],
                    "ventas" => $value->where('fecha', $fecha)->count()
                ];
            }
            $ventas[] = [
                "cliente_id" => $key,
                "cliente" => $venta_model->Cliente,
                "chofer" => $venta_model->Chofer,
                "preventista" => $venta_model->User,
                "sucursal" => $venta_model->Sucursal,
                "ventas" => $value,
                "ventas_fecha" => $ventas_fecha,
                "lista_venta_detalle_pps_text" => $lista_venta_detalle_pps_text,
                "lista_grupo_pps_text" => $lista_grupo_pps_text,
                "lista_lote_venta_text" => $lista_lote_venta_text,
                "lista_venta_items_text" => $lista_venta_items_text
            ];
        }

        $pdf = Pdf::loadView('reportes.pdf.ventas.cliente', [
            "ventas" => $ventas,
            "fechas" => $fechas
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function ventaClienteReportExcel($zona, $tipo, $chofer, $user, $forma, $fecha_1, $fecha_2)
    {
        Carbon::setLocale('es');
        //Carbon en lenguaje español

        $preventista = $user;
        $fecha_1 = $fecha_1 == 'all' ? date('Y-m-d') : $fecha_1;
        $fecha_2 = $fecha_2 == 'all' ? date('Y-m-d') : $fecha_2;
        $fecha = Carbon::parse($fecha_1);
        $fecha_1 = Carbon::parse($fecha_1);
        $fecha_2 = Carbon::parse($fecha_2);
        $fechas = [];
        while ($fecha_1->lte($fecha_2)) { // Mientras fecha_1 sea menor o igual a fecha_2
            $fechas[] = [
                "fecha" => $fecha_1->translatedFormat('Y-m-d'),
                "fecha_sort" => $fecha_1->format('d'),
                "fecha_sort_date" => strtoupper($fecha_1->translatedFormat('D'))
            ];
            $fecha_1->addDay(); // Incrementamos un día
        }
        $fecha_2 = $fecha_2->addDay();
        // return $fechas;
        $venta = Venta::with(['Cliente', 'Sucursal', 'User', 'Chofer'])->whereBetween('fecha', [$fecha, $fecha_2]);
        if ($chofer !== "all") {
            $venta = $venta->where('chofer_id', $chofer);
        }
        if ($preventista !== "all") {
            $venta = $venta->where('user_id', $preventista);
        }
        $venta = $venta->whereHas('Cliente', function ($query) use ($zona, $tipo, $forma) {
            $zona_despacho = $zona;
            $tipo_negocio = $tipo;
            $forma_pedido = $forma;
            if ($zona_despacho !== "all") {
                $query->where('zona_despacho_id', '=', $zona_despacho); // Ejemplo de filtro en la relación Cliente
            }
            if ($tipo_negocio !== "all") {
                $query->where('tipo_negocio_id', '=', $tipo_negocio); // Ejemplo de filtro en la relación Cliente
            }
            if ($forma_pedido !== "all") {
                $query->where('forma_pedido_id', '=', $forma_pedido); // Ejemplo de filtro en la relación Cliente
            }
        });
        $venta = $venta->get()->map(function ($v) {
            $v->venta_detalle_pps = $v->VentaDetallePps()->with('Item')->get()->each(function ($vd) {
                $vd->grupo_text = $vd->CintaCliente->name;
                $vd->name_text = $vd->Item->name;
            });
            $v->lote_detalle_ventas = $v->LoteDetalleVentas()->get()->each(function ($vd) {
                $vd->name_text = $vd->LoteDetalle->producto;
            });
            $v->venta_items = $v->VentaItemsPts()->get()->each(function ($vd) {
                $vd->name_text = $vd->Item->name;
            });
            $v->lista_venta_detalle_pps_text = $v->venta_detalle_pps->pluck('name_text')->implode(',');
            $v->lista_grupo_pps_text = $v->venta_detalle_pps->pluck('grupo_text')->implode(',');
            $v->lista_lote_venta_text = $v->lote_detalle_ventas->pluck('name_text')->implode(',');
            $v->lista_venta_items_text = $v->venta_items->pluck('name_text')->implode(',');

            return $v;
        })->groupBy('cliente_id');
        $ventas = [];
        foreach ($venta as $key => $value) {
            $venta_model  = $value->first();
            $lista_venta_detalle_pps_text = "";
            $lista_grupo_pps_text = "";
            $lista_lote_venta_text = "";
            $lista_venta_items_text = "";

            foreach ($value as $k => $v) {
                if ($v->lista_venta_detalle_pps_text != "") {
                    $lista_venta_detalle_pps_text .= $v->lista_venta_detalle_pps_text . ",";
                }
                if ($v->lista_grupo_pps_text != "") {
                    $lista_grupo_pps_text .= $v->lista_grupo_pps_text . ",";
                }
                if ($v->lista_lote_venta_text != "") {
                    $lista_lote_venta_text .= $v->lista_lote_venta_text . ",";
                }
                if ($v->lista_venta_items_text != "") {
                    $lista_venta_items_text .= $v->lista_venta_items_text . ",";
                }
            }
            $lista_venta_detalle_pps_text = collect(explode(',', $lista_venta_detalle_pps_text))->unique()->filter()->implode(',');
            $lista_grupo_pps_text = collect(explode(',', $lista_grupo_pps_text))->unique()->filter()->implode(',');
            $lista_lote_venta_text = collect(explode(',', $lista_lote_venta_text))->unique()->filter()->implode(',');
            $lista_venta_items_text = collect(explode(',', $lista_venta_items_text))->unique()->filter()->implode(',');
            $ventas_fecha = [];
            foreach ($fechas as $f) {
                $fecha = $f['fecha'];
                $ventas_fecha[] = [
                    "fecha" => $fecha,
                    "fecha_sort" => $f['fecha_sort'],
                    "fecha_sort_date" => $f['fecha_sort_date'],
                    "ventas" => $value->where('fecha', $fecha)->count()
                ];
            }
            $ventas[] = [
                "cliente_id" => $key,
                "cliente" => $venta_model->Cliente,
                "chofer" => $venta_model->Chofer,
                "preventista" => $venta_model->User,
                "sucursal" => $venta_model->Sucursal,
                "ventas" => $value,
                "ventas_fecha" => $ventas_fecha,
                "lista_venta_detalle_pps_text" => $lista_venta_detalle_pps_text,
                "lista_grupo_pps_text" => $lista_grupo_pps_text,
                "lista_lote_venta_text" => $lista_lote_venta_text,
                "lista_venta_items_text" => $lista_venta_items_text
            ];
        }


        $data = [
            "fechas" => $fechas,
            "ventas" => $ventas
        ];
        $ventaCLiente = new VentaClienteExport($data);
        return Excel::download($ventaCLiente, "VENTA CLIENTES.xlsx");
    }
}
