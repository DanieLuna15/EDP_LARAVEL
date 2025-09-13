<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Devolución de Cajas</title>
    <style>
        @page {
            size: A4 landscape;
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

        .signature-section {
            margin-top: 20px;
            width: 100%;
        }

        .signature-section table {
            width: 100%;
            border: none;
        }

        .signature-section td {
            text-align: center;
            width: 45%;
            padding-top: 0;
            border-top: none;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 50%;
            margin-top: 0;
            margin-left: 0;
            height: 1px;
        }
    </style>
</head>

<body>
    <h3 align="center">Reporte Devolución de Cajas</h3>
    <p align="center">Fecha de Impresión: {{ $fechaImpresion }}</p>
    <p style="text-align:center">
        <strong>DESDE:</strong> {{ $fecha_inicio }} <strong>HASTA:</strong> {{ $fecha_fin }} 
    </p>
    <table>
        <thead>
            <tr>
                <th>ID Cliente / Cliente</th>
                <th>Fecha</th>
                <th>Saldo Anterior</th>
                <th>Cantidad Devuelta</th>
                <th>Saldo Actual</th>
                <th>Cajas A/F</th>
                <th>Usuario | Chofer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devoluciones as $fecha => $choferes)
                @foreach ($choferes as $chofer => $clientes)
                    @foreach ($clientes as $devolucion)
                        <tr>
                            <td>{{ $devolucion['id_cliente'] }} | {{ $devolucion['cliente'] }}</td>
                            <td>{{ $fecha }}</td>
                            <td>{{ $devolucion['saldo_anterior'] }}</td>
                            <td>{{ $devolucion['cantidad_devuelta'] }}</td>
                            <td>{{ $devolucion['saldo_actual'] }}</td>
                            <td>{{ $devolucion['cajas_a_favor'] }}</td>
                            <td>{{ $devolucion['usuario'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" align="right"><strong>TOTALES:</strong></th>
                <th><strong>{{ $totalDevolucion }}</strong></th>
                <th><strong>{{ $totalSaldoActual }}</strong></th>
                <th><strong>{{ $totalCajasAFavor }}</strong></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(760, 575, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>
</html>
