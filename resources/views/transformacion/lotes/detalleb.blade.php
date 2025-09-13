@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">
        <div class="col-sm-12 col-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>

                            </h3>
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
        <div class="col-lg-12 col-12 layout-spacing" v-if="enviarItemPtTransformacions.length">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>Items enviados desde PT</h4>
                    </div>
                    <div class="row">
                        <div class="col-12" >
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area border-tab p-0">

                                    <table class="table table-bordered">
                                        <thead>
                                            <th>N°</th>
                                            <th>ITEM</th>
                                            <th>CAJAS</th>
                                            <th>PESO BRUTO</th>
                                            <th>TARA</th>
                                            <th>PESO NETO</th>
                                            <th>ENVIAR</th>

                                        </thead>
                                        <tbody>


                                            <tr v-for="item in enviarItemPtTransformacions">
                                                <td class="text-primary">PT-{{item.pt.nro}}</td>
                                                <td class="text-primary">{{item.item.name}}</td>
                                                <td class="text-primary">
                                                    {{item.cajas}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.peso_bruto).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.taras).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.peso_neto).toFixed(3)}}
                                                </td>

                                                <td>
                                                    <button class="btn btn-warning"   @click="AceptarItem(item)">Aceptar</button>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12 layout-spacing" v-if="model.detalle_pts.length">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>Traspasos</h4>
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
                                    <th>Merma Bruta </th>
                                    <th>Merma Neta </th>


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
                                            <td>{{Number(m.merma_bruta).toFixed(3)}}</td>
                                            <td>{{Number(m.merma_neta).toFixed(3)}}</td>



                                        </tr>
                                    </template>
                                    <tr class="bg-dark">

                                            <td class="text-white">{{model.cajas_disponibles}}</td>
                                            <td class="text-white">{{model.pollos_disponibles}}</td>
                                            <td class="text-white">{{Number(model.peso_bruto_disponibles).toFixed(3)}}</td>
                                            <td class="text-white">{{Number(model.peso_neto_disponibles).toFixed(3)}}</td>
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
        <div class="col-lg-12 col-12 layout-spacing" v-if="pp_envio_transformacion_detalle.length" >
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>Traspasos disponibles de PP</h4>
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
                                    <template v-for="m in pp_envio_transformacion_detalle">
                                        <tr >
                                            <td>{{m.pp.nro}}</td>
                                            <td>{{m.cajas}}</td>
                                            <td>{{m.pollos}}</td>
                                            <td>{{m.peso_bruto}}</td>
                                            <td>{{m.peso_neto}}</td>
                                            <td>{{Number(m.peso_bruto/m.pollos).toFixed(3)}}</td>
                                            <td>{{Number(m.peso_neto/m.pollos).toFixed(3)}}</td>
                                            <td>{{Number(m.merma_bruto).toFixed(3)}}</td>
                                            <td>{{Number(m.merma_neto).toFixed(3)}}</td>

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

        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>Descomponer Items Transformacion</h5>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Items</span>
                                </div>
                                <select name="" id="" class="form-control" v-model="item_descomoponer">
                                    <template v-for="item in model.items">
                                        <option :value="item">{{item.item.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cajas Disponibles</span>
                                </div>
                                <input type="text" v-model.number="item_descomoponer.cajas"  disabled class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Bruto Dis.</span>
                                </div>
                                <input type="text" v-model.number="item_descomoponer.peso_bruto" disabled  class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Neto Dis.</span>
                                </div>
                                <input type="text" v-model.number="item_descomoponer.peso_neto" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cajas </span>
                                </div>
                                <input type="text" v-model.number="descomponer.cajas"   class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Bruto </span>
                                </div>
                                <input type="text" v-model.number="descomponer.peso_bruto"   class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Neto </span>
                                </div>
                                <input type="text" v-model.number="descomponer.peso_neto"  class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="">Items</label>
                            <select class="form-control  basic">
                                <option value="" disabled selected>Seleccionar</option>
                                <template v-for="item in items_sucursals">
                                    <option v-if="item.tipo==3" :value="item.id">{{item.name}}</option>
                                </template>
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
                                                    <input type="text" class="form-control form-control-sm" v-model="item.peso_neto" >
                                                </td>
                                                <td class="text-primary">
                                                    <input type="text" class="form-control form-control-sm" v-model="item.recep" >
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" @click="items_sobra.splice(i,1)">Eliminar</button>
                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-warning w-100 mt-2" @click="descomponerPt">
                                                Descomponer
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
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>Items en Transformacion</h4>
                    </div>
                    <div class="row">
                        <div class="col-12" >
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


                                            <tr v-for="item in model.items">
                                                <td class="text-primary">{{item.item.name}}</td>
                                                <td class="text-primary">
                                                    {{item.cajas}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.peso_bruto).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.taras).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.peso_neto).toFixed(3)}}
                                                </td>


                                            </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td  class="text-right">TOTAL</td>
                                                <td class="text-primary">
                                                    {{Number(model.cajas_items)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(model.peso_bruto_items).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(model.tara_items).toFixed(3)}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(model.peso_neto_items).toFixed(3)}}
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
        <div class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab px-2">
                    <div class="d-flex justify-content-between">
                        <h4>SubItems en Transformacion</h4>
                    </div>
                    <div class="row">
                        <div class="col-12" >
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area border-tab p-0">

                                    <table class="table table-bordered">
                                        <thead>
                                            <th>ITEM</th>
                                            <th>CAJAS</th>
                                            <th>PESO BRUTO</th>

                                            <th>PESO NETO</th>

                                        </thead>
                                        <tbody>


                                            <tr v-for="item in model.sub_items">
                                                <td class="text-primary">{{item.item.name}}</td>
                                                <td class="text-primary">
                                                    {{item.cajas}}
                                                </td>
                                                <td class="text-primary">
                                                    {{Number(item.peso_bruto).toFixed(3)}}
                                                </td>

                                                <td class="text-primary">
                                                    {{Number(item.peso_neto).toFixed(3)}}
                                                </td>


                                            </tr>

                                        </tbody>

                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-4 text-center" v-if="model.curso==1">
                            <button class="btn btn-warning btn-block" @click="CerrarPt">FINALIZAR PT</button>
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
                    pt_traspaso_pps: [],
                    pt_sobra_pps: [],
                    sub_items: [],
                    detalle_pts:[]
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
                item_select: {},
                user:{},
                sucursal:{},
                item_sobras_pt:[],
                items_sucursals:[],
                pp_envio_transformacion_detalle:[],
                enviarItemPtTransformacions:[],
                item_descomoponer:{},
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
            }
        },
        methods: {
            async descomponerPt() {
                try {
                    let descomponer = {
                        items_sobra:this.items_sobra,
                        sucursal_id:this.sucursal.id,
                        user_id:this.user.id,
                        transformacion_lote_id:this.model.id
                    }

                    let res = await axios.post("{{url('api/descomponerTransformacionLotes')}}", descomponer)
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
            sobraCaja(item) {
                item.taras = item.cajas * 2
            },
            sobraNeto(item) {
                item.peso_neto = item.peso_bruto - item.taras
            },
            sobraBruto(item) {
                item.peso_neto = item.peso_bruto - item.taras
            },
            ChangeCajas() {
                this.descomponer.pollos = Number(this.descomponer.cajas) * Number(this.model.pollos_x_caja)
                this.descomponer.peso_neto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_neto_x_unitario)).toFixed(3)
                this.descomponer.peso_bruto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_bruto_x_unitario)).toFixed(3)


            },
            ChangePollos() {


                this.descomponer.peso_neto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_neto_x_unitario)).toFixed(3)
                this.descomponer.peso_bruto = Number(Number(this.descomponer.pollos) * Number(this.model.peso_bruto_x_unitario)).toFixed(3)
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
                        item_descomoponer:this.item_descomoponer,
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
                try {
                    // let res = await axios.post(, this.model)
                    let data = {
                        ...m,
                        transformacion_lote_id: this.model.id,
                        user_id: this.user.id,
                        sucursal_id: this.sucursal.id,
                    }
                    data.pt_nuevo_id = this.model.id
                    let url = "{{url('api/ppEnvioTransformaciones-aceptar')}}/" + m.id;
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
                    let url = "{{url('api/sobras-pt/aceptar')}}/" + m.id;
                    let res = await axios.post(url, data)
                    await this.load()
                } catch (e) {

                }
            },
            async AceptarSobraItem(m) {
                try {
                //
                    let data = {
                        ...m

                    }
                    data.pt_id = this.model.id
                    data.user_id= this.user.id
                    data.user_nombre = this.user.nombre
                    let res = await axios.post("{{url('api/sobras-pt-item/aceptar')}}/"+m.id , data)
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
                        await Promise.all([self.GET_DATA("{{url('api/transformacionLotes/detalles')}}/{{$id}}"),
                        self.GET_DATA("{{url('api/ppEnvioTransformaciones-disponibles')}}"),
                        self.GET_DATA("{{url('api/enviarItemPtTransformacions')}}"),
                        self.GET_DATA("{{url('api/items-sucursal')}}/"+this.sucursal.id),
                        ]).then((v) => {
                            self.model = v[0]
                            self.pp_envio_transformacion_detalle = v[1]
                            self.enviarItemPtTransformacions = v[2]
                            self.items_sucursals = v[3]
                        })

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
                        if (result.value) {
                            let detalle = {
                                ...item
                            }
                            detalle.transformacion_lote_id = this.model.id
                            let res = await axios.put("{{url('api/enviarItemPtTransformacions')}}/" + item.id, detalle)
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
                // do whatever you want if console is [object object] then stringify the response




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
