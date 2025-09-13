@foreach ($transformacionLote->list_items_pt as $item)
<table>
    <thead>
        <tr>
            <th style="font-weight:bold;" >MOV</th>
            <th></th>
            <th  style="font-weight:bold;" colspan="3">DETALLE DE TRASPASOS</th>
            <th  style="font-weight:bold;" colspan="2">TOTALES</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td  style="font-weight:bold;">1</td>
            <td></td>
            <td  style="font-weight:bold;font-size:14px;">PT-{{$item['pt']->nro}}</td>
        </tr>
        <tr>
            <td ></td>
            <td></td>
            <td  style="background-color:#4472C4;color:white " colspan="2">PRODUCTO</td>
            <td></td>
            <td  style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black" colspan="2">{{$item['item']->name}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td ></td>
            <td></td>
            <td style="background-color:#4472C4;color:white ">TRASPASO</td>
            <td style="background-color:#4472C4;color:white ">PT-12</td>
            <td></td>
            <td style="background-color:#4472C4;color:white ">1221</td>
            <td style="background-color:#4472C4;color:white ">1221</td>
        </tr>
        <tr>
            <td ></td>
            <td></td>
            <td style="background-color:#4472C4;color:white "> TRASPASO</td>
            <td style="background-color:#4472C4;color:white " >PT-12</td>
            <td></td>
            <td style="background-color:#4472C4;color:white ">1221</td>
            <td style="background-color:#4472C4;color:white ">1221</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td ></td>
            <td></td>
            <td  style="font-weight:bold;background-color:#4472C4;color:white " colspan="2">TOTALES</td>
            <td></td>
            <td style="border: 1px solid black; ">1221</td>
            <td style="border: 1px solid black; ">1221</td>
        </tr>
        <tr>
            <td ></td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td  style="font-weight:bold;font-size:14px;background-color:#9BC2E6;border: 1px solid black;" colspan="2">{{$item['item']->name}}</td>
        </tr>
        <tr>
            <td ></td>
            <td style="font-weight: bold;">USUARIO</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black; " width="120px" >FECHA</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" width="120px">RESP/TRAS</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" >ORIGEN</td>
            <td ></td>
            <td ></td>
            <td ></td>
            @php
                $subitems = [];
            @endphp
            @foreach ($transformacionLote->sub_item_lista as $subitem)
             @foreach ($item['entregados'] as  $list)
                @php
                    $search = $list->SubItemPtTransformacionLotes()->where('subitem_id',$subitem->id)->get();

                    if($search->count()>0 && !isset($subitems[$subitem->name])){
                        $subitems[$subitem->name] = $subitem->name;

                    }
                @endphp

            @endforeach
            @if (isset($subitems[$subitem->name]))
                    <td></td>
                    <td colspan="2"></td>
            @endif
            @endforeach
            <td></td>
            <td style="background-color:#BDD7EE;border: 1px solid black;">TOTALES</td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" >PT</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" >KG/BR</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" >CJ</td>
            <td  style="background-color:#BDD7EE;border: 1px solid black;" width="120px">CIERRE</td>
            @php
                $subitems = [];
            @endphp
            @foreach ($transformacionLote->sub_item_lista as $subitem)
             @foreach ($item['entregados'] as  $list)
            @php
                $search = $list->SubItemPtTransformacionLotes()->where('subitem_id',$subitem->id)->get();

                if($search->count()>0 && !isset($subitems[$subitem->name])){
                    $subitems[] = $subitem->name;
                    tdHeadSubItem($subitem->name);
                }
            @endphp

            @endforeach
            @endforeach

            {{tdCustomTotales()}}
        </tr>
        @php
            $peso_bruto_t = 0;
            $cajas_t = 0;
            $subitems = [];
        @endphp
        @foreach ($item['entregados'] as  $list)
        @php
            $peso_bruto_t += $list->peso_bruto;
            $cajas_t += $list->cajas;
        @endphp
        <tr>
            <td ></td>
            <td style="font-weight: bold;">{{$list->user->nombre}}</td>
            <td >{{$list->fecha}}</td>
            <td >{{$list->encargado}}</td>
            <td >PT-{{$list->pt->nro}}</td>
            <td >{{sprintf('%0.3f', $list->peso_bruto)}}</td>
            <td >{{$list->cajas}}</td>
            <td >{{$list->cierre}}</td>
            @foreach ($transformacionLote->sub_item_lista as $subitem)
            @php
                $search = $list->SubItemPtTransformacionLotes()->where('subitem_id',$subitem->id)->get();
                $v1= "";
                $v2= "";
                if($search->count()>0){
                    $v1 = $search->first()->peso_bruto;
                    $v2 = $search->first()->cajas;
                    $v1 = sprintf('%0.3f', $v1);
                    $v2 = sprintf('%0.3f', $v2);
                    tdSubItem($v1,$v2);
                }
            @endphp

            @endforeach

        </tr>
        @endforeach
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td style="background-color:#BDD7EE;border: 1px solid black;">{{sprintf('%0.3f', $peso_bruto_t)}}</td>
            <td style="background-color:#BDD7EE;border: 1px solid black;">{{$cajas_t}}</td>
            <td ></td>
            @php
                $subitems = [];
            @endphp
            @foreach ($transformacionLote->sub_item_lista as $subitem)
            @php

                $v1= 0;
                $v2= 0;
                foreach ($item['entregados'] as  $list){
                    $search = $list->SubItemPtTransformacionLotes()->where('subitem_id',$subitem->id)->get();
                    if($search->count()>0 && !isset($subitems[$subitem->name])){
                        $subitems[$subitem->name] = $subitem->name;
                        $v1 += $search->first()->peso_bruto;
                        $v2 += $search->first()->cajas;
                    }

                }

            @endphp
            @if(isset($subitems[$subitem->name]))
            {{tdTotalSubItem($v1,$v2)}}
            @endif

            @endforeach



        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td >TOTALES</td>
            <td ></td>
            <td ></td>
            <td style="background-color:#BDD7EE;border: 1px solid black;">KN</td>
            <td style="background-color:#BDD7EE;border: 1px solid black;">{{sprintf('%0.3f', ($peso_bruto_t-($cajas_t*2)))}}</td>
            @php
                $sub_cajas= 0;
                $sub_peso_bruto= 0;
                $sub_peso_neto= 0;
                $subitems = [];
            @endphp
            <td ></td>

            @foreach ($transformacionLote->sub_item_lista as $subitem)
            @php
                $v1= 0;
                $v2= 0;
                foreach ($item['entregados'] as  $list){
                    $search = $list->SubItemPtTransformacionLotes()->where('subitem_id',$subitem->id)->get();
                    if($search->count()>0 && !isset($subitems[$subitem->name])){
                        $subitems[$subitem->name] = $subitem->name;
                        $v1 += $search->first()->peso_bruto;
                        $v2 += $search->first()->cajas;

                    }

                }
                $total = ($v1-($v2*2));
                $sub_cajas += $v2;
                $sub_peso_bruto += $v1;
                $sub_peso_neto += $total;

            @endphp
            @if(isset($subitems[$subitem->name]))
            {{tdTotal2SubItem($total)}}
            @endif

            @endforeach
            {{tdFooterTotales($sub_peso_bruto,$sub_cajas,$sub_peso_neto,4,5,6,7,8)}}
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td colspan="2" style="font-weight: bold;">RESTANTES</td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td colspan="2" style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black">{{$item['item']->name}}</td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black">KG/NT</td>
            <td style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black">CJ/APROX</td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black">2121</td>
            <td style="font-weight:bold;background-color:#4472C4;color:white;border: 1px solid black">2</td>
        </tr>
        <tr>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td >1</td>

        </tr>
        <tr >
            <td  style="background-color:#A9A9A9" colspan="19"></td>
        </tr>
    </tbody>
</table>

@endforeach

@php
    function tdHeadSubItem($value){
        echo '
        <td ></td>
        <td colspan="2" style="background-color:#BDD7EE;border: 1px solid black;">'.$value.'</td>';
    }
    function tdTotalSubItem($v1,$v2){
        echo '
        <td ></td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v1).'</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.$v2.'</td>';
    }
    function tdTotal2SubItem($v1){
        echo '
        <td ></td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">KN</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v1).'</td>';
    }
    function tdSubItem($value,$value2){
        echo '
        <td ></td>
        <td>'.$value.'</td>
        <td>'.$value2.'</td>';
    }
    function tdCustomTotales(){
        echo '
        <td ></td>
        <td>KG/BR</td>
        <td>CJ</td>
        <td ></td>
        <td>INI/NT </td>
        <td>TRS/NT </td>
        <td>INF</td>
        <td>MERMA</td>
        <td>ME. EDP</td>
        <td style="font-weight:bold;color:red ">FALTANTE</td>
';
    }
    function tdFooterTotales($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8){
        echo '
        <td ></td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v1).'</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.$v2.'</td>
        <td  style="background-color:#BDD7EE;border: 1px solid black;"></td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v3).' </td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v4).' </td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v5).'</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v6).'</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v7).'</td>
        <td style="background-color:#BDD7EE;border: 1px solid black;">'.sprintf('%0.3f', $v8).'</td>
';
    }
@endphp
