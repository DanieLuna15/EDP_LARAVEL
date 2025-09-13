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
                                </svg> Entregas / Reportes Cobranzas / Cuentas por cobrar</p>
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
                                <button class="btn btn-success mt-2" @click="consultarCuentasxCobrar()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <h5>Cuentas por Cobrar</h5>
                                <table id="table_dt_cuentas" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Venta ID</th>
                                            <th>Fecha Emision</th>
                                            <th>Sucursal</th>
                                            <th>Usuario</th>
                                            <th>Total pagado</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(ventas, cliente_id) in ventasCredito" :key="cliente_id">
                                            <template v-for="(venta, index) in ventas.ventas" :key="venta.id">
                                                <tr>
                                                    <th v-if="index === 0" :rowspan="ventas.ventas.length">
                                                        {{ ventas . cliente_nombre }}</th>
                                                    <td>#{{ venta . id }}</td>
                                                    <td>{{ venta . fecha }}</td>
                                                    <td>{{ venta . sucursal_nombre }}</td>
                                                    <td>{{ venta . usuario_nombre }}</td>
                                                    <td>{{ venta . pagado_total }}</td>
                                                    <td>{{ venta . pendiente_total }}</td>
                                                </tr>
                                            </template>

                                            <tr class="bg-light-success">
                                                <td colspan="6">TOTAL CLIENTE</td>


                                                <th>{{ ventas . total_saldo_pendiente }}</th>
                                            </tr>
                                        </template>

                                        <tr class="bg-light-info">
                                            <th colspan="6">TOTAL GENERAL</th>

                                            <th>{{ totalSaldosPendientes }}</th>
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
                        ventasCredito: [],
                        clientes: [],
                        cliente_id: 0,
                        totalSaldosPendientes: 0,
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

                    async consultarCuentasxCobrar() {
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
                                "{{ url('api/cuentasPorCobrar/filtrar-cuentas-por-cobrar') }}", {
                                    fecha_inicio: this.fecha_inicio,
                                    fecha_fin: this.fecha_fin,
                                    cliente_id: this.cliente_id
                                });
                            this.ventasCredito = res.data.ventasCredito ? Object.values(res.data.ventasCredito) :
                        [];
                            let totalPendientes = parseFloat(res.data.totalSaldosPendientes);
                            if (!isNaN(totalPendientes)) {
                                this.totalSaldosPendientes = totalPendientes.toFixed(2);
                            } else {
                                this.totalSaldosPendientes = '0.00';
                            }

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


                            if (this.ventasCredito.length > 0) {
                                window.open(res.data.url_pdf, '_blank');
                            } else {
                                swal.fire('Información',
                                    'No se encontraron resultados para el rango de fechas o el cliente seleccionado.',
                                    'info');
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
