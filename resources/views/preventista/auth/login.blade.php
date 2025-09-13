@component('preventista.template.auth', ['title' => 'Preventista'])
    @slot('body')
        <div class="osahan-signin" id="app">
            <div class="logo-container">
                <img src="{{ asset('/preventista-assets/svg/delivery.svg') }}" alt="Logo Preventista" class="logo">
            </div>
            <div class="p-3">
                <h2 class="my-0 text-center">EDP</h2>
                <p class="small text-center">Iniciar Sesion</p>
                <div class="">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Email</label>
                        <input placeholder="Ingresar Email" type="email" v-model="model.usuario" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword1">Password</label>
                        <div class="input-group">
                            <input :type="showPassword ? 'text' : 'password'" placeholder="Ingresar Password"
                                v-model="model.password" class="form-control" id="exampleInputPassword1">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" @click="showPassword = !showPassword"
                                    :aria-label="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                                    <span v-if="!showPassword">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </span>
                                    <span v-else>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off">
                                            <path
                                                d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.81 21.81 0 0 1 5.06-7.06">
                                            </path>
                                            <path d="M1 1l22 22"></path>
                                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                            <path d="M9.88 9.88L4.22 4.22"></path>
                                            <path d="M14.12 14.12L19.78 19.78"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="Save()" class="btn btn-success btn-lg rounded w-100">Ingresar</button>
                </div>

            </div>
        </div>
    @endslot

    @slot('script')
        <script type="module">
            import Table from "{{ asset('config/dt.js') }}";
            import Block from "{{ asset('config/block.js') }}";
            const {
                createApp
            } = Vue;
            let block = new Block();
            createApp({
                data() {
                    return {
                        model: {
                            email: '',
                            password: '',
                            usuario: ''
                        },
                        showPassword: false

                    };
                },
                methods: {
                    async Save() {
                        try {
                            let self = this;
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/login') }}";
                            let res = await axios.post(url, this.model);
                            if (res.data.success == "true") {
                                let user = JSON.stringify(res.data.data)
                                localStorage.setItem('AppUser', user);
                                location.href = "{{ url('/preventista/home') }}";
                            } else {
                                const swalWithBootstrapButtons = swal.mixin({
                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                    buttonsStyling: false,
                                });

                                swalWithBootstrapButtons({
                                    title: 'Error',
                                    text: "Credenciales incorrectas.",
                                    type: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok!',
                                    padding: '2em'
                                });
                            }
                        } catch (e) {
                            console.error("Error during login:", e);
                        }
                    },
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this;
                        try {
                            // Puedes agregar lógica adicional si la necesitas.
                        } catch (e) {
                            console.error("Error during mount:", e);
                        } finally {
                            // Puedes hacer alguna limpieza si es necesario.
                        }
                    });
                }
            }).mount('#app');
        </script>
    @endslot
@endcomponent
