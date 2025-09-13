<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> AJUSTE DE DOTACION </title>
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
            font-family: Tahoma, Geneva, sans-serif;
        }
        .text-center{
            text-align: center;
        }
        .m-0{
            margin: 0;
        }
        .p-0{
            padding: 0;
        }
        .fs-15{
            font-size: 15px;
        }
        .mt-3{
            margin-top: 12px;
        }
        .text-left{
            text-align: left;
        }
        .fs-10{
            font-size: 10px;
        }
        .body {
            padding: 20px;
        }
        .border-head {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

    </style>
</head>

<body class="body">

    <div class="container mt-3">
        <h3 class="text-center m-0 p-0">{{$ajuste->sucursal->nombre}}</h3>
        <p class="text-center m-0 p-0 fs-15"><?=$ajuste->sucursal->documento->name?>: </strong><?=$ajuste->sucursal->doc?> </p>
        <p class="text-left m-0 p-0 fs-10 mt-3"><strong>NRO AJUSTE :</strong> {{$ajuste->id}}</p>
        <p class="text-left m-0 p-0 fs-10 "><strong>FECHA:</strong> {{ $ajuste->fecha}}</p>
        <p class="text-left m-0 p-0 fs-10 "><strong>MOTIVO :</strong> {{$ajuste->motivo}}</p>
        <p class="text-left m-0 p-0 fs-10 "><strong>USUARIO :</strong> {{$ajuste->user->usuario}}</p>
        <table class="table mt-3">
            <thead class="border-head">
                <tr >

                    <th class="fs-10">DESCRIPCION</th>
                    <th class="fs-10">COSTO</th>
                    <th class="fs-10">ANTES</th>
                    <th class="fs-10">AJUSTE</th>
                    <th class="fs-10">DESPUES</th>
                </tr>
            </thead>
            <tbody>
                   <?php
                                        foreach($ajuste->detalles as $s){
                                       ?>
                                <tr class="border_top">
                                    <td  class="fs-10" align="left">
                                    <?=$s->stockdotaciondetail->dotacion->name?>
                                    </td>
                                    <td  class="fs-10" align="left">
                                    <?=$s->stockdotaciondetail->costo?>
                                    </td>
                                    <td align="center">
                                    <?=$s->antes?>
                                    </td>
                                    <td align="center">
                                    <?=$s->ahora?>
                                    </td>

                                    <td align="center">
                                    <?=floatval($s->despues)?>
                                    </td>
                                </tr>
                                <?php
                                      }
                                       ?>
            </tbody>
        </table>
    </div>
</body>

</html>
