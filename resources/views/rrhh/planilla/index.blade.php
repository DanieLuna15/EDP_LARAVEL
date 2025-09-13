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
                                </svg> RRHH / Planillas</p>
                        </div>
                        <div class="action-btn layout-top-spacing mb-5">
                            <a href="./planillas/add" class="btn btn-success">Agregar</a>
                            <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#modalCargaMasiva">
                                Carga Masiva
                            </button>
                        </div>
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
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Monto</th>
                                            <th>Planilla de Mes</th>
                                            <th>Registro</th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . contrato . persona . nombre }} {{ m . contrato . persona . apellidos }}</td>
                                            <td>{{ m . contrato . persona . documento . name }} {{ m . contrato . persona . doc }}
                                            </td>
                                            <td>{{ m . bruto }}</td>
                                            <td>{{ m . mes }}</td>
                                            <td>{{ m . fecha }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <a :href="m.url_pdf" target="_blank" class="btn btn-success btn-sm">PDF</a>
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
        <div class="modal fade" id="modalCargaMasiva" tabindex="-1" role="dialog" aria-labelledby="modalCargaMasivaLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCargaMasivaLabel">Carga Masiva de Planillas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fileExcel">Subir archivo Excel (.xlsx)</label>
                            <input type="file" id="fileExcel" @change="handleFileUpload" ref="file" accept=".xlsx"
                                class="form-control-file">
                        </div>
                        <button class="btn btn-success w-100" @click="submitFile" :disabled="!file">
                            Cargar
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <!-- 3) Nombre de ruta corregido -->
                        <a href="{{ route('planillas.downloadTemplate') }}" target="_blank" class="btn btn-dark">
                            Descargar Plantilla
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                        data: [],
                        file: null
                    }
                },
                methods: {
                    async load() {
                        block.block()
                        try {
                            const res = await axios.get("{{ url('api/planillas') }}")
                            this.data = res.data
                        } finally {
                            block.unblock()
                        }
                    },
                    async Save() {
                        try {
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
                                await Promise.all([self.GET_DATA("{{ url('api/planillas') }}")]).then((v) => {
                                    self.data = v[0]
                                })

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                    async submitFile() {
                        if (!this.file) return
                        const form = new FormData()
                        form.append('excel', this.file)
                        try {
                            const res = await axios.post(
                                '{{ route('planillas.import') }}',
                                form, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }
                            )
                            swal.fire({
                                title: 'Importación completada',
                                text: `Importación completada: ${res.data.imported} planillas`,
                                type: 'success',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-success'
                            })
                            this.load()
                            this.file = null
                            document.getElementById('fileExcel').value = ''
                            $('#modalCargaMasiva').modal('hide')
                        } catch (e) {
                            swal.fire({
                                title: 'Error',
                                text: 'Ocurrio un error al importar el archivo',
                                type: 'error',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            })
                        }
                    },
                    handleFileUpload(event) {
                        this.file = event.target.files[0]
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
                            await Promise.all([self.load()]).then((v) => {})
                            dt.create()
                        } catch (e) {} finally {
                            block.unblock();
                        }
                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
