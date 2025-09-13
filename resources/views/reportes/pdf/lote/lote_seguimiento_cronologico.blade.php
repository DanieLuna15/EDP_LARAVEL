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
                "tipo" => 2,
                "valor" => [
                    0 => $ld->fecha . ' ' . $ld->hora." U:".$ld->user_id ,
                    1=>$ld->pigmento==1?'SI':'NO',
                    2=>"$ld->nro",
                    3=>"$ld->tipo",
                    4 =>($ld->anulado==1?"ANULADO ":""). "$ld->detalle | $compra->nro_compra",
                    5 => number_format($peso_total, 3),
                    6 => number_format($peso_cajas, 3),
                    7 => number_format($peso_neto, 3),
                    8 => number_format(0, 3),
                    9 => $ld->cajas,
                    10 => 0,
                    11 => $cajas_acumulados,
                    12 => $ld->equivalente,
                    13 => 0,
                    14 => $pollos_acumulados,
                    15 => number_format($peso_neto,3),
                    16 => 0,
                    17 => number_format($peso_neto2,3),
                    18 => $ld->id_nro,
                    19=>$ld->producto,
                    20=>$ld->user_id,
                    21=>$ld->anulado
                ]

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
                "tipo" => 2,
                "valor" => [
                    0 => $ld->fecha.' '.$ld->hora." U:".$ld->user_id ,
                    1=>$ld->pigmento==1?'SI':'NO',
                    2=>"$ld->nro",
                    3=>"$ld->tipo",
                    4 =>($ld->anulado==1?"ANULADO ":""). "$ld->detalle | $compra->nro_compra",
                    5 => number_format($peso_total, 3),
                    6 => number_format($peso_cajas, 3),
                    7 => number_format($peso_neto, 3),
                    8 => number_format(0, 3),
                    9 => 0,
                    10 => $ld->cajas_s,
                    11 => $cajas_acumulados,
                    12 => $ld->und_e,
                    13 => $ld->und_s,
                    14 => $pollos_acumulados,
                    15 => number_format($ld->kg_e,3),
                    16 => number_format($ld->kg_s,3),
                    17 => number_format($peso_neto2, 3),
                    18 => $ld->id_nro,
                    19=>$ld->producto,
                    20=>$ld->user_id,
                    21 => $ld->anulado
                ]

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
                        @if(isset($sucursal->image->path_url))
                        <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                        @endif
                    </td>
                    //FIN LOGO

                    <td width="95%" height="0" align="center">

                        <div>
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <strong><span style="font-size:18px">
                                                    SEGUIMIENTO DE COMPRAS - POR CRONOLOGICO
                                                </span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA COMPRA: </strong>{{$compra->fecha}}
                                        </td>
                                        <td align="left">
                                        <strong>COMPRA NRO: </strong>{{$compra->nro}} - {{$compra->nro_compra}}

                                        </td>
                                        <td colspan="2" align="left">
                                            <strong>PAGINA NRO: </strong>{{$pagina_actual}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA LLEGADA: </strong>{{$compra->fecha_llegada}}
                                        </td>
                                        <td align="left">
                                            <strong>PROVEEDOR: </strong>{{$compra->ProveedorCompra->abreviatura }}
                                        </td>
                                        <td align="left">
                                            <strong>FECHA DE EMISION: </strong>{{date('Y-m-d') }}
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


            <table width="100%" border="0" aling="center" cellpadding="0" cellspacing="0">
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="tabla_borde body">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
          @foreach($value as $v)
          @if($v['tipo'] == 1)
          <tr  class="border_top">
                        <td colspan="20" class="bold"><strong>{{$v['valor']}}</strong></td>

                    </tr>
          @endif
          @if ($v['tipo'] == 2)
    @php
        $tr = $v['valor'];
        // Función para mostrar valor seguro o guion si no existe
        $safeVal = fn($index) => $tr[$index] ?? '-';
    @endphp
    <tr class="border_top">
        <td width="40">{{ $safeVal(0) }}</td>
        <td width="30" align="left">{{ $safeVal(19) }}</td>
        <td width="30" align="left">{{ $safeVal(1) }}</td>
        <td width="30" align="left">{{ $safeVal(2) }}</td>
        <td width="30" align="left">{{ $safeVal(3) }}</td>
        <td width="30" align="left">{{ $safeVal(18) }}</td>
        @if (($tr[21] ?? 0) == 1)
            <td style="color:red" width="70" align="left">{{ $safeVal(4) }}</td>
        @else
            <td width="70" align="left">{{ $safeVal(4) }}</td>
        @endif
        <td width="30" align="left">{{ $safeVal(5) }}</td>
        <td width="30" align="left">{{ $safeVal(6) }}</td>
        <td width="30" align="left">{{ $safeVal(7) }}</td>
        <td width="30" align="left">{{ $safeVal(8) }}</td>
        <td width="30" align="left">{{ $safeVal(9) }}</td>
        <td width="30" align="left">{{ $safeVal(10) }}</td>
        <td width="30" align="left">{{ $safeVal(11) }}</td>
        <td width="30" align="left">{{ $safeVal(12) }}</td>
        <td width="30" align="left">{{ $safeVal(13) }}</td>
        <td width="30" align="left">{{ $safeVal(14) }}</td>
        <td width="30" align="left">{{ $safeVal(15) }}</td>
        <td width="30" align="left">{{ $safeVal(16) }}</td>
        <td width="30" align="left">{{ $safeVal(17) }}</td>
    </tr>
@endif

          @if($v['tipo'] == 3)
            @php
            $tr = $v['valor'];
            $t_5 += floatval($tr[5]);
            $t_6 += floatval($tr[6]);
            $t_7 += floatval($tr[7]);
            @endphp
          <tr class="border_top">

                            <td width="40">{{$tr[0]}}</td>
                            <td width="30" align="left">{{$tr[18]}}</td>
                            <td width="30" align="left">{{$tr[1]}}</td>
                            <td width="30" align="left">{{$tr[2]}}</td>
                            <td width="30"align="left">{{$tr[3]}}</td>
                            <td width="30"align="left">{{$tr[18]}}</td>
                            <td width="70"align="left">{{$tr[4]}}</td>
                            <td width="30"align="left">{{$tr[5]}}</td>
                            <td width="30"align="left">{{$tr[6]}}</td>
                            <td width="30"align="left">{{$tr[7]}}</td>
                            <td width="30"align="left">{{$tr[8]}}</td>
                            <td width="30"align="left">{{$tr[9]}}</td>
                            <td width="30"align="left">{{$tr[10]}}</td>
                            <td width="30"align="left">{{$tr[11]}}</td>
                            <td width="30"align="left">{{$tr[12]}}</td>
                            <td width="30"align="left">{{$tr[13]}}</td>
                            <td width="30"align="left">{{$tr[14]}}</td>
                            <td width="30"align="left">{{$tr[15]}}</td>
                            <td width="30"align="left">{{$tr[16]}}</td>
                            <td width="30"align="left">{{$tr[17]}}</td>


                        </tr>
            @endif
          @if($v['tipo'] == 4)
            @php
            $tr = $v['valor'];
            @endphp
            <tr class="border_top">

                            <td colspan="6" class="bold"><strong>{{$tr[0]}}</strong></td>

                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong></strong></td>

                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong>{{$tr[9]}}</strong></td>
                            <td class="bold"><strong>{{$tr[10]}}</strong></td>
                            <td class="bold"><strong>{{$tr[11]}}</strong></td>
                            <td class="bold"><strong>{{$tr[12]}}</strong></td>
                            <td class="bold"><strong>{{$tr[13]}}</strong></td>
                            <td class="bold"><strong>{{$tr[14]}}</strong></td>
                            <td class="bold"><strong>{{$tr[15]}}</strong></td>
                            <td class="bold"><strong>{{$tr[16]}}</strong></td>
                            <td class="bold"><strong>{{$tr[17]}}</strong></td>
                        </tr>
            @endif
          @if($v['tipo'] == 5)
            @php
            $tr = $v['valor'];
            $t_5 += floatval($tr[5]);
            $t_6 += floatval($tr[6]);
            $t_7 += floatval($tr[7]);
            @endphp
            <tr class="border_top">

                            <td colspan="6" class="bold"><strong>{{$tr[0]}}</strong></td>
                            <td class="bold"></td>

                            <td class="bold"><strong>{{$tr[5]}}</strong></td>
                            <td class="bold"><strong>{{$tr[6]}}</strong></td>
                            <td class="bold"><strong>{{$tr[7]}}</strong></td>

                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong>{{$tr[9]}}</strong></td>
                            <td class="bold"><strong>{{$tr[10]}}</strong></td>
                            <td class="bold"><strong>{{$tr[11]}}</strong></td>
                            <td class="bold"><strong>{{$tr[12]}}</strong></td>
                            <td class="bold"><strong>{{$tr[13]}}</strong></td>
                            <td class="bold"><strong>{{$tr[14]}}</strong></td>
                            <td class="bold"><strong>{{$tr[15]}}</strong></td>
                            <td class="bold"><strong>{{$tr[16]}}</strong></td>
                            <td class="bold"><strong>{{$tr[17]}}</strong></td>
                        </tr>
            @endif
@if($v['tipo'] == 2)
    @php
        $tr = $v['valor'];
        $safeVal = fn($i) => isset($tr[$i]) ? floatval($tr[$i]) : 0;

        $t_5 += $safeVal(5);
        $t_6 += $safeVal(6);
        $t_7 += $safeVal(7);
        $t_8 += $safeVal(8);
        $t_9 += $safeVal(9);
        $t_10 += $safeVal(10);
        $t_11 += $safeVal(9) - $safeVal(10);
        $t_12 += $safeVal(12);
        $t_13 += $safeVal(13);
        $t_14 += $safeVal(12) - $safeVal(13);
        $t_15 += $safeVal(15);
        $t_16 += $safeVal(16);
        $t_17 += $safeVal(15) - $safeVal(16);
    @endphp
@endif

          @endforeach
        </table>
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
                    <td width="30"align="left">{{number_format($t_5,3)}}</td>
                    <td width="30"align="left">{{number_format($t_6,3)}}</td>
                    <td width="30"align="left">{{$t_7}}</td>
                    <td width="30"align="left">{{number_format($t_8,3)}}</td>
                    <td width="30"align="left">{{number_format($t_9,3)}}</td>
                    <td width="30"align="left">{{$t_10}}</td>
                    <td width="30"align="left">{{number_format($t_11,3)}}</td>
                    <td width="30"align="left">{{$t_12}}</td>
                    <td width="30"align="left">{{$t_13}}</td>
                    <td width="30"align="left">{{$t_14}}</td>
                    <td width="30"align="left">{{number_format($t_15,3)}}</td>
                    <td width="30"align="left">{{$t_16}}</td>
                    <td width="30"align="left">{{number_format($t_17,3)}}</td>


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
                    $detalle = (object)$detalle;
                    @endphp
                    <tr class="border_top">
                        <td align="left" >{{$detalle->lote}}</td>
                        <td align="left" >{{$detalle->cinta}}</td>
                        <td align="left" >{{$detalle->cajas}}</td>
                        <td align="left" >{{$detalle->pollos}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->peso_bruto)}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->tara)}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->peso_neto)}}</td>

                    </tr>

                    @endforeach
                    <tr class="border_top">
                        <td align="right" class="bold" colspan="2"> <strong>TOTAL</strong></td>

                        <td align="left" class="bold"><strong>{{$lote->reporte_envios_pp->sum('cajas')}}</strong></td>
                        <td align="left" class="bold"><strong>{{$lote->reporte_envios_pp->sum('pollos')}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_bruto'))}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pp->sum('tara'))}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_neto'))}}</strong></td>

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
                    $detalle = (object)$detalle;
                    @endphp
                    <tr class="border_top">
                        <td align="left" >{{$detalle->lote}}</td>
                        <td align="left" >{{$detalle->cinta}}</td>
                        <td align="left" >{{$detalle->cajas}}</td>
                        <td align="left" >{{$detalle->pollos}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->peso_bruto)}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->tara)}}</td>
                        <td align="left" >{{sprintf('%0.3f', $detalle->peso_neto)}}</td>

                    </tr>

                    @endforeach
                    <tr class="border_top">
                        <td align="right" class="bold" colspan="2"> <strong>TOTAL</strong></td>

                        <td align="left" class="bold"><strong>{{$lote->reporte_envios_pt->sum('cajas')}}</strong></td>
                        <td align="left" class="bold"><strong>{{$lote->reporte_envios_pt->sum('pollos')}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_bruto'))}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pt->sum('tara'))}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_neto'))}}</strong></td>

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
