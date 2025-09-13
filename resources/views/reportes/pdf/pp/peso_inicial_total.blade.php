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

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .no-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body class="white-bg">

    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                        style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        PESO INICIAL TOTAL - PP &nbsp; N° <?= $pp->nro ?>
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
                        <strong>SUCURSAL:</strong>
                        <?= $sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @php
        $trs = $pp->PpTraspasoPps;
        $cajas_traspaso = $trs->sum(fn($i) => optional($i->traspasoPP)->cajas ?? 0);
        $pollos_traspaso = $trs->sum(fn($i) => optional($i->traspasoPP)->pollos ?? 0);
        $peso_bruto_traspaso = $trs->sum(fn($i) => optional($i->traspasoPP)->peso_bruto ?? 0);
        $pesoneto_traspaso = $trs->sum(fn($i) => optional($i->traspasoPP)->peso_neto ?? 0);
    @endphp

    @if ($trs->isNotEmpty())
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="8" class="bold"><strong>TRASPASOS</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PP N°</strong></th>
                        <th align="left" class="bold"><strong>DESCRIPCION</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>PESO BRUTO</strong></th>
                        <th align="left" class="bold"><strong>PESO NETO</strong></th>
                        <th align="left" class="bold"><strong>USUARIO</strong></th>
                        <th align="left" class="bold"><strong>FECHA</strong></th>
                    </tr>

                    @foreach ($trs as $i)
                        <tr class="border_top">
                            <td>{{ optional(optional($i->traspasoPP)->Pp)->nro }}</td>
                            <td>{{ optional($i->traspasoPP)->name }}</td>
                            <td>{{ optional($i->traspasoPP)->cajas }}</td>
                            <td>{{ optional($i->traspasoPP)->pollos }}</td>
                            <td>{{ optional($i->traspasoPP)->peso_bruto }}</td>
                            <td>{{ optional($i->traspasoPP)->peso_neto }}</td>
                            <td>{{ optional($i->User)->nombre }}</td>
                            <td>{{ $i->fecha_hora }}</td>
                        </tr>
                    @endforeach

                    <tr class="border_top">
                        <th align="left" class="bold" colspan="2"></th>
                        <th align="left" class="bold"><strong>{{ $cajas_traspaso }}</strong></th>
                        <th align="left" class="bold"><strong>{{ $pollos_traspaso }}</strong></th>
                        <th align="left" class="bold"><strong>{{ $peso_bruto_traspaso }}</strong></th>
                        <th align="left" class="bold"><strong>{{ $pesoneto_traspaso }}</strong></th>
                        <th align="left" class="bold"></th>
                        <th align="left" class="bold"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <thead>
                    <tr>
                        <th align="left" class="bold border_right"><strong>FECHA</strong></th>
                        <th align="left" class="bold border_right"><strong>USUARIO</strong></th>
                        <th align="left" class="bold border_right"><strong>P.INICIAL</strong></th>
                        <th align="left" class="bold border_right"><strong>LOTE</strong></th>
                        <th align="left" class="bold border_right"><strong>DETALLE</strong></th>
                        <th align="left" class="bold border_right"><strong>CAJAS</strong></th>
                        <th align="left" class="bold border_right"><strong>POLLOS</strong></th>
                        <th align="left" class="bold border_right"><strong>KG/B</strong></th>
                        <th align="left" class="bold border_right"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                </thead>
                <?php

                    foreach ($pp->DetallePps as $de) {

                    ?>
                <tr class="border_top">
                    <td align="left" class="bold">{{ $de->fecha }} {{ $de->hora }}</td>
                    <td align="left" class="bold">{{ $de->User->nombre }}</td>
                    <td align="left" class="bold">{{ $de->peso_inicial_tipo }}</td>
                    <td align="left" class="bold">
                        {{ $de->LoteDetalle->Lote->Compra->ProveedorCompra->abreviatura }}-{{ $de->LoteDetalle->Lote->Compra->nro }}
                    </td>
                    <td align="left" class="bold">{{ $de->LoteDetalle->name }}</td>
                    <td align="left" class="bold">{{ $de->cajas }}</td>
                    <td align="left" class="bold">{{ $de->pollos }}</td>
                    <td align="left" class="bold">{{ $de->peso_bruto }}</td>
                    <td align="left" class="bold">{{ $de->peso_bruto - $de->peso_neto }}</td>
                    <td align="left" class="bold">{{ $de->peso_neto }}</td>
                </tr>
                <?php
                    }
                    ?>
                <tr class="border_top">
                    <th align="left" class="bold" colspan="5"></th>
                    <th align="left" class="bold"><strong>{{ $pp->DetallePps()->sum('cajas') }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $pp->DetallePps()->sum('pollos') }}</strong>
                    </th>
                    <th align="left" class="bold"><strong>{{ $pp->DetallePps()->sum('peso_bruto') }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ $pp->DetallePps()->sum('peso_bruto') - $pp->DetallePps()->sum('peso_neto') }}</strong>
                    </th>
                    <th align="left" class="bold"><strong>{{ $pp->DetallePps()->sum('peso_neto') }}</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="8" class="bold"><strong>RESUMEN / REPORTE DE INGRESO DE
                            LOTES</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>LOTE</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>CINTA</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNIDADES</strong></th>
                    <th align="left" class="bold"><strong>KG/BT</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/NT</strong></th>
                </tr>
                @foreach ($pp->reporte_ingresos_lotes as $detalle)
                    @php
                        $detalle = (object) $detalle;
                    @endphp
                    <tr class="border_top">
                        <td align="left">{{ $detalle->lote }}</td>
                        <td align="left">{{ $detalle->user->nombre }}</td>
                        <td align="left">{{ $detalle->cinta }}</td>
                        <td align="left">{{ $detalle->cajas }}</td>
                        <td align="left">{{ $detalle->pollos }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>
                    </tr>
                @endforeach
                <tr class="border_top">
                    <th align="right" class="bold" colspan="3"> <strong>TOTAL</strong></th>

                    <th align="left" class="bold">
                        <strong>{{ $pp->reporte_ingresos_lotes->sum('cajas') }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ $pp->reporte_ingresos_lotes->sum('pollos') }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pp->reporte_ingresos_lotes->sum('peso_bruto')) }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pp->reporte_ingresos_lotes->sum('tara')) }}</strong>
                    </th>
                    <th align="left" class="bold">
                        <strong>{{ sprintf('%0.3f', $pp->reporte_ingresos_lotes->sum('peso_neto')) }}</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="5" class="bold border_right border_bottom"><strong>TOTAL
                                INICIAL</strong></th>
                        <th align="center" width="10%" class="bold border_right border_bottom">
                            <strong>POLLOS</strong>
                        </th>
                        <th align="center" width="10%" class="bold border_bottom"><strong>KN</strong></th>
                    </tr>
                    <tr>
                        <th align="right" colspan="5" class="bold border_right border_bottom">
                            <strong>TRASPASOS</strong>
                        </th>
                        <td align="center" class="bold">{{ $pollos_traspaso }}</td>
                        <td align="center" class="bold">{{ $pesoneto_traspaso }}</td>
                    </tr>
                    <?php
                    $pollos_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('pollos');
                    $pollos_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('pollos');
                    $pesoneto_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('peso_neto');
                    $pesoneto_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('peso_neto');
                    ?>
                    <tr>
                        <th align="right" colspan="5" class="bold border_right border_bottom">
                            <strong>PESO INICIAL 1</strong>
                        </th>
                        <td align="center" class="bold">{{ $pollos_peso_inicial_1 }}</td>
                        <td align="center" class="bold">{{ $pesoneto_peso_inicial_1 }}</td>
                    </tr>
                    <tr>
                        <th align="right" colspan="5" class="bold border_right border_bottom">
                            <strong>PESO INICIAL 2</strong>
                        </th>
                        <td align="center" class="bold">{{ $pollos_peso_inicial_2 }}</td>
                        <td align="center" class="bold">{{ $pesoneto_peso_inicial_2 }}</td>
                    </tr>
                    <?php
                    $pollos_totales = $pollos_traspaso + $pollos_peso_inicial_1 + $pollos_peso_inicial_2;
                    $pesoneto_totales = $pesoneto_traspaso + $pesoneto_peso_inicial_1 + $pesoneto_peso_inicial_2;
                    ?>
                    <tr class="border_top">
                        <th align="right" colspan="5" class="bold ">
                            <strong>TOTAL</strong>
                        </th>
                        <th align="center"><strong>{{ $pollos_totales }}</strong></th>
                        <th align="center"><strong>{{ $pesoneto_totales }}</strong></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
