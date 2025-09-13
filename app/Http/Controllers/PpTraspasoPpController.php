<?php

namespace App\Http\Controllers;

use App\Models\PpTraspasoPp;
use Illuminate\Http\Request;

class PpTraspasoPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PpTraspasoPp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ppTraspasoPp = new PpTraspasoPp();
        $ppTraspasoPp->name = $request->name;
        $ppTraspasoPp->save();
        return $ppTraspasoPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpTraspasoPp  $ppTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function show(PpTraspasoPp $ppTraspasoPp)
    {
        
        return $ppTraspasoPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PpTraspasoPp  $ppTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PpTraspasoPp $ppTraspasoPp)
    {
        $ppTraspasoPp->name = $request->name;
        $ppTraspasoPp->save();
        return $ppTraspasoPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpTraspasoPp  $ppTraspasoPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpTraspasoPp $ppTraspasoPp)
    {
        $ppTraspasoPp->estado = 0;
        $ppTraspasoPp->save();
    }
}
