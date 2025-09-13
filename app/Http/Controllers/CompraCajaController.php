<?php

namespace App\Http\Controllers;

use App\Models\CajaInventario;
use App\Models\CompraCaja;
use App\Models\CompraCajaDetalle;
use App\Models\PagoCompraCaja;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class CompraCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = CompraCaja::with(['Sucursal','User','Almacen','CajaProveedor'])->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->url_pdf = url("reportes/compraCajas/$s->id");
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
        $compraCaja = new CompraCaja();
      
        $compraCaja->fecha = $request->fecha;
        $compraCaja->caja_proveedor_id = $request->caja_proveedor_id;
        $compraCaja->sucursal_id = $request->sucursal_id;
        $compraCaja->user_id = $request->user_id;
        $compraCaja->almacen_id = $request->almacen_id;
        $compraCaja->tipo = $request->tipo;
        $compraCaja->total = $request->total;
        $compraCaja->monto = $request->tipo==1?$request->total:$request->monto;
        $compraCaja->save();

        $pagoCompraCaja = new PagoCompraCaja();
        $pagoCompraCaja->compra_caja_id = $compraCaja->id;
        $pagoCompraCaja->total = $request->total;
        $pagoCompraCaja->monto = $request->tipo==1?$request->total:$request->monto;
        $pagoCompraCaja->pendiente = $compraCaja->total-$compraCaja->monto;
        $pagoCompraCaja->deuda = $compraCaja->total-$compraCaja->monto;
        $pagoCompraCaja->banco_id = $request->banco_id;
        $pagoCompraCaja->save();

        foreach ($request->cajas_model as $d) {
            $inventario = new CajaInventario();
            $inventario->caja_id = $d['id'];
            $inventario->cantidad = $d['cantidad'];
            $inventario->compra = $d['compra'];
            $inventario->venta = $d['venta'];
            $inventario->almacen_id = $request->almacen_id;
            $inventario->motivo = "COMPRA";
            $inventario->tipo=1;
            $inventario->save();

            $CompraInventario = new CompraCajaDetalle();
            $CompraInventario->caja_inventario_id = $inventario->id;
            $CompraInventario->compra_caja_id = $compraCaja->id;
            $CompraInventario->save();

        }
        $compraCaja->url_pdf = url("reportes/compraCajas/$compraCaja->id");
        return $compraCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraCaja  $compraCaja
     * @return \Illuminate\Http\Response
     */
    public function show(CompraCaja $compraCaja)
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
     * @param  \App\Models\CompraCaja  $compraCajaCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompraCaja $compraCaja)
    {
        $compraCaja->name = $request->name;
        $compraCaja->save();
        return $compraCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraCaja  $compraCajaCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraCaja $compraCaja)
    {
        $compraCaja->estado = 0;
        $compraCaja->save();
    }
    public function ticket(CompraCaja $compraCaja)
    {
        $compraCaja = $this->show($compraCaja);

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.compra', ["compraCaja"=>$compraCaja]);
        return $pdf->stream();
    }
}
