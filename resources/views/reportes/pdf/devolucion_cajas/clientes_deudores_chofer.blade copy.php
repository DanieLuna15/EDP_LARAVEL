<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes que Deben Cajas</title>
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

        th,
        td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
        }

        .totales {
            font-weight: bold;
            text-align: right;
        }

        .mini-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .mini-table th,
        .mini-table td {
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
    <h3 align="center">REPORTE DE CLIENTES QUE DEBEN CAJAS</h3>
    <p align="center">Fecha de Impresión: {{ $fechaImpresion }}</p>
    <p style="text-align:center">
        <strong>DESDE:</strong> {{ $fecha_inicio->format('d-m-Y') }} <strong>HASTA:</strong> {{ $fecha_fin->format('d-m-Y') }}
    </p>

    @foreach ($deudoresPorChofer as $chofer => $deudores)
        <h4>CHOFER: {{ strtoupper($chofer) }}</h4>

        <table>
            <thead>
                <tr>
                    <th>COD</th>
                    <th>NOMBRE DEL CLIENTE</th>
                    <th>FECHA</th>
                    <th>SALDO DE CAJAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deudores as $deudor)
                    <tr>
                        <td>{{ $deudor['codigo_cliente'] }}</td>
                        <td>{{ $deudor['nombre_cliente'] }}</td>
                        <td>{{ $deudor['fecha'] }}</td>
                        <td>{{ $deudor['saldo_cajas'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="totales"><strong>TOTAL:</strong></th>
                    <th class="totales"><strong>{{ number_format($totalesPorChofer[$chofer]) }}</strong></th>
                </tr>
            </tfoot>
        </table>
    @endforeach

    <!-- Mini tabla para el total general -->
    <table class="mini-table">
        <tbody>
            <tr>
                <th class="total-general" colspan="4">TOTAL DEUDA DE CAJAS EN CLIENTES</th>
                <td class="total-row"><strong>{{ number_format($totalGeneral) }}</strong></td>
            </tr>
        </tbody>
    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(500, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
