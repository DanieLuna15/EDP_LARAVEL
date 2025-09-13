<?php

namespace App\Http\Controllers;

use App\Models\VentaAcuerdo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentaAcuerdoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VentaAcuerdo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventaAcuerdo = new VentaAcuerdo();
        $ventaAcuerdo->name = $request->name;
        $ventaAcuerdo->save();
        return $ventaAcuerdo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VentaAcuerdo  $ventaAcuerdo
     * @return \Illuminate\Http\Response
     */
    public function show(VentaAcuerdo $ventaAcuerdo)
    {
        
        return $ventaAcuerdo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VentaAcuerdo  $ventaAcuerdo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaAcuerdo $ventaAcuerdo)
    {
        $ventaAcuerdo->name = $request->name;
        $ventaAcuerdo->save();
        return $ventaAcuerdo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VentaAcuerdo  $ventaAcuerdo
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaAcuerdo $ventaAcuerdo)
    {
        $ventaAcuerdo->estado = 0;
        $ventaAcuerdo->save();
    }
}
