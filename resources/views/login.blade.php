<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Inicio de Sesión</title>

    {{-- No-cache en cliente (complemento; lo serio va en middleware abajo) --}}
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    {{-- CSRF para Axios --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ url('assets/assets/img/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: url("{{ url('img/fondo.jpeg') }}") no-repeat center center / cover;
        }

        #toggle-password {
            cursor: pointer;
            transition: opacity .2s;
        }

        #toggle-password:hover {
            opacity: .7;
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
                            <h1>Iniciar Sesión</h1>
                            <p>Ingresa tus credenciales para continuar</p>

                            <div class="text-left">
                                <!-- Bloquea envío HTML y usa Axios -->
                                <form class="form" @submit.prevent="Save" autocomplete="off" novalidate>
                                    <div id="username-field" class="field-wrapper input">
                                        <label for="username">Usuario</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <input v-model.trim="model.usuario" id="username" name="username" type="text"
                                            class="form-control" placeholder="Usuario" inputmode="email"
                                            autocomplete="username">
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
                                            class="form-control" placeholder="Password" autocomplete="current-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                            class="feather feather-eye" @click="togglePassword">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </div>

                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <!-- type=submit, sin @click -->
                                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- /text-left -->
                        </div>
                    </div>
                </div>
            </div>
        @endverbatim
    </div>

    <script src="{{ url('/assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('/assets/assets/js/app.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>

    <script type="module">
        import Table from "{{ url('config/dt.js') }}";
        import Block from "{{ url('config/block.js') }}";
        const {
            createApp
        } = Vue;

        // Configura CSRF para Axios
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content');

        let dt = new Table();
        let block = new Block();

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
                }
            },
            methods: {
                async Save() {
                    try {
                        const url = "{{ url('login') }}"; // ruta POST login
                        const res = await axios.post(url, this.model, {
                            withCredentials: true
                        });

                        if (res.data?.success === "true" || res.data?.success === true) {
                            const user = res.data.data ?? {};
                            const sucursal = user.sellingpoints_sucursal ?? [];
                            localStorage.setItem('AppUser', JSON.stringify(user));
                            if (sucursal[0]) localStorage.setItem('AppSucursal', JSON.stringify(sucursal[0]));
                            // Redirige a home
                            window.location.replace("{{ url('') }}");
                        } else {
                            this.alertError(res.data?.mensaje || 'Credenciales inválidas');
                        }
                    } catch (e) {
                        const msg = e?.response?.data?.mensaje || 'Error al iniciar sesión';
                        this.alertError(msg);
                    }
                },
                alertError(texto) {
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success btn-rounded',
                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        buttonsStyling: false,
                    });
                    swalWithBootstrapButtons({
                        title: 'Error',
                        text: texto,
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Ok!',
                        padding: '2em'
                    });
                },
                togglePassword() {
                    const input = document.getElementById('password');
                    const icon = document.getElementById('toggle-password');
                    if (!input || !icon) return;
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.innerHTML = `
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    `;
                    } else {
                        input.type = 'password';
                        icon.innerHTML = `
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    `;
                    }
                },
                async logoutIfStaleSession() {
                    // Limpia storages del cliente
                    try {
                        localStorage.clear();
                        sessionStorage.clear();
                    } catch (_) {}

                    // Intenta invalidar sesión del servidor si estás “medio logueado”
                    try {
                        await axios.post("{{ url('logout') }}"); // define esta ruta POST logout en Laravel
                    } catch (_) {
                        /* si no hay sesión, todo bien */ }
                }
            },
            async mounted() {
                // Evita que el navegador cachee esta página en el historial
                if ('caches' in window) {
                    try {
                        const names = await caches.keys();
                        for (const n of names) await caches.delete(n);
                    } catch (_) {}
                }
                await this.logoutIfStaleSession();
            }
        }).mount('#meApp');
    </script>
</body>

</html>
