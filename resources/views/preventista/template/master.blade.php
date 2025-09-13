<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('/preventista-assets/img/logo.svg') }}">
    <title>EDP</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/preventista-assets/vendor/slick/slick.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/preventista-assets/vendor/slick/slick-theme.min.css') }}" />
    <!-- Icofont Icon-->
    <link href="{{ asset('/preventista-assets/vendor/icons/icofont.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/preventista-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/preventista-assets/css/style.css') }}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{ asset('/preventista-assets/vendor/sidebar/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        #map {
            height: 280px;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        th {
            font-size: 10px !important;

            text-transform: uppercase;
        }

        .form-group label {
            text-transform: uppercase !important;
            font-weight: bold;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border: 1px solid #bfc9d4;
            color: #3b3f5c !important;
            font-size: 15px;
            /* padding: 8px 10px; */
            letter-spacing: 1px;
            background-color: #fff;
            height: 35px;
            padding: .375rem .75rem;
            border-radius: 6px;
            box-shadow: none;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #515365;
            color: #3b3f5c;
            font-size: 15px;
            padding: 5px;
            letter-spacing: 1px;
            font-weight: 700;
            border-radius: 4px;
        }

        .select2-results__option {
            padding: 10px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2.mb-4 {
            margin-bottom: 10px !important;
        }





        .modal-body {
            padding: 20px;
            font-size: 1rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .fs-4 {
            font-size: 1.25rem !important;
        }

        .form-control-lg {
            font-size: 1.1rem;
            padding: 0.75rem;
        }

        button {
            font-size: 1.2rem;
            padding: 10px;
        }

        button:hover {
            background-color: #28a745;
        }

        .modal-footer {
            margin-top: 1rem;
        }

        .card-header .btn {
            font-size: 1.25rem;
            padding: 12px;
        }

        .card-header .btn svg {
            width: 24px;
            height: 24px;
        }

        .card-header .btn .d-flex {
            justify-content: space-between;
            align-items: center;
        }

        .task-completed .badge {
            font-size: 1rem;
            font-weight: bold;
            padding: 0.8rem 1.2rem;
        }
    </style>

    <style>
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="fixed-bottom-padding">
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>

    <!-- home page -->
    <div class="osahan-home-page">
        <div class="shadow-sm bg-primary p-3 fixed-top">
            <div class="title d-flex align-items-center ">
                <a href="{{ url('/preventista/home') }}"
                    class="text-decoration-none text-dark d-flex align-items-center">
                    <img class="osahan-logo me-2" src="{{ asset('/preventista-assets/img/logo.svg') }}" alt="">
                    <h4 class="font-weight-bold text-white m-0">EDP</h4>
                </a>
                <p class="ms-auto m-0">
                    {{-- <a href="notification.html"
                        class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                        <i class="text-dark bi bi-bell-fill"></i>
                        <span class="badge badge-danger p-1 ms-1 small">2</span>
                    </a> --}}
                </p>
                <a class="toggle ms-3 text-white" href="#"><i class="bi bi-list "></i></a>
            </div>

            {{-- <a href="search.html" class="text-decoration-none">
                <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white py-1">
                    <div class="input-group-prepend">
                        <button class="border-0 btn btn-outline-secondary text-success bg-white"><i
                                class="icofont-search"></i></button>
                    </div>
                    <input type="text" class="shadow-none border-0 form-control ps-0"
                        placeholder="Search for Products.." aria-label="" aria-describedby="basic-addon1">
                </div>
            </a> --}}
        </div>

        <div v-if="loading" class="loader-overlay">
            <div class="spinner"></div>
        </div>
        <div v-if="!loading" class="osahan-body" style="margin-top: 60px" id="appEntrega">
            {{ $body }}
        </div>
    </div>
    <!-- Footer -->
    @component('preventista.template.base.botton-nav')
    @endcomponent
    <nav id="main-nav">
        <ul class="second-nav">
            <li class="list-group-item">
                <a href="{{ url('/preventista/preventa') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/delivery.svg') }}" alt="Preventa"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Preventa</span>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/preventista/cliente') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/clientes.svg') }}" alt="Clientes"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Clientes</span>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/preventista/entrega') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/entrega.png') }}" alt="Entregas"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Entregas</span>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/preventista/caja') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/caja.png') }}" alt="Caja"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Caja</span>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/preventista/productoPrecio') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/precios.png') }}" alt="Precios"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Precios</span>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/preventista/backupRestore') }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/preventista-assets/svg/backup.png') }}" alt="Backup"
                        style="width:24px; height:24px;" class="me-2">
                    <span>Backup BD</span>
                </a>
            </li>
        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a href="{{ route('preventista.home') }}"
                    class="small col text-decoration-none p-2 {{ Route::currentRouteName() == 'preventista.home' ? 'selected' : '' }}">
                    <p class="h5 m-0"><i class="icofont-home"></i></p>
                    Inicio
                </a>
            </li>
            <li class="github">
                <a href="{{ url('/preventista/entrega') }}"
                    class="small col text-decoration-none p-2 {{ Request::is('preventista/entrega') ? 'selected' : '' }}">
                    <p class="h5 m-0"><i class="icofont-fast-delivery"></i></p>
                    Entregas
                </a>
            </li>
            <li class="ko-fi">
                <a href="{{ url('/preventista/caja') }}"
                    class="small col text-decoration-none p-2 {{ Request::is('preventista/caja') ? 'selected' : '' }}">
                    <p class="h5 m-0"><i class="icofont-money"></i></p>
                    Caja
                </a>
            </li>
            <li class="ko-fi">
                <a href="{{ url('preventista/auth/login') }}" class="small col text-decoration-none p-2">
                    <p class="h5 m-0"><i class="icofont-logout"></i></p>
                    Salir
                </a>
            </li>
        </ul>
    </nav>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/preventista-assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/preventista-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- slick Slider JS-->
    <script src="{{ asset('/preventista-assets/vendor/slick/slick.min.js') }}"></script>
    <!-- Sidebar JS-->
    <script src="{{ asset('/preventista-assets/vendor/sidebar/hc-offcanvas-nav.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/blockui/jquery.blockUI.min.js') }}"></script>

    <script src="{{ asset('/preventista-assets/js/osahan.js') }}"></script>
    <script src="{{ asset('/assets/axios.js') }}"></script>
    <script src="{{ asset('/assets/vue/vue.js') }}"></script>
    <script src="{{ asset('/assets/plugins/blockui/custom-blockui.js') }}"></script>
    <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    {{ $script }}
</body>

</html>
