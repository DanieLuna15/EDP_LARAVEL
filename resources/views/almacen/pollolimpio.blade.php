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
                                </svg> Almacen / Pollo Limpio</p>
                        </div>
                        <div>
                            <button @click="formula=!formula" class="btn "
                                :class="formula == true ? 'btn-warning' : 'btn-danger'">{{ formula == true ? 'CON FORMULA' : 'SIN FORMULA' }}</button>
                            <button @click="ActualizarPrecios" class="btn btn-success">Actualizar Precios</button>
                            <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name='',model.venta_2=0"
                                class="btn btn-success">Agregar</button>
                        </div>
                    </div>


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
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
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Nombre</label>
                                                                <input type="text" v-model="model.name" class="form-control"
                                                                    placeholder="Nombre">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Precio CBBA</label>
                                                                <input type="text" v-model="model.precio" class="form-control"
                                                                    placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="row">


                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 1 A 14 POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_1"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">OFICIAL (15 A 75 POLLOS)</label>
                                                                <input type="text" v-model.number="model.venta_2"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 76 A 150 POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_3"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>

                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 151 A MAS POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_4"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">CUALQUIER CANTIDAD AL CONTADO</label>
                                                                <input type="text" v-model="model_producto.venta_5"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">VIP</label>
                                                                <input type="text" v-model="model_producto.venta_6"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


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
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>PRECIO CBBA</th>

                                            <th>

                                                DE 1 A 14 POLLOS
                                            </th>
                                            <th>

                                                OFICIAL (15 A 75 POLLOS)
                                            </th>
                                            <th>

                                                DE 76 A 150 POLLOS
                                            </th>
                                            <th>

                                                DE 151 A MAS POLLOS
                                            </th>
                                            <th>

                                                CUALQUIER CANTIDAD AL CONTADO
                                            </th>
                                            <th>

                                                VIP
                                            </th>
                                            <th>

                                                CAMBIOS DE PRECIO
                                            </th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data_model">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m . name }}</td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.precio"></td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.venta_1"></td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                    :disabled="m.cambios >= 4" v-model="m.venta_2_valor"></td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.venta_3"></td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.venta_4"></td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.venta_5"></td>
                                            <td><input type="text" class="form-control form-control-sm" :disabled="formula"
                                                    v-model="m.venta_6"></td>

                                            <td>
                                                <div class="icon-container">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #28a745;"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-check-circle">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                    </svg><span class="icon-name"> </span>
                                                    {{ m . cambios }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="modal" @click="add=false,model=m"
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
                    <div class="col-lg-8 mt-2">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>PRODUCTO</th>
                                            <th>PESO </th>
                                            <th>PRECIO </th>

                                            <th>

                                                PROMEDIO
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>POLLO </td>
                                            <td><input type="text" v-model="pollolimpio.peso_1"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_1"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_1 * pollolimpio.precio_1).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td>POLLO LIMPIO</td>
                                            <td><input type="text" v-model="pollolimpio.peso_2"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_2"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_2 * pollolimpio.precio_2).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td>CUELLO</td>
                                            <td><input type="text" v-model="pollolimpio.peso_3"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_3"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_3 * pollolimpio.precio_3).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td>MENUDO</td>
                                            <td><input type="text" v-model="pollolimpio.peso_4"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_4"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_4 * pollolimpio.precio_4).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td>HIGADO</td>
                                            <td><input type="text" v-model="pollolimpio.peso_5"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_5"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_5 * pollolimpio.precio_5).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td>GRASA</td>
                                            <td><input type="text" v-model="pollolimpio.peso_6"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text" v-model="pollolimpio.precio_6"
                                                    class="form-control form-control-sm"></td>
                                            <td><input type="text"
                                                    :value="Number(pollolimpio.peso_6 * pollolimpio.precio_6).toFixed(2)"
                                                    class="form-control form-control-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <button class="btn btn-block btn-primary" @click="savePollo">GUARDAR</button>
                                </div>
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
                            cinta: 1,
                            precio: 0,
                            venta_1: 0,
                            venta_2: 0,
                            venta_3: 0,
                            venta_4: 0,
                            venta_5: 0,
                            venta_6: 0,

                        },
                        data: [],
                        formula: true,
                        sucursal: {},
                        usuario: {},
                        pollolimpio: {
                            peso_1: 0,
                            precio_1: 0,
                            peso_2: 0,
                            precio_2: 0,
                            peso_3: 0,
                            precio_3: 0,
                            peso_4: 0,
                            precio_4: 0,
                            peso_5: 0,
                            precio_5: 0,
                            peso_6: 0,
                            precio_6: 0,
                        }

                    }
                },
                computed: {
                    data_model() {
                        let self = this
                        if (self.formula == true) {
                            return self.data.map(function(m) {
                                let oficial = Number(m.venta_2_valor)
                                m.venta_1 = Number(oficial + 0.2).toFixed(2)
                                m.venta_3 = Number(oficial - 0.1).toFixed(2)
                                m.venta_4 = Number(oficial - 0.2).toFixed(2)
                                m.venta_5 = Number(oficial - 0.2).toFixed(2)
                                m.venta_6 = Number(oficial - 0.4).toFixed(2)
                                return m
                            })
                        }
                        return self.data
                    },
                    model_producto() {
                        let self = this
                        let oficial = Number(this.model.venta_2)
                        this.model.venta_1 = Number(oficial + 0.2).toFixed(2)
                        this.model.venta_3 = Number(oficial - 0.1).toFixed(2)
                        this.model.venta_4 = Number(oficial - 0.2).toFixed(2)
                        this.model.venta_5 = Number(oficial - 0.2).toFixed(2)
                        this.model.venta_6 = Number(oficial - 0.4).toFixed(2)
                        return this.model
                    }
                },
                methods: {
                    async ActualizarPrecios() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/pollolimpio-cambios') }}";
                            let data = {
                                sucursal_id: this.sucursal.id,
                                usuario_id: this.usuario.id,
                                data: this.data
                            }
                            let res = await axios.post(url, data)

                            await this.load()

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Precios Actualizados',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',

                                reverseButtons: true,
                                padding: '2em'
                            })
                            window.open(res.data.url_pdf, '_blank');
                        } catch (e) {

                        }
                    },
                    async savePollo() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/promedioPollolimpios') }}";
                            let pollo = {
                                ...this.pollolimpio
                            }
                            pollo.sucursal_id = this.sucursal.id

                            let res = await axios.post(url, pollo)

                            await this.load()

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Precios Actualizados',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',

                                reverseButtons: true,
                                padding: '2em'
                            })

                        } catch (e) {

                        }
                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/pollolimpios') }}";
                            if (this.add == false) {
                                url = "{{ url('api/pollolimpios') }}/" + this.model.id
                                let res = await axios.put(url, this.model)

                                await this.load()

                            } else {
                                let res = await axios.post(url, this.model)

                                await this.load()


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
                                await Promise.all([self.GET_DATA("{{ url('api/pollolimpio-sucursal') }}/" + this
                                        .sucursal.id),
                                    self.GET_DATA("{{ url('api/promedioPollolimpio-sucursal') }}/" + this
                                        .sucursal.id)
                                ]).then((v) => {
                                    self.data = v[0]
                                    self.pollolimpio = v[1]
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


                                    let url = "{{ url('api/pollolimpios') }}/" + id

                                    await axios.delete(url)

                                    await self.load()

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
                            let sucursal = localStorage.getItem('AppSucursal')
                            this.sucursal = JSON.parse(sucursal)
                            let usuario = localStorage.getItem('AppUser')
                            this.usuario = JSON.parse(usuario)
                            await Promise.all([self.load()]).then((v) => {

                            })


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

    @slot('style')
        <style>
            .modal-lg,
            .modal-xl {
                max-width: 1000px;
            }

            .form-group label,
            label {
                font-size: 10px;
                color: #000000;
                font-weight: 700;
                letter-spacing: 1px;
            }
        </style>
    @endslot
@endcomponent
