<?php

namespace App\Http\Controllers;

use App\Models\ClienteCajacerrada;
use Illuminate\Http\Request;

class ClienteCajacerradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClienteCajacerrada::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clienteCajacerrada = new ClienteCajacerrada();
        $clienteCajacerrada->name = $request->name;
        $clienteCajacerrada->save();
        return $clienteCajacerrada;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClienteCajacerrada  $clienteCajacerrada
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteCajacerrada $clienteCajacerrada)
    {
        
        return $clienteCajacerrada;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClienteCajacerrada  $clienteCajacerrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteCajacerrada $clienteCajacerrada)
    {
        $clienteCajacerrada->name = $request->name;
        $clienteCajacerrada->save();
        return $clienteCajacerrada;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClienteCajacerrada  $clienteCajacerrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteCajacerrada $clienteCajacerrada)
    {
        $clienteCajacerrada->estado = 0;
        $clienteCajacerrada->save();
    }
}
