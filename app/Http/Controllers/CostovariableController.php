<?php

namespace App\Http\Controllers;

use App\Models\Costovariable;
use Illuminate\Http\Request;

class CostovariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Costovariable::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $costovariable = new Costovariable();
        $costovariable->name = $request->name;
        $costovariable->save();
        return $costovariable;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costovariable  $costovariable
     * @return \Illuminate\Http\Response
     */
    public function show(Costovariable $costovariable)
    {
        
        return $costovariable;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Costovariable  $costovariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Costovariable $costovariable)
    {
        $costovariable->name = $request->name;
        $costovariable->save();
        return $costovariable;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costovariable  $costovariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costovariable $costovariable)
    {
        $costovariable->estado = 0;
        $costovariable->save();
    }
}
