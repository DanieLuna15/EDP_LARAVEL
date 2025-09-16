<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
            background: #f2f2f2;
        }

        td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
        }

        .white-bg {
            padding: 10px;
        }

        .tabla_borde {}

        tr.border_bottom td {
            border-bottom: 1px solid #000;
        }

        tr.border_top td {
            border-top: 1px solid #666;
        }

        tr.descomp-head th {
            background: #E9F3FF !important;
        }

        tr.descomp-head-merma th {
            background: #f7f7e2 !important;
        }

        tr.total-final th {
            background: #eef7ee !important;
        }

        td.border_right {
            border-right: 1px solid #666;
        }

        .section-title-main {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            padding: 3px 0;
        }

        .section-content {
            font-size: 8px;
            padding: 3px 0;
        }
    </style>
</head>

@php
    use Carbon\Carbon;
@endphp

<body class="white-bg">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                        style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        REPORTE GENERAL SUBTRANSFORMACIÓN&nbsp; N° <?= $trans->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <span style="font-size:14px"><?= $trans->mes ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width:33%; text-align:left; background:#f2f2f2;">
                        <strong>SUCURSAL:</strong>
                        <?= $sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @php
        $A = $trans->inicial_listado_aceptados ?? [
            'rows' => collect(),
            'totales' => ['cajas' => 0, 'kg_bruto' => 0, 'tara' => 0, 'kg_neto' => 0],
        ];
    @endphp

    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" colspan="8" class="bold"><strong>PESO INICIAL</strong></th>
                </tr>
                <tr class="border_top">
                    <th class="bold" align="left">FECHA/HORA</th>
                    <th class="bold" align="left">PT N°</th>
                    <th class="bold" align="left">ITEM</th>
                    <th class="bold" align="left">USUARIO</th>
                    <th class="bold" align="left">CAJAS</th>
                    <th class="bold" align="left">KG/B</th>
                    <th class="bold" align="left">TARA</th> {{-- <-- NUEVA --}}
                    <th class="bold" align="left">KG/N</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($A['rows'] ?? collect() as $r)
                    <tr class="border_top">
                        <td class="bold">{{ \Carbon\Carbon::parse($r['fecha'])->format('d/m/Y H:i:s') }}</td>
                        <td class="bold">PT-{{ $r['pt_nro'] }}</td>
                        <td class="bold">{{ $r['item_name'] }}</td>
                        <td class="bold">{{ $r['usuario'] }}</td>
                        <td class="bold">{{ number_format($r['cajas']) }}</td>
                        <td class="bold">{{ number_format($r['kg_bruto'], 3) }}</td>
                        <td class="bold">{{ number_format($r['tara']) }}</td> {{-- <-- NUEVA --}}
                        <td class="bold">{{ number_format($r['kg_neto'], 3) }}</td>
                    </tr>
                @endforeach

                <tr class="border_top">
                    <th class="bold" colspan="4" style="text-align:right;">TOTALES INICIAL</th>
                    <th class="bold">{{ number_format($A['totales']['cajas']) }}</th>
                    <th class="bold">{{ number_format($A['totales']['kg_bruto'], 3) }}</th>
                    <th class="bold">{{ number_format($A['totales']['tara']) }}</th> {{-- <-- NUEVA --}}
                    <th class="bold">{{ number_format($A['totales']['kg_neto'], 3) }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    @php
        $L = $trans->inicial_totales_por_pt_item ?? collect();
        $S = $trans->inicial_totales_por_pt_item_sum ?? ['cajas' => 0, 'kg_bruto' => 0, 'tara' => 0, 'kg_neto' => 0];
    @endphp

    @if ($L->count())
        <div class="tabla_borde" style="margin-top:8px;">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="6" class="bold">TOTALES AGRUPADOS</th>
                    </tr>
                    <tr class="border_top">
                        <th>PT N°</th>
                        <th>ITEM</th>
                        <th>CAJAS</th>
                        <th>KG/B</th>
                        <th>TARA</th>
                        <th>KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($L as $r)
                        <tr class="border_top">
                            <td class="bold">PT-{{ $r['pt_nro'] }}</td>
                            <td class="bold">{{ $r['item_name'] }}</td>
                            <td class="bold">{{ number_format($r['cajas']) }}</td>
                            <td class="bold">{{ number_format($r['kg_bruto'], 3) }}</td>
                            <td class="bold">{{ number_format($r['tara']) }}</td>
                            <td class="bold">{{ number_format($r['kg_neto'], 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border_top">
                        <th class="bold" colspan="2" style="text-align:right;">TOTAL</th>
                        <th class="bold">{{ number_format($S['cajas']) }}</th>
                        <th class="bold">{{ number_format($S['kg_bruto'], 3) }}</th>
                        <th class="bold">{{ number_format($S['tara']) }}</th>
                        <th class="bold">{{ number_format($S['kg_neto'], 3) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

    @php
        $T = $trans->traspasos_trans_aceptados ?? [
            'rows' => collect(),
            'totales' => ['cajas' => 0, 'kg_bruto' => 0, 'tara' => 0, 'kg_neto' => 0],
        ];
    @endphp

    @if (($T['rows'] ?? collect())->count())
        <div class="tabla_borde" style="margin-top:8px;">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th align="center" colspan="7" class="bold"><strong>TRASPASOS ACEPTADOS (SUB-TRANS a
                                SUB-TRANS)</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th class="bold" align="left">SUB-TRANS N°</th>
                        <th class="bold" align="left">FECHA/HORA</th>
                        <th class="bold" align="left">ITEM</th>
                        <th class="bold" align="left">USUARIO</th>
                        <th class="bold" align="left">CAJAS</th>
                        <th class="bold" align="left">KG/B</th>
                        <th class="bold" align="left">KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($T['rows'] as $r)
                        <tr class="border_top">
                            <td class="bold">{{ $r['trans_nro'] }}</td>
                            <td class="bold">{{ \Carbon\Carbon::parse($r['fecha'])->format('d/m/Y H:i:s') }}</td>
                            <td class="bold">{{ $r['item_name'] }}</td>
                            <td class="bold">{{ $r['usuario'] }}</td>
                            <td class="bold">{{ number_format($r['cajas']) }}</td>
                            <td class="bold">{{ number_format($r['kg_bruto'], 3) }}</td>
                            <td class="bold">{{ number_format($r['kg_neto'], 3) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th class="bold" colspan="4" style="text-align:right;">TOTALES TRASPASOS</th>
                        <th class="bold">{{ number_format($T['totales']['cajas']) }}</th>
                        <th class="bold">{{ number_format($T['totales']['kg_bruto'], 3) }}</th>
                        <th class="bold">{{ number_format($T['totales']['kg_neto'], 3) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif


    @php
        $B = $trans->subdescomp_por_pt_item ?? collect();
    @endphp

    @if ($B->count())
        <div class="tabla_borde" style="margin-top:8px;">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr class="border_top">
                        <th colspan="6" class="bold section-title">SUB-DESCOMPOSICIONES</th>
                    </tr>
                    <tr class="border_top">
                        <th>FECHA/HORA</th>
                        <th>ITEM</th>
                        <th>CAJAS</th>
                        <th>KG/B</th>
                        <th>TARA</th>
                        <th>KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($B as $g)
                        <tr class="border_top descomp-head">
                            <th class="bold section-title" colspan="2" style="text-align: center">ENTREGADO TOTAL
                                PT N°{{ $g['pt_nro'] }} | {{ $g['item_name'] }}</th>
                            <th class="bold section-title">{{ number_format($g['entregado']['cajas']) }}</th>
                            <th class="bold section-title">{{ number_format($g['entregado']['kg_bruto'], 3) }}</th>
                            <th class="bold section-title">{{ number_format($g['entregado']['tara']) }}</th>
                            <th class="bold section-title">{{ number_format($g['entregado']['kg_neto'], 3) }}</th>
                        </tr>


                        @foreach ($g['encargados'] as $e)
                            <tr class="border_top">
                                <th class="bold" colspan="2">ENCARGADO: {{ $e['encargado'] }} (Entregado)</th>
                                <th class="bold">{{ number_format($e['entregado']['cajas']) }}</th>
                                <th class="bold">{{ number_format($e['entregado']['kg_bruto'], 3) }}</th>
                                <th class="bold">{{ number_format($e['entregado']['tara']) }}</th>
                                <th class="bold">{{ number_format($e['entregado']['kg_neto'], 3) }}</th>
                            </tr>

                            @foreach ($e['subitems'] as $s)
                                <tr>
                                    <td class="bold">{{ $s['fecha'] }}</td>

                                    <td>{{ $s['subitem'] }}</td>
                                    <td>{{ number_format($s['cajas']) }}</td>
                                    <td>{{ number_format($s['kg_bruto'], 3) }}</td>
                                    <td>{{ number_format($s['tara']) }}</td>
                                    <td>{{ number_format($s['kg_neto'], 3) }}</td>
                                </tr>
                            @endforeach

                            <tr class="border_top">
                                <th class="bold" colspan="2">SUBTOTAL SUBITEMS ({{ $e['encargado'] }})</th>
                                <th class="bold">{{ number_format($e['totales_subitem']['cajas']) }}</th>
                                <th class="bold">{{ number_format($e['totales_subitem']['kg_bruto'], 3) }}</th>
                                <th class="bold">{{ number_format($e['totales_subitem']['tara']) }}</th>
                                <th class="bold">{{ number_format($e['totales_subitem']['kg_neto'], 3) }}</th>
                            </tr>
                            <tr class="border_top descomp-head-merma">
                                <th class="bold" colspan="5">MERMA ({{ $e['encargado'] }})</th>
                                {{-- <th class="bold">{{ number_format($e['merma']['cajas']) }}</th>
                                <th class="bold">{{ number_format($e['merma']['kg_bruto'], 3) }}</th>
                                <th class="bold">{{ number_format($e['merma']['tara']) }}</th> --}}
                                <th class="bold">{{ number_format($e['merma']['kg_neto'], 3) }}</th>
                            </tr>
                        @endforeach

                        <tr class="border_top total-final">
                            <th class="bold" colspan="5"> TOTALES SUB-DESCOMPOSICIÓN {{ $g['item_name'] }} | PT
                                N°{{ $g['pt_nro'] }}</th>
                            {{-- <th class="bold">{{ number_format($g['subitems_totales']['cajas']) }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['kg_bruto'], 3) }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['tara']) }}</th> --}}
                            <th class="bold">{{ number_format($g['subitems_totales']['kg_neto'], 3) }}</th>
                        </tr>
                        <tr class="border_top total-final-orange">
                            <th class="bold" colspan="5">TOTALES MERMA {{ $g['item_name'] }} | PT
                                N°{{ $g['pt_nro'] }}</th>
                            {{-- <th class="bold">{{ number_format($g['merma_total']['cajas']) }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['kg_bruto'], 3) }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['tara']) }}</th> --}}
                            <th class="bold">{{ number_format($g['merma_total']['kg_neto'], 3) }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



    @php
        $S = $trans->subitem_totales_con_traspaso ?? collect();
        $Ssum = $trans->subitem_totales_con_traspaso_sum ?? [
            'cajas' => 0,
            'kg_bruto' => 0,
            'tara' => 0,
            'kg_neto' => 0,
        ];
    @endphp

    @if ($S->count())
        <div class="tabla_borde" style="margin-top:8px;">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr class="border_top">
                        <th colspan="5" class="bold section-title">TOTAL POR SUBITEM (SUB-DESCOMPOSICIONES +
                            TRASPASOS)</th>
                    </tr>
                    <tr class="border_top">
                        <th>SUBITEM</th>
                        <th>CAJAS</th>
                        <th>KG/B</th>
                        <th>TARA</th>
                        <th>KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($S as $row)
                        <tr class="border_top">
                            <td class="bold">{{ $row['subitem'] }}</td>
                            <td class="bold">{{ number_format($row['cajas']) }}</td>
                            <td class="bold">{{ number_format($row['kg_bruto'], 3) }}</td>
                            <td class="bold">{{ number_format($row['tara']) }}</td>
                            <td class="bold">{{ number_format($row['kg_neto'], 3) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top total-final">
                        <th class="bold">TOTALES</th>
                        <th class="bold">{{ number_format($Ssum['cajas']) }}</th>
                        <th class="bold">{{ number_format($Ssum['kg_bruto'], 3) }}</th>
                        <th class="bold">{{ number_format($Ssum['tara']) }}</th>
                        <th class="bold">{{ number_format($Ssum['kg_neto'], 3) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    @php
        $BF = $trans->balance_final ?? null;
    @endphp

    @if ($BF)
        <div class="tabla_borde" style="margin-top:8px;">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr class="border_top bold descomp-head">
                        <th align="center" colspan="5" class="bold section-title">
                            <strong>BALANCE FINAL SUB-TRANS N° {{ $trans->nro }}</strong>
                        </th>
                    </tr>
                    <tr class="border_top">
                        <th class="bold" align="left">DETALLE</th>
                        <th class="bold">CAJAS</th>
                        <th class="bold">KG/B</th>
                        <th class="bold">TARA</th>
                        <th class="bold">KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border_top">
                        <th class="bold">TOTAL INICIAL</th>
                        <td class="bold">{{ number_format($BF['inicial']['cajas']) }}</td>
                        <td class="bold">{{ number_format($BF['inicial']['kg_bruto'], 3) }}</td>
                        <td class="bold">{{ number_format($BF['inicial']['tara']) }}</td>
                        <td class="bold">{{ number_format($BF['inicial']['kg_neto'], 3) }}</td>
                    </tr>

                    <tr>
                        <th class="bold">(-) SUB-DESCOMPOSICIONES</th>
                        <td class="bold">{{ number_format($BF['descomp']['cajas']) }}</td>
                        <td class="bold">{{ number_format($BF['descomp']['kg_bruto'], 3) }}</td>
                        <td class="bold">{{ number_format($BF['descomp']['tara']) }}</td>
                        <td class="bold">{{ number_format($BF['descomp']['kg_neto'], 3) }}</td>
                    </tr>

                    <tr>
                        <th class="bold">(-) TOTAL MERMAS SUB-DESCOMPOSICIONES</th>
                        <td class="bold">{{ number_format($BF['merma']['cajas']) }}</td>
                        <td class="bold">{{ number_format($BF['merma']['kg_bruto'], 3) }}</td>
                        <td class="bold">{{ number_format($BF['merma']['tara']) }}</td>
                        <td class="bold">{{ number_format($BF['merma']['kg_neto'], 3) }}</td>
                    </tr>

                    <tr class="border_top total-final">
                        <th class="bold" colspan="4">SOBRANTE PARCIAL (INICIAL - SUB-DESCOMPOSICIONES - MERMAS)
                        </th>
                        {{-- <th class="bold">{{ number_format($BF['sobrante']['cajas']) }}</th>
                        <th class="bold">{{ number_format($BF['sobrante']['kg_bruto'], 3) }}</th>
                        <th class="bold">{{ number_format($BF['sobrante']['tara']) }}</th> --}}
                        <th class="bold">{{ number_format($BF['sobrante']['kg_neto'], 3) }}</th>
                    </tr>

                    <tr class="border_top total-final-orange">
                        <th class="bold" colspan="4">SOBRANTE FINAL GLOBAL (MERMAS + SOBRANTE PARCIAL)</th>
                        {{-- <th class="bold">{{ number_format($BF['merma_final_global']['cajas']) }}</th>
                        <th class="bold">{{ number_format($BF['merma_final_global']['kg_bruto'], 3) }}</th>
                        <th class="bold">{{ number_format($BF['merma_final_global']['tara']) }}</th> --}}
                        <th class="bold">{{ number_format($BF['merma_final_global']['kg_neto'], 3) }}</th>
                    </tr>

                </tbody>
            </table>
        </div>
    @endif

    @php
        $dias = ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
    @endphp

    @foreach ($trans->ventas_por_subitem_bloques as $b)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr class="border_top descomp-head">
                        <th colspan="7" class="section-title" style="text-transform:uppercase;">
                            {{ $b['subitem_name'] ?? 'SIN NOMBRE' }}
                        </th>
                        <th class="section-title">KG/N</th>
                        <th class="section-title">{{ number_format($b['inicial']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>

                    {{-- VENTAS --}}
                    <tr class="border_top">
                        <th class="bold" colspan="11">VENTAS</th>
                    </tr>
                    <tr>
                        <th align="left" class="bold">NDD</th>
                        <th align="left" class="bold">FECHA/HORA</th>
                        <th align="left" class="bold">DÍA</th>
                        <th align="left" class="bold">USUARIO</th>
                        <th align="left" class="bold">CLIENTE</th>
                        <th align="left" class="bold">CJ</th>
                        <th align="left" class="bold">KG/BR</th>
                        <th align="left" class="bold">TARA</th>
                        <th align="left" class="bold">KG/N</th>
                        <th align="left" class="bold">PRECIO</th>
                        <th align="left" class="bold">TOTAL BS.</th>
                    </tr>

                    @forelse ($b['ventas'] as $v)
                        @php
                            $f = $v['fecha'] ? Carbon::parse($v['fecha']) : null;
                            $dia = $f ? $dias[$f->dayOfWeek] : '';
                        @endphp
                        <tr class="border_top">
                            <td class="bold">{{ $v['venta_id'] }}</td>
                            <td class="bold">{{ $v['fecha'] }}</td>
                            <td class="bold">{{ $dia }}</td>
                            <td class="bold">{{ $v['usuario'] }}</td>
                            <td class="bold">{{ $v['cliente'] }} | {{ $v['cliente_id'] }}</td>
                            <td class="bold">{{ number_format($v['cajas'] ?? 0) }}</td>
                            <td class="bold">{{ number_format($v['kg_bruto'] ?? 0, 3) }}</td>
                            <td class="bold">{{ number_format($v['tara'] ?? 0, 0) }}</td>
                            <td class="bold">{{ number_format($v['kg_neto'] ?? 0, 3) }}</td>
                            <td class="bold">{{ number_format($v['precio'] ?? 0, 2) }}</td>
                            <td class="bold">{{ number_format($v['total'] ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr class="border_top bold descomp-head-merma">
                            <th colspan="11" style="text-align:center;">Sin ventas para este subitem.</th>
                        </tr>
                    @endforelse

                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">TOTALES VENTAS</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['kg_bruto'] ?? 0, 3) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['taras'] ?? 0, 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['kg_neto'] ?? 0, 3) }}</th>
                        <th></th>
                        <th class="bold">{{ number_format($b['totales_ventas']['total'] ?? 0, 2) }}</th>
                    </tr>

                    {{-- ENVÍOS A SIGUIENTE SUBTRANS --}}
                    <tr class="border_top">
                        <th class="bold" colspan="11">ENVÍOS A SIGUIENTE SUBTRANS (SOBRANTE)</th>
                    </tr>
                    <tr>
                        <th align="left" class="bold">N°</th>
                        <th align="left" class="bold">FECHA/HORA</th>
                        <th align="left" class="bold">DÍA</th>
                        <th align="left" class="bold">USUARIO</th>
                        <th align="left" class="bold">DETALLE</th>
                        <th align="left" class="bold">CJ</th>
                        <th align="left" class="bold">KG/BR</th>
                        <th align="left" class="bold">TARA</th>
                        <th align="left" class="bold">KG/N</th>
                        <th colspan="2"></th>
                    </tr>

                    @forelse ($b['envios_sgte_trans'] as $s)
                        @php
                            $fh = $s['fecha'] ? Carbon::parse($s['fecha']) : null;
                            $dia = $fh ? $dias[$fh->dayOfWeek] : '';
                        @endphp
                        <tr class="border_top">
                            <td class="bold">{{ $s['sobra_id'] }}</td>
                            <td class="bold">{{ $s['fecha'] }}</td>
                            <td class="bold">{{ $dia }}</td>
                            <td class="bold">{{ $s['usuario'] }}</td>
                            <td class="bold">{{ $s['detalle'] }}</td>
                            <td class="bold">{{ number_format($s['cajas'] ?? 0) }}</td>
                            <td class="bold">{{ number_format($s['kg_bruto'] ?? 0, 3) }}</td>
                            <td class="bold">{{ number_format($s['tara'] ?? 0, 0) }}</td>
                            <td class="bold">{{ number_format($s['kg_neto'] ?? 0, 3) }}</td>
                            <td colspan="2"></td>
                        </tr>
                    @empty
                        <tr class="border_top bold descomp-head-merma">
                            <th colspan="11" style="text-align:center;">Sin envíos al siguiente Subtrans para este
                                subitem.</th>
                        </tr>
                    @endforelse

                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">TOTALES ENVÍOS A SIGUIENTE
                            SUBTRANS</th>
                        <th class="bold">{{ number_format($b['totales_envios_sgte_trans']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_envios_sgte_trans']['kg_bruto'] ?? 0, 3) }}
                        </th>
                        <th class="bold">{{ number_format($b['totales_envios_sgte_trans']['taras'] ?? 0, 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_envios_sgte_trans']['kg_neto'] ?? 0, 3) }}
                        </th>
                        <th colspan="2"></th>
                    </tr>

                    {{-- SALDO --}}
                    <tr class="border_top total-final">
                        <th colspan="5" class="bold" style="text-align:right;">SALDO RESTANTE (MERMA)</th>
                        <th colspan="3"></th>
                        <th class="bold">{{ number_format($b['saldo']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach


    {{-- ==== RESUMEN GLOBAL ==== --}}
    @php $RG = $trans->ventas_resumen_subtrans ?? null; @endphp
    @if ($RG)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="6" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="5" class="bold" style="text-align:center;">RESUMEN GLOBAL (TODOS LOS
                            SUBITEMS)</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="bold">CJ</th>
                        <th class="bold">KG/BR</th>
                        <th class="bold">TARA</th>
                        <th class="bold">KG/N</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border_top">
                        <th class="bold">SALDO INICIAL (SUBDESC + TRASPASOS)</th>
                        <th colspan="3"></th>
                        {{-- <td class="bold">{{ number_format($RG['inicial']['cajas'] ?? 0) }}</td>
                        <td class="bold">{{ number_format($RG['inicial']['kg_bruto'] ?? 0, 3) }}</td>
                        <td class="bold">{{ number_format($RG['inicial']['taras'] ?? 0, 0) }}</td> --}}
                        <th class="bold">{{ number_format($RG['inicial']['kg_neto'] ?? 0, 3) }}</th>
                    </tr>
                    <tr class="border_top">
                        <th class="bold">VENTAS</th>
                        <td class="bold">{{ number_format($RG['ventas']['cajas'] ?? 0) }}</td>
                        <td class="bold">{{ number_format($RG['ventas']['kg_bruto'] ?? 0, 3) }}</td>
                        <td class="bold">{{ number_format($RG['ventas']['taras'] ?? 0, 0) }}</td>
                        <td class="bold">{{ number_format($RG['ventas']['kg_neto'] ?? 0, 3) }}</td>
                    </tr>
                    <tr class="border_top">
                        <th class="bold">ENVÍOS A SIGUIENTE SUBTRANS</th>
                        <td class="bold">{{ number_format($RG['envios_sgte_trans']['cajas'] ?? 0) }}</td>
                        <td class="bold">{{ number_format($RG['envios_sgte_trans']['kg_bruto'] ?? 0, 3) }}</td>
                        <td class="bold">{{ number_format($RG['envios_sgte_trans']['taras'] ?? 0, 0) }}</td>
                        <td class="bold">{{ number_format($RG['envios_sgte_trans']['kg_neto'] ?? 0, 3) }}</td>
                    </tr>
                    <tr class="border_top total-final">
                        <th class="bold">SALDO RESTANTE</th>
                        <th colspan="3"></th>
                        {{-- <td class="bold">{{ number_format($RG['saldo']['cajas'] ?? 0) }}</td>
                        <td class="bold">{{ number_format($RG['saldo']['kg_bruto'] ?? 0, 3) }}</td>
                        <td class="bold">{{ number_format($RG['saldo']['taras'] ?? 0, 0) }}</td> --}}
                        <th class="bold">{{ number_format($RG['saldo']['kg_neto'] ?? 0, 3) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif


    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
