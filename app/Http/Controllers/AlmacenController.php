<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Almacen::with(['Sucursal'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $almacen = new Almacen();
        $almacen->name = $request->name;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->save();
        return $almacen;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        
        return $almacen;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almacen $almacen)
    {
        $almacen->name = $request->name;
        $almacen->sucursal_id = $request->sucursal_id;
        $almacen->save();
        return $almacen;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        $almacen->estado = 0;
        $almacen->save();
    }
}
