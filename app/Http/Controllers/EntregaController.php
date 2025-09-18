<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\PagoGlobal;
use App\Models\ArqueoVenta;
use App\Models\EntregaCaja;
use Illuminate\Http\Request;
use App\Models\ArqueoIngreso;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\EntregaCajaRecuperada;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venta = Venta::where('');
    }
    // public function fecha(Request $request)
    // {
    //     $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
    //     $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

    //     $model = Venta::with(['Cliente', 'Chofer'])->whereDate('fecha', '>=', $fecha_inicio)->whereDate('fecha', '<=', $fecha_fin)->get()->map(function ($item) {
    //         $cantidad_cajas = $item->Cliente->VentaCajas()->sum('cajas');
    //         $entrega_cajas = $item->Cliente->EntregaCajas()->sum('cajas');
    //         $item->cantidad_cajas = $cantidad_cajas - $entrega_cajas;
    //         $item->cajas_venta = optional($item->VentaCaja)->cajas ?? 0;
    //         $item->hora = Carbon::parse($item->created_at)->format('H:i:s a');
    //         $item->url_pdf = url("reportes/ventas/$item->id");
    //         $item->url_2_pdf = url("reportes/ventas-oficial/$item->id");

    //         $ventas_a_credito = $item->Cliente->Ventas()
    //             ->whereIn('metodo_pago', [2, 3])
    //             ->where('pendiente_total', '>', 0)
    //             ->where('estado', 1)
    //             ->get();

    //         $item->cliente->otras_pendientes_credito = $item->cliente->creditos_activos - $ventas_a_credito;

    //         return $item;
    //     });

    //     return $model;
    // }

    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = Venta::with(['Cliente', 'Chofer', 'User', 'Distribuidor'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('estado', 1)
            ->get()
            ->map(function ($item) {
                $cantidad_cajas = $item->Cliente->VentaCajas()->sum('cajas');
                $entrega_cajas = $item->Cliente->EntregaCajas()->sum('cajas');

                $item->cantidad_cajas = $cantidad_cajas - $entrega_cajas;
                $item->cajas_venta = optional($item->VentaCaja)->cajas ?? 0;
                $item->hora = Carbon::parse($item->created_at)->format('H:i:s a');
                $item->url_pdf = url("reportes/ventas/$item->id");
                $item->url_2_pdf = url("reportes/ventas-oficial/$item->id");
                $item->url_3_pdf = url("reportes/ticket-ventas-oficial/$item->id");
                $ventas_a_credito = $item->Cliente->Ventas()
                    ->whereIn('metodo_pago', [2, 3, 4])
                    ->where('pendiente_total', '>', 0)
                    ->where('estado', 1)
                    ->get();
                $item->cliente->otras_pendientes_credito = $item->cliente->creditos_activos - $ventas_a_credito->count();

                return $item;
            });

        return $model;
    }

    public function fechaCliente(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $query = Venta::with(['Cliente', 'Chofer', 'User', 'Distribuidor', 'Preventista'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('estado', 1);

        if ($request->has('cliente_id') && $request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }

        if ($request->has('user_id') && $request->user_id) {
            $query->where('distribuidor_id', $request->user_id);
        }

        $model = $query->get()->map(function ($item) {
            $cantidad_cajas = $item->Cliente->VentaCajas()->sum('cajas');
            $entrega_cajas = $item->Cliente->EntregaCajas()->sum('cajas');
            $item->cantidad_cajas = $cantidad_cajas - $entrega_cajas;
            $item->cajas_venta = optional($item->VentaCaja)->cajas ?? 0;
            $item->hora = Carbon::parse($item->created_at)->format('H:i:s a');
            $item->url_pdf = url("reportes/ventas/$item->id");
            $item->url_2_pdf = url("reportes/ventas-oficial/$item->id");
            $item->url_3_pdf = url("reportes/ticket-ventas-oficial/$item->id");

            $ventas_a_credito = $item->Cliente->Ventas()
                    ->whereIn('metodo_pago', [2, 3, 4])
                    ->where('pendiente_total', '>', 0)
                    ->where('estado', 1)
                    ->get();
            $item->cliente->otras_pendientes_credito = $item->cliente->creditos_activos - $ventas_a_credito->count();
            return $item;
        });
        return $model;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filtrarPorFechaDevolucionGeneral(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        session([
            'fecha_inicio_devolucion_general' => $request->fecha_inicio,
            'fecha_fin_devolucion_general' => $request->fecha_fin,
        ]);

        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $entregas = EntregaCaja::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('estado', 1)
            ->get();

        $devoluciones = [];

        foreach ($entregas as $entrega) {
            $cliente = $entrega->Cliente;
            if (!$cliente) continue;
            $chofer = $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER';
            $saldo_anterior = $entrega->saldo_anterior;
            $cantidad_devuelta = $entrega->cajas;
            $saldo_actual = $entrega->saldo_actual;

            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');

            $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
                ->whereDate('fecha', '=', $entrega->fecha)
                ->where('entrega_id', $entrega->id)
                ->sum('cajas');

            if (!isset($devoluciones[$fecha])) {
                $devoluciones[$fecha] = [];
            }

            if (!isset($devoluciones[$fecha][$chofer])) {
                $devoluciones[$fecha][$chofer] = [];
            }

            $url_pdf_cajas = url("reportes/cajas-oficial/{$entrega->id}");
            $url_pdf_cajas_chofer = url("reportes/cajas-oficial-chofer/{$entrega->id}");

            $devoluciones[$fecha][$chofer][] = [
                'id_cliente' => $cliente->id,
                'cliente' => $cliente->nombre,
                'saldo_anterior' => $saldo_anterior,
                'cantidad_devuelta' => $cantidad_devuelta,
                'saldo_actual' => $saldo_actual,
                'cajas_a_favor' => $cajas_a_favor,
                'usuario' => $chofer,
                'url_pdf_cajas'         => $url_pdf_cajas,
                'url_pdf_cajas_chofer'  => $url_pdf_cajas_chofer,
            ];
        }

        $totalDevolucion = 0;
        $totalSaldoActual = 0;
        $totalCajasAFavor = 0;

        foreach ($devoluciones as $fecha => $choferes) {
            foreach ($choferes as $chofer => $clientes) {
                $clientesGrouped = collect($clientes)->groupBy('id_cliente');
                foreach ($clientesGrouped as $clienteId => $registros) {
                    $ultimoRegistro = $registros->last();
                    $totalSaldoActual += $ultimoRegistro['saldo_actual'];
                    $totalDevolucion += $registros->sum('cantidad_devuelta');
                    $totalCajasAFavor += $registros->sum('cajas_a_favor');
                }
            }
        }

        $fechaImpresion = now()->format('Y-m-d H:i:s');

        // Ordena fechas y choferes
        ksort($devoluciones);
        foreach ($devoluciones as $fecha => $choferes) {
            ksort($choferes);
        }

        $url_pdf = url('/reportes/reporte-devolucion-general');

        return response()->json([
            'devoluciones' => $devoluciones,
            'totalDevolucion' => $totalDevolucion,
            'totalSaldoActual' => $totalSaldoActual,
            'totalCajasAFavor' => $totalCajasAFavor,
            'fechaImpresion' => $fechaImpresion,
            'url_pdf' => $url_pdf,
        ]);
    }

    public function pdfReporteDevolucionGeneral()
    {
        $fecha_inicio = session('fecha_inicio_devolucion_general');
        $fecha_fin = session('fecha_fin_devolucion_general');

        if (!$fecha_inicio || !$fecha_fin) {
            abort(400, 'Debe seleccionar un rango de fechas.');
        }

        $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');


        $entregas = EntregaCaja::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('estado', 1)
            ->get();

        $devoluciones = [];

        foreach ($entregas as $entrega) {
            $cliente = $entrega->Cliente;
            if (!$cliente) continue;
            $chofer = $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER';
            $saldo_anterior = $entrega->saldo_anterior;
            $cantidad_devuelta = $entrega->cajas;
            $saldo_actual = $entrega->saldo_actual;

            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');

            $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
                ->whereDate('fecha', '=', $entrega->fecha)
                ->where('entrega_id', $entrega->id)
                ->sum('cajas');

            if (!isset($devoluciones[$fecha])) {
                $devoluciones[$fecha] = [];
            }

            if (!isset($devoluciones[$fecha][$chofer])) {
                $devoluciones[$fecha][$chofer] = [];
            }

            $devoluciones[$fecha][$chofer][] = [
                'id_cliente' => $cliente->id,
                'cliente' => $cliente->nombre,
                'saldo_anterior' => $saldo_anterior,
                'cantidad_devuelta' => $cantidad_devuelta,
                'saldo_actual' => $saldo_actual,
                'cajas_a_favor' => $cajas_a_favor,
                'usuario' => $chofer,
            ];
        }

        $totalDevolucion = 0;
        $totalSaldoActual = 0;
        $totalCajasAFavor = 0;

        foreach ($devoluciones as $fecha => $choferes) {
            foreach ($choferes as $chofer => $clientes) {
                $clientesGrouped = collect($clientes)->groupBy('id_cliente');
                foreach ($clientesGrouped as $clienteId => $registros) {
                    $ultimoRegistro = $registros->last();
                    $totalSaldoActual += $ultimoRegistro['saldo_actual'];
                    $totalDevolucion += $registros->sum('cantidad_devuelta');
                    $totalCajasAFavor += $registros->sum('cajas_a_favor');
                }
            }
        }

        $fechaImpresion = now()->format('Y-m-d H:i:s');

        ksort($devoluciones);

        foreach ($devoluciones as $fecha => $choferes) {
            ksort($choferes);
        }

        $fechaImpresion = now()->format('Y-m-d H:i:s');

        $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.devoluciones_general', compact(
            'devoluciones',
            'totalDevolucion',
            'totalSaldoActual',
            'totalCajasAFavor',
            'fechaImpresion',
            'fecha_inicio',
            'fecha_fin'
        ))
            ->setPaper('a4', 'landscape')
            ->setOption('enable_php', true);

        return $pdf->stream('reporte_devoluciones_general.pdf');
    }


    // public function pdfReporteDevolucionGeneral()
    // {
    //     $fecha_inicio = session('fecha_inicio_devolucion_general');
    //     $fecha_fin = session('fecha_fin_devolucion_general');

    //     if (!$fecha_inicio || !$fecha_fin) {
    //         abort(400, 'Debe seleccionar un rango de fechas.');
    //     }

    //     $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
    //     $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');


    //     $entregas = EntregaCaja::with(['Cliente'])
    //         ->whereDate('fecha', '>=', $fecha_inicio)
    //         ->whereDate('fecha', '<=', $fecha_fin)
    //         ->where('estado', 1)
    //         ->get();

    //     $devoluciones = [];

    //     foreach ($entregas as $entrega) {
    //         $cliente = $entrega->Cliente;
    //         if (!$cliente) continue;

    //         $venta = Venta::where('cliente_id', $cliente->id)->latest()->first();
    //         $chofer = $venta ? $venta->Chofer->nombre : 'SIN CHOFER';

    //         $saldo_anterior = $entrega->saldo_anterior;
    //         $cantidad_devuelta = $entrega->cajas;
    //         $saldo_actual = $entrega->saldo_actual;

    //         $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');

    //         $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
    //             ->whereDate('fecha', '=', $entrega->fecha)
    //             ->where('entrega_id', $entrega->id)
    //             ->sum('cajas');


    //         if (!isset($devoluciones[$fecha])) {
    //             $devoluciones[$fecha] = [];
    //         }

    //         if (!isset($devoluciones[$fecha][$chofer])) {
    //             $devoluciones[$fecha][$chofer] = [];
    //         }
    //         $devoluciones[$fecha][$chofer][] = [
    //             'id_cliente' => $cliente->id,
    //             'cliente' => $cliente->nombre,
    //             'saldo_anterior' => $saldo_anterior,
    //             'cantidad_devuelta' => $cantidad_devuelta,
    //             'saldo_actual' => $saldo_actual,
    //             'cajas_a_favor' => $cajas_a_favor,
    //             'usuario' => $chofer,
    //         ];
    //     }

    //     $totalDevolucion = 0;
    //     $totalSaldoActual = 0;
    //     $totalCajasAFavor = 0;

    //     foreach ($devoluciones as $fecha => $choferes) {
    //         foreach ($choferes as $chofer => $clientes) {
    //             foreach ($clientes as $devolucion) {
    //                 $totalDevolucion += $devolucion['cantidad_devuelta'];
    //                 $totalSaldoActual += $devolucion['saldo_actual'];
    //                 $totalCajasAFavor += $devolucion['cajas_a_favor'];
    //             }
    //         }
    //     }

    //     $fechaImpresion = now()->format('Y-m-d H:i:s');

    //     ksort($devoluciones);

    //     foreach ($devoluciones as $fecha => $choferes) {
    //         ksort($choferes);
    //     }

    //     $fechaImpresion = now()->format('Y-m-d H:i:s');

    //     $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.devoluciones_general', compact(
    //         'devoluciones',
    //         'totalDevolucion',
    //         'totalSaldoActual',
    //         'totalCajasAFavor',
    //         'fechaImpresion',
    //         'fecha_inicio',
    //         'fecha_fin'
    //     ))
    //         ->setPaper('a4', 'landscape')
    //         ->setOption('enable_php', true);

    //     return $pdf->stream('reporte_devoluciones_general.pdf');
    // }
    // public function pdfReporteDevolucionGeneral()
    // {
    //     $fecha_inicio = session('fecha_inicio_devolucion_general');
    //     $fecha_fin = session('fecha_fin_devolucion_general');

    //     if (!$fecha_inicio || !$fecha_fin) {
    //         abort(400, 'Debe seleccionar un rango de fechas.');
    //     }

    //     $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
    //     $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');


    //     $entregas = EntregaCaja::with(['Cliente'])
    //         ->whereDate('fecha', '>=', $fecha_inicio)
    //         ->whereDate('fecha', '<=', $fecha_fin)
    //         ->where('estado', 1)
    //         ->get();

    //     $devoluciones = [];

    //     foreach ($entregas as $entrega) {
    //         $cliente = $entrega->Cliente;
    //         if (!$cliente) continue;

    //         $venta = Venta::where('cliente_id', $cliente->id)->latest()->first();
    //         $chofer = $venta ? $venta->Chofer->nombre : 'SIN CHOFER';

    //         $saldo_anterior = $entrega->saldo_anterior;
    //         $cantidad_devuelta = $entrega->cajas;
    //         $saldo_actual = $entrega->saldo_actual;

    //         $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');

    //         $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
    //             ->whereDate('fecha', '=', $entrega->fecha)
    //             ->where('entrega_id', $entrega->id)
    //             ->sum('cajas');


    //         if (!isset($devoluciones[$fecha])) {
    //             $devoluciones[$fecha] = [];
    //         }

    //         if (!isset($devoluciones[$fecha][$chofer])) {
    //             $devoluciones[$fecha][$chofer] = [];
    //         }
    //         $devoluciones[$fecha][$chofer][] = [
    //             'id_cliente' => $cliente->id,
    //             'cliente' => $cliente->nombre,
    //             'saldo_anterior' => $saldo_anterior,
    //             'cantidad_devuelta' => $cantidad_devuelta,
    //             'saldo_actual' => $saldo_actual,
    //             'cajas_a_favor' => $cajas_a_favor,
    //             'usuario' => $chofer,
    //         ];
    //     }

    //     $totalDevolucion = 0;
    //     $totalSaldoActual = 0;
    //     $totalCajasAFavor = 0;

    //     foreach ($devoluciones as $fecha => $choferes) {
    //         foreach ($choferes as $chofer => $clientes) {
    //             foreach ($clientes as $devolucion) {
    //                 $totalDevolucion += $devolucion['cantidad_devuelta'];
    //                 $totalSaldoActual += $devolucion['saldo_actual'];
    //                 $totalCajasAFavor += $devolucion['cajas_a_favor'];
    //             }
    //         }
    //     }

    //     $fechaImpresion = now()->format('Y-m-d H:i:s');

    //     ksort($devoluciones);

    //     foreach ($devoluciones as $fecha => $choferes) {
    //         ksort($choferes);
    //     }

    //     $fechaImpresion = now()->format('Y-m-d H:i:s');

    //     $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.devoluciones_general', compact(
    //         'devoluciones',
    //         'totalDevolucion',
    //         'totalSaldoActual',
    //         'totalCajasAFavor',
    //         'fechaImpresion',
    //         'fecha_inicio',
    //         'fecha_fin'
    //     ))
    //         ->setPaper('a4', 'landscape')
    //         ->setOption('enable_php', true);

    //     return $pdf->stream('reporte_devoluciones_general.pdf');
    // }
    public function pdfReporteDevolucionGeneral3()
    {
        // Recuperamos las fechas de la sesión
        $fecha_inicio = session('fecha_inicio_devolucion_general');
        $fecha_fin = session('fecha_fin_devolucion_general');

        // Recupera la fecha de fin de la sesión
        if (!$fecha_inicio || !$fecha_fin) {
            /**
             * Validamos que las fechas estén disponibles.
             * Si no están, abortamos la operación con un error 400.
             */
            abort(400, 'Debe seleccionar un rango de fechas.');
        }

        $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
        // Convertimos las fechas al formato adecuado (Y-m-d)
        $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');

        $entregas = EntregaCaja::with(['Cliente', 'Chofer'])
            /**
             * Obtenemos las entregas de cajas dentro del rango de fechas.
             * Incluimos la relación con Cliente y Chofer.
             */
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('estado', 1)
            ->get();

        // Array para almacenar los datos de las devoluciones
        $devoluciones = [];

        foreach ($entregas as $entrega) {
            $cliente = $entrega->Cliente;
            // Iteramos sobre las entregas para calcular devoluciones por cliente
            if (!$cliente) continue;

            $saldo_anterior = $entrega->saldo_anterior;
            // Calculamos el saldo y las cajas devueltas
            $cantidad_devuelta = $entrega->cajas;
            $saldo_actual = $entrega->saldo_actual;

            // Cajas a favor (sumar todas las cajas recuperadas del cliente)
            $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
                ->whereDate('fecha', '>=', $fecha_inicio)
                ->whereDate('fecha', '<=', $fecha_fin)

                ->sum('cajas');
            // Información del chofer relacionado con la venta
            $chofer = $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER';

            // Agrupamos los datos por día, chofer y cliente
            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y'); // Formato de la fecha (día)

            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');
            if (!isset($devoluciones[$fecha])) {
                $devoluciones[$fecha] = [];
            }

            if (!isset($devoluciones[$fecha][$chofer])) {
                $devoluciones[$fecha][$chofer] = [];
            }

            // Aquí almacenamos los datos de cada cliente por día y chofer
            $devoluciones[$fecha][$chofer][] = [
                'id_cliente' => $cliente->id,
                'cliente' => $cliente->nombre,
                'saldo_anterior' => $saldo_anterior,
                'cantidad_devuelta' => $cantidad_devuelta,
                'saldo_actual' => $saldo_actual,
                'cajas_a_favor' => $cajas_a_favor,
                'usuario' => $entrega->usuario,
            ];
        }

        // Agregamos los totales
        $totalDevolucion = 0;
        $totalSaldoActual = 0;
        $totalCajasAFavor = 0;

        foreach ($devoluciones as $fecha => $choferes) {
            foreach ($choferes as $chofer => $clientes) {
                foreach ($clientes as $devolucion) {
                    $totalDevolucion += $devolucion['cantidad_devuelta'];
                    $totalSaldoActual += $devolucion['saldo_actual'];
                    $totalCajasAFavor += $devolucion['cajas_a_favor'];
                }
            }
        }

        // Fecha de impresión
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        // Generamos el PDF
        $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.devoluciones_general', compact(
            'devoluciones',
            'totalDevolucion',
            'totalSaldoActual',
            'totalCajasAFavor',
            'fechaImpresion'
        ))
            ->setPaper('a4', 'landscape')
            ->setOption('enable_php', true);

        return $pdf->stream('reporte_devoluciones_general.pdf');
    }

    public function filtrarPorFechaSeguimientoCliente(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        session([
            'fecha_inicio_seguimiento_cliente' => $request->fecha_inicio,
            'fecha_fin_seguimiento_cliente' => $request->fecha_fin,
            'cliente_id_seguimiento_cliente' => $request->cliente_id,
        ]);

        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');
        $cliente_id = $request->cliente_id;

        $entregas = EntregaCaja::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('cliente_id', $cliente_id)
            ->where('estado', 1)
            ->get();

        $devoluciones = [];

        foreach ($entregas as $entrega) {
            $cliente = $entrega->Cliente;
            if (!$cliente) continue;

            $chofer = $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER';
            $saldo_anterior = $entrega->saldo_anterior;
            $cantidad_devuelta = $entrega->cajas;
            $saldo_actual = $entrega->saldo_actual;

            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');
            $dia = Carbon::parse($entrega->fecha)->locale('es')->isoFormat('dddd');

            $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
                ->whereDate('fecha', '=', $entrega->fecha)
                ->where('entrega_id', $entrega->id)
                ->sum('cajas');

            if (!isset($devoluciones[$fecha])) {
                $devoluciones[$fecha] = [];
            }

            if (!isset($devoluciones[$fecha][$chofer])) {
                $devoluciones[$fecha][$chofer] = [];
            }

            $devoluciones[$fecha][$chofer][] = [
                'id_cliente' => $cliente->id,
                'cliente' => $cliente->nombre,
                'fecha' => $fecha,
                'dia' => $dia,
                'saldo_anterior' => $saldo_anterior,
                'cantidad_devuelta' => $cantidad_devuelta,
                'saldo_actual' => $saldo_actual,
                'cajas_a_favor' => $cajas_a_favor,
                'usuario' => $chofer,
            ];
        }

        $totalDevolucion = 0;
        $totalSaldoActual = 0;
        $totalCajasAFavor = 0;

        foreach ($devoluciones as $fecha => $choferes) {
            foreach ($choferes as $chofer => $clientes) {
                $clientesGrouped = collect($clientes)->groupBy('id_cliente');
                foreach ($clientesGrouped as $clienteId => $registros) {
                    $ultimoRegistro = $registros->last();
                    $totalSaldoActual += $ultimoRegistro['saldo_actual'];
                    $totalDevolucion += $registros->sum('cantidad_devuelta');
                    $totalCajasAFavor += $registros->sum('cajas_a_favor');
                }
            }
        }

        $fechaImpresion = now()->format('Y-m-d H:i:s');
        ksort($devoluciones);
        foreach ($devoluciones as $fecha => $choferes) {
            ksort($choferes);
        }
        $url_pdf = url('/reportes/reporte-seguimiento-cliente');
        $entregas_a_cliente = Venta::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('cliente_id', $cliente_id)
            ->get()
            ->map(function ($item) {
                $cantidad_cajas = $item->Cliente->VentaCajas()->sum('cajas');
                $entrega_cajas = $item->Cliente->EntregaCajas()->sum('cajas');
                $cantidad_cajas_restantes = $cantidad_cajas - $entrega_cajas;
                $item->cantidad_cajas_restantes = $cantidad_cajas_restantes;
                $item->cajas_venta = optional($item->VentaCaja)->cajas ?? 0;
                $item->hora = Carbon::parse($item->created_at)->format('H:i:s a');
                return [
                    'id' => $item->id,
                    'fecha' => Carbon::parse($item->fecha)->format('d/m/Y'),
                    'dia' => Carbon::parse($item->fecha)->locale('es')->isoFormat('dddd'),
                    'chofer' => $item->Chofer ? $item->Chofer->nombre : 'SIN CHOFER',
                    'cajas_entregadas' => $item->cajas_venta,
                    'saldo' => $cantidad_cajas_restantes,
                ];
            });
        return response()->json([
            'devoluciones' => $entregas->map(function ($entrega) {
                return [
                    'id' => $entrega->id,
                    'fecha' => Carbon::parse($entrega->fecha)->format('d/m/Y'),
                    'dia' => Carbon::parse($entrega->fecha)->locale('es')->isoFormat('dddd'),
                    'chofer' => $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER',
                    'cajas_entregadas' => $entrega->cajas,
                    'saldo' => $entrega->saldo_actual,
                ];
            }),
            'entregas' => $entregas_a_cliente,
            'totalDevolucion' => $totalDevolucion,
            'totalSaldoActual' => $totalSaldoActual,
            'totalCajasAFavor' => $totalCajasAFavor,
            'fechaImpresion' => $fechaImpresion,
            'url_pdf' => $url_pdf,
        ]);
    }

    public function pdfSeguimientoCliente()
    {
        $fecha_inicio = session('fecha_inicio_seguimiento_cliente');
        $fecha_fin = session('fecha_fin_seguimiento_cliente');
        $cliente_id = session('cliente_id_seguimiento_cliente');

        if (!$fecha_inicio || !$fecha_fin || !$cliente_id) {
            abort(400, 'Debe seleccionar un rango de fechas.');
        }

        $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');
        $cliente = Cliente::find($cliente_id);
        $nombreCliente = $cliente ? $cliente->nombre : 'Cliente no encontrado';

        $entregas = EntregaCaja::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('cliente_id', $cliente_id)
            ->where('estado', 1)
            ->get();

        $devoluciones = [];

        foreach ($entregas as $entrega) {
            $cliente = $entrega->Cliente;
            if (!$cliente) continue;

            $chofer = $entrega->Chofer ? $entrega->Chofer->nombre : 'SIN CHOFER';
            $saldo_anterior = $entrega->saldo_anterior;
            $cantidad_devuelta = $entrega->cajas;
            $saldo_actual = $entrega->saldo_actual;

            $fecha = Carbon::parse($entrega->fecha)->format('d/m/Y');
            $dia = Carbon::parse($entrega->fecha)->locale('es')->isoFormat('dddd');

            $cajas_a_favor = EntregaCajaRecuperada::where('cliente_id', $cliente->id)
                ->whereDate('fecha', '=', $entrega->fecha)
                ->where('entrega_id', $entrega->id)
                ->sum('cajas');

            if (!isset($devoluciones[$fecha])) {
                $devoluciones[$fecha] = [];
            }

            if (!isset($devoluciones[$fecha][$chofer])) {
                $devoluciones[$fecha][$chofer] = [];
            }

            $devoluciones[$fecha][$chofer][] = [
                'id' => $entrega->id,
                'cliente' => $cliente->nombre,
                'fecha' => $fecha,
                'dia' => $dia,
                'saldo_anterior' => $saldo_anterior,
                'cantidad_devuelta' => $cantidad_devuelta,
                'saldo_actual' => $saldo_actual,
                'cajas_a_favor' => $cajas_a_favor,
                'usuario' => $chofer,
            ];
        }

        $totalDevolucion = 0;
        $totalSaldoActual = 0;
        $totalCajasAFavor = 0;

        foreach ($devoluciones as $fecha => $choferes) {
            foreach ($choferes as $chofer => $clientes) {
                $clientesGrouped = collect($clientes)->groupBy('id_cliente');
                foreach ($clientesGrouped as $clienteId => $registros) {
                    $ultimoRegistro = $registros->last();
                    $totalSaldoActual += $ultimoRegistro['saldo_actual'];
                    $totalDevolucion += $registros->sum('cantidad_devuelta');
                    $totalCajasAFavor += $registros->sum('cajas_a_favor');
                }
            }
        }
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        ksort($devoluciones);
        foreach ($devoluciones as $fecha => $choferes) {
            ksort($choferes);
        }

        $url_pdf = url('/reportes/reporte-seguimiento-cliente');

        Log::info('Generada URL del reporte PDF:', ['url_pdf' => $url_pdf]);
        Log::info('Devoluciones data:', ['devoluciones' => $devoluciones]);
        $entregas_a_cliente = Venta::with(['Cliente', 'Chofer'])
            ->whereDate('fecha', '>=', $fecha_inicio)
            ->whereDate('fecha', '<=', $fecha_fin)
            ->where('cliente_id', $cliente_id)
            ->get()
            ->map(function ($item) {
                $cantidad_cajas = $item->Cliente->VentaCajas()->sum('cajas');
                $entrega_cajas = $item->Cliente->EntregaCajas()->sum('cajas');
                $cantidad_cajas_restantes = $cantidad_cajas - $entrega_cajas;

                $item->cantidad_cajas_restantes = $cantidad_cajas_restantes;
                $item->cajas_venta = optional($item->VentaCaja)->cajas ?? 0;
                $item->hora = Carbon::parse($item->created_at)->format('H:i:s a');

                return [
                    'id' => $item->id,
                    'fecha' => Carbon::parse($item->fecha)->format('d/m/Y'),
                    'dia' => Carbon::parse($item->fecha)->locale('es')->isoFormat('dddd'),
                    'chofer' => $item->Chofer ? $item->Chofer->nombre : 'SIN CHOFER',
                    'cajas_entregadas' => $item->cajas_venta,
                    'saldo' => $cantidad_cajas_restantes,
                ];
            });

        $totalEntregas = $entregas_a_cliente->sum('cajas_entregadas');

        $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.seguimiento_cliente', [
            'devoluciones' => $devoluciones,
            'entregas' => $entregas_a_cliente,
            'totalEntregas' => $totalEntregas,
            'totalDevoluciones' => $totalDevolucion,
            'fechaImpresion' => $fechaImpresion,
            'nombreCliente' => $nombreCliente,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ])
            ->setPaper('a4', 'portrait')
            ->setOption('enable_php', true);

        return $pdf->stream('seguimiento_cliente.pdf');
    }

    // public function filtrarPorFechaClientesDeudores(Request $request)
    // {
    //     $request->validate([
    //         'fecha_inicio' => 'required|date',
    //         'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    //     ]);
    //     session([
    //         'fecha_inicio_clientes_deudores' => $request->fecha_inicio,
    //         'fecha_fin_clientes_deudores' => $request->fecha_fin,
    //     ]);
    //     $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
    //     $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

    //     $ventas = Venta::with(['Cliente', 'Chofer'])
    //         ->where('estado', 1)
    //         ->where('despachado', 2)
    //         ->whereDate('fecha', '>=', $fecha_inicio)
    //         ->whereDate('fecha', '<=', $fecha_fin)
    //         ->get();
    //     $deudores = [];
    //     foreach ($ventas as $venta) {
    //         $cliente = $venta->Cliente;
    //         if (!$cliente) continue;
    //         $cajas_vendidas = $cliente->VentaCajas()->sum('cajas');
    //         $cajas_entregadas = $cliente->EntregaCajas()->sum('cajas');
    //         $saldo_cajas = $cajas_vendidas - $cajas_entregadas;
    //         if ($saldo_cajas <= 0) continue;
    //         $chofer = $venta->Chofer ? $venta->Chofer->nombre : 'SIN CHOFER';
    //         $key = $chofer . '-' . $cliente->id;
    //         if (!isset($deudores[$chofer])) {
    //             $deudores[$chofer] = [];
    //         }
    //         if (isset($deudores[$chofer][$cliente->id])) {
    //             $deudores[$chofer][$cliente->id]['saldo_cajas'] += $saldo_cajas;
    //         } else {
    //             $deudores[$chofer][$cliente->id] = [
    //                 'codigo_cliente' => $cliente->id,
    //                 'nombre_cliente' => $cliente->nombre,
    //                 'fecha' => Carbon::parse($venta->fecha)->format('d/m/Y'),
    //                 'chofer' => $chofer,
    //                 'saldo_cajas' => $saldo_cajas,
    //             ];
    //         }
    //     }
    //     foreach ($deudores as $chofer => $clientes) {
    //         $deudores[$chofer] = array_values($clientes);
    //     }
    //     $url_pdf = url('/reportes/reporte-devolucion-clientes-por-chofer');
    //     return response()->json([
    //         'deudores' => $deudores,
    //         'url_pdf' => $url_pdf,
    //     ]);
    // }
    // public function pdfListaDeClientesDeudoresPorChofer()
    // {
    //     $fecha_inicio = session('fecha_inicio_clientes_deudores');
    //     $fecha_fin = session('fecha_fin_clientes_deudores');

    //     if (!$fecha_inicio || !$fecha_fin) {
    //         abort(400, 'Debe seleccionar un rango de fechas.');
    //     }
    //     $ventas = Venta::with(['Cliente', 'Chofer'])
    //         ->where('estado', 1)
    //         ->where('despachado', 2)
    //         ->whereDate('fecha', '>=', $fecha_inicio)
    //         ->whereDate('fecha', '<=', $fecha_fin)
    //         ->get();

    //     $deudores = [];

    //     foreach ($ventas as $venta) {
    //         $cliente = $venta->Cliente;
    //         if (!$cliente) continue;
    //         $cajas_vendidas = $cliente->VentaCajas()->sum('cajas');
    //         $cajas_entregadas = $cliente->EntregaCajas()->sum('cajas');
    //         $saldo_cajas = $cajas_vendidas - $cajas_entregadas;
    //         if ($saldo_cajas <= 0) continue;
    //         $chofer = $venta->Chofer ? $venta->Chofer->nombre : 'SIN CHOFER';
    //         if (!isset($deudores[$chofer])) {
    //             $deudores[$chofer] = [
    //                 'clientes' => [],
    //                 'total_saldo' => 0
    //             ];
    //         }
    //         if (isset($deudores[$chofer]['clientes'][$cliente->id])) {
    //             $deudores[$chofer]['clientes'][$cliente->id]['saldo_cajas'] += $saldo_cajas;
    //         } else {
    //             $deudores[$chofer]['clientes'][$cliente->id] = [
    //                 'codigo_cliente' => $cliente->id,
    //                 'nombre_cliente' => $cliente->nombre,
    //                 'fecha' => Carbon::parse($fecha_fin)->format('d/m/Y'),
    //                 'chofer' => $chofer,
    //                 'saldo_cajas' => $saldo_cajas,
    //             ];
    //         }
    //         $deudores[$chofer]['total_saldo'] += $saldo_cajas;
    //     }
    //     foreach ($deudores as $chofer => $data) {
    //         $deudores[$chofer]['clientes'] = array_values($data['clientes']);
    //     }
    //     $deudoresList = [];
    //     foreach ($deudores as $chofer => $data) {
    //         foreach ($data['clientes'] as $cliente) {
    //             $deudoresList[] = $cliente;
    //         }
    //     }
    //     $deudoresCollection = collect($deudoresList);
    //     $deudoresPorChofer = $deudoresCollection->groupBy('chofer');
    //     $totalesPorChofer = $deudoresPorChofer->map(function ($choferData) {
    //         return $choferData->sum('saldo_cajas');
    //     });
    //     $totalGeneral = $deudoresCollection->sum('saldo_cajas');
    //     $fechaImpresion = now()->format('Y-m-d H:i:s');
    //     $fecha_inicio = Carbon::parse($fecha_inicio);
    //     $fecha_fin = Carbon::parse($fecha_fin);
    //     $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.clientes_deudores_chofer', compact(
    //         'deudoresPorChofer',
    //         'totalesPorChofer',
    //         'totalGeneral',
    //         'fechaImpresion',
    //         'fecha_inicio',
    //         'fecha_fin'
    //     ))
    //         ->setPaper('a4')
    //         ->setOption('enable_php', true);

    //     return $pdf->stream('clientes_deudores_por_chofer.pdf');
    // }

    public function filtrarPorFechaClientesDeudores(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        session([
            'fecha_inicio_clientes_deudores' => $request->fecha_inicio,
            'fecha_fin_clientes_deudores' => $request->fecha_fin,
        ]);

        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        Log::debug('Filtrando clientes deudores desde:', ['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin]);

        $clientes = Cliente::with([
            'VentaCajas' => function ($query) {
                $query->whereHas('venta', function ($q) {
                    $q->where('estado', 1)->where('despachado', 2);
                });
            },
            'EntregaCajas',
            'Ventas' => function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
                    ->where('estado', 1)
                    ->where('despachado', 2)
                    ->with('Chofer');
            }
        ])->get();

        Log::debug('Total clientes cargados:', ['count' => $clientes->count()]);

        $deudores = [];

        foreach ($clientes as $cliente) {
            $cajas_vendidas = $cliente->VentaCajas->sum('cajas');
            $cajas_entregadas = $cliente->EntregaCajas->sum('cajas');
            $saldo_total = $cajas_vendidas - $cajas_entregadas;

            if ($saldo_total <= 0) continue;

            $ventas_validas = $cliente->Ventas;

            if ($ventas_validas->isEmpty()) continue;

            $choferes_relacionados = $ventas_validas->map(function ($venta) {
                return $venta->Chofer ? $venta->Chofer->nombre : 'SIN CHOFER';
            })->unique()->values()->all();

            $ultima_entrega = $cliente->EntregaCajas->sortByDesc('fecha')->first();
            $fecha_entrega = $ultima_entrega ? Carbon::parse($ultima_entrega->fecha)->format('d/m/Y') : 'SIN ENTREGA';

            $deudores[] = [
                'codigo_cliente' => $cliente->id,
                'nombre_cliente' => $cliente->nombre,
                'fecha' => $fecha_entrega,
                'saldo_cajas' => $saldo_total,
                'choferes_relacionados' => $choferes_relacionados,
            ];

            Log::debug('Cliente deudor agregado', [
                'cliente_id' => $cliente->id,
                'saldo_mostrado' => $saldo_total,
                'choferes_relacionados' => $choferes_relacionados
            ]);
        }

        Log::debug('Total de choferes con deudores:', ['total' => count($deudores)]);

        $url_pdf = url('/reportes/reporte-devolucion-clientes-por-chofer');

        return response()->json([
            'deudores' => $deudores,
            'url_pdf' => $url_pdf,
        ]);
    }
    public function pdfListaDeClientesDeudoresPorChofer()
    {
        $fecha_inicio = session('fecha_inicio_clientes_deudores');
        $fecha_fin = session('fecha_fin_clientes_deudores');

        if (!$fecha_inicio || !$fecha_fin) {
            abort(400, 'Debe seleccionar un rango de fechas.');
        }

        $fecha_inicio = Carbon::parse($fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($fecha_fin)->format('Y-m-d');

        $clientes = Cliente::with([
            'VentaCajas' => function ($query) {
                $query->whereHas('venta', function ($q) {
                    $q->where('estado', 1)->where('despachado', 2);
                });
            },
            'EntregaCajas',
            'Ventas' => function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
                    ->where('estado', 1)
                    ->where('despachado', 2)
                    ->with('Chofer');
            }
        ])->get();

        $deudores = [];

        foreach ($clientes as $cliente) {
            $cajas_vendidas = $cliente->VentaCajas->sum('cajas');
            $cajas_entregadas = $cliente->EntregaCajas->sum('cajas');
            $saldo_total = $cajas_vendidas - $cajas_entregadas;

            if ($saldo_total <= 0) continue;

            $ventas_validas = $cliente->Ventas;

            if ($ventas_validas->isEmpty()) continue;

            $choferes_relacionados = $ventas_validas->map(function ($venta) {
                return $venta->Chofer ? $venta->Chofer->nombre : 'SIN CHOFER';
            })->unique()->values()->all();

            $ultima_entrega = $cliente->EntregaCajas->sortByDesc('fecha')->first();
            $fecha_entrega = $ultima_entrega ? Carbon::parse($ultima_entrega->fecha)->format('d/m/Y') : 'SIN ENTREGA';

            $deudores[] = [
                'codigo_cliente' => $cliente->id,
                'nombre_cliente' => $cliente->nombre,
                'fecha' => $fecha_entrega,
                'saldo_cajas' => $saldo_total,
                'choferes_relacionados' => $choferes_relacionados,
            ];
        }

        $totalGeneral = collect($deudores)->sum('saldo_cajas');
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        $pdf = Pdf::loadView('reportes.pdf.devolucion_cajas.clientes_deudores_chofer', compact(
            'deudores',
            'totalGeneral',
            'fechaImpresion',
            'fecha_inicio',
            'fecha_fin'
        ))
            ->setPaper('a4')
            ->setOption('enable_php', true);

        return $pdf->stream('clientes_deudores.pdf');
    }

    private function obtenerVentasCredito($fecha_inicio = null, $fecha_fin = null, $cliente_id = null)
    {
        $query = Venta::whereIn('metodo_pago', [1, 2, 3, 4])
            ->where('pendiente_total', '>', 0)
            ->where('estado', 1)
            ->where('despachado', 2);
        if ($fecha_inicio && $fecha_fin) {
            $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        }
        if ($cliente_id && $cliente_id != 0) {
            $query->where('cliente_id', $cliente_id);
        }
        $ventasCredito = $query->get();
        $ventasPorCliente = $ventasCredito->groupBy('cliente_id')->map(function ($ventas) {
            return [
                'cliente_id' => $ventas[0]->cliente_id,
                'cliente_nombre' => $ventas[0]->cliente->nombre,
                'total_saldo_pendiente' => number_format($ventas->sum('pendiente_total'), 2, '.', ''),
                'ventas' => $ventas->map(function ($venta) {
                    return [
                        'id' => $venta->id,
                        'fecha' => $venta->fecha,
                        'sucursal_nombre' => $venta->Sucursal->nombre,
                        'usuario_nombre' => $venta->User->nombre . ' ' . $venta->User->apellidos,
                        'pagado_total' => $venta->pagado_total,
                        'pendiente_total' => $venta->pendiente_total
                    ];
                }),
            ];
        });
        return $ventasPorCliente;
    }

    public function filtrarPorFechaCuentasPorCobrarCliente(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cliente_id' => 'nullable',
        ]);
        session([
            'fecha_inicio_cuentas_por_cobrar' => $request->fecha_inicio,
            'fecha_fin_cuentas_por_cobrar' => $request->fecha_fin,
            'cliente_id_cuentas_por_cobrar' => $request->cliente_id
        ]);
        $ventasPorCliente = $this->obtenerVentasCredito($request->fecha_inicio, $request->fecha_fin, $request->cliente_id);
        $totalSaldosPendientes = number_format($ventasPorCliente->sum('total_saldo_pendiente'), 2, '.', '');
        $url_pdf = url('/reportes/reporte-cuentas-por-cobrar');
        return response()->json([
            'ventasCredito' => $ventasPorCliente->toArray(),
            'totalSaldosPendientes' => $totalSaldosPendientes,
            'url_pdf' => $url_pdf
        ]);
    }
    public function pdfCuentasPorCobrarCliente()
    {
        $fecha_inicio = session('fecha_inicio_cuentas_por_cobrar');
        $fecha_fin = session('fecha_fin_cuentas_por_cobrar');
        $cliente_id = session('cliente_id_cuentas_por_cobrar');
        $ventasPorCliente = $this->obtenerVentasCredito($fecha_inicio, $fecha_fin, $cliente_id);
        $totalSaldosPendientes = number_format($ventasPorCliente->sum('total_saldo_pendiente'), 2, '.', '');
        $fechaImpresion = now()->format('Y-m-d H:i:s');
        $pdf = PDF::loadView('reportes.pdf.devolucion_cajas.cuentas_por_cobrar', [
            'ventasCredito' => $ventasPorCliente,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'totalSaldosPendientes' => $totalSaldosPendientes,
            'fechaImpresion' => $fechaImpresion,
        ])->setPaper('a4', 'portrait')->setOption('enable_php', true);

        return $pdf->stream('reporte_cuentas_cobrar.pdf');
    }
    public function filtrarPorFechaCuentasPorCobrarHistoricoCliente(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable',
        ]);
        session([
            'cliente_id_cuentas_por_cobrar' => $request->cliente_id
        ]);
        $ventasPorCliente = $this->obtenerVentasCredito(null, null, $request->cliente_id);
        $totalSaldosPendientes = number_format($ventasPorCliente->sum('total_saldo_pendiente'), 2, '.', '');
        $url_pdf = url('/reportes/reporte-cuentas-por-cobrar-historico');
        return response()->json([
            'ventasCredito' => $ventasPorCliente->toArray(),
            'totalSaldosPendientes' => $totalSaldosPendientes,
            'url_pdf' => $url_pdf
        ]);
    }

    public function pdfCuentasPorCobrarHistoricoCliente()
    {
        $cliente_id = session('cliente_id_cuentas_por_cobrar');
        $ventasPorCliente = $this->obtenerVentasCredito(null, null, $cliente_id);
        $totalSaldosPendientes = number_format($ventasPorCliente->sum('total_saldo_pendiente'), 2, '.', '');
        $fechaImpresion = now()->format('Y-m-d H:i:s');
        $pdf = PDF::loadView('reportes.pdf.devolucion_cajas.cuentas_por_cobrar_historico', [
            'ventasCredito' => $ventasPorCliente,
            'totalSaldosPendientes' => $totalSaldosPendientes,
            'fechaImpresion' => $fechaImpresion,
        ])->setPaper('a4', 'portrait')->setOption('enable_php', true);
        return $pdf->stream('reporte_cuentas_cobrar_historico.pdf');
    }

    public function filtrarPorFechaCobrosIndividuales(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cliente_id' => 'nullable',
        ]);

        session([
            'fecha_inicio_cobros_individuales' => $request->fecha_inicio,
            'fecha_fin_cobros_individuales' => $request->fecha_fin,
            'cliente_id_cobros_individuales' => $request->cliente_id
        ]);

        $fecha_inicio = Carbon::parse($request->fecha_inicio)->startOfDay()->format('Y-m-d H:i:s');
        $fecha_fin = Carbon::parse($request->fecha_fin)->endOfDay()->format('Y-m-d H:i:s');
        $query = ArqueoVenta::with(['venta.cliente', 'user', 'formaPago', 'banco'])
            ->where('estado', 1)
            ->where('pago_con', '>', 0)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
        if ($request->cliente_id && $request->cliente_id != 0) {
            $query->whereHas('venta', function ($q) use ($request) {
                $q->where('cliente_id', $request->cliente_id);
            });
        }

        $cobrosIndividuales = $query->orderBy('venta_id')
            ->orderBy('created_at')
            ->get();

        $resultados = $cobrosIndividuales->map(function ($item) {
            $cliente_nombre = $item->venta->cliente ? $item->venta->cliente->nombre : 'No Disponible';
            $usuario_nombre = $item->user ? $item->user->nombre . ' ' . $item->user->apellidos : 'No Disponible';
            $forma_pago = $item->formaPago ? $item->formaPago->name : 'No Disponible';
            $banco_nombre = $item->banco ? $item->banco->name : null;
            return [
                'id' => $item->id,
                'id_venta' => $item->venta_id,
                'pago_con' => $item->pago_con,
                'created_at' => Carbon::parse($item->created_at)->format('Y-m-d H:i:s'),
                'url_pdf' => url("reportes/cobranzas-oficial-ind/{$item->id}"),
                'cliente_nombre' => $cliente_nombre,
                'usuario_nombre' => $usuario_nombre,
                'forma_pago' => $forma_pago,
                'banco' => $banco_nombre,
                'comprobante_pago' => $item->comprobante_pago,
            ];
        });

        return response()->json([
            'cobrosIndividuales' => $resultados,
        ]);
    }



    // public function filtrarPorFechaCobrosGlobales(Request $request)
    // {
    //     $request->validate([
    //         'fecha_inicio' => 'required|date',
    //         'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    //         'cliente_id' => 'nullable',
    //     ]);

    //     session([
    //         'fecha_inicio_cobros_globales' => $request->fecha_inicio,
    //         'fecha_fin_cobros_globales' => $request->fecha_fin,
    //         'cliente_id_cobros_globales' => $request->cliente_id
    //     ]);

    //     $fecha_inicio = Carbon::parse($request->fecha_inicio)->startOfDay()->format('Y-m-d H:i:s');
    //     $fecha_fin = Carbon::parse($request->fecha_fin)->endOfDay()->format('Y-m-d H:i:s');
    //     $query = PagoGlobal::with(['venta.cliente', 'user', 'formaPago'])
    //         ->where('monto_total', '>', 0)
    //         ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
    //     if ($request->cliente_id && $request->cliente_id != 0) {
    //         $query->whereHas('venta', function ($q) use ($request) {
    //             $q->where('cliente_id', $request->cliente_id);
    //         });
    //     }

    //     $cobrosGlobales = $query->orderBy('venta_id')
    //         ->orderBy('created_at')
    //         ->get();

    //     $resultados = $cobrosGlobales->map(function ($item) {
    //         $cliente_nombre = $item->venta->cliente ? $item->venta->cliente->nombre : 'No Disponible';
    //         $usuario_nombre = $item->user ? $item->user->nombre . ' ' . $item->user->apellidos : 'No Disponible';
    //         $forma_pago = $item->formaPago ? $item->formaPago->name : 'No Disponible';
    //         return [
    //             'id' => $item->id,
    //             'id_venta' => $item->venta_id,
    //             'pago_con' => $item->pago_con,
    //             'created_at' => Carbon::parse($item->created_at)->format('Y-m-d H:i:s'),
    //             'url_pdf' => url("reportes/cobranza-global-oficial/{$item->id}"),
    //             'cliente_nombre' => $cliente_nombre,
    //             'usuario_nombre' => $usuario_nombre,
    //             'forma_pago' => $forma_pago
    //         ];
    //     });

    //     return response()->json([
    //         'cobrosGlobales' => $resultados,
    //     ]);
    // }}


    public function filtrarPorFechaCobrosGlobales(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cliente_id' => 'nullable',
        ]);

        session([
            'fecha_inicio_cobros_globales' => $request->fecha_inicio,
            'fecha_fin_cobros_globales' => $request->fecha_fin,
            'cliente_id_cobros_globales' => $request->cliente_id
        ]);

        $fecha_inicio = Carbon::parse($request->fecha_inicio)->startOfDay()->format('Y-m-d H:i:s');
        $fecha_fin = Carbon::parse($request->fecha_fin)->endOfDay()->format('Y-m-d H:i:s');

        $query = PagoGlobal::with([
            'arqueoVentas.venta.cliente',
            'user',
            'formapago'
        ])
            ->where('monto_total', '>', 0)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($request->cliente_id && $request->cliente_id != 0) {
            $query->whereHas('arqueoVentas.venta', function ($q) use ($request) {
                $q->where('cliente_id', $request->cliente_id);
            });
        }

        $cobrosGlobales = $query->orderBy('created_at')
            ->get();

        $resultados = $cobrosGlobales->map(function ($item) {
            $cliente_nombre = $item->arqueoVentas->first()->venta->cliente ? $item->arqueoVentas->first()->venta->cliente->nombre : 'No Disponible';
            $usuario_nombre = $item->user ? $item->user->nombre . ' ' . $item->user->apellidos : 'No Disponible';
            $forma_pago = $item->formapago ? $item->formapago->name : 'No Disponible';
            $venta_ids = $item->arqueoVentas->map(function ($arqueoVenta) {
                return $arqueoVenta->venta_id;
            });

            return [
                'id' => $item->id,
                'id_venta' => $venta_ids->toArray(),
                'pago_con' => $item->monto_total,
                'created_at' => Carbon::parse($item->created_at)->format('Y-m-d H:i:s'),
                'url_pdf' => url("reportes/cobranza-global-oficial/{$item->id}"),
                'cliente_nombre' => $cliente_nombre,
                'usuario_nombre' => $usuario_nombre,
                'forma_pago' => $forma_pago
            ];
        });

        return response()->json([
            'cobrosGlobales' => $resultados,
        ]);
    }
}
