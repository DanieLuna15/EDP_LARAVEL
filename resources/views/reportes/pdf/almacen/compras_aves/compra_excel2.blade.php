<style>
   
 
</style>

<table>
    <thead>
        <tr>
            <th style="background-color: #2c3e50; width:200px;color:white;">SUCURSAL</th>
            <th></th>
            <th style="background-color: #2c3e50; width:150px;color:white;">COMPRA - LOTE</th>
            <th></th>
            <th style="background-color: #2c3e50; width:150px;color:white;">FECHA</th>
        </tr>
    </thead>
    <tbody>
    
        <tr>
            <td style="background-color: #b5d2ef; width:200px;color:black;" class="td_body_custom">{{$compra->sucursal->nombre}}</td>
            <td></td>
            <td style="background-color: #b5d2ef; width:150px;color:black;" class="td_body_custom">N° {{$compra->id}} - {{$compra->nro}}</td>
            <td></td>
            <td style="background-color: #b5d2ef; width:150px;color:black;" class="td_body_custom">{{$compra->fecha}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th style="background-color: #2c3e50; width:200px;color:white;">{{$compra->sucursal->documento->name}} DE SUCURSAL</th>
            <th></th>
            <th style="background-color: #2c3e50; width:150px;color:white;">MEDIDOR</th>
            <th></th>
            <th style="background-color: #2c3e50; width:150px;color:white;">RESPONSABLE</th>
        </tr>
        <tr>
            <td style="background-color: #b5d2ef; width:150px;color:black;" class="td_body_custom">{{$compra->sucursal->doc}}</td>
            <td></td>
            <td style="background-color: #b5d2ef; width:150px;color:black;" class="td_body_custom">{{$compra->sucursal->medidor }}</td>
            <td></td>
            <td style="background-color: #b5d2ef; width:200px;color:black;" class="td_body_custom">{{$compra->sucursal->responsable}}</td>
        </tr>
        
        <?php


foreach ($compra->detalles_original as $d) {
?>
<tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
                <tr>
                    
                    <td align="center " style="background-color: #2c3e50;color:white;" colspan="8" class="bold">Tipo de cinta: <?= $d['sub_original']->name ?></td>
                </tr>
                <tr class="border_top">

                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">N°</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Aves</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Peso Bruto</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Jaula</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Taras</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Peso Neto</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">PR-JL-PB</td>
                    <td align="left" style="background-color: #2c3e50;color:white;" class="bold">Promedio Ave</td>

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
                    $promedioPollo = floatval($i->valor) / floatval($i->nro);
                    $Totalpromedio += $promedio;
                    $TotalpromedioPollo += $promedioPollo;
                ?>
                    <tr class="border_top">
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= $key+1 ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= $i->nro ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= $i->valor ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= $i->cant ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= $retraccion*$i->cant ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= number_format($peso_neto,2) ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= number_format($promedio,2) ?>
                        </td>
                        <td style="background-color: #b5d2ef;color:black;" align="left">
                            <?= number_format(floatval($promedioPollo),2) ?>
                        </td>

                    </tr>
                <?php
                }
                ?>
                <tr class="border_top">
             
                    <td style="background-color: #2c3e50;color:white;" align="left" colspan="2" class="bold">Total Aves</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Peso Bruto</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total JL</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Tara</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Peso Neto</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total PR-JL-PB</td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Promedio Ave</td>
                  

                </tr>
                <tr class="border_top">

                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" colspan="2"> {{$nro}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$valor}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$cantidad}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$retraccionSum}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$neto}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{number_format($Totalpromedio,2)}} </td>
                    <td style="background-color: #b5d2ef;color:black;" align="left" class="" > {{number_format($TotalpromedioPollo,2)}} </td>
                   
            
            

                </tr>
                <tr class="border_top">

                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold" colspan="6">  </td>
                
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold" > {{number_format($Totalpromedio/count($compra->detalles),2)}} </td>
                    <td style="background-color: #2c3e50;color:white;" align="left" class="bold" > {{number_format($TotalpromedioPollo/count($compra->detalles),2)}} </td>
                   
            
            

                </tr>

<?php
}
foreach ($compra->detalles_sin_cita as $d) {
                    ?>
                 <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
                                    <tr>
                                        
                                        <td style="background-color: #2c3e50;color:white;" align="center " colspan="8" class="bold">Producto de <?= $d['categoria']->name ?></td>
                                    </tr>
                                    <tr class="border_top">

                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">N°</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Aves</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Peso Bruto</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Jaula</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Taras</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Peso Neto</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">PR-JL-PB</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Promedio Ave</td>

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
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= $key+1 ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= $i->nro ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= $i->valor ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= $i->cant ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= $retraccion*$i->cant ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= number_format($peso_neto,2) ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= number_format($promedio,2) ?>
                                            </td>
                                            <td style="background-color: #b5d2ef;color:black;" align="left">
                                                <?= number_format(floatval($promedioPollo),2) ?>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr class="border_top">
                                 
                                        <td style="background-color: #2c3e50;color:white;"  align="left" colspan="2" class="bold">Total Aves</td>
                                        <td style="background-color: #2c3e50;color:white;"  align="left" class="bold">Total Peso Bruto</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total JL</td>
                                        <td style="background-color: #2c3e50;color:white;"  align="left" class="bold">Total Tara</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Peso Neto</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total PR-JL-PB</td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Promedio Ave</td>
                                      

                                    </tr>
                                    <tr class="border_top">

                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" colspan="2"> {{$nro}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$valor}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$cantidad}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$retraccionSum}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{$neto}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{number_format($Totalpromedio,2)}} </td>
                                        <td  style="background-color: #b5d2ef;color:black;" align="left" class="" > {{number_format($TotalpromedioPollo,2)}} </td>
                                       
                                
                                

                                    </tr>
                                    <tr class="border_top">

                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold" colspan="6">  </td>
                                    
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold" > {{number_format($Totalpromedio/count($compra->detalles_sin_cita),2)}} </td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold" > {{number_format($TotalpromedioPollo/count($compra->detalles_sin_cita),2)}} </td>
                                       
                                
                                

                                    </tr>
                           
                    <?php
                    }
                    ?>
                    <?php
                    foreach ($compra->category_list as $d) {
                    ?>
                     <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
                                    <tr>


                                        <td style="background-color: #2c3e50;color:white;" align="center " colspan="4" class="bold">Categoria: <?= $d['categoria']->name ?></td>
                                    </tr>
                                    <tr class="border_top">

                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold"> Total Aves <?= $d['sumaPollos'] ?></td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Peso Bruto <?= $d['sumaTotal'] ?></td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Peso Neto <?= number_format($d['sumaTotal']-($d['taras']*floatval($d['submedida']->medidaProducto->Medida->retraccion)),2)  ?></td>
                                        <td style="background-color: #2c3e50;color:white;" align="left" class="bold">Total Cant Tara <?= number_format($d['taras']*floatval($d['submedida']->medidaProducto->Medida->retraccion),2) ?></td>



                                    </tr>


                    <?php
                    }
                    ?>
                    <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
               
                                    <tr>


                                        <td style="background-color: #2c3e50;color:white;" align="center " colspan="4" class="bold">TOTALES</td>
                                    </tr>
                                    <tr class="border_top">

                                        <td style="background-color: #b5d2ef;color:black;" align="left" class="bold"> Total Aves <?= $compra->sum_cant_pollos ?></td>
                                        <td style="background-color: #b5d2ef;color:black;" align="left" class="bold">Peso Bruto <?= $compra->sum_peso_bruto ?></td>
                                        <td style="background-color: #b5d2ef;color:black;" align="left" class="bold">Peso Neto  <?= $compra->sum_peso_neto ?></td>
                                        <td style="background-color: #b5d2ef;color:black;" align="left" class="bold">Total Cant  <?= $compra->sum_retraccion ?></td>



                                    </tr>


                       
                  



    </tbody>
</table>