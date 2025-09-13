<?php

namespace App\Http\Controllers;

use App\Models\Formapago;
use Illuminate\Http\Request;

class FormapagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Formapago::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formapago = new Formapago();
        $formapago->name = $request->name;
        $formapago->save();
        return $formapago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formapago  $formapago
     * @return \Illuminate\Http\Response
     */
    public function show(Formapago $formapago)
    {
        
        return $formapago;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formapago  $formapago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formapago $formapago)
    {
        $formapago->name = $request->name;
        $formapago->save();
        return $formapago;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formapago  $formapago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formapago $formapago)
    {
        $formapago->estado = 0;
        $formapago->save();
    }
}
