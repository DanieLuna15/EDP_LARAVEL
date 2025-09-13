<?php

namespace App\Http\Controllers;

use App\Models\DetallePp;
use App\Models\DetallePpDescomposicion;
use Illuminate\Http\Request;

class DetallePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DetallePp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detallePp = new DetallePp();
        $detallePp->name = $request->name;
        $detallePp->save();
        return $detallePp;
    }
    public function descomponer(DetallePp $detallePp,Request $request)
    {
        $detallePp->descomponer = 0;
        $detallePp->back = 0;
        $detallePp->save();
        foreach ($request->compo_internas as $compo) {
            $DetallePpDescomposicion = new DetallePpDescomposicion();
            $DetallePpDescomposicion->cantidad = $detallePp->pollos;
            $DetallePpDescomposicion->precio_venta =0;
            $DetallePpDescomposicion->peso_total = 0;
            $DetallePpDescomposicion->detalle_pp_id = $detallePp->id;
            $DetallePpDescomposicion->pp_id = $detallePp->pp_id;
            $DetallePpDescomposicion->compo_interna_id = $compo['id'];
            $DetallePpDescomposicion->save();
        }
        // $loteTrozadoPp = new LoteTrozadoPp();
        // $loteTrozadoPp->lote_id = $DetallePp->lote_id;
        // $loteTrozadoPp->pp_detalle_id = $DetallePp->id;
        // $loteTrozadoPp->save();
        // $DetallePp->url_pdf = url('reportes/loteTrozadoPps/'.$loteTrozadoPp->id);
        return $detallePp;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetallePp  $detallePp
     * @return \Illuminate\Http\Response
     */
    public function show(DetallePp $detallePp)
    {
        
        return $detallePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetallePp  $detallePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallePp $detallePp)
    {
        $detallePp->name = $request->name;
        $detallePp->save();
        return $detallePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallePp  $detallePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallePp $detallePp)
    {
        $detallePp->estado = 0;
        $detallePp->save();
    }
}
