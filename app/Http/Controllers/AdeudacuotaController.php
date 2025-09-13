<?php

namespace App\Http\Controllers;

use App\Models\Adeudacuota;
use Illuminate\Http\Request;

class AdeudacuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Adeudacuota::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adeudacuota = new Adeudacuota();
        $adeudacuota->name = $request->name;
        $adeudacuota->save();
        return $adeudacuota;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adeudacuota  $adeudacuota
     * @return \Illuminate\Http\Response
     */
    public function show(Adeudacuota $adeudacuota)
    {
        
        return $adeudacuota;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adeudacuota  $adeudacuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adeudacuota $adeudacuota)
    {
        $adeudacuota->name = $request->name;
        $adeudacuota->save();
        return $adeudacuota;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adeudacuota  $adeudacuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adeudacuota $adeudacuota)
    {
        $adeudacuota->estado = 0;
        $adeudacuota->save();
    }
}
