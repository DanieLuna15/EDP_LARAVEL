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
                        ENVIO A
                        {{ $traspasoPp->tipo == 1 ? 'PP' : 'PT' }} N° <?= $traspasoPp->id ?> </span>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b> PP N°</b><?= $traspasoPp->Pp->nro ?> </span>
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





                        <th align="left" class="bold"><strong>LOTE</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>PESO BRUTO</strong></th>
                        <th align="left" class="bold"><strong>PESO NETO</strong></th>
                        <th align="left" class="bold"><strong>MERMA BRUTA</strong></th>
                        <th align="left" class="bold"><strong>MERMA NETA</strong></th>




                    </tr>
                    <?php
                   foreach ($traspasoPp->TraspasoPpDetalles as $k) {
                    ?>
                    <tr class="border_top">




                        <td align="left">
                            {{ $k->LoteDetalle->Lote->Compra->ProveedorCompra->abreviatura }}-{{ $k->LoteDetalle->Lote->Compra->nro }}
                        </td>
                        <td align="left">{{ $k->LoteDetalle->name }}</td>
                        <td align="left">{{ $k->cajas }}</td>
                        <td align="left">{{ $k->pollos }}</td>
                        <td align="left">{{ $k->peso_bruto }}</td>
                        <td align="left">{{ $k->peso_neto }}</td>
                        <td align="left">{{ $k->merma_bruta }}</td>
                        <td align="left">{{ $k->merma_neta }}</td>





                    </tr>
                    <?php
                     }
                    ?>
            </table>
        </div>

    </div>

    <div>

        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>




                    <tr>




                        <th align="left" class="bold"><strong>ENVIO</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>PESO BRUTO</strong></th>
                        <th align="left" class="bold"><strong>PESO NETO</strong></th>
                        <th align="left" class="bold"><strong>MERMA BRUTA</strong></th>
                        <th align="left" class="bold"><strong>MERMA NETA</strong></th>




                    </tr>
                    <?php
                   foreach ($traspasoPp->TraspasoPpEnvios as $k) {
                    ?>
                    <tr class="border_top">





                        <td align="left">{{ $k->tipo == 1 ? 'PP' : 'PT' }}</td>
                        <td align="left">{{ $k->cajas }}</td>
                        <td align="left">{{ $k->pollos }}</td>
                        <td align="left">{{ $k->peso_bruto }}</td>
                        <td align="left">{{ $k->peso_neto }}</td>
                        <td align="left">{{ $k->merma_bruta }}</td>
                        <td align="left">{{ $k->merma_neta }}</td>





                    </tr>
                    <?php
                     }
                    ?>

            </table>
        </div>

    </div>


    <div>

        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>




                    <tr>





                        <th align="left" class="bold"><strong>DETALLE</strong></th>
                        <th align="left" class="bold"><strong>GRUPO</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>PESO BRUTO</strong></th>
                        <th align="left" class="bold"><strong>PESO NETO</strong></th>
                        <th align="left" class="bold"><strong>MERMA BRUTA</strong></th>
                        <th align="left" class="bold"><strong>MERMA NETA</strong></th>




                    </tr>

                    <tr class="border_top">




                        <td align="left" class="bold"><strong>{{ $traspasoPp->name }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->cintaCliente->name }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->cajas }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->pollos }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->peso_bruto }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->peso_neto }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->merma_bruta }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $traspasoPp->merma_neta }}</strong></td>





                    </tr>
            </table>
        </div>

    </div>






</body>

</html>
