@php
    use App\Helpers\NumeroALetras;
@endphp
<!DOCTYPE html>
<html lang="es">
<title>Ticket de Cobranza: {{ $pagoGlobal->id }}</title>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @page {
            size: 80mm 100mm;
            margin: 10;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        th,
        td {
            padding: 2px;
            font-size: 9px;
            text-align: left;
        }

        .header {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            margin-top: 10px;
        }

        .bold {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .bordered {
            border: 1px solid #000;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
            font-size: 10px;
        }

        .line {
            width: 100%;
            height: 1px;
            background: #000;
            margin: 5px 0;
        }

        .footer-text {
            font-size: 9px;
            margin-top: 5px;
            text-align: center;
        }

        .firma {
            margin-top: 5px;
            text-align: center;
        }

        .cliente-info td {
            font-size: 8px;
        }

        .cliente-info td:first-child {
            width: 50%;
            padding-right: 5px;
        }

        .cliente-info td:last-child {
            width: 50%;
            text-align: right;
        }

        .cliente-info tr td {
            padding: 0 5px;
        }

        .cliente-info tr:nth-child(1) td,
        .cliente-info tr:nth-child(2) td {
            font-size: 9px;
        }

        .cliente-info tr:nth-child(1) td:last-child,
        .cliente-info tr:nth-child(2) td:last-child {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <strong>RECIBO COBRANZA GLOBAL-{{ $pagoGlobal->id }}</strong>
        @if($marca !== "")
            <br>{{ $marca }}
        @endif <br>
        @if($sucursal)
            <strong>SUCURSAL: {{ $sucursal->nombre }}</strong>
        @endif
    </div>

    <div>
        <strong>Fecha de pago:</strong> {{ $pagoGlobal->created_at->format('Y-m-d H:i:s') }}<br>
        <strong>Forma de pago:</strong> {{ $pagoGlobal->formapago->name ?? '' }}<br>
        <strong>Cajero(a):</strong> {{ $pagoGlobal->user->nombre ?? '' }} {{ $pagoGlobal->user->apellidos ?? '' }}
    </div>

    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <th><strong>Venta</strong></th>
                <th><strong>Cliente</strong></th>
                <th><strong>Pagado</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagoGlobal->arqueoVentas as $arqueoVenta)
                <tr>
                    <td>#{{ $arqueoVenta->venta->id ?? '' }}</td>
                    <td>{{ $arqueoVenta->venta->cliente->nombre ?? '' }}</td>
                    <td>{{ number_format($arqueoVenta->monto, 2) }} Bs.</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>
    <div>
        <strong>TOTAL PAGADO: {{ number_format($pagoGlobal->monto_total, 2) }} Bs.</strong>
    </div>
    <div>
        <span style="font-size:9px">
            SON: {{ Str::upper(NumeroALetras::convert($pagoGlobal->monto_total) . ' BOLIVIANOS') }}
        </span>
    </div>
    <div class="firma">
        <br>
        <strong>Firma:</strong> ___________________<br><br>
        <strong>Nombre:</strong> ___________________
    </div>
    <div class="footer">
        <strong>GRACIAS POR SU PREFERENCIA</strong><br>
        <small>Fecha Impresión: {{ date('Y-m-d H:i:s') }}</small>
    </div>
</body>
</html>
