<?php

namespace App\Http\Controllers;

use App\Models\BitacoraLote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BitacoraLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BitacoraLote::with(['Lote'])->where('estado',1)->get();
    }
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = BitacoraLote::with(['Lote'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           

            $list[] = $m;
        }
        return $list;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bitacoraLote = new BitacoraLote();
        $bitacoraLote->name = $request->name;
        $bitacoraLote->save();
        return $bitacoraLote;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BitacoraLote  $bitacoraLote
     * @return \Illuminate\Http\Response
     */
    public function show(BitacoraLote $bitacoraLote)
    {
        
        return $bitacoraLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BitacoraLote  $bitacoraLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BitacoraLote $bitacoraLote)
    {
        $bitacoraLote->name = $request->name;
        $bitacoraLote->save();
        return $bitacoraLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BitacoraLote  $bitacoraLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(BitacoraLote $bitacoraLote)
    {
        $bitacoraLote->estado = 0;
        $bitacoraLote->save();
    }
}
