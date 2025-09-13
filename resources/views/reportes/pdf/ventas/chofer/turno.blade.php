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
    </style>
</head>

<body class="white-bg">

<div>
        <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                   
                    <td width="50%" height="0" align="center">
                        <div class="tabla_borde">
                            <table width="100%" height="0" border="0" border-radius="" cellspacing="0">
                                <tbody>
                                <tr>
                                        <td align="center" colspan="3">
                                            <strong><span style="font-size:15px">INFORMACION PERSONAL DEL CHOFER</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>Chofer: </strong><?= $turnoChofer->chofer->nombre ?>
                                        </td>
                                        <td align="left">
                                            <strong>{{$turnoChofer->chofer->documento->name}}: </strong>{{$turnoChofer->chofer->doc}}
                                        </td>
                                        <td align="left">
                                            <strong>Placa: </strong>{{$turnoChofer->chofer->placa}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>Modelo: </strong><?= $turnoChofer->chofer->modelo ?>
                                        </td>
                                        <td align="left">
                                            <strong>Color: </strong><?= $turnoChofer->chofer->color ?>
                                        </td>
                                        <td align="left">
                                            <strong>Zona: </strong><?= $turnoChofer->chofer->zona ?>
                                        </td>
                                     
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="left">
                                            <strong>Estado: </strong><?= $turnoChofer->chofer->EstadoCompraChofer->name ?>
                                        </td>
                                        
                                     
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>

                    </td>
                    
                    <td width="25%" height="0" align="center">
                        <div class="tabla_borde">
                            <table width="100%" height="0" border="0" border-radius="" cellspacing="0">
                                <tbody>
                                <tr>
                                        <td align="center" colspan="2">
                                            <strong><span style="font-size:10px">ESTADO DE CAPACIDAD</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>CAPACIDAD: </strong> 
                                        </td>
                                      
                                        <td align="left">
                                           {{$turnoChofer->chofer->capacidad}} KG
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td align="left">
                                            <strong>CAPACIDAD OCUPADA: </strong> 
                                        </td>
                                      
                                        <td align="left">
                                           {{$turnoChofer->capacidad_utilizada}} KG 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>CAPACIDAD DISPONIBLE: </strong> 
                                        </td>
                                      
                                        <td align="left">
                                           {{number_format($turnoChofer->chofer->capacidad-$turnoChofer->capacidad_utilizada,2)}} KG
                                        </td>
                                    </tr>
                                   

                                </tbody>
                            </table>
                        </div>

                    </td>
                   
                    <td width="25%" >
                        <div class="tabla_borde">
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">TURNO DE CHOFER</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:10px">TURNO N° <?= $turnoChofer->id ?> - {{$turnoChofer->apertura==1?'APERTURADA':'FINALIZADA'}} </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:10px">FECHA INICIO: <?= $turnoChofer->fecha ?> </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span style="font-size:10px">HORA INICIO: <?= $turnoChofer->hora_inicio ?> </span>
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
    <div>

<div class="tabla_borde">
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tbody>




            <tr>

                <td align="center" colspan="7" class="bold"><strong>LISTA DE VENTAS ASIGNADAS</strong></td>





            </tr>


            <tr class="border_top">

                <td align="left" class="bold" ><strong>N°</strong></td>
                <td align="left" class="bold" ><strong>VENTA N°</strong></td>
                <td align="left" class="bold" ><strong>CLIENTE</strong></td>
                <td align="left" class="bold" ><strong>FECHA ENTREGA</strong></td>
                <td align="left" class="bold" ><strong>HORA ENTREGA</strong></td>
                <td align="left" class="bold"><strong>KG</strong></td>
                <td align="left" class="bold"><strong>ESTADO</strong></td>
            



            </tr>
            <?php
            $cajas_t = 0;
            $pollos_t = 0;
            $peso_bruto_t = 0;
            $peso_neto_t = 0;
            $tara_t = 0;
            $nro = 0;
            $peso_entregado = 0;
            $peso_pendiente = 0;
            foreach ($turnoChofer->VentaTurnoChofers as $de) {
            $nro = $nro + 1;
            $peso_entregado = $peso_entregado + ($de->entregado!=1? $de->peso:0);
            $peso_pendiente = $peso_pendiente + ($de->entregado==1? $de->peso:0);
            ?>
                <tr class="border_top">

                    <td align="left" class="bold">{{$nro}}</td>
                    <td align="left" class="bold">{{$de->venta->id}}</td>
                    <td align="left" class="bold">{{$de->venta->cliente->nombre}}</td>
                    <td align="left" class="bold">{{$de->venta->fecha_entrega}}</td>
       
                    <td align="left" class="bold">{{$de->venta->hora_entrega}}</td>
                    <td align="left" class="bold">{{$de->peso}}</td>

                    <td align="left" class="bold">{{$de->entregado==1?'PENDIENTE':'ENTREGADO'}}</td>
                   




                </tr>
            <?php
            }
            ?>
          
        </tbody>
        <tfoot>
            <tr class="border_top">
                <td colspan="6" align="right" class="bold">TOTAL ENTREGADO KG</td>
                <td align="left" class="bold">{{$peso_entregado}}</td>
               
            </tr>
            <tr class="border_top">
                <td colspan="6" align="right" class="bold">TOTAL PENDIENTE KG</td>
                <td align="left" class="bold">{{$peso_pendiente}}</td>
               
            </tr>
        </tfoot>
    </table>
</div>
<br>
</div>
<br>




</body>

</html>