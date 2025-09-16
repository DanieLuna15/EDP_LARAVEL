@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card bg-light-primary">
                <div class="card-body">
                    <div class="row widget-content widget-content-area border-tab px-2 bg-light-warning">
                        <div class="col-12">
                            <h3>
                                PT N° {{model.nro}} de {{model.mes}}
                            </h3>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-success" >
                                <strong>Info! Stock Disponible para producción PT.</strong>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cajas Disponibles</span>
                                </div>
                                <input type="text" :value="model.cajas_disponibles" disabled class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Pollos Disponibles</span>
                                </div>
                                <input type="text" :value="model.pollos_disponibles" disabled class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Bruto</span>
                                </div>
                                <input type="text" :value="Number(model.peso_bruto_disponibles).toFixed(3)" disabled class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Neto</span>
                                </div>
                                <input type="text" :value="Number(model.peso_neto_disponibles).toFixed(3)" disabled class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12">
            <div class="alert alert-info" v-if="model.detalle_pts.length>0">
                <div>
                    <strong>Info!</strong> En el siguiente recuadro se muestran los traspasos recepcionados de un lote de Compras.
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12 layout-spacing" v-if="model.detalle_pts.length>0">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab">
                    <div class="d-flex justify-content-between">
                        <h4>TRASPASOS ACEPTADOS (lotes)</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Cajas</th>
                                    <th>Pollos</th>
                                    <th>Peso Bruto</th>
                                    <th>Peso Neto</th>
                                    <th>Peso Bruto U</th>
                                    <th>Peso Neto U</th>
                                    <th style="display: none">Merma Bruta </th>
                                    <th style="display: none">Merma Neta </th>
                                </thead>
                                <tbody>
                                    <template v-for="m in model.detalle_pts">
                                        <tr>
                                            <td>{{m.cajas}}</td>
                                            <td>{{m.pollos}}</td>
                                            <td>{{m.peso_bruto}}</td>
                                            <td>{{m.peso_neto}}</td>
                                            <td>{{Number(m.peso_bruto/m.pollos).toFixed(3)}}</td>
                                            <td>{{Number(m.peso_neto/m.pollos).toFixed(3)}}</td>
                                            <td style="display: none">{{Number(m.merma_bruta).toFixed(3)}}</td>
                                            <td style="display: none">{{Number(m.merma_neta).toFixed(3)}}</td>
                                        </tr>
                                    </template>
                                    <tr class="bg-dark">
                                            <td class="text-white">{{calcularTotalesDetalle.suma_cajas}}</td>
                                            <td class="text-white">{{calcularTotalesDetalle.suma_pollos}}</td>
                                            <td class="text-white">{{Number(calcularTotalesDetalle.suma_peso_bruto).toFixed(3)}}</td>
                                            <td class="text-white">{{Number(calcularTotalesDetalle.suma_peso_neto).toFixed(3)}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12 layout-spacing" v-if="traspasos.some(m => m.tipo == 2)">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>Traspasos disponibles enviados desde pp</h4>
                    </div>
                     <div class="col-12" style="padding: 0px">
                            <div class="alert alert-info" >
                                <strong>Info!</strong> Son envios realizados desde un lote PP.
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>PP N°</th>
                                    <th>Cajas</th>
                                    <th>Pollos</th>
                                    <th>Peso Bruto</th>
                                    <th>Peso Neto</th>
                                    <th>Peso Bruto U</th>
                                    <th>Peso Neto U</th>
                                    <th>Merma Bruta </th>
                                    <th>Merma Neta </th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <template v-for="m in traspasos">
                                        <tr v-if="m.tipo==2">
                                            <td>{{m.pp.nro}}</td>
                                            <td>{{m.cajas}}</td>
                                            <td>{{m.pollos}}</td>
                                            <td>{{m.peso_bruto}}</td>
                                            <td>{{m.peso_neto}}</td>
                                            <td>{{Number(m.peso_bruto/m.pollos).toFixed(3)}}</td>
                                            <td>{{Number(m.peso_neto/m.pollos).toFixed(3)}}</td>
                                            <td>{{Number(m.merma_bruta).toFixed(3)}}</td>
                                            <td>{{Number(m.merma_neta).toFixed(3)}}</td>
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
        </div>

        <div class="col-lg-12 col-12 layout-spacing" v-if="item_sobras_pt.length>0">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab">
                    <div class="d-flex justify-content-between">
                        <h4>Sobras de Items disponibles de PT</h4>
                    </div>
                       <div class="col-12" style="padding: 0px">
                            <div class="alert alert-info" >
                                <strong>Info!</strong> Son el saldo sobrante de un anterior lote PT.
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12" >
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area border-tab p-0">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <th>PT N°</th>
                                            <th>ITEM</th>
                                            <th>FECHA</th>
                                            <th>CAJAS</th>
                                            <th>PESO BRUTO</th>
                                            <th>TARA</th>
                                            <th>PESO NETO</th>
                                            <th>ACCION</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in item_sobras_pt">
                                                <td>PT-{{item.pt.nro}}</td>
                                                <td>{{item.item.name}}</td>
                                                <td>{{item.fecha}}</td>
                                                <td>
                                                    {{item.cajas}}
                                                </td>
                                                <td>
                                                    {{item.kgb}}
                                                </td>
                                                <td>
                                                    {{item.taras}}
                                                </td>
                                                <td>
                                                    {{item.kgn_nuevo}}
                                                </td>
                                                <td class="text-center">
                                                <button class="btn btn-warning w-100" @click="AceptarSobraItem(item)">
                                                        ACEPTAR
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <t-foot>
                                            <tr class="bg-primary">
                                                <td class="text-white bg-dark" colspan="3">TOTALES</td>
                                                <td class="text-white">{{ item_sobras_pt.reduce((a,b)=>a  + Number(b.cajas),0) }}</td>
                                                <td class="text-white">{{ item_sobras_pt.reduce((a,b)=>a  + Number(b.kgb),0).toFixed(3) }}</td>
                                                <td class="text-white">{{ item_sobras_pt.reduce((a,b)=>a  + Number(b.taras),0).toFixed(3) }}</td>
                                                <td class="text-white">{{ item_sobras_pt.reduce((a,b)=>a  + Number(b.kgn_nuevo),0).toFixed(3) }}</td>
                                            </tr>
                                        </t-foot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-12 layout-spacing" v-if="sobras.length>0">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab">
                    <div class="d-flex justify-content-between">
                        <h4>Sobras disponibles de PP</h4>
                    </div>
                    <div class="col-12" style="padding: 0px">
                        <div class="alert alert-info" >
                            <strong>Info!</strong> Son el envio de sobras de un lote PP.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" v-for="m in sobras">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area border-tab p-0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>ITEM</th>
                                            <th>CAJAS</th>
                                            <th>PESO BRUTO</th>
                                            <th>TARA</th>
                                            <th>PESO NETO</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in m.sobra_detalle_pps">
                                                <td class="text-primary">{{item.item.name}}</td>
                                                <td class="text-primary">
                                                    {{item.cajas}}
                                                </td>
                                                <td class="text-primary">
                                                    {{item.peso_bruto}}
                                                </td>
                                                <td class="text-primary">
                                                    {{item.taras}}
                                                </td>
                                                <td class="text-primary">
                                                    {{item.peso_neto}}
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <button class="btn btn-warning w-100 mt-2" @click="AceptarSobra(m)">
                                        ACEPTAR SOBRA PP N°{{m.pp.nro}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body bg-light-warning">
                    <div class="row">
                        <div class="col-12">
                            <h5>Descomponer PT</h5>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cajas Descomponer</span>
                                </div>
                                <input type="text" v-model.number="descomponer.cajas" @change="ChangeCajas" disabed class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Pollos Descomponer</span>
                                </div>
                                <input type="text" v-model.number="descomponer.pollos" @change="ChangePollos" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Bruto</span>
                                </div>
                                <input type="text" v-model="descomponer.peso_bruto" @change="ChangePesoBruto" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Neto</span>
                                </div>
                                <input type="text" v-model="descomponer.peso_neto" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-danger" v-if="descomponer.cajas>model.cajas_disponibles||descomponer.peso_neto>model.peso_neto_disponibles||descomponer.peso_bruto>model.peso_bruto_disponibles">

                                <strong>Alerta!</strong> Las cajas a descomponer no puede exceder a las cajas totales del PT

                            </div>
                        </div>
                        <div class="col-12">
                            <label for="">Items</label>
                            <select class="form-control  basic">
                                <option value="" disabled selected>Seleccionar</option>
                                <option v-for="item in items" :value="item.id" >{{item.name}}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-info" >
                                <strong>Info!</strong> En este apartado puedes agregar varios items para la venta.
                            </div>
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
                                            <th>RECEP</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,i) in items_sobra">
                                                <td class="text-primary">{{item.name}}</td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model.number="item.cajas" @change="sobraCaja(item)">
                                                </td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model.number="item.peso_bruto" @change="sobraBruto(item)">
                                                </td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model.number="item.taras" @change="sobraNeto(item)" readonly>
                                                </td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model="item.peso_neto" disabled>
                                                </td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model="item.recep" >
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" @click="items_sobra.splice(i,1)">Eliminar</button>
                                                </td>

                                            </tr>

                                        </tbody>
                                        <tfoot v-if="items_sobra.length>0">
                                                <tr class="bg-primary text-white">
                                                    <td class="text-right">TOTALES</td>
                                                    <td class="text-center">{{ TotalesItemsDescomponer . suma_cajas }}</td>
                                                    <td class="text-center">{{ TotalesItemsDescomponer . suma_peso_bruto }}</td>
                                                    <td class="text-center">{{ TotalesItemsDescomponer . suma_taras }}</td>
                                                    <td class="text-center">{{ TotalesItemsDescomponer . suma_peso_neto }}</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>

                                    </table>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-warning w-100 mt-2" @click="descomponerPt" v-if="descomponer.cajas<=model.cajas_disponibles && descomponer.peso_neto<=model.peso_neto_disponibles&&descomponer.peso_bruto<=model.peso_bruto_disponibles"  :disabled="items_sobra.length === 0">
                                                DESCOMPONER
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab">
                    <div class="d-flex justify-content-between">
                        <h4>Items en PT</h4>
                    </div>

                    <div class="alert alert-success" v-if="model.items.length>0">
                        <strong>Info! En este apartado se visualizan los items disponibles para la venta.</strong>
                    </div>

                    <div class="alert alert-warning" v-if="model.items.length===0">
                        <strong>Alerta! No hay items disponibles para la venta.</strong>
                    </div>

                    <div class="row">
                        <div class="col-12" v-if="model.items.length>0">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area border-tab p-0">

                                    <table class="table table-bordered">
                                        <thead>
                                            <th class="text-center">ITEM</th>
                                            <th class="text-center">CAJAS</th>
                                            <th class="text-center">PESO BRUTO</th>
                                            <th class="text-center">TARA</th>
                                            <th class="text-center">PESO NETO</th>
                                            <th class="text-center">PESO NETO NUEVO</th>
                                            <th class="text-center">MERMA</th>
                                            <th class="text-center">ENVIAR</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in model.items">
                                                <td class="text-center">{{item.item.name}}</td>
                                                <td class="text-center">
                                                    {{item.cajas}}
                                                </td>
                                                <td class="text-center">
                                                    {{Number(item.peso_bruto).toFixed(3)}}
                                                </td>
                                                <td class="text-center">
                                                    {{Number(item.taras).toFixed(3)}}
                                                </td>
                                                <td class="text-center">
                                                    {{ Number(item.peso_neto).toFixed(3) }}
                                                </td>

                                                <td class="text-center">
                                                    <input
                                                        type="number"
                                                        v-model="item.peso_neto_nuevo"
                                                        :max="item.peso_neto"
                                                        class="form-control"
                                                        step="0.001"
                                                        min="0"
                                                        placeholder="Nuevo Peso Neto"
                                                        @input="calcularMerma(item)"
                                                    />
                                                </td>

                                                <td class="text-center">
                                                    {{ Number(item.merma).toFixed(3) }}
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success  w-50" data-toggle="modal" data-target="#enviarTransformacionModal"  @click="item_pt=item"> Enviar a SubTrans.</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-info text-center">
                                                <td  class="text-center">TOTAL</td>
                                                <td class="text-center">
                                                    {{Number(model.cajas_items)}}
                                                </td>
                                                <td class="text-center">
                                                    {{Number(model.peso_bruto_items).toFixed(3)}}
                                                </td>
                                                <td class="text-center">
                                                    {{Number(model.tara_items).toFixed(3)}}
                                                </td>
                                                <td class="text-center">
                                                    {{Number(model.peso_neto_items).toFixed(3)}}
                                                </td>
                                                <td class="text-white">
                                                    {{ model.items && model.items.length > 0 ? model.items.reduce((a, b) => a + Number(b.peso_neto_nuevo || 0), 0).toFixed(3) : '0.000' }}
                                                </td>
                                                <td class="text-white">
                                                    {{ model.items && model.items.length > 0 ? model.items.reduce((a, b) => a + Number(b.merma || 0), 0).toFixed(3) : '0.000' }}
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
        <div class="col-12 text-center" v-if="model.curso==1">
            <button class="btn btn-warning btn-block" @click="CerrarPt">FINALIZAR PT</button>
        </div>
        <div class="col-lg-12 col-12 layout-spacing" v-if="model.curso==0">
            <div class="alert alert-danger">
                <div>
                    <strong>Info!</strong> Este lote PT ya fue cerrado.
                </div>
            </div>
        </div>

        <div class="modal fade" id="enviarTransformacionModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">ENVIAR A SUBTRANSFORMACIÓN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">ITEM</label>
                                <input type="text" disabled :value="item_pt.item.name" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">CAJAS</label>
                                <input type="text"  v-model="item_pt_envio.cajas" class="form-control" @change="calcularCajas" placeholder="Cajas">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">PESO BRUTO</label>
                                <input type="text"  v-model="item_pt_envio.peso_bruto" class="form-control" @change="calcularPesoNeto" placeholder="Peso Bruto">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">PESO NETO</label>
                                <input type="text"  v-model="item_pt_envio.peso_neto" class="form-control" @change="actualizarNeto" placeholder="Peso Neto">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button @click="EnviarTransformacion()" type="button" data-dismiss="modal" class="btn btn-success">Guardar</button>
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
    import TableDate from "{{asset('config/dtdate.js')}}"
    import Block from "{{asset('config/block.js')}}"
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
                    items: [],
                    pt_traspaso_pps: [],
                    pt_sobra_pps: [],
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
                item_select: '',
                user:{},
                sucursal:{},
                item_sobras_pt:[],
                item_pt:{
                    item:{}
                },
                item_pt_envio:{
                    cajas:0,
                    peso_bruto:0,
                    peso_neto:0
                },
            }
        },
        computed: {
            lotes_desconpuestos() {
                // return this.model_computed.filter((v)=>v.descomponer == 1)
                return []
            },
            pp_detalle_descomposicions() {
                // return this.model_computed.flatMap((v)=>v.pp_detalle_descomposicions.filter((v)=>v.compo_interna_id==this.retiro_organo_general && v.trozado==1))
                return []
            },
            url() {
                return "{{url('')}}"
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
                    lote.peso_interna = lote_des.reduce((a, b) => a + Number(Number(b.compo_externa.peso) * Number(b.cantidad)), 0)
                    lote.piezas_interna = lote_des.reduce((a, b) => a + Number(b.cantidad), 0)
                    return lote
                })
                // return []
            },
             calcularTotalesDetalle(){
                let detalles = this.model.detalle_pts
                let suma_cajas = detalles.reduce((a, b) => a + Number(b.cajas), 0);
                let suma_pollos = detalles.reduce((a, b) => a + Number(b.pollos), 0);
                let suma_peso_bruto = detalles.reduce((a, b) => a + Number(b.peso_bruto), 0);
                let suma_peso_neto = detalles.reduce((a, b) => a +Number( b.peso_neto), 0);
                return {
                    "suma_cajas":suma_cajas,
                    "suma_pollos":suma_pollos,
                    "suma_peso_bruto":suma_peso_bruto,
                    "suma_peso_neto":suma_peso_neto,
                }
            },

                TotalesItemsDescomponer() {
                        const safe = v => {
                            v = Number(v);
                            return (isNaN(v) || !isFinite(v)) ? 0 : v;
                        };

                        let suma_cajas = this.items_sobra.reduce((a, b) => a + Number(b.cajas), 0);
                        let suma_taras = this.items_sobra.reduce((a, b) => a + Number(b.taras), 0);
                        let suma_peso_bruto = this.items_sobra.reduce((a, b) => a + Number(b.peso_bruto), 0);
                        let suma_peso_neto = this.items_sobra.reduce((a, b) => a + Number(b.peso_neto), 0);
                        return {
                            "suma_cajas": suma_cajas,
                            "suma_taras": suma_taras,
                            "suma_peso_bruto": Number(suma_peso_bruto).toFixed(3),
                            "suma_peso_neto": Number(suma_peso_neto).toFixed(3),
                        }
                },
        },
        methods: {
            red(n, p = 3) {
                const f = Math.pow(10, p);
                return Math.round((Number(n) + Number.EPSILON) * f) / f;
            },
                    validateRecep() {
                        return this.items_sobra.every(item => item.recep && item.recep.trim() !== "");
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
                    excedeStock() {
                        const errores = this._excesoMensaje();
                        if (errores.length) {
                            this._swErr(errores.join(' '));
                            return true;
                        }
                        return false;
                    },
                    _excesoMensaje() {
                        const t = this.TotalesItemsDescomponer;

                        const tBruto = Number(t.suma_peso_bruto);
                        const tNeto  = Number(t.suma_peso_neto);

                        const red = (n, p = 3) => {
                            const f = Math.pow(10, p);
                            return Math.round((Number(n) + Number.EPSILON) * f) / f;
                        };

                        let errores = [];
                        // if (t.suma_cajas > this.descomponer.cajas) {
                        //     errores.push(`Cajas (${t.suma_cajas}) > disponibles (${this.descomponer.cajas}).`);
                        // }
                        // if (red(tBruto,3) > red(this.descomponer.peso_bruto,3)) {
                        //     errores.push(`Peso bruto (${red(tBruto,3).toFixed(3)}) > disponible (${red(this.descomponer.peso_bruto,3).toFixed(3)}).`);
                        // }
                        if (red(tNeto,3) > red(this.descomponer.peso_neto,3)) {
                            errores.push(`Peso neto (${red(tNeto,3).toFixed(3)}) > disponible (${red(this.descomponer.peso_neto,3).toFixed(3)}).`);
                        }

                        return errores;
                    },


            actualizarPesoNeto() {
                this.model.items.forEach(item => {
                    item.peso_neto_nuevo = parseFloat(item.peso_neto.toFixed(3));
                    this.calcularMerma(item);
                });
            },
            red(n, p = 3) {
                const f = Math.pow(10, p);
                return Math.round((Number(n) + Number.EPSILON) * f) / f;
            },
           calcularMerma(item) {
                const kgnNuevo    = this.red(Number(item.peso_neto_nuevo), 3);
                const kgnOriginal = this.red(Number(item.peso_neto), 3);

                if (
                    isNaN(kgnOriginal) ||
                    isNaN(kgnNuevo) ||
                    kgnNuevo < 0 ||
                    kgnNuevo > kgnOriginal
                ) {
                    swal("Error", "Por favor, ingresa valores numéricos válidos y asegura que el nuevo peso neto no sea mayor al peso neto original", "warning");
                    item.peso_neto_nuevo = kgnOriginal;
                    item.merma = 0;
                    return;
                }

                item.merma = this.red(kgnOriginal - kgnNuevo, 3);
            },


            async descomponerPt() {
                let self = this
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success btn-rounded',
                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                    buttonsStyling: false,
                });

                if (!this.validateRecep()) {
                    swalWithBootstrapButtons({
                        title: 'Error',
                        text: 'Todos los campos de recepción deben ser completados.',
                        type: 'error',
                        confirmButtonText: 'Entendido',
                        padding: '2em'
                    });
                    return;
                }

                for (let item of this.items_sobra) {
                    if (item.peso_bruto <= 0 || item.peso_neto <= 0) {
                        swalWithBootstrapButtons({
                            title: 'Error',
                            text: 'El peso bruto y el peso neto de cada item deben ser mayores a 0.',
                            type: 'error',
                            confirmButtonText: 'Entendido',
                            padding: '2em'
                        });
                        return;
                    }
                }

                swalWithBootstrapButtons({
                    title: 'Estas seguro?',
                    text: "Este proceso es irreversible.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Descomponer!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        try {
                            if (this.excedeStock()) {
                                return;
                            }
                            block.block();
                            this.descomponer.pt_id = this.model.id
                            this.descomponer.items_sobra = this.items_sobra
                            let res = await axios.post("{{url('api/descomponerPts')}}", this.descomponer)
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
                            block.unblock();
                        } catch (e) {
                            block.unblock();
                            swalWithBootstrapButtons.fire({
                                title: 'Error!',
                                text: e.response.data.message || 'Ha ocurrido un error.',
                                type: 'error',
                                confirmButtonText: 'Ok!',
                                padding: '2em'
                            })
                        }
                    }
                })

            },

            sobraCaja(item) {
                if (!Number.isInteger(Number(item.cajas))) {
                                swal("Error", "Solo se permiten números enteros en el campo cajas", "warning");
                                item.cajas = Math.floor(Number(item.cajas) || 0);
                                item.taras = item.cajas * 2
                                Number(item.peso_bruto - item.taras).toFixed(3)
                                Number(item.peso_bruto - item.taras).toFixed(3)
                                return;
                            }
                item.taras = item.cajas * 2
                item.peso_neto = Number(item.peso_bruto - item.taras).toFixed(3)
                 item.peso_neto = Number(item.peso_bruto - item.taras).toFixed(3)
                        if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
            },
            sobraNeto(item) {
                item.peso_neto = Number(item.peso_bruto - item.taras).toFixed(3)
                if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
            },
            sobraBruto(item) {
                item.peso_neto = Number(item.peso_bruto - item.taras).toFixed(3)
                        if (this.excedeStock()) {
                            item.cajas = 0;
                            item.taras = 0;
                            item.peso_bruto = 0;
                            item.peso_neto = 0;
                        }
            },
            ChangeCajas() {
                const cajas = Number(this.descomponer.cajas);
                const red = (n, p = 3) => {
                    const f = Math.pow(10, p);
                    return Math.round((Number(n) + Number.EPSILON) * f) / f;
                };
                if (cajas > this.model.cajas_disponibles) {
                    swal("Error", "No puedes descomponer más cajas de las disponibles.", "warning");
                    this.descomponer.cajas = this.model.cajas_disponibles;
                    this.ChangeCajas();
                    return;
                }
                if (!Number.isInteger(cajas)) {
                    swal("Error", "Solo se permiten números enteros en el campo cajas", "warning");
                    this.descomponer.cajas = Number.isFinite(cajas) ? Math.trunc(cajas) : 0;
                    return;
                }
                this.descomponer.pollos = red(
                    Number(this.descomponer.cajas) * Number(this.model.pollos_x_caja),
                    0
                );

                this.descomponer.peso_neto = red(
                    Number(this.descomponer.pollos) * Number(this.model.peso_neto_x_unitario),
                    3
                );

                this.descomponer.peso_bruto = red(
                    Number(this.descomponer.pollos) * Number(this.model.peso_bruto_x_unitario),
                    3
                );
            },
            ChangePollos() {
             const pollos = Number(this.descomponer.pollos);
                if (!Number.isInteger(pollos)) {
                    swal("Error", "Solo se permiten números enteros en el campo pollos", "warning");
                    this.descomponer.pollos = Number.isFinite(pollos) ? Math.trunc(pollos) : 0;

                    return;
                }
                if (pollos > this.model.pollos_disponibles) {
                    swal("Error", "No puedes descomponer más pollos de las disponibles.", "warning");
                    this.descomponer.pollos = this.model.pollos_disponibles;
                    this.ChangePollos();
                    return;
                }

                this.descomponer.peso_neto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_neto_x_unitario)).toFixed(3)
                this.descomponer.peso_bruto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_bruto_x_unitario)).toFixed(3)
            },

            ChangePesoBruto() {
                const retraccion = 2;
                const cajas = Number.isFinite(+this.descomponer.cajas) ? Math.trunc(+this.descomponer.cajas) : 0;
                const bruto = +this.descomponer.peso_bruto || 0;
                const neto = bruto - (cajas * retraccion);

                if (bruto > this.model.peso_bruto_disponibles) {
                    swal("Error", "El peso bruto no puede superar el disponible.", "warning");
                    this.descomponer.peso_bruto = Number(this.model.peso_bruto_disponibles).toFixed(3);
                    this.ChangePesoBruto();
                    return;
                }

                this.descomponer.peso_neto = Number(Math.max(neto, 0).toFixed(3));
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
                        taras: 0,
                        recep:''
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

                    let res = await axios.post("{{url('api/subDesDetallePts')}}", data)
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
                            if (!result.value) {
                                return;
                            }
                            try {
                                // let res = await axios.post(, this.model)
                                let data = {
                                    ...m
                                }

                                data.pt_nuevo_id = this.model.id
                                let url = "{{url('api/traspasos-pt/aceptar')}}/" + m.id;
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
                })
            },
            async AceptarSobra(m) {

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
                                    data.pt_nuevo_id = this.model.id
                                    let url = "{{url('api/sobras-pt/aceptar')}}/" + m.id;
                                    let res = await axios.post(url, data)
                                    await this.load()
                                    block.unblock();
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
                        data.pt_id = this.model.id
                        data.user_id= this.user.id
                        data.user_nombre = this.user.nombre
                        let res = await axios.post("{{url('api/sobras-pt-item/aceptar')}}/"+m.id , data)
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
            CambioPeso() {
                this.envio.bruto = Number(this.detalle_envio_pt.peso_bruto_actual * this.envio.cantidad).toFixed(3)
                this.envio.neto = Number(this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad).toFixed(3)
                this.envio.merma_bruta = Number((this.detalle_envio_pt.peso_bruto_actual * this.envio.cantidad) - {
                    ...this.envio
                }.bruto).toFixed(3)
                this.envio.merma_neta = Number((this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad) - {
                    ...this.envio
                }.neto).toFixed(3)


            },
            CambioPesoMerma() {
                this.envio.merma_bruta = Number((this.detalle_envio_pt.peso_bruto_actual * this.envio.cantidad) - {
                    ...this.envio
                }.bruto).toFixed(3)
                this.envio.merma_neta = Number((this.detalle_envio_pt.peso_neto_actual * this.envio.cantidad) - {
                    ...this.envio
                }.neto).toFixed(3)


            },
            async Save() {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/proveedors')}}";
                    if (this.add == false) {
                        url = "{{url('api/proveedors')}}/" + this.model.id
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
                    if (result.value) {
                        try {
                            this.model.user_id = this.user.id
                            const params = new URLSearchParams(this.model);
                            let url = "{{url('api/pts-cerrar')}}/{{$id}}";
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
                                window.location.href = "{{url('pt/lotes')}}"
                            })

                        } catch (e) {

                        }
                    }
                })
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
                        await Promise.all([self.GET_DATA("{{url('api/pt/detalle-pt')}}/{{$id}}"),
                            self.GET_DATA("{{url('api/compoInternas')}}"),
                            self.GET_DATA("{{url('api/compoExternas')}}"),
                            self.GET_DATA("{{url('api/traspasos-pp/disponibles')}}"),
                            self.GET_DATA("{{url('api/sobras-pp/disponibles')}}"),
                            self.GET_DATA("{{url('api/items')}}"),
                            self.GET_DATA("{{url('api/item-sobras-pt')}}"),
                        ]).then((v) => {
                            self.model = v[0]
                            self.compo_internas = v[1]
                            self.compo_externas = v[2]
                            self.traspasos = v[3]
                            self.sobras = v[4]
                            let items = v[5]
                            self.item_sobras_pt= v[6]
                            self.items = items.filter((v) => v.tipo == 2)
                        })
                        this.actualizarPesoNeto();
                        block.unblock();
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
                    let res = await axios.post("{{url('api/ptDetalles')}}", data)
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
                            let url = "{{url('api/compras')}}/" + id
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
                            let res = await axios.post("{{url('api/descomponer-detallepts')}}/" + pp_detalle.id, pp_detalle)
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
                    let res = await axios.post("{{url('api/descomponer-detallepps')}}/" + pp_detalle.id, pp_detalle)
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
                            let res = await axios.post("{{url('api/descomponerdetallepps')}}/" + pp_detalle.id, pp_detalle)
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
                    let res = await axios.post("{{url('api/descomponerdetallepps')}}/" + pp_detalle.id, pp_detalle)
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

                            let res = await axios.post("{{url('api/detallePpRegresar')}}/" + item.id, pp_detalle)
                            await this.load()
                        }
                    })
                } catch (error) {

                }

            },
            async EnviarTransformacion() {
                try {
                    if (!this.item_pt_envio.peso_bruto || !this.item_pt_envio.peso_neto ||
                        this.item_pt_envio.peso_bruto == 0 || this.item_pt_envio.peso_neto == 0) {
                        swal("Error", "Debe completar todos los campos y asegurarse de que no sean 0.", "warning");
                        return;
                    }
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success btn-rounded',
                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        buttonsStyling: false,
                    })
                    swalWithBootstrapButtons({
                        title: 'Estas seguro?',
                        text: "Este cambio de enviar a Subtransformación.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Enviar!',
                        cancelButtonText: 'No!',
                        reverseButtons: true,
                        padding: '2em'
                    }).then(async (result) => {
                        if (result.value) {
                            let detalle = this.item_pt
                            detalle.detalle_envio = this.item_pt_envio
                            detalle.pt_id = this.model.id
                            detalle.user_id = this.user.id
                            detalle.sucursal_id = this.sucursal.id

                            let res = await axios.post("{{url('api/enviarItemPtTransformacions')}}" , detalle)

                            const swalWithBootstrapButtons2 = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons2({
                                title: 'Enviado!',

                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',

                                reverseButtons: true,
                                padding: '2em'
                            })
                            await this.load()
                            this.item_pt_envio = {
                                cajas: 0,
                                peso_bruto: 0,
                                peso_neto: 0
                            }
                        }
                    })
                } catch (error) {
                    console.error(error)
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

            calcularCajas() {
                let retraccion = 2;
                let tara = this.item_pt_envio.cajas * retraccion;
                let nuevoPesoNeto = this.item_pt_envio.peso_bruto - tara;

                // 🔹 Redondeamos a 3
                this.item_pt_envio.peso_neto = this.red(nuevoPesoNeto, 3);

                // if (this.item_pt_envio.cajas > this.item_pt.cajas) {
                //     swal("Error", "Las cajas no pueden ser mayor que las cajas disponibles en el item.", "warning");
                //     this.item_pt_envio.cajas      = this.item_pt.cajas;
                //     this.item_pt_envio.peso_bruto = this.red(this.item_pt.peso_bruto, 3);
                //     this.item_pt_envio.peso_neto  = this.red(this.item_pt.peso_neto, 3);
                // }
            },

            calcularPesoNeto() {
                let retraccion = 2;
                let tara = this.item_pt_envio.cajas * retraccion;

                let nuevoPesoNeto = this.item_pt_envio.peso_bruto - tara;
                nuevoPesoNeto = this.red(nuevoPesoNeto, 3); // 🔹 siempre redondeado

                if (nuevoPesoNeto < 0) {
                    swal("Error", "El peso neto no puede ser negativo. Se ajustará a 0.", "warning");
                    this.item_pt_envio.peso_neto = 0;
                } else {
                    this.item_pt_envio.peso_neto = nuevoPesoNeto;
                }

                // if (this.red(this.item_pt_envio.peso_bruto, 3) > this.red(this.item_pt.peso_bruto, 3)) {
                //     swal("Error", "El peso bruto no puede ser mayor que el peso disponible en el item.", "warning");
                //     //this.item_pt_envio.cajas      = this.item_pt.cajas;
                //     this.item_pt_envio.cajas      = 0;
                //     this.item_pt_envio.peso_neto  = this.red(this.item_pt.peso_neto, 3);
                //     this.item_pt_envio.peso_bruto = this.red(this.item_pt.peso_bruto, 3);
                // }
                if (this.red(this.item_pt_envio.peso_neto, 3) > this.red(this.item_pt.peso_neto, 3)) {
                    swal("Error", "El peso neto no puede ser mayor que el peso disponible en el item.", "warning");
                    //this.item_pt_envio.cajas      = this.item_pt.cajas;
                    this.item_pt_envio.cajas      = 0;
                    this.item_pt_envio.peso_neto  = this.red(this.item_pt.peso_neto, 3);
                    this.item_pt_envio.peso_bruto = this.red(this.item_pt.peso_bruto, 3);
                }
                // if (this.item_pt_envio.cajas > this.item_pt.cajas) {
                //     swal("Error", "Las cajas no pueden ser mayor que las cajas disponibles en el item.", "warning");
                //     this.item_pt_envio.cajas      = this.item_pt.cajas;
                //     this.item_pt_envio.peso_bruto = this.red(this.item_pt.peso_bruto, 3);
                //     this.item_pt_envio.peso_neto  = this.red(this.item_pt.peso_neto, 3);
                // }
            },

            actualizarNeto() {
                if (this.red(this.item_pt_envio.peso_neto, 3) > this.red(this.item_pt.peso_neto, 3)) {
                    swal("Error", "El peso neto no puede ser mayor que el peso disponible en el item.", "warning");
                    //this.item_pt_envio.cajas      = this.item_pt.cajas;
                    this.item_pt_envio.cajas      = 0;
                    this.item_pt_envio.peso_neto  = this.red(this.item_pt.peso_neto, 3);
                    this.item_pt_envio.peso_bruto = this.red(this.item_pt.peso_bruto, 3);
                }
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

    /*
    Simple Tab
*/

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


    /*
    Simple Pills
*/

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


    /*
    Icon Tab
*/

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

    /*
    Icon Pill
*/
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

    /*
    Underline
*/

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


    /*
    Animated Underline
*/

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


    /*
    Justify Tab
*/

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


    /*
    Justify Pill
*/

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


    /*
    Justify Centered Tab
*/

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


    /*
    Justify Centered Pill
*/

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


    /*
    Justify Right Tab
*/

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


    /*
    Justify Right Pill
*/

    .pill-justify-right .nav-pills .nav-link.active,
    .pill-justify-right .nav-pills .show>.nav-link {
        background-color: #2196f3;
    }

    .pill-justify-right .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    With Icons
*/

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


    /*
    Vertical With Icon
*/

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


    /*
    Rouned Circle With Icons
*/

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


    /*
    Vertical Rounded Circle With Icon
*/
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

    /*
    Vertical Pill
*/

    .vertical-pill .nav-pills .nav-link.active,
    .vertical-pill .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Vertical Pill Right
*/

    .vertical-pill-right .nav-pills .nav-link.active,
    .vertical-pill-right .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Creative vertical pill
*/

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


    /*
    Border Tab
*/

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


    /*
    Vertical Border Tab
*/

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


    /*
    Border Top Tab
*/

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
