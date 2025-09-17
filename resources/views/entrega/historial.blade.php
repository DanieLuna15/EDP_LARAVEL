@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="action-btn layout-top-spacing mb-5">
                    <div class="page-header">
                        <div class="page-title">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>Historial de ventas para entregar</p>
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
                                            <button class="btn btn-success mt-4" @click="ConsultarFecha()"
                                                :disabled="loading.consultar">
                                                <span v-if="loading.consultar">Consultando...</span>
                                                <span v-else>Consultar</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mb-4 mt-4">

                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Creacion</th>
                                            <th>CLIENTE</th>
                                            <th>USUARIO</th>
                                            <th>DISTRIBUIDOR/CHOFER</th>
                                            <th>METODO PAGO</th>
                                            <th>TOTAL</th>
                                            <th>ESTADO PAGO</th>
                                            <th>PENDIENTE</th>
                                            <th>PAGADO</th>
                                            <th>DESPACHADO</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in ventas">
                                            <td>{{ m . id }}</td>
                                            <td>{{ m . fecha }} {{ m . hora }}
                                                <span v-if="m.entregado==1" class="badge badge-danger"><i
                                                        class="fa fa-times"></i></span>
                                                <span v-else class="badge badge-success"><i class="fa fa-check"></i></span>
                                            </td>
                                            <td>{{ m . cliente . nombre }}</td>
                                            <td>{{ m . user . nombre }} {{ m . user . apellidos }}</td>
                                            <td>{{ m . distribuidor . nombre }} {{ m . distribuidor . apellidos }} /
                                                {{ m . chofer . nombre }}
                                            </td>
                                            <td>
                                                <span v-if="m.metodo_pago == 1" class="badge badge-success">CONTADO</span>
                                                <span v-else-if="m.metodo_pago == 2" class="badge badge-info">PAGO PARCIAL</span>
                                                <span v-else-if="m.metodo_pago == 3" class="badge badge-info">CREDITO</span>
                                                <span v-else class="badge badge-dark">CREDITO ENTREGA</span>
                                            </td>
                                            <td>
                                                {{ m . total }}
                                            </td>

                                            <td>
                                                <span v-if="(m.metodo_pago == 3 || m.metodo_pago == 4) && m.pagado_total == 0"
                                                    class="badge badge-danger">NO INICIADO AUN</span>
                                                <span
                                                    v-else-if="(m.metodo_pago == 1 || m.metodo_pago == 2) && m.pendiente_total == 0"
                                                    class="badge badge-success">PAGADO</span>
                                                <span
                                                    v-else-if="(m.metodo_pago == 3 || m.metodo_pago == 4) && m.pendiente_total == 0"
                                                    class="badge badge-success">PAGADO</span>
                                                <span
                                                    v-else-if="(m.metodo_pago == 3 || m.metodo_pago == 4) && m.pendiente_total > 0 && m.pagado_total > 0"
                                                    class="badge badge-warning">PENDIENTE</span>
                                                <span v-else-if="m.pendiente_total == 0" class="badge badge-success">PAGADO</span>
                                                <span v-else class="badge badge-warning">PENDIENTE</span>
                                            </td>
                                            <td>
                                                {{ m . pendiente_total }}
                                            </td>
                                            <td>
                                                {{ m . pagado_total }}
                                            </td>
                                            <td>
                                                <span v-if="m.despachado==1" class="badge badge-warning">SIN DESPACHAR </span>
                                                <span v-else class="badge badge-success">DESPACHADO</span>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <a :href="m.url_2_pdf" target="_blank" class="btn btn-dark btn-sm">PDF</a>
                                                    <button type="button"
                                                        class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                                        :id="'menu' + i" data-toggle="dropdown" data-boundary="viewport"
                                                        aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu" :aria-labelledby="'menu' + i">
                                                        <a class="dropdown-item" :href="m.url_pdf" target="_blank">PDF</a>
                                                        <a v-if="!(
                                                        ((m.metodo_pago == 1 || m.metodo_pago == 2) && m.pendiente_total == 0)
||
                                                        ((m.metodo_pago == 3 || m.metodo_pago == 4) && m.pendiente_total == 0)
                                                    )"
                                                            href="javascript:void(0)" class="dropdown-item" data-toggle="modal"
                                                            data-target="#modalDesapacho" @click="SelectVenta(m)">
                                                            DESPACHAR/COBRAR
                                                        </a>

                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            @click="abrirModalVentasCredito(m.cliente)">COBRO GLOBAL</a>
                                                        <a style="display: none" class="dropdown-item" href="javascript:void(0)"
                                                            @click="deleteItem(m.id)">Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalDesapacho" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">DESPACHAR VENTA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Total</label>
                                                <input type="text" name="" class="form-control" id=""
                                                    :value="venta.total" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Total Pagado</label>
                                                <input type="text" name="" class="form-control" id=""
                                                    :value="venta.pagado_total" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Total Pendiente</label>
                                                <input type="text" name="" class="form-control" id=""
                                                    :value="venta.pendiente_total" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Cajas Venta</label>
                                                <input type="text" name="" class="form-control" id=""
                                                    :value="venta.cajas_venta" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Cajas Pendientes</label>
                                                <input type="text" name="" class="form-control" id=""
                                                    :value="venta.cantidad_cajas" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Cajas / Recibir</label>
                                                <input type="number" name="" class="form-control" id=""
                                                    v-model="despacho.cajas_entregar">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Método de Pago</label>
                                                <select class="form-control" v-model="venta.metodo_pago">
                                                    <option v-for="m in tipopagos" :key="m.id" :value="String(m.id)">
                                                        {{ m . name }}</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Formas de pago</label>
                                                <select name="" class="form-control" id=""
                                                    v-model="despacho.formapago_id">
                                                    <template v-for="m in formapagos">
                                                        <option :value="m.id">{{ m . name }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Monto a Pagar</label>
                                                <input type="text" readonly class="form-control"
                                                    :value="venta.metodo_pago == 1 ? despacho.monto : venta.pendiente_total"
                                                    :disabled="venta.metodo_pago == 3" @input="onMontoInput($event)">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Pago con </label>
                                                <input type="number" class="form-control" v-model="despacho.pago_con">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="">Cambio</label>
                                                <input type="text" class="form-control" :value="cambio" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="entregado" class="custom-checkbox-label">
                                                    Entregado
                                                    <input type="checkbox" id="entregado" v-model="despacho.entregado"
                                                        :true-value="2" :false-value="0"
                                                        :disabled="Number(venta.entregado) === 2" class="custom-checkbox" />
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12" v-if="Number(despacho.cajas_entregar) > 0">
                                            <div class="form-group">
                                                <label for="">Observaciones de Cajas</label>
                                                <textarea class="form-control" rows="2"
                                                    v-model="despacho.observacion_cajas"
                                                    placeholder="Detalle devoluciones o incidencias de cajas"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" v-if="Number(despacho.pago_con) > 0">
                                            <div class="form-group">
                                                <label for="">Observaciones del Pago</label>
                                                <textarea class="form-control" rows="2"
                                                    v-model="despacho.observacion_pago"
                                                    placeholder="Notas adicionales sobre el cobro"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-success" @click="Save()"
                                        :disabled="loading.save">
                                        <span v-if="loading.save">Guardando...</span>
                                        <span v-else>Guardar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para ver y pagar ventas a crédito -->
                    <div class="modal fade" id="modalVentasCredito" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">
                                        Saldos pendientes de:
                                        <span v-if="clienteActual">
                                            <strong>{{ clienteActual . nombre }}</strong>
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div v-if="showCreditoError" class="alert alert-success">
                                                <div>
                                                    <strong>El cliente no tiene ventas(despachadas) a crédito con saldo pendiente de
                                                        pago.</strong>
                                                </div>
                                            </div>
                                            <table v-if="!showCreditoError" class="table table-hover non-hover"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Fecha</th>
                                                        <th>Monto Pendiente</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr v-for="(venta, index) in ventasCreditoCliente" :key="venta.id">
                                                        <td>
                                                            <input type="checkbox" :value="venta.id"
                                                                v-model="ventasSeleccionadas" @change="actualizarSuma()">
                                                        </td>
                                                        <td>{{ venta . fecha }}</td>
                                                        <td>{{ venta . pendiente_total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Total Calculado</label>
                                                <input type="text" class="form-control" v-model="totalPagar" disabled>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Total a Pagar</label>
                                                <input type="text" class="form-control" v-model="totalPagarEditable">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Forma de Pago</label>
                                                <select class="form-control" v-model="formapagoGlobal">
                                                    <option disabled value="">Selecciona una forma de pago</option>
                                                    <option v-for="f in formapagos" :value="f.id">{{ f . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button type="button" class="btn btn-success" @click="confirmarPago"
                                        :disabled="loading.cobrar || showCreditoError">
                                        <span v-if="loading.cobrar">Procesando...</span>
                                        <span v-else>Confirmar Pago</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        @endverbatim
        <div class="modal fade" id="modalBloqueoCaja" tabindex="-1" role="dialog" aria-hidden="true"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border border-info">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title w-100 text-white text-center m-0"><strong>No tienes una caja activa
                                abierta.</strong></h5>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('/img/pos_caja.png') }}" alt="Caja no encontrada" class="img-fluid mb-3"
                            style="max-height: 150px;">
                        <p><strong>No puedes continuar hasta abrir una.</strong></p>
                        <button class="btn btn-info" @click="abrirModalCaja">Abrir Caja</button>
                        <a href="{{ url('/') }}" class="btn btn-success">
                            <i class="flaticon-home"></i> Menú Principal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAperturaCaja" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">APERTURAR CAJA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Monto de Apertura</label>
                            <input type="text" v-model="model.monto_inicial" class="form-control" placeholder="100.00">
                        </div>
                        <div class="form-group">
                            <label>Cajas Disponibles</label>
                            <select v-model="model.caja_sucursal_usuario_id" class="form-control">
                                <option disabled selected value="">Seleccionar Caja</option>
                                <option v-for="s in cajas" :value="s.id">@{{ s.caja_sucursal.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" data-dismiss="modal" @click="AbrirCajaDesdeVista"
                            :disabled="!model.caja_sucursal_usuario_id">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @slot('style')
            <style>
                .dropdown-menu {
                    max-height: 250px !important;
                    overflow-y: auto !important;
                    z-index: 1050 !important;
                }
            </style>
        @endslot
    @endslot
    @slot('script')
        <script type="module">
            import TableDate from "{{ asset('config/dtdate.js') }}"
            import Block from "{{ asset('config/block.js') }}"

            function hoyEnZona(timeZone = 'America/La_Paz') {
                const dtf = new Intl.DateTimeFormat('en-CA', {
                    timeZone,
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });
                const parts = dtf.formatToParts(new Date());
                const y = parts.find(p => p.type === 'year').value;
                const m = parts.find(p => p.type === 'month').value;
                const d = parts.find(p => p.type === 'day').value;
                return `${y}-${m}-${d}`;
            }
            const {
                createApp
            } = Vue
            let dt = new TableDate()
            let block = new Block()
            createApp({
                data() {
                    return {
                        loading: {
                            save: false,
                            cobrar: false,
                            consultar: false,
                        },
                        add: true,
                        model: {
                            name: ''
                        },
                        ventas: [],
                        cajas: [],
                        fecha_inicio: '',
                        fecha_fin: '',
                        arqueo: {},
                        user: {},
                        sucursal: {},
                        venta: {
                            cajas_venta: 0,
                            cantidad_cajas: 0
                        },
                        formapagos: [],
                        despacho: {
                            formapago_id: 1,
                            pago_con: 0,
                            monto: 0,
                            cambio: 0,
                            cajas_entregar: 0,
                            observacion_cajas: '',
                            observacion_pago: ''
                        },
                        ventasCreditoCliente: [],
                        ventasSeleccionadas: [],
                        totalPagar: 0,
                        totalPagarEditable: 0,
                        formapagoGlobal: 1,
                        clienteActual: null,
                        showCreditoError: false,
                        tipopagos: [],
                    }
                },
                computed: {
                    cambio() {
                        let montoPagar = this.venta.metodo_pago == 1 ?
                            Number(this.despacho.monto) :
                            Number(this.venta.pendiente_total);

                        let pagoCon = Number(this.despacho.pago_con);

                        if (!pagoCon || isNaN(pagoCon) || pagoCon < montoPagar) {
                            return '0.00';
                        }
                        return (pagoCon - montoPagar).toFixed(2);
                    }
                },
                methods: {
                    hoyEnZona(timeZone = 'America/La_Paz') {
                        const dtf = new Intl.DateTimeFormat('en-CA', {
                            timeZone,
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        });
                        const p = dtf.formatToParts(new Date());
                        return `${p.find(x=>x.type==='year').value}-${p.find(x=>x.type==='month').value}-${p.find(x=>x.type==='day').value}`;
                    },
                    actualizarSuma() {
                        let total = this.ventasSeleccionadas.reduce((total, ventaId) => {
                            const venta = this.ventasCreditoCliente.find(v => v.id === ventaId);
                            if (venta) {
                                return total + parseFloat(venta.pendiente_total);
                            }
                            return total;
                        }, 0);
                        this.totalPagar = total.toFixed(2);
                        this.totalPagarEditable = this.totalPagar;
                    },
                    async abrirModalVentasCredito(cliente) {
                        this.clienteActual = cliente;
                        let response = await axios.get(`/api/ventas-credito/${cliente.id}`);
                        this.ventasCreditoCliente = response.data;
                        this.ventasSeleccionadas = this.ventasCreditoCliente.map(venta => venta.id);
                        this.actualizarSuma();
                        this.showCreditoError = (this.ventasCreditoCliente.length === 0);
                        $('#modalVentasCredito').modal('show');
                    },

                    async confirmarPago() {

                        if (this.loading.cobrar) return;
                        if (!this.arqueo || !this.arqueo.id) {
                            return swal.fire({
                                title: 'Error',
                                text: 'No se encontró una caja activa abierta para despachar.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger',
                            });
                        }
                        if (this.totalPagarEditable <= 0 || this.ventasSeleccionadas.length === 0) {
                            return swal.fire('Error',
                                'El monto de pago debe ser mayor que cero, al menos debe seleccionar una venta',
                                'error');
                        }
                        if (!this.formapagoGlobal) {
                            return swal.fire('Error', 'Debes seleccionar una forma de pago para continuar',
                                'error');
                        }
                        this.despacho.arqueo = this.arqueo;
                        try {
                            let res = await axios.post('/api/pagar-venta', {
                                ventaIds: this.ventasSeleccionadas,
                                monto: this.totalPagarEditable,
                                despacho: this.despacho,
                                formapago_id: this.formapagoGlobal
                            });

                            if (res.data.success) {
                                const swalWithBootstrapButtons = swal.mixin({
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                    buttonsStyling: false,
                                });
                                swalWithBootstrapButtons({
                                    title: 'Pago Realizado',
                                    text: res.data.message || 'El pago ha sido registrado exitosamente',
                                    type: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: 'Abrir PDF',
                                    cancelButtonText: 'Aceptar',
                                    reverseButtons: true,
                                    padding: '2em',
                                }).then(async (result) => {
                                    if (result.value) {
                                        try {
                                            if (res.data.url_pdf_cobranza) {
                                                window.open(res.data.url_pdf_cobranza, '_blank');
                                            }
                                            this.ConsultarFecha();
                                        } catch (e) {
                                            console.error('Error al abrir el PDF', e);
                                        }
                                    } else {
                                        this.ConsultarFecha();
                                    }
                                });
                                this.ventasCreditoCliente = this.ventasCreditoCliente.filter(
                                    venta => !this.ventasSeleccionadas.includes(venta.id)
                                );
                                this.totalPagar = 0;
                                this.ventasSeleccionadas = [];
                            } else {
                                swal.fire('Error', 'Hubo un problema al procesar el pago', 'error');
                                this.ConsultarFecha();
                            }
                        } catch (error) {
                            swal.fire('Error', 'Ocurrió un error en la comunicación con el servidor', 'error');
                        } finally {
                            this.loading.cobrar = false;
                            $('#modalVentasCredito').modal('hide');
                        }
                    },

                    onMontoInput(e) {
                        if (this.venta.metodo_pago == 1) {
                            this.despacho.monto = e.target.value;
                        }
                    },
                    async checkCajaActiva() {
                        try {
                            let res = await axios.get("{{ url('api/caja-activa-usuario') }}/" + this.user.id +
                                '/' + this.sucursal.id)
                            if (!res.data || !res.data.id) {
                                $('#modalBloqueoCaja').modal('show');
                                return false;
                            }
                            this.arqueo = res.data;
                            return true;
                        } catch (e) {
                            console.error('Error al validar caja activa', e);
                            $('#modalBloqueoCaja').modal('show');
                            return false;
                        }
                    },
                    AbrirCajaDesdeVista() {
                        const self = this;
                        this.model.user_id = this.user.id;
                        this.model.sucursal_id = this.sucursal.id;
                        axios.post("{{ url('api/arqueos') }}", this.model)
                            .then(async (res) => {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Caja Aperturada',
                                    text: 'La caja fue aperturada correctamente.',
                                    confirmButtonText: 'OK'
                                });
                                $('#modalBloqueoCaja').modal('hide');
                                await self.checkCajaActiva();
                            })
                            .catch((err) => {
                                console.error("Error aperturando caja", err);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo aperturar la caja. Intenta nuevamente.',
                                });
                            });
                    },
                    abrirModalCaja() {
                        $('#modalAperturaCaja').modal('show');
                    },
                    SelectVenta(venta) {
                        this.venta = venta;

                        const entregadoNum = Number(venta.entregado);
                        this.despacho.entregado = (entregadoNum === 2) ? 2 : 0;
                        this.despacho.observacion_cajas = '';
                        this.despacho.observacion_pago = '';
                        if (this.venta.venta_pago == 1) {
                            this.despacho.monto = 0
                        } else {
                            this.despacho.monto = venta.total
                        }
                    },
                    async Save() {

                        if (this.loading.save) return;
                        this.loading.save = true;
                        const despachoData = {
                            ...this.despacho,
                            monto: Number(this.despacho.monto || 0),
                            pago_con: Number(this.despacho.pago_con || 0),
                            cajas_entregar: Number(this.despacho.cajas_entregar || 0),
                            observacion_cajas: (this.despacho.observacion_cajas || '').trim(),
                            observacion_pago: (this.despacho.observacion_pago || '').trim(),
                            entregado: this.despacho.entregado
                        };
                        try {

                            if (
                                this.venta.metodo_pago == 4 &&
                                this.venta.despachado == 1 &&
                                this.venta.cliente.otras_pendientes_credito < 0
                            ) {
                                await swal.fire({
                                    title: 'Advertencia',
                                    text: 'El cliente ya tiene otra venta a crédito con saldo pendiente. No se puede despachar una nueva entrega.',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar'
                                });
                                return;
                            }

                            const pendienteTotal = Number(this.venta.pendiente_total);
                            const pagoCon = despachoData.pago_con;


                            if (
                                this.venta.metodo_pago == 1 &&
                                pendienteTotal > pagoCon
                            ) {
                                await swal.fire({
                                    title: 'Advertencia',
                                    text: 'El monto a pagar no puede ser menor al total pendiente en ventas al CONTADO',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar'
                                });
                                return;
                            }

                            // if (
                            //     this.despacho.entregado != 2
                            // ) {
                            //     await swal.fire({
                            //         title: 'Advertencia',
                            //         text: 'Debe marcar la venta como entregado',
                            //         type: 'warning',
                            //         confirmButtonText: 'Aceptar'
                            //     });
                            //     return;
                            // }


                            if (!this.arqueo || !this.arqueo.id) {
                                await swal.fire({
                                    title: 'Error',
                                    text: 'No se encontró una caja activa abierta para despachar.',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar',
                                    confirmButtonClass: 'btn btn-danger',
                                });
                                return;
                            }

                            const payload = {
                                ...despachoData,
                                arqueo: this.arqueo,
                                venta: this.venta
                            };

                            let res = await axios.post("{{ url('api/entregas-venta') }}", payload);
                            this.ConsultarFecha();
                            $('#modalDesapacho').modal('hide');

                            const {
                                url_pdf_cobranza,
                                url_pdf_cajas,
                                url_pdf_cajas_chofer
                            } = res.data || {};

                            const actionButtons = [];

                            if (despachoData.pago_con > 0 && url_pdf_cobranza) {
                                actionButtons.push(`
                                    <a href="${url_pdf_cobranza}" target="_blank" rel="noopener" class="btn btn-primary w-100">
                                        <i class="fa fa-print"></i> Cobranza (venta)
                                    </a>
                                `);
                            }

                            if (despachoData.cajas_entregar > 0 && url_pdf_cajas) {
                                actionButtons.push(`
                                    <a href="${url_pdf_cajas}" target="_blank" rel="noopener" class="btn btn-info w-100">
                                        <i class="fa fa-print"></i> Cajas (admin)
                                    </a>
                                `);
                            }

                            if (despachoData.cajas_entregar > 0 && url_pdf_cajas_chofer) {
                                actionButtons.push(`
                                    <a href="${url_pdf_cajas_chofer}" target="_blank" rel="noopener" class="btn btn-success w-100">
                                        <i class="fa fa-print"></i> Cajas (chofer)
                                    </a>
                                `);
                            }

                            const columnClass = actionButtons.length === 1 ? 'col-12' : actionButtons.length === 2 ?
                                'col-6' : 'col-4';

                            const buttonsHtml = actionButtons.length ?
                                `<div class="row g-2">${actionButtons.map(btn => `<div class="${columnClass}">${btn}</div>`).join('')}</div>` :
                                '<p class="text-center mb-0">No se generaron documentos.</p>';

                            swal.fire({
                                title: 'Venta despachada correctamente',
                                type: 'success',
                                html: `
                                    ${buttonsHtml}
                                    <div class="mt-3 text-center">
                                        <button id="btn-cerrar" class="btn btn-danger w-50">Cerrar</button>
                                    </div>
                                `,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: true,
                                padding: '2em',
                                didOpen: () => {
                                    document.getElementById('btn-cerrar')?.addEventListener('click',
                                        (e) => {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            swal.close();
                                            // Mostrar un swal de confirmación
                                            // swal.fire({
                                            //     title: 'Confirmación',
                                            //     text: '¿Estás seguro de cerrar la ventana?',
                                            //     type: 'warning',
                                            //     showCancelButton: true,
                                            //     confirmButtonText: 'Sí, cerrar',
                                            //     cancelButtonText: 'No, mantener abierta',
                                            // }).then((result) => {
                                            //     if (result.isConfirmed) {
                                            //         // Si el usuario confirma, cerramos el swal original
                                            //         swal.close();
                                            //     }
                                            // });
                                        });
                                },

                                onOpen: (el) => {
                                    el.querySelector('#btn-cerrar')?.addEventListener('click', (
                                        e) => {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        swal.close();
                                        // Mostrar un swal de confirmación
                                        // swal.fire({
                                        //     title: 'Confirmación',
                                        //     text: '¿Estás seguro de cerrar la ventana?',
                                        //     type: 'warning',
                                        //     showCancelButton: true,
                                        //     confirmButtonText: 'Sí, cerrar',
                                        //     cancelButtonText: 'No, mantener abierta',
                                        // }).then((result) => {
                                        //     if (result.isConfirmed) {
                                        //         // Si el usuario confirma, cerramos el swal original
                                        //         swal.close();
                                        //     }
                                        // });
                                    });
                                }

                            });

                        } catch (e) {
                            swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error al procesar el despacho.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger',
                            });
                        } finally {
                            this.loading.save = false;
                            this.despacho = {
                                formapago_id: 1,
                                pago_con: 0,
                                monto: this.despacho.monto,
                                cambio: 0,
                                cajas_entregar: 0,
                                observacion_cajas: '',
                                observacion_pago: '',
                                entregado: false,
                                arqueo: null,
                                venta: null
                            };
                        }
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get(path)
                            return res.data
                        } catch (e) {
                            console.error('Error en GET_DATA', e)
                        }
                    },
                    async load() {
                        try {
                            let self = this
                            try {
                                await Promise.all([
                                    self.GET_DATA("{{ url('api/caja-activa-usuario') }}/" + self.user.id +
                                        '/' + self.sucursal.id),
                                    self.GET_DATA("{{ url('api/cajas-usuario') }}/" + self.user.id + '-' +
                                        self.sucursal.id),
                                    self.GET_DATA("{{ url('api/formapagos') }}"),
                                    self.GET_DATA("{{ url('api/tipopagos') }}"),
                                ]).then(([arqueo, cajas, formapagos, tipopagos]) => {
                                    self.arqueo = arqueo;
                                    self.cajas = cajas;
                                    self.formapagos = formapagos;
                                    self.tipopagos = tipopagos || [];
                                });
                            } catch (e) {}
                        } catch (e) {}
                    },
                    async ConsultarFecha() {
                        if (this.loading.consultar) return; // Evita doble click
                        this.loading.consultar = true;
                        let self = this
                        block.block();
                        dt.destroy()
                        try {
                            let data = {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin
                            }
                            let res = await axios.post("{{ url('api/entregasFecha') }}", data).then((v) => {
                                self.ventas = v.data
                            })
                            dt.create()
                        } catch (error) {} finally {
                            this.loading.consultar = false;
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
                                    let url = "{{ url('api/ventas') }}/" + id
                                    await axios.delete(url)
                                    self.ConsultarFecha()
                                } catch (e) {}
                            }
                        })
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        let user = localStorage.getItem('AppUser')
                        let sucursal = localStorage.getItem('AppSucursal')
                        if (user) {
                            self.user = JSON.parse(user)
                        }
                        if (sucursal) {
                            self.sucursal = JSON.parse(sucursal)
                        }
                        block.block();
                        dt.destroy();
                        dt.create();
                        try {
                            const tieneCaja = await self.checkCajaActiva()
                            await Promise.all([self.load()])
                            const hoyLP = this.hoyEnZona();
                            this.fecha_inicio = hoyLP;
                            this.fecha_fin = hoyLP;
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
            .custom-checkbox-label {
                display: flex;
                flex-direction: column;
                align-items: center;
                font-size: 16px;
                cursor: pointer;
                gap: 6px;
            }

            .custom-checkbox {
                width: 28px;
                height: 28px;
                accent-color: #28a745;
                cursor: pointer;
            }
        </style>
    @endslot
@endcomponent
