<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Reporte Semanal de Control de Cajas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 10px;
            color: #222;
        }

        h2,
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        .semana-header {
            background-color: #2a64bc;
            color: white;
            padding: 6px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            page-break-inside: avoid;
            margin-bottom: 15px;
        }

        thead tr {
            background-color: #0077cc;
            color: white;
        }

        thead tr th {
            border: 1px solid #555;
            padding: 6px 8px;
            font-weight: bold;
            font-size: 10px;
            text-align: center;
            vertical-align: middle;
        }

        tbody tr td {
            border: 1px solid #555;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 10px;
        }

        .saldo-semana {
            font-weight: bold;
            background-color: #d7d7d7;
        }

        .saldo-valor {
            background-color: #87c3f7;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Reporte Semanal de Control de Cajas</h2>
    <p style="text-align:center;">Desde {{ $fecha_inicio }} hasta {{ $fecha_fin }}</p>

    @foreach ($detalles_por_semana as $semana)
        <div class="semana-header">
            MOVIMIENTO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SEMANA {{ $semana['semana'] }}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MES: {{ $semana['mes'] }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>DIA</th>
                    <th>MATADERO INGRESO</th>
                    <th>TOTAL CJ CBBA</th>
                    <th>SALIDAS LPZ</th>
                    <th>SALDO CBBA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $saldoSemana = $semana['stock_inicial'] ?? 0;
                @endphp
                <tr class="saldo-semana">
                    <td colspan="5" style="text-align:right;">SALDO INICIAL SEMANA {{ $semana['semana'] }}</td>
                    <td class="saldo-valor">{{ number_format($saldoSemana, 0, ',', '.') }}</td>
                </tr>

                @foreach ($semana['detalles'] as $fecha => $detalles)
                    @php
                        $primerItem = reset($detalles);
                        $stockOrigen = $primerItem['stock_origen'] ?? 0;

                        $totalCantidad = collect($detalles)->sum(function ($item) {
                            return floatval(str_replace('.', '', str_replace(',', '.', $item['cantidad'] ?? 0)));
                        });

                        $ultimoItem = end($detalles);
                        $saldoCbba = $ultimoItem['saldo_cbba'] ?? 0;
                    @endphp

                    <tr>
                        <td>{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</td>
                        <td>{{ strtoupper($primerItem['dia'] ?? '') }}</td>
                        <td>0</td>
                        <td>{{ number_format($stockOrigen, 0, ',', '.') }}</td>
                        <td class="cantidad">{{ number_format($totalCantidad, 0, ',', '.') }}</td>
                        <td>{{ number_format($saldoCbba, 0, ',', '.') }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
