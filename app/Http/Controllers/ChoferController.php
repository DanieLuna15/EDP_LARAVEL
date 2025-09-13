<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;
class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Chofer::with(['Documento','EstadoCompraChofer'])->where('estado',1)->get();
    }
    public function turno()
    {
        $model = Chofer::with(['Documento','EstadoCompraChofer'])->where('estado',1)->get();
        $lista = [];
        foreach ($model as $chofer) {
            $lista[] = $this->show($chofer);
        }
        return $lista;
    }

    public function choferes()
    {
        $choferes = Chofer::with(['documento'])
            ->where('estado', 1)
            ->get();
        return $choferes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chofer = new Chofer();
        $chofer->nombre = $request->nombre;
        $chofer->documento_id = $request->documento_id;
        $chofer->doc = $request->doc;
        $chofer->zona = $request->zona;
        $chofer->modelo = $request->modelo;
        $chofer->placa = $request->placa;
        $chofer->color = $request->color;
        $chofer->capacidad = $request->capacidad;
        $chofer->estado_compra_chofer_id = $request->estado_compra_chofer_id;
        $chofer->save();
        return $chofer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(Chofer $chofer)
    {
        $chofer->turno_chofer = $chofer->TurnoChofer;
        $ventasPeso = 0;
        if($chofer->turno_chofer != null){
            $chofer->turno_pdf = url("reportes/turnoChofers/{$chofer->TurnoChofer->id}");
            $ventasPeso = $chofer->TurnoChofer->VentaTurnoChofers()->get()->sum('peso');
            $chofer->TurnoChofer->venta_turno_chofer = $chofer->TurnoChofer->VentaTurnoChofers()->get()->each(function($item){
                $item->url_pdf = url("reportes/ventas/{$item->Venta->id}");
            });
        }
        $chofer->capacidad_utilizada = $ventasPeso;
        return $chofer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chofer $chofer)
    {
        $chofer->nombre = $request->nombre;
        $chofer->documento_id = $request->documento_id;
        $chofer->doc = $request->doc;
        $chofer->zona = $request->zona;
        $chofer->modelo = $request->modelo;
        $chofer->placa = $request->placa;
        $chofer->color = $request->color;
        $chofer->capacidad = $request->capacidad;
        $chofer->estado_compra_chofer_id = $request->estado_compra_chofer_id;
        $chofer->save();
        return $chofer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chofer $chofer)
    {
        $chofer->estado = 0;
        $chofer->save();
    }
}
