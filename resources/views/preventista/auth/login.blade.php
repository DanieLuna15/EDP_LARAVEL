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
                        <input placeholder="Ingresar Password" type="password" v-model="model.password" class="form-control"
                            id="exampleInputPassword1">
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
            const { createApp } = Vue;
            let block = new Block();
            createApp({
                data() {
                    return {
                        model: {
                            email: '',
                            password: '',
                            usuario:''
                        }
                    };
                },
                methods: {
                    async Save() {
                        try {
                            let self = this;
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/login') }}";
                            let res = await axios.post(url, this.model);
                            if (res.data.success=="true") {
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
