<?php

namespace App\Http\Controllers;

use App\Models\LoteTrozadoPt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LoteTrozadoPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  LoteTrozadoPt::with(['Lote','PtDetalle'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteTrozadoPts/'.$m->id);
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
        $loteTrozadoPt = new LoteTrozadoPt();
        $loteTrozadoPt->name = $request->name;
        $loteTrozadoPt->save();
        return $loteTrozadoPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteTrozadoPt  $loteTrozadoPt
     * @return \Illuminate\Http\Response
     */
    public function show(LoteTrozadoPt $loteTrozadoPt)
    {
        
        return $loteTrozadoPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteTrozadoPt  $loteTrozadoPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteTrozadoPt $loteTrozadoPt)
    {
        $loteTrozadoPt->name = $request->name;
        $loteTrozadoPt->save();
        return $loteTrozadoPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteTrozadoPt  $loteTrozadoPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteTrozadoPt $loteTrozadoPt)
    {
        $loteTrozadoPt->estado = 0;
        $loteTrozadoPt->save();
    }
    public function pdf(LoteTrozadoPt $loteTrozadoPt)
    {
        $loteTrozadoPt = $this->show($loteTrozadoPt);
        $lote = $loteTrozadoPt->lote;
        $sucursal = $loteTrozadoPt->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $loteTrozadoPt->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.trozadoPT', [
            "loteTrozadoPt" => $loteTrozadoPt,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
