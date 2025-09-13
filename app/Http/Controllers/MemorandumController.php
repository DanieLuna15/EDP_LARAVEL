<?php

namespace App\Http\Controllers;

use App\Models\Memorandum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class MemorandumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
        public function index()
        {
            $model = Memorandum::with(['Contrato','User','Sucursal','Motivomemorandum'])->get();
            $list = [];
            foreach($model as $s){
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->url_pdf = url("reportes/memorandums/$s->id");
   
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
        $memorandum = new Memorandum();
        $memorandum->user_id = $request->user_id;
        $memorandum->sucursal_id = 1;
        $memorandum->contrato_id = $request->contrato_id;
        $memorandum->fecha = $request->fechamemorandums;
        $memorandum->motivomemorandum_id = $request->motivomemorandum_id;
        $memorandum->descripciom = $request->descripcion;
        $memorandum->save();
        $memorandum->url_pdf = url("reportes/memorandums/$memorandum->id");
        return $memorandum;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorandum  $memorandum
     * @return \Illuminate\Http\Response
     */
    public function show(Memorandum $memorandum)
    {
        $memorandum->user =  $memorandum->User;
        $memorandum->contrato =  $memorandum->Contrato;
        $memorandum->sucursal =  $memorandum->Sucursal;
        $memorandum->sucursal->file_sucursals = $memorandum->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $memorandum->sucursal->image = $memorandum->sucursal->file_sucursals->first();
        $memorandum->motivomemorandum =  $memorandum->Motivomemorandum;
        return $memorandum;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memorandum  $memorandum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memorandum $memorandum)
    {
        $memorandum->name = $request->name;
        $memorandum->save();
        return $memorandum;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memorandum  $memorandum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memorandum $memorandum)
    {
        $memorandum->estado = 0;
        $memorandum->save();
    }
    public function pdf(Memorandum $memorandum)
    {
        $memorandum = $this->show($memorandum);

    $pdf = Pdf::loadView('reportes.pdf.memorandum', ["memorandum"=>$memorandum]);
    return $pdf->stream();
    }
}
