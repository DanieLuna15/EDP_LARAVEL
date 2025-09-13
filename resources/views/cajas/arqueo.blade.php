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
                                </svg> Finanzas / Arqueos</p>
                        </div>

                    </div>


                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" v-model="fecha_inicio" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-sm" v-model="fecha_fin" />
                                </div>
                            </div>
                            <div class="col-3 pt-4">
                                <button class="btn btn-success mt-2" @click="consultarArqueos()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CajaSucursal / Usuario</th>
                                            <th>Fecha Apertura</th>
                                            <th>Fecha Cierre</th>
                                            <th>Monto Inicial</th>
                                            <th>Total Ventas</th>
                                            <th>Total Ingresos</th>
                                            <th>Total Egresos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tr v-for="arqueo in arqueos" :key="arqueo.id">
                                        <td>{{ arqueo . id }}</td>
                                        <td>
                                            <div><strong> {{ arqueo . nombre_sucursal }} : {{ arqueo . nombre_usuario }} </strong>
                                            </div>
                                        </td>
                                        <td>{{ arqueo . fecha_hora_apertura }}</td>
                                        <td>{{ arqueo . fecha_hora_cierre }}</td>
                                        <td><strong>{{ Number(arqueo . monto_inicial) . toFixed(2) }}</strong></td>
                                        <td><strong>{{ arqueo . total_ventas . toFixed(2) }}</strong></td>
                                        <td><strong>{{ arqueo . total_ingresos . toFixed(2) }}</strong></td>
                                        <td><strong>{{ arqueo . total_egresos . toFixed(2) }}</strong></td>
                                        <td>
                                            <a :href="arqueo.url_pdf" target="_blank" class="btn btn-info btn-sm">PDF</a>
                                        </td>
                                    </tr>
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
                        fecha_inicio: '',
                        fecha_fin: '',
                        arqueos: [],
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
                            dt.create({
                                order: [
                                    [0, 'asc']
                                ],
                                paging: true,
                                responsive: true,
                                destroy: true
                            });
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

                    async consultarArqueos() {
                        if (!this.fecha_inicio || !this.fecha_fin) {
                            swal.fire('Atención', 'Por favor selecciona ambas fechas', 'warning');
                            return;
                        }
                        try {
                            block.block();
                            const res = await axios.post("{{ url('api/arqueos/filtrar') }}", {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin
                            });

                            this.arqueos = res.data.arqueos || res
                                .data;

                            dt.destroy();
                            await this.$nextTick(() => {
                                dt.create({
                                    order: [
                                        [0, 'asc']
                                    ],
                                    paging: true,
                                    responsive: true,
                                    destroy: true,
                                });
                            });

                            if (this.arqueos.length > 0) {

                            } else {
                                swal.fire('Información',
                                    'No se encontraron resultados para el rango de fechas seleccionado.', 'info'
                                );
                            }
                        } catch (e) {
                            swal.fire('Error', 'No se pudo obtener los datos', 'error');
                        } finally {
                            block.unblock();
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
                                    dt.create({
                                        order: [
                                            [0, 'asc']
                                        ],
                                        paging: true,
                                        responsive: true,
                                        destroy: true
                                    });
                                } catch (e) {

                                }
                            }
                        })
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        const hoy = new Date().toISOString().substr(0, 10);
                        self.fecha_inicio = hoy;
                        self.fecha_fin = hoy;
                        block.block();
                        try {
                            dt.create({
                                order: [
                                    [0, 'asc']
                                ],
                                paging: true,
                                responsive: true,
                                destroy: true
                            });
                            dt.create()

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
