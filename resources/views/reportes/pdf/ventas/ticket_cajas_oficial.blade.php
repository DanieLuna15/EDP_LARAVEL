<!DOCTYPE html>
<html lang="es">
<title>Ticket de Cajas: {{ $venta->id }}</title>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @page {
            size: 80mm 100mm;
            margin: 10;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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
            padding: 3px;
            font-size: 10px;
            text-align: left;
        }

        .header,
        .footer {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .bordered {
            border: 1px solid #000;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .obs {
            margin-top: 10px;
            font-size: 10px;
        }

        .underline {
            text-decoration: underline;
        }

        .date-style {
            font-size: 10px;
            font-weight: normal;
            text-align: right;
        }

        .saldo-style {
            text-align: center;
            margin-top: 10px;
        }

        .line {
            width: 100%;
            height: 1px;
            background: #000;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <strong>RECIBO DE CAJAS</strong>
        @if($marca !== "")
            <br>{{ $marca }}
        @endif <br>
        <div class="line"></div>
        {{ $venta->sucursal->nombre }}<br>
        USUARIO: {{ $venta->user->nombre }}
    </div>

    <table>
        <tr>
            <td><strong>CLIENTE:</strong></td>
            <td style="text-align: right;">{{ $venta->cliente->nombre }}</td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong></td>
            <td style="text-align: right;">{{ $venta->cliente->direccion }}</td>
        </tr>
        <tr>
            <td><strong>Pedido N°:</strong></td>
            <td style="text-align: right;">{{ $venta->id }}</td>
        </tr>
        <tr>
            <td><strong>Fecha y hora de entrega: </strong></td>
            <td style="text-align: right;">{{ $entregaCaja->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>

    <table class="bordered">
        <tr>
            <th>Saldo Ant.</th>
            <th>Devoluciones</th>
            <th>Saldo Act.</th>
            <th>A/F</th>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $entregaCaja->saldo_anterior }}</td>
            <td style="text-align: center;">
                {{ $entregaCaja->cajas + ($entregaCajaRecuperada ? $entregaCajaRecuperada->cajas : 0) }}
            </td>
            <td style="text-align: center;">{{ $entregaCaja->saldo_actual }}</td>
            <td style="text-align: center;">
                {{ $entregaCajaRecuperada ? $entregaCajaRecuperada->cajas : 0 }}
            </td>
        </tr>
    </table>

    <div class="obs">
        <strong>OBS:</strong> {{ $venta->observacion }}
    </div>

    <div class="footer">
        <br><br>
        <strong>Firma:</strong> ___________________

        <br> <br>
        <strong>GRACIAS POR SU PREFERENCIA</strong>
        <br>
        <small>Fecha Impresión: {{ date('Y-m-d H:i:s') }}</small>
    </div>

</body>

</html>
