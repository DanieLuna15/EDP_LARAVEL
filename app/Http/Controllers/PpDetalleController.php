<?php

namespace App\Http\Controllers;

use App\Models\BitacoraLote;
use App\Models\DetallePp;
use App\Models\EnvioGenPp;
use App\Models\EnvioGenPpDetalle;
use App\Models\Lote;
use App\Models\LoteDetalle;
use App\Models\LoteDetalleMovimiento;
use App\Models\LoteDetalleProducto;
use App\Models\LoteDetalleSeguimiento;
use App\Models\LoteEnvioPp;
use App\Models\LoteTrozadoPp;
use App\Models\Pp;
use App\Models\PpDetalle;
use App\Models\PpDetalleDescomposicion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PpDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loteDetalleMovimiento = new LoteDetalleMovimiento();
        $loteDetalleMovimiento->lote_detalle_id = $request->lote_detalle_id;
        $loteDetalleMovimiento->descripcion = 'Envio para PP';
        $loteDetalleMovimiento->cantidad = $request->cantidad;
        $loteDetalleMovimiento->peso_neto = $request->peso_neto;
        $loteDetalleMovimiento->peso_bruto = $request->peso_bruto;
        $loteDetalleMovimiento->cajas = $request->cajas;
        $loteDetalleMovimiento->peso = $request->peso_total;
        $loteDetalleMovimiento->tipo = 1;
        $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
        $loteDetalleMovimiento->save();
        // SEGUIMIENTO
        $loteDetalle = LoteDetalle::find($request->lote_detalle_id);
        $seguimiento = $loteDetalle->LoteDetalleSeguimientos();
        $kgs_s = $seguimiento->sum('kgs_s');
        $unit_s = $seguimiento->sum('unit_s');
        $cont_s = $seguimiento->sum('cont_s');
        $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
        $loteDetalleSeguimiento->lote_detalle_id = $request->lote_detalle_id;
        $loteDetalleSeguimiento->nro = 'Envio para PP';
        $loteDetalleSeguimiento->cliente = 'Envio para PP';
        $loteDetalleSeguimiento->fecha = Carbon::now()->format('Y-m-d');
        $loteDetalleSeguimiento->cont_s = $request->cajas;
        $loteDetalleSeguimiento->cont_sa = $loteDetalle->cajas-($request->cajas+$cont_s);
        $loteDetalleSeguimiento->unit_s = $request->cantidad;
        $loteDetalleSeguimiento->unit_sa =  $loteDetalle->equivalente-($request->cantidad+$unit_s);
        $loteDetalleSeguimiento->kgs_s = $request->peso_neto;
        $loteDetalleSeguimiento->kgs_sa = ($loteDetalle->peso_total-($loteDetalle->cajas*2)) - ($kgs_s+$request->peso_neto);
        $loteDetalleSeguimiento->save();
        // FIN SEGUIMIENTO
        $ppDetalle = new PpDetalle();
        $ppDetalle->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
        $ppDetalle->cantidad = $request->cantidad;
        $ppDetalle->precio_venta = $request->precio_venta;
        $ppDetalle->fecha = Carbon::now()->format('Y-m-d');
        $ppDetalle->peso_total = $request->peso_total;
        $ppDetalle->peso_neto = $request->peso_neto;
        $ppDetalle->peso_bruto = $request->peso_bruto;
        $ppDetalle->merma_bruta = $request->merma_bruta;
        $ppDetalle->merma_neta = $request->merma_neta;
        $ppDetalle->cajas = $request->cajas;
        $ppDetalle->lote_id = $request->lote_id;
        $ppDetalle->lote_detalle_id = $request->lote_detalle_id;
        $ppDetalle->save();
        $loteEnvioPP = new LoteEnvioPp();
        $loteEnvioPP->lote_id = $request->lote_id;
        $loteEnvioPP->lote_detalle_id = $request->lote_detalle_id;
        $loteEnvioPP->pp_detalle_id = $ppDetalle->id;
        $loteEnvioPP->save();
        $ppDetalle->url_pdf = url('reportes/loteEnvioPps/'.$loteEnvioPP->id);
        $lote = Lote::find($request->lote_id);
        $bitacora_pollos = $lote->BitacoraLotes()->sum('pollos_lote');
        $bitacora_cajas = $lote->BitacoraLotes()->sum('cajas_lote');
        $bitacoraLote = new BitacoraLote();
        $bitacoraLote->name = 'Envio para PP';
        $bitacoraLote->lote_id = $request->lote_id;
        $bitacoraLote->fecha = Carbon::now()->format('Y-m-d');
        $bitacoraLote->peso_total = $request->peso_total;
        $bitacoraLote->peso_neto = $request->peso_neto;
        $bitacoraLote->peso_bruto = $request->peso_bruto;
        $bitacoraLote->cajas = $request->cajas;
        $bitacoraLote->tipo = 1;
        $bitacoraLote->pollos = $request->cantidad;
        $bitacoraLote->cajas_lote = $lote->cajas-$bitacora_cajas;
        $bitacoraLote->pollos_lote = $lote->pollos-$bitacora_pollos;
        $bitacoraLote->save();
        $DetallePp = new DetallePp();
        $DetallePp->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
        $DetallePp->pollos = $request->pollos;
        $DetallePp->cajas = $request->cajas;
        $DetallePp->fecha = Carbon::now()->format('Y-m-d');
        $DetallePp->peso_total = $request->peso_total;
        $DetallePp->peso_neto = $request->peso_neto;
        $DetallePp->peso_bruto = $request->peso_bruto;
        $DetallePp->merma_bruta = $request->merma_bruta;
        $DetallePp->merma_neta = $request->merma_neta;
        $DetallePp->lote_id = $request->lote_id;
        $DetallePp->lote_detalle_id = $request->lote_detalle_id;
        $DetallePp->pp_id = $request->pp_id;

        $DetallePp->save();

        return $ppDetalle;
    }
    public function descomponer(PpDetalle $ppDetalle,Request $request)
    {
        $ppDetalle->descomponer = 0;
        $ppDetalle->back = 0;
        $ppDetalle->save();
        foreach ($request->compo_internas as $compo) {
            $ppdetalleDescomposicion = new PpDetalleDescomposicion();
            $ppdetalleDescomposicion->cantidad = $ppDetalle->cantidad;
            $ppdetalleDescomposicion->precio_venta =0;
            $ppdetalleDescomposicion->peso_total = 0;
            $ppdetalleDescomposicion->pp_detalle_id = $ppDetalle->id;
            $ppdetalleDescomposicion->lote_id = $ppDetalle->lote_id;
            $ppdetalleDescomposicion->compo_interna_id = $compo['id'];
            $ppdetalleDescomposicion->save();
        }
        $loteTrozadoPp = new LoteTrozadoPp();
        $loteTrozadoPp->lote_id = $ppDetalle->lote_id;
        $loteTrozadoPp->pp_detalle_id = $ppDetalle->id;
        $loteTrozadoPp->save();
        $ppDetalle->url_pdf = url('reportes/loteTrozadoPps/'.$loteTrozadoPp->id);
        return $ppDetalle;
    }
    public function regresarDetalleItem(DetallePp $detallePp,Request $request)
    {
        $detallePp->estado = 0;
        $detallePp->save();
        $detallePp->LoteDetalleMovimiento->estado=0;
        $detallePp->LoteDetalleMovimiento->save();
        return $detallePp;
    }
    public function regresar(PpDetalle $ppDetalle,Request $request)
    {
        $ppDetalle->estado = 0;
        $ppDetalle->save();
        $ppDetalle->LoteDetalleMovimiento->estado=0;
        $ppDetalle->LoteDetalleMovimiento->save();
        return $ppDetalle;
    }
    public function regresarDetalle(DetallePp $detallePp,Request $request)
    {
        $detallePp->estado = 0;
        $detallePp->save();
        $detallePp->LoteDetalleMovimiento->estado=0;
        $detallePp->LoteDetalleMovimiento->save();
        return $detallePp;
    }
    public function masa(Request $request)
    {
        $envioGenPp = new EnvioGenPp();
        $envioGenPp->fecha = Carbon::now()->format('Y-m-d');
        $envioGenPp->pp_id = $request->pp_id;
        $PP = Pp::find($request->pp_id);
        $peso_inicial_tipo = $PP->peso_inicial_tipo;
        $envioGenPp->save();
        foreach($request->detalle_envio as $d){
            $loteDetalleMovimiento = new LoteDetalleMovimiento();
            $loteDetalleMovimiento->lote_detalle_id = $d['id'];
            $loteDetalleMovimiento->descripcion = 'Envio para PP';
            $loteDetalleMovimiento->cantidad = $d['equivalente'];
            $loteDetalleMovimiento->peso_neto = $d['peso_mod_neto'];
            $loteDetalleMovimiento->peso_bruto = $d['peso_mod_bruto'];
            $loteDetalleMovimiento->cajas = $d['cajas'];
            $loteDetalleMovimiento->peso = $d['peso_actual_bruto'];
            $loteDetalleMovimiento->tipo = 1;
            $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleMovimiento->save();
            // SEGUIMIENTO
            $loteDetalle = LoteDetalle::find($d['id']);
            $seguimiento = $loteDetalle->LoteDetalleSeguimientos();
            $kgs_s = $seguimiento->sum('kgs_s');
            $unit_s = $seguimiento->sum('unit_s');
            $cont_s = $seguimiento->sum('cont_s');
            $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
            $loteDetalleSeguimiento->lote_detalle_id = $d['id'];
            $loteDetalleSeguimiento->nro = 'Envio para PP';
            $loteDetalleSeguimiento->cliente = 'PRODUCCION';
            $loteDetalleSeguimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleSeguimiento->cont_s = $d['cajas'];
            $loteDetalleSeguimiento->cont_sa = $loteDetalle->cajas-($d['cajas']+$cont_s);
            $loteDetalleSeguimiento->unit_s = $d['equivalente'];
            $loteDetalleSeguimiento->unit_sa =  $loteDetalle->equivalente-($d['equivalente']+$unit_s);
            $loteDetalleSeguimiento->kgs_s = $d['peso_mod_neto'];
            $loteDetalleSeguimiento->kgs_sa = ($loteDetalle->peso_total-($loteDetalle->cajas*2)) - ($kgs_s+$d['peso_mod_neto']);
            $loteDetalleSeguimiento->save();
            $loteDetalleProducto = new LoteDetalleProducto();
            $loteDetalleProducto->lote_detalle_id = $d['id'];
            $loteDetalleProducto->lote_id = $d['lote_id'];
            $loteDetalleProducto->producto = $d['producto'];
            $loteDetalleProducto->pigmento = $d['pigmento'];
            $loteDetalleProducto->id_nro = "$PP->id";
            $loteDetalleProducto->tipo = "ENV";
            $loteDetalleProducto->nro = "S";
            $loteDetalleProducto->detalle = "ENVIO A PP " .$PP->nro;
            $loteDetalleProducto->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleProducto->hora = Carbon::now()->format('H:i:s');
            $loteDetalleProducto->user_id =  $request->user_id;

            $loteDetalleProducto->tipo_mov = 2;
            $loteDetalleProducto->peso_bruto = $d['peso_mod_bruto'];
            $loteDetalleProducto->peso_neto = $d['peso_mod_neto'];
            $loteDetalleProducto->tara = $d['peso_mod_bruto']-$d['peso_mod_neto'];
            $loteDetalleProducto->cajas_e = $loteDetalle->cajas-$cont_s;
            $loteDetalleProducto->cajas_s = $d['cajas'];
            $loteDetalleProducto->cajas_sa = $loteDetalle->cajas-($d['cajas']+$cont_s);
            $loteDetalleProducto->und_s = $d['equivalente'];
            $loteDetalleProducto->und_sa =  $loteDetalle->equivalente-($d['equivalente']+$unit_s);
            $loteDetalleProducto->kg_s = $d['peso_mod_neto'];
            $loteDetalleProducto->kg_sa = ($loteDetalle->peso_total-($loteDetalle->cajas*2)) - ($kgs_s+$d['peso_mod_neto']);
            $loteDetalleProducto->save();
            // FIN SEGUIMIENTO
            $ppDetalle = new PpDetalle();
            $ppDetalle->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
            $ppDetalle->cantidad = $d['equivalente'];
            $ppDetalle->precio_venta = 0;
            $ppDetalle->fecha = Carbon::now()->format('Y-m-d');
            $ppDetalle->peso_total = $d['peso_actual_bruto'];
            $ppDetalle->peso_neto = $d['peso_mod_neto'];
            $ppDetalle->peso_bruto = $d['peso_mod_bruto'];
            $ppDetalle->merma_bruta = $d['merma_bruta'];
            $ppDetalle->merma_neta = $d['merma_neta'];
            $ppDetalle->cajas = $d['cajas'];
            $ppDetalle->lote_id = $d['lote_id'];
            $ppDetalle->lote_detalle_id = $d['id'];
            $ppDetalle->peso_inicial_tipo = $PP->peso_inicial_tipo;
            $ppDetalle->save();
            $loteEnvioPP = new LoteEnvioPp();
            $loteEnvioPP->lote_id = $d['lote_id'];
            $loteEnvioPP->lote_detalle_id = $d['id'];
            $loteEnvioPP->pp_detalle_id = $ppDetalle->id;
            $loteEnvioPP->save();
            $ppDetalle->url_pdf = url('reportes/loteEnvioPps/'.$loteEnvioPP->id);
            $lote = Lote::find($d['lote_id']);
            $bitacora_pollos = $lote->BitacoraLotes()->sum('pollos_lote');
            $bitacora_cajas = $lote->BitacoraLotes()->sum('cajas_lote');
            $bitacoraLote = new BitacoraLote();
            $bitacoraLote->name = 'Envio para PP';
            $bitacoraLote->lote_id = $d['lote_id'];
            $bitacoraLote->fecha = Carbon::now()->format('Y-m-d');
            $bitacoraLote->peso_total = $d['peso_actual_bruto'];
            $bitacoraLote->peso_neto = $d['peso_mod_neto'];
            $bitacoraLote->peso_bruto = $d['peso_mod_bruto'];
            $bitacoraLote->cajas = $d['cajas'];
            $bitacoraLote->tipo = 1;
            $bitacoraLote->pollos = $d['equivalente'];
            $bitacoraLote->cajas_lote = $lote->cajas-$bitacora_cajas;
            $bitacoraLote->pollos_lote = $lote->pollos-$bitacora_pollos;
            $bitacoraLote->save();
            $DetallePp = new DetallePp();
            $DetallePp->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
            $DetallePp->pollos = $d['equivalente'];
            $DetallePp->cajas = $d['cajas'];
            $DetallePp->fecha = Carbon::now()->format('Y-m-d');
            $DetallePp->hora = Carbon::now()->format('H:i:s');
            $DetallePp->peso_total = $d['peso_actual_bruto'];
            $DetallePp->peso_neto = $d['peso_mod_neto'];
            $DetallePp->peso_bruto = $d['peso_mod_bruto'];
            $DetallePp->merma_bruta = $d['merma_bruta'];
            $DetallePp->merma_neta = $d['merma_neta'];
            $DetallePp->lote_id = $d['lote_id'];
            $DetallePp->lote_detalle_id = $d['id'];
            $DetallePp->pp_id = $request->pp_id;
            $DetallePp->peso_inicial_tipo = $peso_inicial_tipo;
            $DetallePp->user_id= $request->user_id;
            $DetallePp->save();
            $envioGenPpDetalle = new EnvioGenPpDetalle();
            $envioGenPpDetalle->envio_gen_pp_id = $envioGenPp->id;
            $envioGenPpDetalle->detalle_pp_id = $DetallePp->id;
            $envioGenPpDetalle->save();

        }
        foreach($request->lotes as $d){
            $lote = Lote::find($d['id']);
            $lote->fin = 1;
            $lote->save();
            $compra = $lote->compra;
            $compra->fin = 1;
            $compra->save();
        }
        $PP->peso_inicial_tipo = 2;
        $PP->save();
        $envioGenPp->url_pdf = url('reportes/envioGenPps/'.$envioGenPp->id);
        return $envioGenPp;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpDetalle  $ppDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PpDetalle $ppDetalle)
    {

        return $ppDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpDetalle  $ppDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpDetalle $ppDetalle)
    {
        $ppDetalle->name = $request->name;
        $ppDetalle->save();
        $ppDetalle->LoteDetalleMovimiento->estado=0;
        $ppDetalle->LoteDetalleMovimiento->save();
        return $ppDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpDetalle  $ppDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpDetalle $ppDetalle)
    {
        $ppDetalle->estado = 0;
        $ppDetalle->save();
    }
}
