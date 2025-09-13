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
                        NOTA DE VENTA - N° <?= $venta->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>F/H de Venta:</b> <?= $venta->created_at ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>F/H de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
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
    <table width="100%" cellpadding="0" cellspacing="0" style="border:none; margin:0; padding:0;">
        <tr>
            <td style="width: 50%; vertical-align: top; padding:0 2px 0 0; border:none;">
                <div class="tabla_borde">
                    <table width="100%" cellpadding="6" cellspacing="0">
                        <tbody>
                            <tr>
                                <th style="width:33%; text-align:left; background:#f2f2f2;">
                                    <strong class="section-title">CLIENTE</strong>
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong><?= $venta->chofer->documento->name ?>:
                                    </strong><?= $venta->chofer->doc ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Nombre: </strong><?= $venta->chofer->nombre ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td style="width: 50%; vertical-align: top; padding:0 0 0 2px; border:none;">
                <div class="tabla_borde">
                    <table width="100%" cellpadding="6" cellspacing="0">
                        <tbody>
                            <tr>
                                <th style="width:33%; text-align:left; background:#f2f2f2;">
                                    <strong class="section-title">CLIENTE</strong>
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong><?= $venta->cliente->documento->name ?>:
                                    </strong><?= $venta->cliente->doc ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Nombre: </strong><?= $venta->chofer->nombre ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>


    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="6" class="bold section-title"><strong>PRODUCTO DE
                                LOTES</strong>
                        </th>
                    </tr>
                    <tr class="border_top">

                        <th align="left" class="bold"><strong>LOTE N°</strong></th>
                        <th align="left" class="bold"><strong>PRODUCTO</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>KG/B</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>



                    </tr>
                    <?php
                    $cajas_t = 0;
                    $pollos_t = 0;
                    $peso_bruto_t = 0;
                    $peso_neto_t = 0;
                    $tara_t = 0;
                    foreach ($venta->LoteDetalleVentas as $de) {
                        $cajas_t += $de->cajas;
                        $pollos_t += $de->pollos;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;
                    ?>
                    <tr class="border_top">

                        <td align="left" class="bold">{{ $de->LoteDetalle->Lote->Compra->nro }}</td>
                        <td align="left" class="bold">{{ $de->LoteDetalle->name }}</td>
                        <td align="left" class="bold">{{ $de->cajas }}</td>

                        <td align="left" class="bold">{{ $de->peso_bruto }}</td>
                        <td align="left" class="bold">{{ $de->peso_bruto - $de->peso_neto }}</td>
                        <td align="left" class="bold">{{ $de->peso_neto }}</td>




                    </tr>
                    <?php
                    }
                    ?>
                    <tr class="border_top">

                        <th align="left" colspan="2" class="bold"><strong>TOTALES VENDIDOS DE LOTES </strong>
                        </th>



                        <th align="left" class="bold"><strong>{{ number_format($cajas_t, 2) }}</strong></th>

                        <th align="left" class="bold"><strong>{{ number_format($peso_bruto_t, 2) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($tara_t, 2) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($peso_neto_t, 2) }}</strong></th>



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
                        <th align="center" colspan="6" class="bold section-title"><strong>ITEMS DE PT</strong>
                        </th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PT N°</strong></th>
                        <th align="left" class="bold"><strong>ITEM</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>KG/B</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    <?php
                    $cajas_t = 0;
                    $pollos_t = 0;
                    $peso_bruto_t = 0;
                    $peso_neto_t = 0;
                    $tara_t = 0;
                    foreach ($venta->VentaItemsPts as $de) {
                        $cajas_t += $de->cajas;
                        $pollos_t += $de->pollos;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;
                    ?>
                    <tr class="border_top">
                        <td align="left" class="bold">{{ $de->Pt->nro }}</td>
                        <td align="left" class="bold">{{ $de->Item->name }}</td>
                        <td align="left" class="bold">{{ $de->cajas }}</td>

                        <td align="left" class="bold">{{ $de->peso_bruto }}</td>
                        <td align="left" class="bold">{{ $de->peso_bruto - $de->peso_neto }}</td>
                        <td align="left" class="bold">{{ $de->peso_neto }}</td>

                    </tr>
                    <?php
                    }
                    ?>
                    <tr class="border_top">

                        <th align="left" colspan="2" class="bold"><strong>TOTALES VENDIDOS DE ITEMS DE
                                PT</strong></th>



                        <th align="left" class="bold"><strong>{{ number_format($cajas_t, 2) }}</strong></th>

                        <th align="left" class="bold"><strong>{{ number_format($peso_bruto_t, 2) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($tara_t, 2) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($peso_neto_t, 2) }}</strong></th>



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

                        <th align="center" colspan="6" class="bold section-title"><strong>ITEMS DE PP</strong>
                        </th>





                    </tr>


                    <tr class="border_top">

                        <th align="left" class="bold"><strong>PP N°</strong></th>
                        <th align="left" class="bold"><strong>ITEM</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>KG/B</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>



                    </tr>
                    <?php
                    $cajas_v = 0;
                    $pollos_v = 0;
                    $peso_bruto_v = 0;
                    $peso_neto_v = 0;
                    $tara_v = 0;
                    foreach ($venta->VentaDetallePps as $de) {
                        $cajas_v += $de->cajas;
                        $pollos_v += $de->pollos;
                        $peso_bruto_v += $de->peso_bruto;
                        $peso_neto_v += $de->peso_neto;
                        $tara_v += $de->peso_bruto - $de->peso_neto;
                    ?>
                    <tr class="border_top">

                        <td align="left" class="bold">{{ $de->Pp->nro }}</td>
                        <td align="left" class="bold">{{ $de->Item->name }}</td>
                        <td align="left" class="bold">{{ intval($de->cajas) }}</td>

                        <td align="left" class="bold">{{ $de->peso_bruto }}</td>
                        <td align="left" class="bold">{{ $de->peso_bruto - $de->peso_neto }}</td>
                        <td align="left" class="bold">{{ $de->peso_neto }}</td>




                    </tr>
                    <?php
                    }
                    ?>
                    <tr class="border_top">

                        <th align="left" colspan="2" class="bold"><strong>TOTALES VENDIDOS DE PP</strong></th>



                        <th align="left" class="bold"><strong>{{ $cajas_v }}</strong></th>

                        <th align="left" class="bold"><strong>{{ number_format($peso_bruto_v, 3) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($tara_v, 3) }}</strong></th>
                        <th align="left" class="bold"><strong>{{ number_format($peso_neto_v, 3) }}</strong></th>



                    </tr>
                </tbody>
            </table>
        </div>

    </div>





</body>

</html>
