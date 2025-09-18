<!DOCTYPE html>
<html>
<title>NDD (8mm) Nro: {{ $venta->id }}</title>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @page {
            size: 80mm 150mm;
            margin: 10;
        }

        html,
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        body {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th,
        td {
            padding: 2px 3px;
            font-size: 8px;
        }

        th {
            border-bottom: 1px solid #000;
            font-weight: bold;
        }

        .line {
            border-top: 1px solid #000;
            margin: 5px 0;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div align="center">
        <strong style="font-size:12px">NOTA (DESPACHO) NDD-{{ $venta->id }}</strong>
                        @if($venta->tipo_impresion !== "")
                            <br>
                            <strong>{{ $venta->tipo_impresion }}</strong>
                        @endif
    </div>
    <div align="left">
        <strong>CAJERO: </strong>{{ $venta->user->nombre }}</span><br>
        <strong>F/H EMISION: </strong><span> {{ $venta->created_at }}</span><br>
        <strong>F/H IMPRESION: </strong><span>{{ date('Y-m-d H:i:s') }}</span><br>
    </div>
    <div class="line"></div>
    <strong>CI: </strong> {{ $venta->cliente->doc ?? $venta->cliente->id }}<br>
    <strong>Nombre: </strong> {{ $venta->cliente->nombre }}<br>
    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <th style="border:1px solid #000;">CAJAS - DETALLE</th>
                <th style="border:1px solid #000;" align="right">P.BRUTO</th>
                <th style="border:1px solid #000;" align="right">P.NETO</th>
                <th style="border:1px solid #000;" align="right">Precio/Kg</th>
                <th style="border:1px solid #000;" align="right">IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            @php $grand = 0; @endphp

            @foreach ($venta->venta_transformaciones as $de)
                <tr>
                    <td style="border:1px solid #000;">{{ number_format($de->cajas, 0) }} - {{ strtoupper($de->Subitem->name) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_bruto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_neto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->Subitem->venta, 2) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->total, 2) }}</td>
                </tr>
                @php $grand += $de->total; @endphp
            @endforeach

            @foreach ($venta->lote_detalle_ventas as $de)
                <tr>
                    <td style="border:1px solid #000;">{{ number_format($de->cajas, 0) }} - {{ strtoupper($de->LoteDetalle->name) }}
                    </td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_bruto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_neto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->precio_acuerdo, 2) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->total, 2) }}</td>
                </tr>
                @php $grand += $de->total; @endphp
            @endforeach

            @foreach ($venta->venta_detalle_pps as $de)
                <tr>
                    <td style="border:1px solid #000;">
                        {{ number_format($de->cajas, 0) }} - {{ $de->tipo_pp == 1 ? 'P. COMPLETO' : 'P. LIMPIO' }}
                    </td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_bruto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_neto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->precio_acuerdo, 2) }}</td>
                    <td style="border:1px solid #000;" align="right">
                        {{ number_format($precio_sin_descuento, 2) }}
                    </td>
                </tr>
                @if ($de->subdetalleDescuentoAcuerdo)
                    <tr>
                        <td style="border:1px solid #000;" colspan="2">
                            <strong>Desc:</strong>
                            {{ $de->subdetalleDescuentoAcuerdo->item_nombre ?? '-' }}
                            ({{ number_format($de->subdetalleDescuentoAcuerdo->peso, 2) ?? '0' }} x
                            {{ $de->subdetalleDescuentoAcuerdo->cantidad ?? '0' }} =
                            <b class="text-danger">
                                {{ number_format($de->subdetalleDescuentoAcuerdo->descuento_valor, 2) ?? '0.00' }}
                            </b>)
                        </td>
                        <td style="border:1px solid #000;" align="right">
                            {{ number_format($de->subdetalleDescuentoAcuerdo->peso, 2) ?? '0' }}</td>
                        <td style="border:1px solid #000;" align="right">
                            {{ number_format($de->subdetalleDescuentoAcuerdo->cantidad, 2) ?? '0' }}</td>
                        <td style="border:1px solid #000;" align="right">
                            -{{ number_format($de->subdetalleDescuentoAcuerdo->descuento_valor, 2) ?? '0.00' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000;" colspan="4">
                            <strong>Total:</strong>
                        </td>
                        <td style="border:1px solid #000;" align="right">
                            <b>{{ number_format($de->total, 2) ?? '0.00' }}</b>
                        </td>
                    </tr>
                @endif

                @php $grand += $de->total; @endphp
            @endforeach

            @foreach ($venta->venta_items as $de)
                <tr>
                    <td style="border:1px solid #000;">{{ number_format($de->cajas, 0) }} - {{$de->Item->name}}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_bruto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->peso_neto, 3) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->Item->venta, 2) }}</td>
                    <td style="border:1px solid #000;" align="right">{{ number_format($de->total, 2) }}</td>
                </tr>
                @php $grand += $de->total; @endphp
            @endforeach

            <tr class="line">
                <td colspan="5"></td>
            </tr>

            <tr>
                <td colspan="2" align="left" class="total">TOTAL A PAGAR: Bs.{{ number_format($grand, 2) }}</td>
            </tr>

            <tr style="display: none">
                <td colspan="5">A cuenta: Bs.{{ number_format($venta->monto_pago ?? 0, 2) }}</td>
            </tr>

            <tr style="display: none">
                <td colspan="5" class="total">SALDO: Bs.{{ number_format($grand - ($venta->monto_pago ?? 0), 2) }}
                </td>
            </tr>
        </tbody>
    </table>
    @php
        use App\Helpers\NumeroALetras;
    @endphp
    SON: {{ Str::upper(NumeroALetras::convert($grand, 'BOLIVIANOS')) }}
    <div class="line"></div>
    <div align="center"><strong>Gracias por su preferencia</strong></div>
</body>

</html>
