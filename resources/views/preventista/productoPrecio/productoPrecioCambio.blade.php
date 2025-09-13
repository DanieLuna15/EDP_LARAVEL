@component('preventista.template.master', ['title' => 'Precios'])
    @slot('body')
        @verbatim
            <div v-if="!loading" class="osahan-body" id="appPreciosCambios">
                <div class="p-3 osahan-categories">
                    <div class="mb-2">
                        <h6 class="mb-2">Cambio de precios por producto</h6>
                        <div class="row">
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" v-model="fecha_inicio">
                                <input type="date" class="form-control" v-model="fecha_fin">
                            </div>
                            <div class="position-relative">
                                <div class="input-group">
                                    <button class="btn btn-success w-100" @click="ConsultarFecha()">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="data.length == 0" class="text-center text-muted mt-5">
                        No hay cambios de precios para el rango de fechas seleccionado.
                    </div>
                    <div class="row">
                        <div v-for="(m, i) in data" :key="m.id" class="col-lg-4 col-md-6 mb-2">
                            <div class="card shadow-sm rounded">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Cambio #{{ m . id }}</h5>
                                            <p class="card-text"><strong>Fecha:</strong> {{ m . fecha }}
                                                <br><strong>Sucursal:</strong> {{ m . sucursal . nombre }}
                                            </p>
                                        </div>
                                        <div>
                                            <a :href="m.url_pdf" target="_blank"
                                                class="btn badge bg-danger text-white btn-sm me-2"><i
                                                    class="bi bi-file-pdf-fill"></i> PDF</a>
                                            <a href="javascript:void(0)" @click="openModal(m.url_pdf)"
                                                class="btn badge bg-success text-white btn-sm"> <i class="bi bi-whatsapp"></i>
                                                Enviar WhatsApp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Vacío -->
                <div v-if="showModalVacio" class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.4)">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="modalCrud"><i class="bi bi-whatsapp"></i> ENVIAR A WHATSAPP</h5>
                                <button type="button" class="btn-close" @click="showModalVacio = false"><i></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-12">
                                        <label for="inputTelefono" class="form-label fw-bold">TELÉFONO
                                            (+{{ codigo }})
                                        </label>
                                        <input type="text" v-model="model.telfono" class="form-control form-control-lg"
                                            placeholder="ejemplo: 77667766">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                                <button class="btn btn-danger"
                                    style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                    @click="showModalVacio = false">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </button>
                                <button class="btn btn-success"
                                    style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;"
                                    @click="EnviarWhatsapp()">
                                    <i class="bi bi-check-circle"></i> Enviar
                                </button>
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
                        loading: true,
                        showModalVacio: false,
                        add: true,
                        model: {
                            name: '',
                            url: ''
                        },
                        data: [],
                        fecha_inicio: '',
                        fecha_fin: '',
                        codigo: '591'
                    }
                },
                methods: {
                    openModal(url) {
                        this.model.url = url; // Asigna la URL correctamente al modelo
                        this.showModalVacio = true; // Muestra el modal vacío
                    },
                    closeModal() {
                        this.showModalVacio = false;
                    },

                    EnviarWhatsapp() {
                        window.open('https://api.whatsapp.com/send?phone=' + this.codigo + this.model.telfono +
                            '&text=Hola%20le%20envio%20su%20comprobante%20de%20cambio%20de%20precios%20con%20link%20' +
                            this.model.url, '_blank');
                        this.showModal = false; // Cierra el modal después de enviar
                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/proveedors') }}";
                            if (this.add == false) {
                                url = "{{ url('api/proveedors') }}/" + this.model.id
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
                                await Promise.all([self.GET_DATA("{{ url('api/productoPrecioCambiosFecha') }}")])
                                    .then((v) => {
                                        self.data = v[0]
                                    })

                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
                    async ConsultarFecha() {
                        let self = this
                        // dt.destroy()
                        try {
                            let data = {
                                fecha_inicio: this.fecha_inicio,
                                fecha_fin: this.fecha_fin
                            }
                            dt.destroy()
                            let res = await axios.post("{{ url('api/productoPrecioCambiosFecha') }}", data).then((
                                v) => {
                                self.data = v.data
                            })

                            dt.create()

                        } catch (error) {

                        } finally {}
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
                    },
                    EnviarWhatsapp() {
                        window.open('https://api.whatsapp.com/send?phone=' + this.codigo + this.model.telfono +
                            '&text=Hola%20le%20envio%20su%20comprobante%20de%20cambio%20de%20precios%20con%20link%20' +
                            this.model.url, '_blank');
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        this.loading = true;
                        try {
                            // await Promise.all([self.load()]).then((v) => {

                            // })
                            dt.create()
                            this.fecha_fin = new Date().toISOString().substr(0, 10)
                            this.fecha_inicio = new Date().toISOString().substr(0, 10)
                        } catch (e) {

                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    })
                }
            }).mount('#appPreciosCambios')
        </script>
    @endslot
@endcomponent
