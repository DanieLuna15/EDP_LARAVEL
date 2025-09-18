<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\PagoGlobal;
use App\Models\ArqueoVenta;
use App\Models\EntregaCaja;
use Illuminate\Http\Request;
use App\Models\DespachoArqueo;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\EntregaCajaRecuperada;

class DespachoArqueoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DespachoArqueo::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = Venta::find($request->venta['id']);
        if (!$venta) {
            return response()->json(['error' => 'Venta no encontrada.'], 404);
        }

        if (isset($request->entregado)) {
            if ($venta->entregado !== 2) {
                Log::info('Venta entregada');
                $venta->entregado = $request->entregado === 2 ? 2 : 1;
            } else {
                Log::info('La venta ya está entregada, no se cambiará el estado.');
            }
        }

        $observacionCajas = trim($request->observacion_cajas ?? '');
        $observacionPago = trim($request->observacion_pago ?? '');

        if ($observacionCajas || $observacionPago) {
            $venta->observacion = trim(implode(' | ', array_filter([
                $observacionCajas,
                $observacionPago
            ], function ($value) {
                return $value !== '';
            })));
        }

        $monto = $venta->pendiente_total;
        if ($venta->pendiente_total > 0) {
            $monto_pagado = $request->pago_con;
            if ($monto_pagado > $venta->pendiente_total) {
                $monto_pagado = $venta->pendiente_total;
            }
            $venta->pendiente_total -= $monto_pagado;
            $venta->pagado_total += $monto_pagado;
            if ($venta->pendiente_total <= 0) {
                $venta->pendiente_total = 0;
            }

            $venta->save();
        }
        $venta->despachado = 2;
        $venta->metodo_pago = $request->venta['metodo_pago'];
        $venta->save();

        $cliente = $venta->Cliente;
        $chofer_id = $venta->chofer_id;

        $total_cajas_vendidas = $cliente->VentaCajas()->sum('cajas');
        $total_cajas_entregadas = $cliente->EntregaCajas()->sum('cajas');
        $saldo_anterior = $total_cajas_vendidas - $total_cajas_entregadas;
        $cajas_a_entregar = $request->cajas_entregar;

        $entregaCajaRecuperada = null;
        if ($cajas_a_entregar > 0) {
            # code...
            $entregaCaja = new EntregaCaja();
            $cajas_recuperadas = 0;

            if ($cajas_a_entregar > $saldo_anterior) {
                $cajas_recuperadas = $cajas_a_entregar - $saldo_anterior;
                $cajas_a_entregar_real = $saldo_anterior;
                $saldo_actual = 0;
            } else {
                $cajas_a_entregar_real = $cajas_a_entregar;
                $saldo_actual = $saldo_anterior - $cajas_a_entregar_real;
            }

            $entregaCaja->cliente_id = $cliente->id;
            $entregaCaja->cajas = $cajas_a_entregar_real;
            $entregaCaja->saldo_anterior = $saldo_anterior;
            $entregaCaja->saldo_actual = $saldo_actual;
            $entregaCaja->fecha = date('Y-m-d');
            $entregaCaja->chofer_id = $chofer_id;
            $entregaCaja->venta_id = $venta->id;
            if ($observacionCajas) {
                $entregaCaja->observacion = $observacionCajas;
            }
            $entregaCaja->save();

            if ($cajas_recuperadas > 0) {
                $entregaCajaRecuperada = EntregaCajaRecuperada::create([
                    'cliente_id' => $cliente->id,
                    'cajas' => $cajas_recuperadas,
                    'fecha' => date('Y-m-d'),
                    'estado' => 1,
                    'entrega_id' => $entregaCaja->id,
                    'chofer_id' => $chofer_id,
                ]);
            }
            // $venta->url_pdf_cobranza = url("reportes/cobranzas-oficial-ind/{$arqueoVenta->id}");
            $venta->url_pdf_cajas = url("reportes/cajas-oficial/{$entregaCaja->id}");
            $venta->url_pdf_cajas_chofer = url("reportes/cajas-oficial-chofer/{$entregaCaja->id}");

        }

        $arqueoData = $request->arqueo;
        if (
            !$arqueoData ||
            !isset($arqueoData['arqueo_activo']) ||
            !isset($arqueoData['arqueo_activo']['id'])
        ) {
            return response()->json(['error' => 'Arqueo activo no válido'], 422);
        }

        $arqueoActivo = $arqueoData['arqueo_activo'];
        if (!isset($arqueoActivo['apertura']) || $arqueoActivo['apertura'] != 1) {
            return response()->json(['error' => 'El arqueo no está abierto (apertura ≠ 1)'], 422);
        }
        /////pago_con
        if ($request->pago_con > 0) {

            $arqueoVenta = new ArqueoVenta();
            $arqueoVenta->arqueo_id = $arqueoActivo['id'];
            $arqueoVenta->venta_id = $request->venta['id'];
            $arqueoVenta->formapago_id = $request->formapago_id;
            $arqueoVenta->user_id = $arqueoActivo['user_id'];
            $arqueoVenta->banco_id = $request->input('banco_id', $request->input('venta.banco_id'));
            $arqueoVenta->comprobante_pago = $request->input('comprobante_pago', $request->input('venta.comprobante_pago'));

            $arqueoVenta->pago_con = $request->pago_con;
            if ($request->pago_con > $monto) {
                $arqueoVenta->cambio = $request->pago_con - $monto;
                $arqueoVenta->monto = $monto;
            } else {
                $arqueoVenta->cambio = 0;
                $arqueoVenta->monto = $request->pago_con;
            }
            if ($observacionPago) {
                $arqueoVenta->observacion = $observacionPago;
            }
            $arqueoVenta->save();

            // $entregaCajaRecuperadaId = $entregaCajaRecuperada ? $entregaCajaRecuperada->id : 0;
            $venta->url_pdf_cobranza = url("reportes/cobranzas-oficial-ind/{$arqueoVenta->id}");
            // $venta->url_pdf_cajas = url("reportes/cajas-oficial/{$entregaCaja->id}");
            // $venta->url_pdf_cajas_chofer = url("reportes/cajas-oficial-chofer/{$entregaCaja->id}");
        }


        return response()->json([
            'url_pdf_cobranza' => $venta->url_pdf_cobranza,
            'url_pdf_cajas' => $venta->url_pdf_cajas,
            'url_pdf_cajas_chofer' => $venta->url_pdf_cajas_chofer,
            'venta' => $venta
        ]);
    }


    // public function pagarVenta(Request $request)
    // {
    //     $ventaIds = $request->ventaIds;
    //     $monto = $request->monto;
    //     $despacho = $request->despacho;
    //     $formapago_id = $request->formapago_id ?? ($despacho['formapago_id'] ?? null);


    //     if (!is_array($ventaIds) || empty($ventaIds)) {
    //         return response()->json(['error' => 'No se seleccionaron ventas'], 422);
    //     }

    //     if (
    //         !isset($despacho['arqueo']) ||
    //         !isset($despacho['arqueo']['arqueo_activo']) ||
    //         !isset($despacho['arqueo']['arqueo_activo']['id'])
    //     ) {
    //         return response()->json(['error' => 'Arqueo activo no válido'], 422);
    //     }

    //     $arqueoActivo = $despacho['arqueo']['arqueo_activo'];

    //     if (!isset($arqueoActivo['apertura']) || $arqueoActivo['apertura'] != 1) {
    //         return response()->json(['error' => 'El arqueo no está abierto (apertura ≠ 1)'], 422);
    //     }


    //     $ventasPagadas = [];
    //     $arqueoVentaIds = [];

    //     foreach ($ventaIds as $ventaId) {
    //         $venta = Venta::find($ventaId);
    //         if (!$venta) continue;

    //         $pagar = $venta->pendiente_total;
    //         if ($pagar <= 0) continue;

    //         $venta->pendiente_total = 0;
    //         $venta->pagado_total += $pagar;
    //         $venta->save();

    //         $arqueoVenta = new ArqueoVenta();
    //         $arqueoVenta->arqueo_id = $arqueoActivo['id'];
    //         $arqueoVenta->venta_id = $venta->id;
    //         $arqueoVenta->formapago_id = $formapago_id;
    //         $arqueoVenta->user_id = $arqueoActivo['user_id'];
    //         $arqueoVenta->monto = $pagar;
    //         $arqueoVenta->pago_con = $pagar;
    //         $arqueoVenta->cambio = 0;
    //         $arqueoVenta->save();

    //         $arqueoVentaIds[] = $arqueoVenta->id;

    //         $ventasPagadas[] = [
    //             'id' => $venta->id,
    //             'pagado' => $pagar
    //         ];
    //     }

    //     if (count($ventasPagadas) > 0) {
    //         $pagoGlobal = new PagoGlobal();
    //         $pagoGlobal->user_id = $arqueoActivo['user_id'];
    //         $pagoGlobal->formapago_id = $formapago_id;
    //         $pagoGlobal->monto_total = $monto;
    //         $pagoGlobal->estado = 1;
    //         $pagoGlobal->save();
    //         $pagoGlobal->arqueoVentas()->attach($arqueoVentaIds);
    //     }

    //     if (count($ventasPagadas) == 0) {
    //         return response()->json(['error' => 'No se pudo pagar ninguna venta'], 422);
    //     }

    //     $url_pdf_cobranza = url("reportes/cobranza-global-oficial/{$pagoGlobal->id}");
    //     return response()->json([
    //         'success' => true,
    //         'ventas_pagadas' => $ventasPagadas,
    //         'url_pdf_cobranza' => $url_pdf_cobranza,
    //         'message' => 'El pago de crédito de ' . count($ventasPagadas) . ' venta(s) ha sido pagado exitosamente'
    //     ]);
    // }


    public function pagarVenta(Request $request)
    {
        $ventaIds = $request->ventaIds;
        $monto = $request->monto;
        $despacho = $request->despacho;
        $formapago_id = $request->formapago_id ?? ($despacho['formapago_id'] ?? null);

        if (!is_array($ventaIds) || empty($ventaIds)) {
            return response()->json(['error' => 'No se seleccionaron ventas'], 422);
        }

        if (
            !isset($despacho['arqueo']) ||
            !isset($despacho['arqueo']['arqueo_activo']) ||
            !isset($despacho['arqueo']['arqueo_activo']['id'])
        ) {
            return response()->json(['error' => 'Arqueo activo no válido'], 422);
        }

        $arqueoActivo = $despacho['arqueo']['arqueo_activo'];

        if (!isset($arqueoActivo['apertura']) || $arqueoActivo['apertura'] != 1) {
            return response()->json(['error' => 'El arqueo no está abierto (apertura ≠ 1)'], 422);
        }

        $ventasPagadas = [];
        $arqueoVentaIds = [];

        foreach ($ventaIds as $ventaId) {
            $venta = Venta::find($ventaId);
            if (!$venta) continue;

            $pagar = min($venta->pendiente_total, $monto);


            if ($pagar <= 0) continue;

            $venta->pendiente_total -= $pagar;
            $venta->pagado_total += $pagar;
            $venta->save();

            $arqueoVenta = new ArqueoVenta();
            $arqueoVenta->arqueo_id = $arqueoActivo['id'];
            $arqueoVenta->venta_id = $venta->id;
            $arqueoVenta->formapago_id = $formapago_id;
            $arqueoVenta->user_id = $arqueoActivo['user_id'];
            $arqueoVenta->monto = $pagar;
            $arqueoVenta->pago_con = $pagar;
            $arqueoVenta->cambio = 0;
            $arqueoVenta->banco_id = $request->input('banco_id', data_get($despacho, 'banco_id'));
            $arqueoVenta->comprobante_pago = $request->input('comprobante_pago', data_get($despacho, 'comprobante_pago'));
            $arqueoVenta->save();

            $arqueoVentaIds[] = $arqueoVenta->id;

            $ventasPagadas[] = [
                'id' => $venta->id,
                'pagado' => $pagar
            ];

            $monto -= $pagar;

            if ($monto <= 0) break;
        }

        if (count($ventasPagadas) == 0) {
            return response()->json(['error' => 'No se pudo pagar ninguna venta'], 422);
        }

        $pagoGlobal = new PagoGlobal();
        $pagoGlobal->user_id = $arqueoActivo['user_id'];
        $pagoGlobal->formapago_id = $formapago_id;
        $pagoGlobal->monto_total = $request->monto;
        $pagoGlobal->estado = 1;
        $pagoGlobal->save();

        $pagoGlobal->arqueoVentas()->attach($arqueoVentaIds);

        $url_pdf_cobranza = url("reportes/cobranza-global-oficial/{$pagoGlobal->id}");

        return response()->json([
            'success' => true,
            'ventas_pagadas' => $ventasPagadas,
            'url_pdf_cobranza' => $url_pdf_cobranza,
            'message' => 'El pago de crédito de ' . count($ventasPagadas) . ' venta(s) ha sido pagado exitosamente'
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DespachoArqueo  $despachoArqueo
     * @return \Illuminate\Http\Response
     */
    public function show(DespachoArqueo $despachoArqueo)
    {

        return $despachoArqueo;
    }

    public function obtenerVentasCredito($clienteId)
    {
        $cliente = Cliente::find($clienteId);
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $ventasCredito = $cliente->Ventas()
            ->whereIn('metodo_pago', [2, 3, 4])
            ->where('pendiente_total', '>', 0)
            ->where('estado', 1)
            ->where('despachado', 2)
            ->get();

        return response()->json($ventasCredito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DespachoArqueo  $despachoArqueo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DespachoArqueo $despachoArqueo)
    {
        $despachoArqueo->name = $request->name;
        $despachoArqueo->save();
        return $despachoArqueo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DespachoArqueo  $despachoArqueo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DespachoArqueo $despachoArqueo)
    {
        $despachoArqueo->estado = 0;
        $despachoArqueo->save();
    }
}
