<?php

namespace App\Http\Controllers;

use App\Models\CajaInventario;
use App\Models\TraspasoCaja;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class TraspasoCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = TraspasoCaja::with(['Caja','AlmacenDestino','AlmacenOrigen'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
           
            $s->url_pdf = url("reportes/traspasoCajas/$s->id");
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
        $traspasoCaja = new TraspasoCaja();
        $traspasoCaja->motivo = $request->motivo;
        $traspasoCaja->fecha = $request->fecha;
        $traspasoCaja->almacen_origen_id = $request->almacen_id;
        $traspasoCaja->almacen_destino_id = $request->almacen_destino_id;
        $traspasoCaja->caja_id = $request->caja['caja_id'];
        $traspasoCaja->cantidad = $request->caja['cantidad'];
        $traspasoCaja->save();
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
        $traspasoCaja->url_pdf = url("reportes/traspasoCajas/$traspasoCaja->id");
        return $traspasoCaja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoCaja  $traspasoCaja
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoCaja $traspasoCaja)
    {
        $traspasoCaja->sucursal = $traspasoCaja->AlmacenOrigen->Sucursal;
        $traspasoCaja->sucursal->file_sucursals = $traspasoCaja->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $traspasoCaja->sucursal->image = $traspasoCaja->sucursal->file_sucursals->first();
        $traspasoCaja->caja = $traspasoCaja->Caja;
        $traspasoCaja->almacen_destino = $traspasoCaja->AlmacenDestino;
        $traspasoCaja->almacen_origen = $traspasoCaja->AlmacenOrigen;
        return $traspasoCaja;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoCaja  $traspasoCaja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoCaja $traspasoCaja)
    {
        $traspasoCaja->name = $request->name;
        $traspasoCaja->save();
        return $traspasoCaja;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoCaja  $traspasoCaja
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoCaja $traspasoCaja)
    {
        $traspasoCaja->estado = 0;
        $traspasoCaja->save();
    }
    public function ticket(TraspasoCaja $traspasoCaja)
    {
        $TraspasoCaja = $this->show($traspasoCaja);

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.traspaso', ["traspasoCaja"=>$TraspasoCaja]);
        return $pdf->stream();
    }
}
