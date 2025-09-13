<?php

namespace App\Http\Controllers;

use App\Models\KardexDotacion;
use App\Models\Salidadotacioncontrato;
use App\Models\Salidotacontradeta;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class SalidadotacioncontratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Salidadotacioncontrato::with(['Contrato','Sucursal','User'])->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/salidadotacioncontratos/$s->id");
                $list[]=$s;
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
        $salidadotacioncontrato = new Salidadotacioncontrato();
        $salidadotacioncontrato->sucursal_id = $request->sucursal_id;
        $salidadotacioncontrato->user_id = $request->user_id;
        $salidadotacioncontrato->contrato_id = $request->contrato_id;
        $salidadotacioncontrato->fecha = date('Y-m-d');
        $salidadotacioncontrato->save();
        $stockdotacion = new Stockdotacion();
        $stockdotacion->sucursal_id = $request->sucursal_id;
        $stockdotacion->user_id = $request->user_id;
        $stockdotacion->motivo = "SALIDA DE DOTACION POR PERSONAL";

        $stockdotacion->fecha = date('Y-m-d');
        $stockdotacion->save();
        foreach ($request->dotaciones as $c) {
            $stock_detail = Stockdotaciondetail::where('dotacion_id', intval($c['dotacion']['id']))->where('sucursal_id', $request->sucursal_id)->get();
            $stock = $stock_detail->sum('cantidad');
            $kardex = new KardexDotacion();
            $kardex->dotacion_id = $c['dotacion']['id'];
            $kardex->sucursal_id = $request->sucursal_id;
            $kardex->entradas = 0;
            $kardex->salidas = intval($c['cantidad']);
            $kardex->stock = $stock-intval($c['cantidad']);
            $kardex->user_id = $request->user_id;
            $kardex->fecha = date('Y-m-d');
            $kardex->fechatime = date('Y-m-d H:i:s');
            $kardex->tipo = "DOTACION";
            $kardex->movimiento = 2;
            $kardex->motivo = "SALIDA DE DOTACION POR PERSONAL";
            $kardex->costo = intval($c['dotacion']['costo']);
            $kardex->venta = intval($c['dotacion']['venta']);
            $kardex->save();
            $Stockdotaciondetail = new Stockdotaciondetail();
            $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;

            $Stockdotaciondetail->dotacion_id = intval($c['dotacion_id']);

            $Stockdotaciondetail->costo = intval($c['dotacion']['costo']);
            $Stockdotaciondetail->cantidad = 0-intval($c['cantidad']);
            $Stockdotaciondetail->venta = intval($c['dotacion']['venta']);
            $Stockdotaciondetail->save();

            $Salidotacontradeta = new Salidotacontradeta();
            $Salidotacontradeta->stockdotaciondetail_id = $Stockdotaciondetail->id;
            $Salidotacontradeta->salidadotacioncontrato_id = $salidadotacioncontrato->id;
            $Salidotacontradeta->contrato_id = $request->contrato_id;
            $Salidotacontradeta->cantidad = intval($c['cantidad']);
            $Salidotacontradeta->fecha = date('Y-m-d');
            $Salidotacontradeta->motivo = "DOTACION";
            $Salidotacontradeta->save();
        }
        return $salidadotacioncontrato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salidadotacioncontrato  $salidadotacioncontrato
     * @return \Illuminate\Http\Response
     */
    public function show(Salidadotacioncontrato $salidadotacioncontrato)
    {

            $salidadotacioncontrato->detalle = $salidadotacioncontrato->Salidotacontradetas()->get();
            $salidadotacioncontrato->salidotacontradetas = $salidadotacioncontrato->Salidotacontradetas()->get();
            $salidadotacioncontrato->contrato = $salidadotacioncontrato->Contrato;
            $salidadotacioncontrato->sucursal = $salidadotacioncontrato->Sucursal;
            $salidadotacioncontrato->sucursal->file_sucursals = $salidadotacioncontrato->sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $salidadotacioncontrato->sucursal->image = $salidadotacioncontrato->sucursal->file_sucursals->first();
            $salidadotacioncontrato->user = $salidadotacioncontrato->User;
            $salidadotacioncontrato->emision = Carbon::now()->format('Y-m-d');
            return $salidadotacioncontrato;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salidadotacioncontrato  $salidadotacioncontrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salidadotacioncontrato $salidadotacioncontrato)
    {
        $salidadotacioncontrato->name = $request->name;
        $salidadotacioncontrato->save();
        return $salidadotacioncontrato;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salidadotacioncontrato  $salidadotacioncontrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salidadotacioncontrato $salidadotacioncontrato)
    {
        $salidadotacioncontrato->estado = 0;
        $salidadotacioncontrato->save();
    }
    public function pdf(Salidadotacioncontrato $salidadotacioncontrato)
    {
        $salidadotacioncontrato = $this->show($salidadotacioncontrato);

    $pdf = Pdf::loadView('reportes.pdf.dotacion.salidacontrato', ["salidadotacioncontrato"=>$salidadotacioncontrato]);
    return $pdf->stream();
    }
}
