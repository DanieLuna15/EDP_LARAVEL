<?php

namespace App\Http\Controllers;

use App\Models\Finiaguinaldo;
use App\Models\Finiaguinaldodetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FiniaguinaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if($id!="all"){
            $model = Finiaguinaldo::with(['Contrato'])->where('contrato_id',$id)->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->meses = $s->Finiaguinaldodetalles()->get()->count();
            $s->url_pdf = url("reportes/finiaguinaldos/$s->id");
            $s->mes = $this->mes($s->fecha);
            $list[]=$s;
        }
        return $list;
          
        }else{
            return $this->index();
        }
    }
    public function index()
    {
        $model = Finiaguinaldo::with(['Contrato'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->meses = $s->Finiaguinaldodetalles()->get()->count();
            $s->url_pdf = url("reportes/finiaguinaldos/$s->id");
            $s->mes = $this->mes($s->fecha);
            $list[]=$s;
        }
        return $list;
    }
    public function mes($fecha)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finiaguinaldo = new Finiaguinaldo();
        $finiaguinaldo->user_id = $request->user_id;
            $finiaguinaldo->contrato_id = $request->contrato_id;
            $finiaguinaldo->sucursal_id = 1;
            $finiaguinaldo->pago =  $request->pago;
            $finiaguinaldo->fecha = $request->fecha;
        $finiaguinaldo->save();
        foreach($request->planillas as $c){
            $Finiaguinaldodetalle = new Finiaguinaldodetalle();
            $Finiaguinaldodetalle->finiaguinaldo_id = $finiaguinaldo->id;
            $Finiaguinaldodetalle->planilla_id = $c['id'];
            $Finiaguinaldodetalle->save();

        }
        $finiaguinaldo->url_pdf = url("reportes/finiaguinaldos/$finiaguinaldo->id");
        return $finiaguinaldo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finiaguinaldo  $finiaguinaldo
     * @return \Illuminate\Http\Response
     */
    public function show(Finiaguinaldo $finiaguinaldo)
    {

    

     
            $finiaguinaldo->sucursal = $finiaguinaldo->Sucursal;
            // $finiaguinaldo->sucursal->image = $finiaguinaldo->sucursal->imagesucursal->File();
            // $finiaguinaldo->sucursal->image->url = url_path().$finiaguinaldo->sucursal->image->path;
            $finiaguinaldo->sucursal->file_sucursals = $finiaguinaldo->sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $finiaguinaldo->sucursal->image = $finiaguinaldo->sucursal->file_sucursals->first();
            $finiaguinaldo->contrato = $finiaguinaldo->Contrato;
            $finiaguinaldo->emision = Carbon::now()->format('Y-m-d');
            $list=[];
            foreach( $finiaguinaldo->Finiaguinaldodetalles()->get() as $c){
               
                $c->sd = "as";
                $c->planilla = $c->Planilla;
                $c->mes = $this->mes($c->planilla->desde);
                $list[] = $c;

            }
            $finiaguinaldo->detalle = $list;
            return $finiaguinaldo;
        }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finiaguinaldo  $finiaguinaldo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finiaguinaldo $finiaguinaldo)
    {
        $finiaguinaldo->name = $request->name;
        $finiaguinaldo->save();
        return $finiaguinaldo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finiaguinaldo  $finiaguinaldo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finiaguinaldo $finiaguinaldo)
    {
        $finiaguinaldo->estado = 0;
        $finiaguinaldo->save();
    }
    public function pdf(Finiaguinaldo $finiaguinaldo)
    {
        $finiaguinaldo = $this->show($finiaguinaldo);

    $pdf = Pdf::loadView('reportes.pdf.finiquito.aguinaldo', ["finiquito"=>$finiaguinaldo]);
    return $pdf->stream();
    }
}
