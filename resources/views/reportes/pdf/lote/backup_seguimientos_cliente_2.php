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
    <?php

    $registro = 0;
    $registros = [];

    $registros[] = [
        "tipo" => 1,
        "valor" => "COMPRA"
    ];

    $p_bruto_total = 0;
    $tara_t = 0;
    $p_neto_total = 0;
    $cont_e_t = 0;
    $cont_s_t = 0;
    $cont_sa_t = 0;
    $unit_e_t = 0;
    $unit_s_t = 0;
    $unit_sa_t = 0;
    $kgs_e_t = 0;
    $kgs_s_t = 0;
    $kgs_sa_t = 0;
    $cajas_acumulados = 0;
    $pollos_acumulados = 0;
    $peso_acumulado = 0;
    foreach ($lote->LoteDetalles()->orderBy('name', 'asc')->get() as $detalle) {
        $seguimiento = $detalle->LoteDetalleSeguimientos();
        $kgs_s = $seguimiento->sum('kgs_s');
        $unit_s = $seguimiento->sum('unit_s');
        $cont_s = $seguimiento->sum('cont_s');
        $tara = $detalle->cajas * 2;
        $p_bruto_total += $detalle->peso_total;
        $tara_t = $tara_t + $tara;
        $p_neto_total += $detalle->peso_total - $tara;
        $cont_e_t += $detalle->cajas;
        $unit_e_t += $detalle->equivalente;
        $kgs_e_t += $detalle->peso_total - $tara;
        $cont_s_t += $cont_s;
        $unit_s_t += $unit_s;
        $kgs_s_t += $kgs_s;
        $cont_sa_t += $detalle->cajas;
        $unit_sa_t += $detalle->equivalente - $unit_s;
        $kgs_sa_t += ($detalle->peso_total - $tara) - $kgs_s;
        $cajas_acumulados += $detalle->cajas;
        $pollos_acumulados += $detalle->pollos * $detalle->cajas;
        $peso_acumulado += $detalle->peso_total - $detalle->cajas * 2;
        $registros[] = [
            "tipo" => 2,
            "valor" => [
                0 => $detalle->fecha." ".$detalle->hora." U:".$detalle->user_id,
                1 => $detalle->name,
                2 => $detalle->pigmento == 1 ? 'SI' : 'NO',
                3 => "COM",
                4 => "COMPRA",
                5 => number_format($detalle->peso_total, 2),
                6 => number_format($detalle->cajas * 2, 2),
                7 => number_format($detalle->peso_total - $detalle->cajas * 2, 2),
                8 => number_format(0, 2),
                9 => number_format($detalle->cajas, 2),
                10 => number_format(0, 2),
                11 => number_format($cajas_acumulados, 2),
                12  => number_format($detalle->pollos * $detalle->cajas, 2),
                13 => number_format(0, 2),
                14 => number_format($pollos_acumulados, 2),
                15 => number_format($detalle->peso_total - $detalle->cajas * 2, 2),
                16 => number_format(0, 2),
                17 => number_format($peso_acumulado, 2),
                18 => "E",
            ]
        ];
    }
    $registros[] = [
        "tipo" => 4,
        "valor" => [
            0 => "",
            1 => "",
            2 => "",
            3 => "",
            4 => "",
            5 => number_format($p_bruto_total, 2),
            6 => number_format($tara_t, 2),
            7 => number_format($p_neto_total, 2),
            8 => number_format($cont_e_t, 2),
            9 => number_format(0, 2),
            10 => number_format($cajas_acumulados, 2),
            11 => number_format($unit_e_t, 2),
            12 => number_format(0, 2),
            13 => number_format($pollos_acumulados, 2),
            14 => number_format($kgs_e_t, 2),
            15 => number_format(0, 2),
            16 => number_format($peso_acumulado, 2),
            17 => 0,
        ]
        ];
    foreach ($lote->lote_detalles_cliente as $detalle) {
            $registros[] = [
                "tipo" => 1,
                "valor" => strtoupper($detalle['lote_detalle']->nombre)
            ];


            $p_bruto_total = 0;
            $tara_t = 0;
            $p_neto_total = 0;
            $cont_e_t = 0;
            $cont_s_t = 0;
            $cont_sa_t = 0;
            $unit_e_t = 0;
            $unit_s_t = 0;
            $unit_sa_t = 0;
            $kgs_e_t = 0;
            $kgs_s_t = 0;
            $kgs_sa_t = 0;
            foreach ($detalle['detalles'] as $s) {
                $p_bruto_total += 0;
                $tara_t = $tara_t + 0;
                $p_neto_total += 0;
                $cont_e_t += $s->cont_e;
                $unit_e_t += $s->unit_e;
                $kgs_e_t += $s->peso_neto;
                $cont_s_t += $s->cont_s;
                $unit_s_t += $s->unit_s;
                $kgs_s_t += $s->kgs_s;
                $cont_sa_t += $s->cont_sa;
                $unit_sa_t += $s->unit_sa;
                $kgs_sa_t += $s->kgs_sa;
                $registros [] = [
                    "tipo" => 3,
                    "valor" =>[
                        0 => $s->fecha." ".$s->hora." U:".$s->user_id,
                        1 => $s->LoteDetalle->name,
                        2 => $s->LoteDetalle->pigmento==1?'SI':'NO',
                        3 => $s->nro,
                        4 => $s->cliente,
                        5 => number_format(0, 2),
                        6 => number_format(0, 2),
                        7 => number_format(0, 2),
                        8 => number_format(0, 2),
                        9 => number_format($s->cont_s, 2),
                        10 => number_format(0, 2),
                        11 => number_format(0, 2),
                        12 => number_format($s->unit_s, 2),
                        13 => number_format(0, 2),
                        14 => number_format(0, 2),
                        15 => number_format($s->kgs_s, 2),
                        16 => number_format(0, 2),
                        17 => 0,
                    ]
                ];


            }
            $registros[] = [
                "tipo" => 4,
                "valor" => [
                    0 => "",
                    1 => "",
                    2 => "",
                    3 => "",
                    4 => "",
                    5 => number_format($p_bruto_total, 2),
                    6 => number_format($tara_t, 2),
                    7 => number_format($p_neto_total, 2),
                    8 => number_format(0, 2),
                    9 => number_format($cont_s_t, 2),
                    10 => number_format(0, 2),
                    11 => number_format(0, 2),
                    12 => number_format($unit_s_t, 2),
                    13 => number_format(0, 2),
                    14 => number_format(0, 2),
                    15 => number_format($kgs_s_t, 2),
                    16 => number_format(0, 2),
                    17 => 0,
                ]
                ];


        }


    $registros_x_pagina = 12;
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
                                                        SEGUIMIENTO DE COMPRAS - POR CLIENTE
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <strong>FECHA DE LA COMPRA: </strong>{{$compra->fecha}}
                                            </td>
                                            <td align="left">
                                                <strong>COMPRA NRO: </strong>{{$compra->nro}}
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

                            <td colspan="10" align="left" class="bold"></td>
                            <td></td>
                            <td colspan="3" align="center" class="bold"><strong>CAJAS</strong></td>
                            <td colspan="3" align="center" class="bold"><strong>UNIDADES</strong></td>
                            <td colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></td>


                        </tr>
                        <tr>

                            <td align="left" width="40" class="bold"><strong>FECHA</strong></td>
                            <td align="left" width="40" class="bold"><strong>PRODUCTO</strong></td>
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
                <tr class="border_top">
                    <td colspan="20" class="bold"><strong>{{$v['valor']}}</strong></td>

                </tr>
                @endif
                @if($v['tipo'] == 2)
                @php
                $tr = $v['valor'];
                $t_5 += $tr[5];
                $t_6 += $tr[6];
                $t_7 += $tr[7];
                $t_8 += $tr[8];

                $t_10 += $tr[10];

                $t_13 += $tr[13];



                @endphp
                <tr class="border_top">

                    <td width="40">{{$tr[0]}}</td>
                    <td width="30" align="left">{{$tr[1]}}</td>
                    <td width="30" align="left">{{$tr[2]}}</td>
                    <td width="30" align="left">{{$tr[3]}}</td>
                    <td width="30" align="left"></td>
                    <td width="30" align="left"></td>
                    <td width="70" align="left">{{$tr[4]}}</td>
                    <td width="30" align="left">{{$tr[5]}}</td>
                    <td width="30" align="left">{{$tr[6]}}</td>
                    <td width="30" align="left">{{$tr[7]}}</td>
                    <td width="30" align="left">{{$tr[8]}}</td>
                    <td width="30" align="left">{{$tr[9]}}</td>
                    <td width="30" align="left">{{$tr[10]}}</td>
                    <td width="30" align="left">{{$tr[11]}}</td>
                    <td width="30" align="left">{{$tr[12]}}</td>
                    <td width="30" align="left">{{$tr[13]}}</td>
                    <td width="30" align="left">{{$tr[14]}}</td>
                    <td width="30" align="left">{{$tr[15]}}</td>
                    <td width="30" align="left">{{$tr[16]}}</td>
                    <td width="30" align="left">{{$tr[17]}}</td>


                </tr>
                @endif
                @if($v['tipo'] == 3)
                @php
                $tr = $v['valor'];
                $t_5 += $tr[5];
                $t_6 += $tr[6];
                $t_7 += $tr[7];
                $t_8 += $tr[8];

                $t_10 += $tr[10];


                $t_13 += $tr[13];
                        $t_9 += $tr[9];

                @endphp
                <tr class="border_top">

                    <td width="40">{{$tr[0]}}</td>
                    <td width="30" align="left">{{$tr[1]}}</td>
                    <td width="30" align="left">{{$tr[2]}}</td>
                    <td width="30" align="left">{{$tr[3]}}</td>
                    <td width="30" align="left"></td>
                    <td width="30" align="left"></td>
                    <td width="70" align="left">{{$tr[4]}}</td>
                    <td width="30" align="left">{{$tr[5]}}</td>
                    <td width="30" align="left">{{$tr[6]}}</td>
                    <td width="30" align="left">{{$tr[7]}}</td>
                    <td width="30" align="left">{{$tr[17]}}</td>
                    <td width="30" align="left">{{$tr[8]}}</td>
                    <td width="30" align="left">{{$tr[9]}}</td>
                    <td width="30" align="left">{{$tr[10]}}</td>
                    <td width="30" align="left">{{$tr[11]}}</td>
                    <td width="30" align="left">{{$tr[12]}}</td>
                    <td width="30" align="left">{{$tr[13]}}</td>
                    <td width="30" align="left">{{$tr[14]}}</td>
                    <td width="30" align="left">{{$tr[15]}}</td>
                    <td width="30" align="left">{{$tr[16]}}</td>



                </tr>


                @endif
                @if($v['tipo'] == 4)
                @php
                $tr = $v['valor'];
                if(count($tr) > 0){
                    $t_8 += $tr[8];

                    $t_10 += $tr[10];
                    $t_11 += $tr[11];
                    $t_12 += $tr[12];
                    $t_13 += $tr[13];


                }

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

                    <td  colspan="2" width="70">TOTALES****</td>
                    <td width="30" align="left"></td>
                    <td width="30"align="left"></td>
                    <td width="30"align="left"></td>
                    <td width="30"align="left"></td>
                    <td width="70"align="left"></td>


                    <td width="30"align="left">{{number_format($t_5,2)}}</td>
                    <td width="30"align="left">{{number_format($t_6,2)}}</td>
                    <td width="30"align="left">{{number_format($t_7,2)}}</td>
                    <td width="30"align="left">{{number_format(0,2)}}</td>
                    <td width="30"align="left">{{number_format($t_8,2)}}</td>
                    <td width="30"align="left">{{number_format($t_9,2)}}</td>
                    <td width="30"align="left">{{number_format($t_8-$t_9,2)}}</td>
                    <td width="30"align="left">{{number_format($t_11,2)}}</td>
                    <td width="30"align="left">{{number_format($t_12,2)}}</td>
                    <td width="30"align="left">{{number_format($t_11-$t_12,2)}}</td>
                    <td width="30"align="left">{{number_format($t_14,2)}}</td>
                    <td width="30"align="left">{{number_format($t_15,2)}}</td>
                    <td width="30"align="left">{{number_format($t_14-$t_15,2)}}</td>


                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <?php
    }
    ?>

</body>

</html>
