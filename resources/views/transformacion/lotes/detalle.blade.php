@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row">
                    <div class="col-sm-12 col-12" style="display: none">
                        <p><strong> SUBTRANSFORMACIÓN N° {{ model . nro }} de {{ model . mes }}</strong> </p>
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered m-0">
                                            <thead>
                                                <th><strong>Cajas</strong> </th>
                                                <th><strong>Pollos</strong> </th>
                                                <th><strong>Peso Bruto</strong> </th>
                                                <th><strong>Tara</strong> </th>
                                                <th><strong>Peso Neto</strong> </th>
                                            </thead>
                                            <tbody>

                                                <tr class="bg-primary ">
                                                    <td class="text-white">{{ model . cajas_disponibles }}</td>
                                                    <td class="text-white">{{ model . pollos_disponibles }}</td>
                                                    <td class="text-white">{{ Number(model . peso_bruto_disponibles) . toFixed(3) }}
                                                    </td>
                                                    <td class="text-white">
                                                        {{ Number(model . cajas_disponibles > 0 ? model . cajas_disponibles * 2 : 0) . toFixed(3) }}
                                                    </td>
                                                    <td class="text-white">{{ Number(model . peso_neto_disponibles) . toFixed(3) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="card bg-light-primary">
                            <div class="card-body">
                                <div class="row widget-content widget-content-area border-tab px-2 bg-light-warning">
                                    <div class="col-12">
                                        <h3>
                                            SUBTRANSFORMACIÓN N° {{ model . nro }} de {{ model . mes }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing" v-if="enviarItemPtTransformacions.length>0">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area border-tab px-2">
                                <div class="d-flex justify-content-between">
                                    <h4>ITEMS ENVIADOS DESDE PT</h4>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area border-tab p-0">
                                                <table class="table table-bordered m-0 text-center">
                                                    <thead>
                                                        <th>PT N°</th>
                                                        <th>ITEM</th>
                                                        <th>CAJAS</th>
                                                        <th>PESO BRUTO</th>
                                                        <th>TARA</th>
                                                        <th>PESO NETO</th>
                                                        <th>ACCION</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in enviarItemPtTransformacions">
                                                            <td class="text-primary">PT-{{ item . pt . nro }}</td>
                                                            <td class="text-primary">{{ item . item . name }}</td>
                                                            <td class="text-primary">
                                                                {{ item . cajas }}
                                                            </td>
                                                            <td class="text-primary">
                                                                {{ Number(item . peso_bruto) . toFixed(3) }}
                                                            </td>
                                                            <td class="text-primary">
                                                                {{ Number(item . peso_bruto - item . peso_neto) . toFixed(3) }}
                                                            </td>
                                                            <td class="text-primary">
                                                                {{ Number(item . peso_neto) . toFixed(3) }}
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-warning w-100"
                                                                    @click="AceptarItem(item)">ACEPTAR</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot class="bg-primary text-white">
                                                        <tr>
                                                            <td style="font-weight: bold" colspan="2">TOTAL</td>
                                                            <td style="font-weight: bold">
                                                                {{ calcularTotalesEnviarItemPtTransformacion . suma_cajas }}</td>
                                                            <td style="font-weight: bold">
                                                                {{ Number(calcularTotalesEnviarItemPtTransformacion . suma_peso_bruto) . toFixed(3) }}
                                                            </td>
                                                            <td style="font-weight: bold">
                                                                {{ Number(calcularTotalesEnviarItemPtTransformacion . suma_tara) . toFixed(3) }}
                                                            </td>
                                                            <td style="font-weight: bold">
                                                                {{ Number(calcularTotalesEnviarItemPtTransformacion . suma_peso_neto) . toFixed(3) }}
                                                            </td>

                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing" v-if="item_sobras_trans.length>0">
                        <div class="statbox widget box box-shadow ">
                            <div class="widget-content widget-content-area border-tab px-2">
                                <div class="d-flex justify-content-between">
                                    <h4>Sobras de Items disponibles de Transformación</h4>
                                </div>
                                <div class="col-12" style="padding: 0px">
                                    <div class="alert alert-info">
                                        <strong>Info! Son el saldo sobrante de un anterior lote de Transformacion.</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area border-tab p-0">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <th>TRANS</th>
                                                        <th style="display: none">PT</th>
                                                        <th>ITEM</th>
                                                        <th>FECHA</th>
                                                        <th>CAJAS</th>
                                                        <th>PESO BRUTO</th>
                                                        <th>PESO NETO</th>
                                                        <th>ACCION</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in item_sobras_trans">
                                                            <td>TRANS-{{ item . transformacion_lote . nro }}</td>
                                                            <td style="display: none">PT-{{ item . pt . nro }}</td>
                                                            <td class="text-primary">{{ item . item . name }}</td>
                                                            <td class="text-primary">{{ item . fecha }}</td>
                                                            <td class="text-primary">
                                                                {{ item . cajas }}
                                                            </td>
                                                            <td class="text-primary">
                                                                {{ item . kgb }}
                                                            </td>
                                                            <td class="text-primary">
                                                                {{ item . kgn_nuevo }}
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-warning w-100"
                                                                    @click="AceptarSobraItem(item)">
                                                                    ACEPTAR
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot class="bg-primary text-white">
                                                        <tr>
                                                            <td colspan="3" style="font-weight: bold">TOTAL</td>
                                                            <td style="font-weight: bold">
                                                                {{ calcularTotalesSobrasAceptar . suma_cajas }}</td>
                                                            <td style="font-weight: bold">
                                                                {{ Number(calcularTotalesSobrasAceptar . suma_peso_bruto) . toFixed(3) }}
                                                            </td>
                                                            <td style="font-weight: bold">
                                                                {{ Number(calcularTotalesSobrasAceptar . suma_peso_neto) . toFixed(3) }}
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p v-if="pp_envio_transformacion_detalle.length" class="mt-4" style="display: none"> <strong>TRASPASOS
                            DISPONIBLES DE
                            PP</strong> </p>
                    <div class="card" v-if="pp_envio_transformacion_detalle.length" style="display: none">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered m-0">
                                        <thead>
                                            <th>PP N°</th>
                                            <th>Cajas</th>
                                            <th>Pollos</th>
                                            <th>Peso Bruto</th>
                                            <th>Tara</th>
                                            <th>Peso Neto</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <template v-for="m in pp_envio_transformacion_detalle">
                                                <tr>
                                                    <td class="text-primary">{{ m . pp . nro }}</td>
                                                    <td class="text-primary">
                                                        <input type="text" :value="m.cajas" class="form-control" readonly>
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" :value="m.pollos" class="form-control" readonly>
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" :value="Number(m.peso_bruto).toFixed(3)"
                                                            class="form-control" readonly>
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text"
                                                            :value="Number(m.cajas > 0 ? (m.cajas * 2) : 0).toFixed(3)"
                                                            class="form-control" readonly>
                                                    </td>
                                                    <td class="text-primary">
                                                        <input type="text" :value="Number(m.peso_neto).toFixed(3)"
                                                            class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success w-100 mt-2" @click="traspasoAceptar(m)">
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
                    <div class="col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area border-tab px-2 bg-light-primary">
                            <div class="alert alert-info" v-if="model.lista_subitems_transformacion.length>0">
                                <div>
                                    <strong>Info! ITEMS PT DISPONIBLES PARA TRANSFORMACION.</strong>
                                </div>
                            </div>
                            <div class="card" v-if="model.list_items_pt.length">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <table class="table table-bordered m-0 text-center">
                                                        <thead>
                                                            <th>PT N°</th>
                                                            <th>ITEM</th>
                                                            <th>CAJAS</th>
                                                            <th>PESO BRUTO</th>
                                                            <th>TARA</th>
                                                            <th>PESO NETO</th>
                                                        </thead>
                                                        <tbody>
                                                            <template v-for="m in model.list_items_pt">
                                                                <tr>
                                                                    <td class="text-primary">PT-{{ m . pt . nro }}</td>
                                                                    <td class="text-primary">{{ m . item . name }}</td>
                                                                    <td class="text-primary">
                                                                        <input type="text" :value="Number(m.cajas).toFixed(3)"
                                                                            class="form-control" readonly>
                                                                    </td>
                                                                    <td class="text-primary">
                                                                        <input type="text"
                                                                            :value="Number(m.peso_bruto).toFixed(3)"
                                                                            class="form-control" readonly>
                                                                    </td>
                                                                    <td class="text-primary">
                                                                        <input type="text" :value="Number(m.taras).toFixed(3)"
                                                                            class="form-control" readonly>
                                                                    </td>
                                                                    <td class="text-primary">
                                                                        <input type="text"
                                                                            :value="Number(m.peso_neto).toFixed(3)"
                                                                            class="form-control" readonly>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                        <tfoot class="bg-dark text-white">
                                                            <tr>
                                                                <td style="font-weight: bold" colspan="2">TOTAL</td>
                                                                <td style="font-weight: bold">
                                                                    {{ model . list_items_pt . reduce((a,b)=>a+Number(b . cajas),0) }}
                                                                </td>
                                                                <td style="font-weight: bold">
                                                                    {{ Number(model . list_items_pt . reduce((a,b)=>a+Number(b . peso_bruto),0)) . toFixed(3) }}
                                                                </td>
                                                                <td style="font-weight: bold">
                                                                    {{ Number(model . list_items_pt . reduce((a,b)=>a+Number(b . taras),0)) . toFixed(3) }}
                                                                </td>
                                                                <td style="font-weight: bold">
                                                                    {{ Number(model . list_items_pt . reduce((a,b)=>a+Number(b . peso_neto),0)) . toFixed(3) }}
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 layout-spacing">
                        <div class="card">
                            <div class="card-body bg-light-warning">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="alert alert-success" v-if="model.lista_subitems_transformacion.length>0">
                                            <div>
                                                <strong>Info! Stock Disponible para producción de subtransformaciones.</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Items</span>
                                            </div>
                                            <select name="" class="form-control" id=""
                                                v-model="item_pt_descomponer">
                                                <option disabled value="">-- Selecciona un ítem --</option>
                                                <template v-for="item in model.list_items_pt">
                                                    <option :value="item">PT-{{ item . pt . nro }}
                                                        {{ item . item . name }}
                                                    </option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Cajas Disponibles</span>
                                            </div>
                                            <input type="text" :value="item_pt_descomponer.cajas" disabled
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Peso Bruto Dis.</span>
                                            </div>
                                            <input type="text" :value="Number(item_pt_descomponer.peso_bruto).toFixed(3)"
                                                disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Peso Neto Dis.</span>
                                            </div>
                                            <input type="text" :value="Number(item_pt_descomponer.peso_neto).toFixed(3)"
                                                disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Cajas</span>
                                            </div>
                                            <input type="text" v-model="item_pt_des.cajas" class="form-control" @change="ChangeCajas">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Peso Bruto</span>
                                            </div>
                                            <input type="text" v-model="item_pt_des.peso_bruto" class="form-control"  @change="ChangePesoBruto">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Peso Neto</span>
                                            </div>
                                            <input type="text" v-model="item_pt_des.peso_neto" class="form-control" @change="ChangePesoNeto">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group input-group-sm ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Encargado</span>
                                            </div>
                                            <input type="text" v-model="item_pt_des.encargado" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <button class="btn btn-success w-100" @click="agregarItem" :disabled="!item_pt_descomponer.pt || !item_pt_descomponer.item || item_pt_descomponer.peso_bruto==0 || item_pt_descomponer.peso_neto==0">AGREGAR ITEM</button>
                                    </div>
                                    <div class="col-12 ">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <th>N°</th>
                                                <th>ITEM</th>
                                                <th>CAJAS</th>
                                                <th>PESO BRUTO</th>
                                                <th>TARA</th>
                                                <th>PESO NETO</th>
                                                <th>ENCARGADO</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <template v-for="(item,i) in items_pt_descomponer">
                                                    <tr>
                                                        <td>{{ item . pt . nro }}</td>
                                                        <td>{{ item . item . name }}</td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                :value="item.detalle.cajas" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                :value="Number(item.detalle.peso_bruto).toFixed(3)" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                :value="Number(item.detalle.tara).toFixed(3)" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                :value="Number(item.detalle.peso_neto).toFixed(3)" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                :value="item.detalle.encargado" disabled>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                @click="items_pt_descomponer.splice(i,1)">Eliminar</button>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                            <tfoot class="bg-primary text-white">
                                                <tr>
                                                    <td style="font-weight:bold" colspan="2">TOTAL</td>
                                                    <td style="font-weight:bold">{{ totales_items_pt_descomponer . cajas }}
                                                    </td>
                                                    <td style="font-weight:bold">
                                                        {{ Number(totales_items_pt_descomponer . peso_bruto) . toFixed(3) }}
                                                    </td>
                                                    <td style="font-weight:bold">
                                                        {{ Number(totales_items_pt_descomponer . tara) . toFixed(3) }}</td>
                                                    <td style="font-weight:bold">
                                                        {{ Number(totales_items_pt_descomponer . peso_neto) . toFixed(3) }}
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-warning w-100" @click="EntregarItemPt">ENTREGAR ITEMS</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <template v-for="m in list_items_pt">
                            <p class="mt-4"> <strong> PT-{{ m . pt . nro }} - {{ m . item . name }}</strong> </p>
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row m-0">
                                        <div class="col-8 p-0">
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <th>N°</th>
                                                    <th>USUARIO</th>
                                                    <th>FECHA</th>
                                                    <th>CAJAS</th>
                                                    <th>PESO BRUTO</th>
                                                    <th>TARA</th>
                                                    <th>PESO NETO</th>
                                                    <th>ENCARGADO</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(item,i) in m.entregados">
                                                        <tr v-if="item.is_declarado == 0">
                                                            <td>{{ i + 1 }}</td>
                                                            <td>{{ item . user . nombre }}</td>
                                                            <td>{{ item . fecha }}</td>
                                                            <td>
                                                                <input type="text" class="form-control" :value="item.cajas"
                                                                    disabled>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    :value="Number(item.peso_bruto).toFixed(3)" disabled>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    :value="Number(item.taras).toFixed(3)" disabled>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    :value="Number(item.peso_neto).toFixed(3)" disabled>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    :value="item.encargado" disabled>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-success"
                                                                        @click="addTranformacion(m,item)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-check">
                                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                    <button class="btn btn-danger" @click="cerrarEntregado(item)">
                                                                        X
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-4 p-0">
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <th>ITEM SUB PT</th>
                                                    <th>PESO BT TRANS</th>
                                                    <th>CAJAS</th>
                                                    <th>PESO NT TRANS</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(sub_item,i) in m.lista_trozados">
                                                        <td>
                                                            <select name="" class="form-control" id=""
                                                                v-model="sub_item.sub_item">
                                                                <template v-for="s_item in items_sucursals">
                                                                    <option v-if="s_item.tipo==3 || (s_item.tipo == 2 && s_item.name == 'MALTRATO')" :value="s_item">
                                                                        {{ s_item . name }}
                                                                    </option>
                                                                </template>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control"
                                                                    v-model.number="sub_item.pb_trans"
                                                                    @input="clampRow(m, i)"
                                                                    @blur="clampRow(m, i)">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                    v-model.number="sub_item.cajas_trans"
                                                                    @input="clampRow(m, i)"
                                                                    @blur="clampRow(m, i)">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                    v-model.number="sub_item.pn_trans"
                                                                    @input="clampRow(m, i)"
                                                                    @blur="clampRow(m, i)">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" @click="m.lista_trozados.splice(i,1)">
                                                                X
                                                            </button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                                <tfoot>

                                                </tfoot>

                                            </table>
                                            <div class="w-100 p-2">
                                               <button v-if="m.lista_trozados.length"
                                                        class="btn btn-primary w-100"
                                                        @click="declararTrozado(m)"
                                                        :disabled="!canDeclarar(m)">
                                                DECLARACION TROZADOR NT {{ m.total_nt_trozado }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="alert alert-info" v-if="model.lista_subitems_transformacion.length>0">
                            <div>
                                <strong>Info! SUBITEMS TRANSFORMADOS DISPONIBLES PARA LA VENTA.</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card" v-if="model.lista_subitems_transformacion.length">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered m-0">
                                            <thead>
                                                <th class="text-center" style="display: none">PT N°</th>
                                                <th class="text-center">SUB ITEM</th>
                                                <th class="text-center">CAJAS</th>
                                                <th class="text-center">PESO BRUTO</th>
                                                <th class="text-center">PESO NETO</th>
                                                <th class="text-center">PESO NETO NUEVO</th>
                                                <th class="text-center">MERMA</th>
                                            </thead>
                                            <tbody>
                                                <template v-for="m in model.lista_subitems_transformacion">
                                                    <tr>
                                                        <td class="text-primary" style="display: none">PT-{{ m . pt . nro }}
                                                        </td>
                                                        <td class="text-primary">{{ m . subitem . name }}</td>
                                                        <td class="text-primary">
                                                            <input type="text" :value="Number(m.total_cajas).toFixed(3)"
                                                                class="form-control" readonly>
                                                        </td>
                                                        <td class="text-primary">
                                                            <input type="text" :value="Number(m.total_peso_bruto).toFixed(3)"
                                                                class="form-control" readonly>
                                                        </td>
                                                        <td class="text-primary">
                                                            <input type="text" :value="Number(m.total_peso_neto).toFixed(3)"
                                                                class="form-control" readonly>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" v-model="m.peso_neto_nuevo"
                                                                :max="m.peso_neto" class="form-control" step="0.001"
                                                                min="0" placeholder="Nuevo Peso Neto"
                                                                @input="calcularMerma(m)" />
                                                        </td>
                                                        <td class="text-center">
                                                            {{ Number(m . merma) . toFixed(3) }}
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-dark text-white">
                                                    <td style="font-weight: bold">TOTAL</td>
                                                    <td style="font-weight: bold">
                                                        {{ model . lista_subitems_transformacion . reduce((a,b)=>a+Number(b . total_cajas),0) }}
                                                    </td>
                                                    <td style="font-weight: bold">
                                                        {{ Number(model . lista_subitems_transformacion . reduce((a,b)=>a+Number(b . total_peso_bruto),0)) . toFixed(3) }}
                                                    </td>
                                                    <td style="font-weight: bold">
                                                        {{ Number(model . lista_subitems_transformacion . reduce((a,b)=>a+Number(b . total_peso_neto),0)) . toFixed(3) }}
                                                    </td>
                                                    <td style="font-weight: bold">
                                                        {{ Number(model . lista_subitems_transformacion . reduce((a,b)=>a+Number(b . peso_neto_nuevo),0)) . toFixed(3) }}
                                                    </td>
                                                    <td style="font-weight: bold">
                                                        {{ Number(model . lista_subitems_transformacion . reduce((a,b)=>a+Number(b . merma),0)) . toFixed(3) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center" v-if="model.curso==1">
                        <button class="btn btn-warning btn-block w-100" @click="cerrarTransformacion">CERRAR SUBTRANSFORMACION</button>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing" v-if="model.curso==0">
                        <div class="alert alert-danger">
                            <div>
                                <strong>Info!</strong> Este lote de SubTransformacion ya fue cerrado.
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
                            detalle_pts: [],
                            pt_traspaso_pps: [],
                            pt_sobra_pps: [],
                            sub_items: [],
                            detalle_pts: [],
                            list_items_pt: [],
                            lista_subitems_transformacion: []
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
                        sub_descomponer: {
                            compo_externa: {
                                compo_externa_detalles: []
                            }
                        },
                        sub_descomponer_detalle: {
                            cantidad: 0,
                            compo_externa_detalle_id: '',
                            peso: 0,
                            equivale: 0
                        },
                        envio: {
                            cajas: 0,
                            cantidad: 0,
                            bruto: 0,
                            neto: 0,
                            merma_bruta: 0,
                            merma_neta: 0,

                        },
                        retiro_organo_general: '',
                        compo_internas: [],
                        compo_externas: [],
                        traspasos: [],
                        sobras: [],
                        items: [],
                        items_sobra: [],
                        descomponer: {
                            cajas: 0,
                            pollos: 0,
                            peso_bruto: 0,
                            peso_neto: 0,
                        },
                        item_pt_des: {
                            encargado: '',
                            cajas: 0,
                            peso_bruto: 0,
                            peso_neto: 0
                        },
                        item_pt_descomponer: {
                            cajas: 0,
                            peso_bruto: 0,
                            tara: 0,
                            peso_neto: 0
                        },
                        items_pt_descomponer: [],
                        item_select: {},
                        user: {},
                        sucursal: {},
                        item_sobras_pt: [],
                        items_sucursals: [],
                        pp_envio_transformacion_detalle: [],
                        enviarItemPtTransformacions: [],
                        item_descomoponer: null,
                        sub_transformacion_list: [],
                        item_sobras_trans: [],
                    }
                },
                computed: {
                    calcularTotalesSobrasAceptar() {
                        let suma_cajas = this.item_sobras_trans.reduce((a, b) => a + Number(b.cajas), 0)
                        let suma_peso_bruto = this.item_sobras_trans.reduce((a, b) => a + Number(b.kgb), 0)
                        let suma_peso_neto = this.item_sobras_trans.reduce((a, b) => a + Number(b.kgn_nuevo), 0)
                        return {
                            suma_cajas,
                            suma_peso_bruto,
                            suma_peso_neto
                        }
                    },
                    calcularTotalesEnviarItemPtTransformacion() {
                        let suma_cajas = this.enviarItemPtTransformacions.reduce((a, b) => a + Number(b.cajas), 0);
                        let suma_peso_bruto = this.enviarItemPtTransformacions.reduce((a, b) => a + Number(b
                            .peso_bruto), 0);
                        let suma_peso_neto = this.enviarItemPtTransformacions.reduce((a, b) => a + Number(b.peso_neto),
                            0);
                        let suma_tara = this.enviarItemPtTransformacions.reduce((a, b) => a + Number(b.peso_bruto - b
                            .peso_neto), 0); // Esto se calcula como la diferencia

                        return {
                            suma_cajas,
                            suma_peso_bruto,
                            suma_peso_neto,
                            suma_tara
                        }
                    },

                    totales_items_pt_descomponer() {
                        let cajas = this.items_pt_descomponer.reduce((a, b) => a + Number(b.detalle.cajas), 0)
                        let peso_bruto = this.items_pt_descomponer.reduce((a, b) => a + Number(b.detalle.peso_bruto), 0)
                        let tara = this.items_pt_descomponer.reduce((a, b) => a + Number(b.detalle.tara), 0)
                        let peso_neto = this.items_pt_descomponer.reduce((a, b) => a + Number(b.detalle.peso_neto), 0)

                        return {
                            cajas,
                            peso_bruto,
                            tara,
                            peso_neto
                        }
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
                    model_computed() {
                        return this.model.detalle_pts.map((v) => {
                            let lote = v
                            let lote_des = lote.detalle_pt_descomposicions.filter((v) => v.trozado == 1)
                            lote.peso_interna = lote_des.reduce((a, b) => a + Number(Number(b.compo_externa
                                .peso) * Number(b.cantidad)), 0)
                            lote.piezas_interna = lote_des.reduce((a, b) => a + Number(b.cantidad), 0)
                            return lote
                        })
                        // return []
                    },
                    // list_items_pt() {
                    //     return this.model.list_items_pt.map((v) => {
                    //         v.total_nt_trozado = v.lista_trozados.reduce((a, b) => a + Number(b.pn_trans), 0)
                    //         return v
                    //     })
                    // },

                    list_items_pt() {
                        return this.model.list_items_pt.map((v) => {
                            const suma = v.lista_trozados.reduce((a, b) => a + Number(b.pn_trans), 0);
                            v.total_nt_trozado = this.red(suma, 3);
                            return v;
                        });
                    },
                },
                methods: {
                    _erroresFilasBasicos(m) {
                        const errores = [];
                        (m.lista_trozados || []).forEach((row, idx) => {
                            const n = idx + 1;
                            const tieneSubItem = row?.sub_item && this._num(row.sub_item.id) > 0;
                            const pb = this._num(row.pb_trans);
                            const pn = this._num(row.pn_trans);

                            if (!tieneSubItem) {
                                errores.push(`Fila ${n}: debes seleccionar un ITEM SUB PT.`);
                            }
                            if (pb <= 0) {
                                errores.push(`Fila ${n}: el Peso Bruto debe ser > 0.`);
                            }
                            if (pn <= 0) {
                                errores.push(`Fila ${n}: el Peso Neto debe ser > 0.`);
                            }
                        });
                        return errores;
                    },
                    capUsadoPorEntregado(m, entregadoId, excludeIndex = null) {
                        const usado = { cajas: 0, pb: 0, pn: 0 };
                        m.lista_trozados.forEach((row, idx) => {
                            if (!row.item) return;
                            if (row.item.id === entregadoId && idx !== excludeIndex) {
                            usado.cajas += this._num(row.cajas_trans);
                            usado.pb    += this._num(row.pb_trans);
                            usado.pn    += this._num(row.pn_trans);
                            }
                        });
                        return usado;
                    },

                    _swErrOnce(key, msg, wait = 900) {
                        if (!this._lastWarnAt) this._lastWarnAt = {};
                        const now = Date.now();
                        const last = this._lastWarnAt[key] || 0;
                        if (now - last > wait) {
                            this._lastWarnAt[key] = now;
                            this._swErr(msg);
                        }
                    },

                    clampRow(m, i) {
                        const row = m.lista_trozados[i];
                        if (!row || !row.item) return;

                        const ent = row.item;

                        const e1 = this._fallaPorEntregado(m);
                        if (e1.length) {
                            this._swErrOnce(`clamp-${ent.id}-${i}`, e1.join(' '));
                        }

                        const usado = this.capUsadoPorEntregado(m, ent.id, i);
                        const cap = {
                            cajas: this._num(ent.cajas)      - usado.cajas,
                            pb:    this._num(ent.peso_bruto) - usado.pb,
                            pn:    this._num(ent.peso_neto)  - usado.pn,
                        };

                        //row.cajas_trans = Math.max(0, Math.min(Math.floor(this._num(row.cajas_trans)), Math.floor(cap.cajas)));
                        //row.pb_trans    = this.red(Math.max(0, Math.min(this._num(row.pb_trans), cap.pb)), 3);
                        row.pn_trans    = this.red(Math.max(0, Math.min(this._num(row.pn_trans), cap.pn)), 3);
                    },


                    _fallaPorEntregado(m) {
                        const errores = [];
                        const usados = new Map();
                        m.lista_trozados.forEach((row) => {
                            if (!row.item) return;
                            const id = row.item.id;
                            if (!usados.has(id)) usados.set(id, { cajas:0, pb:0, pn:0, ent: row.item });
                            const acc = usados.get(id);
                            acc.cajas += this._num(row.cajas_trans);
                            acc.pb    += this._num(row.pb_trans);
                            acc.pn    += this._num(row.pn_trans);
                        });
                        usados.forEach(({ cajas, pb, pn, ent }, id) => {
                            const capC = this._num(ent.cajas);
                            const capB = this._num(ent.peso_bruto);
                            const capN = this._num(ent.peso_neto);
                            //if (cajas > capC) errores.push(`Entregado #${id}: Cajas (${cajas}) > disponibles (${capC}).`);
                            // if (this._redondear(pb,3) > this._redondear(capB,3))
                            // errores.push(`Entregado #${id}: Peso bruto (${pb.toFixed(3)}) > disponible (${capB.toFixed(3)}).`);
                            if (this._redondear(pn,3) > this._redondear(capN,3))
                            errores.push(`Entregado #${id}: Peso neto (${pn.toFixed(3)}) > disponible (${capN.toFixed(3)}).`);
                        });
                        return errores;
                    },

                    _fallaGlobal(m) {
                        const sum = m.lista_trozados.reduce((a, r) => ({
                            cajas: a.cajas + this._num(r.cajas_trans),
                            pb:    a.pb    + this._num(r.pb_trans),
                            pn:    a.pn    + this._num(r.pn_trans),
                        }), {cajas:0, pb:0, pn:0});

                        const cap = {
                            cajas: this._num(m.cajas),
                            pb:    this._num(m.peso_bruto),
                            pn:    this._num(m.peso_neto),
                        };

                        const errores = [];
                        // if (sum.cajas > cap.cajas) errores.push(`Total cajas (${sum.cajas}) > saldo del ítem (${cap.cajas}).`);
                        // if (this._redondear(sum.pb,3) > this._redondear(cap.pb,3))
                        //     errores.push(`Total peso bruto (${sum.pb.toFixed(3)}) > saldo del ítem (${cap.pb.toFixed(3)}).`);
                        if (this._redondear(sum.pn,3) > this._redondear(cap.pn,3))
                            errores.push(`Total peso neto (${sum.pn.toFixed(3)}) > saldo del ítem (${cap.pn.toFixed(3)}).`);
                        return errores;
                    },

                    canDeclarar(m) {
                        const e1 = this._fallaPorEntregado(m);
                        const hayAlgo = m.lista_trozados.some(r =>
                            this._num(r.cajas_trans) > 0 ||
                            this._num(r.pb_trans)    > 0 ||
                            this._num(r.pn_trans)    > 0
                        );
                        return e1.length === 0 && hayAlgo;
                    },

                    red(n, p = 3) {
                        const f = Math.pow(10, p);
                        return Math.round((Number(n) + Number.EPSILON) * f) / f;
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
                            title: 'Error',
                            text: msg,
                            type: 'error',
                            confirmButtonText: 'Entendido',
                            padding: '2em'
                        });
                    },

                    _excesoMensaje() {
                        const t = this.TotalesGruposItems;
                        const s = this.total_detalle;

                        const tBruto = Number(t.suma_peso_bruto);
                        const tNeto = Number(t.suma_peso_neto);

                        let errores = [];

                        if (t.suma_cajas > s.cajas) errores.push(`Cajas (${t.suma_cajas}) > disponibles (${s.cajas}).`);
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

                    _redondear(n, p = 3) {
                        const f = Math.pow(10, p);
                        return Math.round((Number(n) + Number.EPSILON) * f) / f;
                    },


                    excedeStock() {
                        const errores = this._excesoMensaje();
                        if (errores.length) {
                            this._swErr(errores.join(' '));
                            return true;
                        }
                        return false;
                    },

                    async AceptarSobraItem(m) {
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
                                let data = {
                                    ...m
                                }
                                data.trans_id = this.model.id
                                data.user_id = this.user.id
                                data.sucursal_id = this.sucursal.id
                                data.user_nombre = this.user.nombre
                                let res = await axios.post(
                                    "{{ url('api/sobras-trans-item/aceptar') }}/" + m.id, data)
                                await this.load()
                                block.unblock();
                                const swalWithBootstrapButtons = swal.mixin({
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                    buttonsStyling: false,
                                })
                                swalWithBootstrapButtons({
                                    title: 'Aceptado!',

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
                                    text: 'Ocurrió un problema al procesar el traspaso.',
                                    type: 'error',
                                    confirmButtonText: 'Entendido',
                                    confirmButtonClass: 'btn btn-danger btn-rounded',
                                })
                            }
                        })
                    },

                    actualizarPesoNeto() {
                        this.model.lista_subitems_transformacion.forEach(item => {
                            item.peso_neto_nuevo = parseFloat(item.total_peso_neto.toFixed(3));
                            this.calcularMerma(item);
                        });
                    },
                    calcularMerma(item) {
                        const kgnNuevo = Number(item.peso_neto_nuevo);
                        const kgnOriginal = Number(item.total_peso_neto);
                        if (isNaN(kgnOriginal) || isNaN(kgnNuevo) || kgnNuevo < 0 || kgnNuevo > kgnOriginal) {
                            swal("Error",
                                "Por favor, ingresa valores numéricos válidos y asegura que el nuevo peso neto no sea mayor al peso neto original",
                                "warning");
                            item.peso_neto_nuevo = parseFloat(kgnOriginal.toFixed(3));
                            item.merma = 0;
                            return;
                        }
                        item.merma = parseFloat((kgnOriginal - kgnNuevo).toFixed(3));
                    },
                    async cerrarTransformacion() {
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
                            confirmButtonText: 'Cerrar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (!result.value) return;
                            try {
                                block.block();
                                let res = await axios.post(
                                    "{{ url('api/transformacionLotes-cerrar') }}/" + this.model
                                    .id, {
                                        lista_subitems_transformacion: this.model
                                            .lista_subitems_transformacion,
                                        user_id: this.user.id
                                    });
                                block.unblock();
                                const swalWithBootstrapButtons = swal.mixin({
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                    buttonsStyling: false,
                                })
                                swalWithBootstrapButtons({
                                    title: 'Cerrado!',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok!',
                                    reverseButtons: true,
                                    padding: '2em'
                                })
                                location.href = "{{ url('transformacion/lotes') }}";
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
                    async cerrarEntregado(m) {
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
                            confirmButtonText: 'Cerrar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (!result.value) return;
                                try {
                                    block.block();
                                    console.log(m)
                                    let res = await axios.post("{{ url('api/itemPtTransformacionLotes-cerrar') }}/" + m.id,
                                        m)
                                    await this.load()
                                    block.unblock();
                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })
                                    swalWithBootstrapButtons({
                                        title: 'Cerrado Item!',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok!',
                                        reverseButtons: true,
                                        padding: '2em'
                                    })

                                } catch (e) {
                                    block.unblock();
                                }
                        })
                    },
                    async cerrarItems(m) {
                        try {
                            let data = {
                                pt: m.pt,
                                item: m.item
                            }
                            console.log(m)
                            let res = await axios.post("{{ url('api/transformacionLotes-cerraritem') }}/" + this
                                .model.id, data)
                            await this.load()
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Cerrado!',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                        } catch (e) {

                        }
                    },
                    async declararTrozado(m) {
                        const e0 = this._erroresFilasBasicos(m);
                        if (e0.length) {
                            this._swErr(e0.join(' '));
                            return;
                        }

                        const e1 = this._fallaPorEntregado(m);
                        if (e1.length) {
                            this._swErr(e1.join(' '));
                            return;
                        }

                        if(m.total_nt_trozado <= 0 || m.total_nt_trozado == null){
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'El peso neto no puede ser 0!',
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                            return;
                        }
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
                            confirmButtonText: 'Transformar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                block.block();
                                try {
                                    let data = {
                                        transformacion_lote_id: this.model.id,
                                        sucursal_id: this.sucursal.id,
                                        user_id: this.user.id,
                                        items: m
                                    }
                                    let res = await axios.post("{{ url('api/subItemPtTransformacionLotes') }}", data)


                                    await this.load()

                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })
                                    swalWithBootstrapButtons({
                                        title: 'Trozado Declarado!',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok!',
                                        reverseButtons: true,
                                        padding: '2em'
                                    })
                                    block.unblock();
                                } catch (e) {} finally {
                                    block.unblock();

                                    this.items_pt_descomponer = []
                                }
                            }
                        })
                    },
                    addTranformacion(m, item) {
                        let sub = {}
                        sub.item = {
                            ...item
                        }
                        sub.cajas_trans = 0
                        sub.pb_trans = 0
                        sub.pn_trans = 0
                        sub.sub_item = {}
                        m.lista_trozados.push(sub)
                    },
                    async EntregarItemPt() {
                        if (this.items_pt_descomponer.length == 0) {
                            swal("Error", "Por favor, agregue al menos un ítem antes de continuar.", "warning");
                            return;
                        }
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
                                try {
                                    block.block();
                                    let data = {
                                        transformacion_lote_id: this.model.id,
                                        sucursal_id: this.sucursal.id,
                                        user_id: this.user.id,
                                        items: this.items_pt_descomponer
                                    }
                                    let res = await axios.post("{{ url('api/itemPtTransformacionLotes') }}", data)
                                    await this.load()
                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })
                                    swalWithBootstrapButtons({
                                        title: 'Entregado!',

                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok!',

                                        reverseButtons: true,
                                        padding: '2em'
                                    })
                                } catch (e) {} finally {
                                    block.unblock();
                                    this.items_pt_descomponer = [];
                                    this.item_pt_des= {
                                        encargado: '',
                                        cajas: 0,
                                        peso_bruto: 0,
                                        peso_neto: 0
                                    };
                                    this.item_pt_descomponer = {
                                        cajas: 0,
                                        peso_bruto: 0,
                                        tara: 0,
                                        peso_neto: 0
                                    };
                                }
                            }
                        })
                    },
                    agregarItem() {
                        if (this.item_pt_des.encargado == '' || this.item_pt_des.cajas < 0 || this.item_pt_des
                            .peso_bruto <= 0 || this.item_pt_des.peso_neto <= 0) {
                            swal("Error", "Por favor, complete todos los campos antes de agregar el ítem.",
                                "warning");
                            return;
                        }
                        let item = {
                            ...this.item_pt_descomponer
                        }
                        item.detalle = {
                            ...this.item_pt_des
                        }
                        item.detalle.tara = Number(item.detalle.cajas * 2).toFixed(2)
                        this.items_pt_descomponer.push(item)
                    },
                    async descomponerPt() {
                        try {
                            let descomponer = {
                                items_sobra: this.items_sobra,
                                sucursal_id: this.sucursal.id,
                                user_id: this.user.id,
                                transformacion_lote_id: this.model.id
                            }

                            let res = await axios.post("{{ url('api/descomponerTransformacionLotes') }}",
                                descomponer)
                            await this.load()

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
                            this.items_sobra = []
                            this.descomponer = {
                                cajas: 0,
                                pollos: 0,
                                peso_bruto: 0,
                                peso_neto: 0,
                            }
                        } catch (e) {

                        }

                    },

                    ChangeCajas() {
                        let cajas = Number(this.item_pt_des.cajas)
                        // if (cajas > this.item_pt_descomponer.cajas) {
                        //     swal("Error", "No puedes descomponer más cajas de las disponibles.", "warning");
                        //     this.item_pt_des.cajas = this.item_pt_descomponer.cajas;
                        //     this.ChangeCajas();
                        //     return;
                        // }
                        if (!Number.isInteger(cajas)) {
                            swal("Error", "Solo se permiten números enteros en el campo cajas", "warning");
                            this.item_pt_des.cajas = Number.isFinite(cajas) ? Math.trunc(cajas) : 0;
                            return;
                        }
                    },

                    ChangePesoBruto() {
                        let peso_bruto = Number(Number(this.item_pt_des.peso_bruto).toFixed(3));
                        if (peso_bruto > Number(this.item_pt_descomponer.peso_bruto)) {
                            swal("Error", "No puedes descomponer más peso de los disponibles.", "warning");
                            this.item_pt_des.peso_bruto = Number(this.item_pt_descomponer.peso_bruto).toFixed(3);
                        }
                    },

                    ChangePesoNeto() {
                        let peso_neto = Number(Number(this.item_pt_des.peso_neto).toFixed(3));
                        if (peso_neto > Number(this.item_pt_descomponer.peso_neto)) {
                            swal("Error", "No puedes descomponer más peso de los disponibles.", "warning");
                            this.item_pt_des.peso_neto = Number(this.item_pt_descomponer.peso_neto).toFixed(3);
                        }
                    },

                    AddItem() {
                        let item = this.items_sucursals.find((v) => v.id == this.item_select)
                        if (item) {
                            this.items_sobra.push({
                                ...item,
                                cajas: this.descomponer.cajas,
                                peso_bruto: this.descomponer.peso_bruto,
                                peso_neto: this.descomponer.peso_neto,
                                taras: 0,
                                item_descomoponer: this.item_descomoponer,
                                recep: ''
                            })
                        }
                    },
                    async DescomponerSubDetalle() {
                        try {
                            let self = this
                            let data = {
                                ...this.sub_descomponer_detalle
                            }
                            data.sub_descomponer = this.sub_descomponer

                            let res = await axios.post("{{ url('api/subDesDetallePts') }}", data)
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
                            window.open(res.data.url_pdf, '_blank');
                            await this.load()
                        } catch (e) {

                        }
                    },
                    SubDesPtDetalle(item) {
                        this.sub_descomponer = {
                            ...item
                        }

                        this.sub_descomponer.cantidad_total = this.sub_descomponer.disponible
                    },
                    DisponibleDescomposicion(item) {
                        let disponible = item.sub_des_detalle_pts.reduce((a, b) => a + Number(b.cantidad), 0)
                        // let disponible =0
                        item.disponible = Number(item.compo_externa.cantidad * item.cantidad) - Number(disponible)
                        return item.disponible
                    },
                    async traspasoAceptar(m) {
                        try {
                            // let res = await axios.post(, this.model)
                            let data = {
                                ...m,
                                transformacion_lote_id: this.model.id,
                                user_id: this.user.id,
                                sucursal_id: this.sucursal.id,
                            }
                            data.pt_nuevo_id = this.model.id
                            let url = "{{ url('api/ppEnvioTransformaciones-aceptar') }}/" + m.id;
                            let res = await axios.post(url, data)
                            await this.load()
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Aceptado!',

                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',

                                reverseButtons: true,
                                padding: '2em'
                            })
                        } catch (e) {

                        }
                    },
                    async AceptarSobra(m) {
                        try {
                            // let res = await axios.post(, this.model)
                            let data = {
                                ...m
                            }
                            data.pt_nuevo_id = this.model.id
                            let url = "{{ url('api/sobras-pt/aceptar') }}/" + m.id;
                            let res = await axios.post(url, data)
                            await this.load()
                        } catch (e) {

                        }
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
                    async CerrarPt() {

                        try {
                            this.model.user_id = this.user.id
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/pts-cerrar') }}/{{ $id }}";
                            let res = axios.post(url, this.model)

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Cerrado!',
                                type: 'success',
                            }).then((result) => {
                                window.location.href = "{{ url('pt/lotes') }}"
                            })

                        } catch (e) {

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

                            try {
                                await Promise.all([
                                    self.GET_DATA(
                                        "{{ url('api/transformacionLotes/detalles') }}/{{ $id }}"
                                    ),
                                    self.GET_DATA("{{ url('api/ppEnvioTransformaciones-disponibles') }}"),
                                    self.GET_DATA("{{ url('api/enviarItemPtTransformacions') }}"),
                                    self.GET_DATA("{{ url('api/items-sucursal') }}/" + this.sucursal.id),
                                    self.GET_DATA("{{ url('api/item-sobras-trans') }}"),
                                ]).then((v) => {
                                    self.model = v[0]
                                    self.pp_envio_transformacion_detalle = v[1]
                                    self.enviarItemPtTransformacions = v[2]
                                    self.items_sucursals = v[3]
                                    self.item_sobras_trans = v[4]

                                })
                                this.actualizarPesoNeto();

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                    async EnviarPT() {
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
                                confirmButtonText: 'Trozar!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let pp_detalle = {
                                        ...item
                                    }
                                    pp_detalle.compo_externas = this.compo_externas
                                    let res = await axios.post(
                                        "{{ url('api/descomponer-detallepts') }}/" + pp_detalle.id,
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
                    async AceptarItem(item) {
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
                                confirmButtonText: 'Aceptar!',
                                cancelButtonText: 'No!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                block.block();
                                if (result.value) {
                                    let detalle = {
                                        ...item
                                    }
                                    detalle.transformacion_lote_id = this.model.id
                                    let res = await axios.put(
                                        "{{ url('api/enviarItemPtTransformacions') }}/" + item.id,
                                        detalle)
                                    await this.load()
                                    block.unblock();
                                }
                                block.unblock();
                            })
                        } catch (error) {
                            block.unblock();
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
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {
                            let user = localStorage.getItem('AppUser')
                            this.user = JSON.parse(user)
                            let sucursal = localStorage.getItem('AppSucursal')
                            this.sucursal = JSON.parse(sucursal)
                            await Promise.all([self.load()]).then((v) => {
                            })
                            this.actualizarPesoNeto();
                            dt.create()
                        } catch (e) {
                        } finally {
                            var ss = $(".basic").select2({
                                tags: true,
                            }).change((v) => {
                                self.item_select = v.target.value
                            })
                            block.unblock();
                        }
                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
    @slot('style')
        <style>
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
