@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Informacion General</h6>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Ajuste</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="paramConsolidacion" disabled class="form-control">
                                                        <option v-for="(m,i) in consolidacionParams.reverse()"
                                                            :value="m">{{ m . name }} %
                                                            {{ Number(m . monto) . toFixed(2) }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div v-for="(m,i) in categoriaList"
                                                    class="col-xxl-10 col-xl-12 col-lg-10 col-md-10 col-sm-10 mx-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6>{{ m . categoria . name }} - Lote N°: {{ m . compra . nro }}
                                                                Fecha:{{ m . compra . fecha }} - Proveedor:
                                                                {{ m . compra . proveedor_compra . nombre }}
                                                                {{ m . compra . proveedor_compra . abreviatura }}</h6>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="table-responsive mb-4 mt-4">
                                                                        <table id="table_dt" class="table table-hover non-hover"
                                                                            style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Peso Compra</th>
                                                                                    <th>Ajuste %</th>
                                                                                    <th >Nuevo Peso</th>
                                                                                    <th >
                                                                                        <span class="text-danger">Para sumar agregar
                                                                                            (-)
                                                                                        </span>
                                                                                        Criterio (-)
                                                                                    </th>
                                                                                    <th>Nuevo Peso</th>
                                                                                    <th >Nuevo AJuste(-)</th>
                                                                                    <th>Peso Oficial</th>
                                                                                    <th class="text-success">T Aves</th>
                                                                                    <th class="text-success">Peso x Ave</th>
                                                                                    <th>Precio Compra KG</th>
                                                                                    <th>Valor Total </th>
                                                                                    <th class="text-success" style="display: none">
                                                                                        CBBA</th>
                                                                                    <th class="text-success" style="display: none">
                                                                                        LP</th>
                                                                                    <th class="text-success" >
                                                                                        KG TOTAL</th>
                                                                                    <th class="text-success" >
                                                                                        KG CRITERIO</th>
                                                                                    <th class="text-warning" >
                                                                                        KG TOTAL</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="td-c"> <input
                                                                                            v-model.number="m.suma_total"
                                                                                            type="text"
                                                                                            class="fm-ct form-control ">
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . ajuste) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c" >
                                                                                        {{ Number(m . nuevo_peso) . toFixed(2) }}
                                                                                    </td>

                                                                                    <td class="td-c" > <input
                                                                                            v-model.number="m.criterio"
                                                                                            type="text"
                                                                                            class="fm-ct form-control ">
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . nuevo_peso_2) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c" > <input
                                                                                            v-model.number="m.nuevoajuste"
                                                                                            type="text"
                                                                                            class="fm-ct form-control "></td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . oficial) . toFixed(2) }}</td>


                                                                                    <td class="td-c">
                                                                                        {{ Number(m . pollos) . toFixed(2) }}</td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . pesoPorAve) . toFixed(3) }}
                                                                                    </td>
                                                                                    <td class="td-c"> <input
                                                                                            v-model.number="m.precio"
                                                                                            :disabled="m.n_cambios >= 6"
                                                                                            type="text"
                                                                                            class="fm-ct form-control "></td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . precioCompra) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c" style="display: none">
                                                                                        {{ Number(m . ajuste) . toFixed(2) }}</td>
                                                                                    <td class="td-c" style="display: none"><input
                                                                                            v-model.number="m.lp" type="text"
                                                                                            class="fm-ct form-control "></td>
                                                                                    <td class="td-c" >
                                                                                        {{ Number(m . kg_total) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c" >
                                                                                        {{ Number(m . kg_criterio) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c text-warning"
                                                                                        >
                                                                                        {{ Number(m . kg_criterio_total) . toFixed(2) }}
                                                                                    </td>
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
                                        <div class="col-12 mt-2">
                                            <h5>Detalle de Gastos Extras </h5>
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
                                                            <button @click="removeGastoFinal(i)" class="btn btn-danger p-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" class="feather feather-trash-2">
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

                                        <div class="col-12 mt-2">
                                            <hr>
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4" class="text-center bg-primary text-white">
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
                                                                        <button @click="addGasto()" class="btn btn-success p-1">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
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
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
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
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
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
                                        <div class="col-sm-2 col-12 m-4">
                                            <div class="form-group">
                                                <label for="fullName">Peso Total</label>
                                                <input :value="Number(SumPeso).toFixed(2)" disabled type="text"
                                                    class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-12 m-4">
                                            <div class="form-group">
                                                <label for="fullName">Valor Total</label>
                                                <input :value="Number(SumValor).toFixed(2)" disabled type="text"
                                                    class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-12">
                                            <hr>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-dark w-100" @click="back()">REGRESAR</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-success w-100" @click="Save()">ASIGNAR PRECIO / EDITAR
                                                PRECIO</button>
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
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"
            const {
                createApp
            } = Vue
            let block = new Block()
            createApp({
                data() {
                    return {
                        user: {},

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
                        lote: null,
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
                        if (!this.lote) {

                            return []
                        }

                        return this.lote.detalles.map((c) => {
                            let porcentaje = Number(this.paramConsolidacion.monto) / 100
                            let sumaTotal = c.suma_total.toString()

                            if (sumaTotal.indexOf(',') > -1) {
                                sumaTotal = sumaTotal.replace(/,/g, "")
                            }
                            c.suma_total = sumaTotal

                            c.ajuste = Number(c.suma_total * porcentaje)
                            c.nuevo_peso = c.suma_total - c.ajuste
                            c.nuevo_peso_2 = c.nuevo_peso - c.criterio

                            c.oficial = c.nuevo_peso_2 - c.nuevoajuste
                            c.precioCompra = (Number(c.oficial) * Number(c.precio)).toFixed(2);
                            c.pesoPorAve = (Number(c.oficial) / Number(c.pollos)).toFixed(3);
                            c.kg_total = c.ajuste - (isNaN(c.lp) ? 0 : Number(c.lp))
                            c.kg_criterio = Number(c.criterio)
                            c.kg_criterio_total = c.kg_criterio + c.kg_total
                            return c
                        })
                    },
                    SumPeso() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.oficial), 0)
                    },
                    SumValor() {
                        let consolidationSum = this.categoriaList.reduce((a, b) => a + (Number(b.oficial) * Number(b
                            .precio)), 0);
                        let gastosSum = this.gastosFinales.reduce((acc, gasto) => acc + (gasto.valor || 0), 0);
                        return (consolidationSum + gastosSum).toFixed(2);
                    },

                    // SumPollos() {
                    //     return this.categoriaList.reduce((a, b) => a + Number(b.pollos), 0);
                    // },
                    // PesoPorPollo() {
                    //     const totalOficial = this.categoriaList.reduce((a, b) => a + Number(b.oficial), 0);
                    //     const totalPollos = this.SumPollos(); // Usamos la propiedad computada `SumPollos`
                    //     return totalPollos > 0 ? (totalOficial / totalPollos).toFixed(3) :
                    //     0;
                    // }

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
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async GetLote() {
                        block.block();
                        try {
                            let res = await axios.get("{{ url('api') }}/compras-aves/" + this.model.compra_id)
                            this.lote = res.data
                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    AgregarProducto() {
                        let medidas = this.medida_producto
                        let bruto = Number(this.producto_model.peso) / Number(this.producto_model.nro)
                        let neto = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) *
                            Number(this.producto_model.cantidad)))
                        let sub = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(
                            this.producto_model.cantidad))) / Number(this.producto_model.nro)
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
                        this.productos_model[i].producto_model.nro = this.productos_model[i].medida_producto.valor *
                            this.productos_model[i].producto_model.cantidad

                        let bruto = Number(this.productos_model[i].producto_model.peso) / Number(this.productos_model[i]
                            .producto_model.nro)
                        let neto = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida
                            .retraccion) * Number(this.productos_model[i].producto_model.cantidad)))
                        let sub = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida
                            .retraccion) * Number(this.productos_model[i].producto_model.cantidad))) / Number(this
                            .productos_model[i].producto_model.nro)
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
                            this.model.consolidacionparam_id = this.paramConsolidacion.id
                            this.model.valor_total = this.SumValor
                            this.model.peso_total = this.SumPeso
                            this.model.categoria_list = this.categoriaList
                            this.model.pago = this.pago
                            this.model.user_id = this.user.id
                            this.model.gastos_finales = this.gastosFinales

                            let res = await axios.put("{{ url('api/consolidacions_aves') }}/{{ $id }}",
                                this.model)
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
                        } catch (e) {} finally {
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
                            await Promise.all([self.GET_DATA('compras-aves'), self.GET_DATA(
                                    'consolidacionparams'), self.GET_DATA('productos'), self
                                .GET_DATA('almacens'), self.GET_DATA('bancos'), self.GET_DATA(
                                    "consolidacions_aves/{{ $id }}")
                            ]).then((v) => {
                                self.compras = v[0]
                                self.consolidacionParams = v[1]
                                self.productos = v[2]
                                self.almacens = v[3]
                                self.bancos = v[4]
                                self.lote = v[5]
                                self.valorTotal = self.lote.valor_total || 0;
                                if (typeof self.lote.gastos === 'string') {
                                    self.gastosFinales = JSON.parse(self.lote.gastos);
                                } else if (Array.isArray(self.lote.gastos)) {
                                    self.gastosFinales = self.lote.gastos;
                                } else {
                                    self.gastosFinales = [];
                                }
                                this.updateValorTotalFinal();
                            })
                            if (self.consolidacionParams.length) {
                                self.paramConsolidacion = self.consolidacionParams[0]
                            }
                            if (self.bancos.length) {
                                self.pago.banco_id = self.bancos[0].id
                            }
                        } catch (e) {} finally {
                            let login = localStorage.getItem('AppUser')
                            if (login != null) {
                                this.user = JSON.parse(login)
                            }
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
        </style>
    @endslot
@endcomponent
