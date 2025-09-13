<?php

namespace App\Http\Controllers;

use App\Models\CajaSucursal;
use Illuminate\Http\Request;

class CajaSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaSucursal::with(['Sucursal'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaSucursal = new CajaSucursal();
        $cajaSucursal->name = $request->name;
        $cajaSucursal->sucursal_id = $request->sucursal_id;
        $cajaSucursal->save();
        return $cajaSucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaSucursal  $cajaSucursal
     * @return \Illuminate\Http\Response
     */
    public function show(CajaSucursal $cajaSucursal)
    {
        $cajaSucursal->Sucursal = $cajaSucursal->Sucursal;
        $cajaSucursal->CajaSucursalUsuarios = $cajaSucursal->CajaSucursalUsuarios;
        return $cajaSucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaSucursal  $cajaSucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaSucursal $cajaSucursal)
    {
        $cajaSucursal->name = $request->name;
        $cajaSucursal->sucursal_id = $request->sucursal_id;
        $cajaSucursal->save();
        return $cajaSucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaSucursal  $cajaSucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaSucursal $cajaSucursal)
    {
        $cajaSucursal->estado = 0;
        $cajaSucursal->save();
    }
}
