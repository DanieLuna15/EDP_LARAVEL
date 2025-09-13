<?php

namespace App\Http\Controllers;

use App\Models\ArqueoIngreso;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArqueoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArqueoIngreso::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista = ArqueoIngreso::where('arqueo_id',$request->arqueo_id)->get();
        $nro = count($lista);
        $arqueoIngreso = new ArqueoIngreso();
        $arqueoIngreso->cajamotivo_id = $request->cajamotivo_id;
        $arqueoIngreso->arqueo_id = $request->arqueo_id;
        $arqueoIngreso->formapago_id = $request->formapago_id;
        $arqueoIngreso->tipo = $request->tipo;
        $arqueoIngreso->monto = $request->monto;
        $arqueoIngreso->fecha = Carbon::now()->format('Y-m-d');
        $arqueoIngreso->nro = $nro+1;
        $arqueoIngreso->save();
        return $arqueoIngreso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(ArqueoIngreso $arqueoIngreso)
    {
        
        return $arqueoIngreso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArqueoIngreso $arqueoIngreso)
    {
        $arqueoIngreso->name = $request->name;
        $arqueoIngreso->save();
        return $arqueoIngreso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArqueoIngreso $arqueoIngreso)
    {
        $arqueoIngreso->estado = 0;
        $arqueoIngreso->save();
    }
}
