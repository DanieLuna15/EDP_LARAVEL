<?php

namespace App\Http\Controllers;

use App\Models\Stockdotaciondetail;
use Illuminate\Http\Request;

class StockdotaciondetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stockdotaciondetail::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stockdotaciondetail = new Stockdotaciondetail();
        $stockdotaciondetail->name = $request->name;
        $stockdotaciondetail->save();
        return $stockdotaciondetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stockdotaciondetail  $stockdotaciondetail
     * @return \Illuminate\Http\Response
     */
    public function show(Stockdotaciondetail $stockdotaciondetail)
    {
        
        return $stockdotaciondetail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stockdotaciondetail  $stockdotaciondetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stockdotaciondetail $stockdotaciondetail)
    {
        $stockdotaciondetail->name = $request->name;
        $stockdotaciondetail->save();
        return $stockdotaciondetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stockdotaciondetail  $stockdotaciondetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stockdotaciondetail $stockdotaciondetail)
    {
        $stockdotaciondetail->estado = 0;
        $stockdotaciondetail->save();
    }
}
