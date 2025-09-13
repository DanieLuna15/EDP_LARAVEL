<?php

namespace App\Http\Controllers;

use App\Models\ClienteFile;
use Illuminate\Http\Request;

class ClienteFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClienteFile::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clienteFile = new ClienteFile();
        $clienteFile->name = $request->name;
        $clienteFile->save();
        return $clienteFile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClienteFile  $clienteFile
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteFile $clienteFile)
    {
        
        return $clienteFile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClienteFile  $clienteFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteFile $clienteFile)
    {
        $clienteFile->name = $request->name;
        $clienteFile->save();
        return $clienteFile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClienteFile  $clienteFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteFile $clienteFile)
    {
        $clienteFile->estado = 0;
        $clienteFile->save();
    }
}
