<?php

namespace App\Http\Controllers;

use App\Models\CompraAve;
use App\Models\ConsolidacionAve;
use App\Models\ConsolidacionAvePago;
use App\Models\ConsolidacionAvePagoTicket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ConsolidacionAvePagoTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $model = ConsolidacionAvePagoTicket::with(['ConsolidacionPago', 'Banco'])->where('estado', 1)->get();
        $list = [];
        foreach ($model as $s) {
            $s->fecha = $s->created_at->format('Y-m-d');
            $s->url_pdf = url("reportes/consolidacion_avesPagoTickets/$s->id");
            $s->ConsolidacionPago->url_pdf = url("reportes/consolidacion_avesPagos/{$s->ConsolidacionPago->id}");
            $list[] = $s;
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
        // Crear el nuevo ConsolidacionAvePagoTicket
        $consolidacionPagoTicket = new ConsolidacionAvePagoTicket();
        $consolidacionPagoTicket->monto = $request->valor;
        $consolidacionPagoTicket->total = $request->total;
        $consolidacionPagoTicket->deuda = $request->pendiente;
        $consolidacionPagoTicket->banco_id = $request->banco_id;
        $consolidacionPagoTicket->formapago_id = $request->formapago_id;
        $consolidacionPagoTicket->observaciones = $request->observaciones;
        $consolidacionPagoTicket->pendiente = $request->pendiente - $request->valor;
        $consolidacionPagoTicket->consolidacion_pago_id = $request->id;

        // Guardar el ticket
        $consolidacionPagoTicket->save();
        // Actualizar el ConsolidacionAvePago
        $consolidacionPago = ConsolidacionAvePago::find($request->id);
        $consolidacionPago->adelanto =  $consolidacionPago->adelanto + $request->valor;
        $consolidacionPago->save();
        // Agregar el URL del PDF
        $consolidacionPagoTicket->url_pdf = url("reportes/consolidacion_avesPagoTickets/$consolidacionPagoTicket->id");
        return $consolidacionPagoTicket;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAvePagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function show(ConsolidacionAvePagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->consolidacionPago = $this->consolidacionPago($consolidacionPagoTicket->consolidacionPago);
        return $consolidacionPagoTicket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAvePagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsolidacionAvePagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->name = $request->name;
        $consolidacionPagoTicket->save();
        return $consolidacionPagoTicket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAvePagoTicket  $consolidacionPagoTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsolidacionAvePagoTicket $consolidacionPagoTicket)
    {
        $consolidacionPagoTicket->estado = 0;
        $consolidacionPagoTicket->save();
    }
    public function consolidacionPago(ConsolidacionAvePago $consolidacionPago)
    {
        $consolidacionPago->sucursal = $consolidacionPago->Sucursal;
        $consolidacionPago->sucursal->file_sucursals = $consolidacionPago->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $consolidacionPago->sucursal->image = $consolidacionPago->sucursal->file_sucursals->first();
        $consolidacionPago->user = $consolidacionPago->User;
        $consolidacionPago->consolidacion_pago_detalles = $consolidacionPago->ConsolidacionPagoDetalles()->get()->each(function ($consolidacion) {
            $consolidacion->consolidacion = $this->consolidacion($consolidacion->Consolidacion);
        });
        return $consolidacionPago;
    }
    public function consolidacion(ConsolidacionAve $consolidacion)
    {
        $consolidacion->compra = $this->compra($consolidacion->compra);
        $consolidacion->detalles = $consolidacion->ConsolidacionDetalles()->get();
        return $consolidacion;
    }
    public function compra(CompraAve $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles = $compra->CompraInventarios()->get()->groupBy('sub_medida_id');
        $list = [];
        foreach ($detalles as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list[] =  ["sub_medida" => $submedida, "list" => $sub];
        }
        $categorias = $compra->CompraInventarios()->get()->groupBy('categoria_id');
        $category_List = [];
        foreach ($categorias as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;


            $category_List[] =  [
                "categoria" => $categoria,
                "sumaTotal" => $sub->sum('valor'),
                "sumaPollos" => $sub->sum('nro'),
                "taras" => $sub->sum('cant'),
                "criterio" => 0,
                "precio" => 0,
                "nuevoajuste" => 0,
            ];
        }
        $compra->category_list = $category_List;
        $compra->detalles = $list;
        return $compra;
    }

    public function ticket($id)
    {
        $consolidacionPagoTicket = ConsolidacionAvePagoTicket::find($id);
        $consolidacionPago = $this->show($consolidacionPagoTicket);
        try {
            $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.ticketpago', [
                "consolidacionPagoTicket" => $consolidacionPagoTicket
            ])->setPaper('a4', 'landscape');

            Log::info("PDF generado exitosamente para el ticket ID: " . $consolidacionPagoTicket->id);
            return $pdf->stream();
        } catch (\Exception $e) {
            Log::error("Error al generar el PDF para el ticket ID: " . $consolidacionPagoTicket->id, ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error al generar el PDF'], 500);
        }
    }
}
