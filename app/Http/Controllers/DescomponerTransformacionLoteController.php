<?php

namespace App\Http\Controllers;

use App\Models\DescomponerTransformacionLote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DescomponerTransformacionLoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DescomponerTransformacionLote::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->items_sobra as $v) {
            $DescomponerTransformacionLote = new DescomponerTransformacionLote();
            $DescomponerTransformacionLote->transformacion_lote_id = $request->transformacion_lote_id;
            $DescomponerTransformacionLote->user_id = $request->user_id;
            $DescomponerTransformacionLote->sucursal_id = $request->sucursal_id;
            $DescomponerTransformacionLote->subitem_id = $v['id'];
            $DescomponerTransformacionLote->recep = $v['recep'];
            $DescomponerTransformacionLote->cajas = $v['cajas'];
            $DescomponerTransformacionLote->peso_bruto = $v['peso_bruto'];
            $DescomponerTransformacionLote->peso_neto = $v['peso_neto'];
            $DescomponerTransformacionLote->item_id = $v['item_descomoponer']['item']['id'];
            $DescomponerTransformacionLote->fecha_hora = Carbon::now();
            $DescomponerTransformacionLote->save();
        }
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescomponerTransformacionLote  $descomponerTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function show(DescomponerTransformacionLote $descomponerTransformacionLote)
    {

        return $descomponerTransformacionLote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DescomponerTransformacionLote  $descomponerTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DescomponerTransformacionLote $descomponerTransformacionLote)
    {
        $descomponerTransformacionLote->name = $request->name;
        $descomponerTransformacionLote->save();
        return $descomponerTransformacionLote;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescomponerTransformacionLote  $descomponerTransformacionLote
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescomponerTransformacionLote $descomponerTransformacionLote)
    {
        $descomponerTransformacionLote->estado = 0;
        $descomponerTransformacionLote->save();
    }
}
