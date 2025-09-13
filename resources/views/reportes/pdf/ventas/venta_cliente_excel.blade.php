
<table >
    <thead>
    <tr >

        <td align="left" style="border:1px solid #000; width:100px;" ><strong>SIS</strong></td>
        <td align="left" style="border:1px solid #000; width:200px;" ><strong>NOMBRE</strong></td>
        <td align="left" style="border:1px solid #000; width:200px;" ><strong>PREVENTISTA</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>ZONA</strong></td>
        <td align="left" style="border:1px solid #000; width:200px;" ><strong>DIRECCION</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>TIPO DE NEGOCIO</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>CHOFER</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>FORMA DE PAGO</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong># CELULAR</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>FORMA DE PEDIDO</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>HORARIO DE PEDIDO</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>HORARIO DE PREFERENCIA DE ENTREGA DEL CLIENTE</strong></td>
        @foreach ($fechas as $fecha)
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>{{$fecha['fecha_sort_date']}}-{{$fecha['fecha_sort']}}</strong></td>
        @endforeach

        <td align="left" style="border:1px solid #000; width:100px;" ><strong>CATEGORIA DE PRECIOS</strong></td>
        <td align="left" style="border:1px solid #000; width:150px;" ><strong>QUE PRODUCTO PIDE</strong></td>
        <td align="left" style="border:1px solid #000; width:100px;" ><strong>OBSERVACIONES</strong></td>



        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as  $venta)
        <tr >
            <td align="left" style="border:1px solid #000;" >--</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->nombre}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['preventista']->nombre}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->ZonaDespacho->name}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->direccion}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->TipoNegocio->name}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['chofer']->nombre}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->Tipopago->name}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->telefono}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->FormaPedido->name}}</td>

            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->horario_pedido}}</td>
            <td align="left" style="border:1px solid #000;" >{{$venta['cliente']->horario_preferencia}}</td>
            @foreach ($venta['ventas_fecha'] as $fecha)
                @if ($fecha['ventas']>0)
                <td align="left" style="border:1px solid #000; background-color:#BDD7EE" ><strong>{{$fecha['ventas']==0?' ':'x'}}</strong></td>

                @else
                <td align="left" style="border:1px solid #000;" ><strong></strong></td>
                @endif

                @endforeach

            <td align="left" style="border:1px solid #000;" ><strong>{{$venta["lista_grupo_pps_text"]}}</strong></td>
            <td align="left" style="border:1px solid #000;" ><strong>{{$venta["lista_venta_detalle_pps_text"]}}</strong></td>
            <td align="left" style="border:1px solid #000;" ><strong></strong></td>

        </tr>
        @endforeach





    </tbody>
</table>
