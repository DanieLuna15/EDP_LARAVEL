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
                        ENVIO A PT - N° <?= $envioGenPt->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>PT N°</b><?= $envioGenPt->Pt->nro ?> </span>
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

    <div>

        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>




                    <tr>

                        <th align="left" class="bold"><strong>FECHA</strong></th>


                        <th align="left" class="bold"><strong>LOTE</strong></th>
                        <th align="left" class="bold"><strong>PIGMENTO</strong></th>
                        <th align="left" class="bold"><strong>DETALLE</strong></th>
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
                foreach ($envioGenPt->envioGenPtDetalles as $de) {
                    $cajas += $de->detallePt->cajas;
                    $pollos += $de->detallePt->pollos;
                    $peso_bruto += $de->detallePt->peso_bruto;
                    $peso_neto += $de->detallePt->peso_neto;
                    $tara += $de->detallePt->peso_bruto-$de->detallePt->peso_neto;
                ?>
                    <tr class="border_top">
                        <td>{{ $envioGenPt->fecha }}</td>
                        <td>{{ $de->detallePt->LoteDetalle->Lote->Compra->ProveedorCompra->abreviatura }}-{{ $de->detallePt->LoteDetalle->Lote->Compra->nro }}
                        </td>
                        <td>{{ $de->detallePt->LoteDetalle->pigmento == 1 ? 'CON PIGMENTO' : 'SIN PIGMENTO' }}</td>
                        <td>{{ $de->detallePt->LoteDetalle->name }}</td>
                        <td>{{ $de->detallePt->cajas }}</td>
                        <td>{{ $de->detallePt->pollos }}</td>
                        <td>{{ $de->detallePt->peso_bruto }}</td>
                        <td>{{ $de->detallePt->peso_bruto - $de->detallePt->peso_neto }}</td>
                        <td>{{ $de->detallePt->peso_neto }}</td>


                    </tr>
                    <?php
               }
               $cajas = number_format($cajas, 2, '.', '');
                $pollos = number_format($pollos, 2, '.', '');
                $peso_bruto = number_format($peso_bruto, 3, '.', '');
                $peso_neto = number_format($peso_neto, 3, '.', '');
                $tara = number_format($tara, 3, '.', '');
               ?>
                    <tr class="border_top">
                        <th colspan="3" class="bold">TOTALES</th>
                        <th></th>
                        <th align="left" class="bold">{{ $cajas }}</th>
                        <th align="left" class="bold">{{ $pollos }}</th>
                        <th align="left" class="bold">{{ $peso_bruto }}</th>
                        <th align="left" class="bold">{{ $tara }}</th>
                        <th align="left" class="bold">{{ $peso_neto }}</th>



                    </tr>
                </tbody>
            </table>
        </div>

    </div>






</body>

</html>
