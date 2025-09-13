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
                    <img src="<?= $sucursal->image->path_url ?>" alt="Sucursal Logo" style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        SEGUIMIENTO DE COMPRAS - POR CLIENTE / LOTE N° <?= $lote->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Compra / Nro compra / Nro Lote:</b>
                        <span style="font-size:14px">
                            <?= $compra->id ?> / {{ $compra->nro_compra }} / {{ $compra->nro }}
                        </span>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de registro: </b><?= $lote->fecha ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <th style="width:33%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">SUCURSAL:</strong>
                    <?= $sucursal->nombre ?>
                </th>
                <td style="width:34%; text-align:left;">
                    <strong>Dirección: </strong><?= $sucursal->direccion ?>
                </td>
                <td style="width:33%; text-align:left;">
                    <strong>Telefono: </strong><?= $sucursal->telefono ?>
                </td>
            </tr>
            <tr>
                <td style="width:33%; text-align:left; background:#f2f2f2;">
                    <strong class="section-title">FECHA DE LA COMPRA:</strong>
                    {{ $compra->fecha }}
                </td>
                <td style="width:34%; text-align:left;">
                    <strong>FECHA DE LA LLEGADA: </strong>{{ $compra->fecha_llegada }}
                </td>
                <td style="width:33%; text-align:left;">
                    <strong>PROVEEDOR: </strong>{{ $compra->ProveedorCompra->abreviatura }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="9"></th>
                    <th align="center" class="bold" colspan="3"><strong>CAJAS</strong></th>
                    <th align="center" class="bold" colspan="3"><strong>UNIDADES</strong></th>
                    <th align="center" class="bold" colspan="3"><strong>KILOGRAMOS</strong></th>
                </tr>
                <tr>
                    <th align="left" class="bold"><strong>N°</strong></th>
                    <th align="left" class="bold"><strong>PRODUCTO</strong></th>
                    <th align="left" class="bold"><strong>PIGMENTO</strong></th>
                    <th align="left" class="bold"><strong>NRO</strong></th>
                    <th align="left" class="bold"><strong>DETALLE</strong></th>
                    <th align="left" class="bold"><strong>P. BRUTO</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>P. NETO</strong></th>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>CONT.S</strong></th>
                    <th align="left" class="bold"><strong>CONT.SA</strong></th>
                    <th align="left" class="bold"><strong>UNID.E</strong></th>
                    <th align="left" class="bold"><strong>UNID.S</strong></th>
                    <th align="left" class="bold"><strong>UNID.SA</strong></th>
                    <th align="left" class="bold"><strong>KGS.E</strong></th>
                    <th align="left" class="bold"><strong>KGS.S</strong></th>
                    <th align="left" class="bold"><strong>KGS.SA</strong></th>
                </tr>
            </thead>
            <tbody>
                {{-- ========================== COMPRAS ========================== --}}
                <tr class="border_top">
                    <th colspan="18" align="left" class="bold"><strong>COMPRAS</strong></th>
                </tr>
                <?php
                    $p_bruto_total = 0;
                    $tara_t = 0;
                    $p_neto_total = 0;
                    $cont_e_t = 0;
                    $cont_s_t = 0;
                    $cont_sa_t = 0;
                    $unit_e_t = 0;
                    $unit_s_t = 0;
                    $unit_sa_t = 0;
                    $kgs_e_t = 0;
                    $kgs_s_t = 0;
                    $kgs_sa_t = 0;

                    foreach ($lote->LoteDetalles()->orderBy('name','asc')->get() as $detalle) {
                        $seguimiento = $detalle->LoteDetalleSeguimientos();
                        $kgs_s = $seguimiento->sum('kgs_s');
                        $unit_s = $seguimiento->sum('unit_s');
                        $cont_s = $seguimiento->sum('cont_s');

                        $tara = $detalle->cajas * 2;

                        $p_bruto_total += $detalle->peso_total;
                        $tara_t += $tara;
                        $p_neto_total += $detalle->peso_total - $tara;

                        $cont_e_t += $detalle->cajas;
                        $unit_e_t += $detalle->equivalente;
                        $kgs_e_t += $detalle->peso_total - $tara;

                        $cont_s_t += $cont_s;
                        $unit_s_t += $unit_s;
                        $kgs_s_t += $kgs_s;

                        $cont_sa_t += $detalle->cajas - $cont_s;
                        $unit_sa_t += $detalle->equivalente - $unit_s;
                        $kgs_sa_t += ($detalle->peso_total - $tara) - $kgs_s;
                ?>
                <tr>
                    <th align="left">{{ $detalle->id }}</th>
                    <td align="left">{{ $detalle->name }}</td>
                    <td align="left">{{ $detalle->pigmento == 1 ? 'SI' : 'NO' }}</td>
                    <td align="left">COMPRA | {{ $compra->nro_compra }}</td>
                    <td align="left">PRODUCCION</td>
                    <td align="left">{{ number_format($detalle->peso_total, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->cajas * 2, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->peso_total - $detalle->cajas * 2, 3, '.', ',') }}
                    </td>
                    <td align="left">{{ $detalle->fecha }}</td>
                    <td align="left">{{ number_format($detalle->cajas, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->cajas, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format(0, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->pollos * $detalle->cajas, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->pollos * $detalle->cajas, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format(0, 3, '.', ',') }}</td>
                    <td align="left">{{ number_format($detalle->peso_total - $detalle->cajas * 2, 3, '.', ',') }}
                    </td>
                    <td align="left">{{ number_format($detalle->peso_total - $detalle->cajas * 2, 3, '.', ',') }}
                    </td>
                    <td align="left">{{ number_format(0, 3, '.', ',') }}</td>
                </tr>
                <?php } // end foreach compras ?>
                <tr class="border_top">
                    <th colspan="5" class="bold" style="text-align:right;">
                        <strong>TOTAL DE COMPRA</strong>
                    </th>

                    <th><strong>{{ number_format($p_bruto_total, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($tara_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($p_neto_total, 3, '.', ',') }}</strong></th>
                    <th></th>
                    <th><strong>{{ number_format($cont_e_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($cont_e_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format(0, 3, '.', ',') }}</strong></th>

                    <th><strong>{{ number_format($unit_e_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($unit_e_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format(0, 3, '.', ',') }}</strong></th>

                    <th><strong>{{ number_format($p_neto_total, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($p_neto_total, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format(0, 3, '.', ',') }}</strong></th>
                </tr>

                {{-- ===================== SEGUIMIENTO POR CLIENTE ===================== --}}
                <?php
                // Totales globales (suma de todos los subtotales por cliente)
                $g_p_bruto_total = 0;
                $g_tara_t = 0;
                $g_p_neto_total = 0;
                $g_cont_e_t = 0;
                $g_cont_s_t = 0;
                $g_cont_sa_t = 0;
                $g_unit_e_t = 0;
                $g_unit_s_t = 0;
                $g_unit_sa_t = 0;
                $g_kgs_e_t = 0;
                $g_kgs_s_t = 0;
                $g_kgs_sa_t = 0;

                ?>

                @foreach ($lote->lote_detalles_cliente as $detalle)
                    <?php
                    // Subtotales por cliente
                    $c_p_bruto_total = 0;
                    $c_tara_t = 0;
                    $c_p_neto_total = 0;
                    $c_cont_e_t = 0;
                    $c_cont_s_t = 0;
                    $c_cont_sa_t = 0;
                    $c_unit_e_t = 0;
                    $c_unit_s_t = 0;
                    $c_unit_sa_t = 0;
                    $c_kgs_e_t = 0;
                    $c_kgs_s_t = 0;
                    $c_kgs_sa_t = 0;
                    ?>
                    <tr class="border_top">
                        <td colspan="18" align="left" class="bold">
                            <strong>{{ strtoupper($detalle['lote_detalle']->nombre) }}</strong>
                        </td>
                    </tr>

                    @foreach ($detalle['detalles'] as $s)
                        <?php
                        // Si está anulado, mostrar todo en 0 y NO acumular valores reales
                        $isAnulado = (int) $s->anulado == 1;

                        $peso_bruto = $isAnulado ? 0 : 0;
                        $tara = $isAnulado ? 0 : 0;
                        $peso_neto = $isAnulado ? 0 : 0;

                        $cont_e = $isAnulado ? 0 : 0;
                        $cont_s = $isAnulado ? 0 : (float) $s->cont_s;
                        $cont_sa = $isAnulado ? 0 : 0;

                        $unit_e = $isAnulado ? 0 : 0;
                        $unit_s = $isAnulado ? 0 : (float) $s->unit_s;
                        $unit_sa = $isAnulado ? 0 : 0;

                        $kgs_e = $isAnulado ? 0 : 0;
                        $kgs_s = $isAnulado ? 0 : (float) $s->kgs_s;
                        $kgs_sa = $isAnulado ? 0 : 0;

                        // Acumular a nivel cliente
                        $c_p_bruto_total += $peso_bruto;
                        $c_tara_t += $tara;
                        $c_p_neto_total += $peso_neto;

                        $c_cont_e_t += $cont_e;
                        $c_cont_s_t += $cont_s;
                        $c_cont_sa_t += $cont_sa;

                        $c_unit_e_t += $unit_e;
                        $c_unit_s_t += $unit_s;
                        $c_unit_sa_t += $unit_sa;

                        $c_kgs_e_t += $kgs_e;
                        $c_kgs_s_t += $kgs_s;
                        $c_kgs_sa_t += $kgs_sa;
                        ?>
                        <tr>
                            <td align="left">{{ $s->id }}</td>
                            <td align="left">{{ $s->LoteDetalle->name }}</td>
                            <td align="left">{{ $s->LoteDetalle->pigmento == 1 ? 'SI' : 'NO' }}</td>
                            <td align="left">{{ $s->nro }}</td>

                            @if ($isAnulado)
                                <td style="color:red" align="left">{{ $s->cliente }} (ANULADO)</td>
                            @else
                                <td align="left">{{ $s->cliente }}</td>
                            @endif

                            <td align="left">{{ number_format($peso_bruto, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($tara, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($peso_neto, 3, '.', ',') }}</td>
                            <td align="left">{{ $s->fecha }}</td>

                            <td align="left">{{ number_format($cont_e, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($cont_s, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($cont_sa, 3, '.', ',') }}</td>

                            <td align="left">{{ number_format($unit_e, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($unit_s, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($unit_sa, 3, '.', ',') }}</td>

                            <td align="left">{{ number_format($kgs_e, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($kgs_s, 3, '.', ',') }}</td>
                            <td align="left">{{ number_format($kgs_sa, 3, '.', ',') }}</td>
                        </tr>
                    @endforeach

                    {{-- Subtotal por cliente --}}
                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">
                            SUBTOTAL {{ strtoupper($detalle['lote_detalle']->nombre) }}</strong>
                        </th>
                        <th class="bold">{{ number_format($c_p_bruto_total, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_tara_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_p_neto_total, 3, '.', ',') }}</th>

                        <th></th>
                        <th class="bold">{{ number_format($c_cont_e_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_cont_s_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_cont_sa_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_unit_e_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_unit_s_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_unit_sa_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_kgs_e_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_kgs_s_t, 3, '.', ',') }}</th>
                        <th class="bold">{{ number_format($c_kgs_sa_t, 3, '.', ',') }}</th>
                    </tr>

                    <?php
                    // Acumular en los totales globales (sumatoria de todos los clientes)
                    $g_p_bruto_total += $c_p_bruto_total;
                    $g_tara_t += $c_tara_t;
                    $g_p_neto_total += $c_p_neto_total;

                    $g_cont_e_t += $c_cont_e_t;
                    $g_cont_s_t += $c_cont_s_t;
                    $g_cont_sa_t += $c_cont_sa_t;

                    $g_unit_e_t += $c_unit_e_t;
                    $g_unit_s_t += $c_unit_s_t;
                    $g_unit_sa_t += $c_unit_sa_t;

                    $g_kgs_e_t += $c_kgs_e_t;
                    $g_kgs_s_t += $c_kgs_s_t;
                    $g_kgs_sa_t += $c_kgs_sa_t;
                    ?>
                @endforeach

                <tr>
                    <td colspan="18"></td>
                </tr>

                {{-- ===================== SUMATORIA DE TOTALES (GENERAL) ===================== --}}
                <tr class="border_top">
                    <th colspan="5" class="bold"><strong>SUMATORIA DE TOTALES</strong></th>
                    <th><strong>{{ number_format($p_bruto_total, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($tara_t, 3, '.', ',') }}</strong></th>
                    <th><strong>{{ number_format($p_neto_total, 3, '.', ',') }}</strong></th>
                    <th></th>
                    <th><strong>{{ number_format($cont_e_t, 3, '.', ',') }}</strong></th>
                    <th class="bold">{{ number_format($g_cont_s_t, 3, '.', ',') }}</th>
                    <th class="bold">{{ number_format($g_cont_sa_t, 3, '.', ',') }}</th>

                    <th><strong>{{ number_format($unit_e_t, 3, '.', ',') }}</strong></th>
                    <th class="bold">{{ number_format($g_unit_s_t, 3, '.', ',') }}</th>
                    <th class="bold">{{ number_format($g_unit_sa_t, 3, '.', ',') }}</th>

                    <th><strong>{{ number_format($p_neto_total, 3, '.', ',') }}</strong></th>
                    <th class="bold">{{ number_format($g_kgs_s_t, 3, '.', ',') }}</th>
                    <th class="bold">{{ number_format($g_kgs_sa_t, 3, '.', ',') }}</th>
                </tr>
                @php
                    $saldo_cajas_ventas    = (float)$cont_e_t     - (float)$g_cont_s_t;
                    $saldo_unidades_ventas = (float)$unit_e_t     - (float)$g_unit_s_t;
                    $saldo_kilos_ventas    = (float)$p_neto_total - (float)$g_kgs_s_t;
                @endphp
                {{-- ===================== CALCULOS / SALDOS / MERMAS ===================== --}}
                <tr class="border_top">
                    <th colspan="5" class="bold"><strong>CALCULOS / SALDOS / MERMAS</strong></th>
                    <td align="left" colspan="6" class="bold"><strong></strong></td>
                    <th align="left" class="bold">
                        <strong>{{ number_format($saldo_cajas_ventas, 3, '.', ',') }}</strong>
                    </th>
                    <td align="left" colspan="2" class="bold"><strong></strong></td>
                    <th align="left" class="bold">
                        <strong>{{ number_format($saldo_unidades_ventas, 3, '.', ',') }}</strong>
                    </th>
                    <td align="left" colspan="2" class="bold"><strong></strong></td>
                    <th align="left" class="bold">
                        <strong>{{ number_format($saldo_kilos_ventas, 3, '.', ',') }}</strong>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    @php
        $pp = collect(data_get($lote, 'reporte_envios_pp', []));
        $pt = collect(data_get($lote, 'reporte_envios_pt', []));

        $pp_cajas    = (float) $pp->sum('cajas');
        $pp_unidades = (float) $pp->sum('pollos');
        $pp_bruto    = (float) $pp->sum('peso_bruto');
        $pp_tara     = (float) $pp->sum('tara');
        $pp_neto     = (float) $pp->sum('peso_neto');

        $pt_cajas    = (float) $pt->sum('cajas');
        $pt_unidades = (float) $pt->sum('pollos');
        $pt_bruto    = (float) $pt->sum('peso_bruto');
        $pt_tara     = (float) $pt->sum('tara');
        $pt_neto     = (float) $pt->sum('peso_neto');

        $env_cajas    = $pp_cajas + $pt_cajas;
        $env_unidades = $pp_unidades + $pt_unidades;
        $env_bruto    = $pp_bruto + $pt_bruto;
        $env_tara     = $pp_tara + $pt_tara;
        $env_neto     = $pp_neto + $pt_neto;

        $saldo_cajas_final    = $saldo_cajas_ventas    - $env_cajas;
        $saldo_unidades_final = $saldo_unidades_ventas - $env_unidades;
        $saldo_kilos_final    = $saldo_kilos_ventas    - $env_neto;
    @endphp

    @if (count($lote->reporte_envios_pp) > 0)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title "><strong>ENVÍOS A
                                PP</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PP</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pp as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>
                        <th><strong>{{ number_format($pp_cajas, 3, '.', ',') }}</strong></th>
                        <th><strong>{{ number_format($pp_unidades, 3, '.', ',') }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pp_bruto) }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pp_tara) }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pp_neto) }}</strong></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
    @if (count($lote->reporte_envios_pt) > 0)

        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title"><strong>ENVÍOS A
                                PT</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PT</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pt as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>

                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>

                        <th><strong>{{ number_format($pt_cajas, 3, '.', ',') }}</strong></th>
                        <th><strong>{{ number_format($pt_unidades, 3, '.', ',') }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pt_bruto) }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pt_tara) }}</strong></th>
                        <th><strong>{{ sprintf('%0.3f', $pt_neto) }}</strong></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    @if (count($lote->reporte_envios_pp) > 0 || count($lote->reporte_envios_pt) > 0)


        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr class="border_top">
                        <th colspan="5" class="bold"><strong>SALDOS GENERALES</strong></th>
                        <th>CAJAS</th>
                        <th>UNIDADES</th>
                        <th>KILOGRAMOS</th>
                    </tr>

                    <tr class="border_top">
                        <th colspan="5" class="bold"><strong>CALCULOS / SALDOS / MERMAS</strong></th>
                        <td align="left" class="bold">
                            <strong>{{ number_format($saldo_cajas_final, 3, '.', ',') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ number_format($saldo_unidades_final, 3, '.', ',') }}</strong>
                        </td>
                        <td align="left" class="bold">
                            <strong>{{ number_format($saldo_kilos_final, 3, '.', ',') }}</strong>
                        </td>
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
