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
                                </svg> Finanzas / Reportes / Cobranzas x Chofer</p>
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
                                    <label>Chofer</label>
                                    <div class="input-group mb-4">
                                        <select class="form-control select_chofer" v-model="chofer_id">
                                            <option disabled value="">Seleccione un chofer</option>
                                           <template v-for="m in chofers">
                                                <option :value="m.id">
                                                    {{ m.nombre }}{{ m.documento?.name ? ' - ' + m.documento.name : '' }}{{ m.doc ? ' - ' + m.doc : '' }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>
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
                                            <th>#</th>
                                            <th>ID Pedido</th>
                                            <th>REC.</th>
                                            <th>Código</th>
                                            <th>Cliente</th>
                                            <th>Forma Pago</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(venta, index) in ventas" :key="venta.recibo">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ venta . id_pedido }}</td>
                                            <td>{{ venta . recibo }}</td>
                                            <td>{{ venta . codigo }}</td>
                                            <td>{{ venta . cliente }}</td>
                                            <td>{{ venta . forma_pago }}</td>
                                            <td>{{ Number(venta . monto) . toFixed(2) }}</td>
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
                        ventas: [],
                        chofers: [],
                        chofer_id: '',
                    }
                },
                watch: {
                    chofers() {
                        this.$nextTick(() => this.initSelectChofer());
                    }
                },
                methods: {
                    initSelectChofer() {
                        const vm = this;
                        const $sel = $(".select_chofer");
                        try { $sel.select2('destroy'); } catch (e) {}
                        $sel.select2({
                            placeholder: "Seleccione un chofer",
                            allowClear: true,
                            width: '100%'
                        });
                        // Sync select2 -> Vue
                        $sel.off('change.select2.vue').on('change.select2.vue', function () {
                            const val = $(this).val();
                            vm.chofer_id = val === null ? '' : val;
                        });
                        // Apply current value Vue -> select2
                        $sel.val(vm.chofer_id ?? '').trigger('change.select2');
                    },
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
                        if (!this.chofer_id) {
                            swal.fire('Atención', 'Por favor selecciona un chofer', 'warning');
                            return;
                        }
                        try {
                            block.block();
                            const res = await axios.post("{{ url('api/cobranzaGastos/filtrar-por-chofer') }}", {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin,
                                chofer_id: Number(this.chofer_id)
                            });

                            this.ventas = res.data.ventas || res
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

                            if (this.ventas.length > 0) {
                                window.open(res.data.url_pdf, '_blank');
                            } else {
                                swal.fire('Información',
                                    'No se encontraron resultados para el rango de fechas o el chofer seleccionado.',
                                    'info'
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
                            await this.$nextTick(() => this.initSelectChofer());

                        } catch (e) {
                            console.error("Error al iniciar:", e);
                        } finally {
                            block.unblock();
                        }
                    });
                }


            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
