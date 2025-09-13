<?php

namespace App\Http\Controllers;

use App\Models\PromedioMerma;
use Illuminate\Http\Request;

class PromedioMermaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PromedioMerma::where('estado',1)->get()->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promedioMerma = PromedioMerma::where('estado',1)->get()->first();
        $promedioMerma->promedio = $request->promedio;
        $promedioMerma->save();
        return $promedioMerma;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromedioMerma  $promedioMerma
     * @return \Illuminate\Http\Response
     */
    public function show(PromedioMerma $promedioMerma)
    {

        return $promedioMerma;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromedioMerma  $promedioMerma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromedioMerma $promedioMerma)
    {
        $promedioMerma->name = $request->name;
        $promedioMerma->save();
        return $promedioMerma;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromedioMerma  $promedioMerma
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromedioMerma $promedioMerma)
    {
        $promedioMerma->estado = 0;
        $promedioMerma->save();
    }
}
