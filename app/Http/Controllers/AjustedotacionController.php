<?php

namespace App\Http\Controllers;

use App\Models\Ajustedotacion;
use App\Models\Ajustedotaciondetalle;
use App\Models\KardexDotacion;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class AjustedotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Ajustedotacion::with(['Sucursal','Ajustedotaciondetalles','User'])->where('estado',1)->get();
            $list = [];
            foreach($model as $s){


                $s->url_pdf = url("reportes/ajustedotacions/$s->id");
                $s->url_ticket_pdf = url("reportes/ajustedotacions-ticket/$s->id");

                $list[]=$s;
            }
            return $list;
    }
    public function sucursal($id)
    {
        $model = Ajustedotacion::with(['Sucursal','Ajustedotaciondetalles','User'])->where('estado',1)->where('sucursal_id',$id)->get();
            $list = [];
            foreach($model as $s){


                $s->url_pdf = url("reportes/ajustedotacions/$s->id");
                $s->url_ticket_pdf = url("reportes/ajustedotacions-ticket/$s->id");

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
        $ajustedotacion = new Ajustedotacion();
        $ajustedotacion->sucursal_id = $request->sucursal_id;
        $ajustedotacion->user_id = $request->user_id;
        $ajustedotacion->motivo = $request->motivo;

        $ajustedotacion->fecha = date('Y-m-d');
        $ajustedotacion->save();
        $stockdotacion = new Stockdotacion();
        $stockdotacion->sucursal_id = $request->sucursal_id;
        $stockdotacion->user_id = $request->user_id;
        $stockdotacion->motivo = "AJUSTE";
        $stockdotacion->lote = "LOTE";
        $stockdotacion->fecha = date('Y-m-d');
        $stockdotacion->save();
        foreach ($request->dotaciones as $c) {
            $stock_detail = Stockdotaciondetail::where('dotacion_id', intval($c['dotacion']['id']))->where('sucursal_id', $request->sucursal_id)->get();
            $stock = $stock_detail->sum('cantidad');
            $tipo = $c['cantidad']>0?1:2;
            if($tipo==1){
                $stock = $stock+$c['cantidad'];
            }else{
                $stock = $stock-abs($c['cantidad']);
            }
            $kardex = new KardexDotacion();
            $kardex->dotacion_id = $c['dotacion']['id'];
            $kardex->familia_id = $c['dotacion']['familia_id'];
            $kardex->sucursal_id = $request->sucursal_id;
            $kardex->entradas = $c['cantidad']>0?$c['cantidad']:0;
            $kardex->salidas =  $c['cantidad']>0?0:abs($c['cantidad']);
            $kardex->stock = $stock;
            $kardex->user_id = $request->user_id;
            $kardex->fecha = date('Y-m-d');
            $kardex->fechatime = date('Y-m-d H:i:s');
            $kardex->tipo = "AJUSTE";
            $kardex->movimiento = $tipo;
            $kardex->motivo = "AJUSTE DE DOTACION";
            $kardex->costo = $c['dotacion']['costo'];
            $kardex->venta = $c['dotacion']['venta'];
            $kardex->save();

            $Stockdotaciondetail = new Stockdotaciondetail();
            $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;

            $Stockdotaciondetail->dotacion_id = $c['dotacion']['id'];
            $Stockdotaciondetail->sucursal_id = $request->sucursal_id;
            $Stockdotaciondetail->costo = $c['dotacion']['costo'];
            $Stockdotaciondetail->cantidad = $c['cantidad'];
            $Stockdotaciondetail->venta = $c['dotacion']['venta'];
            $Stockdotaciondetail->lote = $c['dotacion']['lote'];
            $Stockdotaciondetail->save();
            $Ajustedotadetalle = new Ajustedotaciondetalle();
            $Ajustedotadetalle->ajustedotacion_id = $ajustedotacion->id;
            $Ajustedotadetalle->stockdotaciondetail_id = $Stockdotaciondetail->id;
            $Ajustedotadetalle->cantidad = $c['cantidad'];
            $Ajustedotadetalle->antes = $c['dotacion']['stock'];
            $Ajustedotadetalle->ahora = $c['cantidad'];
            $Ajustedotadetalle->despues = $c['dotacion']['stock']+$c['cantidad'];
            $Ajustedotadetalle->save();

        }
        return $ajustedotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajustedotacion  $ajustedotacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ajustedotacion $ajustedotacion)
    {
        $ajustedotacion->sucursal = $ajustedotacion->Sucursal;
        $ajustedotacion->sucursal->file_sucursals = $ajustedotacion->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $ajustedotacion->sucursal->image = $ajustedotacion->sucursal->file_sucursals->first();
        // $ajustedotacion->sucursal->image = $ajustedotacion->sucursal->imagesucursal->File();
        // $ajustedotacion->sucursal->image->url = url_path().$ajustedotacion->sucursal->image->path;
        $ajustedotacion->detalles = $ajustedotacion->Ajustedotaciondetalles()->get();
        $ajustedotacion->user = $ajustedotacion->User;
        return $ajustedotacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajustedotacion  $ajustedotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajustedotacion $ajustedotacion)
    {
        $ajustedotacion->name = $request->name;
        $ajustedotacion->save();
        return $ajustedotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajustedotacion  $ajustedotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajustedotacion $ajustedotacion)
    {
        $ajustedotacion->estado = 0;
        $ajustedotacion->save();
    }
    public function pdf(Ajustedotacion $ajustedotacion)
    {
        $ajustedotacion = $this->show($ajustedotacion);

        $pdf = Pdf::loadView('reportes.pdf.dotacion.ajuste', ["ajuste"=>$ajustedotacion]);
        return $pdf->stream();
    }
    public function pdfTicket(Ajustedotacion $ajustedotacion)
    {
        $ajustedotacion = $this->show($ajustedotacion);

        $pdf = Pdf::loadView('reportes.pdf.dotacion.ajuste-ticket', ["ajuste"=>$ajustedotacion])->setPaper(
            [0, 0, 220, 550],
        );
        return $pdf->stream();
    }
}
