<?php

namespace App\Http\Controllers;

use App\Models\Motivomemorandum;
use Illuminate\Http\Request;

class MotivomemorandumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Motivomemorandum::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $motivomemorandum = new Motivomemorandum();
        $motivomemorandum->name = $request->name;
        $motivomemorandum->save();
        return $motivomemorandum;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivomemorandum  $motivomemorandum
     * @return \Illuminate\Http\Response
     */
    public function show(Motivomemorandum $motivomemorandum)
    {
        
        return $motivomemorandum;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motivomemorandum  $motivomemorandum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motivomemorandum $motivomemorandum)
    {
        $motivomemorandum->name = $request->name;
        $motivomemorandum->save();
        return $motivomemorandum;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivomemorandum  $motivomemorandum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivomemorandum $motivomemorandum)
    {
        $motivomemorandum->estado = 0;
        $motivomemorandum->save();
    }
}
