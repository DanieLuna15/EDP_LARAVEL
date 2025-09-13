<?php

namespace App\Http\Controllers;

use App\Models\PtTraspasoPp;
use Illuminate\Http\Request;

class PtTraspasoPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PtTraspasoPp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ptTraspasoPp = new PtTraspasoPp();
        $ptTraspasoPp->name = $request->name;
        $ptTraspasoPp->save();
        return $ptTraspasoPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtTraspasoPp  $ptTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function show(PtTraspasoPp $ptTraspasoPp)
    {
        
        return $ptTraspasoPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PtTraspasoPp  $ptTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PtTraspasoPp $ptTraspasoPp)
    {
        $ptTraspasoPp->name = $request->name;
        $ptTraspasoPp->save();
        return $ptTraspasoPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtTraspasoPp  $ptTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtTraspasoPp $ptTraspasoPp)
    {
        $ptTraspasoPp->estado = 0;
        $ptTraspasoPp->save();
    }
}
