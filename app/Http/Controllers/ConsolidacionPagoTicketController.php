<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Consolidacion;
use App\Models\ConsolidacionPago;
use App\Models\ConsolidacionPagoTicket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ConsolidacionPagoTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  ConsolidacionPagoTicket::with(['ConsolidacionPago','Banco'])->where('estado',1)->get();
        $list = [];
        foreach($model as $s){
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->fecha = $s->created_at->format('Y-m-d');
            $s->url_pdf = url("reportes/consolidacionPagoTickets/$s->id");
            $s->ConsolidacionPago->url_pdf = url("reportes/consolidacionPagos/{$s->ConsolidacionPago->id}");
            $list[]=$s;
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consolidacionPagoTicket = new ConsolidacionPagoTicket();
        $consolidacionPagoTicket->monto = $request->valor;
        $consolidacionPagoTicket->total = $request->total;
        $consolidacionPagoTicket->deuda = $request->pendiente;
        $consolidacionPagoTicket->banco_id = $request->banco_id;
        $consolidacionPagoTicket->formapago_id = $request->formapago_id;
        $consolidacionPagoTicket->observaciones = $request->observaciones;
        $consolidacionPagoTicket->pendiente = $request->pendiente - $request->valor;
        $consolidacionPagoTicket->consolidacion_pago_id = $request->id;
        $consolidacionPagoTicket->save();
        $consolidacionPago =ConsolidacionPago::find($request->id);
        $consolidacionPago->adelanto =  $consolidacionPago->adelanto + $request->valor;
        $consolidacionPago->save();
        $consolidacionPagoTicket->url_pdf = url("reportes/consolidacionPagoTickets/$consolidacionPagoTicket->id");
        return $consolidacionPagoTicket;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionPagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionPagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->consolidacionPago = $this->consolidacionPago($consolidacionPagoTicket->consolidacionPago);
        return $consolidacionPagoTicket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionPagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionPagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->name = $request->name;
        $consolidacionPagoTicket->save();
        return $consolidacionPagoTicket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionPagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionPagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->estado = 0;
        $consolidacionPagoTicket->save();
    }
    public function consolidacionPago(ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago->sucursal = $consolidacionPago->Sucursal;
        $consolidacionPago->sucursal->file_sucursals = $consolidacionPago->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $consolidacionPago->sucursal->image = $consolidacionPago->sucursal->file_sucursals->first();
        $consolidacionPago->user = $consolidacionPago->User;
        $consolidacionPago->consolidacion_pago_detalles = $consolidacionPago->ConsolidacionPagoDetalles()->get()->each(function($consolidacion){
            $consolidacion->consolidacion = $this->consolidacion($consolidacion->Consolidacion);
        });
        return $consolidacionPago;
    }
    public function consolidacion(Consolidacion $consolidacion)
    {
        $consolidacion->compra = $this->compra($consolidacion->compra);
        $consolidacion->detalles= $consolidacion->ConsolidacionDetalles()->get();
        return $consolidacion;
    }
    public function compra(Compra $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles = $compra->CompraInventarios()->get()->groupBy('sub_medida_id');
        $list=[];
        foreach($detalles as $d){
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list[] =  ["sub_medida"=>$submedida,"list"=>$sub];
        }
        $categorias = $compra->CompraInventarios()->get()->groupBy('categoria_id');
        $category_List=[];
        foreach($categorias as $d){
            $sub = $d;
            $categoria = $sub->first()->categoria;


            $category_List[] =  [
                "categoria"=>$categoria,
                "sumaTotal"=>$sub->sum('valor'),
                "sumaPollos"=>$sub->sum('nro'),
                "taras"=>$sub->sum('cant'),
                "criterio"=>0,
                "precio"=>0,
                "nuevoajuste"=>0,
            ];
        }
        $compra->category_list = $category_List;
        $compra->detalles = $list;
        return $compra;
    }
    public function ticket(ConsolidacionPagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPago = $this->show($consolidacionPagoTicket);

    $pdf = Pdf::loadView('reportes.pdf.almacen.ticketpago', ["consolidacionPagoTicket"=>$consolidacionPagoTicket])->setPaper('a4', 'landscape');
    return $pdf->stream();
    }
}
