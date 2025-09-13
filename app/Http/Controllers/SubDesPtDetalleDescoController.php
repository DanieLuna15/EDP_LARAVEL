<?php

namespace App\Http\Controllers;

use App\Models\SubDesPtDetalleDesco;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubDesPtDetalleDescoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubDesPtDetalleDesco::where('estado',1)->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = SubDesPtDetalleDesco::where('estado', 1)->whereDate('created_at','>=', $fecha_inicio)->whereDate('created_at','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
            $detalle = $this->show($m);
            $m->url_pdf = url('reportes/subDesPtDetalleDescos/'.$detalle->id);
            $m->url_lote_pdf = url('reportes/lotes/'.$detalle->lote->id);

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
        $subDesPtDetalleDesco = new SubDesPtDetalleDesco();
        $subDesPtDetalleDesco->equivale = $request->equivale;
        $subDesPtDetalleDesco->cantidad = $request->cantidad;
        $subDesPtDetalleDesco->peso_total = $request->peso;
        $subDesPtDetalleDesco->compo_externa_detalle_id = $request->compo_externa_detalle_id;
        $subDesPtDetalleDesco->pt_detalle_descomposicion_id = $request->sub_descomponer['id'];
        $subDesPtDetalleDesco->pt_detalle_id = $request->sub_descomponer['pt_detalle_id'];
        $subDesPtDetalleDesco->save();
        $subDesPtDetalleDesco->url_pdf = url('reportes/subDesPtDetalleDescos/'.$subDesPtDetalleDesco->id);
        return $subDesPtDetalleDesco;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubDesPtDetalleDesco  $subDesPtDetalleDesco
     * @return \Illuminate\Http\Response
     */
    public function show(SubDesPtDetalleDesco $subDesPtDetalleDesco)
    {
        $subDesPtDetalleDesco->compo_externa_detalle = $subDesPtDetalleDesco->CompoExternaDetalle;
        $subDesPtDetalleDesco->pt_detalle_descomposicion = $subDesPtDetalleDesco->PtDetalleDescomposicion;
        $subDesPtDetalleDesco->pt_detalle = $subDesPtDetalleDesco->PtDetalle;
        $subDesPtDetalleDesco->lote = $subDesPtDetalleDesco->PtDetalle->Lote;

        return $subDesPtDetalleDesco;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubDesPtDetalleDesco  $subDesPtDetalleDesco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubDesPtDetalleDesco $subDesPtDetalleDesco)
    {
        $subDesPtDetalleDesco->name = $request->name;
        $subDesPtDetalleDesco->save();
        return $subDesPtDetalleDesco;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubDesPtDetalleDesco  $subDesPtDetalleDesco
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDesPtDetalleDesco $subDesPtDetalleDesco)
    {
        $subDesPtDetalleDesco->estado = 0;
        $subDesPtDetalleDesco->save();
    }
    public function pdf(SubDesPtDetalleDesco $subDesPtDetalleDesco)
    {
        $subDesPtDetalleDesco = $this->show($subDesPtDetalleDesco);
        $lote = $subDesPtDetalleDesco->lote;
        $sucursal = $subDesPtDetalleDesco->lote->Compra->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $compra = $subDesPtDetalleDesco->lote->Compra;
        $pdf = Pdf::loadView('reportes.pdf.lote.subDesPtDetalleDesco', [
            "subDesPtDetalleDesco" => $subDesPtDetalleDesco,
            "sucursal" => $sucursal,
            "compra" => $compra,
            "lote" => $lote
        ]);
        return $pdf->stream();
    }
}
