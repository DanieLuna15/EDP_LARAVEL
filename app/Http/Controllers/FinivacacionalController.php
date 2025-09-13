<?php

namespace App\Http\Controllers;

use App\Models\Finivacacional;
use App\Models\Finivacacionaldetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FinivacacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if($id!="all"){
            $model = Finivacacional::with(['Contrato'])->where('contrato_id',$id)->where('estado',1)->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/finivacacionals/$s->id");
                $s->mes_fin = $this->mes($s->fecha_fin);
                $s->mes_inicio = $this->mes($s->fecha_inicio);
                $list[]=$s;
            }
            return $list;
          
        }else{
            return $this->index();
        }
    }
    public function index()
    {
        $model = Finivacacional::with(['Contrato'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->url_pdf = url("reportes/finivacacionals/$s->id");
            $s->mes_fin = $this->mes($s->fecha_fin);
            $s->mes_inicio = $this->mes($s->fecha_inicio);
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
        $finivacacional = new Finivacacional();
        $finivacacional->fecha_inicio = $request->fecha_inicio;
        $finivacacional->fecha_fin = $request->fechaInicio;
        $finivacacional->user_id = $request->user_id;
        $finivacacional->pago = $request->pago;
        $finivacacional->planilla = $request->planilla_estado;
        $finivacacional->contrato_id = $request->contrato_id;
        $finivacacional->sucursal_id = 1;
        $finivacacional->save();
        foreach($request->planillas as $c){
            $Finivacacionaldetalle = new Finivacacionaldetalle();
            $Finivacacionaldetalle->finivacacional_id = $finivacacional->id;
            $Finivacacionaldetalle->planilla_id = $c['id'];
            $Finivacacionaldetalle->save();

        }
        $finivacacional->url_pdf = url("reportes/finivacacionals/$finivacacional->id");
        return $finivacacional;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finivacacional  $finivacacional
     * @return \Illuminate\Http\Response
     */
    public function show(Finivacacional $finivacacional)
    {

    

     
            $finivacacional->sucursal = $finivacacional->Sucursal;
            $finivacacional->sucursal->file_sucursals = $finivacacional->sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $finivacacional->sucursal->image = $finivacacional->sucursal->file_sucursals->first();
            // $finivacacional->sucursal->image = $finivacacional->sucursal->imagesucursal->File();
            // $finivacacional->sucursal->image->url = url_path().$finivacacional->sucursal->image->path;
            $finivacacional->contrato = $finivacacional->Contrato;
            $finivacacional->emision = Carbon::now()->format('Y-m-d');
            $list=[];
            foreach( $finivacacional->Finivacacionaldetalles()->get() as $c){
               
                $c->sd = "as";
                $c->planilla = $c->Planilla;
                $c->mes = $this->mes($c->planilla->desde);
                $list[] = $c;

            }
            $finivacacional->detalles = $list;
            return $finivacacional;
        }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finivacacional  $finivacacional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finivacacional $finivacacional)
    {
        $finivacacional->name = $request->name;
        $finivacacional->save();
        return $finivacacional;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finivacacional  $finivacacional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finivacacional $finivacacional)
    {
        $finivacacional->estado = 0;
        $finivacacional->save();
    }
    public function pdf(Finivacacional $finivacacional)
    {
        $finivacacional = $this->show($finivacacional);

    $pdf = Pdf::loadView('reportes.pdf.finiquito.vacacional', ["finiquito"=>$finivacacional]);
    return $pdf->stream();
    }
}
