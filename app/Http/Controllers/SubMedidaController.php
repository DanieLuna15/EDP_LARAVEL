<?php

namespace App\Http\Controllers;

use App\Models\SubMedida;
use Illuminate\Http\Request;

class SubMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubMedida::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subMedida = new SubMedida();
        $subMedida->name = $request->name;
        $subMedida->valor_1 = $request->valor_1;
        $subMedida->valor_2 = $request->valor_2;
        $subMedida->nro_orden = $request->nro_orden;
        $subMedida->medida_producto_id = $request->id;
        $subMedida->save();
        return $subMedida;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMedida  $subMedida
     * @return \Illuminate\Http\Response
     */
    public function show(SubMedida $subMedida)
    {

        return $subMedida;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubMedida  $subMedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMedida $subMedida)
    {
        $subMedida->name = $request->name;
        $subMedida->valor_1 = $request->valor_1;
        $subMedida->valor_2 = $request->valor_2;
        $subMedida->nro_orden = $request->nro_orden;
        $subMedida->save();
        return $subMedida;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMedida  $subMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMedida $subMedida)
    {
        $subMedida->estado = 0;
        $subMedida->save();
    }
}
