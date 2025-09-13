<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;

            border-spacing: 0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .white-bg {
            padding: 0px 20px 10px 20px;
        }

        th,
        td {
            border: none;
            padding: 5px;
        }

        .tabla_borde {
            border: 1px solid #666;
            /* border-radius: 10px */
        }

        tr.border_bottom td {
            border-bottom: 1px solid #000
        }

        tr.border_top td {
            border-top: 1px solid #666
        }

        td.border_right {
            border-right: 1px solid #666
        }

        .header {

            position: relative;
            top: 0;
            left: 0;
            right: 0;

            text-align: center;

        }

        /* Estilos para el pie de página */
        .footer {
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;



        }

        .body {

            position: relative;
        }

        .foot tr {
            background-color: #94c9ff;
        }
    </style>
</head>

<body class="white-bg">
    @php
        $registro = 0;
        $registros_compras = [];
        $registros_ventas = [];
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
    
    $registros_compras[] = [
        'tipo' => 1,
        'valor' => $detalle['producto'],
    ];
    foreach ($detalle['lote_detalles'] as $ld) {
        $registro++;
        $peso_total = $ld->peso_total;
        $peso_cajas = $ld->cajas * 2;
        $peso_neto = $peso_total - $peso_cajas;
        $registros_compras[] = [
            'tipo' => 2,
            'valor' => [
                0 => $ld->fecha . ' ' . $ld->hora . ' U:' . $ld->user_id,
                1 => $ld->pigmento == 1 ? 'SI' : 'NO',
                2 => "$ld->nro",
                3 => "$ld->tipo",
                4 => ($ld->anulado == 1 ? 'ANULADO ' : '') . "$ld->detalle | $compra->nro_compra",
                5 => number_format($peso_total, 3),
                6 => number_format($peso_cajas, 3),
                7 => number_format($peso_neto, 3),
                8 => number_format(0, 3),
                9 => $ld->cajas,
                10 => 0,
                11 => 0, // Acumulados opcionales
                12 => $ld->equivalente,
                13 => 0,
                14 => 0,
                15 => number_format($peso_neto, 3),
                16 => 0,
                17 => 0,
                18 => $ld->id_nro,
                19 => $ld->producto,
                20 => $ld->user_id,
                21 => $ld->anulado,
            ],
        ];
    }
    // Encabezado para ventas
    $registros_ventas[] = [
        'tipo' => 1,
        'valor' => $detalle['producto'],
    ];
    
    // Ventas: lista_registros
    foreach ($detalle['lista_registros'] as $ld) {
        $registro++;
        $peso_total = $ld->peso_total;
        $peso_cajas = $ld->cajas * 2;
        $peso_neto = $peso_total - $peso_cajas;
        $registros_ventas[] = [
            'tipo' => 2,
            'valor' => [
                0 => $ld->fecha . ' ' . $ld->hora . ' U:' . $ld->user_id,
                1 => $ld->pigmento == 1 ? 'SI' : 'NO',
                2 => "$ld->nro",
                3 => "$ld->tipo",
                4 => ($ld->anulado == 1 ? 'ANULADO ' : '') . "$ld->detalle | $compra->nro_compra",
                5 => number_format($peso_total, 3),
                6 => number_format($peso_cajas, 3),
                7 => number_format($peso_neto, 3),
                8 => number_format(0, 3),
                9 => 0,
                10 => $ld->cajas_s,
                11 => 0, // Acumulados opcionales
                12 => $ld->und_e,
                13 => $ld->und_s,
                14 => 0,
                15 => number_format($ld->kg_e, 3),
                16 => number_format($ld->kg_s, 3),
                17 => 0,
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

    $registros_x_pagina = 11;
    $total_registros = count($registros);
    $total_paginas = ceil($total_registros / $registros_x_pagina);
    $pagina_actual = 0;

    $registros = array_chunk($registros, $registros_x_pagina);
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
    foreach ($registros as $key => $value) {
        $pagina_actual += 1;
    ?>

    <div class="header">
        <table width="100%" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    //LOGO
                    <td width="5%" height="0" align="center">
                        @if (isset($sucursal->image->path_url))
                            <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif
                    </td>
                    //FIN LOGO

                    <td width="95%" height="0" align="center">

                        <div>
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9"
                                cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <strong><span style="font-size:18px">
                                                    SEGUIMIENTO DE MOVIMIENTOS - POR CRONOLOGICO - LOTE:
                                                    {{ $lote->id }}
                                                </span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA COMPRA: </strong>{{ $compra->fecha }}
                                        </td>
                                        <td align="left">
                                            <strong>COMPRA NRO: </strong>{{ $compra->nro }} - {{ $compra->nro_compra }}

                                        </td>
                                        <td colspan="2" align="left">
                                            <strong>PAGINA NRO: </strong>{{ $pagina_actual }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA LLEGADA: </strong>{{ $compra->fecha_llegada }}
                                        </td>
                                        <td align="left">
                                            <strong>PROVEEDOR: </strong>{{ $compra->ProveedorCompra->abreviatura }}
                                        </td>
                                        <td align="left">
                                            <strong>FECHA DE EMISION: </strong>{{ date('Y-m-d') }}
                                        </td>
                                        <td align="left">
                                            <strong>CERRADO: </strong>SI
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
        <div class="tabla_borde ">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td colspan="9" align="left" class="bold"></td>
                        <td></td>
                        <td colspan="3" align="center" class="bold"><strong>CAJAS</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>UNIDADES</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></td>
                    </tr>
                    <tr>
                        <td align="left" width="40" class="bold"><strong>FECHA</strong></td>
                        <td align="left" width="30" class="bold"><strong>CINTA</strong></td>
                        <td align="left" width="30" class="bold"><strong>PIGM.</strong></td>
                        <td align="left" width="30" class="bold"><strong>NRO</strong></td>
                        <td align="left" width="30" class="bold"><strong>TIPO</strong></td>
                        <td align="left" width="30" class="bold"><strong></strong></td>
                        <td align="left" width="70" class="bold"><strong>DETALLE</strong></td>
                        <td align="left" width="30" class="bold"><strong>K.B</strong></td>
                        <td align="left" width="30" class="bold"><strong>TARA</strong></td>
                        <td align="left" width="30" class="bold"><strong>K.N</strong></td>
                        <td align="left" width="30" class="bold"><strong>N. M</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                    </tr>
                    @foreach ($registros_compras as $v)
                        @if ($v['tipo'] == 1)
                            <tr class="border_top">
                                <td colspan="20" class="bold"><strong>{{ $v['valor'] }}</strong></td>
                            </tr>
                        @elseif ($v['tipo'] == 2)
                            @php
                                $tr = $v['valor'];
                            @endphp
                            <tr class="border_top">
                                <td>{{ $tr[0] }}</td>
                                <td>{{ $tr[19] }}</td>
                                <td>{{ $tr[1] }}</td>
                                <td>{{ $tr[2] }}</td>
                                <td>{{ $tr[3] }}</td>
                                <td>{{ $tr[18] }}</td>
                                <td @if ($tr[21] == 1) style="color:red" @endif>{{ $tr[4] }}</td>
                                <td>{{ $tr[5] }}</td>
                                <td>{{ $tr[6] }}</td>
                                <td>{{ $tr[7] }}</td>
                                <td>{{ $tr[8] }}</td>
                                <td>{{ $tr[9] }}</td>
                                <td>{{ $tr[10] }}</td>
                                <td>{{ $tr[11] }}</td>
                                <td>{{ $tr[12] }}</td>
                                <td>{{ $tr[13] }}</td>
                                <td>{{ $tr[14] }}</td>
                                <td>{{ $tr[15] }}</td>
                                <td>{{ $tr[16] }}</td>
                                <td>{{ $tr[17] }}</td>
                            </tr>
                        @endif
                    @endforeach
                    <!-- Aquí puedes agregar la fila de totales -->
                </tbody>
            </table>
        </div>

    </div>

    <div class="footer">
        <br>
        <div class="tabla_borde foot ">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>


                    <tr>

                        <td width="40">TOTALES****</td>
                        <td width="30" align="left"></td>
                        <td width="30" align="left"></td>
                        <td width="30"align="left"></td>
                        <td width="70"align="left"></td>
                        <td width="70"align="left"></td>
                        <td width="30"align="left">{{ number_format($t_5, 3) }}</td>
                        <td width="30"align="left">{{ number_format($t_6, 3) }}</td>
                        <td width="30"align="left">{{ $t_7 }}</td>
                        <td width="30"align="left">{{ number_format($t_8, 3) }}</td>
                        <td width="30"align="left">{{ number_format($t_9, 3) }}</td>
                        <td width="30"align="left">{{ $t_10 }}</td>
                        <td width="30"align="left">{{ number_format($t_11, 3) }}</td>
                        <td width="30"align="left">{{ $t_12 }}</td>
                        <td width="30"align="left">{{ $t_13 }}</td>
                        <td width="30"align="left">{{ $t_14 }}</td>
                        <td width="30"align="left">{{ number_format($t_15, 3) }}</td>
                        <td width="30"align="left">{{ $t_16 }}</td>
                        <td width="30"align="left">{{ number_format($t_17, 3) }}</td>


                    </tr>
                </tbody>

            </table>
        </div>
    </div>



    <div class="header">
        <table width="100%" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    //LOGO
                    <td width="5%" height="0" align="center">
                        @if (isset($sucursal->image->path_url))
                            <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif
                    </td>
                    //FIN LOGO

                    <td width="95%" height="0" align="center">

                        <div>
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9"
                                cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <strong><span style="font-size:18px">
                                                    SEGUIMIENTO DE MOVIMIENTOS - POR CRONOLOGICO - LOTE:
                                                    {{ $lote->id }}
                                                </span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA COMPRA: </strong>{{ $compra->fecha }}
                                        </td>
                                        <td align="left">
                                            <strong>COMPRA NRO: </strong>{{ $compra->nro }} -
                                            {{ $compra->nro_compra }}

                                        </td>
                                        <td colspan="2" align="left">
                                            <strong>PAGINA NRO: </strong>{{ $pagina_actual }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA LLEGADA: </strong>{{ $compra->fecha_llegada }}
                                        </td>
                                        <td align="left">
                                            <strong>PROVEEDOR: </strong>{{ $compra->ProveedorCompra->abreviatura }}
                                        </td>
                                        <td align="left">
                                            <strong>FECHA DE EMISION: </strong>{{ date('Y-m-d') }}
                                        </td>
                                        <td align="left">
                                            <strong>CERRADO: </strong>SI
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
        <div class="tabla_borde ">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td colspan="9" align="left" class="bold"></td>
                        <td></td>
                        <td colspan="3" align="center" class="bold"><strong>CAJAS</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>UNIDADES</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></td>
                    </tr>
                    <tr>
                        <td align="left" width="40" class="bold"><strong>FECHA</strong></td>
                        <td align="left" width="30" class="bold"><strong>CINTA</strong></td>
                        <td align="left" width="30" class="bold"><strong>PIGM.</strong></td>
                        <td align="left" width="30" class="bold"><strong>NRO</strong></td>
                        <td align="left" width="30" class="bold"><strong>TIPO</strong></td>
                        <td align="left" width="30" class="bold"><strong></strong></td>
                        <td align="left" width="70" class="bold"><strong>DETALLE</strong></td>
                        <td align="left" width="30" class="bold"><strong>K.B</strong></td>
                        <td align="left" width="30" class="bold"><strong>TARA</strong></td>
                        <td align="left" width="30" class="bold"><strong>K.N</strong></td>
                        <td align="left" width="30" class="bold"><strong>N. M</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                        <td align="left" width="30" class="bold"><strong>E</strong></td>
                        <td align="left" width="30" class="bold"><strong>S</strong></td>
                        <td align="left" width="30" class="bold"><strong>SA</strong></td>
                    </tr>
                    @foreach ($registros_ventas as $v)
                        @if ($v['tipo'] == 1)
                            <tr class="border_top">
                                <td colspan="20" class="bold"><strong>{{ $v['valor'] }}</strong></td>
                            </tr>
                        @elseif ($v['tipo'] == 2)
                            @php
                                $tr = $v['valor'];
                            @endphp
                            <tr class="border_top">
                                <td>{{ $tr[0] }}</td>
                                <td>{{ $tr[19] }}</td>
                                <td>{{ $tr[1] }}</td>
                                <td>{{ $tr[2] }}</td>
                                <td>{{ $tr[3] }}</td>
                                <td>{{ $tr[18] }}</td>
                                <td @if ($tr[21] == 1) style="color:red" @endif>{{ $tr[4] }}</td>
                                <td>{{ $tr[5] }}</td>
                                <td>{{ $tr[6] }}</td>
                                <td>{{ $tr[7] }}</td>
                                <td>{{ $tr[8] }}</td>
                                <td>{{ $tr[9] }}</td>
                                <td>{{ $tr[10] }}</td>
                                <td>{{ $tr[11] }}</td>
                                <td>{{ $tr[12] }}</td>
                                <td>{{ $tr[13] }}</td>
                                <td>{{ $tr[14] }}</td>
                                <td>{{ $tr[15] }}</td>
                                <td>{{ $tr[16] }}</td>
                                <td>{{ $tr[17] }}</td>
                            </tr>
                        @endif
                    @endforeach
                    <!-- Aquí puedes agregar la fila de totales -->
                </tbody>
            </table>
        </div>

    </div>

    <div class="footer">
        <br>
        <div class="tabla_borde foot ">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>


                    <tr>

                        <td width="40">TOTALES****</td>
                        <td width="30" align="left"></td>
                        <td width="30" align="left"></td>
                        <td width="30"align="left"></td>
                        <td width="70"align="left"></td>
                        <td width="70"align="left"></td>
                        <td width="30"align="left">{{ number_format($t_5, 3) }}</td>
                        <td width="30"align="left">{{ number_format($t_6, 3) }}</td>
                        <td width="30"align="left">{{ $t_7 }}</td>
                        <td width="30"align="left">{{ number_format($t_8, 3) }}</td>
                        <td width="30"align="left">{{ number_format($t_9, 3) }}</td>
                        <td width="30"align="left">{{ $t_10 }}</td>
                        <td width="30"align="left">{{ number_format($t_11, 3) }}</td>
                        <td width="30"align="left">{{ $t_12 }}</td>
                        <td width="30"align="left">{{ $t_13 }}</td>
                        <td width="30"align="left">{{ $t_14 }}</td>
                        <td width="30"align="left">{{ number_format($t_15, 3) }}</td>
                        <td width="30"align="left">{{ $t_16 }}</td>
                        <td width="30"align="left">{{ number_format($t_17, 3) }}</td>


                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    
    <?php
    }
    ?>












    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="center" colspan="7" class="bold"><strong>REPORTE DE ENVIO A PP</strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>PP</strong></td>
                        <td align="left" class="bold"><strong>CINTA</strong></td>
                        <td align="left" class="bold"><strong>CJ</strong></td>
                        <td align="left" class="bold"><strong>UNIDADES</strong></td>
                        <td align="left" class="bold"><strong>KG/BT</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>KG/NT</strong></td>
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
                        <td align="right" class="bold" colspan="2"> <strong>TOTAL</strong></td>

                        <td align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pp->sum('cajas') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pp->sum('pollos') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_bruto')) }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('tara')) }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_neto')) }}</strong>
                        </td>

                    </tr>


                </tbody>
            </table>
        </div>
        <br>
    </div>
    <br>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="center" colspan="7" class="bold"><strong>REPORTE DE ENVIO A PT</strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>PT</strong></td>
                        <td align="left" class="bold"><strong>CINTA</strong></td>
                        <td align="left" class="bold"><strong>CJ</strong></td>
                        <td align="left" class="bold"><strong>UNIDADES</strong></td>
                        <td align="left" class="bold"><strong>KG/BT</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>KG/NT</strong></td>
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
                        <td align="right" class="bold" colspan="2"> <strong>TOTAL</strong></td>

                        <td align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('cajas') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('pollos') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_bruto')) }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('tara')) }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_neto')) }}</strong>
                        </td>

                    </tr>


                </tbody>
            </table>
        </div>
        <br>
    </div>
    <br>
</body>

</html>
