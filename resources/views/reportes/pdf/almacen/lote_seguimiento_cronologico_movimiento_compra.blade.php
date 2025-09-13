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

    <div class="header">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    {{-- LOGO --}}
                    <td width="5%" height="0" align="center">
                        @if (isset($sucursal->image->path_url))
                            <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif
                    </td>
                    {{-- FIN LOGO --}}

                    <td width="95%" height="0" align="center">
                        <div>
                            <table width="100%" height="0" border="0" cellpadding="9" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <strong><span style="font-size:18px">SEGUIMIENTO DE VENTAS EN LOTE:
                                                    {{ $compra->nro }}</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left"><strong>FECHA DE LA COMPRA: </strong>{{ $compra->fecha }}
                                        </td>
                                        <td align="left"><strong>COMPRA NRO: </strong>{{ $compra->nro }} -
                                            {{ $compra->nro_compra }}</td>
                                      
                                    </tr>
                                    <tr>
                                        <td align="left"><strong>FECHA DE LA LLEGADA:
                                            </strong>{{ $compra->fecha_llegada }}</td>
                                        <td align="left"><strong>PROVEEDOR:
                                            </strong>{{ $compra->ProveedorCompra->abreviatura }}</td>
                                        <td align="left"><strong>FECHA DE EMISION: </strong>{{ date('Y-m-d') }}</td>
                                        <td align="left"><strong>CERRADO: </strong>SI</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

    <br>

    @php
        $registro = 0;
        $registros = [];
    @endphp

    <?php
    // Construcción del arreglo solo con lista_registros (sin lote_detalles)
    foreach ($lote->detalles as $detalle) {
        $registro += 1;
    
        // Variables por detalle (si quieres usar)
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
            'tipo' => 1,
            'valor' => $detalle['producto'],
        ];
    
        $peso_total2 = 0;
        $peso_cajas2 = 0;
        $peso_neto2 = 0;
        $cajas_acumulados = 0;
        $pollos_acumulados = 0;
    
        foreach ($detalle['lista_registros'] as $ld) {
            $registro += 1;
            $peso_total = $ld->peso_total;
            $peso_cajas = $ld->cajas * 2;
            $peso_neto = $peso_total - $peso_cajas;
            $peso_total2 += $peso_total;
            $peso_cajas2 += $peso_cajas;
            $peso_neto2 += $ld->kg_s;
            $cajas_acumulados += $ld->cajas_s;
            $pollos_acumulados += $ld->und_s;
    
            $registros[] = [
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
                    11 => $cajas_acumulados,
                    12 => $ld->und_e,
                    13 => $ld->und_s,
                    14 => $pollos_acumulados,
                    15 => number_format($ld->kg_e, 3),
                    16 => number_format($ld->kg_s, 3),
                    17 => number_format($peso_neto2, 3),
                    18 => $ld->id_nro,
                    19 => $ld->producto,
                    20 => $ld->user_id,
                    21 => $ld->anulado,
                ],
            ];
        }
    }
    
    // Agrupar por id_nro para tablas independientes por venta
    // Agrupar por id_nro para tablas independientes por venta
    $ventasPorIdNro = [];
    $productoActual = null;
    
    foreach ($registros as $reg) {
        if ($reg['tipo'] == 1) {
            $productoActual = $reg['valor'];
        }
        if ($reg['tipo'] == 2) {
            $id_nro = $reg['valor'][18];
    
            if (!isset($ventasPorIdNro[$id_nro])) {
                // Extraemos el nombre del cliente desde el campo detalle del registro
                // Por ejemplo, si $reg['valor'][4] es "1 Cliente numero 1", podemos intentar extraerlo
    
                $detalle = $reg['valor'][4]; // "1 Cliente numero 1" o "ANULADO 1 Cliente numero 1"
                // Limpiamos si tiene "ANULADO " delante
                $detalleLimpio = preg_replace('/^ANULADO\s*/', '', $detalle);
    
                // Extraemos el nombre del cliente después del número (simple split)
                // Suponiendo que el nombre empieza después del primer espacio
                $partes = explode(' ', $detalleLimpio, 2);
                $nombreCliente = isset($partes[1]) ? $partes[1] : 'Cliente no disponible';
    
                $ventasPorIdNro[$id_nro] = [
                    'producto' => $productoActual,
                    'registros' => [],
                    'cliente' => $nombreCliente,
                ];
            }
            $ventasPorIdNro[$id_nro]['registros'][] = $reg;
        }
    }
    
    ?>

    @php $pagina_actual = 0; @endphp

    @foreach ($ventasPorIdNro as $id_nro => $venta)
        @php
            $pagina_actual++;
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
        @endphp

        <div class="header">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="95%" height="0" align="center">
                            <div>
                                <table width="100%" border="0" align="center" cellpadding="0"
                                    cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td width="50%" height="0" align="left">
                                                <strong><span style="font-size:13px">MOVIMIENTO: NDD
                                                        {{ $id_nro }}</span></strong>
                                            </td>
                                            <td width="50%" height="0" align="right">
                                                <strong><span style="font-size:13px">CLIENTE:
                                                        {{ $venta['cliente'] }}</span></strong>
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
                            <td align="left" width="30" class="bold"></td>
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
                @php
                    // Variables totales por página/venta
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
                @endphp

                @foreach ($venta['registros'] as $v)
                    @if ($v['tipo'] == 1)
                        {{-- Fila de producto / categoría --}}
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="20">{{ $v['valor'] }}</td>
                        </tr>
                    @elseif ($v['tipo'] == 2)
                        @php $tr = $v['valor']; @endphp
                        <tr>
                            <td width="40">{{ $tr[0] }}</td>
                            <td width="30" align="left">{{ $tr[19] }}</td>
                            <td width="30" align="left">{{ $tr[1] }}</td>
                            <td width="30" align="left">{{ $tr[2] }}</td>
                            <td width="30" align="left">{{ $tr[3] }}</td>
                            <td width="30" align="left">{{ $tr[18] }}</td>
                            <td width="70" align="left"
                                @if ($tr[21] == 1) style="color:red" @endif>{{ $tr[4] }}</td>
                            <td width="30" align="left">{{ $tr[5] }}</td>
                            <td width="30" align="left">{{ $tr[6] }}</td>
                            <td width="30" align="left">{{ $tr[7] }}</td>
                            <td width="30" align="left">{{ $tr[8] }}</td>
                            <td width="30" align="left">{{ $tr[9] }}</td>
                            <td width="30" align="left">{{ $tr[10] }}</td>
                            <td width="30" align="left">{{ $tr[12] }}</td>
                            <td width="30" align="left">{{ $tr[13] }}</td>
                            <td width="30" align="left">{{ $tr[14] }}</td>
                            <td width="30" align="left">{{ $tr[15] }}</td>
                            <td width="30" align="left">{{ $tr[16] }}</td>
                            <td width="30" align="left">{{ $tr[17] }}</td>
                        </tr>

                        @php
                            // Acumular totales solo de registros tipo 2
                            $t_5 += floatval($tr[5]);
                            $t_6 += floatval($tr[6]);
                            $t_7 += floatval($tr[7]);
                            $t_8 += floatval($tr[8]);
                            $t_9 += floatval($tr[9]);
                            $t_10 += floatval($tr[10]);
                            $t_11 += floatval($tr[10]);
                            $t_12 += floatval($tr[12]);
                            $t_13 += floatval($tr[13]);
                            $t_14 += floatval($tr[14]);
                            $t_15 += floatval($tr[15]);
                            $t_16 += floatval($tr[16]);
                            $t_17 += floatval($tr[17]);
                        @endphp
                    @endif
                @endforeach
            </table>
        </div>

        <div class="footer">
            <br>
            <div class="tabla_borde foot">
                <table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="40">TOTALES****</td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="30"></td>
                            <td width="70"></td>
                            <td width="70"></td>
                            <td width="30">{{ number_format($t_5, 3) }}</td>
                            <td width="30">{{ number_format($t_6, 3) }}</td>
                            <td width="30">{{ $t_7 }}</td>
                            <td width="30">{{ number_format($t_8, 3) }}</td>
                            <td width="30">{{ number_format($t_9, 3) }}</td>
                            <td width="30">{{ $t_10 }}</td>
                            <td width="30">{{ number_format($t_11, 3) }}</td>
                            <td width="30">{{ $t_12 }}</td>
                            <td width="30">{{ $t_13 }}</td>
                            <td width="30">{{ $t_14 }}</td>
                            <td width="30">{{ number_format($t_15, 3) }}</td>
                            <td width="30">{{ $t_16 }}</td>
                            <td width="30">{{ number_format($t_17, 3) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
