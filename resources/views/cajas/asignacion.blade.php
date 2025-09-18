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
                                </svg> Asignar usuarios a Caja / {{ data . name }} - {{ data . sucursal . nombre }}</p>
                        </div>
                        <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name='',model.user_id=''"
                            class="btn btn-success">Agregar</button>
                    </div>


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">{{ add == true ? 'Agregar' : 'Actualizar' }}</h5>
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
                                            <label for="inputEmail4">Usuario</label>
                                            <div class="input-group">
                                                <select v-model="model.user_id" class="form-control select_cliente">
                                                    <option disabled value="">Seleccione un Usuario</option>
                                                    <option v-for="s in users" :value="s.id">{{ s . nombre }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                                    <button @click="Save()" type="button" data-dismiss="modal"
                                        class="btn btn-success">Guardar</button>
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




                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data.caja_sucursal_usuarios">
                                            <td>{{ i + 1 }}</td>

                                            <td>{{ m . user . nombre }}</td>


                                            <td>
                                                <div class="btn-group">
                                                    <button @click="deleteItem(m.id)" type="button"
                                                        class="btn btn-dark btn-sm">Eliminar</button>

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
                        model: {
                            name: '',
                            user_id: 1,

                        },
                        data: {
                            sucursal: {

                            },
                            caja_sucursal_usuarios: []
                        },
                        users: []

                    }
                },
                watch: {
                    users() {
                        this.$nextTick(() => this.initSelectCliente());
                    }
                },
                methods: {
                    initSelectCliente() {
                        const vm = this;
                        const $sel = $(".select_cliente");
                        // destruir instancias previas para evitar handlers duplicados
                        try { $sel.select2('destroy'); } catch (e) {}
                        // inicializar select2 en el select del modal
                        $sel.select2({
                            placeholder: "Seleccione un Usuario",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $('#exampleModal')
                        });
                        // sincronizar cambios de select2 -> Vue model
                        $sel.off('change.select2.vue').on('change.select2.vue', function () {
                            const val = $(this).val();
                            vm.model.user_id = val === null ? '' : val;
                        });
                        // aplicar valor actual si existe (Vue -> select2)
                        $sel.val(vm.model.user_id ?? '').trigger('change.select2');
                    },
                    async Save() {
                        try {
                            // Validar selección
                            if (!this.model.user_id) {
                                swal({ title: 'Atención', text: 'Seleccione un usuario', type: 'warning', button: 'Aceptar' });
                                return;
                            }
                            // Normalizar tipos y preparar payload
                            const payload = {
                                caja_sucursal_id: this.data.id,
                                user_id: Number(this.model.user_id)
                            };
                            let url = "{{ url('api/cajaSucursalUsuarios') }}";
                            if (this.add == false) {
                                url = `{{ url('api/cajaSucursalUsuarios') }}/${this.model.id}`;
                                await axios.put(url, payload)
                            } else {
                                await axios.post(url, payload)
                            }
                            // Refrescar tabla tras guardar
                            dt.destroy();
                            await this.load();
                            await this.$nextTick(() => { dt.create() });
                            // Feedback y reset
                            swal({ title: 'Guardado', text: 'Asignación registrada', type: 'success', button: 'OK' });
                            this.model.user_id = '';
                            this.$nextTick(() => this.initSelectCliente());
                        } catch (e) {
                            swal({ title: 'Error', text: 'No se pudo guardar la asignación', type: 'error', button: 'Aceptar' });
                            console.error('Save error:', e);
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
                                await Promise.all([self.GET_DATA("{{ url('api/users') }}"),
                                    self.GET_DATA("{{ url('api/cajaSucursals') }}/{{ $id }}")
                                ]).then((v) => {
                                    self.users = v[0]
                                    self.data = v[1]
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


                                    let url = "{{ url('api/cajaSucursalUsuarios') }}/" + id

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
                            await Promise.all([self.load()])
                            await self.$nextTick(() => { dt.create() })

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                        $('#exampleModal').on('shown.bs.modal', () => {
                            this.$nextTick(() => this.initSelectCliente());
                        });
                        this.$nextTick(() => this.initSelectCliente());
                        // do whatever you want if console is [object object] then stringify the response




                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
