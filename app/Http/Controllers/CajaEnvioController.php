<?php

namespace App\Http\Controllers;

use App\Models\CajaInventario;
use App\Models\CajaEnvio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class CajaEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= CajaEnvio::with(['Caja','AlmacenDestino','AlmacenOrigen'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
           
            $s->url_pdf = url("reportes/cajaEnvios/$s->id");
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
        $CajaEnvio = new CajaEnvio();
        $CajaEnvio->motivo = $request->motivo;
        $CajaEnvio->chofer = $request->chofer;
        $CajaEnvio->camion = $request->camion;
        $CajaEnvio->fecha = $request->fecha;
        $CajaEnvio->almacen_origen_id = $request->almacen_id;
        $CajaEnvio->almacen_destino_id = $request->almacen_destino_id;
        $CajaEnvio->caja_id = $request->caja['caja_id'];
        $CajaEnvio->cantidad = $request->caja['cantidad'];
        $CajaEnvio->save();
        $inventario = new CajaInventario();
        $inventario->caja_id = $request->caja['caja_id'];
        $inventario->cantidad = 0-$request->caja['cantidad'];
        $inventario->compra = $request->caja['caja']['compra'];
        $inventario->venta = $request->caja['caja']['venta'];
        $inventario->almacen_id = $request->almacen_id;
        $inventario->motivo = $request->motivo;
        $inventario->tipo=2;
        $inventario->save();
        $inventario2 = new CajaInventario();
        $inventario2->caja_id = $request->caja['caja_id'];
        $inventario2->cantidad = $request->caja['cantidad'];
        $inventario2->compra = $request->caja['caja']['compra'];
        $inventario2->venta = $request->caja['caja']['venta'];
        $inventario2->almacen_id = $request->almacen_destino_id;
        $inventario2->motivo = $request->motivo;
        $inventario2->tipo=2;
        $inventario2->save();
        $CajaEnvio->url_pdf = url("reportes/cajaEnvios/$CajaEnvio->id");
        return $CajaEnvio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaEnvio  $CajaEnvio
     * @return \Illuminate\Http\Response
     */
    public function show(CajaEnvio $cajaEnvio)
    {
        $cajaEnvio->sucursal = $cajaEnvio->AlmacenOrigen->Sucursal;
        $cajaEnvio->sucursal->file_sucursals = $cajaEnvio->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $cajaEnvio->sucursal->image = $cajaEnvio->sucursal->file_sucursals->first();
        $cajaEnvio->caja = $cajaEnvio->Caja;
        $cajaEnvio->almacen_destino = $cajaEnvio->AlmacenDestino;
        $cajaEnvio->almacen_origen = $cajaEnvio->AlmacenOrigen;
        return $cajaEnvio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaEnvio  $CajaEnvio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaEnvio $cajaEnvio)
    {
        $cajaEnvio->name = $request->name;
        $cajaEnvio->save();
        return $cajaEnvio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaEnvio  $CajaEnvio
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaEnvio $cajaEnvio)
    {
        $cajaEnvio->estado = 0;
        $cajaEnvio->save();
    }
    public function ticket(CajaEnvio $cajaEnvio)
    {
        $cajaEnvio = $this->show($cajaEnvio);

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.envio', ["cajaEnvio"=>$cajaEnvio]);
        return $pdf->stream();
    }
}
