<?php

namespace App\Http\Controllers;

use App\Models\Adeuda;
use Illuminate\Http\Request;

class AdeudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Adeuda::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adeuda = new Adeuda();
        $adeuda->name = $request->name;
        $adeuda->save();
        return $adeuda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adeuda  $adeuda
     * @return \Illuminate\Http\Response
     */
    public function show(Adeuda $adeuda)
    {
        
        return $adeuda;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adeuda  $adeuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adeuda $adeuda)
    {
        $adeuda->name = $request->name;
        $adeuda->save();
        return $adeuda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adeuda  $adeuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adeuda $adeuda)
    {
        $adeuda->estado = 0;
        $adeuda->save();
    }
}
