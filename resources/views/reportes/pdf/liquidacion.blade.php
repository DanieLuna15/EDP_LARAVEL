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

        .no-border,
        .no-border th,
        .no-border td {
            border: none !important;
        }

        /* Signature section adjustments */
        .firma-table td {
            width: 50%;
            text-align: center;
            vertical-align: middle;
        }

        /* Inner table: remove extra padding, and align child tables */
        .inner-table th,
        .inner-table td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .inner-table {
            width: 100%;
            margin: 0;
        }
    </style>
</head>


<body class="white-bg">

    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tbody>
            <tr>
                <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                    @if (isset($liquidacion->sucursal->image->path_url))
                        <img src="<?= $liquidacion->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                            style="width: 100px;">
                    @endif
                </td>
                <td width="60%" valign="middle" style="border:1px solid #ccc;">
                    <div style="padding: 8px;">
                        <div
                           style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                            <span>
                                LIQUIDACIÓN N° <?= $liquidacion->id ?>
                            </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px"><b>Fecha Liquidación:</b>
                                <?= $liquidacion->inicio ?>
                            </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px"><b>Fecha de emision</b>
                                <?= date('d/m/Y H:i:s') ?> </span>
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
                        <strong class="section-title">SUCURSAL:</strong> <?= $liquidacion->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $liquidacion->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $liquidacion->sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width:33%; text-align:left; background:#f2f2f2;">
                        <strong class="section-title">DATOS DEL CONTRATANTE</strong>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Nombre:</strong> <?= $liquidacion->user->nombre ?>
                        <?= $liquidacion->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $liquidacion->user->usuario ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="2" style="width:77%; text-align:left; background:#f2f2f2;">
                        <strong class="section-title">DATOS DEL CONTRATADO</strong>
                    </th>
                    <td style="width:33%; text-align:left;">
                        @if (isset($liquidacion->contrato->persona->image->path_url))
                            <img src="<?= $liquidacion->contrato->persona->image->path_url ?>" class="img-fluid"
                                alt="admin-profile" style="width: 100px;">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td align="left"><strong>Razón
                            Social:</strong>
                        <?= $liquidacion->contrato->persona->nombre ?>
                        <?= $liquidacion->contrato->persona->apellidos ?></td>
                    <td align="left">
                        <strong><?= $liquidacion->contrato->persona->documento->name ?>:</strong>
                        <?= $liquidacion->contrato->persona->doc ?>
                    </td>

                    <td align="left">
                        <strong>Telefono: </strong>
                        <?= $liquidacion->contrato->persona->telefono ?>

                    </td>
                <tr>
                    <td align="left">
                        <strong>Dirección: </strong>
                        <?= $liquidacion->contrato->persona->direccion ?>
                    </td>

                    <td align="left"><strong>Fecha Inicio:
                        </strong> <?= $liquidacion->contrato->inicio ?></td>
                    <td align="left"><strong>Fecha Fin: </strong>
                        <?= $liquidacion->contrato->fin ?></td>
                </tr>

                <tr>
                    <td align="left"><strong>Area: </strong>
                        <?= $liquidacion->contrato->area->name ?> </td>

                    <td align="left"><strong>Cargo:
                        </strong><?= $liquidacion->contrato->persona->cargo ?>
                    </td>
                    <td align="left"><strong>Costos fijos:
                        </strong>
                        <?= $liquidacion->contratocostos_sum ?></td>
                </tr>
                <tr>
                    <td align="left" colspan="3"><strong>Sueldo base:
                        </strong>
                        <?= $liquidacion->contrato->sueldo ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <th align="left" class="bold">Desde</th>
                    <th align="left" class="bold">Fin </th>

                </tr>

                <tr class="border_top">
                    <td align="left">
                        <?= $liquidacion->inicio ?>
                    </td>
                    <td align="left">
                        <?= $liquidacion->fecha ?>


                </tr>



            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <th align="left" class="bold">Descripción</th>
                    <th align="center" class="bold">Valor Unit </th>
                    <th align="center" class="bold">Cantidad</th>
                    <th align="center" class="bold">Total</th>
                </tr>

                <tr class="border_top">
                    <th align="left">
                        Meses trabajados
                    </th>
                    <td align="center">
                        <?= $liquidacion->sueldo_mensual ?>
                    </td>
                    <td align="center">
                        <?= $liquidacion->mes ?>
                    </td>
                    <td align="center">
                        <?= $liquidacion->mes * $liquidacion->sueldo_mensual ?>
                    </td>

                </tr>

                <tr class="border_top">
                    <th align="left">
                        Dias trabajados
                    </th>
                    <td align="center">
                        <?= $liquidacion->sueldo_diario ?>
                    </td>
                    <td align="center">
                        <?= $liquidacion->dia ?>
                    </td>
                    <td align="center">
                        <?= $liquidacion->dia * $liquidacion->sueldo_diario ?>
                    </td>

                </tr>
                <tr class="border_top">
                    <th align="left" colspan="3">
                        Sueldo Neto
                    </th>

                    <td align="center">
                        <?= $liquidacion->sueldo_bruto ?>
                    </td>

                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>
