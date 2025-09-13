<?php

namespace App\Http\Controllers;

use App\Models\CompoExterna;
use App\Models\CompoExternaFile;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompoExternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompoExterna::with(['CompoExternaDetalles'])->where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compoExterna = new CompoExterna();
        $compoExterna->name = $request->name;
        $compoExterna->peso = $request->peso;
        $compoExterna->cantidad = $request->cantidad;
        $compoExterna->compra = $request->compra;
        $compoExterna->venta = $request->venta;
        $compoExterna->save();
        return $compoExterna;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompoExterna  $compoExterna
     * @return \Illuminate\Http\Response
     */
    public function show(CompoExterna $compoExterna)
    {
        $compoExterna->compo_externa_detalles = $compoExterna->CompoExternaDetalles()->get();
        $compoExterna->file_sucursals = $compoExterna->CompoExternaFiles()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        return $compoExterna;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompoExterna  $compoExterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompoExterna $compoExterna)
    {
        $compoExterna->name = $request->name;
        $compoExterna->peso = $request->peso;
        $compoExterna->cantidad = $request->cantidad;
        $compoExterna->compra = $request->compra;
        $compoExterna->venta = $request->venta;
        $compoExterna->save();
        return $compoExterna;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompoExterna  $compoExterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompoExterna $compoExterna)
    {
        $compoExterna->estado = 0;
        $compoExterna->save();
    }
    public function image(Request $request,$id)
    {
     

        $file = $request->file('file')->store('public/composicion');
        $url = Storage::url($file);

        $fileModel = new File();
        $fileModel->path = $url;
        $fileModel->save();
        $filesucursal = new CompoExternaFile();
        $filesucursal->file_id = $fileModel->id;
        $filesucursal->compo_externa_id = $id;
        $filesucursal->save();
       
        return $filesucursal;
    }
    public function imageDelete($id)
    {
        $file = CompoExternaFile::find($id);
        $file->estado = 0;
        $file->save();
    }
}
