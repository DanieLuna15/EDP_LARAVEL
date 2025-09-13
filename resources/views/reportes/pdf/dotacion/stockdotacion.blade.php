<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> INGRESO DE DOTACION </title>
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
            padding: 6
        }

        .table-valores-totales tbody>tr>td {
            border-top: 0 none !important
        }

        .page_break {
            page-break-before: always;
        }
    </style>
</head>

<body class="white-bg">

    <table width="100%">
        <tbody>
            <tr>
                <td style="padding:30px; !important">
                    <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="50%" height="0" align="center">
                                    @if ($stock->sucursal->image)
                                        <img src="<?= $stock->sucursal->image->path_url ?>" class="img-fluid"
                                            alt="admin-profile" style="width: 100px;">
                                    @endif
                                </td>
                                <td width="5%" height="0" align="center"></td>
                                <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                                    <div class="tabla_borde">
                                        <table width="100%" border="0" height="50" cellpadding="6"
                                            cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <span
                                                            style="font-family:Tahoma, Geneva, sans-serif; font-size:14px"
                                                            text-align="center">I N G R E S O &nbsp; D E &nbsp; D O T A
                                                            C I O N</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:24px">N° <?= $stock->id ?> </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" style="padding-left:0" colspan="3">
                                    <div class="tabla_borde">
                                        <table width="100%" height="0" border="0" border-radius=""
                                            cellpadding="9" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center" colspan="2">
                                                        <strong><span
                                                                style="font-size:15px"><?= $stock->sucursal->nombre ?></span></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <strong><?= $stock->sucursal->documento->name ?>:
                                                        </strong><?= $stock->sucursal->doc ?>
                                                    </td>
                                                    <td align="left">
                                                        <strong>Email: </strong><?= $stock->sucursal->email ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <strong>Dirección: </strong><?= $stock->sucursal->direccion ?>
                                                    </td>
                                                    <td align="left">
                                                        <strong>Telefono: </strong><?= $stock->sucursal->telefono ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left">
                                                        <strong>Responsable:
                                                        </strong><?= $stock->sucursal->responsable ?>
                                                    </td>
                                                    <td align="left">
                                                        <strong>Medidor: </strong><?= $stock->sucursal->medidor ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" style="padding-left:0" colspan="3">

                                    <div class="tabla_borde">
                                        <table width="100%" border="0" height="50" cellpadding="6"
                                            cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="text-align: start;vertical-align: bottom;">
                                                        <span
                                                            style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                            text-align="center">DATOS DEL RESPONSABLE</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                        <table width="100%" border="0" cellpadding="1"
                                                            cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"><strong>Nombre:</strong>
                                                                        <?= $stock->user->nombre ?>
                                                                        <?= $stock->user->apellidos ?></td>
                                                                    <td align="left"><strong>Correo:</strong>
                                                                        <?= $stock->user->correo ?></td>


                                                                    <td align="left">
                                                                        <strong>Usuario: </strong>
                                                                        <?= $stock->user->usuario ?>

                                                                    </td>

                                                                </tr>
                                                                <tr>


                                                                    <td align="left">
                                                                        <strong>Forma de pago: </strong>
                                                                        <?= $stock->formapago->name ?>

                                                                    </td>
                                                                    <td align="left">
                                                                        <strong>Fecha de dotacion Ingreso: </strong>
                                                                        <?= $stock->fecha ?>

                                                                    </td>
                                                                    <td align="left">
                                                                        <strong>Motivo Ingreso: </strong>
                                                                        <?= $stock->motivo ?>

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
                                <td valign="bottom" style="padding-left:0" colspan="3">

                                    <div class="tabla_borde">
                                        <table width="100%" border="0" height="50" cellpadding="6"
                                            cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="text-align: start;vertical-align: bottom;">
                                                        <span
                                                            style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                                                            text-align="center">DATOS DEL PROVEEDOR</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                        <table width="100%" border="0" cellpadding="1"
                                                            cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"><strong>Nombre:</strong>
                                                                        <?= $stock->proveedor->nombre ?> </td>
                                                                    <td align="left">
                                                                        <strong><?= $stock->proveedor->documento->name ?>:</strong>
                                                                        <?= $stock->proveedor->doc ?> </td>





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
                        </tbody>
                    </table>
                    <br>
                    <div class="tabla_borde">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tbody>
                                <tr>

                                    <td align="left" class="bold">Descripción de dotacion</td>
                                    <td align="center" class="bold">Costo</td>
                                    <td align="center" class="bold"> venta</td>
                                    <td align="center" class="bold">Cantidad</td>
                                    <td align="center" class="bold">Total</td>
                                </tr>
                                <?php
                                        foreach($stock->detalles as $s){
                                       ?>
                                <tr class="border_top">
                                    <td align="left">
                                        <?= $s->dotacion->name ?>
                                    </td>
                                    <td align="center">
                                        <?= $s->costo ?>
                                    </td>
                                    <td align="center">
                                        <?= $s->venta ?>
                                    </td>
                                    <td align="center">
                                        <?= $s->cantidad ?>
                                    </td>
                                    <td align="center">
                                        <?= printf('%.2f', $s->cantidad * $s->costo) ?>
                                    </td>
                                </tr>
                                <?php
                                      }
                                       ?>
                            </tbody>
                        </table>
                    </div>



                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
