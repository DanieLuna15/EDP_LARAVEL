<?php

namespace App\Http\Controllers;

use App\Models\Finiquinqueniodetalle;
use Illuminate\Http\Request;

class FiniquinqueniodetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finiquinqueniodetalle::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finiquinqueniodetalle = new Finiquinqueniodetalle();
        $finiquinqueniodetalle->name = $request->name;
        $finiquinqueniodetalle->save();
        return $finiquinqueniodetalle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finiquinqueniodetalle  $finiquinqueniodetalle
     * @return \Illuminate\Http\Response
     */
    public function show(Finiquinqueniodetalle $finiquinqueniodetalle)
    {
        
        return $finiquinqueniodetalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finiquinqueniodetalle  $finiquinqueniodetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finiquinqueniodetalle $finiquinqueniodetalle)
    {
        $finiquinqueniodetalle->name = $request->name;
        $finiquinqueniodetalle->save();
        return $finiquinqueniodetalle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finiquinqueniodetalle  $finiquinqueniodetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finiquinqueniodetalle $finiquinqueniodetalle)
    {
        $finiquinqueniodetalle->estado = 0;
        $finiquinqueniodetalle->save();
    }
}
