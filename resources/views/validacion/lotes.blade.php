@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12 col-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-content widget-content-area border-tab p-0">
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <thead>
                                                    <th>Nro Compra</th>
                                                    <th>Lote</th>
                                                    <template v-for="m in lista_cintas">
                                                        <th>{{ m }}</th>
                                                    </template>
                                                    <th>TOTAL</th>
                                                    <th class="action-column">ACCION</th>
                                                </thead>
                                                <tbody>
                                                    <template v-for="m in model_cintas">
                                                        <tr>
                                                            <td>{{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro_compra }}
                                                            </td>
                                                            <td>{{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro }}</td>
                                                            <template v-for="c in m.cinta_cajas">
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mx-2">
                                                                            {{ Number(c . lote_detalle . cajas - c . envios) }}
                                                                             ({{ Number(c . lote_detalle . promedio) . toFixed(2) }})
                                                                        </div>
                                                                        <button v-if="c.lote_detalle.cajas>0" class="btn  p-1"
                                                                            :class="c.envios > c.lote_detalle.cajas ?
                                                                                'btn-danger' : 'btn-success'"
                                                                            @click="AddDetalle(c.lote_detalle,m.compra,c)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-plus">
                                                                                <line x1="12" y1="5" x2="12"
                                                                                    y2="19"></line>
                                                                                <line x1="5" y1="12" x2="19"
                                                                                    y2="12"></line>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </template>
                                                            <td>{{ m . total_cajas }}</td>
                                                            <td>
                                                                <button class="btn btn-sm w-100 mt-2" :class="'btn-' + bandera(m)"
                                                                    @click="FinalizarLote(m.id)">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                        <line x1="4" y1="4" x2="12" y2="12"></line>
                                                                        <line x1="12" y1="4" x2="4" y2="12"></line>
                                                                    </svg>
                                                                    CERRAR LOTE
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    <tr class="bg-primary">
                                                        <th colspan="2" class="text-white">
                                                            TOTALES
                                                        </th>
                                                        <template v-for="c in totales_cintas">
                                                            <th class="text-white">
                                                                {{ c . total_cajas }}
                                                            </th>
                                                        </template>
                                                        <th class="text-white"  colspan="2">
                                                            {{ total_cinta }}
                                                        </th>

                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area border-tab p-0">

                                <div class="table-responsive w-100">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>#</th>
                                            <th>Nro Compra</th>
                                            <th>Lote</th>

                                            <th>Cajas</th>
                                            <th>Pollos</th>
                                            <th>Peso Bruto</th>
                                            <th>Peso Neto</th>

                                            <th>P. Neto U.</th>

                                            <th>Cinta</th>
                                            <th>Pigmento</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <template v-for="(l,i) in detalle_envios_computed">
                                                <tr :class="l.cajas > l.cajas_stock ? 'bg-light-danger' : ''">
                                                    <td>{{ l . index + 1 }}</td>
                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro_compra }}</td>
                                                    <td>{{ l . compra . proveedor_compra . abreviatura }}-{{ l . compra . nro }}</td>

                                                    <td>
                                                        <input type="text" name="" id="" v-model="l.cajas"
                                                            @keyup="changeCajas(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" id="" v-model="l.equivalente"
                                                            @keyup="changeLote(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" id=""
                                                            v-model="l.peso_mod_bruto" @keyup="changeLoteM(l)" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input disabled type="text" name="" id=""
                                                            v-model="l.peso_mod_neto" @keyup="changeLoteM(l)" class="form-control">
                                                    </td>


                                                    <td>{{ l . peso_unitario_neto }}</td>

                                                    <td>{{ l . producto }}</td>
                                                    <td>{{ l . pigmento == 1 ? 'CON PIGMENTO' : 'SIN PIGMENTO' }}</td>
                                                    <td>
                                                        <button class="btn btn-danger p-1" @click="detalle_envio.splice(l.index,1)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10" y2="17">
                                                                </line>
                                                                <line x1="14" y1="11" x2="14" y2="17">
                                                                </line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>

                                            <tr class="sub_t">
                                                <td colspan="3">SUB TOTALES</td>
                                                <td>
                                                    {{ Number(total_detalles . cajas) }}
                                                </td>

                                                <td>
                                                    {{ Number(total_detalles . pollos) }}
                                                </td>
                                                <td>
                                                    {{ Number(total_detalles . peso_bruto) . toFixed(3) }}
                                                </td>
                                                <td>
                                                    {{ Number(total_detalles . peso_neto) . toFixed(3) }}
                                                </td>
                                                <td>
                                                    {{ Number(total_detalles . peso_unitario_neto) . toFixed(3) }}
                                                </td>
                                                <td></td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center my-4">
                        <div class="btn-group">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                @click="detalle_lote={...m}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg> ENVIAR A PP</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal2"
                                @click="detalle_lote={...m}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg> ENVIAR A PT</button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCrud">PP Destino</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-row mb-4">

                                            <div class="form-group col-md-12">

                                                <select name="" class="form-control" id="" v-model="pp_envio">
                                                    <option v-for="item in pps" :value="item">PP {{ item . nro }}
                                                    </option>
                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                            Cancelar</button>
                                        <button v-if="detalle_envio.length" @click="EnviarPP()" type="button"
                                            data-dismiss="modal" class="btn btn-success">Enviar a PP</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCrud">PT Destino</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">

                                                <select name="" class="form-control" id="" v-model="pt_envio">
                                                    <option v-for="item in pts" :value="item">PT {{ item . nro }}
                                                    </option>
                                                </select>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                            Cancelar</button>
                                        <button v-if="detalle_envio.length" @click="EnviarPT()" type="button"
                                            data-dismiss="modal" class="btn btn-success">Enviar a PT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area border-tab p-0">
                                <h3 class="p-3">Cajas enviadas a PP </h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>PP</th>
                                        <th>Nro Compra</th>
                                        <th>Lote</th>
                                        <th>Cajas</th>
                                        <th>Pollos</th>
                                        <th>Peso Bruto</th>
                                        <th>Peso Neto</th>

                                        <th>P. Neto U.</th>

                                        <th>Cinta</th>
                                        <th>Pigmento</th>
                                        <th>ACCION</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(l,i) in detalle_enviados_pp">
                                            <td>{{ l . index }}</td>
                                            <td>PP {{ l . pp . nro }}</td>

                                            <td>{{ l . lote_detalle . compra . proveedor_compra . abreviatura }}-{{ l . lote_detalle . compra . nro_compra }}
                                            </td>
                                            <td>{{ l . lote_detalle . compra . proveedor_compra . abreviatura }}-{{ l . lote_detalle . compra . nro }}
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.cajas"
                                                    @keyup="cajasChangeEnviado(l)" class="form-control"  readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.equivalente"
                                                    @keyup="changeLoteEnviado(l)" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.peso_mod_bruto"
                                                    @keyup="changeLoteEnviadoM(l)" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.peso_mod_neto"
                                                    @keyup="changeLoteEnviadoM(l)" class="form-control" readonly>
                                            </td>


                                            <td>
                                                {{ Number.isFinite(Number(l.peso_mod_neto) / Number(l.equivalente))
                                                    ? (Number(l.peso_mod_neto) / Number(l.equivalente)).toFixed(3)
                                                    : '0.000'
                                                }}
                                            </td>

                                            <td>{{ l . lote_detalle . name }}</td>
                                            <td>{{ l . lote_detalle . pigmento == 1 ? 'CON PIGMENTO' : 'SIN PIGMENTO' }}</td>
                                            <td>
                                                <button @click="deleteLoteEnviadoPp(l)" class="btn btn-danger p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14" y2="17">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-primary">
                                            <th class="text-white" colspan="4">
                                                TOTALES
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pp . cajas }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pp . pollos }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pp . bruto }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pp . neto }}
                                            </th>
                                            <th class="text-white" colspan="4">
                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="row">
                                    <div class="col-12 m-2 text-center">
                                        <button @click="ActualizarPp()" type="button" class="btn btn-success" style="display: none">
                                            <i class="fas fa-sync-alt"></i> Actualizar PP
                                        </button>

                                        <button @click="RetornarPp()" type="button" class="btn btn-danger" style="display: none">
                                            <i class="fas fa-undo"></i> Retornar Todo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area border-tab p-0">
                                <h3 class="p-3">Cajas enviadas a PT</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>PT</th>
                                        <th>Nro Compra</th>
                                        <th>Lote</th>
                                        <th>Cajas</th>
                                        <th>Pollos</th>
                                        <th>Peso Bruto</th>
                                        <th>Peso Neto</th>

                                        <th>P. Neto U.</th>

                                        <th>Cinta</th>
                                        <th>Pigmento</th>
                                        <th>Accion</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(l,i) in detalle_enviados_pt">
                                            <td>{{ l . index }}</td>
                                            <td>PT {{ l . pt . nro }}</td>
                                            <td>{{ l . lote_detalle . compra . proveedor_compra . abreviatura }}-{{ l . lote_detalle . compra . nro_compra }}
                                            </td>
                                            <td>{{ l . lote_detalle . compra . proveedor_compra . abreviatura }}-{{ l . lote_detalle . compra . nro }}
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.cajas"
                                                    @keyup="cajasChangeEnviado(l)" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.equivalente"
                                                    @keyup="changeLoteEnviado(l)" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.peso_mod_bruto"
                                                    @keyup="changeLoteEnviadoM(l)" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="" id="" v-model="l.peso_mod_neto"
                                                    @keyup="changeLoteEnviadoM(l)" class="form-control" readonly>
                                            </td>


                                            <td>{{ l . peso_unitario_neto }}</td>

                                            <td>{{ l . lote_detalle . name }}</td>
                                            <td>{{ l . lote_detalle . pigmento == 1 ? 'CON PIGMENTO' : 'SIN PIGMENTO' }}</td>
                                            <td>
                                                <button @click="deleteLoteEnviadoPt(l)" class="btn btn-danger p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14" y2="17">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-primary">
                                            <th class="text-white" colspan="4">
                                                TOTALES
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pt . cajas }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pt . pollos }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pt . bruto }}
                                            </th>
                                            <th class="text-white">
                                                {{ detalle_totales_pt . neto }}
                                            </th>
                                            <th class="text-white" colspan="4">
                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-12 m-2 text-center">
                                        <button @click="ActualizarPt()" type="button" class="btn btn-success" style="display: none">
                                            <i class="fas fa-sync-alt"></i> Actualizar PT
                                        </button>

                                        <button @click="RetornarPt()" type="button" class="btn btn-danger" style="display: none">
                                            <i class="fas fa-undo"></i> Retornar Todo
                                        </button>
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
            import TableDate from "{{ asset('config/dtdate.js') }}"
            import Block from "{{ asset('config/block.js') }}"


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
                            compra: {

                            },
                            name: '',
                            lote_detalles: []
                        },
                        lotes: [],
                        detalle_lote: {
                            equivalente: 0,
                            pollos: 0,
                            pp_detalles: []
                        },
                        envio: {
                            cajas: 0,
                            pollos: 0,
                            bruto: 0,
                            neto: 0,
                            merma_bruta: 0,
                            merma_neta: 0,
                        },
                        compo_internas: [],
                        compo_externas: [],
                        sucursal: {
                            id: 0,
                            name: ''
                        },
                        pp: {},
                        pp_envio: {},
                        pt_envio: {},
                        pt: {},
                        detalle_envio: [],
                        banderas: [],
                        user: {},
                        pp_detalle: [],
                        pt_detalle: [],
                        pps: []
                    }
                },
                computed: {
                    url() {
                        return "{{ url('') }}"
                    },
                    model_detalles() {
                        return this.lotes.map((l) => {

                            l.cajas_disponibles = l.lote_detalles.reduce((a, b) => a + (b.cajas > 0 ? b.cajas :
                                0), 0)
                            l.pollos_disponibles = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? b
                                .equivalente : 0), 0)
                            l.peso_neto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (
                                b.peso_total - b.cajas * 2) : 0), 0)
                            l.peso_bruto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ?
                                (b.peso_total) : 0), 0)

                            return l

                        })
                    },
                    total_detalles() {
                        let cajas = this.detalle_envio.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.detalle_envio.reduce((a, b) => a + Number(b.equivalente), 0)
                        let peso_bruto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
                        let peso_neto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
                        let merma_bruta = this.detalle_envio.reduce((a, b) => a + Number(b.merma_bruta), 0)
                        let merma_neta = this.detalle_envio.reduce((a, b) => a + Number(b.merma_neta), 0)
                        let peso_unitario_bruto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_unitario_bruto),
                            0)
                        let peso_unitario_neto = this.detalle_envio.reduce((a, b) => a + Number(b.peso_unitario_neto),
                            0)

                        return {
                            cajas: cajas,
                            pollos: pollos,
                            peso_bruto: peso_bruto,
                            peso_neto: peso_neto,
                            merma_bruta: merma_bruta,
                            merma_neta: merma_neta,
                            peso_unitario_bruto: peso_unitario_bruto,
                            peso_unitario_neto: peso_unitario_neto,
                        }
                    },
                    lista_cintas1() {

                        let cintas_detalles = [];
                        this.model_detalles.forEach(compra => {
                            compra.lote_detalles.forEach(detalle => {
                                let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP'
                                let buscar_cinta = cintas_detalles.filter((e) => {
                                    return e.name == detalle.producto + '/' + pigmento
                                })
                                if (buscar_cinta.length == 0) {
                                    cintas_detalles.push({
                                        id: detalle.compra_inventario.sub_original_id,
                                        name: detalle.producto + '/' + pigmento
                                    });
                                }
                            });
                        });
                        return cintas_detalles
                    },
                    lista_cintas() {

                        let lista = this.lista_cintas1.sort(function(a, b) {
                            return a.id - b.id;
                        });
                        return lista.map((e) => e.name)
                    },

                    model_cintas() {
                        let self = this;
                        let model = this.model_detalles.map((compra) => {
                            compra.cintas = [...this.lista_cintas];

                            let cintas_cajas = compra.cintas.map((cinta) => {
                                let lote_detalles = compra.lote_detalles.filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP';
                                    return detalle.producto + '/' + pigmento == cinta;
                                });

                                let cajas_envio = [...self.detalle_envio].filter((detalle) => {
                                    let pigmento = detalle.pigmento == 1 ? 'CP' : 'SP';
                                    return detalle.producto + '/' + pigmento == cinta && detalle.compra_id == compra.id;
                                });

                                let envios = cajas_envio.reduce((a, b) => a + Number(b.cajas), 0);

                                // Ordenar lote_detalles por peso total (de mayor a menor)
                                lote_detalles = lote_detalles.sort((a, b) => b.peso_total - a.peso_total);

                                if (lote_detalles.length > 0) {
                                    let lote_detalle = { ...lote_detalles[0] };

                                    // Calcular cajas y otros totales
                                    lote_detalle.cajas = lote_detalles.reduce((a, b) => a + b.cajas, 0);
                                    let cajas_tara = lote_detalle.cajas * 2;

                                    lote_detalle.total_pollos = lote_detalles.reduce((a, b) => a + b.equivalente, 0);
                                    lote_detalle.total_peso = lote_detalles.reduce((a, b) => a + b.peso_total, 0) - cajas_tara;

                                    // Calcular el promedio, asegurando que no haya divisiones por 0 o negativos
                                    if (lote_detalle.cajas === 0 || lote_detalle.total_pollos <= 0 || lote_detalle.total_peso < 0) {
                                        lote_detalle.promedio = 0;
                                    } else {
                                        lote_detalle.promedio = lote_detalle.total_peso / lote_detalle.total_pollos;
                                    }

                                    // Calcular el peso disponible
                                    lote_detalle.peso_disponible = Number(lote_detalle.total_peso - lote_detalle.peso_movimientos);

                                    let detalle = {
                                        lote_detalles,
                                        cinta,
                                        lote_detalle,
                                        tipo_producto: lote_detalle.tipo_producto,
                                        envios: envios
                                    };
                                    return detalle;
                                } else {
                                    // Si no hay lote_detalles, retornar un objeto vacío por defecto
                                    return {
                                        cinta,
                                        lote_detalle: {
                                            cajas: 0,
                                            promedio: 0,
                                            peso_disponible: 0,
                                            envios: []
                                        },
                                        tipo_producto: 0,
                                        envios: envios
                                    };
                                }
                            });

                            // Totalizar las cajas y envíos para cada compra
                            compra.cinta_cajas = cintas_cajas;
                            compra.total_envios = cintas_cajas.reduce((a, b) => a + b.envios, 0);
                            compra.total_cajas = cintas_cajas.reduce((a, b) => a + b.lote_detalle.cajas, 0) - compra.total_envios;

                            // Determinar si cerrar (cuando no hay cajas disponibles)
                            compra.cerrar = compra.total_cajas === 0;

                            return compra;
                        });

                        return model;
                    },

                    totales_cintas() {
                        let cintas = [...this.lista_cintas]
                        let cinta_totales = cintas.map((cinta) => {
                            let total_cajas = 0
                            let model_cintas = [...this.model_cintas].map((model) => {
                                let buscar_cinta = model.cinta_cajas.filter((b) => b.cinta == cinta)
                                if (buscar_cinta) {
                                    total_cajas += buscar_cinta.reduce((a, b) => a + b.lote_detalle
                                        .cajas, 0) - buscar_cinta.reduce((a, b) => a + b.envios, 0)

                                }
                            })
                            return {
                                name: cinta,
                                total_cajas: total_cajas
                            }
                        })
                        return cinta_totales
                    },
                    total_cinta() {
                        return this.totales_cintas.reduce((a, b) => a + b.total_cajas, 0)
                    },
                    detalle_envios_computed() {
                        let data = [...this.detalle_envio].map((e, i) => {
                            e.index = i
                            return e
                        })
                        return data.reverse()
                    },
                    detalle_enviados_pp() {
                        let data = [...this.pp_detalle].map((e, i) => {
                            e.index = i + 1
                            return e
                        })
                        return data.reverse()
                    },
                    detalle_totales_pp() {
                        let cajas = this.pp_detalle.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.pp_detalle.reduce((a, b) => a + Number(b.equivalente), 0)
                        let bruto = this.pp_detalle.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
                        let neto = this.pp_detalle.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
                        return {
                            cajas: cajas,
                            pollos: pollos,
                            bruto: Number(bruto).toFixed(3),
                            neto: Number(neto).toFixed(3),
                        }
                    },
                    detalle_enviados_pt() {
                        let data = [...this.pt_detalle].map((e, i) => {
                            e.index = i + 1
                            return e
                        })
                        return data.reverse()
                    },
                    detalle_totales_pt() {
                        let cajas = this.pt_detalle.reduce((a, b) => a + Number(b.cajas), 0)
                        let pollos = this.pt_detalle.reduce((a, b) => a + Number(b.equivalente), 0)
                        let bruto = this.pt_detalle.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
                        let neto = this.pt_detalle.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
                        return {
                            cajas: cajas,
                            pollos: pollos,
                            bruto: Number(bruto).toFixed(3),
                            neto: Number(neto).toFixed(3),
                        }
                    },
                    lotes_cerrar() {
                        return this.model_cintas.filter((l) => l.cerrar == true)
                    }
                },
                methods: {
                    red(n, p = 3) {
                        const f = Math.pow(10, p);
                        return Math.round((Number(n) + Number.EPSILON) * f) / f;
                    },
                    compararPorCajas(a, b) {
                        return a.lote_detalle.cajas - b.lote_detalle.cajas;
                    },
                    bandera(d) {
                        let b = this.banderas.find(b => d.dias >= b.min && d.dias <= b.max)
                        if (b) {
                            return b.name
                        }
                        return ''
                    },
                    changeCajas(d) {
                            if (!Number.isInteger(Number(d.cajas))) {
                                swal("Error", "Solo se permiten números enteros en el campo cajas", "warning");
                                d.cajas = Math.floor(Number(d.cajas) || 0);
                                return;
                            }

                        if (d.cajas > d.cajas_stock) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Error',
                                text: "Excedes del stock",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',

                                padding: '2em'
                            })
                            d.cajas = d.cajas_stock
                        }
                        d.equivalente = Number(d.cajas * d.pollos)
                        let cajas_peso = Number(d.cajas * 2)
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(3)
                        d.peso_actual_neto = Number(d.peso_actual_bruto - cajas_peso).toFixed(3)
                        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(3)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(3)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },
                    cajasChangeEnviado(d) {
                        d.equivalente = Number(d.cajas * d.pollos)
                        let cajas_peso = Number(d.cajas * 2)
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(3)
                        d.peso_actual_neto = Number(d.peso_actual_bruto - cajas_peso).toFixed(3)
                        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(3)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(3)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },
                    changeLote(d) {
                            if (!Number.isInteger(Number(d.equivalente))) {
                                swal("Error", "Solo se permiten números enteros en el campo pollos", "warning");
                                d.equivalente = Math.floor(Number(d.equivalente) || 0);
                                return;
                            }
                        //     swal({
                        //         title: 'Detalle del objeto',
                        //         html: `<pre style="text-align:left; white-space:pre-wrap;">${JSON.stringify(d, null, 2)}</pre>`,
                        //         width: 600,
                        //         padding: '2em'
                        //     });
                        // if (d.equivalente > d.pollos) {
                        //      const swalWithBootstrapButtons = swal.mixin({
                        //         confirmButtonClass: 'btn btn-success btn-rounded',
                        //         cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        //         buttonsStyling: false,
                        //     })
                        //     swalWithBootstrapButtons({
                        //         title: 'Error',
                        //         text: "Excedes del stock",
                        //         type: 'warning',
                        //         showCancelButton: false,
                        //         confirmButtonText: 'Ok',

                        //         padding: '2em'
                        //     })
                        //     d.equivalente = d.pollos
                        // }
                        let tara = d.cajas * 2
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(3)
                        d.peso_actual_neto = Number(d.equivalente * d.peso_unitario_neto).toFixed(3)
                        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(3)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(3)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },
                    changeLoteEnviado(d) {
                        let tara = d.cajas * 2
                        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(3)
                        d.peso_actual_neto = Number(d.equivalente * d.peso_unitario_neto).toFixed(3)
                        d.peso_mod_neto = Number(d.peso_mod_bruto - (d.cajas * 2)).toFixed(3)
                        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(3)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },

                    changeLoteM(d) {
                        let tara = d.cajas * 2;
                        if (this.red(d.peso_mod_bruto, 3) > this.red(d.peso_total_2, 3)) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });
                            swalWithBootstrapButtons({
                                title: 'Error',
                                text: "Excedes del stock",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                padding: '2em'
                            });
                            d.peso_mod_bruto = this.red(d.peso_total_2, 3);
                        }
                        d.peso_mod_neto = this.red(d.peso_mod_bruto - tara, 3);
                        d.merma_bruta   = this.red(d.peso_actual_bruto - d.peso_mod_bruto, 3);
                        d.merma_neta    = this.red(d.peso_actual_neto - d.peso_mod_neto, 3);
                    },

                    changeLoteEnviadoM(d) {
                        let tara = d.cajas * 2
                        d.peso_mod_neto = d.peso_mod_bruto - tara
                        d.peso_mod_neto = Number(d.peso_mod_neto).toFixed(3)
                        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(3)
                        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(3)
                    },
                    AddDetalle(i, compra, c) {
                        console.log(i)
                        console.log(compra)
                        console.log(c)
                        let item = {
                            ...i
                        }
                        item.cajas_stock = item.cajas - c.envios
                        item.compra = {
                            ...compra
                        }
                        item.cajas = 1
                        let peso_total = Number(item.peso_total / item.equivalente)
                        item.equivalente = item.cajas * Number(item.pollos)
                        item.peso_total = Number(item.equivalente * peso_total).toFixed(3)

                        item.peso_unitario_bruto = Number(item.peso_total / item.equivalente).toFixed(3)
                        item.peso_neto = Number(item.peso_total - item.cajas * 2).toFixed(3)
                        item.peso_unitario_neto = Number(item.peso_neto / item.equivalente).toFixed(3)
                        item.peso_actual_bruto = Number(item.equivalente * item.peso_unitario_bruto).toFixed(3)
                        item.peso_actual_neto = Number(item.equivalente * item.peso_unitario_neto).toFixed(3)
                        item.peso_mod_bruto = Number(item.peso_actual_bruto).toFixed(3)
                        item.peso_mod_neto = Number(item.peso_actual_bruto - (item.cajas * 2)).toFixed(3)
                        item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(2)
                        item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(2)
                        item.cinta_detalle = c
                        this.detalle_envio.push(item)
                    },
                    CambioPeso() {
                        this.envio.bruto = Number(this.detalle_lote.peso_unit_pollo * this.detalle_envio).toFixed(3)
                        this.envio.neto = Number(this.detalle_lote.peso_neto_pollo * this.detalle_envio).toFixed(3)
                        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_envio) - {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_envio) - {
                            ...this.envio
                        }.neto).toFixed(3)
                    },
                    CambioPesoMerma() {
                        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_envio) - {
                            ...this.envio
                        }.bruto).toFixed(3)
                        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_envio) - {
                            ...this.envio
                        }.neto).toFixed(3)


                    },
                    async FinalizarLote(id) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de Cerrar el lote?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Finalizar Lote',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    block.block();
                                    let res = await axios.post("{{ url('api/lotes-finalizar') }}/" + id, { id });
                                    await this.load();
                                    swalWithBootstrapButtons({
                                        title: 'Lote Finalizado',
                                        text: "El lote fue cerrado exitosamente.",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        reverseButtons: true,
                                        padding: '2em'
                                    });
                                } catch (e) {
                                    console.error(e);
                                } finally {
                                    block.unblock();
                                }
                            }
                        });
                    },

                    deleteLoteEnviadoPp(detalle) {
                        let self = this
                        try {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'OK',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (r) => {
                                if (r.value) {

                                    let url = "{{ url('api/regresar-item-ppdetalleitem') }}/" + detalle.id;
                                    let res = await axios.post(url, {
                                        detalle
                                    })


                                    await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}"),

                                    ]).then((v) => {
                                        self.lotes = v[0]

                                    })
                                    if (!this.pp.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" +
                                                this.sucursal.id),
                                        ]).then((v) => {
                                            this.pp_detalle = v[0]
                                            this.pp_detalle = this.pp_detalle.map((item, i) => {
                                                item.index = i + 1
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item
                                                    .cajas)
                                                let peso_total = Number(item.peso_total /
                                                    item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente *
                                                    peso_total).toFixed(3)
                                                item.peso_unitario_bruto = Number(item
                                                        .peso_total / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_neto = Number(item.peso_total -
                                                    item.cajas * 2).toFixed(3)
                                                item.peso_unitario_neto = Number(item
                                                        .peso_neto / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_actual_bruto = Number(item
                                                    .peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item
                                                    .peso_actual_bruto - tara).toFixed(
                                                    3)
                                                item.peso_mod_bruto = Number(item
                                                    .peso_actual_bruto).toFixed(3)
                                                item.peso_mod_neto = Number(item
                                                    .peso_actual_neto).toFixed(3)
                                                item.merma_bruta = Number(item
                                                    .peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item
                                                    .peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })


                                        })
                                    }

                                    if (!this.pt.hasOwnProperty('id')) {
                                        await Promise.all([
                                            this.GET_DATA("{{ url('api/pts/detalles-V1') }}/" +
                                                this.sucursal.id),
                                        ]).then((v) => {

                                            this.pt_detalle = v[0]


                                            this.pt_detalle = this.pt_detalle.map((item, i) => {
                                                item.index = i + 1
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item
                                                    .cajas)
                                                let peso_total = Number(item.peso_total /
                                                    item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente *
                                                    peso_total).toFixed(3)
                                                item.peso_unitario_bruto = Number(item
                                                        .peso_total / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_neto = Number(item.peso_total -
                                                    item.cajas * 2).toFixed(3)
                                                item.peso_unitario_neto = Number(item
                                                        .peso_neto / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_actual_bruto = Number(item
                                                    .peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item
                                                    .peso_actual_bruto - tara).toFixed(
                                                    3)
                                                item.peso_mod_bruto = Number(item
                                                    .peso_actual_bruto).toFixed(3)
                                                item.peso_mod_neto = Number(item
                                                    .peso_actual_neto).toFixed(3)
                                                item.merma_bruta = Number(item
                                                    .peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item
                                                    .peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        })
                                    }
                                }
                            })
                            // let res = await axios.post(, this.model)

                        } catch (e) {

                        }
                    },
                    deleteLoteEnviadoPt(detalle) {
                        let self = this
                        try {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Estas seguro?',
                                text: "Este cambio es irreversible.",
                                type: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'OK',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (r) => {
                                if (r.value) {

                                    let url = "{{ url('api/regresar-item-ptdetalleitem') }}/" + detalle.id;
                                    let res = await axios.post(url, {
                                        detalle
                                    })


                                    await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}"),

                                    ]).then((v) => {
                                        self.lotes = v[0]

                                    })
                                    if (!this.pp.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" +
                                                this.sucursal.id),
                                        ]).then((v) => {
                                            this.pp_detalle = v[0]
                                            this.pp_detalle = this.pp_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item
                                                    .cajas)
                                                let peso_total = Number(item.peso_total /
                                                    item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente *
                                                    peso_total).toFixed(3)
                                                item.peso_unitario_bruto = Number(item
                                                        .peso_total / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_neto = Number(item.peso_total -
                                                    item.cajas * 2).toFixed(3)
                                                item.peso_unitario_neto = Number(item
                                                        .peso_neto / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_actual_bruto = Number(item
                                                    .peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item
                                                    .peso_actual_bruto - tara).toFixed(
                                                    3)
                                                item.peso_mod_bruto = Number(item
                                                    .peso_actual_bruto).toFixed(3)
                                                item.peso_mod_neto = Number(item
                                                    .peso_actual_neto).toFixed(3)
                                                item.merma_bruta = Number(item
                                                    .peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item
                                                    .peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })


                                        })
                                    }

                                    if (!this.pt.hasOwnProperty('id')) {
                                        await Promise.all([
                                            this.GET_DATA("{{ url('api/pts/detalles-V1') }}/" +
                                                this.sucursal.id),
                                        ]).then((v) => {

                                            this.pt_detalle = v[0]


                                            this.pt_detalle = this.pt_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item
                                                    .cajas)
                                                let peso_total = Number(item.peso_total /
                                                    item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente *
                                                    peso_total).toFixed(3)
                                                item.peso_unitario_bruto = Number(item
                                                        .peso_total / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_neto = Number(item.peso_total -
                                                    item.cajas * 2).toFixed(3)
                                                item.peso_unitario_neto = Number(item
                                                        .peso_neto / item.equivalente)
                                                    .toFixed(3)
                                                item.peso_actual_bruto = Number(item
                                                    .peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item
                                                    .peso_actual_bruto - tara).toFixed(
                                                    3)
                                                item.peso_mod_bruto = Number(item
                                                    .peso_actual_bruto).toFixed(3)
                                                item.peso_mod_neto = Number(item
                                                    .peso_actual_neto).toFixed(3)
                                                item.merma_bruta = Number(item
                                                    .peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item
                                                    .peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        })
                                    }
                                }
                            })
                            // let res = await axios.post(, this.model)

                        } catch (e) {

                        }
                    },
                    async Save() {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de guardar?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Guardar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let url = this.add ? "{{ url('api/proveedors') }}" : "{{ url('api/proveedors') }}/" + this.model.id;
                                    const res = this.add ? await axios.post(url, this.model) : await axios.put(url, this.model);
                                    dt.destroy();
                                    await this.load();
                                    dt.create();
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
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


                            await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}"),
                                self.GET_DATA("{{ url('api/compoInternas') }}"),
                                self.GET_DATA("{{ url('api/compoExternas') }}"),
                                self.GET_DATA("{{ url('api/pps/curso/') }}/" + this.sucursal.id),
                                self.GET_DATA("{{ url('api/banderas') }}"),
                                self.GET_DATA("{{ url('api/pts/curso/') }}/" + this.sucursal.id),


                            ]).then((v) => {
                                self.lotes = v[0]
                                self.compo_internas = v[1]
                                self.compo_externas = v[2]
                                self.pp = v[3]
                                self.banderas = v[4]
                                self.pt = v[5]
                            })


                        } catch (e) {

                        }
                    },
                    async EnviarPP() {
                        block.block();
                        try {
                            let self = this
                            let data = {
                                detalle_envio: this.detalle_envio,
                                pp_id: this.pp_envio.id,
                                user_id: this.user.id,
                                lotes: this.lotes_cerrar
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
                                confirmButtonText: 'Enviar a PP!',
                                cancelButtonText: 'No Enviar!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let res = await axios.post("{{ url('api/ppDetalles-masa') }}",
                                        data)

                                    swalWithBootstrapButtons({
                                        title: 'Enviado a PP con Exito!',
                                        type: 'success',
                                        confirmButtonText: 'Imprimir PDF',
                                        cancelButtonText: 'Continuar',
                                        showCancelButton: true,
                                    }).then((r) => {
                                        if (r.value) {
                                            window.open(res.data.url_pdf, '_blank');
                                        }
                                    })
                                }
                                await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}"),

                                ]).then((v) => {
                                    self.lotes = v[0]

                                })
                                if (!this.pp.hasOwnProperty('id')) {
                                    await Promise.all([
                                        self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" +
                                            this.sucursal.id),
                                    ]).then((v) => {
                                        this.pp_detalle = v[0]
                                        this.pp_detalle = this.pp_detalle.map((item) => {
                                            item.equivalente = Number(item.pollos)
                                            item.pollos = Number(item.equivalente / item
                                                .cajas)
                                            let peso_total = Number(item.peso_total /
                                                item.equivalente)
                                            let tara = Number(item.cajas * 2)
                                            item.peso_total = Number(item.equivalente *
                                                peso_total).toFixed(3)
                                            item.peso_unitario_bruto = Number(item
                                                    .peso_total / item.equivalente)
                                                .toFixed(3)
                                            item.peso_neto = Number(item.peso_total -
                                                item.cajas * 2).toFixed(3)
                                            item.peso_unitario_neto = Number(item
                                                    .peso_neto / item.equivalente)
                                                .toFixed(3)
                                            item.peso_actual_bruto = Number(item
                                                .peso_bruto).toFixed(3)
                                            item.peso_actual_neto = Number(item
                                                .peso_actual_bruto - tara).toFixed(
                                                3)
                                            item.peso_mod_bruto = Number(item
                                                .peso_actual_bruto).toFixed(3)
                                            item.peso_mod_neto = Number(item
                                                .peso_actual_neto).toFixed(3)
                                            item.merma_bruta = Number(item
                                                .peso_actual_bruto - item
                                                .peso_mod_bruto).toFixed(3)
                                            item.merma_neta = Number(item
                                                .peso_actual_neto - item
                                                .peso_mod_neto).toFixed(3)
                                            return item
                                        })


                                    })
                                }

                                if (!this.pt.hasOwnProperty('id')) {
                                    await Promise.all([
                                        this.GET_DATA("{{ url('api/pts/detalles-V1') }}/" +
                                            this.sucursal.id),
                                    ]).then((v) => {

                                        this.pt_detalle = v[0]


                                        this.pt_detalle = this.pt_detalle.map((item) => {
                                            item.equivalente = Number(item.pollos)
                                            item.pollos = Number(item.equivalente / item
                                                .cajas)
                                            let peso_total = Number(item.peso_total /
                                                item.equivalente)
                                            let tara = Number(item.cajas * 2)
                                            item.peso_total = Number(item.equivalente *
                                                peso_total).toFixed(3)
                                            item.peso_unitario_bruto = Number(item
                                                    .peso_total / item.equivalente)
                                                .toFixed(3)
                                            item.peso_neto = Number(item.peso_total -
                                                item.cajas * 2).toFixed(3)
                                            item.peso_unitario_neto = Number(item
                                                    .peso_neto / item.equivalente)
                                                .toFixed(3)
                                            item.peso_actual_bruto = Number(item
                                                .peso_bruto).toFixed(3)
                                            item.peso_actual_neto = Number(item
                                                .peso_actual_bruto - tara).toFixed(
                                                3)
                                            item.peso_mod_bruto = Number(item
                                                .peso_actual_bruto).toFixed(3)
                                            item.peso_mod_neto = Number(item
                                                .peso_actual_neto).toFixed(3)
                                            item.merma_bruta = Number(item
                                                .peso_actual_bruto - item
                                                .peso_mod_bruto).toFixed(3)
                                            item.merma_neta = Number(item
                                                .peso_actual_neto - item
                                                .peso_mod_neto).toFixed(3)
                                            return item
                                        })
                                    })
                                }
                                this.detalle_envio = []
                            })
                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async EnviarPT() {
                        block.block();
                        try {
                            let self = this
                            let data = {
                                detalle_envio: this.detalle_envio,
                                pt_id: this.pt_envio.id,
                                user_id: this.user.id,
                                lotes: this.lotes_cerrar
                            }
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
                                confirmButtonText: 'Enviar a PT!',
                                cancelButtonText: 'No Enviar!',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    let res = await axios.post("{{ url('api/ptDetalles-masa') }}",
                                        data)

                                    swalWithBootstrapButtons({
                                        title: 'Enviado a PT con Exito!',
                                        type: 'success',
                                        confirmButtonText: 'Imprimir PDF',
                                        cancelButtonText: 'Continuar',
                                        showCancelButton: true,
                                    }).then((r) => {
                                        if (r.value) {
                                            window.open(res.data.url_pdf, '_blank');
                                        }
                                    })
                                }
                                await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}"),

                                ]).then((v) => {
                                    self.lotes = v[0]

                                })
                                this.detalle_envio = []
                                if (!this.pp.hasOwnProperty('id')) {
                                    await Promise.all([
                                        self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" +
                                            this.sucursal.id),
                                    ]).then((v) => {
                                        this.pp_detalle = v[0]
                                        this.pp_detalle = this.pp_detalle.map((item) => {
                                            item.equivalente = Number(item.pollos)
                                            item.pollos = Number(item.equivalente / item
                                                .cajas)
                                            let peso_total = Number(item.peso_total /
                                                item.equivalente)
                                            let tara = Number(item.cajas * 2)
                                            item.peso_total = Number(item.equivalente *
                                                peso_total).toFixed(3)
                                            item.peso_unitario_bruto = Number(item
                                                    .peso_total / item.equivalente)
                                                .toFixed(3)
                                            item.peso_neto = Number(item.peso_total -
                                                item.cajas * 2).toFixed(3)
                                            item.peso_unitario_neto = Number(item
                                                    .peso_neto / item.equivalente)
                                                .toFixed(3)
                                            item.peso_actual_bruto = Number(item
                                                .peso_bruto).toFixed(3)
                                            item.peso_actual_neto = Number(item
                                                .peso_actual_bruto - tara).toFixed(
                                                3)
                                            item.peso_mod_bruto = Number(item
                                                .peso_actual_bruto).toFixed(3)
                                            item.peso_mod_neto = Number(item
                                                .peso_actual_neto).toFixed(3)
                                            item.merma_bruta = Number(item
                                                .peso_actual_bruto - item
                                                .peso_mod_bruto).toFixed(3)
                                            item.merma_neta = Number(item
                                                .peso_actual_neto - item
                                                .peso_mod_neto).toFixed(3)
                                            return item
                                            return item
                                        })


                                    })
                                }

                                if (!this.pt.hasOwnProperty('id')) {
                                    await Promise.all([
                                        this.GET_DATA("{{ url('api/pts/detalles-V1') }}/" +
                                            this.sucursal.id),
                                    ]).then((v) => {

                                        this.pt_detalle = v[0]


                                        this.pt_detalle = this.pt_detalle.map((item) => {
                                            item.equivalente = Number(item.pollos)
                                            item.pollos = Number(item.equivalente / item
                                                .cajas)
                                            let peso_total = Number(item.peso_total /
                                                item.equivalente)
                                            let tara = Number(item.cajas * 2)
                                            item.peso_total = Number(item.equivalente *
                                                peso_total).toFixed(3)
                                            item.peso_unitario_bruto = Number(item
                                                    .peso_total / item.equivalente)
                                                .toFixed(3)
                                            item.peso_neto = Number(item.peso_total -
                                                item.cajas * 2).toFixed(3)
                                            item.peso_unitario_neto = Number(item
                                                    .peso_neto / item.equivalente)
                                                .toFixed(3)
                                            item.peso_actual_bruto = Number(item
                                                .peso_bruto).toFixed(3)
                                            item.peso_actual_neto = Number(item
                                                .peso_actual_bruto - tara).toFixed(
                                                3)
                                            item.peso_mod_bruto = Number(item
                                                .peso_actual_bruto).toFixed(3)
                                            item.peso_mod_neto = Number(item
                                                .peso_actual_neto).toFixed(3)
                                            item.merma_bruta = Number(item
                                                .peso_actual_bruto - item
                                                .peso_mod_bruto).toFixed(3)
                                            item.merma_neta = Number(item
                                                .peso_actual_neto - item
                                                .peso_mod_neto).toFixed(3)
                                            return item
                                        })
                                    })
                                }


                            })


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async ActualizarPp() {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de actualizar PP?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Actualizar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let data = { detalle_envio: this.pp_detalle };
                                    await axios.post("{{ url('api/ppDetalles-masa-actualizar') }}", data);
                                    swalWithBootstrapButtons({
                                        title: 'Actualizado correctamente!',
                                        type: 'success',
                                        confirmButtonText: 'Ok',
                                        cancelButtonText: 'Cancelar',
                                        showCancelButton: false,
                                    });
                                    await this.load();
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
                    },
                    async RetornarPp() {
                        let self = this;
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de retornar PP?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Retornar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let data = { detalle_envio: this.pp_detalle };
                                    await axios.post("{{ url('api/ppDetalles-masa-retornar') }}/" + this.sucursal.id, data);

                                    swalWithBootstrapButtons({
                                        title: 'Retorno total correctamente!',
                                        type: 'success',
                                        confirmButtonText: 'Ok',
                                        showCancelButton: false,
                                    });

                                    await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}")]).then((v) => {
                                        self.lotes = v[0];
                                    });

                                    if (!this.pp.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" + this.sucursal.id),
                                        ]).then((v) => {
                                            this.pp_detalle = v[0];
                                            this.pp_detalle = this.pp_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item.cajas)
                                                let peso_total = Number(item.peso_total / item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente * peso_total)
                                                    .toFixed(3)
                                                item.peso_unitario_bruto = Number(item.peso_total / item
                                                    .equivalente).toFixed(3)
                                                item.peso_neto = Number(item.peso_total - item.cajas * 2)
                                                    .toFixed(3)
                                                item.peso_unitario_neto = Number(item.peso_neto / item
                                                    .equivalente).toFixed(3)
                                                item.peso_actual_bruto = Number(item.peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item.peso_actual_bruto -
                                                    tara).toFixed(3)
                                                item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                                    .toFixed(3)
                                                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(
                                                    3)
                                                item.merma_bruta = Number(item.peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item.peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        });
                                    }

                                    if (!this.pt.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pts/detalles-V1') }}/" + this.sucursal.id),
                                        ]).then((v) => {
                                            this.pt_detalle = v[0]
                                            this.pt_detalle = this.pt_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item.cajas)
                                                let peso_total = Number(item.peso_total / item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente * peso_total)
                                                    .toFixed(3)
                                                item.peso_unitario_bruto = Number(item.peso_total / item
                                                    .equivalente).toFixed(3)
                                                item.peso_neto = Number(item.peso_total - item.cajas * 2)
                                                    .toFixed(3)
                                                item.peso_unitario_neto = Number(item.peso_neto / item
                                                    .equivalente).toFixed(3)
                                                item.peso_actual_bruto = Number(item.peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item.peso_actual_bruto -
                                                    tara).toFixed(3)
                                                item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                                    .toFixed(3)
                                                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(
                                                    3)
                                                item.merma_bruta = Number(item.peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item.peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        });
                                    }

                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
                    },
                    async RetornarPt() {
                        let self = this;
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de retornar PT?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Retornar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let data = { detalle_envio: this.pt_detalle };
                                    await axios.post("{{ url('api/ptDetalles-masa-retornar') }}/" + this.sucursal.id, data);

                                    swalWithBootstrapButtons({
                                        title: 'Retorno total correctamente!',
                                        type: 'success',
                                        confirmButtonText: 'Ok',
                                        showCancelButton: false,
                                    });

                                    await Promise.all([self.GET_DATA("{{ url('api/lotes-general') }}")]).then((v) => {
                                        self.lotes = v[0];
                                    });

                                    if (!this.pp.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" + this.sucursal.id),
                                        ]).then((v) => {
                                            this.pp_detalle = v[0]
                                            this.pp_detalle = this.pp_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item.cajas)
                                                let peso_total = Number(item.peso_total / item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente * peso_total)
                                                    .toFixed(3)
                                                item.peso_unitario_bruto = Number(item.peso_total / item
                                                    .equivalente).toFixed(3)
                                                item.peso_neto = Number(item.peso_total - item.cajas * 2)
                                                    .toFixed(3)
                                                item.peso_unitario_neto = Number(item.peso_neto / item
                                                    .equivalente).toFixed(3)
                                                item.peso_actual_bruto = Number(item.peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item.peso_actual_bruto -
                                                    tara).toFixed(3)
                                                item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                                    .toFixed(3)
                                                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(
                                                    3)
                                                item.merma_bruta = Number(item.peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item.peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        });
                                    }

                                    if (!this.pt.hasOwnProperty('id')) {
                                        await Promise.all([
                                            self.GET_DATA("{{ url('api/pts/detalles-V1') }}/" + this.sucursal.id),
                                        ]).then((v) => {
                                            this.pt_detalle = v[0]
                                            this.pt_detalle = this.pt_detalle.map((item) => {
                                                item.equivalente = Number(item.pollos)
                                                item.pollos = Number(item.equivalente / item.cajas)
                                                let peso_total = Number(item.peso_total / item.equivalente)
                                                let tara = Number(item.cajas * 2)
                                                item.peso_total = Number(item.equivalente * peso_total)
                                                    .toFixed(3)
                                                item.peso_unitario_bruto = Number(item.peso_total / item
                                                    .equivalente).toFixed(3)
                                                item.peso_neto = Number(item.peso_total - item.cajas * 2)
                                                    .toFixed(3)
                                                item.peso_unitario_neto = Number(item.peso_neto / item
                                                    .equivalente).toFixed(3)
                                                item.peso_actual_bruto = Number(item.peso_bruto).toFixed(3)
                                                item.peso_actual_neto = Number(item.peso_actual_bruto -
                                                    tara).toFixed(3)
                                                item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                                    .toFixed(3)
                                                item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(
                                                    3)
                                                item.merma_bruta = Number(item.peso_actual_bruto - item
                                                    .peso_mod_bruto).toFixed(3)
                                                item.merma_neta = Number(item.peso_actual_neto - item
                                                    .peso_mod_neto).toFixed(3)
                                                return item
                                            })
                                        });
                                    }

                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
                    },

                    async loadPps() {
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA("{{ url('api/pps/curso/') }}/" + this.sucursal
                                    .id),

                                ]).then((v) => {
                                    self.pps = v[0]
                                    self.pps.reverse();
                                    if (self.pps && self.pps.length > 0) {
                                        self.pp_envio = self.pps[0];
                                    }
                                })

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                    async loadPts() {
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA("{{ url('api/pts/curso/') }}/" + this.sucursal
                                    .id),

                                ]).then((v) => {
                                    self.pts = v[0]
                                    self.pts.reverse();
                                    if (self.pts && self.pts.length > 0) {
                                        self.pt_envio = self.pts[0];
                                    }
                                })

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                   async ActualizarPt() {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro de actualizar PT?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Actualizar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let data = { detalle_envio: this.pt_detalle };
                                    await axios.post("{{ url('api/ptDetalles-masa-actualizar') }}", data);
                                    swalWithBootstrapButtons({
                                        title: 'Actualizado correctamente!',
                                        type: 'success',
                                        confirmButtonText: 'Ok',
                                        cancelButtonText: 'Cancelar',
                                        showCancelButton: false,
                                    });
                                    await this.load();
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
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


                                    let url = "{{ url('api/compras') }}/" + id

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
                            let user = localStorage.getItem('AppUser')
                            this.user = JSON.parse(user)
                            this.sucursal = JSON.parse(sucursal)
                            await Promise.all([self.load(), self.loadPps(), self.loadPts()]).then((v) => {

                            })
                            if (!this.pp.hasOwnProperty('id')) {
                                await Promise.all([
                                    self.GET_DATA("{{ url('api/pps/detalles-V1/') }}/" + this
                                        .sucursal.id),
                                ]).then((v) => {
                                    let data = v[0]
                                    this.pp_detalle = data.map((item) => {
                                        item.equivalente = Number(item.pollos)
                                        item.pollos = Number(item.equivalente / item.cajas)
                                        let peso_total = Number(item.peso_total / item
                                            .equivalente)
                                        let tara = Number(item.cajas * 2)
                                        item.peso_total = Number(item.equivalente *
                                            peso_total).toFixed(3)
                                        item.peso_unitario_bruto = Number(item.peso_total /
                                            item.equivalente).toFixed(3)
                                        item.peso_neto = Number(item.peso_total - item
                                            .cajas * 2).toFixed(3)
                                        item.peso_unitario_neto = Number(item.peso_neto /
                                            item.equivalente).toFixed(3)
                                        item.peso_actual_bruto = Number(item.peso_bruto)
                                            .toFixed(3)
                                        item.peso_actual_neto = Number(item
                                            .peso_actual_bruto - tara).toFixed(3)
                                        item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                            .toFixed(3)
                                        item.peso_mod_neto = Number(item.peso_actual_neto)
                                            .toFixed(3)
                                        item.merma_bruta = Number(item.peso_actual_bruto -
                                            item.peso_mod_bruto).toFixed(3)
                                        item.merma_neta = Number(item.peso_actual_neto -
                                            item.peso_mod_neto).toFixed(3)
                                        return item
                                    })


                                })
                            }

                            if (!this.pt.hasOwnProperty('id')) {
                                await Promise.all([
                                    this.GET_DATA("{{ url('api/pts/detalles-V1') }}/" + this
                                        .sucursal.id),
                                ]).then((v) => {

                                    let data = v[0]


                                    this.pt_detalle = data.map((item) => {
                                        item.equivalente = Number(item.pollos)
                                        item.pollos = Number(item.equivalente / item.cajas)
                                        let peso_total = Number(item.peso_total / item
                                            .equivalente)
                                        let tara = Number(item.cajas * 2)
                                        item.peso_total = Number(item.equivalente *
                                            peso_total).toFixed(3)
                                        item.peso_unitario_bruto = Number(item.peso_total /
                                            item.equivalente).toFixed(3)
                                        item.peso_neto = Number(item.peso_total - item
                                            .cajas * 2).toFixed(3)
                                        item.peso_unitario_neto = Number(item.peso_neto /
                                            item.equivalente).toFixed(3)
                                        item.peso_actual_bruto = Number(item.peso_bruto)
                                            .toFixed(3)
                                        item.peso_actual_neto = Number(item
                                            .peso_actual_bruto - tara).toFixed(3)
                                        item.peso_mod_bruto = Number(item.peso_actual_bruto)
                                            .toFixed(3)
                                        item.peso_mod_neto = Number(item.peso_actual_neto)
                                            .toFixed(3)
                                        item.merma_bruta = Number(item.peso_actual_bruto -
                                            item.peso_mod_bruto).toFixed(3)
                                        item.merma_neta = Number(item.peso_actual_neto -
                                            item.peso_mod_neto).toFixed(3)
                                        return item
                                    })
                                })
                            }
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
            .sub_t td {
                font-weight: bold;

            }

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

            th.action-column,
            td .action-column {
                width: 150px;
                text-align: center;
            }

            .btn-sm {
                padding: 0.5rem 0.5rem;
                font-size: 0.8rem;
            }

            table th,
            table td {
                padding: 0.5rem;
            }
        </style>
    @endslot
@endcomponent
