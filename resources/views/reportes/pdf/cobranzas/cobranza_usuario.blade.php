<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Cobranza de Usuario</title>
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
            padding: 0;
            margin: 0;
            border-top: none;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 50%;
            margin: 0;
            height: 1px;
            display: inline-block;
        }

        .signature-section p {
            margin-top: -5px;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        .observations {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .observation-line {
            border-top: 1px solid black;
        }
    </style>
</head>

<body>
    <h3 align="center">COBRANZAS POR USUARIO</h3>
    <p align="center">Fecha de Impresión: {{ $fechaImpresion }}</p>
    <p style="text-align:center">
        FECHA DESDE: {{ \Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y') }}
        HASTA: {{ \Carbon\Carbon::parse($fecha_fin)->format('d-m-Y') }}
    </p>

    <h4>Detalles de Cobranza</h4>
    <table>
        <thead>
            <tr>
                <th>N.</th>
                <th>ID Pedido</th>
                <th>PED.</th>
                <th>Código</th>
                <th>Cliente</th>
                <th>Forma Pago</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cobranza as $index => $i)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $i['id_pedido'] }}</td>
                    <td>{{ $i['recibo'] }}</td>
                    <td>{{ $i['codigo'] }}</td>
                    <td>{{ $i['cliente'] }}</td>
                    <td>{{ $i['forma_pago'] }}</td>
                    <td>{{ number_format($i['monto'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" align="right"><strong>Total Cobranza:</strong></td>
                <td><strong>Bs. {{ number_format($totalCobranza, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <br>
    <div class="observations">
        <strong>Observación:</strong>
        <div class="observation-line"></div>
    </div>

    <div class="signature-section">
        <table>
            <tr>
                <td>
                    <br><br><br>
                    <div class="signature-line"></div>
                    <p>RECIBÍ CONFORME</p>
                </td>
                <td>
                    <br><br><br>
                    <div class="signature-line"></div>
                    <p>ENTREGUÉ CONFORME</p>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(500, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>

</body>

</html>
