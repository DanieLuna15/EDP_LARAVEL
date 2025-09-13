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
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        table.parent-table {
            border: none;
        }

        table.parent-table>tr>td,
        table.parent-table>tbody>tr>td {
            border: none !important;
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

    <h3 align="center">SEGUIMIENTO DE CAJAS</h3>
     <p align="center">Cliente: </p>
    <p align="center">Fecha de Impresión: {{ $fechaImpresion }}</p>
    <p style="text-align:center">
        FECHA DESDE: {{ now()->format('d-m-Y') }}
        HASTA: {{ now()->format('d-m-Y') }}
    </p>

    <table class="parent-table">
        <tr>
            <td>
                <h4>Entregas de EDP</h4>
                <table class="sub-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Día</th>
                            <th>N° Pedido</th>
                            <th>Chofer Responsable</th>
                            <th>Cajas Entregadas</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entregas as $entrega)
                            <tr>
                                <td>{{ $entrega['fecha'] }}</td>
                                <td>{{ $entrega['dia_semana'] }}</td>
                                <td>{{ $entrega['nro_pedido'] }}</td>
                                <td>{{ $entrega['chofer'] }}</td>
                                <td>{{ $entrega['cajas_entregadas'] }}</td>
                                <td>{{ $entrega['saldo_entregado'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="totales"><strong>TOTAL ENTREGADO:</strong></td>
                            <td class="totales"><strong>{{ $totalEntregas }}</strong></td>
                            <td colspan="1"></td>
                        </tr>
                    </tfoot>
                </table>
            </td>

            <td>
                <h4>Devoluciones de Cliente</h4>
                <table class="sub-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Día</th>
                            <th>N° Nota</th>
                            <th>Chofer Responsable</th>
                            <th>Cajas Devueltas</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devoluciones as $devolucion)
                            <tr>
                                <td>{{ $devolucion['fecha_devolucion'] }}</td>
                                <td>{{ $devolucion['dia_semana_devolucion'] }}</td>
                                <td>{{ $devolucion['nro_nota'] }}</td>
                                <td>{{ $devolucion['chofer_responsable'] }}</td>
                                <td>{{ $devolucion['cajas_devueltas'] }}</td>
                                <td>{{ $devolucion['saldo_final'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="totales"><strong>TOTAL DEVUELTO:</strong></td>
                            <td class="totales"><strong>{{ $totalDevoluciones }}</strong></td>
                            <td colspan="1"></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
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
            $pdf->page_text(500, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>

</body>

</html>
