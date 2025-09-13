<?php

namespace App\Http\Controllers;

use App\Models\ItemPollo;
use Illuminate\Http\Request;

class ItemPolloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemPollo::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemPollo = new ItemPollo();
        $itemPollo->name = $request->name;
        $itemPollo->save();
        return $itemPollo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemPollo  $itemPollo
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPollo $itemPollo)
    {
        
        return $itemPollo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemPollo  $itemPollo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPollo $itemPollo)
    {
        $itemPollo->name = $request->name;
        $itemPollo->save();
        return $itemPollo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemPollo  $itemPollo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPollo $itemPollo)
    {
        $itemPollo->estado = 0;
        $itemPollo->save();
    }
}
