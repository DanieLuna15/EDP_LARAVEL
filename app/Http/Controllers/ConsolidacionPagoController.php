<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Consolidacion;
use App\Models\ConsolidacionPago;
use App\Models\ConsolidacionPagoDetalle;
use App\Models\ConsolidacionPagoTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ConsolidacionPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ConsolidacionPago::all();
        $list = [];
        foreach($model as $s){
            $detalles = ConsolidacionPagoDetalle::with(['Consolidacion'])->where('consolidacion_pago_id',$s->id)->get()->map(function($item){
                $item->valor_compra = $item->Consolidacion->valor_total;
                return $item;
            });
            $s->valor_compra = $detalles->sum('valor_compra');
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->url_pdf = url("reportes/consolidacionPagos/$s->id");
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
        $consolidacionPago = new ConsolidacionPago();
        $consolidacionPago->user_id = $request->user_id;
        $consolidacionPago->sucursal_id = $request->sucursal_id;
        $consolidacionPago->banco_id = $request->banco_id;
        $consolidacionPago->formapago_id = $request->formapago_id;
        $consolidacionPago->observaciones = $request->observaciones;
        $consolidacionPago->suma_total = $request->valor_total;
        $consolidacionPago->adelanto = $request->adelanto;
        $consolidacionPago->tipo = $request->tipo;
        $consolidacionPago->fecha_limite = $request->tipo==1?Carbon::now()->format('Y-m-d'):$request->fecha;
        $consolidacionPago->save();
        foreach($request->lotes as $m){
            $consolidacionPagoDetalle = new ConsolidacionPagoDetalle();
            $consolidacionPagoDetalle->consolidacion_id = $m['id'];
            $consolidacionPagoDetalle->consolidacion_pago_id = $consolidacionPago->id;
            $consolidacionPagoDetalle->save();

        }
        $ConsolidacionPagoTicket = new ConsolidacionPagoTicket();
        $ConsolidacionPagoTicket->consolidacion_pago_id = $consolidacionPago->id;
        $ConsolidacionPagoTicket->banco_id = $request->banco_id;
        $ConsolidacionPagoTicket->formapago_id = $request->formapago_id;
        $ConsolidacionPagoTicket->observaciones = $request->observaciones;
        $ConsolidacionPagoTicket->total = $request->valor_total;
        $ConsolidacionPagoTicket->monto = $request->adelanto;
        $ConsolidacionPagoTicket->pendiente = floatval($request->valor_total)-floatval($request->adelanto);
        $ConsolidacionPagoTicket->deuda = floatval($request->valor_total)-floatval($request->adelanto);
        $ConsolidacionPagoTicket->save();
        $consolidacionPago->url_pdf = url("reportes/consolidacionPagos/$consolidacionPago->id");
        return $consolidacionPago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago->sucursal = $consolidacionPago->Sucursal;
        $consolidacionPago->sucursal->file_sucursals = $consolidacionPago->sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        $consolidacionPago->consolidacion_pago_tickets = $consolidacionPago->ConsolidacionPagoTickets()->get()->map(function($item){
            $item->banco = $item->Banco;
            $item->formapago = $item->Formapago;
            $item->fecha_hora = $item->created_at->format('d-m-Y H:i:s');
            return $item;
        });
        $consolidacionPago->sucursal->image = $consolidacionPago->sucursal->file_sucursals->first();
        $consolidacionPago->user = $consolidacionPago->User;
        $consolidacionPago->consolidacion_pago_detalles = $consolidacionPago->ConsolidacionPagoDetalles()->get()->each(function($consolidacion){
            $consolidacion->consolidacion = $this->consolidacion($consolidacion->Consolidacion);
        });
        $detalles = ConsolidacionPagoDetalle::with(['Consolidacion'])->where('consolidacion_pago_id',$consolidacionPago->id)->get()->map(function($item){
            $item->valor_compra = $item->Consolidacion->valor_total;
            return $item;
        });
        $consolidacionPago->valor_compra = $detalles->sum('valor_compra');
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago->name = $request->name;
        $consolidacionPago->save();
        return $consolidacionPago;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago->estado = 0;
        $consolidacionPago->save();
        $detalles = ConsolidacionPagoDetalle::where('consolidacion_pago_id',$consolidacionPago->id)->get();
        foreach($detalles as $d){
            $d->estado = 0;
            $d->save();
        }
    }
    public function pdf(ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago = $this->show($consolidacionPago);

        $pdf = Pdf::loadView('reportes.pdf.almacen.consolidacionpago', ["consolidacionPago"=>$consolidacionPago])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ticketpdf(ConsolidacionPago $consolidacionPago)
    {
        $consolidacionPago = $this->show($consolidacionPago);

    $pdf = Pdf::loadView('reportes.pdf.almacen.consolidacionpago', ["consolidacionPago"=>$consolidacionPago]);
    return $pdf->stream();
    }

}
