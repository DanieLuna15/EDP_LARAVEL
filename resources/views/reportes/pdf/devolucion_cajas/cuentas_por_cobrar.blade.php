<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuentas por Cobrar</title>
    <style>
        @page {
            size: A4;
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .sub-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .totales {
            font-weight: bold;
            text-align: center;
        }

        .mini-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .mini-table th, .mini-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .mini-table th {
            background-color: #f2f2f2;
        }

        .total-general {
            font-size: 14px;
            font-weight: bold;
        }

        .total-row {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h1 align="center">CUENTAS POR COBRAR</h1>
    <p align="center"><strong>Fecha de Impresión: </strong>{{ $fechaImpresion }}</p>
    <p style="text-align:center">
        <strong>FECHA DESDE:</strong> {{ $fecha_inicio }} <strong>HASTA:</strong> {{ $fecha_fin }}
    </p>


    @foreach ($ventasCredito as $cliente)
        <h3>Cliente: {{ $cliente['cliente_nombre'] }} - Id: {{ $cliente['cliente_id'] }}</h3>
        <table class="mini-table">
            <thead>
                <tr>
                    <th>Venta ID</th>
                    <th>Fecha Emisión</th>
                    <th>Sucursal</th>
                    <th>Usuario</th>
                    <th>Total Pagado</th>
                    <th>Saldo Pendiente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente['ventas'] as $venta)
                    <tr>
                        <td>#{{ $venta['id'] }}</td>
                        <td>{{ $venta['fecha'] }}</td>
                        <td>{{ $venta['sucursal_nombre'] }}</td>
                        <td>{{ $venta['usuario_nombre'] }}</td>
                        <td>{{ $venta['pagado_total'] }}</td>
                        <td>{{ $venta['pendiente_total'] }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <th colspan="5" style="text-align: right; font-weight: bold;">TOTAL CLIENTE</th>
                    <th>{{ $cliente['total_saldo_pendiente'] }}</th>
                </tr>
            </tbody>
        </table>
    @endforeach

    <table class="mini-table">

        <tbody>
            <tr>
                <th class="total-row"><strong>TOTAL SALDO PENDIENTE GENERAL:</strong></th>
                <th class="total-row">{{ $totalSaldosPendientes }}</th>
            </tr>
        </tbody>
    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>
</html>
