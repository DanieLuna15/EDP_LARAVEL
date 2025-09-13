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
                                MEMORANDUM N° <?= $memorandum->id ?>
                            </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:15px" text-align="center">TIPO DE CONTRATO:
                                <b><?= $memorandum->contrato->tipocontrato->name ?></b></span>
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
                        <strong class="section-title">SUCURSAL:</strong> <?= $memorandum->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $memorandum->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $memorandum->sucursal->telefono ?>
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
                        <strong class="section-title">DATOS DEL RESPONSABLE</strong>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Nombre:</strong> <?= $memorandum->user->nombre ?>
                        <?= $memorandum->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $memorandum->user->usuario ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <table width="100%" cellpadding="6" cellspacing="0">
        <tbody>
            <th colspan="3" style="width:77%; text-align:left; background:#f2f2f2;">
                <strong class="section-title">DATOS DEL EMPLEADO</strong>
            </th>
            <tr>
                <td width="60%" align="left"><strong>Nombres:</strong>
                    <?= $memorandum->contrato->persona->nombre ?>
                    <?= $memorandum->contrato->persona->apellidos ?></td>
                <td colspan="2" width="40%" align="left">
                    <strong><?= $memorandum->contrato->persona->documento->name ?>:</strong>
                    <?= $memorandum->contrato->persona->doc ?>
                </td>
            </tr>
            <tr>
                <td width="60%" align="left">
                    <strong>Telefono: </strong> <?= $memorandum->contrato->persona->telefono ?>

                </td>
                <td colspan="2"width="40%" align="left"><strong>Dirección: </strong>
                    <?= $memorandum->contrato->persona->direccion ?></td>
            </tr>
            <tr>
                <td width="60%" align="left">
                    <strong>Cargo: </strong> <?= $memorandum->contrato->persona->cargo ?>

                </td>
                <td colspan="2" width="40%" align="left"><strong>Area: </strong>
                    <?= $memorandum->contrato->area->name ?></td>
            </tr>
            <tr>
                <td width="30%" align="left">
                    <strong>Suelo base: </strong> <?= $memorandum->contrato->sueldo ?>

                </td>
                <td width="30%" align="left">
                    <strong>Costos fijos %: </strong>
                    <?= $memorandum->contrato->contratocostos_sum ?>

                </td>
                <td width="30%" align="left">
                    <strong>Sueldo Bruto: </strong>
                    <?= floatval($memorandum->contrato->sueldo) - floatval(floatval($memorandum->contrato->sueldo) * (floatval($memorandum->contrato->contratocostos_sum) / 100)) ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <th style="width: 50%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">DESCRIPCION:</strong> <?= $memorandum->sucursal->nombre ?>
                </th>
                <td width="50%">
                    <?= $memorandum->descripciom ?>
                </td>
            </tr>

            <tr>
                <th style="width: 50%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">FECHA:</strong>
                </th>
                <td width="50%">
                    <?= $memorandum->fecha ?>
                </td>
            </tr>
            <tr>
                <th style="width: 50%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">MOTIVO:</strong>
                </th>
                <td width="50%">
                    <?= $memorandum->motivomemorandum->name ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="4">
                        <strong>Información Adicional</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <table width="100%" border="0" class="no-border" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td>
                    <!-- Esta tabla tiene bordes y distribución 50% para cada celda -->
                    <table width="50%" border="1" cellpadding="5" cellspacing="0">
                        <tbody>
                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    AREA ASIGNADA:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->contrato->area->name ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    SUELDO MENSUAL ESTIMADO:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->sueldo ?? 0 ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    HORAS EXTRAS: 
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->extras ?? 0 ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    FALTAS: 
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->faltas ?? 0 ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <!-- Esta tabla tiene bordes y distribución 50% para cada celda -->
                    <table width="50%" border="1" cellpadding="5" cellspacing="0">
                        <tbody>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    ATRASOS: 
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->atraso ?? 0 ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    VENDIDO: 
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <span><?= $memorandum->venta ?? 0 ?></span>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    VALOR DE PAGO DE VACACIONES:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->valor_vacaciones ?? 0 ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    SUELDO BRUTO:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $memorandum->bruto ?? 0 ?>
                                    </p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
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
                    Firma <?= $memorandum->user->nombre ?>
                </span>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <span
                    style="border-top: 2px #676a6c solid; width: 70%; font-family: Tahoma, Geneva, sans-serif; font-size: 14px; font-weight: bold; padding-top: 10px; display: inline-block;">
                    Firma <?= $memorandum->contrato->persona->nombre ?>
                </span>
            </td>
        </tr>
    </table>

</body>

</html>
