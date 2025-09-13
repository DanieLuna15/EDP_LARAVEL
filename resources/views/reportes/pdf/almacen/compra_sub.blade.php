<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
            background: #f2f2f2;
        }

        td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
        }

        .white-bg {
            padding: 10px;
        }

        .tabla_borde {}

        tr.border_bottom td {
            border-bottom: 1px solid #000;
        }

        tr.border_top td,
        tr.border_top th {
            border-top: 1px solid #666;
        }

        td.border_right {
            border-right: 1px solid #666;
        }

        .section-title-main {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>

<body class="white-bg">
    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:10px;">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($compra->sucursal->image->path_url))
                    <img src="<?= $compra->sucursal->image->path_url ?>" alt="Sucursal Logo" style="width: 80px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        <?= $compra->ProveedorCompra->abreviatura ?>-<?= $compra->nro_compra ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <?= $compra->ProveedorCompra->abreviatura ?>-<?= $compra->nro_compra ?> <?= $compra->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <?= $compra->obs ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de registro:</b> <?= $compra->fecha ?> <b>Hora:</b> <?= $compra->hora ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width:33%; text-align:left; background:#f2f2f2;">
                        <strong class="section-title">SUCURSAL:</strong> <?= $compra->sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $compra->sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $compra->sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tabla_borde">
        <table width="100%" cellpadding="6" cellspacing="0">
            <tbody>
                <tr>
                    <th style="width:33%; text-align:left; background:#f2f2f2;">
                        <strong class="section-title">DATOS DEL RESPONSABLE</strong>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Nombre:</strong> <?= $compra->user->nombre ?> <?= $compra->user->apellidos ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Usuario:</strong> <?= $compra->user->usuario ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="1" cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="3" class="section-title">DATOS DE LA COMPRA</th>
                </tr>
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
                </tr>
                <tr>
                    <td width="30%" align="left">
                        <strong>Proveedor: </strong> <?= $compra->ProveedorCompra
                            ->ProveedorCompraMedidas()
                            ->where([['id', 4]])
                            ->get()
                            ->count() ?>
                    </td>
                    <td width="30%" align="left">
                        <strong>Fecha Salida: </strong> <?= $compra->fecha_salida ?>
                    </td>
                    <td width="30%" align="left">
                        <strong>Fecha Llegada: </strong> <?= $compra->fecha_llegada ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div class="tabla_borde">

    <?php


foreach ($compra->detalles as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <th align="center " colspan="8" class="bold">Tipo de cinta:
                        <?= isset($d['sub_medida']->name) ? $d['sub_medida']->name : '' ?></th>
                </tr>
                <tr class="border_top">

                    <th align="left" class="bold">N°</th>
                    <th align="left" class="bold">Pollos</th>
                    <th align="left" class="bold">Peso Bruto</th>
                    <th align="left" class="bold">Cajas</th>
                    <th align="left" class="bold">Taras</th>
                    <th align="left" class="bold">Peso Neto</th>
                    <th align="left" class="bold">PR-CJ-PB</th>
                    <th align="left" class="bold">Promedio Pollo</th>

                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval(isset($d['sub_medida']->medidaProducto->medida->retraccion) ? $d['sub_medida']->medidaProducto->medida->retraccion : 0);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                $filas = 1;
                if (isset($d['list'])) {
                    foreach ($d['list'] as $key => $i) {
                        $cantidad += $i->cant;
                        $nro += $i->nro;
                        $valor += $i->valor;
                        $neto += $i->valor - $retraccion * $i->cant;
                        $retraccionSum += $retraccion * $i->cant;
                        $peso_neto = $i->valor - $retraccion * $i->cant;
                        $promedio = $i->valor / $i->cant;
                        $promedioPollo = floatval($peso_neto) / floatval($i->nro == 0 ? 1 : $i->nro);
                        $Totalpromedio += $promedio;
                        $TotalpromedioPollo += $promedioPollo;
                        $filas++;
                    }
                }
                ?>
                <tr class="border_top">

                    <th align="left" class="bold">Total </th>
                    <th align="left" class="bold">Total Pollos</th>
                    <th align="left" class="bold">Total Peso Bruto</th>
                    <th align="left" class="bold">Total CJ</th>
                    <th align="left" class="bold">Total Tara</th>
                    <th align="left" class="bold">Total Peso Neto</th>
                    <th align="left" class="bold">Total PR-CJ-PB</th>
                    <th align="left" class="bold">Total Promedio Pollo</th>


                </tr>
                <tr class="border_top">

                    <td align="left" class=""> {{ $filas }} </td>
                    <td align="left" class=""> {{ $nro }} </td>
                    <td align="left" class=""> {{ $valor }} </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ $neto }} </td>
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <th align="left" class="bold" colspan="6"> </th>

                    <th align="left" class="bold"> {{ number_format($Totalpromedio / $filas, 2) }} </th>
                    <th align="left" class="bold"> {{ number_format($TotalpromedioPollo / $filas, 2) }} </th>




                </tr>
            </tbody>
        </table>
    </div>

    <?php
}


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
                ?>

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

                    <td align="left" class="" colspan="2"> {{ $nro }} </td>
                    <td align="left" class=""> {{ $valor }} </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ $neto }} </td>
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>




                </tr>
                <tr class="border_top">

                    <td align="left" class="bold" colspan="6"> </td>

                    <td align="left" class="bold">
                        {{ number_format($Totalpromedio / count($compra->detalles_sin_cita), 2) }} </td>
                    <td align="left" class="bold">
                        {{ number_format($TotalpromedioPollo / count($compra->detalles_sin_cita), 2) }} </td>




                </tr>
            </tbody>
        </table>
    </div>

    <?php
}

foreach ($compra->category_list as $d) {
?>
    <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <th align="center " colspan="4" class="bold">Categoria: <?= $d['categoria']->name ?></th>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong> Total Pollos:</strong> <?= $d['sumaPollos'] ?></td>
                    <td align="left" class="bold"><strong>Peso Bruto:</strong> <?= $d['sumaTotal'] ?></td>
                    <td align="left" class="bold"><strong>Peso Neto:</strong>
                        <?= number_format($d['sumaTotal'] - $d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 2) ?>
                    </td>
                    <td align="left" class="bold"><strong>Total Cant Tara:</strong>
                        <?= number_format($d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 2) ?>
                    </td>



                </tr>


            </tbody>
        </table>
    </div>

    <?php
}
?>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center " colspan="4" class="bold">TOTALES</th>
                </tr>
                <tr class="border_top">
                    <td align="left" class="bold"><strong>Total Pollos:</strong> <?= $compra->sum_cant_pollos ?></td>
                    <td align="left" class="bold"><strong>Peso Bruto:</strong> <?= $compra->sum_peso_bruto ?></td>
                    <td align="left" class="bold"><strong>Peso Neto:</strong> <?= $compra->sum_peso_neto ?></td>
                    <td align="left" class="bold"><strong>Total Cant:</strong> <?= $compra->sum_retraccion ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('Helvetica', 'normal');
            $pdf->page_text(520, 825, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, [0,0,0]);
        }
    </script>

</body>

</html>
