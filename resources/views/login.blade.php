<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Inicio de Sesion </title>
    <link rel="icon" type="image/x-icon" href="{{ url('assets/assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ url('assets/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: url("{{ url('img/fondo.jpeg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        #toggle-password {
            cursor: pointer;
            transition: opacity 0.2s;
        }

        #toggle-password:hover {
            opacity: 0.7;
        }
    </style>
    <script src="{{ url('assets/vue/vue.js') }}"></script>
    <script src="{{ url('assets/axios.js') }}"></script>

</head>

<body class="form">
    <div class="form-container outer">
        @verbatim
            <div class="form-form" id="meApp">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">
                            <img :src="imgPollo" alt="" style="width: 25%;">
                            <h1 class="">Iniciar Sesion</h1>
                            <p class="">Ingresa tus credenciales para continuar </p>
                            <div class="text-left">
                                <form class="form">
                                    <div id="username-field" class="field-wrapper input">
                                        <label for="username">Usuario</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <input v-model="model.usuario" id="username" name="username" type="text"
                                            class="form-control" placeholder="Usuario">
                                    </div>
                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                            </rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input v-model="model.password" id="password" name="password" type="password"
                                            class="form-control" placeholder="Password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                            class="feather feather-eye" style="cursor: pointer;" @click="togglePassword">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <button @click="Save()" type="button" class="btn btn-primary"
                                                value="">Iniciar Sesion</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endverbatim
    </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ url('/assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('/assets/assets/js/app.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>

    <script type="module">
        import Table from "{{ url('config/dt.js') }}"
        import Block from "{{ url('config/block.js') }}"
        const {
            createApp
        } = Vue
        let dt = new Table()
        let block = new Block()
        createApp({
            data() {
                return {
                    model: {
                        usuario: '',
                        password: ''
                    }


                }
            },
            computed: {
                imgPollo() {
                    return "{{ url('') }}/img/perfil.jpg"
                },
            },
            methods: {

                async GET_DATA(path) {
                    try {
                        let res = await axios.get("url_path()" + path)
                        return res.data
                    } catch (e) {

                    }
                },
                async Save() {
                    try {
                        let self = this
                        const params = new URLSearchParams(this.model);
                        let url = "{{ url('login') }}";
                        let res = await axios.post(url, this.model);
                        if (res.data.success == "true") {
                            let user = JSON.stringify(res.data.data)
                            let sucursal = res.data.data.sellingpoints_sucursal;
                            localStorage.setItem('AppUser', user);
                            localStorage.setItem('AppSucursal', JSON.stringify(sucursal[0]));
                            // localStorage.setItem('AppSucursal', sucursal[0]);
                            location.href = "{{ url('') }}"
                            //location.href = "{{ url('sucursal') }}"
                        } else {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Error',
                                text: res.data.mensaje,
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                padding: '2em'
                            })
                        }

                    } catch (e) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons({
                            title: 'Error',
                            text: e.response.data.mensaje,
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Ok!',
                            padding: '2em'
                        })
                    }
                },
                togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const toggleIcon = document.getElementById('toggle-password');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.innerHTML = `
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        `;
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.innerHTML = `
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        `;
                    }
                },
            },
            mounted() {
                this.$nextTick(async () => {
                    let self = this
                    try {} catch (e) {} finally {

                    }
                    // do whatever you want if console is [object object] then stringify the response
                })
            }

        }).mount('#meApp')
    </script>

</body>

</html>
