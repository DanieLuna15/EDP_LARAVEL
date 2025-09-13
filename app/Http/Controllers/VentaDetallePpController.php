<?php

namespace App\Http\Controllers;

use App\Models\VentaDetallePp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VentaDetallePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaDetallePp::with(['Venta','CintaCliente','Cliente','Item'])->where('estado',1)->get();
    }

    public function fechas(Request $request)
    {
        $fecha_1 = Carbon::parse($request->fecha_1);
        $fecha_2 = Carbon::parse($request->fecha_2);
        $venta = VentaDetallePp::with(['Venta','CintaCliente','Cliente','Item'])->whereBetween('fecha',[$fecha_1,$fecha_2])->where('estado',1)->get()->each(function ($item) {
            $item->cliente_id = $item->cliente->id;
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaDetallePp = new VentaDetallePp();
        $ventaDetallePp->name = $request->name;
        $ventaDetallePp->save();
        return $ventaDetallePp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaDetallePp  $ventaDetallePp
     * @return \Illuminate\Http\Response
     */
    public function show(VentaDetallePp $ventaDetallePp)
    {

        return $ventaDetallePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaDetallePp  $ventaDetallePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaDetallePp $ventaDetallePp)
    {
        $ventaDetallePp->name = $request->name;
        $ventaDetallePp->save();
        return $ventaDetallePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaDetallePp  $ventaDetallePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaDetallePp $ventaDetallePp)
    {
        $ventaDetallePp->estado = 0;
        $ventaDetallePp->save();
    }
}
