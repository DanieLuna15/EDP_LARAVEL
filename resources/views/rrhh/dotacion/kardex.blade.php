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
                                    class="feather feather-briefcase">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Kardex Dotaciones
                            </p>
                        </div>

                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">

                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group"><label for="">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-sm" v-model="fecha_1"></div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group"><label for="">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-sm" v-model="fecha_2"></div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Producto </label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" v-model="dotacion_id" id="familia">
                                            <option value="all">Todo</option>
                                                <option v-for="(f,i) in dotacions" :value="f.id">{{ f.name }}</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Familia </label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" v-model="familia_id" id="familia">
                                            <option value="all">Todo</option>
                                                <option v-for="(f,i) in familias" :value="f.id">{{ f.name }}</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Usuario </label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" v-model="user_id" id="familia">
                                            <option value="all">Todo</option>
                                                <option v-for="(f,i) in users" :value="f.id">{{ f.nombre }}</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Sucursal </label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" v-model="sucursal_id" id="familia">
                                                <option value="all">Todo</option>
                                                <option v-for="(f,i) in sucursals" :value="f.id">{{ f.nombre }}</option>
                                            </select>

                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" @click="getKardex()">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"></div>
                            </div>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>M</th>
                                            <th>Movimiento</th>
                                            <th>Nombre</th>
                                            <th>Familia</th>
                                            <th>Entradas</th>
                                            <th>Salidas</th>
                                            <th>Costo</th>
                                            <th>Venta</th>
                                            <th>Tipo</th>
                                            <th>Stock Actuak</th>
                                            <th>Fecha</th>

                                            <th>Sucursal</th>
                                            <th>Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in data">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ m.movimiento==1 ? 'ENTRADA' : 'SALIDA' }}</td>
                                            <td>{{ m.dotacion.name }}</td>
                                            <td>{{ m.familia.name }}</td>
                                            <td>{{ m.entradas}}</td>
                                            <td>{{ m.salidas}}</td>
                                            <td>{{ m.costo }}</td>
                                            <td>{{ m.venta }}</td>
                                            <td>{{ m.tipo }}</td>
                                            <td>{{ m.stock }}</td>
                                            <td>{{ m.fechatime }}</td>
                                            <td>
                                              {{m.sucursal.nombre}}
                                            </td>
                                            <td>
                                              {{m.user.nombre}}
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
                            familia_id: 1,
                        },
                        data: [],
                        fecha_1:'',
                        fecha_2:'',
                        dotacions: [],
                        dotacion_id: 'all',
                        sucursal: {
                            id: 1
                        },
                        familia_id: 'all',
                        user_id:'all',
                        sucursal_id:'all',
                        familias:[],
                        users:[],
                        sucursals:[]

                    }
                },
                methods: {
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/dotacions') }}";
                            if (this.add == false) {
                                url = "{{ url('api/dotacions') }}/" + this.model.id
                                let res = await axios.put(url, this.model)
                            } else {
                                let res = await axios.post(url, this.model)

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
                    async getKardex() {
                      try {
                        let data = {
                          fecha_1: this.fecha_1,
                          fecha_2: this.fecha_2,
                          dotacion_id: this.dotacion_id,
                          sucursal_id: this.sucursal.id,
                          user_id: this.user_id,
                          familia_id: this.familia_id
                        }
                        dt.destroy()
                        let res = await axios.post("{{ url('api/kardexDotacionFecha') }}", data).then((v) =>{
                            this.data = v.data
                        })


                      } catch (error) {

                      }finally{
                        $('#table_dt').DataTable( {
                                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                    buttons: {
                                        buttons: [
                                            { extend: 'copy', className: 'btn' },
                                            { extend: 'csv', className: 'btn' },
                                            { extend: 'excel', className: 'btn' },
                                            { extend: 'print', className: 'btn' }
                                        ]
                                    },
                                    order:[[0,'asc']],
                                    "oLanguage": {"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                    "sSearchPlaceholder": "Buscar...",
                                "sLengthMenu": "Resultados :  _MENU_",},
                                    "stripeClasses": [],
                                    "lengthMenu": [70, 100],
                                    "pageLength": 70
                                } );
                      }
                    },
                    async load() {
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA("{{ url('api/dotacions') }}")]).then((v) => {
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


                                    let url = "{{ url('api/dotacions') }}/" + id

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
                            let sucursal =  localStorage.getItem('AppSucursal')
                            this.sucursal = JSON.parse(sucursal)
                            await Promise.all([self.GET_DATA("{{ url('api/dotacions') }}"),
                                self.GET_DATA("{{ url('api/familias') }}"),
                                self.GET_DATA("{{ url('api/users') }}"),
                                self.GET_DATA("{{ url('api/sucursals') }}")
                            ])
                                .then((v) => {
                                    this.dotacions = v[0]
                                    this.familias = v[1]
                                    this.users = v[2]
                                    this.sucursals = v[3]
                                })


                        } catch (e) {

                        } finally {
                            block.unblock();

                            $('#table_dt').DataTable( {
                                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                    buttons: {
                                        buttons: [
                                            { extend: 'copy', className: 'btn' },
                                            { extend: 'csv', className: 'btn' },
                                            { extend: 'excel', className: 'btn' },
                                            { extend: 'print', className: 'btn' }
                                        ]
                                    },
                                    order:[[0,'asc']],
                                    "oLanguage": {"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                    "sSearchPlaceholder": "Buscar...",
                                "sLengthMenu": "Resultados :  _MENU_",},
                                    "stripeClasses": [],
                                    "lengthMenu": [70, 100],
                                    "pageLength": 70
                                } );
                        }
                        // do whatever you want if console is [object object] then stringify the response




                    })
                }
            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
