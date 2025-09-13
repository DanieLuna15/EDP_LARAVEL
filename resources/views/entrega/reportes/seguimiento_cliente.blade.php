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
                                </svg> Entregas / Reportes / Seguimiento de cajas</p>
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
                                            <option disabled value="">Seleccione un Cliente</option>
                                            <option v-for="m in clientes" :value="m.id">{{ m . nombre }}
                                                {{ m . documento . name }} {{ m . doc }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 pt-4">
                                <button class="btn btn-success mt-2" @click="consultarSeguimiento()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <!-- Tabla de Entregas -->

                            <div class="table-responsive mb-4 mt-4">
                                 <h5>Entregas de EDP</h5>
                                <table id="table_dt_entregas" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Día</th>
                                            <th>ID PEDIDO</th>
                                            <th>Chofer</th>
                                            <th colspan="2">Cajas Entregadas al cliente</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(entrega, index) in entregas" :key="entrega.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ entrega . fecha }}</td>
                                            <td>{{ entrega . dia }}</td>
                                            <td>{{ entrega . id }}</td>
                                            <td>{{ entrega . chofer }}</td>
                                            <td colspan="2">{{ entrega . cajas_entregadas }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabla de Devoluciones -->
                            <div class="table-responsive mb-4 mt-4">
                                <h5>Devoluciones del Cliente</h5>
                                <table id="table_dt_devoluciones" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Día</th>
                                            <th>ID ENTREGA</th>
                                            <th>Chofer</th>
                                            <th>Cajas Devueltas</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(devolucion, index) in devoluciones" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ devolucion . fecha }}</td>
                                            <td>{{ devolucion . dia }}</td>
                                            <td>{{ devolucion . id }}</td>
                                            <td>{{ devolucion . chofer }}</td>
                                            <td>{{ devolucion . cajas_entregadas }}</td>
                                            <td>{{ devolucion . saldo }}</td>
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
                        fecha_inicio: '',
                        fecha_fin: '',
                        entregas: [],
                        devoluciones: [],
                        clientes: [],
                        cliente_id: '',
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

                    async consultarSeguimiento() {
                        if (!this.fecha_inicio || !this.fecha_fin) {
                            swal.fire('Atención', 'Por favor selecciona ambas fechas', 'warning');
                            return;
                        }
                        if (!this.cliente_id) {
                            swal.fire('Atención', 'Por favor selecciona un cliente', 'warning');
                            return;
                        }
                        try {
                            block.block();
                            const res = await axios.post(
                                "{{ url('api/entregaCajas/filtrar-seguimiento-cliente') }}", {
                                    fecha_inicio: this.fecha_inicio,
                                    fecha_fin: this.fecha_fin,
                                    cliente_id: this.cliente_id
                                });

                            this.entregas = res.data.entregas || [];
                            this.devoluciones = res.data.devoluciones || [];

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

                            if (this.entregas.length > 0) {
                                window.open(res.data.url_pdf, '_blank');
                            } else {
                                swal.fire('Información',
                                    'No se encontraron resultados para el rango de fechas o el cliente seleccionado.',
                                    'info'
                                );
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
                                data: this.clientes.map(cliente => ({ id: cliente.id, text: cliente.nombre }))
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
