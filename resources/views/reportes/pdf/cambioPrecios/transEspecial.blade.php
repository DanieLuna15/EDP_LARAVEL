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

        tr.border_top td {
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


    @foreach ($transEspecial as $item)
  

        <div class="tabla_borde">
            <table>
                <thead>
                    <tr>
                        <th colspan="10" class="section-title-main">
                            {{ $item->name }}
                        </th>
                    </tr>

                </thead>
                <tbody>
                    <tr class="border_top">
                        <th>
                            <strong>PRESA</strong>
                        </th>
                        <th><strong>PESO</strong></th>
                        <th><strong>PRECIO LPZ</strong></th>
                        <th><strong>BS</strong></th>
                        <th><strong>PROMEDIO</strong></th>
                        <th><strong>PRECIO ALT. 1</strong></th>
                        <th><strong>PRECIO ALT. 2</strong></th>
                        <th><strong>PRECIO ALT. 3</strong></th>
                        <th><strong>PRECIO ALT. 4</strong></th>
                        <th><strong>PRECIO ALT. 5</strong></th>             
                    </tr>
                    @foreach ($item->TransEspecialItems as $i)
                        <tr class="border_top">


                            <td align="left" class="bold"><strong>{{ $i->Item->name }}</strong></td>
                            <td align="left" class="bold"><strong>{{ $i->peso }}</strong></td>
                            <td align="left" class="bold" style="color:red"><strong>{{ $i->precio }}</strong>
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_2 }}</strong></td>

                            <td align="left" class="bold"><strong>{{ $i->promedio }}</strong></td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_1 }}</strong>
                                @if($i->estado_precio_alternativo_1 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_2 }}</strong>
                                @if($i->estado_precio_alternativo_2 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_3 }}</strong>
                                @if($i->estado_precio_alternativo_3 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_4 }}</strong>
                                @if($i->estado_precio_alternativo_4 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                            <td align="left" class="bold"><strong>{{ $i->precio_alternativo_5 }}</strong>
                                @if($i->estado_precio_alternativo_5 == 1)
                                    <span style="color: green; font-weight: bold;">(EN USO)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="border_top">
                        <th>
                            <strong>SUMA PESO</strong>
                        </th>
                        <th><strong>{{ $item->suma_peso }}</strong></th>

                        <th>PESO<strong></strong></th>
                        <th><strong>{{ $item->suma_precio }}</strong></th>
                        <th><strong>{{ $item->suma_promedio }}</strong></th>
                        <th colspan="5"><strong></strong></th>
                    </tr>
                    <tr class="border_top">
                        <th>
                            <strong>PRECIO APROX</strong>
                        </th>
                        <th><strong>{{ $item->precio_aprox }}</strong></th>

                        <th><strong>{{ $item->Item->name }}</strong></th>
                        <th><strong>{{ $item->promedio_item }}</strong></th>
                        <th><strong></strong></th>
                        <th colspan="5"><strong></strong></th>
                    </tr>
                </tbody>
            </table>

        </div>
    @endforeach



</body>

</html>
