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
                                        <div class="col-9 mb-2">
                                            <br>
                                            <button class="btn btn-success w-100 mt-2" @click="AgregarLoteManual()" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                </svg>
                                                AGREGAR LOTE
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div v-for="(m,i) in categoriaList"
                                                    class="col-xxl-10 col-xl-12 col-lg-10 col-md-10 col-sm-10 mx-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6>Compra de Aves, Lote N°: {{ m . nro_lote }} - Fecha:
                                                                {{ m . fecha }} -
                                                                Proveedor: {{ m . proveedor }}
                                                            </h6>
                                                            <button class="btn btn-danger btn-sm p-1 position-absolute"
                                                                style="top:0; right:0; z-index:2;" @click="eliminarLote(i)"
                                                                title="Eliminar lote">
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
                                                            <div class="row">

                                                                <div class="col-12 col-md-5 col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Proveedor</label>
                                                                        <input v-model="m.proveedor" type="text"
                                                                            class="form-control" required placeholder="Proveedor" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-2 col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Nro. Lote</label>
                                                                        <input v-model="m.nro_lote" type="text"
                                                                            class="form-control" placeholder="Nro. Lote" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-5 col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Observación</label>
                                                                        <input v-model="m.observacion" type="text"
                                                                            class="form-control" placeholder="Obs." />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="table-responsive">
                                                                        <table id="table_dt"
                                                                            class="table table-sm table-bordered text-center align-middle">
                                                                            <thead class="bg-light">
                                                                                <tr>
                                                                                    <th>Peso Compra (BRUTO)</th>
                                                                                    <th>Tara</th>
                                                                                    <th>Und Aves</th>
                                                                                    <th>Cant Jaulas</th>
                                                                                    <th>Peso Compra (NETO)</th>
                                                                                    <th>Ajuste %</th>
                                                                                    <th>Nuevo Peso</th>
                                                                                    <th>
                                                                                        <span class="text-danger">Para sumar agregar
                                                                                            (-)
                                                                                        </span>
                                                                                        Criterio (-)
                                                                                    </th>
                                                                                    <th>Nuevo Peso</th>
                                                                                    <th>Nuevo AJuste(-)</th>
                                                                                    <th>Peso Oficial</th>
                                                                                    <th style="display: none" class="text-success">T
                                                                                        Aves</th>
                                                                                    <th class="text-success">Peso x Ave</th>
                                                                                    <th>Precio Compra KG</th>
                                                                                    <th>Valor Total </th>
                                                                                    <th class="text-success" style="display: none">
                                                                                        CBBA</th>
                                                                                    <th class="text-success" style="display: none">
                                                                                        LP</th>
                                                                                    <th class="text-success">
                                                                                        KG TOTAL</th>
                                                                                    <th class="text-success">
                                                                                        KG CRITERIO</th>
                                                                                    <th class="text-warning">
                                                                                        KG TOTAL</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>

                                                                                    <td class="td-c">
                                                                                        <input v-model.number="m.peso_bruto"
                                                                                            type="text"
                                                                                            class="fm-ct form-control" />
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        <input v-model.number="m.tara"
                                                                                            type="text"
                                                                                            class="fm-ct form-control" />
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        <input v-model.number="m.pollos"
                                                                                            type="text"
                                                                                            class="fm-ct form-control" />
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        <input v-model.number="m.cantidad_jaulas"
                                                                                            type="text"
                                                                                            class="fm-ct form-control" />
                                                                                    </td>

                                                                                    <td class="td-c"> <input
                                                                                            v-model.number="m.suma_total"
                                                                                            type="text"
                                                                                            class="fm-ct form-control ">
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . ajuste) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . nuevo_peso) . toFixed(2) }}
                                                                                    </td>

                                                                                    <td class="td-c"> <input
                                                                                            v-model.number="m.criterio"
                                                                                            type="text"
                                                                                            class="fm-ct form-control ">
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . nuevo_peso_2) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c"> <input
                                                                                            v-model.number="m.nuevoajuste"
                                                                                            type="text"
                                                                                            class="fm-ct form-control "></td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . oficial) . toFixed(2) }}</td>


                                                                                    <td class="td-c" style="display: none">
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
                                                                                    <td class="td-c" style="display: none">
                                                                                        <input v-model.number="m.lp"
                                                                                            type="text"
                                                                                            class="fm-ct form-control ">
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . kg_total) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c">
                                                                                        {{ Number(m . kg_criterio) . toFixed(2) }}
                                                                                    </td>
                                                                                    <td class="td-c text-warning">
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

                                        <div class="col-12 mt-2" v-if="gastosFinales.length > 0">
                                            <h5><strong>Detalle de Gastos Extras</strong></h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Detalle</th>
                                                        <th v-if="hasTransporteFinales">Boleta</th>
                                                        <th>Cant/KG/Ave</th>
                                                        <th>Costo</th>
                                                        <th v-if="hasTransporteFinales">Muertos</th>
                                                        <th v-if="hasTransporteFinales">Faltan</th>
                                                        <th v-if="hasTransporteFinales">A favor</th>
                                                        <th>Valor</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(gasto, i) in gastosFinales" :key="i">
                                                        <td>
                                                            <span class="badge"
                                                                :class="{
                                                                    'bg-primary': gasto.tipo === 'Simple',
                                                                    'bg-success': gasto.tipo === 'Transporte',
                                                                    'bg-secondary': gasto.tipo === 'Faena'
                                                                }">{{ gasto . tipo || '*' }}</span>
                                                        </td>
                                                        <td>{{ gasto . detalle || '*' }}</td>
                                                        <td v-if="hasTransporteFinales">
                                                            <span
                                                                v-if="gasto.tipo === 'Transporte'">{{ gasto . nro_boleta || '*' }}</span>
                                                            <span v-else>*</span>
                                                        </td>
                                                        <td>{{ gasto . cantidad || '*' }}</td>
                                                        <td>{{ gasto . costo ?? '*' }}</td>
                                                        <td v-if="hasTransporteFinales">
                                                            <span
                                                                v-if="gasto.tipo === 'Transporte'">{{ gasto . muertos ?? '*' }}</span>
                                                            <span v-else>*</span>
                                                        </td>
                                                        <td v-if="hasTransporteFinales">
                                                            <span
                                                                v-if="gasto.tipo === 'Transporte'">{{ gasto . faltan ?? '*' }}</span>
                                                            <span v-else>*</span>
                                                        </td>
                                                        <td v-if="hasTransporteFinales">
                                                            <span
                                                                v-if="gasto.tipo === 'Transporte'">{{ gasto . a_favor ?? '*' }}</span>
                                                            <span v-else>*</span>
                                                        </td>
                                                        <td><strong>{{ gasto . valor ?? '*' }}</strong></td>
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
                                                        <td colspan="8" v-if="hasTransporteFinales"><strong>TOTAL EN
                                                                GASTOS</strong></td>
                                                        <td colspan="4" v-else><strong>TOTAL EN GASTOS</strong></td>
                                                        <td class="text-end">
                                                            <strong>{{ valorTotalFinal . toFixed(2) }}</strong>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="col-12" v-if="totalAvesMuertas > 0">
                                                <div class="row bg-dark p-2">
                                                    <div class="col-sm-2 col-12">
                                                    </div>
                                                    <div class="col-sm-2 col-12">
                                                    </div>
                                                    <div class="col-sm-2 col-12">
                                                    </div>
                                                    <div class="col-sm-2 col-12">
                                                        <div class="form-group">
                                                            <label for="fullName" class="text-warning fw-bold">Total Aves
                                                                Muertas</label>
                                                            <input :value="totalAvesMuertas" disabled type="text"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-12">
                                                        <div class="form-group">
                                                            <label for="fullName" class="text-warning fw-bold">Costo</label>
                                                            <input v-model.number="costoPorAveMuerta" type="number"
                                                                min="0" step="0.01" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-12">
                                                        <div class="form-group">
                                                            <label for="fullName" class="text-warning fw-bold">Valor Total
                                                                Aves Muertas</label>
                                                            <input :value="valorAvesMuertas" disabled type="text"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area border-tab p-0">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="11" class="text-center bg-primary text-white">
                                                                    GASTOS EXTRAS
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th>Tipo</th>
                                                                <th>Detalle</th>
                                                                <th v-if="hasTransporteTemporales">Boleta</th>
                                                                <th>Cant/KG/Ave</th>
                                                                <th>Costo</th>
                                                                <th v-if="hasTransporteTemporales">Muertos</th>
                                                                <th v-if="hasTransporteTemporales">Faltan</th>
                                                                <th v-if="hasTransporteTemporales">A favor</th>
                                                                <th>Valor</th>
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
                                                                        <select v-model="item.tipo" class="form-control">
                                                                            <option value="Simple">Simple</option>
                                                                            <option value="Transporte">Transporte</option>
                                                                            <option value="Faena">Faena</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input v-model="item.detalle" type="text"
                                                                            class="form-control"
                                                                            :placeholder="item.tipo === 'Faena' ? 'Matadero' : (
                                                                                item.tipo === 'Transporte' ?
                                                                                'Transportista' : 'Detalle')">
                                                                    </td>
                                                                    <td v-if="item.tipo === 'Transporte'">
                                                                        <input v-model="item.nro_boleta" type="text"
                                                                            class="form-control" placeholder="Boleta">
                                                                    </td>
                                                                    <td>
                                                                        <input v-model.number="item.cantidad" type="number"
                                                                            min="1" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input v-model.number="item.costo" type="number"
                                                                            min="0" step="0.01" class="form-control">
                                                                    </td>
                                                                    <td v-if="item.tipo === 'Transporte'">
                                                                        <input v-model.number="item.muertos" type="number"
                                                                            min="0" class="form-control"
                                                                            placeholder="Muertos">
                                                                    </td>
                                                                    <td v-if="item.tipo === 'Transporte'">
                                                                        <input v-model.number="item.faltan" type="number"
                                                                            min="0" class="form-control"
                                                                            placeholder="Faltan">
                                                                    </td>
                                                                    <td v-if="item.tipo === 'Transporte'">
                                                                        <input v-model.number="item.a_favor" type="number"
                                                                            min="0" class="form-control"
                                                                            placeholder="A favor">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            :value="calculaValor(item)" disabled>
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
                            tipo: 'Simple',
                            detalle: '',
                            cantidad: 1,
                            costo: 0.00,
                            nro_boleta: '',
                            muertos: 0,
                            faltan: 0,
                            a_favor: 0
                        }],
                        gastosFinales: [],
                        valorTotalFinal: 0,
                        costoPorAveMuerta: 0,
                    }
                },
                computed: {
                    totalAvesMuertas() {
                        return this.gastosFinales.reduce((acc, gasto) => {
                            return acc + (gasto.muertos || 0);
                        }, 0);
                    },
                    valorAvesMuertas() {
                        return (this.totalAvesMuertas * this.costoPorAveMuerta).toFixed(2);
                    },
                    hasTransporteFinales() {
                        return this.gastosFinales.some(g => g.tipo === 'Transporte');
                    },
                    hasTransporteTemporales() {
                        return this.gastos.some(g => g.tipo === 'Transporte');
                    },
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

                            if (!c.sumaTotalManual) {
                                c.suma_total = Number(c.peso_bruto || 0) - Number(c.tara || 0)
                            }

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
                    calculaValor(item) {
                        const cantidad = parseFloat(item.cantidad) || 0;
                        const costo = parseFloat(item.costo) || 0;
                        const valor = cantidad * costo;
                        return valor.toFixed(2);
                    },
                    AgregarLoteManual() {
                        const lote = {
                            categoria: {
                                id: '1',
                                name: 'AVE'
                            },
                            suma_total: 0.000,
                            sumaTotalManual: false,
                            pollos: 0,
                            sugerido: 3,
                            ajuste: 0.000,
                            criterio: 0.000,
                            nuevo_peso: 0.000,
                            nuevo_peso_2: 0.000,
                            oficial: 0.000,
                            precio: 0.00,
                            precioCompra: 0.00,
                            kg_total: 0.000,
                            kg_criterio: 0.000,
                            kg_criterio_total: 0.000,
                            lp: 0.000,
                            pesoPorAve: 0.000,
                            nuevoajuste: 0.000,
                            cantidad_jaulas: 0,
                            tara: 0.000,
                            peso_bruto: 0.000,
                            nro_lote: '',
                            proveedor: '',
                            observacion: '',
                        };
                        if (!this.lote || !this.lote.detalles) {
                            this.lote = {
                                detalles: []
                            };
                        }
                        this.lote.detalles.push(lote);
                    },
                    eliminarLote(index) {
                        swal({
                            title: '¿Estás seguro?',
                            text: "¿Desea eliminar este lote?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.value) {
                                this.lote.detalles.splice(index, 1);

                            }
                        });
                    },
                    addGasto() {
                        this.gastos.push({
                            tipo: 'Simple',
                            detalle: '',
                            cantidad: 1,
                            costo: 0,
                            nro_boleta: '',
                            muertos: 0,
                            faltan: 0,
                            a_favor: 0
                        });
                        this.updateValorTotal();
                    },
                    removeGasto(i) {
                        this.gastos.splice(i, 1);
                        if (this.gastos.length === 0) {
                            this.addGasto();
                        }
                        this.updateValorTotal();
                    },


                    updateValorTotal() {
                        this.valorTotal = this.gastos.reduce((acc, gasto) => acc + (gasto.valor || 0), 0);
                    },

                    AddGastoFinal(item, i) {
                        if (!item.tipo || !item.detalle || !(item.cantidad > 0) || !(item.costo > 0)) {
                            swal({
                                title: 'Error',
                                text: 'Complete los campos obligatorios (detalle, cantidad, costo).',
                                type: 'error'
                            });
                            return;
                        }

                        if (item.tipo === 'Transporte') {
                            if (!item.nro_boleta || item.muertos === null || item.faltan === null || item.a_favor ===
                                null) {
                                swal({
                                    title: 'Error',
                                    text: 'Complete todos los campos requeridos para Transporte (boleta, muertos, faltan, a favor).',
                                    type: 'error'
                                });
                                return;
                            }

                            if (
                                isNaN(item.muertos) || isNaN(item.faltan) || isNaN(item.a_favor) ||
                                item.muertos < 0 || item.faltan < 0 || item.a_favor < 0
                            ) {
                                swal({
                                    title: 'Error',
                                    text: 'Muertos, faltan y a favor deben ser números mayores o iguales a 0.',
                                    type: 'error'
                                });
                                return;
                            }
                        }
                        let nuevoGasto = {
                            tipo: item.tipo,
                            detalle: item.detalle,
                            cantidad: item.cantidad,
                            costo: item.costo,
                            nro_boleta: item.nro_boleta || '',
                            muertos: item.muertos || 0,
                            faltan: item.faltan || 0,
                            a_favor: item.a_favor || 0,
                            valor: parseFloat(this.calculaValor(item))
                        };

                        this.gastos.splice(i, 1, {
                            tipo: 'Simple',
                            detalle: '',
                            cantidad: 1,
                            costo: 0,
                            nro_boleta: '',
                            muertos: 0,
                            faltan: 0,
                            a_favor: 0
                        });
                        this.gastosFinales.push(nuevoGasto);


                        this.updateValorTotalFinal();
                        this.gastosFinales = this.gastosFinales.filter(g => g && typeof g === 'object' && g.tipo !==
                            undefined);
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


                    async Save() {
                        block.block();
                        try {
                            if (!this.lote || !this.lote.detalles || this.lote.detalles.length === 0) {
                                swal({
                                    title: 'Error',
                                    text: 'Debe agregar al menos un lote para consolidar.',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                });
                                block.unblock();
                                return;
                            }
                            for (let m of this.lote.detalles) {
                                if (!m.proveedor || m.proveedor.trim() === "") {
                                    swal({
                                        title: 'Error',
                                        text: 'El campo Proveedor es obligatorio en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (isNaN(m.cantidad_jaulas) || m.cantidad_jaulas <= 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'La cantidad de jaulas debe ser mayor a 0 en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (isNaN(m.precio) || m.precio <= 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'El valor de precio KG debe ser mayor a 0 en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (isNaN(m.pollos) || m.pollos <= 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'El nro de aves debe ser mayor a 0 en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (isNaN(m.peso_bruto) || m.peso_bruto <= 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'El peso bruto debe ser mayor a 0 en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (isNaN(m.tara) || m.tara < 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'La tara debe ser un valor mayor o igual a 0 en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (Number(m.tara) >= Number(m.peso_bruto)) {
                                    swal({
                                        title: 'Error',
                                        text: 'La tara debe ser menor que el peso bruto en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                                if (!m.nro_lote || m.nro_lote.trim() === '') {
                                    swal({
                                        title: 'Error',
                                        text: 'El campo NRO LOTE es obligatorio en todos los lotes.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                            }
                            if (this.totalAvesMuertas > 0) {
                                if (isNaN(this.costoPorAveMuerta) || this.costoPorAveMuerta === '' || this
                                    .costoPorAveMuerta === 0 || isNaN(this.valorAvesMuertas) || this
                                    .valorAvesMuertas === '' || this.valorAvesMuertas === 0) {
                                    swal({
                                        title: 'Error',
                                        text: 'El costo por ave muerta y el valor total de aves muertas no pueden estar vacíos, ser NaN o 0 cuando la cantidad de aves muertas es mayor a 0.',
                                        type: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    block.unblock();
                                    return;
                                }
                            }
                            this.model.valor_aves_muertas = this.valorAvesMuertas;
                            this.model.valor_por_ave_muerta = this.costoPorAveMuerta;
                            this.model.consolidacionparam_id = this.paramConsolidacion.id
                            this.model.valor_total = this.SumValor
                            this.model.peso_total = this.SumPeso
                            this.model.categoria_list = this.categoriaList
                            this.model.pago = this.pago
                            this.model.user_id = this.user.id
                            this.model.gastos_finales = this.gastosFinales

                            let res = await axios.put(
                                "{{ url('api/consolidacions_aves_new') }}/{{ $id }}",
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
                                        window.open(consolidacion.url_pdf2, '_blank');
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
                                    "consolidacions_aves_new/{{ $id }}")
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
                                self.costoPorAveMuerta = self.lote.valor_por_ave_muerta || 0;
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
