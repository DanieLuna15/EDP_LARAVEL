@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
        <div class="page-header">
            <div class="page-title">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg> Pedidos (Preventista)</p>
            </div>


        </div>


    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <select v-model="cliente" class="form-control form-control-sm">
                            <option value="" disabled selected>Seleccionar</option>
                            <option v-for="m in clientes" :value="m">{{m.nombre}} {{m.documento.name}} {{m.doc}}</option>

                        </select>
                        <label for="" class="text-danger" v-if="cliente.id==''">Selecciona un cliente</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group ">
                        <label>Fecha de entrega</label>
                        <input type="date" class="form-control form-control" v-model="entrega.fecha">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group ">
                        <label>Hora de entrega</label>
                        <input type="text" class="form-control form-control" v-model="entrega.hora">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group ">
                        <label>Tiempo Espera</label>
                        <input type="text" class="form-control form-control" v-model="entrega.espera">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group ">
                        <label>Choferes</label>
                        <select v-model="chofer" class="form-control form-control-sm">
                            <option value="" disabled selected>Seleccionar</option>
                            <template v-for="m in chofers">
                                <option :disabled="m.turno_chofer==null" :class="m.turno_chofer==null?'op_disabled':'op_enabled'" :value="m">{{m.nombre}} {{m.documento.name}} {{m.doc}}</option>
                            </template>
                        </select>
                        <label for="" class="text-danger" v-if="!chofer.hasOwnProperty('id')">Selecciona un chofer</label>
                    </div>
                </div>
                <div class="col-4">

                    <div class="form-group ">
                        <label>Formas de pago</label>

                        <select v-model="formapago_id" class="form-control form-control-sm">
                            <option value="" disabled selected>Seleccionar</option>
                            <option v-for="m in formapagos" :value="m.id">{{m.name}}</option>

                        </select>


                        <label for="" class="text-danger" v-if="formapago_id==''">Selecciona una Forma de Pago</label>
                    </div>
                </div>
                <div class="col-4">

                    <div class="form-group ">
                        <label>Tipo de pago</label>

                        <select v-model="model.tipopago" class="form-control form-control-sm">

                            <option :value="1">CONTADO</option>
                            <option :value="2">CREDITO</option>

                        </select>



                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-2">

            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab bg-secondary">

                    <div class="row">
                        <div class="col-3">

                            <div class="form-group ">
                                <label>Cajas</label>
                                <input type="text" class="form-control form-control" @click="ItemPrecio" v-model="conversion.cajas">
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group ">
                                <label>Pollo</label>
                                <input type="text" class="form-control form-control" @click="ItemPrecio" v-model="conversion.pollos">
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group ">
                                <label>KG</label>
                                <input type="text" class="form-control form-control" @click="ItemPrecio" v-model="conversion.peso">
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group ">
                                <label>Tara</label>
                                <input type="text" class="form-control form-control" @click="ItemPrecio" v-model="conversion.tara">
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="col-12 mt-2">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab ">

                    <div class="row">
                        <div class="col-3">

                            <div class="form-group ">
                                <label>Items</label>
                                <select v-model="select_item" class="form-control form-control-sm" @change="ItemPrecio">

                                    <option v-for="m in items" :value="m">{{m.name}}</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-3">

                            <div class="form-group ">
                                <label>Cajas</label>
                                <input type="text" class="form-control form-control" v-model="item.cajas" @change="ItemPrecio">
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group ">
                                <label>Pollo</label>
                                <input type="text" class="form-control form-control" v-model="item.pollos">
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group ">
                                <label>KG</label>
                                <input type="text" class="form-control form-control" v-model="item.peso_bruto">
                            </div>
                        </div>
                        <div class="col-12">

                            <button class="btn btn-warning w-100 mt-2" @click="AgregarItem">
                                AGREGAR ITEM
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">

            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered ">
                        <thead>
                            <th>Item</th>
                            <th>Cajas</th>

                            <th>Peso Bruto</th>
                            <th>Tara</th>
                            <th>Peso Neto</th>
                            <th>Peso Neto Unitario</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <template v-for="l in pedido_items">
                                        <tr >
                                            <td>{{l.item.name}}</td>
                                            <td>{{l.cajas}}</td>
                                            <td>{{Number(l.peso_bruto).toFixed(2)}}</td>
                                            <td>{{Number(l.tara).toFixed(2)}}</td>
                                            <td>{{Number(l.peso_neto).toFixed(2)}}</td>
                                            <td>{{Number(l.peso_neto_unitario).toFixed(2)}}</td>

                                            <td>

                                            </td>
                                        </tr>
                                    </template>

                        </tbody>

                    </table>

                    <div class="col-12">

                    <button class="btn btn-success w-100 m-2" @click="SavePedido">
                        REALIZAR PEDIDO
                    </button>

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
    import Table from "{{asset('config/dt.js')}}"
    import Block from "{{asset('config/block.js')}}"


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
                    tipopago: 1
                },
                conversion:{
                    cajas:1,
                    pollos:15,
                    peso:35,
                    tara:2
                },
                documentos: [],
                tipoclientes: [],
                lote_id: '',
                lotes: [],
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
                    id: ''
                },
                chofer_id: '',
                formapago_id: '',
                entrega: {
                    fecha: '',
                    hora: '',
                    espera: ''
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
                item:{
                    cajas:1,
                    pollos:15,
                    peso_bruto:35,

                },
                select_item:{

                },
                pedido_items:[]
            }
        },
        computed: {
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
                return "{{url('')}}/img/pollo.jpg"
            },
            model_detalles() {
                return this.lotes.map((l) => {

                    l.cajas_disponibles = l.lote_detalles.reduce((a, b) => a + (b.cajas > 0 ? b.cajas : 0), 0)
                    l.pollos_disponibles = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? b.equivalente : 0), 0)
                    l.peso_neto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (b.peso_total - b.cajas * 2) : 0), 0)
                    l.peso_bruto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (b.peso_total) : 0), 0)

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
                let peso_unitario_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_unitario_bruto), 0)
                let peso_unitario_neto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_unitario_neto), 0)

                return {
                    cajas: cajas,
                    pollos: pollos,
                    peso_bruto: peso_bruto,
                    peso_neto: peso_neto,
                    merma_bruta: merma_bruta,
                    merma_neta: merma_neta,
                    peso_unitario_bruto: peso_unitario_bruto,
                    peso_unitario_neto: peso_unitario_neto,
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
                return Number(this.venta_items_peso_bruto + this.detalle_vente_lotes_peso_bruto + this.detalle_venta_pp_peso_bruto).toFixed(2)
            },
        },
        methods: {
            AgregarItem() {
               let item = {
                   ...this.item
               }
                item.item = {
                     ...this.select_item
                }
                this.pedido_items.push(item)
            },
            ItemPrecio(){
                this.item.pollos = Number((this.item.cajas*this.conversion.cajas )* this.conversion.pollos)
                this.item.peso_bruto = Number((this.item.cajas*this.conversion.cajas )* this.conversion.peso)
                this.item.tara = Number((this.item.cajas*this.conversion.cajas )* this.conversion.tara)
                this.item.peso_neto = Number(this.item.peso_bruto - this.item.tara)
                this.item.peso_neto_unitario = Number(this.item.peso_neto / this.item.pollos)
            },
            AddPpDetalle(d) {
                let pp_detalle = {
                    ...d
                }
                pp_detalle.item = {
                    ...this.ItemSelect
                }
                this.detalle_venta_pp.push(pp_detalle)
                this.venta_pps = []
            },
            AddPtItem(d) {
                let pt_detalle = {
                    ...d
                }
                pt_detalle.pt_id = this.pt.id
                pt_detalle.peso_bruto_x_caja = Number(pt_detalle.peso_bruto / pt_detalle.cajas).toFixed(2)
                pt_detalle.peso_neto_x_caja = Number(pt_detalle.peso_neto / pt_detalle.cajas).toFixed(2)
                pt_detalle.cajas_vender = 1
                pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
                pt_detalle.peso_neto_vender = pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender
                pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender

                this.venta_items.push(pt_detalle)
            },
            changeCajasItem(pt_detalle) {
                pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
                pt_detalle.peso_neto_vender = pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender
                pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
            },
            changePesoBrutoItem(pt_detalle) {
                pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
            },
            changePesoNetoItem(pt_detalle) {
                pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
            },
            bandera(d) {
                let b = this.banderas.find(b => d.equivalente >= b.min && d.equivalente <= b.max)
                if (b) {
                    return b.name
                }
                return ''
            },
            changeCajas(d) {
                d.equivalente = Number(d.cajas * d.pollos)
                d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
                d.peso_actual_neto = Number(d.equivalente * d.peso_unitario_neto).toFixed(2)
                d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
                d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
                d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
            },
            changeLote(d) {
                d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
                d.peso_actual_neto = Number(d.equivalente * d.peso_unitario_neto).toFixed(2)
                d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
                d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
                d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
            },
            changeLoteM(d) {

                d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
                d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
            },
            AddDetalle(i, compra) {
                let item = {
                    ...i
                }
                item.compra = {
                    ...compra
                }
                item.peso_unitario_bruto = Number(item.peso_total / item.equivalente).toFixed(2)
                item.peso_neto = Number(item.peso_total - item.cajas * 2).toFixed(2)
                item.peso_unitario_neto = Number(item.peso_neto / item.equivalente).toFixed(2)
                item.peso_actual_bruto = Number(item.equivalente * item.peso_unitario_bruto).toFixed(2)
                item.peso_actual_neto = Number(item.equivalente * item.peso_unitario_neto).toFixed(2)
                item.peso_mod_bruto = Number(item.peso_actual_bruto).toFixed(2)
                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(2)
                item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(2)
                item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(2)
                this.detalle_lote = item
            },
            AddDetalleLote() {
                let item = {
                    ...this.detalle_lote
                }
                this.detalle_vente_lotes.push(item)
            },
            CambioPeso() {
                this.envio.bruto = Number(this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes).toFixed(2)
                this.envio.neto = Number(this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes).toFixed(2)
                this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) - {
                    ...this.envio
                }.bruto).toFixed(2)
                this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) - {
                    ...this.envio
                }.neto).toFixed(2)


            },
            CambioPesoMerma() {
                this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) - {
                    ...this.envio
                }.bruto).toFixed(2)
                this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) - {
                    ...this.envio
                }.neto).toFixed(2)


            },
            async FinalizarLote(id) {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/lotes-finalizar')}}/" + id;
                    let res = await axios.post(url, {
                        id
                    })

                    await this.load()

                } catch (e) {

                }
            },
            async SavePedido() {
                block.block()
                try {
                    let self = this
                    let data = {
                        sucursal_id: self.sucursal.id,
                        cliente_id: self.cliente.id,
                        chofer_id: self.chofer.id,
                        formapago_id: self.formapago_id,
                        pedido_items: self.pedido_items,
                        tipopago : self.model.tipopago,
                        fecha_entrega: self.entrega.fecha,
                        hora_entrega: self.entrega.hora,
                    }
                    let res = await axios.post("{{url('api/pedidoClientes')}}", data)
                    self.detalle_vente_lotes = []
                    self.venta_pps = []
                    self.venta_items = []
                    self.detalle_venta_pp = []
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
                    window.open(res.data.url_pdf, '_blank');
                    await this.load()
                } catch (e) {

                } finally {
                    block.unblock()
                }
            },
            async Vender() {
                block.block()
                try {
                    let self = this
                    let data = {
                        sucursal_id: self.sucursal.id,
                        cliente_id: self.cliente.id,
                        chofer_id: self.chofer.id,
                        turno_chofer_id: self.chofer.turno_chofer.id,
                        venta_pps: self.detalle_venta_pp,
                        detalle_vente_lotes: self.detalle_vente_lotes,
                        venta_items: self.venta_items,
                        peso_bruto_total: self.peso_bruto_total,
                        fecha_entrega: self.entrega.fecha,
                        hora_entrega: self.entrega.hora,
                    }
                    let res = await axios.post("{{url('api/ventas')}}", data)
                    self.detalle_vente_lotes = []
                    self.venta_pps = []
                    self.venta_items = []
                    self.detalle_venta_pp = []
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
                    window.open(res.data.url_pdf, '_blank');
                    await this.load()
                } catch (e) {

                } finally {
                    block.unblock()
                }
            },
            ChangeCajasPp(item) {
                let cajas = Number(item.cajas_vender)

                let pollos_x_caja = Number(item.pollos_x_caja)
                item.pollos_vender = cajas * pollos_x_caja
                item.peso_bruto_vender = Number(item.pollos_vender * item.peso_bruto_unit).toFixed(2)
                item.peso_neto_vender = Number(item.pollos_vender * item.peso_neto_unit).toFixed(2)

            },
            ChangePollosPp(item) {

                let pollos_vender = Number(item.pollos_vender)
                item.peso_bruto_vender = Number(pollos_vender * item.peso_bruto_unit).toFixed(2)
                item.peso_neto_vender = Number(pollos_vender * item.peso_neto_unit).toFixed(2)

            },
            AddPp() {
                let pp = {
                    ...this.pp
                }
                let pollos_x_caja = Number(pp.pollos) / Number(pp.cajas)
                pp.cajas_vender = 0
                pp.peso_bruto_vender = 0
                pp.peso_neto_vender = 0
                pp.pollos_vender = 0
                pp.pollos_x_caja = pollos_x_caja
                pp.peso_bruto_unit = Number(pp.peso_bruto) / Number(pp.pollos)
                pp.peso_neto_unit = Number(pp.peso_neto) / Number(pp.pollos)
                pp.sobra = false
                pp.sobra_descripcion = ''
                pp.sobra_peso = 0
                if (this.venta_pps.length == 0) {
                    this.venta_pps.push(pp)
                }
            },
            async GET_DATA(path) {
                try {
                    let res = await axios.get("{{url('api')}}/" + path)
                    return res.data
                } catch (e) {

                }
            },

            async Save() {
                block.block();
                try {

                    let url = "url_path()api/clientes";
                    await axios.post("{{url('api/clientes')}}", this.model)
                    this.back()

                } catch (e) {

                } finally {
                    block.unblock();
                }
            },
            async GetLote() {
                block.block();
                try {
                    let res = await axios.get("{{url('api')}}/lotes-pos/" + this.lote_id)
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
                            self.GET_DATA("clientes"),
                            self.GET_DATA("chofers-turno"),
                            self.GET_DATA("formapagos"),
                            self.GET_DATA("items"),
                            self.GET_DATA("pts/curso-pos/" + this.sucursal.id),
                            self.GET_DATA("producto-precios-sucursal/" + this.sucursal.id)
                        ]).then((v) => {
                            self.pp = v[0]
                            self.lotes = v[1]
                            self.banderas = v[2]
                            self.clientes = v[3]
                            self.chofers = v[4]
                            self.formapagos = v[5]

                            let items = v[6]
                            self.items = items.filter((v) => v.tipo == 1)
                            self.pt = v[7]
                            self.productos_precios = v[8]
                        })

                    } catch (e) {

                    }
                } catch (e) {

                }
            },
        },
        mounted() {
            this.$nextTick(async () => {
                let self = this

                try {



                    let sucursal = localStorage.getItem('AppSucursal')
                    this.sucursal = JSON.parse(sucursal)
                    let user = localStorage.getItem('AppUser')
                    this.user = JSON.parse(user)
                    await Promise.all([self.load()]).then((v) => {

                    })

                } catch (e) {

                } finally {
                    var ss = $(".basic").select2({
                        tags: true,
                    }).change((v) => {
                        self.AddPp()

                        self.item_select = v.target.value
                    })
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
</style>
@endslot
@endcomponent
