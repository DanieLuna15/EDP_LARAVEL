<?php

namespace App\Http\Controllers;

use App\Models\VentaTurnoChofer;
use Illuminate\Http\Request;

class VentaTurnoChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaTurnoChofer::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaTurnoChofer = new VentaTurnoChofer();
        $ventaTurnoChofer->name = $request->name;
        $ventaTurnoChofer->save();
        return $ventaTurnoChofer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaTurnoChofer  $ventaTurnoChofer
     * @return \Illuminate\Http\Response
     */
    public function show(VentaTurnoChofer $ventaTurnoChofer)
    {
        $ventaTurnoChofer->venta = $ventaTurnoChofer->Venta;
        $ventaTurnoChofer->venta->url_pdf = url("reportes/ventas/$ventaTurnoChofer->venta_id");

        return $ventaTurnoChofer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaTurnoChofer  $ventaTurnoChofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaTurnoChofer $ventaTurnoChofer)
    {
        $ventaTurnoChofer->entregado = 0;
        $ventaTurnoChofer->save();
        return $ventaTurnoChofer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaTurnoChofer  $ventaTurnoChofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaTurnoChofer $ventaTurnoChofer)
    {
        $ventaTurnoChofer->estado = 0;
        $ventaTurnoChofer->save();
    }
}
