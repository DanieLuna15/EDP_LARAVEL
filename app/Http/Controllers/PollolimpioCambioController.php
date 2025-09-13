<?php

namespace App\Http\Controllers;

use App\Models\PollolimpioCambio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PollolimpioCambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PollolimpioCambio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pollolimpioCambio = new PollolimpioCambio();
        $pollolimpioCambio->name = $request->name;
        $pollolimpioCambio->save();
        return $pollolimpioCambio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollolimpioCambio  $pollolimpioCambio
     * @return \Illuminate\Http\Response
     */
    public function show(PollolimpioCambio $pollolimpioCambio)
    {
        
        return $pollolimpioCambio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollolimpioCambio  $pollolimpioCambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollolimpioCambio $pollolimpioCambio)
    {
        $pollolimpioCambio->name = $request->name;
        $pollolimpioCambio->save();
        return $pollolimpioCambio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollolimpioCambio  $pollolimpioCambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollolimpioCambio $pollolimpioCambio)
    {
        $pollolimpioCambio->estado = 0;
        $pollolimpioCambio->save();
    }
    public function pdf(PollolimpioCambio $pollolimpioCambio)
    {
        $pollolimpioCambio = $this->show($pollolimpioCambio);
        $sucursal = $pollolimpioCambio->Sucursal;
        $user = $pollolimpioCambio->User;
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pollolimpios.producto', ["pollolimpioCambio"=>$pollolimpioCambio,
        "sucursal"=>$sucursal,
        "user"=>$user
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = PollolimpioCambio::with(['Sucursal'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           $m->url_pdf = url("reportes/pollolimpioCambios/$m->id");

            $list[] = $m;
        }
        return $list;
    }
}
