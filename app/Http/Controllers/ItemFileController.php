<?php

namespace App\Http\Controllers;

use App\Models\ItemFile;
use Illuminate\Http\Request;

class ItemFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemFile::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemFile = new ItemFile();
        $itemFile->name = $request->name;
        $itemFile->save();
        return $itemFile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemFile  $itemFile
     * @return \Illuminate\Http\Response
     */
    public function show(ItemFile $itemFile)
    {
        
        return $itemFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemFile  $itemFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemFile $itemFile)
    {
        $itemFile->name = $request->name;
        $itemFile->save();
        return $itemFile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemFile  $itemFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemFile $itemFile)
    {
        $itemFile->estado = 0;
        $itemFile->save();
    }
}
