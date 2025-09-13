<?php

namespace App\Http\Controllers;

use App\Models\Consolidacionparam;
use Illuminate\Http\Request;

class ConsolidacionparamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Consolidacionparam::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionparam = new Consolidacionparam();
        $consolidacionparam->name = $request->name;
        $consolidacionparam->monto = $request->monto;
        $consolidacionparam->save();
        return $consolidacionparam;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consolidacionparam  $consolidacionparam
     * @return \Illuminate\Http\Response
     */
    public function show(Consolidacionparam $consolidacionparam)
    {
        
        return $consolidacionparam;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consolidacionparam  $consolidacionparam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consolidacionparam $consolidacionparam)
    {
        $consolidacionparam->name = $request->name;
        $consolidacionparam->monto = $request->monto;
        $consolidacionparam->save();
        return $consolidacionparam;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consolidacionparam  $consolidacionparam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consolidacionparam $consolidacionparam)
    {
        $consolidacionparam->estado = 0;
        $consolidacionparam->save();
    }
}
