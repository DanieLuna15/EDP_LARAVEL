<?php

namespace App\Http\Controllers;

use App\Models\TransformacionSucursal;
use Illuminate\Http\Request;

class TransformacionSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionSucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionSucursal = new TransformacionSucursal();
        $transformacionSucursal->name = $request->name;
        $transformacionSucursal->save();
        return $transformacionSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionSucursal  $transformacionSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionSucursal $transformacionSucursal)
    {
        
        return $transformacionSucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionSucursal  $transformacionSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionSucursal $transformacionSucursal)
    {
        $transformacionSucursal->name = $request->name;
        $transformacionSucursal->save();
        return $transformacionSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionSucursal  $transformacionSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionSucursal $transformacionSucursal)
    {
        $transformacionSucursal->estado = 0;
        $transformacionSucursal->save();
    }
}
