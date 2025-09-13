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
                        DESCOMPOSICIÓN DE PT &nbsp; N° <?= $pt->nro ?>
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
                    <th align="center" colspan="6" class="bold section-title"><strong>BITACORA DE
                            DESCOMPOSICIONES</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>POLLOS</strong></th>
                    <th align="left" class="bold"><strong>KG/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/N</strong></th>
                </tr>
                <?php
                        $cajas = 0;
                        $pollos = 0;
                        $peso_bruto = 0;
                        $peso_neto = 0;
                        $tara = 0;
                    foreach ($pt->DescomponerPts as $de) {
                        $cajas += $de->cajas;
                        $pollos += $de->pollos;
                        $peso_bruto += $de->peso_bruto;
                        $peso_neto += $de->peso_neto;
                        $tara += $de->peso_bruto-$de->peso_neto;
                    ?>
                <tr class="border_top">
                    <td align="left" class="bold">{{ $de->fecha }}</td>
                    <td align="left" class="bold">{{ $de->cajas }}</td>
                    <td align="left" class="bold">{{ $de->pollos }}</td>
                    <td align="left" class="bold">{{ $de->peso_bruto }}</td>


                    <td align="left" class="bold">{{ $de->peso_bruto - $de->peso_neto }}</td>
                    <td align="left" class="bold">{{ $de->peso_neto }}</td>
                </tr>
                <?php
                    }





                    ?>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TOTALES DE DESCOMPOSICIONES EN PT</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($cajas, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($pollos, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_bruto, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($tara, 2) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_neto, 2) }}</strong></th>
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
