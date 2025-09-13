<?php

namespace App\Http\Controllers;

use App\Models\ClientePt;
use Illuminate\Http\Request;

class ClientePtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientePt::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientePt = new ClientePt();
        $clientePt->name = $request->name;
        $clientePt->save();
        return $clientePt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientePt  $clientePt
     * @return \Illuminate\Http\Response
     */
    public function show(ClientePt $clientePt)
    {
        
        return $clientePt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientePt  $clientePt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientePt $clientePt)
    {
        $clientePt->name = $request->name;
        $clientePt->save();
        return $clientePt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientePt  $clientePt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientePt $clientePt)
    {
        $clientePt->estado = 0;
        $clientePt->save();
    }
}
