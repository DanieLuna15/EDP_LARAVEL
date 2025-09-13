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
@php
    function format_peso($peso, $decimales = 3)
    {
        return number_format($peso, $decimales, '.');
    }
@endphp

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
                        <strong>Fecha Salida: </strong> <?= $compra->fecha_salida ?>
                    </td>
                    <td width="30%" align="left" colspan="2">
                        <strong>Fecha Llegada: </strong> <?= $compra->fecha_llegada ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div class="tabla_borde">
    <?php
   $total_cajas_general = 0;
        $antes = "";
        $despues = "";
foreach ($compra->lista_detalles as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center " colspan="9" class="bold"><?= $d['name'] ?> <?= $d['cinta'] ?> &
                        <?= $d['pigmento'] ?></th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">N°</th>
                    <th align="left" class="bold">Pollos</th>
                    <th align="left" class="bold">Pigmento</th>
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
                $retraccion = floatval($d['sub_medida']->medidaProducto->medida->retraccion);
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
                    $total_cajas_general += $i->cant;
                ?>
                <tr class="border_top">
                    <td align="left">
                        <?= $key + 1 ?>
                    </td>
                    <td align="left">
                        {{ $pollos }}
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
                        <?= format_peso($peso_neto, 3) ?>
                    </td>
                    <td align="left">
                        <?= number_format($promedio, 2) ?>
                    </td>
                    <td align="left">
                        <?= number_format(floatval($promedioPollo), 2) ?>
                    </td>
                </tr>
                <?php
                }
                ?>
                <tr class="border_top">
                    <th align="left" class="bold">Total </th>
                    <th align="left" class="bold">Total Pollos</th>
                    <th align="left" class="bold"></th>
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
                    <td align="left" class=""> </td>
                    <td align="left" class=""> {{ format_peso($valor) }} </td>
                    <td align="left" class=""> {{ $cantidad }} </td>
                    <td align="left" class=""> {{ $retraccionSum }} </td>
                    <td align="left" class=""> {{ format_peso($neto) }} </td>
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
                    <td align="left" class=""> {{ number_format($TotalpromedioPollo, 2) }} </td>
                </tr>
                <tr class="border_top">

                    <th align="left" class="bold" colspan="7"> </th>
                    <th align="left" class="bold"> {{ format_peso($Totalpromedio / $filas) }} </th>
                    <th align="left" class="bold"> {{ number_format($TotalpromedioPollo / $filas, 2) }} </th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
        $despues = $d['name'] ;
        $antes = $antes != $d['name']?$d['name']:'' ;
   $total_cajas = 0;
if($despues != $antes){
foreach ($compra->detalles_cinta as $de) {
    if($de['sub_medida']->name == $d['name']){
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <td align="center " colspan="9" class="bold">Sumatoria de cinta:
                        <?= $de['sub_medida']->name ?></td>
                </tr>
                <?php
                $cantidad = 0;
                $nro = 0;
                $valor = 0;
                $neto = 0;
                $retraccion = floatval($de['sub_medida']->medidaProducto->medida->retraccion);
                $retraccionSum = 0;
                $Totalpromedio = 0;
                $TotalpromedioPollo = 0;
                $filas = 0;
                foreach ($de['list'] as $key => $i) {
                    $pollos = $i->tipo_pollo==1?$i->nro:1;
                    $cantidad += $pollos;
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
                <?php
                }
                ?>
                <tr class="border_top">
                    <td align="left" class="bold">Total </td>
                    <td align="left" class="bold">Total Pollos</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold">Total CJ</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-CJ-PB</td>
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
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
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

    <?php
    }
}
}

?>
    <?php
}
?>



    <?php
   $total_cajas_sin_cinta = 0;

foreach ($compra->detalles_sin_cita as $d) {
?>
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="center " colspan="9" class="bold">Sumatoria: <?= $d['categoria']->name ?></td>
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
                    $total_cajas_sin_cinta += $i->cant;
                ?>


                <?php


                }
                ?>
                <tr class="border_top">

                    <td align="left" class="bold">Total </td>
                    <td align="left" class="bold">Total Pollos</td>
                    <td align="left" class="bold"></td>
                    <td align="left" class="bold">Total Peso Bruto</td>
                    <td align="left" class="bold">Total CJ</td>
                    <td align="left" class="bold">Total Tara</td>
                    <td align="left" class="bold">Total Peso Neto</td>
                    <td align="left" class="bold">Total PR-CJ-PB</td>
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
                    <td align="left" class=""> {{ number_format($Totalpromedio, 2) }} </td>
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

    <?php
}
?>



    <?php




foreach ($compra->category_list as $d) {
    //buscar si la categoria esta en el proveedor
    $buscar = $compra->ProveedorCompra->ProveedorCategorias()->where('categoria_id',$d['categoria']->id)->get();
    //si la categoria esta en el proveedor
    if($buscar->count() > 0){
        $sumaPollosCategoria = 0;
        $sumaValorCategoria = 0;
        $sumaValorNetoCategoria = 0;
        $sumaValorTaraCategoria = 0;
        $category = $buscar->first();
        // foreach ($compra->CompraInventarios()->where([["categoria_id",$category->categoria_id]])->get() as $i) {
        //recorrer los inventarios de la compra
        foreach ($compra->CompraInventarios()->get() as $i) {
            //buscar si la sub medida esta en el proveedor
            $buscar_sub = $category->ProveedorCategoriaDetalles()->where('sub_medida_id',$i->sub_medida_id)->get();
            //si la sub medida esta en el proveedor y la categoria es la misma
            if($buscar_sub->count() > 0 && $i->cinta == 1  ){
                $pollos = $i->tipo_pollo==1?$i->nro:0;
                $sumaPollosCategoria += $pollos;
                $sumaValorCategoria += $i->valor;
                $sumaValorNetoCategoria += $i->valor -($i->cant*2);
                $sumaValorTaraCategoria += ($i->cant*2);
            }
            if($i->cinta == 2 && $i->categoria_id == $category->categoria_id ){
                $pollos = $i->tipo_pollo==1?$i->nro:0;
                $sumaPollosCategoria += $pollos;
                $sumaValorCategoria += $i->valor;
                $sumaValorNetoCategoria += $i->valor -($i->cant*2);
                $sumaValorTaraCategoria += ($i->cant*2);
            }


            // $buscar_sub = $category->ProveedorCategoriaDetalles()->where('sub_medida_id',$i->sub_medida_id)->get()->count();
            // if($buscar_sub > 0){
            //     $sumaPollosCategoria += $i->nro;
            //     $sumaValorCategoria += $i->valor;
            //     $sumaValorNetoCategoria += $i->valor -($i->cant*2);
            //     $sumaValorTaraCategoria += ($i->cant*2);



            // }
        }
?>

    <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <th align="center " colspan="4" class="bold">CATEGORIA PROVEEDOR:
                        <?= $d['categoria']->name ?></th>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"><strong> Total Pollos:</strong>
                        {{ number_format($sumaPollosCategoria, 2) }}</td>
                    <td align="left" class="bold"><strong>Peso Bruto:</strong>
                        {{ format_peso($sumaValorCategoria, 3) }}</td>
                    <td align="left" class="bold"><strong>Peso Neto:</strong>
                        {{ format_peso($sumaValorNetoCategoria, 3) }}</td>
                    <td align="left" class="bold"><strong>Total Cant Tara:</strong>
                        {{ format_peso($sumaValorTaraCategoria, 3) }}
                    </td>



                </tr>


            </tbody>
        </table>
    </div>

    <?php
}
}
?>
    <?php
foreach ($compra->category_list as $d) {
?>
    <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <th align="center " colspan="4" class="bold">Categoria: <?= $d['categoria']->name ?></th>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold"> <strong> Total Pollos:</strong>
                        <?= number_format($d['sumaPollos'], 2) ?></td>
                    <td align="left" class="bold"> <strong>Peso Bruto:</strong>
                        <?= number_format($d['sumaTotal'], 2) ?></td>
                    <td align="left" class="bold"> <strong>Peso Neto:</strong>
                        <?= number_format($d['sumaTotal'] - $d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 2) ?>
                    </td>
                    <td align="left" class="bold"> <strong>Total Cant Tara:</strong>
                        <?= number_format($d['taras'] * floatval($d['submedida']->medidaProducto->Medida->retraccion), 2) ?>
                    </td>



                </tr>


            </tbody>
        </table>
    </div>

    <?php
}
?>
    <?php
foreach ($compra->lote_detalle_compras as $d) {
?>
    <div class="tabla_borde">


        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>


                    <td align="center " colspan="4" class="bold">{{ $d['lote_detalle']->name }}
                        {{ $d['lote_detalle']->Categoria->name }}</td>
                </tr>
                <tr class="border_top">

                    <td align="left" colspan="4" class="bold"> Faltante
                        <?= number_format($d['faltante'], 2) ?></td>




                </tr>


            </tbody>
        </table>
    </div>

    <?php
}
?>

    <!-- Totales -->
    <div class="tabla_borde">
        <table width="100%" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="5" class="section-title">TOTALES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total Pollos:</strong> <?= (int) $compra->sum_cant_pollos ?></td>
                    <td><strong>Total Cajas:</strong> <?= $total_cajas_general ?></td>
                    <td><strong>Peso Bruto:</strong> <?= format_peso($compra->sum_peso_bruto) ?></td>
                    <td><strong>Peso Neto:</strong> <?= format_peso($compra->sum_peso_neto) ?></td>
                    <td><strong>Total Tara:</strong> <?= format_peso($compra->sum_retraccion) ?></td>
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
