@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="widget-content widget-content-area br-6">
                <div class="section general-info">
                    <div class="info">
                        <h6 class="">Seleccione los LOTES que desea consolidar para despues pasar a Pagar</h6>
                        <div class="row">

                            <div class="col-8">
                                <div class="form-group ">
                                    <label>Lotes</label>

                                    <div class="input-group mb-4">

                                        <select v-model="model.compra_id" class="form-control">

                                            <template v-for="(m,i) in compras.reverse()">

                                                <option v-if="m.consolidacion_detalles.length==0 && m.estado==1" :value="m.id">
                                                    {{m.fecha}} - N°: {{m.proveedor_compra.abreviatura}} {{m.nro_compra}} - N° Lote: {{m.nro}}  - {{m.proveedor_compra.nombre}}
                                                </option>


                                            </template>

                                        </select>
                                        <button class="btn btn-success " @click="GetLote()" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group ">
                                    <label>Ajuste</label>

                                    <div class="input-group mb-4">

                                        <select v-model="paramConsolidacion" class="form-control">


                                            <option v-for="(m,i) in consolidacionParams" :value="m">{{m.name}} % {{Number(m.monto).toFixed(2)}}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <div v-if="!lote" class="alert alert-warning alert-dismissible fade show mb-4" role="alert">

                                    <strong>Sin Lote!</strong> Seleccione un lote para comenzar con la consolidacion.
                                </div>
                                <div class="col-12">

                                </div>
                                <div v-else class="row">
                                    <div v-for="(l,i) in categoriaList" class="col-xxl-10 col-xl-12 col-lg-10 col-md-10 col-sm-10 mx-auto">

                                        <div class="card" v-for="m in l.categoria_proveedor_list">
                                            <div class="card-body">
                                                <h6>{{m.categoria.name}} N° Compra: {{l.proveedor_compra.abreviatura}} {{l.nro_compra}} - Lote N°: {{l.nro}} - Fecha: {{l.fecha}} - Proveedor: {{l.proveedor_compra.nombre}} </h4>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div class="form-group">
                                                                <label for="fullName">Sugerido</label>
                                                                <input type="text" class="form-control mb-4" v-model.number="m.sugerido">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="table-responsive mb-4 mt-4">
                                                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Und Pollos</th>
                                                                            <th>Peso Compra</th>
                                                                            <th>Ajuste %</th>
                                                                            <th>Sugerido</th>
                                                                            <th>Nuevo Peso</th>
                                                                            <th>
                                                                            <span class="text-danger">Para sumar agregar (-)  </span>
                                                                            Criterio (-)</th>
                                                                            <th>Nuevo Peso</th>
                                                                            <th>Nuevo AJuste(-)</th>
                                                                            <th>Peso Oficial</th>
                                                                            <th>Precio Compra KG</th>
                                                                            <th>Valor Total </th>
                                                                            <th class="text-success">T Pollos</th>
                                                                            <th class="text-success">CBBA</th>
                                                                            <th class="text-success">LP</th>
                                                                            <th class="text-success">KG TOTAL</th>
                                                                            <th class="text-success">KG CRITERIO</th>
                                                                            <th class="text-warning">KG TOTAL</th>




                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="td-c">{{Number(m.sumaPollos).toFixed(2)}}</td>
                                                                            <td class="td-c"> <input v-model.number="m.sumaTotal" type="text" class="fm-ct form-control "></td>
                                                                            <td class="td-c">{{Number(m.ajuste).toFixed(2)}}</td>
                                                                            <td class="td-c text-primary "><span class="fw-700">{{Number(m.ajuste*(m.sugerido/100)).toFixed(2)}}</span> </td>
                                                                            <td class="td-c">{{Number(m.nuevo_peso).toFixed(2)}}</td>
                                                                            <td class="td-c"> <input v-model.number="m.criterio" type="text" class="fm-ct form-control "></td>
                                                                            <td class="td-c">{{Number(m.nuevo_peso_2).toFixed(2)}}</td>
                                                                            <td class="td-c"> <input v-model.number="m.nuevoajuste" type="text" class="fm-ct form-control "></td>
                                                                            <td class="td-c">{{Number(m.oficial).toFixed(2)}}</td>
                                                                            <td class="td-c"> <input v-model.number="m.precio" disabled type="text" class="fm-ct form-control "></td>
                                                                            <td class="td-c">{{Number(m.precioCompra).toFixed(2)}}</td>
                                                                            <td class="td-c">{{Number(m.sumaPollos).toFixed(2)}}</td>
                                                                            <td class="td-c"> {{Number(m.ajuste).toFixed(2)}}</td>
                                                                            <td class="td-c"><input v-model.number="m.lp" type="text" class="fm-ct form-control "></td>
                                                                            <td class="td-c"> {{Number(m.kg_total).toFixed(2)}}</td>
                                                                            <td class="td-c">{{Number(m.kg_criterio).toFixed(2)}}</td>
                                                                            <td class="td-c text-warning">{{Number(m.kg_criterio_total).toFixed(2)}}</td>




                                                                        </tr>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName">Peso Total</label>
                                                    <input :value="Number(l.suma_peso).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>

                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName">Valor Total</label>
                                                    <input :value="Number(l.suma_valor).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Pollos Total</label>
                                                    <input :value="Number(l.suma_pollos).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">CBBA Total</label>
                                                    <input :value="Number(l.suma_cbba).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Lp Total</label>
                                                    <input :value="Number(l.suma_lp).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Kg Total</label>
                                                    <input :value="Number(l.suma_kg_total).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold"> Kg Criterio</label>
                                                    <input :value="Number(l.suma_kg_criterio).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold"> Kg Criterio Total</label>
                                                    <input :value="Number(l.suma_kg_criterio_total).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                                <div class="col-12 mt-2" v-if="gastosFinales.length > 0">
                                                    <h5>Detalle de Gastos Extras</h5>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Detalle</th>
                                                                <th>Valor</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(gasto, i) in gastosFinales" :key="i">
                                                                <td>{{ gasto . detalle }}</td>
                                                                <td>{{ gasto . valor . toFixed(2) }}</td>
                                                                <td>
                                                                    <button @click="removeGastoFinal(i)"
                                                                        class="btn btn-danger p-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-trash-2">
                                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                                            <path
                                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                            </path>
                                                                            <line x1="10" y1="11" x2="10"
                                                                                y2="17"></line>
                                                                            <line x1="14" y1="11" x2="14"
                                                                                y2="17"></line>
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>TOTAL EN GASTOS</strong></td>
                                                                <td><strong>{{ valorTotalFinal . toFixed(2) }}</strong></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 mt-2" v-if="lotes.length !== 0">
                                                    <hr>
                                                    <div class="statbox widget box box-shadow">
                                                        <div class="widget-content widget-content-area border-tab p-0">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="4"
                                                                            class="text-center bg-primary text-white">
                                                                            GASTOS EXTRAS
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>DETALLE</th>
                                                                        <th>VALOR</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <template v-for="(item, i) in gastos">
                                                                        <tr class="tr-hover">
                                                                            <td>
                                                                                <button @click="addGasto()"
                                                                                    class="btn btn-success p-1">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-plus">
                                                                                        <line x1="12" y1="5"
                                                                                            x2="12" y2="19"></line>
                                                                                        <line x1="5" y1="12"
                                                                                            x2="19" y2="12"></line>
                                                                                    </svg>
                                                                                </button>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control"
                                                                                    v-model="item.detalle">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control"
                                                                                    v-model.number="item.valor">
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-danger p-1" v-if="i > 0"
                                                                                    @click="removeGasto(i)">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-trash-2">
                                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                                        <path
                                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                        </path>
                                                                                        <line x1="10" y1="11"
                                                                                            x2="10" y2="17"></line>
                                                                                        <line x1="14" y1="11"
                                                                                            x2="14" y2="17"></line>
                                                                                    </svg>
                                                                                </button>
                                                                                <button class="btn btn-success p-1"
                                                                                    @click="AddGastoFinal(item, i)">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-check">
                                                                                        <polyline points="20 6 9 17 4 12">
                                                                                        </polyline>
                                                                                    </svg>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </template>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                    <div class="col-12">
                                        <hr>
                                        <div class="row bg-dark p-2">
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Peso Total</label>
                                                    <input :value="Number(SumPeso).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-12 m-4">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Valor Total</label>
                                                    <input :value="Number(valorTotalFinal).toFixed(2)" disabled
                                                            type="text" class="form-control mb-4">
                                                </div>
                                            </div>

                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Pollos Total</label>
                                                    <input :value="Number(SumTotalPollos).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">CBBA Total</label>
                                                    <input :value="Number(sumaCbba).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Lp Total</label>
                                                    <input :value="Number(sumaLp).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold">Kg Total</label>
                                                    <input :value="Number(SumKgTotal).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold"> Kg Criterio</label>
                                                    <input :value="Number(SumKgCriterio).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-12">
                                                <div class="form-group">
                                                    <label for="fullName" class="text-success fw-bold"> Kg Criterio Total</label>
                                                    <input :value="Number(SumKgCriterioTotal).toFixed(2)" disabled type="text" class="form-control mb-4">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div v-if="!lote" class="col-sm-12 col-12">
                                <hr>
                            </div>
                            <div v-else class="col-12">

                            </div>

                            <div class="col-sm-12 col-12">
                                <hr>
                            </div>

                            <div class="col-6">
                                <button class="btn btn-dark w-100" @click="back()">Regresar</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-success w-100" @click="Save()">Guardar Consolidacion</button>
                            </div>

                        </div>
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
    let block = new Block()

    createApp({
        data() {
            return {
                model: {
                    inactivo: 1,
                    pagar: 1,
                    camion: '',
                    placa: '',
                    chofer: '',
                    e_recepcion: '',
                    e_despacho: '',

                    fecha: '',
                    hora: '',
                    almacen_id: '',
                    compra_id: '',

                    medidas: []
                },
                producto_model: {
                    nro: 0,
                    peso: 0,
                    cantidad: 1,
                },
                producto: {
                    name: '',
                    medida_productos: []
                },
                paramConsolidacion: {

                },
                medida_producto: {

                },
                pago: {
                    tipo: 1,
                    fecha: "",
                    adelanto: 0,
                    banco_id: 1,
                },
                lotes: [],
                compras: [],
                consolidacionParams: [],
                medidas: [],
                bancos: [],
                almacens: [],
                data: [],
                productos: [],
                productos_model: [],
                submedida: {
                    name: '',
                    valor_1: 0,
                    valor_2: 0,
                    categoria: {
                        name: ''
                    }
                },
                sugerido: 3,
                gastos: [{
                    detalle: '',
                    valor: 0
                }],
                gastosFinales: [],
                valorTotalFinal: 0,

            }
        },
        computed: {
            categoriaList() {
                if (this.lotes.length == 0) {

                    return []
                }

                return this.lotes.map((l) => {
                    l.categoria_proveedor_list.map((c) => {
                        //numero a string
                        let sumaTotal = c.sumaTotal.toString()
                        let sumaPollos = c.sumaPollos.toString()

                        //validar si existe una coma en el string
                        if (sumaTotal.indexOf(',') > -1) {
                            sumaTotal = sumaTotal.replace(/,/g, "")
                        }
                        if (sumaPollos.indexOf(',') > -1) {
                            sumaPollos = sumaPollos.replace(/,/g, "")
                        }
                        c.sumaPollos = sumaPollos
                        c.sumaTotal = sumaTotal

                        c.sugerido = isNaN(c.sugerido) ? 3 : Number(c.sugerido)
                        let porcentaje = Number(this.paramConsolidacion.monto) / 100
                        c.ajuste = Number(c.sumaTotal * porcentaje)
                        c.nuevo_peso = c.sumaTotal - c.ajuste
                        c.nuevo_peso_2 = c.nuevo_peso - c.criterio
                        c.oficial = c.nuevo_peso_2 - c.nuevoajuste
                        c.precioCompra = c.oficial * c.precio
                        c.kg_total = c.ajuste - (isNaN(c.lp) ? 0 : Number(c.lp))
                        c.kg_criterio =  c.criterio
                        c.kg_criterio_total = c.kg_criterio + c.kg_total
                        return c
                    })
                    l.suma_peso = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.oficial), 0)
                    l.suma_valor = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.precioCompra), 0)
                    l.suma_pollos = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.sumaPollos), 0)
                    l.suma_cbba = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.ajuste), 0)
                    l.suma_lp = l.categoria_proveedor_list.reduce((a, b) => a + Number(isNaN(b.lp) ? 0 : Number(b.lp)), 0)
                    l.suma_kg_total = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.kg_total), 0)
                    l.suma_kg_criterio = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.kg_criterio), 0)
                    l.suma_kg_criterio_total = l.categoria_proveedor_list.reduce((a, b) => a + Number(b.kg_criterio_total), 0)
                    return l
                })
            },
              SumPeso() {
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_peso), 0)
              },
              SumValor() {
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_valor), 0)
              },

              SumTotalPollos(){
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_pollos), 0)
              },
              sumaCbba(){
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_cbba), 0)
              },
              sumaLp(){
                return this.categoriaList.reduce((a, b) => a + Number(isNaN(b.suma_lp) ? 0 : Number(b.suma_lp)), 0)
              },
              SumKgTotal(){
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_total), 0)
              },
              SumKgCriterio(){
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_criterio), 0)
              },
              SumKgCriterioTotal(){
                return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_criterio_total), 0)
              },
              valorTotalFinal() {
                return this.SumValor + this.valorTotal;
              },
        },
        methods: {

                    addGasto() {
                        this.gastos.push({
                            detalle: '',
                            valor: 0
                        });
                        this.updateValorTotal();
                    },

                    removeGasto(i) {
                        this.gastos.splice(i, 1);
                        this.updateValorTotal();
                    },

                    updateValorTotal() {
                        this.valorTotal = this.gastos.reduce((acc, gasto) => acc + (gasto.valor || 0), 0);
                    },

                    AddGastoFinal(item, i) {
                        if (item.detalle && item.valor > 0) {
                            this.gastosFinales.push({
                                detalle: item.detalle,
                                valor: item.valor
                            });
                            this.gastos[i].detalle = '';
                            this.gastos[i].valor = 0;
                            this.updateValorTotalFinal();
                        } else {
                            swal({
                                title: 'Error',
                                text: 'Por favor complete los campos "Detalle" y "Valor" antes de agregar.',
                                type: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    removeGastoFinal(i) {
                        this.gastosFinales.splice(i, 1);
                        this.updateValorTotalFinal();
                    },
                    updateValorTotalFinal() {
                        this.valorTotalFinal = this.gastosFinales.reduce((acc, gasto) => acc + (gasto.valor || 0), 0);
                    },

            async GET_DATA(path) {
                try {
                    let res = await axios.get("{{url('api')}}/" + path)
                    return res.data
                } catch (e) {

                }
            },
            async GetLote() {
                block.block();
                try {
                    let res = await axios.get("{{url('api')}}/compras/" + this.model.compra_id)
                    this.lotes.push(res.data)
                } catch (e) {

                } finally {
                    block.unblock();
                }
            },
            AgregarProducto() {
                let medidas = this.medida_producto
                let bruto = Number(this.producto_model.peso) / Number(this.producto_model.nro)
                let neto = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.producto_model.cantidad)))
                let sub = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.producto_model.cantidad))) / Number(this.producto_model.nro)
                let unit = {}
                medidas.sub_medidas.map((a) => {
                    let valor_1 = Number(a.valor_1)
                    let valor_2 = Number(a.valor_2)
                    if (sub >= valor_1 && sub <= valor_2) {
                        unit = a
                    }
                })
                const producto = {
                    sub_medida: unit,
                    producto: {
                        name: this.producto.name,
                        id: this.producto.id,
                    },
                    categoria: {},
                    medida_producto: medidas,
                    producto_model: {
                        peso: this.producto_model.peso,
                        neto: neto,
                        nro: this.producto_model.nro,
                        cantidad: this.producto_model.cantidad,
                    },

                }
                this.productos_model.push(producto)
            },
            ChangeProducto(i) {
                let medidas = this.productos_model[i].medida_producto
                this.productos_model[i].producto_model.nro = this.productos_model[i].medida_producto.valor * this.productos_model[i].producto_model.cantidad

                let bruto = Number(this.productos_model[i].producto_model.peso) / Number(this.productos_model[i].producto_model.nro)
                let neto = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.productos_model[i].producto_model.cantidad)))
                let sub = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.productos_model[i].producto_model.cantidad))) / Number(this.productos_model[i].producto_model.nro)
                let unit = {}
                medidas.sub_medidas.map((a) => {
                    let valor_1 = Number(a.valor_1)
                    let valor_2 = Number(a.valor_2)
                    if (sub >= valor_1 && sub <= valor_2) {
                        unit = a
                    }
                })

                this.productos_model[i].producto_model.neto = neto
                this.productos_model[i].sub_medida = unit
            },
            CambioProducto() {

                this.medida_producto = this.producto.medida_productos[0]
                this.producto_model.nro = this.producto_model.cantidad * Number(this.medida_producto.valor)
            },
            AgregarSubmedida(i) {
                const submedida = {
                    name: this.submedida.name,
                    valor_1: this.submedida.valor_1,
                    valor_2: this.submedida.valor_2,
                    categoria: this.submedida.categoria,
                }
                this.model.medidas[i].submedidas.push(submedida)
            },

            async Save() {
                block.block();
                try {
                    this.model.gastos = this.gastosFinales;
                    this.model.consolidacionparam_id = this.paramConsolidacion.id
                    this.model.valor_total = this.valorTotalFinal
                    this.model.peso_total = this.SumPeso
                    this.model.categoria_list = this.categoriaList
                    this.model.pago = this.pago
                    let res = await axios.post("{{url('api/consolidacions')}}", this.model)
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success btn-rounded',
                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        buttonsStyling: false,
                    })
                    let consolidacion = res.data
                    swalWithBootstrapButtons({
                        title: 'Consolidacion Guardada',
                        text: "Su Consolidacion fue guardada",
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'IMPRIMIR PDF',
                        cancelButtonText: 'REGRESAR',
                        reverseButtons: true,
                        padding: '2em'
                    }).then(async (result) => {
                        if (result.value) {
                            try {


                                window.open(consolidacion.url_pdf, '_blank');
                                this.back()
                            } catch (e) {

                            }
                        } else {
                            this.back()
                        }
                    })

                } catch (e) {
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success btn-rounded',
                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                        title: 'Operacion Cancelada',
                        text: "Probablemente su Consolidacion tiene campos vacios, reviselo y vuelva a intentarlo",
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        cancelButtonText: 'REGRESAR',
                        reverseButtons: true,
                        padding: '2em'
                    })
                } finally {
                    block.unblock();
                }
            },
            back() {
                window.location.replace(document.referrer);
            }
        },
        mounted() {
            this.$nextTick(async () => {
                let self = this
                block.block();
                try {



                    await Promise.all([self.GET_DATA('compras'), self.GET_DATA('consolidacionparams'), self.GET_DATA('productos'), self.GET_DATA('almacens'), self.GET_DATA('bancos')]).then((v) => {
                        self.compras = v[0]
                        self.consolidacionParams = v[1]
                        self.productos = v[2]
                        self.almacens = v[3]
                        self.bancos = v[4]
                    })
                    if (self.consolidacionParams.length) {
                        self.paramConsolidacion = self.consolidacionParams[0]
                    }
                    if (self.bancos.length) {
                        self.pago.banco_id = self.bancos[0].id
                    }

                } catch (e) {

                } finally {
                    block.unblock();
                }

            })
        }
    }).mount('#meApp')
</script>

@endslot
@slot('style')
<style>
    .fm-ct {
        width: 100px;
    }

    td.td-c {
        width: 100px;
    }

    .table>thead>tr>th {
        color: #1b55e2;
        font-weight: 700;
        font-size: 10px !important;
        border: none;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
</style>
@endslot
@endcomponent
