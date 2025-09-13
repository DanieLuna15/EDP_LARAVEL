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
                    <td width="10%" height="0" align="center">

                        @if(isset($sucursal->image->path_url))
                        <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                        @endif

                    </td>
                    <td width="5%" height="0" align="center"></td>
                    <td width="55%" height="0" align="center">
                        <div class="tabla_borde">
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <strong><span style="font-size:15px"><?= $sucursal->nombre ?></span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong><?= $sucursal->documento->name ?>: </strong><?= $sucursal->doc ?>
                                        </td>
                                        <td align="left">
                                            <strong>Email: </strong><?= $sucursal->email ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>Dirección: </strong><?= $sucursal->direccion ?>
                                        </td>
                                        <td align="left">
                                            <strong>Telefono: </strong><?= $sucursal->telefono ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong>Responsable: </strong><?= $sucursal->responsable ?>
                                        </td>
                                        <td align="left">
                                            <strong>Medidor: </strong><?= $sucursal->medidor ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </td>
                    <td width="5%" height="0" align="center"></td>
                    <td width="25%" >
                        <div class="tabla_borde">
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">PEDIDO - PREVENTA</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:19px">N° <?= $pedidoCliente->id ?> </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px">Fecha : <?= $pedidoCliente->fecha ?> </span>
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
        <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    
                    <td width="50%" height="0" align="center">
                        <div class="tabla_borde">
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <strong><span style="font-size:15px">CLIENTE</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong><?= $pedidoCliente->cliente->documento->name ?>: </strong><?= $pedidoCliente->cliente->doc ?>
                                        </td>
                                        <td align="left">
                                            <strong>Nombre: </strong><?= $pedidoCliente->cliente->nombre ?>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>

                    </td>
                  
                    <td width="50%" height="0" align="center">
                        <div class="tabla_borde">
                            <table width="100%" height="0" border="0" border-radius="" cellpadding="9" cellspacing="0">
                            <tbody>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <strong><span style="font-size:15px">CHOFER</span></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <strong><?= $pedidoCliente->chofer->documento->name ?>: </strong><?= $pedidoCliente->chofer->doc ?>
                                        </td>
                                        <td align="left">
                                            <strong>Nombre: </strong><?= $pedidoCliente->chofer->nombre ?>
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

                <td align="center" colspan="6" class="bold"><strong>ITEMS DE PP</strong></td>





            </tr>


            <tr class="border_top">

                <td align="left" class="bold" ><strong> N°</strong></td>
                <td align="left" class="bold" ><strong>ITEM</strong></td>
                <td align="left" class="bold"><strong>CAJAS</strong></td>
                <td align="left" class="bold"><strong>KG/B</strong></td>
                <td align="left" class="bold"><strong>TARA</strong></td>
                <td align="left" class="bold"><strong>KG/N</strong></td>
                <td align="left" class="bold"><strong>KG/N UNIT</strong></td>



            </tr>
            <?php
            $cajas_v = 0;
            $pollos_v = 0;
            $peso_bruto_v = 0;
            $peso_neto_v = 0;
            $tara_v = 0;
            $nro = 0;
            foreach ($pedidoCliente->PedidoClienteDetalles as $de) {
                $cajas_v += $de->cajas;
                $pollos_v += $de->pollos;
                $peso_bruto_v += $de->peso_bruto;
                $peso_neto_v += $de->peso_neto;
                $tara_v += $de->tara;
                $nro++;
            ?>
                <tr class="border_top">

                    <td align="left" class="bold">{{$nro}}</td>
                    <td align="left" class="bold">{{$de->Item->name}}</td>
                    <td align="left" class="bold">{{$de->cajas}}</td>

                    <td align="left" class="bold">{{$de->peso_bruto}}</td>
                    <td align="left" class="bold">{{$de->tara}}</td>
                    <td align="left" class="bold">{{$de->peso_neto}}</td>
                    <td align="left" class="bold">{{$de->peso_neto_unitario}}</td>




                </tr>
            <?php
            }
            ?>
            <tr class="border_top">

                <td align="left" colspan="2" class="bold" ><strong>TOTALES VENDIDOS DE ITEMS</strong></td>



                <td align="left" class="bold"><strong>{{number_format($cajas_v,2)}}</strong></td>

                <td align="left" class="bold"><strong>{{number_format($peso_bruto_v,2)}}</strong></td>
                <td align="left" class="bold"><strong>{{number_format($tara_v,2)}}</strong></td>
                <td align="left" class="bold"><strong>{{number_format($peso_neto_v,2)}}</strong></td>
                <td align="left" class="bold"><strong></strong></td>



            </tr>
        </tbody>
    </table>
</div>
<br>
</div>
<br>


</body>

</html>