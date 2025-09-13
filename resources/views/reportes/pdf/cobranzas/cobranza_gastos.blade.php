<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Cobranza y Gastos</title>
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

        .page-break {
            page-break-before: always;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
        }
    </style>
</head>

<body>
    <h3 align="center">COBRANZA Y GASTOS</h3>
    <p align="center">Fecha de Impresión: {{ $fechaImpresion }}</p>
    <p style="text-align:center">
        FECHA DESDE: {{ \Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y') }}
        HASTA: {{ \Carbon\Carbon::parse($fecha_fin)->format('d-m-Y') }}
    </p>

    <h4>Cobranza</h4>
    <table>
        <thead>
            <tr>
                <th>NDD / Forma Pago</th>
                <th>REC.</th>
                <th>Cliente</th>
                <th>Monto EFE</th>
                <th>Monto Dep.</th>
                <th>Monto Dir.</th>
                <th>Desc.</th>
                <th>Resp.</th>
                <th>Banco</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cobranza as $i)
                <tr>
                    <td>{{ $i['venta_id'] }} - {{ $i['forma_pago'] }}</td>
                    <td>{{ $i['recibo'] }}</td>
                    <td>{{ $i['cliente'] }}</td>
                    <td>{{ number_format($i['monto_efe'], 2) }}</td>
                    <td>{{ number_format($i['monto_dep'], 2) }}</td>
                    <td>{{ number_format($i['monto_dir'], 2) }}</td>
                    <td>{{ number_format($i['desc'], 2) }}</td>
                    <td>{{ $i['resp'] }}</td>
                    <td>{{ $i['banco'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Totales:</strong></td>
                <td><strong>{{ number_format($totalMontoEfe, 2) }}</strong></td>
                <td><strong>{{ number_format($totalMontoDep, 2) }}</strong></td>
                <td><strong>{{ number_format($totalMontoDir, 2) }}</strong></td>
                <td><strong>{{ number_format($totalDesc, 2) }}</strong></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Total General Cobranza:</strong></td>
                <td colspan="6" align="right"><strong>Bs.{{ number_format($totalCobranza, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
    <br>

    <h4>Gastos</h4>
    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Doc.</th>
                <th>Beneficiario</th>
                <th>Monto</th>
                <th>Detalles</th>
                <th>Resp.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastos as $gasto)
                <tr>
                    <td>{{ $gasto['tipo'] }}</td>
                    <td>{{ $gasto['doc'] }}</td>
                    <td>{{ $gasto['beneficiario'] }}</td>
                    <td align="right">{{ number_format($gasto['monto'], 2) }}</td>
                    <!-- Monto alineado a la derecha -->
                    <td>{{ $gasto['detalles'] }}</td>
                    <td>{{ $gasto['resp'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Total Gastos:</strong></td>
                <td align="right"><strong>Bs. {{ number_format($totalGasto, 2) }}</strong></td>
                <!-- Total de los gastos alineado a la derecha -->
                <td colspan="2" align="right"></td>
            </tr>
        </tfoot>
    </table>

    <br />

    <table>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Cantidad de Cobros Realizados:</strong></td>
            <td style="width: 50%;"><strong>{{ $cantidadCobros }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Cantidad de Gastos Registrados:</strong></td>
            <td style="width: 50%;"><strong>{{ $cantidadGastos }}</strong></td>
        </tr>
    </table>

    <br />

    <table>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Depósitos:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalMontoDep, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Cobranzas directas a gerencia:</strong>
            </td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalMontoDir, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Descuentos:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalDesc, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Cobro efectivo + directo:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalEfeMasDir, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Cobranzas:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalCobranza, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total Gastos:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalGasto, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="5" align="right" style="width: 50%;"><strong>Total a Entregar:</strong></td>
            <td style="width: 50%;"><strong>Bs.{{ number_format($totalEntregar, 2) }}</strong></td>
        </tr>
    </table>


    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(500, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
