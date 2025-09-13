<?php

namespace App\Http\Controllers;

use App\Models\KardexDotacion;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
class StockdotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Stockdotacion::with(['Sucursal','User'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){


            $s->url_pdf = url("reportes/stockdotacions/$s->id");
            $s->url_ticket_pdf = url("reportes/stockdotacions-ticket/$s->id");

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
        $stockdotacion = new Stockdotacion();
        $stockdotacion->sucursal_id = $request->sucursal_id;
        $stockdotacion->user_id = $request->user_id;
        $stockdotacion->proveedor_id = $request->proveedor_id;
        $stockdotacion->motivo = $request->motivo;
        $stockdotacion->fecha = $request->fecha;
        $stockdotacion->lote = $request->lote;
        $stockdotacion->formapago_id = $request->formapago_id;
        $stockdotacion->save();
        foreach ($request->dotaciones as $c) {
            $stock_detail = Stockdotaciondetail::where('dotacion_id', intval($c['dotacion']['id']))->where('sucursal_id', $request->sucursal_id)->get();
            $stock = $stock_detail->sum('cantidad');
            $kardex = new KardexDotacion();
            $kardex->dotacion_id = $c['dotacion']['id'];
            $kardex->familia_id = $c['dotacion']['familia_id'];
            $kardex->sucursal_id = $request->sucursal_id;
            $kardex->entradas = $c['cantidad'];
            $kardex->salidas = 0;
            $kardex->stock = $stock + $c['cantidad'];
            $kardex->user_id = $request->user_id;
            $kardex->fecha = date('Y-m-d');
            $kardex->fechatime = date('Y-m-d H:i:s');
            $kardex->tipo = "COMPRA";
            $kardex->movimiento = 1;
            $kardex->motivo = $request->motivo;
            $kardex->costo = $c['dotacion']['costo'];

            $kardex->venta = $c['dotacion']['venta'];
            $kardex->save();

            $Stockdotaciondetail = new Stockdotaciondetail();
            $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;
            $Stockdotaciondetail->lote = $request->lote;
            $Stockdotaciondetail->dotacion_id = intval($c['dotacion']['id']);

            $Stockdotaciondetail->proveedor_id = $request->proveedor_id;



            $Stockdotaciondetail->sucursal_id = $request->sucursal_id;
            $Stockdotaciondetail->costo = $c['dotacion']['costo'];
            $Stockdotaciondetail->cantidad = $c['cantidad'];
            $Stockdotaciondetail->venta = $c['dotacion']['venta'];
            $Stockdotaciondetail->save();
        }
        $stockdotacion->url_pdf = url("reportes/stockdotacions/$stockdotacion->id");
        return $stockdotacion;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stockdotacion  $stockdotacion
     * @return \Illuminate\Http\Response
     */
    public function show(Stockdotacion $stockdotacion)
    {

        return $stockdotacion;
    }
    public function sucursal($id)
    {
        $model = Stockdotaciondetail::with(['Dotacion'])->where('estado', 1)->where('sucursal_id', $id)->get();
        $list = [];
        foreach ($model as $s) {

            $list[] = $s;
        }
        $new = [];
        if(count($list)>0){
            $list = collect($list)->groupBy(['dotacion_id','lote']);
            foreach ($list as $s) {
                foreach ($s as $c) {
                        $dotacion = $c->first()->dotacion;
                        $dotacion->stock_inventario = $c->sum('cantidad');
                        $dotacion->lote = $c->first()->lote;
                        $new[] =$dotacion;

                }
            }

            return $new;
        }
        return $new;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stockdotacion  $stockdotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stockdotacion $stockdotacion)
    {
        $stockdotacion->name = $request->name;
        $stockdotacion->save();
        return $stockdotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stockdotacion  $stockdotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stockdotacion $stockdotacion)
    {
        $stockdotacion->estado = 0;
        $stockdotacion->save();
    }
    public function pdf(Stockdotacion $stockdotacion)
    {
        $stockdotacion->sucursal->file_sucursals = $stockdotacion->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $stockdotacion->sucursal->image = $stockdotacion->sucursal->file_sucursals->first();
    $stockdotacion->detalles = $stockdotacion->Stockdotaciondetails()->get();
    $pdf = Pdf::loadView('reportes.pdf.dotacion.stockdotacion', ["stock"=>$stockdotacion]);
    return $pdf->stream();
    }

    public function pdfTicket(Stockdotacion $stockdotacion)
    {
        $stockdotacion->sucursal->file_sucursals = $stockdotacion->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $stockdotacion->sucursal->image = $stockdotacion->sucursal->file_sucursals->first();
    $stockdotacion->detalles = $stockdotacion->Stockdotaciondetails()->get();
    $pdf = Pdf::loadView('reportes.pdf.dotacion.stockdotacion-ticket', ["stock"=>$stockdotacion])->setPaper(
        [0, 0, 220, 550],
    );
    return $pdf->stream();
    }
}
