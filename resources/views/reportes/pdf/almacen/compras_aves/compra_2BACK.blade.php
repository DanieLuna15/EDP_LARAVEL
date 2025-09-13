<html>
<!-- COMPRA ORIGINALS -->

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
@php
    function format_peso($peso, $decimales = 3)
    {
        return number_format($peso, $decimales, '.');
    }
@endphp

<body class="white-bg">
    <div>
        <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td width="50%" height="0" align="center">

                        @if (isset($compra->sucursal->image->path_url))
                            <img src="<?= $compra->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                                style="width: 100px;">
                        @endif

                    </td>
                    <td width="5%" height="0" align="center"></td>
                    <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                        <div class="tabla_borde">
                            <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px"
                                                text-align="center">C O M P R A - N° <?= $compra->id ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:17px">
                                                {{ $compra->ProveedorCompra->abreviatura }}-{{ $compra->nro_compra }}
                                                {{ $compra->nro }} </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <span style="font-size:17px"> <?= $compra->obs ?> </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span style="font-size:14px">Fecha de registro: <?= $compra->fecha ?> Hora
                                                <?= $compra->hora ?> </span>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                    <td align="center">
                                        <span style="font-size:14px">Hora de registro: </span>
                                    </td>
                                </tr> -->

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
                        <strong><span style="font-size:15px"><?= $compra->sucursal->nombre ?></span></strong>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <strong><?= $compra->sucursal->documento->name ?>: </strong><?= $compra->sucursal->doc ?>
                    </td>
                    <td align="left">
                        <strong>Email: </strong><?= $compra->sucursal->email ?>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <strong>Dirección: </strong><?= $compra->sucursal->direccion ?>
                    </td>
                    <td align="left">
                        <strong>Telefono: </strong><?= $compra->sucursal->telefono ?>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <strong>Responsable: </strong><?= $compra->sucursal->responsable ?>
                    </td>
                    <td align="left">
                        <strong>Medidor: </strong><?= $compra->sucursal->medidor ?>
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
                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;"
                            text-align="center">DATOS DEL RESPONSABLE</span>
                    </td>

                </tr>
                <tr>
                    <td>

                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="left"><strong>Nombre:</strong> <?= $compra->user->nombre ?>
                                        <?= $compra->user->apellidos ?></td>
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
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="1" cellspacing="0">
            <tbody>


                <tr>
                    <td width="30%" align="left">
                        <strong>Chofer: </strong> <?= $compra->chofer ?>

                    </td>
                    <td width="30%" align="left">
                        <strong>Camion: </strong> <?= $compra->camion ?>

                    </td>

                    <td width="30%" align="left">
                        <strong>Placa: </strong> <?= $compra->placa ?>

                    </td>




                </tr>
                <tr>
                    <td width="30%" align="left">
                        <strong>E. Despacho: </strong> <?= $compra->e_despacho ?>

                    </td>
                    <td width="30%" align="left">
                        <strong>E. Recepcion: </strong> <?= $compra->e_recepcion ?>

                    </td>
                    <td width="30%" align="left">
                        <strong>Proveedor: </strong> <?= $compra->ProveedorCompra->abreviatura ?>

                    </td>

                    <td width="30%" align="left">
                        <strong>Proveedor: </strong> <?= $compra->ProveedorCompra
                        ->ProveedorCompraMedidas()
                        ->where([['id', 4]])
                        ->get()
                        ->count() ?>

                    </td>






                </tr>
                <tr>
                    <td width="30%" align="left">
                        <strong>Fecha Salida: </strong> <?= $compra->fecha_salida ?>

                    </td>

                    <td width="30%" align="left">
                        <strong>Fecha Llegada: </strong> <?= $compra->fecha_llegada ?>

                    </td>
                    <td width="30%" align="left">


                    </td>







                </tr>



            </tbody>
        </table>
    </div class="tabla_borde">
    <br>
    <?php

$total_cajas = 0;
foreach ($compra->detalles_pigmento_cinta as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="left " colspan="9" class="bold">Tipo de cinta: <?= $d['sub_original']->name ?>
                        CON PIGMENTO</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">N°</td>
                    <td align="left" class="bold">Pollos</td>
                    <td align="left" class="bold">Pigmento</td>
                    <td align="left" class="bold">Peso Bruto</td>
                    <td align="left" class="bold">Cajas</td>
                    <td align="left" class="bold">Taras</td>
                    <td align="left" class="bold">Peso Neto</td>
                    <td align="left" class="bold">PR-JL-PB</td>
                    <td align="left" class="bold">Promedio Pollo</td>

                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($d['sub_original']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                $filas = 0;
                foreach ($d['list'] as $key => $i) {
                    $cantidad += $i->cant;
                    $pollos = $i->tipo_pollo==1?$i->nro:1;
                    $nro += $pollos;
                    $valor += $i->valor;
                    $neto += $i->valor - ($retraccion * $i->cant);
                    $retraccionSum += ($retraccion * $i->cant);
                    $peso_neto = $i->valor - ($retraccion * $i->cant);
                    $promedio = ($i->valor / $i->cant);
                    $promedioPollo = floatval($peso_neto) / floatval($pollos);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                    $filas++;
                    $total_cajas += $i->cant;
                ?>

                <tr class="border_top">
                    <td align="left">
                        <?= $key + 1 ?> {{ $i->editado == 1 ? '*' : '' }}
                    </td>
                    <td align="left">
                        <?= (int) $pollos ?>
                    </td>
                    <td align="left">
                        <?= $i->pigmento == 1 ? 'SI' : 'NO' ?>
                    </td>
                    <td align="left">
                        <?= format_peso($i->valor) ?>
                    </td>
                    <td align="left">
                        <?= (int) $i->cant ?>
                    </td>
                    <td align="left">
                        <?= $retraccion * $i->cant ?>
                    </td>
                    <td align="left">
                        <?= format_peso($peso_neto) ?>
                    </td>
                    <td align="left">
                        <?= format_peso($promedio) ?>
                    </td>
                    <td align="left">
                        <?= number_format(floatval($promedioPollo), 2) ?>
                    </td>

                </tr>
                <?php
                }
                ?>
                <tr class="border_top">

                    <td align="left" class="bold">Total </td>
                    <td align="left" class="bold">Total Pollos</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold">Total JL</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-JL-PB</td>
                    <td align="left" class="bold">Total Promedio Pollo</td>


                </tr>
                <tr class="border_top">

                    <td align="left" class=""> {{ $filas }} </td>
                    <td align="left" class=""> {{ $nro }} </td>
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> {{ (int) $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ format_peso($Totalpromedio) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold" colspan="7"> </td>

                    <td align="left" class="bold"> {{ format_peso($Totalpromedio / $filas) }} </td>
                    <td align="left" class="bold"> {{ number_format($TotalpromedioPollo / $filas, 2) }} </td>




                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <?php
}

?>
    <?php


foreach ($compra->detalles_sin_pigmento_cinta as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="left " colspan="9" class="bold">Tipo de cinta: <?= $d['sub_original']->name ?>
                        SIN PIGMENTO</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">N°</td>
                    <td align="left" class="bold">Pollos</td>
                    <td align="left" class="bold">Pigmento</td>
                    <td align="left" class="bold">Peso Bruto</td>
                    <td align="left" class="bold">Cajas</td>
                    <td align="left" class="bold">Taras</td>
                    <td align="left" class="bold">Peso Neto</td>
                    <td align="left" class="bold">PR-JL-PB</td>
                    <td align="left" class="bold">Promedio Pollo</td>

                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($d['sub_original']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                $filas = 0;
                foreach ($d['list'] as $key => $i) {
                    $pollos = $i->tipo_pollo==1?$i->nro:1;
                    $cantidad += $i->cant;
                    $nro += $pollos;
                    $valor += $i->valor;
                    $neto += $i->valor - ($retraccion * $i->cant);
                    $retraccionSum += ($retraccion * $i->cant);
                    $peso_neto = $i->valor - ($retraccion * $i->cant);
                    $promedio = ($i->valor / $i->cant);
                    $promedioPollo = floatval($peso_neto) / floatval($pollos);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                    $filas++;
                    $total_cajas += $i->cant;
                ?>

                <tr class="border_top">
                    <td align="left">
                        <?= $key + 1 ?> {{ $i->editado == 1 ? '*' : '' }}
                    </td>
                    <td align="left">
                        <?= (int) $pollos ?>
                    </td>
                    <td align="left">
                        <?= $i->pigmento == 1 ? 'SI' : 'NO' ?>
                    </td>
                    <td align="left">
                        <?= format_peso($i->valor) ?>
                    </td>
                    <td align="left">
                        <?= $i->cant ?>
                    </td>
                    <td align="left">
                        <?= $retraccion * $i->cant ?>
                    </td>
                    <td align="left">
                        <?= format_peso($peso_neto) ?>
                    </td>
                    <td align="left">
                        <?= number_format($promedio, 3) ?>
                    </td>
                    <td align="left">
                        <?= number_format(floatval($promedioPollo), 2) ?>
                    </td>

                </tr>
                <?php
                }
                ?>
                <tr class="border_top">

                    <td align="left" class="bold">Total </td>
                    <td align="left" class="bold">Total Pollos</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold">Total JL</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-JL-PB</td>
                    <td align="left" class="bold">Total Promedio Pollo</td>


                </tr>
                <tr class="border_top">

                    <td align="left" class=""> {{ $filas }} </td>
                    <td align="left" class=""> {{ $nro }} </td>
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ format_peso($Totalpromedio) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold" colspan="7"> </td>

                    <td align="left" class="bold"> {{ number_format($Totalpromedio / $filas, 2) }} </td>
                    <td align="left" class="bold"> {{ number_format($TotalpromedioPollo / $filas, 2) }} </td>




                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <?php
}

?>

    <?php
foreach ($compra->detalles_pigmento_sin_cinta as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="left " colspan="9" class="bold">Producto de <?= $d['categoria']->name ?> CON
                        PIGMENTO</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">N°</td>
                    <td align="left" class="bold">Pollos</td>
                    <td align="left" class="bold">Pigmento</td>
                    <td align="left" class="bold">Peso Bruto</td>
                    <td align="left" class="bold">Cajas</td>
                    <td align="left" class="bold">Taras</td>
                    <td align="left" class="bold">Peso Neto</td>
                    <td align="left" class="bold">PR-JL-PB</td>
                    <td align="left" class="bold">Promedio Pollo</td>

                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($d['sub_medida']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                foreach ($d['list'] as $key => $i) {
                    $pollos = $i->tipo_pollo==1?$i->nro:1;
                    $cantidad += $i->cant;
                    $nro += $pollos;
                    $valor += $i->valor;
                    $neto += $i->valor - ($retraccion * $i->cant);
                    $retraccionSum += ($retraccion * $i->cant);
                    $peso_neto = $i->valor - ($retraccion * $i->cant);
                    $promedio = ($i->valor / $i->cant);
                    $promedioPollo = floatval($i->valor) / floatval($pollos);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                    $total_cajas += $i->cant;
                ?>
                <tr class="border_top">
                    <td align="left">
                        <?= $key + 1 ?> {{ $i->editado == 1 ? '*' : '' }}
                    </td>
                    <td align="left">
                        <?= (int) $pollos ?>
                    </td>
                    <td align="left">
                        <?= $i->pigmento == 1 ? 'SI' : 'NO' ?>
                    </td>
                    <td align="left">
                        <?= format_peso($i->valor) ?>
                    </td>
                    <td align="left">
                        <?= $i->cant ?>
                    </td>
                    <td align="left">
                        <?= $retraccion * $i->cant ?>
                    </td>
                    <td align="left">
                        <?= format_peso($peso_neto) ?>
                    </td>
                    <td align="left">
                        <?= format_peso($promedio) ?>
                    </td>
                    <td align="left">
                        <?= number_format(floatval($promedioPollo), 2) ?>
                    </td>

                </tr>
                <?php
                }
                ?>
                <tr class="border_top">

                    <td align="left" colspan="2" class="bold">Total Pollos</td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total JL</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-JL-PB</td>
                    <td align="left" class="bold">Total Promedio Pollo</td>


                </tr>
                <tr class="border_top">

                    <td align="left" class="" colspan="2"> {{ $nro }} </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold" colspan="7"> </td>

                    <td align="left" class="bold">
                        {{ number_format($Totalpromedio / count($compra->detalles_sin_cita), 2) }} </td>
                    <td align="left" class="bold">
                        {{ number_format($TotalpromedioPollo / count($compra->detalles_sin_cita), 2) }} </td>




                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <?php
}
?>

    <?php
foreach ($compra->detalles_sin_pigmento_sin_cinta as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="left " colspan="9" class="bold">Producto de <?= $d['categoria']->name ?> SIN
                        PIGMENTO</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">N°</td>
                    <td align="left" class="bold">Pollos</td>
                    <td align="left" class="bold">Pigmento</td>
                    <td align="left" class="bold">Peso Bruto</td>
                    <td align="left" class="bold">Cajas</td>
                    <td align="left" class="bold">Taras</td>
                    <td align="left" class="bold">Peso Neto</td>
                    <td align="left" class="bold">PR-JL-PB</td>
                    <td align="left" class="bold">Promedio Pollo</td>

                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($d['sub_medida']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                foreach ($d['list'] as $key => $i) {
                    $cantidad += $i->cant;
                    $nro += $i->nro;
                    $valor += $i->valor;
                    $neto += $i->valor - ($retraccion * $i->cant);
                    $retraccionSum += ($retraccion * $i->cant);
                    $peso_neto = $i->valor - ($retraccion * $i->cant);
                    $promedio = ($i->valor / $i->cant);
                    $promedioPollo = floatval($i->valor) / floatval($i->nro);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                    $total_cajas += $i->cant;
                ?>
                <tr class="border_top">
                    <td align="left">
                        <?= $key + 1 ?> {{ $i->editado == 1 ? '*' : '' }}
                    </td>
                    <td align="left">
                        <?= (int) $i->nro ?>
                    </td>
                    <td align="left">
                        <?= $i->pigmento == 1 ? 'SI' : 'NO' ?>
                    </td>
                    <td align="left">
                        <?= format_peso($i->valor) ?>
                    </td>
                    <td align="left">
                        <?= $i->cant ?>
                    </td>
                    <td align="left">
                        <?= $retraccion * $i->cant ?>
                    </td>
                    <td align="left">
                        <?= format_peso($peso_neto) ?>
                    </td>
                    <td align="left">
                        <?= format_peso($promedio) ?>
                    </td>
                    <td align="left">
                        <?= number_format(floatval($promedioPollo), 3) ?>
                    </td>

                </tr>
                <?php
                }
                ?>
                <tr class="border_top">

                    <td align="left" colspan="2" class="bold">Total Pollos</td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total JL</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-JL-PB</td>
                    <td align="left" class="bold">Total Promedio Pollo</td>


                </tr>
                <tr class="border_top">

                    <td align="left" class="" colspan="2"> {{ $nro }} </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold" colspan="7"> </td>

                    <td align="left" class="bold">
                        {{ number_format($Totalpromedio / count($compra->detalles_sin_cita), 2) }} </td>
                    <td align="left" class="bold">
                        {{ number_format($TotalpromedioPollo / count($compra->detalles_sin_cita), 2) }} </td>




                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <?php
}
?>
    <br>
    <?php
   $total_cajas = 0;

foreach ($compra->detalles_cinta as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="left " colspan="9" class="bold">Sumatoria de cinta:
                        <?= $d['sub_original']->name ?></td>
                </tr>

                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($d['sub_medida']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                $filas = 0;
                foreach ($d['list'] as $key => $i) {
                    $cantidad += $i->cant;
                    $nro += $i->nro;
                    $valor += $i->valor;
                    $neto += $i->valor - ($retraccion * $i->cant);
                    $retraccionSum += ($retraccion * $i->cant);
                    $peso_neto = $i->valor - ($retraccion * $i->cant);
                    $promedio = ($i->valor / $i->cant);
                    $promedioPollo = floatval($peso_neto) / floatval($i->nro==0?1:$i->nro);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                    $filas++;
                    $total_cajas += $i->cant;
                ?>
                <?php
                }
                ?>
                <tr class="border_top">

                    <td align="left" class="bold">Total </td>
                    <td align="left" class="bold">Total Pollos</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold">Total JL</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-JL-PB</td>
                    <td align="left" class="bold">Total Promedio Pollo</td>
                </tr>
                <tr class="border_top">
                    <td align="left" class=""> {{ $filas }} </td>
                    <td align="left" class=""> {{ (int) $nro }} </td>
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ format_peso($Totalpromedio, 3) }} </td>
                    <td align="left" class=""> {{ format_peso($TotalpromedioPollo, 3) }} </td>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold" colspan="7"> </td>
                    <td align="left" class="bold"> {{ number_format($Totalpromedio / $filas, 3) }} </td>
                    <td align="left" class="bold"> {{ number_format($TotalpromedioPollo / $filas, 3) }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <?php
}
?>

    <?php

foreach ($compra->category_list as $d) {
    if($d['categoria']->id == $compra->ProveedorCompra->categoria_id){
        $sumaPollosCategoria = 0;
        $sumaValorCategoria = 0;
        $sumaValorNetoCategoria = 0;
        $sumaValorTaraCategoria = 0;

        foreach ($compra->CompraInventarios()->where([["categoria_id",$d['categoria']->id],['cinta',1]])->get() as $i) {
            $buscar_sub = $compra->ProveedorCompra->ProveedorCompraMedidas()->where('sub_medida_id',$i->sub_medida_id)->get()->count();
            if($buscar_sub > 0){
                $sumaPollosCategoria += $i->nro;
                $sumaValorCategoria += $i->valor;
                $sumaValorNetoCategoria += $i->valor -($i->cant*2);
                $sumaValorTaraCategoria += ($i->cant*2);



            }
        }
?>

    <!-- <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <td align="left " colspan="4" class="bold">CATEGORIA PROVEEDOR: <?= $d['categoria']->name ?></td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"> Total Pollos {{ (int) $sumaPollosCategoria }}</td>
                    <td align="left" class="bold">Peso Bruto {{ $sumaValorCategoria }}</td>
                    <td align="left" class="bold">Peso Neto {{ $sumaValorNetoCategoria }}</td>
                    <td align="left" class="bold">Total Cant Tara {{ $sumaValorTaraCategoria }}</td>



                </tr>


            </tbody>
        </table>
        </div>
        <br> -->
    <?php
}
}
?>
    <?php
$medidas_sub_list_proveedor = [];
foreach ($compra->category_list as $d) {
?>
    <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <td align="left" colspan="4" class="bold">Categoria: <?= $d['categoria']->name ?></td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"> Total Pollos <?= $d['sumaPollos'] ?></td>
                    <td align="left" class="bold">Peso Bruto <?= $d['sumaTotal'] ?></td>
                    <td align="left" class="bold">Peso Neto
                        <?= format_peso($d['sumaTotal'] - $d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 3) ?>
                    </td>
                    <td align="left" class="bold">Total Cant Tara
                        <?= format_peso($d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 3) ?>
                    </td>



                </tr>


            </tbody>
        </table>
    </div>
    <br>
    <?php
}
?>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <td align="center " colspan="5" class="bold">TOTALES</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"> Total Pollos {{ (int) $compra->sum_cant_pollos }}</td>
                    <td align="left" class="bold">Total Cajas <?= $total_cajas ?></td>
                    <td align="left" class="bold">Peso Bruto <?= format_peso($compra->sum_peso_bruto) ?></td>
                    <td align="left" class="bold">Peso Neto <?= format_peso($compra->sum_peso_neto) ?></td>
                    <td align="left" class="bold">Total Tara <?= format_peso($compra->sum_retraccion) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
