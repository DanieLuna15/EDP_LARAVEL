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

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .white-bg {
            padding: 20px 20px;
        }

        th,
        td {
            border: none;
            padding: 5px;
        }

        .tabla_borde {
            border: 1px solid #666;
            border-radius: 10px
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
        .border-th {
            border: 2px solid #666
        }
        .border-td {
            border-right: 2px solid #666;
            border-left: 2px solid #666
        }
    </style>
</head>

<body class="white-bg">

    <div>
        <table>
            <tbody>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">
                        <strong><span style="font-size:15px">PEDIDO (DESPACHO) PED-{{ $venta->id }}</span></strong>
                    </td>
                    <td width="33%" height="0" align="right">
                        <span style="font-size:12px">FECHA {{ $venta->fecha }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">
                        <span style="font-size:12px"><strong>IMPRESION:</strong>{{date('Y-m-d H:i:s')}}</span>
                    </td>
                </tr>

                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">
                        <span style="font-size:12px">USUARIO {{$venta->user->nombre}}</span>
                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">

                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="left">
                        CLIENTE: {{ $venta->cliente->id}} - {{ $venta->cliente->nombre }}
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">
                       <strong>PAGO CREDITO ({{ $venta->fecha }})</strong>
                    </td>
                </tr>
                <tr>
                    <td width="33%" height="0" align="left">
                        DIRECCION: {{ $venta->cliente->direccion }}
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">

                    </td>
                </tr>
                  <tr>
                    <td width="33%" height="0" align="center">
                        <strong></strong>
                    </td>
                    <td width="33%" height="0" align="center">

                    </td>
                    <td width="33%" height="0" align="right">

                    </td>
                </tr>
                  <tr>
                    <td  height="0" align="center" colspan="3">
                        <table width="100%" height="0" aling="center" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">COD</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">ITEM</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">CAJAS</span></strong>
                                    </th>
                                    <th class="border-th"  height="0" align="center">
                                        <strong><span style="font-size:9px">UNIDAD</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">P. BRUTO</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">TARA</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">P. NETO</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">PRECIO / KG</span></strong>
                                    </th>
                                    <th  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">TOTAL</span></strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    $cajas_t = 0;
                    $pollos_t = 0;
                    $peso_bruto_t = 0;
                    $peso_neto_t = 0;
                    $tara_t = 0;
                    foreach ($venta->LoteDetalleVentas as $de) {
                        $cajas_t += $de->cajas;
                        $pollos_t += $de->pollos;
                        $peso_bruto_t += $de->peso_bruto;
                        $peso_neto_t += $de->peso_neto;
                        $tara_t += $de->peso_bruto - $de->peso_neto;
                    ?>
                        <tr class="border_top">

                            <td align="left" class="bold">{{$de->LoteDetalle->Lote->Compra->nro}}</td>
                            <td align="left" class="bold">{{$de->LoteDetalle->name}}</td>
                            <td align="left" class="bold">{{$de->cajas}}</td>
                            <td align="left" class="bold">{{$de->pollos}}</td>

                            <td align="left" class="bold">{{$de->peso_bruto}}</td>
                            <td align="left" class="bold">{{$de->peso_bruto-$de->peso_neto}}</td>
                            <td align="left" class="bold">{{$de->peso_neto}}</td>
                            <td align="left" class="bold">{{$de->precio_acuerdo}}</td>
                            <td align="left" class="bold">{{$de->total}}</td>




                        </tr>
                    <?php
                    }
                    ?>
                                <tr>
                                    <td   height="0" align="left">
                                       <span style="font-size:9px">20 1</span>
                                    </td>
                                    <td   height="0" align="center">
                                       <span style="font-size:9px">POLLO LIMPIO</span>
                                    </td>
                                    <td   height="0" align="center">
                                       <span style="font-size:9px">5</span>
                                    </td>
                                    <td   height="0" align="center">
                                       <span style="font-size:9px">100</span>
                                    </td>
                                    <td   height="0" align="center">
                                       <span style="font-size:9px">201.00</span>
                                    </td>
                                    <td  class="border-td" height="0" align="center">
                                       <span style="font-size:9px">10.00</span>
                                    </td>
                                    <td   height="0" align="right">
                                       <span style="font-size:9px">191.00 + 36.00 = 227.00</span>
                                    </td>
                                    <td   class="border-td" height="0" align="right">
                                       <span style="font-size:9px">14.00</span>
                                    </td>
                                    <td   height="0" align="right">
                                       <span style="font-size:9px">3,178.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td   height="0" align="left" colspan="5">
                                       <span style="font-size:9px">Descuento MENUDO (36.00 x 2 = 72.00)</span>
                                    </td>

                                    <td  class="border-td" height="0" align="center">
                                       <span style="font-size:9px"></span>
                                    </td>
                                    <td   height="0" align="right">
                                       <span style="font-size:9px">36.00 </span>
                                    </td>
                                    <td   class="border-td" height="0" align="right">
                                       <span style="font-size:9px">2.00</span>
                                    </td>
                                    <td   height="0" align="right">
                                       <span style="font-size:9px">-72.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td   class="border-th"  height="0" align="left" colspan="8">
                                       <span style="font-size:9px"></span>
                                    </td>


                                    <td  class="border-th"   height="0" align="right">
                                       <span style="font-size:9px">3,106.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="border-th" height="0" align="center" colspan="2">
                                        <strong><span style="font-size:9px">TOTALES</span></strong>

                                    </td>
                                    <td  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">5</span></strong>
                                    </td>
                                    <td class="border-th"  height="0" align="center">
                                        <strong><span style="font-size:9px">10</span></strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">201.00</span></strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">10.00</span></strong>
                                    </td>
                                    <td  class="border-th" height="0" align="right">
                                        <strong><span style="font-size:9px">191.00</span></strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center">
                                        <strong><span style="font-size:9px">TOTAL</span></strong>
                                    </td>
                                    <td  class="border-th" height="0" align="right">
                                        <strong><span style="font-size:9px">3,106.00</span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="0" align="left" colspan="9">
                                        <strong><span style="font-size:9px">SON: CIENTO VEINTE Y SEIS CON 00/100 BOLIVIANOS</span></strong>

                                    </td>
                                </tr>
                                <tr>
                                    <td  height="0" align="left" colspan="9">
                                        <strong><span style="font-size:9px">OBS: </span></strong>

                                    </td>
                                </tr>
                                <tr>
                                    <td   height="0" align="left" colspan="9">
                                        <strong></strong>

                                    </td>
                                </tr>
                                <tr>
                                    <td  class="border-th" height="0" align="center" colspan="2">
                                        <strong>CAJAS</strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <strong>SAL. ANT</strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <strong>HOY</strong>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <strong>25/11/2020</strong>
                                    </td>
                                    <td   height="0" align="center" >

                                    </td>
                                </tr>
                                <tr>
                                    <td  class="border-th" height="0" align="center" colspan="2">
                                        <span>CAJAS</span>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <span>SAL. ANT</span>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <span>HOY</span>
                                    </td>
                                    <td  class="border-th" height="0" align="center" >
                                        <span>25/11/2020</span>
                                    </td>
                                    <td   height="0" align="center" >

                                    </td>
                                </tr>
                                 <tr>
                                    <td   height="25" align="left" colspan="9">
                                        <strong></strong>

                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="4">
                                        <strong></strong>
                                    </td>
                                     <td   height="0" align="center" >

                                    </td>
                                    <td    align="left" colspan="4">
                                        <strong></strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td    align="center" colspan="2">
                                        <strong>_____________________________________</strong>
                                    </td>
                                     <td   height="0" align="center" >

                                    </td>
                                     <td    align="left" colspan="2">
                                        <strong>_____________________________________</strong>
                                    </td>
                                    <td    align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td    align="center" colspan="2">
                                        RESP. CHOFER
                                    </td>
                                     <td   height="0" align="center" >

                                    </td>
                                     <td    align="left" colspan="2">
                                        RECIBIDO POR CLIENTE
                                    </td>
                                    <td    align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td    align="center" colspan="2">

                                    </td>
                                     <td   height="0" align="center" >

                                    </td>
                                     <td    align="left" colspan="2">
                                        NOMBRE:___________________________________
                                    </td>
                                    <td    align="center" colspan="2">
                                        <strong></strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="2">
                                        <strong></strong>
                                    </td>
                                    <td    align="center" colspan="2">

                                    </td>
                                     <td   height="0" align="center" >

                                    </td>
                                     <td    align="left" colspan="2">
                                        HORA RECEPCION:___________________________
                                    </td>
                                    <td    align="center" colspan="2">

                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="left" colspan="9">
                                        <strong>OBS:</strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td    align="center" colspan="9">
                                        <strong>ESTIMADO CLIENTE LA PRESENTE NOTA DA COMFORMIDAD DE LA ENTREGA DE SU PEDIDO</strong>
                                    </td>
                                </tr>
                                 <tr>
                                    <td   align="center" colspan="9">
                                        <strong>GRACIAS POR SU PREFERENCIA!!!</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>
