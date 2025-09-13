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
                    </svg> Descomposicion de PT</p>
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



                  <th>Item</th>
                  <th>Cajas</th>
                  <th>Taras</th>
                  <th>Peso Bruto</th>
                  <th>Peso Neto</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in pt.items">
                  <td>{{m.item.name}}</td>


                  <td>{{m.cajas}}</td>
                  <td>{{Number(m.peso_bruto - m.peso_neto).toFixed(2)}}</td>
                  <td>{{Number(m.peso_bruto).toFixed(2)}}</td>
                  <td>{{Number(m.peso_neto).toFixed(2)}}</td>

                  <td>

                      <button data-toggle="modal" data-target="#exampleModal" @click="item=m" class="btn btn-dark btn-sm">Descomponer</button>



                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">Sub Descomponer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                        <div class="col-12">
                    <label for="">Items</label>
                <select class="form-control  basic" v-model="descomponer.item_id">
                    <option value="" disabled selected>Seleccionar</option>
                    <template v-for="item in items">
                        <option v-if="item.tipo==2"  :value="item.id">{{item.name}}</option>
                    </template>
                    </select>
                </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Cajas</label>
                                <input type="text" v-model="descomponer.cajas" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Peso Bruto</label>
                                <input type="text" v-model="descomponer.peso_bruto" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Peso Neto</label>
                                <input type="text" v-model="descomponer.peso_neto" class="form-control" placeholder="">
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button @click="DescomponerItem()" type="button" data-dismiss="modal" class="btn btn-primary">Descomponer</button>
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
                    items: [],
                    pt:{
                        items:[]
                    },
                    user:{},
                    sucursal:{},
                    item:{},
                    descomponer:{

                    }
                }
            },
            methods: {
                async DescomponerItem() {
                    try {
                        // let res = await axios.post(, this.model)

                        let url = "{{url('api/itemspt-descomponer')}}";
                        this.descomponer.item = this.item
                        this.descomponer.pt_id = this.pt.id
                         let res = axios.post(url,this.descomponer)

                        dt.destroy()
                        await this.load()
                        dt.create()
                    } catch (e) {

                    }
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
                async load() {
                    try {
                        let self = this

                        try {
                            await Promise.all([
                                self.GET_DATA("{{url('api/pts/curso-subpt/')}}/"+this.sucursal.id),
                                self.GET_DATA("{{url('api/items-sucursal')}}/"+this.sucursal.id)

                        ]).then((v) => {
                                self.pt = v[0]
                                self.items = v[1]

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
                        let sucursal = localStorage.getItem('AppSucursal')
                        this.sucursal = JSON.parse(sucursal)
                        let user = localStorage.getItem('AppUser')
                        this.user = JSON.parse(user)
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
