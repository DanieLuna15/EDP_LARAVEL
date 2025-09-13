<?php

namespace App\Http\Controllers;

use App\Models\Contratocosto;
use Illuminate\Http\Request;

class ContratocostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contratocosto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contratocosto = new Contratocosto();
        $contratocosto->name = $request->name;
        $contratocosto->save();
        return $contratocosto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contratocosto  $contratocosto
     * @return \Illuminate\Http\Response
     */
    public function show(Contratocosto $contratocosto)
    {
        
        return $contratocosto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contratocosto  $contratocosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contratocosto $contratocosto)
    {
        $contratocosto->name = $request->name;
        $contratocosto->save();
        return $contratocosto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contratocosto  $contratocosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratocosto $contratocosto)
    {
        $contratocosto->estado = 0;
        $contratocosto->save();
    }
}
