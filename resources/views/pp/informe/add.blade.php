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
                    </svg> Informe Preliminar para Venta</p>
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
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Compo. Externas</label>
                                <select name="" id="" class="form-control" v-model="composicion">
                                    <option v-for="item in compo_externas" :value="item">{{item.name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Peso</label>
                                <input type="text" v-model.number="composicion.peso" class="form-control" placeholder="Peso">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cupo</label>
                                <input type="text" v-model.number="cupo.cupo" class="form-control" placeholder="Cupo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cupo del día</label>
                                <input type="text" v-model.number="cupo.dia" class="form-control" placeholder="Cupo del dia">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button @click="Save()" type="button" data-dismiss="modal" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-content widget-content-area br-6">
                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <label for="">KG</label>
                                <input type="text" class="form-control" v-model="informe.kg">
                            </div>
                            <div class="col-4">
                                <label for="">DIA</label>
                                <input type="text" class="form-control" v-model="informe.dia">
                            </div>
                            <div class="col-12">
                                <label for="">OBSERVACION</label>
                                <input type="text" class="form-control" v-model="informe.observacion">
                            </div>



                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <label for="">CAJAS</label>
                                <input type="text" class="form-control" v-model.number="pollos.cajas">
                            </div>
                            <div class="col-4">
                                <label for="">X CAJA</label>
                                <input type="text" class="form-control" v-model.number="pollos.cant">
                            </div>

                            <div class="col-4">
                                <label for="">POLLOS</label>
                                <input type="text" class="form-control" :value="pollos_total" disabled>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <h4>PROGRAMA TROZADO</h4>
                            <h4> </h4>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th>Producto</th>
                                <th>Peso</th>
                                <th>Valor Total</th>

                            </thead>
                            <tbody>
                                <tr v-for="(r,i) in productos">
                                    <td>{{r.name}}</td>
                                    <td>{{r.peso}}</td>
                                    <td>{{Number(r.peso*pollos_total).toFixed(2)}}</td>



                                </tr>

                            </tbody>

                        </table>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12" v-for="m in productos_model">
                        <div class="d-flex justify-content-between">
                            <h4>{{m.name}}</h4>
                            <h4> </h4>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">CUPOS</label>
                                <input type="text" class="form-control" :value="m.cupos_fil">
                            </div>
                            <div class="col-4">
                                <label for="">CUPO </label>
                                <input type="text" class="form-control" v-model.number="m.cupo.cupo">
                            </div>
                            <div class="col-4">
                                <label for="">CUPO DEL DIA</label>
                                <input type="text" class="form-control" v-model.number="m.cupo.dia">
                            </div>

                            <div class="col-12 mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>PRODUCTOS</th>
                                        <th>PESO</th>

                                    </thead>
                                    <tbody>
                                        <tr v-for="(r,i) in m.compo_externa_detalles">
                                            <td>{{r.name}}</td>
                                            <td>{{r.peso}}</td>


                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td>{{Number(m.total_cupo_fit).toFixed(2)}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <button class="btn btn-success w-100 mt-4" @click="saveInforme()">GUARDAR</button>
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
                    name: '',
                    valor: 0,
                    cajas: 0,
                    trozado: 0,
                },
                data: [],
                valor: 0,
                cajas: 0,
                productos: [

                ],
                producto: {

                },
                composicion: {
                    peso: 0,
                    compo_externas_detalles: []
                },
                pollos: {
                    cajas: 100,
                    cant: 15
                },
                cupo: {
                    cupo: 0,
                    dia: 300
                },
                compo_externas: [

                ],
                informe:{
                    kg:0,
                    dia:0,
                    observacion:''
                }
                ,
                user:{

                },
                sucursal:{

                }
            }
        },

        computed: {
            pollos_total() {
                return this.pollos.cajas * this.pollos.cant
            },
            productos_model() {
                return this.productos.map((p) => {
                    let main = p.compo_externa_detalles.filter((c) => c.principal == 1)
                    let constuctor = p.compo_externa_detalles.filter((c) => c.name == p.name)
                    p.main = {
                        peso: 0,
                        name: ''
                    }
                    p.constuctor = {
                        peso: 0,
                        name: ''
                    }
                    if (main.length) {
                        p.main = main[0]
                    }
                    if (constuctor.length) {
                        p.constuctor = constuctor[0]
                    }
                    p.cupos_fil = Number(p.cupo.cupo / p.main.peso).toFixed(2)
                    p.total_cupo_fit = Number(p.constuctor.peso * p.cupos_fil).toFixed(2)

                    return p
                })

                // return this.productos.map((p)=>{
                //     p.suma_total = p.registros.reduce((a,b)=>a+Number(b.valor),0)
                //     p.suma_cajas = p.registros.reduce((a,b)=>a+Number(b.cajas),0)
                //     return p
                // })
            }
        },
        methods: {
            async Save() {
                try {
                    let producto = {
                        ...this.composicion
                    }
                    producto.cupo = {
                        cupo: this.cupo.cupo,
                        dia: this.cupo.dia,
                    }

                    this.productos.push(producto)

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
                        await Promise.all([self.GET_DATA("{{url('api/documentos')}}"),
                            self.GET_DATA("{{url('api/compoExternas')}}"),
                        ]).then((v) => {
                            self.data = v[0]
                            self.compo_externas = v[1]
                        })

                    } catch (e) {

                    }
                } catch (e) {

                }
            },
            async saveInforme() {
        block.block();
        try {
          this.informe.sucursal_id = this.sucursal.id
          this.informe.user_id = this.user.id
            this.informe.cajas = this.pollos.cajas
            this.informe.cant = this.pollos.cant
            this.informe.pollos = this.pollos.cajas*this.pollos.cant
            this.informe.detalles = this.productos_model
          let url = "{{url('api/informePreliminars')}}";
          let res = await axios.post(url,this.informe);
          const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success btn-rounded',
            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
            buttonsStyling: false,
          })
          let planilla = res.data
          swalWithBootstrapButtons({
            title: 'Liquidacion Guardado',
            text: "Su Liquidacion fue guardado",
            type: 'success',
            showCancelButton: true,
            confirmButtonText: 'PDF',
            cancelButtonText: 'REGRESAR',
            reverseButtons: true,
            padding: '2em'
          }).then(async (result) => {
            if (result.value) {
              try {


                window.open(planilla.url_pdf, '_blank');
                this.back()
              } catch (e) {

              }
            } else {
              this.back()
            }
          })



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


                            let url = "{{url('api/documentos')}}/" + id

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
                    let sucursal = localStorage.getItem('AppSucursal')
                    if (sucursal != null) {
                    this.sucursal = JSON.parse(sucursal);

                    }
                    let user = localStorage.getItem('AppUser')
                    if (user != null) {
                    this.user = JSON.parse(user);

                    }
                    block.unblock();
                }
                // do whatever you want if console is [object object] then stringify the response




            })
        }
    }).mount('#meApp')
</script>
@endslot
@endcomponent
