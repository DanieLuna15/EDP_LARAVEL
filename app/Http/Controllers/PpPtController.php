<?php

namespace App\Http\Controllers;

use App\Models\PpPt;
use Illuminate\Http\Request;

class PpPtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpPt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppPt = new PpPt();
        $ppPt->name = $request->name;
        $ppPt->save();
        return $ppPt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpPt  $ppPt
     * @return \Illuminate\Http\Response
     */
    public function show(PpPt $ppPt)
    {
        
        return $ppPt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpPt  $ppPt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpPt $ppPt)
    {
        $ppPt->name = $request->name;
        $ppPt->save();
        return $ppPt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpPt  $ppPt
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpPt $ppPt)
    {
        $ppPt->estado = 0;
        $ppPt->save();
    }
}
