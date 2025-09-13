<?php

namespace App\Http\Controllers;

use App\Models\TransEspecialItem;
use Illuminate\Http\Request;

class TransEspecialItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransEspecialItem::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transEspecialItem = new TransEspecialItem();
        $transEspecialItem->name = $request->name;
        $transEspecialItem->save();
        return $transEspecialItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransEspecialItem  $transEspecialItem
     * @return \Illuminate\Http\Response
     */
    public function show(TransEspecialItem $transEspecialItem)
    {
        
        return $transEspecialItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransEspecialItem  $transEspecialItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransEspecialItem $transEspecialItem)
    {
        $transEspecialItem->name = $request->name;
        $transEspecialItem->save();
        return $transEspecialItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransEspecialItem  $transEspecialItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransEspecialItem $transEspecialItem)
    {
        $transEspecialItem->estado = 0;
        $transEspecialItem->save();
    }
}
