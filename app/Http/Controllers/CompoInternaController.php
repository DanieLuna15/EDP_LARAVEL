<?php

namespace App\Http\Controllers;

use App\Models\CompoInterna;
use App\Models\CompoInternaFile;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompoInternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompoInterna::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compoInterna = new CompoInterna();
        $compoInterna->name = $request->name;
        $compoInterna->peso = $request->peso;
        $compoInterna->cantidad = $request->cantidad;
        $compoInterna->compra = $request->compra;
        $compoInterna->venta = $request->venta;
        $compoInterna->save();
        return $compoInterna;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompoInterna  $compoInterna
     * @return \Illuminate\Http\Response
     */
    public function show(CompoInterna $compoInterna)
    {
        $compoInterna->file_sucursals = $compoInterna->CompoInternaFiles()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        return $compoInterna;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompoInterna  $compoInterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompoInterna $compoInterna)
    {
        $compoInterna->name = $request->name;
        $compoInterna->peso = $request->peso;
        $compoInterna->cantidad = $request->cantidad;
        $compoInterna->compra = $request->compra;
        $compoInterna->venta = $request->venta;
        $compoInterna->save();
        return $compoInterna;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompoInterna  $compoInterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompoInterna $compoInterna)
    {
        $compoInterna->estado = 0;
        $compoInterna->save();
    }
    public function image(Request $request,$id)
    {
     

        $file = $request->file('file')->store('public/composicion');
        $url = Storage::url($file);

        $fileModel = new File();
        $fileModel->path = $url;
        $fileModel->save();
        $filesucursal = new CompoInternaFile();
        $filesucursal->file_id = $fileModel->id;
        $filesucursal->compo_interna_id = $id;
        $filesucursal->save();
       
        return $filesucursal;
    }
    public function imageDelete($id)
    {
        $file = CompoInternaFile::find($id);
        $file->estado = 0;
        $file->save();
    }
}
