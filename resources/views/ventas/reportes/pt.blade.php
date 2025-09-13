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
                    </svg> Ventas / Venta PT</p>
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
                    <select class="form-control select_cliente" id="buscar_area1" v-model="cliente">
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
                    <select class="form-control select_usuario" v-model="user">
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
                    <th align="left" class="bold"><strong>ITEM</strong></th>
                    <th align="left" class="bold"><strong>CLIENTE</strong></th>
                    <th align="left" class="bold"><strong>USUARIO</strong></th>
                    <th align="left" class="bold"><strong>FECHA</strong></th>
                    <th align="left" class="bold"><strong>CJ</strong></th>
                    <th align="left" class="bold"><strong>K/B</strong></th>
                    <th align="left" class="bold"><strong>TARA</strong></th>
                    <th align="left" class="bold"><strong>K/N</strong></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">

                    <td>{{ m.venta.id }}</td>
                    <td>{{ m.item.name }}</td>
                    <td>{{ m.venta.cliente.nombre }}</td>
                    <td>{{ m.venta.user.nombre }}</td>
                    <td>{{ m.fecha }}</td>
                    <td>{{ Number(m.cajas) }}</td>
                    <td>{{ m.peso_bruto }}</td>
                    <td>{{ Number(m.taras).toFixed(3)}}</td>
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
            watch: {
                users() { this.$nextTick(() => this.initSelectUsuario()); },
                clientes() { this.$nextTick(() => this.initSelectCliente()); },
                user(val) {
                    this.$nextTick(() => $(".select_usuario").val(val ?? 'all').trigger('change.select2'));
                },
                cliente(val) {
                    this.$nextTick(() => $(".select_cliente").val(val ?? 'all').trigger('change.select2'));
                }
            },
            methods: {
                initSelectCliente() {
                    const vm = this;
                    const $sel = $(".select_cliente");
                    try { $sel.select2('destroy'); } catch (e) {}
                    $sel.select2({ placeholder: 'Seleccione un cliente', width: '100%' });
                    $sel.off('change.select2.vue').on('change.select2.vue', function() {
                        const val = $(this).val();
                        vm.cliente = val === null ? 'all' : val;
                    });
                    $sel.val(vm.cliente ?? 'all').trigger('change.select2');
                },
                initSelectUsuario() {
                    const vm = this;
                    const $sel = $(".select_usuario");
                    try { $sel.select2('destroy'); } catch (e) {}
                    $sel.select2({ placeholder: 'Seleccione un usuario', width: '100%' });
                    $sel.off('change.select2.vue').on('change.select2.vue', function() {
                        const val = $(this).val();
                        vm.user = val === null ? 'all' : val;
                    });
                    $sel.val(vm.user ?? 'all').trigger('change.select2');
                },
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
                // No precargar datos; solo consultar al hacer clic en Buscar
                async load() { /* intencionalmente vacío */ },
                async GetFechas() {
                        let self = this
                        try {
                            block.block();
                            dt.destroy();
                            const res = await axios.post("{{url('api/ventaItemsPts-fechas')}}",{
                                fecha_1: self.fecha_1,
                                fecha_2: self.fecha_2,
                                user: this.user,
                                cliente: this.cliente
                            });
                            self.data = res.data;
                            await this.$nextTick(() => dt.create());
                        } catch (e) {
                        } finally {
                            block.unblock();
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
                        const [usuarios, clientes] = await Promise.all([
                            self.GET_DATA("{{url('api/users')}}"),
                            self.GET_DATA("{{url('api/clientes')}}"),
                        ]);
                        self.users = usuarios;
                        self.clientes = clientes;
                        await this.$nextTick(() => {
                            this.initSelectUsuario();
                            this.initSelectCliente();
                        });
                        // no crear DT ni cargar datos hasta que el usuario pulse Buscar
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
