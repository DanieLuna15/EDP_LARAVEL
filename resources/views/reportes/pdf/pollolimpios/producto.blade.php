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
                                    <tr>
                                        <td colspan="2" align="left">
                                            <strong>Usuario responsable: </strong><?= $user->nombre ?>
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
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">CAMBIO DE PRECIOS</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:19px">N° <?= $pollolimpioCambio->id ?> </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px"><?= $pollolimpioCambio->fecha ?> </span>
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

                <td align="center" colspan="9" class="bold"><strong>ITEMS AFECTADOS</strong></td>





            </tr>


            <tr class="border_top">

                <td align="left" class="bold"><strong>PRODUCTO</strong></td>
                <td align="left" class="bold"><strong>FECHA</strong></td>
                <td align="left" class="bold"><strong>HORA</strong></td>

                <td align="left" class="bold">
                    <strong>
                        PRECIO CBBA</strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        DE 1 A 14 POLLOS </strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        OFICIAL (15 A 75 POLLOS) </strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        DE 76 A 150 POLLOS </strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        DE 151 A MAS POLLOS </strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        CUALQUIER CANTIDAD AL CONTADO </strong>
                </td>
                <td align="left" class="bold">
                    <strong>
                        VIP
                    </strong>
                </td>



            </tr>
            <?php

            foreach ($pollolimpioCambio->PollolimpioSucursals as $de) {

            ?>
                <tr class="border_top">

                    <td align="left" class="bold">{{$de->Pollolimpio->name}}</td>

                    <td>{{$de->f}} </td>
                    <td>{{$de->h}} </td>
                    <td>{{$de->precio_cbba}} </td>
                    <td>{{$de->venta_1}} </td>
                    <td>{{$de->precio}} </td>
                    <td>{{$de->venta_3}} </td>
                    <td>{{$de->venta_4}} </td>
                    <td>{{$de->venta_5}} </td>
                    <td>{{$de->venta_6}} </td>




                </tr>
                <tr class="border_top">

                <td align="left" colspan="3" class="bold"><strong>DESCUENTO</strong></td>


                <td><strong>{{$de->descuento_1}}</strong> </td>
                <td><strong>{{$de->descuento_2}}</strong> </td>
                <td><strong>{{$de->descuento_3}}</strong> </td>
                <td><strong>{{$de->descuento_4}}</strong> </td>
                <td><strong>{{$de->descuento_5}}</strong> </td>
                <td><strong>{{$de->descuento_6}}</strong> </td>
                <td><strong>{{$de->descuento_7}}</strong> </td>
                <td><strong>{{$de->descuento_8}}</strong> </td>




                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>
<br>
</div>
<br>



</body>

</html>
