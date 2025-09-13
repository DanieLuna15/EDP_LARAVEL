<?php

namespace App\Http\Controllers;

use App\Models\CompraCaja;
use App\Models\PagoCompraCaja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PagoCompraCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  PagoCompraCaja::with(['CompraCaja','Banco'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->fecha = $s->created_at->format('Y-m-d');
            $s->url_pdf = url("reportes/pagoCompraCajas/$s->id");
            $s->CompraCaja->url_pdf = url("reportes/compraCajas/{$s->CompraCaja->id}");
            $list[]=$s;
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
        $pagoCompraCaja = new PagoCompraCaja();
        $pagoCompraCaja->monto = $request->valor;
        $pagoCompraCaja->total = $request->total;
        $pagoCompraCaja->deuda = $request->pendiente;
        $pagoCompraCaja->banco_id = $request->banco_id;
        $pagoCompraCaja->pendiente = $request->pendiente - $request->valor;
        $pagoCompraCaja->compra_caja_id = $request->id;
        $pagoCompraCaja->save();
        $consolidacionPago =CompraCaja::find($request->id);
        $consolidacionPago->monto =  $consolidacionPago->monto + $request->valor;
        $consolidacionPago->save();
        $pagoCompraCaja->url_pdf = url("reportes/pagoCompraCajas/$pagoCompraCaja->id");
        return $pagoCompraCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PagoCompraCaja  $pagoCompraCaja
     * @return \Illuminate\Http\Response
     */
    public function show(PagoCompraCaja $pagoCompraCaja)
    {
        $pagoCompraCaja->compra_caja = $this->compra($pagoCompraCaja->compraCaja);
        return $pagoCompraCaja;
    }
    public function compra(CompraCaja $compraCaja)
    {
        $compraCaja->sucursal = $compraCaja->Sucursal;
        $compraCaja->sucursal->file_sucursals = $compraCaja->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $compraCaja->sucursal->image = $compraCaja->sucursal->file_sucursals->first();
        $compraCaja->detalles = $compraCaja->CompraCajaDetalles()->get();
        $compraCaja->detalle_pagos = $compraCaja->PagoCompraCajas()->get();
        return $compraCaja;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PagoCompraCaja  $pagoCompraCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoCompraCaja $pagoCompraCaja)
    {
        $pagoCompraCaja->name = $request->name;
        $pagoCompraCaja->save();
        return $pagoCompraCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PagoCompraCaja  $pagoCompraCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoCompraCaja $pagoCompraCaja)
    {
        $pagoCompraCaja->estado = 0;
        $pagoCompraCaja->save();
    }
    public function ticket(PagoCompraCaja $pagoCompraCaja)
    {
        $pagoCompraCaja = $this->show($pagoCompraCaja);

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.comprapago', ["pagoCompraCaja"=>$pagoCompraCaja]);
        return $pdf->stream();
    }
}
