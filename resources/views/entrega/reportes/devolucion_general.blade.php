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
                                </svg> Entregas / Reportes / Devolucion General de Cajas</p>
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
                                <button class="btn btn-success mt-2" @click="consultarDevoluciones()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Chofer</th>
                                            <th>Cliente</th>
                                            <th>Saldo Anterior</th>
                                            <th>Cantidad Devuelta</th>
                                            <th>Saldo Actual</th>
                                            <th>Cajas a Favor</th>
                                            <th>Usuario/Chofer</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(fechas, fecha) in devoluciones">
                                            <template v-for="(choferes, chofer) in fechas" :key="fecha + chofer">
                                                <tr v-for="(devolucion, index) in choferes" :key="fecha + chofer + index">
                                                    <td v-if="index === 0" rowspan="choferes.length">{{ fecha }}</td>
                                                    <td v-if="index === 0" rowspan="choferes.length">{{ chofer }}</td>
                                                    <td>{{ devolucion . cliente }}</td>
                                                    <td>{{ devolucion . saldo_anterior }}</td>
                                                    <td>{{ devolucion . cantidad_devuelta }}</td>
                                                    <td>{{ devolucion . saldo_actual }}</td>
                                                    <td>{{ devolucion . cajas_a_favor }}</td>
                                                    <td>{{ devolucion . usuario }}</td>
                                                     <td>


                                                        <a :href="devolucion.url_pdf_cajas" target="_blank" class="btn btn-info btn-sm">...</a>
                                                        <a :href="devolucion.url_pdf_cajas_chofer" target="_blank" class="btn btn-success btn-sm">...</a>

                                                    </td>
                                                </tr>
                                            </template>
                                        </template>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Totales</th>
                                            <th>{{ totalDevolucion }}</th>
                                            <th>{{ totalSaldoActual }}</th>
                                            <th>{{ totalCajasAFavor }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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
                        devoluciones: [],
                        totalDevolucion: 0,
                        totalSaldoActual: 0,
                        totalCajasAFavor: 0,
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

                    async consultarDevoluciones() {
                        if (!this.fecha_inicio || !this.fecha_fin) {
                            swal.fire('Atención', 'Por favor selecciona ambas fechas', 'warning');
                            return;
                        }

                        try {

                            // Obtener datos desde el servidor
                            const res = await axios.post("{{ url('api/entregaCajas/filtrar') }}", {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin
                            });

                            if (res.data.devoluciones) {
                                let devoluciones = [];
                                for (const fecha in res.data.devoluciones) {
                                    for (const chofer in res.data.devoluciones[fecha]) {
                                        for (const devolucion of res.data.devoluciones[fecha][chofer]) {
                                            devoluciones.push({
                                                fecha,
                                                chofer,
                                                cliente: devolucion.cliente,
                                                saldo_anterior: devolucion.saldo_anterior,
                                                cantidad_devuelta: devolucion.cantidad_devuelta,
                                                saldo_actual: devolucion.saldo_actual,
                                                cajas_a_favor: devolucion.cajas_a_favor,
                                                usuario: devolucion.usuario,
                                                url_pdf_cajas: devolucion.url_pdf_cajas,
                                                url_pdf_cajas_chofer: devolucion.url_pdf_cajas_chofer,
                                            });
                                        }
                                    }
                                }
                                this.devoluciones = devoluciones;
                                this.totalDevolucion = res.data.totalDevolucion;
                                this.totalSaldoActual = res.data.totalSaldoActual;
                                this.totalCajasAFavor = res.data.totalCajasAFavor;

                            } else {
                                swal.fire('Información',
                                    'No se encontraron resultados para el rango de fechas seleccionado.', 'info'
                                );
                                return;
                            }

                            dt.destroy();
                            await this.$nextTick(() => {
                                dt.create({
                                    data: this.devoluciones,
                                    columns: [{
                                            data: 'fecha'
                                        },
                                        {
                                            data: 'chofer'
                                        },
                                        {
                                            data: 'cliente'
                                        },
                                        {
                                            data: 'saldo_anterior'
                                        },
                                        {
                                            data: 'cantidad_devuelta'
                                        },
                                        {
                                            data: 'saldo_actual'
                                        },
                                        {
                                            data: 'cajas_a_favor'
                                        },
                                        {
                                            data: 'usuario'
                                        },
                                        {
                                            data: null,
                                            orderable: false,
                                            searchable: false,
                                            render: function (data, type, row) {
                                                const a = row.url_pdf_cajas
                                                    ? `<a href="${row.url_pdf_cajas}" target="_blank" class="btn btn-info btn-sm" title="Dev. Cajas (adm)">
                                                        <i class="fa fa-print"></i> Adm.
                                                    </a>`
                                                    : '';
                                                const b = row.url_pdf_cajas_chofer
                                                    ? `<a href="${row.url_pdf_cajas_chofer}" target="_blank" class="btn btn-success btn-sm" title="Dev. Cajas (chofer)">
                                                        <i class="fa fa-print"></i> Chofer
                                                    </a>`
                                                    : '';
                                                return `<div class="d-inline-flex gap-1">${a}${b}</div>`;
                                            }
                                        }
                                    ],
                                    order: [
                                        [0, 'asc']
                                    ],
                                    paging: true,
                                    responsive: true,
                                    destroy: true,
                                });
                            });

                            if (this.devoluciones.length > 0) {
                                window.open(res.data.url_pdf, '_blank');
                            }
                        } catch (e) {
                            swal.fire('Error', 'No se pudo obtener los datos. Detalles del error: ' + (e.message ||
                                e), 'error');
                        } finally {}
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
