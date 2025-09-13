@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Informacion General</h6>
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nombres</label>
                                                <input v-model="model.nombre" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Apellidos</label>
                                                <input v-model="model.apellidos" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">


                                            <div class="form-group ">
                                                <label>Documentos</label>
                                                <select v-model="model.documento_id" class="form-control">

                                                    <option v-for="m in documentos" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">N° Doc</label>
                                                <input type="text" v-model="model.doc" class="form-control mb-4" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Dirección</label>
                                                <input type="text" v-model="model.direccion" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Cargo</label>
                                                <input type="text" v-model="model.cargo" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Telefono</label>
                                                <input type="text" v-model="model.telefono" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Telefono Coorporativo</label>
                                                <input type="text" v-model="model.tel_cor" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Garante</label>
                                                <input type="text" v-model="model.garante" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Celular Garante</label>
                                                <input type="text" v-model="model.cel_garante" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Direccion Garante</label>
                                                <input type="text" v-model="model.dir_garante" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">


                                            <div class="form-group ">
                                                <label>Activo</label>
                                                <select v-model="model.inactivo" class="form-control">

                                                    <option :value="1">ACTIVO</option>
                                                    <option :value="2">INACTIVO</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-danger w-100" @click="back()">Regresar</button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success w-100" @click="Save()" :disabled="isSubmitting">
                                                <span v-if="isSubmitting"><i class="fa fa-spinner fa-spin"></i> Guardando...</span>
                                                <span v-else>Guardar</span>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-primary w-100" @click="SaveContrato()"
                                                :disabled="isSubmittingContrato">
                                                <span v-if="isSubmittingContrato"><i class="fa fa-spinner fa-spin"></i>
                                                    Guardando...</span>
                                                <span v-else>Guardar / Contrato</span>
                                            </button>
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
                        isSubmitting: false,
                        isSubmittingContrato: false,
                        model: {
                            inactivo: 1,
                            nombre: '',
                            apellidos: '',
                            documento_id: '',
                            doc: '',
                            cargo: '',
                            telefono: '',
                            direccion: '',
                            garante: '',
                            dir_garante: '',
                            cel_garante: '',
                        },
                        documentos: []
                    }
                },

                methods: {
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async Save() {
                        this.isSubmitting = true;
                        block.block();

                        try {
                            let res = await axios.post("{{ url('api/personas') }}", this.model);

                            if (res.data.success) {
                                sessionStorage.setItem('success_message', res.data.success);
                                window.location.href = "{{ url('admin/personal/persona') }}";
                            }
                        } catch (e) {
                            if (e.response) {
                                const response = e.response.data;
                                let errorList = '';

                                if (response.errors) {
                                    errorList = Object.values(response.errors).map(err => `<li>${err[0]}</li>`)
                                        .join('');
                                } else if (response.error) {
                                    errorList = Object.values(response.error).map(err => `<li>${err[0]}</li>`).join(
                                        '');
                                } else if (response.message) {
                                    errorList = `<li>${response.message}</li>`;
                                }

                                swal({
                                    title: 'Errores de validación',
                                    html: `<ul style="text-align:left;">${errorList}</ul>`,
                                    type: 'warning',
                                    button: 'Aceptar',
                                    dangerMode: true,
                                });
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: 'No se pudo conectar con el servidor.',
                                    type: 'error',
                                    button: 'Aceptar'
                                });
                            }
                        } finally {
                            this.isSubmitting = false;
                            block.unblock();
                        }
                    },


                    async SaveContrato() {
                        this.isSubmittingContrato = true;
                        block.block();
                        try {
                            let res = await axios.post("{{ url('api/personas') }}", this.model);

                            if (res.data.success) {
                                window.location.href = "{{ url('rrhh/contratos/add') }}";
                            }
                        } catch (e) {
                            if (e.response) {
                                const response = e.response.data;
                                let errorList = '';

                                if (response.errors) {
                                    errorList = Object.values(response.errors).map(err => `<li>${err[0]}</li>`)
                                        .join('');
                                } else if (response.error) {
                                    errorList = Object.values(response.error).map(err => `<li>${err[0]}</li>`).join(
                                        '');
                                } else if (response.message) {
                                    errorList = `<li>${response.message}</li>`;
                                }

                                swal({
                                    title: 'Errores de validación',
                                    html: `<ul style="text-align:left;">${errorList}</ul>`,
                                    type: 'warning',
                                    button: 'Aceptar',
                                    dangerMode: true,
                                });
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: 'No se pudo conectar con el servidor.',
                                    type: 'error',
                                    button: 'Aceptar'
                                });
                            }
                        } finally {
                            this.isSubmittingContrato = false;
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



                            await Promise.all([self.GET_DATA('documentos')]).then((v) => {
                                self.documentos = v[0]
                            })
                            if (self.documentos.length) {
                                self.model.documento_id = self.documentos[0].id
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
@endcomponent
