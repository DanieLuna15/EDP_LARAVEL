<?php

namespace App\Http\Controllers;

use App\Models\CompoInternaFile;
use Illuminate\Http\Request;

class CompoInternaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompoInternaFile::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compoInternaFile = new CompoInternaFile();
        $compoInternaFile->name = $request->name;
        $compoInternaFile->save();
        return $compoInternaFile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompoInternaFile  $compoInternaFile
     * @return \Illuminate\Http\Response
     */
    public function show(CompoInternaFile $compoInternaFile)
    {
        
        return $compoInternaFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompoInternaFile  $compoInternaFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompoInternaFile $compoInternaFile)
    {
        $compoInternaFile->name = $request->name;
        $compoInternaFile->save();
        return $compoInternaFile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompoInternaFile  $compoInternaFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompoInternaFile $compoInternaFile)
    {
        $compoInternaFile->estado = 0;
        $compoInternaFile->save();
    }
}
