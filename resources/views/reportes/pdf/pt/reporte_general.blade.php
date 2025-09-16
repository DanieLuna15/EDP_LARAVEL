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

        tr.descomp-head th {
            background: #E9F3FF !important;
        }

        tr.descomp-head-merma th {
            background: #f7f7e2 !important;
        }

        tr.total-final th {
            background: #eef7ee !important;
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
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            padding: 3px 0;
        }

        .section-content {
            font-size: 8px;
            padding: 3px 0;
        }
    </style>
</head>

@php
    use Carbon\Carbon;
@endphp

<body class="white-bg">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="40%" align="center" style="border:1px solid #ccc; vertical-align:middle;">
                @if (isset($sucursal->image->path_url))
                    <img src="<?= $sucursal->image->path_url ?>" class="img-fluid" alt="admin-profile"
                        style="width: 100px;">
                @endif
            </td>
            <td width="60%" valign="middle" style="border:1px solid #ccc;">
                <div style="padding: 8px;">
                    <div
                        style="background: #f2f2f2; font-weight: bold; font-size: 15px; text-align: center; padding: 6px 0; margin-bottom: 4px;">
                        REPORTE GENERAL PT&nbsp; N° <?= $pt->nro ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <span style="font-size:14px"><?= $pt->mes ?>
                    </div>
                    <div style="font-size:12px; text-align:right;">
                        <b>Fecha de Impresion:</b> <?= date('d/m/Y H:i:s') ?>
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
                        <strong>SUCURSAL:</strong>
                        <?= $sucursal->nombre ?>
                    </th>
                    <td style="width:34%; text-align:left;">
                        <strong>Dirección: </strong><?= $sucursal->direccion ?>
                    </td>
                    <td style="width:33%; text-align:left;">
                        <strong>Telefono: </strong><?= $sucursal->telefono ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="left" class="bold"><strong>PESO INICIAL</strong></th>
                    <th align="left" class="bold"><strong>FECHA/HORA</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>LOTE</strong></th>
                    <th align="left" class="bold"><strong>DETALLE</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>POLLOS</strong></th>
                    <th align="left" class="bold"><strong>KG/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/N</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $cajas = 0;
                    $pollos = 0;
                    $peso_bruto = 0;
                    $tara = 0;
                    $peso_neto = 0;
                    foreach ($pt->DetallePts()->get() as $de) {
                        $cajas += $de->cajas;
                        $pollos += $de->pollos;
                        $peso_bruto += $de->peso_bruto;
                        $tara += $de->peso_bruto-$de->peso_neto;
                        $peso_neto += $de->peso_neto;
                    ?>
                <tr class="border_top">
                    <td align="left" class="bold">
                        {{ $de->peso_inicial_tipo == 1 ? 'PESO INICIAL 1' : 'PESO INICIAL 2' }}</td>
                    <td align="left" class="bold">{{ $de->created_at }}</td>
                    <td align="left" class="bold">{{ $de->User->nombre }}</td>
                    <td align="left" class="bold">
                        {{ $de->LoteDetalle->Lote->Compra->ProveedorCompra->abreviatura }}-{{ $de->LoteDetalle->Lote->Compra->nro }}
                    </td>
                    <td align="left" class="bold">{{ $de->LoteDetalle->name }}</td>
                    <td align="left" class="bold">{{ number_format($de->cajas) }}</td>
                    <td align="left" class="bold">{{ number_format($de->pollos) }}</td>
                    <td align="left" class="bold">{{ number_format($de->peso_bruto, 3) }}</td>
                    <td align="left" class="bold">{{ number_format($de->peso_bruto - $de->peso_neto) }}</td>
                    <td align="left" class="bold">{{ number_format($de->peso_neto, 3) }}</td>
                </tr>
                <?php
                    }
                    ?>
                <tr class="border_top">
                    <th align="left" class="bold" colspan="5">TOTALES INICIAL</th>
                    <th align="left" class="bold">{{ number_format($cajas) }}</th>
                    <th align="left" class="bold">{{ number_format($pollos) }}</th>
                    <th align="left" class="bold">{{ number_format($peso_bruto, 3) }}</th>
                    <th align="left" class="bold">{{ number_format($tara) }}</th>
                    <th align="left" class="bold">{{ number_format($peso_neto, 3) }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" colspan="7" class="bold">
                        <strong>TRASPASOS DE PP</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">PP N°</th>
                    <th align="left" class="bold">FECHA/HORA</th>
                    <th align="left" class="bold">USUARIO</th>
                    <th align="left" class="bold">CAJAS</th>
                    <th align="left" class="bold">POLLOS</th>
                    <th align="left" class="bold">KG/B</th>
                    <th align="left" class="bold">KG/N</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($pt->traspasos_aceptados_pp ?? []) as $t) {
                    $kg_b_u = ($t['pollos'] ?? 0) ? $t['peso_bruto'] / $t['pollos'] : 0;
                    $kg_n_u = ($t['pollos'] ?? 0) ? $t['peso_neto']  / $t['pollos'] : 0;
                ?>
                <tr class="border_top">
                    <td class="bold"><?= $t['pp']['nro'] ?? '-' ?></td>
                    <td class="bold"><?= \Carbon\Carbon::parse($t['fecha'])->format('d/m/Y H:i:s') ?></td>
                    <td class="bold"><?= $t['user'] ?? '-' ?></td>
                    <td class="bold"><?= number_format($t['cajas']) ?></td>
                    <td class="bold"><?= number_format($t['pollos']) ?></td>
                    <td class="bold"><?= number_format($t['peso_bruto'], 3) ?></td>
                    <td class="bold"><?= number_format($t['peso_neto'], 3) ?></td>
                </tr>
                <?php } ?>

                <?php if (!empty($pt->traspasos_aceptados_pp_totales)) { $T = $pt->traspasos_aceptados_pp_totales; ?>
                <tr class="border_top">
                    <th align="left" class="bold" colspan="3">TOTALES ACEPTADOS PP a PT</th>
                    <th class="bold"><?= number_format($T['cajas']) ?></th>
                    <th class="bold"><?= number_format($T['pollos']) ?></th>
                    <th class="bold"><?= number_format($T['peso_bruto'], 3) ?></th>
                    <th class="bold"><?= number_format($T['peso_neto'], 3) ?></th>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <th align="center" colspan="5" class="bold"><strong>TOTAL INICIAL</strong></th>
                    <th align="center" width="10%" class="bold"><strong>POLLOS</strong></th>
                    <th align="center" width="10%" class="bold"><strong>KN</strong></th>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold"><strong>TRASPASOS (PP a PT)</strong></th>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['traspasos']['pollos'] ?? 0) ?>
                    </td>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['traspasos']['peso_neto'] ?? 0, 3) ?>
                    </td>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold"><strong>PESO INICIAL 1</strong></th>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['pi1']['pollos'] ?? 0) ?>
                    </td>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['pi1']['peso_neto'] ?? 0, 3) ?>
                    </td>
                </tr>
                <tr>
                    <th align="right" colspan="5" class="bold"><strong>PESO INICIAL 2</strong></th>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['pi2']['pollos'] ?? 0) ?>
                    </td>
                    <td align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['pi2']['peso_neto'] ?? 0, 3) ?>
                    </td>
                </tr>
                <tr class="border_top">
                    <th align="right" colspan="5" class="bold"><strong>TOTAL SALDO GENERAL</strong></th>
                    <th align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['totales']['pollos'] ?? 0) ?>
                    </th>
                    <th align="center" class="bold">
                        <?= number_format($pt->resumen_inicial['totales']['peso_neto'] ?? 0, 3) ?>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if (!empty($pt->listado_items_tipo_1['items'])) { ?>
    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="7" class="bold">TRASPASOS MENUDENCIAS (PP a PT)</th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">PP N°</th>
                    <th>FECHA/HORA</th>
                    <th>ITEM</th>
                    <th>USUARIO</th>
                    <th>CAJAS</th>
                    <th>KG/B</th>
                    <th>KG/N</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pt->listado_items_tipo_1['items'] as $i) { ?>
                <tr class="border_top">
                    <td class="bold"><?= $i['emisor_label'] ?></td>
                    <td class="bold"><?= \Carbon\Carbon::parse($i['fecha'])->format('d/m/Y H:i:s') ?></td>
                    <td class="bold"><?= $i['item_name'] ?></td>
                    <td class="bold"><?= $i['user_name'] ?></td>
                    <td class="bold"><?= number_format($i['cajas']) ?></td>
                    <td class="bold"><?= number_format($i['peso_bruto'], 3) ?></td>
                    <td class="bold"><?= number_format($i['peso_neto'], 3) ?></td>
                </tr>
                <?php } ?>
                <tr class="border_top">
                    <th colspan="4" class="bold" style="text-align:right;">TOTALES</th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_1['totales']['cajas']) ?></th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_1['totales']['peso_bruto'], 3) ?></th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_1['totales']['peso_neto'], 3) ?></th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php } ?>

    <?php if (!empty($pt->listado_items_tipo_2['items'])) { ?>
    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="7" class="bold">TRASPASOS SOBRANTES (PT a PT)</th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold">PT N°</th>
                    <th>FECHA/HORA</th>
                    <th>ITEM</th>
                    <th>USUARIO</th>
                    <th>CAJAS</th>
                    <th>KG/B</th>
                    <th>KG/N</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pt->listado_items_tipo_2['items'] as $i) { ?>
                <tr class="border_top">
                    <td class="bold"><?= $i['emisor_label'] ?></td>
                    <td class="bold"><?= \Carbon\Carbon::parse($i['fecha'])->format('d/m/Y H:i:s') ?></td>
                    <td class="bold"><?= $i['item_name'] ?></td>
                    <td class="bold"><?= $i['user_name'] ?></td>
                    <td class="bold"><?= number_format($i['cajas']) ?></td>
                    <td class="bold"><?= number_format($i['peso_bruto'], 3) ?></td>
                    <td class="bold"><?= number_format($i['peso_neto'], 3) ?></td>
                </tr>
                <?php } ?>
                <tr class="border_top">
                    <th colspan="4" class="bold" style="text-align:right;">TOTALES</th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_2['totales']['cajas']) ?></th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_2['totales']['peso_bruto'], 3) ?></th>
                    <th class="bold"><?= number_format($pt->listado_items_tipo_2['totales']['peso_neto'], 3) ?></th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php } ?>

    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" colspan="7" class="bold section-title">
                        <strong>PRIMERA TRANSFORMACIÓN</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>FECHA/HORA</strong></th>
                    <th align="left" class="bold"><strong>ITEM</strong></th>
                    <th align="left" class="bold"><strong>ENCARGADO</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>KG/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/N</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pt->bloques_descomp as $bloque) {
                    $p = $bloque['padre'];
                    $t = $bloque['totales_hijos'];
                    $m = $bloque['merma'];
                ?>

                <tr class="border_top bold descomp-head">
                    <th align="left" class="bold"><?= $p['fecha'] ?></th>
                    <th style="text-align: center" class="bold" colspan="2">
                        <strong>INICIAL DESCOMPOSICIÓN N° <?= $p['id'] ?> | <?= number_format($p['pollos']) ?>
                            POLLO(S)</strong>
                    </th>
                    <th align="left" class="bold"><?= number_format($p['cajas']) ?></th>
                    <th align="left" class="bold"><?= number_format($p['peso_bruto'], 3) ?></th>
                    <th align="left" class="bold"><?= number_format($p['tara']) ?></th>
                    <th align="left" class="bold"><?= number_format($p['peso_neto'], 3) ?></th>
                </tr>

                <?php foreach ($bloque['hijos'] as $h) { ?>
                <tr class="border_top">
                    <td align="left" class="bold"><?= $h['created_at'] ?></td>
                    <td align="left" class="bold"><?= $h['item_name'] ?></td>
                    <td align="left" class="bold"><?= $h['recep'] ?></td>
                    <td align="left" class="bold"><?= number_format($h['cajas']) ?></td>
                    <td align="left" class="bold"><?= number_format($h['peso_bruto'], 3) ?></td>
                    <td align="left" class="bold"><?= number_format($h['taras']) ?></td>
                    <td align="left" class="bold"><?= number_format($h['peso_neto'], 3) ?></td>
                </tr>
                <?php } ?>

                <tr class="border_top">
                    <th align="left" class="bold" colspan="3">SUBTOTALES DESCOMPOSICIÓN N° <?= $p['id'] ?>
                    </th>
                    <th align="left" class="bold"><?= number_format($t['cajas']) ?></th>
                    <th align="left" class="bold"><?= number_format($t['peso_bruto'], 3) ?></th>
                    <th align="left" class="bold"><?= number_format($t['taras']) ?></th>
                    <th align="left" class="bold"><?= number_format($t['peso_neto'], 3) ?></th>
                </tr>

                {{-- <?php if ($m['peso_neto'] > 0 || $m['peso_bruto'] > 0 || $m['taras'] > 0 || $m['cajas'] > 0) { ?> --}}
                <?php if ($m['peso_neto'] > 0 || $m['peso_bruto'] > 0 ) { ?>
                <tr class="border_top bold descomp-head-merma">
                    <th align="left" class="bold" colspan="3">MERMA DESCOMPOSICIÓN N° <?= $p['id'] ?></th>
                    <th align="left" class="bold"><?= number_format($m['cajas']) ?></th>
                    <th align="left" class="bold"><?= number_format($m['peso_bruto'], 3) ?></th>
                    <th align="left" class="bold"><?= number_format($m['taras']) ?></th>
                    <th align="left" class="bold"><?= number_format($m['peso_neto'], 3) ?></th>
                </tr>
                <?php } ?>

                <?php } ?>
            </tbody>
            <tr class="border_top bold">
                <td colspan="7"></td>
            </tr>
            <tfoot>
                <tr>
                    <th align="left" class="bold" colspan="3">TOTAL DESCOMPOSICIONES</th>
                    <td align="left" class="bold"><?= number_format($pt->totales_descomp['cajas']) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_descomp['peso_bruto'], 3) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_descomp['taras']) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_descomp['peso_neto'], 3) ?></td>
                </tr>
                <tr>
                    <th align="left" class="bold" colspan="3">TOTAL MERMAS</th>
                    <td align="left" class="bold"><?= number_format($pt->totales_merma['cajas']) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_merma['peso_bruto'], 3) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_merma['taras']) ?></td>
                    <td align="left" class="bold"><?= number_format($pt->totales_merma['peso_neto'], 3) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>


    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" colspan="5" class="bold section-title">
                        <strong>TOTAL POR ITEM (DESCOMPOSICIONES + TRASPASOS)</strong>
                    </th>
                </tr>
                <tr class="border_top">
                    <th align="left" class="bold"><strong>ITEM</strong></th>
                    <th align="left" class="bold"><strong>CAJAS</strong></th>
                    <th align="left" class="bold"><strong>KG/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>KG/N</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pt->totales_por_item as $row) { ?>
                <tr class="border_top">
                    <td class="bold"><?= $row['item_name'] ?></td>
                    <td class="bold"><?= number_format($row['cajas']) ?></td>
                    <td class="bold"><?= number_format($row['peso_bruto'], 3) ?></td>
                    <td class="bold"><?= number_format($row['taras']) ?></td>
                    <td class="bold"><?= number_format($row['peso_neto'], 3) ?></td>
                </tr>
                <?php } ?>

                <tr class="border_top">
                    <th align="left" class="bold">TOTAL ITEMS</th>
                    <th align="left" class="bold"><?= number_format($pt->totales_por_item_totales['cajas']) ?>
                    </th>
                    <th align="left" class="bold">
                        <?= number_format($pt->totales_por_item_totales['peso_bruto'], 3) ?></th>
                    <th align="left" class="bold"><?= number_format($pt->totales_por_item_totales['taras']) ?>
                    </th>
                    <th align="left" class="bold">
                        <?= number_format($pt->totales_por_item_totales['peso_neto'], 3) ?></th>
                </tr>
            </tbody>
        </table>
    </div>


    <?php if (!empty($pt->resumen_sobrante)) { $R = $pt->resumen_sobrante; ?>
    <div class="tabla_borde" style="margin-top:8px;">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
            <thead>
                <tr class="border_top bold descomp-head">
                    <th align="center" colspan="6" class="bold section-title"><strong>BALANCE FINAL DE
                            PT N° <?= $pt->nro ?></strong></th>
                </tr>
                <tr class="border_top">
                    <th class="bold" align="left">DETALLE</th>
                    <th class="bold">POLLOS</th>
                    <th class="bold">CAJAS</th>
                    <th class="bold">KG/B</th>
                    <th class="bold">TARA</th>
                    <th class="bold">KG/N</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border_top">
                    <th class="bold">TOTAL INICIAL</th>
                    <td class="bold"><?= number_format($R['inicial']['pollos'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['inicial']['cajas'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['inicial']['peso_bruto'] ?? 0, 3) ?></td>
                    <td class="bold"><?= number_format($R['inicial']['tara'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['inicial']['peso_neto'] ?? 0, 3) ?></td>
                </tr>
                <tr>
                    <th class="bold">(-) DESCOMPOSICIONES</th>
                    <td class="bold"><?= number_format($R['descomp']['pollos'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['descomp']['cajas'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['descomp']['peso_bruto'] ?? 0, 3) ?></td>
                    <td class="bold"><?= number_format($R['descomp']['tara'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['descomp']['peso_neto'] ?? 0, 3) ?></td>
                </tr>
                <tr>
                    <th class="bold">(-) MERMAS</th>
                    <td class="bold">-</td>
                    <td class="bold"><?= number_format($R['merma']['cajas'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['merma']['peso_bruto'] ?? 0, 3) ?></td>
                    <td class="bold"><?= number_format($R['merma']['tara'] ?? 0) ?></td>
                    <td class="bold"><?= number_format($R['merma']['peso_neto'] ?? 0, 3) ?></td>
                </tr>
                <tr class="border_top total-final">
                    <th class="bold">SOBRANTE FINAL</th>
                    <th class="bold"><?= number_format($R['sobrante']['pollos'] ?? 0) ?></th>
                    <th class="bold"><?= number_format($R['sobrante']['cajas'] ?? 0) ?></th>
                    <th class="bold"><?= number_format($R['sobrante']['peso_bruto'] ?? 0, 3) ?></th>
                    <th class="bold"><?= number_format($R['sobrante']['tara'] ?? 0) ?></th>
                    <th class="bold"><?= number_format($R['sobrante']['peso_neto'] ?? 0, 3) ?></th>
                </tr>
            </tbody>
        </table>
    </div>
    <?php } ?>


    @php
        $dias = ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
    @endphp

    {{-- ========== BLOQUES POR ÍTEM ========== --}}
    @foreach ($pt->ventas_por_item_bloques as $b)
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <thead>
                    <tr class="border_top bold descomp-head">
                        <th colspan="7" class="bold section-title" style="text-transform:uppercase;">
                            {{ $b['item_name'] ?? 'SIN NOMBRE' }}
                        </th>
                        <th class="bold section-title">KG/N</th>
                        <th class="bold section-title">{{ number_format($b['inicial']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="border_top">
                        <th class="bold" colspan="11">VENTAS</th>
                    </tr>
                    <tr>
                        <th align="left" class="bold">NDD</th>
                        <th align="left" class="bold">FECHA/HORA</th>
                        <th align="left" class="bold">DÍA</th>
                        <th align="left" class="bold">USUARIO</th>
                        <th align="left" class="bold">CLIENTE</th>
                        <th align="left" class="bold">CJ</th>
                        <th align="left" class="bold">KG/BR</th>
                        <th align="left" class="bold">TARA</th>
                        <th align="left" class="bold">KG/N</th>
                        <th align="left" class="bold">PRECIO</th>
                        <th align="left" class="bold">TOTAL BS.</th>
                    </tr>
                    @forelse ($b['ventas'] as $v)
                        @php
                            $fecha = $v['fecha'] ? Carbon::parse($v['fecha']) : null;
                            $dia = $fecha ? $dias[$fecha->dayOfWeek] : '';
                            $tagAnulado = $v['anulada'] ? ' <span style="color:#c00;">(ANULADO)</span>' : '';
                        @endphp
                        <tr class="border_top">
                            <td class="bold">{{ $v['venta_id'] }}</td>
                            <td class="bold">{{ $v['fecha'] }}</td>
                            <td class="bold">{{ $dia }}</td>
                            <td class="bold">{{ $v['usuario'] }}</td>
                            <td class="bold">
                                {!! e($v['cliente']) . ' | ' . e($v['cliente_id']) !!} {!! $tagAnulado !!}
                            </td>
                            <td class="bold">{{ number_format($v['cajas'] ?? 0) }}</td>
                            <td class="bold">{{ number_format($v['kg_bruto'] ?? 0, 3) }}
                            </td>
                            <td class="bold">{{ number_format($v['tara'] ?? 0, 0) }}
                            </td>
                            <td class="bold">{{ number_format($v['kg_neto'] ?? 0, 3) }}
                            </td>
                            <td class="bold">{{ number_format($v['precio'] ?? 0, 2) }}
                            </td>
                            <td class="bold">{{ number_format($v['total'] ?? 0, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr class="border_top bold descomp-head-merma">
                            <th colspan="11" style="text-align:center;">Sin ventas para este ítem.</th>
                        </tr>
                    @endforelse

                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">TOTALES VENTAS</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['kg_bruto'] ?? 0, 3) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['taras'] ?? 0, 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_ventas']['kg_neto'] ?? 0, 3) }}</th>
                        <th></th>
                        <th class="bold">{{ number_format($b['totales_ventas']['total'] ?? 0, 2) }}</th>
                    </tr>

                    <tr class="border_top">
                        <th class="bold" colspan="11">TRASPASOS A PT (SOBRANTE)</th>
                    </tr>
                    <tr>
                        <th align="left" class="bold">N°</th>
                        <th align="left" class="bold">FECHA/HORA</th>
                        <th align="left" class="bold">DÍA</th>
                        <th align="left" class="bold">USUARIO</th>
                        <th align="left" class="bold">DETALLE</th>
                        <th align="left" class="bold">CJ</th>
                        <th align="left" class="bold">KG/BR</th>
                        <th align="left" class="bold">TARA</th>
                        <th align="left" class="bold">KG/N</th>
                        <th colspan="2"></th>
                    </tr>

                    @forelse ($b['sobrantes_pt'] as $s)
                        @php
                            $f = $s['fecha'] ? Carbon::parse($s['fecha']) : null;
                            $dia = $f ? $dias[$f->dayOfWeek] : '';
                        @endphp
                        <tr class="border_top">
                            <td class="bold">{{ $s['sobra_id'] }}</td>
                            <td class="bold">{{ $s['fecha'] }}</td>
                            <td class="bold">{{ $dia }}</td>
                            <td class="bold">{{ $s['usuario'] }}</td>
                            <td class="bold">Sobrante enviado a PT</td>
                            <td class="bold">{{ number_format($s['cajas'] ?? 0) }}</td>
                            <td class="bold">{{ number_format($s['kg_bruto'] ?? 0, 3) }}</td>
                            <td class="bold">{{ number_format($s['tara'] ?? 0, 0) }}</td>
                            <td class="bold">{{ number_format($s['kg_neto'] ?? 0, 3) }}</td>
                            <td colspan="2"></td>
                        </tr>
                    @empty
                        <tr class="border_top bold descomp-head-merma">
                            <th colspan="11" style="text-align:center;">Sin sobrantes enviados a PT para este
                                ítem.</th>
                        </tr>
                    @endforelse

                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">TOTALES TRASPASOS A PT</th>
                        <th class="bold">{{ number_format($b['totales_sobrantes_pt']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_sobrantes_pt']['kg_bruto'] ?? 0, 3) }}</th>
                        <th class="bold">{{ number_format($b['totales_sobrantes_pt']['taras'] ?? 0, 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_sobrantes_pt']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>


                    <tr class="border_top">
                        <th class="bold" colspan="11">ENVÍOS A SUBTRANSFORMACIÓN</th>
                    </tr>
                    <tr>
                        <th align="left" class="bold">N°</th>
                        <th align="left" class="bold">FECHA/HORA</th>
                        <th align="left" class="bold">DÍA</th>
                        <th align="left" class="bold">USUARIO</th>
                        <th align="left" class="bold">DETALLE</th>
                        <th align="left" class="bold">CJ</th>
                        <th align="left" class="bold">KG/BR</th>
                        <th align="left" class="bold">TARA</th>
                        <th align="left" class="bold">KG/N</th>
                        <th colspan="2"></th>
                    </tr>


                    @forelse ($b['envios_transf'] as $t)
                        @php
                            $f = $t['fecha'] ? Carbon::parse($t['fecha']) : null;
                            $dia = $f ? $dias[$f->dayOfWeek] : '';
                        @endphp
                        <tr class="border_top">
                            <td class="bold">{{ $t['envio_id'] }}</td>
                            <td class="bold">{{ $t['fecha'] }}</td>
                            <td class="bold">{{ $dia }}</td>
                            <td class="bold">{{ $t['usuario'] }}</td>
                            <td class="bold">Envío a Subtransformación</td>
                            <td class="bold">{{ number_format($t['cajas'] ?? 0) }}</td>
                            <td class="bold">{{ number_format($t['kg_bruto'] ?? 0, 3) }}</td>
                            <td class="bold">{{ number_format($t['tara'] ?? 0, 0) }}</td>
                            <td class="bold">{{ number_format($t['kg_neto'] ?? 0, 3) }}</td>
                            <td colspan="2"></td>
                        </tr>
                    @empty
                        <tr class="border_top bold descomp-head-merma">
                            <th colspan="11" style="text-align:center;">Sin envíos a Subtransformación para este
                                ítem.</th>
                        </tr>
                    @endforelse

                    <tr class="border_top">
                        <th colspan="5" class="bold" style="text-align:right;">TOTALES ENVÍOS A
                            SUBTRANSFORMACIÓN</th< /th>
                        <th class="bold">{{ number_format($b['totales_envios_transf']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_envios_transf']['kg_bruto'] ?? 0, 3) }}</th>
                        <th class="bold">{{ number_format($b['totales_envios_transf']['taras'] ?? 0, 0) }}</th>
                        <th class="bold">{{ number_format($b['totales_envios_transf']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>


                    {{-- Saldo del ítem (inicial - ventas) --}}
                    <tr class="border_top bold descomp-head">
                        <th colspan="5" class="bold" style="text-align:right;">SALDO RESTANTE (MERMA)</th>
                        <th colspan="3"></th>
                        {{-- <th class="bold">{{ number_format($b['saldo']['cajas'] ?? 0) }}</th>
                        <th class="bold">{{ number_format($b['saldo']['kg_bruto'] ?? 0, 3) }}</th>
                        <th class="bold">{{ number_format($b['saldo']['taras'] ?? 0, 0) }}</th> --}}
                        <th class="bold">{{ number_format($b['saldo']['kg_neto'] ?? 0, 3) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
    {{-- ========== RESUMEN GLOBAL ========== --}}
    <div class="tabla_borde">
        <table width="100%" border="0" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="5" class="bold" style="text-align:center;">RESUMEN GLOBAL (TODOS LOS ÍTEMS)
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th class="bold">CJ</th>
                    <th class="bold">KG/BR</th>
                    <th class="bold">TARA</th>
                    <th class="bold">KG/N</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border_top">
                    <th class="bold">SALDO INICIAL ITEMS</th>
                    <th colspan="3"></th>
                    {{-- <th class="bold">{{ number_format($pt->ventas_resumen_global['inicial']['cajas'] ?? 0) }}</th>
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['inicial']['kg_bruto'] ?? 0, 3) }}
                    </th>
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['inicial']['taras'] ?? 0, 0) }}
                    </th> --}}
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['inicial']['kg_neto'] ?? 0, 3) }}
                    </th>
                </tr>
                <tr class="border_top">
                    <th class="bold">VENTAS</th>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['ventas']['cajas'] ?? 0) }}</td>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['ventas']['kg_bruto'] ?? 0, 3) }}
                    </td>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['ventas']['taras'] ?? 0, 0) }}</td>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['ventas']['kg_neto'] ?? 0, 3) }}
                    </td>
                </tr>
                <tr class="border_top">
                    <th class="bold">TRASPASOS A PT</th>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['sobrantes_pt']['cajas'] ?? 0) }}
                    </td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['sobrantes_pt']['kg_bruto'] ?? 0, 3) }}</td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['sobrantes_pt']['taras'] ?? 0, 0) }}</td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['sobrantes_pt']['kg_neto'] ?? 0, 3) }}</td>
                </tr>
                <tr class="border_top">
                    <th class="bold">ENVÍOS A SUBTRANSFORMACIÓN</th>
                    <td class="bold">{{ number_format($pt->ventas_resumen_global['envios_transf']['cajas'] ?? 0) }}
                    </td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['envios_transf']['kg_bruto'] ?? 0, 3) }}</td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['envios_transf']['taras'] ?? 0, 0) }}</td>
                    <td class="bold">
                        {{ number_format($pt->ventas_resumen_global['envios_transf']['kg_neto'] ?? 0, 3) }}</td>
                </tr>
                <tr class="border_top total-final">
                    <th class="bold">SALDO RESTANTE</th>
                    <th colspan="3"></th>
                    {{-- <th class="bold">{{ number_format($pt->ventas_resumen_global['saldo']['cajas'] ?? 0) }}</th>
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['saldo']['kg_bruto'] ?? 0, 3) }}
                    </th>
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['saldo']['taras'] ?? 0, 0) }}</th> --}}
                    <th class="bold">{{ number_format($pt->ventas_resumen_global['saldo']['kg_neto'] ?? 0, 3) }}
                    </th>
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
