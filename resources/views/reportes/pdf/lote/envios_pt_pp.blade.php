<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;

            border-spacing: 0;
        }

        th {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
            background: #f2f2f2;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }

        td {
            border: 1px solid black;
            padding: 5px;
        }

        .white-bg {
            padding: 0px 20px 10px 20px;
        }


        td {
            border: none;
            padding: 5px;
        }

        .tabla_borde {
            border: 1px solid #666;
            /* border-radius: 10px */
        }

        tr.border_bottom td {
            border-bottom: 1px solid #000
        }

        tr.border_top td {
            border-top: 1px solid #666
        }

        td.border_right {
            border-right: 1px solid #666
        }

        .header {

            position: relative;
            top: 0;
            left: 0;
            right: 0;

            text-align: center;

        }

        /* Estilos para el pie de página */
        .footer {
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;



        }

        .body {

            position: relative;
        }

        .foot tr {
            background-color: #94c9ff;
        }
    </style>
</head>

<body class="white-bg">
    <div class="header">
        <table width="100%" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    //LOGO
                    <td width="5%" height="0" align="center">
                        @if (isset($sucursal->image->path_url))
                            <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif
                    </td>
                    //FIN LOGO

                    <td width="95%" height="0" align="center">

                        <div>
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9"
                                cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="4">
                                            <strong><span style="font-size:18px">
                                                    ENVIOS A PP / PT
                                                </span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA COMPRA: </strong>{{ $compra->fecha }}
                                        </td>
                                        <td align="left">
                                            <strong>COMPRA NRO: </strong>{{ $compra->nro }} - {{ $compra->nro_compra }}

                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>FECHA DE LA LLEGADA: </strong>{{ $compra->fecha_llegada }}
                                        </td>
                                        <td align="left">
                                            <strong>PROVEEDOR: </strong>{{ $compra->ProveedorCompra->abreviatura }}
                                        </td>
                                        <td align="left">
                                            <strong>FECHA DE EMISION: </strong>{{ date('Y-m-d') }}
                                        </td>
                                        <td align="left">
                                            <strong>CERRADO: </strong>SI
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
    <br>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title "><strong>REPORTE DE ENVIO A PP</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PP</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pp as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>

                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>

                        <th align="left" class="bold"><strong>{{ $lote->reporte_envios_pp->sum('cajas') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pp->sum('pollos') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_bruto')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('tara')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pp->sum('peso_neto')) }}</strong>
                        </th>

                    </tr>


                </tbody>
            </table>
        </div>
        <br>
    </div>
    <br>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="7" class="bold section-title"><strong>REPORTE DE ENVIO A PT</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PT</strong></th>
                        <th align="left" class="bold"><strong>CINTA</strong></th>
                        <th align="left" class="bold"><strong>CJ</strong></th>
                        <th align="left" class="bold"><strong>UNIDADES</strong></th>
                        <th align="left" class="bold"><strong>KG/BT</strong></th>
                        <th align="left" class="bold"><strong>TARA</strong></th>
                        <th align="left" class="bold"><strong>KG/NT</strong></th>
                    </tr>
                    @foreach ($lote->reporte_envios_pt as $detalle)
                        @php
                            $detalle = (object) $detalle;
                        @endphp
                        <tr class="border_top">
                            <td align="left">{{ $detalle->lote }}</td>
                            <td align="left">{{ $detalle->cinta }}</td>
                            <td align="left">{{ $detalle->cajas }}</td>
                            <td align="left">{{ $detalle->pollos }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_bruto) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->tara) }}</td>
                            <td align="left">{{ sprintf('%0.3f', $detalle->peso_neto) }}</td>

                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th align="right" class="bold" colspan="2"> <strong>TOTAL</strong></th>

                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('cajas') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ $lote->reporte_envios_pt->sum('pollos') }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_bruto')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('tara')) }}</strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>{{ sprintf('%0.3f', $lote->reporte_envios_pt->sum('peso_neto')) }}</strong>
                        </th>

                    </tr>


                </tbody>
            </table>
        </div>

    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(776, 579, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>
</body>

</html>
