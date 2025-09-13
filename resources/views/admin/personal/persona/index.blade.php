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
                                </svg> Personas / Persona</p>
                        </div>
                        <a href="./persona/add" class="btn btn-success">Agregar</a>
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
                                            <th>Apellido</th>
                                            <th>Documento</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Tel Coor</th>
                                            <th>Garante</th>
                                            <th>Imagen</th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . nombre }}</td>
                                            <td>{{ m . apellidos }}</td>
                                            <td>{{ m . documento . name }} {{ m . doc }}</td>
                                            <td>{{ m . direccion }}</td>
                                            <td>{{ m . telefono }}</td>
                                            <td>{{ m . tel_cor }}</td>
                                            <td>{{ m . garante }}</td>
                                            <td>
                                                <div class="media" v-if="m.image!=null">
                                                    <img :src="m.image.path_url" onerror="this.style.display='none'"
                                                        class="img-fluid" alt="File" style="width: 50px;">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a :href="'./persona/edit/' + m.id" class="btn btn-warning btn-sm">Editar</a>
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
                                                        <a :href="'./persona/image/' + m.id" class="dropdown-item">Imagen</a>
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


            const {
                createApp
            } = Vue

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
                            let url = "{{ url('api/personas') }}";
                            if (this.add == false) {
                                url = "{{ url('api/personas') }}/" + this.model.id
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
                                await Promise.all([self.GET_DATA("{{ url('api/personas') }}")]).then((v) => {
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


                                    let url = "{{ url('api/personas') }}/" + id

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
                        try {
                            await Promise.all([self.load()])
                            dt.create()
                        } catch (e) {} finally {
                        }

                        // ⬇️ Mostrar mensaje de éxito si existe
                        const message = sessionStorage.getItem('success_message');
                        if (message) {
                            swal({
                                title: "¡Éxito!",
                                text: message,
                                type: "success",
                                button: "Aceptar"
                            });
                            sessionStorage.removeItem('success_message');
                        }
                    })
                }

            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
