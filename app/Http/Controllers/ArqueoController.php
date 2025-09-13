<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Arqueo;
use App\Models\ArqueoVenta;
use Illuminate\Http\Request;
use App\Models\ArqueoIngreso;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ValidarCajaDetalle;
use Illuminate\Support\Facades\Log;

class ArqueoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Arqueo::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arqueo = new Arqueo();
        $arqueo->monto_inicial = $request->monto_inicial;
        $arqueo->caja_sucursal_usuario_id = $request->caja_sucursal_usuario_id;
        $arqueo->sucursal_id = $request->sucursal_id;
        $arqueo->user_id = $request->user_id;
        $arqueo->fecha = Carbon::now()->format('Y-m-d');
        $arqueo->apertura = 1;
        $arqueo->save();
        return $arqueo;
    }
    public function listaArqueos($user, $sucursal)
    {
        $lista = Arqueo::with(['CajaSucursalUsuario', 'ArqueoIngresos', 'ArqueoVentas'])->where('sucursal_id', $sucursal)->where('user_id', $user)->where([['apertura', 1], ['estado', 1]])->get()->map(function ($arqueo) {
            $arqueo->monto_total_ventas = $arqueo->ArqueoVentas->where('estado', 1)->sum('monto');
            return $arqueo;
        });

        return $lista;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function show(Arqueo $arqueo)
    {

        return $arqueo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Arqueo $arqueo)
    // {
    //     $arqueo->apertura = 0;
    //     $arqueo->save();
    //     return $arqueo;
    // }

    public function update(Request $request, Arqueo $arqueo)
    {
        $arqueo->apertura = 0;

        if ($request->has('detalle_billetaje')) {
            $arqueo->detalle_billetaje = $request->detalle_billetaje;
        }

        if ($request->has('observacion')) {
            $arqueo->observaciones = $request->observacion;
        }

        $arqueo->save();
        $url_pdf_cierre = url("reportes/cierre-caja/{$arqueo->id}");

        return response()->json([
            'url_pdf_cierre' => $url_pdf_cierre,
            'arqueo' => $arqueo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arqueo $arqueo)
    {
        $arqueo->estado = 0;
        $arqueo->save();
    }

    public function cierreCajaPdf(Arqueo $arqueo)
    {

        $arqueo->load([
            'CajaSucursalUsuario.CajaSucursal.Sucursal',
            'ArqueoIngresos.formapago',
            'ArqueoVentas.formapago',
            'User'
        ]);

        $arqueo->total_ingresos   = $arqueo->ArqueoIngresos->where('tipo', 1)->sum('monto');
        $arqueo->total_egresos    = $arqueo->ArqueoIngresos->where('tipo', 2)->sum('monto');
        $arqueo->total_ventas     = $arqueo->ArqueoVentas->sum('monto');
        $arqueo->total_calculado  = $arqueo->monto_inicial + $arqueo->total_ingresos + $arqueo->total_ventas - $arqueo->total_egresos;

        $detalleBilletaje = [];
        if ($arqueo->detalle_billetaje) {
            try {
                $detalleBilletaje = json_decode($arqueo->detalle_billetaje, true);
            } catch (\Throwable $e) {
                Log::error('❌ Error al decodificar detalle_billetaje JSON:', ['error' => $e->getMessage()]);
            }
        }

        $movimientos = collect();
        foreach ($arqueo->ArqueoIngresos->where('tipo', 1) as $ingreso) {
            $movimientos->push([
                'formapago_id' => $ingreso->formapago_id,
                'nombre' => optional($ingreso->formapago)->name ?? 'Desconocido',
                'monto' => $ingreso->monto,
            ]);
        }

        foreach ($arqueo->ArqueoVentas as $venta) {
            $movimientos->push([
                'formapago_id' => $venta->formapago_id,
                'nombre' => optional($venta->formapago)->name ?? 'Desconocido',
                'monto' => $venta->monto,
            ]);
        }

        $formasPagoTotales = $movimientos->groupBy('nombre')->map(function ($items, $name) {
            return [
                'nombre' => $name,
                'total' => collect($items)->sum('monto'),
            ];
        })->values();

        $sucursal = $arqueo->CajaSucursalUsuario->CajaSucursal->Sucursal ?? null;
        if ($sucursal) {

            $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
                $file->path_url = url($file->File->path);
            });
            $sucursal->image = $sucursal->file_sucursals->first();
        }

        $pdf = Pdf::loadView('reportes.pdf.finanzas.ticket_cierre_caja', [
            'arqueo'             => $arqueo,
            'sucursal'           => $sucursal,
            'billetaje'          => $detalleBilletaje,
            'formasPagoTotales'  => $formasPagoTotales,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('cierre_caja_' . $arqueo->id . '.pdf');
    }

    public function filtrarPorFechaArqueo(Request $request)
    {
        Log::info('Inicio filtrarPorFechaArqueo', ['request_data' => $request->all()]);

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        Log::info("Filtrando arqueos desde {$fechaInicio} hasta {$fechaFin}");

        $arqueos = Arqueo::withSum('arqueoVentas as total_ventas', 'monto')
            ->withSum(['arqueoIngresos as total_ingresos' => function ($query) {
                $query->where('tipo', 1);
            }], 'monto')
            ->withSum(['arqueoIngresos as total_egresos' => function ($query) {
                $query->where('tipo', 2);
            }], 'monto')
            ->with(['CajaSucursalUsuario.CajaSucursal', 'CajaSucursalUsuario.user'])
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        Log::info('Cantidad de arqueos encontrados: ' . $arqueos->count());

        $resultado = $arqueos->map(function ($arqueo) {
            return [
                'id' => $arqueo->id,
                'created_at' => $arqueo->created_at,
                'monto_inicial' => $arqueo->monto_inicial,
                'fecha_hora_apertura' => $arqueo->created_at->format('Y-m-d H:i:s'),
                'fecha_hora_cierre' => $arqueo->updated_at->format('Y-m-d H:i:s'),
                'total_ventas' => floatval($arqueo->total_ventas ?? 0),
                'total_ingresos' => floatval($arqueo->total_ingresos ?? 0),
                'total_egresos' => floatval($arqueo->total_egresos ?? 0),
                'nombre_sucursal' => $arqueo->CajaSucursalUsuario?->CajaSucursal?->name ?? null,
                'nombre_usuario' => $arqueo->CajaSucursalUsuario?->user?->nombre ?? null,
                'url_pdf' => url("/reportes/cierre-caja/{$arqueo->id}"),
            ];
        });

        Log::info('Datos mapeados de arqueos:', $resultado->toArray());

        Log::info('Finalizando filtrarPorFechaArqueo');

        return response()->json([
            'arqueos' => $resultado,
        ]);
    }



    public function filtrarPorFechaGeneral(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        session([
            'fecha_inicio_cobranzas_gastos' => $request->fecha_inicio,
            'fecha_fin_cobranzas_gastos' => $request->fecha_fin,
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $ventas = ArqueoVenta::with([
            'venta.cliente',
            'venta.chofer',
            'venta.sucursal',
            'formapago',
            'user'
        ])->whereHas('venta', function ($q) {
            $q->where('estado', '!=', 0);
        })
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $egresos = ArqueoIngreso::with([
            'cajamotivo',
            'formapago',
            'arqueo.user'
        ])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('tipo', 2)
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'venta_id'   => $v->venta->id,
                'recibo'     => $v->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto_efe'  => $v->monto ?? 0,
                'monto_dep'  => 0,
                'monto_dir'  => 0,
                'desc'       => 0,
                'resp'       => $v->user->nombre ?? '',
                'banco'      => '',
            ];
        });

        $gastos = $egresos->map(function ($e) {
            return [
                'tipo'         => 'GASTO',
                'doc'          => $e->id ?? 'N/A',
                'beneficiario' => $e->cajamotivo->name ?? 'N/A',
                'monto'        => $e->monto ?? 0,
                'detalles'     => $e->cajamotivo->name ?? 'N/A',
                'resp'         => $e->arqueo->user->nombre ?? '',
            ];
        });

        $url_pdf = url('/reportes/reporte-cobranza-gastos');


        return response()->json([
            'ventas' => $cobranza,
            'egresos' => $gastos,
            'url_pdf' => $url_pdf,
        ]);
    }

    public function filtrarPorFechaUsuario(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'user_id' => 'required|exists:users,id',
        ]);

        session([
            'fecha_inicio_cobranzas_usuario' => $request->fecha_inicio,
            'fecha_fin_cobranzas_usuario' => $request->fecha_fin,
            'user_id_cobranzas_usuario' => $request->user_id,
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $userId = $request->input('user_id');

        $ventas = ArqueoVenta::with([
            'venta.cliente',
            'formapago',
            'user'
        ])
            ->whereHas('venta', function ($q) {
                $q->where('estado', '!=', 0);
            })
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'recibo'     => $v->id ?? 'N/A',
                'codigo'     => $v->venta->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto'      => $v->monto ?? 0,
                'id_pedido'  => $v->venta->id ?? null,
            ];
        })->toArray();

        $url_pdf = url('/reportes/reporte-cobranza-usuario');

        return response()->json([
            'ventas' => $cobranza,
            'url_pdf' => $url_pdf,
        ]);
    }

    public function pdfReporteCobranzaUsuario()
    {
        $fecha_inicio = session('fecha_inicio_cobranzas_usuario');
        $fecha_fin = session('fecha_fin_cobranzas_usuario');
        $user_id = session('user_id_cobranzas_usuario');

        if (!$fecha_inicio || !$fecha_fin || !$user_id) {
            abort(404, 'Datos de sesión incompletos');
        }

        $ventas = ArqueoVenta::with(['venta.cliente', 'formapago', 'user'])
            ->whereHas('venta', function ($q) {
                $q->where('estado', '!=', 0);
            })
            ->where('user_id', $user_id)
            ->whereBetween('created_at', [$fecha_inicio . ' 00:00:00', $fecha_fin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'recibo'     => $v->id ?? 'N/A',
                'codigo'     => $v->venta->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto'      => $v->monto ?? 0,
                'id_pedido'  => $v->venta->id ?? null,
            ];
        })->toArray();

        $totalCobranza = array_sum(array_column($cobranza, 'monto'));
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        $pdf = Pdf::loadView('reportes.pdf.cobranzas.cobranza_usuario', compact(
            'cobranza',
            'totalCobranza',
            'fechaImpresion',
            'fecha_inicio',
            'fecha_fin'
        ))
            ->setPaper('a4', 'portrait')
            ->setOption('enable_php', true);

        return $pdf->stream('reporte_cobranza_usuario.pdf');
    }

    public function filtrarPorFechaChofer(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'chofer_id' => 'required|exists:chofers,id',
        ]);

        session([
            'fecha_inicio_cobranzas_chofer' => $request->fecha_inicio,
            'fecha_fin_cobranzas_chofer' => $request->fecha_fin,
            'chofer_id_cobranzas_chofer' => $request->chofer_id,
        ]);

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $choferId = $request->input('chofer_id');

        $ventas = ArqueoVenta::with([
            'venta.cliente',
            'formapago',
            'user'
        ])
            ->whereHas('venta', function ($q) use ($choferId) {
                $q->where('chofer_id', $choferId)
                    ->where('estado', '!=', 0);
            })
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'recibo'     => $v->id ?? 'N/A',
                'codigo'     => $v->venta->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto'      => $v->monto ?? 0,
                'id_pedido'  => $v->venta->id ?? null,
            ];
        })->toArray();

        $url_pdf = url('/reportes/reporte-cobranza-chofer');

        return response()->json([
            'ventas' => $cobranza,
            'url_pdf' => $url_pdf,
        ]);
    }



    public function pdfReporteCobranzaYGastos()
    {
        $fecha_inicio = session('fecha_inicio_cobranzas_gastos');
        $fecha_fin = session('fecha_fin_cobranzas_gastos');

        if (!$fecha_inicio || !$fecha_fin) {
            abort(404, 'Fechas no definidas en sesión');
        }

        $ventas = ArqueoVenta::with(['venta.cliente', 'formapago', 'user'])
            ->whereBetween('created_at', [$fecha_inicio . ' 00:00:00', $fecha_fin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $egresos = ArqueoIngreso::with(['cajamotivo', 'formapago', 'arqueo.user'])
            ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
            ->where('tipo', 2)
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'venta_id'   => $v->venta->id,
                'recibo'     => $v->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto_efe'  => $v->monto ?? 0,
                'monto_dep'  => 0,
                'monto_dir'  => 0,
                'desc'       => 0,
                'resp'       => $v->user->nombre ?? '',
                'banco'      => '',
            ];
        })->toArray();

        $gastos = $egresos->map(function ($e) {
            return [
                'tipo'         => 'GASTO',
                'doc'          => $e->id ?? 'N/A',
                'beneficiario' => $e->cajamotivo->name ?? 'N/A',
                'monto'        => $e->monto ?? 0,
                'detalles'     => $e->cajamotivo->name ?? 'N/A',
                'resp'         => $e->arqueo->user->nombre ?? '',
            ];
        })->toArray();

        $totalMontoEfe = array_sum(array_column($cobranza, 'monto_efe'));
        $totalMontoDep = array_sum(array_column($cobranza, 'monto_dep'));
        $totalMontoDir = array_sum(array_column($cobranza, 'monto_dir'));
        $totalDesc     = array_sum(array_column($cobranza, 'desc'));

        $totalCobranza = $totalMontoEfe + $totalMontoDep + $totalMontoDir - $totalDesc;

        $totalGasto = array_sum(array_column($gastos, 'monto'));

        $totalEfeMasDir     = $totalMontoEfe + $totalMontoDir;
        $totalGastoEfectivo = array_sum(array_map(
            fn($i) => $i['monto_efe'] * ($i['forma_pago'] === 'Efectivo' ? 1 : 0),
            $cobranza
        ));

        $totalEntregar = $totalCobranza - $totalGasto;

        $cantidadCobros = count($cobranza);
        $cantidadGastos = count($gastos);
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        $pdf = PDF::loadView('reportes.pdf.cobranzas.cobranza_gastos', compact(
            'cobranza',
            'gastos',
            'totalMontoEfe',
            'totalMontoDep',
            'totalMontoDir',
            'totalDesc',
            'totalCobranza',
            'totalGasto',
            'totalEfeMasDir',
            'totalGastoEfectivo',
            'totalEntregar',
            'fechaImpresion',
            'cantidadCobros',
            'cantidadGastos',
            'fecha_inicio',
            'fecha_fin'
        ))
            ->setPaper('a4', 'portrait')
            ->setOption('enable_php', true);

        return $pdf->stream('reporte_cobranza_gastos.pdf');
    }


    public function pdfReporteCobranzaChofer()
    {
        $fechaInicio = session('fecha_inicio_cobranzas_chofer');
        $fechaFin = session('fecha_fin_cobranzas_chofer');
        $choferId = session('chofer_id_cobranzas_chofer');

        if (!$fechaInicio || !$fechaFin || !$choferId) {
            abort(404, 'Datos insuficientes para generar el reporte.');
        }

        $ventas = ArqueoVenta::with([
            'venta.cliente',
            'formapago',
            'user'
        ])
            ->whereHas('venta', function ($q) use ($choferId) {
                $q->where('chofer_id', $choferId);
            })
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('estado', 1)
            ->get();

        $cobranza = $ventas->map(function ($v) {
            return [
                'recibo'     => $v->id ?? 'N/A',
                'codigo'     => $v->venta->id ?? 'N/A',
                'forma_pago' => $v->formapago->name ?? 'N/A',
                'cliente'    => $v->venta->cliente->nombre ?? 'N/A',
                'monto'      => $v->monto ?? 0,
                'id_pedido'  => $v->venta->id ?? null,
            ];
        })->toArray();

        $totalCobranza = array_sum(array_column($cobranza, 'monto'));
        $fechaImpresion = now()->format('Y-m-d H:i:s');

        $pdf = Pdf::loadView('reportes.pdf.cobranzas.cobranza_chofer', compact(
            'cobranza',
            'totalCobranza',
            'fechaImpresion',
            'fechaInicio',
            'fechaFin'
        ))
            ->setPaper('a4', 'portrait')
            ->setOption('enable_php', true);

        return $pdf->stream('reporte_cobranza_chofer.pdf');
    }
}
