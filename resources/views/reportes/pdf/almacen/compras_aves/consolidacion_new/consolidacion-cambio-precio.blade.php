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
                @if (isset($consolidacion->sucursal->image->path_url))
                    <img src="<?= $consolidacion->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                        style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        CONSOLIDACION - N° <?= $consolidacion->id ?>
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
                                    <?= $consolidacion->sucursal->nombre ?>
                                </th>
                                <td style="width:34%; text-align:left;">
                                    <strong>Dirección: </strong><?= $consolidacion->sucursal->direccion ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Telefono: </strong><?= $consolidacion->sucursal->telefono ?>
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
                                    <strong>Nombre:</strong> <?= $consolidacion->user->nombre ?>
                                    <?= $consolidacion->user->apellidos ?>
                                </td>
                                <td style="width:33%; text-align:left;">
                                    <strong>Usuario:</strong> <?= $consolidacion->user->usuario ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <!-- Detalle de Gastos -->
    @php
        $mostrar_columnas_extras = collect($consolidacion->gastos)->contains(function ($g) {
            return in_array(strtolower($g['tipo']), ['transporte']);
        });
        $total_gastos = 0;
    @endphp

    @if (!empty($consolidacion->gastos) && count($consolidacion->gastos) > 0)
        <div class="tabla_borde">
            <table width="100%" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="{{ $mostrar_columnas_extras ? 9 : 5 }}" align="center" class="bold">
                            DETALLE DE GASTOS EXTRAS
                        </th>
                    </tr>
                    <tr class="border_top">
                        <th align="left">Tipo</th>
                        <th align="left">Detalle</th>
                        @if ($mostrar_columnas_extras)
                            <th align="left">Boleta</th>
                        @endif
                        <th align="right">Cant/KG/Ave</th>
                        <th align="right">Costo</th>

                        @if ($mostrar_columnas_extras)
                            <th align="right">Muertos</th>
                            <th align="right">Faltan</th>
                            <th align="right">A favor</th>
                        @endif

                        <th align="right">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consolidacion->gastos as $gasto)
                        @php
                            $total_gastos += $gasto['valor'];
                            $tipo = ucfirst($gasto['tipo'] ?? '');
                            $detalle = $gasto['detalle'] ?? '';
                            $boleta = $gasto['nro_boleta'] ?? '';
                            $cantidad = $gasto['cantidad'] ?? '';
                            $costo = $gasto['costo'] ?? '';
                            $muertos = $gasto['muertos'] ?? '';
                            $faltan = $gasto['faltan'] ?? '';
                            $a_favor = $gasto['a_favor'] ?? '';
                            $valor = $gasto['valor'] ?? '';
                        @endphp
                        <tr>
                            <td>{{ $tipo }}</td>
                            <td>{{ $detalle }}</td>
                            @if ($mostrar_columnas_extras)
                                <td>{{ $boleta }}</td>
                            @endif
                            <td align="right">{{ is_numeric($cantidad) ? number_format($cantidad, 2) : '' }}</td>
                            <td align="right">{{ is_numeric($costo) ? number_format($costo, 2) : '' }}</td>

                            @if ($mostrar_columnas_extras)
                                <td align="right">{{ is_numeric($muertos) ? $muertos : '' }}</td>
                                <td align="right">{{ is_numeric($faltan) ? $faltan : '' }}</td>
                                <td align="right">{{ is_numeric($a_favor) ? $a_favor : '' }}</td>
                            @endif

                            <td align="right">{{ number_format($valor, 2) }}</td>
                        </tr>
                    @endforeach

                    <tr class="border_top">
                        <td colspan="{{ $mostrar_columnas_extras ? 8 : 4 }}" align="right"
                            style="font-weight: bold; background: #f2f2f2;">
                            TOTAL EN GASTOS
                        </td>
                        <td align="right" style="font-weight: bold; background: #f2f2f2;">
                            {{ number_format($total_gastos, 2) }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    @endif

    @php
        $total_aves_muertas_gastos = collect($consolidacion->gastos)->sum('muertos');
        $total_aves_muertas = $consolidacion->valor_por_ave_muerta * $total_aves_muertas_gastos;
    @endphp

    @if ($total_aves_muertas > 0)
        <div class="tabla_borde">
            <table width="100%" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th colspan="3" class="bold text-align-center">CUENTAS POR COBRAR</th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" style="width:33%; text-align:left; background:#f2f2f2;" class="bold">
                            total Aves Muertas</th>
                        <th align="left" style="width:33%; text-align:left; background:#f2f2f2;" class="bold">
                            Precio </th>
                        <th align="center" style="width:33%; text-align:left; background:#f2f2f2;" class="bold">
                            Total Bs.</th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class=""><strong>{{ $total_aves_muertas_gastos }}</strong></td>
                        <td align="left" class="">{{ $consolidacion->valor_por_ave_muerta }}</td>
                        <td align="left" class="">{{ number_format($total_aves_muertas, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    <!-- Detalles de Compra -->
    <?php
    foreach ($consolidacion->detalles as $d) {
    ?>
    <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="4" class="bold"> Lote:
                        {{ $d->consolidacionDetalle->nro_lote }} | Fecha de cambio de precio: {{ $d->fecha_cambio }}
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">Precio Anterior</th>
                    <th align="left" class="bold">Precio Actual</th>
                    <th align="left" class="bold">Usuario</th>
                    <th align="left" class="bold">Nro Cambio</th>
                </tr>
                <tr class="border_top">
                    <td align="left" class="">{{ $d->precio_anterior }}</td>
                    <td align="left" class="">{{ $d->precio_actual }}</td>
                    <td align="left" class="">{{ $d->user->nombre }}</td>
                    <td align="left" class="">{{ $d->nro_cambio }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
