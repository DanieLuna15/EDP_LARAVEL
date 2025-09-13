<?php

namespace App\Http\Controllers;

use App\Models\DespleguePp;
use Illuminate\Http\Request;

class DespleguePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DespleguePp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $despleguePp = new DespleguePp();
        $despleguePp->name = $request->name;
        $despleguePp->save();
        return $despleguePp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DespleguePp  $despleguePp
     * @return \Illuminate\Http\Response
     */
    public function show(DespleguePp $despleguePp)
    {
        
        return $despleguePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DespleguePp  $despleguePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DespleguePp $despleguePp)
    {
        $despleguePp->name = $request->name;
        $despleguePp->save();
        return $despleguePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DespleguePp  $despleguePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(DespleguePp $despleguePp)
    {
        $despleguePp->estado = 0;
        $despleguePp->save();
    }
}
