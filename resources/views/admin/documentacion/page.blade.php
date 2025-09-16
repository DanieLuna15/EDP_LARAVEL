<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - FAQ Landing Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/assets/css/pages/faq/faq.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <script src="{{ asset('assets/vue/vue.js') }}"></script>
    <script src="{{ asset('assets/axios.js') }}"></script>
</head>

<body class="sidebar-noneoverflow">

    <div class="fq-header-wrapper">
        <nav class="navbar navbar-expand">
            <div class="container">
                <a class="navbar-brand" href="index.html">EDP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center order-md-0 order-1">
                    <h1 class="">Documentacion</h1>
                    <p class="">Documentacion y funcionamiento de los modulos del sistema</p>
                </div>
            </div>
        </div>
    </div>
    @verbatim
        <div class="faq container">
            <div class="faq-layouting layout-spacing" id="meApp">
                <div class="fq-tab-section">
                    <div class="row">
                        <div class="col-md-12 mb-5 mt-5">
                            <h2>Documentacion</h2>
                            <div class="accordion" id="accordionExample">
                                <template v-for="m in data">
                                    <div class="card">
                                        <div class="card-header" :id="'fqheadingOne' + m.id">
                                            <div class="mb-0" data-toggle="collapse" role="navigation"
                                                :data-target="'#fqcollapseOne' + m.id" aria-expanded="false"
                                                aria-controls="fqcollapseOne">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-code">
                                                    <polyline points="16 18 22 12 16 6"></polyline>
                                                    <polyline points="8 6 2 12 8 18"></polyline>
                                                </svg> <span class="faq-q-title">{{ m . name }}</span>

                                            </div>
                                        </div>
                                        <div :id="'fqcollapseOne' + m.id" class="collapse" aria-labelledby="fqheadingOne"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>{{ m . descripcion }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endverbatim


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/assets/js/pages/faq/faq.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script type="module">
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    add: true,
                    model: {
                        name: '',
                        descripcion: ''
                    },
                    data: []
                }
            },
            methods: {
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
                            await Promise.all([self.GET_DATA("{{ url('api/documentacions') }}")]).then((v) => {
                                self.data = v[0]
                            })
                        } catch (e) {
                        }
                    } catch (e) {
                    }
                },
            },
            mounted() {
                this.$nextTick(async () => {
                    let self = this
                    try {
                        await Promise.all([self.load()]).then((v) => {
                        })
                    } catch (e) {
                    } finally {
                    }
                    // do whatever you want if console is [object object] then stringify the response
                })
            }
        }).mount('#meApp')
    </script>
</body>

</html>
