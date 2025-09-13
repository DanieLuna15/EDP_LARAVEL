<?php

namespace App\Http\Controllers;

use App\Models\CajaAjuste;
use App\Models\CajaAjusteDetalle;
use App\Models\CajaInventario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class CajaAjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  CajaAjuste::with(['Sucursal','User'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
           
            $s->url_pdf = url("reportes/cajaAjustes/$s->id");
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
        $cajaAjuste = new CajaAjuste();
        $cajaAjuste->fecha = $request->fecha;
        $cajaAjuste->motivo = $request->motivo;
        $cajaAjuste->save();
        foreach($request->cajas as $d){
            if(isset($d['ajuste'])){

                if($d['ajuste']!=0){
                    $inventario2 = new CajaInventario();
                    $inventario2->caja_id = $d['caja']['id'];
                    $inventario2->cantidad = $d['ajuste'];
                    $inventario2->compra = $d['caja']['compra'];
                    $inventario2->venta = $d['caja']['venta'];
                    $inventario2->almacen_id = $d['almacen']['id'];
                    $inventario2->motivo = "AJUSTE CAJAS";
                    $inventario2->tipo=$d['ajuste']>0?1:2;
                    $inventario2->save();
                    $cajaAjusteDetalle = new CajaAjusteDetalle();
                    $cajaAjusteDetalle->caja_ajuste_id = $cajaAjuste->id;
                    $cajaAjusteDetalle->caja_inventario_id = $inventario2->id;
                    $cajaAjusteDetalle->stock_actual = $d['cantidad_total'];
                    $cajaAjusteDetalle->ajuste = $d['ajuste'];
                    $cajaAjusteDetalle->stock_final = $d['cantidad_total']+$d['ajuste'];
                    $cajaAjusteDetalle->save();
                }
            }
        }
        $cajaAjuste->url_pdf = url("reportes/cajaAjustes/$cajaAjuste->id");
        return $cajaAjuste;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaAjuste  $cajaAjuste
     * @return \Illuminate\Http\Response
     */
    public function show(CajaAjuste $cajaAjuste)
    {
        $cajaAjuste->sucursal = $cajaAjuste->Sucursal;
        $cajaAjuste->sucursal->file_sucursals = $cajaAjuste->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $cajaAjuste->sucursal->image = $cajaAjuste->sucursal->file_sucursals->first();

        $cajaAjuste->user = $cajaAjuste->User;
        $cajaAjuste->caja_ajuste_detalles = $cajaAjuste->CajaAjusteDetalles()->get();
        return $cajaAjuste;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaAjuste  $cajaAjuste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaAjuste $cajaAjuste)
    {
        $cajaAjuste->name = $request->name;
        $cajaAjuste->save();
        return $cajaAjuste;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaAjuste  $cajaAjuste
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaAjuste $cajaAjuste)
    {
        $cajaAjuste->estado = 0;
        $cajaAjuste->save();
    }
    public function ticket(CajaAjuste $cajaAjuste)
    {
        $cajaAjuste = $this->show($cajaAjuste);

        $pdf = Pdf::loadView('reportes.pdf.almacen.caja.ajuste', ["cajaAjuste"=>$cajaAjuste]);
        return $pdf->stream();
    }
}
