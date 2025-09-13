<?php

namespace App\Http\Controllers;

use App\Models\CambioPrecio;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CambioPrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CambioPrecio::where('estado',1)->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = CambioPrecio::with(['Sucursal'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           $m->url_pdf = url("reportes/cambioPrecios/$m->id");

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
        $cambioPrecio = new CambioPrecio();
        $cambioPrecio->name = $request->name;
        $cambioPrecio->save();
        return $cambioPrecio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CambioPrecio  $cambioPrecio
     * @return \Illuminate\Http\Response
     */
    public function show(CambioPrecio $cambioPrecio)
    {
        
        return $cambioPrecio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CambioPrecio  $cambioPrecio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CambioPrecio $cambioPrecio)
    {
        $cambioPrecio->name = $request->name;
        $cambioPrecio->save();
        return $cambioPrecio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CambioPrecio  $cambioPrecio
     * @return \Illuminate\Http\Response
     */
    public function destroy(CambioPrecio $cambioPrecio)
    {
        $cambioPrecio->estado = 0;
        $cambioPrecio->save();
    }
    public function pdf(CambioPrecio $cambioPrecio)
    {
        $cambioPrecio = $this->show($cambioPrecio);
        $sucursal = $cambioPrecio->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.cambioPrecios.nota', ["cambioPrecio"=>$cambioPrecio,
        "sucursal"=>$sucursal
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
