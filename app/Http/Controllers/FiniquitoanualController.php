<?php

namespace App\Http\Controllers;

use App\Models\Finianualdetalle;
use App\Models\Finiquitoanual;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FiniquitoanualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if($id!="all"){
            $model = Finiquitoanual::with(['Contrato','User'])->where('contrato_id',$id)->where('estado',1)->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/finiquitoanuals/$s->id");
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
            $model = Finiquitoanual::with(['Contrato','User'])->where('estado',1)->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/finiquitoanuals/$s->id");
                $s->mes = $this->mes($s->fecha);
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
        $finiquitoanual = new Finiquitoanual();
            $finiquitoanual->contrato_id = $request->contrato_id;
            $finiquitoanual->user_id = $request->user_id;
            $finiquitoanual->sucursal_id = 1;
            $finiquitoanual->pago = $request->pago;
            $finiquitoanual->fecha = $request->fechainicio;
            $finiquitoanual->save();
            foreach($request->planillas as $c){
                $Finianualdetalle = new Finianualdetalle();
                $Finianualdetalle->finiquitoanual_id = $finiquitoanual->id;
                $Finianualdetalle->planilla_id = $c['id'];
                $Finianualdetalle->save();

            }
            

            $finiquitoanual->url_pdf = url("reportes/finiquitoanuals/$finiquitoanual->id");
            return $finiquitoanual;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finiquitoanual  $finiquitoanual
     * @return \Illuminate\Http\Response
     */
    public function show(Finiquitoanual $finiquitoanual)
    {
        
       
        $finiquitoanual->detalle = $finiquitoanual->Finianualdetalles()->get();
        $finiquitoanual->sucursal = $finiquitoanual->Sucursal;

        // $finiaguinaldo->sucursal->image = $finiaguinaldo->sucursal->imagesucursal->File();
        // $finiaguinaldo->sucursal->image->url = url_path().$finiaguinaldo->sucursal->image->path;
        $finiquitoanual->sucursal->file_sucursals = $finiquitoanual->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $finiquitoanual->sucursal->image = $finiquitoanual->sucursal->file_sucursals->first();
        $finiquitoanual->contrato = $finiquitoanual->Contrato;
        $finiquitoanual->emision = Carbon::now()->format('Y-m-d');
        $list=[];
        foreach($finiquitoanual->detalle as $c){
           
            $c->sd = "as";
            $c->planilla = $c->Planilla;
            $c->mes = $this->mes($c->planilla->desde);
            $list[] = $c;

        }
        $finiquitoanual->detalles =$list;
        // $finiquitoanual->detalle2 =$finiquitoanual->detalle->demos();
        return $finiquitoanual;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finiquitoanual  $finiquitoanual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finiquitoanual $finiquitoanual)
    {
        $finiquitoanual->name = $request->name;
        $finiquitoanual->save();
        return $finiquitoanual;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finiquitoanual  $finiquitoanual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finiquitoanual $finiquitoanual)
    {
        $finiquitoanual->estado = 0;
        $finiquitoanual->save();
    }
    public function pdf(Finiquitoanual $finiquitoanual)
    {
        $finiquitoanual = $this->show($finiquitoanual);

    $pdf = Pdf::loadView('reportes.pdf.finiquito.anual', ["finiquito"=>$finiquitoanual]);
    return $pdf->stream();
    }
}
