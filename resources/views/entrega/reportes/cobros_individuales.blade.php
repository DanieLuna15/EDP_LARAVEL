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
                                </svg> Entregas / Reportes Cobranzas / Cobros Individuales</p>
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

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Clientes</label>
                                    <div class="input-group">
                                        <select v-model="cliente_id" class="form-control select_cliente">
                                            <option value="0">Todos</option>
                                            <option v-for="m in clientes" :value="m.id">{{ m . nombre }}
                                                {{ m . documento . name }} {{ m . doc }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 pt-4">
                                <button class="btn btn-success mt-2" @click="consultarCobrosIndividuales()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <h5>Cobros Individuales</h5>
                                    <table id="table_dt_cuentas" class="table table-hover non-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Cobro ID</th>
                                                <th>Venta ID</th>
                                                <th>Cliente</th>
                                                <th>Usuario</th>
                                                <th>Total Pagado</th>
                                                <th>Forma de Pago</th>
                                                <th>Fecha Emisión</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(cobro, index) in cobrosIndividuales" :key="index">
                                                <tr>
                                                    <td>{{ cobro.id }}</td>
                                                    <td>#{{ cobro.id_venta }}</td>
                                                    <td>{{ cobro.cliente_nombre }}</td>
                                                    <td>{{ cobro.usuario_nombre }}</td>
                                                    <td>{{ cobro.pago_con }}</td>
                                                    <td>{{ cobro.forma_pago }}</td>
                                                    <td>{{ cobro.created_at }}</td>
                                                    <td>
                                                        <a :href="cobro.url_pdf" target="_blank" class="btn btn-info btn-sm"><i
                                                            class="fa fa-print"></i> Ticket 8mm</a>
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
                        cobrosIndividuales: [],
                        clientes: [],
                        cliente_id: 0,
                    }
                },
                methods: {
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("" + path)
                            return res.data
                        } catch (e) {

                        }
                    },

                    async consultarCobrosIndividuales() {
                        if (!this.fecha_inicio || !this.fecha_fin) {
                            swal.fire('Atención', 'Por favor selecciona ambas fechas', 'warning');
                            return;
                        }

                        if (this.cliente_id === null || this.cliente_id === '') {
                            swal.fire('Atención', 'Por favor selecciona un cliente', 'warning');
                            return;
                        }

                        try {
                            block.block();
                            const res = await axios.post(
                                "{{ url('api/cobros/filtrar-cobros-individuales') }}", {
                                    fecha_inicio: this.fecha_inicio,
                                    fecha_fin: this.fecha_fin,
                                    cliente_id: this.cliente_id
                                });
                                this.cobrosIndividuales = res.data.cobrosIndividuales ? Object.values(res.data.cobrosIndividuales) : [];
                                dt.destroy();
                                await this.$nextTick(() => {
                                    dt.create({
                                        order: [
                                            [0, 'desc']
                                        ],
                                        paging: true,
                                        responsive: true,
                                        destroy: true,
                                    });
                                });
                            if (this.cobrosIndividuales.length > 0) {
                                //window.open(res.data.url_pdf, '_blank');
                            } else {
                                swal.fire('Información', 'No se encontraron resultados para el rango de fechas o el cliente seleccionado.', 'info');
                            }
                        } catch (e) {
                            swal.fire('Error', 'No se pudo obtener los datos', 'error');
                        } finally {
                            block.unblock();
                        }
                    },
                },
                mounted() {
                    this.$nextTick(async () => {
                        const hoy = new Date().toISOString().substr(0, 10);
                        this.fecha_inicio = hoy;
                        this.fecha_fin = hoy;
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
                            const choferes = await this.GET_DATA("{{ url('api/choferes') }}");
                            this.chofers = choferes;
                            const clientes = await this.GET_DATA("{{ url('api/clientes') }}");
                            this.clientes = clientes;
                        } catch (e) {
                            console.error("Error al iniciar:", e);
                        } finally {
                            block.unblock();
                             $(".select_cliente").select2({
                                tags: true,
                                placeholder: "Buscar",
                                data: this.clientes.map(cliente => ({
                                    id: cliente.id,
                                    text: cliente.nombre
                                }))
                            }).on('change', (e) => {
                                this.cliente_id = $(e.target).val();
                            });
                        }
                    });
                }


            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
