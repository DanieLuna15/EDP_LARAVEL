@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card bg-light-primary">
                            <div class="card-body">
                                <div class="row widget-content widget-content-area border-tab px-2 bg-light-warning">
                                    <div class="col-12">
                                        <h3>
                                            PP N° {{ model . nro }} de {{ model . mes }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="alert alert-success" v-if="traspasos.length>0">
                                    <div>
                                        <strong>Info!</strong> En el siguiente recuadro se muestran los traspasos disponibles para
                                        aceptar.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 layout-spacing">
                                <div class="statbox widget box box-shadow" v-if="traspasos.length>0">
                                    <div class="widget-content widget-content-area border-tab px-2">
                                        <div class="d-flex justify-content-between">
                                            <h4>Traspasos disponibles</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th>PP N°</th>
                                                        <th>Grupo</th>
                                                        <th>Cajas</th>
                                                        <th>Pigmento</th>
                                                        <th>Pollos</th>
                                                        <th>Peso Bruto</th>
                                                        <th>Peso Neto</th>
                                                        <th>Peso Bruto U</th>
                                                        <th>Peso Neto U</th>
                                                        <th style="display:none">Merma Bruta </th>
                                                        <th style="display:none">Merma Neta </th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                        <template v-for="m in traspasos">
                                                            <tr v-if="m.tipo == 1 && m.pp.id !== model . id">
                                                                <td>{{ m . pp . nro }}</td>
                                                                <td>{{ m . cinta_cliente . name }}</td>
                                                                <td>{{ m . cajas }}</td>
                                                                <td>{{ m . pigmento == 1 ? 'CON PIGMENTO' : 'SIN PIGMENTO' }}</td>
                                                                <td>{{ m . pollos }}</td>
                                                                <td>{{ m . peso_bruto }}</td>
                                                                <td>{{ m . peso_neto }}</td>
                                                                <td>{{ Number(m . peso_bruto / m . pollos) . toFixed(3) }}</td>
                                                                <td>{{ Number(m . peso_neto / m . pollos) . toFixed(3) }}</td>
                                                                <td style="display:none">{{ Number(m . merma_bruta) . toFixed(3) }}
                                                                </td>
                                                                <td style="display:none">{{ Number(m . merma_neta) . toFixed(3) }}
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-success w-100 mt-2"
                                                                        @click="traspasoAceptar(m)">
                                                                        ACEPTAR
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="alert alert-info" v-if="model.pp_traspaso_pp_cinta_list.length>0">
                                    <div>
                                        <strong>Info!</strong> En el siguiente recuadro se muestran los traspasos recepcionados de
                                        un lote anterior PP.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 layout-spacing" v-if="AllTraspasos.length">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab">
                                        <div class="d-flex justify-content-between">
                                            <h4>Traspasos Aceptados</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <th>Grupo</th>
                                                        <th>PP N°</th>
                                                        <th>Cajas</th>
                                                        <th>Pollos</th>
                                                        <th>Peso Bruto</th>
                                                        <th>Peso Neto</th>
                                                        <th style="display:none">Merma Bruta</th>
                                                        <th style="display:none">Merma Neta</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="r in AllTraspasos" :key="r._key">
                                                            <td>{{ r . cliente }}</td>
                                                            <td>{{ r . pp_nro }}</td>
                                                            <td>{{ r . cajas }}</td>
                                                            <td>{{ r . pollos }}</td>
                                                            <td>{{ r . peso_bruto . toFixed(3) }}</td>
                                                            <td>{{ r . peso_neto . toFixed(3) }}</td>
                                                            <td style="display:none">{{ r . merma_bruta . toFixed(3) }}</td>
                                                            <td style="display:none">{{ r . merma_neta . toFixed(3) }}</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="bg-dark text-white">
                                                            <td colspan="2">TOTALES</td>
                                                            <td>{{ TotalesTabla . suma_cajas }}</td>
                                                            <td>{{ TotalesTabla . suma_pollos }}</td>
                                                            <td>{{ TotalesTabla . suma_peso_bruto }}</td>
                                                            <td>{{ TotalesTabla . suma_peso_neto }}</td>
                                                            <td style="display:none">{{ TotalesTabla . suma_merma_bruta }}</td>
                                                            <td style="display:none">{{ TotalesTabla . suma_merma_neta }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 col-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>DETALLE</th>
                                                <th class="text-center">Cajas</th>
                                                <th class="text-center">Pollos</th>
                                                <th class="text-center">Peso Bruto</th>
                                                <th class="text-center">Peso Neto</th>
                                                <th class="text-center">Peso Bruto U</th>
                                                <th class="text-center">Peso Neto U</th>
                                                <th style="display:none">Merma Bruta </th>
                                                <th style="display:none">Merma Neta </th>
                                                <th class="text-center">Grupo</th>
                                                <th class="text-center">Pigmento</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-primary fw-bold">TOTALES DISPONIBLES</td>
                                                    <td class="text-center">{{ Number(total_detalle . cajas) }}</td>
                                                    <td class="text-center">{{ Number(total_detalle . pollos) }}</td>
                                                    <td class="text-center">{{ Number(total_detalle . bruto) . toFixed(3) }}</td>
                                                    <td class="text-center">{{ Number(total_detalle . neto) . toFixed(3) }}</td>
                                                    <td class="text-center">
                                                        {{ total_detalle . pollos ? Number(total_detalle . bruto / total_detalle . pollos) . toFixed(3) : 0.0 }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ total_detalle . pollos ? Number(total_detalle . neto / total_detalle . pollos) . toFixed(3) : 0.0 }}
                                                    </td>
                                                    <td class="text-center" style="display:none">
                                                        {{ Number(total_detalle . merma_bruta) . toFixed(3) }}</td>
                                                    <td class="text-center" style="display:none">
                                                        {{ Number(total_detalle . merma_neta) . toFixed(3) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="13" class="text-center">
                                                        <button class="btn btn-success w-100" @click="AddItemEnviar">
                                                            AGREGAR ITEM
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr v-for="(m,i) in envio_items">
                                                    <td class="text-primary fw-bold">{{ i + 1 }}</td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm" v-model="m.cajas"
                                                            @change="envioCaja(m)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model="m.pollos" @change="envioPollo(m)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model="m.peso_bruto" @change="envioMerma(m)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model="m.peso_neto" @change="envioMerma(m)">
                                                    </td>
                                                    <td>
                                                        {{ Number(m . pb_unit) . toFixed(3) }}
                                                    </td>
                                                    <td>
                                                        {{ Number(m . pn_unit) . toFixed(3) }}
                                                    </td>
                                                    <td style="display: none">
                                                        {{ Number(m . merma_bruto) . toFixed(3) }}
                                                    </td>
                                                    <td style="display: none">
                                                        {{ Number(m . merma_neto) . toFixed(3) }}
                                                    </td>
                                                    <td>
                                                        <select name="" id="" class="form-control"
                                                            v-model="m.cinta_cliente">
                                                            <template v-for="m in cintaClientes">
                                                                <option :value="m.id">{{ m . name }}</option>
                                                            </template>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="" id="" class="form-control"
                                                            v-model="m.cinta_pigmento">
                                                            <option value="1">Pigmento</option>
                                                            <option value="0">Sin Pigmento</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger"
                                                            @click="envio_items.splice(i,1)">Eliminar</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot v-if="envio_items.length>0">
                                                <tr class="bg-primary text-white">
                                                    <td class="text-right">TOTALES</td>
                                                    <td class="text-center">{{ TotalesGruposItems . suma_cajas }}</td>
                                                    <td class="text-center">{{ TotalesGruposItems . suma_pollos }}</td>
                                                    <td class="text-center">{{ TotalesGruposItems . suma_peso_bruto }}</td>
                                                    <td class="text-center">{{ TotalesGruposItems . suma_peso_neto }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="display: none"></td>
                                                    <td style="display: none"></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="col-12 d-flex my-2">
                                            <button class="btn btn-success w-100 mt-2" @click="traspaso(1)" style="display: none"
                                                :disabled="envio_items.length == 0">
                                                TRASPASAR A PP
                                            </button>
                                            <button class="btn btn-info w-100 mt-2" @click="traspaso(3)"
                                                :disabled="envio_items.length == 0">
                                                DESPLEGAR PP
                                            </button>
                                            <button class="btn btn-secondary w-100 mt-2" @click="traspaso(2)" style="display: none"
                                                :disabled="envio_items.length == 0">
                                                ENVIAR A PT
                                            </button>
                                            <button class="btn btn-warning w-100 mt-2" @click="EnviarTransformacion()"
                                                style="display: none" :disabled="envio_items.length == 0">
                                                ENVIAR A TRANSF.
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="alert alert-success" v-if="model.pp_list_desplegue_cinta.length>0">
                                    <div>
                                        <strong>Info!</strong> En el siguiente apartado se muestran los saldos (despliegues +
                                        trapasos) de grupos
                                        disponibles para la venta.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12 layout-spacing" v-for="(m, index) in model.pp_list_desplegue_cinta">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab px-2 bg-light-warning">
                                        <div class="d-flex justify-content-between">
                                            <h4>SALDO TOTAL GRUPO: <strong>{{ m . cinta_cliente . name }}</strong> </h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <th>Detalle</th>
                                                        <th>Cajas</th>
                                                        <th>Pollos</th>
                                                        <th>Peso Bruto</th>
                                                        <th>Peso Neto</th>
                                                        <th>Peso Bruto U</th>
                                                        <th>Peso Neto U</th>
                                                        <th style="display: none">Merma Bruta</th>
                                                        <th style="display: none">Merma Neto</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>TOTAL DISPONIBLE</td>
                                                            <td>{{ m . totales . cajas }}</td>
                                                            <td>{{ m . totales . pollos }}</td>
                                                            <td>{{ m . totales . peso_bruto . toFixed(3) }}</td>
                                                            <td>{{ m . totales . peso_neto . toFixed(3) }}</td>
                                                            <td>{{ m . totales . pollos ? Number(m . totales . peso_bruto / m . totales . pollos) . toFixed(3) : 0.0 }}
                                                            </td>
                                                            <td>{{ m . totales . pollos ? Number(m . totales . peso_neto / m . totales . pollos) . toFixed(3) : 0.0 }}
                                                            </td>
                                                            <td style="display: none">{{ m . totales . merma_bruta . toFixed(3) }}</td>
                                                            <td style="display: none">{{ m . totales . merma_neta . toFixed(3) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="13" class="text-center">
                                                                <button class="btn btn-primary w-100"
                                                                    @click="AddItemDespliegue(index)">
                                                                    AGREGAR ITEM
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr v-for="(item, i) in m.despliegue_items" :key="i">
                                                            <td class="text-primary fw-bold">{{ i + 1 }}</td>
                                                            <td class="text-primary">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    v-model="item.cajas"
                                                                    @change="envioCajaDespliegue(item, index)">
                                                            </td>
                                                            <td class="text-primary">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    v-model="item.pollos"
                                                                    @change="envioPolloDespliegue(item, index)">
                                                            </td>
                                                            <td class="text-primary">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    v-model="item.peso_bruto"
                                                                    @change="envioMermaDespliegue(item, index)">
                                                            </td>
                                                            <td class="text-primary">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    v-model="item.peso_neto"
                                                                    @change="envioMermaDespliegue(item, index)">
                                                            </td>
                                                            <td>{{ Number(item . pb_unit) . toFixed(3) }}</td>
                                                            <td>{{ Number(item . pn_unit) . toFixed(3) }}</td>
                                                            <td style="display: none">
                                                                {{ Number(item . merma_bruto) . toFixed(3) }}
                                                            </td>
                                                            <td style="display: none">{{ Number(item . merma_neto) . toFixed(3) }}
                                                            </td>
                                                            <td>
                                                                <select class="form-control" v-model.number="item.cinta_cliente"
                                                                    :disabled="true">
                                                                    <option v-for="c in cintaClientes" :key="c.id"
                                                                        :value="c.id">{{ c . name }}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="" id="" class="form-control"
                                                                    v-model="item.cinta_pigmento">
                                                                    <option value="1">Pigmento</option>
                                                                    <option value="0">Sin Pigmento</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger"
                                                                    @click="eliminarDespliegueItem(index, i)">Eliminar</button>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                    <tfoot v-if="m.despliegue_items && m.despliegue_items.length > 0">
                                                        <tr class="bg-dark text-white">
                                                            <td class="text-right">TOTALES</td>
                                                            <td class="text-center">
                                                                {{ TotalesDespliegueItems(index) . suma_cajas }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ TotalesDespliegueItems(index) . suma_pollos }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ TotalesDespliegueItems(index) . suma_peso_bruto }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ TotalesDespliegueItems(index) . suma_peso_neto }}
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="col-12 d-flex my-2">
                                                    <button class="btn btn-success w-100 mt-2"
                                                        @click="traspasoDespliegue(1, index)"
                                                        :disabled="m.despliegue_items.length == 0">
                                                        TRASPASAR A PP
                                                    </button>
                                                    <button class="btn btn-secondary w-100 mt-2"
                                                        @click="traspasoDespliegue(2, index)"
                                                        :disabled="m.despliegue_items.length == 0">
                                                        ENVIAR A PT
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="">Items </label>
                                <div class="alert alert-info">
                                    <div>
                                        <strong>Advertencia!</strong> Los items que seleccione se enviaran a PT como sobrante de
                                        este lote PP.
                                    </div>
                                </div>
                                <select class="form-control  basic">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option v-for="item in items" :value="item.id">{{ item . name }}</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn btn-success w-100" @click="AddItem">Agregar Item</button>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>ITEM</th>
                                                <th>CAJAS</th>
                                                <th>PESO BRUTO</th>
                                                <th>TARA</th>
                                                <th>PESO NETO</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,i) in items_sobra">
                                                    <td class="text-primary">{{ item . name }}</td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model.number="item.cajas" @change="sobraCaja(item)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model.number="item.peso_bruto" @change="sobraBruto(item)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model.number="item.taras" @change="sobraNeto(item)">
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" class="form-control form-control-sm"
                                                            v-model="item.peso_neto">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger"
                                                            @click="items_sobra.splice(i,1)">Eliminar</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot v-if="items_sobra.length>0">
                                                <tr class="bg-primary text-white">
                                                    <td class="text-right">TOTALES</td>
                                                    <td class="text-center">{{ TotalesItemsSobra . suma_cajas }}</td>
                                                    <td class="text-center">{{ TotalesItemsSobra . suma_peso_bruto }}</td>
                                                    <td class="text-center">{{ TotalesItemsSobra . suma_taras }}</td>
                                                    <td class="text-center">{{ TotalesItemsSobra . suma_peso_neto }}</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="row" v-if="model.curso==1">
                                            <div class="col-6">
                                                <button class="btn btn-success w-100 mt-2" @click="EnviarPP"
                                                    :disabled="items_sobra.length == 0">
                                                    ENVIAR A PT
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-warning w-100 mt-2" @click="CerrarPP">
                                                    ENVIAR Y FINALIZAR PP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-12 layout-spacing mt-2" v-if="model.curso==0">
                        <div class="alert alert-danger">
                            <div>
                                <strong>Info!</strong> Este lote PP ya fue cerrado.
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">ENVIAR A PP</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row mb-4 ">
                                        <div class="col-6 text-center">
                                            <h3>{{ detalle_envio_pt . pollos_disponible }}</h3>
                                            <h5 class="text-primary">TOTAL POLLOS DISPONIBLES </h5>

                                        </div>
                                        <div class="col-6 text-center">
                                            <h3>{{ envio . cantidad }}</h3>
                                            <h5 class="text-primary">TOTAL POLLOS A ENVIAR</h5>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Cantidad de pollos</label>
                                            <input type="text" v-model.number="envio.cantidad" class="form-control"
                                                @change="CambioPeso()">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Cajas de pollos</label>
                                            <input type="text" v-model.number="envio.cajas" class="form-control"
                                                @change="CambioPeso()">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Peso Bruto Unit KG</label>
                                            <input type="text" v-model.number="detalle_envio_pt.peso_bruto_actual"
                                                @change="CambioPeso()" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Peso Neto Unit KG</label>
                                            <input type="text" v-model.number="detalle_envio_pt.peso_neto_actual"
                                                @change="CambioPeso()" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Peso Bruto Total KG</label>
                                            <input type="text" v-model="envio.bruto" @change="CambioPesoMerma()"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Peso Neto Total KG</label>
                                            <input type="text" v-model="envio.neto" @change="CambioPesoMerma()"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Merma Bruto Total KG</label>
                                            <input type="text" :value="envio.merma_bruta"disabled class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Merma Neta Total KG</label>
                                            <input type="text" :value="envio.merma_neta" disabled class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button v-if="envio.cantidad<=detalle_envio_pt.cantidad" @click="EnviarPT()" type="button"
                                        data-dismiss="modal" class="btn btn-primary">Enviar</button>
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
            import TableDate from "{{ asset('config/dtdate.js') }}"
            import Block from "{{ asset('config/block.js') }}"
            const {
                createApp
            } = Vue
            let dt = new TableDate()
            let block = new Block()
            createApp({
                data() {
                    return {
                        add: true,
                        model: {
                            compra: {

                            },
                            name: '',
                            detalle_pps: [],
                            traspaso_pps: [],
                            venta_detalle_pps_1: [],
                            venta_detalle_pps: [],
                            pp_traspaso_pp_list: [],
                            pp_traspaso_pp_cinta_list: [],
                            pp_list_desplegue_cinta: [],
                            desplegue_pps: [],
                            pp_envio_transformacion_detalles: []
                        },
                        data: [],
                        detalle_lote: {
                            cantidad: 0,
                            equivalente: 0,
                            pollos: 0,
                            pp_detalles: []
                        },
                        detalle_envio_pt: {
                            cantidad: 0,

                        },
                        envio: {
                            cajas: 0,
                            pollos: 0,
                            peso_bruto: 0,
                            peso_neto: 0,
                            merma_bruto: 0,
                            merma_neto: 0,
                            pb_unit: 0,
                            pn_unit: 0,
                            peso_bruto_m: 0,
                            peso_neto_m: 0,

                        },
                        retiro_organo_general: '',
                        compo_internas: [],
                        compo_externas: [],
                        data_envio: [],
                        banderas: [],
                        items: [],
                        items_sobra: [],
                        item_select: 0,
                        traspasos: [],
                        cintaClientes: [],
                        cinta_cliente: 1,
                        cinta_pigmento: 1,
                        envio_items: [],
                        despliegue_items: [],
                        user: {},
                        sucursal: {}
                    }
                },
                computed: {
                    AllTraspasos() {
                        const grupos = [...(this.model?.pp_traspaso_pp_cinta_list ?? [])];
                        return grupos.flatMap((g, gi) => {
                            const cliente = g?.cinta_cliente?.name ?? '—';
                            const cintaId = g?.cinta_cliente?.id ?? 'sin-cinta';
                            return (g?.traspaso_pps ?? []).map((t, ti) => {
                                const tr = t?.traspaso_pp ?? {};
                                const pb = Number(tr?.peso_bruto ?? 0);
                                const pn = Number(tr?.peso_neto ?? 0);
                                return {
                                    _key: `${cintaId}-${tr?.id ?? 'x'}-${gi}-${ti}`,
                                    cliente,
                                    pp_nro: tr?.pp?.nro ?? '',
                                    cajas: Number(tr?.cajas ?? 0),
                                    pollos: Number(tr?.pollos ?? 0),
                                    peso_bruto: Number(pb),
                                    peso_neto: Number(pn),
                                    merma_bruta: Number((t?.traspaso_pp?.merma_bruta ?? 0)),
                                    merma_neta: Number(t?.traspaso_pp?.merma_neta ?? 0),
                                };
                            });
                        });
                    },
                    TotalesTabla() {
                        const rows = this.AllTraspasos;
                        const suma_cajas = rows.reduce((a, r) => a + Number(r.cajas), 0);
                        const suma_pollos = rows.reduce((a, r) => a + Number(r.pollos), 0);
                        const suma_peso_bruto = rows.reduce((a, r) => a + Number(r.peso_bruto), 0);
                        const suma_peso_neto = rows.reduce((a, r) => a + Number(r.peso_neto), 0);
                        const suma_merma_bruta = rows.reduce((a, r) => a + Number(r.merma_bruta), 0);
                        const suma_merma_neta = rows.reduce((a, r) => a + Number(r.merma_neta), 0);
                        return {
                            suma_cajas,
                            suma_pollos,
                            suma_peso_bruto: Number(suma_peso_bruto).toFixed(3),
                            suma_peso_neto: Number(suma_peso_neto).toFixed(3),
                            suma_merma_bruta: Number(suma_merma_bruta).toFixed(3),
                            suma_merma_neta: Number(suma_merma_neta).toFixed(3),
                        };
                    },
                    lotes_desconpuestos() {
                        // return this.model_computed.filter((v)=>v.descomponer == 1)
                        return []
                    },
                    pp_detalle_descomposicions() {
                        // return this.model_computed.flatMap((v)=>v.pp_detalle_descomposicions.filter((v)=>v.compo_interna_id==this.retiro_organo_general && v.trozado==1))
                        return []
                    },
                    url() {
                        return "{{ url('') }}"
                    },
                    detalle_envio() {
                        // return this.detalle_envio_pt.pollos_disponible-this.envio.cantidad
                    },
                    pollos_pp() {
                        // return this.detalle_lote.pp_detalles.reduce((a,b)=>a+Number(b.cantidad),0)
                        return []
                    },
                    pollos_disponible() {
                        // return Number(this.detalle_lote.equivalente)-Number(this.pollos_pp)
                        return []
                    },
                    total_detalle() {
                        let cajas = this.model.detalle_pps.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.model.detalle_pps.reduce((a, b) => a + Number(b.pollos), 0)
                        let bruto = this.model.detalle_pps.reduce((a, b) => a + Number(b.peso_bruto), 0)
                        let neto = this.model.detalle_pps.reduce((a, b) => a + Number(b.peso_neto), 0)
                        let merma_bruta = this.model.detalle_pps.reduce((a, b) => a + Number(b.merma_bruta), 0)
                        let merma_neta = this.model.detalle_pps.reduce((a, b) => a + Number(b.merma_neta), 0)

                        let cajas_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) => a +
                            Number(b.cajas), 0)
                        let pollos_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) => a +
                            Number(b.pollos), 0)
                        let bruto_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) => a +
                            Number(b.peso_bruto), 0)
                        let neto_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) => a +
                            Number(b.peso_neto), 0)
                        let merma_bruta_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) =>
                            a + Number(b.merma_bruta), 0)
                        let merma_neta_transformacion = this.model.pp_envio_transformacion_detalles.reduce((a, b) => a +
                            Number(b.merma_neta), 0)

                        const base = Array.isArray(this.model?.traspaso_pps) ? this.model.traspaso_pps : [];
                        const traspasosSinEmisor = base.filter(t => t.cinta_cliente_id_emisor == null);
                        const sum = (arr, key) => arr.reduce((acc, it) => acc + (Number(it?.[key]) || 0), 0);
                        let cajas_2 = sum(traspasosSinEmisor, 'cajas');
                        let pollos_2 = sum(traspasosSinEmisor, 'pollos');
                        let bruto_2 = sum(traspasosSinEmisor, 'peso_bruto');
                        let neto_2 = sum(traspasosSinEmisor, 'peso_neto');
                        let merma_bruta_2 = sum(traspasosSinEmisor, 'merma_bruta');
                        let merma_neta_2 = sum(traspasosSinEmisor, 'merma_neta');

                        // let cajas_v = this.model.venta_detalle_pps_1.reduce((a, b) => a + Number(b.cajas), 0)
                        // let pollos_v = this.model.venta_detalle_pps_1.reduce((a, b) => a + Number(b.pollos), 0)
                        // let bruto_v = this.model.venta_detalle_pps_1.reduce((a, b) => a + Number(b.peso_bruto), 0)
                        // let neto_v = this.model.venta_detalle_pps_1.reduce((a, b) => a + Number(b.peso_neto), 0)

                        // let cajas_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.cajas), 0)
                        // let pollos_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.pollos), 0)
                        // let bruto_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.peso_bruto), 0)
                        // let neto_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.peso_neto), 0)
                        // let merma_bruta_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.merma_bruta),
                        //     0)
                        // let merma_neta_al = this.model.pp_traspaso_pp_list.reduce((a, b) => a + Number(b.merma_neta), 0)

                        let cajas_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.pollos), 0)
                        let peso_bruto_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.peso_bruto),
                            0)
                        let peso_neto_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.peso_neto), 0)
                        let merma_bruta_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.merma_bruta),
                            0)
                        let merma_neta_desplegue = this.model.desplegue_pps.reduce((a, b) => a + Number(b.merma_neta),
                            0)

                        let cajas_sobra = this.model.sobra_pps ?
                            this.model.sobra_pps.reduce((a, s) =>
                                a + s.sobra_detalle_pps.reduce((aa, dd) => aa + Number(dd.cajas), 0), 0) :
                            0
                        let bruto_sobra = this.model.sobra_pps ?
                            this.model.sobra_pps.reduce((a, s) =>
                                a + s.sobra_detalle_pps.reduce((aa, dd) => aa + Number(dd.peso_bruto), 0), 0) :
                            0
                        let neto_sobra = this.model.sobra_pps ?
                            this.model.sobra_pps.reduce((a, s) =>
                                a + s.sobra_detalle_pps.reduce((aa, dd) => aa + Number(dd.peso_neto), 0), 0) :
                            0
                        let merma_bruta_sobra = bruto_sobra - neto_sobra
                        let merma_neta_sobra = 0

                        let peso_subdetalle = this.model.retorno_pps ?
                            this.model.retorno_pps.reduce((a, s) =>
                                a + Number(s.peso), 0) :
                            0

                        // cajas = cajas - cajas_2 - cajas_v + cajas_al - cajas_desplegue - cajas_transformacion -
                        //     cajas_sobra
                        // pollos = pollos - pollos_2 - pollos_v + pollos_al - pollos_desplegue - pollos_transformacion
                        // bruto = bruto - bruto_2 - bruto_v + bruto_al - peso_bruto_desplegue - bruto_transformacion -
                        //     bruto_sobra + peso_subdetalle
                        // neto = neto - neto_2 - neto_v + neto_al - peso_neto_desplegue - neto_transformacion -
                        //     neto_sobra + peso_subdetalle
                        // merma_bruta = merma_bruta - merma_bruta_2 + merma_bruta_al - merma_bruta_desplegue -
                        //     merma_bruta_sobra
                        // merma_neta = merma_neta - merma_neta_2 + merma_neta_al - merma_neta_desplegue - merma_neta_sobra

                        // cajas = cajas - cajas_2 - cajas_desplegue - cajas_transformacion -
                        //     cajas_sobra
                        // pollos = pollos - pollos_2 - pollos_desplegue - pollos_transformacion
                        // bruto = bruto - peso_bruto_desplegue - bruto_transformacion -
                        //     bruto_sobra + peso_subdetalle
                        // neto = neto - neto_2 - peso_neto_desplegue - neto_transformacion -
                        //     neto_sobra + peso_subdetalle
                        // merma_bruta = merma_bruta - merma_bruta_2 - merma_bruta_desplegue -
                        //     merma_bruta_sobra
                        // merma_neta = merma_neta - merma_neta_2 - merma_neta_desplegue - merma_neta_sobra

                        cajas = Math.max(cajas - cajas_2 - cajas_desplegue - cajas_transformacion - cajas_sobra, 0);
                        pollos = Math.max(pollos - pollos_2 - pollos_desplegue - pollos_transformacion, 0);
                        bruto = Math.max(bruto - peso_bruto_desplegue - bruto_transformacion - bruto_sobra + peso_subdetalle, 0);
                        neto = Math.max(neto - neto_2 - peso_neto_desplegue - neto_transformacion - neto_sobra + peso_subdetalle, 0);
                        merma_bruta = Math.max(merma_bruta - merma_bruta_2 - merma_bruta_desplegue - merma_bruta_sobra, 0);
                        merma_neta = Math.max(merma_neta - merma_neta_2 - merma_neta_desplegue - merma_neta_sobra, 0);

                        let pollos_caja = cajas > 0 ? (pollos / cajas) : 0;
                        return {
                            cajas,
                            pollos,
                            pollos_caja,
                            bruto,
                            neto,
                            merma_bruta,
                            merma_neta
                        }
                    },
                    model_computed() {
                        return this.model.detalle_pps.map((v) => {
                            let lote = v
                            let lote_des = lote.detalle_pp_descomposicions.filter((v) => v.trozado == 0)
                            lote.peso_interna = lote_des.reduce((a, b) => a + Number(Number(b.compo_interna
                                .peso) * Number(b.cantidad)), 0)
                            lote.piezas_interna = lote_des.reduce((a, b) => a + Number(b.cantidad), 0)
                            lote.peso_bruto_actual = Number(lote.peso_bruto / lote.pollos).toFixed(3)
                            lote.peso_neto_actual = Number(lote.peso_neto / lote.pollos).toFixed(3)
                            // lote.total_pt = v.pp_pts.reduce((a,b)=>a+Number(b.cantidad),0)
                            lote.pollos_disponible = Number(lote.pollos).toFixed(3)
                            lote.peso_bruto_disponible = lote.pollos_disponible * lote.peso_bruto_actual
                            lote.peso_neto_disponible = lote.pollos_disponible * lote.peso_neto_actual
                            lote.merma_bruta_actual = Number(lote.merma_bruta / lote.pollos)
                            lote.merma_neta_actual = Number(lote.merma_neta / lote.pollos)
                            lote.merma_bruta_disponible = lote.pollos_disponible * lote.merma_bruta_actual
                            lote.merma_neta_disponible = lote.pollos_disponible * lote.merma_neta_actual
                            return lote
                        })
                        // return []
                    },
                    TotalesGruposItems() {
                        const safe = v => {
                            v = Number(v);
                            return (isNaN(v) || !isFinite(v)) ? 0 : v;
                        };

                        let suma_cajas = this.envio_items.reduce((a, b) => a + Number(b.cajas), 0);
                        let suma_pollos = this.envio_items.reduce((a, b) => a + Number(b.pollos), 0);
                        let suma_peso_bruto = this.envio_items.reduce((a, b) => a + Number(b.peso_bruto), 0);
                        let suma_peso_neto = this.envio_items.reduce((a, b) => a + Number(b.peso_neto), 0);
                        return {
                            "suma_cajas": suma_cajas,
                            "suma_pollos": suma_pollos,
                            "suma_peso_bruto": Number(suma_peso_bruto).toFixed(3),
                            "suma_peso_neto": Number(suma_peso_neto).toFixed(3),
                        }
                    },
                    TotalesItemsSobra() {
                        const safe = v => {
                            v = Number(v);
                            return (isNaN(v) || !isFinite(v)) ? 0 : v;
                        };

                        let suma_cajas = this.items_sobra.reduce((a, b) => a + safe(b.cajas), 0);
                        let suma_peso_bruto = this.items_sobra.reduce((a, b) => a + safe(b.peso_bruto), 0);
                        let suma_taras = this.items_sobra.reduce((a, b) => a + safe(b.taras), 0);
                        let suma_peso_neto = this.items_sobra.reduce((a, b) => a + safe(b.peso_neto), 0);
                        return {
                            "suma_cajas": suma_cajas,
                            "suma_peso_bruto": Number(suma_peso_bruto).toFixed(3),
                            "suma_taras": Number(suma_taras).toFixed(3),
                            "suma_peso_neto": Number(suma_peso_neto).toFixed(3),
                        }
                    }
                },
                methods: {
                    TotalesDespliegueItems(index) {
                        const m = this.model.pp_list_desplegue_cinta[index];
                        if (!m || !Array.isArray(m.despliegue_items)) {
                            return {
                                suma_cajas: 0,
                                suma_pollos: 0,
                                suma_peso_bruto: "0.000",
                                suma_peso_neto: "0.000",
                            };
                        }

                        const safe = v => {
                            v = Number(v);
                            return (isNaN(v) || !isFinite(v)) ? 0 : v;
                        };

                        let suma_cajas = m.despliegue_items.reduce((a, b) => a + safe(b.cajas), 0);
                        let suma_pollos = m.despliegue_items.reduce((a, b) => a + safe(b.pollos), 0);
                        let suma_peso_bruto = m.despliegue_items.reduce((a, b) => a + safe(b.peso_bruto), 0);
                        let suma_peso_neto = m.despliegue_items.reduce((a, b) => a + safe(b.peso_neto), 0);

                        return {
                            suma_cajas,
                            suma_pollos,
                            suma_peso_bruto: suma_peso_bruto.toFixed(3),
                            suma_peso_neto: suma_peso_neto.toFixed(3),
                        };
                    },
                    _num(v) {
                        v = Number(v);
                        return Number.isFinite(v) ? v : 0;
                    },
                    safeDiv(a, b) {
                        a = this._num(a);
                        b = this._num(b);
                        return b > 0 ? (a / b) : 0;
                    },
                    fx(v, dec = 3) {
                        v = this._num(v);
                        return v.toFixed(dec);
                    },

                    _swErr(msg) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-danger btn-rounded',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Saldo insuficiente',
                            text: msg,
                            type: 'error',
                            confirmButtonText: 'Entendido',
                            padding: '2em'
                        });
                    },

                    _redondear(n, p = 3) {
                        const f = Math.pow(10, p);
                        return Math.round((Number(n) + Number.EPSILON) * f) / f;
                    },

                    _excesoMensaje() {
                        const t = this.TotalesGruposItems;
                        const s = this.total_detalle;
                        const tBruto = Number(t.suma_peso_bruto);
                        const tNeto = Number(t.suma_peso_neto);
                        let errores = [];

                        // if (t.suma_cajas > s.cajas) errores.push(`Cajas (${t.suma_cajas}) > disponibles (${s.cajas}).`);
                        if (t.suma_pollos > s.pollos) errores.push(
                            `Pollos (${t.suma_pollos}) > disponibles (${s.pollos}).`);
                        if (this._redondear(tBruto, 3) > this._redondear(s.bruto, 3)) {
                            errores.push(
                                `Peso bruto (${this._redondear(tBruto,3).toFixed(3)}) > disponible (${this._redondear(s.bruto,3).toFixed(3)}).`
                            );
                        }
                        if (this._redondear(tNeto, 3) > this._redondear(s.neto, 3)) {
                            errores.push(
                                `Peso neto (${this._redondear(tNeto,3).toFixed(3)}) > disponible (${this._redondear(s.neto,3).toFixed(3)}).`
                            );
                        }
                        const tSobra = this.TotalesItemsSobra;
                        const tBrutoSobra = Number(tSobra.suma_peso_bruto);
                        const tNetoSobra = Number(tSobra.suma_peso_neto);
                        if (tSobra.suma_cajas > s.cajas) errores.push(
                            `Cajas sobrantes (${tSobra.suma_cajas}) > disponibles (${s.cajas}).`);
                        if (this._redondear(tBrutoSobra, 3) > this._redondear(s.bruto, 3)) {
                            errores.push(
                                `Peso bruto sobrante (${this._redondear(tBrutoSobra,3).toFixed(3)}) > disponible (${this._redondear(s.bruto,3).toFixed(3)}).`
                            );
                        }
                        return errores;
                    },

                    _excesoMensajeDespliegue(index) {
                        const t = this.TotalesDespliegueItems(index);
                        const despliegue = this.model.pp_list_desplegue_cinta[
                            index];
                        const totalesDespliegue = despliegue.totales;
                        const tBruto = Number(t.suma_peso_bruto);
                        const tNeto = Number(t.suma_peso_neto);
                        let errores = [];
                        // if (t.suma_cajas > totalesDespliegue.cajas) {
                        //     errores.push(
                        //         `Cajas en despliegue (${t.suma_cajas}) > disponibles (${totalesDespliegue.cajas}).`);
                        // }
                        if (t.suma_pollos > totalesDespliegue.pollos) {
                            errores.push(
                                `Pollos en despliegue (${t.suma_pollos}) > disponibles (${totalesDespliegue.pollos}).`
                            );
                        }
                        if (this._redondear(tBruto, 3) > this._redondear(totalesDespliegue.peso_bruto, 3)) {
                            errores.push(
                                `Peso bruto en despliegue (${this._redondear(tBruto, 3).toFixed(3)}) > disponible (${this._redondear(totalesDespliegue.peso_bruto, 3).toFixed(3)}).`
                            );
                        }
                        if (this._redondear(tNeto, 3) > this._redondear(totalesDespliegue.peso_neto, 3)) {
                            errores.push(
                                `Peso neto en despliegue (${this._redondear(tNeto, 3).toFixed(3)}) > disponible (${this._redondear(totalesDespliegue.peso_neto, 3).toFixed(3)}).`
                            );
                        }
                        return errores;
                    },

                    excedeStockDespliegue(index) {
                        const bloque = this.model.pp_list_desplegue_cinta[index];
                        const errores = this._excesoMensajeDespliegue(index);
                        if (errores.length) {
                            this._swErr(errores.join(' '));
                            return true;
                        }
                        return false;
                    },

                    excedeStock() {
                        const errores = this._excesoMensaje();
                        if (errores.length) {
                            this._swErr(errores.join(' '));
                            return true;
                        }
                        return false;
                    },

                    excedeStockNeto() {
                        const errores = this._excesoMensaje2();
                        if (errores.length) {
                            this._swErr(errores.join(' '));
                            return true;
                        }
                        return false;
                    },

                    _excesoMensaje2() {
                        const s = this.total_detalle;
                        const tSobra = this.TotalesItemsSobra;
                        const tNetoSobra = Number(tSobra.suma_peso_neto);
                        let errores = [];
                        if (tNetoSobra > s.neto) errores.push(
                            `Peso neto sobrante (${tNetoSobra.toFixed(3)}) > disponible (${Number(s.neto).toFixed(3)}).`
                        );
                        return errores;
                    },

                    AddItemEnviar() {
                        this.envio_items.push({
                            cajas: 0,
                            pollos: 0,
                            peso_bruto: 0,
                            peso_neto: 0,
                            merma_bruto: 0,
                            merma_neto: 0,
                            pb_unit: 0,
                            pn_unit: 0,
                            peso_bruto_m: 0,
                            peso_neto_m: 0,
                            cinta_pigmento: 1,
                            cinta_cliente: 1
                        })
                    },

                    AddItemDespliegue(index) {
                        const bloque = this.model.pp_list_desplegue_cinta[index];
                        if (!Array.isArray(bloque.despliegue_items)) {
                            bloque.despliegue_items = [];
                        }
                        const cintaObj = bloque.cinta_cliente;
                        const cintaId = (cintaObj && typeof cintaObj === 'object') ? cintaObj.id : Number(cintaObj);
                        bloque.despliegue_items.push({
                            cajas: 0,
                            pollos: 0,
                            peso_bruto: 0,
                            peso_neto: 0,
                            merma_bruto: 0,
                            merma_neto: 0,
                            pb_unit: 0,
                            pn_unit: 0,
                            peso_bruto_m: 0,
                            peso_neto_m: 0,
                            cinta_pigmento: 1,
                            cinta_cliente: cintaId,
                        });
                    },

                    eliminarDespliegueItem(index, i) {
                        if (this.model.pp_list_desplegue_cinta[index].despliegue_items) {
                            this.model.pp_list_desplegue_cinta[index].despliegue_items.splice(i, 1);
                        } else {
                            console.error('No se pudo eliminar, despliegue_items no está definido para este índice');
                        }
                    },

                    async traspasoAceptar(m) {
                        let self = this

                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Aceptar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (!result.value) return;
                            try {
                                block.block();
                                // let res = await axios.post(, this.model)
                                let data = {
                                    ...m
                                }
                                data.pp_nuevo_id = this.model.id
                                data.user_id = this.user.id
                                let url = "{{ url('api/traspasos-pp/aceptar') }}/" + m.id;
                                let res = await axios.post(url, data)
                                await this.load()
                                block.unblock();
                                swalWithBootstrapButtons.fire({
                                    title: '¡Aceptado!',
                                    text: 'El traspaso fue aceptado con éxito.',
                                    type: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                })
                            } catch (e) {
                                block.unblock();
                                swalWithBootstrapButtons.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un problema al procesar el traspaso.',
                                    type: 'error',
                                    confirmButtonText: 'Entendido',
                                    confirmButtonClass: 'btn btn-danger btn-rounded',
                                })
                            }
                        })
                    },
                    AddItem() {
                        if (!this.item_select) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Error',
                                text: 'Debe seleccionar un item antes de agregar.',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                            return;
                        }
                        let item = this.items.find((v) => v.id == this.item_select)
                        if (item) {
                            this.items_sobra.push({
                                ...item,
                                cajas: 0,
                                peso_bruto: 0,
                                peso_neto: 0,
                                taras: 0
                            })
                        }
                    },
                    async traspaso(tipo) {
                        let self = this
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Enviar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            let self = this
                            if (!result.value) return;
                            if (this.excedeStock()) return;
                            block.block();
                            let invalido = this.envio_items.some(item => {
                                return (!item.pollos || item.pollos <= 0) ||
                                    (!item.peso_bruto || item.peso_bruto <= 0) ||
                                    (!item.peso_neto || item.peso_neto <= 0);
                            });
                            if (invalido) {
                                block.unblock();
                                swalWithBootstrapButtons({
                                    title: 'Error!',
                                    text: 'Todos los items deben tener Pollos, Peso Bruto y Peso Neto mayores a 0.',
                                    type: 'error',
                                    confirmButtonText: 'Ok',
                                    padding: '2em'
                                });
                                return;
                            }
                            this.envio.tipo = tipo
                            this.envio.pp_id = this.model.id
                            this.envio.detalles = this.model_computed
                            this.envio.trapasos = this.model.traspaso_pps
                            this.envio.detalles_envio = this.envio_items
                            try {
                                block.block();
                                let url = "{{ url('api/traspasoPps') }}";
                                this.envio.cinta_cliente = this.cinta_cliente
                                this.envio.cinta_pigmento = this.cinta_pigmento
                                let res = await axios.post(url, this.envio)
                                this.envio_items = []
                                await Promise.all([self.GET_DATA(
                                    "{{ url('api/pp/detalle-pp') }}/{{ $id }}"
                                ), ]).then((v) => {
                                    self.model = v[0]
                                })
                                block.unblock();
                                swalWithBootstrapButtons.fire({
                                    title: 'Traspasado!',
                                    text: 'El traspaso fue realizado con éxito.',
                                    type: 'success',
                                    confirmButtonText: 'OK',
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                })
                            } catch (e) {
                                block.unblock();
                                swalWithBootstrapButtons.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un problema al procesar el traspaso.',
                                    type: 'error',
                                    confirmButtonText: 'Entendido',
                                    confirmButtonClass: 'btn btn-danger btn-rounded',
                                })
                            }
                        })
                    },
                    async traspasoDespliegue(tipo, index) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        const result = await swalWithBootstrapButtons({
                            title: '¿Estás seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Enviar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em',
                        });

                        if (!result.value) return;

                        const bloque = this.model.pp_list_desplegue_cinta?.[index];
                        if (!bloque) {
                            console.error('Bloque no encontrado para index', index);
                            return;
                        }
                        if (!Array.isArray(bloque.despliegue_items) || bloque.despliegue_items.length === 0) {
                            console.error('Sin items de despliegue');
                            return;
                        }

                        //if (this.excedeStockDespliegue(bloque)) return;

                        const invalido = bloque.despliegue_items.some(it =>
                            !it.pollos || it.pollos <= 0 || !it.peso_bruto || it.peso_bruto <= 0 || !it
                            .peso_neto || it.peso_neto <= 0
                        );
                        if (invalido) {
                            await swalWithBootstrapButtons({
                                title: 'Error!',
                                text: 'Todos los items deben tener Pollos, Peso Bruto y Peso Neto mayores a 0.',
                                type: 'error',
                                confirmButtonText: 'Ok',
                                padding: '2em'
                            });
                            return;
                        }

                        const payload = {
                            tipo,
                            pp_id: this.model.id,
                            detalles: this.model_computed,
                            trapasos: this.model.traspaso_pps ?? [],
                            detalles_envio: bloque.despliegue_items.map(it => ({
                                cajas: Number(it.cajas) || 0,
                                pollos: Number(it.pollos) || 0,
                                peso_bruto: Number(it.peso_bruto) || 0,
                                peso_neto: Number(it.peso_neto) || 0,
                                peso_bruto_m: Number(it.peso_bruto_m) || 0,
                                peso_neto_m: Number(it.peso_neto_m) || 0,
                                cinta_cliente: Number(it.cinta_cliente) || null,
                                cinta_pigmento: Number(it.cinta_pigmento) || 1,
                            })),
                            cinta_pigmento: Number(bloque.despliegue_items[0]?.cinta_pigmento ?? 1),
                        };

                        try {
                            block.block();
                            await axios.post("{{ url('api/traspasoDesplieguePps') }}", payload);
                            bloque.despliegue_items = [];
                            const data = await this.GET_DATA(
                                "{{ url('api/pp/detalle-pp') }}/{{ $id }}");
                            this.model = data;

                            block.unblock();
                            await swalWithBootstrapButtons.fire({
                                title: 'Traspasado!',
                                text: 'El traspaso fue realizado con éxito.',
                                type: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonClass: 'btn btn-success btn-rounded',
                            });
                        } catch (e) {
                            console.error("Error occurred:", e.response || e.message || e);
                            block.unblock();
                            await swalWithBootstrapButtons.fire({
                                title: 'Error',
                                text: 'Ocurrió un problema al procesar el traspaso.',
                                type: 'error',
                                confirmButtonText: 'Entendido',
                                confirmButtonClass: 'btn btn-danger btn-rounded',
                            });
                        }
                    },

                    sobraCaja(item) {
                        item.taras = item.cajas * 2
                        if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
                    },
                    sobraNeto(item) {
                        item.peso_neto = item.peso_bruto - item.taras
                        if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
                    },
                    sobraBruto(item) {
                        item.peso_neto = item.peso_bruto - item.taras
                        if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
                    },


                    envioCaja(m) {
                        const n = this._num.bind(this);
                        m.cajas = n(m.cajas);

                        const pc = this._num(this.total_detalle.pollos_caja);
                        m.pollos = Math.round(n(m.cajas * pc));


                        const brutoPP = this.safeDiv(this.total_detalle.bruto, this.total_detalle.pollos);
                        const netoPP = this.safeDiv(this.total_detalle.neto, this.total_detalle.pollos);

                        m.pb_unit = this.fx(brutoPP);
                        m.pn_unit = this.fx(netoPP);
                        m.peso_bruto = this.fx(m.pollos * brutoPP);
                        m.peso_neto = this.fx(m.pollos * netoPP);
                        m.peso_bruto_m = this.fx(m.pollos * brutoPP);
                        m.peso_neto_m = this.fx(m.pollos * netoPP);

                        if (this.excedeStock()) {
                            m.cajas = 0;
                            m.pollos = 0;
                            m.peso_bruto = 0;
                            m.peso_neto = 0;
                            m.pb_unit = 0;
                            m.pn_unit = 0;
                            m.peso_bruto_m = 0;
                            m.peso_neto_m = 0;
                        }
                    },

                    envioPollo(m) {
                        const n = this._num.bind(this);
                        m.pollos = n(m.pollos);

                        const brutoPP = this.safeDiv(this.total_detalle.bruto, this.total_detalle.pollos);
                        const netoPP = this.safeDiv(this.total_detalle.neto, this.total_detalle.pollos);

                        m.peso_bruto = this.fx(m.pollos * brutoPP);
                        m.peso_neto = this.fx(m.pollos * netoPP);
                        m.pb_unit = this.fx(this.safeDiv(this._num(m.peso_bruto), m.pollos)); // si m.pollos=0 → 0
                        m.pn_unit = this.fx(this.safeDiv(this._num(m.peso_neto), m.pollos));
                        m.peso_bruto_m = this.fx(m.pollos * brutoPP);
                        m.peso_neto_m = this.fx(m.pollos * netoPP);
                        m.merma_bruto = this.fx(this._num(m.peso_bruto_m) - this._num(m.peso_bruto));
                        m.merma_neto = this.fx(this._num(m.peso_neto_m) - this._num(m.peso_neto));

                        if (this.excedeStock()) {
                            m.pollos = 0;
                            m.peso_bruto = 0;
                            m.peso_neto = 0;
                            m.pb_unit = 0;
                            m.pn_unit = 0;
                            m.merma_bruto = 0;
                            m.merma_neto = 0;
                        }
                    },

                    envioMerma(m) {
                        const n = this._num.bind(this);

                        const cajasTaras = n(m.cajas) * 2;
                        m.peso_neto = this.fx(n(m.peso_bruto) - cajasTaras);
                        m.merma_bruto = this.fx(this._num(m.peso_bruto_m) - this._num(m.peso_bruto));
                        m.merma_neto = this.fx(this._num(m.peso_neto_m) - this._num(m.peso_neto));

                        if (this.excedeStock()) {
                            m.peso_bruto = 0;
                            m.peso_neto = 0;
                            m.merma_bruto = 0;
                            m.merma_neto = 0;
                        }
                    },



                    envioCajaDespliegue(item, index) {
                        const n = this._num.bind(this);
                        item.cajas = n(item.cajas);

                        const despliegue = this.model.pp_list_desplegue_cinta[index];
                        const totalesDespliegue = despliegue.totales;

                        let pollos_caja = totalesDespliegue.cajas > 0 ? (totalesDespliegue.pollos / totalesDespliegue
                            .cajas) : 0;
                        const pc = this._num(pollos_caja);

                        item.pollos = Math.round(n(item.cajas * pc));

                        const brutoPP = this.safeDiv(totalesDespliegue.peso_bruto, totalesDespliegue.pollos);
                        const netoPP = this.safeDiv(totalesDespliegue.peso_neto, totalesDespliegue.pollos);

                        item.pb_unit = this.fx(brutoPP);
                        item.pn_unit = this.fx(netoPP);
                        item.peso_bruto = this.fx(item.pollos * brutoPP);
                        item.peso_neto = this.fx(item.pollos * netoPP);
                        item.peso_bruto_m = this.fx(item.pollos * brutoPP);
                        item.peso_neto_m = this.fx(item.pollos * netoPP);

                        if (this.excedeStockDespliegue(index)) {
                            item.cajas = 0;
                            item.pollos = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                            item.pb_unit = 0;
                            item.pn_unit = 0;
                            item.peso_bruto_m = 0;
                            item.peso_neto_m = 0;
                        }
                    },



                    envioPolloDespliegue(item, index) {
                        const n = this._num.bind(this);
                        item.pollos = n(item.pollos);

                        const despliegue = this.model.pp_list_desplegue_cinta[index];
                        const totalesDespliegue = despliegue.totales;

                        const brutoPP = this.safeDiv(totalesDespliegue.peso_bruto, totalesDespliegue.pollos);
                        const netoPP = this.safeDiv(totalesDespliegue.peso_neto, totalesDespliegue.pollos);

                        item.peso_bruto = this.fx(item.pollos * brutoPP);
                        item.peso_neto = this.fx(item.pollos * netoPP);
                        item.pb_unit = this.fx(this.safeDiv(this._num(item.peso_bruto), item
                            .pollos));
                        item.pn_unit = this.fx(this.safeDiv(this._num(item.peso_neto), item.pollos));
                        item.peso_bruto_m = this.fx(item.pollos * brutoPP);
                        item.peso_neto_m = this.fx(item.pollos * netoPP);
                        item.merma_bruto = this.fx(this._num(item.peso_bruto_m) - this._num(item.peso_bruto));
                        item.merma_neto = this.fx(this._num(item.peso_neto_m) - this._num(item.peso_neto));

                        if (this.excedeStockDespliegue(index)) {
                            item.pollos = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                            item.pb_unit = 0;
                            item.pn_unit = 0;
                            item.merma_bruto = 0;
                            item.merma_neto = 0;
                        }
                    },

                    envioMermaDespliegue(item, index) {
                        const n = this._num.bind(this);

                        const despliegue = this.model.pp_list_desplegue_cinta[index];
                        const totalesDespliegue = despliegue.totales;

                        const cajasTaras = n(item.cajas) * 2;
                        item.peso_neto = this.fx(n(item.peso_bruto) - cajasTaras);
                        item.merma_bruto = this.fx(this._num(item.peso_bruto_m) - this._num(item.peso_bruto));
                        item.merma_neto = this.fx(this._num(item.peso_neto_m) - this._num(item.peso_neto));

                        if (this.excedeStockDespliegue(index)) {
                            item.pollos = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                            item.pb_unit = 0;
                            item.pn_unit = 0;
                            item.merma_bruto = 0;
                            item.merma_neto = 0;
                        }
                    },

                    addEnvio(l) {
                        this.data_envio.push(l)

                    },
                    bandera(d) {
                        let b = this.banderas.find(b => d.pollos >= b.min && d.pollos <= b.max)
                        if (b) {
                            return b.name
                        }
                        return ''
                    },
                    CambioPeso() {
                        this.envio.bruto = Number(this.detalle_envio_pt.peso_bruto_actual * this.envio.cantidad)
                            .toFixed(3)
                        this.envio.neto = Number(this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad).toFixed(
                            3)
                        this.envio.merma_bruta = Number((this.detalle_envio_pt.peso_bruto_actual * this.envio
                            .cantidad) - {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad) -
                        {
                            ...this.envio
                        }.neto).toFixed(3)


                    },
                    CambioPesoMerma() {
                        this.envio.merma_bruta = Number((this.detalle_envio_pt.peso_bruto_actual * this.envio
                            .cantidad) - {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad) -
                        {
                            ...this.envio
                        }.neto).toFixed(3)


                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/proveedors') }}";
                            if (this.add == false) {
                                url = "{{ url('api/proveedors') }}/" + this.model.id
                                let res = axios.put(url, this.model)
                            } else {
                                let res = axios.post(url, this.model)

                            }
                            dt.destroy()
                            await this.load()
                            dt.create()
                        } catch (e) {

                        }
                    },
                    async CerrarPP() {

                        let self = this
                        if (this.excedeStock()) return;
                        if (this.excedeStockNeto()) return;

                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })

                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Enviar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {

                            block.block();
                            let invalido = this.items_sobra.some(item => {
                                return (!item.peso_bruto || item.peso_bruto <= 0) ||
                                    (!item.peso_neto || item.peso_neto <= 0);
                            });
                            if (invalido) {
                                block.unblock();
                                swalWithBootstrapButtons({
                                    title: 'Error!',
                                    text: 'Debes llenar Peso Bruto y Peso Neto con valores mayores a 0.',
                                    type: 'error',
                                    confirmButtonText: 'Ok',
                                    padding: '2em'
                                });
                                return;
                            }
                            if (result.value) {
                                try {
                                    block.block();
                                    // let res = await axios.post(, this.model)
                                    const params = new URLSearchParams(this.model);
                                    this.model.items_sobra = this.items_sobra
                                    let url = "{{ url('api/pps-cerrar') }}/{{ $id }}";
                                    let res = axios.post(url, this.model)

                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })
                                    block.unblock();
                                    swalWithBootstrapButtons({
                                        title: 'Cerrado!',
                                        type: 'success',
                                    }).then((result) => {

                                        window.location.href = "{{ url('pp/lotes') }}"
                                    })

                                } catch (e) {

                                }
                            }
                        })
                    },
                    async EnviarPP() {
                        let self = this
                        if (this.excedeStock()) return;
                        if (this.excedeStockNeto()) return;
                        if (this.items_sobra.length > 0) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Enviar!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    block.block();
                                    let invalido = this.items_sobra.some(item => {
                                        return (!item.peso_bruto || item.peso_bruto <= 0) ||
                                            (!item.peso_neto || item.peso_neto <= 0);
                                    });
                                    if (invalido) {
                                        block.unblock();
                                        swalWithBootstrapButtons({
                                            title: 'Error!',
                                            text: 'Debes llenar Peso Bruto y Peso Neto con valores mayores a 0.',
                                            type: 'error',
                                            confirmButtonText: 'Ok',
                                            padding: '2em'
                                        });
                                        return;
                                    }
                                    try {
                                        block.block();
                                        // let res = await axios.post(, this.model)
                                        const params = new URLSearchParams(this.model);
                                        this.model.items_sobra = this.items_sobra
                                        let url = "{{ url('api/pps-enviar') }}/{{ $id }}";
                                        this.model.user_id = this.user.id
                                        let res = axios.post(url, this.model)

                                        const swalWithBootstrapButtons = swal.mixin({
                                            confirmButtonClass: 'btn btn-success btn-rounded',
                                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                            buttonsStyling: false,
                                        })
                                        block.unblock();
                                        swalWithBootstrapButtons({
                                            title: 'Enviado!',
                                            type: 'success',
                                        }).then((result) => {
                                            this.load()


                                        })

                                    } catch (e) {

                                    }
                                }
                            })
                        } else {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Error',
                                text: 'Debe agregar al menos un item de sobra antes de enviar.',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                        }
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async load() {
                        try {
                            let self = this
                            block.block();
                            try {
                                await Promise.all([self.GET_DATA(
                                        "{{ url('api/pp/detalle-pp') }}/{{ $id }}"),
                                    self.GET_DATA("{{ url('api/compoInternas') }}"),
                                    self.GET_DATA("{{ url('api/compoExternas') }}"),
                                    self.GET_DATA("{{ url('api/banderas') }}"),
                                    self.GET_DATA("{{ url('api/items') }}"),
                                    self.GET_DATA("{{ url('api/traspasos-pp/disponibles') }}"),
                                    self.GET_DATA("{{ url('api/cintaClientes') }}"),
                                ]).then((v) => {
                                    self.model = v[0]
                                    self.compo_internas = v[1]
                                    self.compo_externas = v[2]
                                    self.banderas = v[3]
                                    let items = v[4]
                                    self.items = items.filter((item) => {
                                        return (item.tipo == 1 || item.tipo == 2 || item.tipo ==
                                            3) && ["CUELLO", "MENUDO", "HIGADO", "PULMON",
                                            "CUERO",
                                            "GRASA"
                                        ].includes(item.name.toUpperCase());
                                    });
                                    self.items_sobra.forEach((v) => {
                                        v.cajas = 0
                                        v.peso_bruto = 0
                                        v.peso_neto = 0
                                        v.taras = 0
                                    })
                                    self.traspasos = v[5]
                                    self.cintaClientes = v[6]
                                    block.unblock();
                                })

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                    async EnviarPT() {

                        if (!result.value) return;
                        console.log(this.detalle_envio_pt);
                        try {
                            let self = this
                            let data = {
                                ...this.detalle_envio_pt
                            }
                            data.cantidad_envio = this.envio.cantidad
                            data.cajas_envio = this.envio.cajas
                            data.peso_bruto_2 = this.envio.bruto
                            data.peso_neto_2 = this.envio.neto
                            data.merma_bruta = this.envio.merma_bruta
                            data.merma_neta = this.envio.merma_neta
                            let res = await axios.post("{{ url('api/ptDetalles') }}", data)
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Enviado!',
                                type: 'success',
                            })
                            await self.load()
                            window.open(res.data.url_pdf, '_blank');
                        } catch (e) {

                        }
                    },

                    deleteItem(id) {
                        let self = this
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })

                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Eliminar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {

                                    const params = new URLSearchParams({});


                                    let url = "{{ url('api/compras') }}/" + id

                                    await axios.delete(url)
                                    dt.destroy()
                                    await self.load()
                                    dt.create()
                                } catch (e) {

                                }
                            }
                        })
                    },
                    async Descomponer(item) {
                        try {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Descomponer!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let pp_detalle = {
                                        ...item
                                    }
                                    pp_detalle.compo_internas = this.compo_internas
                                    let res = await axios.post(
                                        "{{ url('api/descomponer-detallepps') }}/" + pp_detalle
                                        .id,
                                        pp_detalle)
                                    await this.load()
                                    window.open(res.data.url_pdf, '_blank');
                                }
                            })
                        } catch (error) {

                        }

                    },
                    async DescomponerGeneral(item) {
                        try {

                            let pp_detalle = {
                                ...item
                            }
                            pp_detalle.compo_internas = this.compo_internas
                            let res = await axios.post("{{ url('api/descomponer-detallepps') }}/" + pp_detalle.id,
                                pp_detalle)
                            return res.data
                        } catch (error) {

                        }

                    },
                    async TrozarDetallepp(item) {
                        try {


                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Descomponer!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let pp_detalle = {
                                        ...item
                                    }

                                    let res = await axios.post(
                                        "{{ url('api/descomponerdetallepps') }}/" + pp_detalle.id,
                                        pp_detalle)
                                    await this.load()
                                }
                            })
                        } catch (error) {

                        }

                    },
                    async TrozarDetalleppUnit(item) {
                        try {
                            let pp_detalle = {
                                ...item
                            }
                            let res = await axios.post("{{ url('api/descomponerdetallepps') }}/" + pp_detalle.id,
                                pp_detalle)
                            return res.data
                        } catch (error) {

                        }

                    },
                    async RegresarLote(item) {
                        try {


                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Regresar!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let pp_detalle = {
                                        ...item
                                    }

                                    let res = await axios.post("{{ url('api/detallePpRegresar') }}/" +
                                        item.id, pp_detalle)
                                    await this.load()
                                }
                            })
                        } catch (error) {

                        }

                    },
                    async DescomponerTodo() {
                        this.lotes_desconpuestos.map(async (item) => {

                            await this.DescomponerGeneral(item)

                        })
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Trozado!',

                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok!',

                            reverseButtons: true,
                            padding: '2em'
                        })
                        await this.load()
                    },
                    async QuitarOrgano() {
                        this.pp_detalle_descomposicions.map(async (item) => {
                            await this.TrozarDetalleppUnit(item)

                        })
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Descompuesto!',

                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok!',

                            reverseButtons: true,
                            padding: '2em'
                        })
                        await this.load()
                    },
                    async EnviarTransformacion() {
                        let self = this
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })

                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Enviar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                if (this.excedeStock()) return;
                                block.block();
                                let invalido = this.envio_items.some(item => {
                                    return (!item.pollos || item.pollos <= 0) ||
                                        (!item.peso_bruto || item.peso_bruto <= 0) ||
                                        (!item.peso_neto || item.peso_neto <= 0);
                                });

                                if (invalido) {
                                    block.unblock();
                                    swalWithBootstrapButtons({
                                        title: 'Error!',
                                        text: 'Todos los items deben tener Pollos, Peso Bruto y Peso Neto mayores a 0.',
                                        type: 'error',
                                        confirmButtonText: 'Ok',
                                        padding: '2em'
                                    });
                                    return;
                                }
                                try {
                                    block.block();
                                    let data = {
                                        pp_id: this.model.id,
                                        data: this.envio_items,
                                        user_id: this.user.id,
                                        sucursal_id: this.sucursal.id
                                    }
                                    let res = await axios.post(
                                        "{{ url('api/envios-pp-transformaciones') }}", data)
                                    this.envio_items = []
                                    await this.load()
                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })
                                    block.unblock();
                                    swalWithBootstrapButtons({
                                        title: 'Enviado a Transformaciones!',
                                        text: "Se envio correctamente, puedes aceptar el envio en la transformacion.",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok!',

                                        reverseButtons: true,
                                        padding: '2em'
                                    })
                                } catch (e) {
                                    block.unblock();
                                    swalWithBootstrapButtons.fire({
                                        title: 'Error',
                                        text: 'Ocurrió un problema al procesar el envío.',
                                        type: 'error',
                                        confirmButtonText: 'Entendido',
                                        confirmButtonClass: 'btn btn-danger btn-rounded',
                                    })
                                }
                            }
                        })
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {
                            let sucursal = localStorage.getItem('AppSucursal')
                            let user = localStorage.getItem('AppUser')
                            this.user = JSON.parse(user)
                            this.sucursal = JSON.parse(sucursal)
                            await Promise.all([self.load()]).then((v) => {

                            })
                            dt.create()

                        } catch (e) {

                        } finally {
                            var ss = $(".basic").select2({
                                tags: true,
                            }).change((v) => {
                                self.item_select = v.target.value
                            })
                            let user = localStorage.getItem('AppUser')
                            if (user == null) {

                            }
                            this.user = JSON.parse(user)
                            block.unblock();
                        }

                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
    @slot('style')
        <style>
            .fw-bold {
                font-weight: bold;
            }

            .nav-tabs svg {
                width: 20px;
                vertical-align: bottom;
            }

            .nav-tabs .nav-link.active {
                color: #e95f2b;
                background-color: #fff;
                border-color: #e0e6ed #e0e6ed #fff;
            }

            .nav-tabs .nav-link.active:after {
                color: #e95f2b;
            }

            .nav-tabs {
                border-bottom: 1px solid #ebedf2;
            }

            .nav-tabs .nav-link:hover {
                border-color: #ebedf2 #ebedf2 #f1f2f3;
            }

            .dropdown-menu {
                box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.1);
            }

            .nav-tabs .dropdown-item:hover {
                background-color: #f1f2f3;
                color: #515365;
            }

            .nav-tabs li a.disabled {
                color: #acb0c3 !important;
            }

            .nav-pills .nav-item:not(:last-child) {
                margin-right: 5px;
            }

            .nav-pills .nav-link.active:after {
                color: #fff;
            }

            .nav-pills .nav-link {
                color: #3b3f5c;
            }

            .nav-pills .show>.nav-link {
                background-color: #e95f2b;
            }

            .nav-pills li a.disabled {
                color: #acb0c3 !important;
            }

            h4 {
                font-size: 1.125rem;
            }


            .simple-tab .nav-tabs li a {
                color: #3b3f5c;
            }

            .simple-tab .nav-tabs .nav-item.show .nav-link,
            .simple-tab .nav-tabs .nav-link.active {
                color: #1b55e2;
                font-weight: 600;
                background-color: #fff;
            }

            .nav-tabs {
                border-bottom: 1px solid #e0e6ed;
            }

            .simple-tab .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }




            .simple-pills .nav-pills li a {
                color: #3b3f5c;
            }

            .simple-pills .nav-pills .nav-link.active,
            .simple-pills .nav-pills .show>.nav-link {
                background-color: #1b55e2;
                border-color: transparent;
            }

            .simple-pills .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .icon-tab .nav-tabs li a {
                color: #3b3f5c;
            }

            .icon-tab .nav-tabs svg {
                width: 20px;
                vertical-align: bottom;
            }

            .icon-tab .nav-tabs .nav-item.show .nav-link,
            .icon-tab .nav-tabs .nav-link.active {
                color: #e95f2b;
                background-color: #fff;
                border-color: #e0e6ed #e0e6ed #fff;
            }

            .icon-tab .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }


            .icon-pill .nav-pills li a {
                color: #3b3f5c;
            }

            .icon-pill .nav-pills svg {
                width: 20px;
                vertical-align: bottom;
            }

            .icon-pill .nav-pills .nav-link.active,
            .icon-pill .nav-pills .show>.nav-link {
                background-color: #e2a03f;
                border-color: transparent;
            }

            .icon-pill .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }


            .underline-content .nav-tabs {
                border-bottom: 1px solid #e0e6ed;
            }

            .underline-content .nav-tabs li a {
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .underline-content .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }

            .underline-content .nav-tabs .nav-link.active,
            .underline-content .nav-tabs .show>.nav-link {
                border-color: transparent;
                border-bottom: 1px solid #5c1ac3;
                color: #5c1ac3;
                background-color: transparent;
            }

            .underline-content .nav-tabs .nav-link.active:hover,
            .underline-content .nav-tabs .show>.nav-link:hover,
            .underline-content .nav-tabs .nav-link.active:focus,
            .underline-content .nav-tabs .show>.nav-link:focus {
                border-bottom: 1px solid #5c1ac3;
            }

            .underline-content .nav-tabs .nav-link:focus,
            .underline-content .nav-tabs .nav-link:hover {
                border-color: transparent;
            }



            .animated-underline-content .nav-tabs {
                border-bottom: 1px solid #e0e6ed;
            }

            .animated-underline-content .nav-tabs li a {
                padding-top: 15px;
                padding-bottom: 15px;
                position: relative;
            }

            .animated-underline-content .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }

            .animated-underline-content .nav-tabs .nav-link.active,
            .animated-underline-content .nav-tabs .show>.nav-link {
                border-color: transparent;
                color: #5c1ac3;
            }

            .animated-underline-content .nav-tabs .nav-link:focus,
            .animated-underline-content .nav-tabs .nav-link:hover {
                border-color: transparent;
            }

            .animated-underline-content .nav-tabs .nav-link.active:before {
                -webkit-transform: scale(1);
                transform: scale(1);
            }

            .animated-underline-content .nav-tabs .nav-link:before {
                content: "";
                height: 1px;
                position: absolute;
                width: 100%;
                left: 0;
                bottom: 0;
                background-color: #5c1ac3;
                -webkit-transform: scale(0);
                transform: scale(0);
                transition: all .3s;
            }



            .justify-tab .nav-tabs li a {
                color: #3b3f5c;
            }

            .justify-tab .nav-tabs .nav-item.show .nav-link,
            .justify-tab .nav-tabs .nav-link.active {
                color: #1b55e2;
                background-color: #fff;
                border-color: #e0e6ed #e0e6ed #fff;
            }

            .justify-tab .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }




            .justify-pill .nav-pills li a {
                color: #3b3f5c;
            }

            .justify-pill .nav-pills .nav-link.active,
            .justify-pill .nav-pills .show>.nav-link {
                background-color: #2196f3;
                border-color: transparent;
            }

            .justify-pill .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .tab-justify-centered .nav-tabs li a {
                color: #3b3f5c;
            }

            .tab-justify-centered .nav-tabs .nav-item.show .nav-link,
            .tab-justify-centered .nav-tabs .nav-link.active {
                color: #e95f2b;
                background-color: #fff;
                border-color: #e0e6ed #e0e6ed #fff;
            }

            .tab-justify-centered .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .pill-justify-centered .nav-pills li a {
                color: #3b3f5c;
            }

            .pill-justify-centered .nav-pills .nav-link.active,
            .pill-justify-centered .nav-pills .show>.nav-link {
                background-color: #e2a03f;
            }

            .pill-justify-centered .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .tab-justify-right .nav-tabs li a {
                color: #3b3f5c;
            }

            .tab-justify-right .nav-tabs .nav-item.show .nav-link,
            .tab-justify-right .nav-tabs .nav-link.active {
                color: #1b55e2;
                background-color: #fff;
                border-color: #e0e6ed #e0e6ed #fff;
            }

            .tab-justify-right .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }




            .pill-justify-right .nav-pills .nav-link.active,
            .pill-justify-right .nav-pills .show>.nav-link {
                background-color: #2196f3;
            }

            .pill-justify-right .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .rounded-pills-icon .nav-pills li a {
                -webkit-border-radius: 0.625rem !important;
                -moz-border-radius: 0.625rem !important;
                -ms-border-radius: 0.625rem !important;
                -o-border-radius: 0.625rem !important;
                border-radius: 0.625rem !important;
                background-color: #f1f2f3;
                width: 100px;
                padding: 8px;
            }

            .rounded-pills-icon .nav-pills li a svg {
                display: block;
                text-align: center;
                margin-bottom: 10px;
                margin-top: 5px;
                margin-left: auto;
                margin-right: auto;
            }

            .rounded-pills-icon .nav-pills .nav-link.active,
            .rounded-pills-icon .nav-pills .show>.nav-link {
                box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
                background-color: #009688;
            }

            .rounded-pills-icon .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }


            .rounded-vertical-pills-icon .nav-pills a {
                -webkit-border-radius: 0.625rem !important;
                -moz-border-radius: 0.625rem !important;
                -ms-border-radius: 0.625rem !important;
                -o-border-radius: 0.625rem !important;
                border-radius: 0.625rem !important;
                background-color: #ffffff;
                border: solid 1px #e4e2e2;
                padding: 11px 23px;
                text-align: center;
                width: 100px;
                padding: 8px;
            }

            .rounded-vertical-pills-icon .nav-pills a svg {
                display: block;
                text-align: center;
                margin-bottom: 10px;
                margin-top: 5px;
                margin-left: auto;
                margin-right: auto;
            }

            .rounded-vertical-pills-icon .nav-pills .nav-link.active,
            .rounded-vertical-pills-icon .nav-pills .show>.nav-link {
                box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
                background-color: #009688;
                border-color: transparent;

            }




            .rounded-circle-pills-icon .nav-pills li a {
                background-color: #f1f2f3;
                padding: 20px 20px;
            }

            .rounded-circle-pills-icon .nav-pills li a svg {
                display: block;
                text-align: center;
            }

            .rounded-circle-pills-icon .nav-pills .nav-link.active,
            .rounded-circle-pills-icon .nav-pills .show>.nav-link {
                box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
                background-color: #2196f3;
            }

            .rounded-circle-pills-icon .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }



            .rounded-circle-vertical-pills-icon .nav-pills a {
                background-color: #ffffff;
                border: solid 1px #e4e2e2;
                border-radius: 50%;
                height: 58px;
                width: 60px;
                padding: 16px 18px;
                max-width: 80px;
                min-width: auto
            }

            .rounded-circle-vertical-pills-icon .nav-pills a svg {
                display: block;
                text-align: center;
                line-height: 19px;
            }

            .rounded-circle-vertical-pills-icon .nav-pills .nav-link.active,
            .rounded-circle-vertical-pills-icon .nav-pills .show>.nav-link {
                box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
                background-color: #2196f3;
                border-color: transparent;
            }



            .vertical-pill .nav-pills .nav-link.active,
            .vertical-pill .nav-pills .show>.nav-link {
                background-color: #009688;
            }


            .vertical-pill-right .nav-pills .nav-link.active,
            .vertical-pill-right .nav-pills .show>.nav-link {
                background-color: #009688;
            }



            .vertical-line-pill .nav-pills {
                border-bottom: 1px solid transparent;
                width: 92px;
                border-right: 1px solid #e0e6ed;
            }

            .vertical-line-pill .nav-pills a {
                padding-top: 15px;
                padding-bottom: 15px;
                position: relative;
            }

            .vertical-line-pill .nav-pills .nav-link {
                padding: .5rem 0;
            }

            .vertical-line-pill .nav-pills .nav-link.active,
            .vertical-line-pill .nav-pills .show>.nav-link {
                position: relative;
                background-color: transparent;
                border-color: transparent;
                color: #5c1ac3;
                font-weight: 600;
            }

            .vertical-line-pill .nav-pills .nav-link:focus,
            .vertical-line-pill .nav-pills .nav-link:hover {
                border-color: transparent;
            }

            .vertical-line-pill .nav-pills .nav-link.active:before {
                -webkit-transform: scale(1);
                transform: scale(1);
                bottom: 0;
            }

            .vertical-line-pill .nav-pills .nav-link:before {
                content: "";
                height: 100%;
                position: absolute;
                width: 1px;
                right: -1px;
                background-color: #5c1ac3;
                -webkit-transform: scale(0);
                transform: scale(0);
                transition: all .3s;
            }

            .vertical-line-pill #v-line-pills-tabContent h4 {
                color: #e2a03f;
            }

            .vertical-line-pill #v-line-pills-tabContent p {
                color: #888ea8;
            }

            .media img {
                border-radius: 50%;
                border: solid 5px #ebedf2;
                width: 80px;
                height: 80px;
            }



            .border-tab .tab-content {
                border: 1px solid #e0e6ed;
                border-top: none;
                padding: 10px;
            }

            .border-tab .tab-content>.tab-pane {
                padding: 20px 30px 0 30px
            }

            .border-tab .tab-content .media img.meta-usr-img {
                margin-left: -30px;
            }



            .vertical-border-pill .nav-pills {
                width: 92px;
            }

            .vertical-border-pill .nav-pills a {
                padding-top: 15px;
                padding-bottom: 15px;
                position: relative;
            }

            .vertical-border-pill .nav-pills .nav-link {
                padding: .5rem 0;
                border: 1px solid #e0e6ed;
                border-radius: 0;
                border-bottom: none;
            }

            .vertical-border-pill .nav-pills .nav-link:last-child {
                border-bottom: 1px solid #e0e6ed;
            }

            .vertical-border-pill .nav-pills .nav-link.active,
            .vertical-border-pill .nav-pills .show>.nav-link {
                position: relative;
                color: #fff;
                background-color: #8dbf42;
            }



            .border-top-tab .nav-tabs {
                border-bottom: 1px solid transparent;
            }

            .border-top-tab .nav-tabs li a {
                border-radius: 0px;
                padding: 12px 30px;
                background: #f6f7f8;
                color: #0e1726;
                border-right: 1px solid transparent;
            }

            .border-top-tab .tab-content>.tab-pane {
                padding: 20px 0 0 0;
            }

            .border-top-tab .nav-tabs .nav-item.show .nav-link,
            .border-top-tab .nav-tabs .nav-link.active {
                color: #495057;
                border-radius: 0px;
                padding: 12px 30px;
                background: #f6f7f8;
                color: #5c1ac3;
                border: 1px solid transparent;
                border-top: 2px solid #5c1ac3;
            }

            .border-top-tab .nav-tabs .nav-link:focus,
            .border-top-tab .nav-tabs .nav-link:hover {
                border: 1px solid transparent;
                border-top: 2px solid #5c1ac3;
            }
        </style>
    @endslot
@endcomponent
