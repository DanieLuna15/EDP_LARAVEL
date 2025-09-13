<?php

namespace App\Http\Controllers;

use App\Models\Documentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DocumentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Documentacion::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentacion = new Documentacion();
        $documentacion->name = $request->name;
        $documentacion->descripcion = $request->descripcion;
        $documentacion->slug = Str::slug($request->name) ;
        $documentacion->save();
        return $documentacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Documentacion $documentacion)
    {
        
        return $documentacion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documentacion $documentacion)
    {
        $documentacion->name = $request->name;
        $documentacion->descripcion = $request->descripcion;
        $documentacion->slug = Str::slug($request->name) ;
        $documentacion->save();
        return $documentacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documentacion $documentacion)
    {
        $documentacion->estado = 0;
        $documentacion->save();
    }
}
