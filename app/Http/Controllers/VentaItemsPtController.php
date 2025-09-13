<?php

namespace App\Http\Controllers;

use App\Models\VentaItemsPt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentaItemsPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaItemsPt::with(['Item','Venta'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fechas(Request $request)
    {
        $fecha_1 = Carbon::parse($request->fecha_1);
        $fecha_2 = Carbon::parse($request->fecha_2);
        $venta = VentaItemsPt::with(['Item','Venta'])->whereBetween('fecha',[$fecha_1,$fecha_2])->where('estado',1)->get()->each(function ($item) {
            $item->cliente_id = $item->Venta->cliente->id;
            $item->user_id = $item->Venta->user_id;
            return $item;
        });
        if($request->user!=="all"){
            $venta = $venta->where('user_id',$request->user);
        }
        if($request->cliente!=="all"){
            $venta = $venta->where('cliente_id',$request->cliente);
        }
        return $venta;

    }
    public function store(Request $request)
    {
        $ventaItemsPt = new VentaItemsPt();
        $ventaItemsPt->name = $request->name;
        $ventaItemsPt->save();
        return $ventaItemsPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaItemsPt  $ventaItemsPt
     * @return \Illuminate\Http\Response
     */
    public function show(VentaItemsPt $ventaItemsPt)
    {

        return $ventaItemsPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaItemsPt  $ventaItemsPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaItemsPt $ventaItemsPt)
    {
        $ventaItemsPt->name = $request->name;
        $ventaItemsPt->save();
        return $ventaItemsPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaItemsPt  $ventaItemsPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaItemsPt $ventaItemsPt)
    {
        $ventaItemsPt->estado = 0;
        $ventaItemsPt->save();
    }
}
