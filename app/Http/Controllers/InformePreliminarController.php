<?php

namespace App\Http\Controllers;

use App\Models\InformeDetalle;
use App\Models\InformePreliminar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InformePreliminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $model = InformePreliminar::with(['Sucursal','User'])->where('estado',1)->get();
        $list = [];
        foreach ($model as  $value) {
            $value->url_pdf = url('reportes/informePreliminars/'.$value->id);
            $list[] = $value;
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
        $informePreliminar = new InformePreliminar();
        $informePreliminar->dia = $request->dia;
        $informePreliminar->observacion = $request->observacion;
        $informePreliminar->sucursal_id = $request->sucursal_id;
        $informePreliminar->user_id = $request->user_id;
        $informePreliminar->kg = $request->kg;
        $informePreliminar->cajas = $request->cajas;
        $informePreliminar->cant = $request->cant;
        $informePreliminar->pollos = $request->pollos;
        $informePreliminar->fecha = date('Y-m-d');
        $informePreliminar->save();
        foreach ($request->detalles as $compo_externa) {
            $informeDetalle = new InformeDetalle();
            $informeDetalle->informe_preliminar_id = $informePreliminar->id;
            $informeDetalle->compo_externa_id = $compo_externa['id'];
            $informeDetalle->cupo = $compo_externa['cupo']['cupo'];
            $informeDetalle->cupo_dia = $compo_externa['cupo']['dia'];
            $informeDetalle->cupo_fit = $compo_externa['cupos_fil'];
            $informeDetalle->total_cupo_fit = $compo_externa['total_cupo_fit'];
            $informeDetalle->peso = $compo_externa['peso'];
            $informeDetalle->save();

        }
        $informePreliminar->url_pdf = url('reportes/informePreliminars/'.$informePreliminar->id);
        return $informePreliminar;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InformePreliminar  $informePreliminar
     * @return \Illuminate\Http\Response
     */
    public function show(InformePreliminar $informePreliminar)
    {
        $informePreliminar->sucursal = $informePreliminar->Sucursal;
        $informePreliminar->user = $informePreliminar->User;
        $informePreliminar->detalles = $informePreliminar->InformeDetalles()->get();
       
        return $informePreliminar;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformePreliminar  $informePreliminar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformePreliminar $informePreliminar)
    {
        $informePreliminar->name = $request->name;
        $informePreliminar->save();
        return $informePreliminar;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformePreliminar  $informePreliminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformePreliminar $informePreliminar)
    {
        $informePreliminar->estado = 0;
        $informePreliminar->save();
    }
    public function pdf(InformePreliminar $informePreliminar)
    {
        $informePreliminar = $this->show($informePreliminar);

    $pdf = Pdf::loadView('reportes.pdf.informePreliminar', ["informePreliminar"=>$informePreliminar]);
    return $pdf->stream();
    }
}
