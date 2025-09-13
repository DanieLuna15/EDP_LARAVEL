<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        @page {
            size: 80mm 200mm;
            margin: 0;
        }

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

        .page_break {
            page-break-before: always;
        }

        .center {
            text-align: center;
        }

        .p-0 {
            padding: 0;
        }
    </style>
</head>

<body class="white-bg">

    <table width="100%">
        <tbody>
            <tr>
                <td style="padding-top:30px !important" class="center bold p-0">
                    {{$cajaEnvio->almacen_destino->sucursal->nombre}}

                </td>
            </tr>
            <tr>
                <td class="center p-0">
                    {{$cajaEnvio->almacen_destino->sucursal->direccion}}

                </td>
            </tr>
            <tr>
                <td class="center p-0">
                    Teléfono: {{$cajaEnvio->almacen_destino->sucursal->telefono}}

                </td>
            </tr>
           
            <tr>
                <td class="center p-0 bold ">
                    TICKET DE ENVIO DE CAJAS

                </td>
            </tr>
            <tr>
                <td style="padding:20px">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">FECHA:</td>
                                <td>{{$cajaEnvio->fecha}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">ORIGEN:</td>
                                <td>{{$cajaEnvio->almacen_origen->name}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">SUCURSAL DESTINO:</td>
                                <td>{{$cajaEnvio->almacen_destino->sucursal->nombre}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">ALMACEN DESTINO:</td>
                                <td>{{$cajaEnvio->almacen_destino->name}}</td>
                            </tr>
                            
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">NRO DE TRASPASO:</td>
                                <td>{{$cajaEnvio->id}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">MOTIVO:</td>
                                <td>{{$cajaEnvio->motivo}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">CHOFER:</td>
                                <td>{{$cajaEnvio->chofer}}</td>
                            </tr>
                            <tr>
                                <td class=" p-0 bold " style="width: 100px;">CAMION:</td>
                                <td>{{$cajaEnvio->camion}}</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                   
                        <div class="tabla_borde">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                <tbody>

                                   
                                    <tr >

                                  
                                        <td align="left" class="bold">CAJA</td>
                                        <td align="left" class="bold">CANT</td>
                                        <td align="left" class="bold">COMPRA</td>
                                        <td align="left" class="bold">VENTA</td>



                                    </tr>
                                    <?php
                         
                                    ?>
                                    <tr class="border_top">


                                          
                                        <td align="left" class="">{{$cajaEnvio->caja->name}}</td>
                                        <td align="left" class="">{{$cajaEnvio->cantidad}}</td>
                                        <td align="left" class="">{{$cajaEnvio->caja->compra}}</td>
                                        <td align="left" class="">{{$cajaEnvio->caja->venta}}</td>




                                        </tr>
                                  
                                     
                                </tbody>
                            </table>
                        </div>
                        <br>
                   
                </td>
            </tr>
             <tr>
              
             </tr>               
                        
        </tbody>
    </table>
</body>

</html>