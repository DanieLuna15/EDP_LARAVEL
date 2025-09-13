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
                        VENTAS - PP &nbsp; N° <?= $pp->nro ?>
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
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="10" class="bold"><strong>VENTAS</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>NDD</strong></th>
                    <th align="left" class="bold"><strong>GRUPO</strong></th>
                    <th align="left" class="bold"><strong>CLIENTE</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>FECHA-HORA</strong></th>

                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNIT</strong></th>
                    <th align="left" class="bold"><strong>K/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>K/N</strong></th>
                </tr>
                <?php
                $pollos = 0;
                $peso_neto = 0;
                $peso_bruto = 0;
                $taras = 0;
                $cajas = 0;
                ?>
                @foreach ($pp->detalle_pp_venta_list as $i)
                   @foreach ($i['detalle'] as $detalle)
                        <tr class="border_top">
                            <td>{{ $detalle['venta_id'] }}</td>
                            <td>{{ $i['cinta_cliente']->name }}</td>
                            <td>{{ $detalle['cliente']['nombre'] }}
                                @if ($detalle['estado'] == 0)
                                    <span style="color:red">ANULADO</span>
                                @endif
                            </td>
                            <td>{{ $detalle['venta']['user']['nombre'] }} {{ $detalle['venta']['user']['apellidos'] }}</td>
                            <td>{{ $detalle['fecha'] }} {{ $detalle['hora'] }}</td>
                            <td>{{ $detalle['estado'] == 1 ? floatval($detalle['cajas']) : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['pollos'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['peso_bruto'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? floatval($detalle['peso_bruto'] - $detalle['peso_neto']) : 0 }}
                            </td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['peso_neto'] : 0 }}</td>
                        </tr>
                         <?php
                            if ($detalle['estado'] == 1) {
                                $cajas += floatval($detalle['cajas']);
                                $pollos += $detalle['pollos'];
                                $peso_bruto += $detalle['peso_bruto'];
                                $taras += $detalle['peso_bruto'] - $detalle['peso_neto'];
                                $peso_neto += $detalle['peso_neto'];
                            }
                        ?>
                    @endforeach
                @endforeach
                <tr class="border_top">
                    <th align="left" class="bold" colspan="5"><strong>TOTAL</strong></th>
                    <th align="left" class="bold"><strong>{{ $cajas }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $pollos }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_bruto, 3) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ sprintf('%0.3f', $taras) }}</strong></th>
                    <th align="left" class="bold"><strong>{{ number_format($peso_neto, 3) }}</strong></th>
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
