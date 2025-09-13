@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>
                                Lote N° {{model.compra.nro}}
                            </h3>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Precio Venta</span>
                                </div>
                                <input type="text" v-model="model.precio_venta" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Total</span>
                                </div>
                                <input type="text" v-model="model.valor_peso" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Compra</span>
                                </div>
                                <input type="text" v-model="model.valor_compra" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Venta</span>
                                </div>
                                <input type="text" v-model="model.valor_venta" class="form-control">
                            </div>
                        </div> -->
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Cajas</span>
                                </div>
                                <input type="text" v-model="model.cajas" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Pollos</span>
                                </div>
                                <input type="text" v-model="model.pollos" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-12 layout-spacing" v-for="m in model_computed">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area border-tab px-2">
                            <h4>{{m.name}}</h4>

                            <ul class="nav nav-tabs mt-3" :id="'border-tabs'+m.id" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" :id="'border-home_'+m.id"  data-toggle="tab" :href="'#border-home'+m.id"  role="tab"  aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Producto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " :id="'border-interna_'+m.id"  data-toggle="tab" :href="'#border-interna'+m.id"  role="tab"  aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Comp. Interna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " :id="'border-externa_'+m.id"  data-toggle="tab" :href="'#border-externa'+m.id"  role="tab"  aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Comp. Externa</a>
                                </li>

                            </ul>
                            <div class="tab-content mb-4" id="border-tabsContent">
                                <div class="tab-pane fade active show" :id="'border-home'+m.id"  role="tabpanel" aria-labelledby="border-home-tab">
                                   <div class="row">
                                    <div class="col-4">
                                    <img :src="url+'/img/pollo.jpg'" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-8 table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-dark text-white">TOTAL DE POLLOS</td>
                                                    <td> <strong>{{Number(m.equivalente-m.suma_total_pp).toFixed(2)}}</strong></td>
                                                    <td class="bg-dark text-white">PESO X POLLO(Kg)</td>
                                                    <td><strong>{{Number(m.peso_unit_pollo).toFixed(2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-dark text-white">TOTAL CAJAS</td>
                                                    <td><strong>{{Number(m.cajas-m.cajas_disponible).toFixed(2)}}</strong></td>
                                                    <td class="bg-dark text-white">PESO POR CAJA(Kg)</td>
                                                    <td><strong>{{Number(m.peso_total/m.cajas).toFixed(2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td  class="bg-dark text-white">PESO TOTAL NETO(Kg)</td>
                                                    <td  ><strong>{{Number(m.peso_total-m.peso_tara).toFixed(2)}}</strong></td>
                                                    <td  class="bg-dark text-white">PESO TOTAL(Kg)</td>
                                                    <td  ><strong>{{Number(m.peso_total).toFixed(2)}}</strong></td>
                                                    <!-- <td class="bg-primary text-white">VALOR VENTA TOTAL</td>
                                                    <td><strong>Bs {{Number(m.peso_total*model.precio_venta).toFixed(2)}}</strong></td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                <td class="bg-warning text-white">VENTA POR CAJA</td>
                                                    <td > <strong>Bs. {{Number((m.peso_total/m.cajas)*model.precio_venta).toFixed(2)}}</strong></td>
                                                    <td class="bg-warning text-white">VENTA X POLLO</td>
                                                    <td> <strong>Bs. {{Number((m.peso_total/m.equivalente)*model.precio_venta).toFixed(2)}}</strong></td>
                                                </tr>

                                            </tbody>
                                        </table> -->

                                    </div>
                                    <!-- <div class="col-12">
                                    <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                <td class="bg-success text-white">TOTAL CAJAS DISPONIBLES</td>
                                                    <td > <strong>Bs. {{Number((m.peso_total/m.cajas)*model.precio_venta).toFixed(2)}}</strong></td>

                                                </tr>
                                                <tr>
                                                <td class="bg-success text-white">TOTAL POLLOS DISPONIBLES</td>
                                                    <td > <strong>Bs. {{Number((m.peso_total/m.cajas)*model.precio_venta).toFixed(2)}}</strong></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> -->
                                    <div class="col-12 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal" @click="detalle_lote={...m}">ENVIAR A PP</button>
                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal2" @click="detalle_lote={...m}">ENVIAR A PT</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <table class="table table-bordered table-striped mt-2" >
                                        <thead>
                                            <tr>
                                                <td colspan="6" class="bg-primary text-white text-center"> MOVIMIENTOS</td>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="bg-primary text-white">DESCRIPCION</td>
                                                    <td class="bg-primary text-white">FECHA</td>

                                                    <td class="bg-primary text-white">CANTIDAD POLLOS</td>
                                                    <td class="bg-primary text-white">CANTIDAD CAJAS</td>
                                                    <td class="bg-primary text-white">PESO BRUTO</td>
                                                    <td class="bg-primary text-white">PESO NETO</td>
                                                </tr>
                                                <tr v-for="p in m.lote_detalle_movimientos">
                                                    <td>{{p.descripcion}}</td>
                                                    <td>{{p.fecha}}</td>
                                                    <td>{{p.cantidad}}</td>
                                                    <td>{{p.cajas}}</td>
                                                    <td>{{p.peso_bruto}}</td>
                                                    <td>{{p.peso_neto}}</td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td  colspan="5" class="bg-primary text-white">POLLOS ENVIADOS</td>
                                                <td  class="">{{m.suma_total_pp}}</td>
                                            </tr>
                                        </tfoot>
                                        </table>
                                    </div>
                                   </div>
                                </div>
                                <div class="tab-pane fade " :id="'border-interna'+m.id" role="tabpanel" aria-labelledby="border-home-tab">
                                 <div class="row">
                                    <div class="col-12">
                                    <table class="table table-bordered table-striped mt-2" >
                                        <thead>
                                            <tr>
                                                <td colspan="4" class="bg-primary text-white text-center">COMPOSICION INTERNA DEL LOTE</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-primary text-white ">NOMBRE</td>
                                                <td class="bg-primary text-white ">CANT. UNIT</td>
                                                <td class="bg-primary text-white ">CANT. LOTE</td>
                                                <td class="bg-primary text-white ">CANT. DISPONIBLE</td>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="c in compo_internas">
                                                    <td>{{c.name}}</td>
                                                    <td>{{c.cantidad}}</td>
                                                    <td>{{Number(c.cantidad)*Number(m.equivalente)}}</td>
                                                    <td>{{(Number(c.cantidad)*Number(m.equivalente))-(Number(c.cantidad)*Number(m.suma_total_pp))}}</td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                 </div>
                                 </div>
                                <div class="tab-pane fade " :id="'border-externa'+m.id" role="tabpanel" aria-labelledby="border-home-tab">
                                 <div class="row">
                                    <div class="col-12">
                                    <table class="table table-bordered table-striped mt-2" >
                                        <thead>
                                            <tr>
                                                <td colspan="4" class="bg-primary text-white text-center">COMPOSICION EXTERNA DEL LOTE</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-primary text-white ">NOMBRE</td>
                                                <td class="bg-primary text-white ">CANT. UNIT</td>
                                                <td class="bg-primary text-white ">CANT. LOTE</td>
                                                <td class="bg-primary text-white ">CANT. DISPONIBLE</td>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="c in compo_externas">
                                                    <td>{{c.name}}</td>
                                                    <td>{{c.cantidad}}</td>
                                                    <td>{{Number(c.cantidad)*Number(m.equivalente)}}</td>
                                                    <td>{{(Number(c.cantidad)*Number(m.equivalente))-(Number(c.cantidad)*Number(m.suma_total_pp))}}</td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                 </div>
                                 </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">ENVIAR A PP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4 ">
                            <div class="col-12 text-center">
                                <h3>{{detalle_lote.equivalente-detalle_lote.suma_total_pp}}</h3>
                                <h5 class="text-primary">TOTAL POLLOS DISPONIBLES</h5>

                            </div>


                        </div>
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cajas</label>
                                <input type="text" v-model.number="envio.cajas" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Pollos</label>
                                <input type="text" v-model.number="envio.pollos" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Bruto Unit KG</label>
                                <input type="text" v-model.number="detalle_lote.peso_unit_pollo" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Neto Unit KG</label>
                                <input type="text" v-model.number="detalle_lote.peso_neto_pollo" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Bruto Total KG</label>
                                <input type="text" v-model="envio.bruto"  @change="CambioPesoMerma()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Neto Total KG</label>
                                <input type="text" v-model="envio.neto"  @change="CambioPesoMerma()" class="form-control" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Merma Bruto Total KG</label>
                                <input type="text" :value="envio.merma_bruta"disabled  class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Merma Neta Total KG</label>
                                <input type="text" :value="envio.merma_neta" disabled class="form-control" >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">PP en curso</label>
                                <input type="text" :value="'N° '+pp.nro+' '+pp.mes" disabled class="form-control" >
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button v-if="detalle_envio<=pollos_disponible" @click="EnviarPP()" type="button" data-dismiss="modal" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">ENVIAR A PT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4 ">
                            <div class="col-6 text-center">
                            <h3>{{detalle_lote.equivalente-detalle_lote.suma_total_pp}}</h3>
                                <h5 class="text-primary">TOTAL POLLOS</h5>

                            </div>
                            <div class="col-6 text-center">
                                <h3>{{detalle_envio}}</h3>
                                <h5 class="text-warning">ENVIAR POLLOS</h5>

                            </div>

                        </div>
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cajas</label>
                                <input type="text" v-model.number="envio.cajas" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Pollos</label>
                                <input type="text" v-model.number="envio.pollos" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Bruto Unit KG</label>
                                <input type="text" v-model.number="detalle_lote.peso_unit_pollo" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Neto Unit KG</label>
                                <input type="text" v-model.number="detalle_lote.peso_neto_pollo" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Bruto Total KG</label>
                                <input type="text" v-model="envio.bruto"  @change="CambioPesoMerma()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Neto Total KG</label>
                                <input type="text" v-model="envio.neto"  @change="CambioPesoMerma()" class="form-control" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Merma Bruto Total KG</label>
                                <input type="text" :value="envio.merma_bruta"disabled  class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Merma Neta Total KG</label>
                                <input type="text" :value="envio.merma_neta" disabled class="form-control" >
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button v-if="detalle_envio<=pollos_disponible" @click="EnviarPT()" type="button" data-dismiss="modal" class="btn btn-primary">Enviar</button>
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
                    compra:{

                    },
                    name: '',
                    lote_detalles:[]
                },
                data: [],
                detalle_lote:{
                    equivalente:0,
                    pollos:0,
                    pp_detalles:[]
                },
                envio:{
                    cajas:0,
                    pollos:0,
                    bruto:0,
                    neto:0,
                    merma_bruta:0,
                    merma_neta:0,
                },
                compo_internas:[],
                compo_externas:[],
                sucursal: {
                    id: 0,
                    name: ''
                },
                pp:{}
            }
        },
        computed: {
            url(){
                return "{{url('')}}"
            },
            detalle_envio(){
                return this.envio.pollos
            },
            pollos_pp(){
                return this.detalle_lote.pp_detalles.reduce((a,b)=>a+Number(b.cantidad),0)
            },
            pollos_disponible(){
                return Number(this.detalle_lote.equivalente)-Number(this.pollos_pp)
            },
            model_computed(){
                return this.model.lote_detalles.map((v)=>{
                    let lote = v
                    v.suma_total_pp = v.lote_detalle_movimientos.reduce((a,b)=>a+Number(b.cantidad),0)
                    let cajas_disponible = Number(Number(v.suma_total_pp)/Number(v.pollos))
                    //redondear a entero
                    v.cajas_disponible = Math.floor(cajas_disponible)
                    v.peso_unit_pollo = Number(Number(v.peso_total)/Number(v.equivalente)).toFixed(2)
                    v.peso_tara = Number(v.cajas)*2
                    v.peso_neto_pollo = Number((Number(v.peso_total-Number(v.peso_tara)))/Number(v.equivalente)).toFixed(2)
                    return lote
                })
            }
        },
        methods: {
            CambioPeso(){
                this.envio.bruto= Number(this.detalle_lote.peso_unit_pollo*this.detalle_envio).toFixed(2)
                this.envio.neto= Number(this.detalle_lote.peso_neto_pollo*this.detalle_envio).toFixed(2)
                this.envio.merma_bruta=  Number((this.detalle_lote.peso_unit_pollo*this.detalle_envio)-{...this.envio}.bruto).toFixed(2)
                this.envio.merma_neta= Number((this.detalle_lote.peso_neto_pollo*this.detalle_envio)-{...this.envio}.neto).toFixed(2)


            },
            CambioPesoMerma(){
                this.envio.merma_bruta= Number((this.detalle_lote.peso_unit_pollo*this.detalle_envio)-{...this.envio}.bruto).toFixed(2)
                this.envio.merma_neta= Number((this.detalle_lote.peso_neto_pollo*this.detalle_envio)-{...this.envio}.neto).toFixed(2)


            },
            async Save() {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/proveedors')}}";
                    if (this.add == false) {
                        url = "{{url('api/proveedors')}}/" + this.model.id
                        let res = axios.put(url, this.model)
                    } else {
                        let res = axios.post(url, this.model)

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
                        await Promise.all([self.GET_DATA("{{url('api/lotes')}}/{{$id}}"),
                        self.GET_DATA("{{url('api/compoInternas')}}"),
                        self.GET_DATA("{{url('api/compoExternas')}}"),
                   self.GET_DATA("{{url('api/pps/curso/')}}/"+this.sucursal.id),
                    ]).then((v) => {
                            self.model = v[0]
                            self.compo_internas = v[1]
                            self.compo_externas = v[2]
                            self.pp = v[3]
                        })

                    } catch (e) {

                    }
                } catch (e) {

                }
            },
            async EnviarPP(){
                try {
                    let self = this
                 let data={
                    cantidad:this.detalle_envio,

                    precio_venta:this.model.precio_venta,
                    peso_total:this.detalle_envio*(this.detalle_lote.peso_total/this.detalle_lote.equivalente),
                    lote_id:this.model.id,
                    lote_detalle_id:this.detalle_lote.id,
                    peso_bruto:this.envio.bruto,
                    peso_neto:this.envio.neto,
                    merma_bruta:this.envio.merma_bruta,
                    merma_neta:this.envio.merma_neta,
                    cajas:this.envio.cajas,
                    pollos:this.envio.pollos,
                    pp_id:this.pp.id
                 }
                   this.envio.cajas = 0
                    this.envio.pollos = 0
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
                    confirmButtonText: 'Enviar!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        let res = await axios.post("{{url('api/ppDetalles')}}",data)
                        window.open(res.data.url_pdf, '_blank');
                       swalWithBootstrapButtons({
                    title: 'Enviado!',
                    type: 'success',
                    })
                }
                try {
                        await Promise.all([self.GET_DATA("{{url('api/lotes')}}/{{$id}}"),

                    ]).then((v) => {
                            self.model = v[0]

                        })

                    } catch (e) {

                    }
                })
                } catch (e) {

                }
            },
            async EnviarPT(){
                try {
                    let self = this
                 let data={
                    cantidad:this.detalle_envio,
                    precio_venta:this.model.precio_venta,
                    peso_total:this.detalle_envio*(this.detalle_lote.peso_total/this.detalle_lote.equivalente),
                    lote_id:this.model.id,
                    lote_detalle_id:this.detalle_lote.id,
                    peso_bruto:this.envio.bruto,
                    peso_neto:this.envio.neto,
                    merma_bruta:this.envio.merma_bruta,
                    merma_neta:this.envio.merma_neta,
                    cajas:this.envio.cajas,
                 }
                   this.envio.cajas = 0
                    this.envio.pollos = 0
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
                    confirmButtonText: 'Enviar!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        let res = await axios.post("{{url('api/ptDetalles-lote')}}",data)
                        window.open(res.data.url_pdf, '_blank');
                       swalWithBootstrapButtons({
                    title: 'Enviado!',
                    type: 'success',
                    })
                }
                try {
                        await Promise.all([self.GET_DATA("{{url('api/lotes')}}/{{$id}}"),

                    ]).then((v) => {
                            self.model = v[0]

                        })

                    } catch (e) {

                    }
                })
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


                            let url = "{{url('api/compras')}}/" + id

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
@slot('style')
<style>
    .nav-tabs svg {
        width: 20px;
        vertical-align: bottom;
    }

    .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .nav-tabs .nav-link.active:after {
        color: #e95f2b;
    }

    .nav-tabs {
        border-bottom: 1px solid #ebedf2;
    }

    .nav-tabs .nav-link:hover {
        border-color: #ebedf2 #ebedf2 #f1f2f3;
    }

    .dropdown-menu {
        box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.1);
    }

    .nav-tabs .dropdown-item:hover {
        background-color: #f1f2f3;
        color: #515365;
    }

    .nav-tabs li a.disabled {
        color: #acb0c3 !important;
    }

    .nav-pills .nav-item:not(:last-child) {
        margin-right: 5px;
    }

    .nav-pills .nav-link.active:after {
        color: #fff;
    }

    .nav-pills .nav-link {
        color: #3b3f5c;
    }

    .nav-pills .show>.nav-link {
        background-color: #e95f2b;
    }

    .nav-pills li a.disabled {
        color: #acb0c3 !important;
    }

    h4 {
        font-size: 1.125rem;
    }

    /*
    Simple Tab
*/

    .simple-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .simple-tab .nav-tabs .nav-item.show .nav-link,
    .simple-tab .nav-tabs .nav-link.active {
        color: #1b55e2;
        font-weight: 600;
        background-color: #fff;
    }

    .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .simple-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Simple Pills
*/

    .simple-pills .nav-pills li a {
        color: #3b3f5c;
    }

    .simple-pills .nav-pills .nav-link.active,
    .simple-pills .nav-pills .show>.nav-link {
        background-color: #1b55e2;
        border-color: transparent;
    }

    .simple-pills .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Icon Tab
*/

    .icon-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .icon-tab .nav-tabs svg {
        width: 20px;
        vertical-align: bottom;
    }

    .icon-tab .nav-tabs .nav-item.show .nav-link,
    .icon-tab .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .icon-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    Icon Pill
*/
    .icon-pill .nav-pills li a {
        color: #3b3f5c;
    }

    .icon-pill .nav-pills svg {
        width: 20px;
        vertical-align: bottom;
    }

    .icon-pill .nav-pills .nav-link.active,
    .icon-pill .nav-pills .show>.nav-link {
        background-color: #e2a03f;
        border-color: transparent;
    }

    .icon-pill .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    Underline
*/

    .underline-content .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .underline-content .nav-tabs li a {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .underline-content .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .underline-content .nav-tabs .nav-link.active,
    .underline-content .nav-tabs .show>.nav-link {
        border-color: transparent;
        border-bottom: 1px solid #5c1ac3;
        color: #5c1ac3;
        background-color: transparent;
    }

    .underline-content .nav-tabs .nav-link.active:hover,
    .underline-content .nav-tabs .show>.nav-link:hover,
    .underline-content .nav-tabs .nav-link.active:focus,
    .underline-content .nav-tabs .show>.nav-link:focus {
        border-bottom: 1px solid #5c1ac3;
    }

    .underline-content .nav-tabs .nav-link:focus,
    .underline-content .nav-tabs .nav-link:hover {
        border-color: transparent;
    }


    /*
    Animated Underline
*/

    .animated-underline-content .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .animated-underline-content .nav-tabs li a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .animated-underline-content .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .animated-underline-content .nav-tabs .nav-link.active,
    .animated-underline-content .nav-tabs .show>.nav-link {
        border-color: transparent;
        color: #5c1ac3;
    }

    .animated-underline-content .nav-tabs .nav-link:focus,
    .animated-underline-content .nav-tabs .nav-link:hover {
        border-color: transparent;
    }

    .animated-underline-content .nav-tabs .nav-link.active:before {
        -webkit-transform: scale(1);
        transform: scale(1);
    }

    .animated-underline-content .nav-tabs .nav-link:before {
        content: "";
        height: 1px;
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 0;
        background-color: #5c1ac3;
        -webkit-transform: scale(0);
        transform: scale(0);
        transition: all .3s;
    }


    /*
    Justify Tab
*/

    .justify-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .justify-tab .nav-tabs .nav-item.show .nav-link,
    .justify-tab .nav-tabs .nav-link.active {
        color: #1b55e2;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .justify-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Pill
*/

    .justify-pill .nav-pills li a {
        color: #3b3f5c;
    }

    .justify-pill .nav-pills .nav-link.active,
    .justify-pill .nav-pills .show>.nav-link {
        background-color: #2196f3;
        border-color: transparent;
    }

    .justify-pill .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Centered Tab
*/

    .tab-justify-centered .nav-tabs li a {
        color: #3b3f5c;
    }

    .tab-justify-centered .nav-tabs .nav-item.show .nav-link,
    .tab-justify-centered .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .tab-justify-centered .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Centered Pill
*/

    .pill-justify-centered .nav-pills li a {
        color: #3b3f5c;
    }

    .pill-justify-centered .nav-pills .nav-link.active,
    .pill-justify-centered .nav-pills .show>.nav-link {
        background-color: #e2a03f;
    }

    .pill-justify-centered .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Right Tab
*/

    .tab-justify-right .nav-tabs li a {
        color: #3b3f5c;
    }

    .tab-justify-right .nav-tabs .nav-item.show .nav-link,
    .tab-justify-right .nav-tabs .nav-link.active {
        color: #1b55e2;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .tab-justify-right .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Right Pill
*/

    .pill-justify-right .nav-pills .nav-link.active,
    .pill-justify-right .nav-pills .show>.nav-link {
        background-color: #2196f3;
    }

    .pill-justify-right .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    With Icons
*/

    .rounded-pills-icon .nav-pills li a {
        -webkit-border-radius: 0.625rem !important;
        -moz-border-radius: 0.625rem !important;
        -ms-border-radius: 0.625rem !important;
        -o-border-radius: 0.625rem !important;
        border-radius: 0.625rem !important;
        background-color: #f1f2f3;
        width: 100px;
        padding: 8px;
    }

    .rounded-pills-icon .nav-pills li a svg {
        display: block;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .rounded-pills-icon .nav-pills .nav-link.active,
    .rounded-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #009688;
    }

    .rounded-pills-icon .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Vertical With Icon
*/

    .rounded-vertical-pills-icon .nav-pills a {
        -webkit-border-radius: 0.625rem !important;
        -moz-border-radius: 0.625rem !important;
        -ms-border-radius: 0.625rem !important;
        -o-border-radius: 0.625rem !important;
        border-radius: 0.625rem !important;
        background-color: #ffffff;
        border: solid 1px #e4e2e2;
        padding: 11px 23px;
        text-align: center;
        width: 100px;
        padding: 8px;
    }

    .rounded-vertical-pills-icon .nav-pills a svg {
        display: block;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .rounded-vertical-pills-icon .nav-pills .nav-link.active,
    .rounded-vertical-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #009688;
        border-color: transparent;

    }


    /*
    Rouned Circle With Icons
*/

    .rounded-circle-pills-icon .nav-pills li a {
        background-color: #f1f2f3;
        padding: 20px 20px;
    }

    .rounded-circle-pills-icon .nav-pills li a svg {
        display: block;
        text-align: center;
    }

    .rounded-circle-pills-icon .nav-pills .nav-link.active,
    .rounded-circle-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #2196f3;
    }

    .rounded-circle-pills-icon .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Vertical Rounded Circle With Icon
*/
    .rounded-circle-vertical-pills-icon .nav-pills a {
        background-color: #ffffff;
        border: solid 1px #e4e2e2;
        border-radius: 50%;
        height: 58px;
        width: 60px;
        padding: 16px 18px;
        max-width: 80px;
        min-width: auto
    }

    .rounded-circle-vertical-pills-icon .nav-pills a svg {
        display: block;
        text-align: center;
        line-height: 19px;
    }

    .rounded-circle-vertical-pills-icon .nav-pills .nav-link.active,
    .rounded-circle-vertical-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #2196f3;
        border-color: transparent;
    }

    /*
    Vertical Pill
*/

    .vertical-pill .nav-pills .nav-link.active,
    .vertical-pill .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Vertical Pill Right
*/

    .vertical-pill-right .nav-pills .nav-link.active,
    .vertical-pill-right .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Creative vertical pill
*/

    .vertical-line-pill .nav-pills {
        border-bottom: 1px solid transparent;
        width: 92px;
        border-right: 1px solid #e0e6ed;
    }

    .vertical-line-pill .nav-pills a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .vertical-line-pill .nav-pills .nav-link {
        padding: .5rem 0;
    }

    .vertical-line-pill .nav-pills .nav-link.active,
    .vertical-line-pill .nav-pills .show>.nav-link {
        position: relative;
        background-color: transparent;
        border-color: transparent;
        color: #5c1ac3;
        font-weight: 600;
    }

    .vertical-line-pill .nav-pills .nav-link:focus,
    .vertical-line-pill .nav-pills .nav-link:hover {
        border-color: transparent;
    }

    .vertical-line-pill .nav-pills .nav-link.active:before {
        -webkit-transform: scale(1);
        transform: scale(1);
        bottom: 0;
    }

    .vertical-line-pill .nav-pills .nav-link:before {
        content: "";
        height: 100%;
        position: absolute;
        width: 1px;
        right: -1px;
        background-color: #5c1ac3;
        -webkit-transform: scale(0);
        transform: scale(0);
        transition: all .3s;
    }

    .vertical-line-pill #v-line-pills-tabContent h4 {
        color: #e2a03f;
    }

    .vertical-line-pill #v-line-pills-tabContent p {
        color: #888ea8;
    }

    .media img {
        border-radius: 50%;
        border: solid 5px #ebedf2;
        width: 80px;
        height: 80px;
    }


    /*
    Border Tab
*/

    .border-tab .tab-content {
        border: 1px solid #e0e6ed;
        border-top: none;
        padding: 10px;
    }

    .border-tab .tab-content>.tab-pane {
        padding: 20px 30px 0 30px
    }

    .border-tab .tab-content .media img.meta-usr-img {
        margin-left: -30px;
    }


    /*
    Vertical Border Tab
*/

    .vertical-border-pill .nav-pills {
        width: 92px;
    }

    .vertical-border-pill .nav-pills a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .vertical-border-pill .nav-pills .nav-link {
        padding: .5rem 0;
        border: 1px solid #e0e6ed;
        border-radius: 0;
        border-bottom: none;
    }

    .vertical-border-pill .nav-pills .nav-link:last-child {
        border-bottom: 1px solid #e0e6ed;
    }

    .vertical-border-pill .nav-pills .nav-link.active,
    .vertical-border-pill .nav-pills .show>.nav-link {
        position: relative;
        color: #fff;
        background-color: #8dbf42;
    }


    /*
    Border Top Tab
*/

    .border-top-tab .nav-tabs {
        border-bottom: 1px solid transparent;
    }

    .border-top-tab .nav-tabs li a {
        border-radius: 0px;
        padding: 12px 30px;
        background: #f6f7f8;
        color: #0e1726;
        border-right: 1px solid transparent;
    }

    .border-top-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .border-top-tab .nav-tabs .nav-item.show .nav-link,
    .border-top-tab .nav-tabs .nav-link.active {
        color: #495057;
        border-radius: 0px;
        padding: 12px 30px;
        background: #f6f7f8;
        color: #5c1ac3;
        border: 1px solid transparent;
        border-top: 2px solid #5c1ac3;
    }

    .border-top-tab .nav-tabs .nav-link:focus,
    .border-top-tab .nav-tabs .nav-link:hover {
        border: 1px solid transparent;
        border-top: 2px solid #5c1ac3;
    }
</style>
@endslot
@endcomponent
