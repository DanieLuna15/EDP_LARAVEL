<?php

namespace App\Http\Controllers;

use App\Models\Tipopago;
use Illuminate\Http\Request;

class TipopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipopago::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipopago = new Tipopago();
        $tipopago->name = $request->name;
        $tipopago->save();
        return $tipopago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function show(Tipopago $tipopago)
    {
        
        return $tipopago;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipopago $tipopago)
    {
        $tipopago->name = $request->name;
        $tipopago->save();
        return $tipopago;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipopago $tipopago)
    {
        $tipopago->estado = 0;
        $tipopago->save();
    }
}
