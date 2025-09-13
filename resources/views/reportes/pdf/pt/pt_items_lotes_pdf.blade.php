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
                    <td width="25%">
                        <div class="tabla_borde">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">ITEMS EN PT</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:19px">N° PT <?= $pt->nro ?> </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px"><?= $pt->mes ?> </span>
                                        </td>
                                    </tr>
  <tr>
                                        <td align="center">
                                           <span style="font-size:14px">{{date('Y-m-d h:m')}} </span>
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

                        <td align="center" colspan="5" class="bold"><strong>BITACORA DE DESCOMPOSICIONES</strong></td>





                    </tr>
                    <tr class="border_top">

                        <td align="left" class="bold"><strong>FECHA</strong></td>


                        <td align="left" class="bold"><strong>CAJAS</strong></td>
                        <td align="left" class="bold"><strong>KG/B</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>KG/N</strong></td>



                    </tr>
                    <?php

                    foreach ($pt->items as $de) {
                    ?>
                        <tr class="border_top">

                            <td align="left" class="bold" colspan="5"><strong>{{$de['item']['name']}}</strong></td>




                        </tr>
                        <?php
                        $cajas = 0;
                        $peso_bruto = 0;
                        $tara = 0;
                        $peso_neto = 0;
                        foreach ($de['list'] as $i) {
                            $cajas += $i->cajas;

                            $peso_bruto += $i->peso_bruto;
                            $tara += $i->taras;
                            $peso_neto += $i->peso_neto;
                        ?>
                            <tr class="border_top">

                                <td align="left" class="bold">{{$i->fecha}}</strong></td>
                                <td align="left" class="bold">{{$i->cajas}}</strong></td>
                                <td align="left" class="bold">{{$i->peso_bruto}}</strong></td>
                                <td align="left" class="bold">{{$i->taras}}</strong></td>
                                <td align="left" class="bold">{{$i->peso_neto}}</strong></td>




                            </tr>

                        <?php

                        }
                        ?>
                        <tr class="border_top">

                            <td align="left" class="bold"><strong>TOTAL DE {{$de['item']['name']}}</strong></td>



                            <td align="left" class="bold"><strong>{{number_format($cajas,2)}}</strong></td>
                            <td align="left" class="bold"><strong>{{number_format($peso_bruto,2)}}</strong></td>
                            <td align="left" class="bold"><strong>{{number_format($tara,2)}}</strong></td>
                            <td align="left" class="bold"><strong>{{number_format($peso_neto,2)}}</strong></td>



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
