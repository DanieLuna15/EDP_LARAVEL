@component('preventista.template.master', ['title' => 'Entregas'])
    @slot('body')
        @verbatim
            <div v-if="!loading" class="osahan-body" id="appEntrega">
                <div class="p-3 osahan-categories">
                    <h6 class="mb-2">Entregas pendientes</h6>
                    <div class="row mb-3">
                        <div class="input-group mb-2">
                            <input type="date" class="form-control" v-model="fecha_inicio">
                            <input type="date" class="form-control" v-model="fecha_fin">
                        </div>
                        <div class="position-relative">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar cliente..." v-model="cliente_nombre"
                                    @input="buscarClientes">
                                <button v-if="cliente_nombre" class="btn btn-outline-danger"
                                    @click="limpiarCliente">&times;</button>
                                <button class="btn btn-success" @click="ConsultarFecha" :disabled="loadingButton.consultar">
                                    <span v-if="loadingButton.consultar">Consultando...</span>
                                    <span v-else>Consultar</span>
                                </button>
                            </div>
                            <div class="list-group shadow" v-if="resultados.length && cliente_nombre"
                                style="z-index: 1050 !important; position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 0 0 0.5rem 0.5rem;">
                                <button type="button" class="list-group-item list-group-item-action" v-for="c in resultados"
                                    :key="c.id" @click="seleccionarCliente(c)">
                                    {{ c . nombre }} {{ c . documento . name }} {{ c . doc }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="data.length == 0" class="text-center text-muted mt-5">
                        No hay entregas pendientes para el cliente o rango de fechas seleccionado.
                    </div>
                    <div v-for="(m,i) in data" :key="m.id"
                        :class="['card', 'shadow-sm', 'rounded', 'mb-3', 'px-2', 'py-2', isDarkMode ?
                            'bg-dark text-white border-light' : 'bg-white'
                        ]">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">Pedido #{{ m . id }} - {{ m . cliente . nombre }}

                                </div>
                                <div class="text-muted small">{{ m . fecha }} {{ m . hora }} </div>
                                <span class="badge bg-info text-white me-1" v-if="m.metodo_pago==1">Contado</span>
                                <span class="badge bg-dark text-white me-1" v-if="m.metodo_pago==2">Pago Parcial</span>
                                <span class="badge bg-purple text-white me-1" v-else-if="m.metodo_pago == 3">Crédito</span>
                                <span class="badge bg-warning text-white me-1" v-else>Crédito E.</span>
                                <span class="badge bg-orange text-white" v-if="m.despachado==1"><i class="bi bi-x"></i>
                                    S/Desp.</span>
                                <span class="badge bg-success text-white me-1" v-else><i class="bi bi-check"> </i> Desp.</span>

                            </div>
                            <div class="text-end">
                                <div class="fw-bold fs-5">
                                    <span v-if="m.entregado==1" class="badge badge-danger">N/E<i class="bi bi-x"></i></span>
                                    <span v-else class="badge badge-success">E<i class="bi bi-check"></i></span>
                                    Bs./{{ m . total }}
                                </div>
                                <button
                                    v-if="( m.metodo_pago == 1 || m.metodo_pago == 2 || m.metodo_pago == 3 || m.metodo_pago == 4 || m.despachado == 1)  && m.pendiente_total > 0"
                                    class="btn btn-success btn-sm mt-1" @click="SelectVenta(m)"><i class="bi bi-truck"></i>
                                    Desp./Cobrar</button>
                                <a :href="m.url_3_pdf" target="_blank" class="btn btn-danger btn-sm mt-1"><i
                                        class="bi bi-file-pdf-fill"></i>NDD</a>
                                <a class="btn bg-purple text-white btn-sm mt-1" href="javascript:void(0)"
                                    @click="abrirModalVentasCredito(m.cliente)"><i class="bi bi-credit-card-fill"></i> C. Global</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="ShowModalGlobal" class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.4)">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="modalCrud">
                                    Saldos pendientes de:
                                    <span v-if="clienteActual">
                                        <strong>{{ clienteActual . nombre }}</strong>
                                    </span>
                                </h5>
                                <button type="button" class="btn-close" @click="ShowModalGlobal = false"></button>
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
                                        <table v-if="!showCreditoError" class="table table-hover non-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Fecha</th>
                                                    <th>Monto Pendiente</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(venta, index) in ventasCreditoCliente" :key="venta.id">
                                                    <td style="align-content: center; text-align: center;">
                                                        <input type="checkbox" :value="venta.id" v-model="ventasSeleccionadas"
                                                            @change="actualizarSuma()">
                                                    </td>
                                                    <td class="fs-6">{{ venta . fecha }}</td>
                                                    <td class="fs-6">{{ venta . pendiente_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Total Calculado</label>
                                            <input type="text" class="form-control form-control-lg" v-model="totalPagar"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Total a Pagar</label>
                                            <input type="text" class="form-control form-control-lg"
                                                v-model="totalPagarEditable">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Forma de Pago</label>
                                            <select class="form-control form-control-lg"v-model="formapagoGlobal">
                                                <option disabled value="">Selecciona una forma de pago</option>
                                                <option v-for="f in formapagos" :value="f.id">{{ f . name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger"
                                    style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                    @click="ShowModalGlobal = false">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                </button>
                                <button type="button" class="btn btn-success"
                                    style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;"
                                    @click="confirmarPago" :disabled="loadingButton.cobrar || showCreditoError">
                                        <i class="bi bi-check-circle"></i>
                                    <span v-if="loadingButton.cobrar">Procesando...</span>
                                    <span v-else>Confirmar Pago</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="showModal" class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.4)">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title"><i class="bi bi-truck"></i> DESPACHAR PEDIDO</h5>
                                <button type="button" class="btn-close" @click="showModal=false"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row gy-3">
                                    <!-- Total -->
                                    <div class="col-6">
                                        <div class="bg-light rounded p-3">
                                            <small class="text-muted">TOTAL:</small><br>
                                            <strong class="fs-4">Bs./{{ venta . total }}</strong>
                                        </div>
                                    </div>
                                    <!-- Total Pagado -->
                                    <div class="col-6">
                                        <div class="bg-light rounded p-3">
                                            <small class="text-muted">TOTAL PAGADO:</small><br>
                                            <strong class="fs-4">Bs./{{ venta . pagado_total }}</strong>
                                        </div>
                                    </div>
                                    <!-- Total Pendiente -->
                                    <div class="col-6">
                                        <div class="bg-light rounded p-3">
                                            <small class="text-muted">TOTAL PENDIENTE:</small><br>
                                            <strong class="fs-4">Bs./{{ venta . pendiente_total }}</strong>
                                        </div>
                                    </div>
                                    <!-- Total Cajas -->
                                    <div class="col-6">
                                        <div class="bg-light rounded p-3">
                                            <small class="text-muted">CAJAS VENTA:</small><br>
                                            <strong class="fs-4">{{ venta . cajas_venta }}</strong>
                                        </div>
                                    </div>
                                    <!-- Cajas Pendientes -->
                                    <div class="col-6">
                                        <div class="bg-light rounded p-3">
                                            <small class="text-muted">CAJAS PENDIENTES:</small><br>
                                            <strong class="fs-4">{{ venta . cantidad_cajas }}</strong>
                                        </div>
                                    </div>
                                    <!-- Cajas a Entregar -->
                                    <div class="col-6">
                                        <label class="form-label fw-bold">CAJAS / RECIBIR</label>
                                        <input type="number" v-model="despacho.cajas_entregar"
                                            class="form-control form-control-lg" min="1">
                                    </div>
                                    <!-- Tipo de Venta -->
                                    <div class="col-6">
                                        <label class="form-label fw-bold">MÉTODO DE PAGO</label>
                                        <select class="form-control form-control-lg" v-model="venta.metodo_pago">
                                            <option v-for="m in tipopagos" :key="m.id" :value="m.id">
                                                {{ m . name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="entregado" class="custom-checkbox-label">
                                                Entregado
                                                <input type="checkbox" id="entregado" v-model="despacho.entregado"
                                                    :true-value="2" :false-value="0"
                                                    :checked="Number(venta.entregado) === 2"
                                                    :disabled="Number(venta.entregado) === 2" class="custom-checkbox" />
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">FORMA DE PAGO</label>
                                        <select v-model="despacho.formapago_id" class="form-control form-control-lg">
                                            <option v-for="f in formapagos" :value="f.id">{{ f . name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label fw-bold">MONTO</label>
                                        <input type="text" disabled class="form-control form-control-lg"
                                            :value="venta.metodo_pago == 1 ? despacho.monto : venta.pendiente_total"
                                            :disabled="venta.metodo_pago == 3" @input="onMontoInput($event)">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label fw-bold">PAGO CON</label>
                                        <input type="number" v-model="despacho.pago_con" class="form-control form-control-lg">
                                    </div>

                                    <!-- Cambio -->
                                    <div class="col-12 text-end">
                                        <span class="text-muted">CAMBIO:</span>
                                        <h4 class="text-success fs-4"><strong>Bs./{{ cambio }}</strong></h4>
                                    </div>

                                </div>
                                <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                                    <button class="btn btn-danger"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                        @click="showModal = false">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                    <button class="btn btn-success"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;"
                                        @click="Save" :disabled="loadingButton.save">
                                        <i class="bi bi-check-circle"></i>
                                        <span v-if="loadingButton.save">Guardando...</span>
                                        <span v-else>Guardar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalBloqueoCaja" tabindex="-1" role="dialog" aria-hidden="true"
                    data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border border-info">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title w-100 text-white text-center m-0">
                                    <strong>No tienes una caja activa abierta.</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-center">
                                <img :src="imageSrc" alt="Caja no encontrada" class="img-fluid mb-3"
                                    style="max-height: 150px;">
                                <p><strong>No puedes continuar hasta abrir una.</strong></p>
                                <button class="btn btn-success" @click="abrirModalCaja">Abrir Caja</button>
                                <button class="btn btn-success" @click="goHome">Volver al Menú Principal</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalAperturaCaja" tabindex="-1" role="dialog" aria-hidden="true"
                    data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border border-info">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title w-100 text-white text-center m-0"><strong>Aperturar Caja</strong></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-12">
                                        <label for="inputMonto">Monto de Apertura</label>
                                        <input type="number" v-model="model.monto_inicial" class="form-control"
                                            placeholder="100.00" min="0">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputCaja">Cajas Disponibles</label>
                                        <select v-model="model.caja_sucursal_usuario_id" class="form-control">
                                            <option value="" selected disabled>Seleccionar Caja</option>
                                            <option v-for="s in cajas" :value="s.id">{{ s . caja_sucursal . name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;" @click="cerrarModalCaja"><i class="bi bi-x-circle"></i>Cancelar</button>
                                <button class="btn btn-success" style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;" @click="AbrirCajaDesdeVista"><i class="bi bi-x-circle"></i>Abrir Caja</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endverbatim
        @endslot

        @slot('script')
            <script type="module">
                import Block from "{{ asset('config/block.js') }}"
                const {
                    createApp
                } = Vue
                let block = new Block()
                createApp({
                    data() {
                        return {
                            loadingButton: {
                                save: false,
                                cobrar: false,
                                consultar: false,
                            },
                            loading: true,
                            data: [],
                            fecha_inicio: '',
                            fecha_fin: '',
                            clientes: [],
                            cliente_id: '',
                            arqueo: {},
                            user: {},
                            sucursal: {},
                            formapagos: [],
                            despacho: {
                                formapago_id: 1,
                                pago_con: 0,
                                monto: 0,
                                cajas_entregar: 0
                            },
                            venta: {},
                            showModal: false,
                            cliente_nombre: '',
                            resultados: [],
                            ShowModalCaja: false,
                            model: {
                                name: '',
                                sucursal_id: 1,
                                monto_inicial: 0,
                                caja_sucursal_usuario_id: '',
                            },
                            abriendoCaja: false,
                            imageSrc: "{{ asset('/img/pos_caja.png') }}",
                            cajas: [],
                            ventasCreditoCliente: [],
                            ventasSeleccionadas: [],
                            totalPagar: 0,
                            totalPagarEditable: 0,
                            formapagoGlobal: 1,
                            clienteActual: null,
                            showCreditoError: false,
                            ShowModalGlobal: false,
                            tipopagos: [],
                        }
                    },
                    computed: {
                        isDarkMode() {
                            return document.body.classList.contains('dark') || localStorage.getItem('mode') === 'dark';
                        },
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
                        goHome() {
                            window.location.href = '/preventista/home';
                        },
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
                            this.ShowModalGlobal = true;
                            let response = await axios.get(`/api/ventas-credito/${cliente.id}`);
                            this.ventasCreditoCliente = response.data;
                            this.ventasSeleccionadas = this.ventasCreditoCliente.map(venta => venta.id);
                            this.actualizarSuma();
                            this.showCreditoError = (this.ventasCreditoCliente.length === 0);
                        },

                        async confirmarPago() {
                            if (this.loadingButton.cobrar) return;
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
                            this.loadingButton.cobrar = true;
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
                                this.loadingButton.cobrar = false;
                                this.ShowModalGlobal = false;
                            }
                        },

                        onMontoInput(e) {
                            if (this.venta.metodo_pago == 1) {
                                this.despacho.monto = e.target.value;
                            }
                        },

                        abrirModalCaja() {
                            $('#modalAperturaCaja').modal('show');
                        },
                        cerrarModalCaja() {
                            $('#modalAperturaCaja').modal('hide');
                        },

                        async AbrirCajaDesdeVista() {
                            const self = this;
                            this.model.user_id = this.user.id;
                            this.model.sucursal_id = this.sucursal.id;

                            if (!this.model.caja_sucursal_usuario_id) {
                                Swal.fire({
                                    type: 'warning',
                                    title: 'Atención',
                                    text: 'Por favor selecciona una caja para continuar.',
                                    confirmButtonText: 'Aceptar',
                                });
                                return;
                            }
                            this.abriendoCaja = true;
                            try {
                                let res = await axios.post("{{ url('api/arqueos') }}", this.model);
                                if (res.data) {
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Caja Aperturada',
                                        text: 'La caja fue aperturada correctamente.',
                                        confirmButtonText: 'OK'
                                    });

                                    $('#modalBloqueoCaja').modal('hide');
                                    $('#modalAperturaCaja').modal('hide');
                                    await self.checkCajaActiva();
                                }
                            } catch (error) {
                                console.error('Error al aperturar la caja:', error);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'No se pudo aperturar la caja. Intenta nuevamente.',
                                });
                            }
                        },
                        buscarClientes() {
                            if (this.cliente_nombre.length < 2) {
                                this.resultados = [];
                                return;
                            }
                            axios.get(`{{ url('api/filtrarClientes') }}`, {
                                params: {
                                    q: this.cliente_nombre
                                }
                            }).then(res => {
                                this.resultados = res.data;
                            });
                        },

                        seleccionarCliente(cliente) {
                            this.cliente_id = cliente.id;
                            this.cliente_nombre = cliente.nombre + ' ' + cliente.documento.name + ' ' + cliente.doc;
                            this.resultados = [];
                        },
                        limpiarCliente() {
                            this.cliente_id = null;
                            this.cliente_nombre = '';
                            this.resultados = [];
                        },
                        async load() {
                            this.loading = true;

                            let self = this;
                            try {
                                let user = JSON.parse(localStorage.getItem('AppUser'));
                                let sucursal = JSON.parse(localStorage.getItem('AppSucursal'));
                                self.user = user;
                                self.sucursal = sucursal;

                                await Promise.all([
                                    self.GET_DATA("{{ url('api/caja-activa-usuario') }}/" + self.user.id +
                                        '/' + self.sucursal.id),
                                    self.GET_DATA("{{ url('api/cajas-usuario') }}/" + self.user.id + '-' + self
                                        .sucursal.id),
                                    self.GET_DATA("{{ url('api/formapagos') }}"),
                                    self.GET_DATA("{{ url('api/tipopagos') }}"),
                                ]).then(([arqueo, cajas, formapagos, tipopagos]) => {
                                    self.arqueo = arqueo;
                                    self.cajas = cajas;
                                    self.formapagos = formapagos;
                                    self.tipopagos = tipopagos || [];
                                });
                            } catch (e) {
                                self.arqueo = {};
                                console.error('Error al cargar los datos:', e);
                            } finally {
                                this.loading = false;
                                const loader = document.querySelector('.loader-overlay');
                                if (loader && this.loading == false) {
                                    loader.style.display = 'none';
                                }
                            }
                        },

                        async checkCajaActiva() {
                            if (!this.user || !this.sucursal) {
                                console.error("No se encontraron los datos de usuario o sucursal.");
                                return;
                            }
                            try {
                                let res = await axios.get("{{ url('api/caja-activa-usuario-app') }}");
                                if (res.data && res.data.id) {
                                    console.log("Caja activa encontrada:", res.data);
                                    this.arqueo = res.data;
                                    $('#modalBloqueoCaja').modal('hide');
                                } else {
                                    console.log("No hay caja activa.");
                                    $('#modalBloqueoCaja').modal('show');
                                }
                            } catch (e) {
                                console.error('Error al validar caja activa', e);
                                $('#modalBloqueoCaja').modal('show');
                            }
                        },

                        async GET_DATA(path) {
                            try {
                                let res = await axios.get(path);
                                return res.data;
                            } catch (e) {
                                console.error('Error al obtener datos', e);
                            }
                        },
                        async ConsultarFecha() {
                            if (this.loadingButton.consultar) return;
                            if (!this.fecha_inicio || !this.fecha_fin) {
                                swal.fire('Atención', 'Por favor selecciona ambas fechas', 'warning');
                                return;
                            }
                            if (!this.cliente_id) {
                                swal.fire('Atención', 'Por favor selecciona un cliente', 'warning');
                                return;
                            }

                            let user = JSON.parse(localStorage.getItem('AppUser'));
                            if (!user) {
                                swal.fire('Atención', 'No se pudo obtener la información del usuario', 'warning');
                                return;
                            }
                            let userId = user.id;

                            this.loadingButton.consultar = true;
                            block.block();
                            try {
                                let res = await axios.post("{{ url('api/entregasFechaCliente') }}", {
                                    fecha_inicio: this.fecha_inicio,
                                    fecha_fin: this.fecha_fin,
                                    cliente_id: this.cliente_id,
                                    user_id: userId
                                });
                                this.data = res.data.reverse();
                            } finally {
                                block.unblock();
                                this.loadingButton.consultar = false;
                            }
                        },
                        SelectVenta(venta) {
                            this.venta = venta;
                            this.showModal = true;
                            const entregadoNum = Number(venta.entregado);
                            this.despacho.entregado = (entregadoNum === 2) ? 2 : 0;
                            this.despacho = {
                                formapago_id: 1,
                                pago_con: 0,
                                monto: (venta.venta_pago == 1) ? 0 : venta.total,
                                cajas_entregar: 0
                            };
                            this.$nextTick(() => {
                                this.despacho.entregado = (entregadoNum === 2) ? 2 : 0;
                            });
                        },

                        async Save() {
                            if (this.loadingButton.save) return;
                            this.loadingButton.save = true;
                            const despachoData = {
                                ...this.despacho,
                                entregado: this.despacho.entregado // Pasar el valor de entregado
                            };

                            try {
                                if (
                                    this.venta.metodo_pago == 4 &&
                                    this.venta.despachado == 1 &&
                                    this.venta.cliente.otras_pendientes_credito < 0
                                ) {
                                    return swal.fire({
                                        title: 'Advertencia',
                                        text: 'El cliente ya tiene otra venta a crédito con saldo pendiente. No se puede despachar una nueva entrega.',
                                        type: 'warning',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                                const pendienteTotal = Number(this.venta.pendiente_total);
                                const pagoCon = Number(this.despacho.pago_con);


                                if (pagoCon > 0) {
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
                                }

                                if (
                                    this.despacho.entregado != 2
                                ) {
                                    await swal.fire({
                                        title: 'Advertencia',
                                        text: 'Debe marcar la venta como entregado',
                                        type: 'warning',
                                        confirmButtonText: 'Aceptar'
                                    });
                                    return;
                                }
                                if (!this.arqueo || !this.arqueo.id) {
                                    return swal.fire({
                                        title: 'Error',
                                        text: 'No se encontró una caja activa abierta para despachar.',
                                        type: 'warning',
                                        confirmButtonText: 'Aceptar',
                                        confirmButtonClass: 'btn btn-danger',
                                    });
                                }
                                this.despacho.arqueo = this.arqueo;
                                this.despacho.venta = this.venta;
                                let res = await axios.post("{{ url('api/entregas-venta') }}", this.despacho);
                                if (res.data.url_pdf_cobranza && res.data.url_pdf_cajas) {
                                    this.ConsultarFecha();
                                    this.showModal = false;
                                    swal.fire({
                                        title: 'Venta despachada correctamente',
                                        type: 'success',
                                        html: `
                                <div class="row g-2">
                                    <div class="col-4">
                                        <a href="${res.data.url_pdf_cobranza}" target="_blank" rel="noopener" class="btn bg-info text-white w-100">
                                            <i class="fa fa-print"></i> Cobranza (venta)
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="${res.data.url_pdf_cajas}" target="_blank" rel="noopener" class="btn bg-purple text-white w-100">
                                            <i class="fa fa-print"></i> Cajas (admin)
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="${res.data.url_pdf_cajas_chofer}" target="_blank" rel="noopener" class="btn bg-success text-white w-100">
                                            <i class="fa fa-print"></i> Cajas (chofer)
                                        </a>
                                    </div>
                                </div>
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
                                                });
                                            this.showModal = false;
                                        },
                                        onOpen: (el) => {
                                            el.querySelector('#btn-cerrar')?.addEventListener('click', (
                                                e) => {
                                                e.preventDefault();
                                                e.stopPropagation();
                                                swal.close();
                                            });
                                        }
                                    });


                                } else {
                                    swal.fire({
                                        title: 'Error',
                                        text: 'No se pudo generar los PDFs de cobranza y cajas.',
                                        type: 'error',
                                        confirmButtonText: 'Aceptar',
                                        confirmButtonClass: 'btn btn-danger',
                                    });
                                }

                            } catch (e) {
                                swal.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un error al procesar el despacho.',
                                    type: 'warning',
                                    confirmButtonText: 'Aceptar',
                                    confirmButtonClass: 'btn btn-danger',
                                });
                            } finally {
                                this.loadingButton.save = false;
                            }
                        },
                    },
                    mounted() {
                        this.loading = true; // Inicia con loading en true
                        console.log("Cargando datos...");

                        document.addEventListener('click', (e) => {
                            if (!e.target.closest('.position-relative')) {
                                this.resultados = [];
                            }
                        });

                        const hoyLP = this.hoyEnZona();
                        this.fecha_inicio = hoyLP;
                        this.fecha_fin = hoyLP;
                        let user = localStorage.getItem('AppUser')
                        let sucursal = localStorage.getItem('AppSucursal')
                        if (user) {
                            self.user = JSON.parse(user)
                        }
                        if (sucursal) {
                            self.sucursal = JSON.parse(sucursal)
                        }
                        axios.get("{{ url('api/clientes') }}")
                            .then(res => {
                                this.clientes = res.data;
                                console.log("Clientes cargados", this.clientes);
                                this.$nextTick(() => {
                                    $(".select_clientes").select2({
                                        placeholder: "Buscar Cliente",
                                        width: '100%',
                                    }).on("change", (e) => {
                                        this.cliente_id = e.target.value;
                                    });
                                });
                            })
                            .catch(() => {
                                this.clientes = [];
                            })
                        this.load();
                        this.checkCajaActiva();
                    },



                    watch: {
                        loading(newVal) {
                            console.log("Nuevo valor de loading:", newVal);
                        },
                        'model.monto_inicial'(newValue) {
                            console.log("Monto de Apertura actualizado:", newValue);
                            if (newValue === 0) {
                                console.log('El valor se ha restablecido a 0');
                            }
                        }
                    },
                }).mount('#appEntrega')
            </script>
        @endslot
    @endcomponent
