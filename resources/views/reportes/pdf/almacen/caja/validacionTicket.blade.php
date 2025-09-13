<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>TACO N° {{ $validarCaja->id }}</title>
    <style type="text/css">
        @page {
            size: 76mm auto;
            margin: 0;
        }

        html,
        body {
            margin: 0;
            margin-top: 5px;
            padding: 0;
            width: 76mm;
            font-family: sans-serif;
            font-size: 8px;
        }

        body {
            padding: 1mm 2mm 1mm 2mm;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .line {
            border-top: 1px solid #000;
            margin: 2mm 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }

        th,
        td {
            padding: 1mm 1mm;
            border: 1px solid #000;
            word-wrap: break-word;
            white-space: normal;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
            width: 33%;
            font-size: 7px;
            line-height: 1.1;
        }

        td {
            font-size: 7px;
        }

        .no-border td {
            border: none;
            padding-top: 3;
            padding-bottom: 0;
            margin: 0;
            font-size: 7px;
        }

        .signature {
            margin-top: 4mm;
        }

        .signature div {
            display: inline-block;
            width: 38%;
            text-align: center;
            margin-right: 4%;
        }

        .signature .label {
            display: block;
            margin-top: 10mm;
            border-top: 1px solid #000;
        }

        .footer {
            font-size: 6px;
            margin-top: 2mm;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="center">
        <strong style="font-size:9px"> TACO </strong> N° {{ $validarCaja->id }}<br>
    </div>
    <div class="line"></div>
    <!-- Datos generales -->
    <table class="no-border">
        <tr>
            <td>Fecha:</td>
            <td class="right">{{ $validarCaja->fecha }}</td>
        </tr>
        <tr>
            <td>Sucursal:</td>
            <td class="right">{{ $validarCaja->compra->sucursal->nombre }}</td>
        </tr>
        <tr>
            <td>Responsable:</td>
            <td class="right">{{ $validarCaja->compra->sucursal->responsable }}</td>
        </tr>
        <tr>
            <td>Chofer:</td>
            <td class="right">{{ $validarCaja->chofer }}</td>
        </tr>
        <tr>
            <td>Placa:</td>
            <td class="right">{{ $validarCaja->placa }}</td>
        </tr>
    </table>
    <div class="line"></div>

    <!-- Detalle de cajas -->
    <table>
        <thead>
            <tr>
                <th>Stock Inicial<br>{{ $validarCaja->origen->name }}</th>
                <th>Salida a<br>{{ $validarCaja->destino->name }}</th>
                <th>Saldo <br>{{ $validarCaja->origen->name }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($validarCaja->detalles as $d)
                <tr>
                    <td class="center">{{ intval($d->stock) }}</td>
                    <td class="center">{{ intval($d->cantidad) }}</td>
                    <td class="center">
                        @if ($d->origen->id === $d->destino->id)
                            {{ intval($d->stock) }}
                        @else
                            {{ intval($d->stock - $d->cantidad) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Motivo -->
    <br>
    <table class="no-border">
        <tr>
            <td>Motivo:</td>
            <td class="right">{{ $validarCaja->motivo }}</td>
        </tr>
    </table>
    <div class="line"></div>
    <!-- Firmas -->
    <table class="no-border" style="width: 100%; margin-top: 8mm;">
        <tr>
            <td style="text-align: center; vertical-align: bottom; width: 20%;">
                <span style="display: block; border-top: 1px solid #000; margin-bottom: 2mm;"></span>
                <small>Recibí Conforme</small>
            </td>
            <td style="text-align: center; vertical-align: bottom; width: 20%;">
                <span style="display: block; border-top: 1px solid #000; margin-bottom: 2mm;"></span>
                <small> Entregué Conforme</small>
            </td>
        </tr>
    </table>

    <!-- Pie -->
    <div class="footer">
        Fecha de impresión: {{ date('Y-m-d H:i:s') }}
    </div>
</body>

</html>
