<?php

namespace App\Http\Controllers;

use App\Models\ClientePp;
use Illuminate\Http\Request;

class ClientePpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientePp::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientePp = new ClientePp();
        $clientePp->name = $request->name;
        $clientePp->save();
        return $clientePp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientePp  $clientePp
     * @return \Illuminate\Http\Response
     */
    public function show(ClientePp $clientePp)
    {
        
        return $clientePp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientePp  $clientePp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientePp $clientePp)
    {
        $clientePp->name = $request->name;
        $clientePp->save();
        return $clientePp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientePp  $clientePp
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientePp $clientePp)
    {
        $clientePp->estado = 0;
        $clientePp->save();
    }
}
