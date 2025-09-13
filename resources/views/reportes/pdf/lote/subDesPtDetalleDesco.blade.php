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
        .white-bg{
            padding: 20px 20px;
        }
        th, td {
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
<div >
    <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td width="50%" height="0" align="center">

                    @if(isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                    @endif

                </td>
                <td width="5%" height="0" align="center"></td>
                <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                    <div class="tabla_borde">
                        <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:14px" text-align="center">L O T E  &nbsp; S U B T R O Z A R &nbsp; A &nbsp;P T </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">
                                        <span style="font-size:14px">SUB-DESCOMPONER N° <?= $subDesPtDetalleDesco->id ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <span style="font-size:14px">LOTE N° <?= $lote->id ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                    <strong>Compra / Nro Compra /Nro Lote: </strong><?= $compra->id ?> - {{$compra->nro_compra}}- {{$compra->nro}}
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
    <br>
    <div class="tabla_borde">
    <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
        <tbody>
            <tr>
                <td align="left" style="text-align: start;vertical-align: bottom;">
                    <span style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;" text-align="center">DATOS DEL RESPONSABLE</span>
                </td>

            </tr>
            <tr>
                <td>

                    <table width="100%" border="0" cellpadding="1" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="left"><strong>Nombre:</strong> <?= $compra->user->nombre ?> <?= $compra->user->apellidos ?></td>
                                <td align="left"><strong>Correo:</strong> <?= $compra->user->correo ?></td>




                            </tr>
                            <tr>

                                <td align="left">
                                    <strong>Usuario: </strong> <?= $compra->user->usuario ?>

                                </td>
                                <td align="left">
                                    <strong>Usuario: </strong> <?= $compra->user->usuario ?>

                                </td>



                            </tr>

                        </tbody>
                    </table>
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

                <tr>

                    <td align="center" class="bold" colspan="4"><strong> DETALLE DE PT</strong></td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong>CINTA</strong></td>
                    <td align="left" class="bold"><strong>CANTIDAD</strong> </td>
                    <td align="left" class="bold"><strong>PESO BRUTO</strong> </td>
                    <td align="left" class="bold"><strong>PESO NETO</strong></td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalle->loteDetalle->name}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalle->cantidad}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalle->peso_bruto}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalle->peso_neto}}</td>




                </tr>

            </tbody>
        </table>
        </div>
        <br>


        <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <tr>

                    <td align="center" class="bold" colspan="4"><strong> DETALLE DE DESCOMPOSICION </strong></td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong>NOMBRE</strong></td>
                    <td align="left" class="bold"><strong>CANTIDAD</strong> </td>
                    <td align="left" class="bold"><strong>PESO UNIT</strong> </td>
                    <td align="left" class="bold"><strong>PESO TOTAL</strong></td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalleDescomposicion->CompoExterna->name}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalleDescomposicion->CompoExterna->cantidad*$subDesPtDetalleDesco->ptDetalle->cantidad}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->ptDetalleDescomposicion->CompoExterna->peso}}</td>
                    <td align="left" class="bold">{{number_format(($subDesPtDetalleDesco->ptDetalleDescomposicion->CompoExterna->cantidad*$subDesPtDetalleDesco->ptDetalle->cantidad)*$subDesPtDetalleDesco->ptDetalleDescomposicion->CompoExterna->peso,2)}}</td>




                </tr>

            </tbody>
        </table>
        </div>
        <br>
        <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <tr>

                    <td align="center" class="bold" colspan="4"><strong> DETALLE DE LA SUB DESCOMPOSICION DE PT</strong></td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong>DETALLE</strong></td>
                    <td align="left" class="bold"><strong>CANTIDAD</strong> </td>
                    <td align="left" class="bold"><strong>PESO TOTAL</strong> </td>
                    <td align="left" class="bold"><strong>EQUIVALE</strong> </td>





                </tr>

                <tr class="border_top">

                    <td align="left" class="bold">{{$subDesPtDetalleDesco->CompoExternaDetalle->name}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->cantidad}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->peso_total}}</td>
                    <td align="left" class="bold">{{$subDesPtDetalleDesco->equivale}}</td>





                </tr>

            </tbody>
        </table>
        </div>
        <br>

</body>

</html>
