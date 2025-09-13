<?php

namespace App\Http\Controllers;

use App\Models\KardexDotacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KardexDotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KardexDotacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kardexDotacion = new KardexDotacion();
        $kardexDotacion->name = $request->name;
        $kardexDotacion->save();
        return $kardexDotacion;
    }
    public function dotacionFecha(Request $request)
    {
        $usuario = $request->user_id;
        $sucursal = $request->sucursal_id;
        $familia = $request->familia_id;
        $dotacion = $request->dotacion_id;
        $fecha_1 = Carbon::parse($request->fecha_1)->format('Y-m-d');
        $fecha_2 = Carbon::parse($request->fecha_2)->format('Y-m-d');
        $kardexDotacion = KardexDotacion::with(['Dotacion','User','Familia','Sucursal'])->whereBetween('fecha', [$fecha_1, $fecha_2]);
        if($dotacion != 'all'){
          $kardexDotacion = $kardexDotacion->where('dotacion_id', $dotacion);
        }
        if($sucursal != 'all'){
          $kardexDotacion = $kardexDotacion->where('sucursal_id', $sucursal);
        }
        if($familia != 'all'){
          $kardexDotacion = $kardexDotacion->where('familia_id', $familia);
        }
        if($usuario != 'all'){
          $kardexDotacion = $kardexDotacion->where('user_id', $usuario);
        }
        $kardexDotacion = $kardexDotacion->orderBy('fecha','desc')->get();
        return $kardexDotacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KardexDotacion  $kardexDotacion
     * @return \Illuminate\Http\Response
     */
    public function show(KardexDotacion $kardexDotacion)
    {

        return $kardexDotacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KardexDotacion  $kardexDotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KardexDotacion $kardexDotacion)
    {
        $kardexDotacion->name = $request->name;
        $kardexDotacion->save();
        return $kardexDotacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KardexDotacion  $kardexDotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(KardexDotacion $kardexDotacion)
    {
        $kardexDotacion->estado = 0;
        $kardexDotacion->save();
    }
}
