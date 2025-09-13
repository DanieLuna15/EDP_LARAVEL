<?php

namespace App\Http\Controllers;

use App\Models\Redotacion;
use App\Models\Redotaciondetalle;
use App\Models\Salidotacontradeta;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class RedotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index()
        {
            $model = Redotacion::with(['Contrato','Sucursal','User'])->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/redotacions/$s->id");
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
       
        $redotacion = new Redotacion();
        $redotacion->salidadotacioncontrato_id = $request->id;
        $redotacion->contrato_id = $request->contrato_id;
        $redotacion->user_id = 1;
        $redotacion->sucursal_id = 1;
        $redotacion->fecha = date('Y-m-d');
        $redotacion->save();
        $stockdotacion = new Stockdotacion();
        $stockdotacion->sucursal_id = 1;
        $stockdotacion->user_id = 1;
        $stockdotacion->motivo = "REDOTACION";

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
            $Redotaciondetalle = new Redotaciondetalle();
            $Redotaciondetalle->stockdotaciondetail_id = $Stockdotaciondetail->id;
        
            $Redotaciondetalle->redotacion_id = $redotacion->id;
            

            $Redotaciondetalle->cantidad = intval($c['cantidad']);
    
            $Redotaciondetalle->save();
            $Salidotacontradeta = new Salidotacontradeta();
            $Salidotacontradeta->stockdotaciondetail_id = $Stockdotaciondetail->id;
            $Salidotacontradeta->salidadotacioncontrato_id = $request->id;
            $Salidotacontradeta->contrato_id = $request->contrato_id;
            $Salidotacontradeta->cantidad = intval($c['cantidad']);
            $Salidotacontradeta->fecha = date('Y-m-d');
            $Salidotacontradeta->motivo = "REDOTACION";
            $Salidotacontradeta->save();
        }
        return $redotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redotacion  $redotacion
     * @return \Illuminate\Http\Response
     */
    public function show(Redotacion $redotacion)
    {
        $redotacion->detalle = $redotacion->Redotaciondetalles()->get();
        $redotacion->contrato = $redotacion->Contrato;
        $redotacion->sucursal = $redotacion->Sucursal;
        $redotacion->sucursal->file_sucursals = $redotacion->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $redotacion->sucursal->image = $redotacion->sucursal->file_sucursals->first();
        $redotacion->user = $redotacion->User;
        return $redotacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redotacion  $redotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redotacion $redotacion)
    {
        $redotacion->name = $request->name;
        $redotacion->save();
        return $redotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redotacion  $redotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redotacion $redotacion)
    {
        $redotacion->estado = 0;
        $redotacion->save();
    }
    public function pdf(Redotacion $redotacion)
    {
        $redotacion = $this->show($redotacion);

    $pdf = Pdf::loadView('reportes.pdf.dotacion.redotacion', ["redotacion"=>$redotacion]);
    return $pdf->stream();
    }
}
