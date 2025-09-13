<?php

namespace App\Http\Controllers;

use App\Models\BitacoraLote;
use App\Models\DetallePt;
use App\Models\EnvioGenPt;
use App\Models\EnvioGenPtDetalle;
use App\Models\Lote;
use App\Models\LoteDetalle;
use App\Models\LoteDetalleMovimiento;
use App\Models\LoteDetalleProducto;
use App\Models\LoteDetalleSeguimiento;
use App\Models\LoteEnvioPppt;
use App\Models\LoteEnvioPt;
use App\Models\LoteTrozadoPt;
use App\Models\PpDetalle;
use App\Models\PpPt;
use App\Models\Pt;
use App\Models\PtDetalle;
use App\Models\PtDetalleDescomposicion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PtDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PtDetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ptDetalle = new PtDetalle();
        $ptDetalle->cantidad = $request->cantidad_envio;
        $ptDetalle->cajas = $request->cajas_envio;
        $ptDetalle->peso_bruto = $request->peso_bruto_2;
        $ptDetalle->peso_neto = $request->peso_neto_2;
        $ptDetalle->merma_bruta = $request->merma_bruta;
        $ptDetalle->merma_neta = $request->merma_neta;
        $ptDetalle->lote_id = $request->lote_id;
        $ptDetalle->lote_detalle_id = $request->lote_detalle_id;
        $ptDetalle->save();
        $ppPt = new PpPt();
        $ppPt->cantidad = $request->cantidad_envio;
        $ppPt->pp_detalle_id = $request->id;
        $ppPt->pt_detalle_id = $ptDetalle->id;
        $ppPt->fecha = Carbon::now()->format('Y-m-d');
        $ppPt->hora = Carbon::now()->format('H:i:s A');
        $ppPt->save();
        $LoteEnvioPppt = new LoteEnvioPppt();
        $LoteEnvioPppt->lote_id = $request->lote_id;
        $LoteEnvioPppt->pp_detalle_id = $request->id;
        $LoteEnvioPppt->pt_detalle_id = $ptDetalle->id;
        $LoteEnvioPppt->save();
        $ptDetalle->url_pdf = url('reportes/loteEnvioPppts/'.$LoteEnvioPppt->id);
        $ppDetalle = PpDetalle::find($request->id);
        $ppDetalle->back=0;
        $ppDetalle->save();
        return $ptDetalle;
    }
    public function storeLote(Request $request)
    {
        $loteDetalleMovimiento = new LoteDetalleMovimiento();
        $loteDetalleMovimiento->lote_detalle_id = $request->lote_detalle_id;
        $loteDetalleMovimiento->descripcion = 'Envio para PT';
        $loteDetalleMovimiento->cantidad = $request->cantidad;
        $loteDetalleMovimiento->peso_neto = $request->peso_neto;
        $loteDetalleMovimiento->peso_bruto = $request->peso_bruto;
        $loteDetalleMovimiento->cajas = $request->cajas;
        $loteDetalleMovimiento->peso = $request->peso_total;
        $loteDetalleMovimiento->tipo = 2;
        $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
        $loteDetalleMovimiento->save();

        $ptDetalle = new PtDetalle();
        $ptDetalle->cantidad = $request->cantidad;
        $ptDetalle->cajas = $request->cajas;
        $ptDetalle->peso_bruto = $request->peso_bruto;
        $ptDetalle->peso_neto = $request->peso_neto;
        $ptDetalle->merma_bruta = $request->merma_bruta;
        $ptDetalle->merma_neta = $request->merma_neta;
        $ptDetalle->lote_id = $request->lote_id;
        $ptDetalle->lote_detalle_id = $request->lote_detalle_id;
        $ptDetalle->save();
        $LoteEnvioPppt = new LoteEnvioPt();
        $LoteEnvioPppt->lote_id = $request->lote_id;
        $LoteEnvioPppt->lote_detalle_id = $request->lote_detalle_id;
        $LoteEnvioPppt->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
        $LoteEnvioPppt->pt_detalle_id = $ptDetalle->id;
        $LoteEnvioPppt->save();
        $ptDetalle->url_pdf = url('reportes/loteEnvioPts/'.$LoteEnvioPppt->id);
        $lote = Lote::find($request->lote_id);
        $bitacora_pollos = $lote->BitacoraLotes()->sum('pollos_lote');
        $bitacora_cajas = $lote->BitacoraLotes()->sum('cajas_lote');
        $bitacoraLote = new BitacoraLote();
        $bitacoraLote->name = 'Envio para PT';
        $bitacoraLote->lote_id = $request->lote_id;
        $bitacoraLote->fecha = Carbon::now()->format('Y-m-d');
        $bitacoraLote->peso_total = $request->peso_total;
        $bitacoraLote->peso_neto = $request->peso_neto;
        $bitacoraLote->peso_bruto = $request->peso_bruto;
        $bitacoraLote->cajas = $request->cajas;
        $bitacoraLote->tipo = 2;
        $bitacoraLote->pollos = $request->cantidad;
        $bitacoraLote->cajas_lote = $lote->cajas-$bitacora_cajas;
        $bitacoraLote->pollos_lote = $lote->pollos-$bitacora_pollos;
        $bitacoraLote->save();
        return $ptDetalle;
    }

    public function masa(Request $request)
    {
        $envioGenPt = new EnvioGenPt();
        $envioGenPt->fecha = Carbon::now()->format('Y-m-d');
        $envioGenPt->pt_id = $request->pt_id;
        $PT = Pt::find($request->pt_id);
        $peso_inicial_tipo = $PT->peso_inicial_tipo;
        $envioGenPt->save();
        foreach($request->detalle_envio as $d){
            $peso_bruto = $d['tipo_producto']==0?$d['peso_mod_bruto']:$d['peso_actual_bruto'];
            $peso_neto = $d['tipo_producto']==0?$d['peso_mod_neto']:$d['peso_actual_neto'];

            $loteDetalleMovimiento = new LoteDetalleMovimiento();
            $loteDetalleMovimiento->lote_detalle_id = $d['id'];
            $loteDetalleMovimiento->descripcion = 'Envio para PT';
            $loteDetalleMovimiento->cantidad = $d['equivalente'];
            $loteDetalleMovimiento->peso_neto = $peso_neto;
            $loteDetalleMovimiento->peso_bruto = $peso_bruto;
            $loteDetalleMovimiento->cajas = $d['cajas'];
            $loteDetalleMovimiento->peso = $d['peso_total'];
            $loteDetalleMovimiento->tipo = 2;
            $loteDetalleMovimiento->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalleMovimiento->save();

            $ptDetalle = new PtDetalle();
            $ptDetalle->cantidad = $d['equivalente'];
            $ptDetalle->cajas = $d['cajas'];
            $ptDetalle->peso_bruto = $peso_bruto;
            $ptDetalle->peso_neto = $peso_neto;
            $ptDetalle->merma_bruta = $d['merma_bruta'];
            $ptDetalle->merma_neta = $d['merma_neta'];
            $ptDetalle->lote_id = $d['lote_id'];
            $ptDetalle->lote_detalle_id = $d['id'];
            $ptDetalle->save();
            $LoteEnvioPppt = new LoteEnvioPt();
            $LoteEnvioPppt->lote_id = $d['lote_id'];
            $LoteEnvioPppt->lote_detalle_id = $d['id'];
            $LoteEnvioPppt->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
            $LoteEnvioPppt->pt_detalle_id = $ptDetalle->id;
            $LoteEnvioPppt->save();
            $ptDetalle->url_pdf = url('reportes/loteEnvioPts/'.$LoteEnvioPppt->id);
            $lote = Lote::find($d['lote_id']);
            $bitacora_pollos = $lote->BitacoraLotes()->sum('pollos_lote');
            $bitacora_cajas = $lote->BitacoraLotes()->sum('cajas_lote');
            $bitacoraLote = new BitacoraLote();
            $bitacoraLote->name = 'Envio para PT';
            $bitacoraLote->lote_id = $d['lote_id'];
            $bitacoraLote->fecha = Carbon::now()->format('Y-m-d');
            $bitacoraLote->peso_total = $d['peso_total'];
            $bitacoraLote->peso_neto = $d['peso_actual_neto'];
            $bitacoraLote->peso_bruto = $d['peso_actual_bruto'];
            $bitacoraLote->cajas = $d['cajas'];
            $bitacoraLote->tipo = 2;
            $bitacoraLote->pollos = $d['equivalente'];
            $bitacoraLote->cajas_lote = $lote->cajas-$bitacora_cajas;
            $bitacoraLote->pollos_lote = $lote->pollos-$bitacora_pollos;
            $bitacoraLote->save();
         // SEGUIMIENTO
         $loteDetalle = LoteDetalle::find($d['id']);
         $seguimiento = $loteDetalle->LoteDetalleSeguimientos();
         $kgs_s = $seguimiento->sum('kgs_s');
         $unit_s = $seguimiento->sum('unit_s');
         $cont_s = $seguimiento->sum('cont_s');
         $loteDetalleSeguimiento = new LoteDetalleSeguimiento();
         $loteDetalleSeguimiento->lote_detalle_id = $d['id'];
         $loteDetalleSeguimiento->nro = 'Envio para PT';
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

         $loteDetalleProducto->tipo = "ENV";
         $loteDetalleProducto->nro = "S";
         $loteDetalleProducto->id_nro = "$PT->id";
         $loteDetalleProducto->detalle = "ENVIO A PT ".$PT->nro;
         $loteDetalleProducto->fecha = Carbon::now()->format('Y-m-d');
         $loteDetalleProducto->hora = Carbon::now()->format('H:i:s');
         $loteDetalleProducto->user_id = 1;
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
         $DetallePt = new DetallePt();
         $DetallePt->lote_detalle_movimiento_id = $loteDetalleMovimiento->id;
         $DetallePt->pollos = $d['equivalente'];
         $DetallePt->cajas = $d['cajas'];
         $DetallePt->fecha = Carbon::now()->format('Y-m-d');
         $DetallePt->peso_total = $d['peso_actual_bruto'];
         $DetallePt->peso_neto = $d['peso_mod_neto'];
         $DetallePt->peso_bruto = $d['peso_mod_bruto'];
         $DetallePt->merma_bruta = $d['merma_bruta'];
         $DetallePt->merma_neta = $d['merma_neta'];
         $DetallePt->lote_id = $d['lote_id'];
         $DetallePt->lote_detalle_id = $d['id'];
         $DetallePt->pt_id = $request->pt_id;
         $DetallePt->peso_inicial_tipo = $peso_inicial_tipo;
         $DetallePt->user_id= $request->user_id;
         $DetallePt->save();
         $envioGenPtDetalle = new EnvioGenPtDetalle();
         $envioGenPtDetalle->envio_gen_pt_id = $envioGenPt->id;
         $envioGenPtDetalle->detalle_pt_id = $DetallePt->id;
         $envioGenPtDetalle->save();
        }
        foreach($request->lotes as $d){
            $lote = Lote::find($d['id']);
            $lote->fin = 1;
            $lote->save();
            $compra = $lote->compra;
            $compra->fin = 1;
            $compra->save();
        }
        $PT->peso_inicial_tipo = 2;
        $PT->save();
        $envioGenPt->url_pdf = url('reportes/envioGenPts/'.$envioGenPt->id);
        return $envioGenPt;
    }
    public function regresarDetalleItem(DetallePt $detallePt,Request $request)
    {
        // $ptDetalle->estado = 0;
        // $ptDetalle->save();
        // $LoteEnvioPt = $ptDetalle->LoteEnvioPt;
        // if($LoteEnvioPt!=null){
        //     $LoteEnvioPt->estado = 0;
        //     $LoteEnvioPt->save();
        //     $LoteEnvioPt->loteDetalleMovimiento = $LoteEnvioPt->LoteDetalleMovimiento;
        //     $LoteEnvioPt->loteDetalleMovimiento->estado = 0;
        //     $LoteEnvioPt->loteDetalleMovimiento->save();

        // }else{
        //     $ptDetalle->ppPt = $ptDetalle->PpPt;
        //     $ptDetalle->ppPt->estado = 0;
        //     $ptDetalle->ppPt->save();
        // }
        $detallePt->estado = 0;
        $detallePt->save();
        $detallePt->LoteDetalleMovimiento->estado=0;
        $detallePt->LoteDetalleMovimiento->save();
        return $detallePt;
    }
    public function regresar(PtDetalle $ptDetalle,Request $request)
    {
        $ptDetalle->estado = 0;
        $ptDetalle->save();
        $LoteEnvioPt = $ptDetalle->LoteEnvioPt;
        if($LoteEnvioPt!=null){
            $LoteEnvioPt->estado = 0;
            $LoteEnvioPt->save();
            $LoteEnvioPt->loteDetalleMovimiento = $LoteEnvioPt->LoteDetalleMovimiento;
            $LoteEnvioPt->loteDetalleMovimiento->estado = 0;
            $LoteEnvioPt->loteDetalleMovimiento->save();

        }else{
            $ptDetalle->ppPt = $ptDetalle->PpPt;
            $ptDetalle->ppPt->estado = 0;
            $ptDetalle->ppPt->save();
        }
        return $ptDetalle;
    }
    public function descomponer(PtDetalle $ptDetalle,Request $request)
    {
        $ptDetalle->descomponer = 0;
        $ptDetalle->back = 0;
        $ptDetalle->save();
        foreach ($request->compo_externas as $compo) {
            $ppdetalleDescomposicion = new PtDetalleDescomposicion();
            $ppdetalleDescomposicion->cantidad = $ptDetalle->cantidad;
            $ppdetalleDescomposicion->precio_venta =0;
            $ppdetalleDescomposicion->peso_total = 0;
            $ppdetalleDescomposicion->pt_detalle_id = $ptDetalle->id;
            $ppdetalleDescomposicion->compo_externa_id = $compo['id'];
            $ppdetalleDescomposicion->lote_id = $ptDetalle->lote_id;;
            $ppdetalleDescomposicion->save();
        }
        $loteTrozadoPt = new LoteTrozadoPt();
        $loteTrozadoPt->lote_id = $ptDetalle->lote_id;
        $loteTrozadoPt->pt_detalle_id = $ptDetalle->id;
        $loteTrozadoPt->save();
        $ptDetalle->url_pdf = url('reportes/loteTrozadoPts/'.$loteTrozadoPt->id);
        return $ptDetalle;
    }
    public function fromPP(Request $request)
    {
        $ptDetalle = new PtDetalle();
        $ptDetalle->cantidad = $request->cantidad_envio;
        $ptDetalle->peso_bruto = $request->peso_bruto;
        $ptDetalle->peso_neto = $request->peso_neto;
        $ptDetalle->lote_id = $request->lote_id;
        $ptDetalle->lote_detalle_id = $request->lote_detalle_id;
        $ptDetalle->save();
        return $ptDetalle;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtDetalle  $ptDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PtDetalle $ptDetalle)
    {

        return $ptDetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PtDetalle  $ptDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PtDetalle $ptDetalle)
    {
        $ptDetalle->name = $request->name;
        $ptDetalle->save();
        return $ptDetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtDetalle  $ptDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtDetalle $ptDetalle)
    {
        $ptDetalle->estado = 0;
        $ptDetalle->save();
    }
}
