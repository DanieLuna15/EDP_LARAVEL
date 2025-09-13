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
                    <td width="5%" height="0" align="center">

                        @if(isset($sucursal->image->path_url))
                        <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                        @endif

                    </td>
                    <td width="5%" height="0" align="center"></td>
                    <td width="40%" height="0" align="center">

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
                                        <td align="left">
                                            <strong>Compra / Nro: </strong><?= $compra->id ?> - {{$compra->nro}}
                                        </td>
                                        <td align="left">
                                            <strong>Fecha Compra: </strong><?= $compra->fecha ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td width="5%" height="0" align="center"></td>
                    <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                        <div class="tabla_borde">
                            <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">SEGUIMIENTO DE COMPRAS - POR PRODUCTO </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px">NOTA N° <?= $lote->id ?> </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px"> <strong>Compra / Nro: </strong><?= $compra->id ?> - {{$compra->nro}}</span>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px">Fecha de registro: <?= $lote->fecha ?> </span>
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

    </div class="tabla_borde">
    <br>



    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>


                <tr >

                    <td align="left" class="bold"><strong>FECHA</strong></td>
                    <td align="left" class="bold"><strong>TIPO</strong></td>
                    <td align="left" class="bold"><strong>NRO</strong></td>
                    <td align="left" class="bold"><strong>CLIENTE</strong></td>
                    <td align="left" class="bold"><strong>P. BRUTO</strong></td>
                    <td align="left" class="bold"><strong>TARA</strong></td>
                    <td align="left" class="bold"><strong>M_1</strong></td>
                    <td align="left" class="bold"><strong>M_2</strong></td>
                    <td align="left" class="bold"><strong>NETO_MERMA</strong></td>
                    <td align="left" class="bold"><strong>CONT.SA</strong></td>
                    <td align="left" class="bold"><strong>UNID.E</strong></td>
                    <td align="left" class="bold"><strong>UNID.S</strong></td>
                    <td align="left" class="bold"><strong>UNID.SA</strong></td>
                    <td align="left" class="bold"><strong>KGS.E</strong></td>
                    <td align="left" class="bold"><strong>KGS.S</strong></td>
                    <td align="left" class="bold"><strong>KGS.SA</strong></td>

                </tr>
// ! ||--------------------------------------------------------------------------------||
// ! ||                     LOTE DETALLES SEGUIMIENTO DE PRODUCTOS                     ||
// ! ||--------------------------------------------------------------------------------||
            <?php
                foreach($lote->lote_detalles_seguimiento_productos as $ldsp){
            ?>
                <tr class="border_top">
                    <td colspan="16" class="bold"><strong>{{$ldsp['lote_detalle']->name}}</strong></td>

                </tr>
// ! ||--------------------------------------------------------------------------------||
// ! ||                            LOTE MOVIMIENTOS DE $ldsp                           ||
// ! ||--------------------------------------------------------------------------------||
            <?php
                foreach($ldsp['lote_detalle_movimientos'] as $m){
            ?>
                <tr class="border_top">
                    <td>{{$m->fecha}}</td>
                    <td>{{$m->tipo==1?'NDD':'NCC'}}</td>
                    <td>{{$m->id}}</td>
                    <td>{{$m->descripcion}}</td>
                    <td>{{$m->peso_bruto}}</td>
                    <td>{{$m->tara}}</td>
                    <td>{{$m->peso_neto}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
           
                

                </tr>
            <?php
                }    
            ?>
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