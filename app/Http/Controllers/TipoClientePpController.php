<?php

namespace App\Http\Controllers;

use App\Models\TipoClientePp;
use Illuminate\Http\Request;

class TipoClientePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoClientePp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoClientePp = new TipoClientePp();
        $tipoClientePp->name = $request->name;
        $tipoClientePp->desde = $request->desde;
        $tipoClientePp->hasta = $request->hasta;
        $tipoClientePp->save();
        return $tipoClientePp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoClientePp  $tipoClientePp
     * @return \Illuminate\Http\Response
     */
    public function show(TipoClientePp $tipoClientePp)
    {
        
        return $tipoClientePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoClientePp  $tipoClientePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoClientePp $tipoClientePp)
    {
        $tipoClientePp->name = $request->name;
        $tipoClientePp->desde = $request->desde;
        $tipoClientePp->hasta = $request->hasta;
        $tipoClientePp->save();
        return $tipoClientePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoClientePp  $tipoClientePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoClientePp $tipoClientePp)
    {
        $tipoClientePp->estado = 0;
        $tipoClientePp->save();
    }
}
