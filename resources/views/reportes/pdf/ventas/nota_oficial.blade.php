<html>
<title>NDD (A4) Nro: {{ $venta->id }}</title>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;

            border-spacing: 0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .white-bg {
            padding: 20px 20px;
        }

        th,
        td {
            border: none;
            padding: 5px;
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

        td.border_left {
            border-right: 1px solid #666
        }


        .border-th {
            border: 2px solid #666
        }

        .border-td {
            border-right: 2px solid #666;
            border-left: 2px solid #666
        }

        .th-cabecera {
            background: #e0e0e0 !important;
            font-weight: bold !important;
        }
    </style>
</head>

<body class="white-bg">

    <div>
        <table>
            <tbody>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <th width="34%" class="th-cabecera" height="0" align="center">
                        <strong><span style="font-size:15px">NOTA (DESPACHO) NDD-{{ $venta->id }}</span></strong>
                        @if($venta->tipo_impresion !== "")
                            <br>
                            <strong>{{ $venta->tipo_impresion }}</strong>
                        @endif
                    </tH>
                    <td width="33%" height="0" align="center">
                        <span style="font-size:12px"><strong>F/H EMISION:</strong> {{ $venta->created_at }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="center">
                        <span style="font-size:12px"><strong>F/H IMPRESION:</strong>{{ date('Y-m-d H:i:s') }}</span>
                    </td>
                </tr>

                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="center">
                        <span style="font-size:12px">USUARIO {{ $venta->user->nombre }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="left">
                        <b>CLIENTE:</b>  {{ $venta->cliente->id }} - {{ $venta->cliente->nombre }}
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="center">
                        <strong>MÉTODO PAGO:</strong>
                        {{ optional($venta->Tipopago)->name
                            ?? optional(optional($venta->Cliente)->Tipopago)->name
                            ?? '—' }}
                    </td>
                </tr>
                <tr>
                    <td width="33%" colspan="2" height="0" align="left">
                        <strong>DIRECCION:</strong> {{ $venta->cliente->direccion }}
                    </td>

                    <td width="33%" height="0" align="center">

                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                </tr>
                <tr>
                    <td height="0" align="center" colspan="3">
                        <table width="100%" height="0" aling="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">COD</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">ITEM</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">CAJAS</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">UNIDAD</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">P. BRUTO</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">TARA</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">P. NETO</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">PRECIO/KG</span></strong>
                                    </th>
                                    <th class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">TOTAL</span></strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
  $cajas_t = 0;
  $pollos_t = 0;
  $peso_bruto_t = 0;
  $peso_neto_t = 0;
  $tara_t = 0;
  $total = 0;
                    foreach ($venta->venta_transformaciones as $de) {
                        $cajas_t += $de->cajas;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += max(0, $de->peso_bruto - $de->peso_neto);
                        $total += $de->total;
                    ?>
                                <tr>

                                    <td align="left" class="bold border-th border_top">SUBTR-{{ $de->subitem_id }}</td>
                                    <td align="left" class="bold border-th border_top">
                                        {{ $de->Subitem->name }}</td>
                                    <td align="left" class="bold border-th border_top">
                                        {{ $de->cajas ? (int) $de->cajas : 0 }}
                                    </td>
                                    <td align="left" class="bold border-th border_top">0</td>

                                    <td align="left" class="bold border-th border_top">
                                        {{ $de->peso_bruto }}
                                    </td>
                                    <td align="left" class="border-th border_top">
                                        {{ sprintf('%0.2f', max(0, $de->peso_bruto - $de->peso_neto)) }}
                                    </td>
                                    <td align="left" class="border-th border_top">{{ $de->peso_neto }}
                                    </td>
                                    <td align="left" class="border-th border_top">
                                        {{ $de->venta }}
                                    </td>
                                    <td align="left" class="border-th border_top">{{ sprintf('%0.2f',  $de->total ) }}</td>

                                </tr>
                                <?php
                    }


                    foreach ($venta->LoteDetalleVentas as $de) {
                        $cajas_t += $de->cajas;
                        $pollos_t += $de->pollos;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;
                        $total += $de->total;
                    ?>
                                <tr>

                                    <td align="left" class="border-th border_top">
                                        C-{{ $de->LoteDetalle->sub_medida_id }}</td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ explode(' -', $de->LoteDetalle->name)[0] }}
                                    </td>
                                    <td align="left" class="border-th border_top" align="center">
                                         {{ $de->cajas ? (int) $de->cajas : 0 }}</td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->pollos }}</td>

                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->peso_bruto }}</td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ sprintf('%0.2f', $de->peso_bruto - $de->peso_neto) }}</td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->peso_neto }}</td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->precio_acuerdo }}
                                    </td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->total }}</td>

                                </tr>
                                <?php
                    }
                    ?>
                                <?php

                    foreach ($venta->venta_detalle_pps as $de) {
                        $cajas_t += $de->cajas;
                        $pollos_t += $de->pollos;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;
                        $precio_sin_descuento = round($de->peso_neto * $de->precio_acuerdo, 1);
                        $precio_sin_descuento = number_format($precio_sin_descuento, 2, '.', ''); 
                        $total += $de->total;

                    ?>
                                <tr>
                                    <td align="left" class="border-th">P-{{ $de->item_id }}</td>
                                    <td align="left" class="border-th" align="center">
                                        {{ $de->tipo_pp == 1 ? 'POLLO COMPLETO' : 'POLLO LIMPIO' }}
                                    </td>
                                    <td align="left" class="border-th " align="center"> {{ $de->cajas ? (int) $de->cajas : 0 }}
                                    </td>
                                    <td align="left" class="border-th " align="center">
                                        {{ sprintf('%0.2f', $de->pollos) }}</td>

                                    <td align="left" class="border-th " align="center">{{ $de->peso_bruto }}
                                    </td>
                                    <td align="left" class="border-th" align="center">
                                        {{ sprintf('%0.2f', $de->peso_bruto - $de->peso_neto) }}</td>
                                    <td align="left" class="border-th" align="center">{{ $de->peso_neto }}</td>
                                    <td align="left" class="border-th" align="center">
                                        {{ $de->precio_acuerdo }}
                                    </td>
                                    <td align="left" class="border-th" align="center">
                                        {{ number_format($precio_sin_descuento, 2) }}</td>

                                </tr>
                                @if ($de->subdetalleDescuentoAcuerdo)
                                    <tr>
                                        <td></td>
                                        <td colspan="5"><b>Descuento:</b>
                                            {{ $de->subdetalleDescuentoAcuerdo->item_nombre ?? '-' }}
                                            ({{ number_format($de->subdetalleDescuentoAcuerdo->peso, 2) ?? '0' }}
                                            x
                                            {{ $de->subdetalleDescuentoAcuerdo->cantidad ?? '0' }}
                                            =
                                            <b class="text-danger">
                                                {{ number_format($de->subdetalleDescuentoAcuerdo->descuento_valor, 2) ?? '0.00' }})
                                            </b>
                                        </td>
                                        <td align="center">
                                            {{ number_format($de->subdetalleDescuentoAcuerdo->peso, 2) ?? '0' }}
                                        </td>
                                        <td align="center">
                                            {{ number_format($de->subdetalleDescuentoAcuerdo->cantidad, 2) ?? '0' }}
                                        </td>
                                        <td align="center">
                                            <span>
                                                -{{ number_format($de->subdetalleDescuentoAcuerdo->descuento_valor, 2) ?? '0.00' }}
                                                = <b>{{ number_format($de->total, 2) }}</b>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                <?php
                    }
                    ?>

                    @if(isset($venta->venta_acuerdos) && $venta->venta_acuerdos->count())
                        @foreach ($venta->venta_acuerdos as $a)
                            <?php
                                $cajas_t      += floatval($a->cajas);
                                $peso_bruto_t += floatval($a->peso_bruto);
                                $peso_neto_t  += floatval($a->peso_neto);
                                $tara_t       += floatval($a->tara);
                                $total        += floatval($a->total);
                            ?>
                            <tr>
                                <td class="border-th border_top" align="center">{{ $a->cod ?? '—' }}</td>
                                <td class="border-th border_top" align="center">{{ $a->item }}</td>
                                <td class="border-th border_top" align="center">{{ $a->cajas }}</td>
                                <td class="border-th border_top" align="center">{{ $a->unidad }}</td>
                                <td class="border-th border_top" align="center">{{ number_format($a->peso_bruto, 2) }}</td>
                                <td class="border-th border_top" align="center">{{ number_format($a->tara, 2) }}</td>
                                <td class="border-th border_top" align="center">{{ number_format($a->peso_neto, 2) }}</td>
                                <td class="border-th border_top" align="center">{{ number_format($a->precio_kg, 2) }}</td>
                                <td class="border-th border_top" align="center">{{ number_format($a->total, 2) }}</td>
                            </tr>
                        @endforeach
                    @endif


                                <?php

                    foreach ($venta->venta_items as $de) {
                        $cajas_t += $de->cajas;

                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;

                        $total += $de->total;
                    ?>
                                <tr>

                                    <td align="left" class="border-th border_top" >PR-{{ $de->item_id }}</td>
                                    <td align="left" class="border-th border_top"  align="center">{{ $de->Item->name }}
                                    </td>
                                    <td align="left" class="border-th border_top" align="center">
                                        {{ $de->cajas ? (int) $de->cajas : 0 }}
                                    </td>
                                    <td align="left" class="border-th border_top"  align="center">
                                        {{ sprintf('%0.2f', 0) }}</td>

                                    <td align="left" class="border-th border_top"  align="center">{{ $de->peso_bruto }}
                                    </td>
                                    <td align="left" class="border-th border_top"  align="center">
                                        {{ sprintf('%0.2f', $de->peso_bruto - $de->peso_neto) }}</td>
                                    <td align="left" class="border-th border_top"  align="center">{{ $de->peso_neto }}</td>
                                    <td align="left" class="border-th border_top"  align="center">
                                        {{ $de->precio }}</td>
                                    <td align="left" class="border-th border_top" align="center"> {{ sprintf('%0.2f',  $de->total) }}</td>

                                </tr>
                                <?php
                    }
                    ?>

                                @if(isset($venta->venta_gastos) && $venta->venta_gastos->count())
                                    <?php $subtotal = $total; ?>
                                    @foreach ($venta->venta_gastos as $g)
                                        <?php
                                            $total -= floatval($g->valor);
                                        ?>
                                        <tr>
                                            <td class="border-th border_top" align="left">GASTO</td>
                                            <td class="border-th border_top" align="left">
                                                {{ $g->detalle }}
                                            </td>
                                            <td class="border-th border_top" align="center">*</td>
                                            <td class="border-th border_top" align="center">*</td>
                                            <td class="border-th border_top" align="center">*</td>
                                            <td class="border-th border_top" align="center">*</td>
                                            <td class="border-th border_top" align="center">*</td>
                                            <td class="border-th border_top" align="center">—</td>
                                            <td class="border-th border_top" align="center">
                                                -{{ number_format($g->valor, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td class="border-th" colspan="8" align="center"><b>SUBTOTAL (sin gastos)</b></td>
                                        <td class="border-th" align="center"><b>{{ number_format($subtotal, 2) }}</b></td>
                                    </tr> --}}
                                @endif
                                <tr>
                                    <td class="border-th" height="0" align="left" colspan="8">
                                        <span style="font-size:9px"></span>
                                    </td>


                                    <td class="border-th" height="0" align="center">
                                        <span style="font-size:9px">{{ sprintf('%0.2f', $total) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-th th-cabecera " height="0" align="center" colspan="2">
                                        <strong><span style="font-size:9px">TOTALES</span></strong>

                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $cajas_t) }}</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $pollos_t) }}</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $peso_bruto_t) }}</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $tara_t) }}</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $peso_neto_t) }}</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span style="font-size:9px">TOTAL</span></strong>
                                    </td>
                                    <td class="border-th th-cabecera" height="0" align="center">
                                        <strong><span
                                                style="font-size:9px">{{ sprintf('%0.2f', $total) }}</span></strong>
                                    </td>
                                </tr>
                                @php
                                    use App\Helpers\NumeroALetras;
                                @endphp
                                <tr>
                                    <td height="0" align="left" colspan="9">
                                        <strong><span style="font-size:9px"> SON:
                                                {{ Str::upper(NumeroALetras::convert($total, 'BOLIVIANOS')) }}</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="0" align="left" colspan="9">
                                        <strong><span style="font-size:9px">OBS:  </span></strong> {{ $venta->observacion ? $venta->observacion : 'SN' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td height="0" align="left" colspan="9">
                                        <strong></strong>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-th th-cabecera" width="50" align="center" colspan="2">
                                        <strong>CAJAS</strong>
                                    </td>
                                    <td class="border-th th-cabecera" width="50" align="center">
                                        <strong>SAL. ANT</strong>
                                    </td>
                                    <td class="border-th th-cabecera" width="60" align="center">
                                        <strong>HOY</strong>
                                    </td>
                                    <td class="border-th th-cabecera" width="50" align="center">
                                        <strong>{{ date('Y-m-d') }}</strong>
                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-th" height="0" align="center" colspan="2">
                                        <span>CAJAS</span>
                                    </td>
                                    <td class="border-th" height="0" align="center">
                                        <span>{{ number_format($venta->cajas_pendientes_saldo_anterior, 0) }}</span>
                                    </td>
                                    <td class="border-th" height="0" align="center">
                                        <span>{{ number_format($venta->cajas_pendientes_venta_hoy, 0) }}</span>
                                    </td>
                                    <td class="border-th" height="0" align="center">
                                        <span>{{ number_format($venta->cajas_venta_saldo_actual, 0) }}</span>
                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" align="left" colspan="9">
                                        <strong></strong>

                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="4">
                                        <strong></strong>
                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                    <td align="left" colspan="4">
                                        <strong></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td align="center" colspan="2">
                                        <strong>_____________________________________</strong>
                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                    <td align="left" colspan="2">
                                        <strong>_____________________________________</strong>
                                    </td>
                                    <td align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td align="center" colspan="2">
                                        RESP. CHOFER: <b>{{ $venta->chofer ? $venta->chofer->nombre : 'NO ASIGNADO' }}</b> </strong>
                                    </td>

                                    <td height="0" align="center">

                                    </td>
                                    <td align="left" colspan="2">
                                        RECIBIDO POR CLIENTE
                                    </td>
                                    <td align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td align="center" colspan="2">

                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                    <td align="left" colspan="2">
                                        NOMBRE:___________________________________
                                    </td>
                                    <td align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td align="center" colspan="2">

                                    </td>
                                    <td height="0" align="center">

                                    </td>
                                    <td align="left" colspan="2">
                                        HORA RECEPCION:___________________________
                                    </td>
                                    <td align="center" colspan="2">

                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="9">
                                        <strong>ESTIMADO CLIENTE LA PRESENTE NOTA DA COMFORMIDAD DE LA ENTREGA DE SU
                                            PEDIDO</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="9">
                                        <strong>GRACIAS POR SU PREFERENCIA!!!</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>
