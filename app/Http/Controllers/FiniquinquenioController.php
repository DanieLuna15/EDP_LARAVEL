<?php

namespace App\Http\Controllers;

use App\Models\Finianualdetalle;
use App\Models\Finiquinquenio;
use App\Models\Finiquinqueniodetalle;
use App\Models\Finiquitoanual;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FiniquinquenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $model = Finiquinquenio::with(['Contrato'])->where('estado',1)->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/finiquinquenios/$s->id");
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
    public function store(Request $request,)
    {
        $finiquinquenio = new Finiquinquenio();
        $finiquinquenio->contrato_id = $request->contrato_id;
        $finiquinquenio->user_id = $request->user_id;
        $finiquinquenio->sucursal_id = 1;
        $finiquinquenio->pago =  $request->pago;
        $finiquinquenio->fecha = $request->fecha;
        $finiquinquenio->save();
        $finiquinquenio->url_pdf = url("reportes/finiquinquenios/$finiquinquenio->id");
        $finiquitoanual = new Finiquitoanual();
        $finiquitoanual->contrato_id = $request->contrato_id;
        $finiquitoanual->sucursal_id = 1;
        $finiquitoanual->pago = $request->pago;
        $finiquitoanual->fecha = $request->fecha;
        $finiquitoanual->save();
        foreach($request->planillas as $c){
            $Finianualdetalle = new Finianualdetalle();
            $Finianualdetalle->finiquitoanual_id = $finiquitoanual->id;
            $Finianualdetalle->planilla_id = $c->id;
            $Finianualdetalle->save();
            $Finiquinqueniodetalle = new Finiquinqueniodetalle();
            $Finiquinqueniodetalle->finiquinquenio_id = $finiquinquenio->id;
            $Finiquinqueniodetalle->planilla_id = $c->id;
            $Finiquinqueniodetalle->save();

        }
        return $finiquinquenio;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finiquinquenio  $finiquinquenio
     * @return \Illuminate\Http\Response
     */
    public function show(Finiquinquenio $finiquinquenio)
    {
        
        return $finiquinquenio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finiquinquenio  $finiquinquenio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finiquinquenio $finiquinquenio)
    {
        $finiquinquenio->name = $request->name;
        $finiquinquenio->save();
        return $finiquinquenio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finiquinquenio  $finiquinquenio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finiquinquenio $finiquinquenio)
    {
        $finiquinquenio->estado = 0;
        $finiquinquenio->save();
    }
}
