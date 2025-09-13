<?php

namespace App\Http\Controllers;

use App\Models\FormaPedido;
use Illuminate\Http\Request;

class FormaPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FormaPedido::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formaPedido = new FormaPedido();
        $formaPedido->name = $request->name;
        $formaPedido->save();
        return $formaPedido;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormaPedido  $formaPedido
     * @return \Illuminate\Http\Response
     */
    public function show(FormaPedido $formaPedido)
    {
        
        return $formaPedido;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormaPedido  $formaPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormaPedido $formaPedido)
    {
        $formaPedido->name = $request->name;
        $formaPedido->save();
        return $formaPedido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormaPedido  $formaPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaPedido $formaPedido)
    {
        $formaPedido->estado = 0;
        $formaPedido->save();
    }
}
