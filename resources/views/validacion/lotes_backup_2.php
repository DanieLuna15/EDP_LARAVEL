@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">

        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing" v-for="m in model_detalles">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area border-tab p-0">

                            <table class="table table-bordered">
                                <thead>
                                    <th>Lote</th>
                                    <th>Cajas</th>
                                    <th>Pollos</th>
                                    <th>Peso Bruto</th>
                                    <th>Peso Neto</th>
                                    <th>Cinta</th>
                                    <th>Pigmento</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <template v-for="l in m.lote_detalles">
                                        <tr v-if="l.cajas>0&&l.equivalente>0">
                                            <td>{{m.compra.proveedor_compra.abreviatura}}-{{m.compra.nro}}</td>
                                            <td>{{l.cajas}}</td>
                                            <td>{{l.equivalente}}</td>
                                            <td>{{Number(l.peso_total).toFixed(2)}}</td>
                                            <td>{{Number(Number(l.peso_total)-Number(l.cajas*2)).toFixed(2)}}</td>
                                            <td :class="'bg-'+bandera(l)+' text-white'">{{l.name}}</td>
                                            <td>{{l.pigmento==1?'CON PIGMENTO':'SIN PIGMENTO'}}</td>
                                            <td>
                                                <button class="btn btn-success p-1" @click="AddDetalle(l,m.compra)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-plus">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td class="text-primary">SUB TOTALES</td>
                                        <td class="text-primary">{{Number(m.cajas_disponibles).toFixed(2)}}</td>
                                        <td class="text-primary">{{Number(m.pollos_disponibles).toFixed(2)}}</td>
                                        <td class="text-primary">{{Number(m.peso_bruto_disponible).toFixed(2)}}</td>
                                        <td class="text-primary">{{Number(m.peso_neto_disponible).toFixed(2)}}</td>
                                        <td></td>
                                        <td></td>

                                    </tr>

                                </tbody>

                            </table>

                            <button class="btn btn-warning w-100 mt-2" @click="FinalizarLote(m.id)">
                                FINALIZAR LOTE
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                        <thead>
                            <th>Lote</th>
                            <th>Cajas</th>
                            <th>Pollos</th>
                            <th>Peso Bruto</th>
                            <th>Peso Neto</th>
                            <th>P. Bruto U.</th>
                            <th>P. Neto U.</th>
                            <th>M. Bruto </th>
                            <th>M. Neto </th>
                            <th>Cinta</th>
                            <th>Pigmento</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr v-for="(l,i) in detalle_envio">
                                <td>{{l.compra.proveedor_compra.abreviatura}}-{{l.compra.nro}}</td>
                                <td>
                                    <input type="text" name="" id="" v-model="l.cajas" @change="changeCajas(l)"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="" id="" v-model="l.equivalente" @change="changeLote(l)"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="" id="" v-model="l.peso_mod_bruto" @change="changeLoteM(l)"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="" id="" v-model="l.peso_mod_neto" @change="changeLoteM(l)"
                                        class="form-control">
                                </td>

                                <td>{{l.peso_unitario_bruto}}</td>
                                <td>{{l.peso_unitario_neto}}</td>
                                <td>{{l.merma_bruta}}</td>
                                <td>{{l.merma_neta}}</td>

                                <td :class="'bg-'+bandera(l)+' text-white'">{{l.name}}</td>
                                <td>{{l.pigmento==1?'CON PIGMENTO':'SIN PIGMENTO'}}</td>
                                <td>
                                    <button class="btn btn-danger p-1" @click="detalle_envio.splice(i,1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr class="sub_t">
                                <td>SUB TOTALES</td>
                                <td>
                                    {{Number(total_detalles.cajas).toFixed(2)}}
                                </td>

                                <td>
                                    {{Number(total_detalles.pollos).toFixed(2)}}
                                </td>
                                <td>
                                    {{Number(total_detalles.peso_bruto).toFixed(2)}}
                                </td>
                                <td>
                                    {{Number(total_detalles.peso_neto).toFixed(2)}}
                                </td>


                                <td>
                                    {{Number(total_detalles.peso_unitario_bruto).toFixed(2)}}
                                </td>
                                <td>
                                    {{Number(total_detalles.peso_unitario_neto).toFixed(2)}}
                                </td>
                                <td>
                                    {{Number(total_detalles.merma_bruta).toFixed(2)}}
                                </td>
                                <td>
                                    {{Number(total_detalles.merma_neta).toFixed(2)}}
                                </td>
                                <td></td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
        <div class="col-12 text-right mt-4">
            <div class="btn-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    @click="detalle_lote={...m}">ENVIAR A PP</button>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal2"
                    @click="detalle_lote={...m}">ENVIAR A PT</button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCrud">PP Destino</h5>
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

                            <div class="form-row mb-4">

                                <div class="form-group col-md-12">

                                    <input type="text" :value="'N° '+pp.nro+' '+pp.mes" disabled class="form-control">
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                Cancelar</button>
                            <button v-if="detalle_envio.length" @click="EnviarPP()" type="button" data-dismiss="modal"
                                class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCrud">PT Destino</h5>
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

                            <div class="form-row mb-4">

                                <div class="form-group col-md-12">

                                    <input type="text" :value="'N° '+pt.nro+' '+pt.mes" disabled class="form-control">
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                Cancelar</button>
                            <button v-if="detalle_envio.length" @click="EnviarPT()" type="button" data-dismiss="modal"
                                class="btn btn-primary">Enviar</button>
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
                    lote_detalles: []
                },
                lotes: [],
                detalle_lote: {
                    equivalente: 0,
                    pollos: 0,
                    pp_detalles: []
                },
                envio: {
                    cajas: 0,
                    pollos: 0,
                    bruto: 0,
                    neto: 0,
                    merma_bruta: 0,
                    merma_neta: 0,
                },
                compo_internas: [],
                compo_externas: [],
                sucursal: {
                    id: 0,
                    name: ''
                },
                pp: {},
                pt: {},
                detalle_envio: [],
                banderas: [],
                user: {}
            }
        },
        computed: {
            url() {
                return "{{url('')}}"
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
                let cajas = this.detalle_envio.reduce((a, b) => a + Number(b.cajas), 0)
                let pollos = this.detalle_envio.reduce((a, b) => a + Number(b.equivalente), 0)
                let peso_bruto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
                let peso_neto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
                let merma_bruta = this.detalle_envio.reduce((a, b) => a + Number(b.merma_bruta), 0)
                let merma_neta = this.detalle_envio.reduce((a, b) => a + Number(b.merma_neta), 0)
                let peso_unitario_bruto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_unitario_bruto), 0)
                let peso_unitario_neto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_unitario_neto), 0)

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
            }

        },
        methods: {
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
                let item = { ...i }
                item.compra = { ...compra }
                item.peso_unitario_bruto = Number(item.peso_total / item.equivalente).toFixed(2)
                item.peso_neto = Number(item.peso_total - item.cajas * 2).toFixed(2)
                item.peso_unitario_neto = Number(item.peso_neto / item.equivalente).toFixed(2)
                item.peso_actual_bruto = Number(item.equivalente * item.peso_unitario_bruto).toFixed(2)
                item.peso_actual_neto = Number(item.equivalente * item.peso_unitario_neto).toFixed(2)
                item.peso_mod_bruto = Number(item.peso_actual_bruto).toFixed(2)
                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(2)
                item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(2)
                item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(2)
                this.detalle_envio.push(item)
            }
            ,
            CambioPeso() {
                this.envio.bruto = Number(this.detalle_lote.peso_unit_pollo * this.detalle_envio).toFixed(2)
                this.envio.neto = Number(this.detalle_lote.peso_neto_pollo * this.detalle_envio).toFixed(2)
                this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_envio) - { ...this.envio }.bruto).toFixed(2)
                this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_envio) - { ...this.envio }.neto).toFixed(2)


            },
            CambioPesoMerma() {
                this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_envio) - { ...this.envio }.bruto).toFixed(2)
                this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_envio) - { ...this.envio }.neto).toFixed(2)


            },
            async FinalizarLote(id) {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/lotes-finalizar')}}/" + id;
                    let res = axios.post(url, { id })
                    dt.destroy()
                    await this.load()
                    dt.create()
                } catch (e) {

                }
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


                    await Promise.all([self.GET_DATA("{{url('api/lotes-general')}}"),
                    self.GET_DATA("{{url('api/compoInternas')}}"),
                    self.GET_DATA("{{url('api/compoExternas')}}"),
                    self.GET_DATA("{{url('api/pps/curso/')}}/" + this.sucursal.id),
                    self.GET_DATA("{{url('api/banderas')}}"),
                    self.GET_DATA("{{url('api/pts/curso/')}}/" + this.sucursal.id),


                    ]).then((v) => {
                        self.lotes = v[0]
                        self.compo_internas = v[1]
                        self.compo_externas = v[2]
                        self.pp = v[3]
                        self.banderas = v[4]
                        self.pt = v[5]
                    })


                } catch (e) {

                }
            },
            async EnviarPP() {
                try {
                    let self = this
                    let data = {
                        detalle_envio: this.detalle_envio,
                        pp_id: this.pp.id,
                        user_id: this.user.id,
                    }
                    this.envio.cajas = 0
                    this.envio.pollos = 0
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
                            let res = await axios.post("{{url('api/ppDetalles-masa')}}", data)

                            window.open(res.data.url_pdf, '_blank');
                            swalWithBootstrapButtons({
                                title: 'Enviado!',
                                type: 'success',
                            })
                        }
                        await Promise.all([self.GET_DATA("{{url('api/lotes-general')}}"),

                        ]).then((v) => {
                            self.lotes = v[0]

                        })
                        this.detalle_envio = []
                    })
                } catch (e) {

                }
            },
            async EnviarPT() {
                try {
                    let self = this
                    let data = {
                        detalle_envio: this.detalle_envio,
                        pt_id: this.pt.id
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
                        confirmButtonText: 'Enviar!',
                        cancelButtonText: 'No!',
                        reverseButtons: true,
                        padding: '2em'
                    }).then(async (result) => {
                        if (result.value) {
                            let res = await axios.post("{{url('api/ptDetalles-masa')}}", data)
                            window.open(res.data.url_pdf, '_blank');
                            swalWithBootstrapButtons({
                                title: 'Enviado!',
                                type: 'success',
                            })
                            await Promise.all([self.GET_DATA("{{url('api/lotes-general')}}"),

                            ]).then((v) => {
                                self.lotes = v[0]

                            })
                            this.detalle_envio = []
                        }




                    })


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
    .sub_t td {
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
