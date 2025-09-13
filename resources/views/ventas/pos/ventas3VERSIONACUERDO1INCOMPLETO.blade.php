@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-sm text-center align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="18" class="text-center bg-primary text-white">DETALLE VENTA</th>
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
                                                    <th>PESO NETO NVO</th>
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
                                                        <input type="text" name="" id="" readonly
                                                            :value="l.equivalente" @change="changeLote(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly
                                                            :value="l.peso_mod_bruto" @change="changeLoteM(l)" class="form-control">
                                                    </td>
                                                    <td>***</td>
                                                    <td>
                                                        <input type="text" name="" id="" readonly
                                                            :value="l.peso_mod_neto" @change="changeLoteM(l)" class="form-control">
                                                    </td>
                                                    <td>***</td>
                                                    <td>{{ l . peso_unitario_bruto }}</td>
                                                    <td>{{ l . peso_unitario_neto }}</td>
                                                    <td>{{ l . descuento_pollo_limpio }}</td>

                                                    <td>{{ Number(l . descuento_valor) . toFixed(2) }}</td>
                                                    <td>{{ Number(l . valor_precio) . toFixed(2) }}</td>
                                                    <td>{{ Number(l . total_final) . toFixed(2) }}</td>


                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="cart_lotes.splice(i,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
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
                                                    <td>PP-{{ l.pp.nro }}</td>
                                                    <td>***</td>
                                                    <td>***</td>
                                                    <td class="bg-info text-white">POLLO LIMPIO</td>
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
                                                    <td>{{ Number(l.peso_bruto_vender - l.peso_neto_vender).toFixed(2) }}</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" readonly :value="l.peso_neto_vender">
                                                    </td>
                                                    <td>{{ Number(l.peso_neto_vender2).toFixed(2) }}</td>
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
                                                        <td colspan="3">
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
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.total_peso_bruto - item.total_peso_neto"> </td>
                                                    <td> <input type="text" class="form-control" readonly
                                                            :value="item.total_peso_neto" @change="changePesoNetoItem(item)">
                                                    </td>
                                                    <td>***</td>
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
                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <td colspan="16" class="text-right"><strong>TOTAL</strong></td>
                                                    <td>{{ Number(totalAll) . toFixed(2) }}</td>
                                                    <td></td>

                                                </tr>
                                                <tr>
                                                    <td colspan="16" class="text-right"><strong>TOTAL CAJAS</strong></td>
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
                                        <div class="col-3">
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
                                        <div class="col-3">
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
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Grupo Cliente</label>
                                                <select v-model="cliente.cinta_cliente.id":value="" class="form-control">
                                                    <option value="" disabled selected>Seleccionar</option>
                                                    <option v-for="m in cintaClientes" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
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
                                                    <select v-model="chofer" class="form-control">
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
                                                    <select v-model="user" class="form-control">
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <template v-for="m in users">
                                                            <option :value="m">{{ m . nombre }}</option>
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
                                                <label>Forma de pago</label>
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
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Metodo de Pago</label>
                                                <div class="input-group">
                                                    <select class="form-control" v-model="metodo_pago">
                                                        <option value="1" >Contado</option>
                                                        <option value="2" >Credito</option>
                                                    </select>

                                                </div>
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
                                                                                :value="Number(d_pp.peso_bruto).toFixed(2)"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label for="">PESO NETO</label>
                                                                            <input type="text" class="form-control"
                                                                                :value="Number(d_pp.peso_neto).toFixed(2)"
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
                                                                    <th colspan="13" class="text-center bg-primary text-white">CAJAS CERRADAS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Lote</th>
                                                                    <th>N Compra</th>
                                                                    <th>Cinta</th>
                                                                    <th>Pigmento</th>
                                                                    <th>Cajas</th>
                                                                    <th>Pollos</th>
                                                                    <th>Peso Bruto</th>
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
                                                                    <td>
                                                                        <input type="text" name="" id=""
                                                                            v-model="l.peso_mod_neto" @change="changeLoteM(l)"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td class="text-end">{{ l . peso_unitario_bruto }}</td>
                                                                    <td class="text-end">{{ l . peso_unitario_neto }}</td>
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
                                                                        {{ Number(total_detalles . peso_bruto) . toFixed(2) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Number(total_detalles . peso_neto) . toFixed(2) }}
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
                                                                    TRANSFORMACIONES</th>

                                                            </tr>
                                                            <tr>

                                                                <th>N°</th>

                                                                <th>PRODUCTO </th>
                                                                <th>CAJAS </th>
                                                                <th>PESO </th>
                                                                <th>PRECIO </th>

                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="(m,i) in TransformacionDetalles">
                                                                <tr>
                                                                    <td>#-{{ m . tramsformacion . nro }}</td>
                                                                    <td>{{ m . subitem . name }}</td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm"
                                                                            v-model="m.total_cajas">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm"
                                                                            v-model="m.total_peso_bruto">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm"
                                                                            v-model="m.subitem.venta">
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
                                                                <th colspan="10" class="text-center bg-primary text-white">
                                                                    ITEMS PP
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>PP</th>
                                                                <th>Pollos</th>
                                                                <th>Cajas</th>
                                                                <th>P.Bruto</th>
                                                                <th>Taras</th>
                                                                <th>P. Neto</th>
                                                                <th>P. Neto U</th>
                                                                <th>Precio KG</th>
                                                                <th>Total Bs/.</th>

                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(l,i) in PpItemsModel">
                                                                <td>PP-{{ l . pp . nro }}</td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.pollos_vender" @change="ChangePollosPp(l)">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.cajas_vender" @change="ChangeCajasPp(l)">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.peso_bruto_vender">
                                                                </td>
                                                                <td>{{ Number(l . peso_bruto_vender - l . peso_neto_vender) . toFixed(2) }}
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        v-model="l.peso_neto_vender">
                                                                </td>
                                                                <td>{{ Number(l . peso_neto_unit) . toFixed(2) }}</td>
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
                                                                    <input type="text" v-model="peso_acuerdo"
                                                                        class="form-control" style="width:70px">
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

                                        <div class="col-12 mt-2" v-if="venta_items.length">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">

                                                     <div class="table-responsive">
                                                        <table class="table table-bordered table-sm text-center align-middle mb-0">

                                                        <thead>
                                                            <tr>
                                                                <th colspan="8" class="text-center bg-primary text-white">
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
                                                                <td>{{ Number(item . item . venta * item . peso_neto_vender) . toFixed(2) }}
                                                                </td>
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
                                            <button @click="Vender()"
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
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>Nro Compra</th>
                                                    <th>Lote</th>
                                                    <template v-for="m in listaCintasCajaCerrada">
                                                        <th>{{ m }}</th>
                                                    </template>

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


                                                        </tr>

                                                    </template>




                                                </tbody>

                                            </table>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="widget-content widget-content-area br-6">
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

                                                                <th>
                                                                    KG
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="ptm in pts">
                                                                <template v-for="item in ptm.items">
                                                                    <tr v-if="item.cajas>0" @click="AddPtItem(item,ptm)"
                                                                        class="tr-hover">
                                                                        <td>PT-{{ ptm . nro }}</td>
                                                                        <td>{{ item . item . name }}</td>

                                                                        <td>{{ Number(item . peso_bruto) . toFixed(2) }} KG</td>
                                                                    </tr>
                                                                </template>
                                                            </template>


                                                    </table>
                                                </div>
                                                <div class="col-12 px-0" v-if="pp.hasOwnProperty('pp')">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    N°
                                                                </th>
                                                                <th>
                                                                    PRODUCTO
                                                                </th>
                                                                <th>
                                                                    SALDO
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="m in pps">
                                                                <tr @click="AddPp(m)" class="tr-hover">
                                                                    <td>PP-{{ m . pp . nro }}</td>
                                                                    <td>{{ m . pollos }} POLLOS ENTEROS</td>
                                                                    <td>{{ Number(m . peso_neto) . toFixed(2) }} KG</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" class="p-0">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        GRUPO
                                                                                    </th>
                                                                                    <th>
                                                                                        SAL
                                                                                    </th>
                                                                                    <th>
                                                                                        DIS
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <tr class="bg-light-primary"
                                                                                    v-for="g in m.pp.pp_traspaso_pp_cinta_list">
                                                                                    <td class="font-weight-bold text-primary">
                                                                                        {{ g . cinta_cliente . name }}</td>
                                                                                    <td class="font-weight-bold text-primary">-
                                                                                    </td>
                                                                                    <td class="font-weight-bold text-primary">-
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </template>
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
                                                                    TRANSFORMACIONES
                                                                </th>
                                                                <th>
                                                                    CAJAS
                                                                </th>
                                                                <th>
                                                                    PESO
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="m in transformacions">
                                                                <tr class="tr-hover"
                                                                    v-for="item in m.lista_subitems_transformacion"
                                                                    @click="AddTransformacion(item,m)">
                                                                    <td>#-{{ m . nro }}</td>
                                                                    <td>{{ item . subitem . name }}</td>
                                                                    <td>{{ item . total_cajas }}</td>
                                                                    <td>{{ item . total_peso_bruto }}</td>

                                                                </tr>

                                                            </template>
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
                        item_id: 1,
                        acuerdos: [],
                        acuerdo: {},
                        gastos: [{
                            detalle: '',
                            valor: 0
                        }],
                        peso_acuerdo: 0,
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
                    }
                },
                computed: {
                    GastosModel() {
                        return this.cart_gastos_model.map((i) => {
                            return i
                        })
                    },
                    CartPtsModel() {
                        return this.cart_pts.map((i) => {
                            i.total = i.item.venta * i.peso_neto_vender

                            i.total_final = i.total + i.descuento_total

                            return i
                        })
                    },
                    CartTransformacions() {
                        return this.transformacion_cart.map((i) => {

                            i.total_final = i.total_peso_bruto * i.subitem.venta
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
                                b.peso_total - b.cajas * 2) : 0), 0)
                            l.peso_bruto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ?
                                (b.peso_total) : 0), 0)

                            return l

                        })
                    },
                    total_detalles() {
                        let cajas = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.equivalente), 0)
                        let peso_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
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
                            .detalle_venta_pp_peso_bruto).toFixed(2)
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
                        let self = this
                        let id = 1
                        let model = this.model_detalles.map((compra) => {
                            compra.cintas = [...this.lista_cintas]
                            let cintas_cajas = compra.cintas.map((cinta) => {
                                let lote_detalles = compra.lote_detalles.filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP'
                                    return detalle.producto + '/' + pigmento == cinta
                                })

                                let cajas_envio = [...self.detalle_vente_lotes].filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP'
                                    return detalle.producto + '/' + pigmento == cinta && detalle
                                        .compra_id == compra.id
                                })
                                // let envios = 0
                                let envios = cajas_envio.reduce((a, b) => a + Number(b.cajas), 0)
                                lote_detalles = lote_detalles.sort((a, b) => {
                                    return b.peso_total - a.peso_total;
                                })
                                if (lote_detalles.length > 0) {

                                    let lote_detalle = {
                                        ...lote_detalles[0]
                                    }
                                    lote_detalle.cajas = lote_detalles.reduce((a, b) => a + b.cajas, 0)
                                    lote_detalle.total_pollos = lote_detalles.reduce((a, b) => a + b
                                        .equivalente, 0)
                                    lote_detalle.total_peso = lote_detalles.reduce((a, b) => a + b
                                        .peso_total, 0)
                                    lote_detalle.promedio = lote_detalle.total_peso / (lote_detalle
                                        .total_pollos <= 0 ? 1 : lote_detalle.total_pollos)

                                    let detalle = {

                                        lote_detalles,
                                        compra: compra.compra,
                                        cinta,
                                        dias: compra.dias,
                                        lote_detalle,
                                        envios: envios
                                    }
                                    return detalle
                                } else {
                                    let detalle = {

                                        cinta,
                                        compra: compra.compra,
                                        dias: compra.dias,
                                        envios: envios,
                                        lote_detalle: {
                                            cajas: 0,
                                            promedio: 0,
                                            envios: []
                                        },

                                    }
                                    return detalle
                                }

                            })
                            compra.cinta_cajas = cintas_cajas.map((c) => {
                                c.id = id


                                id = id + 1
                                return c
                            });

                            compra.total_envios = cintas_cajas.reduce((a, b) => a + b.envios, 0)
                            compra.total_cajas = cintas_cajas.reduce((a, b) => a + b.lote_detalle.cajas, 0) -
                                compra.total_envios
                            compra.cerrar = compra.total_cajas == 0 ? true : false
                            return compra
                        })
                        return model
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
                    PpItemsModel() {
                        return this.detalle_venta_pp.map((d) => {
                            let cantidadPollos = Number(d.pollos_vender) || 0
                            d.precio_acuerdo = this.getPrecioPolloLimpioPorCantidad(cantidadPollos)
                            d.total = Number(d.peso_neto_vender * d.precio_acuerdo)
                            return d
                        })
                    },
                    TransformacionDetalles() {
                        return this.transformacions_list
                    },

ModelAcuerdo() {
    let acuerdo = this.acuerdo;
    if (acuerdo.hasOwnProperty('id')) {
        let pollos = this.PpItemsModel.reduce((a, b) => a + b.pollos_vender, 0);
        let total = this.PpItemsModel.reduce((a, b) => a + b.total, 0);
        let descuento = 0;

        if (acuerdo.peso > 0) {
            this.peso_acuerdo = (pollos * acuerdo.peso).toFixed(2);
            descuento = (this.peso_acuerdo * acuerdo.cantidad).toFixed(2);
        } else {
            descuento = (this.peso_acuerdo * acuerdo.cantidad).toFixed(2);
        }

        // Asegúrate de restar el descuento del total original
        let totalConDescuento = (total - descuento).toFixed(2);

        return {
            kg: Number(this.peso_acuerdo),
            cantidad: acuerdo.cantidad,
            t_des: Number(descuento),
            total: Number(totalConDescuento)
        };
    }

    return {
        kg: 0,
        cantidad: 0,
        t_des: 0,
        total: this.PpItemsModel.reduce((a, b) => a + b.total, 0)
    };
},


                    DetalleVentaLotes() {
                        return this.detalle_vente_lotes.map((d) => {
                            d.valor_precio = d.precio_detalle_lote
                            d.total = Number(d.peso_mod_neto * d.valor_precio)
                            return d
                        })
                    },
                    totalGastos() {
                        return this.gastos.reduce((a, b) => a + b.valor, 0)
                    },
                    listaCintasCajaCerrada() {
                        return this.lista_cintas.filter((b) => b.toLowerCase().indexOf(this.caja_busqueda) != -1).slice(
                            0, 1)
                    },
                    cajaCerradaFiltro() {
                        return this.model_cintas.map((c) => {
                            c.filtro_cintas = c.cintas.filter((b) => b.toLowerCase().indexOf(this
                                .caja_busqueda) != -1).slice(0, 1)
                            c.filtro_cintas_cajas = c.cinta_cajas.filter((b) => b.cinta.toLowerCase().indexOf(
                                this.caja_busqueda) != -1).slice(0, 1)
                            return c
                        })
                    },
                    totalAll() {
                        let total_detalle_venta_lotes = this.cart_lotes.reduce((a, b) => a + b.total_final, 0)
                        let total_venta_pps = this.cart_pps.reduce((a, b) => a + b.total, 0)
                        let total_vente_pts = this.cart_pts.reduce((a, b) => a + Number(b.total_final), 0)
                        let total_vente_gastos = this.GastosModel.reduce((a, b) => a + Number(b.valor), 0)
                        return total_detalle_venta_lotes + total_venta_pps + total_vente_pts - total_vente_gastos
                    },
                    itemSucursal() {
                        return this.pollo_sucursal.items
                    },
                    totalCajas(){
                        let caja_lotes = this.cart_lotes.reduce((a,b)=>a+Number(b.cajas),0)
                        let caja_pts = this.cart_pts.reduce((a,b)=>a+Number(b.cajas_vender),0)
                        let caja_pps = this.cart_pps.reduce((a,b)=>a+Number(b.cajas_vender),0)
                        return caja_lotes+caja_pts+caja_pps
                    }
                },
                methods: {
                    getPrecioPolloLimpioPorCantidad(cantidadPollos) {
                        let producto = this.productos_precios.find(p => p.id === 9)
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
                    },

                    // addVentaPpCarrito(d, i) {
                    //     let item = {
                    //         ...d
                    //     }

                    //     this.cart_pps.push(item)
                    //     this.detalle_venta_pp.splice(i, 1)
                    // },
                    addVentaPpCarrito(l, i) {
                        let item = JSON.parse(JSON.stringify(l));
                        let selectedItem = this.items.find(it => it.id == this.item_id);

                        item.subdetalle = {
                            acuerdo: this.acuerdo,
                            item_id: this.item_id,
                            item_nombre: selectedItem ? selectedItem.name : '',
                            peso: this.peso_acuerdo,
                            cantidad: this.ModelAcuerdo.cantidad,
                            descuento_valor: this.ModelAcuerdo.t_des,
                            total_con_descuento: this.ModelAcuerdo.total,
                            total_sin_descuento: item.total,
                            precio_acuerdo: item.precio_acuerdo,
                            peso_neto_vender: item.peso_neto_vender,
                            peso_neto_vender2: item.peso_neto_vender2,
                            pollos_vender: item.pollos_vender,
                            cajas_vender: item.cajas_vender,
                        };

                        if (this.acuerdo.peso > 0) {
                            let totalPollos = Number(item.pollos_vender) || 0;
                            let pesoAcuerdo = Number(this.acuerdo.peso) || 0;
                            item.peso_neto_vender2 = (Number(item.peso_neto_vender) + (totalPollos * pesoAcuerdo)).toFixed(2);
                        }
                        item.total = (Number(item.peso_neto_vender2) * Number(item.precio_acuerdo)).toFixed(2);

                        this.cart_pps.push(item);
                        this.detalle_venta_pp.splice(i, 1);
                    },

                    addTransformacionCarrito(d, i) {
                        let item = {
                            ...d
                        }

                        this.transformacion_cart.push(item)
                        this.transformacions_list.splice(i, 1)
                    },
                    addVentaPtCarrito(d, i) {
                        let precio_buscar = this.itemSucursal.filter((b) => b.id == d.item.id)
                        let item = {
                            ...d
                        }
                        let precio_venta = item.item.venta
                        if (precio_buscar.length > 0) {
                            item.item.venta = precio_buscar[0].precio

                        }
                        let descuento_filter = this.ClientePts.filter((b) => b.item.id == d.item.id)
                        item.descuento_valor = 0
                        if (descuento_filter.length > 0) {
                            item.descuento_valor = descuento_filter[0].valor
                        }
                        item.descuento_total = Number(item.peso_neto_vender) * Number(item.descuento_valor)
                        this.cart_pts.push(item)
                        this.venta_items.splice(i, 1)

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
                        pp_detalle.item = {
                            ...this.ItemSelect
                        };
                        this.detalle_venta_pp.push(pp_detalle);
                        this.venta_pps = [];
                    },

                    AddPtItem(d, pt) {
                        let pt_detalle = {
                            ...d
                        }
                        pt_detalle.pt_id = pt.id
                        pt_detalle.nro = pt.nro
                        pt_detalle.peso_bruto_x_caja = Number(pt_detalle.peso_bruto / pt_detalle.cajas).toFixed(2)
                        pt_detalle.peso_neto_x_caja = Number(pt_detalle.peso_neto / pt_detalle.cajas).toFixed(2)
                        pt_detalle.cajas_vender = 1
                        pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
                        pt_detalle.peso_neto_vender = pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender
                        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender

                        this.venta_items.push(pt_detalle)
                    },
                    changeCajasItem(pt_detalle) {

                        let cajas = pt_detalle.cajas_vender * 2
                        pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
                        pt_detalle.peso_neto_vender = pt_detalle.peso_bruto_x_caja - cajas
                        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },
                    changePesoBrutoItem(pt_detalle) {
                        let cajas = pt_detalle.cajas_vender * 2
                        pt_detalle.peso_neto_vender = pt_detalle.peso_bruto_vender - cajas
                        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },
                    changePesoNetoItem(pt_detalle) {
                        let cajas = pt_detalle.cajas_vender * 2
                        pt_detalle.peso_neto_vender = pt_detalle.peso_bruto_vender - cajas
                        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
                    },
                    bandera(d) {
                        let b = this.banderas.find(b => d.dias >= b.min && d.dias <= b.max)
                        if (b) {
                            return b.name
                        }
                        return ''
                    },
                    changeCajas(d) {
                        d.equivalente = Math.round(Number(d.cajas * d.pollos))
                        let cajas = d.cajas * 2
                        //  alert(cajas)
                        let producto_precio = d.producto_precio
                        let total_pollos = d.equivalente

                        if (total_pollos > 1 && total_pollos <= 14) {
                            d.precio_detalle_lote = producto_precio.venta_1
                        }
                        if (total_pollos > 14 && total_pollos <= 75) {
                            d.precio_detalle_lote = producto_precio.venta_2
                        }
                        if (total_pollos > 75 && total_pollos <= 150) {
                            d.precio_detalle_lote = producto_precio.venta_3
                        }
                        if (total_pollos > 150) {
                            d.precio_detalle_lote = producto_precio.venta_4
                        }
                        if (this.tipo_pollo_limpia == 5) {
                            d.precio_detalle_lote = producto_precio.venta_5
                        }
                        if (this.tipo_pollo_limpia == 6) {
                            d.precio_detalle_lote = producto_precio.venta_6
                        }
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
                        d.peso_actual_neto = Number(d.peso_actual_bruto - cajas).toFixed(2)
                        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
                    },
                    changeLote(d) {
                        let producto_precio = d.producto_precio
                        let cajas = d.cajas * 2
                        let total_pollos = d.equivalente

                        if (total_pollos > 1 && total_pollos <= 14) {
                            d.precio_detalle_lote = producto_precio.venta_1
                        }
                        if (total_pollos > 14 && total_pollos <= 75) {
                            d.precio_detalle_lote = producto_precio.venta_2
                        }
                        if (total_pollos > 75 && total_pollos <= 150) {
                            d.precio_detalle_lote = producto_precio.venta_3
                        }
                        if (total_pollos > 150) {
                            d.precio_detalle_lote = producto_precio.venta_4
                        }
                        if (this.tipo_pollo_limpia == 5) {
                            d.precio_detalle_lote = producto_precio.venta_5
                        }
                        if (this.tipo_pollo_limpia == 6) {
                            d.precio_detalle_lote = producto_precio.venta_6
                        }
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
                        d.peso_actual_neto = Number(d.peso_actual_bruto - cajas).toFixed(2)
                        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
                    },
                    changeLoteM(d) {

                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
                    },
                    AddDetalle(i, compra, cinta, dias) {
                        console.log(i)

                            let producto = i.producto
                            let buscar_precio = this.productos_precios.filter(p => p.name == producto)
                            if (buscar_precio.length > 0) {
                                let precio = buscar_precio[0]
                                let total_pollos = i.total_pollos

                                if (total_pollos > 1 && total_pollos <= 14) {
                                    i.precio_detalle_lote = precio.venta_1
                                }
                                if (total_pollos > 14 && total_pollos <= 75) {
                                    i.precio_detalle_lote = precio.venta_2
                                }
                                if (total_pollos > 75 && total_pollos <= 150) {
                                    i.precio_detalle_lote = precio.venta_3
                                }
                                if (total_pollos > 150) {
                                    i.precio_detalle_lote = precio.venta_4
                                }
                                if (i.tipo_pollo_limpia == 5) {
                                    i.precio_detalle_lote = precio.venta_5
                                }
                                if (i.tipo_pollo_limpia == 6) {
                                    i.precio_detalle_lote = precio.venta_6
                                }
                                // if(this.tipo_pollo_limpia==1){
                                //     this.precio_detalle_lote=precio.venta_1
                                // }
                                // if(this.tipo_pollo_limpia==2){
                                //     this.precio_detalle_lote=precio.venta_2
                                // }
                                // if(this.tipo_pollo_limpia==3){
                                //     this.precio_detalle_lote=precio.venta_3
                                // }
                                // if(this.tipo_pollo_limpia==4){
                                //     this.precio_detalle_lote=precio.venta_4
                                // }
                                // if(this.tipo_pollo_limpia==5){
                                //     this.precio_detalle_lote=precio.venta_5
                                // }
                                // if(this.tipo_pollo_limpia==6){
                                //     this.precio_detalle_lote=precio.venta_6
                                // }
                            }
                            let item = {
                                ...i
                            }
                            item.compra = {
                                ...compra
                            }
                            item.producto_precio = buscar_precio[0]
                            item.peso_unitario_bruto = Number(item.peso_total / item.equivalente).toFixed(2)
                            item.peso_neto = Number(item.peso_total - item.cajas * 2).toFixed(2)
                            item.peso_unitario_neto = Number(item.peso_neto / item.equivalente).toFixed(2)
                            item.peso_actual_bruto = Number(item.equivalente * item.peso_unitario_bruto).toFixed(2)
                            item.peso_actual_neto = Number(item.equivalente * item.peso_unitario_neto).toFixed(2)
                            item.peso_mod_bruto = Number(item.peso_actual_bruto).toFixed(2)
                            item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(2)
                            item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(2)
                            item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(2)
                            item.cinta = cinta
                            item.dias = dias
                            item.valor_precio = this.precio_detalle_lote

                            this.detalle_vente_lotes.push(item)


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
                        }.bruto).toFixed(2)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.neto).toFixed(2)


                    },
                    CambioPesoMerma() {
                        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.bruto).toFixed(2)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) -
                        {
                            ...this.envio
                        }.neto).toFixed(2)


                    },
                    async FinalizarLote(id) {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/lotes-finalizar') }}/" + id;
                            let res = await axios.post(url, {
                                id
                            })

                            await this.load()

                        } catch (e) {

                        }
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

                            block.block()
                            let self = this
                            try {
                                let data = {
                                    sucursal_id: self.sucursal.id,
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
                                    user_id: this.user.id,
                                    hora_entrega: this.hora_entrega,
                                    forma_pago_id: this.formapago.id,
                                    forma_pedido_id: this.forma_pedido.id,
                                    metodo_pago: this.metodo_pago,
                                    observacion: this.entrega.observacion,
                                    total:this.totalAll,
                                    total_cajas: this.totalCajas
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
                                self.transformacion_cart
                                self.cart_pts = []
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
                                window.open(res.data.url_pdfTicket, '_blank');
                                window.open(res.data.url_pdf, '_blank');

                                await this.load()
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
                        let cajas = Number(item.cajas_vender)

                        let pollos_x_caja = Number(item.pollos_x_caja)
                        item.pollos_vender = Math.round(cajas * pollos_x_caja)
                        item.peso_bruto_vender = Number(item.pollos_vender * item.peso_bruto_unit).toFixed(2)
                        item.peso_neto_vender = Number(item.pollos_vender * item.peso_neto_unit).toFixed(2)

                    },
                    ChangePollosPp(item) {

                        let pollos_vender = Number(item.pollos_vender)
                        item.peso_bruto_vender = Number(pollos_vender * item.peso_bruto_unit).toFixed(2)
                        item.peso_neto_vender = Number(pollos_vender * item.peso_neto_unit).toFixed(2)

                    },
                    AddPp(m) {

                        let pp = {
                            ...m
                        }
                        let pollos_x_caja = Number(pp.pollos) / Number(pp.cajas)
                        pp.cajas_vender = pp.cajas
                        pp.peso_bruto_vender = Number(pp.peso_bruto).toFixed(2)
                        pp.peso_neto_vender = Number(pp.peso_neto).toFixed(2)
                        pp.pollos_vender = pp.pollos
                        pp.pollos_x_caja = pollos_x_caja
                        pp.peso_bruto_unit = Number(pp.peso_bruto) / Number(pp.pollos)
                        pp.peso_neto_unit = Number(pp.peso_neto) / Number(pp.pollos)
                        pp.sobra = false
                        pp.sobra_descripcion = ''
                        pp.sobra_peso = 0
                        // if (this.venta_pps.length == 0) {
                        //   this.venta_pps.push(pp)
                        // }
                        this.AddPpDetalle(pp)
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
                                    self.GET_DATA("formaPedidos")

                                ]).then((v) => {
                                    self.pps = v[0]
                                    self.lotes = v[1]
                                    self.banderas = v[2]
                                    self.clientes = v[3]
                                    self.chofers = v[4]
                                    self.formapagos = v[5]

                                    let items = v[6]
                                    self.items = items.filter((v) => v.tipo == 1)
                                    self.pts = v[7]
                                    self.productos_precios = v[8]
                                    self.cintaClientes = v[9]
                                    self.acuerdos = v[10]
                                    self.pollo_sucursal = v[11]
                                    self.transformacions = v[12]
                                    self.users = v[13]
                                    self.forma_pedidos = v[14]

                                    if (self.forma_pedidos.length > 0) {
                                        self.forma_pedido = self.forma_pedidos[0]
                                    }
                                    if (self.formapagos.length > 0) {
                                        self.formapago = self.formapagos[0]
                                    }
                                })

                            } catch (e) {

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
                    AddTransformacion(item, m) {
                        item.tramsformacion = {
                            id: m.id,
                            nro: m.nro
                        }
                        this.transformacions_list.push(item)
                    }
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
                                    self.acuerdo = self.cliente.acuerdo_cliente;

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
        </style>
    @endslot
@endcomponent
