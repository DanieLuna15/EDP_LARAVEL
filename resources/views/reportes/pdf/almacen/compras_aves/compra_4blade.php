<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .bold,
        b,
        strong {
            font-weight: 700
        }

        body {
            background-repeat: no-repeat;
            background-position: center center;
            text-align: center;
            margin: 0;
            font-family: Verdana, monospace
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

        .table-valores-totales tbody>tr>td {
            border: 0
        }

        .table-valores-totales>tbody>tr>td:first-child {
            text-align: right
        }

        .table-valores-totales>tbody>tr>td:last-child {
            border-bottom: 1px solid #666;
            text-align: right;
            width: 30%
        }

        hr,
        img {
            border: 0
        }

        table td {
            font-size: 12px
        }

        html {
            font-family: sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-size: 10px;
            -webkit-tap-highlight-color: transparent
        }

        a {
            background-color: transparent
        }

        a:active,
        a:hover {
            outline: 0
        }

        img {
            vertical-align: middle
        }

        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px solid #eee
        }

        table {
            border-spacing: 0;
            border-collapse: collapse
        }

        @media print {

            blockquote,
            img,
            tr {
                page-break-inside: avoid
            }

            *,
            :after,
            :before {
                color: #000 !important;
                text-shadow: none !important;
                background: 0 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important
            }

            a,
            a:visited {
                text-decoration: underline
            }

            a[href]:after {
                content: " (" attr(href) ")"
            }

            blockquote {
                border: 1px solid #999
            }

            img {
                max-width: 100% !important
            }

            p {
                orphans: 3;
                widows: 3
            }

            .table {
                border-collapse: collapse !important
            }

            .table td {
                background-color: #fff !important
            }
        }

        a,
        a:focus,
        a:hover {
            text-decoration: none
        }

        *,
        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        a {
            color: #428bca;
            cursor: pointer
        }

        a:focus,
        a:hover {
            color: #2a6496
        }

        a:focus {
            outline: dotted thin;
            outline: -webkit-focus-ring-color auto 5px;
            outline-offset: -2px
        }

        h6 {
            font-family: inherit;
            line-height: 1.1;
            color: inherit;
            margin-top: 10px;
            margin-bottom: 10px
        }

        p {
            margin: 0 0 10px
        }

        blockquote {
            padding: 10px 20px;
            margin: 0 0 20px;
            border-left: 5px solid #eee
        }

        table {
            background-color: transparent
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px
        }

        h6 {
            font-weight: 100;
            font-size: 10px
        }

        body {
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #2f4050;
            font-size: 13px;
            color: #676a6c;
            overflow-x: hidden
        }

        .table>tbody>tr>td {
            vertical-align: top;
            border-top: 1px solid #e7eaec;
            line-height: 1.42857;
            padding: 5px
        }

        .white-bg {
            background-color: #fff
        }

        td {
            padding: 3
        }

        .table-valores-totales tbody>tr>td {
            border-top: 0 none !important
        }

        tr {
  page-break-inside: avoid;
}
body {
  margin-top: .5in;
  background-color: #2f4050;
}
    </style>
</head>

<body class="white-bg">

    <table width="100%">
        <tbody>
            <tr>
                <td style="padding:30px !important">
                    <table width="100%" height="200px" border="0" aling="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="50%" height="0" align="center">

                                    @if(isset($compra->sucursal->image->path_url))
                                    <img src="<?= $compra->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                                    @endif

                                </td>
                                <td width="5%" height="0" align="center"></td>
                                <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                                    <div class="tabla_borde">
                                        <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">C O M P R A </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:19px">N° <?= $compra->id ?> - {{$compra->nro}} </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:14px">Fecha de registro: <?= $compra->fecha ?> </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-size:14px">Hora de registro: <?= $compra->hora ?> </span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="bottom" style="padding-left:0" colspan="3">
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
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" style="padding-left:0" colspan="3">

                                    <div class="tabla_borde">
                                        <table width="100%" border="0" height="50" cellpadding="6" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="text-align: start;vertical-align: bottom;">
                                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;" text-align="center">DATOS DEL RESPONSABLE</span>
                                                    </td>
                                                    <td align="left" style="text-align: start;vertical-align: bottom;">
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



                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                                        <strong>Proveedor: </strong> <?= $compra->ProveedorCompra->nombre ?>

                                    </td>






                                </tr>
                                <tr>
                                    <td width="30%" align="left">
                                        <strong>Fecha Salida: </strong> <?= $compra->fecha_salida ?>

                                    </td>
                                  
                                    <td width="30%" align="left">
                                        <strong>Fecha Llegada: </strong> <?= $compra->fecha_llegada ?>

                                    </td>
                                  






                                </tr>



                            </tbody>
                        </table>
                    </div><br>
                  
                    <?php


                    foreach ($compra->detalles_original as $d) {
                    ?>
                        <div class="tabla_borde">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                <tbody>
                                    <tr>
                                        
                                        <td align="center " colspan="8" class="bold">Tipo de cinta: <?= $d['sub_original']->name ?></td>
                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold">N°</td>
                                        <td align="left" class="bold">Pollos</td>
                                        <td align="left" class="bold">Peso Bruto</td>
                                        <td align="left" class="bold">Cajas</td>
                                        <td align="left" class="bold">Taras</td>
                                        <td align="left" class="bold">Peso Neto</td>
                                        <td align="left" class="bold">PR-CJ-PB</td>
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
                                    foreach ($d['list'] as $key =>$i) {
                                        $cantidad += $i->cant;
                                        $nro += $i->nro;
                                        $valor += $i->valor;
                                        $neto += $i->valor - ($retraccion * $i->cant);
                                        $retraccionSum += ($retraccion * $i->cant);
                                        $peso_neto = $i->valor - ($retraccion*$i->cant);
                                        $promedio = ($i->valor/$i->cant);
                                        $promedioPollo = floatval($peso_neto) / floatval($i->nro);
                                        $Totalpromedio += $promedio;
                                        $TotalpromedioPollo += $promedioPollo;
                                    ?>
                                        <tr class="border_top">
                                            <td align="left">
                                                <?= $key+1 ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->nro ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->valor ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->cant ?>
                                            </td>
                                            <td align="left">
                                                <?= $retraccion*$i->cant ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format($peso_neto,2) ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format($promedio,2) ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format(floatval($promedioPollo),2) ?>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr class="border_top">
                                 
                                        <td align="left" colspan="2" class="bold">Total Pollos</td>
                                        <td align="left" class="bold">Total Peso Bruto</td>
                                        <td align="left" class="bold">Total CJ</td>
                                        <td align="left" class="bold">Total Tara</td>
                                        <td align="left" class="bold">Total Peso Neto</td>
                                        <td align="left" class="bold">Total PR-CJ-PB</td>
                                        <td align="left" class="bold">Total Promedio Pollo</td>
                                      

                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="" colspan="2"> {{$nro}} </td>
                                        <td align="left" class="" > {{$valor}} </td>
                                        <td align="left" class="" > {{$cantidad}} </td>
                                        <td align="left" class="" > {{$retraccionSum}} </td>
                                        <td align="left" class="" > {{$neto}} </td>
                                        <td align="left" class="" > {{number_format($Totalpromedio,2)}} </td>
                                        <td align="left" class="" > {{number_format($TotalpromedioPollo,2)}} </td>
                                       
                                
                                

                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold" colspan="6">  </td>
                                    
                                        <td align="left" class="bold" > {{number_format($Totalpromedio/count($compra->detalles),2)}} </td>
                                        <td align="left" class="bold" > {{number_format($TotalpromedioPollo/count($compra->detalles),2)}} </td>
                                       
                                
                                

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                    <?php
                    }
                    ?>
                    <?php


                    foreach ($compra->detalles_sin_cita as $d) {
                    ?>
                        <div class="tabla_borde">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                <tbody>
                                    <tr>
                                        
                                        <td align="center " colspan="8" class="bold">Producto de <?= $d['categoria']->name ?></td>
                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold">N°</td>
                                        <td align="left" class="bold">Pollos</td>
                                        <td align="left" class="bold">Peso Bruto</td>
                                        <td align="left" class="bold">Cajas</td>
                                        <td align="left" class="bold">Taras</td>
                                        <td align="left" class="bold">Peso Neto</td>
                                        <td align="left" class="bold">PR-CJ-PB</td>
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
                                    foreach ($d['list'] as $key =>$i) {
                                        $cantidad += $i->cant;
                                        $nro += $i->nro;
                                        $valor += $i->valor;
                                        $neto += $i->valor - ($retraccion * $i->cant);
                                        $retraccionSum += ($retraccion * $i->cant);
                                        $peso_neto = $i->valor - ($retraccion*$i->cant);
                                        $promedio = ($i->valor/$i->cant);
                                        $promedioPollo = floatval($i->valor) / floatval($i->nro);
                                        $Totalpromedio += $promedio;
                                        $TotalpromedioPollo += $promedioPollo;
                                    ?>
                                        <tr class="border_top">
                                            <td align="left">
                                                <?= $key+1 ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->nro ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->valor ?>
                                            </td>
                                            <td align="left">
                                                <?= $i->cant ?>
                                            </td>
                                            <td align="left">
                                                <?= $retraccion*$i->cant ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format($peso_neto,2) ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format($promedio,2) ?>
                                            </td>
                                            <td align="left">
                                                <?= number_format(floatval($promedioPollo),2) ?>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr class="border_top">
                                 
                                        <td align="left" colspan="2" class="bold">Total Pollos</td>
                                        <td align="left" class="bold">Total Peso Bruto</td>
                                        <td align="left" class="bold">Total CJ</td>
                                        <td align="left" class="bold">Total Tara</td>
                                        <td align="left" class="bold">Total Peso Neto</td>
                                        <td align="left" class="bold">Total PR-CJ-PB</td>
                                        <td align="left" class="bold">Total Promedio Pollo</td>
                                      

                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="" colspan="2"> {{$nro}} </td>
                                        <td align="left" class="" > {{$valor}} </td>
                                        <td align="left" class="" > {{$cantidad}} </td>
                                        <td align="left" class="" > {{$retraccionSum}} </td>
                                        <td align="left" class="" > {{$neto}} </td>
                                        <td align="left" class="" > {{number_format($Totalpromedio,2)}} </td>
                                        <td align="left" class="" > {{number_format($TotalpromedioPollo,2)}} </td>
                                       
                                
                                

                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold" colspan="6">  </td>
                                    
                                        <td align="left" class="bold" > {{number_format($Totalpromedio/count($compra->detalles_sin_cita),2)}} </td>
                                        <td align="left" class="bold" > {{number_format($TotalpromedioPollo/count($compra->detalles_sin_cita),2)}} </td>
                                       
                                
                                

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
                    ?>
                        <div class="tabla_borde">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                <tbody>
                                    <tr>


                                        <td align="center " colspan="4" class="bold">Categoria: <?= $d['categoria']->name ?></td>
                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold"> Total Pollos <?= $d['sumaPollos'] ?></td>
                                        <td align="left" class="bold">Peso Bruto <?= $d['sumaTotal'] ?></td>
                                        <td align="left" class="bold">Peso Neto <?= number_format($d['sumaTotal']-($d['taras']*floatval($d['submedida']->medidaProducto->Medida->retraccion)),2)  ?></td>
                                        <td align="left" class="bold">Total Cant Tara <?= number_format($d['taras']*floatval($d['submedida']->medidaProducto->Medida->retraccion),2) ?></td>



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


                                        <td align="center " colspan="4" class="bold">TOTALES</td>
                                    </tr>
                                    <tr class="border_top">

                                        <td align="left" class="bold"> Total Pollos <?= $compra->sum_cant_pollos ?></td>
                                        <td align="left" class="bold">Peso Bruto <?= $compra->sum_peso_bruto ?></td>
                                        <td align="left" class="bold">Peso Neto  <?= $compra->sum_peso_neto ?></td>
                                        <td align="left" class="bold">Total Cant  <?= $compra->sum_retraccion ?></td>



                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <br>
                  



                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>