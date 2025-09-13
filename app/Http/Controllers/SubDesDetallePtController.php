<?php

namespace App\Http\Controllers;

use App\Models\SubDesDetallePt;
use Illuminate\Http\Request;

class SubDesDetallePtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubDesDetallePt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subDesDetallePt = new SubDesDetallePt();
        $subDesDetallePt->equivale = $request->equivale;
        $subDesDetallePt->cantidad = $request->cantidad;
        $subDesDetallePt->peso_total = $request->peso;
        $subDesDetallePt->compo_externa_detalle_id = $request->compo_externa_detalle_id;
        $subDesDetallePt->detalle_pt_descomposicion_id = $request->sub_descomponer['id'];
        $subDesDetallePt->detalle_pt_id = $request->sub_descomponer['detalle_pt_id'];
        $subDesDetallePt->save();
        $subDesDetallePt->url_pdf = url('reportes/subDesDetallePts/'.$subDesDetallePt->id);
        return $subDesDetallePt;
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubDesDetallePt  $subDesDetallePt
     * @return \Illuminate\Http\Response
     */
    public function show(SubDesDetallePt $subDesDetallePt)
    {
        
        return $subDesDetallePt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubDesDetallePt  $subDesDetallePt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubDesDetallePt $subDesDetallePt)
    {
        $subDesDetallePt->name = $request->name;
        $subDesDetallePt->save();
        return $subDesDetallePt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubDesDetallePt  $subDesDetallePt
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDesDetallePt $subDesDetallePt)
    {
        $subDesDetallePt->estado = 0;
        $subDesDetallePt->save();
    }
}
