<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\PpTraspasoPp;
use App\Models\PtTraspasoPp;
use App\Models\DespleguePp;
use App\Models\TraspasoPp;
use App\Models\TraspasoPpDetalle;
use App\Models\TraspasoPpEnvio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TraspasoPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TraspasoPp::where('estado',1)->get();
    }
    public function disponible()
    {
        return TraspasoPp::with(['Pp','CintaCliente'])->where([['estado',1],['aceptado',0]])->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = TraspasoPp::with('Pp')->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/traspasoPps/'.$m->id);

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

        if($request->tipo != 3){
            foreach($request->detalles_envio as $de){
                $traspasoPp = new TraspasoPp();
                $traspasoPp->name = "Traspaso de PP";
                $traspasoPp->tipo = $request->tipo;
                $traspasoPp->cinta_cliente_id = $de['cinta_cliente'];
                $traspasoPp->pigmento = $request->cinta_pigmento;
                $traspasoPp->fecha = Carbon::now()->format('Y-m-d');
                $traspasoPp->cajas = $de['cajas'];
                $traspasoPp->pollos = $de['pollos'];
                $traspasoPp->peso_bruto = $de['peso_bruto'];
                $traspasoPp->peso_neto = $de['peso_neto'];
                $traspasoPp->merma_bruta = $de['peso_bruto_m'] - $de['peso_bruto'];
                $traspasoPp->merma_neta = $de['peso_neto_m'] - $de['peso_neto'];
                $traspasoPp->pp_id = $request->pp_id;
                $traspasoPp->save();
                foreach($request->detalles as $d){
                    $traspasoPpDetalle = new TraspasoPpDetalle();
                    $traspasoPpDetalle->traspaso_pp_id = $traspasoPp->id;
                    $traspasoPpDetalle->pigmento = $request->cinta_pigmento;
                    $traspasoPpDetalle->lote_detalle_id = $d['lote_detalle_id'];
                    $traspasoPpDetalle->cajas = $d['cajas'];
                    $traspasoPpDetalle->pollos = $d['pollos'];
                    $traspasoPpDetalle->peso_bruto = $d['peso_bruto'];
                    $traspasoPpDetalle->peso_neto = $d['peso_neto'];
                    $traspasoPpDetalle->merma_bruta = $d['merma_bruta'];
                    $traspasoPpDetalle->merma_neta = $d['merma_neta'];
                    $traspasoPpDetalle->save();
                }
                foreach($request->trapasos as $d){
                    $traspasoPpEnvio = new TraspasoPpEnvio();
                    $traspasoPpEnvio->traspaso_pp_id = $traspasoPp->id;
                    $traspasoPpEnvio->pigmento = $request->cinta_pigmento;
                    $traspasoPpEnvio->cajas = $d['cajas'];
                    $traspasoPpEnvio->pollos = $d['pollos'];
                    $traspasoPpEnvio->peso_bruto = $d['peso_bruto'];
                    $traspasoPpEnvio->peso_neto = $d['peso_neto'];
                    $traspasoPpEnvio->merma_bruta = $d['merma_bruta'];
                    $traspasoPpEnvio->merma_neta = $d['merma_neta'];
                    $traspasoPpEnvio->tipo = $d['tipo'];
                    $traspasoPpEnvio->aceptado = $d['aceptado'];
                    $traspasoPpEnvio->save();
                }
                $traspasoPp->url_pdf = url('reportes/traspasoPps/'.$traspasoPp->id);
            }

            return True;
        }
        foreach($request->detalles_envio as $d){
            $DespleguePp = new DespleguePp();
            $DespleguePp->name = "Despliegue de PP";
            $DespleguePp->tipo = $request->tipo;
            $DespleguePp->pigmento = $d['cinta_pigmento'];
            $DespleguePp->cinta_cliente_id = $d['cinta_cliente'];
            $DespleguePp->fecha = Carbon::now()->format('Y-m-d');
            $DespleguePp->cajas = $d['cajas'];
            $DespleguePp->pollos = $d['pollos'];
            $DespleguePp->peso_bruto = $d['peso_bruto'];
            $DespleguePp->peso_neto = $d['peso_neto'];
            $DespleguePp->merma_bruta = $d['peso_bruto_m'] - $d['peso_bruto'];
            $DespleguePp->merma_neta = $d['peso_neto_m'] - $d['peso_neto'];
            $DespleguePp->pp_id = $request->pp_id;
            $DespleguePp->save();
        }
        return True;
    }

    public function storeDespliegue(Request $request)
    {
        if ($request->tipo != 3) {
            Log::info('Procesando traspaso de PP...');
            foreach ($request->detalles_envio as $de) {
                Log::info('Procesando detalle de traspaso de PP: ', $de);
                $traspasoPp = new TraspasoPp();
                $traspasoPp->name = "Traspaso de PP";
                $traspasoPp->tipo = $request->tipo;
                $traspasoPp->cinta_cliente_id = $de['cinta_cliente'];
                $traspasoPp->pigmento = $request->cinta_pigmento;
                $traspasoPp->fecha = Carbon::now()->format('Y-m-d');
                $traspasoPp->cajas = $de['cajas'];
                $traspasoPp->pollos = $de['pollos'];
                $traspasoPp->peso_bruto = $de['peso_bruto'];
                $traspasoPp->peso_neto = $de['peso_neto'];
                $traspasoPp->merma_bruta = $de['peso_bruto_m'] - $de['peso_bruto'];
                $traspasoPp->merma_neta = $de['peso_neto_m'] - $de['peso_neto'];
                $traspasoPp->pp_id = $request->pp_id;
                $traspasoPp->cinta_cliente_id_emisor =  $de['cinta_cliente'];
                $traspasoPp->save();
                Log::info('Traspaso de PP guardado con éxito, ID: ' . $traspasoPp->id);
                foreach ($request->detalles as $d) {
                    Log::info('Guardando detalle de traspaso PP: ', $d);

                    $traspasoPpDetalle = new TraspasoPpDetalle();
                    $traspasoPpDetalle->traspaso_pp_id = $traspasoPp->id;
                    $traspasoPpDetalle->pigmento = $request->cinta_pigmento;
                    $traspasoPpDetalle->lote_detalle_id = $d['lote_detalle_id'];
                    $traspasoPpDetalle->cajas = $d['cajas'];
                    $traspasoPpDetalle->pollos = $d['pollos'];
                    $traspasoPpDetalle->peso_bruto = $d['peso_bruto'];
                    $traspasoPpDetalle->peso_neto = $d['peso_neto'];
                    $traspasoPpDetalle->merma_bruta = $d['merma_bruta'];
                    $traspasoPpDetalle->merma_neta = $d['merma_neta'];
                    $traspasoPpDetalle->save();

                    Log::info('Detalle de traspaso guardado con éxito, ID: ' . $traspasoPpDetalle->id);
                }
                foreach ($request->trapasos as $d) {
                    Log::info('Guardando traspaso de envío: ', $d);

                    $traspasoPpEnvio = new TraspasoPpEnvio();
                    $traspasoPpEnvio->traspaso_pp_id = $traspasoPp->id;
                    $traspasoPpEnvio->pigmento = $request->cinta_pigmento;
                    $traspasoPpEnvio->cajas = $d['cajas'];
                    $traspasoPpEnvio->pollos = $d['pollos'];
                    $traspasoPpEnvio->peso_bruto = $d['peso_bruto'];
                    $traspasoPpEnvio->peso_neto = $d['peso_neto'];
                    $traspasoPpEnvio->merma_bruta = $d['merma_bruta'];
                    $traspasoPpEnvio->merma_neta = $d['merma_neta'];
                    $traspasoPpEnvio->tipo = $d['tipo'];
                    $traspasoPpEnvio->aceptado = $d['aceptado'];
                    $traspasoPpEnvio->save();

                    Log::info('Traspaso de envío guardado con éxito, ID: ' . $traspasoPpEnvio->id);
                }
                $traspasoPp->url_pdf = url('reportes/traspasoPps/' . $traspasoPp->id);
                Log::info('URL del reporte del traspaso: ' . $traspasoPp->url_pdf);
            }
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoPp  $traspasoPp
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoPp $traspasoPp)
    {

        return $traspasoPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoPp  $traspasoPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoPp $traspasoPp)
    {
        $traspasoPp->name = $request->name;
        $traspasoPp->save();
        return $traspasoPp;
    }
    public function aceptar(Request $request, TraspasoPp $traspasoPp)
    {
        $traspasoPp->aceptado = 1;
        $traspasoPp->save();
        $ppTraspaso = new PpTraspasoPp();
        $ppTraspaso->pp_id = $request->pp_nuevo_id;
        $ppTraspaso->traspaso_pp_id = $traspasoPp->id;
        $ppTraspaso->cinta_cliente_id = $traspasoPp->cinta_cliente_id;
        $ppTraspaso->fecha_hora = Carbon::now();
        $ppTraspaso->user_id = $request->user_id;
        $ppTraspaso->save();
        return $traspasoPp;
    }
    public function aceptarPt(Request $request, TraspasoPp $traspasoPp)
    {
        $traspasoPp->aceptado = 1;
        $traspasoPp->save();
        $ptTraspaso = new PtTraspasoPp();
        $ptTraspaso->pt_id = $request->pt_nuevo_id;
        $ptTraspaso->traspaso_pp_id = $traspasoPp->id;
        $ptTraspaso->user_id = Auth::user()->id;
        $ptTraspaso->save();
        return $traspasoPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoPp  $traspasoPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoPp $traspasoPp)
    {
        $traspasoPp->estado = 0;
        $traspasoPp->save();
    }
    public function pdf(TraspasoPp $traspasoPp)
    {
        $sucursal = $traspasoPp->Pp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();

       $pdf = Pdf::loadView('reportes.pdf.lote.traspasoPp',[
        'traspasoPp'=>$traspasoPp,
        'sucursal'=>$sucursal,
        ])->setPaper('a4', 'landscape');
    return $pdf->stream();
    }
}
