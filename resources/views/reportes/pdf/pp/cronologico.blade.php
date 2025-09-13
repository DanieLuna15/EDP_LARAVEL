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
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
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
                    <img src="<?= $sucursal->image->path_url ?>" alt="Sucursal Logo" style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        CRONOLÓGICO GRUPOS - PP &nbsp; N° <?= $pp->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <span style="font-size:14px">
                            <?= $pp->mes ?>
                        </span>
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
        $pollos = 0;
        $kg = 0;
    @endphp
    @foreach ($pp->detalle_pp_venta_list as $grupo)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>


                    <tr>
                        <th align="center" colspan="9" class="bold"><strong>TRASPASOS</strong></th>
                    </tr>
                    <tr>
                        <th><strong>PP N°</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    @foreach ($grupo['traspasos'] as $traspaso)
                        <tr class="border_top">

                            <td align="left" class="bold">
                                {{ $traspaso->TraspasoPP->Pp->nro }}
                            </td>
                            <td align="left" class="bold">{{ $traspaso->TraspasoPP->cajas }}</td>
                            <td align="left" class="bold">{{ $traspaso->TraspasoPP->pollos }}</td>

                            <td colspan="2" align="left" class="bold">{{ $traspaso->TraspasoPP->peso_bruto }}
                            </td>
                            <td colspan="2" align="left" class="bold">
                                {{ floatval($traspaso->TraspasoPP->peso_bruto - $traspaso->TraspasoPP->peso_neto) }}
                            </td>
                            <td colspan="2" align="left" class="bold">{{ $traspaso->TraspasoPP->peso_neto }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="center" colspan="9" class="bold"><strong>TOTAL VENTAS</strong></th>
                    </tr>
                    <tr>

                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    <tr class="border_top">


                        <td>
                            {{ $grupo['detalle']->sum('cajas') }}
                        </td>
                        <td colspan="2">
                            {{ $grupo['detalle']->sum('pollos') }}
                        </td>
                        <td colspan="2">
                            {{ $grupo['detalle']->sum('peso_bruto') }}
                        </td>
                        <td colspan="2">
                            {{ floatval($grupo['detalle']->sum('peso_bruto') - $grupo['detalle']->sum('peso_neto')) }}
                        </td>
                        <td colspan="2">
                            {{ $grupo['detalle']->sum('peso_neto') }}
                        </td>
                    </tr>
                    <tr class="border_top">
                        <th align="center" colspan="9" class="bold">
                            <strong>{{ $grupo['cinta_cliente']->name }}</strong>
                        </th>
                    </tr>
                    <tr class="border_top">

                        <th align="left" class="bold"><strong>N° VENTA </strong></th>
                        <th align="left" class="bold"><strong>FECHA HORA</strong></th>
                        <th align="left" class="bold"><strong>CLIENTE</strong></th>
                        <th align="left" class="bold"><strong>GRUPO</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>KG/B</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>




                    </tr>

                    @foreach ($grupo['detalle'] as $detalle)
                        <tr class="border_top">

                            <td>{{ $detalle['venta_id'] }}</td>
                            <td>{{ $detalle['fecha'] }} {{ $detalle['hora'] }}</td>
                            <td>{{ $detalle['cliente']['nombre'] }}</td>
                            <td>{{ $grupo['cinta_cliente']->name }}</td>
                            <td>{{ $detalle['cajas'] }}</td>
                            <td>{{ $detalle['pollos'] }}</td>
                            <td>{{ $detalle['peso_bruto'] }}</td>
                            <td>{{ floatval($detalle['peso_bruto'] - $detalle['peso_neto']) }}</td>
                            <td>{{ $detalle['peso_neto'] }}</td>

                        </tr>
                    @endforeach

                    <tr class="border_top">

                        <th align="center" colspan="4">
                            <strong>TOTALES</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->sum('cajas') }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->sum('pollos') }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->sum('peso_bruto') }}</strong>
                        </th>
                        <th>
                            <strong>{{ floatval($grupo['detalle']->sum('peso_bruto') - $grupo['detalle']->sum('peso_neto')) }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->sum('peso_neto') }}</strong>
                        </th>


                    </tr>
                    @php
                        $pollos += $grupo['detalle']->sum('pollos');
                        $kg += $grupo['detalle']->sum('peso_bruto');
                    @endphp
                    <tr class="border_top">
                        <th align="center" colspan="9" class="bold"><strong>SOBRAS</strong></th>
                    </tr>
                    <tr>

                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    @php
                        $s_pollos = 0;
                        $s_cajas = 0;
                        $s_peso_bruto = 0;
                        $s_peso_neto = 0;
                        $s_tara = 0;
                    @endphp
                    @foreach ($grupo['sobras'] as $traspaso)
                        @php
                            $s_cajas += $traspaso->cajas;
                            $s_pollos += $traspaso->pollos;
                            $s_peso_bruto += $traspaso->peso_bruto;
                            $s_peso_neto += $traspaso->peso_neto;
                            $s_tara += $traspaso->peso_bruto - $traspaso->peso_neto;
                        @endphp
                        <tr class="border_top">


                            <td align="left" class="bold">{{ $traspaso->cajas }}</td>
                            <td colspan="2" align="left" class="bold">{{ $traspaso->pollos }}</td>

                            <td colspan="2" align="left" class="bold">{{ $traspaso->peso_bruto }}</td>
                            <td colspan="2" align="left" class="bold">
                                {{ floatval($traspaso->peso_bruto - $traspaso->peso_neto) }}</td>
                            <td colspan="2" align="left" class="bold">{{ $traspaso->peso_neto }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="center" colspan="9" class="bold"><strong>TOTAL PRODUCCION +
                                SOBRAS</strong></th>
                    </tr>
                    <tr>

                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    <tr class="border_top">


                        <td>
                            <strong>{{ $grupo['detalle']->sum('cajas') + $s_cajas }}</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{ $grupo['detalle']->sum('pollos') + $s_pollos }}</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{ $grupo['detalle']->sum('peso_bruto') + $s_peso_bruto }}</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{ floatval($grupo['detalle']->sum('peso_bruto') - $grupo['detalle']->sum('peso_neto') + $s_tara) }}</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{ $grupo['detalle']->sum('peso_neto') + $s_peso_neto }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
    <?php
    $cajas_traspaso_general = 0;
    $peso_bruto_traspaso_general = 0;
    $tara_traspaso_general = 0;
    $peso_neto_traspaso_general = 0;
    ?>
    @foreach ($pp->SobraPps as $d)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="6">TRASPASO Nro {{ $d->nro_traspaso }} (MENUDENCIAS)</th>
                    </tr>
                    <tr class="border_top">
                        <th>ITEM</th>
                        <th>CJ</th>
                        <th>KG/B</th>
                        <th>TARA</th>
                        <th>KG/N</th>
                        <th>TRASPASO</th>
                    </tr>
                    <?php
                    $cajas_traspaso = 0;
                    $peso_bruto_traspaso = 0;
                    $tara_traspaso = 0;
                    $peso_neto_traspaso = 0;
                    ?>
                    @foreach ($d->SobraDetallePps as $sd)
                        <?php
                        $cajas_traspaso += $sd->cajas;
                        $peso_bruto_traspaso += $sd->peso_bruto;
                        $tara_traspaso += $sd->taras;
                        $peso_neto_traspaso += $sd->peso_neto;
                        
                        $cajas_traspaso_general += $sd->cajas;
                        $peso_bruto_traspaso_general += $sd->peso_bruto;
                        $tara_traspaso_general += $sd->taras;
                        $peso_neto_traspaso_general += $sd->peso_neto;
                        ?>
                        <tr class="border_top">
                            <td>{{ $sd->Item->name }}</td>
                            <td>{{ $sd->cajas }}</td>
                            <td>{{ $sd->peso_bruto }}</td>
                            <td>{{ $sd->taras }}</td>
                            <td>{{ $sd->peso_neto }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <td>
                            <strong>
                                TOTALES
                            </strong>
                        </td>
                        <td><strong>{{ $cajas_traspaso }}</strong></td>
                        <td><strong>{{ $peso_bruto_traspaso }}</strong></td>
                        <td><strong>{{ $tara_traspaso }}</strong></td>
                        <td><strong>{{ $peso_neto_traspaso }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" width="50%" class="bold" rowspan="2"><strong>TOTALES</strong>
                    </th>
                    <th align="center" class="bold"><strong>TOTAL POLLOS</strong></th>
                    <td align="center" class="bold"><strong>{{ $pollos }}</strong></td>

                </tr>
                <tr>
                    <th align="center" class="bold"><strong>TOTAL KG</strong></th>
                    <td align="center" class="bold"><strong>{{ $kg }}</strong></td>

                </tr>


            </tbody>
        </table>
    </div>



    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
