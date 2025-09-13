<?php

namespace App\Http\Controllers;

use App\Models\TraspasoDotacion;
use App\Models\TraspasoDotaciondetalle;
use App\Models\KardexDotacion;
use App\Models\Stockdotacion;
use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class TraspasoDotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = TraspasoDotacion::with(['Sucursal','SucursalDestino','User'])->where('estado',1)->get();
            $list = [];
            foreach($model as $s){


                $s->url_pdf = url("reportes/traspasoDotacions/$s->id");
                $s->url_ticket_pdf = url("reportes/traspasoDotacions-ticket/$s->id");

                $list[]=$s;
            }
            return $list;
    }
    public function sucursal($id)
    {
        $model = TraspasoDotacion::with(['Sucursal','SucursalDestino','User'])->where('estado',1)->where('sucursal_id',$id)->get();
            $list = [];
            foreach($model as $s){


                $s->url_pdf = url("reportes/traspasoDotacions/$s->id");
                $s->url_ticket_pdf = url("reportes/traspasoDotacions-ticket/$s->id");
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
        $traspasoDotacion = new TraspasoDotacion();
        $traspasoDotacion->sucursal_id = $request->sucursal_id;
        $traspasoDotacion->sucursal_destino_id = $request->sucursal_destino_id;
        $traspasoDotacion->user_id = $request->user_id;
        $traspasoDotacion->motivo = $request->motivo;

        $traspasoDotacion->fecha = date('Y-m-d');
        $traspasoDotacion->save();
        $stockdotacion = new Stockdotacion();
        $stockdotacion->sucursal_id = $request->sucursal_id;
        $stockdotacion->user_id = $request->user_id;
        $stockdotacion->motivo = "AJUSTE";
        $stockdotacion->fecha = date('Y-m-d');
        $stockdotacion->save();
        $stockdotacion2 = new Stockdotacion();
        $stockdotacion2->sucursal_id = $request->sucursal_destino_id;
        $stockdotacion2->user_id = $request->user_id;
        $stockdotacion2->motivo = "TRASPASO";
        $stockdotacion2->fecha = date('Y-m-d');
        $stockdotacion2->save();
        foreach ($request->dotaciones as $c) {
            $stock_detail = Stockdotaciondetail::where('dotacion_id', intval($c['dotacion']['id']))->where('sucursal_id', $request->sucursal_id)->get();
            $stock = $stock_detail->sum('cantidad');
            $stock = $stock-$c['cantidad'];
            $stock_detail2 = Stockdotaciondetail::where('dotacion_id', intval($c['dotacion']['id']))->where('sucursal_id', $request->sucursal_destino_id)->get();
            $stock2 = $stock_detail2->sum('cantidad');
            $stock2 = $stock2+$c['cantidad'];
            $kardex = new KardexDotacion();
            $kardex->dotacion_id = $c['dotacion']['id'];
            $kardex->sucursal_id = $request->sucursal_id;
            $kardex->familia_id = $c['dotacion']['familia_id'];
            $kardex->entradas = 0;
            $kardex->salidas =  $c['cantidad'];
            $kardex->stock = $stock;
            $kardex->user_id = $request->user_id;
            $kardex->fecha = date('Y-m-d');
            $kardex->fechatime = date('Y-m-d H:i:s');
            $kardex->tipo = "TRASPASO";
            $kardex->movimiento = 2;
            $kardex->motivo = "TRASPASO DE DOTACION";
            $kardex->costo = intval($c['dotacion']['costo']);
            $kardex->venta = intval($c['dotacion']['venta']);
            $kardex->save();
            $kardex2 = new KardexDotacion();
            $kardex2->dotacion_id = $c['dotacion']['id'];
            $kardex2->sucursal_id = $request->sucursal_destino_id;
            $kardex2->entradas = $c['cantidad'];
            $kardex2->familia_id = $c['dotacion']['familia_id'];
            $kardex2->salidas = 0 ;
            $kardex2->stock = $stock2;
            $kardex2->user_id = $request->user_id;
            $kardex2->fecha = date('Y-m-d');
            $kardex2->fechatime = date('Y-m-d H:i:s');
            $kardex2->tipo = "TRASPASO";
            $kardex2->movimiento = 1;
            $kardex2->motivo = "TRASPASO DE DOTACION";
            $kardex2->costo = intval($c['dotacion']['costo']);
            $kardex2->venta = intval($c['dotacion']['venta']);
            $kardex2->save();

            $Stockdotaciondetail = new Stockdotaciondetail();
            $Stockdotaciondetail->stockdotacion_id = $stockdotacion->id;
            $Stockdotaciondetail->lote = $c['dotacion']['lote'];
            $Stockdotaciondetail->dotacion_id = intval($c['dotacion']['id']);
            $Stockdotaciondetail->sucursal_id = $request->sucursal_id;
            $Stockdotaciondetail->costo = $c['dotacion']['costo'];
            $Stockdotaciondetail->cantidad = 0-$c['cantidad'];
            $Stockdotaciondetail->venta = $c['dotacion']['venta'];
            $Stockdotaciondetail->save();
            $Stockdotaciondetail2 = new Stockdotaciondetail();
            $Stockdotaciondetail2->stockdotacion_id = $stockdotacion2->id;

            $Stockdotaciondetail2->lote = $c['dotacion']['lote'];
            $Stockdotaciondetail2->dotacion_id = intval($c['dotacion']['id']);
            $Stockdotaciondetail2->sucursal_id = $request->sucursal_destino_id;
            $Stockdotaciondetail2->costo = $c['dotacion']['costo'];
            $Stockdotaciondetail2->cantidad = intval($c['cantidad']);
            $Stockdotaciondetail2->venta = $c['dotacion']['venta'];
            $Stockdotaciondetail2->save();
            $traspasoDotacionDetalle = new TraspasoDotaciondetalle();
            $traspasoDotacionDetalle->traspaso_dotacion_id = $traspasoDotacion->id;
            $traspasoDotacionDetalle->stockdotaciondetail_id = $Stockdotaciondetail->id;
            $traspasoDotacionDetalle->costo = $c['dotacion']['costo'];
            $traspasoDotacionDetalle->cantidad = intval($c['cantidad']);
            $traspasoDotacionDetalle->venta = $c['dotacion']['venta'];
            $traspasoDotacionDetalle->save();

        }
        $traspasoDotacion->url_pdf = url("reportes/traspasoDotacions/$traspasoDotacion->id");
        return $traspasoDotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TraspasoDotacion  $traspasoDotacion
     * @return \Illuminate\Http\Response
     */
    public function show(TraspasoDotacion $traspasoDotacion)
    {
        $traspasoDotacion->sucursal = $traspasoDotacion->Sucursal;
        $traspasoDotacion->sucursal_destino = $traspasoDotacion->SucursalDestino;
        $traspasoDotacion->sucursal->file_sucursals = $traspasoDotacion->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $traspasoDotacion->sucursal->image = $traspasoDotacion->sucursal->file_sucursals->first();
        // $traspasoDotacion->sucursal->image = $traspasoDotacion->sucursal->imagesucursal->File();
        // $traspasoDotacion->sucursal->image->url = url_path().$traspasoDotacion->sucursal->image->path;
        $traspasoDotacion->detalles = $traspasoDotacion->TraspasoDotaciondetalles()->get();
        $traspasoDotacion->user = $traspasoDotacion->User;
        return $traspasoDotacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraspasoDotacion  $traspasoDotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraspasoDotacion $traspasoDotacion)
    {
        $traspasoDotacion->name = $request->name;
        $traspasoDotacion->save();
        return $traspasoDotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraspasoDotacion  $traspasoDotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraspasoDotacion $traspasoDotacion)
    {
        $traspasoDotacion->estado = 0;
        $traspasoDotacion->save();
    }
    public function pdf(TraspasoDotacion $traspasoDotacion)
    {
        $traspasoDotacion = $this->show($traspasoDotacion);

        $pdf = Pdf::loadView('reportes.pdf.dotacion.traspaso', ["traspaso"=>$traspasoDotacion]);
        return $pdf->stream();
    }
    public function pdfTicket(TraspasoDotacion $traspasoDotacion)
    {
        $traspasoDotacion = $this->show($traspasoDotacion);

        $pdf = Pdf::loadView('reportes.pdf.dotacion.traspaso-ticket', ["traspaso"=>$traspasoDotacion])->setPaper(
            [0, 0, 220, 550],
        );
        return $pdf->stream();
    }
}
