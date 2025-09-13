<html>
<!-- VALIDACION LOTE -->

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
                        VALIDACIÓN LOTE - N° <?= $lote->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Compra - Nro compra - Nro Lote: </b> <?= $compra->id ?> - {{ $compra->nro_compra }} -
                        {{ $compra->nro }}
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Registro:</b> <?= $lote->fecha ?>
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
                    <?= $compra->sucursal->nombre ?>
                </th>
                <td style="width:34%; text-align:left;">
                    <strong>Dirección: </strong><?= $compra->sucursal->direccion ?>
                </td>
                <td style="width:33%; text-align:left;">
                    <strong>Telefono: </strong><?= $compra->sucursal->telefono ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <th style="width:33%; text-align:left; background:#f2f2f2;">
                    DATOS DEL RESPONSABLE
                </th>
                <td style="width:34%; text-align:left;">
                    <strong>Nombre:</strong> <?= $compra->user->nombre ?>
                    <?= $compra->user->apellidos ?>
                </td>
                <td style="width:33%; text-align:left;">
                    <strong>Usuario:</strong> <?= $compra->user->usuario ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
                $nro = 0;
                $filas = 0;
                foreach ($lote->LoteDetalles as $detalle) {
                    $nro++;
                    $filas++;
                ?>
    </div class="tabla_borde">




    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <tr>

                    <th colspan="6" align="left" class="bold"><strong>{{ $detalle->name }} -
                            PIGMENTO:{{ $detalle->pigmento == 1 ? 'SI' : 'NO' }}</strong></th>


                </tr>

                <tr class="border_top">

                    <th align="left" class="bold"><strong>N° Detalle</strong></th>

                    <th align="left" class="bold"><strong>PESO TOTAL</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>UND. CAJA</strong></th>
                    <th align="left" class="bold"><strong>TOTAL DE POLLOS</strong></th>
                    <th align="left" class="bold"><strong>PESO UNIT</strong></th>


                </tr>
                <tr class="border_top">
                    <td align="left">
                        {{ $nro }}
                    </td>

                    <td align="left">
                        {{ $detalle->peso_total }}

                    </td>
                    <td align="left">
                        {{ intval($detalle->cajas) }}
                    </td>
                    <td align="left">
                        {{ intval($detalle->pollos) }}

                    </td>
                    <td align="left">
                        {{ intval($detalle->equivalente) }}
                    </td>
                    <td align="left">
                        {{ number_format($detalle->peso_total / ($detalle->peso_total == 0 ? 1 : $detalle->peso_total), 3) }}
                    </td>


                </tr>
                <tr class="border_top">

                    <th colspan="6" align="center" class="bold"><strong>DETALLE DE MOVIMIENTOS POLLOS</strong>
                    </th>


                </tr>

                <tr class="border_top">

                    <th align="left" class="bold"><strong>N° Mov.</strong></th>

                    <th align="left" colspan="3" class="bold"><strong>DESCRIPCION</strong></th>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CANTIDAD</strong></th>



                </tr>
                <?php
                $nroM = 0;
                $filas = 0;
                $totalM = $detalle->LoteDetalleMovimientos()->where('estado',1)->sum('cantidad');
                foreach ($detalle->LoteDetalleMovimientos as $movimiento) {
                    $nroM++;
                    $filas++;
                ?>
                <tr class="border_top">

                    <td align="left" class="bold">{{ $nroM }}</td>

                    <td align="left" colspan="3" class="bold">{{ $movimiento->descripcion }}</td>
                    <td align="left" class="bold">{{ $movimiento->fecha }}</td>
                    <td align="left" class="bold">{{ $movimiento->cantidad }}</td>




                </tr>
                <?php
               }
               ?>
                <tr class="border_top">



                    <th align="left" colspan="4" class="bold"></th>
                    <th align="left" class="bold"><strong>POLLOS DISPONIBLES</strong></th>
                    <td align="left" class="bold">{{ $detalle->equivalente - $totalM }}</td>




                </tr>
            </tbody>
        </table>
    </div>

    </div>


    <?php
               }
                ?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <tr>

                    <th align="left" class="bold"><strong> TOTAL KG</strong></th>
                    <!-- <th align="left" class="bold"><strong>PRECIO POR KILO</strong> </th>
                    <th align="left" class="bold"><strong>VALOR VENTA</strong> </th> -->
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>POLLOS</strong></th>



                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">{{ $lote->valor_peso }}</td>
                    <!-- <td align="left" class="bold">{{ $lote->precio_venta }}</td>
                    <td align="left" class="bold">{{ $lote->valor_venta }}</td> -->
                    <td align="left" class="bold">{{ $lote->cajas }}</td>
                    <td align="left" class="bold">{{ $lote->pollos }}</td>



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
