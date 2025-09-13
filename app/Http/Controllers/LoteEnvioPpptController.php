<?php

namespace App\Http\Controllers;

use App\Models\LoteEnvioPppt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LoteEnvioPpptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  LoteEnvioPppt::with(['Lote','PpDetalle','PtDetalle'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteEnvioPppts/'.$m->id);
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
        $loteEnvioPppt = new LoteEnvioPppt();
        $loteEnvioPppt->name = $request->name;
        $loteEnvioPppt->save();
        return $loteEnvioPppt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteEnvioPppt  $loteEnvioPppt
     * @return \Illuminate\Http\Response
     */
    public function show(LoteEnvioPppt $loteEnvioPppt)
    {
        $loteEnvioPppt->lote = $loteEnvioPppt->Lote;
  
        $loteEnvioPppt->pp_detalle = $loteEnvioPppt->PpDetalle;
        $loteEnvioPppt->pt_detalle = $loteEnvioPppt->PtDetalle;
        return $loteEnvioPppt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteEnvioPppt  $loteEnvioPppt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteEnvioPppt $loteEnvioPppt)
    {
        $loteEnvioPppt->name = $request->name;
        $loteEnvioPppt->save();
        return $loteEnvioPppt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteEnvioPppt  $loteEnvioPppt
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteEnvioPppt $loteEnvioPppt)
    {
        $loteEnvioPppt->estado = 0;
        $loteEnvioPppt->save();
    }
    public function pdf(LoteEnvioPppt $loteEnvioPppt)
    {
        $loteEnvioPppt = $this->show($loteEnvioPppt);
        $lote = $loteEnvioPppt->lote;
        $sucursal = $loteEnvioPppt->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $loteEnvioPppt->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.envioPPPT', [
            "loteEnvioPppt" => $loteEnvioPppt,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
