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
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Correo</label>
                                                <input v-model="model.correo" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Usuario</label>
                                                <input v-model="model.usuario" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Password</label>
                                                <input v-model="model.password" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <button class="btn btn-danger w-100" @click="back()">Regresar</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-success w-100" @click="Save()">Guardar</button>
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
                        model: {
                            nombre: '',
                            apellidos: '',
                            correo: '',
                            usuario: '',
                            password: '',
                        }
                    }
                },
                methods: {
                    async Save() {
                        this.isSubmitting = true;
                        block.block();
                        try {
                            let res = await axios.put("{{ url('api/users') }}/{{ $id }}", this.model);
                            if (res.data.success) {
                                sessionStorage.setItem('success_message', res.data.success);
                                window.location.href = "{{ url('admin/personal/usuario') }}";
                            }
                        } catch (e) {
                            let errorList = '';
                            const response = e.response?.data || {};
                            if (response.errors || response.error) {
                                const errors = response.errors || response.error;
                                errorList = Object.values(errors).map(err => `<li>${err[0]}</li>`).join('');
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
                        } finally {
                            this.isSubmitting = false;
                            block.unblock();
                        }
                    },
                    back() {
                        window.location.replace(document.referrer);
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        block.block();
                        try {
                            let res = await axios.get("{{ url('api/users') }}/{{ $id }}");
                            this.model = res.data;
                        } catch (e) {
                            swal("Error", "No se pudo cargar el usuario.", "error");
                        } finally {
                            block.unblock();
                        }
                    });
                }

            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
