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
                @if (isset($validarCaja->compra->sucursal->image->path_url))
                    <img src="<?= $validarCaja->compra->sucursal->image->path_url ?>" class="img-fluid"
                        alt="admin-profile" style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        VALIDACIÓN DE CAJA - N° <?= $validarCaja->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" style="border:none; margin:0; padding:0;">
        <tr>
            <td style="width: 50%; vertical-align: top; padding:0 2px 0 0; border:none;">
                <div class="tabla_borde">
                    <table width="100%" cellpadding="6" cellspacing="0">
                        <tbody>
                            <tr>
                                <th style="width:33%; text-align:left; background:#f2f2f2;">
                                    <strong class="section-title">SUCURSAL:</strong>
                                    <?= $validarCaja->compra->sucursal->nombre ?>
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong>Dirección: </strong><?= $validarCaja->compra->sucursal->direccion ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Telefono: </strong><?= $validarCaja->compra->sucursal->telefono ?>
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
                                    DATOS DEL RESPONSABLE
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong>Nombre:</strong> <?= $validarCaja->compra->user->nombre ?>
                                    <?= $validarCaja->compra->user->apellidos ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Usuario:</strong> <?= $validarCaja->compra->user->usuario ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="tabla_borde">
        <table width="100%" border="0" cellspacing="0">
            <tbody>
                <tr>
                    <th align="left" class="bold">STOCK DE ORIGEN</th>
                    <th align="left" class="bold">CANTIDAD</th>
                    <th align="left" class="bold">STOCK ACTUAL DE ORIGEN</th>
                    <th align="left" class="bold">ORIGEN</th>
                    <th align="left" class="bold">DESTINO</th>
                </tr>
                <?php
                    foreach ($validarCaja->detalles as $k) {
                                                ?>
                <tr class="border_top">
                    <td align="left" class=""><?= $k->stock ?></td>
                    <td align="left" class=""><?= $k->cantidad ?></td>
                    <td align="left" class="">
                        <?php
                        if ($k->origen->id == $k->destino->id) {
                            echo $k->stock . ' (mismo almacén, ajuste interno)';
                        } else {
                            echo $k->stock - $k->cantidad;
                        }
                        ?>
                    </td>
                    <td align="left" class=""><?= $k->origen->name ?></td>
                    <td align="left" class=""><?= $k->destino->name ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>








</body>

</html>
