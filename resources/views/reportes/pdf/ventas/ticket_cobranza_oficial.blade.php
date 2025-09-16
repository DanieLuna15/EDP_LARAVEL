@php
    use App\Helpers\NumeroALetras;
@endphp
<!DOCTYPE html>
<html lang="es">
<title>Ticket de Cobranza: {{ $arqueoVenta->id }}</title>

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
        <strong>RECIBO COBRANZA - {{ $arqueoVenta->id }}</strong>
        @if($marca !== "")
            <br>{{ $marca }}
        @endif <br>
        <strong>SUCURSAL: {{ $venta->sucursal->nombre }}</strong>
    </div>

    <table class="cliente-info">
        <tr>
            <td><strong>Pedido/Venta N°:</strong></td>
            <td>{{ $venta->id }}</td>
        </tr>
        <tr>
            <td><strong>Fecha Pedido/Venta:</strong></td>
            <td>{{ date('Y-m-d') }}</td>
        </tr>
        <tr>
            <td><strong>Cliente:</strong></td>
            <td>{{ $venta->cliente->nombre }}</td>
        </tr>
        <tr>
            <td><strong>NIT:</strong></td>
            <td>{{ $venta->cliente->nit }}</td>
        </tr>
        <tr>
            <td><strong>CI:</strong></td>
            <td>{{ $venta->cliente->ci }}</td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong></td>
            <td>{{ $venta->cliente->direccion }}</td>
        </tr>
        <tr>
            <td><strong>Tel/Celular:</strong></td>
            <td>{{ $venta->cliente->telefono }}</td>
        </tr>
    </table>

    <div class="line"></div>

    @if (in_array($venta->metodo_pago, [2, 3, 4]))
        <table class="cliente-info">
            <tr>
                <td><strong>Detalles de {{ optional($venta->Tipopago)->name
                            ?? optional(optional($venta->Cliente)->Tipopago)->name
                            ?? '—' }}:</strong></td>
                <td> <strong>Forma de Pago: </strong>{{ $arqueoVenta->formapago->name }}</td>
            </tr>
        </table>
        <table class="bordered">
            <tr>
                <th>Saldo Anterior</th>
                <th>Pago Recibido</th>
                <th>Cambio</th>
                <th>Saldo Actual</th>
            </tr>
            <tr>
                <td>{{ number_format($arqueoVenta->monto, 2) }}</td>
                <td>{{ number_format($arqueoVenta->pago_con, 2) }} Bs.</td>
                <td>{{ number_format($arqueoVenta->cambio, 2) }} Bs.</td>
                <td>{{ number_format(max($arqueoVenta->monto - $arqueoVenta->pago_con, 0), 2) }}</td>
            </tr>
        </table>
    @elseif($venta->metodo_pago == 1)
        <table class="cliente-info">
            <tr>
                <td><strong>Detalles al {{ optional($venta->Tipopago)->name
                            ?? optional(optional($venta->Cliente)->Tipopago)->name
                            ?? '—' }}:</strong></td>
                <td> <strong>Forma de Pago: </strong>{{ $arqueoVenta->formapago->name }}</td>
            </tr>
        </table>
        <table class="bordered">
            <tr>
                <th><strong>Monto Total:</strong></th>
                <th><strong>Monto Recibido:</strong></th>
                <th><strong>Cambio:</strong></th>
            </tr>
            <tr>
                <td>{{ number_format($arqueoVenta->monto, 2) }} Bs.</td>
                <td>{{ number_format($arqueoVenta->pago_con, 2) }} Bs.</td>
                <td>{{ number_format($arqueoVenta->cambio, 2) }} Bs.</td>
            </tr>
        </table>
    @endif
    <strong>Fecha y hora de pago: </strong>{{ $arqueoVenta->created_at->format('Y-m-d H:i:s') }}
    <div class="line"></div>

    <div class="total-row">
        <strong><span style="font-size:9px"> SON:
                {{ Str::upper(NumeroALetras::convert($arqueoVenta->monto) . ' BOLIVIANOS') }}</span></strong>
    </div>

    <div class="line"></div>

    <div class="footer-text">
        <strong>OBSERVACIONES:</strong> {{ $venta->observacion }}
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
