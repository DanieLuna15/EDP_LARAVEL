<?php

namespace App\Http\Controllers;

use App\Models\CompoExterna;
use App\Models\PtDetalleDescomposicion;
use App\Models\PtDetalleSubDescomposicion;
use Illuminate\Http\Request;

class PtDetalleSubDescomposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PtDetalleSubDescomposicion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pt_detalledescomposci = PtDetalleDescomposicion::find($request->id);
        $pt_detalledescomposci->trozado = 1;
        $pt_detalledescomposci->save();
        // $compoExterna = CompoExterna::find($request->compo_externa_id);
        // $compoExterna->compo_externa_detalles = $compoExterna->CompoExternaDetalles()->get();
        // $lis = [];
        // foreach($compoExterna->compo_externa_detalles as $d){
        //     $ptDetalleSubDescomposicion = new PtDetalleSubDescomposicion();
        //     $ptDetalleSubDescomposicion->cantidad = $request->cantidad*$compoExterna->cantidad;
        //     $ptDetalleSubDescomposicion->precio_venta = $request->precio_venta;
        //     $ptDetalleSubDescomposicion->peso_total = $request->peso_total;
        //     $ptDetalleSubDescomposicion->pt_detalle_descomposicion_id = $request->id;
        //     $ptDetalleSubDescomposicion->compo_externa_detalle_id = $d->id;
        //     $ptDetalleSubDescomposicion->pt_detalle_id = $request->pt_detalle_id;
        //     $ptDetalleSubDescomposicion->save();
            
        // }
        return $pt_detalledescomposci;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtDetalleSubDescomposicion  $ptDetalleSubDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function show(PtDetalleSubDescomposicion $ptDetalleSubDescomposicion)
    {
        
        return $ptDetalleSubDescomposicion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PtDetalleSubDescomposicion  $ptDetalleSubDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PtDetalleSubDescomposicion $ptDetalleSubDescomposicion)
    {
        $ptDetalleSubDescomposicion->name = $request->name;
        $ptDetalleSubDescomposicion->save();
        return $ptDetalleSubDescomposicion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtDetalleSubDescomposicion  $ptDetalleSubDescomposicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtDetalleSubDescomposicion $ptDetalleSubDescomposicion)
    {
        $ptDetalleSubDescomposicion->estado = 0;
        $ptDetalleSubDescomposicion->save();
    }
}
