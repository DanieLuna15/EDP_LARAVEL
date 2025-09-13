<?php

namespace App\Http\Controllers;

use App\Models\EnvioGenPp;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnvioGenPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = EnvioGenPp::with('Pp')->where('estado',1)->get();
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

        $model = EnvioGenPp::with('Pp')->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/envioGenPps/'.$m->id);

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
        $envioGenPp = new EnvioGenPp();
        $envioGenPp->name = $request->name;
        $envioGenPp->save();
        return $envioGenPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnvioGenPp  $envioGenPp
     * @return \Illuminate\Http\Response
     */
    public function show(EnvioGenPp $envioGenPp)
    {
        
        return $envioGenPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnvioGenPp  $envioGenPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnvioGenPp $envioGenPp)
    {
        $envioGenPp->name = $request->name;
        $envioGenPp->save();
        return $envioGenPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnvioGenPp  $envioGenPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnvioGenPp $envioGenPp)
    {
        $envioGenPp->estado = 0;
        $envioGenPp->save();
    }
    public function pdf(EnvioGenPp $envioGenPp)
    {
        $sucursal = $envioGenPp->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
   
       $pdf = Pdf::loadView('reportes.pdf.lote.envioPpGen',[
        'envioGenPp'=>$envioGenPp,
        'sucursal'=>$sucursal,
        ])->setPaper('a4', 'landscape');
    return $pdf->stream();
    }
}
