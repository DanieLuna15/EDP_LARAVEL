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
                                </svg> Reportes / Planillas</p>
                        </div>

                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group ">
                                            <label>Area</label>
                                            <div class="input-group mb-4">
                                                <select v-model="buscar_area" class="form-control" id="buscar_area1">

                                                    <option value="all">Todos</option>
                                                    <option v-for="(m,i) in areas" :value="m.name">{{ m . name }}
                                                    </option>

                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Fecha Inicio</label>
                                            <input type="date" class="form-control form-control-sm" v-model="fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Fecha Fin</label>
                                            <input type="date" class="form-control form-control-sm" v-model="fecha_fin">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group ">
                                            <label>Personal</label>
                                            <div class="input-group mb-4">
                                                <select v-model="contrato_id" class="form-control">

                                                    <option value="all">Todos</option>
                                                    <option v-for="(m,i) in contratos" :value="m.id">{{ m . persona . nombre }}
                                                    </option>

                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" @click="Consultar()"
                                                        type="button">Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">

                                    </div>
                                </div>

                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Area</th>
                                            <th>Planilla de Mes</th>
                                            <th>Sueldo Base</th>
                                            <th>Variable + </th>
                                            <th>Variable - </th>
                                            <th>Faltas</th>
                                            <th>Atrasos</th>
                                            <th>Horas Extras</th>
                                            <th>Cajas</th>
                                            <th>Sueldo Final</th>
                                            <th>Observacion</th>
                                            <th>Cargo</th>
                                            <th>Registro</th>
                                            <th>Usuario</th>
                                            <th>Sucursal</th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . contrato . persona . nombre }} {{ m . contrato . persona . apellidos }}</td>
                                            <td>{{ m . contrato . persona . documento . name }} {{ m . contrato . persona . doc }}</td>
                                            <td>{{ m . contrato . area . name }}</td>
                                            <td>{{ m . mes }}</td>
                                            <td>{{ m . sueldo }}</td>
                                            <td>{{ m . costos_1 }}</td>
                                            <td>{{ m . costos_2 }}</td>
                                            <td>{{ m . faltas }} = {{ m . faltas_n }}</td>
                                            <td>{{ m . atraso }} = {{ m . atraso_n }}</td>
                                            <td>{{ m . extras }} = {{ m . extras_n }}</td>
                                            <td>{{ m . venta }} = {{ m . venta_n }}</td>


                                            <td>{{ m . bruto }}</td>
                                            <td>{{ m . observacion }} </td>
                                            <td>{{ m . contrato . area . name }} </td>
                                            <td>{{ m . fecha }}</td>
                                            <td>{{ m . user . nombre }} </td>
                                            <td>{{ m . sucursal . nombre }} </td>

                                            <td>
                                                <div class="btn-group">
                                                    <a :href="m.url_pdf" target="_blank" class="btn btn-warning btn-sm">PDF</a>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split"
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
                        contrato_id: "all",
                        data: [],
                        users: [],
                        areas: [],
                        contratos: [],
                        buscar_area: 'all',
                        fecha_inicio: '',
                        fecha_fin: '',

                    }
                },
                methods: {
                    async Consultar() {
                        let self = this
                        try {
                            // dt.destroy()
                            // await Promise.all([ self.GET_DATA('api/reportes/contratos/planillas/'+this.contrato_id)]).then((v) => {

                            //     self.data = v[0]
                            // })

                            // dt.create()
                            let data = {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin
                            }

                            let res = await axios.post("{{ url('api/reportes/contratos/planillas-fecha') }}/" +
                                this.contrato_id, data).then((v) => {
                                self.data = v.data
                            })

                        } catch (e) {

                        }
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async load() {
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA('api/contratos'), self.GET_DATA('api/areas')])
                                    .then((v) => {

                                        self.contratos = v[0]
                                        self.areas = v[1]
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


                                    let url = "{{ url('api/proveedors') }}/" + id

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
                            await self.load()
                            $.fn.dataTable.ext.search.push(
                                function(settings, data, dataIndex) {
                                    var area = $('#buscar_area1').val()

                                    if ((data[3] == area) || (area == "all")) {
                                        return true;
                                    }
                                    return false;
                                }
                            );
                            // Event listener to the two range filtering inputs to redraw on input
                            $('#buscar_area1').change(function() {
                                dt.destroy()

                                dt.create();
                            });

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
