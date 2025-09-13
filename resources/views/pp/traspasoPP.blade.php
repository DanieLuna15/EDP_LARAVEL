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
                    </svg> Traspasos de PP</p>
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

                  <th>Creacion</th>
                  <th>TIPO</th>
                  <th>PP N°</th>




                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{m.fecha}} #{{m.id}}</td>
                  <td>ENVIO A {{m.tipo==1?'PP':'PT'}}</td>
                  <td>{{m.pp.nro}}</td>


                  <td>
                    <div class="btn-group">
                      <a :href="m.url_pdf" target="_blank" class="btn btn-dark btn-sm">PDF</a>


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
                    // dt.destroy()
                    try {
                        let data = {
                            fecha_inicio: this.fecha_inicio,
                            fecha_fin: this.fecha_fin
                        }
                        dt.destroy()
                        let res = await axios.post("{{url('api/traspasoPpsFecha')}}",data).then((v) => {
                                self.data = v.data
                            })

                        dt.create()

                    } catch (error) {

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
                        // await Promise.all([self.load()]).then((v) => {

                        // })
                        dt.create()
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
