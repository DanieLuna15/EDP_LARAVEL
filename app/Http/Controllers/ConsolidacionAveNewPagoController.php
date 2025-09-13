<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CompraAve;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ConsolidacionAveNew;
use Illuminate\Support\Facades\Log;
use App\Models\ConsolidacionAveNewPago;
use App\Models\ConsolidacionAveNewPagoTicket;
use App\Models\ConsolidacionAveNewPagoDetalle;

class ConsolidacionAveNewPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ConsolidacionAveNewPago::all();
        $list = [];
        foreach ($model as $s) {
            $detalles = ConsolidacionAveNewPagoDetalle::with(['Consolidacion'])->where('consolidacion_pago_id', $s->id)->get()->map(function ($item) {
                $item->valor_compra = $item->Consolidacion->valor_total;
                return $item;
            });
            $s->valor_compra = $detalles->sum('valor_compra');
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->url_pdf = url("reportes/consolidacion_aves_newPagos/$s->id");
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
        // Crear un nuevo registro de pago de consolidación
        $consolidacionPago = new ConsolidacionAveNewPago();
        $consolidacionPago->user_id = $request->user_id;
        $consolidacionPago->sucursal_id = $request->sucursal_id;
        $consolidacionPago->banco_id = $request->banco_id;
        $consolidacionPago->formapago_id = $request->formapago_id;
        $consolidacionPago->observaciones = $request->observaciones;
        $consolidacionPago->suma_total = $request->valor_total;
        $consolidacionPago->adelanto = $request->adelanto;
        $consolidacionPago->tipo = $request->tipo;
        $consolidacionPago->fecha_limite = $request->tipo == 1 ? Carbon::now()->format('Y-m-d') : $request->fecha;
        $consolidacionPago->save();

        // Guardar detalles de los lotes
        foreach ($request->lotes as $m) {
            $consolidacionPagoDetalle = new ConsolidacionAveNewPagoDetalle();
            $consolidacionPagoDetalle->consolidacion_id = $m['id'];
            $consolidacionPagoDetalle->consolidacion_pago_id = $consolidacionPago->id;
            $consolidacionPagoDetalle->save();
        }

        // Crear ticket de pago
        $ConsolidacionAvePagoTicket = new ConsolidacionAveNewPagoTicket();
        $ConsolidacionAvePagoTicket->consolidacion_pago_id = $consolidacionPago->id;
        $ConsolidacionAvePagoTicket->banco_id = $request->banco_id;
        $ConsolidacionAvePagoTicket->formapago_id = $request->formapago_id;
        $ConsolidacionAvePagoTicket->observaciones = $request->observaciones;
        $ConsolidacionAvePagoTicket->total = $request->valor_total;
        $ConsolidacionAvePagoTicket->monto = $request->adelanto;
        $ConsolidacionAvePagoTicket->pendiente = floatval($request->valor_total) - floatval($request->adelanto);
        $ConsolidacionAvePagoTicket->deuda = floatval($request->valor_total) - floatval($request->adelanto);
        $ConsolidacionAvePagoTicket->save();

        // Generar URL del PDF
        $consolidacionPago->url_pdf = url("reportes/consolidacion_aves_newPagos/$consolidacionPago->id");

        // Retornar el objeto de pago de consolidación
        return $consolidacionPago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsolidacionAveNewPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $consolidacionPago = ConsolidacionAveNewPago::with([
            'Sucursal',
            'Sucursal.Filesucursals.File',
            'ConsolidacionPagoTickets.Banco',  // Cargar relación Banco
            'ConsolidacionPagoTickets.Formapago',  // Cargar relación Formapago
            'ConsolidacionPagoDetalles.Consolidacion' // Cargar relación de detalles
        ])->findOrFail($id);  // 'findOrFail' devolverá un error 404 si no encuentra el registro
        $consolidacionPago->sucursal->file_sucursals = $consolidacionPago->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);  // Asignamos la URL del archivo
        });

        $consolidacionPago->consolidacion_ave_pago_tickets = $consolidacionPago->consolidacionPagoTickets->map(function ($item) {
            // Mapear información adicional a los tickets
            $item->banco = $item->Banco;
            $item->formapago = $item->Formapago;
            $item->fecha_hora = $item->created_at->format('d-m-Y H:i:s');  // Formato de fecha
            return $item;
        });
        $consolidacionPago->sucursal->image = $consolidacionPago->sucursal->file_sucursals->first();
        $consolidacionPago->user = $consolidacionPago->User;
        $consolidacionPago->consolidacion_pago_detalles = $consolidacionPago->ConsolidacionPagoDetalles()->get()->each(function ($consolidacion) {
            $consolidacion->consolidacion = $this->consolidacion($consolidacion->Consolidacion); // Asignar detalles adicionales
        });

        $detalles = ConsolidacionAveNewPagoDetalle::with(['Consolidacion'])
            ->where('consolidacion_pago_id', $consolidacionPago->id)
            ->get()
            ->map(function ($item) {
                $item->valor_compra = $item->Consolidacion->valor_total;  // Calcular el valor de la compra
                return $item;
            });
        $consolidacionPago->valor_compra = $detalles->sum('valor_compra');
        return $consolidacionPago;
    }

    public function consolidacion(ConsolidacionAveNew $consolidacion)
    {
        //$consolidacion->compra = $this->compra($consolidacion->compra);
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsolidacionAveNewPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $consolidacionPago = ConsolidacionAveNewPago::find($id);
        if (!$consolidacionPago) {
            return response()->json(['error' => 'ConsolidacionPago no encontrado'], 404);
        }
        $consolidacionPago->name = $request->name;
        $consolidacionPago->save();
        return $consolidacionPago;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsolidacionAveNewPago  $consolidacionPago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consolidacionPago = ConsolidacionAveNewPago::find($id);
        $consolidacionPago->estado = 0;
        $consolidacionPago->save();
        $detalles = ConsolidacionAveNewPagoDetalle::where('consolidacion_pago_id', $consolidacionPago->id)->get();
        foreach ($detalles as $d) {
            $d->estado = 0;
            $d->save();
        }
    }
    public function pdf($id)
    {
        $consolidacionPago = $this->show($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.consolidacionpago', ["consolidacionPago" => $consolidacionPago]);
        $pdf->setPaper('a4', 'landscape')->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function ticketpdf($id)
    {
        $consolidacionPago = $this->show($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.consolidacion_new.consolidacionpago', ["consolidacionPago" => $consolidacionPago]);
        return $pdf->stream();
    }
}
