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
                    </svg> Configuración / Tirajes</p>
            </div>
            <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name=''" class="btn btn-success">Agregar</button>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">{{add==true?'Agregar':'Actualizar'}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
              <div class="form-row mb-4">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Serie</label>
                  <input type="text" v-model="model.serie" class="form-control" placeholder="Serie">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Inicio</label>
                  <input type="text" v-model="model.inicio" class="form-control" placeholder="Inicio">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Fin</label>
                  <input type="text" v-model="model.fin" class="form-control" placeholder="Inicio">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nro Autorización</label>
                  <input type="text" v-model="model.nro_auth" class="form-control" placeholder="Inicio">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Fecha Inicio</label>
                  <input type="date" v-model="model.fecha_inicio" class="form-control" placeholder="Inicio">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Fecha Fin</label>
                  <input type="date" v-model="model.fecha_fin" class="form-control" placeholder="Inicio">
                </div>
                <div class="form-group col-md-12">
                <label>Comprobantes</label>
                    <select v-model="model.comprobante_id" class="form-control">

                      <option v-for="m in comprobantes" :value="m.id">{{m.name}}</option>

                    </select>
                </div>
                <div class="form-group col-md-12">
                <label>Sucursal</label>
                    <select v-model="model.sucursal_id" class="form-control">

                      <option v-for="m in sucursals" :value="m.id">{{m.nombre}}</option>

                    </select>
                </div>

              </div>
            </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button @click="Save()" type="button" data-dismiss="modal" class="btn btn-success">Guardar</button>
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
                  <th>Serie</th>
                  <th>Nro Autorizacion</th>
                  <th>Comprobante</th>
                  <th>Sucursal</th>
                  <th>Inicio</th>
                  <th>Fin</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>

                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{i+1}}</td>
                  <td>{{m.serie}}</td>
                  <td>{{m.nro_auth}}</td>
                  <td>{{m.comprobante.name}}</td>
                  <td>{{m.sucursal.nombre}}</td>
                  <td>{{m.inicio}}</td>
                  <td>{{m.fin}}</td>
                  <td>{{m.fecha_inicio}}</td>
                  <td>{{m.fecha_fin}}</td>
                  <td>
                    <div class="btn-group">
                      <button data-toggle="modal" @click="add=false,model=m" data-target="#exampleModal" type="button" class="btn btn-warning btn-sm">Editar</button>
                      <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
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
                    comprobantes: [],
                    sucursals: [],


                }
            },
            methods: {
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/sucursalTirajes')}}";
                        if (this.add == false) {
                            url = "{{url('api/sucursalTirajes')}}/"+this.model.id
                            let res = await axios.put(url,this.model)
                            dt.destroy()
                            await this.load()
                            dt.create()
                        }else{
                            let res =await  axios.post(url,this.model)
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
                            await Promise.all([self.GET_DATA("{{url('api/sucursalTirajes')}}"),self.GET_DATA("{{url('api/sucursals')}}"),self.GET_DATA("{{url('api/comprobantes')}}")]).then((v) => {
                                self.data = v[0]
                                self.sucursals = v[1]
                                self.comprobantes = v[2]
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


                                let url = "{{url('api/sucursalTirajes')}}/"+id

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
