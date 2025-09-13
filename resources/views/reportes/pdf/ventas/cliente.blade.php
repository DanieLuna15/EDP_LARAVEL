<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 8px;
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
    </style>
</head>

<body class="white-bg">



    <br>
    <div>

        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                <tr >

                    <td align="left" class="bold" ><strong>SIS</strong></td>
                    <td align="left" class="bold" ><strong>NOMBRE</strong></td>
                    <td align="left" class="bold" ><strong>PREVENTISTA</strong></td>
                    <td align="left" class="bold" ><strong>ZONA</strong></td>
                    <td align="left" class="bold" ><strong>DIRECCION</strong></td>
                    <td align="left" class="bold" ><strong>TIPO DE NEGOCIO</strong></td>
                    <td align="left" class="bold" ><strong>CHOFER</strong></td>
                    <td align="left" class="bold" ><strong>FORMA DE PAGO</strong></td>
                    <td align="left" class="bold" ><strong># CELULAR</strong></td>
                    <td align="left" class="bold" ><strong>FORMA DE PEDIDO</strong></td>
                    <td align="left" class="bold" ><strong>HORARIO DE PEDIDO</strong></td>
                    <td align="left" class="bold" ><strong>HORARIO DE PREFERENCIA DE ENTREGA DEL CLIENTE</strong></td>
                    @foreach ($fechas as $fecha)
                    <td align="left" class="bold" ><strong>{{$fecha['fecha_sort_date']}}</strong></td>
                    @endforeach

                    <td align="left" class="bold" ><strong>CATEGORIA DE PRECIOS</strong></td>
                    <td align="left" class="bold" ><strong>QUE PRODUCTO PIDE</strong></td>
                    <td align="left" class="bold" ><strong>OBSERVACIONES</strong></td>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as  $venta)
                    <tr class="border_top">
                        <td align="left" class="bold" >--</td>
                        <td align="left" class="bold" >{{$venta['cliente']->nombre}}</td>
                        <td align="left" class="bold" >{{$venta['preventista']->nombre}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->ZonaDespacho->name}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->direccion}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->TipoNegocio->name}}</td>
                        <td align="left" class="bold" >{{$venta['chofer']->nombre}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->Tipopago->name}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->telefono}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->FormaPedido->name}}</td>

                        <td align="left" class="bold" >{{$venta['cliente']->horario_pedido}}</td>
                        <td align="left" class="bold" >{{$venta['cliente']->horario_preferencia}}</td>
                        @foreach ($venta['ventas_fecha'] as $fecha)
                            <td align="left" class="bold" ><strong>{{$fecha['ventas']==0?' ':'x'}}</strong></td>
                         @endforeach

                        <td align="left" class="bold" ><strong>{{$venta["lista_grupo_pps_text"]}}</strong></td>
                        <td align="left" class="bold" ><strong>{{$venta["lista_venta_detalle_pps_text"]}}</strong></td>
                        <td align="left" class="bold" ><strong></strong></td>

                    </tr>
                    @endforeach





                </tbody>
            </table>
        </div>
        <br>
    </div>




</body>

</html>
