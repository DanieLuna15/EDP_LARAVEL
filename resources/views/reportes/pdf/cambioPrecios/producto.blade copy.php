<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
            background: #f2f2f2;
        }

        td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
        }

        .white-bg {
            padding: 10px;
        }

        .tabla_borde {}

        tr.border_bottom td {
            border-bottom: 1px solid #000;
        }

        tr.border_top td {
            border-top: 1px solid #666;
        }

        td.border_right {
            border-right: 1px solid #666;
        }

        .section-title-main {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>

<body class="white-bg">
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" alt="Sucursal Logo" style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        CAMBIO DE PRECIOS - N° <?= $productoPrecioCambio->id ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Cambio:</b> <?= $productoPrecioCambio->fecha ?>
                    </div>
                    
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width:33%; text-align:left; background:#f2f2f2;">
                        <strong class="section-title">SUCURSAL:</strong>
                        <?= $sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tbody>
                    <tr>
                        <th align="center" colspan="16" class="bold"><strong>ITEMS AFECTADOS</strong></th>
                    </tr>
                    <tr class="border_top">
                        <th align="left" class="bold"><strong>PRODUCTO</strong></th>
                        <th align="left" class="bold"><strong>FECHA</strong></th>
                        <th align="left" class="bold"><strong>HORA</strong></th>
                        <th align="left" class="bold">
                            <strong>
                                PRECIO CBBA </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                DE 1 A 14 POLLOS </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                OFICIAL (15 A 75 POLLOS) </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                DE 76 A 150 POLLOS </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                DE 151 A MAS POLLOS </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                CUALQUIER CANTIDAD AL CONTADO </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                VIP
                            </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                P. OFICIAL
                            </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                P. POR MAYOR
                            </strong>
                        </th>                        
                        <th align="left" class="bold">
                            <strong>
                                P. OFERTA
                            </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                P. LIQUIDACIÓN
                            </strong>
                        </th>
                        <th align="left" class="bold">
                            <strong>
                                P. C/FACTURA
                            </strong>
                        </th>                        
                        <th align="left" class="bold">
                            <strong>
                                P. SUCURSAL
                            </strong>
                        </th>
                    </tr>
                    <?php

                    foreach ($productoPrecioCambio->ProductoPrecioSucursals as $de) {

                    ?>
                    <tr class="border_top">

                        <td align="left" class="bold">{{ $de->ProductoPrecio->name }}</td>

                        <td>{{ $de->f }} </td>
                        <td>{{ $de->h }} </td>
                        <td>{{ $de->precio_cbba }} </td>
                        <td>{{ $de->venta_1 }} </td>
                        <td>{{ $de->precio }} </td>
                        <td>{{ $de->venta_3 }} </td>
                        <td>{{ $de->venta_4 }} </td>
                       <td>
                            {{ $de->venta_5 }}
                            @if($de->estado_precio_5 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_6 }}
                            @if($de->estado_precio_6 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_7 }}
                            @if($de->estado_precio_7 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_8 }}
                            @if($de->estado_precio_8 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_9 }}
                            @if($de->estado_precio_9 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_10 }}
                            @if($de->estado_precio_10 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_11 }}
                            @if($de->estado_precio_11 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                        <td>
                            {{ $de->venta_12 }}
                            @if($de->estado_precio_12 == 1)
                                <span style="color: green; font-weight: bold;">(EN USO)</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="border_top">

                        <th align="left" colspan="3" class="bold"><strong>DESCUENTO</strong></th>
                        <th><strong>{{ $de->descuento_1 }}</strong> </th>
                        <th><strong>{{ $de->descuento_2 }}</strong> </th>
                        <th><strong>{{ $de->descuento_3 }}</strong> </th>
                        <th><strong>{{ $de->descuento_4 }}</strong> </th>
                        <th><strong>{{ $de->descuento_5 }}</strong> </th>
                        <th><strong>{{ $de->descuento_6 }}</strong> </th>
                        <th><strong>{{ $de->descuento_7 }}</strong> </th>
                        <th><strong>{{ $de->descuento_8 }}</strong> </th>
                        <th><strong>{{ $de->descuento_9 }}</strong> </th>
                        <th><strong>{{ $de->descuento_10 }}</strong> </th>                        
                        <th><strong>{{ $de->descuento_11 }}</strong> </th>
                        <th><strong>{{ $de->descuento_12 }}</strong> </th>
                        <th><strong>{{ $de->descuento_13 }}</strong> </th>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>



    @foreach ($transEspecial as $item)
        <div class="tabla_borde">
            <table>
                <thead>
                    <tr>
                        <th colspan="10">
                            {{ $item->name }}
                        </th>
                    </tr>

                </thead>
                <tbody>
                    <tr class="border_top">
                        <th>
                            <strong>PRESA</strong>
                        </th>
                        <th><strong>PESO</strong></th>
                        <th><strong>PRECIO LPZ</strong></th>
                        <th><strong>BS</strong></th>
                        <th><strong>PROMEDIO</strong></th>
                        <th><strong>P. POR MAYOR</strong></th>
                        <th><strong>P. OFERTA</strong></th>
                        <th><strong>P. LIQUIDACIÓN</strong></th>
                        <th><strong>P. C/FACTURA</strong></th>
                        <th><strong>P. SUCURSAL</strong></th>
                    </tr>
                    @foreach ($item->TransEspecialItems as $i)
                        <tr class="border_top">


                            <td align="left" class="bold"><strong>{{ $i->Item->name }}</strong></td>
                            <td align="left" class="bold"><strong>{{ $i->peso }}</strong></td>
                            <td align="left" class="bold" style="color:red"><strong>{{ $i->precio }}</strong>
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_2 }}</strong></td>

                            <td align="left" class="bold"><strong>{{ $i->promedio }}</strong></td>
   <td align="left" class="bold"><strong>{{ $i->precio_alternativo_1 }}</strong>
                                @if($i->estado_precio_alternativo_1 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_2 }}</strong>
                                @if($i->estado_precio_alternativo_2 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_3 }}</strong>
                                @if($i->estado_precio_alternativo_3 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_4 }}</strong>
                                @if($i->estado_precio_alternativo_4 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_5 }}</strong>
                                @if($i->estado_precio_alternativo_5 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th>
                            <strong>SUMA PESO</strong>
                        </th>
                        <th><strong>{{ $item->suma_peso }}</strong></th>

                        <th>PESO<strong></strong></th>
                        <th><strong>{{ $item->suma_precio }}</strong></th>
                        <th><strong>{{ $item->suma_promedio }}</strong></th>
                        <th colspan="5"></th>
                    </tr>
                    <tr class="border_top">
                        <th>
                            <strong>PRECIO APROX</strong>
                        </th>
                        <th><strong>{{ $item->precio_aprox }}</strong></th>

                        <th><strong>{{ $item->Item->name }}</strong></th>
                        <th><strong>{{ $item->promedio_item }}</strong></th>
                        <th><strong></strong></th>
                         <th colspan="5"></th>
                    </tr>
                </tbody>
            </table>

        </div>
    @endforeach

    @foreach ($transItem as $item)
        <div class="tabla_borde">
            <table>
                <thead>
                    <tr>
                        <th colspan="9">
                            {{ $item->name }}
                        </th>
                    </tr>

                </thead>
                <tbody>
                    <tr class="border_top">
                        <th>
                            <strong>PRESA</strong>
                        </th>
                        <th><strong>PESO</strong></th>
                        <th><strong>PRECIO </strong></th>

                        <th><strong>PROMEDIO</strong></th>
                        <th><strong>P. POR MAYOR</strong></th>
                        <th><strong>P. OFERTA</strong></th>
                        <th><strong>P. LIQUIDACIÓN</strong></th>
                        <th><strong>P. C/FACTURA</strong></th>
                        <th><strong>P. SUCURSAL</strong></th>
                    </tr>
                    <tr class="border_top">


                        <td align="left" class="bold"><strong>{{ $item->Item->name }}</strong></td>
                        <td align="left" class="bold"><strong>{{ $item->peso }}</strong></td>
                        <td align="left" class="bold" style="color:red"><strong>{{ $item->precio }}</strong>
                        </td>


                        <td align="left" class="bold"><strong>{{ $item->promedio }}</strong></td>
                        <th colspan="5"><strong></strong></th>

                    </tr>
                    @foreach ($item->TransItemDetalles as $i)
                        <tr class="border_top">


                            <td align="left" class="bold"><strong>{{ $i->Item->name }}</strong></td>
                            <td align="left" class="bold"><strong>{{ $i->peso }}</strong></td>
                            <td align="left" class="bold" style="color:red"><strong>{{ $i->precio }}</strong>
                            </td>


                            <td align="left" class="bold"><strong>{{ $i->promedio }}</strong></td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_1 }}</strong>
                                @if($i->estado_precio_alternativo_1 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_2 }}</strong>
                                @if($i->estado_precio_alternativo_2 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_3 }}</strong>
                                @if($i->estado_precio_alternativo_3 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_4 }}</strong>
                                @if($i->estado_precio_alternativo_4 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_4 }}</strong>
                                @if($i->estado_precio_alternativo_5 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th>
                            <strong>PROM/{{ $item->Item->name }}</strong>
                        </th>
                        <th><strong>{{ $item->promedio_item }}</strong></th>

                        <th><strong></strong></th>
                        <th><strong>{{ $item->suma_promedio }}</strong></th>
                        <th colspan="5"><strong></strong></th>
                    </tr>

                </tbody>
            </table>

        </div>
    @endforeach




</body>

</html>
