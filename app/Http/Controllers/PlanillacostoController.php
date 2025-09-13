<?php

namespace App\Http\Controllers;

use App\Models\Planillacosto;
use Illuminate\Http\Request;

class PlanillacostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Planillacosto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planillacosto = new Planillacosto();
        $planillacosto->name = $request->name;
        $planillacosto->save();
        return $planillacosto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planillacosto  $planillacosto
     * @return \Illuminate\Http\Response
     */
    public function show(Planillacosto $planillacosto)
    {
        
        return $planillacosto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planillacosto  $planillacosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planillacosto $planillacosto)
    {
        $planillacosto->name = $request->name;
        $planillacosto->save();
        return $planillacosto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planillacosto  $planillacosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planillacosto $planillacosto)
    {
        $planillacosto->estado = 0;
        $planillacosto->save();
    }
}
