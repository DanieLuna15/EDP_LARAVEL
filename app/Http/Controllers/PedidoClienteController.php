<?php

namespace App\Http\Controllers;

use App\Models\PedidoCliente;
use App\Models\PedidoClienteDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use COM;
use Illuminate\Http\Request;

class PedidoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PedidoCliente::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = PedidoCliente::with(['Cliente','Chofer'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           $m->url_pdf = url("reportes/pedidoClientes/$m->id");

            $list[] = $m;
        }
        return $list;
    }
    public function store(Request $request)
    {
        $pedidoCliente = new PedidoCliente();
        $pedidoCliente->fecha_entrega = $request->fecha_entrega;
        $pedidoCliente->hora_entrega = $request->hora_entrega;
        $pedidoCliente->tiempo = $request->tiempo;
        $pedidoCliente->cliente_id = $request->cliente_id;
        $pedidoCliente->formapago_id = $request->formapago_id;
        $pedidoCliente->tipo = $request->tipopago;
        $pedidoCliente->sucursal_id = $request->sucursal_id;
        $pedidoCliente->chofer_id = $request->chofer_id;
        $pedidoCliente->fecha = Carbon::now()->format('Y-m-d');
        $pedidoCliente->save();
        $pedidoCliente->url_pdf = url("reportes/pedidoClientes/$pedidoCliente->id");
        foreach($request->pedido_items as $item){
            $pedidoClienteDetalle = new PedidoClienteDetalle();
            $pedidoClienteDetalle->pedido_cliente_id = $pedidoCliente->id;
            $pedidoClienteDetalle->item_id = $item['item']['id'];
            $pedidoClienteDetalle->cajas = $item['cajas'];
            $pedidoClienteDetalle->pollos = $item['pollos'];
            $pedidoClienteDetalle->peso_bruto = $item['peso_bruto'];
            $pedidoClienteDetalle->peso_neto = $item['peso_neto'];
            $pedidoClienteDetalle->tara = $item['tara'];
            $pedidoClienteDetalle->peso_neto_unitario = $item['peso_neto_unitario'];
            $pedidoClienteDetalle->save();
        }
        return $pedidoCliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoCliente $pedidoCliente)
    {
        
        return $pedidoCliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidoCliente $pedidoCliente)
    {
        $pedidoCliente->name = $request->name;
        $pedidoCliente->save();
        return $pedidoCliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidoCliente  $pedidoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoCliente $pedidoCliente)
    {
        $pedidoCliente->estado = 0;
        $pedidoCliente->save();
    }
    public function pdf(PedidoCliente $pedidoCliente)
    {
        $pedidoCliente = $this->show($pedidoCliente);
        $sucursal = $pedidoCliente->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $pdf = Pdf::loadView('reportes.pdf.pedidos.nota', ["pedidoCliente"=>$pedidoCliente,
        "sucursal"=>$sucursal
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
