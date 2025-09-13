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

        tr.total-final-orange th {
            background: #f3e3c3 !important;
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

<body class="white-bg">
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
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
                        PESO INICIAL TOTAL - SUBTRANSFORMACION &nbsp; N° <?= $trans->nro ?>
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
                        <strong class="section-title">SUCURSAL:</strong>
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
                        <th align="center" colspan="7" class="bold"><strong>TRASPASOS ACEPTADOS (TRANS →
                                TRANS)</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th class="bold" align="left">FECHA/HORA</th>
                        <th class="bold" align="left">TRANS ORIGEN N°</th>
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
                            <td class="bold">{{ \Carbon\Carbon::parse($r['fecha'])->format('d/m/Y H:i:s') }}</td>
                            <td class="bold">TRANS-{{ $r['trans_nro'] }}</td>
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
                                <th class="bold" colspan="2">MERMA ({{ $e['encargado'] }})</th>
                                <th class="bold">{{ number_format($e['merma']['cajas']) }}</th>
                                <th class="bold">{{ number_format($e['merma']['kg_bruto'], 3) }}</th>
                                <th class="bold">{{ number_format($e['merma']['tara']) }}</th>
                                <th class="bold">{{ number_format($e['merma']['kg_neto'], 3) }}</th>
                            </tr>
                        @endforeach

                        <tr class="border_top total-final">
                            <th class="bold" colspan="2"> TOTALES SUB-DESCOMPOSICIÓN {{ $g['item_name'] }} | PT
                                N°{{ $g['pt_nro'] }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['cajas']) }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['kg_bruto'], 3) }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['tara']) }}</th>
                            <th class="bold">{{ number_format($g['subitems_totales']['kg_neto'], 3) }}</th>
                        </tr>
                        <tr class="border_top total-final-orange">
                            <th class="bold" colspan="2">TOTALES MERMA {{ $g['item_name'] }} | PT
                                N°{{ $g['pt_nro'] }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['cajas']) }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['kg_bruto'], 3) }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['tara']) }}</th>
                            <th class="bold">{{ number_format($g['merma_total']['kg_neto'], 3) }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



    @php
        $S = $trans->subdescomp_totales_por_subitem ?? collect();
        $Ssum = $trans->subdescomp_totales_por_subitem_sum ?? [
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
                    <tr class="border_top">
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



    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
