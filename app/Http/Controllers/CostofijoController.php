<?php

namespace App\Http\Controllers;

use App\Models\Costofijo;
use Illuminate\Http\Request;

class CostofijoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Costofijo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $costofijo = new Costofijo();
        $costofijo->name = $request->name;
        $costofijo->monto = $request->monto;
        $costofijo->save();
        return $costofijo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costofijo  $costofijo
     * @return \Illuminate\Http\Response
     */
    public function show(Costofijo $costofijo)
    {
        
        return $costofijo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Costofijo  $costofijo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Costofijo $costofijo)
    {
        $costofijo->name = $request->name;
        $costofijo->monto = $request->monto;
        $costofijo->save();
        return $costofijo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costofijo  $costofijo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costofijo $costofijo)
    {
        $costofijo->estado = 0;
        $costofijo->save();
    }
}
