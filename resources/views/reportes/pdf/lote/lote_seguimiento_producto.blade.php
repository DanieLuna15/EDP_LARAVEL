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
                        SEGUIMIENTO DE COMPRAS - POR PRODUCTO / LOTE N° <?= $lote->id ?>
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
        $cajas_entrada = 0;
        $und_entrada = 0;
        $kg_entrada = 0;
        foreach ($detalle['lote_detalles'] as $ld) {
            $registro += 1;
            $peso_total = $ld->peso_total;
            $peso_cajas = $ld->cajas * 2;
            $peso_neto = $peso_total - $peso_cajas;
            $peso_total2 += $peso_total;
            $peso_cajas2 += $peso_cajas;
            $peso_neto2 += $peso_neto;
            $cajas_entrada += $ld->cajas;
            $und_entrada += $ld->equivalente;
            $kg_entrada += $peso_neto;
            $registros[] = [
                "tipo" => 2,
                "valor" => [
                    0 => $ld->fecha." ".$ld->hora." U:".$ld->user_id,
                    1=>$ld->pigmento==1?'SI':'NO',
                    2=>"$ld->nro",
                    3=>"$ld->tipo",
                    4 => "$ld->detalle | $compra->nro_compra",
                    5 => number_format($peso_total, 3),
                    6 => number_format($peso_cajas, 3),
                    7 => number_format($peso_neto, 3),
                    8 => number_format(0, 2),
                    9 => number_format($ld->cajas,3),
                    10 => 0,
                    11 => number_format($ld->cajas,3),
                    12 => number_format($ld->equivalente,3),
                    13 => 0,
                    14 => number_format($ld->equivalente,3),
                    15 => number_format($peso_neto,3),
                    16 => 0,
                    17 => number_format($peso_neto,3),
                    18 => $ld->id_nro,
                ]
            ];
        ?>

    @foreach ($ld->LoteDetalleProductos as $ldp)
        @php
            $registro += 1;
            $registros[] = [
                'tipo' => 3,
                'valor' => [
                    0 => $ldp->fecha . ' ' . $ldp->hora . ' U:' . $ldp->user_id,
                    1 => $ldp->pigmento == 1 ? 'SI' : 'NO',
                    2 => $ldp->nro,
                    3 => $ldp->tipo,
                    4 => "$ldp->detalle | $compra->nro_compra" . ($ldp->anulado == 1 ? ' (ANULADO)' : ''),
                    5 => 0,
                    6 => 0,
                    7 => 0,
                    8 => 0,
                    9 => 0,
                    10 => $ldp->anulado == 1 ? 0 : number_format($ldp->cajas_s, 3),
                    11 => $ldp->anulado == 1 ? 0 : number_format($ldp->cajas_sa, 3),
                    12 => $ldp->anulado == 1 ? 0 : 0,
                    13 => $ldp->anulado == 1 ? 0 : number_format($ldp->und_s, 3),
                    14 => $ldp->anulado == 1 ? 0 : number_format($ldp->und_sa, 3),
                    15 => $ldp->anulado == 1 ? 0 : 0,
                    16 => $ldp->anulado == 1 ? 0 : number_format($ldp->kg_s, 3),
                    17 => $ldp->anulado == 1 ? 0 : number_format($ldp->kg_sa, 3),
                    18 => $ldp->id_nro,
                    19 => $ldp->anulado,
                ],
            ];
        @endphp
    @endforeach
    @php
        $registro += 1;
        $ltp = $ld->LoteDetalleProductos;
        $total_peso_bruto = $ltp->sum('peso_bruto');
        $total_peso_bruto_detalle += $ltp->sum('peso_bruto');
        $total_tara = $ltp->sum('tara');
        $total_tara_detalle += $ltp->sum('tara');
        $total_peso_neto = $ltp->sum('peso_neto');
        $total_peso_neto_detalle += $ltp->sum('peso_neto');
        $total_cajas_e = $cajas_entrada;
        $total_cajas_e_detalle += $ltp->sum('cajas_e');
        $total_cajas_s = $ltp->sum('cajas_s');
        $total_cajas_s_detalle += $ltp->sum('cajas_s');
        $total_cajas_sa = $total_cajas_e - $total_cajas_s;
        $total_cajas_sa_detalle += $ltp->sum('cajas_sa');
        $total_und_e = $und_entrada;
        $total_und_e_detalle += $ltp->sum('und_e');
        $total_und_s = $ltp->sum('und_s');
        $total_und_s_detalle += $ltp->sum('und_s');
        $total_und_sa = $total_und_e - $total_und_s;
        $total_und_sa_detalle += $ltp->sum('und_sa');
        $total_kg_e = $kg_entrada;
        $total_kg_e_detalle += $ltp->sum('kg_e');
        $total_kg_s = $ltp->sum('kg_s');
        $total_kg_s_detalle += $ltp->sum('kg_s');
        $total_kg_sa = $total_kg_e - $total_kg_s;
        $total_kg_sa_detalle += $ltp->sum('kg_sa');
        $pig = $ld->pigmento == 1 ? 'CON' : 'SIN';
        $registros[] = [
            'tipo' => 4,
            'valor' => [
                0 => "*** SUBTOTAL {$detalle['producto']} - {$pig} PIGMENTO",
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5  => round($peso_total2, 3),     // K.B total de las filas tipo 2
                6  => round($peso_cajas2, 3),     // TARA total (cajas*2)
                7  => round($peso_neto2, 3),
                8 => 0,
                9 => number_format($total_cajas_e, 3),
                10 => number_format($total_cajas_s, 3),
                11 => number_format($total_cajas_sa, 3),
                12 => number_format($total_und_e, 3),
                13 => number_format($total_und_s, 3),
                14 => number_format($total_und_sa, 3),
                15 => number_format($total_kg_e, 3),
                16 => number_format($total_kg_s, 3),
                17 => number_format($total_kg_sa, 3),
            ],
        ];
    @endphp

    <?php
        }
        // $registro += 1;
        // $registros[] = [
        //     "tipo" => 5,
        //     "valor" => [
        //         0 => "****SUBTOTAL {$detalle['producto']}****",
        //         1 => 0,
        //         2 => 0,
        //         3 => 0,
        //         4 => 0,
        //         5 => $peso_total2,
        //         6 => $peso_cajas2,
        //         7 => $peso_neto2,
        //         8 => 0,
        //         9 => $cajas_entrada,
        //         10 => $total_cajas_s_detalle,
        //         11 => $total_cajas_sa_detalle,
        //         12 => $total_und_e_detalle,
        //         13 => $total_und_s_detalle,
        //         14 => $total_und_sa_detalle,
        //         15 => $total_kg_e_detalle,
        //         16 => $total_kg_s_detalle,
        //         17 => $total_kg_sa_detalle,

        //     ]

        // ];
        ?>

    <?php
    }

    // ! ||--------------------------------------------------------------------------------||
    // ! ||                                  FIN REGISTROS                                 ||
    // ! ||--------------------------------------------------------------------------------||

    // $registros_x_pagina = 17;
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
        function toNum($v) {
            if (is_numeric($v)) return (float)$v;
            $v = str_replace([' ', ','], ['', ''], (string)$v);
            return (float)$v;
        }

        $TG = [5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0,12=>0,13=>0,14=>0,15=>0,16=>0,17=>0];
        foreach ($registros as $r) {
            if ($r['tipo']==2 || $r['tipo']==3) {
                $tr = $r['valor'];
                for ($i=5; $i<=17; $i++) {
                    $TG[$i] += toNum($tr[$i] ?? 0);
                }
            }
        }
    @endphp


    <div class="tabla_borde body">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="10" align="left" class="bold"></th>
                    <th colspan="3" align="center" class="bold"><strong>CAJAS</strong></th>
                    <th colspan="3" align="center" class="bold"><strong>UNIDADES</strong></th>
                    <th colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></th>
                </tr>
                <tr>
                    <th width="40">FECHA</th>
                    <th width="30">PIGM.</th>
                    <th width="30">NRO</th>
                    <th width="30">TIPO</th>
                    <th width="30"></th>
                    <th width="70">DETALLE</th>
                    <th width="30">K.B</th>
                    <th width="30">TARA</th>
                    <th width="30">K.N</th>
                    <th width="30">N. M</th>
                    <th width="30">E</th>
                    <th width="30">S</th>
                    <th width="30">SA</th>
                    <th width="30">E</th>
                    <th width="30">S</th>
                    <th width="30">SA</th>
                    <th width="30">E</th>
                    <th width="30">S</th>
                    <th width="30">SA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $v)
                    @if ($v['tipo'] == 1)
                        <tr class="border_top">
                            <th colspan="19" class="bold section-title"><strong>{{ $v['valor'] }}</strong></th>
                        </tr>
                    @endif

                    @if ($v['tipo'] == 2)
                        @php
                            $tr = $v['valor'];
                            $t_5 += floatval($tr[5]);
                            $t_6 += floatval($tr[6]);
                            $t_7 += floatval($tr[7]);
                            $t_9 += floatval($tr[9]);
                            $t_12 += floatval($tr[12]);
                            $t_15 += floatval($tr[15]);
                        @endphp
                        <tr class="border_top">
                            <th width="40">{{ $tr[0] }}</th>
                            <th width="30">{{ $tr[1] }}</th>
                            <th width="30">{{ $tr[2] }}</th>
                            <th width="30">{{ $tr[3] }}</th>
                            <th width="30">{{ $tr[18] }}</th>
                            <th width="70">{{ $tr[4] }}</th>
                            <th width="30">{{ $tr[5] }}</th>
                            <th width="30">{{ $tr[6] }}</th>
                            <th width="30">{{ $tr[7] }}</th>
                            <th width="30">{{ $tr[8] }}</th>
                            <th width="30">{{ $tr[9] }}</th>
                            <th width="30">{{ $tr[10] }}</th>
                            <th width="30">{{ $tr[11] }}</th>
                            <th width="30">{{ $tr[12] }}</th>
                            <th width="30">{{ $tr[13] }}</th>
                            <th width="30">{{ $tr[14] }}</th>
                            <th width="30">{{ $tr[15] }}</th>
                            <th width="30">{{ $tr[16] }}</th>
                            <th width="30">{{ $tr[17] }}</th>
                        </tr>
                    @endif

                    @if ($v['tipo'] == 3)
                        @php $tr = $v['valor']; @endphp
                        <tr class="border_top">
                            <td width="40">{{ $tr[0] }}</td>
                            <td width="30">{{ $tr[1] }}</td>
                            <td width="30">{{ $tr[2] }}</td>
                            <td width="30">{{ $tr[3] }}</td>
                            <td width="30">{{ $tr[18] }}</td>
                            <td width="70" @if ($tr[19] == 1) style="color:red" @endif>
                                {{ $tr[4] }}</td>
                            <td width="30">{{ $tr[5] }}</td>
                            <td width="30">{{ $tr[6] }}</td>
                            <td width="30">{{ $tr[7] }}</td>
                            <td width="30">{{ $tr[8] }}</td>
                            <td width="30">{{ $tr[9] }}</td>
                            <td width="30">{{ $tr[10] }}</td>
                            <td width="30">{{ $tr[11] }}</td>
                            <td width="30">{{ $tr[12] }}</td>
                            <td width="30">{{ $tr[13] }}</td>
                            <td width="30">{{ $tr[14] }}</td>
                            <td width="30">{{ $tr[15] }}</td>
                            <td width="30">{{ $tr[16] }}</td>
                            <td width="30">{{ $tr[17] }}</td>
                        </tr>
                        @php
                            $t_5 += floatval($tr[5]);
                            $t_6 += floatval($tr[6]);
                            $t_7 += floatval($tr[7]);
                            $t_8 += floatval($tr[8]);
                            $t_9 += floatval($tr[9]);
                            $t_10 += floatval($tr[10]);
                            $t_11 += floatval($tr[11]);
                            $t_12 += floatval($tr[12]);
                            $t_13 += floatval($tr[13]);
                            $t_14 += floatval($tr[14]);
                            $t_15 += floatval($tr[15]);
                            $t_16 += floatval($tr[16]);
                            $t_17 += floatval($tr[17]);
                        @endphp
                    @endif

                    @if ($v['tipo'] == 4)
                        @php $tr = $v['valor']; @endphp
                        <tr class="border_top">
                            <th colspan="5" class="bold"><strong>{{ $tr[0] }}</strong></th>
                            <th></th>
                            <th class="bold"><strong>{{ number_format($tr[5], 3) }}</strong></th>
                            <th class="bold"><strong>{{ number_format($tr[6], 3) }}</strong></th>
                            <th class="bold"><strong>{{ number_format($tr[7], 3) }}</strong></th>
                            <th></th>
                            <th class="bold"><strong>{{ $tr[9] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[10] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[11] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[12] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[13] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[14] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[15] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[16] }}</strong></th>
                            <th class="bold"><strong>{{ $tr[17] }}</strong></th>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="tabla_borde foot">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th width="260">TOTALES ****</th>
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
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
