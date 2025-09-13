<?php

namespace App\Http\Controllers;

use App\Models\DetallePt;
use App\Models\DetallePtDescomposicion;
use Illuminate\Http\Request;

class DetallePtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetallePt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detallePt = new DetallePt();
        $detallePt->name = $request->name;
        $detallePt->save();
        return $detallePt;
    }
    public function descomponer(DetallePt $detallePt,Request $request)
    {
        $detallePt->descomponer = 0;
        $detallePt->back = 0;
        $detallePt->save();
        foreach ($request->compo_externas as $compo) {
            $DetallePtDescomposicion = new DetallePtDescomposicion();
            $DetallePtDescomposicion->cantidad = $detallePt->pollos;
            $DetallePtDescomposicion->precio_venta =0;
            $DetallePtDescomposicion->peso_total = 0;
            $DetallePtDescomposicion->detalle_pt_id = $detallePt->id;
            $DetallePtDescomposicion->pt_id = $detallePt->pt_id;
            $DetallePtDescomposicion->compo_externa_id = $compo['id'];
            $DetallePtDescomposicion->save();
        }
        // $loteTrozadoPp = new LoteTrozadoPp();
        // $loteTrozadoPp->lote_id = $DetallePt->lote_id;
        // $loteTrozadoPp->pp_detalle_id = $DetallePt->id;
        // $loteTrozadoPp->save();
        // $DetallePt->url_pdf = url('reportes/loteTrozadoPps/'.$loteTrozadoPp->id);
        return $detallePt;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetallePt  $detallePt
     * @return \Illuminate\Http\Response
     */
    public function show(DetallePt $detallePt)
    {
        
        return $detallePt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetallePt  $detallePt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePt $detallePt)
    {
        $detallePt->name = $request->name;
        $detallePt->save();
        return $detallePt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallePt  $detallePt
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallePt $detallePt)
    {
        $detallePt->estado = 0;
        $detallePt->save();
    }
}
