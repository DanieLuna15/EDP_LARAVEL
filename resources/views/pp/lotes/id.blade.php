@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>
                               Lote N° {{model.compra.nro}}
                            </h3>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Precio Venta</span>
                                </div>
                                <input type="text" v-model="model.precio_venta" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Total</span>
                                </div>
                                <input type="text" v-model="model.valor_peso" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Compra</span>
                                </div>
                                <input type="text" v-model="model.valor_compra" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Venta</span>
                                </div>
                                <input type="text" v-model="model.valor_venta" class="form-control">
                            </div>
                        </div> -->
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Cajas</span>
                                </div>
                                <input type="text" v-model="model.cajas" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Pollos</span>
                                </div>
                                <input type="text" v-model="model.pollos" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                                <button class="btn btn-warning" v-if="lotes_desconpuestos.length>0"  @click="DescomponerTodo()">DESCOMPONSICION GENERAL</button>
                            </div>
                        <div class="col-12 text-left">
                            <hr>
                            <label for="">Componente Interno</label>
                            <div class="input-group">
                                <select name="" id="" class="form-control" v-model="retiro_organo_general">
                                    <option value="">Seleccione</option>
                                    <option v-for="c in compo_internas" :value="c.id">{{c.name}}</option>
                                </select>
                                    <button class="btn btn-success" v-if="lotes_desconpuestos"  @click="QuitarOrgano()">Trozar</button>

                            </div>
                            </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-6 col-12 layout-spacing" v-for="m in model_computed">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area border-tab px-2">
                            <div class="d-flex justify-content-between">
                                <h4>{{m.lote_detalle.name}}</h4>
                                <button v-if="m.back==1" class="btn btn-danger" @click="RegresarLote(m)">REGRESAR A LOTE INICIAL</button>
                            </div>

                            <ul class="nav nav-tabs mt-3" :id="'border-tabs'+m.id" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" :id="'border-home_'+m.id"  data-toggle="tab" :href="'#border-home'+m.id"  role="tab"  aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Producto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " :id="'border-interna_'+m.id"  data-toggle="tab" :href="'#border-interna'+m.id"  role="tab"  aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Comp. Interna</a>
                                </li>


                            </ul>
                            <div class="tab-content mb-4" id="border-tabsContent">
                                <div class="tab-pane fade active show" :id="'border-home'+m.id"  role="tabpanel" aria-labelledby="border-home-tab">
                                   <div class="row">
                                   <div class="col-sm-4 col-12">
                                    <img :src="url+'/img/pollo.jpg'" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-sm-8 col-12">
                                        <table class="table table-bordered table-striped">
                                            <tbody>

                                            <tr>
                                                <td class="bg-success text-white">CAJAS</td>
                                                    <td > <strong>{{Number(m.cajas).toFixed(2)}}</strong></td>

                                                </tr>
                                                <td class="bg-success text-white">CANTIDAD POLLOS</td>
                                                    <td > <strong>{{Number(m.pollos_disponible).toFixed(2)}}</strong></td>

                                                </tr>
                                                <tr>
                                                   <td class="bg-warning text-white">PESO BRUTO TOTAL</td>
                                                       <td > <strong>{{Number(m.peso_bruto_disponible).toFixed(2)}}</strong></td>

                                                   </tr>
                                                <tr>
                                                   <td class="bg-warning text-white">PESO NETO TOTAL </td>
                                                       <td > <strong>{{Number(m.peso_neto_disponible).toFixed(2)}}</strong></td>

                                                   </tr>
                                                <tr>
                                                   <td class="bg-secondary text-white">MERMA BRUTA</td>
                                                       <td > <strong>{{Number(m.merma_bruta_disponible).toFixed(2)}}</strong></td>

                                                   </tr>
                                                <tr>
                                                   <td class="bg-secondary text-white">MERMA NETA</td>
                                                       <td > <strong>{{Number(m.merma_neta_disponible).toFixed(2)}}</strong></td>

                                                   </tr>


                                            </tbody>
                                        </table>


                                    </div>

                                   </div>
                                </div>
                                <div class="tab-pane fade " :id="'border-interna'+m.id" role="tabpanel" aria-labelledby="border-home-tab">
                                 <div class="row">
                                    <div class="col-12 table-responsive">
                                    <table class="table table-bordered table-striped mt-2" >
                                        <thead>
                                            <tr>
                                                <td colspan="5" class="bg-primary text-white text-center">COMPOSICION INTERNA DEL LOTE</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-primary text-white ">NOMBRE</td>
                                                <td class="bg-primary text-white ">PESO. TOTAL</td>
                                                <td class="bg-primary text-white ">CANT. TOTAL</td>
                                                <td class="bg-primary text-white "></td>


                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="c in m.pp_detalle_descomposicions" >
                                                    <td :class="m.descomponer==0?'bg-light-success':''">{{c.compo_interna.name}}</td>
                                                    <td :class="m.descomponer==0?'bg-light-success':''">{{Number(c.compo_interna.peso)*Number(c.cantidad)}}</td>
                                                    <td :class="m.descomponer==0?'bg-light-success':''">{{Number(c.compo_interna.cantidad*c.cantidad)}}</td>
                                                    <td :class="m.descomponer==0?'bg-light-success':''">
                                                        <button v-if="c.trozado==1" class="btn btn-warning btn-sm" @click="TrozarPpDetalle(c)">TROZAR</button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                           <tfoot>
                                            <tr>
                                                <td colspan="2" class="bg-primary text-white ">
                                                    PESO TOTAL (Kg)
                                                </td>
                                                <td>
                                                    {{Number(m.peso_interna).toFixed(2)}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="bg-primary text-white ">
                                                    PIEZAS TOTAL (Cant)
                                                </td>
                                                <td>
                                                    {{Number(m.piezas_interna).toFixed(2)}}
                                                </td>
                                            </tr>
                                           </tfoot>
                                        </table>
                                    </div>
                                 </div>
                                 </div>

                            </div>


                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button class="btn btn-warning" v-if="m.descomponer==1" @click="Descomponer(m)">DESCOMPONER</button>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-success mt-2"  data-toggle="modal" data-target="#exampleModal" @click="detalle_envio_pt={...m}">ENVIAR PT</button>
                            </div>
                            <div class="col-12">
                            <table class="table table-bordered table-striped mt-2" >
                                        <thead>
                                            <tr>
                                                <td colspan="4" class="bg-primary text-white text-center">BITACORA DE MOVIMIENTOS</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-primary text-white ">FECHA</td>
                                                <td class="bg-primary text-white ">HORA</td>
                                                <td class="bg-primary text-white ">CANT</td>


                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="c in m.pp_pts" >
                                                    <td >{{c.fecha}}</td>
                                                    <td >{{c.hora}}</td>
                                                    <td >{{c.cantidad}}</td>


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
                            <div class="col-6 text-center">
                                <h3>{{detalle_envio_pt.pollos_disponible}}</h3>
                                <h5 class="text-primary">TOTAL POLLOS DISPONIBLES </h5>

                            </div>
                            <div class="col-6 text-center">
                                <h3>{{envio.cantidad}}</h3>
                                <h5 class="text-primary">TOTAL POLLOS A ENVIAR</h5>

                            </div>


                        </div>
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cantidad de pollos</label>
                                <input type="text" v-model.number="envio.cantidad" class="form-control"   @change="CambioPeso()">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cajas de pollos</label>
                                <input type="text" v-model.number="envio.cajas" class="form-control"   @change="CambioPeso()">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Bruto Unit KG</label>
                                <input type="text" v-model.number="detalle_envio_pt.peso_bruto_actual" @change="CambioPeso()" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Peso Neto Unit KG</label>
                                <input type="text" v-model.number="detalle_envio_pt.peso_neto_actual" @change="CambioPeso()" class="form-control" >
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
                        <button v-if="envio.cantidad<=detalle_envio_pt.cantidad" @click="EnviarPT()" type="button" data-dismiss="modal" class="btn btn-primary">Enviar</button>
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
                    cantidad:0,
                    equivalente:0,
                    pollos:0,
                    pp_detalles:[]
                },
                detalle_envio_pt:{
                    cantidad:0,

                },
                envio:{
                   cajas:0,
                   cantidad:0,
                     bruto:0,
                    neto:0,
                    merma_bruta:0,
                    merma_neta:0,

                },
                retiro_organo_general:'',
                compo_internas:[],
                compo_externas:[],
            }
        },
        computed: {
            lotes_desconpuestos(){
                return this.model_computed.filter((v)=>v.descomponer == 1)
            },
            pp_detalle_descomposicions(){
                return this.model_computed.flatMap((v)=>v.pp_detalle_descomposicions.filter((v)=>v.compo_interna_id==this.retiro_organo_general && v.trozado==1))
            },
            url(){
                return "{{url('')}}"
            },
            detalle_envio(){
                return this.detalle_envio_pt.pollos_disponible-this.envio.cantidad
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
                    let lote_des = lote.pp_detalle_descomposicions.filter((v)=>v.trozado==0)
                    lote.peso_interna = lote_des.reduce((a,b)=>a+Number(Number(b.compo_interna.peso)*Number(b.cantidad)),0)
                    lote.piezas_interna = lote_des.reduce((a,b)=>a+Number(b.cantidad),0)
                    lote.peso_bruto_actual = Number(lote.peso_bruto / lote.cantidad).toFixed(2)
                    lote.peso_neto_actual = Number(lote.peso_neto / lote.cantidad).toFixed(2)
                    lote.total_pt = v.pp_pts.reduce((a,b)=>a+Number(b.cantidad),0)
                    lote.pollos_disponible = Number(lote.cantidad - lote.total_pt).toFixed(2)
                    lote.peso_bruto_disponible = lote.pollos_disponible * lote.peso_bruto_actual
                    lote.peso_neto_disponible = lote.pollos_disponible * lote.peso_neto_actual
                    lote.merma_bruta_actual = Number(lote.merma_bruta/lote.cantidad)
                    lote.merma_neta_actual = Number(lote.merma_neta/lote.cantidad)
                    lote.merma_bruta_disponible = lote.pollos_disponible * lote.merma_bruta_actual
                    lote.merma_neta_disponible = lote.pollos_disponible * lote.merma_neta_actual
                    return lote
                })
            }
        },
        methods: {
            CambioPeso(){
                this.envio.bruto= Number(this.detalle_envio_pt.peso_bruto_actual*this.envio.cantidad).toFixed(2)
                this.envio.neto= Number(this.detalle_envio_pt.peso_neto_actual*this.envio.cantidad).toFixed(2)
                this.envio.merma_bruta=  Number((this.detalle_envio_pt.peso_bruto_actual*this.envio.cantidad)-{...this.envio}.bruto).toFixed(2)
                this.envio.merma_neta= Number((this.detalle_envio_pt.peso_neto_actual*this.envio.cantidad)-{...this.envio}.neto).toFixed(2)


            },
            CambioPesoMerma(){
                this.envio.merma_bruta= Number((this.detalle_envio_pt.peso_bruto_actual*this.envio.cantidad)-{...this.envio}.bruto).toFixed(2)
                this.envio.merma_neta= Number((this.detalle_envio_pt.peso_neto_actual*this.envio.cantidad)-{...this.envio}.neto).toFixed(2)


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
                        await Promise.all([self.GET_DATA("{{url('api/lotes-pp')}}/{{$id}}"),
                        self.GET_DATA("{{url('api/compoInternas')}}"),
                        self.GET_DATA("{{url('api/compoExternas')}}")
                    ]).then((v) => {
                            self.model = v[0]
                            self.compo_internas = v[1]
                            self.compo_externas = v[2]
                        })

                    } catch (e) {

                    }
                } catch (e) {

                }
            },
            async EnviarPT(){
                console.log(this.detalle_envio_pt);
                try {
                    let self = this
                 let data={...this.detalle_envio_pt}
                 data.cantidad_envio = this.envio.cantidad
                 data.cajas_envio = this.envio.cajas
                data.peso_bruto_2 = this.envio.bruto
                data.peso_neto_2 = this.envio.neto
                data.merma_bruta = this.envio.merma_bruta
                data.merma_neta = this.envio.merma_neta
                    let res = await axios.post("{{url('api/ptDetalles')}}",data)
                    const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success btn-rounded',
                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                    buttonsStyling: false,
                })

                       swalWithBootstrapButtons({
                    title: 'Enviado!',
                    type: 'success',
                    })
                    await self.load()
                    window.open(res.data.url_pdf, '_blank');
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
            },
            async Descomponer(item){
                try {


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
                    confirmButtonText: 'Descomponer!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        let pp_detalle = {...item}
                    pp_detalle.compo_internas = this.compo_internas
                    let res = await axios.post("{{url('api/descomponer-ppdetalles')}}/"+pp_detalle.id,pp_detalle)
                        await this.load()
                        window.open(res.data.url_pdf, '_blank');
                    }
                })
                } catch (error) {

                }

            },
            async DescomponerGeneral(item){
                try {

                    let pp_detalle = {...item}
                    pp_detalle.compo_internas = this.compo_internas
                    let res = await axios.post("{{url('api/descomponer-ppdetalles')}}/"+pp_detalle.id,pp_detalle)
                    return res.data
                } catch (error) {

                }

            },
            async TrozarPpDetalle(item){
                try {


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
                    confirmButtonText: 'Descomponer!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        let pp_detalle = {...item}

                        let res = await axios.post("{{url('api/descomponerppdetalles')}}/"+pp_detalle.id,pp_detalle)
                        await this.load()
                    }
                })
                } catch (error) {

                }

            },
            async TrozarPpDetalleUnit(item){
                try {
                    let pp_detalle = {...item}
                    let res = await axios.post("{{url('api/descomponerppdetalles')}}/"+pp_detalle.id,pp_detalle)
                    return res.data
                } catch (error) {

                }

            },
            async RegresarLote(item){
                try {


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
                    confirmButtonText: 'Regresar!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        let pp_detalle = {...item}

                        let res = await axios.post("{{url('api/ppDetalleRegresar')}}/"+item.id,pp_detalle)
                        await this.load()
                    }
                })
                } catch (error) {

                }

            },
            async DescomponerTodo(){
                this.lotes_desconpuestos.map(async (item)=>{

                    await this.DescomponerGeneral(item)

                })
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success btn-rounded',
                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                    buttonsStyling: false,
                })
                swalWithBootstrapButtons({
                    title: 'Trozado!',

                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Ok!',

                    reverseButtons: true,
                    padding: '2em'
                })
                await this.load()
            },
            async QuitarOrgano(){
                this.pp_detalle_descomposicions.map(async (item)=>{
                    await this.TrozarPpDetalleUnit(item)

                })
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success btn-rounded',
                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                    buttonsStyling: false,
                })
                swalWithBootstrapButtons({
                    title: 'Descompuesto!',

                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Ok!',

                    reverseButtons: true,
                    padding: '2em'
                })
                await this.load()
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
