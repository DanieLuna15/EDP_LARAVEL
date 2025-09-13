<?php

namespace App\Http\Controllers;

use App\Models\LoteTrozadoPp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LoteTrozadoPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  LoteTrozadoPp::with(['Lote','PpDetalle'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteTrozadoPps/'.$m->id);
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
        $loteTrozadoPp = new LoteTrozadoPp();
        $loteTrozadoPp->name = $request->name;
        $loteTrozadoPp->save();
        return $loteTrozadoPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteTrozadoPp  $loteTrozadoPp
     * @return \Illuminate\Http\Response
     */
    public function show(LoteTrozadoPp $loteTrozadoPp)
    {
        $loteTrozadoPp->lote = $loteTrozadoPp->Lote;
        $loteTrozadoPp->pp_detalle = $loteTrozadoPp->PpDetalle;
        return $loteTrozadoPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteTrozadoPp  $loteTrozadoPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteTrozadoPp $loteTrozadoPp)
    {
        $loteTrozadoPp->name = $request->name;
        $loteTrozadoPp->save();
        return $loteTrozadoPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteTrozadoPp  $loteTrozadoPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteTrozadoPp $loteTrozadoPp)
    {
        $loteTrozadoPp->estado = 0;
        $loteTrozadoPp->save();
    }
    public function pdf(LoteTrozadoPp $loteTrozadoPp)
    {
        $loteTrozadoPp = $this->show($loteTrozadoPp);
        $lote = $loteTrozadoPp->lote;
        $sucursal = $loteTrozadoPp->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $loteTrozadoPp->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.trozadoPP', [
            "loteTrozadoPp" => $loteTrozadoPp,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
