<?php

namespace App\Http\Controllers;

use App\Models\CompoExternaFile;
use Illuminate\Http\Request;

class CompoExternaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompoExternaFile::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compoExternaFile = new CompoExternaFile();
        $compoExternaFile->name = $request->name;
        $compoExternaFile->save();
        return $compoExternaFile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompoExternaFile  $compoExternaFile
     * @return \Illuminate\Http\Response
     */
    public function show(CompoExternaFile $compoExternaFile)
    {
        
        return $compoExternaFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompoExternaFile  $compoExternaFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompoExternaFile $compoExternaFile)
    {
        $compoExternaFile->name = $request->name;
        $compoExternaFile->save();
        return $compoExternaFile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompoExternaFile  $compoExternaFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompoExternaFile $compoExternaFile)
    {
        $compoExternaFile->estado = 0;
        $compoExternaFile->save();
    }
}
