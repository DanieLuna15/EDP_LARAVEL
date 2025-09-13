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
                        SEGUIMIENTO - PP &nbsp; N° <?= $pp->nro ?>
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
    <?php
    $pollos_traspaso = 0;
    $pesoneto_traspaso = 0;
    foreach ($pp->PpTraspasoPps as $i) {
        $pollos_traspaso += $i->traspasoPP->pollos;
        $pesoneto_traspaso += $i->traspasoPP->peso_neto;
    }
    ?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="5" class="bold"><strong>TOTAL INICIAL</strong></th>
                    <th align="center" width="10%" class="bold"><strong>POLLOS</strong></th>
                    <th align="center" width="10%" class="bold"><strong>KN</strong></th>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold">
                        <strong>TRASPASOS</strong>
                    </th>
                    <td align="center" class="bold">{{ (int) $pollos_traspaso }}</td>
                    <td align="center" class="bold">{{ $pesoneto_traspaso }}</td>
                </tr>
                <?php
                $pollos_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('pollos');
                $pollos_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('pollos');
                $pesoneto_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('peso_neto');
                $pesoneto_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('peso_neto');
                ?>
                <tr>
                    <th align="right" colspan="5" class="bold">
                        <strong>PESO INICIAL 1</strong>
                    </th>
                    <td align="center" class="bold">{{ (int) $pollos_peso_inicial_1 }}</td>
                    <td align="center" class="bold">{{ $pesoneto_peso_inicial_1 }}</td>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold">
                        <strong>PESO INICIAL 2</strong>
                    </th>
                    <td align="center" class="bold">{{ (int) $pollos_peso_inicial_2 }}</td>
                    <td align="center" class="bold">{{ $pesoneto_peso_inicial_2 }}</td>
                </tr>
                <?php
                $pollos_totales = intval($pollos_traspaso + $pollos_peso_inicial_1 + $pollos_peso_inicial_2);
                $pesoneto_totales = $pesoneto_traspaso + $pesoneto_peso_inicial_1 + $pesoneto_peso_inicial_2;
                ?>
                <tr class="border_top">
                    <th align="right" colspan="5" class="bold">
                        <strong>TOTAL</strong>
                    </th>
                    <th align="center"><strong>{{ $pollos_totales }}</strong></th>
                    <th align="center"><strong>{{ $pesoneto_totales }}</strong></th>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
    $peso_menudencia_traspaso_1 = 0;
    $peso_menudencia_traspaso_2 = 0;
    ?>
    @foreach ($pp->SobraPps as $d)
        @foreach ($d->SobraDetallePps as $sd)
            <?php
            if ($d->nro_traspaso == 1) {
                $peso_menudencia_traspaso_1 += $sd->peso_neto;
            } else {
                $peso_menudencia_traspaso_2 += $sd->peso_neto;
            }
            
            ?>
        @endforeach
    @endforeach



    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="3" class="bold"><strong>VENTAS</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>GRUPO</strong></th>
                        <th align="left" class="bold"><strong>UNIT</strong></th>
                        <th align="left" class="bold"><strong>K/N</strong></th>
                    </tr>
                    <?php
                    $pollos = 0;
                    $peso_neto = 0;
                    ?>
                    @foreach ($pp->detalle_pp_venta_list as $i)
                        <tr class="border_top">
                            <td>{{ $i['cinta_cliente']['name'] }}</td>
                            <td>{{ intval($i['pollos']) }}</td>
                            <td>{{ $i['peso_neto'] }}</td>
                            <?php
                            $pollos += (int) $i['pollos'];
                            $peso_neto += $i['peso_neto'];
                            ?>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>TOTAL</strong></th>
                        <td align="left" class="bold"><strong>{{ $pollos }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $peso_neto }}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>TRASPASO Nro 1 (MENUDENCIAS)</strong></th>

                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong>{{ $peso_menudencia_traspaso_1 }}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>SOBRANTE POLLO</strong></td>
                        <td align="left" class="bold"><strong>{{ $pp->sobrante_units }}</strong></th>
                        <td align="left" class="bold"><strong>{{ $pp->sobrante_kn }}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>OBSERVACIONES</strong></td>
                        <td align="left" class="bold"><strong>0</strong></td>
                        <td align="left" class="bold"><strong>0</strong></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>TRASPASO Nro 2 (MENUDENCIAS)</strong></th>

                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong>{{ $peso_menudencia_traspaso_2 }}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold" colspan="3"></td>
                    </tr>
                    <?php
                    $pollos_x_unit = round($pollos + $pp->sobrante_units, 3);
                    $kn_x_unit = round($peso_neto + $pp->sobrante_kn + $peso_menudencia_traspaso_1 + $peso_menudencia_traspaso_2, 3);
                    ?>

                    <tr class="border_top">
                        <th align="left" class="bold"><strong>TOTALES</strong></th>
                        <th align="left" class="bold"><strong>{{ $pollos_x_unit }}</strong></th>
                        <th align="left" class="bold"><strong>{{ $kn_x_unit }}</strong></th>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="3" class="bold"><strong>INFORME FINAL</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong></strong></th>
                        <th align="left" class="bold"><strong>UNIT</strong></th>
                        <th align="left" class="bold"><strong>K/N</strong></th>
                    </tr>


                    <tr class="border_top">
                        <th align="left" class="bold">TOTALES INICIAL</th>
                        <td align="left" class="bold">{{ $pollos_totales }}</td>
                        <td align="left" class="bold">{{ $pesoneto_totales }}</td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold">TOTALES POS VENTA</th>
                        <td align="left" class="bold">{{ $pollos_x_unit }}</td>
                        <td align="left" class="bold">{{ $kn_x_unit }}</td>
                    </tr>
                    <tr class="border_top">
                        <td colspan="3"></td>
                    </tr>
                    <?php
                    $merma = $pesoneto_totales - $kn_x_unit;
                    ?>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>MERMA</strong></th>
                        <td align="right" class="bold" colspan="2"><strong>{{ $merma }}</strong></td>
                    </tr>

                    <tr class="border_top">
                        <td colspan="3"></td>
                    </tr>

                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PROMEDIO X POLLO</strong></th>
                        <td align="right" class="bold" colspan="2"><strong>{{ round((($merma==0?1:$merma)/($pollos_x_unit==0?1:$pollos_x_unit)), 3) }}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <td colspan="3"></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>MERMA POR POLLO</strong></th>
                        <th align="left" class="bold"><strong>UNIDAD DE POLLOS</strong></th>
                        <th align="left" class="bold"><strong>MERMA ACEPTABLE</strong></th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>
                                <?php

                                $merma_promedio = $promedioMerma;
                                ?>
                                {{ $merma_promedio }}
                            </strong></td>
                        <td align="left" class="bold"><strong>
                                {{ $pollos_totales }}
                            </strong></td>
                        <td align="left" class="bold"><strong>
                            <?php
                            $merma_pollos_promedio = round($pollos_totales * $merma_promedio, 3);
                            ?>
                            {{ $merma_pollos_promedio }}
                            </strong>
                        </td>

                    </tr>

                    <tr class="border_top">
                        <td colspan="3"></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>MERMA DEL DIA</strong></th>
                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>{{ $merma }}</strong></th>
                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                    </tr>

                    <tr class="border_top">
                        <td colspan="3"></td>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>SALDO A FAVOR</strong></th>
                        <td align="left" class="bold"><strong></strong></td>
                        <th align="left" class="bold"><strong>SALDO FALTANTE</strong></th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>{{ $merma - $merma_pollos_promedio }}</strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>




    </div>



    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
