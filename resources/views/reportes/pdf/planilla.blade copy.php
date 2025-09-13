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

        .tabla_borde {
            border-collapse: collapse;
            width: 100%;
        }

        /* Bordes exteriores */
        .tabla_borde th,
        .tabla_borde td {
            padding: 6px;
            text-align: left;
            border: 1px solid #ccc;
            /* Borde exterior */
        }

        /* Eliminar bordes internos verticales */
        .tabla_borde td {
            border-left: none;
            /* Elimina el borde izquierdo interno */
            border-right: none;
            /* Elimina el borde derecho interno */
        }

        /* Mantener las líneas horizontales internas */
        .tabla_borde tr td {
            border-top: 1px solid #ccc;
            /* Borde horizontal entre las filas */
        }

        /* Línea inferior de la tabla */
        .tabla_borde tr:last-child td {
            border-bottom: 1px solid #ccc;
        }

        /* Estilo de los encabezados de las tablas */
        .tabla_borde th {
            background: #f2f2f2;
            font-weight: bold;
        }


        /* Opcional: Si deseas un espaciado adicional entre los encabezados y el contenido */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-align: left;
        }

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

        .firma-table {
            margin-top: 20px;
            width: 100%;
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
                    @if (isset($planilla->sucursal->image->path_url))
                        <img src="<?= $planilla->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                            style="width: 100px;">
                    @endif
                </td>
                <td width="60%" valign="middle" style="border:1px solid #ccc;">
                    <div style="padding: 8px;">
                        <div
                            style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                            PLANILLA N° <?= $planilla->id ?> -
                            <?= $planilla->mes ?>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:15px" text-align="center"> TIPO DE
                                CONTRATO:<strong>
                                    <?= $planilla->contrato->tipocontrato->name ?></strong></span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px">Fecha de registro
                                <?= $planilla->created_at ?> </span>
                        </div>
                        <div style="font-size:12px; text-align:right;">
                            <span style="font-size:14px">Fecha de emision
                                <?= $planilla->emision ?> </span>
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
                        <strong class="section-title">SUCURSAL:</strong> <?= $planilla->contrato->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $planilla->contrato->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $planilla->contrato->sucursal->telefono ?>
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
                        <strong>Nombre:</strong> <?= $planilla->user->nombre ?>
                        <?= $planilla->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $planilla->user->usuario ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="1" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="3">
                        <strong>DATOS DEL EMPLEADO</strong>
                    </th>
                </tr>
                <tr>
                    <td width="60%" align="left"><strong>Nombres:</strong>
                        <?= $planilla->contrato->persona->nombre ?>
                        <?= $planilla->contrato->persona->apellidos ?></td>
                    <td width="40%" align="left" colspan="2">
                        <strong><?= $planilla->contrato->persona->documento->name ?>:</strong>
                        <?= $planilla->contrato->persona->doc ?>
                    </td>
                </tr>
                <tr>
                    <td width="60%" align="left">
                        <strong>Telefono: </strong> <?= $planilla->contrato->persona->telefono ?>
                    </td>
                    <td width="40%" align="left" colspan="2"><strong>Dirección: </strong>
                        <?= $planilla->contrato->persona->direccion ?></td>
                </tr>
                <tr>
                    <td width="60%" align="left">
                        <strong>Cargo: </strong> <?= $planilla->contrato->persona->cargo ?>
                    </td>
                    <td width="40%" align="left" colspan="2"><strong>Area: </strong>
                        <?= $planilla->contrato->area->name ?></td>
                </tr>
                <tr>
                    <td width="30%" align="left">
                        <strong>Sueldo base: </strong> <?= $planilla->contrato->sueldo ?>
                    </td>
                    <td width="30%" align="left">
                        <strong>Costos fijos %: </strong> <?= $planilla->contrato->contratocostos_sum ?>
                    </td>
                    <td width="30%" align="left">
                        <strong>Sueldo Bruto: </strong>
                        <?= floatval($planilla->contrato->sueldo) - floatval(floatval($planilla->contrato->sueldo) * (floatval($planilla->contrato->contratocostos_sum) / 100)) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" width="30%" align="left">
                        <strong>Observacion: </strong> {{ $planilla->observacion }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <th align="left" class="bold">Descripción de costos</th>
                    <th align="center" class="bold">Valor</th>
                </tr>
                <?php
                                        foreach($planilla->Planillacostos()->get() as $costo){
                                       ?>
                <tr class="border_top">
                    <td align="left">
                        <?= $costo->costovariable->name ?>
                    </td>
                    <td align="center">
                        <?= $costo->monto ?>
                    </td>

                </tr>
                <?php
                                      }
                                       ?>
            </tbody>
        </table>
    </div>

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
                                        <?= $planilla->contrato->area->name ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    SUELDO MENSUAL ESTIMADO:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->sueldo ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    HORAS EXTRAS:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->extras ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    FALTAS:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->faltas ?>
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
                                        <?= $planilla->atraso ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    VENDIDO:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->venta ?>
                                    </p>
                                </td>
                            </tr>

                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    VALOR DE PAGO DE VACACIONES:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->valor_vacaciones ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="border_top">
                                <th style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    SUELDO BRUTO:
                                </th>
                                <td style="font-size: 10px; width: 50%; text-align: left; border: 1px solid #ccc;">
                                    <p>
                                        <?= $planilla->bruto ?>
                                    </p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <?php
                                        foreach($planilla->adeudas_detalles as $a){
                                       ?>
                <tr>

                    <th align="left" class="bold">Adeuda</th>
                    <th align="center" class="bold"> <?= $a->adeuda->monto ?></th>
                    <th align="center" class="bold">Cuotas <?= $a->adeuda->plan ?></th>
                </tr>
                <tr class="border_top">

                    <th align="left" class="bold">Motivo:</th>
                    <td align="left" class="" colspan="2"> <?= $a->adeuda->motivo ?></td>

                </tr>
                <?php


                                        foreach($a->adeuda->adeudacuotas as $c=>$val){

                                       ?>
                <tr class="border_top">
                    <td align="left">
                        Cuota <?= $c + 1 ?>
                    </td>
                    <td align="center">
                        <?= $val->monto ?>
                    </td>
                    <td align="center">
                        <?= $val->pagado ? 'PAGADO' : 'PENDIENTE' ?>
                    </td>

                </tr>
                <?php
                                      }

                                        }


                                ?>
            </tbody>
        </table>
    </div>


    <table width="100%" border="0" class="no-border" style="margin: 0 auto;">
        <br>
        <br>
        <br>
        <br>
        <tr>
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <span
                    style="border-top: 2px #676a6c solid; width: 70%; font-family: Tahoma, Geneva, sans-serif; font-size: 14px; font-weight: bold; padding-top: 10px; display: inline-block;">
                    Firma <?= $planilla->user->nombre ?>
                </span>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <span
                    style="border-top: 2px #676a6c solid; width: 70%; font-family: Tahoma, Geneva, sans-serif; font-size: 14px; font-weight: bold; padding-top: 10px; display: inline-block;">
                    Firma <?= $planilla->contrato->persona->nombre ?>
                </span>
            </td>
        </tr>
    </table>



</body>

</html>
