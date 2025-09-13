@php
    use App\Helpers\NumeroALetras;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cierre de Caja #{{ $arqueo->id }}</title>
    <style>
        @page {
            size: 80mm 150mm;
            margin: 10;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .header,
        .footer {
            text-align: center;
            font-weight: bold;
        }

        .footer small {
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
        }

        th,
        td {
            padding: 0 2px;
            font-size: 9px;
        }

        .line {
            width: 100%;
            border-top: 1px solid #000;
            margin: 3px 0;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .section-title {
            font-size: 9px;
            font-weight: bold;
            margin: 2px 0;
        }

        .small {
            font-size: 8px;
        }

        .text-right {
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="header">
        CIERRE DE CAJA #{{ $arqueo->id }}<br>
        <small>SUCURSAL: {{ $sucursal->nombre ?? '-' }}</small>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td class="text-right">{{ $arqueo->fecha }}</td>
        </tr>
        <tr>
            <td><strong>Usuario:</strong></td>
            <td class="text-right">{{ $arqueo->user->nombre ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Monto Inicial:</strong></td>
            <td class="text-right">{{ number_format($arqueo->monto_inicial, 2) }} Bs</td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="line"></div>
            </td>
        </tr>
        <tr>
            <td><strong>Ingresos:</strong></td>
            <td class="text-right">{{ number_format($arqueo->total_ingresos, 2) }} Bs</td>
        </tr>
        <tr>
            <td><strong>Egresos:</strong></td>
            <td class="text-right">-{{ number_format($arqueo->total_egresos, 2) }} Bs</td>
        </tr>
        <tr>
            <td><strong>Ventas:</strong></td>
            <td class="text-right">{{ number_format($arqueo->total_ventas, 2) }} Bs</td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="line"></div>
            </td>
        </tr>
        <tr>
            <td><strong>TOTAL:</strong></td>
            <td class="total-row">{{ number_format($arqueo->total_calculado, 2) }} Bs</td>
        </tr>
    </table>


    <div class="line"></div>
    @if ($formasPagoTotales->isNotEmpty())
        <table>
            @foreach ($formasPagoTotales as $fp)
                <tr>
                    <td>{{ $fp['nombre'] }}</td>
                    <td class="text-right">{{ number_format($fp['total'], 2) }} Bs</td>
                </tr>
            @endforeach
        </table>
        <div class="line"></div>
    @endif



    {{-- Detalle de billetaje --}}
    @if (!empty($billetaje['detalle']))
        <div class="section-title">DETALLE DE BILLETES / MONEDAS</div>
        <table>
            @foreach ($billetaje['detalle'] as $item)
                <tr>
                    <td>{{ $item['descripcion'] }} ({{ number_format($item['valor'], 2) }} x {{ $item['cantidad'] }})
                    </td>
                    <td class="text-right">{{ number_format($item['subtotal'], 2) }} Bs</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td>Total Billetaje:</td>
                <td class="text-right">{{ number_format($billetaje['total'], 2) }} Bs</td>
            </tr>
        </table>
        <div class="line"></div>
    @endif



    <div class="section-title">SON:
        {{ Str::upper(NumeroALetras::convert($arqueo->total_calculado ?? 0)) }} BOLIVIANOS
    </div>

    @if (!empty($arqueo->observaciones))
        <div class="section-title">OBSERVACIÓN:</div>
        <div class="small">{{ $arqueo->observaciones }}</div>
    @endif

    <div class="footer">
        <small>Fecha de Impresión: {{ now()->format('Y-m-d H:i:s') }}</small>
    </div>

</body>

</html>
