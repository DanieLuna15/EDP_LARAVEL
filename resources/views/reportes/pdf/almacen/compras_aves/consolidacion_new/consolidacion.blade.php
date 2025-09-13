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

    <!-- Detalles de Compra -->
    @foreach ($consolidacion->detalles as $d)
        <div class="tabla_borde">
            <table width="100%" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th colspan="9" align="center" class="bold">
                            COMPRA: {{ $d['proveedor'] }} |
                            LOTE NRO: {{ $d['nro_lote'] }} | Fecha: {{ $d['fecha'] }}
                        </th>
                    </tr>
                    {{-- Cabecera primera fila (9 columnas) --}}
                    <tr class="border_top">
                        <th align="left" class="bold">Peso inicial (BRUTO)</th>
                        <th align="left" class="bold">Tara</th>
                        <th align="left" class="bold">Peso Total (NETO)</th>
                        <th align="left" class="bold">Cant. Jaulas</th>
                        <th align="left" class="bold">Ajuste</th>
                        <th align="left" class="bold">Nuevo Peso</th>
                        <th align="left" class="bold">Criterio</th>
                        <th align="left" class="bold">Nuevo Peso</th>
                        <th align="left" class="bold">Nuevo Ajuste</th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class=""><?= $d['peso_bruto'] ?></td>
                        <td align="left" class=""><?= $d['tara'] ?></td>
                        <td align="left" class=""><?= $d['suma_total'] ?></td>
                        <td align="left" class=""><?= $d['cantidad_jaulas'] ?></td>
                        <td align="left" class=""> <?= $d['ajuste'] ?></td>
                        <td align="left" class=""><?= $d['nuevo_peso'] ?></td>
                        <td align="left" class=""> <?= $d['criterio'] ?></td>
                        <td align="left" class=""> <?= $d['nuevo_peso_2'] ?></td>
                        <td align="left" class=""> <?= $d['nuevoajuste'] ?></td>
                    </tr>
                    {{-- Cabecera segunda fila (8 columnas) --}}
                    <tr class="border_top">
                        <th align="left" class="bold">Peso Oficial</th>
                        <th align="left" class="bold">Precio KG</th>
                        <th align="left" class="bold">Valor Total</th>
                        <th align="left" class="bold">T. Aves</th>
                        <th align="left" class="bold">Peso x Ave</th>
                        <th align="left" class="bold">KG TOTAL</th>
                        <th align="left" class="bold">KG CRITERIO</th>
                        <th align="left" colspan="2" class="bold">KG TOTAL</th>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class=""> <?= $d['oficial'] ?></td>
                        <td align="left" class=""> <?= $d['precio'] ?></td>
                        <td align="left" class=""> <strong> <?= $d['precio_compra'] ?> </strong></td>
                        <td align="left" class=""> <?= $d['pollos'] ?></td>
                        <td align="left" class="">
                            <?php
                            if (!empty($d['suma_total']) && !empty($d['pollos']) && $d['pollos'] != 0) {
                                echo number_format($d['suma_total'] / $d['pollos'], 2);
                            } else {
                                echo 0;
                            }
                            ?>
                        </td>
                        <td align="left" class=""> <?= $d['kg_total'] ?></td>
                        <td align="left" class=""> <?= $d['kg_criterio'] ?></td>
                        <td align="left" class="" colspan="2"> <?= $d['kg_criterio_total'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach


    <!-- Totales -->
    @php
        $total_gastos = 0;
        if (!empty($consolidacion->gastos) && count($consolidacion->gastos) > 0) {
            foreach ($consolidacion->gastos as $gasto) {
                $total_gastos += $gasto['valor'];
            }
        }
        $total_precio_compra = $consolidacion->detalles->sum('precio_compra');
        $valor_total_final = $total_gastos + $total_precio_compra;
    @endphp

    <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="7" class="bold text-align-center">TOTALES</th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">Peso Total </th>
                    <th align="left" class="bold">Aves Total </th>
                    <th align="left" class="bold">KG Total </th>
                    <th align="left" class="bold">KG Criterio </th>
                    <th align="left" class="bold">KG Criterio Total </th>
                    <th align="center" class="bold">Total
                        de Gastos</th>
                    <th align="center" class="bold">Valor Total Final</th>
                </tr>
                <tr class="border_top">
                    <td align="left" class="">
                        <?= $consolidacion->detalles->sum('suma_total') ?></td>
                    <td align="left" class=""> <?= $consolidacion->detalles->sum('pollos') ?>
                    </td>
                    <td align="left" class="">
                        <?= $consolidacion->detalles->sum('kg_total') ?></td>
                    <td align="left" class="">
                        <?= $consolidacion->detalles->sum('kg_criterio') ?></td>
                    <td align="left" class="">
                        <?= $consolidacion->detalles->sum('kg_criterio_total') ?></td>
                    <td align="center">{{ number_format($total_gastos, 2) }}</td>
                    <td align="left" class="">
                        {{ number_format($valor_total_final, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
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

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>

</body>

</html>
