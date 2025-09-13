<?php

namespace App\Http\Controllers;

use App\Models\TransformacionItem;
use Illuminate\Http\Request;

class TransformacionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionItem::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionItem = new TransformacionItem();
        $transformacionItem->name = $request->name;
        $transformacionItem->save();
        return $transformacionItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionItem  $transformacionItem
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionItem $transformacionItem)
    {
        
        return $transformacionItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionItem  $transformacionItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionItem $transformacionItem)
    {
        $transformacionItem->name = $request->name;
        $transformacionItem->save();
        return $transformacionItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionItem  $transformacionItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionItem $transformacionItem)
    {
        $transformacionItem->estado = 0;
        $transformacionItem->save();
    }
}
