<?php

namespace App\Http\Controllers;

use App\Models\Planillaserviciocosto;
use Illuminate\Http\Request;

class PlanillaserviciocostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Planillaserviciocosto::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planillaserviciocosto = new Planillaserviciocosto();
        $planillaserviciocosto->name = $request->name;
        $planillaserviciocosto->save();
        return $planillaserviciocosto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planillaserviciocosto  $planillaserviciocosto
     * @return \Illuminate\Http\Response
     */
    public function show(Planillaserviciocosto $planillaserviciocosto)
    {
        
        return $planillaserviciocosto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planillaserviciocosto  $planillaserviciocosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planillaserviciocosto $planillaserviciocosto)
    {
        $planillaserviciocosto->name = $request->name;
        $planillaserviciocosto->save();
        return $planillaserviciocosto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planillaserviciocosto  $planillaserviciocosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planillaserviciocosto $planillaserviciocosto)
    {
        $planillaserviciocosto->estado = 0;
        $planillaserviciocosto->save();
    }
}
