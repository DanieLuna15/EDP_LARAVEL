<?php

namespace App\Http\Controllers;

use App\Models\Devosalidotacontra;
use App\Models\Salidotacontradeta;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;

class DevosalidotacontraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Devosalidotacontra::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        $stockdotacion = new Stockdotacion();
            $stockdotacion->sucursal_id = 1;
            $stockdotacion->motivo = "DEVOLUCION DE DOTACION POR PERSONAL";
            $stockdotacion->fecha = date('Y-m-d');
            $stockdotacion->save();
            $Devosalidadotacli = new Devosalidotacontra();
            $Devosalidadotacli->salidadotacioncontrato_id = $request->id;
            $Devosalidadotacli->sucursal_id = 1;
            $Devosalidadotacli->fecha = date('Y-m-d');
            $Devosalidadotacli->save();
            foreach ($request->dotaciones as $c) {
              
        
                $Stockdotaciondetail = new Stockdotaciondetail();
                $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;
            
                $Stockdotaciondetail->dotacion_id = intval($c['dotacion_id']);
                
                $Stockdotaciondetail->costo = intval($c['dotacion_costo']);
                $Stockdotaciondetail->cantidad = intval($c['cantidad']);
                $Stockdotaciondetail->venta = intval($c['dotacion_venta']);
                $Stockdotaciondetail->save();
                $Salidotacontradeta2= new Salidotacontradeta();
                $Salidotacontradeta2->stockdotaciondetail_id = $Stockdotaciondetail->id;
                $Salidotacontradeta2->salidadotacioncontrato_id = $request->id;
                $Salidotacontradeta2->contrato_id = $request->contrato_id;
                $Salidotacontradeta2->cantidad = 0-intval($c['cantidad']);
                $Salidotacontradeta2->fecha = date('Y-m-d');
                $Salidotacontradeta2->motivo = "DEVOLUCION";
                $Salidotacontradeta2->save();
            }
            return $stockdotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devosalidotacontra  $devosalidotacontra
     * @return \Illuminate\Http\Response
     */
    public function show(Devosalidotacontra $devosalidotacontra)
    {
        
        return $devosalidotacontra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devosalidotacontra  $devosalidotacontra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devosalidotacontra $devosalidotacontra)
    {
        $devosalidotacontra->name = $request->name;
        $devosalidotacontra->save();
        return $devosalidotacontra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devosalidotacontra  $devosalidotacontra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devosalidotacontra $devosalidotacontra)
    {
        $devosalidotacontra->estado = 0;
        $devosalidotacontra->save();
    }
}
