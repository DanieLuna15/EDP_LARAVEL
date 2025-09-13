<?php

namespace App\Http\Controllers;

use App\Models\TransformacionDetalleSucursal;
use Illuminate\Http\Request;

class TransformacionDetalleSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionDetalleSucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionDetalleSucursal = new TransformacionDetalleSucursal();
        $transformacionDetalleSucursal->name = $request->name;
        $transformacionDetalleSucursal->save();
        return $transformacionDetalleSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionDetalleSucursal  $transformacionDetalleSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionDetalleSucursal $transformacionDetalleSucursal)
    {
        
        return $transformacionDetalleSucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionDetalleSucursal  $transformacionDetalleSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionDetalleSucursal $transformacionDetalleSucursal)
    {
        $transformacionDetalleSucursal->name = $request->name;
        $transformacionDetalleSucursal->save();
        return $transformacionDetalleSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionDetalleSucursal  $transformacionDetalleSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionDetalleSucursal $transformacionDetalleSucursal)
    {
        $transformacionDetalleSucursal->estado = 0;
        $transformacionDetalleSucursal->save();
    }
}
