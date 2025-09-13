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
            margin-bottom: 20px;
        }
        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
        .totales {
            font-weight: bold;
            text-align: right;
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
        <strong>DESDE:</strong> {{ \Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y') }} 
        <strong>HASTA:</strong> {{ \Carbon\Carbon::parse($fecha_fin)->format('d-m-Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>COD</th>
                <th>CLIENTE</th>
                <th>FECHA ÚLT. ENTREGA</th>
                <th>CHOFER(ES) INVOLUCRADOS</th>
                <th>SALDO CAJAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deudores as $index => $deudor)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $deudor['codigo_cliente'] }}</td>
                    <td>{{ $deudor['nombre_cliente'] }}</td>
                    <td>{{ $deudor['fecha'] }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach ($deudor['choferes_relacionados'] as $ch)
                                <li>{{ $ch }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($deudor['saldo_cajas'], 0) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="totales">TOTAL CAJAS PENDIENTES</td>
                <td class="totales">{{ number_format($totalGeneral, 0) }}</td>
            </tr>
        </tfoot>
    </table>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(510, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>
</html>
