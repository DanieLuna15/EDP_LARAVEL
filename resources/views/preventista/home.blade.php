@component('preventista.template.master', ['title' => 'Preventista'])
    @slot('body')
        <div class="osahan-home-page">

            <!-- body -->
            <div class="osahan-body">
                <!-- categories -->
                <div class="p-3 osahan-categories">
                    <h6 class="mb-2">Dashboard</h6>
                    <div class="row m-0">
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/preventa') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/delivery.svg') }}"
                                        style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>PREVENTA</strong></p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/cliente') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/clientes.svg') }}"
                                        style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>CLIENTES</strong></p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/entrega') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/entrega.png') }}"
                                        style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>ENTREGAS</strong></p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/caja') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/caja.png') }}" style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>CAJA</strong></p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/productoPrecio') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/precios.png') }}"
                                        style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>PRECIOS</strong></p>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 ps-0 pe-1 py-1">
                            <div class="bg-white shadow-sm rounded text-center  px-2 py-3 ">
                                <a href="{{ url('/preventista/backupRestore') }}"
                                    class="text-decoration-none text-dark d-block w-100 h-100">
                                    <img src="{{ asset('/preventista-assets/svg/backup.png') }}"
                                        style="width: 150px !important;">
                                    <p class="m-0 pt-2 text-muted text-center"><strong>BACKUP BD</strong></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endslot

    @slot('script')
        <script type="module">
            const {
                createApp
            } = Vue;
            createApp({
                data() {
                    return {
                        loading: true,
                    };
                },
                mounted() {
                    this.loading = false;
                    const loader = document.querySelector('.loader-overlay');
                    if (loader) {
                        loader.style.display = 'none';
                    }
                }
            }).mount('#appEntrega');
        </script>
    @endslot
@endcomponent
