@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="action-btn layout-top-spacing mb-5">
                    <div class="page-header">
                        <div class="page-title">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg> Lotes</p>
                        </div>
                        <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name=''"
                            class="btn btn-success" :disabled="pps.length >= 2"
                            :title="pps.length >= 2 ? 'No se puede abrir más lotes, por favor cierra los anteriores lotes' : ''">INICIAR
                            PT</button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">INICIAR PT</h5>
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
                                            <label for="inputEmail4">NRO DE PT</label>
                                            <input type="text" v-model="model.nro" class="form-control" placeholder="Ejm: 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button @click="Save()" type="button" data-dismiss="modal"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div v-for="m in pps" class="col-lg-4 col-md-12 col-12 mb-2">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">PT N° {{ m . nro }}</h6>
                                        <p class="">{{ m . mes }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a :href="'./detalle/' + m.id" class="btn btn-success w-100">DETALLE</a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="btn-group w-100">
                                            <a :href="m.url_peso_inicial_1_pdf" target="_blank" class="btn btn-primary w-100">PESO
                                                INICIAL 1</a>
                                            <a :href="m.url_peso_inicial_2_pdf" target="_blank" class="btn btn-primary w-100">PESO
                                                INICIAL 2</a>
                                            <a :href="m.url_peso_total_pdf" target="_blank" class="btn btn-info w-100">PESO TOTAL
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover">
                                    <thead>
                                        <tr>
                                            <th>Creacion</th>
                                            <th>Nro Pt</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ m . fecha }} #{{ m . id }}</td>
                                            <td>{{ m . nro }}</td>

                                            <td>
                                                <span v-if="m.curso==1" class="badge bg-success">En Curso</span>
                                                <span v-else class="badge bg-danger">Finalizado</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split"
                                                        :id="'menu' + i" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-reference="parent">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu" :aria-labelledby="'menu' + i">
                                                        <a :href="m.url_informe_pdf" target="_blank"
                                                            class="dropdown-item">SEGUIMIENTO</a>
                                                        <a :href="m.url_general_pdf" target="_blank" class="dropdown-item"
                                                            style="display: none">DETALLE
                                                            GENERAL</a>
                                                        <a :href="m.url_peso_inicial_1_pdf" target="_blank"
                                                            class="dropdown-item">
                                                            PESO INICIAL 1</a>
                                                        <a :href="m.url_peso_inicial_2_pdf" target="_blank"
                                                            class="dropdown-item">
                                                            PESO INICIAL 2</a>
                                                        <a :href="m.url_peso_total_pdf" target="_blank" class="dropdown-item">
                                                            TOTAL INICIAL</a>
                                                        <a :href="m.url_descomponer_pdf" target="_blank"
                                                            class="dropdown-item bg-light-success">
                                                            DESCOMPOSI. DE PT</a>
                                                        <a :href="m.url_items_pdf" target="_blank" class="dropdown-item"
                                                            style="display: none"> ITEMS
                                                            EN PT</a>
                                                        <a :href="m.url_venta_pdf" target="_blank" class="dropdown-item"
                                                            style="display: none"> VENTAS
                                                            DE PT</a>
                                                        <a :href="m.url_envio_pdf" target="_blank" class="dropdown-item"
                                                            style="display: none"> ENVIOS
                                                            DE PT</a>
                                                        <a :href="m.url_pt_ventas_pdf" target="_blank" class="dropdown-item"
                                                            style="display: none">
                                                            REP. VENTA GENERAL PT</a>
                                                        <a :href="m.url_pt_venta_reporte_pdf" target="_blank"
                                                            class="dropdown-item bg-light-success"> REP. MOVIMIENTOS PT</a>
                                                        <a :href="m.url_pt_reporte_general_pdf" target="_blank"
                                                            class="dropdown-item bg-light-success"> REP. GENERAL PT</a>
                                                        <!-- <a :href="'./compras/edit/' + m.id" class="dropdown-item">Editar</a>
                                                                                <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(m.id)">Eliminar</a> -->
                                                    </div>
                                                    <a :href="'./detalle/' + m.id" class="btn btn-primary btn-sm"
                                                        v-if="m.curso==1">Detalle</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                            nro: '',
                        },
                        sucursal: {},
                        user: {},
                        pp: {

                        },
                        data: [],
                        pps: []
                    }
                },
                methods: {
                    async Save() {
                        if (this.model.nro.trim() == '') {
                            swal('Error', 'El nro de PT es obligatorio', 'error')
                            return
                        }
                        try {
                            block.block();
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            this.model.sucursal_id = this.sucursal.id
                            this.model.user_id = this.user.id
                            let url = "{{ url('api/pts') }}";
                            if (this.add == false) {
                                url = "{{ url('api/pts') }}/" + this.model.id
                                let res = await axios.put(url, this.model)
                            } else {
                                let res = await axios.post(url, this.model).then((v) => {
                                    this.pp = v.data
                                })
                            }
                            dt.destroy()
                            await this.load()
                            dt.create()
                            block.unblock();
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
                            block.block();
                            try {
                                await Promise.all([self.GET_DATA("{{ url('api/pts/curso/') }}/" + this.sucursal.id),
                                    self.GET_DATA("{{ url('api/pts') }}")
                                ]).then((v) => {
                                    self.pps = v[0]
                                    self.data = v[1]
                                })
                                block.unblock();
                            } catch (e) {
                            }
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
                                    block.block();
                                    const params = new URLSearchParams({});
                                    let url = "{{ url('api/compras') }}/" + id
                                    await axios.delete(url)
                                    dt.destroy()
                                    await self.load()
                                    dt.create()
                                    block.unblock();
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
                            this.sucursal = JSON.parse(sucursal)
                            let user = localStorage.getItem('AppUser')
                            this.user = JSON.parse(user)
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
@endcomponent
