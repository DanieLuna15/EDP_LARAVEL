<?php

namespace App\Http\Controllers;

use App\Models\TurnoChofer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TurnoChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TurnoChofer::where('estado',1)->get();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set(env('TIME_ZONE'));
        $turnoChofer = new TurnoChofer();
        $turnoChofer->chofer_id = $request->id;
        $turnoChofer->apertura = 1;
        $turnoChofer->fecha = date('Y-m-d');
        $turnoChofer->hora_inicio = date('H:i:s');
        $turnoChofer->save();
        return $turnoChofer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TurnoChofer  $turnoChofer
     * @return \Illuminate\Http\Response
     */
    public function show(TurnoChofer $turnoChofer)
    {
  
        $ventasPeso = $turnoChofer->VentaTurnoChofers()->get()->sum('peso');
        
        $turnoChofer->capacidad_utilizada = $ventasPeso;
        return $turnoChofer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TurnoChofer  $turnoChofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TurnoChofer $turnoChofer)
    {
        $turnoChofer->apertura = 0;
        $turnoChofer->save();
        return $turnoChofer;
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = TurnoChofer::with(['Chofer'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           $m->url_pdf = url("reportes/turnoChofers/$m->id");

            $list[] = $m;
        }
        return $list;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TurnoChofer  $turnoChofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TurnoChofer $turnoChofer)
    {
        $turnoChofer->estado = 0;
        $turnoChofer->save();
    }
    public function pdf(TurnoChofer $turnoChofer)
    {
        $turnoChofer = $this->show($turnoChofer);
       

     
       
        $pdf = Pdf::loadView('reportes.pdf.ventas.chofer.turno', ["turnoChofer"=>$turnoChofer,
  
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
