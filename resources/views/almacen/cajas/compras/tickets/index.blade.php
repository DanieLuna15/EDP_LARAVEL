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
                                </svg> Compras de caja / Tickets de pago</p>
                        </div>
                        <a href="./tickets/add" class="btn btn-primary">Pagar Ticket</a>
                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Fecha</th>

                                            <th>Fecha Limite </th>
                                            <th>Deuda Total</th>
                                            <th>Monto Pagado</th>
                                            <th>Deuda Pendiente</th>
                                            <th>Banco</th>
                                            <!-- <th>Pago</th> -->
                                            <th>Tipo de Compra</th>
                                            <th>Anulado</th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ m . id }}</td>
                                            <td>{{ m . fecha }}</td>
                                            <td>{{ m . compra_caja . fecha }}</td>
                                            <td>{{ m . compra_caja . total }}</td>
                                            <td>{{ m . monto }}</td>
                                            <td>{{ m . pendiente }}</td>
                                            <td>{{ m . banco . name }}</td>
                                            <td>
                                                <span v-if="m.compra_caja.tipo==1" class="badge bg-success">Contado</span>
                                                <span v-else
                                                    class="badge bg-primary">{{ m . compra_caja . total == m . compra_caja . monto ? 'CREDITO PAGADO' : 'CREDITO' }}</span>
                                            </td>
                                            <td>
                                                <span v-if="m.estado==1" class="badge bg-success">Vigente</span>
                                                <span v-else class="badge bg-danger">Anulado</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a :href="m.url_pdf" class="btn btn-warning btn-sm">Editar</a>
                                                    <button type="button"
                                                        class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
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
                                                        <a :href="m.compra_caja.url_pdf" class="dropdown-item">Historico</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            @click="deleteItem(m.id)">Eliminar</a>

                                                    </div>
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
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"


            const {
                createApp
            } = Vue
            let dt = new Table()
            let block = new Block()
            createApp({
                data() {
                    return {
                        add: true,
                        model: {
                            name: ''
                        },
                        data: []

                    }
                },
                methods: {
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
                                await Promise.all([self.GET_DATA("{{ url('api/pagoCompraCajas') }}")]).then((
                                v) => {
                                    self.data = v[0]
                                })

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

                                    const params = new URLSearchParams({});


                                    let url = "{{ url('api/consolidacionPagoTickets') }}/" + id

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
