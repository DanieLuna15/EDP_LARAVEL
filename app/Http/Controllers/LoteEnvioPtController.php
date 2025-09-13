<?php

namespace App\Http\Controllers;

use App\Models\LoteEnvioPt;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoteEnvioPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  LoteEnvioPt::with(['Lote','LoteDetalle','PtDetalle'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteEnvioPts/'.$m->id);
            $m->url_lote_pdf = url('reportes/lotes/'.$m->lote->id);
            $list[] = $m;
        }
        return $list;
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = LoteEnvioPt::with(['Lote','LoteDetalle','PtDetalle'])->where('estado', 1)->whereDate('created_at','>=', $fecha_inicio)->whereDate('created_at','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteEnvioPts/'.$m->id);
            $m->url_lote_pdf = url('reportes/lotes/'.$m->lote->id);

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
        $loteEnvioPt = new LoteEnvioPt();
        $loteEnvioPt->name = $request->name;
        $loteEnvioPt->save();
        return $loteEnvioPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteEnvioPt  $loteEnvioPt
     * @return \Illuminate\Http\Response
     */
    public function show(LoteEnvioPt $loteEnvioPt)
    {
        $loteEnvioPt->lote = $loteEnvioPt->Lote;
        $loteEnvioPt->lote_detalle = $loteEnvioPt->LoteDetalle;
        $loteEnvioPt->pt_detalle = $loteEnvioPt->PtDetalle;
        return $loteEnvioPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteEnvioPt  $loteEnvioPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteEnvioPt $loteEnvioPt)
    {
        $loteEnvioPt->name = $request->name;
        $loteEnvioPt->save();
        return $loteEnvioPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteEnvioPt  $loteEnvioPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteEnvioPt $loteEnvioPt)
    {
        $loteEnvioPt->estado = 0;
        $loteEnvioPt->save();
    }
    public function pdf(LoteEnvioPt $loteEnvioPt)
    {
        $loteEnvioPt = $this->show($loteEnvioPt);
        $lote = $loteEnvioPt->lote;
        $sucursal = $loteEnvioPt->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $loteEnvioPt->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.envioPt', [
            "loteEnvioPt" => $loteEnvioPt,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
