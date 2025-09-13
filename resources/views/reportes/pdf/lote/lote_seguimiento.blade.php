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
                        SEGUIMIENTO DE
                        COMPRAS - POR PRODUCTO / NOTA N° <?= $lote->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Compra / Nro compra / Nro Lote:</b>
                        <span style="font-size:14px">
                            <?= $compra->id ?> / {{ $compra->nro_compra }} /
                            {{ $compra->nro }}
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
        </tbody>
    </table>






    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>


                <tr>

                    <th align="left" class="bold"><strong>C</strong></th>
                    <th align="left" class="bold"><strong>PRODUCTO</strong></th>
                    <th align="left" class="bold"><strong>PIGMENTO</strong></th>
                    <th align="left" class="bold"><strong>NRO</strong></th>
                    <th align="left" class="bold"><strong>DETALLE</strong></th>
                    <th align="left" class="bold"><strong>P. BRUTO</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>P. NETO</strong></th>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>CONT.S</strong></th>
                    <th align="left" class="bold"><strong>CONT.SA</strong></th>
                    <th align="left" class="bold"><strong>UNID.E</strong></th>
                    <th align="left" class="bold"><strong>UNID.S</strong></th>
                    <th align="left" class="bold"><strong>UNID.SA</strong></th>
                    <th align="left" class="bold"><strong>KGS.E</strong></th>
                    <th align="left" class="bold"><strong>KGS.S</strong></th>
                    <th align="left" class="bold"><strong>KGS.SA</strong></th>

                </tr>
                <?php
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
                foreach ($lote->LoteDetalles()->orderBy('name','asc')->get() as $detalle) {
                ?>
                <tr class="border_top">

                    <th colspan="18" align="left" class="bold"><strong>{{ $detalle->name }}</strong></th>


                </tr>
                <tr>

                    <th align="left" class="">{{ $detalle->id }}</th>
                    <td align="left" class="">{{ $detalle->name }}</td>
                    <td align="left" class="">{{ $detalle->pigmento == 1 ? 'SI' : 'NO' }}</td>
                    <td align="left" class="">COMPRA | {{ $compra->nro_compra }}</td>
                    <td align="left" class="">PRODUCCION</td>
                    <td align="left" class="">{{ number_format($detalle->peso_total, 3) }}</td>
                    <td align="left" class="">{{ number_format($detalle->cajas * 2, 3) }}</td>
                    <td align="left" class="">
                        {{ number_format($detalle->peso_total - $detalle->cajas * 2, 3) }}
                    </td>
                    <td align="left" class="">{{ $detalle->fecha }}</td>
                    <td align="left" class="">{{ number_format($detalle->cajas, 3) }}</td>
                    <td align="left" class="">{{ number_format($detalle->cajas, 3) }}</td>
                    <td align="left" class="">{{ number_format(0, 3) }}</td>
                    <td align="left" class="">{{ number_format($detalle->pollos, 3) }}</td>
                    <td align="left" class="">{{ number_format($detalle->pollos, 3) }}</td>
                    <td align="left" class="">{{ number_format(0, 3) }}</td>
                    <td align="left" class="">
                        {{ number_format($detalle->peso_total - $detalle->cajas * 2, 3) }}
                    </td>
                    <td align="left" class="">
                        {{ number_format($detalle->peso_total - $detalle->cajas * 2, 3) }}
                    </td>
                    <td align="left" class="">{{ number_format(0, 3) }}</td>

                </tr>
                <?php

                    foreach ($detalle->LoteDetalleSeguimientos as $s) {
                    ?>
                <tr>

                    <th align="left" class="">{{ $detalle->id }}</th>
                    <td align="left" class="">{{ $detalle->name }}</td>
                    <td align="left" class="">{{ $detalle->pigmento == 1 ? 'SI' : 'NO' }}</td>
                    <td align="left" class="">{{ $s->nro }}</td>
                    @if ($s->anulado == 1)
                        <td style="color:red" align="left">ANULADO {{ $s->cliente }}</td>
                    @else
                        <td align="left" class="">{{ $s->cliente }}</td>
                    @endif

                    <td align="left" class="">{{ $s->peso_bruto }}</td>
                    <td align="left" class="">{{ $s->tara }}</td>
                    <td align="left" class="">{{ $s->peso_neto }}</td>
                    <td align="left" class="">{{ $s->fecha }}</td>
                    <td align="left" class="">{{ $s->cont_e }}</td>
                    <td align="left" class="">{{ $s->cont_s }}</td>
                    <td align="left" class="">{{ $s->cont_sa }}</td>
                    <td align="left" class="">{{ $s->unit_e }}</td>
                    <td align="left" class="">{{ $s->unit_s }}</td>
                    <td align="left" class="">{{ $s->unit_sa }}</td>
                    <td align="left" class="">{{ $s->kgs_e }}</td>
                    <td align="left" class="">{{ $s->kgs_s }}</td>
                    <td align="left" class="">{{ $s->kgs_sa }}</td>

                </tr>
                <?php
                    }
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
                    $cont_sa_t += $detalle->cajas - $cont_s;
                    $unit_sa_t += $detalle->equivalente - $unit_s;
                    $kgs_sa_t += ($detalle->peso_total - $tara) - $kgs_s;

                    ?>


                <tr class="border_top">

                    <th colspan="5" class="bold"><strong>TOTALES</strong></th>

                    <th align="left" class="bold"><strong> {{ $detalle->peso_total }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($tara, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>
                            {{ number_format($detalle->peso_total - $tara, 3) }}</strong></th>
                    <th align="left" class="bold"><strong></strong></th>
                    <th align="left" class="bold"><strong>{{ $detalle->cajas }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $cont_s }}</strong></th>
                    <th align="left" class="bold">
                        <strong>{{ number_format($detalle->cajas - $cont_s, 3) }}</strong>
                    </th>
                    <th align="left" class="bold"><strong>{{ $detalle->equivalente }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $unit_s }}</strong></th>
                    <th align="left" class="bold">
                        <strong>{{ number_format($detalle->equivalente - $unit_s, 3) }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ number_format($detalle->peso_total - $tara, 3) }}</strong>
                    </th>
                    <th align="left" class="bold"><strong>{{ $kgs_s }}</strong></th>
                    <th align="left" class="bold">
                        <strong>{{ number_format($detalle->peso_total - $tara - $kgs_s, 3) }}</strong>
                    </th>

                </tr>
                <tr class="border_top">

                    <th colspan="5" class="bold"><strong>CALCULOS/SALDOS/MERMAS</strong></th>

                    <td align="left" colspan="12" class="bold"><strong></strong></td>
                    <th align="left" class="bold">
                        <strong>{{ number_format($detalle->peso_total - $tara - $kgs_s, 3) }}</strong>
                    </th>

                </tr>
                <?php
                }
                ?>
                <?php
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
                foreach ($lote->lote_detalles_cinta as $detalle) {
                ?>
                <tr class="border_top">

                    <th colspan="18" align="left" class="bold"><strong>{{ $detalle['name'] }}</strong></th>


                </tr>
                <tr>

                    <th align="left" class=""></th>
                    <td align="left" colspan="4" class="">{{ $detalle['name'] }}-GENERAL</td>

                    <td align="left" class="bold"><strong>{{ number_format($detalle['peso_total'], 3) }}</strong>
                    </td>
                    <td align="left" class="bold">
                        <strong>{{ number_format($detalle['taras_total'], 3) }}</strong>
                    </td>
                    <td align="left" class="bold"><strong>{{ number_format($detalle['peso_neto'], 3) }}</strong>
                    </td>
                    <td align="left" class=""></td>
                    <td align="left" class="bold"><strong>{{ number_format($detalle['cajas'], 3) }}</strong></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>
                    <td align="left" class=""></td>

                </tr>

                <?php
                }
                ?>

                <tr class="border_top">
                    <td colspan="18">

                    </td>
                </tr>
                <tr class="border_top">

                    <th colspan="5" class="bold"><strong>SUMATORIA DE TOTALES</strong></th>



                    <th align="left" class="bold"><strong>{{ number_format($p_bruto_total, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($tara_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($p_neto_total, 3) }}</strong></th>

                    <th align="left" class="bold"><strong></strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($cont_e_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($cont_s_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($cont_sa_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($unit_e_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($unit_s_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($unit_sa_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($kgs_e_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($kgs_s_t, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($kgs_sa_t, 3) }}</strong></th>



                </tr>

                <tr class="border_top">
                    <th colspan="5" class="bold"><strong>CALCULOS / SALDOS / MERMAS</strong></th>

                    <td align="left" colspan="12" class="bold"><strong></strong></td>
                    <th align="left" class="bold"><strong>{{ number_format($kgs_sa_t, 3) }}</strong></th>


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
