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

                    @if(isset($informePreliminar->sucursal->image->path_url))
                    <img src="<?= $informePreliminar->sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile" style="width: 100px;">
                    @endif

                </td>
                <td width="5%" height="0" align="center"></td>
                <td width="45%" rowspan="" valign="bottom" style="padding-left:0">
                    <div class="tabla_borde">
                        <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">I N F O R M E </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">
                                        <span style="font-size:19px">N° <?= $informePreliminar->id ?>  </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <span style="font-size:14px">Fecha de registro: <?= $informePreliminar->fecha ?> </span>
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
                    <strong><span style="font-size:15px"><?= $informePreliminar->sucursal->nombre ?></span></strong>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong><?= $informePreliminar->sucursal->documento->name ?>: </strong><?= $informePreliminar->sucursal->doc ?>
                </td>
                <td align="left">
                    <strong>Email: </strong><?= $informePreliminar->sucursal->email ?>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong>Dirección: </strong><?= $informePreliminar->sucursal->direccion ?>
                </td>
                <td align="left">
                    <strong>Telefono: </strong><?= $informePreliminar->sucursal->telefono ?>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong>Responsable: </strong><?= $informePreliminar->sucursal->responsable ?>
                </td>
                <td align="left">
                    <strong>Medidor: </strong><?= $informePreliminar->sucursal->medidor ?>
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
                    <span style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; font-weight: bold;" text-align="center">DATOS DEL USUARIO</span>
                </td>

            </tr>
            <tr>
                <td>

                    <table width="100%" border="0" cellpadding="1" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="left"><strong>Nombre:</strong> <?= $informePreliminar->user->nombre ?> <?= $informePreliminar->user->apellidos ?></td>
                                <td align="left"><strong>Correo:</strong> <?= $informePreliminar->user->correo ?></td>




                            </tr>
                            <tr>

                                <td align="left">
                                    <strong>Usuario: </strong> <?= $informePreliminar->user->usuario ?>

                                </td>
                                <td align="left">
                                  

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
                    <strong>KG: </strong> <?= $informePreliminar->kg ?>

                </td>
                <td width="30%" align="left">
                    <strong>Cantidad: </strong> <?= $informePreliminar->cant ?>

                </td>

                <td width="30%" align="left">
                    <strong>Cajas: </strong> <?= $informePreliminar->cajas ?>

                </td>




            </tr>
            <tr>
                <td width="30%" align="left">
                    <strong>Pollos: </strong> <?= $informePreliminar->pollos ?>

                </td>
                <td width="30%" align="left">
                    <strong>Dia: </strong> <?= $informePreliminar->dia ?>

                </td>
              




            </tr>
            <tr>
            <td width="30%" colspan="3" align="left">
                    <strong>Observacion: </strong> <?= $informePreliminar->observacion ?>

                </td>

              






            </tr>



        </tbody>
    </table>
    </div>
    <br>

<div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>

                    <td align="center " colspan="4" class="bold">PROGRAMA TROZADO</td>
                </tr>
                <tr class="border_top">

                    <td align="left" class="bold">N°</td>
                    <td align="left" class="bold">PRODUCTO</td>
                    <td align="left" class="bold">PESO</td>
                    <td align="left" class="bold">VALOR</td>
        

                </tr>
                <?php


$key = 0;
foreach ($informePreliminar->detalles as $d) {
?>
                    <tr class="border_top">
                        <td align="left">
                            <?= $key + 1 ?>
                        </td>
                        <td align="left">
                            <?= $d->compoExterna->name ?>
                        </td>
                        <td align="left">
                            <?= $d->peso ?>
                        </td>
                        <td align="left">
                            <?= $d->peso*$informePreliminar->pollos?>
                        </td>
                        

                    </tr>
                <?php
                $key++;
                }
                ?>
            
            </tbody>
        </table>
        </div>
        <br>
<?php
foreach ($informePreliminar->detalles as $d) {
    ?>
    <div class="tabla_borde">
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tbody>
            <tr>

                <td align="center " colspan="3" class="bold">CUPOS DE FIL {{$d->compoExterna->name}}</td>
            </tr>
            <tr class="border_top">

                <td align="left" class="bold">N°</td>
                <td align="left" class="bold">COMPOSICION</td>
                <td align="left" class="bold">PESO</td>
              
    

            </tr>
            <?php


$x = 0;
foreach ($d->compoExterna->compoExternaDetalles as $e) {
?>
                <tr class="border_top">
                    <td align="left">
                        <?= $x + 1 ?>
                    </td>
                    <td align="left">
                        <?= $e->name ?>
                    </td>
                    <td align="left">
                        <?= $e->peso ?>
                    </td>
                   
                    

                </tr>
            <?php
            $x++;
            }
            ?>
            <tfoot>
                <tr>
                    <td colspan="2" align="right" class="bold">CUPO</td>
                    <td align="left" class="bold">
                        <?= $d->cupo ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="bold">CUPO DEL DIA</td>
                    <td align="left" class="bold">
                        <?= $d->cupo_dia ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="bold">TOTAL CUPO</td>
                    <td align="left" class="bold">
                        <?= $d->cupo_fit ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="bold">TOTAL KN  {{$d->compoExterna->name}}</td>
                    <td align="left" class="bold">
                        <?= $d->total_cupo_fit ?>
                    </td>
                </tr>
            </tfoot>
        </tbody>
    </table>
    </div>
    <br>
    <?php
            }
            ?>

</body>

</html>