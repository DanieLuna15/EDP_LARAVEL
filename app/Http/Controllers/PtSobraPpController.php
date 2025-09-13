<?php

namespace App\Http\Controllers;

use App\Models\PtSobraPp;
use Illuminate\Http\Request;

class PtSobraPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PtSobraPp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ptSobraPp = new PtSobraPp();
        $ptSobraPp->name = $request->name;
        $ptSobraPp->save();
        return $ptSobraPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtSobraPp  $ptSobraPp
     * @return \Illuminate\Http\Response
     */
    public function show(PtSobraPp $ptSobraPp)
    {
        
        return $ptSobraPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PtSobraPp  $ptSobraPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PtSobraPp $ptSobraPp)
    {
        $ptSobraPp->name = $request->name;
        $ptSobraPp->save();
        return $ptSobraPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtSobraPp  $ptSobraPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtSobraPp $ptSobraPp)
    {
        $ptSobraPp->estado = 0;
        $ptSobraPp->save();
    }
}
