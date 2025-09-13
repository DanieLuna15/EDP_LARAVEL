<?php

namespace App\Http\Controllers;

use App\Models\DescomponerPt;
use App\Models\ItemsPt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DescomponerPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DescomponerPt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());
        $descomponerPt = new DescomponerPt();
        $descomponerPt->fecha = Carbon::now()->format('Y-m-d');
        $descomponerPt->pt_id = $request->pt_id;
        $descomponerPt->cajas = $request->cajas;
        $descomponerPt->pollos = $request->pollos;
        $descomponerPt->peso_bruto = $request->peso_bruto;
        $descomponerPt->peso_neto = $request->peso_neto;
        $descomponerPt->save();
        foreach ($request->items_sobra as $item) {
            $itemsPt = new ItemsPt();
            $itemsPt->fecha = Carbon::now()->format('Y-m-d');
            $itemsPt->pt_id = $request->pt_id;
            $itemsPt->descomponer_pt_id = $descomponerPt->id;
            $itemsPt->item_id = $item['id'];
            $itemsPt->cajas = $item['cajas'];
            $itemsPt->taras = $item['taras'];
            $itemsPt->peso_bruto = $item['peso_bruto'];
            $itemsPt->peso_neto = $item['peso_neto'];
            $itemsPt->recep = $item['recep'];
            $itemsPt->tipo = 3;
            $itemsPt->save();
        }
        return $descomponerPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescomponerPt  $descomponerPt
     * @return \Illuminate\Http\Response
     */
    public function show(DescomponerPt $descomponerPt)
    {

        return $descomponerPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DescomponerPt  $descomponerPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DescomponerPt $descomponerPt)
    {
        $descomponerPt->name = $request->name;
        $descomponerPt->save();
        return $descomponerPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescomponerPt  $descomponerPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescomponerPt $descomponerPt)
    {
        $descomponerPt->estado = 0;
        $descomponerPt->save();
    }
}
