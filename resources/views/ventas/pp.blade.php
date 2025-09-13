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
                    </svg> Ventas PP</p>
            </div>
            <div>
                <a href="./pt" class="btn btn-success">Ventas Pt</a>
                <a href="./cerrada" class="btn btn-danger">Ventas Cerrada</a>
        </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control form-control-sm" v-model="fecha_inicio">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control form-control-sm" v-model="fecha_fin">
                            </div>
                        </div>
                        <div class="col-3 pt-2">
                            <button class="btn btn-success mt-4" @click="ConsultarFecha()">Consultar</button>
                        </div>
                    </div>
                </div>
            </div>
          <div class="table-responsive mb-4 mt-4">

            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>
                                      <th>ID</th>
                    <th>Creacion</th>
                  <th>CLIENTE</th>
                  <th>PP</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                                      <td>{{m.id}}</td>
                    <td>{{m.fecha}}</td>
                  <td>{{m.venta.cliente.nombre}}</td>
                  <td>{{m.pp.nro}}</td>
                  <td>
                    <span v-if ="m.venta.estado==1" class="badge badge-success">VIGENTE</span>
                    <span v-else class="badge badge-danger">ANULADO</span>
                  </td>


                  <td>



                      <div class="btn-group">

                      <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                        <!-- <a :href="m.url_pdf_2"  class="dropdown-item">Ver Original PDF</a>
                 <a :href="'./compras/edit/'+m.id" class="dropdown-item">Editar</a> -->
                       <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(m.venta.id)">Eliminar</a>


                   </div>

                                         <a :href="m.url_pdf" target="_blank" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-print"></i> PDF</a>
                                                    <a :href="m.url_2_pdf" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i>
                                                        (A4)</a>
                                                    <a :href="m.url_3_pdf" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i>
                                                        (8mm)</a>
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
                    fecha_inicio: '',
                    fecha_fin: '',
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
                    try {
                        let self = this

                        try {
                            await Promise.all([self.GET_DATA("{{url('api/loteEnvioPps')}}")]).then((v) => {
                                self.data = v[0]
                            })

                        } catch (e) {

                        }
                    } catch (e) {

                    }
                },
                async ConsultarFecha(){
                    let self = this
                    dt.destroy()
                    block.block();
                    try {
                        let data = {
                            fecha_inicio: this.fecha_inicio,
                            fecha_fin: this.fecha_fin
                        }

                        let res = await axios.post("{{url('api/ventaPpFecha')}}",data).then((v) => {
                                self.data = v.data
                            })

                    dt.create()

                    } catch (error) {

                    }finally{
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


                                let url = "{{url('api/ventas')}}/"+id

                                await axios.delete(url)

                                self.ConsultarFecha()
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
                        // await Promise.all([self.load()]).then((v) => {

                        // })

                            this.fecha_fin =  new Date().toISOString().substr(0, 10)
                            this.fecha_inicio =  new Date().toISOString().substr(0, 10)
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
