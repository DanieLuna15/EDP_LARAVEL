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

        .section-content {
            font-size: 8px;
            padding: 3px 0;
        }
    </style>
</head>

<body class="white-bg">
    <!-- Header Section -->
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($consolidacionPago->sucursal->image->path_url))
                    <img src="<?= $consolidacionPago->sucursal->image->path_url ?>" alt="Sucursal Logo"
                        style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        PAGO DE COMPRAS - N° <?= $consolidacionPago->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        TIPO DE PAGO: <strong> <?= $consolidacionPago->tipo == 1 ? 'CONTADO' : 'CREDITO' ?> </strong>
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
                        <strong class="section-title">SUCURSAL:</strong> <?= $consolidacionPago->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $consolidacionPago->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $consolidacionPago->sucursal->telefono ?>
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
                        <strong>Nombre:</strong> <?= $consolidacionPago->user->nombre ?>
                        <?= $consolidacionPago->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $consolidacionPago->user->usuario ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>




    <?php
$totalGastosExtras = 0;

if (!empty($consolidacionPago->consolidacion_pago_detalles)) {
    foreach ($consolidacionPago->consolidacion_pago_detalles as $detalle) {
        if (!empty($detalle->consolidacion->detalle_gastos)) {
            $gastosExtras = $detalle->consolidacion->detalle_gastos;
            if (count($gastosExtras) > 0) {
                // Sumar los valores de los gastos
                foreach ($gastosExtras as $gasto) {
                    $totalGastosExtras += isset($gasto['valor']) ? $gasto['valor'] : 0;
                }
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" colspan="2" class="bold">Gastos Extras</th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">Detalle</th>
                    <th align="left" class="bold">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($gastosExtras as $gasto) {
            ?>
                <tr class="border_top">
                    <td align="left"><?= isset($gasto['detalle']) ? $gasto['detalle'] : 'N/A' ?></td>
                    <td align="left">
                        <?= isset($gasto['valor']) ? number_format($gasto['valor'], 2) : '0.00' ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <?php if ($totalGastosExtras > 0): ?>
            <tfoot>
                <tr class="border_top">
                    <th colspan="1" align="right" class="bold">Total de Gastos Extras:</th>
                    <th align="left" class="bold"><?= number_format($totalGastosExtras, 2) ?></th>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
    <?php
            }
        }
    }
}
?>


    <?php
        $num = 1;
        $TOTAL = 0;
        foreach ($consolidacionPago->consolidacion_pago_detalles as $d) {
    ?>
    <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="left" class="bold"></th>
                    <th align="left" class="bold">FECHA</th>
                    <th align="left" class="bold">COMPRA</th>
                    <th align="left" class="bold">LOTE</th>
                    <th align="left" class="bold">PESO NETO</th>
                    <th align="left" class="bold">PRECIO COMPRA</th>
                    <th align="left" class="bold">EFECTIVO TOTAL</th>
                </tr>
                <?php
                    $total_detalle = 0;
                    foreach ($d->consolidacion->detalles as $de) {
                        $total_detalle += $de->precio_compra;
                ?>
                <tr class="border_top">
                    <td align="left" class="">{{ $num }}</td>
                    <td align="left" class="">{{ $de->compra->fecha }}</td>
                    <td align="left" class="">
                        {{ $de->compra->ProveedorCompra->abreviatura }}-{{ $de->compra->nro_compra }}</td>
                    <td align="left" class="">{{ $de->compra->nro }}</td>
                    <td align="left" class="">{{ $de->oficial }}</td>
                    <td align="left" class="">{{ $de->precio }}</td>
                    <td align="left" class="">{{ $de->precio_compra }}</td>
                </tr>
                <?php
                    $num+=1;
                    }
                ?>
                <tr class="border_top">
                    <th align="left" class="" colspan="6"></th>
                    <th align="left" class="bold">Sub Total {{ number_format($total_detalle, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
        $TOTAL += $total_detalle;
        }
    ?>

    <!-- Total Real a Pagar -->
    <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="left" class="bold"> Total Real a Pagar</td>
                    <td align="left" class=""><?= number_format($consolidacionPago->suma_total, 2) ?></td>
                </tr>
                <tr>
                    <th align="left" class="bold"> Total Actual a Pagar</td>
                    <td align="left" class=""><?= number_format($consolidacionPago->valor_compra, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Detalle de Pagos -->
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="10" class="bold"> Detalle de Pagos</th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"> ID PAGO</th>
                    <th align="left" class="bold"> Fecha</th>
                    <th align="left" class="bold"> Monto</th>
                    <th align="left" class="bold"> Banco</th>
                    <th align="left" class="bold"> Forma Pago</th>
                    <th align="left" class="bold"> Observaciones</th>
                    <th align="left" class="bold"> Deuda Real</th>
                    <th align="left" class="bold"> Deuda Actual</th>
                    <th align="left" class="bold"> Pendiente Real</th>
                    <th align="left" class="bold"> Pendiente Actual</th>
                </tr>
                <?php
                $pendienteActual = $consolidacionPago->valor_compra;
                $deudaActual = $consolidacionPago->valor_compra;
                foreach ($consolidacionPago->consolidacion_pago_tickets as $d) {
                    $pendienteActual -= $d->monto;
                    $deudaActual -= $d->deuda;
                ?>
                <tr class="border_top">
                    <td align="left" class="bold">{{ $d->id }}</td>
                    <td align="left" class="bold">{{ $d->created_at->format('Y-m-d') }}</td>
                    <td align="left" class="">{{ number_format($d->monto, 2) }}</td>
                    <td align="left" class="">{{ $d->banco->name }}</td>
                    <td align="left" class="">{{ $d->formapago->name }}</td>
                    <td align="left" class="">{{ $d->observaciones }}</td>
                    <td align="left" class="">{{ number_format($d->deuda, 2) }}</td>
                    <td align="left" class="">{{ number_format($pendienteActual, 2) }}</td>
                    <td align="left" class="">{{ number_format($d->pendiente, 2) }}</td>
                    <td align="left" class="">{{ number_format($pendienteActual, 2) }}</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
