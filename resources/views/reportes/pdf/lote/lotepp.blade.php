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
                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">L O T E &nbsp; E N &nbsp; P P</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">
                                        <span style="font-size:19px">N° <?= $lote->id ?> </span>
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
    <?php
                $nro = 0;
                $filas = 0;

                foreach ($lote->lote_detalles as $detalle) {
                    $nro++;
                    $filas++;
                ?>


<div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>

                <tr>

                    <td align="center" colspan="9" class="bold"><strong>{{$detalle->LoteDetalle->name}}</strong></td>



                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong>N°</strong></td>

                    <td align="left" class="bold"><strong>PESO BRUTO</strong></td>
                    <td align="left" class="bold"><strong>PESO NETO</strong></td>
                    <td align="left" class="bold"><strong>TOTAL DE POLLOS</strong></td>
                    <td align="left" class="bold"><strong>MERMA NETA TOTAL</strong></td>
                    <td align="left" class="bold"><strong>MERMA BRUTA TOTAL</strong></td>
                    <td align="left" class="bold"><strong>CAJAS</strong></td>
                    <td align="left" class="bold"><strong>TARAS</strong></td>
                    <td align="left" class="bold"><strong>ESTADO</strong></td>


                </tr>
                <tr class="border_top">
                        <td align="left">
                           {{$nro}}
                        </td>

                        <td align="left">
                            {{$detalle->peso_bruto}}


                        </td>
                        <td align="left">
                        {{$detalle->peso_neto}}
                        </td>
                        <td align="left">
                        {{$detalle->cantidad}}

                        </td>
                        <td align="left">
                        {{$detalle->merma_bruta}}
                        </td>
                        <td align="left">
                        {{$detalle->merma_neta}}
                        </td>
                        <td align="left">
                        {{$detalle->cajas}}
                        </td>
                        <td align="left">
                        {{number_format($detalle->cajas*2,2)}}
                        </td>
                        <td align="left">
                        {{$detalle->descomponer==0?'TROZADO':'SIN TROZAR'}}
                        </td>


                    </tr>
                    <tr class="border_top">

                    <td align="center" colspan="9" class="bold"><strong>COMPO. INTER. EXTRAIDA</strong></td>



                    </tr>
                    <tr class="border_top">
                        <td align="left">
                        <strong>N°</strong>
                        </td>

                        <td align="left" colspan="5">

                            <strong>COMPO. INTERNA</strong>

                        </td>
                        <td align="left">
                        <strong>CANTIDAD</strong>
                        </td>
                        <td align="left">
                        <strong>PESO</strong>
                        </td>
                        <td align="left">
                        <strong>PESO TOTAL</strong>
                        </td>



                    </tr>
                <?php
                $nroTrozado = 0;
                $filasTrozado = 0;

                foreach ($detalle->PpDetalleDescomposicions()->where('trozado',0)->get() as $des) {
                    $nroTrozado++;
                    $filasTrozado++;
                ?>
                    <tr class="border_top">
                        <td align="left">
                           {{$nroTrozado}}
                        </td>

                        <td align="left" colspan="5">
                            SIN {{$des->CompoInterna->name}}


                        </td>
                        <td align="left">
                            {{$des->cantidad}}
                        </td>
                        <td align="left">
                            {{$des->CompoInterna->peso}}

                        </td>
                        <td align="left">
                        {{number_format($des->cantidad*$des->CompoInterna->peso,2)}}
                        </td>



                    </tr>
                <?php


                }
                ?>

            </tbody>
        </table>
        </div>
        <br>
        <?php


}
?>


</body>

</html>
