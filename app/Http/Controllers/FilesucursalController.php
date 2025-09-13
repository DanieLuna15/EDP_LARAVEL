<?php

namespace App\Http\Controllers;

use App\Models\Filesucursal;
use Illuminate\Http\Request;

class FilesucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Filesucursal::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filesucursal = new Filesucursal();
        $filesucursal->name = $request->name;
        $filesucursal->save();
        return $filesucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filesucursal  $filesucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Filesucursal $filesucursal)
    {
        
        return $filesucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filesucursal  $filesucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filesucursal $filesucursal)
    {
        $filesucursal->name = $request->name;
        $filesucursal->save();
        return $filesucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filesucursal  $filesucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filesucursal $filesucursal)
    {
        $filesucursal->estado = 0;
        $filesucursal->save();
    }
}
