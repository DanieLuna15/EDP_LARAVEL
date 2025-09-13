<?php

namespace App\Http\Controllers;

use App\Models\Bandera;
use Illuminate\Http\Request;

class BanderaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bandera::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bandera = new Bandera();
        $bandera->name = $request->name;
        $bandera->min = $request->min;
        $bandera->max = $request->max;
        $bandera->save();
        return $bandera;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bandera  $bandera
     * @return \Illuminate\Http\Response
     */
    public function show(Bandera $bandera)
    {
        
        return $bandera;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bandera  $bandera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bandera $bandera)
    {
        $bandera->name = $request->name;
        $bandera->min = $request->min;
        $bandera->max = $request->max;
        $bandera->save();
        return $bandera;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bandera  $bandera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bandera $bandera)
    {
        $bandera->estado = 0;
        $bandera->save();
    }
}
