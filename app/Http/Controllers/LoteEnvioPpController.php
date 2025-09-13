<?php

namespace App\Http\Controllers;

use App\Models\LoteEnvioPp;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoteEnvioPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  LoteEnvioPp::with(['Lote','LoteDetalle','PpDetalle'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteEnvioPps/'.$m->id);
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
        $loteEnvioPp = new LoteEnvioPp();
        $loteEnvioPp->name = $request->name;
        $loteEnvioPp->save();
        return $loteEnvioPp;
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = LoteEnvioPp::with(['Lote','LoteDetalle','PpDetalle'])->where('estado', 1)->whereDate('created_at','>=', $fecha_inicio)->whereDate('created_at','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $m->url_pdf = url('reportes/loteEnvioPps/'.$m->id);
            $m->url_lote_pdf = url('reportes/lotes/'.$m->lote->id);

            $list[] = $m;
        }
        return $list;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoteEnvioPp  $loteEnvioPp
     * @return \Illuminate\Http\Response
     */
    public function show(LoteEnvioPp $loteEnvioPp)
    {
        $loteEnvioPp->lote = $loteEnvioPp->Lote;
        $loteEnvioPp->lote_detalle = $loteEnvioPp->LoteDetalle;
        $loteEnvioPp->pp_detalle = $loteEnvioPp->PpDetalle;
        return $loteEnvioPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoteEnvioPp  $loteEnvioPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteEnvioPp $loteEnvioPp)
    {
        $loteEnvioPp->name = $request->name;
        $loteEnvioPp->save();
        return $loteEnvioPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoteEnvioPp  $loteEnvioPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteEnvioPp $loteEnvioPp)
    {
        $loteEnvioPp->estado = 0;
        $loteEnvioPp->save();
    }
    public function pdf(LoteEnvioPp $loteEnvioPp)
    {
        $loteEnvioPp = $this->show($loteEnvioPp);
        $lote = $loteEnvioPp->lote;
        $sucursal = $loteEnvioPp->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $loteEnvioPp->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.envioPp', [
            "loteEnvioPp" => $loteEnvioPp,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
