<?php

namespace App\Http\Controllers;

use App\Models\Cogplanilla;
use App\Models\Contrato;
use App\Models\Contratocosto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contrato = Contrato::with(['Persona','Area','Tipocontrato','Sucursal','Adeudas'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->planilla = $s->Planilla;
            $s->desde = Carbon::parse($s->inicio)->format('Y-m-d');
            if( $s->planilla!=null){
                $s->desde = $s->planilla->hasta;                  
            }    
            $s->hasta = Carbon::parse($s->desde)->addMonth()->format('Y-m-d');
            $s->mes = $this->mes($s->desde);
            $s->apto = Carbon::parse($s->hasta)->lessThanOrEqualTo(Carbon::now());
            $s->fincontrato = Carbon::parse($s->hasta)->diffInMonths(Carbon::parse($s->fin));
            $percent = $sum/100;
            $s->sueldo_bruto = number_format(floatval($s->sueldo)-(floatval($s->sueldo)*$percent),2);
            $s->finivacacionals = $s->Finivacacionals()->get();
            $s->contratocostos = $contratos;
            // $s->cog_planilla = Cogplanilla::find(1);
            $s->cog_planilla = Cogplanilla::find(1);
            $s->url_pdf = url("reportes/contratos/$s->id");
            $s->contratocostos_sum = $sum;
            
            $list[]=$s;
        }
        return $list;
    }
    public function Liquidacions()
    {
     
        $Contrato = Contrato::with(['Persona','Area','Sucursal','Tipocontrato','Contratocostos'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->contratocostos = $contratos;
            $s->liquidacion = $s->Liquidacion;
            if($s->liquidacion!=null){
                $s->inicio = Carbon::parse($s->liquidacion->fecha)->format('Y-m-d');
            }  
            $meses = Carbon::now()->diffInMonths(Carbon::parse($s->inicio));
            $s->meses = Carbon::now()->diffInMonths(Carbon::parse($s->inicio));
            $fecha_mes = Carbon::parse($s->inicio)->addMonths($meses);
            $s->dias = Carbon::now()->diffInDays(Carbon::parse($fecha_mes));
            $s->hoy = Carbon::now()->format("Y-m-d");
            $s->cog_planilla = Cogplanilla::find(1);
            $s->contratocostos_sum = $sum;
            $percent = $sum/100;
            $sueldo_bruto=floatval($s->sueldo);
            $s->sueldo_diario = floatval($sueldo_bruto)/$s->cog_planilla->dias_base;
            $s->sueldo_bruto = $sueldo_bruto;
   
    

            $s->url_pdf = url("reportes/contratos/$s->id");
            
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
        $contrato = new Contrato();
        $contrato->user_id = $request->user_id;
        $contrato->persona_id = $request->persona_id;
        $contrato->tipocontrato_id = $request->tipocontrato_id;
        $contrato->area_id = $request->area_id;
        $contrato->sueldo = $request->sueldo;
        $contrato->servicio = $request->servicio;
        $contrato->inicio = Carbon::parse($request->inicio)->format('Y-m-d');
        $contrato->fin = Carbon::parse($request->fin)->format('Y-m-d');
        $contrato->terminos = $request->terminos;
        $contrato->sucursal_id = 1;
        $contrato->save();
        foreach($request->costos as $c){
            $Contratocosto = new Contratocosto();
            $Contratocosto->contrato_id = $contrato->id;
            $Contratocosto->costofijo_id = $c['id'];
            $Contratocosto->save();

        }
        $contrato->url_pdf = url("reportes/contratos/$contrato->id");
        return $contrato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        $contrato->user = $contrato->User;
        $contrato->persona = $contrato->Persona;
        $contrato->area = $contrato->Area;
        $contrato->sucursal = $contrato->Sucursal;
        $contrato->tipocontrato = $contrato->Tipocontrato;
        $contrato->detalles = $contrato->Contratocostos()->get();
        $contrato->sucursal->file_sucursals = $contrato->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $contrato->sucursal->image = $contrato->sucursal->file_sucursals->first();
        $contrato->persona->file_personas = $contrato->persona->Filepersonas()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $contrato->persona->image = $contrato->persona->file_personas->first();
        // $contrato->sucursal = $contrato->Sucursal();
        // $contrato->sucursal->image = $contrato->sucursal->imagesucursal->File();
        // $contrato->sucursal->image->url = url_path().$contrato->sucursal->image->path;
        $sum=0;
        foreach($contrato->Contratocostos()->get() as $c){
            $c->costofijo = $c->Costofijo;
            $sum+=floatval($c->costofijo->monto);
 
        }
        $contrato->contratocostos_sum = $sum;
    
        $percent = $sum/100;
        $contrato->sueldo_bruto = number_format(floatval($contrato->sueldo)-(floatval($contrato->sueldo)*$percent),2);
        $contrato->inicio = Carbon::parse($contrato->inicio)->format('Y-m-d');
        $contrato->fin = Carbon::parse($contrato->fin)->format('Y-m-d');
        $contrato->url_pdf = url("reportes/contratos/$contrato->id");
        return $contrato;
 
    }
    public function finiquitoAnual()
    {
     
        $Contrato = Contrato::with(['Persona','Area','Sucursal','Tipocontrato','Contratocostos'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->contratocostos = $contratos;
            $s->finiquitoanual = $s->Finiquitoanual;
            if($s->finiquitoanual!=null){
                $s->inicio = Carbon::parse($s->finiquitoanual->fecha)->format('Y-m-d');
            }  
            $s->planilla_lista = $s->Planillas()->whereBetween('desde',[$s->inicio,Carbon::now()->format('Y-m-d')])->limit(12)->get()->each(function($planilla){
                $planilla->mes = $this->mes($planilla->desde);
            });
            // $s->planilla_lista = $s->Planillas($s->inicio,,'desde')->limit(12);
            $s->url_pdf = url("reportes/contratos/$s->id");
            $s->contratocostos_sum = $sum;
            
            $list[]=$s;
        }
        return $list;
    }
    public function finiquitoQuinquenio()
    {
     
        $Contrato = Contrato::with(['Persona','Area','Sucursal','Tipocontrato','Contratocostos'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->contratocostos = $contratos;
            $s->finiquitoanual = $s->Finiquitoanual;
            if($s->finiquitoanual!=null){
                $s->inicio = Carbon::parse($s->finiquitoanual->fecha)->format('Y-m-d');
            }  
            $s->planilla_lista = $s->Planillas()->whereBetween('desde',[$s->inicio,Carbon::now()->format('Y-m-d')])->limit(60)->get()->each(function($planilla){
                $planilla->mes = $this->mes($planilla->desde);
            });
            $s->url_pdf = url("reportes/contratos/$s->id");
            $s->contratocostos_sum = $sum;
            
            $list[]=$s;
        }
        return $list;
    
    }
    public function finiquitoVacacional()
    {
     
        $Contrato = Contrato::with(['Persona','Area','Sucursal','Tipocontrato','Contratocostos'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->contratocostos = $contratos;
            $s->finivacacional = $s->Finivacacional;
            if($s->finivacacional!=null){
                $s->inicio = Carbon::parse($s->finivacacional->fecha_fin)->format('Y-m-d');
            }  
            $s->cog_planilla = Cogplanilla::find(1);
            $s->planilla_lista = $s->Planillas()->whereBetween('desde',[$s->inicio,Carbon::now()->format('Y-m-d')])->get()->each(function($planilla){
                $planilla->mes = $this->mes($planilla->desde);
            });
            $s->url_pdf = url("reportes/contratos/$s->id");
            $s->contratocostos_sum = $sum;
            
            $list[]=$s;
        }
        return $list;
    }
    public function finiquitoAguinaldo()
    {
     
        $Contrato = Contrato::with(['Persona','Area','Sucursal','Tipocontrato','Contratocostos'])->where('estado',1)->get();
        $list = [];
        foreach($Contrato as $s){

            $contratos = []; 
            $sum=0;
            foreach($s->Contratocostos()->get() as $c){
                $c->costofijo = $c->Costofijo;
                $sum+=floatval($c->costofijo->monto);
                $contratos[]=$c;
            }
            $s->contratocostos = $contratos;
            $s->finiaguinaldo = $s->Finiaguinaldo;
            if($s->finiaguinaldo!=null){
                $s->inicio = Carbon::parse($s->finiaguinaldo->fecha)->format('Y-m-d');
            }  
            $s->cog_planilla = Cogplanilla::find(1);
            $s->planilla_lista = $s->Planillas()->whereBetween('desde',[$s->inicio,Carbon::now()->format('Y-m-d')])->get()->each(function($planilla){
                $planilla->mes = $this->mes($planilla->desde);
            });
            $s->url_pdf = url("reportes/contratos/$s->id");
            $s->contratocostos_sum = $sum;
            
            $list[]=$s;
        }
        return $list;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {
        $contrato->user_id =1;
           
        $contrato->tipocontrato_id = $request->tipocontrato_id;
        $contrato->area_id = $request->area_id;
        $contrato->sueldo = $request->sueldo;
        $contrato->servicio = $request->servicio;
        $contrato->inicio = Carbon::parse($request->inicio)->format('Y-m-d');
        $contrato->fin = Carbon::parse($request->fin)->format('Y-m-d');
        $contrato->terminos = $request->terminos;
        $contrato->sucursal_id = 1;
        $contrato->save();
        return $contrato;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        $contrato->estado = 0;
        $contrato->save();
    }
    public function pdf(Contrato $contrato)
    {
        $contrato = $this->show($contrato);

    $pdf = Pdf::loadView('reportes.pdf.contrato', ["contrato"=>$contrato]);
    return $pdf->stream();
    }
}
