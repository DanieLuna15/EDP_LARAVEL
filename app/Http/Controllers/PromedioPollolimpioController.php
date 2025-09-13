<?php

namespace App\Http\Controllers;

use App\Models\PromedioPollolimpio;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class PromedioPollolimpioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PromedioPollolimpio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promedioPollolimpio = new PromedioPollolimpio();
        $promedioPollolimpio->precio_1 = $request->precio_1;
        $promedioPollolimpio->precio_2 = $request->precio_2;
        $promedioPollolimpio->precio_3 = $request->precio_3;
        $promedioPollolimpio->precio_4 = $request->precio_4;
        $promedioPollolimpio->precio_5 = $request->precio_5;
        $promedioPollolimpio->precio_6 = $request->precio_6;
        $promedioPollolimpio->peso_1 = $request->peso_1;
        $promedioPollolimpio->peso_2 = $request->peso_2;
        $promedioPollolimpio->peso_3 = $request->peso_3;
        $promedioPollolimpio->peso_4 = $request->peso_4;
        $promedioPollolimpio->peso_5 = $request->peso_5;
        $promedioPollolimpio->peso_6 = $request->peso_6;
        $promedioPollolimpio->sucursal_id = $request->sucursal_id;
        $promedioPollolimpio->save();
        return $promedioPollolimpio;
    }
    public function listaSucursal(Sucursal $sucursal)
    {
        $pollo = PromedioPollolimpio::where('sucursal_id',$sucursal->id)->orderBy('id','desc')->get();
        if($pollo->count()>0){
            $pollo = $pollo[0];
        
            return $pollo;
        }
        return [];
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromedioPollolimpio  $promedioPollolimpio
     * @return \Illuminate\Http\Response
     */
    public function show(PromedioPollolimpio $promedioPollolimpio)
    {
        
        return $promedioPollolimpio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromedioPollolimpio  $promedioPollolimpio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromedioPollolimpio $promedioPollolimpio)
    {
        $promedioPollolimpio->name = $request->name;
        $promedioPollolimpio->save();
        return $promedioPollolimpio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromedioPollolimpio  $promedioPollolimpio
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromedioPollolimpio $promedioPollolimpio)
    {
        $promedioPollolimpio->estado = 0;
        $promedioPollolimpio->save();
    }
}
