@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group ">
                                                <h6 class="">Agregue los lotes que desea consolidar para despues pasar a Pagar
                                                </h6>
                                                <div class="input-group mb-4">
                                                    <select style="display: none" v-model="model.compra_id" class="form-control">
                                                        <template v-for="(m,i) in compras.reverse()">
                                                            <option v-if="m.consolidacion_detalles.length==0 && m.estado==1"
                                                                :value="m.id">
                                                                {{ m . fecha }} - N°: {{ m . proveedor_compra . abreviatura }}
                                                                {{ m . nro_compra }} - N° Lote: {{ m . nro }} -
                                                                {{ m . proveedor_compra . nombre }}
                                                            </option>
                                                        </template>
                                                    </select>
                                                    <button style="display: none" class="btn btn-success " @click="getLote()"
                                                        type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-send">
                                                            <line x1="22" y1="2" x2="11" y2="13">
                                                            </line>
                                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                        </svg>
                                                    </button>
                                                    <br>
                                                    <button class="btn btn-success w-100 mt" @click="AgregarLoteManual()"
                                                        type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-shopping-cart">
                                                            <circle cx="9" cy="21" r="1"></circle>
                                                            <circle cx="20" cy="21" r="1"></circle>
                                                            <path
                                                                d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                                            </path>
                                                        </svg><span> AGREGAR LOTE</span>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label>Ajuste</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="paramConsolidacion" class="form-control">
                                                        <option v-for="(m,i) in consolidacionParams.reverse()"
                                                            :value="m">
                                                            {{ m . name }} % {{ Number(m . monto) . toFixed(2) }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <div v-if="lotes.length === 0"
                                                class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                                <strong>Sin Lote!</strong> Agregue un lote para comenzar con la consolidacion.
                                            </div>
                                            <div class="col-12">
                                            </div>
                                            <div v-else class="row">
                                                <div v-for="(l,i) in categoriaList"
                                                    class="col-xxl-10 col-xl-12 col-lg-10 col-md-10 col-sm-10 mx-auto">
                                                    <div class="card" v-for="m in l.categoria_proveedor_list">
                                                        <div class="card-body">
                                                            <h6><strong> Compra de Aves, Lote N°: </strong> {{ m . nro_lote }}
                                                                <strong>- Fecha:</strong>
                                                                {{ l . fecha }} -
                                                                <strong>Proveedor:</strong> {{ m . proveedor }}
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
                                                                </svg>
                                                            </button>


                                                            <div class="row">
                                                                <div class="col-12 col-md-1 col-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Sugerido</label>
                                                                        <input type="text" class="form-control"
                                                                            v-model.number="m.sugerido">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Proveedor</label>
                                                                        <input v-model="m.proveedor" type="text"
                                                                            class="form-control" required
                                                                            placeholder="Proveedor" />
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

                                                                <div class="col-12 table-responsive">
                                                                    <table
                                                                        class="table table-sm table-bordered text-center align-middle">
                                                                        <thead class="bg-light">
                                                                            <tr>
                                                                                <th>Peso BRUTO</th>
                                                                                <th>Tara</th>
                                                                                <th>C. Aves</th>
                                                                                <th>C. Jaulas</th>
                                                                                <th>Peso NETO</th>
                                                                                <th class="text-success">Ajuste %</th>
                                                                                <th>Sugerido</th>
                                                                                <th>
                                                                                    <span class="text-danger">Para sumar
                                                                                        agregar (-) </span>
                                                                                    Criterio (-)
                                                                                </th>
                                                                                <th>Nvo Peso</th>
                                                                                <th class="text-success">Nvo Ajuste</th>
                                                                                <th class="text-success">P. Oficial</th>
                                                                                <th style="display: none" class="text-success">T
                                                                                    Aves</th>
                                                                                <th class="text-success">P/Ave</th>
                                                                                <th>Precio KG</th>
                                                                                <th>V. Total</th>
                                                                                <th class="text-success" style="display: none">
                                                                                    CBBA</th>
                                                                                <th class="text-success" style="display: none">
                                                                                    LP</th>
                                                                                <th class="text-success">Kg T</th>
                                                                                <th class="text-success">Kg C</th>
                                                                                <th class="text-warning">Kg C Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.peso_bruto"
                                                                                        @input="m.sumaTotalManual = false"
                                                                                        type="text"
                                                                                        class="fm-ct form-control" />
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.tara"
                                                                                        @input="m.sumaTotalManual = false"
                                                                                        type="text"
                                                                                        class="fm-ct form-control" />
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.sumaPollos"
                                                                                        type="text"
                                                                                        class="fm-ct form-control" />
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.cantidad_jaulas"
                                                                                        type="text"
                                                                                        class="fm-ct form-control" />
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.sumaTotal"
                                                                                        @input="m.sumaTotalManual = true"
                                                                                        type="text" class="fm-ct form-control">
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    {{ Number(m . ajuste) . toFixed(2) }}
                                                                                </td>
                                                                                <td class="td-c text-primary "><span
                                                                                        class="fw-700">{{ Number(m . ajuste * (m . sugerido / 100)) . toFixed(2) }}</span>
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.criterio"
                                                                                        type="text"
                                                                                        class="fm-ct form-control ">
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    {{ Number(m . nuevo_peso_2) . toFixed(2) }}
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.nuevoajuste"
                                                                                        type="text"
                                                                                        class="fm-ct form-control ">
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    {{ Number(m . oficial) . toFixed(2) }}
                                                                                </td>
                                                                                <td style="display: none" class="td-c">
                                                                                    {{ Number(m . sumaPollos) . toFixed(2) }}
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    <input v-model.number="m.pesoPorAve"
                                                                                        type="text"
                                                                                        class="fm-ct form-control" />
                                                                                </td>
                                                                                <td class="td-c"> <input
                                                                                        v-model.number="m.precio" type="text"
                                                                                        class="fm-ct form-control "></td>
                                                                                <td class="td-c" style="display: none">
                                                                                    {{ Number(m . ajuste) . toFixed(2) }}
                                                                                </td>
                                                                                <td class="td-c">
                                                                                    {{ Number(m . precioCompra) . toFixed(2) }}
                                                                                </td>
                                                                                <td class="td-c" style="display: none">
                                                                                    <input v-model.number="m.lp" type="text"
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
                                                    <div class="row">
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName">Peso Total</label>
                                                                <input :value="Number(l.suma_peso).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName">Valor Total</label>
                                                                <input :value="Number(l.suma_valor).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Aves
                                                                    Total</label>
                                                                <input :value="Number(l.suma_pollos).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12" style="display: none">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">CBBA
                                                                    Total</label>
                                                                <input :value="Number(l.suma_cbba).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12" style="display: none">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Lp
                                                                    Total</label>
                                                                <input :value="Number(l.suma_lp).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Kg
                                                                    Total</label>
                                                                <input :value="Number(l.suma_kg_total).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold"> Kg
                                                                    Criterio</label>
                                                                <input :value="Number(l.suma_kg_criterio).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold"> Kg Criterio
                                                                    Total</label>
                                                                <input :value="Number(l.suma_kg_criterio_total).toFixed(2)" disabled
                                                                    type="text" class="form-control mb-4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-2" v-if="gastosFinales.length > 0">
                                                    <h5>Detalle de Gastos Extras</h5>
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
                                                                    <span class="badge text-uppercase"
                                                                        :class="{
                                                                            'bg-primary': gasto.tipo === 'Simple',
                                                                            'bg-success': gasto.tipo === 'Transporte',
                                                                            'bg-secondary': gasto.tipo === 'Faena',
                                                                            'bg-dark': !gasto.tipo
                                                                        }">
                                                                        {{ gasto . tipo ? gasto . tipo : '*' }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ gasto . detalle || '*' }}</td>
                                                                <td v-if="hasTransporteFinales">
                                                                    <span
                                                                        v-if="gasto.tipo === 'Transporte'">{{ gasto . nro_boleta || '*' }}</span>
                                                                    <span v-else>*</span>
                                                                </td>

                                                                <td>{{ gasto . cantidad ?? '*' }}</td>
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
                                                                    <label for="fullName"
                                                                        class="text-warning fw-bold">Costo</label>
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

                                                <div class="col-12 mt-2" v-if="lotes.length !== 0">
                                                    <div class="statbox widget box box-shadow">
                                                        <div class="widget-content widget-content-area border-tab p-0">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="11"
                                                                            class="text-center bg-primary text-white">
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
                                                                                <select v-model="item.tipo" class="form-control">
                                                                                    <option value="Simple">Simple</option>
                                                                                    <option value="Transporte">Transporte</option>
                                                                                    <option value="Faena">Faena</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input v-model="item.detalle" type="text"
                                                                                    class="form-control"
                                                                                    :placeholder="item.tipo === 'Faena' ?
                                                                                        'Matadero' : (item
                                                                                            .tipo === 'Transporte' ?
                                                                                            'Transportista' : 'Detalle')">
                                                                            </td>
                                                                            <td v-if="item.tipo === 'Transporte'">
                                                                                <input v-model="item.nro_boleta" type="text"
                                                                                    class="form-control" placeholder="Boleta">
                                                                            </td>
                                                                            <td>
                                                                                <input v-model.number="item.cantidad"
                                                                                    type="number" min="1"
                                                                                    class="form-control" placeholder="Cantidad">
                                                                            </td>
                                                                            <td>
                                                                                <input v-model.number="item.costo" type="number"
                                                                                    min="0" step="0.01"
                                                                                    class="form-control" placeholder="Costo">
                                                                            </td>
                                                                            <td v-if="item.tipo === 'Transporte'">
                                                                                <input v-model.number="item.muertos"
                                                                                    type="number" min="0"
                                                                                    class="form-control" placeholder="Muertos">
                                                                            </td>
                                                                            <td v-if="item.tipo === 'Transporte'">
                                                                                <input v-model.number="item.faltan" type="number"
                                                                                    min="0" class="form-control"
                                                                                    placeholder="Faltan">
                                                                            </td>
                                                                            <td v-if="item.tipo === 'Transporte'">
                                                                                <input v-model.number="item.a_favor"
                                                                                    type="number" min="0"
                                                                                    class="form-control" placeholder="A favor">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control"
                                                                                    :value="calculaValor(item)" disabled>
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
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Peso
                                                                    Total</label>
                                                                <input :value="Number(SumPeso).toFixed(2)" disabled type="text"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Valor
                                                                    Total</label>
                                                                <input :value="Number(SumValor).toFixed(2)" disabled
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Total de
                                                                    Aves</label>
                                                                <input :value="Number(SumTotalPollos).toFixed(2)" disabled
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1 col-12" style="display: none">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">CBBA
                                                                    Total</label>
                                                                <input :value="Number(sumaCbba).toFixed(2)" disabled
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 col-12" style="display: none">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Lp
                                                                    Total</label>
                                                                <input :value="Number(sumaLp).toFixed(2)" disabled type="text"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold">Kg
                                                                    Total</label>
                                                                <input :value="Number(SumKgTotal).toFixed(2)" disabled
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold"> Kg
                                                                    Criterio</label>
                                                                <input :value="Number(SumKgCriterio).toFixed(2)" disabled
                                                                    type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-12">
                                                            <div class="form-group">
                                                                <label for="fullName" class="text-success fw-bold"> Kg Criterio
                                                                    Total</label>
                                                                <input :value="Number(SumKgCriterioTotal).toFixed(2)" disabled
                                                                    type="text" class="form-control">
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
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"


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
                        if (!this.lotes || this.lotes.length === 0) {
                            return [];
                        }

                        return this.lotes.map((lote) => {
                            lote.categoria_proveedor_list.forEach((item) => {
                                // Asegurándonos de que las propiedades sean numéricas y sin comas.
                                let sumaTotal = item.sumaTotal.toString();
                                let sumaPollos = item.sumaPollos.toString();

                                // Limpieza de comas
                                if (sumaTotal.indexOf(',') > -1) {
                                    sumaTotal = sumaTotal.replace(/,/g, "");
                                }
                                if (sumaPollos.indexOf(',') > -1) {
                                    sumaPollos = sumaPollos.replace(/,/g, "");
                                }

                                item.sumaPollos = sumaPollos;

                                if (!item.sumaTotalManual) {
                                    item.sumaTotal = Number(item.peso_bruto || 0) - Number(item.tara ||
                                        0);
                                }

                                item.sugerido = isNaN(item.sugerido) ? 3 : Number(item.sugerido);
                                let porcentaje = Number(this.paramConsolidacion.monto) / 100;
                                item.ajuste = Number(item.sumaTotal * porcentaje);
                                item.nuevo_peso = item.sumaTotal - item.ajuste;
                                item.nuevo_peso_2 = item.nuevo_peso - item.criterio;
                                item.oficial = item.nuevo_peso_2 - item.nuevoajuste;

                                // Calculando el valor total usando sumaPollos
                                let totalPollos = Number(item.sumaPollos) || 0;
                                if (totalPollos > 0 && !isNaN(item.precio)) {
                                    item.precioCompra = (Number(item.precio) * Number(item.sumaTotal))
                                        .toFixed(2);
                                    item.pesoPorAve = (Number(item.sumaTotal) / totalPollos).toFixed(3);
                                } else {
                                    item.precioCompra = "0";
                                    item.pesoPorAve = "0";
                                }

                                item.kg_total = item.ajuste - (isNaN(item.lp) ? 0 : Number(item.lp));
                                item.kg_criterio = item.criterio;
                                item.kg_criterio_total = item.kg_criterio + item.kg_total;
                            });

                            // Sumar los valores de las categorías
                            lote.suma_peso = lote.categoria_proveedor_list.reduce((acc, item) => acc + Number(
                                item.oficial), 0);
                            lote.suma_valor = lote.categoria_proveedor_list.reduce((acc, item) => acc + Number(
                                item.precioCompra), 0);
                            lote.suma_pollos = lote.categoria_proveedor_list.reduce((acc, item) => acc + Number(
                                item.sumaPollos), 0);
                            lote.suma_cbba = lote.categoria_proveedor_list.reduce((acc, item) => acc + Number(
                                item.ajuste), 0);
                            lote.suma_lp = lote.categoria_proveedor_list.reduce((acc, item) => acc + Number(
                                isNaN(item.lp) ? 0 : Number(item.lp)), 0);
                            lote.suma_kg_total = lote.categoria_proveedor_list.reduce((acc, item) => acc +
                                Number(item.kg_total), 0);
                            lote.suma_kg_criterio = lote.categoria_proveedor_list.reduce((acc, item) => acc +
                                Number(item.kg_criterio), 0);
                            lote.suma_kg_criterio_total = lote.categoria_proveedor_list.reduce((acc, item) =>
                                acc + Number(item.kg_criterio_total), 0);

                            return lote;
                        });
                    },


                    // Sumatorias y validaciones
                    SumPeso() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_peso), 0);
                    },

                    SumValor() {
                        let consolidationSum = this.categoriaList.reduce((acc, lote) => {
                            console.log('Valor de lote:', lote.suma_valor);
                            return acc + (lote.suma_valor || 0);
                        }, 0);

                        let gastosSum = this.gastosFinales.reduce((acc, gasto) => {
                            console.log('Valor de gasto:', gasto.valor);
                            return acc + (gasto.valor || 0);
                        }, 0);

                        return (consolidationSum + gastosSum).toFixed(2);
                    },

                    SumTotalPollos() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_pollos), 0);
                    },
                    sumaCbba() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_cbba), 0)
                    },
                    sumaLp() {
                        return this.categoriaList.reduce((a, b) => a + Number(isNaN(b.suma_lp) ? 0 : Number(b.suma_lp)),
                            0)
                    },
                    SumKgTotal() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_total), 0)
                    },
                    SumKgCriterio() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_criterio), 0)
                    },
                    SumKgCriterioTotal() {
                        return this.categoriaList.reduce((a, b) => a + Number(b.suma_kg_criterio_total), 0)
                    },
                    valorTotalFinal() {
                        return this.SumValor + this.valorTotal;
                    },
                },


                methods: {
                    calculaValor(item) {
                        const cantidad = parseFloat(item.cantidad) || 0;
                        const costo = parseFloat(item.costo) || 0;
                        const valor = cantidad * costo;
                        return valor.toFixed(2);
                    },

                    getFechaActual() {
                        const hoy = new Date();
                        const dd = String(hoy.getDate()).padStart(2, '0');
                        const mm = String(hoy.getMonth() + 1).padStart(2, '0'); // Enero es 0
                        const yyyy = hoy.getFullYear();
                        return `${dd}/${mm}/${yyyy}`;
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
                                this.lotes.splice(index, 1);
                            }
                        });
                    },

                    AgregarLoteManual() {
                        const lote = {
                            categoria_proveedor_list: [{
                                categoria: {
                                    id: '1',
                                    name: 'AVE'
                                },
                                sumaTotal: 0.000,
                                sumaPollos: 0,
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
                            }],
                            proveedor_compra: {
                                abreviatura: 'C',
                                nombre: 'CENT'
                            },
                            nro_compra: '0',
                            nro: '0',
                            fecha: this.getFechaActual(),
                        };


                        this.lotes = [...this.lotes, lote];
                        this.categoriaList = [...this.categoriaList, lote];
                    },


                    async Save() {
                        block.block();
                        try {
                            if (!this.lotes || this.lotes.length === 0 || !this.categoriaList || this.categoriaList
                                .length === 0) {
                                swal({
                                    title: 'Error',
                                    text: 'Debe agregar al menos un lote para consolidar.',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                });
                                block.unblock();
                                return;
                            }
                            for (let l of this.categoriaList) {
                                for (let m of l.categoria_proveedor_list) {
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
                                    if (isNaN(m.sumaPollos) || m.sumaPollos <= 0) {
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
                                    if (m.lp === undefined || m.lp < 0) {
                                        swal({
                                            title: 'Error',
                                            text: 'El campo LP debe tener un valor igual o mayor a 0 en todos los lotes.',
                                            type: 'error',
                                            confirmButtonText: 'OK'
                                        });
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
                            this.model.gastos = this.gastosFinales;
                            this.model.consolidacionparam_id = this.paramConsolidacion.id;
                            this.model.valor_total = this.SumValor;
                            this.model.peso_total = this.SumPeso;
                            this.model.categoria_list = this.categoriaList;
                            this.model.pago = this.pago;

                            // swal({
                            //     title: "Payload final que va al backend",
                            //     html: "<pre style='text-align:left;white-space:pre-wrap;'>" + JSON
                            //         .stringify(this.model, null, 2) + "</pre>",
                            //     customClass: 'swal-wide'
                            // });
                            //return;

                            let res = await axios.post("{{ url('api/consolidacions_aves_new') }}", this.model)
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
                            await Promise.all([self.GET_DATA('compras-aves'), self.GET_DATA(
                                    'consolidacionparams'), self.GET_DATA('productos'), self
                                .GET_DATA('almacens'), self.GET_DATA('bancos')
                            ]).then((v) => {
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
