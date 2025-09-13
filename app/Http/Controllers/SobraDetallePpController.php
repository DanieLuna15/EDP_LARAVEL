<?php

namespace App\Http\Controllers;

use App\Models\SobraDetallePp;
use Illuminate\Http\Request;

class SobraDetallePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SobraDetallePp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sobraDetallePp = new SobraDetallePp();
        $sobraDetallePp->name = $request->name;
        $sobraDetallePp->save();
        return $sobraDetallePp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SobraDetallePp  $sobraDetallePp
     * @return \Illuminate\Http\Response
     */
    public function show(SobraDetallePp $sobraDetallePp)
    {
        
        return $sobraDetallePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SobraDetallePp  $sobraDetallePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SobraDetallePp $sobraDetallePp)
    {
        $sobraDetallePp->name = $request->name;
        $sobraDetallePp->save();
        return $sobraDetallePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SobraDetallePp  $sobraDetallePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(SobraDetallePp $sobraDetallePp)
    {
        $sobraDetallePp->estado = 0;
        $sobraDetallePp->save();
    }
}
