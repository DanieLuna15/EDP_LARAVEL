<?php

namespace App\Http\Controllers;

use App\Models\Filepersona;
use Illuminate\Http\Request;

class FilepersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Filepersona::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filepersona = new Filepersona();
        $filepersona->name = $request->name;
        $filepersona->save();
        return $filepersona;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filepersona  $filepersona
     * @return \Illuminate\Http\Response
     */
    public function show(Filepersona $filepersona)
    {
        
        return $filepersona;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filepersona  $filepersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filepersona $filepersona)
    {
        $filepersona->name = $request->name;
        $filepersona->save();
        return $filepersona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filepersona  $filepersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filepersona $filepersona)
    {
        $filepersona->estado = 0;
        $filepersona->save();
    }
}
