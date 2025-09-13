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
                                </svg> Composicion / Externa / {{ externa . name }}</p>
                        </div>
                        <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name=''"
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
                                            <label for="inputEmail4">Nombre</label>
                                            <input type="text" v-model="model.name" class="form-control" placeholder="Nombre">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Cantidad</label>
                                            <input type="text" v-model="model.cantidad" class="form-control" placeholder="Cant">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Peso</label>
                                            <input type="text" v-model="model.peso" class="form-control" placeholder="Peso">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Compra</label>
                                            <input type="text" v-model="model.compra" class="form-control" placeholder="Compra">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Venta</label>
                                            <input type="text" v-model="model.venta" class="form-control" placeholder="Venta">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Venta</label>
                                            <select name="" id="" class="form-control" v-model="model.principal">
                                                <option :value="1">PRINCIPAL</option>
                                                <option :value="0">SECUNDARIO</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
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
                                            <th>Cantidad</th>
                                            <th>Peso</th>
                                            <th>Compra</th>
                                            <th>Venta</th>
                                            <th>PRINCIPAL</th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in externa.compo_externa_detalles">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . name }}</td>
                                            <td>{{ m . cantidad }}</td>
                                            <td>{{ m . peso }}</td>
                                            <td>{{ m . compra }}</td>
                                            <td>{{ m . venta }}</td>
                                            <td>{{ m . principal == 1 ? 'PRINCIPAL' : 'SECUNDARIO' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="modal" @click="add=false,model=m"
                                                        data-target="#exampleModal" type="button"
                                                        class="btn btn-warning btn-sm">Editar</button>
                                                    <button type="button"
                                                        class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
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
                                                        <a :href="'./externa/detalles/' + m.id" class="dropdown-item">Detalles</a>
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
                        model: {
                            name: '',
                            princial: 0,
                        },
                        data: [],
                        externa: {
                            compo_externa_detalles: []
                        }
                    }
                },
                methods: {
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            this.model.compo_externa_id = this.externa.id
                            let url = "{{ url('api/compoExternaDetalles') }}";
                            if (this.add == false) {
                                url = "{{ url('api/compoExternaDetalles') }}/" + this.model.id
                                let res = await axios.put(url, this.model)
                                dt.destroy()
                                await this.load()
                                dt.create()
                            } else {
                                let res = await axios.post(url, this.model)
                                dt.destroy()
                                await this.load()
                                dt.create()

                            }
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
                                await Promise.all([self.GET_DATA(
                                    "{{ url('api/compoExternas') }}/{{ $id }}")]).then((v) => {
                                    self.externa = v[0]
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


                                    let url = "{{ url('api/compoExternas') }}/" + id

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
                            await Promise.all([self.load()]).then((v) => {

                            })
                            dt.create()

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
