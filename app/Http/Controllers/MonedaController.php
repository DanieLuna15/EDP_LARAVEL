<?php

namespace App\Http\Controllers;

use App\Models\Moneda;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Filemoneda;
use Illuminate\Support\Facades\Storage;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Moneda::where('estado', 1)->get();
        $list = [];

        foreach ($model as $moneda) {
            $moneda->file_monedas = $moneda->Filemonedas()->get()->each(function ($file) {
                $file->path_url = url($file->File->path);
            });
            $moneda->image = $moneda->file_monedas->first(); 
            $list[] = $moneda;
        }

        return $list;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $moneda = new Moneda();
        $moneda->name = $request->name;
        $moneda->valor = $request->valor;
        $moneda->save();
        return $moneda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function show(Moneda $moneda)
    {
        $moneda->file_monedas = $moneda->Filemonedas()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        return $moneda;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moneda $moneda)
    {
        $moneda->name = $request->name;
        $moneda->valor = $request->valor;
        $moneda->save();
        return $moneda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moneda $moneda)
    {
        $moneda->estado = 0;
        $moneda->save();
    }

    public function image(Request $request, $id)
    {
        $file = $request->file('file')->store('public/monedas');
        $url = Storage::url($file);

        $fileModel = new File();
        $fileModel->path = $url;
        $fileModel->save();

        $fileMoneda = new Filemoneda();
        $fileMoneda->file_id = $fileModel->id;
        $fileMoneda->moneda_id = $id;
        $fileMoneda->tipoarchivo_id = $request->tipoarchivo_id;
        $fileMoneda->save();

        return $fileMoneda;
    }

    public function imageDelete($id)
    {
        $file = Filemoneda::find($id);
        $file->estado = 0;
        $file->save();
    }
}
