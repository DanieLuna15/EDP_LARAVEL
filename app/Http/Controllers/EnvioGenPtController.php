<?php

namespace App\Http\Controllers;

use App\Models\EnvioGenPt;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnvioGenPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = EnvioGenPt::with('Pt')->where('estado',1)->get();
        $list = [];
        foreach ($model as $m) {
            $list[] = $m;
        }
        return $list;
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = EnvioGenPt::with('Pt')->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/envioGenPts/'.$m->id);

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
        $envioGenPt = new EnvioGenPt();
        $envioGenPt->name = $request->name;
        $envioGenPt->save();
        return $envioGenPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnvioGenPt  $envioGenPt
     * @return \Illuminate\Http\Response
     */
    public function show(EnvioGenPt $envioGenPt)
    {
        
        return $envioGenPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnvioGenPt  $envioGenPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnvioGenPt $envioGenPt)
    {
        $envioGenPt->name = $request->name;
        $envioGenPt->save();
        return $envioGenPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnvioGenPt  $envioGenPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnvioGenPt $envioGenPt)
    {
        $envioGenPt->estado = 0;
        $envioGenPt->save();
    }
    public function pdf(EnvioGenPt $envioGenPt)
    {
        $sucursal = $envioGenPt->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
   
       $pdf = Pdf::loadView('reportes.pdf.lote.envioPtGen',[
        'envioGenPt'=>$envioGenPt,
        'sucursal'=>$sucursal,
        ])->setPaper('a4', 'landscape');
    return $pdf->stream();
    }
}
