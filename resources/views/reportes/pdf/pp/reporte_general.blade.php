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
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            padding: 3px 0;
        }

        .section-content {
            font-size: 8px;
            padding: 3px 0;
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
                        REPORTE GENERAL - PP &nbsp; N° <?= $pp->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <span style="font-size:14px">
                            <?= $pp->mes ?>
                        </span>
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

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="5" class="bold"><strong>TOTAL INICIAL</strong></th>
                    <th align="center" width="10%" class="bold"><strong>POLLOS</strong></th>
                    <th align="center" width="10%" class="bold"><strong>KN</strong></th>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold">
                        <strong>TRASPASOS</strong>
                    </th>
                    <td align="center" class="bold">{{ $pollos_traspaso }}</td>
                    <td align="center" class="bold">{{ $pesoneto_traspaso }}</td>
                </tr>
                <?php
                $pollos_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('pollos');
                $cajas_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('cajas');
                $cajas_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('cajas');
                $pollos_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('pollos');
                $pesoneto_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('peso_neto');
                $pesobruto_peso_inicial_1 = $pp->DetallePps()->where('peso_inicial_tipo', '1')->sum('peso_bruto');
                $pesoneto_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('peso_neto');
                $pesobruto_peso_inicial_2 = $pp->DetallePps()->where('peso_inicial_tipo', '2')->sum('peso_bruto');
                $tara_peso_inicial_1 = $pesobruto_peso_inicial_1 - $pesoneto_peso_inicial_1;
                $tara_peso_inicial_2 = $pesobruto_peso_inicial_2 - $pesoneto_peso_inicial_2;
                ?>
                <tr>
                    <th align="right" colspan="5" class="bold">
                        <strong>PESO INICIAL 1</strong>
                    </th>
                    <td align="center" class="bold">{{ $pollos_peso_inicial_1 }}</td>
                    <td align="center" class="bold">{{ $pesoneto_peso_inicial_1 }}</td>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold">
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
                    <th align="right" colspan="5" class="bold">
                        <strong>TOTAL SALDO GENERAL</strong>
                    </th>
                    <th align="center"><strong>{{ $pollos_totales }}</strong></th>
                    <th align="center"><strong>{{ $pesoneto_totales }}</strong></th>
                </tr>
            </tbody>
        </table>
    </div>



    @php
        $pollos = 0;
        $kg = 0;
    @endphp
    @foreach ($pp->detalle_pp_venta_list as $grupo)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr class="border_top">
                        <th align="center" colspan="12" class="bold section-title">
                            <strong>{{ $grupo['cinta_cliente']->name }}</strong>
                        </th>
                    </tr>

                    @php
                        $hasTrasp = $grupo['traspasos']->count() > 0;
                        $hasDespl = $grupo['despliegues']->count() > 0;
                        $t_cajas = $t_pollos = $t_peso_bruto = $t_peso_neto = $t_tara = 0;
                        $d_cajas = $d_pollos = $d_peso_bruto = $d_peso_neto = $d_tara = 0;
                    @endphp

                    @if ($hasTrasp)
                        <tr>
                            <th align="center" colspan="12" class="bold"><strong>TRASPASOS</strong></th>
                        </tr>
                        <tr>
                            <th><strong>PP N°</strong></th>
                            <th align="left" class="bold"><strong>CAJAS</strong></th>
                            <th align="left" class="bold"><strong>POLLOS</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>KG/B</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>TARA</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>KG/N</strong></th>
                        </tr>
                        @php
                            $t_cajas = $grupo['traspasos']->sum(fn($t) => optional($t->TraspasoPP)->cajas ?? 0);
                            $t_pollos = $grupo['traspasos']->sum(fn($t) => optional($t->TraspasoPP)->pollos ?? 0);
                            $t_peso_bruto = $grupo['traspasos']->sum(
                                fn($t) => optional($t->TraspasoPP)->peso_bruto ?? 0,
                            );
                            $t_peso_neto = $grupo['traspasos']->sum(fn($t) => optional($t->TraspasoPP)->peso_neto ?? 0);
                            $t_tara = $t_peso_bruto - $t_peso_neto;
                        @endphp

                        @foreach ($grupo['traspasos'] as $traspaso)
                            @php
                                $pp_nro = optional(optional($traspaso->TraspasoPP)->Pp)->nro;
                                $cajas_f = optional($traspaso->TraspasoPP)->cajas ?? 0;
                                $pollos_f = optional($traspaso->TraspasoPP)->pollos ?? 0;
                                $kg_b_f = optional($traspaso->TraspasoPP)->peso_bruto ?? 0;
                                $kg_n_f = optional($traspaso->TraspasoPP)->peso_neto ?? 0;
                                $tara_f = $kg_b_f - $kg_n_f;
                            @endphp
                            <tr class="border_top">
                                <td align="left" class="bold">{{ $pp_nro }}</td>
                                <td align="left" class="bold">{{ $cajas_f }}</td>
                                <td align="left" class="bold">{{ $pollos_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $kg_b_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $tara_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $kg_n_f }}</td>
                            </tr>
                        @endforeach

                        <tr class="border_top">
                            <th align="left"><strong>TOTAL</strong></th>
                            <th><strong>{{ $t_cajas }}</strong></th>
                            <th><strong>{{ $t_pollos }}</strong></th>
                            <th colspan="3"><strong>{{ $t_peso_bruto }}</strong></th>
                            <th colspan="3"><strong>{{ $t_tara }}</strong></th>
                            <th colspan="3"><strong>{{ $t_peso_neto }}</strong></th>
                        </tr>
                    @endif

                    @if ($hasDespl)
                        <tr>
                            <th align="center" colspan="12" class="bold"><strong>DESPLIEGUES</strong></th>
                        </tr>
                        <tr>
                            <th><strong>N°</strong></th>
                            <th align="left" class="bold"><strong>CAJAS</strong></th>
                            <th align="left" class="bold"><strong>POLLOS</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>KG/B</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>TARA</strong></th>
                            <th colspan="3" align="left" class="bold"><strong>KG/N</strong></th>
                        </tr>

                        @php
                            $d_cajas = $grupo['despliegues']->sum('cajas');
                            $d_pollos = $grupo['despliegues']->sum('pollos');
                            $d_peso_bruto = $grupo['despliegues']->sum('peso_bruto');
                            $d_peso_neto = $grupo['despliegues']->sum('peso_neto');
                            $d_tara = $d_peso_bruto - $d_peso_neto;
                        @endphp

                        @foreach ($grupo['despliegues'] as $despliegue)
                            @php
                                $id_f = $despliegue->id;
                                $cj_f = $despliegue->cajas ?? 0;
                                $po_f = $despliegue->pollos ?? 0;
                                $kb_f = $despliegue->peso_bruto ?? 0;
                                $kn_f = $despliegue->peso_neto ?? 0;
                                $ta_f = $kb_f - $kn_f;
                            @endphp
                            <tr class="border_top">
                                <td align="left" class="bold">{{ $id_f }}</td>
                                <td align="left" class="bold">{{ $cj_f }}</td>
                                <td align="left" class="bold">{{ $po_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $kb_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $ta_f }}</td>
                                <td colspan="3" align="left" class="bold">{{ $kn_f }}</td>
                            </tr>
                        @endforeach

                        <tr class="border_top">
                            <th><strong>TOTAL</strong></th>
                            <th><strong>{{ $d_cajas }}</strong></th>
                            <th><strong>{{ $d_pollos }}</strong></th>
                            <th colspan="3"><strong>{{ $d_peso_bruto }}</strong></th>
                            <th colspan="3"><strong>{{ $d_tara }}</strong></th>
                            <th colspan="3"><strong>{{ $d_peso_neto }}</strong></th>
                        </tr>
                    @endif
                    @if ($hasTrasp && $hasDespl)
                        @php
                            $c_cajas = $t_cajas + $d_cajas;
                            $c_pollos = $t_pollos + $d_pollos;
                            $c_peso_bruto = $t_peso_bruto + $d_peso_bruto;
                            $c_peso_neto = $t_peso_neto + $d_peso_neto;
                            $c_tara = $c_peso_bruto - $c_peso_neto;
                        @endphp
                        <tr class="border_top">
                            <th align="left"><strong>TOTAL GRUPO</strong></th>
                            <th><strong>{{ $c_cajas }}</strong></th>
                            <th><strong>{{ $c_pollos }}</strong></th>
                            <th colspan="3"><strong>{{ $c_peso_bruto }}</strong></th>
                            <th colspan="3"><strong>{{ $c_tara }}</strong></th>
                            <th colspan="3"><strong>{{ $c_peso_neto }}</strong></th>
                        </tr>
                    @endif


                    <tr class="border_top">
                        <th align="center" colspan="12" class="bold">
                            <strong> VENTAS DE {{ $grupo['cinta_cliente']->name }}</strong>
                        </th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>NDD</strong></th>
                        <th align="left" class="bold"><strong>FECHA HORA</strong></th>
                        <th align="left" class="bold"><strong>CLIENTE</strong></th>
                        <th align="left" class="bold"><strong>GRUPO</strong></th>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th align="left" class="bold"><strong>POLLOS</strong></th>
                        <th align="left" class="bold"><strong>KG/B</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/N</strong></th>
                        <th align="left" class="bold"><strong>TIPO</strong></th>
                        <th align="left" class="bold"><strong>P. VENTA</strong></th>
                        <th align="left" class="bold"><strong>SUBTOTAL</strong></th>
                    </tr>
                    @foreach ($grupo['detalle'] as $detalle)
                        <tr class="border_top">
                            <td>{{ $detalle['venta_id'] }}</td>
                            <td>{{ $detalle['fecha'] }} {{ $detalle['hora'] }}</td>
                            <td>{{ $detalle['cliente']['nombre'] }}
                                @if ($detalle['estado'] == 0)
                                    <span style="color:red">(ANULADO)</span>
                                @endif
                            </td>
                            <td>{{ $grupo['cinta_cliente']->name }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['cajas'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['pollos'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['peso_bruto'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? floatval($detalle['peso_bruto'] - $detalle['peso_neto']) : 0 }}
                            </td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['peso_neto'] : 0 }}</td>
                            <td>
                                {{ $detalle['estado'] == 1 ? ($detalle['tipo_pp'] == 0 ? 'P. LIMPIO' : 'P. COMP.') : 0 }}
                            </td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['precio_acuerdo'] : 0 }}</td>
                            <td>{{ $detalle['estado'] == 1 ? $detalle['total'] : 0 }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="center" colspan="4">
                            <strong>TOTAL VENTAS</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->where('estado', 1)->sum('cajas') }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->where('estado', 1)->sum('pollos') }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->where('estado', 1)->sum('peso_bruto') }}</strong>
                        </th>
                        <th>
                            <strong>{{ floatval($grupo['detalle']->where('estado', 1)->sum('peso_bruto') - $grupo['detalle']->where('estado', 1)->sum('peso_neto')) }}</strong>
                        </th>
                        <th>
                            <strong>{{ $grupo['detalle']->where('estado', 1)->sum('peso_neto') }}</strong>
                        </th>
                        <th></th>
                        <th></th>
                        <th>
                            <strong>{{ $grupo['detalle']->where('estado', 1)->sum('total') }}</strong>
                        </th>
                    </tr>
                    {{-- <tr class="border_top">
                        <th align="center" colspan="12" class="bold"><strong>TOTAL VENTAS</strong></th>
                    </tr>
                    <tr>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    @php
                        $activos = $grupo['detalle']->where('estado', 1);
                    @endphp
                    <tr class="border_top">
                        <td>{{ $activos->sum('cajas') }}</td>
                        <td colspan="2">{{ $activos->sum('pollos') }}</td>
                        <td colspan="3">{{ $activos->sum('peso_bruto') }}</td>
                        <td colspan="3">{{ floatval($activos->sum('peso_bruto') - $activos->sum('peso_neto')) }}
                        </td>
                        <td colspan="3">{{ $activos->sum('peso_neto') }}</td>
                    </tr> --}}

                    @php
                        $pollos += $grupo['detalle']->sum('pollos');
                        $kg += $grupo['detalle']->sum('peso_bruto');
                    @endphp
                    <tr class="border_top">
                        <th align="center" colspan="12" class="bold"><strong>SOBRAS ENVIADAS</strong></th>
                    </tr>
                    <tr>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    @php
                        $s_pollos = 0;
                        $s_cajas = 0;
                        $s_peso_bruto = 0;
                        $s_peso_neto = 0;
                        $s_tara = 0;
                    @endphp
                    @foreach ($grupo['sobras'] as $traspaso)
                        @php
                            $s_cajas += $traspaso->cajas;
                            $s_pollos += $traspaso->pollos;
                            $s_peso_bruto += $traspaso->peso_bruto;
                            $s_peso_neto += $traspaso->peso_neto;
                            $s_tara += $traspaso->peso_bruto - $traspaso->peso_neto;
                        @endphp
                        <tr class="border_top">


                            <td align="left" class="bold">{{ $traspaso->cajas }}</td>
                            <td colspan="2" align="left" class="bold">{{ $traspaso->pollos }}</td>

                            <td colspan="3" align="left" class="bold">{{ $traspaso->peso_bruto }}</td>
                            <td colspan="3" align="left" class="bold">
                                {{ floatval($traspaso->peso_bruto - $traspaso->peso_neto) }}</td>
                            <td colspan="3" align="left" class="bold">{{ $traspaso->peso_neto }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="center" colspan="12" class="bold"><strong>TOTAL VENTAS +
                                SOBRAS ENVIADAS</strong></th>
                    </tr>
                    <tr>
                        <th align="left" class="bold"><strong>CAJAS</strong></th>
                        <th colspan="2" align="left" class="bold"><strong>POLLOS</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/B</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>TARA</strong></th>
                        <th colspan="3" align="left" class="bold"><strong>KG/N</strong></th>
                    </tr>
                    @php
                        $activos = $grupo['detalle']->where('estado', 1);
                    @endphp
                    <tr class="border_top">
                        <td><strong>{{ $activos->sum('cajas') + $s_cajas }}</strong></td>
                        <td colspan="2"><strong>{{ $activos->sum('pollos') + $s_pollos }}</strong></td>
                        <td colspan="3"><strong>{{ $activos->sum('peso_bruto') + $s_peso_bruto }}</strong></td>
                        <td colspan="3">
                            <strong>{{ floatval($activos->sum('peso_bruto') - $activos->sum('peso_neto') + $s_tara) }}</strong>
                        </td>
                        <td colspan="3"><strong>{{ $activos->sum('peso_neto') + $s_peso_neto }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
    <?php
    $cajas_traspaso_general = 0;
    $peso_bruto_traspaso_general = 0;
    $tara_traspaso_general = 0;
    $peso_neto_traspaso_general = 0;
    ?>
    @php
        $sobras = $pp->SobraPps->sortBy('nro_traspaso');
        $primero = $sobras->first();
        $resto = $sobras->slice(1);
    @endphp

    @if ($primero)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="8">TRASPASO Nro {{ $primero->nro_traspaso }} (MENUDENCIAS)
                        </th>
                    </tr>
                    <tr class="border_top">
                        <th>ITEM</th>
                        <th>CJ</th>
                        <th>KG/B</th>
                        <th>TARA</th>
                        <th>KG/N</th>
                        <th>DETALLE</th>
                        <th>USUARIO</th>
                        <th>FECHA</th>
                    </tr>
                    @php
                        $cajas_traspaso = 0;
                        $peso_bruto_traspaso = 0;
                        $tara_traspaso = 0;
                        $peso_neto_traspaso = 0;
                    @endphp
                    @foreach ($primero->SobraDetallePps as $sd)
                        @php
                            $cajas_traspaso += $sd->cajas;
                            $peso_bruto_traspaso += $sd->peso_bruto;
                            $tara_traspaso += $sd->taras;
                            $peso_neto_traspaso += $sd->peso_neto;
                        @endphp
                        <tr class="border_top">
                            <td>{{ $sd->Item->name }}</td>
                            <td>{{ $sd->cajas }}</td>
                            <td>{{ $sd->peso_bruto }}</td>
                            <td>{{ $sd->taras }}</td>
                            <td>{{ $sd->peso_neto }}</td>
                            @if ($sd->SobraPP->PtSobraPp && $sd->SobraPP->PtSobraPp->Pt)
                                <td>Traspaso a PT <strong>{{ $sd->SobraPP->PtSobraPp->Pt->nro }}</strong></td>
                            @else
                                <td style="color:red">NO ACEPTADO AÚN</td>
                            @endif
                            <td>{{ $sd->User->nombre }}</td>
                            <td>{{ $sd->fecha_hora }}</td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th><strong>TOTALES</strong></th>
                        <th><strong>{{ $cajas_traspaso }}</strong></th>
                        <th><strong>{{ $peso_bruto_traspaso }}</strong></th>
                        <th><strong>{{ $tara_traspaso }}</strong></th>
                        <th><strong>{{ $peso_neto_traspaso }}</strong></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    @if ($resto->isNotEmpty())
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="8">TRASPASO Nro 2 (MENUDENCIAS)</th>
                    </tr>
                    <tr class="border_top">
                        <th>ITEM</th>
                        <th>CJ</th>
                        <th>KG/B</h>
                        <th>TARA</th>
                        <th>KG/N</th>
                        <th>DETALLE</th>
                        <th>USUARIO</th>
                        <th>FECHA</th>
                    </tr>
                    @php
                        $cj_acum = 0;
                        $kb_acum = 0;
                        $ta_acum = 0;
                        $kn_acum = 0;
                    @endphp

                    @foreach ($resto as $d)
                        @foreach ($d->SobraDetallePps as $sd)
                            @php
                                $cj_acum += $sd->cajas;
                                $kb_acum += $sd->peso_bruto;
                                $ta_acum += $sd->taras;
                                $kn_acum += $sd->peso_neto;
                            @endphp
                            <tr class="border_top">
                                <td>{{ $sd->Item->name }}</td>
                                <td>{{ $sd->cajas }}</td>
                                <td>{{ $sd->peso_bruto }}</td>
                                <td>{{ $sd->taras }}</td>
                                <td>{{ $sd->peso_neto }}</td>
                                @if ($sd->SobraPP->PtSobraPp && $sd->SobraPP->PtSobraPp->Pt)
                                    <td>Traspaso a PT <strong>{{ $sd->SobraPP->PtSobraPp->Pt->nro }}</strong></td>
                                @else
                                    <td style="color:red">NO ACEPTADO AÚN</td>
                                @endif
                                <td>{{ $sd->User->nombre }}</td>
                                <td>{{ $sd->fecha_hora }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr class="border_top">
                        <th><strong>TOTALES</strong></th>
                        <th><strong>{{ $cj_acum }}</strong></th>
                        <th><strong>{{ $kb_acum }}</strong></th>
                        <th><strong>{{ $ta_acum }}</strong></th>
                        <th><strong>{{ $kn_acum }}</strong></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    <?php
    $peso_menudencia_traspaso_1 = 0;
    $peso_menudencia_traspaso_2 = 0;
    ?>
    @foreach ($pp->SobraPps as $d)
        @foreach ($d->SobraDetallePps as $sd)
            <?php
            if ($d->nro_traspaso == 1) {
                $peso_menudencia_traspaso_1 += $sd->peso_neto;
            } else {
                $peso_menudencia_traspaso_2 += $sd->peso_neto;
            }
            ?>
        @endforeach
    @endforeach

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="3" class="bold"><strong>VENTAS</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>GRUPO</strong></th>
                    <th align="left" class="bold"><strong>UNIT</strong></th>
                    <th align="left" class="bold"><strong>K/N</strong></th>
                </tr>
                <?php
                $pollos = 0;
                $peso_neto = 0;
                ?>
                @foreach ($pp->detalle_pp_venta_list as $i)
                    <tr class="border_top">
                        <td>{{ $i['cinta_cliente']['name'] }}</td>
                        <td>{{ intval($i['pollos']) }}</td>
                        <td>{{ $i['peso_neto'] }}</td>
                        <?php
                        $pollos += (int) $i['pollos'];
                        $peso_neto += $i['peso_neto'];
                        ?>
                    </tr>
                @endforeach
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TOTAL</strong></th>
                    <th align="left" class="bold"><strong>{{ $pollos }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $peso_neto }}</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TRASPASO Nro 1 (MENUDENCIAS)</strong></th>

                    <td align="left" class="bold"><strong>0</strong></td>
                    <td align="left" class="bold"><strong>{{ $peso_menudencia_traspaso_1 }}</strong></td>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>SOBRANTE POLLO</strong></th>
                    <td align="left" class="bold"><strong>{{ $pp->sobrante_units }}</strong></td>
                    <td align="left" class="bold"><strong>{{ $pp->sobrante_kn }}</strong></td>
                </tr>
                {{-- <tr class="border_top">
                    <th align="left" class="bold"><strong>OBSERVACIONES</strong></th>
                    <td align="left" class="bold"><strong>0</strong></td>
                    <td align="left" class="bold"><strong>0</strong></td>
                </tr> --}}
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TRASPASO Nro 2 (MENUDENCIAS)</strong></th>

                    <td align="left" class="bold"><strong>0</strong></td>
                    <td align="left" class="bold"><strong>{{ $peso_menudencia_traspaso_2 }}</strong></td>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold" colspan="3"></td>
                </tr>
                <?php
                $pollos_x_unit = $pollos + $pp->sobrante_units;
                $kn_x_unit = $peso_neto + $pp->sobrante_kn + $peso_menudencia_traspaso_1 + $peso_menudencia_traspaso_2;
                ?>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>TOTALES</strong></th>
                    <th align="left" class="bold"><strong>{{ $pollos_x_unit }}</strong></th>
                    <th align="left" class="bold"><strong>{{ $kn_x_unit }}</strong></th>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="3" class="bold"><strong>INFORME FINAL</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong></strong></th>
                    <th align="left" class="bold"><strong>UNIT</strong></th>
                    <th align="left" class="bold"><strong>K/N</strong></th>
                </tr>


                <tr class="border_top">
                    <th align="left" class="bold">TOTALES INICIAL</th>
                    <td align="left" class="bold">{{ $pollos_totales }}</td>
                    <td align="left" class="bold">{{ $pesoneto_totales }}</td>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">TOTALES POS VENTA + SOBRANTES ENVIADOS</th>
                    <td align="left" class="bold">{{ $pollos_x_unit }}</td>
                    <td align="left" class="bold">{{ $kn_x_unit }}</td>
                </tr>
                <tr class="border_top">
                    <td colspan="3"></td>
                </tr>
                <?php
                $unidades_restantes = $pollos_totales - $pollos_x_unit;
                $merma = $pesoneto_totales - $kn_x_unit;
                ?>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>MERMA</strong></th>
                    <th align="right" class="bold"><strong>{{ $unidades_restantes }}</strong></th>
                    <th align="right" class="bold"><strong>{{ $merma }}</strong></th>
                </tr>
                <tr class="border_top">
                    <td colspan="3"></td>
                </tr>
                {{-- <tr class="border_top">
                    <th align="left" class="bold"><strong>PROMEDIO POR POLLO</strong></th>
                    <td align="right" class="bold" colspan="2">
                        <strong>{{ round(($merma == 0 ? 1 : $merma) / ($pollos_x_unit == 0 ? 1 : $pollos_x_unit), 3) }}</strong>
                    </td>
                </tr>
                <tr class="border_top">
                    <td colspan="3"></td>
                </tr> --}}
                <tr class="border_top">
                    <th align="left" class="bold"><strong>MERMA POR POLLO</strong></th>
                    <th align="left" class="bold"><strong>UNIDAD DE POLLOS</strong></th>
                    <th align="left" class="bold"><strong>MERMA ACEPTABLE</strong></th>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold"><strong>
                            <?php
                            $merma_promedio = $pp->promedioMerma;
                            ?>
                            {{ $merma_promedio }}
                        </strong></td>
                    <td align="left" class="bold"><strong>
                            {{ $pollos_totales }}
                        </strong></td>
                    <td align="left" class="bold"><strong>
                            <?php
                            $merma_pollos_promedio = $pollos_totales * $merma_promedio;
                            ?>
                            {{ $merma_pollos_promedio }}
                        </strong></td>
                </tr>
                <tr class="border_top">
                    <td colspan="3"></td>
                </tr>
                {{-- <tr class="border_top">
                    <th align="left" class="bold"><strong>MERMA DEL DIA</strong></th>
                    <td align="left" class="bold"><strong></strong></td>
                    <td align="left" class="bold"><strong></strong></td>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold"><strong>{{ $merma }}</strong></td>
                    <td align="left" class="bold"><strong></strong></td>
                    <td align="left" class="bold"><strong></strong></td>
                </tr>
                <tr class="border_top">
                    <td colspan="3"></td>
                </tr> --}}
                @php
                    $saldo = $merma - $merma_pollos_promedio;
                @endphp

                <tr class="border_top">
                    <th align="left" class="bold"><strong>SALDO A FAVOR</strong></th>
                    <th align="left" class="bold"><strong>POLLOS SOBRANTES</strong></th>
                    <th align="left" class="bold"><strong>SALDO FALTANTE</strong></th>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold" style="color:green">
                        <strong>{{ $saldo < 0 ? abs($saldo) : 0 }}</strong>
                    </td>
                    <td align="left" class="bold">
                        <strong>{{ $unidades_restantes }}</strong>
                    </td>
                    <td align="left" class="bold" style="color:red">
                        <strong>{{ $saldo > 0 ? $saldo : 0 }}</strong>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>


    {{-- <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="8" class="bold"><strong>REPORTE DE TRASPASO</strong></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>RECEPCION</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>GRUPO</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNIDADES</strong></th>
                    <th align="left" class="bold"><strong>KG/BT</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/NT</strong></th>
                </tr>
                @foreach ($pp->reporte_traspasos_pps as $detalle)
                    @php
                        $detalle = (object) $detalle;
                    @endphp
                    <tr class="border_top">
                        <td align="left">PP {{ $detalle->pp->nro }}</td>
                        <td align="left">{{ $detalle->User->nombre }}</td>
                        <td align="left">{{ $detalle->cinta_cliente->name }}</td>
                        <td align="left">{{ $detalle->cajas }}</td>
                        <td align="left">{{ $detalle->pollos }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                        <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>
                    </tr>
                @endforeach
                <tr class="border_top">
                    <th align="right" class="bold" colspan="3"> <strong>TOTAL TRASPASOS</strong></th>

                    <th align="left" class="bold">
                        {{ $pp->reporte_traspasos_pps->sum('cajas') }}
                    </th>
                    <th align="left" class="bold">
                        {{ $pp->reporte_traspasos_pps->sum('pollos') }}
                    </th>
                    <th align="left" class="bold">
                        {{ sprintf('%0.3f', $pp->reporte_traspasos_pps->sum('peso_bruto')) }}
                    </th>
                    <th align="left" class="bold">
                        {{ sprintf('%0.3f', $pp->reporte_traspasos_pps->sum('tara')) }}
                    </th>
                    <th align="left" class="bold">
                        {{ sprintf('%0.3f', $pp->reporte_traspasos_pps->sum('peso_neto')) }}
                    </th>

                </tr>
                @php
                    $cajas_traspasos = $pp->reporte_traspasos_pps->sum('cajas');
                    $pollos_traspaso = $pp->reporte_traspasos_pps->sum('pollos');
                    $kg_traspaso = $pp->reporte_traspasos_pps->sum('peso_bruto');
                    $tara_traspaso = $pp->reporte_traspasos_pps->sum('tara');
                    $kg_neto_traspaso = $pp->reporte_traspasos_pps->sum('peso_neto');
                @endphp
                <tr class="border_top">
                    <th align="right" class="bold" colspan="3">
                        <strong>
                            PESO INICIAL 1
                        </strong>
                    </th>
                    <td>{{ $cajas_peso_inicial_1 }}</td>
                    <td>{{ $pollos_peso_inicial_1 }}</td>
                    <td>{{ $pesobruto_peso_inicial_1 }}</td>
                    <td>{{ $tara_peso_inicial_1 }}</td>
                    <td>{{ $pesoneto_peso_inicial_1 }}</td>

                </tr>
                <tr class="border_top">
                    <th align="right" class="bold" colspan="3">
                        <strong>
                            PESO INICIAL 2
                        </strong>
                    </th>
                    <td>{{ $cajas_peso_inicial_2 }}</td>
                    <td>{{ $pollos_peso_inicial_2 }}</td>
                    <td>{{ $pesobruto_peso_inicial_2 }}</td>
                    <td>{{ $tara_peso_inicial_2 }}</td>
                    <td>{{ $pesoneto_peso_inicial_2 }}</td>
                </tr>
                @php
                    $totales_cajas = $cajas_traspaso + $cajas_peso_inicial_1 + $cajas_peso_inicial_2;
                    $totales_pollos = $pollos_traspaso + $pollos_peso_inicial_1 + $pollos_peso_inicial_2;
                    $totales_kg = $kg_traspaso + $pesobruto_peso_inicial_1 + $pesobruto_peso_inicial_2;
                    $totales_tara = $tara_traspaso + $tara_peso_inicial_1 + $tara_peso_inicial_2;
                    $totales_kg_neto = $kg_neto_traspaso + $pesoneto_peso_inicial_1 + $pesoneto_peso_inicial_2;
                @endphp
                <tr class="border_top">
                    <th align="right" class="bold" colspan="3">
                        <strong>
                            TOTALES
                        </strong>
                    </th>
                    <th><strong>{{ $totales_cajas }}</strong></th>
                    <th><strong>{{ $totales_pollos }}</strong></th>
                    <th><strong>{{ $totales_kg }}</strong></th>
                    <th><strong>{{ $totales_tara }}</strong></th>
                    <th><strong>{{ $totales_kg_neto }}</strong></th>
                </tr>
            </tbody>
        </table>
    </div> --}}


    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
