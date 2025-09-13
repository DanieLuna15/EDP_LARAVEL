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
                                </svg> Apertura/ Cierre</p>
                        </div>
                        <button v-if="arqueos.length==0" data-toggle="modal" data-target="#exampleModal"
                            @click="add=true,model.name=''" class="btn btn-success">APERTURAR CAJA</button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">APERTURAR CAJA</h5>
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
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Monto de Apertura</label>
                                            <input type="text" v-model="model.monto_inicial" class="form-control"
                                                placeholder="100.00">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Cajas Disponibles</label>
                                            <select name="" id="" v-model="model.caja_sucursal_usuario_id"
                                                class="form-control">
                                                <option value="" selected disabled>Seleccionar Caja</option>
                                                <option v-for="s in data" :value="s.id">{{ s . caja_sucursal . name }}</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button v-if="model.caja_sucursal_usuario_id!=''" @click="Save()" type="button"
                                        data-dismiss="modal" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleIngrespModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">INGRESO / EGRESO</h5>
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
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Motivo </label>
                                            <select name="" id="" v-model="ingreso.cajamotivo_id"
                                                class="form-control">
                                                <option value="" selected disabled>Seleccionar Motivo</option>
                                                <option v-for="s in motivos" :value="s.id">{{ s . name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Monto </label>
                                            <input type="text" v-model="ingreso.monto" class="form-control"
                                                placeholder="100.00" >
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Tipo de movimiento</label>
                                            <select name="" id="" v-model="ingreso.tipo" class="form-control">
                                                <option value="1">INGRESO</option>
                                                <option value="2">EGRESO</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Forma de pago</label>
                                            <select name="" id="" v-model="ingreso.formapago_id"
                                                class="form-control">
                                                <option value="" selected disabled>Seleccionar Forma</option>
                                                <option v-for="s in formapagos" :value="s.id">{{ s . name }}</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button v-if="ingreso.formapago_id!=''" @click="SaveIngreso()" type="button"
                                        data-dismiss="modal" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalCerrarCaja" tabindex="-1" role="dialog" aria-labelledby="modalCerrarCajaLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCerrarCajaLabel">Cerrar Caja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <!-- Monto Inicial -->
                                            <div class="form-group col-md-6">
                                                <label for="monto_inicial">Monto Inicial</label>
                                                <input type="text" id="monto_inicial" class="form-control" v-model="monto_inicial" disabled />
                                            </div>
                                            <!-- Ingresos -->
                                            <div class="form-group col-md-6">
                                                <label for="ingresos">Ingresos</label>
                                                <input type="text" id="ingresos" class="form-control" v-model="ingresos" disabled />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Egresos -->
                                            <div class="form-group col-md-6">
                                                <label for="egresos">Egresos</label>
                                                <input type="text" id="egresos" class="form-control" v-model="egresos" disabled />
                                            </div>
                                            <!-- Ventas -->
                                            <div class="form-group col-md-6">
                                                <label for="ventas">Ventas</label>
                                                <input type="text" id="ventas" class="form-control" v-model="ventas" disabled />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Total Calculado -->
                                            <div class="form-group col-md-6">
                                                <label for="total_calculado">Total Caja</label>
                                                <input type="text" id="total_calculado" class="form-control" :value="Number(total_calculado).toFixed(2)" disabled />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="observacion">Observación</label>
                                                <textarea id="observacion" class="form-control" v-model="observacion"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="monedas">Detalle de Billetaje</label>
                                                <div class="accordion" id="accordionMonedas">
                                                    <div class="card">
                                                        <div class="card-header" id="headingMonedas">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-info w-100 d-flex justify-content-between align-items-center" type="button"
                                                                        data-toggle="collapse" data-target="#collapseMonedas" aria-expanded="true" aria-controls="collapseMonedas">
                                                                    <span>Monedas y Billetes</span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd"
                                                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1
                                                                            .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                                                    </svg>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseMonedas" class="collapse" aria-labelledby="headingMonedas" data-parent="#accordionMonedas">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div v-for="(moneda, index) in monedas" :key="moneda.id" class="col-md-6 mb-3">
                                                                        <div class="d-flex align-items-center border p-2 rounded">
                                                                            <button
                                                                                class="btn btn-light w-100 d-flex align-items-center"
                                                                                type="button"
                                                                                @click="moneda.cantidad = Number(moneda.cantidad || 0) + 1; calcularTotal()"
                                                                                style="padding: 8px;">

                                                                                <div class="d-flex align-items-center w-100">
                                                                                   <img
                                                                                    :src="(moneda.image && moneda.image.path_url) ? moneda.image.path_url : '/img/money-default.png'"
                                                                                    alt="Imagen"
                                                                                    style="width: 130px; height: 50px; object-fit: contain; border-radius: 4px; margin-right: 10px;" />
                                                                                    <div class="text-left">
                                                                                        <div class="font-weight-bold">{{ moneda.name }}</div>
                                                                                        <div>Bs./{{ moneda.valor }}</div>
                                                                                    </div>
                                                                                </div>
                                                                            </button>

                                                                            <input
                                                                                type="number"
                                                                                v-model.number="moneda.cantidad"
                                                                                class="form-control form-control-sm ml-2"
                                                                                style="width: 70px;"
                                                                                min="0"
                                                                                step="1"
                                                                                @input="calcularTotal" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="total_calculado_monedas">Total billetaje</label>
                                                                        <input type="text" id="total_calculado_monedas" class="form-control" v-model="totalMonedas" disabled />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button
                                        type="button"
                                        class="btn btn-success"
                                        @click="guardarCaja"
                                        :disabled="guardandoCaja">
                                        {{ guardandoCaja ? 'Cerrando...' : 'Guardar' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <p class="task-left"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                            <path
                                                d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                            </path>
                                        </svg></p>
                                    <p class="task-completed">
                                        <span>{{ CajaAbierta . caja_sucursal_usuario . caja_sucursal . name }}</span></p>
                                    <p class="task-hight-priority"><span>Bs. {{ Number(BalanceTotal) . toFixed(2) }}</span></p>
                                    <p>
                                        <button v-if="arqueos.length>0" class="btn btn-warning" data-toggle="modal"
                                            data-target="#exampleIngrespModal" @click="ingreso.monto=0,ingreso.motivo=''">INGRESO
                                            / EGRESO</button>
                                    </p>
                                    <p>
                                        <button v-if="arqueos.length>0" class="btn btn-warning" @click="Cerrar">CERRAR
                                            CAJA</button>
                                    </p>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="widget widget-account-invoice-inicio">
                                                <div class="widget-content text-center py-4">
                                                    <h5 class="text-white">Inicial</h5>
                                                    <p class="text-white">Bs. {{ Number(CajaAbierta . monto_inicial) . toFixed(2) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="widget widget-account-invoice-two">
                                                <div class="widget-content text-center py-4">
                                                    <h5 class="text-white">Ingresos</h5>
                                                    <p class="text-white">Bs. {{ Number(TotalIngresos) . toFixed(2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="widget widget-account-invoice-egreso">
                                                <div class="widget-content text-center py-4">
                                                    <h5 class="text-white">Egresos</h5>
                                                    <p class="text-white">- Bs.{{ Number(TotalEgresos) . toFixed(2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-2">
                                            <div class="widget widget-account-ventas">
                                                <div class="widget-content text-center py-4">
                                                    <h5 class="text-white">Ventas</h5>
                                                    <p class="text-white"> Bs.{{ Number(CajaAbierta . monto_total_ventas) . toFixed(2) }}</p>
                                                </div>
                                            </div>
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
            let dt = new Table()
            let block = new Block()
            createApp({
                data() {
                    return {
                        add: true,
                        user: {},
                        sucursal: {},
                        model: {
                            name: '',
                            sucursal_id: 1,
                            monto_inicial: 0,
                            caja_sucursal_usuario_id: '',
                        },
                        data: [],
                        arqueos: [],
                        ingreso: {
                            monto: 0,
                            formapago_id: '',
                            cajamotivo_id: '',
                            tipo: 1
                        },
                        formapagos: [],
                        motivos: [],
                        monedas: [],
                        monto_inicial: 0,
                        ingresos: 0,
                        egresos: 0,
                        ventas: 0,
                        total_calculado: 0,
                        observacion: 'SN',
                        totalMonedas: 0,
                        guardandoCaja: false,
                    }
                },

                computed: {
                    CajaAbierta() {
                        if (this.arqueos.length > 0) {
                            return this.arqueos[0]
                        }
                        return {
                            caja_sucursal_usuario: {
                                caja_sucursal: {
                                    name: 'SIN CAJA APERTURADA'
                                }
                            },
                            monto_inicial: 0,
                            monto_total_ventas: 0,
                            arqueo_ingresos: []
                        }
                    },
                    TotalIngresos() {

                        let ingreso = this.CajaAbierta.arqueo_ingresos.filter((v) => v.tipo == 1)
                        return ingreso.reduce((a, b) => a + Number(b.monto), 0)
                    },
                    TotalEgresos() {

                        let egreso = this.CajaAbierta.arqueo_ingresos.filter((v) => v.tipo == 2)
                        return egreso.reduce((a, b) => a + Number(b.monto), 0)
                    },
                    BalanceTotal() {
                        return (
                            Number(this.TotalIngresos) -
                            Number(this.TotalEgresos) +
                            Number(this.CajaAbierta.monto_inicial) +
                            Number(this.CajaAbierta.monto_total_ventas)
                        );
                    },
                },
                methods: {
                    calcularTotal() {
                        let totalMonedas = 0;
                        this.monedas.forEach(moneda => {
                            if (moneda.cantidad) {
                                totalMonedas += moneda.valor * moneda.cantidad;
                            }
                        });
                        this.totalMonedas = totalMonedas.toFixed(2);
                    },
                    verificarTotal() {
                        if (this.totalMonedas === this.monto_inicial + this.ingresos - this.egresos) {
                            console.log("El total coincide.");
                        } else {
                            console.log("El total no coincide.");
                        }
                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            this.model.user_id = this.user.id
                            this.model.sucursal_id = this.sucursal.id
                            let url = "{{ url('api/arqueos') }}";
                            let res = await axios.post(url, this.model)

                            await this.load()
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Caja Aperturada!',
                                text: "Su Caja fue Aperturada Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',

                            })
                        } catch (e) {

                        }
                    },
                    async Cerrar() {
                        try {
                            this.monto_inicial = Number(this.CajaAbierta.monto_inicial);
                            this.ingresos = Number(this.TotalIngresos);
                            this.egresos = Number(this.TotalEgresos);
                            this.ventas = Number(this.CajaAbierta.monto_total_ventas);
                            this.total_calculado = this.monto_inicial + this.ingresos - this.egresos + this.ventas;

                            this.totalMonedas = '0.00';
                            this.monedas.forEach(m => m.cantidad = '');

                            $('#modalCerrarCaja').modal('show');
                        } catch (e) {
                            console.error('Error abriendo el modal:', e);
                        }
                    },
                    async guardarCaja() {
                        this.guardandoCaja = true;
                        try {
                            let detalle = this.monedas
                                .filter(m => m.cantidad && m.cantidad > 0)
                                .map(m => {
                                    return {
                                        id: m.id,
                                        descripcion: m.name,
                                        valor: m.valor,
                                        cantidad: m.cantidad,
                                        subtotal: parseFloat((m.valor * m.cantidad).toFixed(2))
                                    }
                                });

                            const total = detalle.reduce((acc, item) => acc + item.subtotal, 0);
                            const detalleBilletajeJSON = {
                                detalle: detalle,
                                total: parseFloat(total.toFixed(2))
                            };

                            const algunaMoneda = this.monedas.some(m => Number(m.cantidad) > 0);

                            if (algunaMoneda && parseFloat(this.totalMonedas) !== parseFloat(this.total_calculado)) {
                                Swal.fire({
                                    title: 'Error de validación',
                                    type: 'error',
                                    text: 'El total del billetaje debe coincidir con el Total Calculado.',
                                });
                                this.guardandoCaja = false;
                                return;
                            }

                            const payload = {
                                apertura: 0,
                                detalle_billetaje: total > 0 ? JSON.stringify(detalleBilletajeJSON) : '',
                                observacion: this.observacion
                            };

                            let url = "{{ url('api/arqueos') }}" + "/" + this.CajaAbierta.id;
                            let res = await axios.put(url, payload);

                            await this.load();

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'Caja Cerrada!',
                                text: '¿Deseas ver el reporte de cierre en PDF?',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Ver ticket de cierre',
                                cancelButtonText: 'Cerrar',
                                reverseButtons: true,
                                padding: '2em',
                            }).then(async (result) => {
                                if (result.value && res.data.url_pdf_cierre) {
                                    try {
                                        window.open(res.data.url_pdf_cierre, '_blank');
                                    } catch (e) {
                                        console.error('Error al abrir el PDF', e);
                                    }
                                }
                                $('#modalCerrarCaja').modal('hide');
                            });

                        } catch (error) {
                            console.error("Error al cerrar la caja:", error);
                        } finally {
                            this.guardandoCaja = false;
                        }
                    },


                    async SaveIngreso() {
                        try {
                            // let res = await axios.post(, this.model)

                            this.ingreso.arqueo_id = this.CajaAbierta.id

                            let url = "{{ url('api/arqueoIngresos') }}";
                            let res = await axios.post(url, this.ingreso)


                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Movimiento registrado!',
                                text: "Su Movimiento fue registrado Correctamente.",
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',

                            })
                            await this.load()
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
                                await Promise.all([
                                    self.GET_DATA("{{ url('api/cajas-usuario') }}/" + self.user.id + '-' +
                                        self.sucursal.id),
                                    self.GET_DATA("{{ url('api/arqueos-usuario') }}/" + self.user.id +
                                        '-' + self.sucursal.id),
                                    self.GET_DATA("{{ url('api/formapagos') }}"),
                                    self.GET_DATA("{{ url('api/cajaMotivos') }}"),
                                    self.GET_DATA("{{ url('api/cajaMonedas') }}")

                                ]).then((v) => {

                                   self.data = v[0];
                                    self.arqueos = v[1];
                                    self.formapagos = v[2];
                                    self.motivos = v[3];
                                    self.monedas = v[4];
                                })

                            } catch (e) {

                            }
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


                                    let url = "{{ url('api/cajaSucursals') }}/" + id

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
                        let user = localStorage.getItem('AppUser')
                        if (user) {
                            self.user = JSON.parse(user)
                        }
                        let sucursal = localStorage.getItem('AppSucursal')
                        if (sucursal) {
                            self.sucursal = JSON.parse(sucursal)
                        }
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
            .task-left {
                margin-bottom: 0;
                font-size: 30px;
                color: #1b55e2;
                background: #c2d5ff;
                font-weight: 600;
                border-radius: 50%;
                display: inline-flex;
                height: 150px;
                width: 150px;
                justify-content: center;
                padding: 45px 0px;
                border: 5px solid #fff;
                margin-bottom: 20px;
                -webkit-box-shadow: 0px 0px 8px 2px #e0e6ed;
                box-shadow: 0px 0px 8px 2px #e0e6ed;
            }

            .task-completed {
                font-size: 14px;
                font-weight: 700;
                margin-bottom: 4px;
                color: #009688;
            }

            .task-hight-priority span {
                color: #e7515a;
                font-weight: 700;
            }

            .widget-account-invoice-inicio {
                padding: 22px 19px;
                background: #e2a03f;
                background: linear-gradient(to right, #28a745 0%, #2f384f 100%);
            }

            .widget-account-invoice-two {
                padding: 22px 19px;
                background: #e2a03f;
                background: linear-gradient(to right, #007bff 0%, #2f384f 100%);
            }

            .widget-account-invoice-egreso {
                padding: 22px 19px;
                background: #e2a03f;
                background: linear-gradient(to right, #dc3545 0%, #2f384f 100%);
            }
            .widget-account-ventas {
                padding: 22px 19px;
                background: #e2a03f;
                background: linear-gradient(to right, #ffd560 0%, #2f384f 100%);
            }

            .widget {
                position: relative;
                padding: 0;
                border-radius: 6px;
                border: none;
                border: 1px solid #e0e6ed;
                box-shadow: 0 0 40px 0 rgba(94, 92, 154, .06);
            }
        </style>
    @endslot
@endcomponent
