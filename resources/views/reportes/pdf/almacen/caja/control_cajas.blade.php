<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Control de Cajas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 10px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            page-break-inside: auto;
        }

        thead tr {
            background-color: #1a73e8;
            color: white;
        }

        thead tr th {
            border: 1px solid #ccc;
            padding: 6px 8px;
            font-weight: bold;
            font-size: 9px;
            text-align: center;
            vertical-align: middle;
        }

        tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        tbody tr td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
        }

        /* Colores para columnas específicas */
        .stock-origen {
            background-color: #a5d6a7;
            /* verde claro */
        }

        .cantidad {
            background-color: #ef9a9a;
            /* rojo claro */
        }

        .stock-destino {
            background-color: #90caf9;
            /* azul claro */
        }

        .header-green {
            background-color: #4caf50;
        }

        .header-blue {
            background-color: #2196f3;
        }

        /* Estilos para títulos y subcabeceras */
        .titulo-reporte {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 15px;
            text-align: center;
            text-transform: uppercase;
        }

        /* Ajustes para la página en horizontal */
        @page {
            size: A4 landscape;
            margin: 10mm 10mm 10mm 10mm;
        }
    </style>
</head>

<body>
    <div class="titulo-reporte">
        CONTROL DE CAJAS COCHABAMBA<br />
        Desde {{ $fecha_inicio }} hasta {{ $fecha_fin }}<br />
        Cantidad de cajas responsabilidad CBBA
    </div>

    <table>
        <thead>
            <tr>
                <th colspan="5" class="header-green">RECEPCIÓN LA PAZ</th>
                <th colspan="5" class="header-blue">DEVOLUCIÓN CBBA</th>
            </tr>
            <tr>
                <th>DIA</th>
                <th>FECHA</th>
                <th>N° NOTA</th>
                <th>CNT CAJA LLEGADA</th>
                <th>SALDO A/F LP</th>
                <th>DIA</th>
                <th>FECHA</th>
                <th>N° TACO</th>
                <th>SALDO</th>
                <th>ENVIO CAJAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles_completos as $fecha => $detalles)
                @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle['dia'] ?? 'SN' }}</td>
                        <td>{{ $detalle['fecha'] ? \Carbon\Carbon::parse($detalle['fecha'])->format('d/m/Y') : 'SN' }}
                        </td>
                        <td>{{ $detalle['nro'] ?? 'SN' }}</td>
                        <td class="cantidad">{{ number_format($detalle['cantidad'] ?? 0, 0, ',', '.') }}</td>
                        <td class="stock-origen">{{ number_format($detalle['saldo_af_lp'] ?? 0, 0, ',', '.') }}</td>

                        <td>{{ $detalle['dia'] ?? 'SN' }}</td>
                        <td>{{ $detalle['fecha'] ? \Carbon\Carbon::parse($detalle['fecha'])->format('d/m/Y') : 'SN' }}
                        </td>
                        <td>{{ $detalle['id'] ?? 'SN' }}</td>
                        <td class="stock-destino">{{ number_format($detalle['saldo'] ?? 0, 0, ',', '.') }}</td>
                        <td class="cantidad">{{ number_format($detalle['envio_cajas'] ?? 0, 0, ',', '.') }}</td>
                    </tr>

                    @if (strtolower($detalle['dia'] ?? '') === 'domingo')
                        <tr>
                            <td colspan="10" style="border-top: 4px solid #000; height: 1px; padding: 0; margin: 0;">
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>

    </table>

</body>

</html>
