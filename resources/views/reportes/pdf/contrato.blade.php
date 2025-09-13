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
                    @if (isset($contrato->sucursal->image->path_url))
                        <img src="<?= $contrato->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                            style="width: 100px;">
                    @endif
                </td>
                <td width="60%" valign="middle" style="border:1px solid #ccc;">
                    <div style="padding: 8px;">
                        <div
                            style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                            <span>
                                CONTRATO N° <?= $contrato->id ?>
                            </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px"><b>Tipo:</b>
                                CONTRATO &nbsp;<?= $contrato->servicio == 1 ? '' : 'SERVICIO' ?>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px"><b>Fecha Inicio Contrato:</b>
                                <?= $contrato->inicio ?>
                            </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px"><b>Fecha Fin Contrato:</b>
                                <?= $contrato->fin ?> </span>
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
                        <strong class="section-title">SUCURSAL:</strong> <?= $contrato->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $contrato->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $contrato->sucursal->telefono ?>
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
                        <strong>Nombre:</strong> <?= $contrato->user->nombre ?>
                        <?= $contrato->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $contrato->user->usuario ?>
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
                        @if (isset($contrato->persona->image->path_url))
                            <img src="<?= $contrato->persona->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td align="left"><strong>Razón
                            Social:</strong>
                        <?= $contrato->persona->nombre ?>
                        <?= $contrato->persona->apellidos ?></td>
                    <td align="left">
                        <strong><?= $contrato->persona->documento->name ?>:</strong>
                        <?= $contrato->persona->doc ?>
                    </td>
                    <td align="left">
                        <strong>Telefono: </strong>
                        <?= $contrato->persona->telefono ?>
                    </td>
                <tr>
                    <td align="left">
                        <strong>Dirección: </strong>
                        <?= $contrato->persona->direccion ?>
                    </td>

                    <td align="left"><strong>Fecha Inicio:
                        </strong> <?= $contrato->inicio ?></td>
                    <td align="left"><strong>Fecha Fin: </strong>
                        <?= $contrato->fin ?></td>
                </tr>
                <tr>
                    <td align="left"><strong>Garante: </strong>
                        <?= $contrato->persona->garante ?> </td>
                    <td align="left"><strong>Dir. Garante:
                        </strong>
                        <?= $contrato->persona->dir_garante ?> </td>

                    <td align="left"><strong>Cel. Garante:
                        </strong>
                        <?= $contrato->persona->cel_garante ?>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><strong>Area: </strong>
                        <?= $contrato->area->name ?> </td>

                    <td align="left"><strong>Cargo:
                        </strong><?= $contrato->persona->cargo ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <th style="width:40%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">TÉRMINOS:</strong>
                </th>
                <td style="width:60%; text-align:left;">
                    <?= $contrato->terminos ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <th colspan="2" style="width:100%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">COSTOS FIJOS:</strong>
                </th>
            </tr>
            <?php
            foreach($contrato->Contratocostos()->get() as $costo){
        ?>
            <tr class="border_bottom">
                <td align="right"><strong>
                        <?= $costo->costofijo->name ?></strong></td>
                <td width="120" align="right">
                    <span><?= $costo->costofijo->monto ?> %</span>
                </td>
            </tr>
            <?php
            }
        ?>
            <tr class="border_bottom">
                <th style="width:50%; text-align:left;"><strong> Sueldo Mensual Neto.</strong></th>
                <td align="right">
                    <span><?= $contrato->sueldo ?></span>
                </td>
            </tr>
            <tr class="border_bottom">
                <th style="width:50%; text-align:left;"><strong> Sueldo Mensual Bruto Aprox.</strong></th>
                <td align="right">
                    <span><?= $contrato->sueldo_bruto ?></span>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" border="0" class="no-border" style="margin: 0 auto;">
        <br>
        <br>
        <br>
        <br>
        <tr>
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <span
                    style="border-top: 2px #676a6c solid; width: 70%; font-family: Tahoma, Geneva, sans-serif; font-size: 14px; font-weight: bold; padding-top: 10px; display: inline-block;">
                    Firma <?= $contrato->user->nombre ?>
                </span>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <span
                    style="border-top: 2px #676a6c solid; width: 70%; font-family: Tahoma, Geneva, sans-serif; font-size: 14px; font-weight: bold; padding-top: 10px; display: inline-block;">
                    Firma <?= $contrato->persona->nombre ?>
                </span>
            </td>
        </tr>
    </table>

</body>

</html>
