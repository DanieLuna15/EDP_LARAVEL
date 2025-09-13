<?php

namespace App\Http\Controllers;

use App\Models\Adeudacosto;
use Illuminate\Http\Request;

class AdeudacostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Adeudacosto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adeudacosto = new Adeudacosto();
        $adeudacosto->name = $request->name;
        $adeudacosto->save();
        return $adeudacosto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adeudacosto  $adeudacosto
     * @return \Illuminate\Http\Response
     */
    public function show(Adeudacosto $adeudacosto)
    {
        
        return $adeudacosto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adeudacosto  $adeudacosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adeudacosto $adeudacosto)
    {
        $adeudacosto->name = $request->name;
        $adeudacosto->save();
        return $adeudacosto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adeudacosto  $adeudacosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adeudacosto $adeudacosto)
    {
        $adeudacosto->estado = 0;
        $adeudacosto->save();
    }
}
