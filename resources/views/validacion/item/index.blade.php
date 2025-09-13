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
                    </svg> Items</p>
            </div>
            <div>
                <!-- <button @click="ActualizarPrecios" class="btn btn-success">Actualizar Precios</button> -->
                <a href="./item/add" class="btn btn-success">Agregar Item</a>

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
                  <th>Compra</th>
                  <th>Venta</th>
                  <th style="display: none">PRECIO 1</th>
                  <th style="display: none">PRECIO 2</th>
                  <th style="display: none">PRECIO 3</th>
                  <th>Tipo</th>
                  <th>Image</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{i+1}}</td>
                  <td>{{m.name}}</td>
                  <td>{{m.compra}}</td>
                  <td><input disabled type="text" class="form-control form-control-sm" v-model="m.precio_valor" :disabled="m.cambios>=3"></td>
                  <td style="display: none">
                  <div v-if="m.cambios>=1" class="icon-container">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  style="color: #28a745;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><span class="icon-name"> </span>
                                                        </div>
                  </td>
                  <td style="display: none">
                  <div  v-if="m.cambios>=2" class="icon-container">
                                                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #28a745;"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><span class="icon-name"> </span>
                                                        </div>
                  </td>
                  <td style="display: none">
                  <div v-if="m.cambios>=3" class="icon-container">
                                                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #28a745;"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><span class="icon-name"> </span>
                                                        </div>
                  </td>
                  <td>{{tipos[m.tipo-1]}}</td>
                  <td><div class="media" v-if="m.image!=null">
                    <img :src="m.image.path_url" onerror="this.style.display='none'" class="img-fluid" alt="File" style="width: 50px;"></div>
                </td>
                  <td>
                    <div class="btn-group">
                      <a :href="'./item/edit/'+m.id" class="btn btn-warning btn-sm">Editar</a>
                      <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                      <a :href="'./item/image/'+m.id" class="dropdown-item">Imagen</a>
                        <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(m.id)">Eliminar</a>

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
        import Table from "{{asset('config/dt.js')}}"
        import Block from "{{asset('config/block.js')}}"


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
                    tipos: ["PP", "PT", "SUB PT"],
                    sucursal:{}

                }
            },
            methods: {
                async ActualizarPrecios() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/items-precios')}}";
                        let data = {
                            sucursal_id: 1,
                            data:this.data
                        }
                        let res = await axios.post(url,data)
                        dt.destroy()
                        await this.load()
                        dt.create()
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
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/items')}}";
                        if (this.add == false) {
                            url = "{{url('api/items')}}/"+this.model.id
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
                    try {
                        let self = this

                        try {
                            await Promise.all([self.GET_DATA("{{url('api/items-sucursal')}}/"+this.sucursal.id)]).then((v) => {
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


                                let url = "{{url('api/items')}}/"+id

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
                    let sucursal = localStorage.getItem('AppSucursal')
                    this.sucursal = JSON.parse(sucursal)

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
