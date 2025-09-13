<?php

namespace App\Http\Controllers;

use App\Models\Salidadotaclidetalle;
use App\Models\Salidadotacliente;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SalidadotaclienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {

            $model = Salidadotacliente::with(['Cliente','Sucursal','User'])->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/salidadotaclientes/$s->id");
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
        $Salidadotacliente = new Salidadotacliente();
        $Salidadotacliente->sucursal_id = 1;
        $Salidadotacliente->user_id = 1;
        $Salidadotacliente->cliente_id = $request->cliente_id;
        $Salidadotacliente->fecha = date('Y-m-d');
        
        $Salidadotacliente->save();
        $stockdotacion = new Stockdotacion();
        $stockdotacion->motivo = "SALIDA DE DOTACION POR CLIENTE";
        $stockdotacion->sucursal_id = 1;
        $stockdotacion->user_id = 1;
        $stockdotacion->fecha = date('Y-m-d');
        $stockdotacion->save();
        foreach ($request->dotaciones as $c) {
            $Stockdotaciondetail = new Stockdotaciondetail();
            $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;
        
            $Stockdotaciondetail->dotacion_id = intval($c['dotacion']['id']);
            
            $Stockdotaciondetail->costo = intval($c['dotacion']['costo']);
            $Stockdotaciondetail->cantidad = 0-intval($c['cantidad']);
            $Stockdotaciondetail->venta = intval($c['dotacion']['venta']);
            $Stockdotaciondetail->save();
            $Salidadotaclidetalle = new Salidadotaclidetalle();
            $Salidadotaclidetalle->salidadotacliente_id = $Salidadotacliente->id;
            $Salidadotaclidetalle->cliente_id = $request->cliente_id;
            $Salidadotaclidetalle->stockdotaciondetail_id = $Stockdotaciondetail->id;
            $Salidadotaclidetalle->cantidad = intval($c['cantidad']);
            $Salidadotaclidetalle->save();
        }
        return $Salidadotacliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salidadotacliente  $salidadotacliente
     * @return \Illuminate\Http\Response
     */
    public function show(Salidadotacliente $salidadotacliente)
    {
        $salidadotacliente->detalle = $salidadotacliente->Salidadotaclidetalles()->get();
            $salidadotacliente->cliente = $salidadotacliente->Cliente;
            $salidadotacliente->sucursal = $salidadotacliente->Sucursal;
            $salidadotacliente->sucursal->file_sucursals = $salidadotacliente->sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $salidadotacliente->sucursal->image = $salidadotacliente->sucursal->file_sucursals->first();
            $salidadotacliente->user = $salidadotacliente->User;
            $salidadotacliente->emision = Carbon::now()->format('Y-m-d');
            return $salidadotacliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salidadotacliente  $salidadotacliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salidadotacliente $salidadotacliente)
    {
        $salidadotacliente->name = $request->name;
        $salidadotacliente->save();
        return $salidadotacliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salidadotacliente  $salidadotacliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salidadotacliente $salidadotacliente)
    {
        $salidadotacliente->estado = 0;
        $salidadotacliente->save();
    }
    public function pdf(Salidadotacliente $salidadotacliente)
    {
        $salidadotacliente = $this->show($salidadotacliente);

    $pdf = Pdf::loadView('reportes.pdf.dotacion.salidacliente', ["salidacliente"=>$salidadotacliente]);
    return $pdf->stream();
    }
}
