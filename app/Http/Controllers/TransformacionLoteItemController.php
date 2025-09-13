<?php

namespace App\Http\Controllers;

use App\Models\TransformacionLoteItem;
use Illuminate\Http\Request;

class TransformacionLoteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransformacionLoteItem::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transformacionLoteItem = new TransformacionLoteItem();
        $transformacionLoteItem->name = $request->name;
        $transformacionLoteItem->save();
        return $transformacionLoteItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransformacionLoteItem  $transformacionLoteItem
     * @return \Illuminate\Http\Response
     */
    public function show(TransformacionLoteItem $transformacionLoteItem)
    {
        
        return $transformacionLoteItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransformacionLoteItem  $transformacionLoteItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransformacionLoteItem $transformacionLoteItem)
    {
        $transformacionLoteItem->name = $request->name;
        $transformacionLoteItem->save();
        return $transformacionLoteItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransformacionLoteItem  $transformacionLoteItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransformacionLoteItem $transformacionLoteItem)
    {
        $transformacionLoteItem->estado = 0;
        $transformacionLoteItem->save();
    }
}
