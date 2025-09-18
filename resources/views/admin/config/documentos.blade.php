@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="action-btn layout-top-spacing mb-5">
                    <div class="page-header">
                        <div class="page-title">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg> Configuración / Documentos
                            </p>
                        </div>
                        <button data-toggle="modal" data-target="#exampleModal" @click="add=true, model.name=''"
                            class="btn btn-success">
                            Agregar
                        </button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">{{ add ? 'Agregar' : 'Actualizar' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Nombre</label>
                                            <input type="text" v-model="model.name" class="form-control" placeholder="Nombre">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button @click="Save" id="submitBtn" type="button" data-dismiss="modal"
                                        class="btn btn-success" :disabled="isSubmitting">
                                        <span v-if="isSubmitting">
                                            <i class="fa fa-spinner fa-spin"></i> Guardando...
                                        </span>
                                        <span v-else>Guardar</span>
                                    </button>
                                </div>
                            </div>
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
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m, i) in data">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="modal" @click="add=false, model=m"
                                                        data-target="#exampleModal" type="button"
                                                        class="btn btn-warning btn-sm">Editar</button>
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
            import Table from "{{ asset('../config/dt.js') }}"
            import Block from "{{ asset('../config/block.js') }}"

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
                        isSubmitting: false, // Añadimos un estado para saber si el botón está en proceso de envío
                    }
                },

                methods: {
                    async Save() {
                        this.isSubmitting = true;

                        try {
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/documentos') }}";
                            let res;
                            if (!this.add) {
                                url = "{{ url('api/documentos') }}/" + this.model.id;
                                res = await axios.put(url, this.model);
                            } else {
                                res = await axios.post(url, this.model);
                            }
                            dt.destroy();
                            await this.load();
                            dt.create();

                            // Mostrar mensaje de éxito con SweetAlert
                            if (res.data.success) {
                                // Cerrar el modal
                                $('#exampleModal').modal('hide');

                                swal({
                                    title: "¡Éxito!",
                                    text: res.data.success,
                                    type: "success",
                                    button: "Aceptar"
                                });
                            }
                        } catch (e) {
                            // Mostrar mensaje de error con SweetAlert
                            if (e.response && e.response.data.error) {
                                const errorMessage = e.response.data.error.name ? e.response.data.error.name[0] :
                                    e.response.data.error[Object.keys(e.response.data.error)[0]][0] ||
                                    "Hubo un problema al guardar el documento.";

                                swal({
                                    title: "¡Error!",
                                    text: errorMessage,
                                    type: "error",
                                    button: "Aceptar"
                                });
                            } else {
                                swal({
                                    title: "¡Error!",
                                    text: "Hubo un problema al guardar el documento.",
                                    type: "error",
                                    button: "Aceptar"
                                });
                            }
                        } finally {
                            this.isSubmitting = false;
                        }
                    },


                    async GET_DATA(path) {
                        try {
                            let res = await axios.get(path);
                            return res.data;
                        } catch (e) {
                            swal({
                                title: "¡Error!",
                                text: "Hubo un problema al obtener los datos.",
                                type: 'error',
                                type: "error",
                                button: "Aceptar"
                            });
                        }
                    },

                    async load() {
                        try {
                            let self = this;
                            await Promise.all([self.GET_DATA("{{ url('api/documentos') }}")]).then((v) => {
                                self.data = v[0];
                            });
                        } catch (e) {
                            swal({
                                title: "¡Error!",
                                text: "Hubo un problema al cargar los datos.",
                                type: 'error',
                                button: "Aceptar"
                            });
                        }
                    },

                    deleteItem(id) {
                        let self = this;
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro?',
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
                                    let url = "{{ url('api/documentos') }}/" + id;
                                    let res = await axios.delete(url);
                                    dt.destroy();
                                    await self.load();
                                    dt.create();

                                    if (res.data.success) {
                                        swal({
                                            title: "¡Eliminado!",
                                            text: res.data.success,
                                            type: 'success',
                                            button: "Aceptar"
                                        });
                                    }
                                } catch (e) {
                                    swal({
                                        title: "¡Error!",
                                        text: e.response.data.error ||
                                            "Hubo un problema al eliminar el documento.",
                                        type: 'error',
                                        button: "Aceptar"
                                    });
                                }
                            }
                        });
                    }
                },

                mounted() {
                    this.$nextTick(async () => {
                        let self = this;
                        block.block();
                        try {
                            await Promise.all([self.load()]).then((v) => {});
                            dt.create();
                        } catch (e) {} finally {
                            block.unblock();
                        }
                    });
                }
            }).mount('#meApp');
        </script>
    @endslot
@endcomponent
