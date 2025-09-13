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
            padding: 180px 20px 50px 20px;
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
            padding: 0px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;

        }

        /* Estilos para el pie de página */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            padding: 15px 20px;
        }

        .body {

            position: relative;
        }
        .foot tr{
            background-color: #888ea8;
        }
    </style>
</head>

<body class="white-bg">
    @php
    $registro = 0;
    $registros = [];
    @endphp
    <div class="header">
        <table width="100%"  border="0" aling="center" cellpadding="0" cellspacing="0">
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
                                                    SEGUIMIENTO DE COMPRAS - POR PRODUCTO
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
                                            <strong>PAGINA NRO: </strong>{{$registro}}
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


            <table width="100%"  border="0" aling="center" cellpadding="0" cellspacing="0">
                <tbody>

                    <tr>
                        <td></td>
                        <td colspan="9" align="left" class="bold"></td>
                        <td colspan="3"  align="center" class="bold"><strong>CAJAS</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>UNIDADES</strong></td>
                        <td colspan="3" align="center" class="bold"><strong>KILOGRAMOS</strong></td>


                    </tr>
                    <tr>
                    <td>N</td>
                        <td align="left" width="40" class="bold"><strong>FECHA</strong></td>
                        <td align="left" width="30" class="bold"><strong>TIPO</strong></td>
                        <td align="left" width="30" class="bold"><strong>PIGM.</strong></td>
                        <td align="left" width="30" class="bold"><strong>NRO</strong></td>
                        <td align="left" width="70" class="bold"><strong>CLIENTE</strong></td>
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

    <div class="footer">
        <div class="tabla_borde foot ">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>


                    <tr>

                        <td align="left" class="bold"><strong>FECHA</strong></td>
                        <td align="left" class="bold"><strong>TIPO</strong></td>
                        <td align="left" class="bold"><strong>PIGM.</strong></td>
                        <td align="left" class="bold"><strong>NRO</strong></td>
                        <td align="left" class="bold"><strong>CLIENTE</strong></td>
                        <td align="left" class="bold"><strong>P. BRUTO</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>P. NETO</strong></td>
                        <td align="left" class="bold"><strong>NETO_MERMA</strong></td>
                        <td align="left" class="bold"><strong>E</strong></td>
                        <td align="left" class="bold"><strong>S</strong></td>
                        <td align="left" class="bold"><strong>SA</strong></td>
                        <td align="left" class="bold"><strong>E</strong></td>
                        <td align="left" class="bold"><strong>S</strong></td>
                        <td align="left" class="bold"><strong>SA</strong></td>
                        <td align="left" class="bold"><strong>E</strong></td>
                        <td align="left" class="bold"><strong>S</strong></td>
                        <td align="left" class="bold"><strong>SA</strong></td>

                    </tr>
                </tbody>

            </table>
        </div>
    </div>




    </div>




    <div class="tabla_borde body">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <?php

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
                    $registros[]=[
                        "tipo"=>1,
                        "valor"=>$detalle['producto']
                        ];
                ?>
                    <tr class="border_top">
                    <td>{{$registro}} </td>
                        <td colspan="18" class="bold"><strong>{{$detalle['producto']}}</strong></td>

                    </tr>
                    <?php
                    $peso_total2 = 0;
                    $peso_cajas2 = 0;
                    $peso_neto2 = 0;
                    foreach ($detalle['lote_detalles'] as $ld) {
                        $registro += 1;
                        $peso_total = $ld->peso_total;
                        $peso_cajas = $ld->cajas * 2;
                        $peso_neto = $peso_total - $peso_cajas;
                        $peso_total2 += $peso_total;
                        $peso_cajas2 += $peso_cajas;
                        $peso_neto2 += $peso_neto;
                        $registros[]=[
                            "tipo"=>2,
                            "valor"=>[
                                0=>$ld->fecha,
                                1=>$ld->tipo,
                                2=>$ld->pigmento==1?'SI':'NO',
                                3=>$ld->nro,
                                4=>"$ld->detalle | $compra->nro_compra",
                                5=>number_format($peso_total,2),
                                6=>number_format($peso_cajas,2),
                                7=>number_format($peso_neto,2),
                                8 =>number_format(0,2),
                                9=>$ld->cajas,
                                10=>0,
                                11=>$ld->cajas,
                                12=>$ld->equivalente,
                                13=>0,
                                14=>$ld->equivalente,
                                15=>$peso_neto,
                                16=>0,
                                17=>$peso_neto
                                ]

                            ];
                    ?>
                        <tr class="border_top">
                        <td>{{$registro}} </td>
                            <td width="40">{{$ld->fecha}}</td>
                            <td width="30" align="left">{{$ld->tipo}}</td>
                            <td width="30"align="left">{{$ld->pigmento==1?'SI':'NO'}}</td>
                            <td width="30"align="left">{{$ld->nro}}</td>
                            <td width="70"align="left">{{$ld->detalle}}</td>
                            <td width="30">{{number_format($peso_total,2)}}</td>
                            <td width="30">{{number_format($peso_cajas,2)}}</td>
                            <td width="30">{{number_format($peso_neto,2)}}</td>

                            <td width="30">{{number_format(0,2)}}</td>
                            <td width="30">{{number_format($ld->cajas,2)}}</td>
                            <td width="30">{{number_format(0,2)}}</td>
                            <td width="30">{{number_format($ld->cajas,2)}}</td>
                            <td width="30">{{number_format($ld->equivalente,2)}}</td>

                            <td width="30">{{number_format(0,2)}}</td>
                            <td width="30">{{number_format($ld->equivalente,2)}}</td>
                            <td width="30">{{number_format($peso_neto,2)}}</td>


                            <td width="30">{{number_format(0,2)}}</td>
                            <td width="30">{{number_format($peso_neto,2)}}</td>


                        </tr>
                        @foreach($ld->LoteDetalleProductos as $ldp)
                        @php
                        $registro += 1;
                        $registros[]=[
                            "tipo"=>3,
                            "valor"=>[
                                0=>$ldp->fecha,
                                1=>$ldp->tipo,
                                2=>$ldp->pigmento==1?'SI':'NO',
                                3=>$ldp->nro,
                                4=>($ldp->anulado==1?"ANULADO":"")."$ldp->detalle | $compra->nro_compra",
                                5=>0,
                                6=>0,
                                7=>0,
                                8=>0,
                                9=>$ldp->cajas_e,
                                10=>$ldp->cajas_s,
                                11=>$ldp->cajas_sa,
                                12=>$ldp->und_e,
                                13=>$ldp->und_s,
                                14=>$ldp->und_sa,
                                15=>$ldp->kg_e,
                                16=>$ldp->kg_s,
                                17=>$ldp->kg_sa,
                                ]

                            ];
                        @endphp
                        <tr class="border_top">
                        <td>{{$registro }}</td>
                            <td>{{$ldp->fecha}}</td>
                            <td>{{$ldp->tipo}}</td>
                            <td>{{$ldp->pigmento==1?'SI':'NO'}}</td>
                            <td>{{$ldp->nro}}</td>
                            <td>{{$ldp->detalle}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$ldp->mermatotal}}</td>
                            <td>{{$ldp->cajas_e}}</td>
                            <td>{{$ldp->cajas_s}}</td>
                            <td>{{$ldp->cajas_sa}}</td>
                            <td>{{$ldp->und_e}}</td>
                            <td>{{$ldp->und_s}}</td>
                            <td>{{$ldp->und_sa}}</td>
                            <td>{{$ldp->kg_e}}</td>
                            <td>{{$ldp->kg_s}}</td>
                            <td>{{$ldp->kg_sa}}</td>

                        </tr>
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
                        $total_cajas_e = $ltp->sum('cajas_e');
                        $total_cajas_e_detalle += $ltp->sum('cajas_e');
                        $total_cajas_s = $ltp->sum('cajas_s');
                        $total_cajas_s_detalle += $ltp->sum('cajas_s');
                        $total_cajas_sa = $ltp->sum('cajas_sa');
                        $total_cajas_sa_detalle += $ltp->sum('cajas_sa');
                        $total_und_e = $ltp->sum('und_e');
                        $total_und_e_detalle += $ltp->sum('und_e');
                        $total_und_s = $ltp->sum('und_s');
                        $total_und_s_detalle += $ltp->sum('und_s');
                        $total_und_sa = $ltp->sum('und_sa');
                        $total_und_sa_detalle += $ltp->sum('und_sa');
                        $total_kg_e = $ltp->sum('kg_e');
                        $total_kg_e_detalle += $ltp->sum('kg_e');
                        $total_kg_s = $ltp->sum('kg_s');
                        $total_kg_s_detalle += $ltp->sum('kg_s');
                        $total_kg_sa = $ltp->sum('kg_sa');
                        $total_kg_sa_detalle += $ltp->sum('kg_sa');
                        $registros[]=[
                            "tipo"=>4,
                            "valor"=>[
                                0=>"*** SUBTOTAL {{$detalle['producto']}} - {{($ld->pigmento==1)?'CON':'SIN'}} PIGMENTO",
                                1=>0,
                                2=>0,
                                3=>0,
                                4=>0,
                                5=>0,
                                6=>0,
                                7=>0,
                                8=>0,
                                9=>$total_cajas_e,
                                10=>$total_cajas_s,
                                11=>$total_cajas_sa,
                                12=>$total_und_e,
                                13=>$total_und_s,
                                14=>$total_und_sa,
                                15=>$total_kg_e,
                                16=>$total_kg_s,
                                17=>$total_kg_sa,
                                ]

                            ];
                        @endphp
                        <tr class="border_top">
                        <td>{{$registro }}</td>
                            <td colspan="5" class="bold"><strong>*** SUBTOTAL {{$detalle['producto']}} - {{$ld->pigmento==1?'CON':'SIN'}} PIGMENTO</strong></td>

                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong></strong></td>

                            <td class="bold"><strong></strong></td>
                            <td class="bold"><strong>{{number_format($total_cajas_e,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_cajas_s,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_cajas_sa,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_und_e,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_und_s,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_und_sa,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_kg_e,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_kg_s,2)}}</strong></td>
                            <td class="bold"><strong>{{number_format($total_kg_sa,2)}}</strong></td>
                        </tr>
                    <?php
                    }
                    $registro += 1;
                    $registros[]=[
                        "tipo"=>5,
                        "valor"=>[
                            0=>"****SUBTOTAL {{$detalle['producto']}}****",
                            1=>0,
                            2=>0,
                            3=>0,
                            4=>0,
                            5=>$peso_total2,
                            6=>$peso_cajas2,
                            7=>$peso_neto2,
                            8=>0,
                            9=>$total_cajas_e_detalle,
                            10=>$total_cajas_s_detalle,
                            11=>$total_cajas_sa_detalle,
                            12=>$total_und_e_detalle,
                            13=>$total_und_s_detalle,
                            14=>$total_und_sa_detalle,
                            15=>$total_kg_e_detalle,
                            16=>$total_kg_s_detalle,
                            17=>$total_kg_sa_detalle,

                            ]

                        ];
                    ?>
                    <tr class="border_top">
                    <td>{{$registro}}</td>
                        <td colspan="5" class="bold"><strong> ****SUBTOTAL {{$detalle['producto']}}**** </strong></td>

                        <td class="bold"><strong>{{number_format($peso_total2,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($peso_cajas2,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($peso_neto2,2)}}</strong></td>


                        <td class="bold"><strong>{{number_format(0,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_cajas_e_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_cajas_s_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_cajas_sa_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_und_e_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_und_s_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_und_sa_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_kg_e_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_kg_s_detalle,2)}}</strong></td>
                        <td class="bold"><strong>{{number_format($total_kg_sa_detalle,2)}}</strong></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    {{var_dump($registros)}}
    </div>


    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
