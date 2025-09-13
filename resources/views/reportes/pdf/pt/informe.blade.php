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
                    <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                        style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        SEGUIMIENTO DE PT &nbsp; N° <?= $pt->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <span style="font-size:14px"><?= $pt->mes ?>
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
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CINTA</strong></th>
                    <th align="left" class="bold"><strong>K/B</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNI</strong></th>
                    <th align="left" class="bold"><strong>LOTE</strong></th>
                    <th align="left" class="bold"><strong>KN</strong></th>
                    <th align="left" class="bold"><strong>PROM</strong></th>
                </tr>
                <?php
                    $cajas = 0;
                    $pollos = 0;
                    $peso_bruto = 0;
                    $peso_neto = 0;
                    $tara = 0;
                foreach ($pt->detalle_pts as $de) {
                    $cajas += $de->cajas;
                    $pollos += $de->pollos;
                    $peso_bruto += $de->peso_bruto;
                    $peso_neto += $de->peso_neto;
                    $tara += $de->peso_bruto-$de->peso_neto;
                ?>
                <tr class="border_top">
                    <td>{{ $de->created_at }}</td>
                    <td>{{ $de->LoteDetalle->name }}</td>
                    <td>{{ $de->peso_bruto }}</td>
                    <td>{{ $de->cajas }}</td>
                    <td>{{ $de->pollos }}</td>
                    <td>
                        {{ $de->LoteDetalle->Lote->Compra->ProveedorCompra->abreviatura }}-{{ $de->LoteDetalle->Lote->Compra->nro }}
                    </td>
                    <td>{{ $de->peso_neto }}</td>
                    <td>{{ number_format($de->peso_neto / $de->pollos, 3, '.', '') }}</td>
                </tr>
                <?php
               }
               $cajas = number_format($cajas, 2, '.', '');
                $pollos = number_format($pollos, 2, '.', '');
                $peso_bruto = number_format($peso_bruto, 2, '.', '');
                $peso_neto = number_format($peso_neto, 2, '.', '');
                $tara = number_format($tara, 2, '.', '');
               ?>
                <tr class="border_top">
                    <th colspan="2" class="bold">TOTALES</th>
                    <th align="left" class="bold">{{ $peso_bruto }}</th>
                    <th align="left" class="bold">{{ $cajas }}</th>
                    <th align="left" class="bold">{{ $pollos }}</th>
                    <th></th>
                    <th align="left" class="bold">{{ $peso_neto }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="7" class="bold section-title"><strong>TRANSFORMACIONES</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>Nro PT</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>KG/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/N</strong></th>
                    <th align="left" class="bold"><strong>RECEP</strong></th>
                </tr>
                <?php
                $cajas_tras = 0;
                $peso_bruto_tras = 0;
                $tara_tras = 0;
                $peso_neto_tras = 0;
            foreach ($pt->items as $de) {
            ?>
                <tr class="border_top">
                    <th align="left" class="bold section-title" colspan="7">
                        <strong>{{ $de['item']['name'] }}</strong>
                    </th>
                </tr>
                <?php
                foreach ($de['list'] as $i) {
                    $cajas_tras += $i->cajas;

                    $peso_bruto_tras += $i->peso_bruto;
                    $tara_tras += $i->taras;
                    $peso_neto_tras += $i->peso_neto;
                ?>
                <tr class="border_top">
                    <td align="left" class="bold">{{ $i->created_at }}</strong></td>
                    <td align="left" class="bold">{{ $pt->nro }}</strong></td>
                    <td align="left" class="bold">{{ $i->cajas }}</strong></td>
                    <td align="left" class="bold">{{ $i->peso_bruto }}</strong></td>
                    <td align="left" class="bold">{{ $i->taras }}</strong></td>
                    <td align="left" class="bold">{{ $i->peso_neto }}</strong></td>
                    <td align="left" class="bold">{{ $i->recep }}</strong></td>
                </tr>
                <?php
                }
                ?>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TOTAL DE {{ $de['item']['name'] }}</strong></th>
                    <th align="left" class="bold"><strong></strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($cajas_tras, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_bruto_tras, 2) }}</strong>
                    </th>
                    <th align="left" class="bold"><strong>{{ number_format($tara_tras, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_neto_tras, 2) }}</strong>
                    </th>
                    <th align="left" class="bold"><strong></strong></th>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="6" class="bold"><strong>INFORME FINAL</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong></strong></th>
                        <th align="left" class="bold"><strong>KG/BR</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNI</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>K/N</strong></th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold">PESO INICIAL</td>
                        <td align="left" class="bold">
                            {{ $peso_bruto }}
                        </td>
                        <td align="left" class="bold">
                            {{ $cajas }}
                        </td>
                        <td align="left" class="bold">
                            {{ $pollos }}
                        </td>
                        <td align="left" class="bold">
                            <?php
                            $tara = $cajas * 2;
                            ?>
                            {{ number_format($tara, 2) }}
                        </td>
                        <td align="left" class="bold">
                            <?php
                            $peso_neto_1 = $peso_bruto - $tara;
                            ?>
                            {{ $peso_bruto - $tara }}
                        </td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold">PESO INICIAL</td>
                        <td align="left" class="bold">
                            {{ $peso_bruto_tras }}
                        </td>
                        <td align="left" class="bold">
                            {{ $cajas_tras }}
                        </td>
                        <td align="left" class="bold">

                        </td>
                        <td align="left" class="bold">
                            <?php
                            $tara_tras = $cajas_tras * 2;
                            ?>
                            {{ number_format($tara_tras, 2) }}
                        </td>
                        <td align="left" class="bold">
                            <?php
                            $peso_neto_2 = $peso_neto_tras - $tara_tras;
                            ?>
                            {{ $peso_neto_tras - $tara_tras }}
                        </td>
                    </tr>
                    <tr class="border_top">
                        <td colspan="6"></td>
                    </tr>

                    <tr class="border_top">
                        <?php
                        $primera_merma = $peso_neto_1 - $peso_neto_2;
                        ?>
                        <td align="left" class="bold"><strong>1° MERMA</strong></td>
                        <td align="right" class="bold" colspan="5"><strong>
                                {{ $primera_merma }}
                            </strong></td>
                    </tr>
                    <tr class="border_top">
                        <td colspan="6"></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>PROMEDIO X POLLO</strong></td>
                        <td align="right" class="bold" colspan="5">
                            <strong>
                                {{ number_format($primera_merma / ($pollos == 0 ? 1 : $pollos), 2) }}
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="7" class="bold"><strong>REPORTE DE INGRESO DE LOTES</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>LOTE</strong></th>
                    <th align="left" class="bold"><strong>CINTA</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNIDADES</strong></th>
                    <th align="left" class="bold"><strong>KG/BT</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/NT</strong></th>
                </tr>
                @foreach ($pt->reporte_ingresos_lotes as $detalle)
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
                        <strong>{{ $pt->reporte_ingresos_lotes->sum('cajas') }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ $pt->reporte_ingresos_lotes->sum('pollos') }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pt->reporte_ingresos_lotes->sum('peso_bruto')) }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pt->reporte_ingresos_lotes->sum('tara')) }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pt->reporte_ingresos_lotes->sum('peso_neto')) }}</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
