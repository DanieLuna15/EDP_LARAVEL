<?php

namespace App\Http\Controllers;

use App\Models\Finivacacionalplanilla;
use Illuminate\Http\Request;

class FinivacacionalplanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finivacacionalplanilla::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finivacacionalplanilla = new Finivacacionalplanilla();
        $finivacacionalplanilla->name = $request->name;
        $finivacacionalplanilla->save();
        return $finivacacionalplanilla;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finivacacionalplanilla  $finivacacionalplanilla
     * @return \Illuminate\Http\Response
     */
    public function show(Finivacacionalplanilla $finivacacionalplanilla)
    {
        
        return $finivacacionalplanilla;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finivacacionalplanilla  $finivacacionalplanilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finivacacionalplanilla $finivacacionalplanilla)
    {
        $finivacacionalplanilla->name = $request->name;
        $finivacacionalplanilla->save();
        return $finivacacionalplanilla;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finivacacionalplanilla  $finivacacionalplanilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finivacacionalplanilla $finivacacionalplanilla)
    {
        $finivacacionalplanilla->estado = 0;
        $finivacacionalplanilla->save();
    }
}
