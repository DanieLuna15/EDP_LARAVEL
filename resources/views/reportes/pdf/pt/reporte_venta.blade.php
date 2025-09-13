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
@php
    use Carbon\Carbon;
@endphp
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
                    <td width="25%" rowspan="" valign="bottom" style="padding-left:0">
                        <div class="tabla_borde">
                            <table width="100%" border="0" height="50" cellpadding="2" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">REPORTE DE VENTAS</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px" text-align="center">P T &nbsp; N° <?= $pt->nro ?> </span>
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

@php
    $n=1;
    $dias = ['DOMINGO','LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
@endphp
@foreach ($pt->items as $item)



                    <tr class="{{$n!=1?'border_top':''}}">

                        <td align="left" class="bold"><strong>1</strong></td>
                        <td align="left" class="bold"><strong>{{$item['item']->name}}</strong></td>
                        <td  colspan="3" align="center" class="bold"><strong>MOVIMIENTOS</strong></td>
                        <td  align="left" class="bold"><strong>CJ</strong></td>
                        <td align="left" class="bold"><strong>KGB</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>KGN</strong></td>
                        <td align="left" class="bold"><strong>SALIDAS</strong></td>



                    </tr>
                    @php

        $mov_cajas = 0;
        $mov_kgb = 0;
        $mov_taras = 0;
        $mov_kgn = 0;
        @endphp
        @foreach ($item['movimientos'] as $mov)
        @php
        $mov_cajas += $mov['cajas'];
        $mov_kgb += $mov['kgb'];
        $mov_taras += $mov['taras'];
        $mov_kgn += $mov['kgn'];
        $fecha = Carbon::parse($mov['fecha']);
        @endphp
                    <tr class="border_top">
                        <td align="left" class="bold">{{$dias[$fecha->dayOfWeek]}}</td>
                        <td align="left" class="bold">{{$mov['fecha']}}</td>
                        <td align="left" class="bold">{{$mov['user']['nombre']}}</td>
                        <td align="left" class="bold"></td>
                        <td align="left" class="bold">{{$mov['motivo']}}</td>

                        <td align="left" class="bold">{{$mov['cajas']}}</td>
                        <td align="left" class="bold">{{$mov['kgb']}}</td>
                        <td align="left" class="bold">{{$mov['taras']}}</td>
                        <td align="left" class="bold">{{$mov['kgn']}}</td>
                        <td align="left" class="bold"></td>
                    </tr>
        @endforeach
        <tr class="border_top">
                        <td align="left" class="bold"></td>
                        <td colspan="4" align="right" class="bold"><strong>TOTALES</strong></td>
                        <td align="left" class="bold"><strong>{{$mov_cajas}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $mov_kgb)}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $mov_taras)}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $mov_kgn)}}</strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold"><strong>NDD</strong></td>
                        <td align="left" class="bold"><strong>FECHA</strong></td>
                        <td align="left" class="bold"><strong>DIA</strong></td>
                        <td align="left" class="bold"><strong>HRS</strong></td>
                        <td align="left" class="bold"><strong>CLIENTES</strong></td>
                        <td align="left" class="bold"><strong>CJ</strong></td>
                        <td align="left" class="bold"><strong>KGB</strong></td>
                        <td align="left" class="bold"><strong>TARA</strong></td>
                        <td align="left" class="bold"><strong>KGN</strong></td>
                        <td align="left" class="bold"><strong>SALIDAS</strong></td>
                    </tr>
                    @php


                    $total_movs_descuento = $mov_kgn;
                    $venta_cajas =0;
                    $venta_kgb =0;
                    $venta_taras =0;
                    $venta_kgn =0;
                    @endphp
            @foreach ($item['ventas'] as $mov)
        @php
        $total_movs_descuento = $total_movs_descuento - $mov['peso_neto'];
        $fecha = Carbon::parse($mov['venta']['fecha']);
        $hora = Carbon::parse($mov['venta']['created_at'])->format('H:i:s');
        $venta_cajas += $mov['cajas'];
        $venta_kgb += $mov['peso_bruto'];
        $venta_taras += $mov['taras'];
        $venta_kgn += $mov['peso_neto'];
        @endphp
                 <tr class="border_top">
                        <td align="left" class="bold">{{$mov['venta']['id']}}</td>
                        <td align="left" class="bold">{{$mov['venta']['fecha']}}</td>
                        <td align="left" class="bold">{{$dias[$fecha->dayOfWeek]}}</td>
                        <td align="left" class="bold">{{$hora}}</td>
                        <td align="left" class="bold">{{$mov['venta']['cliente']['nombre']}}</td>
                        <td align="left" class="bold">{{(int)$mov['cajas']}}</td>
                        <td align="left" class="bold">{{$mov['peso_bruto']}},</td>
                        <td align="left" class="bold">{{$mov['taras']}},</td>
                        <td align="left" class="bold">{{$mov['peso_neto']}},</td>
                        <td align="left" class="bold">{{sprintf('%0.3f', $total_movs_descuento)}}</td>
                    </tr>
        @endforeach

                    <tr class="border_top">
                        <td align="left" class="bold"></td>
                        <td colspan="4" align="right" class="bold"></td>
                        <td align="left" class="bold"><strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                        <td align="left" class="bold"><strong>0</strong></td>
                        <td align="left" class="bold"><strong>0</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $total_movs_descuento)}}</strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" class="bold">{{count($item['ventas'])}}</td>
                        <td colspan="4" align="right" class="bold"><strong>TOTALES</strong></td>
                        <td align="left" class="bold"><strong>{{(int)$venta_cajas}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $venta_kgb)}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $venta_taras)}}</strong></td>
                        <td align="left" class="bold"><strong>{{sprintf('%0.3f', $venta_kgn)}}</strong></td>
                        <td align="left" class="bold"><strong></strong></td>
                    </tr>
                    <tr class="border_top">
                        <td align="left" colspan="2" class="bold"><strong>CIERRE</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>INFORME</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>MERMA</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>MERMA</strong></td>
                        <td align="left" class="bold"><strong style="color: red;">FALTANTE</strong></td>

                        <td align="left" class="bold"><strong>TRASPASO</strong></td>

                    </tr>
                    <tr class="border_top">
                        <td align="left" colspan="2" class="bold"><strong>SALDOS</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>KG</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>%KG</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>EDP</strong></td>
                        <td align="left" class="bold"><strong ></strong></td>

                        <td align="left" class="bold"><strong></strong></td>

                    </tr>
                    <tr class="border_top">
                        <td align="left" colspan="2" class="bold"><strong>-</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>-</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>-</strong></td>
                        <td align="left" colspan="2" class="bold"><strong>-</strong></td>
                        <td align="left" class="bold"><strong >-</strong></td>

                        <td align="left" class="bold"><strong>-</strong></td>

                    </tr>
@php
    $n=$n+1;
@endphp
@endforeach
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <br>


    <br>



</body>

</html>
