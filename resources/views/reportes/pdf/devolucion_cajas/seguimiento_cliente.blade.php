<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Seguimiento de Clientes</title>
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

        th,
        td {
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

    <h3 align="center">SEGUIMIENTO DE CAJAS</h3>
    <p align="center"><strong> Cliente:</strong> {{ $nombreCliente }}</p>
    <p align="center"><strong>Fecha de Impresión: </strong>{{ $fechaImpresion }}</p>
    <p style="text-align:center">
        <strong>FECHA DESDE:</strong> {{ $fecha_inicio }} <strong>HASTA:</strong> {{ $fecha_fin }}
    </p>

    <h4>Entregas de EDP</h4>
    <table class="sub-table">
        <thead>
            <tr>
                <th style="width: 18%">Fecha</th>
                <th style="width: 18%">Día</th>
                <th style="width: 18%">N° Pedido</th>
                <th style="width: 18%">Chofer Responsable</th>
                <th style="width: 28%" colspan="2">Cajas Entregadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entregas as $entrega)
                <tr>
                    <td>{{ $entrega['fecha'] }}</td>
                    <td>{{ $entrega['dia'] }}</td>
                    <td>{{ $entrega['id'] }}</td>
                    <td>{{ $entrega['chofer'] }}</td>
                    <td  colspan="2">{{ $entrega['cajas_entregadas'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="totales"><strong>TOTAL ENTREGADO:</strong></td>
                <td colspan="2" class="totales"><strong>{{ $totalEntregas }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <h4>Devoluciones de Cliente</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 18%">Fecha</th>
                <th style="width: 18%">Día</th>
                <th style="width: 18%">Nro Nota</th>
                <th style="width: 18%">Chofer Responsable</th>
                <th style="width: 14%">Cajas Devueltas</th>
                <th style="width: 14%">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devoluciones as $fecha => $choferes)
                @foreach ($choferes as $chofer => $devolucionesPorChofer)
                    @foreach ($devolucionesPorChofer as $devolucion)
                        <tr>
                            <td>{{ $devolucion['fecha'] }}</td>
                            <td>{{ $devolucion['dia'] }}</td>
                            <td>{{ $devolucion['id'] }}</td>
                            <td>{{ $devolucion['usuario'] }}</td>
                            <td>{{ $devolucion['cantidad_devuelta'] }}</td>
                            <td>{{ $devolucion['saldo_actual'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="totales"><strong>TOTAL DEVUELTO:</strong></td>
                <td colspan="2" class="totales"><strong>{{ $totalDevoluciones }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <!-- Total General -->
    <table class="mini-table">
        <thead>
            <tr>
                <th class="total-general" colspan="2">TOTAL SALDO PENDIENTE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="total-row"><strong>Total General:</strong></td>
                <td class="total-row"><strong>{{ $totalEntregas - $totalDevoluciones }}</strong></td>
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
