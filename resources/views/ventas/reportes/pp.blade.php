@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
        <div class="page-header">
            <div class="page-title">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg> Ventas / Venta PP</p>
            </div>

        </div>


    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
        <div class="row">

            <div class="col-3">
                <div class="form-group">
                <label>Clientes</label>
                <div class="input-group mb-4">
                    <select class="form-control" id="buscar_area1" v-model="cliente">
                    <option value="all">Todos</option>
                    <template v-for="m in clientes">
                        <option :value="m.id">{{m.nombre}}</option>
                    </template>
                    </select>
                </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                <label for="">Fecha Inicio</label
                ><input type="date" class="form-control form-control-sm" v-model="fecha_1" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                <label for="">Fecha Fin</label
                ><input type="date" class="form-control form-control-sm"  v-model="fecha_2"/>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                <label>Usuario</label>
                <div class="input-group mb-4">
                    <select class="form-control" v-model="user">
                    <option value="all">Todos</option>
                    <template v-for="m in users">
                        <option :value="m.id">{{m.nombre}}</option>
                    </template>
                    </select>

                </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-primary" type="button" @click="GetFechas">Buscar</button>
            </div>
            </div>

          <div class="table-responsive mb-4 mt-4">
            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>

                    <th align="left" class="bold"><strong>NDD</strong></th>
                    <th align="left" class="bold"><strong>GRUPO</strong></th>
                    <th align="left" class="bold"><strong>CLIENTE</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>HORA</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>UNIT</strong></th>
                    <th align="left" class="bold"><strong>K/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>K/N</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">

                    <td>{{ m.venta.id }}</td>
                    <td>{{ m.cinta_cliente.name }}</td>
                    <td>{{ m.cliente.nombre }}</td>
                    <td>{{ m.venta.user.nombre }}</td>
                    <td>{{ m.fecha }}</td>
                    <td>{{ m.hora }}</td>
                    <td>{{ m.cajas }}</td>
                    <td>{{ m.pollos }}</td>
                    <td>{{ m.peso_bruto }}</td>
                    <td>{{ Number(m.peso_bruto - m.peso_neto)}}</td>
                    <td>{{ m.peso_neto }}</td>
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
        import TableDate from "{{asset('config/dtdate.js')}}"
        import Block from "{{asset('config/block.js')}}"


const {
            createApp
        } = Vue
        let dt = new TableDate()
        let block = new Block()
        createApp({
            data() {
                return {
                    add: true,
                    model: {
                        name: ''
                    },
                    data: [],
                    fecha_1: new Date().toISOString().slice(0, 10),
                    fecha_2: new Date().toISOString().slice(0, 10),
                    users:[],
                    clientes:[],
                    user:'all',
                    cliente:'all'
                }
            },
            methods: {
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/proveedors')}}";
                        if (this.add == false) {
                            url = "{{url('api/proveedors')}}/"+this.model.id
                            let res = axios.put(url,this.model)
                        }else{
                            let res = axios.post(url,this.model)

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

                        let self = this

                        try {
                            await Promise.all([self.GET_DATA("{{url('api/ventaDetallePps')}}")]).then((v) => {
                                self.data = v[0]
                            })

                        } catch (e) {

                        }

                },
                async GetFechas() {

                        let self = this

                        try {

                            dt.destroy()


                           await axios.post("{{url('api/ventaDetallePps-fechas')}}",{
                                fecha_1: self.fecha_1,
                                fecha_2: self.fecha_2,
                                user:this.user,
                                cliente:this.cliente
                            }).then((res) => {
                                self.data = res.data

                            })
                            // console.log(res)
                            dt.create()

                        } catch (e) {

                        }finally{

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


                                let url = "{{url('api/compras')}}/"+id

                                await axios.delete(url)
                                await self.load()
                                dt.create()
                                dt.destroy()
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
                        await Promise.all([self.load(),
                        self.GET_DATA("{{url('api/users')}}"),
                        self.GET_DATA("{{url('api/clientes')}}"),
                        ]).then((v) => {
                            self.users = v[1]
                            self.clientes = v[2]
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
