<?php

namespace App\Http\Controllers;

use App\Models\Cogplanilla;
use App\Models\Liquidacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if($id!="all"){
            $liquidacion = Liquidacion::with(['Contrato','Sucursal','User'])->where('contrato_id',$id)->where('estado',1)->get();
            $list = [];
            foreach($liquidacion as $s){
                $s->cog_planilla = Cogplanilla::find(1);
                $s->url_pdf = url("reportes/liquidacions/$s->id");
    
                
                $list[]=$s;
            }
            return $list;
          
        }else{
            return $this->index();
        }
    }
    public function index()
    {
        $liquidacion = Liquidacion::with(['Contrato','Sucursal','User'])->where('estado',1)->get();
        $list = [];
        foreach($liquidacion as $s){
            $s->cog_planilla = Cogplanilla::find(1);
            $s->url_pdf = url("reportes/liquidacions/$s->id");

            
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
        $liquidacion = new Liquidacion();
        $liquidacion->contrato_id = $request->contrato_id;
        $liquidacion->sucursal_id = 1;
        $liquidacion->user_id = 1;
        $liquidacion->fecha = Carbon::now()->format("Y-m-d");
        $liquidacion->inicio = $request->inicio;
        $liquidacion->fin = $request->hoy;
        $liquidacion->dia = $request->dias;
        $liquidacion->mes = $request->meses;
        $liquidacion->sueldo_mensual = $request->sueldo_bruto;
        $liquidacion->sueldo_diario = $request->sueldo_diario;
        $liquidacion->sueldo_bruto = $request->sueldo_neto;
        $liquidacion->save();
        $liquidacion->url_pdf = url("reportes/liquidacions/$liquidacion->id");
        return $liquidacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacion $liquidacion)
    {
        $liquidacion->sucursal = $liquidacion->Sucursal;
            // $liquidacion->sucursal->image = $liquidacion->sucursal->imagesucursal->File();
            // $liquidacion->sucursal->image->url = url_path().$liquidacion->sucursal->image->path;
            $sum = 0;
            foreach($liquidacion->Contrato->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
       
            }
            $liquidacion->sucursal->file_sucursals = $liquidacion->sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $liquidacion->sucursal->image = $liquidacion->sucursal->file_sucursals->first();
           
            $liquidacion->contratocostos_sum = $sum;
            $liquidacion->contrato = $liquidacion->Contrato;
            $liquidacion->user = $liquidacion->User;
            return $liquidacion;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        $liquidacion->name = $request->name;
        $liquidacion->save();
        return $liquidacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        $liquidacion->estado = 0;
        $liquidacion->save();
    }
    public function pdf(Liquidacion $liquidacion)
    {
        $liquidacion = $this->show($liquidacion);

    $pdf = Pdf::loadView('reportes.pdf.liquidacion', ["liquidacion"=>$liquidacion]);
    return $pdf->stream();
    }
}
