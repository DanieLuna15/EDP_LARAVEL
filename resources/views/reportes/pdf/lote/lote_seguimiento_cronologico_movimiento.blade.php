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
            padding: 5px 0;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body class="white-bg">


    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" alt="Sucursal Logo" style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        SEGUIMIENTO DE COMPRAS - POR CRONOLÓGICO / LOTE N° <?= $lote->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Compra / Nro compra / Nro Lote:</b>
                        <span style="font-size:14px">
                            <?= $compra->id ?> / {{ $compra->nro_compra }} / {{ $compra->nro }}
                        </span>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de registro: </b><?= $lote->fecha ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
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
            <tr>
                <th style="width:33%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">FECHA DE LA COMPRA:</strong>
                    {{ $compra->fecha }}
                </th>
                <td style="width:34%; text-align:left;">
                    <strong>FECHA DE LA LLEGADA: </strong>{{ $compra->fecha_llegada }}
                </td>
                <td style="width:33%; text-align:left;">
                    <strong>PROVEEDOR: </strong>{{ $compra->ProveedorCompra->abreviatura }}
                </td>
            </tr>
        </tbody>
    </table>

    @php
        $registro = 0;
        $registros = [];
    @endphp

    <?php
    // ! ||--------------------------------------------------------------------------------||
    // ! ||                                    REGISTROS                                   ||
    // ! ||--------------------------------------------------------------------------------||
    foreach ($lote->detalles as $detalle) {
        $registro += 1;
        $total_peso_bruto_detalle = 0;
        $total_tara_detalle = 0;
        $total_peso_neto_detalle = 0;
        $total_cajas_e_detalle = 0;
        $total_cajas_s_detalle = 0;
        $total_cajas_sa_detalle = 0;
        $total_und_e_detalle = 0;
        $total_und_s_detalle = 0;
        $total_und_sa_detalle = 0;
        $total_kg_e_detalle = 0;
        $total_kg_s_detalle = 0;
        $total_kg_sa_detalle = 0;
        $registros[] = [
            "tipo" => 1,
            "valor" => $detalle['producto']
        ];
    ?>

    <?php
    $peso_total2 = 0;
    $peso_cajas2 = 0;
    $peso_neto2 = 0;
    $cajas_acumulados = 0;
    $pollos_acumulados = 0;
    foreach ($detalle['lote_detalles'] as $ld) {
        $registro += 1;
        $peso_total = $ld->peso_total;
        $peso_cajas = $ld->cajas * 2;
        $peso_neto = $peso_total - $peso_cajas;
        $peso_total2 += $peso_total;
        $peso_cajas2 += $peso_cajas;
        $peso_neto2 += $peso_neto;
        $cajas_acumulados += $ld->cajas;
        $pollos_acumulados += $ld->equivalente;
        $registros[] = [
            'tipo' => 2,
            'valor' => [
                0 => $ld->fecha . ' ' . $ld->hora . ' U:' . $ld->user_id,
                1 => $ld->pigmento == 1 ? 'SI' : 'NO',
                2 => "$ld->nro",
                3 => "$ld->tipo",
                4 => "$ld->detalle | $compra->nro_compra" . ($ld->anulado == 1 ? ' (ANULADO)' : ''),
                5 => number_format($peso_total, 3),
                6 => number_format($peso_cajas, 3),
                7 => number_format($peso_neto, 3),
                8 => number_format(0, 3),
                9 => $ld->cajas,
                10 => number_format(0, 3),
                11 => $cajas_acumulados,
                12 => $ld->equivalente,
                13 => number_format(0, 3),
                14 => $pollos_acumulados,
                15 => number_format($peso_neto, 3),
                16 => number_format(0, 3),
                17 => number_format($peso_neto2, 3),
                18 => $ld->id_nro,
                19 => $ld->producto,
                20 => $ld->user_id,
                21 => $ld->anulado,
            ],
        ];
    }

    foreach ($detalle['lista_registros'] as $ld) {
        $registro += 1;
        $peso_total = $ld->peso_total;
        $peso_cajas = $ld->cajas * 2;
        $peso_neto = $peso_total - $peso_cajas;
        $peso_total2 += $peso_total;
        $peso_cajas2 += $peso_cajas;
        $peso_neto2 -= $ld->kg_s;
        $cajas_acumulados -= $ld->cajas_s;
        $pollos_acumulados -= $ld->und_s;
        $registros[] = [
            'tipo' => 3,
            'valor' => [
                0 => $ld->fecha . ' ' . $ld->hora . ' U:' . $ld->user_id,
                1 => $ld->pigmento == 1 ? 'SI' : 'NO',
                2 => "$ld->nro",
                3 => "$ld->tipo",
                4 => "$ld->detalle | $compra->nro_compra" . ($ld->anulado == 1 ? ' (ANULADO)' : ''),
                5 => number_format($peso_total, 3),
                6 => number_format($peso_cajas, 3),
                7 => number_format($peso_neto, 3),
                8 => number_format(0, 3),
                9 => number_format(0, 3),
                10 => $ld->cajas_s,
                11 => $ld->anulado == 1 ? number_format(0, 3) : $cajas_acumulados,
                12 => $ld->und_e,
                13 => $ld->und_s,
                14 => $ld->anulado == 1 ? number_format(0, 3) : $pollos_acumulados,
                15 => $ld->anulado == 1 ? number_format(0, 3) : number_format($ld->kg_e, 3),
                16 => $ld->anulado == 1 ? number_format(0, 3) : number_format($ld->kg_s, 3),
                17 => $ld->anulado == 1 ? number_format(0, 3) : number_format($peso_neto2, 3),
                18 => $ld->id_nro,
                19 => $ld->producto,
                20 => $ld->user_id,
                21 => $ld->anulado,
            ],
        ];
    }

    ?>

    <?php
    }


    // ! ||--------------------------------------------------------------------------------||
    // ! ||                                  FIN REGISTROS                                 ||
    // ! ||--------------------------------------------------------------------------------||

    // $registros_x_pagina = 11;
    // $total_registros = count($registros);
    // $total_paginas = ceil($total_registros / $registros_x_pagina);
    // $pagina_actual = 0;

    // $registros = array_chunk($registros, $registros_x_pagina);
    $t_5 = 0;
    $t_6 = 0;
    $t_7 = 0;
    $t_8 = 0;
    $t_9 = 0;
    $t_10 = 0;
    $t_11 = 0;
    $t_12 = 0;
    $t_13 = 0;
    $t_14 = 0;
    $t_15 = 0;
    $t_16 = 0;
    $t_17 = 0;
    ?>
    @php
        function toNum($v)
        {
            if (is_numeric($v)) {
                return (float) $v;
            }
            $v = str_replace([' ', ','], ['', ''], (string) $v);
            return (float) $v;
        }
        $TG = [
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
            13 => 0,
            14 => 0,
            15 => 0,
            16 => 0,
            17 => 0,
        ];
        foreach ($registros as $r) {
            if ($r['tipo'] == 2 || $r['tipo'] == 3) {
                $tr = $r['valor'];
                for ($i = 5; $i <= 17; $i++) {
                    $TG[$i] += toNum($tr[$i] ?? 0);
                }
            }
        }
    @endphp
    <div class="tabla_borde body">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="11" align="left" class="bold"></th>
                    <th colspan="3" align="center" class="bold"><strong>CAJAS</strong></th>
                    <th colspan="3" align="center" class="bold"><strong>UNIDADES</strong></th>
                    <th colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></th>
                </tr>
                <tr>
                    <th align="left" width="40" class="bold"><strong>FECHA</strong></th>
                    <th align="left" width="30" class="bold"><strong>CINTA</strong></th>
                    <th align="left" width="30" class="bold"><strong>PIGM.</strong></th>
                    <th align="left" width="30" class="bold"><strong>NRO</strong></th>
                    <th align="left" width="30" class="bold"><strong>TIPO</strong></th>
                    <th align="left" width="30" class="bold"><strong></strong></th>
                    <th align="left" width="70" class="bold"><strong>DETALLE</strong></th>
                    <th align="left" width="30" class="bold"><strong>K.B</strong></th>
                    <th align="left" width="30" class="bold"><strong>TARA</strong></th>
                    <th align="left" width="30" class="bold"><strong>K.N</strong></th>
                    <th align="left" width="30" class="bold"><strong>N. M</strong></th>
                    <th align="left" width="30" class="bold"><strong>E</strong></th>
                    <th align="left" width="30" class="bold"><strong>S</strong></th>
                    <th align="left" width="30" class="bold"><strong>SA</strong></th>
                    <th align="left" width="30" class="bold"><strong>E</strong></th>
                    <th align="left" width="30" class="bold"><strong>S</strong></th>
                    <th align="left" width="30" class="bold"><strong>SA</strong></th>
                    <th align="left" width="30" class="bold"><strong>E</strong></th>
                    <th align="left" width="30" class="bold"><strong>S</strong></th>
                    <th align="left" width="30" class="bold"><strong>SA</strong></th>
                </tr>
            </thead>
            @php
                $COL_SA = [11, 14, 17];
                function addToSubTotal(&$sum, &$lastSA, $tr, $COL_SA) {
                    for ($i = 5; $i <= 17; $i++) {
                        $val = toNum($tr[$i] ?? 0);
                        if (in_array($i, $COL_SA, true)) {
                            $lastSA[$i] = $val;
                        } else {
                            $sum[$i] = ($sum[$i] ?? 0) + $val;
                        }
                    }
                }
                function printSubRow($label, $sumE, $lastSA, $sumS = null) {
                @endphp
                    <tr class="border_top" style="background:#f9f9f9;font-weight:bold;">
                        <th width="70" align="right" colspan="7">{{ $label }}</th>

                        <th width="30" align="left">{{ number_format($sumE[5] ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumE[6] ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumE[7] ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumE[8] ?? 0, 3) }}</th>

                        <th width="30" align="left">{{ number_format($sumE[9]  ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumS[10] ?? 0, 3) }}</th>
                        <th width="30" align="left" style="color: green">{{ number_format($lastSA[11] ?? 0, 3) }}</th>

                        <th width="30" align="left">{{ number_format($sumE[12] ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumS[13] ?? 0, 3) }}</th>
                        <th width="30" align="left" style="color: green">{{ number_format($lastSA[14] ?? 0, 3) }}</th>

                        <th width="30" align="left">{{ number_format($sumE[15] ?? 0, 3) }}</th>
                        <th width="30" align="left">{{ number_format($sumS[16] ?? 0, 3) }}</th>
                        <th width="30" align="left" style="color: green">{{ number_format($lastSA[17] ?? 0, 3) }}</th>
                    </tr>
                @php
                }

                $sum2 = []; $sa2 = []; $has2 = false;
                $sum3 = []; $sa3 = []; $has3 = false;
                $printedSub2 = false;
                $printedSub3 = false;
                $estaEnBloque = false;
                $bloqueNombre = '';
            @endphp

            @foreach ($registros as $v)
                @if ($v['tipo'] == 1)
                    @php
                        if ($estaEnBloque) {
                            if ($has2 && !$printedSub2) { printSubRow('SUBTOTAL COMPRAS', $sum2, $sa2); }
                            if ($has3 && !$printedSub3) {
                                printSubRow('SUBTOTALES: ' . $bloqueNombre, $sum2, $sa3, $sum3);
                                $printedSub3 = true;
                            }
                        }
                        $sum2 = []; $sa2 = []; $has2 = false;
                        $sum3 = []; $sa3 = []; $has3 = false;
                        $printedSub2 = false;
                        $printedSub3 = false;
                        $estaEnBloque = true;
                        $bloqueNombre = $v['valor'];
                    @endphp
                    <tr class="border_top">
                        <th colspan="20" class="bold section-title"><strong>{{ $v['valor'] }}</strong></th>
                    </tr>
                @endif
                @if ($v['tipo'] == 2)
                    @php
                        $tr = $v['valor'];
                        addToSubTotal($sum2, $sa2, $tr, $COL_SA); $has2 = true;
                    @endphp
                    <tr class="border_top">
                        <td widtd="40">{{ $tr[0] }}</td>
                        <td widtd="30" align="left">{{ $tr[19] }}</td>
                        <td widtd="30" align="left">{{ $tr[1] }}</td>
                        <td widtd="30" align="left">{{ $tr[2] }}</td>
                        <td widtd="30" align="left">{{ $tr[3] }}</td>
                        <td widtd="30" align="left">{{ $tr[18] }}</td>
                        @if ($tr[21] == 1)
                            <td style="color:red" widtd="70" align="left">{{ $tr[4] }}</td>
                        @else
                            <td widtd="70" align="left">{{ $tr[4] }}</td>
                        @endif
                        <td widtd="30" align="left">{{ $tr[5] }}</td>
                        <td widtd="30" align="left">{{ $tr[6] }}</td>
                        <td widtd="30" align="left">{{ $tr[7] }}</td>
                        <td widtd="30" align="left">{{ $tr[8] }}</td>
                        <td widtd="30" align="left">{{ $tr[9] }}</td>
                        <td widtd="30" align="left">{{ $tr[10] }}</td>
                        <td widtd="30" align="left">{{ $tr[11] }}</td>
                        <td widtd="30" align="left">{{ $tr[12] }}</td>
                        <td widtd="30" align="left">{{ $tr[13] }}</td>
                        <td widtd="30" align="left">{{ $tr[14] }}</td>
                        <td widtd="30" align="left">{{ $tr[15] }}</td>
                        <td widtd="30" align="left">{{ $tr[16] }}</td>
                        <td widtd="30" align="left">{{ $tr[17] }}</td>
                    </tr>
                @endif
                @if ($v['tipo'] == 3)
                    @php
                        $tr = $v['valor'];
                        if ($has2 && !$has3 && !$printedSub2) {
                            printSubRow('SUBTOTALES COMPRAS', $sum2, $sa2);
                            $printedSub2 = true;
                        }
                        addToSubTotal($sum3, $sa3, $tr, $COL_SA); $has3 = true;
                    @endphp
                    <tr class="border_top">
                        <td width="40">{{ $tr[0] }}</td>
                        <td width="30" align="left">{{ $tr[19] }}</td>
                        <td width="30" align="left">{{ $tr[1] }}</td>
                        <td width="30" align="left">{{ $tr[2] }}</td>
                        <td width="30" align="left">{{ $tr[3] }}</td>
                        <td width="30" align="left">{{ $tr[18] }}</td>
                        <td width="70" align="left">{{ $tr[4] }}</td>
                        <td width="30" align="left">{{ $tr[5] }}</td>
                        <td width="30" align="left">{{ $tr[6] }}</td>
                        <td width="30" align="left">{{ $tr[7] }}</td>
                        <td width="30" align="left">{{ $tr[8] }}</td>
                        <td width="30" align="left">{{ $tr[9] }}</td>
                        <td width="30" align="left">{{ $tr[10] }}</td>
                        <td width="30" align="left">{{ $tr[11] }}</td>
                        <td width="30" align="left">{{ $tr[12] }}</td>
                        <td width="30" align="left">{{ $tr[13] }}</td>
                        <td width="30" align="left">{{ $tr[14] }}</td>
                        <td width="30" align="left">{{ $tr[15] }}</td>
                        <td width="30" align="left">{{ $tr[16] }}</td>
                        <td width="30" align="left">{{ $tr[17] }}</td>
                    </tr>
                @endif
            @endforeach
            @php
                if ($estaEnBloque) {
                    if ($has2 && !$printedSub2) {
                        printSubRow('SUBTOTALES COMPRAS', $sum2, $sa2);
                        $printedSub2 = true;
                    }
                    if ($has3 && !$printedSub3) {
                        printSubRow('SUBTOTALES: ' . $bloqueNombre, $sum2, $sa3, $sum3);
                        $printedSub3 = true;
                    }
                }
            @endphp
        </table>
    </div>
    <div class="footer">
        <div class="tabla_borde foot">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th width="300">TOTALES ****</th>
                        <th width="30">{{ number_format($TG[5], 3) }}</th>
                        <th width="30">{{ number_format($TG[6], 3) }}</th>
                        <th width="30">{{ number_format($TG[7], 3) }}</th>
                        <th width="30">{{ number_format($TG[8], 3) }}</th>
                        <th width="30">{{ number_format($TG[9], 3) }}</th>
                        <th width="30">{{ number_format($TG[10], 3) }}</th>
                        <th width="30" style="color: green">{{ number_format($TG[9] - $TG[10], 3) }}</th>
                        <th width="30">{{ number_format($TG[12], 3) }}</th>
                        <th width="30">{{ number_format($TG[13], 3) }}</th>
                        <th width="30" style="color: green">{{ number_format($TG[12] - $TG[13], 3) }}</th>
                        <th width="30">{{ number_format($TG[15], 3) }}</th>
                        <th width="30">{{ number_format($TG[16], 3) }}</th>
                        <th width="30" style="color: green">{{ number_format($TG[15] - $TG[16], 3) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if (count($lote->reporte_envios_pp) > 0)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title "><strong>REPORTE DE ENVIO A
                                PP</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PP</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pp as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>

                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>

                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pp->sum('cajas') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pp->sum('pollos') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_bruto')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('tara')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_neto')) }}</strong>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
    @if (count($lote->reporte_envios_pt) > 0)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title "><strong>REPORTE DE ENVIO A
                                PT</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PT</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pt as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>
                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('cajas') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('pollos') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_bruto')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('tara')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_neto')) }}</strong>
                        </th>
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
