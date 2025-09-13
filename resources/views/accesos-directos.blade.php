@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
        <div class="page-header">
            <div class="page-title">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>Accesos Directos</p>
            </div>

        </div>


    </div>
    <h6><strong class="text-primary">Accesos Directos</strong></h6>
    <div class="row">
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/compras/add">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Nueva Compra</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/add">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Nueva Conslidacion</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/pagar/add">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Pagar Consolidacion</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/tickets/add">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Pagar Compras/Lotes</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./pp/lotes">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Lista de PP</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./pt/lotes">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Lista PT</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <hr>
    </div>
    <div class="row">
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/lista-ave-new">
                    <div class="w-content">
                        <div class="w-info">
                            <p class="">Consolidación Aves</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content"  href="./almacen/consilodacion/add-ave-new">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Nueva Cons. Aves</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/pagar-ave-new/add">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Pagar Cons. Aves</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./almacen/consilodacion/tickets/add-ave-new">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Pagar Compras Aves</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./entrega/historial">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Entrega de Pedidos</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="widget widget-card-four">
                <a class="widget-content" href="./cajas/apertura-cierre">
                    <div class="w-content">
                        <div class="w-info">

                            <p class="">Apertura/Cierre de Caja</p>
                        </div>
                        <div class="">
                            <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
    </div>
</div>
@endverbatim
@endslot
@slot('script')
<script type="module">
    import Table from "{{asset('config/dt.js')}}"
    import Block from "{{asset('config/block.js')}}"


    const {
        createApp
    } = Vue
    let dt = new Table()
    let block = new Block()
    createApp({
        data() {
            return {
                add: true,
                model: {
                    name: ''
                },
                data: [],
                compras: [],
                lotes: [],
                planillas: [],
                sucursal: {}
            }
        },
        methods: {
            async Save() {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/personas')}}";
                    if (this.add == false) {
                        url = "{{url('api/personas')}}/" + this.model.id
                        let res = axios.put(url, this.model)
                    } else {
                        let res = axios.post(url, this.model)

                    }
                    dt.destroy()
                    await this.load()
                    dt.create()
                } catch (e) {

                }
            },
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
                        await Promise.all([self.GET_DATA("{{url('api/planillas')}}"),
                        self.GET_DATA("{{url('api/lotes')}}"),
                        self.GET_DATA("{{url('api/compras')}}"),
                        ]).then((v) => {
                            self.planillas = v[0]
                            self.lotes = v[1]
                            self.compras = v[2]
                        })

                    } catch (e) {

                    }
                } catch (e) {

                }
            },
            deleteItem(id) {
                let self = this
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success btn-rounded',
                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                    title: 'Estas seguro?',
                    text: "Este cambio es irreversible.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar!',
                    cancelButtonText: 'No!',
                    reverseButtons: true,
                    padding: '2em'
                }).then(async (result) => {
                    if (result.value) {
                        try {

                            const params = new URLSearchParams({});


                            let url = "{{url('api/personas')}}/" + id

                            await axios.delete(url)
                            dt.destroy()
                            await self.load()
                            dt.create()
                        } catch (e) {

                        }
                    }
                })
            }
        },
        mounted() {
            this.$nextTick(async () => {
                let self = this
                block.block();
                try {
                    let sucursal = localStorage.getItem('AppSucursal')
                    this.sucursal = JSON.parse(sucursal)
                    await Promise.all([self.load()]).then((v) => {

                    })
                } catch (e) {

                } finally {
                    block.unblock();
                }
                // do whatever you want if console is [object object] then stringify the response




            })
        }
    }).mount('#meApp')
</script>
@endslot
@endcomponent
