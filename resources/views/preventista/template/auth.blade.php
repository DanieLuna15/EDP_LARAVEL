<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.svg">
    <title>Grofar - Online Grocery Supermarket HTML Mobile Template</title>
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
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
    </style>

    <style>
        .osahan-signin {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            flex-direction: column;
            padding-top: 40%;
            /* Para pantallas más grandes */
        }

        .osahan-signin .logo-container {
            margin-bottom: 30px;
            text-align: center;
        }

        .osahan-signin .p-3 {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .osahan-signin img.logo {
            width: 120px;
            margin-bottom: 20px;
        }

        .osahan-signin h2,
        .osahan-signin p {
            text-align: center;
        }

        @media (max-width: 768px) {
            .osahan-signin {
                padding-top: 30%;
            }
        }

        @media (min-width: 769px) {
            .osahan-signin {
                padding-top: 15%;
            }
        }
    </style>



</head>

<body>

    <!-- home page -->
    <div class="osahan-home-page">

        <!-- body -->
        {{ $body }}
    </div>
    <!-- Footer -->


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/preventista-assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/preventista-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- slick Slider JS-->
    <script src="{{ asset('/preventista-assets/vendor/slick/slick.min.js') }}"></script>
    <!-- Sidebar JS-->
    <script src="{{ asset('/preventista-assets/vendor/sidebar/hc-offcanvas-nav.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/preventista-assets/js/osahan.js') }}"></script>
    <script src="{{ asset('assets/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/axios.js') }}"></script>
    <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    {{ $script }}
</body>

</html>
