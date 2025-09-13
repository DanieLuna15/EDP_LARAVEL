<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> EDP </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/img/favicon.ico') }}" />
    <link href="{{ asset('assets/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/assets/css/components/custom-list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    @isset($style)
        {{ $style }}
    @endisset
    <style>
        @media (min-width: 992px) {
            .topbar-nav.header nav#topbar ul.menu-categories li.menu>a {
                display: flex;
                padding: 0 15px 0 15px;
                height: 100%;
            }
        }

        .dropdown-menu {
            max-height: 250px !important;
            overflow-y: auto !important;
            z-index: 1050 !important;
        }
    </style>
    <style>
        /* Alinear todo a la izquierda */
        #topbar,
        #topbar .navbar-nav,
        #topbar .menu-categories {
            text-align: left;
        }

        /* Enlaces principales como contenedores flex, chevron a la derecha */
        .menu.single-menu>a.dropdown-toggle {
            display: flex;
            align-items: center;
            gap: .5rem;
            justify-content: flex-start;
            width: 100%;
            padding-right: .75rem;
        }

        /* El bloque con icono + texto debe poder encoger y permitir wrap del texto */
        .menu.single-menu>a.dropdown-toggle>div {
            display: flex;
            align-items: center;
            gap: .5rem;
            min-width: 0;
            /* clave para que el span pueda partirse */
            flex: 1 1 auto;
        }

        /* El texto del label puede ocupar varias líneas y partir palabras largas */
        .menu.single-menu>a.dropdown-toggle span {
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
            line-height: 1.25;
        }

        /* El chevron no se achica y se va a la derecha */
        .menu.single-menu>a.dropdown-toggle .feather {
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Submenús: alinear icono + texto a la izquierda y evitar espacios forzados */
        .submenu>li>a,
        .sub-submenu>li>a {
            display: flex;
            align-items: center;
            gap: .5rem;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
            line-height: 1.25;
            padding-right: .75rem;
            justify-content: flex-start;
        }

        .submenu>li>a .mdi,
        .sub-submenu>li>a .mdi {
            flex-shrink: 0;
            width: 18px;
            min-width: 18px;
            text-align: center;
        }

        .submenu>li>a .feather,
        .sub-submenu>li>a .feather {
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Forzar overrides sobre reglas del tema que usan space-between */
        .topbar-nav.header nav#topbar ul.menu-categories li.menu .submenu li a,
        .topbar-nav.header nav#topbar ul.menu-categories li.menu .submenu li.sub-sub-submenu-list .sub-submenu li a {
            justify-content: flex-start !important;
            gap: .5rem;
        }

        /* Evitar que contenedores flex colapsen el texto */
        .menu.single-menu,
        .submenu,
        .sub-submenu {
            min-width: 0;
        }

        /* Opcional: limitar ancho para un wrap más predecible (ajusta o quita) */
        .menu.single-menu>a,
        .submenu>li>a,
        .sub-submenu>li>a {
            max-width: 320px;
        }
    </style>


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/dropify/dropify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/tables/table-basic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mdi/css/materialdesignicons.min.css') }}">
    <link href="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('assets/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/axios.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <div class="nav-logo align-self-center">
                <a class="navbar-brand" href=""><img alt="logo"
                        src="{{ asset('/assets/assets/img/logo2.svg') }}"> <span
                        class="navbar-brand-name">EDP</span></a>
            </div>

            <ul class="navbar-item flex-row mr-auto">
                <li class="nav-item align-self-center search-animated">
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto"
                                placeholder="Search...">
                        </div>
                    </form>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-search toggle-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </li>
            </ul>

            <ul class="navbar-item flex-row nav-dropdowns">
                <li class="nav-item dropdown language-dropdown more-dropdown" id="showDataSucursal">

                </li>



                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <img src="{{ asset('/assets/assets/img/profile-7.jpeg') }}" class="img-fluid"
                                alt="admin-profile">
                            <div class="media-body align-self-center">
                                <h6 id="user_name"></h6>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp"
                        aria-labelledby="user-profile-dropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> My Profile</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="apps_mailbox.html"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-inbox">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                        <path
                                            d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                        </path>
                                    </svg> Inbox</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="auth_lockscreen.html"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg> Lock Screen</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="javascript:void(0)" onClick="Logout()"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> Sign Out</a>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        @component('components.template.main.head')
        @endcomponent
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content ">
            <div class="layout-px-spacing mt-4" id="meApp">

                {{ $body }}





                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © <?= date('Y') ?> <a target="_blank" href="#">Click
                                Soft</a>, All rights reserved.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-heart">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg></p>
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('/assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/assets/js/app.js') }}"></script>

    <script src="{{ asset('/assets/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script>
        $(document).ready(function() {
            App.init();
            showDataSucursalNavbar()
        });

        function Logout() {
            localStorage.removeItem('AppUser')
            localStorage.removeItem('AppSucursal')
            location.href = "{{ url('login') }}"
        }

        function SucursalChange() {
            localStorage.removeItem('AppSucursal')
            location.href = "{{ url('sucursal') }}"
        }

        function showDataSucursalNavbar() {
            let sucursal = dataSucursalNavbar()
            $("#showDataSucursal").html(sucursal)
        }
        let login = localStorage.getItem('AppUser')
        if (login == null) {
            location.href = "{{ url('login') }}"
        }
        // let sucursal = localStorage.getItem('AppSucursal')
        // if(sucursal==null){
        //     location.href="{{ url('sucursal') }}"
        // }
        let login_user = JSON.parse(login)

        function dataSucursalNavbar() {
            let sucursal = localStorage.getItem('AppSucursal')
            if (sucursal == null) {
                return "";
            }
            let sucursalJson = JSON.parse(sucursal);
            let image = sucursalJson.image != null ? sucursalJson.image.path_url : ''
            return `<div class="dropdown custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="javascript:void(0)" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="${image}" onerror="this.style.display='none'" class="rounded-circle" alt="flag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            ${sucursalJson.nombre}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="customDropdown">
                            <a class="dropdown-item" data-img-value="de" data-value="de" href="javascript:void(0);" onClick="SucursalChange()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                            Cambiar Sucursal
                            </a>

                        </div>
                    </div>`
        }
        $("#user_name").html(login_user.usuario)
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('/assets/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/assets/js/dashboard/dash_2.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{ asset('/assets/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('/assets/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('/assets/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/blockui/custom-blockui.js') }}"></script>
    <script src="{{ asset('/assets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/moment.js') }}"></script>
    <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}"></script>
    {{ $script }}
</body>

</html>
