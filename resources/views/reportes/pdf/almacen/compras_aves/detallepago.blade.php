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

    <!-- Header Section -->
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($consolidacion->compra->sucursal->image->path_url))
                    <img src="<?= $consolidacion->compra->sucursal->image->path_url ?>" alt="Sucursal Logo"
                        style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        DETALLE A PAGAR - N° <?= $consolidacion->id ?>
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
                                    <?= $consolidacion->compra->sucursal->nombre ?>
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong>Dirección: </strong><?= $consolidacion->compra->sucursal->direccion ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Telefono: </strong><?= $consolidacion->compra->sucursal->telefono ?>
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
                                    <strong>Nombre:</strong> <?= $consolidacion->compra->user->nombre ?>
                                    <?= $consolidacion->compra->user->apellidos ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Usuario:</strong> <?= $consolidacion->compra->user->usuario ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- Transport Info -->
    {{-- <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="3" class="section-title">DATOS DE LA COMPRA</th>
                </tr>
                <tr>
                    <td><strong>Chofer:</strong> <?= $consolidacion->compra->chofer ?></td>
                    <td><strong>Camion:</strong> <?= $consolidacion->compra->camion ?></td>
                    <td><strong>Placa:</strong> <?= $consolidacion->compra->placa ?></td>
                </tr>
                <tr>
                    <td><strong>E. Despacho:</strong> <?= $consolidacion->compra->e_despacho ?></td>
                    <td><strong>E. Recepcion:</strong> <?= $consolidacion->compra->e_recepcion ?></td>
                    <td><strong>Proveedor:</strong> <?= $consolidacion->compra->ProveedorCompra->abreviatura ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha Salida:</strong> <?= $consolidacion->compra->fecha_salida ?></td>
                    <td colspan="2"><strong>Fecha Llegada:</strong> <?= $consolidacion->compra->fecha_llegada ?></td>
                </tr>
            </tbody>
        </table>
    </div> --}}

    @if (!empty($consolidacion->gastos) && count($consolidacion->gastos) > 0)
        <div class="tabla_borde">
            <table width="100%" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th colspan="2" align="center" class="bold">DETALLE DE GASTOS</th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold">Detalle</th>
                        <th align="left" class="bold">Valor</th>
                    </tr>
                    @php $total_gastos = 0; @endphp
                    @foreach ($consolidacion->gastos as $gasto)
                        @php $total_gastos += $gasto['valor']; @endphp
                        <tr>
                            <td align="left">{{ $gasto['detalle'] }}</td>
                            <td align="left">{{ $gasto['valor'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold">TOTAL DE GASTOS</th>
                        <th align="left" class="bold">{{ $total_gastos }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    @php
        $total_gastos = 0;
        $total_detalle = 0;
        if (!empty($consolidacion->gastos) && count($consolidacion->gastos) > 0) {
            foreach ($consolidacion->gastos as $gasto) {
                $total_gastos += $gasto['valor'];
            }
        }
        foreach ($consolidacion->detalles as $de) {
            $total_detalle += $de->precio_compra;
        }
        $total_final = $total_gastos + $total_detalle;
    @endphp

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
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
                @php
                    $num = 1;
                @endphp
                @foreach ($consolidacion->detalles as $de)
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
                    @php
                        $num += 1;
                    @endphp
                @endforeach
                <tr class="border_top">
                    <th align="left" class="" colspan="6"></th>
                    <th align="left" class="bold">VALOR TOTAL: {{ number_format($total_final, 2) }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
</body>

</html>
