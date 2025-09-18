@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <div class="table-wrapper">
                                            <table class="table" >
                                                <thead>
                                                    <th>Nro Compra</th>
                                                    <th>Lote</th>
                                                    <template v-for="m in listaCintasCajaCerrada">
                                                        <th>{{ m }}</th>
                                                    </template>
                                                    <th>TOTAL</th>
                                                    <th class="action-column">ACCION</th>
                                                </thead>
                                                <tbody>
                                                    <template v-for="m in cajaCerradaFiltro">
                                                        <tr>
                                                            <td>{{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro_compra }}
                                                            </td>
                                                            <td>{{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro }}
                                                            </td>
                                                            <template v-for="c in m.filtro_cintas_cajas">
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mx-2">
                                                                            {{ Number(c . lote_detalle . cajas - c . envios) }}
                                                                            ({{ Number(c . lote_detalle . promedio) . toFixed(2) }})

                                                                        </div>
                                                                        <button v-if="c.lote_detalle.cajas>0"
                                                                            :disabled="cliente.id == ''" class="btn btn-success p-1"
                                                                            @click="AddDetalle(c.lote_detalle,c.compra,c.cinta,c.dias)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-plus">
                                                                                <line x1="12" y1="5"
                                                                                    x2="12" y2="19"></line>
                                                                                <line x1="5" y1="12"
                                                                                    x2="19" y2="12"></line>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </template>
                                                            <td>{{ m . total_cajas }}</td>
                                                            <td>
                                                                <button class="btn btn-sm w-100 mt-2" :class="'btn-' + bandera(m)"
                                                                    @click="FinalizarLote(m.id)">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                        <line x1="4" y1="4" x2="12" y2="12"></line>
                                                                        <line x1="12" y1="4" x2="4" y2="12"></line>
                                                                    </svg>
                                                                    CERRAR LOTE
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                     <tr class="bg-primary">
                                                        <th colspan="2" class="text-white">
                                                            TOTALES
                                                        </th>
                                                        <template v-for="c in totales_cintas">
                                                            <th class="text-white">
                                                                {{ c . total_cajas }}
                                                            </th>
                                                        </template>
                                                        <th class="text-white"  colspan="2">
                                                            {{ total_cinta }}
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="17" class="text-center bg-primary text-white">DETALLE VENTA</th>
                                                </tr>
                                                <tr>
                                                    <th>TIPO</th>
                                                    <th>LOTE</th>
                                                    <th>N COMPRA</th>
                                                    <th>CINTA</th>
                                                    <th>PIGMENTO</th>
                                                    <th>CAJAS</th>
                                                    <th>POLLOS</th>
                                                    <th>PESO BRUTO</th>
                                                    <th>TARA</th>
                                                    <th>PESO NETO</th>
                                                    <th>P. NETO U.</th>
                                                    <th>P. BRUTO U.</th>
                                                    <th>
                                                        DESC/REC
                                                    </th>
                                                    <th>Desc/Rec Total </th>
                                                    <th>Precio Kg </th>
                                                    <th>Total Bs/ </th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(l,i) in CartLotesModel">
                                                    <td>CAJA</td>
                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro }}</td>
                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro_compra }}</td>
                                                    <td :class="'bg-' + bandera(l) + ' text-white'">{{ l . cinta }}</td>
                                                    <td>{{ l . pigmento == 1 ? 'SI' : 'NO' }}</td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly
                                                            :value="l.cajas" @change="changeCajas(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly :value="l.equivalente" @change="changeLote(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly :value="l.peso_mod_bruto" @change="changeLoteM(l)" class="form-control">
                                                    </td>
                                                    <td>{{ Math.ceil(l.peso_mod_bruto - l.peso_mod_neto) }}</td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly :value="l.peso_mod_neto" @change="changeLoteM(l)" class="form-control">
                                                    </td>

                                                    <td>{{ l . peso_unitario_bruto }}</td>
                                                    <td>{{ l . peso_unitario_neto }}</td>
                                                    <td>{{ l . descuento_pollo_limpio }}</td>

                                                    <td>{{ Number(l . descuento_valor) . toFixed(2) }}</td>
                                                    <td>{{ Number(l . valor_precio) . toFixed(2) }}</td>
                                                    <td>{{ Number(l . total_final) . toFixed(2) }}</td>



                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_lotes.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10" y2="17">
                                                                </line>
                                                                <line x1="14" y1="11" x2="14" y2="17">
                                                                </line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>


                                                <template v-for="(l, i) in cart_pps" :key="i">
                                                    <tr>
                                                    <td>PP-{{ l.pp.nro }} ({{ l.grupo_name }})</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td class="bg-info text-white">
                                                        {{ l.tipo_pp === 1 ? 'POLLO COMPLETO' : 'POLLO LIMPIO' }}
                                                    </td>
                                                    <td>***</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" readonly :value="l.cajas_vender">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" readonly :value="l.pollos_vender">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" readonly :value="l.peso_bruto_vender">
                                                    </td>
                                                    <td>{{ Math.ceil(l.peso_bruto_vender - l.peso_neto_vender) }}</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" readonly :value="l.peso_neto_vender">
                                                    </td>
                                                    <td>{{ Number(l.peso_neto_unit).toFixed(2) }}</td>
                                                    <td>{{ Number(l.peso_bruto_unit).toFixed(2) }}</td>
                                                    <td>Descuento</td>
                                                    <td>Recargo</td>
                                                    <td>{{ Number(l.precio_acuerdo).toFixed(2) }}</td>
                                                    <td>
                                                        <strong>{{ Number(l.subdetalle ? l.subdetalle.total_sin_descuento : l.total).toFixed(2) }}</strong>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_pps.splice(i,1)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-trash-2">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                        </button>
                                                    </td>
                                                    </tr>
                                                     <tr v-if="l.subdetalle && l.subdetalle.descuento_valor > 0" style="background:#eef6fa;">
                                                        <td></td>
                                                        <td colspan="3">
                                                            <b>Subitem:</b> {{ l.subdetalle.item_nombre || '---' }}
                                                        </td>
                                                        <td colspan="3">
                                                            <b>Acuerdo:</b> {{ l.subdetalle.acuerdo ? l.subdetalle.acuerdo.name : '---' }}
                                                        </td>
                                                        <td colspan="4">
                                                            <b>Descuento:</b>
                                                            {{ Number(l.subdetalle.peso).toFixed(2) }}
                                                            x
                                                            {{ l.subdetalle.cantidad }}
                                                            =
                                                            {{ Number(l.subdetalle.descuento_valor).toFixed(2) }}
                                                        </td>
                                                        <td colspan="2"></td>
                                                        <td colspan="2">
                                                            <b>Total con descuento:</b>
                                                            <span class="text-success">
                                                                {{ Number(l.subdetalle.total_con_descuento).toFixed(2) }}
                                                            </span>
                                                        </td>
                                                        <td></td>

                                                    </tr>
                                                </template>

                                                <tr v-for="(item,i) in CartPtsModel" class="tr-hover">
                                                    <td>PT-{{ item . nro }}</td>
                                                    <td>***</td>
                                                    <td>***</td>

                                                    <td>{{ item . item . name }}</td>
                                                    <td>***</td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.cajas_vender" @change="changeCajasItem(item)"> </td>
                                                    <td>***</td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.peso_bruto_vender" @change="changePesoBrutoItem(item)">
                                                    </td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.tara_vender"> </td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.peso_neto_vender" @change="changePesoNetoItem(item)">
                                                    </td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>{{ item . descuento_valor }}</td>

                                                    <td>{{ Number(item . descuento_total) . toFixed(2) }}</td>
                                                    <td>{{ Number(item . item . venta) . toFixed(2) }}</td>
                                                    <td>{{ Number(item . total_final) . toFixed(2) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_pts.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-for="(item,i) in CartTransformacions" class="tr-hover">
                                                    <td>PT-{{ item . pt . nro }}</td>
                                                    <td>***</td>
                                                    <td>***</td>

                                                    <td>{{ item . subitem . name }}</td>
                                                    <td>***</td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.total_cajas" @change="changeCajasItem(item)"> </td>
                                                    <td>***</td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.total_peso_bruto" @change="changePesoBrutoItem(item)">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" readonly
                                                                :value="((item.total_peso_bruto - item.total_peso_neto) < 0
                                                                        ? 0
                                                                        : (item.total_peso_bruto - item.total_peso_neto)).toFixed(2)">
                                                    </td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.total_peso_neto" @change="changePesoNetoItem(item)">
                                                    </td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>

                                                    <td>***</td>
                                                    <td>{{ Number(item . subitem . venta) . toFixed(2) }}</td>
                                                    <td>{{ Number(item . total_final) . toFixed(2) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger p-1"
                                                            @click="transformacion_cart.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-for="(item,i) in GastosModel" class="tr-hover">
                                                    <td>GASTO</td>
                                                    <td>{{ item . detalle }}</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>{{ Number(item . valor) . toFixed(2) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_gastos_model.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-for="(item,i) in cart_acuerdo_items" class="tr-hover">
                                                    <td>ITEM</td>
                                                    <td>{{ item.item }}</td>
                                                    <td>{{ item.cod }}</td>
                                                    <td>***</td>
                                                    <td>***</td>

                                                    <td>{{ item.cajas }}</td>
                                                    <td>{{ item.unidad }}</td>
                                                    <td>{{ item.peso_bruto }}</td>
                                                    <td>{{ item.tara }}</td>
                                                    <td>{{ item.peso_neto }}</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td>{{ item.precio_kg }}</td>
                                                    <td>{{item.total }}</td>
                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_acuerdo_items.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>


                                                </tr>
                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <td colspan="15" class="text-right"><strong>TOTAL</strong></td>
                                                    <td>{{ Number(totalAll) . toFixed(2) }}</td>
                                                    <td></td>

                                                </tr>
                                                <tr>
                                                    <td colspan="15" class="text-right"><strong>TOTAL CAJAS</strong></td>
                                                    <td>{{ Number(totalCajas) }}</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 mt-4">
                        <div class="row">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCrud">{{ detalle_lote . name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row mb-4">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Producto Precio</label>
                                                    <select name="" id="" class="form-control"
                                                        v-model="producto_precio">
                                                        <option v-for="m in productos_precios" :value="m">
                                                            {{ m . name }}</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Aplicado Precio</label>
                                                    <input type="text" class="form-control"
                                                        :value="tipo_precio[cliente.tipo_caja_cerrada]">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Valor Precio</label>
                                                    <input type="text" class="form-control" :value="valor_precio">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                                Cancelar</button>
                                            <button @click="AddDetalleLote()" type="button" data-dismiss="modal"
                                                class="btn btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">

                                <div class="info">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <label>BUSCAR ITEMS PARA VENDER</label>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label>Caja cerrada</label>
                                                        <div class="input-group">
                                                            <select v-model="caja_cerrada_id"
                                                                class="form-control select_cajas_cerradas">
                                                                <template v-for="m in cajas_cerrada">
                                                                    <option v-if="m.lote_detalle.cajas>0" :value="m.id">
                                                                        {{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro_compra }}*{{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro }}*{{ m . cinta }}
                                                                    </option>
                                                                </template>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label>Item PT</label>
                                                        <div class="input-group">
                                                            <select v-model="pt_item_id" class="form-control select_pt_item">
                                                                <template v-for="m in pts_model">
                                                                    <option v-if="m.cajas>0" :value="m.id">
                                                                        PT-{{ m . ptm . nro }} * {{ m . item . name }}</option>
                                                                </template>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label>Item PP</label>
                                                        <div class="input-group">
                                                            <select v-model="pp_item_id" class="form-control select_pp_item">
                                                                <template v-for="m in pps">
                                                                    <option :value="m.pp.id">PP-{{ m . pp . nro }} *
                                                                        {{ m . pollos }} POLLOS ENTEROS</option>
                                                                </template>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label>Cod Cliente</label>
                                                <div class="input-group">
                                                    <select v-model="model.cliente_id" class="form-control select_codigo_cliente">
                                                        <option v-for="m in clientes" :value="m.id">{{ m . id }}
                                                            - {{ m . documento . name }} {{ m . doc }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label>Clientes</label>
                                                <div class="input-group">
                                                    <select v-model="model.cliente_id" class="form-control select_cliente">
                                                        <option v-for="m in clientes" :value="m.id">{{ m . nombre }}
                                                            {{ m . documento . name }} {{ m . doc }}</option>
                                                    </select>
                                                </div>
                                                <label for="" class="text-danger" v-if="cliente.id==''">Selecciona un
                                                    cliente</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label>Grupo Cliente</label>
                                                <select v-model="cliente.cinta_cliente.id":value="" class="form-control">
                                                    <option value="" disabled selected>Seleccionar</option>
                                                    <option v-for="m in cintaClientes" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3" style="display: none">
                                            <div class="form-group ">
                                                <label>Caja Cerrada</label>
                                                <select v-model="cliente.caja_cerrada":value="" class="form-control">
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Choferes</label>
                                                <div class="input-group">
                                                    <select v-model="chofer" class="form-control select_chofer">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in chofers">
                                                            <option :disabled="m.turno_chofer == null"
                                                                :class="m.turno_chofer == null ? 'op_disabled' : 'op_enabled'"
                                                                :value="m">{{ m . nombre }} {{ m . documento . name }}
                                                                {{ m . doc }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <label for="" class="text-danger"
                                                    v-if="!chofer.hasOwnProperty('id')">Selecciona un chofer</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Preventista</label>
                                                <div class="input-group">
                                                    <select v-model="preventista_id" class="form-control">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in users">
                                                            <option :value="m.id">{{ m . nombre }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3" style="display: none">
                                            <div class="form-group ">
                                                <label>Distribuidor</label>
                                                <div class="input-group">
                                                    <select v-model="distribuidor_id" class="form-control">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in users">
                                                            <option :value="m.id">{{ m . nombre }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Forma de pedido</label>
                                                <div class="input-group">
                                                    <select v-model="forma_pedido" class="form-control">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in forma_pedidos">
                                                            <option :value="m">{{ m . name }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Método de pago</label>
                                                <div class="input-group">
                                                    <select v-model="formapago" class="form-control">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in formapagos">
                                                            <option :value="m">{{ m . name }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Fecha de pedido</label>
                                                <div class="input-group">
                                                    <input type="date" v-model="fecha_pedido" class="form-control"
                                                        name="" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Hora de entrega</label>
                                                <div class="input-group">
                                                    <input type="time" v-model="hora_entrega" class="form-control"
                                                        name="" id="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Método de pago</label>
                                                <select v-model="metodo_pago" class="form-control select_metodo">
                                                    <option value="" disabled selected>Seleccionar</option>
                                                    <option v-for="m in tipopagos" :key="m.id" :value="m.id">{{ m.name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label>Observacion</label>
                                                <input type="text" class="form-control" v-model="entrega.observacion">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <template v-for="d_pp in venta_pps">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <div class="form-group">
                                                                            <label for="">PP N°</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="'PP-' + d_pp.pp.nro" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="form-group">
                                                                            <label for="">CAJAS DIS.</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="d_pp.cajas" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="form-group">
                                                                            <label for="">POLLOS DIS.</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="d_pp.pollos" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO PRUTO</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="Number(d_pp.peso_bruto).toFixed(3)"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO NETO</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="Number(d_pp.peso_neto).toFixed(3)"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">CAJAS</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.cajas_vender"
                                                                                @change="ChangeCajasPp(d_pp)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">POLLOS</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.pollos_vender"
                                                                                @change="ChangePollosPp(d_pp)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO BRUTO</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.peso_bruto_vender">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO NETO</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.peso_neto_vender">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PRECIO UNIT</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="ItemSelect.venta">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">SUBTOTAL</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="Number(ItemSelect.venta * d_pp
                                                                                    .peso_bruto_vender).toFixed(2)">
                                                                        </div>
                                                                    </div>
                                                                    <div v-if="d_pp.sobra" class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">DESCRIPCION SOBRA</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.sobra_descripcion">
                                                                        </div>
                                                                    </div>
                                                                    <div v-if="d_pp.sobra" class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO SOBRA</label>
                                                                            <input type="text" class="form-control"
                                                                                v-model="d_pp.sobra_peso">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button class="btn btn-success"
                                                                            @click="AddPpDetalle(d_pp)">AGREGAR</button>
                                                                        <button class="btn btn-primary"
                                                                            @click="d_pp.sobra=!d_pp.sobra">PESO SOBRA</button>
                                                                        <button class="btn btn-danger"
                                                                            @click="venta_pps = []">CANCELAR</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2" v-if="DetalleVentaLotes.length">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="14" class="text-center bg-primary text-white">CAJAS CERRADAS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Lote</th>
                                                                    <th>N Compra</th>
                                                                    <th>Cinta</th>
                                                                    <th>Pigmento</th>
                                                                    <th>Cajas</th>
                                                                    <th>Pollos</th>
                                                                    <th>Peso Bruto</th>
                                                                    <th>Tara</th>
                                                                    <th>Peso Neto</th>
                                                                    <th>P. Bruto U.</th>
                                                                    <th>P. Neto U.</th>
                                                                    <th>Precio Kg </th>
                                                                    <th>Total Bs/ </th>
                                                                    <th>Accion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(l,i) in DetalleVentaLotes">
                                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro }}
                                                                    </td>
                                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro_compra }}
                                                                    </td>
                                                                    <td class="text-white" style="max-width: 120px;" :class="'bg-' + bandera(l)">
                                                                        {{ l.cinta }}
                                                                    </td>
                                                                    <td>{{ l . pigmento == 1 ? 'SI' : 'NO' }}</td>
                                                                    <td>
                                                                        <input type="text" name="" id=""
                                                                            v-model="l.cajas" @change="changeCajas(l)"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="" id=""
                                                                            v-model="l.equivalente" @change="changeLote(l)"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="" id=""
                                                                            v-model="l.peso_mod_bruto" @change="changeLoteM(l)"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td>{{ l.tara }}</td>
                                                                    <td>
                                                                        <input type="text" name="" id=""
                                                                            v-model="l.peso_mod_neto" @change="changeLoteM(l)"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td class="text-end"  v-model="l.peso_unitario_bruto">{{ l . peso_unitario_bruto }}</td>

                                                                    <td class="text-end" v-model="l.peso_unitario_neto">{{ l . peso_unitario_neto }}</td>
                                                                    <td class="text-end">{{ Number(l . valor_precio) . toFixed(2) }}</td>
                                                                    <td class="text-end">{{ Number(l.total).toFixed(2) }}</td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-danger p-1"
                                                                                @click="detalle_vente_lotes.splice(i,1)">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-trash-2">
                                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                                    <path
                                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                    </path>
                                                                                    <line x1="10" y1="11"
                                                                                        x2="10" y2="17"></line>
                                                                                    <line x1="14" y1="11"
                                                                                        x2="14" y2="17"></line>
                                                                                </svg>
                                                                            </button>
                                                                            <button class="btn btn-success p-1"
                                                                                @click="addVentaLoteCarrito(l,i)">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-check">
                                                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="sub_t">
                                                                    <td colspan="4">SUB TOTALES</td>
                                                                    <td>
                                                                        {{ Number(total_detalles . cajas) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . pollos) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . peso_bruto) . toFixed(3) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . tara) . toFixed(3) }}

                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . peso_neto) . toFixed(3) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . peso_unitario_bruto) . toFixed(2) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . peso_unitario_neto) . toFixed(2) }}
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . total) . toFixed(2) }}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2" v-if="TransformacionDetalles.length">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                  <div class="table-responsive">
                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="13" class="text-center bg-primary text-white">
                                                                    SUBTRANSFORMACIONES
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>PRODUCTO </th>
                                                                <th>CAJAS </th>

                                                                <th> P. BRUTO KG </th>
                                                                <th> P. TARA KG </th>
                                                                <th> P. NETO KG </th>

                                                                <th>PRECIO (X KG)</th>
                                                                <th>SUB TOTAL </th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="(m,i) in transformacions_list">
                                                                <tr>
                                                                    <td>SUBTR-{{ m . tramsformacion . nro }}</td>
                                                                    <td>{{ m . subitem . name }}</td>
                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm"
                                                                            v-model.number="m.total_cajas"
                                                                            @change="changeCajasTransformacion(m)">
                                                                    </td>

                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm"
                                                                            v-model.number="m.total_peso_bruto"
                                                                            @change="changePesoBrutoTransformacion(m)">
                                                                    </td>

                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm" v-model="m.total_tara" readonly>
                                                                    </td>

                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm"
                                                                            v-model.number="m.total_peso_neto"
                                                                            @change="changePesoNetoTransformacion(m)">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm"
                                                                            v-model="m.subitem.venta" readonly>
                                                                    </td>
                                                                    <td>

                                                                        <input type="text" class="form-control form-control-sm"
                                                                            :value="m.subtotal" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-danger p-1"
                                                                                @click="transformacions_list.splice(i,1)">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-trash-2">
                                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                                    <path
                                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                    </path>
                                                                                    <line x1="10" y1="11"
                                                                                        x2="10" y2="17"></line>
                                                                                    <line x1="14" y1="11"
                                                                                        x2="14" y2="17"></line>
                                                                                </svg>
                                                                            </button>
                                                                            <button class="btn btn-success p-1"
                                                                                @click="addTransformacionCarrito(m,i)">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-check">
                                                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2" v-if="PpItemsModel.length">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">

                                                        <thead>
                                                            <tr>
                                                                <th colspan="11" class="text-center bg-primary text-white">
                                                                    ITEMS PP
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>PP</th>
                                                                <th>Cajas</th>
                                                                <th>Pollos</th>
                                                                <th>P.Bruto</th>
                                                                <th>Taras</th>
                                                                <th>P. Neto</th>
                                                                <th>P. Neto U</th>
                                                                <th>Tipo</th>
                                                                <th>Precio KG</th>
                                                                <th>Total Bs/.</th>

                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(l,i) in PpItemsModel">
                                                                <td>
                                                                    PP-{{ l.pp.nro }} ({{ l.grupo_name }})
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.cajas_vender" @change="ChangeCajasPp(l)">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.pollos_vender" @change="ChangePollosPp(l)">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.peso_bruto_vender"
                                                                        @change="ChangePesoPp(l)"
                                                                        >
                                                                </td>
                                                                <td>{{ l.tara }}</td>

                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.peso_neto_vender">
                                                                </td>
                                                                <td>{{ Number(l . peso_neto_unit) . toFixed(2) }}</td>
                                                                <td>
                                                                    <select class="form-control form-control-sm" v-model.number="l.tipo_pp">
                                                                        <option :value="0">POLLO LIMPIO</option>
                                                                        <option :value="1">POLLO COMPLETO</option>
                                                                    </select>
                                                                </td>
                                                                <td>{{ Number(l . precio_acuerdo) . toFixed(2) }}</td>
                                                                <td>{{ Number(l . total) . toFixed(2) }}</td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-danger p-1"
                                                                            @click="detalle_venta_pp.splice(i,1)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-trash-2">
                                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                                <path
                                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                </path>
                                                                                <line x1="10" y1="11"
                                                                                    x2="10" y2="17"></line>
                                                                                <line x1="14" y1="11"
                                                                                    x2="14" y2="17"></line>
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-success p-1"
                                                                            @click="addVentaPpCarrito(l,i)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-check">
                                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                    <div class="row p-2">
                                                        <div class="col-4">

                                                            <div class="form-group ">
                                                                <label>Items</label>
                                                                <div class="input-group">
                                                                    <select v-model="item_id" class="form-control basic">

                                                                        <option v-for="m in items" :value="m.id">
                                                                            {{ m . name }}</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">

                                                            <div class="form-group ">

                                                                <div class="d-flex">
                                                                    <template v-for="m in acuerdos">
                                                                        <div class="n-chk">
                                                                            <label
                                                                                class="new-control new-radio radio-classic-primary">
                                                                                <input type="radio" v-model="acuerdo"
                                                                                    :value="m"
                                                                                    class="new-control-input">
                                                                                <span
                                                                                    class="new-control-indicator"></span>{{ m . name }}
                                                                            </label>
                                                                        </div>

                                                                    </template>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">

                                                            <div class="d-flex justify-content-between">
                                                                <div class="form-group text-center">
                                                                    <label for="" class="text-primary fw-bold">KG</label>
                                                                   <input
                                                                        type="text"
                                                                        inputmode="decimal"
                                                                        v-model="peso_acuerdo"
                                                                        @input="e => peso_acuerdo = e.target.value.replace(/[^0-9.]/g,'')"
                                                                        class="form-control"
                                                                        style="width:70px">
                                                                </div>
                                                                <div class="form-group text-center"
                                                                    style="width: 80px; padding:2px">
                                                                    <label for="" class="text-primary fw-bolder">X</label>
                                                                    <label for="" class=""
                                                                        style="width:70px">{{ ModelAcuerdo . cantidad }}</label>
                                                                </div>
                                                                <div class="form-group text-center" style="width:70px">
                                                                    <label for=""
                                                                        class="text-primary fw-bolder">T.Des</label>
                                                                    <label for="" class=""
                                                                        style="width:70px">{{ Number(ModelAcuerdo . t_des) . toFixed(2) }}</label>
                                                                </div>
                                                                <div class="form-group text-center" style="width:70px">
                                                                    <label for=""
                                                                        class="text-primary fw-bolder">Total</label>
                                                                    <label for="" class=""
                                                                        style="width:70px">{{ Number(ModelAcuerdo . total) . toFixed(2) }}</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2" v-if="PpItemsModel.length > 0 && (acuerdo && acuerdo.name === 'ACUERDO 1')">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="10" class="text-center bg-primary text-white">
                                                                    ACUERDO 1
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    COD
                                                                </th>
                                                                <th>
                                                                    ITEM
                                                                </th>
                                                                <th>
                                                                    CAJAS
                                                                </th>
                                                                <th>
                                                                    UNIDAD
                                                                </th>
                                                                <th>
                                                                    P.BRUTO
                                                                </th>
                                                                <th>
                                                                    P.TARA
                                                                </th>
                                                                <th>
                                                                    P.NETO
                                                                </th>
                                                                <th>
                                                                    PRECIO / KG
                                                                </th>
                                                                <th>
                                                                    TOTAL
                                                                </th>
                                                                <th>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" class="form-control" v-model="acuerdo_item.cod"></td>
                                                                <td><input type="text" class="form-control" v-model="acuerdo_item.item"></td>
                                                                <td><input type="text" class="form-control" v-model="acuerdo_item.cajas"></td>
                                                                <td><input type="text" class="form-control" v-model="acuerdo_item.unidad"></td>
                                                                <td><input type="text" class="form-control" v-model="acuerdo_item.peso_bruto"></td>
                                                                <td><input type="text" class="form-control" disabled :value="AcuerdoModel.tara"></td>
                                                                <td><input type="text" class="form-control" disabled :value="AcuerdoModel.peso_neto"></td>
                                                                <td><input type="text" class="form-control" v-model.number="acuerdo_item.precio_kg"></td>
                                                                <td><input type="text" class="form-control" disabled :value="AcuerdoModel.total"></td>
                                                                <td>
                                                                    <button class="btn btn-success p-1"
                                                                        @click="addAcuerdoItem()">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-check">
                                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2" v-if="venta_items.length">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">

                                                     <div class="table-responsive">
                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">

                                                        <thead>
                                                            <tr>
                                                                <th colspan="9" class="text-center bg-primary text-white">
                                                                    ITEMS PT
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    PT
                                                                </th>
                                                                <th>
                                                                    ITEM
                                                                </th>
                                                                <th>
                                                                    CAJAS
                                                                </th>
                                                                <th>
                                                                    P. BRUTO KG
                                                                </th>
                                                                <th>
                                                                    P. TARA KG
                                                                </th>
                                                                <th>
                                                                    P. NETO KG
                                                                </th>
                                                                <th>
                                                                    PRECIO (X KG)
                                                                </th>
                                                                <th>
                                                                    TOTAL Bs/
                                                                </th>
                                                                <th>

                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(item,i) in venta_items" class="tr-hover">
                                                                <td>PT-{{ item . nro }}</td>
                                                                <td>{{ item . item . name }}</td>
                                                                <td> <input type="text" class="form-control"
                                                                        v-model="item.cajas_vender"
                                                                        @change="changeCajasItem(item)"> </td>
                                                                <td> <input type="text" class="form-control"
                                                                        v-model="item.peso_bruto_vender"
                                                                        @change="changePesoBrutoItem(item)"> </td>
                                                                <td> <input type="text" class="form-control"
                                                                        v-model="item.tara_vender"> </td>
                                                                <td> <input type="text" class="form-control"
                                                                        v-model="item.peso_neto_vender"
                                                                        @change="changePesoNetoItem(item)"> </td>
                                                                <td>{{ Number(item . item . venta).toFixed(2) }}</td>
                                                                <td>{{ redondearTotal(Number(item.item.venta * item.peso_neto_vender)) }}</td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-danger p-1"
                                                                            @click="venta_items.splice(i,1)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-trash-2">
                                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                                <path
                                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                </path>
                                                                                <line x1="10" y1="11"
                                                                                    x2="10" y2="17"></line>
                                                                                <line x1="14" y1="11"
                                                                                    x2="14" y2="17"></line>
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-success p-1"
                                                                            @click="addVentaPtCarrito(item,i)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-check">
                                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 mt-2">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4" class="text-center bg-primary text-white">
                                                                    GASTOS
                                                                </th>
                                                            </tr>
                                                            <tr>

                                                                <th>

                                                                </th>
                                                                <th>
                                                                    DETALLE
                                                                </th>
                                                                <th>
                                                                    VALOR
                                                                </th>

                                                                <th>

                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="(item,i) in gastos">
                                                                <tr class="tr-hover">
                                                                    <td>
                                                                        <button @click="addGasto()" class="btn btn-success p-1">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-plus">
                                                                                <line x1="12" y1="5"
                                                                                    x2="12" y2="19"></line>
                                                                                <line x1="5" y1="12"
                                                                                    x2="19" y2="12"></line>
                                                                            </svg>
                                                                        </button>
                                                                    </td>

                                                                    <td> <input type="text" class="form-control"
                                                                            v-model="item.detalle"> </td>
                                                                    <td> <input type="text" class="form-control"
                                                                            v-model.number="item.valor"> </td>
                                                                    <td>
                                                                        <button class="btn btn-danger p-1" v-if="i>0"
                                                                            @click="gastos.splice(i,1)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-trash-2">
                                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                                <path
                                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                </path>
                                                                                <line x1="10" y1="11"
                                                                                    x2="10" y2="17"></line>
                                                                                <line x1="14" y1="11"
                                                                                    x2="14" y2="17"></line>
                                                                            </svg>
                                                                        </button>
                                                                        <button class="btn btn-success p-1"
                                                                            @click="AddGasto(item,i)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-check">
                                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center p-0 mt-2">
                                            <div v-if="showCreditoError" class="alert alert-warning">
                                                <div>
                                                    <strong>Advertencia!</strong> El saldo de créditos activos es insuficiente: {{ creditos_activos_saldo }}.
                                                </div>
                                            </div>

                                            <div v-if="showLimiteCreditoError" class="alert alert-warning">
                                                <div>
                                                    <strong>Advertencia!</strong> El saldo límite crediticio es menor al total de la venta: {{ saldo_limite_crediticio }} < {{ totalAll }}.
                                                </div>
                                            </div>
                                            <button @click="Vender()"
                                                :disabled="isButtonDisabled"
                                                class="btn btn-success btn-block w-100 p-4">
                                                <h4 class="text-white">FINALIZAR DESPACHO DE NDD (F7)</h4>
                                            </button>
                                            <div class="modal fade" id="modalVenta" tabindex="-1" role="dialog"
                                                aria-labelledby="modalCrud" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCrud">PROCESAR VENTA</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-x">
                                                                    <line x1="18" y1="6" x2="6"
                                                                        y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18"
                                                                        y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <a class="btn  btn-success">Bitacora de Cajas por Cliente</a>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="">Imprimir</label>
                                                                        <select name="" class="form-control"
                                                                            id="">
                                                                            <option value="0">No</option>
                                                                            <option value="1">Si</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="">Tipo de venta</label>
                                                                        <select name="" class="form-control"
                                                                            id="">
                                                                            <option value="1">Credito</option>
                                                                            <option value="2">Contado</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="">Devolver Cajas</label>
                                                                        <input type="text" name="" class="form-control"
                                                                            id="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label for="">Total de Venta</label>
                                                                        <input type="text" name="" class="form-control"
                                                                            id="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i
                                                                    class="flaticon-cancel-12"></i> Cancelar</button>
                                                            <button @click="Vender()" type="button" data-dismiss="modal"
                                                                class="btn btn-success">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget-content widget-content-area br-6 mt-4">
                                    <div class="section general-info">
                                        <div class="info">
                                            <h6 class="">ITEMS KG</h6>
                                            <div class="row px-0">
                                                <div class="col-12 px-0">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    PT
                                                                </th>
                                                                <th>
                                                                    ITEM
                                                                </th>
                                                                <th style="display: none">
                                                                    KG B
                                                                </th>
                                                                <th>
                                                                    KG N
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="ptm in pts">
                                                                <template v-for="item in ptm.items">
                                                                    <tr  @click="AddPtItem(item,ptm)"
                                                                        class="tr-hover">
                                                                        <td><strong>PT-{{ ptm . nro }}</strong></td>
                                                                        <td>{{ item . item . name }}</td>
                                                                        <td style="display: none">{{ Number(item . peso_bruto) . toFixed(3) }} KG</td>
                                                                        <td class="bg-light-primary">{{ Number(item . peso_neto) . toFixed(3) }} KG</td>
                                                                    </tr>
                                                                </template>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12 px-0" v-if="pp.hasOwnProperty('pp')">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>PRODUCTO</th>
                                                                <th >SALDO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="m in pps">
                                                                <tr v-if="m.peso_neto>0" @click="AddPp(m)" class="tr-hover">
                                                                     <td><strong>PP-{{ m.pp.nro }}-({{ m.cinta_cliente ? m.cinta_cliente.name : 'SIN CINTA' }})</strong></td>
                                                                    <td>{{ m.pollos }} POLLOS ENTEROS</td>
                                                                    <td class="bg-light-info">{{ Number(m.peso_neto).toFixed(3) }} KG</td>
                                                                </tr>
                                                                <tr style="display: none">
                                                                    <td colspan="3" class="p-0">
                                                                        <table class="table table-bordered" v-if="Number(m.peso_neto)>0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>GRUPO</th>
                                                                                    <th>SALDO</th>
                                                                                    <th>POLL. DISP.</th>
                                                                                    <th>CAJAS DISP.</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr class="bg-light-primary" v-for="g in m.pp.pp_list_desplegue_cinta">
                                                                                    <td class="font-weight-bold text-primary">
                                                                                        {{ g.cinta_cliente.name }}
                                                                                    </td>
                                                                                    <td class="font-weight-bold text-primary">
                                                                                        {{ g.traspaso_pps.reduce((total, traspaso) => total + parseFloat(traspaso.peso_neto), 0).toFixed(3) }}
                                                                                    </td>
                                                                                    <td class="font-weight-bold text-primary">
                                                                                        {{ g.traspaso_pps.reduce((total, traspaso) => total + traspaso.pollos, 0) }}
                                                                                    </td>
                                                                                    <td class="font-weight-bold text-primary">
                                                                                        {{ g.traspaso_pps.reduce((total, traspaso) => total + traspaso.cajas, 0) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 px-0">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    N°
                                                                </th>
                                                                <th>
                                                                    SUBTRANSFORMACIONES
                                                                </th>
                                                                <th style="display: none">
                                                                    CAJAS
                                                                </th>
                                                                <th style="display: none">
                                                                    KG B
                                                                </th>
                                                                 <th>
                                                                    KG N
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template  v-for="m in transformacions">
                                                                <tr class="tr-hover"
                                                                    v-for="item in m.lista_subitems_transformacion"
                                                                     @click="AddTransformacion(item,m)">
                                                                    <td><strong>SUBTR-{{ m . nro }}</strong></td>
                                                                    <td>{{ item . subitem . name }}</td>
                                                                    <td style="display: none">{{ item . total_cajas }}</td>
                                                                    <td style="display: none">{{ Number( item . total_peso_bruto).toFixed(3) }}</td>
                                                                    <td class="bg-light-warning">{{ Number(item . total_peso_neto).toFixed(3) }}</td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endverbatim
    @endslot
    @slot('script')
        <script type="module">
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"

            const {
                createApp
            } = Vue
            let block = new Block()

            createApp({
                data() {
                    return {
                        preventista_id: null,
                        distribuidor_id: null,
                        retraccion: null,
                        transItems: [],
                        transEspecials: [],
                        showCreditoError: false,
                        showLimiteCreditoError: false,
                        creditos_activos_saldo: 0,
                        saldo_limite_crediticio: 0,
                        totalFinal: 0,
                        model: {
                            inactivo: 1,
                            tipocliente_id: 1,
                            nombre: '',
                            apellidos: '',
                            documento_id: '',
                            doc: '',
                            cargo: '',
                            telefono: '',
                            direccion: '',
                            garante: '',
                            dir_garante: '',
                            cel_garante: '',
                            correo: '',
                            latitud: '',
                            longitud: '',
                            creditos_activos: 0,
                            dias_horas: "",
                            limite_crediticio: 0,
                        },
                        documentos: [],
                        tipoclientes: [],
                        lote_id: '',
                        lotes: [],
                        descuento: 1,
                        chofer: {
                            capacidad_utilizada: 0,
                            turno_chofer: {
                                capacidad_disponible: 0
                            }
                        },
                        sucursal: {},
                        user: {},
                        pp: {
                            pp: {}
                        },
                        pt: {
                            items: []
                        },
                        venta_pps: [],
                        lote: {
                            lote_detalles: [],
                            pp_detalles: [],
                            pt_detalles: [],
                            pp_descomposicion_detalles: [],
                        },
                        lotes: [],
                        banderas: [],
                        detalle_vente_lotes: [],
                        detalle_venta_pp: [],
                        clientes: [],
                        formapagos: [],
                        chofers: [],
                        items: [],
                        venta_items: [],
                        item_select: '1',
                        cliente: {
                            cinta_cliente: {

                            },
                            cliente_cajacerradas: [],
                            cliente_pts: [],
                            cliente_pps: [],
                        },
                        chofer_id: '',
                        formapago_id: 1,
                        entrega: {
                            fecha: '',
                            hora: ''
                        },
                        productos_precios: [],
                        detalle_lote: {

                        },
                        producto_precio: {

                        },
                        tipo_precio: {
                            1: 'DE 1 A 14 POLLOS',
                            2: 'OFICIAL (15 A 75 POLLOS)',
                            3: 'DE 76 A 150 POLLOS',
                            4: 'DE 151 A MAS POLLOS',
                            5: 'CUALQUIER CANTIDAD AL CONTADO',
                            6: 'vip',
                        },
                        cintaClientes: [],
                        forma_pedidos: [],
                        pps: [],
                        pts: [],
                        banderas: [],
                        caja_cerrada_id: 0,
                        pp_item_id: 0,
                        pt_item_id: 0,
                        metodo_pago: 1,
                        item_id: null,
                        acuerdos: [],
                        acuerdo: null,
                        gastos: [{
                            detalle: '',
                            valor: 0
                        }],
                        peso_acuerdo: '',
                        caja_busqueda: '',
                        cart_lotes: [],
                        cart_pps: [],
                        cart_pts: [],
                        precio_detalle_lote: 5,
                        cl_id: 1,
                        descuento: 1,
                        cart_gastos_model: [],
                        pollo_sucursal: {
                            items: []
                        },
                        transformacions: [],
                        users: [],
                        producto_precio_sucursal: [],
                        transformacions_list: [],
                        transformacion_cart: [],
                        forma_pedido: {

                        },
                        formapago: {

                        },
                        fecha_pedido: '',
                        hora_entrega: '',
                        acuerdo_item:{
                            cod:'',
                            item:'',
                            cajas:0,
                            peso_bruto:0,
                            unidad:0,
                            precio_kg:0
                        },
                        cart_acuerdo_items:[],
                        tipopagos: [],
                    }
                },
                computed: {
                    AcuerdoModel(){
                        let item = {...this.acuerdo_item}
                        item.tara = item.cajas*2
                        item.peso_neto = Number(item.peso_bruto - item.tara).toFixed(3)
                        item.total = Number(Number(item.peso_neto)*item.precio_kg).toFixed(2)//para decimales
                        return item

                    },
                    isButtonDisabled() {
                        const totalVenta = this.totalAll;
                        if (this.metodo_pago == 3) {
                            if (this.creditos_activos_saldo <= 0) {
                                this.showCreditoError = true;
                                this.showLimiteCreditoError = false;
                                return true;
                            }
                            if (this.saldo_limite_crediticio < totalVenta) {
                                this.showLimiteCreditoError = true;
                                this.showCreditoError = false;
                                return true;
                            }
                        }
                        this.showLimiteCreditoError = false;
                        this.showCreditoError = false;
                        return false;
                    },

                    GastosModel() {
                        return this.cart_gastos_model.map((i) => {
                            i.valor = this.redondearTotal(i.valor);
                            return i
                        })

                    },
                    CartPtsModel() {
                        return this.cart_pts.map((i) => {
                            i.total = i.item.venta * i.peso_neto_vender
                            i.total = this.redondearTotal(i.total);
                            i.total_final = i.total + i.descuento_total
                            i.total_final = this.redondearTotal(i.total_final);
                            return i
                        })
                    },


                    CartTransformacions() {
                        return this.transformacion_cart.map((i) => {
                            i.total_final = this.redondearTotal(i.total_peso_neto * i.subitem.venta)
                            return i
                        })
                    },
                    CartLotesModel() {
                        return this.cart_lotes.map((i) => {
                            i.descuento_valor = i.descuento_pollo_limpio * i.equivalente
                            i.total_final = i.total - i.descuento_valor

                            return i
                        })
                    },
                    ClienteCajacerradas() {
                        return this.cliente.cliente_cajacerradas
                    },
                    ClientePps() {
                        return this.cliente.cliente_pps
                    },
                    ClientePts() {
                        return this.cliente.cliente_pts
                    },
                    tipo_pollo_limpia() {
                        return this.cliente.tipo_pollo_limpia
                    },
                    valor_precio() {
                        if (this.cliente.tipo_caja_cerrada == 1) {
                            return this.producto_precio.venta_1
                        }
                        if (this.cliente.tipo_caja_cerrada == 2) {
                            return this.producto_precio.venta_2
                        }
                        if (this.cliente.tipo_caja_cerrada == 3) {
                            return this.producto_precio.venta_3
                        }
                        if (this.cliente.tipo_caja_cerrada == 4) {
                            return this.producto_precio.venta_4
                        }
                        if (this.cliente.tipo_caja_cerrada == 5) {
                            return this.producto_precio.venta_5
                        }
                        if (this.cliente.tipo_caja_cerrada == 6) {
                            return this.producto_precio.venta_6
                        }
                    },
                    ItemSelect() {
                        let item = this.items.find(i => i.id == this.item_select)
                        if (item) {
                            return item
                        }
                        return {
                            venta: 0

                        }
                    },
                    imgPollo() {
                        return "{{ url('') }}/img/pollo.jpg"
                    },
                    model_detalles() {
                        return this.lotes.map((l) => {

                            l.cajas_disponibles = l.lote_detalles.reduce((a, b) => a + (b.cajas > 0 ? b.cajas :
                                0), 0)
                            l.pollos_disponibles = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? b
                                .equivalente : 0), 0)
                            l.peso_neto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (
                                b.peso_total - b.cajas * this.retraccion) : 0), 0)
                            l.peso_bruto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ?
                                (b.peso_total) : 0), 0)

                            return l

                        })
                    },
                    total_detalles() {
                        let cajas = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.equivalente), 0)
                        let peso_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
                        let tara = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.tara), 0)

                        let peso_neto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
                        let merma_bruta = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.merma_bruta), 0)
                        let merma_neta = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.merma_neta), 0)
                        let peso_unitario_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b
                            .peso_unitario_bruto), 0)
                        let peso_unitario_neto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b
                            .peso_unitario_neto), 0)
                        let total = this.DetalleVentaLotes.reduce((a, b) => a + Number(b.total), 0)
                        return {
                            cajas: cajas,
                            pollos: pollos,
                            peso_bruto: peso_bruto,
                            peso_neto: peso_neto,
                            tara:tara,
                            merma_bruta: merma_bruta,
                            merma_neta: merma_neta,
                            peso_unitario_bruto: peso_unitario_bruto,
                            peso_unitario_neto: peso_unitario_neto,
                            total: total,
                        }
                    },
                    venta_items_peso_bruto() {
                        return this.venta_items.reduce((a, b) => a + Number(b.peso_bruto_vender), 0)

                    },
                    detalle_vente_lotes_peso_bruto() {
                        return this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)

                    },
                    detalle_venta_pp_peso_bruto() {
                        return this.detalle_venta_pp.reduce((a, b) => a + Number(b.peso_bruto_vender), 0)
                    },
                    peso_bruto_total() {
                        return Number(this.venta_items_peso_bruto + this.detalle_vente_lotes_peso_bruto + this
                            .detalle_venta_pp_peso_bruto).toFixed(3)
                    },
                    lista_cintas1() {

                        let cintas_detalles = [];
                        this.model_detalles.forEach(compra => {
                            compra.lote_detalles.forEach(detalle => {
                                let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP'
                                let buscar_cinta = cintas_detalles.filter((e) => {
                                    return e.name == detalle.producto + '/' + pigmento
                                })
                                if (buscar_cinta.length == 0) {
                                    cintas_detalles.push({
                                        id: detalle.compra_inventario.sub_original_id,
                                        name: detalle.producto + '/' + pigmento
                                    });
                                }
                            });
                        });
                        return cintas_detalles
                    },
                    lista_cintas() {

                        let lista = this.lista_cintas1.sort(function(a, b) {
                            return a.id - b.id;
                        });
                        return lista.map((e) => e.name)
                    },
                    model_cintas1() {
                        let model = this.model_detalles.map((compra) => {
                            compra.cintas = [...this.lista_cintas]
                            let cintas_cajas = compra.cintas.map((cinta) => {
                                let lote_detalles = compra.lote_detalles.filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP'
                                    return detalle.name + '/' + pigmento == cinta
                                })
                                lote_detalles = lote_detalles.sort((a, b) => {
                                    return b.peso_total - a.peso_total;
                                })
                                if (lote_detalles.length > 0) {

                                    let lote_detalle = lote_detalles[0]
                                    lote_detalle.cajas = lote_detalles.reduce((a, b) => a + b.cajas, 0)
                                    lote_detalle.total_pollos = lote_detalles.reduce((a, b) => a + b
                                        .equivalente, 0)
                                    lote_detalle.total_peso = lote_detalles.reduce((a, b) => a + b
                                        .peso_total, 0)
                                    lote_detalle.promedio = lote_detalle.total_peso / (lote_detalle
                                        .total_pollos <= 0 ? 1 : lote_detalle.total_pollos)

                                    let detalle = {
                                        lote_detalles,
                                        cinta,
                                        lote_detalle
                                    }
                                    return detalle
                                } else {
                                    let detalle = {
                                        cinta,
                                        lote_detalle: {
                                            cajas: 0,
                                            promedio: 0
                                        }
                                    }
                                    return detalle
                                }
                            })
                            compra.cinta_cajas = cintas_cajas
                            compra.total_cajas = cintas_cajas.reduce((a, b) => a + b.lote_detalle.cajas, 0)
                            return compra
                        })
                        return model
                    },

                    model_cintas() {
                        let self = this;
                        let id = 1;
                        let model = this.model_detalles.map((compra) => {
                            compra.cintas = [...this.lista_cintas];

                            let cintas_cajas = compra.cintas.map((cinta) => {
                                let lote_detalles = compra.lote_detalles.filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP';
                                    return detalle.producto + '/' + pigmento == cinta;
                                });

                                let cajas_envio = [...self.detalle_vente_lotes].filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP';
                                    return detalle.producto + '/' + pigmento == cinta && detalle.compra_id == compra.id;
                                });

                                let envios = cajas_envio.reduce((a, b) => a + Number(b.cajas), 0);

                                lote_detalles = lote_detalles.sort((a, b) => b.peso_total - a.peso_total);

                                if (lote_detalles.length > 0) {
                                    let lote_detalle = { ...lote_detalles[0] };

                                    lote_detalle.cajas = lote_detalles.reduce((a, b) => a + b.cajas, 0);
                                    let cajas_tara = lote_detalle.cajas * 2;

                                    lote_detalle.total_pollos = lote_detalles.reduce((a, b) => a + b.equivalente, 0);
                                    lote_detalle.total_peso = lote_detalles.reduce((a, b) => a + b.peso_total, 0) - cajas_tara;

                                    if (lote_detalle.cajas === 0 || lote_detalle.total_pollos <= 0 || lote_detalle.total_peso < 0) {
                                        lote_detalle.promedio = 0;
                                    } else {
                                        lote_detalle.promedio = lote_detalle.total_peso / lote_detalle.total_pollos;
                                    }

                                    lote_detalle.peso_disponible = Number(lote_detalle.total_peso - lote_detalle.peso_movimientos);

                                    let detalle = {
                                        lote_detalles,
                                        compra: compra.compra,
                                        cinta,
                                        dias: compra.dias,
                                        lote_detalle,
                                        envios: envios
                                    };
                                    return detalle;
                                } else {
                                    return {
                                        cinta,
                                        compra: compra.compra,
                                        dias: compra.dias,
                                        envios: envios,
                                        lote_detalle: {
                                            cajas: 0,
                                            promedio: 0,
                                            envios: []
                                        },
                                    };
                                }
                            });

                            compra.cinta_cajas = cintas_cajas.map((c) => {
                                c.id = id;
                                id = id + 1;
                                return c;
                            });

                            compra.total_envios = cintas_cajas.reduce((a, b) => a + b.envios, 0);
                            compra.total_cajas = cintas_cajas.reduce((a, b) => a + b.lote_detalle.cajas, 0) - compra.total_envios;

                            compra.cerrar = compra.total_cajas === 0;

                            return compra;
                        });

                        return model;
                    },

                    totales_cintas() {
                        let cintas = [...this.lista_cintas]
                        let cinta_totales = cintas.map((cinta) => {
                            let total_cajas = 0
                            let model_cintas = [...this.model_cintas].map((model) => {
                                let buscar_cinta = model.cinta_cajas.filter((b) => b.cinta == cinta)
                                if (buscar_cinta) {
                                    total_cajas += buscar_cinta.reduce((a, b) => a + b.lote_detalle
                                        .cajas, 0)

                                }
                            })
                            return {
                                name: cinta,
                                total_cajas: total_cajas
                            }
                        })
                        return cinta_totales
                    },
                    total_cinta() {
                        return this.totales_cintas.reduce((a, b) => a + b.total_cajas, 0)
                    },
                    lotes_cerrar() {
                        return this.model_cintas.filter((l) => l.cerrar == true)
                    },
                    cajas_cerrada() {
                        return this.model_cintas.flatMap((l) => l.cinta_cajas)
                    },
                    pts_model() {
                        let id = 1
                        let pts = [...this.pts]
                        pts.map((pt) => {
                            pt.items = pt.items.map((item) => {
                                item.ptm = {
                                    id: pt.id,
                                    nro: pt.nro
                                }
                                item.id = id
                                id = id + 1
                                return item
                            })
                            return pt
                        })
                        return pts.flatMap((pt) => pt.items)
                    },
                    // PpItemsModel() {
                    //     return this.detalle_venta_pp.map((d) => {
                    //         let cantidadPollos = Number(d.pollos_vender) || 0
                    //         d.precio_acuerdo = this.getPrecioPolloLimpioPorCantidad(cantidadPollos)
                    //         d.total = Number(d.peso_neto_vender * d.precio_acuerdo)
                    //         return d
                    //     })
                    // },

                    PpItemsModel() {
                        return this.detalle_venta_pp.map((d) => {
                            let cantidadPollos = Number(d.pollos_vender) || 0;
                            const nombreProducto = d.tipo_pp === 1 ? 'POLLO COMPLETO' : 'POLLO LIMPIO';
                            let precio_final = null;
                            let precio_estado = null;

                            let precio_personalizado = this.ClienteCajacerradas.find(
                                x => x.producto_precio && x.producto_precio.name == nombreProducto
                            );
                            if (precio_personalizado && precio_personalizado.valor) {
                                precio_final = Number(precio_personalizado.valor);
                            }

                            if (precio_final === null) {
                                let producto = this.productos_precios.find(p => p.name == nombreProducto  );
                                if (producto) {
                                    if (producto.estado_precio_5 == 1) {
                                        precio_estado = Number(producto.venta_5);
                                    }
                                    else if (producto.estado_precio_6 == 1) {
                                        precio_estado = Number(producto.venta_6);
                                    }
                                    else if (producto.estado_precio_7 == 1) {
                                        precio_estado = Number(producto.venta_7);
                                    }
                                    else if (producto.estado_precio_8 == 1) {
                                        precio_estado = Number(producto.venta_8);
                                    }
                                    else if (producto.estado_precio_9 == 1) {
                                        precio_estado = Number(producto.venta_9);
                                    }
                                    else if (producto.estado_precio_10 == 1) {
                                        precio_estado = Number(producto.venta_10);
                                    }
                                    else if (producto.estado_precio_11 == 1) {
                                        precio_estado = Number(producto.venta_11);
                                    }
                                    else if (producto.estado_precio_12 == 1) {
                                        precio_estado = Number(producto.venta_12);
                                    }
                                }
                                precio_final=precio_estado
                            }

                            if (precio_final === null && precio_estado === null) {
                                let tipo_caja_cerrada_cliente = this.cliente.tipo_pollo_limpia;
                                if (tipo_caja_cerrada_cliente) {
                                    let producto = this.productos_precios.find(p => p.name == nombreProducto);
                                    if (producto) {
                                        if (tipo_caja_cerrada_cliente === 12) {
                                            precio_final = Number(producto.venta_12);
                                        } else if (tipo_caja_cerrada_cliente === 11) {
                                            precio_final = Number(producto.venta_11);
                                        } else if (tipo_caja_cerrada_cliente === 10) {
                                            precio_final = Number(producto.venta_10);
                                        } else if (tipo_caja_cerrada_cliente === 9) {
                                            precio_final = Number(producto.venta_9);
                                        } else if (tipo_caja_cerrada_cliente === 8) {
                                            precio_final = Number(producto.venta_8);
                                        } else if (tipo_caja_cerrada_cliente === 7) {
                                            precio_final = Number(producto.venta_7);
                                        } else if (tipo_caja_cerrada_cliente === 6) {
                                            precio_final = Number(producto.venta_6);
                                        } else if (tipo_caja_cerrada_cliente === 5) {
                                            precio_final = Number(producto.venta_5);
                                        } else if (tipo_caja_cerrada_cliente === 4) {
                                            precio_final = Number(producto.venta_4);
                                        } else if (tipo_caja_cerrada_cliente === 3) {
                                            precio_final = Number(producto.venta_3);
                                        } else if (tipo_caja_cerrada_cliente === 2) {
                                            precio_final = Number(producto.venta_2);
                                        } else if (tipo_caja_cerrada_cliente === 1) {
                                            precio_final = Number(producto.venta_1);
                                        }
                                    }
                                }
                            }

                            // if (precio_final === null) {
                            //     let producto = this.productos_precios.find(p => p.name == "POLLO LIMPIO");
                            //     if (producto) {
                            //         if (cantidadPollos > 0 && cantidadPollos <= 14) {
                            //             precio_final = Number(producto.venta_1);
                            //         } else if (cantidadPollos >= 15 && cantidadPollos <= 75) {
                            //             precio_final = Number(producto.venta_2);
                            //         } else if (cantidadPollos >= 76 && cantidadPollos <= 150) {
                            //             precio_final = Number(producto.venta_3);
                            //         } else if (cantidadPollos >= 151) {
                            //             precio_final = Number(producto.venta_4);

                            //         }
                            //     }
                            // }

                            if (precio_final === null) {
                                precio_final = 0;
                            }
                            d.tara = Math.ceil(d.cajas_vender*this.retraccion)
                            d.precio_acuerdo = precio_final;
                            d.total = this.redondearTotal(Number(d.peso_neto_vender * d.precio_acuerdo));
                            d.item = {
                                ...(d.item || {}),
                                name: nombreProducto
                            };
                            d.tipo_pp = Number(d.tipo_pp ?? 0);
                            return d;
                        });
                    },

                    TransformacionDetalles() {
                        return [...this.transformacions_list].map((m) => {
                            let cajas = m.total_cajas * this.retraccion;
                            m.total_tara = cajas; // 2kg por caja
                            // m.total_peso_neto = m.total_peso_bruto - m.total_tara;
                            m.subtotal = this.redondearTotal(m.total_peso_neto * m.subitem.venta);
                            return m;
                        });
                    },


                    ModelAcuerdo() {
                    const acuerdo = this.acuerdo;
                    const items = Array.isArray(this.PpItemsModel) ? this.PpItemsModel : [];
                    const pollos = items.reduce((a, b) => a + (Number(b.pollos_vender) || 0), 0);
                    const total  = items.reduce((a, b) => a + (Number(b.total) || 0), 0);

                    if (!acuerdo || !acuerdo.id) {
                        return { kg: 0, cantidad: 0, t_des: 0, total: Number(total.toFixed(2)) };
                    }

                    const cantidad = Number(acuerdo.cantidad) || 0;
                    const peso     = Number(acuerdo.peso) || 0;

                    // si el acuerdo define "peso", calculamos; si no, usamos lo escrito por el usuario
                    const kg = peso > 0
                        ? +(pollos * peso).toFixed(2)
                        : (parseFloat(this.peso_acuerdo) || 0);

                    const t_des = +this.redondearTotal((kg * cantidad).toFixed(2));
                    const totalConDescuento = +this.redondearTotal((total - t_des).toFixed(2));

                    return { kg, cantidad, t_des, total: totalConDescuento };
                    },

                    DetalleVentaLotes() {
                        return this.detalle_vente_lotes.map((d) => {
                            d.valor_precio = d.precio_detalle_lote
                            d.tara = Math.ceil(d.cajas*this.retraccion)
                            d.total = this.redondearTotal(Number(d.peso_mod_neto * d.valor_precio));
                            return d
                        })
                    },
                    totalGastos() {
                        return this.gastos.reduce((a, b) => a + b.valor, 0)
                    },
                    listaCintasCajaCerrada() {
                        return this.lista_cintas.filter((b) => b.toLowerCase().indexOf(this.caja_busqueda) != -1)
                    },
                    cajaCerradaFiltro() {
                        return this.model_cintas.map((c) => {
                            c.filtro_cintas = c.cintas.filter((b) => b.toLowerCase().indexOf(this
                                .caja_busqueda) != -1)
                            c.filtro_cintas_cajas = c.cinta_cajas.filter((b) => b.cinta.toLowerCase().indexOf(
                                this.caja_busqueda) != -1)
                            return c
                        })
                    },
                    totalAll() {
                        let total_detalle_venta_lotes = this.cart_lotes.reduce((a, b) => a + Number(b.total_final), 0)
                        let total_venta_pps = this.cart_pps.reduce((a, b) => a + Number(b.total), 0)
                        let total_vente_pts = this.cart_pts.reduce((a, b) => a + Number(b.total_final), 0)
                        let total_vente_gastos = this.GastosModel.reduce((a, b) => a + Number(b.valor), 0)
                        let total_acuerdo = this.cart_acuerdo_items.reduce((a, b) => a + Number(b.total), 0)

                        //sumando las transformaciones
                        let total_transformaciones = this.CartTransformacions.reduce((a,b)=> a + Number(b.subtotal),0)
                        return total_transformaciones + total_detalle_venta_lotes + total_venta_pps + total_vente_pts - total_vente_gastos + total_acuerdo
                    },
                    itemSucursal() {
                        return this.pollo_sucursal.items
                    },
                    totalCajas() {
                        let cajas_acuerdo = this.cart_acuerdo_items.reduce((a,b) => a + Number(b.cajas), 0);
                        let caja_lotes    = this.cart_lotes.reduce((a,b) => a + Number(b.cajas), 0);
                        let caja_pts      = this.cart_pts.reduce((a,b) => a + Number(b.cajas_vender), 0);
                        let caja_pps      = this.cart_pps.reduce((a,b) => a + Number(b.cajas_vender), 0);
                        let caja_transf   = this.transformacion_cart.reduce((a,b) => a + Number(b.total_cajas), 0);
                        return caja_lotes + caja_pts + caja_pps + cajas_acuerdo + caja_transf;
                    },
                },
                methods: {
                    redondearTotal(valor) {
                        //return (Math.ceil(valor * 10) / 10).toFixed(2);
                        return (Math.round(valor * 10) / 10).toFixed(2);
                    },
                    red(n, p = 3) {
                        const f = Math.pow(10, p);
                        return Math.round((Number(n) + Number.EPSILON) * f) / f;
                    },
                    addAcuerdoItem(){
                        let item = {...this.AcuerdoModel}
                        this.cart_acuerdo_items.push(item)
                        this.acuerdo_item = {
                            cod:'',
                            item:'',
                            cajas:0,
                            peso_bruto:0,
                            unidad:0,
                            precio_kg:0
                        }
                    },
                    buscarPrecioTransformacion(item_id) {
                        let tipo = this.cliente.tipo_trans;
                        for (let trans of this.transItems) {
                            if (trans.trans_item_detalles && Array.isArray(trans.trans_item_detalles)) {
                                let detalle = trans.trans_item_detalles.find(d => Number(d.item_id) === Number(item_id));
                                if (detalle) {
                                    let personalizado = this.ClientePts.find(x => x.item && x.item.id == item_id);
                                    if (personalizado && personalizado.valor) return Number(personalizado.valor);

                                    if (detalle.estado_precio_alternativo_1 == 1) return Number(detalle.precio_alternativo_1);
                                    if (detalle.estado_precio_alternativo_2 == 1) return Number(detalle.precio_alternativo_2);
                                    if (detalle.estado_precio_alternativo_3 == 1) return Number(detalle.precio_alternativo_3);
                                    if (detalle.estado_precio_alternativo_4 == 1) return Number(detalle.precio_alternativo_4);
                                    if (detalle.estado_precio_alternativo_5 == 1) return Number(detalle.precio_alternativo_5);

                                    if (tipo === 12 ) return Number(detalle.precio_alternativo_5);
                                    if (tipo === 11 ) return Number(detalle.precio_alternativo_4);
                                    if (tipo === 10 ) return Number(detalle.precio_alternativo_3);
                                    if (tipo === 9 ) return Number(detalle.precio_alternativo_2);
                                    if (tipo === 8 ) return Number(detalle.precio_alternativo_1);
                                    if (tipo === 7 ) return Number(detalle.precio);


                                    // if (detalle.estado_precio_alternativo_6 == 1) return Number(detalle.precio_alternativo_6);

                                    // if (detalle.precio) return Number(detalle.precio);
                                    if (detalle.precio) return 0;
                                }
                            }
                        }
                        for (let trans of this.transEspecials) {
                            if (trans.trans_especial_items && Array.isArray(trans.trans_especial_items)) {
                                let detalle = trans.trans_especial_items.find(d => Number(d.item_id) === Number(item_id));
                                if (detalle) {
                                    let personalizado = this.ClientePts.find(x => x.item && x.item.id == item_id);
                                    if (personalizado && personalizado.valor) return Number(personalizado.valor);


                                    if (detalle.estado_precio_alternativo_1 == 1) return Number(detalle.precio_alternativo_1);
                                    if (detalle.estado_precio_alternativo_2 == 1) return Number(detalle.precio_alternativo_2);
                                    if (detalle.estado_precio_alternativo_3 == 1) return Number(detalle.precio_alternativo_3);
                                    if (detalle.estado_precio_alternativo_4 == 1) return Number(detalle.precio_alternativo_4);
                                    if (detalle.estado_precio_alternativo_5 == 1) return Number(detalle.precio_alternativo_5);
                                    // if (detalle.estado_precio_alternativo_6 == 1) return Number(detalle.precio_alternativo_6);

                                    if (tipo === 12 ) return Number(detalle.precio_alternativo_5);
                                    if (tipo === 11 ) return Number(detalle.precio_alternativo_4);
                                    if (tipo === 10 ) return Number(detalle.precio_alternativo_3);
                                    if (tipo === 9 ) return Number(detalle.precio_alternativo_2);
                                    if (tipo === 8 ) return Number(detalle.precio_alternativo_1);
                                    if (tipo === 7 ) return Number(detalle.precio_2);

                                    //if (detalle.precio_2) return Number(detalle.precio_2);
                                    if (detalle.precio_2) return 0;
                                }
                            }
                        }
                        return null;
                    },

                    getPrecioPolloLimpioPorCantidad(cantidadPollos) {
                        let producto = this.productos_precios.find(p => p.name == "POLLO LIMPIO")
                        if (!producto) return 0
                        if (cantidadPollos > 0 && cantidadPollos <= 14) return Number(producto.venta_1)
                        if (cantidadPollos >= 15 && cantidadPollos <= 75) return Number(producto.venta_2)
                        if (cantidadPollos >= 76 && cantidadPollos <= 150) return Number(producto.venta_3)
                        if (cantidadPollos >= 151) return Number(producto.venta_4)
                        return 0
                    },
                    getDescuentoProductoPrecio(item) {
                        return this.productos_precios.find((b) => b.name == item)
                    },
                    AddGasto(d, i) {

                            let gasto = {
                                ...d
                            }
                            this.cart_gastos_model.push(gasto)

                    },
                    addVentaLoteCarrito(d, i) {
                       if(d.valor_precio > 0){
                         let producto = d.producto
                            let descuento_filter = this.ClienteCajacerradas.filter((b) => b.producto_precio.name == d
                                .producto)
                            let item = {
                                ...d
                            }
                            item.descuento_valor = 0
                            if (descuento_filter.length > 0) {
                                item.descuento_valor = descuento_filter[0].valor
                            }
                            let descuento = {
                                ...this.getDescuentoProductoPrecio(producto)
                            }
                            let cliente_pollo_limpio = this.cliente.tipo_pollo_limpia
                            item.descuento_pollo_limpio = 0
                            if (cliente_pollo_limpio == 1) {
                                item.descuento_pollo_limpio = descuento.descuento_2
                            }
                            if (cliente_pollo_limpio == 2) {
                                item.descuento_pollo_limpio = descuento.descuento_3
                            }
                            if (cliente_pollo_limpio == 3) {
                                item.descuento_pollo_limpio = descuento.descuento_4
                            }
                            if (cliente_pollo_limpio == 4) {
                                item.descuento_pollo_limpio = descuento.descuento_5
                            }
                            if (cliente_pollo_limpio == 5) {
                                item.descuento_pollo_limpio = descuento.descuento_6
                            }
                            if (cliente_pollo_limpio == 6) {
                                item.descuento_pollo_limpio = descuento.descuento_7
                            }
                            item.producto_precio_descuento = descuento
                            item.descuento_total = Number(item.peso_mod_neto) * Number(item.descuento_valor)
                            this.cart_lotes.push(item)
                            this.detalle_vente_lotes.splice(i, 1)
                       }else{
                         swal({
                             title: 'Error',
                             text: 'El precio no puede ser 0, por favor verifique los precios.',
                             type: 'warning',
                             confirmButtonText: 'Aceptar',
                             confirmButtonClass: 'btn btn-danger'
                         })
                       }
                    },

                    // addVentaPpCarrito(d, i) {
                    //     let item = {
                    //         ...d
                    //     }

                    //     this.cart_pps.push(item)
                    //     this.detalle_venta_pp.splice(i, 1)
                    // },

                    addVentaPpCarrito(d, i) {
                        if (Number(d.precio_acuerdo) <= 0) {
                            swal({
                            title: 'Error',
                            text: 'El precio no puede ser 0, por favor verifique los precios.',
                            type: 'warning',
                            confirmButtonText: 'Aceptar',
                            confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }
                        const item = JSON.parse(JSON.stringify(d));
                        item.grupo_name = d.grupo_name;
                        item.tipo_pp = Number(item.tipo_pp ?? 0);
                        const nombreProducto = item.tipo_pp === 1 ? 'POLLO COMPLETO' : 'POLLO LIMPIO';
                        item.item = item.item || {};
                        item.item.name = nombreProducto;
                        item.item.tipo_pp = item.tipo_pp;
                        const totalSinDesc = Number(item.total);
                        if (this.acuerdo) {
                            if (!this.item_id) {
                            swal.fire({
                                title: 'Error',
                                text: 'Debe seleccionar un item antes de agregar al carrito.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }

                        const selectedItem = this.items.find(it => it.id == this.item_id);

                        item.subdetalle = {
                            acuerdo: this.acuerdo,
                            item_id: this.item_id,
                            item_nombre: selectedItem ? selectedItem.name : '',
                            peso: this.ModelAcuerdo.kg,
                            cantidad: this.ModelAcuerdo.cantidad,
                            descuento_valor: this.ModelAcuerdo.t_des,
                            total_con_descuento: this.ModelAcuerdo.total,
                            total_sin_descuento: totalSinDesc,

                            precio_acuerdo: Number(item.precio_acuerdo),
                            peso_neto_vender: Number(item.peso_neto_vender),
                            pollos_vender: Number(item.pollos_vender),
                            cajas_vender: Number(item.cajas_vender),
                            };
                            item.total = Number(this.ModelAcuerdo.total);
                        }

                        this.cart_pps.push(item);
                        this.detalle_venta_pp.splice(i, 1);
                    },



                    // addTransformacionCarrito(d, i) {
                    //     let item = {
                    //         ...d
                    //     }

                    //     this.transformacion_cart.push(item)
                    //     this.transformacions_list.splice(i, 1)
                    // },

                    //para usar precios de transformaciones
                    addTransformacionCarrito(d, i) {
                        if(d.subitem.venta > 0){
                            //alert(d.total_cajas);
                            let item = JSON.parse(JSON.stringify(d));
                            let precioEncontrado = this.buscarPrecioTransformacion(item.subitem.id);
                            // alert(precioEncontrado)
                            if (precioEncontrado !== null) {
                                item.subitem.venta = precioEncontrado
                            }

                            if(item.total_cajas  > 0){
                                let tara = item.total_cajas * this.retraccion
                            }else{
                                let tara = 0
                            }

                            //item.total_peso_neto = item.total_peso_bruto -  tara
                            this.transformacion_cart.push(item);
                            this.transformacions_list.splice(i, 1);
                        }else{
                         swal({
                             title: 'Error',
                             text: 'El precio no puede ser 0, por favor verifique los precios.',
                             type: 'warning',
                             confirmButtonText: 'Aceptar',
                             confirmButtonClass: 'btn btn-danger'
                         })
                       }
                    },


                    // addVentaPtCarrito(d, i) {
                    //     let precio_buscar = this.itemSucursal.filter((b) => b.id == d.item.id)
                    //     let item = {
                    //         ...d
                    //     }
                    //     let precio_venta = item.item.venta
                    //     if (precio_buscar.length > 0) {
                    //         item.item.venta = precio_buscar[0].precio

                    //     }
                    //     let descuento_filter = this.ClientePts.filter((b) => b.item.id == d.item.id)
                    //     item.descuento_valor = 0
                    //     if (descuento_filter.length > 0) {
                    //         item.descuento_valor = descuento_filter[0].valor
                    //     }
                    //     item.descuento_total = Number(item.peso_neto_vender) * Number(item.descuento_valor)
                    //     this.cart_pts.push(item)
                    //     this.venta_items.splice(i, 1)

                    // },

                    addVentaPtCarrito(d, i) {
                        if(d.item.venta > 0){
                            const round = (n, dec = 3) => Math.round((Number(n) + Number.EPSILON) * 10**dec) / 10**dec;
                            const fmt = (n, dec = 3) => round(n, dec).toFixed(dec);
                            if (round(d.peso_neto_vender, 3) <= round(d.peso_neto, 3)) {
                            let item = { ...d }
                                let itemPrecioSucursal = this.itemSucursal.find(b => b.id == item.item.id)
                                let precio_final = 0;

                                let precio_personalizado = this.ClientePts.find(x => x.item && x.item.id == item.item.id);
                                if (precio_personalizado && precio_personalizado.valor) {
                                    precio_final = Number(precio_personalizado.valor);
                                }

                                if (precio_final === 0 && itemPrecioSucursal) {
                                    if (itemPrecioSucursal.estado_precio_alternativo_1 == 1) {
                                        precio_final = Number(itemPrecioSucursal.precio_alternativo_1);
                                    } else if (itemPrecioSucursal.estado_precio_alternativo_2 == 1) {
                                        precio_final = Number(itemPrecioSucursal.precio_alternativo_2);
                                    } else if (itemPrecioSucursal.estado_precio_alternativo_3 == 1) {
                                        precio_final = Number(itemPrecioSucursal.precio_alternativo_3);
                                    } else if (itemPrecioSucursal.estado_precio_alternativo_4 == 1) {
                                        precio_final = Number(itemPrecioSucursal.precio_alternativo_4);
                                    } else if (itemPrecioSucursal.estado_precio_alternativo_5 == 1) {
                                        precio_final = Number(itemPrecioSucursal.precio_alternativo_5);
                                    }
                                }

                                if (precio_final === 0 && itemPrecioSucursal) {
                                    let tipo_caja_cerrada_cliente = this.cliente.tipo_pt;
                                    if (tipo_caja_cerrada_cliente) {
                                        if (tipo_caja_cerrada_cliente === 12) {
                                            precio_final = Number(itemPrecioSucursal.precio_alternativo_5);
                                        } else if (tipo_caja_cerrada_cliente === 11) {
                                            precio_final = Number(itemPrecioSucursal.precio_alternativo_4);
                                        } else if (tipo_caja_cerrada_cliente === 10) {
                                            precio_final = Number(itemPrecioSucursal.precio_alternativo_3);
                                        } else if (tipo_caja_cerrada_cliente === 9) {
                                            precio_final = Number(itemPrecioSucursal.precio_alternativo_2);
                                        } else if (tipo_caja_cerrada_cliente === 8) {
                                            precio_final = Number(itemPrecioSucursal.precio_alternativo_1);
                                        } else if (tipo_caja_cerrada_cliente === 7) {
                                            precio_final = Number(itemPrecioSucursal.precio);
                                        }
                                    }
                                }

                                if (precio_final === 0 && itemPrecioSucursal) {
                                    // precio_final = Number(itemPrecioSucursal.precio);
                                    precio_final = 0;
                                }

                                item.item.venta = precio_final;

                                // let descuento_filter = this.ClientePts.filter(b => b.item.id == item.item.id)
                                // item.descuento_valor = 0
                                // if (descuento_filter.length > 0) {
                                //     item.descuento_valor = descuento_filter[0].valor
                                // }
                                // item.descuento_total = Number(item.peso_neto_vender) * Number(item.descuento_valor)
                                // item.total_final = Number(item.item.venta) * Number(item.peso_neto_vender) - item.descuento_total
                                // this.cart_pts.push(item)
                                // this.venta_items.splice(i, 1)

                                let descuento_filter = this.ClientePts.filter(b => b.item.id == item.item.id)
                                item.descuento_valor = 0
                                item.descuento_total = 0
                                item.total_final = Number(precio_final) * Number(item.peso_neto_vender) - item.descuento_total
                                this.cart_pts.push(item)
                                this.venta_items.splice(i, 1)
                            }else{
                                swal({
                                    title: "Error",
                                    text: "El peso a vender no puede ser mayor al peso total del pollo.",
                                    type: "error",
                                    button: "Aceptar",
                                });

                            }
                        }else{
                         swal({
                             title: 'Error',
                             text: 'El precio no puede ser 0, por favor verifique los precios.',
                             type: 'warning',
                             confirmButtonText: 'Aceptar',
                             confirmButtonClass: 'btn btn-danger'
                         })
                       }
                    },

                    async FinalizarLote(id) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de Cerrar el lote?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Finalizar Lote',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                block.block()
                                try {
                                    let res = await axios.post("{{ url('api/lotes-finalizar') }}/" + id, { id });
                                    await this.load();

                                    swalWithBootstrapButtons({
                                        title: 'Lote Finalizado',
                                        text: "El lote fue cerrado exitosamente.",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        reverseButtons: true,
                                        padding: '2em'
                                    });
                                } catch (e) {
                                    block.unblock()
                                    console.error(e);
                                }
                            }
                        });
                    },

                    addGasto() {
                        this.gastos.push({
                            detalle: '',
                            valor: 0
                        })
                    },
                    // AddPpDetalle(d) {
                    //         let pp_detalle = {
                    //             ...d
                    //         }
                    //         pp_detalle.item = {
                    //             ...this.ItemSelect
                    //         }
                    //         this.detalle_venta_pp.push(pp_detalle)
                    //         this.venta_pps = []

                    // },
                    AddPpDetalle(d) {
                        if (!this.cliente.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        if (!this.chofer || !this.chofer.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Chofer',
                                text: "Selecciona un chofer antes de continuar.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }
                        let pp_detalle = {
                            ...d
                        };
                        pp_detalle.tipo_pp = 0;
                        pp_detalle.item = {
                            ...this.ItemSelect,
                            name: 'POLLO LIMPIO'
                        };
                        this.detalle_venta_pp.push(pp_detalle);
                        this.venta_pps = [];
                    },

                    // AddPtItem(d, pt) {
                    //     let pt_detalle = {
                    //         ...d
                    //     }
                    //     pt_detalle.pt_id = pt.id
                    //     pt_detalle.nro = pt.nro
                    //     pt_detalle.peso_bruto_x_caja = Number(pt_detalle.peso_bruto / pt_detalle.cajas).toFixed(2)
                    //     pt_detalle.peso_neto_x_caja = Number(pt_detalle.peso_neto / pt_detalle.cajas).toFixed(2)
                    //     pt_detalle.cajas_vender = 1
                    //     pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
                    //     pt_detalle.peso_neto_vender = pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender
                    //     pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender

                    //     this.venta_items.push(pt_detalle)
                    // },

                    AddPtItem(d, pt) {
                        if (!this.cliente.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        if (!this.chofer || !this.chofer.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Chofer',
                                text: "Selecciona un chofer antes de continuar.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }
                        let pt_detalle = { ...d }
                        pt_detalle.pt_id = pt.id
                        pt_detalle.nro = pt.nro
                        let cajas = pt_detalle.cajas > 0 ? pt_detalle.cajas : 1;
                        pt_detalle.peso_bruto_x_caja = Number(pt_detalle.peso_bruto / cajas).toFixed(3)
                        pt_detalle.peso_neto_x_caja = Number(pt_detalle.peso_neto / cajas).toFixed(3)
                        pt_detalle.cajas_vender = 1
                        pt_detalle.peso_bruto_vender = pt_detalle.cajas_vender > 0 ? pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender : 0;
                        pt_detalle.peso_neto_vender = pt_detalle.cajas_vender > 0 ? pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender : 0;
                        pt_detalle.tara_vender = pt_detalle.cajas_vender * this.retraccion
                        let itemPolloSucursal = this.itemSucursal.find(b => b.id == pt_detalle.item.id)
                        let precio_final = 0;

                        let precio_personalizado = this.ClientePts.find(x => x.item && x.item.id == pt_detalle.item.id);
                            if (precio_personalizado && precio_personalizado.valor) {
                                precio_final = Number(precio_personalizado.valor);
                        }
                        if (precio_final === 0 && itemPolloSucursal) {
                            if (itemPolloSucursal.estado_precio_alternativo_1 == 1) {
                                precio_final = Number(itemPolloSucursal.precio_alternativo_1);
                            } else if (itemPolloSucursal.estado_precio_alternativo_2 == 1) {
                                precio_final = Number(itemPolloSucursal.precio_alternativo_2);
                            } else if (itemPolloSucursal.estado_precio_alternativo_3 == 1) {
                                precio_final = Number(itemPolloSucursal.precio_alternativo_3);
                            } else if (itemPolloSucursal.estado_precio_alternativo_4 == 1) {
                                precio_final = Number(itemPolloSucursal.precio_alternativo_4);
                            } else if (itemPolloSucursal.estado_precio_alternativo_5 == 1) {
                                precio_final = Number(itemPolloSucursal.precio_alternativo_5);
                            }
                        }
                        if (precio_final === 0 && itemPolloSucursal) {
                            let tipo_caja_cerrada_cliente = this.cliente.tipo_pt;
                            if (tipo_caja_cerrada_cliente) {
                                if (tipo_caja_cerrada_cliente === 12) {
                                    precio_final = Number(itemPolloSucursal.precio_alternativo_5);
                                } else if (tipo_caja_cerrada_cliente === 11) {
                                    precio_final = Number(itemPolloSucursal.precio_alternativo_4);
                                } else if (tipo_caja_cerrada_cliente === 10) {
                                    precio_final = Number(itemPolloSucursal.precio_alternativo_3);
                                } else if (tipo_caja_cerrada_cliente === 9) {
                                    precio_final = Number(itemPolloSucursal.precio_alternativo_2);
                                } else if (tipo_caja_cerrada_cliente === 8) {
                                    precio_final = Number(itemPolloSucursal.precio_alternativo_1);
                                } else if (tipo_caja_cerrada_cliente === 7) {
                                    precio_final = Number(itemPolloSucursal.precio);
                                }
                            }
                        }

                        // Si no se encontró ningún precio, usar el precio base
                        if (precio_final === 0 && itemPolloSucursal) {
                            // precio_final = Number(itemPolloSucursal.precio);
                            precio_final = 0;
                        }


                        pt_detalle.item.venta = precio_final;
                        this.venta_items.push(pt_detalle)
                    },




                    changeCajasItem(pt_detalle) {
                        let cajas = pt_detalle.cajas_vender * this.retraccion
                        pt_detalle.peso_bruto_vender = this.red(pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender, 3)
                        pt_detalle.peso_neto_vender = this.red(pt_detalle.peso_bruto_x_caja - cajas, 3)
                        pt_detalle.tara_vender = this.red(pt_detalle.cajas_vender * this.retraccion, 0)
                        // pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },
                    changePesoBrutoItem(pt_detalle) {
                        let cajas = pt_detalle.cajas_vender * this.retraccion
                        pt_detalle.peso_neto_vender = this.red(pt_detalle.peso_bruto_vender - cajas, 3)
                        pt_detalle.tara_vender = this.red(pt_detalle.cajas_vender * this.retraccion, 0)
                        // pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },
                    changePesoNetoItem(pt_detalle) {
                        let cajas = pt_detalle.cajas_vender * this.retraccion
                        pt_detalle.peso_neto_vender = this.red(pt_detalle.peso_bruto_vender - cajas, 3)
                        pt_detalle.tara_vender = this.red(pt_detalle.cajas_vender * this.retraccion, 0)
                        // pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },

                    changeCajasTransformacion(m) {
                        const cajas = m.total_cajas * this.retraccion;
                        m.total_tara = cajas;
                        m.total_peso_neto = Number((m.total_peso_bruto - m.total_tara).toFixed(3));
                        m.subtotal = Number((m.total_peso_neto * m.subitem.venta).toFixed(2));
                    },

                    changePesoBrutoTransformacion(m) {
                        const cajas = m.total_cajas * this.retraccion;
                        m.total_tara = cajas;
                        m.total_peso_neto = Number((m.total_peso_bruto - m.total_tara).toFixed(3));
                        m.subtotal = Number((m.total_peso_neto * m.subitem.venta).toFixed(2));
                    },

                    changePesoNetoTransformacion(m) {
                        const cajas = m.total_cajas * this.retraccion;
                        m.total_tara = cajas;
                        m.total_peso_bruto = Number((m.total_peso_neto + m.total_tara).toFixed(3));
                        m.subtotal = Number((m.total_peso_neto * m.subitem.venta).toFixed(2));
                    },

                    bandera(d) {
                        let b = this.banderas.find(b => d.dias >= b.min && d.dias <= b.max)
                        if (b) {
                            return b.name
                        }
                        return ''
                    },

                    changeCajas(d) {

                        d.equivalente = Math.round(Number(d.cajas) * Number(d.pollos));
                        const cajas = Number(d.cajas) * Number(this.retraccion || 0);

                        const producto = d.producto;
                        const p = d.producto_precio || this.productos_precios.find(x => x.name === producto) || null;

                        let precio_final = null;
                        let precio_estado = null;

                        // 1) Personalizado por cliente
                        const per = this.ClienteCajacerradas.find(
                            x => x.producto_precio && x.producto_precio.name === producto
                        );
                        if (per && per.valor) precio_final = Number(per.valor);

                        // 2) Estado activo
                        if (precio_final === null && p) {
                            if (p.estado_precio_5  == 1) precio_estado = Number(p.venta_5);
                            else if (p.estado_precio_6  == 1) precio_estado = Number(p.venta_6);
                            else if (p.estado_precio_7  == 1) precio_estado = Number(p.venta_7);
                            else if (p.estado_precio_8  == 1) precio_estado = Number(p.venta_8);
                            else if (p.estado_precio_9  == 1) precio_estado = Number(p.venta_9);
                            else if (p.estado_precio_10 == 1) precio_estado = Number(p.venta_10);
                            else if (p.estado_precio_11 == 1) precio_estado = Number(p.venta_11);
                            else if (p.estado_precio_12 == 1) precio_estado = Number(p.venta_12);
                        }
                        if (precio_final === null && precio_estado !== null) {
                            precio_final = precio_estado;
                        }

                        // 3) Tipo de cliente
                        if (precio_final === null && p) {
                            const t = this.cliente && this.cliente.tipo_caja_cerrada;
                            if      (t === 12) precio_final = Number(p.venta_12);
                            else if (t === 11) precio_final = Number(p.venta_11);
                            else if (t === 10) precio_final = Number(p.venta_10);
                            else if (t === 9)  precio_final = Number(p.venta_9);
                            else if (t === 8)  precio_final = Number(p.venta_8);
                            else if (t === 7)  precio_final = Number(p.venta_7);
                            else if (t === 6)  precio_final = Number(p.venta_6);
                            else if (t === 5)  precio_final = Number(p.venta_5);
                            else if (t === 4)  precio_final = Number(p.venta_4);
                            else if (t === 3)  precio_final = Number(p.venta_3);
                            else if (t === 2)  precio_final = Number(p.venta_2);
                            else if (t === 1)  precio_final = Number(p.venta_1);
                        }

                                                // if (precio_final === null && producto_precio) {
                            //     if (total_pollos > 1 && total_pollos <= 14) {
                            //         precio_final = producto_precio.descuento_2 > 0 ? Number(producto_precio.descuento_2) : Number(producto_precio.venta_1);
                            //     } else if (total_pollos > 14 && total_pollos <= 75) {
                            //         precio_final = producto_precio.descuento_3 > 0 ? Number(producto_precio.descuento_3) : Number(producto_precio.venta_2);
                            //     } else if (total_pollos > 75 && total_pollos <= 150) {
                            //         precio_final = producto_precio.descuento_4 > 0 ? Number(producto_precio.descuento_4) : Number(producto_precio.venta_3);
                            //     } else if (total_pollos > 150) {
                            //         precio_final = producto_precio.descuento_5 > 0 ? Number(producto_precio.descuento_5) : Number(producto_precio.venta_4);
                            //     }
                            // }

                        // 4) Default
                        if (precio_final === null) precio_final = 0;

                        d.precio_detalle_lote = precio_final;

                        d.peso_actual_bruto = Number(d.equivalente * Number(d.peso_unitario_bruto)).toFixed(3);
                        d.peso_actual_neto  = Number(Number(d.peso_actual_bruto) - cajas).toFixed(3);
                        d.peso_mod_bruto    = Number(d.peso_actual_bruto).toFixed(3);
                        d.peso_mod_neto     = Number(d.peso_actual_neto).toFixed(3);
                        d.merma_bruta       = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3);
                        d.merma_neta        = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3);

                        d.peso_unitario_bruto = Number(d.peso_total / d.equivalente).toFixed(3);
                        d.peso_unitario_neto = Number((d.peso_total - cajas) / d.equivalente).toFixed(3);

                    },

                    changeLote(d) {
                        const cajas = Number(d.cajas) * Number(this.retraccion || 0);

                        const producto = d.producto;
                        const p = d.producto_precio || this.productos_precios.find(x => x.name === producto) || null;

                        let precio_final = null;
                        let precio_estado = null;

                        // 1) Personalizado por cliente
                        const per = this.ClienteCajacerradas.find(
                            x => x.producto_precio && x.producto_precio.name === producto
                        );
                        if (per && per.valor) precio_final = Number(per.valor);

                        // 2) Estado activo
                        if (precio_final === null && p) {
                            if (p.estado_precio_5  == 1) precio_estado = Number(p.venta_5);
                            else if (p.estado_precio_6  == 1) precio_estado = Number(p.venta_6);
                            else if (p.estado_precio_7  == 1) precio_estado = Number(p.venta_7);
                            else if (p.estado_precio_8  == 1) precio_estado = Number(p.venta_8);
                            else if (p.estado_precio_9  == 1) precio_estado = Number(p.venta_9);
                            else if (p.estado_precio_10 == 1) precio_estado = Number(p.venta_10);
                            else if (p.estado_precio_11 == 1) precio_estado = Number(p.venta_11);
                            else if (p.estado_precio_12 == 1) precio_estado = Number(p.venta_12);
                        }
                        if (precio_final === null && precio_estado !== null) {
                            precio_final = precio_estado;
                        }

                        // 3) Tipo de cliente
                        if (precio_final === null && p) {
                            const t = this.cliente && this.cliente.tipo_caja_cerrada;
                            if      (t === 12) precio_final = Number(p.venta_12);
                            else if (t === 11) precio_final = Number(p.venta_11);
                            else if (t === 10) precio_final = Number(p.venta_10);
                            else if (t === 9)  precio_final = Number(p.venta_9);
                            else if (t === 8)  precio_final = Number(p.venta_8);
                            else if (t === 7)  precio_final = Number(p.venta_7);
                            else if (t === 6)  precio_final = Number(p.venta_6);
                            else if (t === 5)  precio_final = Number(p.venta_5);
                            else if (t === 4)  precio_final = Number(p.venta_4);
                            else if (t === 3)  precio_final = Number(p.venta_3);
                            else if (t === 2)  precio_final = Number(p.venta_2);
                            else if (t === 1)  precio_final = Number(p.venta_1);
                        }

                        // if (precio_final === null && producto_precio) {
                            //     if (total_pollos > 1 && total_pollos <= 14) {
                            //         precio_final = producto_precio.descuento_2 > 0 ? Number(producto_precio.descuento_2) : Number(producto_precio.venta_1);
                            //     } else if (total_pollos > 14 && total_pollos <= 75) {
                            //         precio_final = producto_precio.descuento_3 > 0 ? Number(producto_precio.descuento_3) : Number(producto_precio.venta_2);
                            //     } else if (total_pollos > 75 && total_pollos <= 150) {
                            //         precio_final = producto_precio.descuento_4 > 0 ? Number(producto_precio.descuento_4) : Number(producto_precio.venta_3);
                            //     } else if (total_pollos > 150) {
                            //         precio_final = producto_precio.descuento_5 > 0 ? Number(producto_precio.descuento_5) : Number(producto_precio.venta_4);
                            //     }
                            // }
                        // 4) Default
                        if (precio_final === null) precio_final = 0;

                        d.precio_detalle_lote = precio_final;

                        d.peso_actual_bruto = Number(d.equivalente * Number(d.peso_unitario_bruto)).toFixed(3);
                        d.peso_actual_neto  = Number(Number(d.peso_actual_bruto) - cajas).toFixed(3);
                        d.peso_mod_bruto    = Number(d.peso_actual_bruto).toFixed(3);
                        d.peso_mod_neto     = Number(d.peso_actual_neto).toFixed(3);
                        d.merma_bruta       = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3);
                        d.merma_neta        = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3);

                        d.peso_unitario_bruto = Number(d.peso_total / d.equivalente).toFixed(3);
                        d.peso_unitario_neto = Number((d.peso_total - cajas) / d.equivalente).toFixed(3);
                    },

                    changeLoteM(d) {
                        const cajas = Number(d.cajas) * Number(this.retraccion || 0);
                        d.peso_mod_neto = Number(d.peso_mod_bruto - d.tara).toFixed(3)
                        d.peso_unitario_bruto = Number(d.peso_mod_bruto / d.equivalente).toFixed(3);
                        d.peso_unitario_neto = Number((d.peso_mod_bruto - cajas) / d.equivalente).toFixed(3);
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },

                    AddDetalle(i, compra, cinta, dias) {
                        if (!this.cliente || !this.cliente.id) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        let producto = i.producto;
                        let buscar_precio = this.productos_precios.filter(p => p.name == producto);
                        let total_pollos = i.total_pollos;
                        let precio_final = null;
                        let precio_estado = null;

                        let precio_personalizado = this.ClienteCajacerradas.find(
                            x => x.producto_precio && x.producto_precio.name === producto
                        );
                        if (precio_personalizado && precio_personalizado.valor) {
                            precio_final = Number(precio_personalizado.valor);
                        }

                        if (precio_final === null && buscar_precio.length > 0) {
                            let precio = buscar_precio[0];
                            if (precio.estado_precio_5 == 1) precio_estado = Number(precio.venta_5);
                            else if (precio.estado_precio_6 == 1) precio_estado = Number(precio.venta_6);
                            else if (precio.estado_precio_7 == 1) precio_estado = Number(precio.venta_7);
                            else if (precio.estado_precio_8 == 1) precio_estado = Number(precio.venta_8);
                            else if (precio.estado_precio_9 == 1) precio_estado = Number(precio.venta_9);
                            else if (precio.estado_precio_10 == 1) precio_estado = Number(precio.venta_10);
                            else if (precio.estado_precio_11 == 1) precio_estado = Number(precio.venta_11);
                            else if (precio.estado_precio_12 == 1) precio_estado = Number(precio.venta_12);

                            if (precio_final === null && precio_estado !== null) {
                                precio_final = precio_estado;
                            }
                        }


                        if (precio_final === null) {
                            let tipo_caja_cerrada_cliente = this.cliente.tipo_caja_cerrada;
                            if (tipo_caja_cerrada_cliente && buscar_precio.length > 0) {
                                let precio = buscar_precio[0];
                                if (tipo_caja_cerrada_cliente === 12) {
                                    precio_final = Number(precio.venta_12);
                                } else if (tipo_caja_cerrada_cliente === 11) {
                                    precio_final = Number(precio.venta_11);
                                } else if (tipo_caja_cerrada_cliente === 10) {
                                    precio_final = Number(precio.venta_10);
                                } else if (tipo_caja_cerrada_cliente === 9) {
                                    precio_final = Number(precio.venta_9);
                                } else if (tipo_caja_cerrada_cliente === 8) {
                                    precio_final = Number(precio.venta_8);
                                } else if (tipo_caja_cerrada_cliente === 7) {
                                    precio_final = Number(precio.venta_7);
                                } else if (tipo_caja_cerrada_cliente === 6) {
                                    precio_final = Number(precio.venta_6);
                                } else if (tipo_caja_cerrada_cliente === 5) {
                                    precio_final = Number(precio.venta_5);
                                } else if (tipo_caja_cerrada_cliente === 4) {
                                    precio_final = Number(precio.venta_4);
                                } else if (tipo_caja_cerrada_cliente === 3) {
                                    precio_final = Number(precio.venta_3);
                                } else if (tipo_caja_cerrada_cliente === 2) {
                                    precio_final = Number(precio.venta_2);
                                } else if (tipo_caja_cerrada_cliente === 1) {
                                    precio_final = Number(precio.venta_1);
                                }
                            }
                        }
                        // if (precio_final === null && buscar_precio.length > 0) {
                        //     let precio = buscar_precio[0];
                        //     if (total_pollos > 1 && total_pollos <= 14) {
                        //         precio_final = precio.descuento_2 > 0 ? Number(precio.descuento_2) : Number(precio.venta_1);
                        //     }
                        //     if (total_pollos > 14 && total_pollos <= 75) {
                        //         precio_final = precio.descuento_3 > 0 ? Number(precio.descuento_3) : Number(precio.venta_2);
                        //     }
                        //     if (total_pollos > 75 && total_pollos <= 150) {
                        //         precio_final = precio.descuento_4 > 0 ? Number(precio.descuento_4) : Number(precio.venta_3);
                        //     }
                        //     if (total_pollos > 150) {
                        //         precio_final = precio.descuento_5 > 0 ? Number(precio.descuento_5) : Number(precio.venta_4);
                        //     }
                        // }

                        if (precio_final === null) {
                            precio_final = 0;
                        }
                        let item = {
                            ...i,
                            compra: { ...compra },
                            producto_precio: buscar_precio[0],
                            peso_unitario_bruto: Number(i.peso_total / i.equivalente).toFixed(3),
                            peso_neto: Number(i.peso_total - i.cajas * this.retraccion).toFixed(3),
                            peso_unitario_neto: Number((i.peso_total - i.cajas * this.retraccion) / i.equivalente).toFixed(3),
                            peso_actual_bruto: Number(i.equivalente * (i.peso_total / i.equivalente)).toFixed(3),
                            peso_actual_neto: Number(i.equivalente * ((i.peso_total - i.cajas * this.retraccion) / i.equivalente)).toFixed(3),
                            peso_mod_bruto: Number(i.equivalente * (i.peso_total / i.equivalente)).toFixed(3),
                            peso_mod_neto: Number(i.equivalente * ((i.peso_total - i.cajas * this.retraccion) / i.equivalente)).toFixed(3),
                            cinta,
                            dias,
                            precio_detalle_lote: precio_final,
                            valor_precio: precio_final
                        };
                        item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(3);
                        item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(3);

                        this.detalle_vente_lotes.push(item);
                    },


                    AddDetalleLote() {
                        let item = {
                            ...this.detalle_lote
                        }
                        item.producto_precio = {
                            ...this.producto_precio
                        }
                        item.valor_precio = this.valor_precio
                        this.detalle_vente_lotes.push(item)
                    },
                    CambioPeso() {
                        this.envio.bruto = Number(this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes).toFixed(
                            2)
                        this.envio.neto = Number(this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes).toFixed(
                            2)
                        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.neto).toFixed(3)


                    },
                    CambioPesoMerma() {
                        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.neto).toFixed(3)


                    },

                    async Vender() {
                        if (!this.cliente || !this.cliente.id) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        if (!this.chofer || !this.chofer.id) {
                            swal.fire({
                                title: 'Chofer no asignado',
                                text: 'Debe seleccionar un chofer antes de continuar con la venta.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }

                        if (!this.preventista_id) {
                            swal.fire({
                                title: 'Preventista no seleccionado',
                                text: 'Debe seleccionar un preventista antes de continuar con la venta.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }
                        if (!this.distribuidor_id) {
                            swal.fire({
                                title: 'Preventista no seleccionado',
                                text: 'Debe seleccionar un preventista antes de continuar con la venta.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }

                        if (
                            this.cart_pps.length === 0 &&
                            this.cart_pts.length === 0 &&
                            this.cart_lotes.length === 0 &&
                            this.transformacion_cart.length === 0 &&
                            this.lotes_cerrar.length === 0
                        ) {
                            swal.fire({
                                title: 'No hay productos seleccionados',
                                text: 'Debe agregar productos a la venta antes de continuar.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }


                            block.block()
                            let self = this
                            try {
                                let data = {
                                    cliente_id: self.cliente.id,
                                    cinta_cliente_id: self.cliente.cinta_cliente.id,
                                    chofer_id: self.chofer.id,
                                    turno_chofer_id: self.chofer.turno_chofer.id,
                                    venta_pps: self.cart_pps,
                                    detalle_vente_lotes: self.cart_lotes,
                                    venta_items: self.cart_pts,
                                    peso_bruto_total: self.peso_bruto_total,
                                    venta_transformacion: self.transformacion_cart,
                                    fecha_entrega: self.entrega.fecha,
                                    hora_entrega: self.entrega.hora,
                                    lotes: this.lotes_cerrar,
                                    acuerdo: this.acuerdo,
                                    fecha_pedido: this.fecha_pedido,
                                    preventista_id: self.preventista_id,
                                    distribuidor_id: self.distribuidor_id,
                                    user_id: this.user.id,
                                    sucursal_id :this.sucursal.id,
                                    hora_entrega: this.hora_entrega,
                                    forma_pago_id: this.formapago.id,
                                    forma_pedido_id: this.forma_pedido.id,
                                    metodo_pago: this.metodo_pago,
                                    observacion: this.entrega.observacion,
                                    total:this.totalAll,
                                    total_cajas: this.totalCajas,
                                    cart_acuerdo_items: this.cart_acuerdo_items,
                                    cart_gastos:this.cart_gastos_model

                                }
                                let res = await axios.post("{{ url('api/ventas-2') }}", data)
                                if (res.data.error) {
                                    this.showErrorModal(res.data.error);
                                    return;
                                }
                                self.detalle_vente_lotes = []
                                self.venta_pps = []
                                self.venta_items = []
                                self.detalle_venta_pp = []
                                self.cart_pps = []
                                self.cart_lotes = []
                                self.transformacion_cart = []
                                self.cart_pts = []
                                self.cart_gastos_model = []

                                self.entrega = {
                                    fecha: '',
                                    hora: ''
                                }
                                self.chofer = {
                                    capacidad_utilizada: 0,
                                    turno_chofer: {
                                        capacidad_disponible: 0
                                    }
                                }

                                self.metodo_pago = 1
                                self.formapago = {

                                }
                                self.forma_pedido = {

                                }
                                self.preventista_id= null
                                self.distribuidor_id= null
                                self.acuerdo= null


                                //window.open(res.data.url_pdfTicket, '_blank');
                                window.open(res.data.url_pdf, '_blank');



                                await this.load();
                            } catch (e) {
                                console.log(e)
                                swal.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un error al procesar la venta, complete todos los campos obligatorios.',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar',
                                    confirmButtonClass: 'btn btn-danger'
                                });
                            } finally {
                                block.unblock()
                            }

                    },
                    showErrorModal(errorMessage) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: 'Error',
                            text: errorMessage,
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'Aceptar',
                            reverseButtons: true,
                            padding: '2em'
                        });
                    },

                    ChangeCajasPp(item) {
                        const red = (n, p = 3) => {
                            const f = Math.pow(10, p);
                            return Math.round((Number(n) + Number.EPSILON) * f) / f;
                        };
                        let cajas = Number(item.cajas_vender);
                        let pollos_x_caja = red(item.pollos_x_caja,3);

                        item.pollos_vender     = Math.round(cajas * pollos_x_caja);
                        item.peso_bruto_vender = red(item.pollos_vender * item.peso_bruto_unit, 3);
                        item.peso_neto_vender  = red(item.pollos_vender * item.peso_neto_unit, 3);
                    },

                    ChangePollosPp(item) {
                        const red = (n, p = 3) => {
                            const f = Math.pow(10, p);
                            return Math.round((Number(n) + Number.EPSILON) * f) / f;
                        };
                        let pollos_vender = Number(item.pollos_vender);

                        item.peso_bruto_vender = red(pollos_vender * item.peso_bruto_unit, 3);
                        item.peso_neto_vender  = red(item.peso_bruto_vender - item.tara, 3);
                        // Si prefieres por unidad, sería:
                        // item.peso_neto_vender = red(pollos_vender * item.peso_neto_unit, 3);
                    },

                    ChangePesoPp(item) {
                        const red = (n, p = 3) => {
                            const f = Math.pow(10, p);
                            return Math.round((Number(n) + Number.EPSILON) * f) / f;
                        };
                        let peso_bruto = Number(item.peso_bruto_vender);
                        item.peso_neto_vender = red(peso_bruto - item.tara, 3);
                    },


                    AddPp(m) {
                        // helper de redondeo con epsilon
                        const red = (n, p = 3) => {
                            const f = Math.pow(10, p);
                            return Math.round((Number(n) + Number.EPSILON) * f) / f;
                        };

                        let pp = {
                            ...m
                        }
                        pp.grupo_name = m.cinta_cliente ? m.cinta_cliente.name : 'SIN CINTA';
                        let pollos_x_caja = red(pp.pollos) / Number(pp.cajas,3);

                        pp.cajas_vender      = pp.cajas;
                        pp.peso_bruto_vender = red(pp.peso_bruto, 3);
                        pp.peso_neto_vender  = red(pp.peso_neto, 3);
                        pp.pollos_vender     = pp.pollos;
                        pp.pollos_x_caja     = Math.round(pollos_x_caja);

                        pp.peso_bruto_unit   = red(Number(pp.peso_bruto) / Number(pp.pollos), 3);
                        pp.peso_neto_unit    = red(Number(pp.peso_neto)  / Number(pp.pollos), 3);

                        pp.sobra             = false;
                        pp.sobra_descripcion = '';
                        pp.sobra_peso        = 0;

                        this.AddPpDetalle(pp);
                    },

                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },

                    async Save() {
                        block.block();
                        try {

                            let url = "url_path()api/clientes";
                            await axios.post("{{ url('api/clientes') }}", this.model)
                            this.back()

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async GetLote() {
                        block.block();
                        try {
                            let res = await axios.get("{{ url('api') }}/lotes-pos/" + this.lote_id)
                            this.lote = res.data
                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    back() {
                        window.location.replace(document.referrer);
                    },
                    async load() {
                        try {
                            let self = this
                            block.block()
                            try {
                                await Promise.all([self.GET_DATA("pps/curso-pos/" + this.sucursal.id),
                                    self.GET_DATA("lotes-general"),
                                    self.GET_DATA("banderas"),
                                    self.GET_DATA("clientes-precios-list"),
                                    self.GET_DATA("chofers-turno"),
                                    self.GET_DATA("formapagos"),
                                    self.GET_DATA("items"),
                                    self.GET_DATA("pts/curso-pos/" + this.sucursal.id),
                                    self.GET_DATA("producto-precios-sucursal/" + this.sucursal.id),
                                    self.GET_DATA("cintaClientes"),
                                    self.GET_DATA("acuerdoClientes"),
                                    self.GET_DATA("pollo-sucursal/" + this.sucursal.id),
                                    self.GET_DATA("tranformacion-lotes/curso-pos/" + this.sucursal.id),
                                    self.GET_DATA("users"),
                                    self.GET_DATA("formaPedidos"),

                                    self.GET_DATA("transItems"),
                                    self.GET_DATA("transEspecials"),
                                    self.GET_DATA("medidas"),
                                    self.GET_DATA('tipopagos'),

                                ]).then((v) => {
                                    self.pps = v[0]
                                    self.lotes = v[1]
                                    self.banderas = v[2]
                                    self.clientes = v[3]
                                    self.chofers = v[4]
                                    self.formapagos = v[5]

                                    let items = v[6]
                                    self.items = items.filter((item) => {
                                        return (item.tipo == 1 || item.tipo == 2 || item.tipo == 3)
                                            && ["CUELLO", "MENUDO", "HIGADO", "PULMON", "CUERO", "GRASA"].includes(item.name.toUpperCase());
                                    });

                                    self.pts = v[7]
                                    self.productos_precios = v[8]
                                    self.cintaClientes = v[9]
                                    self.acuerdos = v[10]
                                    self.pollo_sucursal = v[11]
                                    self.transformacions = v[12]
                                    self.users = v[13]
                                    self.forma_pedidos = v[14]

                                    self.transItems = v[15]
                                    self.transEspecials = v[16]

                                    if (self.forma_pedidos.length > 0) {
                                        self.forma_pedido = self.forma_pedidos[0]
                                    }
                                    if (self.formapagos.length > 0) {
                                        self.formapago = self.formapagos[0]
                                    }
                                    const medidaCajas = v[17].find((medida) => medida.name === 'CAJAS');
                                    if (medidaCajas) {
                                        self.retraccion = medidaCajas.retraccion;
                                    }

                                    self.tipopagos = v[18]
                                })
                                $(".select_cliente").val(null).trigger('change');
                                $(".select_codigo_cliente").val(null).trigger('change');
                                $(".select_cajas_cerradas").val(null).trigger('change');
                                $(".select_pt_item").val(null).trigger('change');
                                $(".select_pp_item").val(null).trigger('change');
                                $(".select_chofer").val(null).trigger('change');
                                block.unblock()
                            } catch (e) {
                                block.unblock()
                            }
                        } catch (e) {

                        }
                    },
                    TeclaPress(e) {
                        //tecla F8
                        if (e.keyCode == 118) {
                            this.Vender
                        }

                    },
                    async preventRefresh(event) {
                        if (event.key === 'F5' || (event.ctrlKey && event.key === 'r')) {
                            event.preventDefault();

                        }
                        if (event.key === 'F7') {
                            await this.Vender()
                        }
                    },
                    // AddTransformacion(item, m) {
                    //     item.tramsformacion = {
                    //         id: m.id,
                    //         nro: m.nro
                    //     }
                    //     this.transformacions_list.push(item)
                    // }
                    AddTransformacion(item, m) {
                        if (!this.cliente.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        if (!this.chofer || !this.chofer.hasOwnProperty('id')) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Chofer',
                                text: "Selecciona un chofer antes de continuar.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }
                        let itemCopia = JSON.parse(JSON.stringify(item));
                        let precioEncontrado = this.buscarPrecioTransformacion(itemCopia.subitem.id);
                         // alert(precioEncontrado)
                        if (precioEncontrado !== null) {
                            itemCopia.subitem.venta = precioEncontrado;
                        }
                        itemCopia.tramsformacion = {
                            id: m.id,
                            nro: m.nro
                        };
                        this.transformacions_list.push(itemCopia);
                    },
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this

                        const now = new Date()
                        const yyyy = now.getFullYear()
                        const mm = String(now.getMonth() + 1).padStart(2, '0')
                        const dd = String(now.getDate()).padStart(2, '0')
                        const hh = String(now.getHours()).padStart(2, '0')
                        const min = String(now.getMinutes()).padStart(2, '0')

                        this.fecha_pedido = `${yyyy}-${mm}-${dd}`
                        this.hora_entrega = `${hh}:${min}`

                        try {



                            let sucursal = localStorage.getItem('AppSucursal')
                            this.sucursal = JSON.parse(sucursal)
                            let user = localStorage.getItem('AppUser')
                            this.user = JSON.parse(user)
                            await Promise.all([self.load()]).then((v) => {

                            })

                        } catch (e) {

                        } finally {
                            $(".select_cliente").select2({
                                tags: true,
                                placeholder: "Seleccione un cliente",
                            }).change((v) => {
                                self.model.cliente_id = v.target.value;
                                let buscar_cliente = self.clientes.find((v) => v.id == self.model.cliente_id);

                                if (buscar_cliente) {
                                    self.cliente = buscar_cliente;

                                    self.acuerdo = self.cliente.acuerdo_cliente || null;
                                    if (!self.acuerdo) self.peso_acuerdo = 0;

                                    self.creditos_activos_saldo = self.cliente.creditos_activos_saldo;
                                    self.saldo_limite_crediticio = self.cliente.saldo_limite_crediticio;

                                    if (self.cliente.tipopago_id) {
                                        self.metodo_pago = Number(self.cliente.tipopago_id);
                                        $(".select_metodo").val(String(self.metodo_pago)).trigger('change');
                                    } else {
                                        self.metodo_pago = '';
                                        $(".select_metodo").val(1).trigger('change');
                                    }

                                    if (self.cliente.chofer_id) {
                                        self.chofer = self.chofers.find(chofer => chofer.id === self.cliente.chofer_id);

                                        if (self.chofer) {

                                            if (self.chofer.turno_chofer == null) {
                                                self.chofer = null;
                                                $(".select_chofer").val(null).trigger('change');
                                            } else {
                                                $(".select_chofer").val(self.chofer.id).trigger('change');
                                            }
                                        }
                                    }

                                    if (self.cliente.preventista_id) {
                                        self.preventista_id = self.cliente.preventista_id;
                                        $(".select_preventista").val(self.preventista_id).trigger('change');
                                    } else {
                                        $(".select_preventista").val(null).trigger('change');
                                    }
                                    if (self.cliente.distribuidor_id) {
                                        self.distribuidor_id = self.cliente.distribuidor_id;
                                        $(".select_preventista").val(self.distribuidor_id).trigger('change');
                                    } else {
                                        $(".select_preventista").val(null).trigger('change');
                                    }
                                }
                            });

                            $(".select_codigo_cliente").select2({
                                tags: true,
                                placeholder: "Buscar un codigo",
                            }).change((v) => {
                                self.model.cliente_id = v.target.value
                                let buscar_cliente = self.clientes.find((v) => v.id == self.model
                                    .cliente_id)
                                self.cliente = buscar_cliente
                                if (self.cl_id != v.target.value) {
                                    $('.select_cliente').val(v.target.value).trigger('change');

                                    return false
                                }
                                self.cl_id = v.target.value
                            })
                            $(".select_cajas_cerradas").select2({
                                tags: true,
                                placeholder: "Buscar",
                            }).change((v) => {
                                self.cajas_cerrada_id = v.target.value
                                let buscar_caja = self.cajas_cerrada.find((v) => v.id == self
                                    .cajas_cerrada_id)
                                self.AddDetalle(buscar_caja.lote_detalle, buscar_caja.compra,
                                    buscar_caja.cinta, buscar_caja.dias)
                                // $("#exampleModal").modal("show")
                            })
                            $('.select_cajas_cerradas').on('select2:open', function(e) {
                                // Encuentra el input de búsqueda
                                let searchField = document.querySelector('.select2-search__field');

                                // Escucha el evento 'keyup' en el input de búsqueda
                                searchField.addEventListener('keyup', function(event) {
                                    self.caja_busqueda = event.target.value
                                });
                            });
                            $(".select_pt_item").select2({
                                tags: true,
                                placeholder: "Buscar",
                            }).change((v) => {
                                self.pt_item_id = v.target.value
                                let buscar = self.pts_model.find((v) => v.id == self.pt_item_id)
                                self.AddPtItem(buscar, buscar.ptm)
                            })
                            $(".select_pp_item").select2({
                                tags: true,
                                placeholder: "Buscar",
                            }).change((v) => {
                                self.pp_item_id = v.target.value
                                let buscar = self.pps.find((v) => v.pp.id == self.pp_item_id)
                                self.AddPp(buscar)
                            })

                            document.addEventListener('keydown', (event) => {
                                self.TeclaPress(event)
                            })
                            window.addEventListener('keydown', this.preventRefresh);
                        }

                    })
                }
            }).mount('#meApp')
        </script>
    @endslot


    @slot('style')
        <style>
            #map {
                height: 280px;
            }

            .tr-hover {
                cursor: pointer;
            }

            .tr-hover:hover {
                background-color: #f2f2f2;
            }

            .tb-pos th {
                font-size: 10px !important;
                padding: 5px !important;
            }

            .tb-pos td {
                font-size: 9px !important;
                padding: 5px !important;
            }

            option.op_enabled {

                background: #28a745 !important;
                color: white !important;
            }

            option.op_disabled {

                background: #dc3545 !important;
                color: white !important;
            }

            .disabled_bg.bg-success {
                background-color: #8dbf42 !important;
                border-color: #8dbf42;
                color: #fff;
            }

            .disabled_bg.bg-danger {
                background-color: #dc3545 !important;
                border-color: #dc3545;
                color: #fff;
            }
            .form-control{
                padding: 5px !important;
            }

            .text-truncate {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            table input.form-control {
                padding: 0.25rem;
                height: 30px;
                font-size: 0.875rem;
            }

            .btn-group .btn {
                padding: 0.2rem 0.4rem;
            }

            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                width: 100%;
            }

            .table {
                min-width: 100%;
            }
        </style>
    @endslot
@endcomponent
