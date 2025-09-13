<?php
namespace App\Http\Controllers;

use App\Models\AcuerdoCliente;
use Illuminate\Http\Request;

class AcuerdoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcuerdoCliente::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acuerdoCliente           = new AcuerdoCliente();
        $acuerdoCliente->name     = $request->name;
        $acuerdoCliente->cantidad = $request->cantidad;
        $acuerdoCliente->peso     = $request->peso;
        $acuerdoCliente->precio   = $request->precio;
        $acuerdoCliente->digitar  = $request->digitar;
        $acuerdoCliente->save();
        return $acuerdoCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcuerdoCliente  $acuerdoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(AcuerdoCliente $acuerdoCliente)
    {

        return $acuerdoCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcuerdoCliente  $acuerdoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcuerdoCliente $acuerdoCliente)
    {
        $acuerdoCliente->name     = $request->name;
        $acuerdoCliente->cantidad = $request->cantidad;
        $acuerdoCliente->peso     = $request->peso;
        $acuerdoCliente->precio   = $request->precio;
        $acuerdoCliente->digitar  = $request->digitar;
        $acuerdoCliente->save();
        return $acuerdoCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcuerdoCliente  $acuerdoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcuerdoCliente $acuerdoCliente)
    {
        $acuerdoCliente->estado = 0;
        $acuerdoCliente->save();
    }
}
