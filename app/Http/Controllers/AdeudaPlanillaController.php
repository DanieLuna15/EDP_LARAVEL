<?php

namespace App\Http\Controllers;

use App\Models\AdeudaPlanilla;
use Illuminate\Http\Request;

class AdeudaPlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdeudaPlanilla::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adeudaPlanilla = new AdeudaPlanilla();
        $adeudaPlanilla->name = $request->name;
        $adeudaPlanilla->save();
        return $adeudaPlanilla;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdeudaPlanilla  $adeudaPlanilla
     * @return \Illuminate\Http\Response
     */
    public function show(AdeudaPlanilla $adeudaPlanilla)
    {
        
        return $adeudaPlanilla;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdeudaPlanilla  $adeudaPlanilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdeudaPlanilla $adeudaPlanilla)
    {
        $adeudaPlanilla->name = $request->name;
        $adeudaPlanilla->save();
        return $adeudaPlanilla;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdeudaPlanilla  $adeudaPlanilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdeudaPlanilla $adeudaPlanilla)
    {
        $adeudaPlanilla->estado = 0;
        $adeudaPlanilla->save();
    }
}
