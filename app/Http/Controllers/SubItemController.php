<?php

namespace App\Http\Controllers;

use App\Models\SubItem;
use Illuminate\Http\Request;

class SubItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubItem::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subItem = new SubItem();
        $subItem->item_id = $request->pt['id'];
        $subItem->sub_item_id = $request->sub_pt['item']['id'];
        $subItem->peso = $request->sub_pt['peso'];
        $subItem->precio = $request->sub_pt['precio'];
        $subItem->promedio = $request->sub_pt['promedio'];
        $subItem->save();
        return $subItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function show(SubItem $subItem)
    {

        return $subItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubItem $subItem)
    {
        $subItem->name = $request->name;
        $subItem->save();
        return $subItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubItem  $subItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubItem $subItem)
    {
        $subItem->estado = 0;
        $subItem->save();
    }
}
