<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .bold,
        b,
        strong {
            font-weight: 700
        }

        body {
            background-repeat: no-repeat;
            background-position: center center;
            text-align: center;
            margin: 0;
            font-family: Verdana, monospace
        }

        .tabla_borde {
            border: 1px solid #666;
            border-radius: 10px
        }

        tr.border_bottom td {
            border-bottom: 1px solid #000
        }

        tr.border_top td {
            border-top: 1px solid #666
        }

        td.border_right {
            border-right: 1px solid #666
        }

        .table-valores-totales tbody>tr>td {
            border: 0
        }

        .table-valores-totales>tbody>tr>td:first-child {
            text-align: right
        }

        .table-valores-totales>tbody>tr>td:last-child {
            border-bottom: 1px solid #666;
            text-align: right;
            width: 30%
        }

        hr,
        img {
            border: 0
        }

        table td {
            font-size: 12px
        }

        html {
            font-family: sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-size: 10px;
            -webkit-tap-highlight-color: transparent
        }

        a {
            background-color: transparent
        }

        a:active,
        a:hover {
            outline: 0
        }

        img {
            vertical-align: middle
        }

        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px solid #eee
        }

        table {
            border-spacing: 0;
            border-collapse: collapse
        }

        @media print {

            blockquote,
            img,
            tr {
                page-break-inside: avoid
            }

            *,
            :after,
            :before {
                color: #000 !important;
                text-shadow: none !important;
                background: 0 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important
            }

            a,
            a:visited {
                text-decoration: underline
            }

            a[href]:after {
                content: " (" attr(href) ")"
            }

            blockquote {
                border: 1px solid #999
            }

            img {
                max-width: 100% !important
            }

            p {
                orphans: 3;
                widows: 3
            }

            .table {
                border-collapse: collapse !important
            }

            .table td {
                background-color: #fff !important
            }
        }

        a,
        a:focus,
        a:hover {
            text-decoration: none
        }

        *,
        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        a {
            color: #428bca;
            cursor: pointer
        }

        a:focus,
        a:hover {
            color: #2a6496
        }

        a:focus {
            outline: dotted thin;
            outline: -webkit-focus-ring-color auto 5px;
            outline-offset: -2px
        }

        h6 {
            font-family: inherit;
            line-height: 1.1;
            color: inherit;
            margin-top: 10px;
            margin-bottom: 10px
        }

        p {
            margin: 0 0 10px
        }

        blockquote {
            padding: 10px 20px;
            margin: 0 0 20px;
            border-left: 5px solid #eee
        }

        table {
            background-color: transparent
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px
        }

        h6 {
            font-weight: 100;
            font-size: 10px
        }

        body {
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #2f4050;
            font-size: 13px;
            color: #676a6c;
            overflow-x: hidden
        }

        .table>tbody>tr>td {
            vertical-align: top;
            border-top: 1px solid #e7eaec;
            line-height: 1.42857;
            padding: 8px
        }

        .white-bg {
            background-color: #fff
        }

        td {
            padding: 4
        }

        .table-valores-totales tbody>tr>td {
            border-top: 0 none !important
        }

        div.page_break+div.page_break {
            page-break-before: always;
        }
    </style>
</head>

<body class="white-bg">

    <table width="100%">
        <tbody>

            <tr>
                <td>
                    <div class="tabla_borde">
                        <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px"
                                            text-align="center">F I N I Q U I T O &nbsp; A G U I N A L D O </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <div class="tabla_borde">
                                            <table width="100%" border="0" height="50" cellpadding="6"
                                                cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="left"
                                                            style="text-align: start;vertical-align: bottom;">
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                                text-align="center">DATOS DE LA SUCURSAL</span>
                                                        </td>
                                                        <td align="left">
                                                            @if (isset($finiquito->sucursal->image->path_url))
                                                                <img src="<?= $finiquito->sucursal->image->path_url ?>"
                                                                    class="img-fluid" alt="admin-profile"
                                                                    style="width: 100px;">
                                                            @endif
                                                        </td>

                                                        <td align="right"
                                                            style="text-align: end;vertical-align: bottom;">
                                                            <span style="font-size:15px">FINIQUITOS N°
                                                                <?= $finiquito->id ?></span>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <table width="100%" height="0" border="0"
                                                                border-radius="" cellpadding="9" cellspacing="0">
                                                                <tbody>
                                                                    <tr>

                                                                        <td align="left">
                                                                            <strong>Nombre:
                                                                            </strong><?= $finiquito->sucursal->nombre ?>

                                                                        </td>
                                                                        <td align="left">
                                                                            <strong><?= $finiquito->sucursal->documento->name ?>:
                                                                            </strong><?= $finiquito->sucursal->doc ?>
                                                                        </td>
                                                                        <td align="left">
                                                                            <strong>Email:
                                                                            </strong><?= $finiquito->sucursal->email ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>


                                                                        <td align="left">
                                                                            <strong>Dirección:
                                                                            </strong><?= $finiquito->sucursal->direccion ?>
                                                                        </td>
                                                                        <td align="left">
                                                                            <strong>Telefono:
                                                                            </strong><?= $finiquito->sucursal->telefono ?>
                                                                        </td>

                                                                        <td align="left">
                                                                            <strong>Responsable:
                                                                            </strong><?= $finiquito->sucursal->responsable ?>
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table width="200px" height="0" border="0"
                                                                border-radius="" cellpadding="9" cellspacing="0">
                                                                <tbody>
                                                                    <tr>

                                                                        <td width="100%" align="left"><strong>Fecha
                                                                                Registo: </strong>
                                                                            <?= $finiquito->emision ?></td>

                                                                    </tr>
                                                                    <tr>

                                                                        <td width="100%" align="left"><strong>Fecha
                                                                                Emision: </strong>
                                                                            <?= $finiquito->emision ?></td>

                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="left">
                                        <div class="tabla_borde">
                                            <table width="100%" border="0" height="50" cellpadding="6"
                                                cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="left"
                                                            style="text-align: start;vertical-align: bottom;">
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                                text-align="center">DATOS DEL CONTRATANTE</span>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>

                                                            <table width="100%" border="0" cellpadding="1"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left"><strong>Razón
                                                                                Social:</strong>
                                                                            <?= $finiquito->contrato->persona->nombre ?>
                                                                            <?= $finiquito->contrato->persona->apellidos ?>
                                                                        </td>
                                                                        <td align="left">
                                                                            <strong><?= $finiquito->contrato->persona->documento->name ?>:</strong>
                                                                            <?= $finiquito->contrato->persona->doc ?>
                                                                        </td>

                                                                        <td align="left">
                                                                            <strong>Telefono: </strong>
                                                                            <?= $finiquito->contrato->persona->telefono ?>

                                                                        </td>


                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="left">
                                        <div class="tabla_borde">
                                            <table width="100%" border="0" height="50" cellpadding="6"
                                                cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="left"
                                                            style="text-align: start;vertical-align: bottom;">
                                                            <span
                                                                style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                                text-align="center">DETALLE DEL FINIQUITO</span>
                                                        </td>



                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">

                                                            <table width="100%" border="0" cellpadding="1"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left"><strong>Razón
                                                                                Social:</strong>
                                                                            <?= $finiquito->contrato->persona->nombre ?>
                                                                            <?= $finiquito->contrato->persona->apellidos ?>
                                                                        </td>
                                                                        <td align="left">
                                                                            <strong><?= $finiquito->contrato->persona->documento->name ?>:</strong>
                                                                            <?= $finiquito->contrato->persona->doc ?>
                                                                        </td>

                                                                        <td align="left">
                                                                            <strong>Telefono: </strong>
                                                                            <?= $finiquito->contrato->persona->telefono ?>

                                                                        </td>

                                                                        <td colspan="2" align="left">
                                                                            <strong>Dirección: </strong>
                                                                            <?= $finiquito->contrato->persona->direccion ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>

                                                                        <td align="left"><strong>Area: </strong>
                                                                            <?= $finiquito->contrato->area->name ?>
                                                                        </td>
                                                                        <td align="left"><strong>Cargo: </strong>
                                                                            <?= $finiquito->contrato->persona->cargo ?>
                                                                        </td>


                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">

                                        <table width="100%" border="0" height="50" cellpadding="6"
                                            cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="text-align: start;vertical-align: bottom;">
                                                        <span
                                                            style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                            text-align="center">Planillas</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                        <div class="tabla_borde">
                                                            <table width="100%" border="0" cellpadding="5"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" class="bold"
                                                                            colspan="2">Finiquito por planillas</td>

                                                                    </tr>
                                                                    <?php
                                        foreach($finiquito->detalle as $a){
                                       ?>
                                                                    <tr class="border_top">
                                                                        <td align="center">
                                                                            <?= $a->mes ?>
                                                                        </td>
                                                                        <td align="center">
                                                                            <?= $a->planilla->sueldo ?>
                                                                        </td>

                                                                    </tr>
                                                                    <?php
                                      }
                                       ?>



                                                                    <tr class="border_top">

                                                                        <td colspan="4" align="right">
                                                                            Valor total <?= $finiquito->pago ?>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td align="center">
                                                <span
                                                    style="border-top: 2px #676a6c  solid;width: 100%;font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                    text-align="center">Firma
                                                    <?= $finiquito->contrato->persona->nombre ?></span>
                                            </td>
                                            <td align="center">
                                                <span
                                                    style="border-top: 2px #676a6c  solid;width: 100%;font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                    text-align="center">Firma
                                                    <?= $finiquito->contrato->persona->nombre ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
