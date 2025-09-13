@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row">
        <div class="col-sm-4 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Precio Venta</span>
                                </div>
                                <input type="text" v-model="model.precio_venta" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Peso Total</span>
                                </div>
                                <input type="text" v-model="model.valor_peso" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Compra</span>
                                </div>
                                <input type="text" v-model="model.valor_compra" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Valor Venta</span>
                                </div>
                                <input type="text" v-model="model.valor_venta" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Cajas</span>
                                </div>
                                <input type="text" v-model="model.cajas" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Pollos</span>
                                </div>
                                <input type="text" v-model="model.pollos" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-12">
            <div class="row">
                <div class="col-lg-12 col-12 layout-spacing" v-for="m in model.lote_detalles">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area border-tab px-2">
                            <h4>{{m.name}}</h4>

                            <ul class="nav nav-tabs mt-3" id="border-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="border-home-tab" data-toggle="tab" href="#border-home" role="tab" aria-controls="border-home" aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="border-profile-tab" data-toggle="tab" href="#border-profile" role="tab" aria-controls="border-profile" aria-selected="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="border-contact-tab" data-toggle="tab" href="#border-contact" role="tab" aria-controls="border-contact" aria-selected="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content mb-4" id="border-tabsContent">
                                <div class="tab-pane fade active show" id="border-home" role="tabpanel" aria-labelledby="border-home-tab">
                                   <div class="row">
                                    <div class="col-4">
                                    <img :src="url+'/img/pollo.jpg'" alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-8">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-dark text-white">TOTAL DE POLLOS</td>
                                                    <td> <strong>{{Number(m.equivalente).toFixed(2)}}</strong></td>
                                                    <td class="bg-dark text-white">PESO X POLLO(Kg)</td>
                                                    <td><strong>{{Number(m.peso_total/m.equivalente).toFixed(2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-dark text-white">TOTAL CAJAS</td>
                                                    <td><strong>{{Number(m.cajas).toFixed(2)}}</strong></td>
                                                    <td class="bg-dark text-white">PESO POR CAJA(Kg)</td>
                                                    <td><strong>{{Number(m.peso_total/m.cajas).toFixed(2)}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-dark text-white">PESO TOTAL(Kg)</td>
                                                    <td><strong>{{Number(m.peso_total).toFixed(2)}}</strong></td>
                                                    <td class="bg-primary text-white">VALOR VENTA TOTAL</td>
                                                    <td><strong>Bs {{Number(m.peso_total*model.precio_venta).toFixed(2)}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                <td class="bg-warning text-white">VENTA POR CAJA</td>
                                                    <td > <strong>Bs. {{Number((m.peso_total/m.cajas)*model.precio_venta).toFixed(2)}}</strong></td>
                                                    <td class="bg-warning text-white">VENTA X POLLO</td>
                                                    <td> <strong>Bs. {{Number((m.peso_total/m.equivalente)*model.precio_venta).toFixed(2)}}</strong></td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                   </div>
                                </div>
                                <div class="tab-pane fade" id="border-profile" role="tabpanel" aria-labelledby="border-profile-tab">
                                    <div class="media">
                                        <img class="meta-usr-img mr-3" src="assets/img/profile-32.jpeg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="border-contact" role="tabpanel" aria-labelledby="border-contact-tab">
                                    <p class="dropcap  dc-outline-primary">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{model}}
    </div>
</div>
@endverbatim
@endslot
@slot('script')
<script type="module">
    import TableDate from "{{asset('config/dtdate.js')}}"
    import Block from "{{asset('config/block.js')}}"


    const {
        createApp
    } = Vue
    let dt = new TableDate()
    let block = new Block()
    createApp({
        data() {
            return {
                add: true,
                model: {
                    name: '',
                    lote_detalles:[]
                },
                data: []

            }
        },
        computed: {
            url(){
                return "{{url('')}}"
            }
        },
        methods: {
            async Save() {
                try {
                    // let res = await axios.post(, this.model)
                    const params = new URLSearchParams(this.model);
                    let url = "{{url('api/proveedors')}}";
                    if (this.add == false) {
                        url = "{{url('api/proveedors')}}/" + this.model.id
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
                        await Promise.all([self.GET_DATA("{{url('api/lotes')}}/{{$id}}")]).then((v) => {
                            self.model = v[0]
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


                            let url = "{{url('api/compras')}}/" + id

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
                    await Promise.all([self.load()]).then((v) => {

                    })
                    dt.create()

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
@slot('style')
<style>
    .nav-tabs svg {
        width: 20px;
        vertical-align: bottom;
    }

    .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .nav-tabs .nav-link.active:after {
        color: #e95f2b;
    }

    .nav-tabs {
        border-bottom: 1px solid #ebedf2;
    }

    .nav-tabs .nav-link:hover {
        border-color: #ebedf2 #ebedf2 #f1f2f3;
    }

    .dropdown-menu {
        box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.1);
    }

    .nav-tabs .dropdown-item:hover {
        background-color: #f1f2f3;
        color: #515365;
    }

    .nav-tabs li a.disabled {
        color: #acb0c3 !important;
    }

    .nav-pills .nav-item:not(:last-child) {
        margin-right: 5px;
    }

    .nav-pills .nav-link.active:after {
        color: #fff;
    }

    .nav-pills .nav-link {
        color: #3b3f5c;
    }

    .nav-pills .show>.nav-link {
        background-color: #e95f2b;
    }

    .nav-pills li a.disabled {
        color: #acb0c3 !important;
    }

    h4 {
        font-size: 1.125rem;
    }

    /*
    Simple Tab
*/

    .simple-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .simple-tab .nav-tabs .nav-item.show .nav-link,
    .simple-tab .nav-tabs .nav-link.active {
        color: #1b55e2;
        font-weight: 600;
        background-color: #fff;
    }

    .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .simple-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Simple Pills
*/

    .simple-pills .nav-pills li a {
        color: #3b3f5c;
    }

    .simple-pills .nav-pills .nav-link.active,
    .simple-pills .nav-pills .show>.nav-link {
        background-color: #1b55e2;
        border-color: transparent;
    }

    .simple-pills .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Icon Tab
*/

    .icon-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .icon-tab .nav-tabs svg {
        width: 20px;
        vertical-align: bottom;
    }

    .icon-tab .nav-tabs .nav-item.show .nav-link,
    .icon-tab .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .icon-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    Icon Pill
*/
    .icon-pill .nav-pills li a {
        color: #3b3f5c;
    }

    .icon-pill .nav-pills svg {
        width: 20px;
        vertical-align: bottom;
    }

    .icon-pill .nav-pills .nav-link.active,
    .icon-pill .nav-pills .show>.nav-link {
        background-color: #e2a03f;
        border-color: transparent;
    }

    .icon-pill .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    Underline
*/

    .underline-content .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .underline-content .nav-tabs li a {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .underline-content .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .underline-content .nav-tabs .nav-link.active,
    .underline-content .nav-tabs .show>.nav-link {
        border-color: transparent;
        border-bottom: 1px solid #5c1ac3;
        color: #5c1ac3;
        background-color: transparent;
    }

    .underline-content .nav-tabs .nav-link.active:hover,
    .underline-content .nav-tabs .show>.nav-link:hover,
    .underline-content .nav-tabs .nav-link.active:focus,
    .underline-content .nav-tabs .show>.nav-link:focus {
        border-bottom: 1px solid #5c1ac3;
    }

    .underline-content .nav-tabs .nav-link:focus,
    .underline-content .nav-tabs .nav-link:hover {
        border-color: transparent;
    }


    /*
    Animated Underline
*/

    .animated-underline-content .nav-tabs {
        border-bottom: 1px solid #e0e6ed;
    }

    .animated-underline-content .nav-tabs li a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .animated-underline-content .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .animated-underline-content .nav-tabs .nav-link.active,
    .animated-underline-content .nav-tabs .show>.nav-link {
        border-color: transparent;
        color: #5c1ac3;
    }

    .animated-underline-content .nav-tabs .nav-link:focus,
    .animated-underline-content .nav-tabs .nav-link:hover {
        border-color: transparent;
    }

    .animated-underline-content .nav-tabs .nav-link.active:before {
        -webkit-transform: scale(1);
        transform: scale(1);
    }

    .animated-underline-content .nav-tabs .nav-link:before {
        content: "";
        height: 1px;
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 0;
        background-color: #5c1ac3;
        -webkit-transform: scale(0);
        transform: scale(0);
        transition: all .3s;
    }


    /*
    Justify Tab
*/

    .justify-tab .nav-tabs li a {
        color: #3b3f5c;
    }

    .justify-tab .nav-tabs .nav-item.show .nav-link,
    .justify-tab .nav-tabs .nav-link.active {
        color: #1b55e2;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .justify-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Pill
*/

    .justify-pill .nav-pills li a {
        color: #3b3f5c;
    }

    .justify-pill .nav-pills .nav-link.active,
    .justify-pill .nav-pills .show>.nav-link {
        background-color: #2196f3;
        border-color: transparent;
    }

    .justify-pill .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Centered Tab
*/

    .tab-justify-centered .nav-tabs li a {
        color: #3b3f5c;
    }

    .tab-justify-centered .nav-tabs .nav-item.show .nav-link,
    .tab-justify-centered .nav-tabs .nav-link.active {
        color: #e95f2b;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .tab-justify-centered .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Centered Pill
*/

    .pill-justify-centered .nav-pills li a {
        color: #3b3f5c;
    }

    .pill-justify-centered .nav-pills .nav-link.active,
    .pill-justify-centered .nav-pills .show>.nav-link {
        background-color: #e2a03f;
    }

    .pill-justify-centered .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Right Tab
*/

    .tab-justify-right .nav-tabs li a {
        color: #3b3f5c;
    }

    .tab-justify-right .nav-tabs .nav-item.show .nav-link,
    .tab-justify-right .nav-tabs .nav-link.active {
        color: #1b55e2;
        background-color: #fff;
        border-color: #e0e6ed #e0e6ed #fff;
    }

    .tab-justify-right .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Justify Right Pill
*/

    .pill-justify-right .nav-pills .nav-link.active,
    .pill-justify-right .nav-pills .show>.nav-link {
        background-color: #2196f3;
    }

    .pill-justify-right .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    /*
    With Icons
*/

    .rounded-pills-icon .nav-pills li a {
        -webkit-border-radius: 0.625rem !important;
        -moz-border-radius: 0.625rem !important;
        -ms-border-radius: 0.625rem !important;
        -o-border-radius: 0.625rem !important;
        border-radius: 0.625rem !important;
        background-color: #f1f2f3;
        width: 100px;
        padding: 8px;
    }

    .rounded-pills-icon .nav-pills li a svg {
        display: block;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .rounded-pills-icon .nav-pills .nav-link.active,
    .rounded-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #009688;
    }

    .rounded-pills-icon .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Vertical With Icon
*/

    .rounded-vertical-pills-icon .nav-pills a {
        -webkit-border-radius: 0.625rem !important;
        -moz-border-radius: 0.625rem !important;
        -ms-border-radius: 0.625rem !important;
        -o-border-radius: 0.625rem !important;
        border-radius: 0.625rem !important;
        background-color: #ffffff;
        border: solid 1px #e4e2e2;
        padding: 11px 23px;
        text-align: center;
        width: 100px;
        padding: 8px;
    }

    .rounded-vertical-pills-icon .nav-pills a svg {
        display: block;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .rounded-vertical-pills-icon .nav-pills .nav-link.active,
    .rounded-vertical-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #009688;
        border-color: transparent;

    }


    /*
    Rouned Circle With Icons
*/

    .rounded-circle-pills-icon .nav-pills li a {
        background-color: #f1f2f3;
        padding: 20px 20px;
    }

    .rounded-circle-pills-icon .nav-pills li a svg {
        display: block;
        text-align: center;
    }

    .rounded-circle-pills-icon .nav-pills .nav-link.active,
    .rounded-circle-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #2196f3;
    }

    .rounded-circle-pills-icon .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }


    /*
    Vertical Rounded Circle With Icon
*/
    .rounded-circle-vertical-pills-icon .nav-pills a {
        background-color: #ffffff;
        border: solid 1px #e4e2e2;
        border-radius: 50%;
        height: 58px;
        width: 60px;
        padding: 16px 18px;
        max-width: 80px;
        min-width: auto
    }

    .rounded-circle-vertical-pills-icon .nav-pills a svg {
        display: block;
        text-align: center;
        line-height: 19px;
    }

    .rounded-circle-vertical-pills-icon .nav-pills .nav-link.active,
    .rounded-circle-vertical-pills-icon .nav-pills .show>.nav-link {
        box-shadow: 0px 5px 15px 0px rgba(0, 0, 0, 0.3);
        background-color: #2196f3;
        border-color: transparent;
    }

    /*
    Vertical Pill
*/

    .vertical-pill .nav-pills .nav-link.active,
    .vertical-pill .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Vertical Pill Right
*/

    .vertical-pill-right .nav-pills .nav-link.active,
    .vertical-pill-right .nav-pills .show>.nav-link {
        background-color: #009688;
    }

    /*
    Creative vertical pill
*/

    .vertical-line-pill .nav-pills {
        border-bottom: 1px solid transparent;
        width: 92px;
        border-right: 1px solid #e0e6ed;
    }

    .vertical-line-pill .nav-pills a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .vertical-line-pill .nav-pills .nav-link {
        padding: .5rem 0;
    }

    .vertical-line-pill .nav-pills .nav-link.active,
    .vertical-line-pill .nav-pills .show>.nav-link {
        position: relative;
        background-color: transparent;
        border-color: transparent;
        color: #5c1ac3;
        font-weight: 600;
    }

    .vertical-line-pill .nav-pills .nav-link:focus,
    .vertical-line-pill .nav-pills .nav-link:hover {
        border-color: transparent;
    }

    .vertical-line-pill .nav-pills .nav-link.active:before {
        -webkit-transform: scale(1);
        transform: scale(1);
        bottom: 0;
    }

    .vertical-line-pill .nav-pills .nav-link:before {
        content: "";
        height: 100%;
        position: absolute;
        width: 1px;
        right: -1px;
        background-color: #5c1ac3;
        -webkit-transform: scale(0);
        transform: scale(0);
        transition: all .3s;
    }

    .vertical-line-pill #v-line-pills-tabContent h4 {
        color: #e2a03f;
    }

    .vertical-line-pill #v-line-pills-tabContent p {
        color: #888ea8;
    }

    .media img {
        border-radius: 50%;
        border: solid 5px #ebedf2;
        width: 80px;
        height: 80px;
    }


    /*
    Border Tab
*/

    .border-tab .tab-content {
        border: 1px solid #e0e6ed;
        border-top: none;
        padding: 10px;
    }

    .border-tab .tab-content>.tab-pane {
        padding: 20px 30px 0 30px
    }

    .border-tab .tab-content .media img.meta-usr-img {
        margin-left: -30px;
    }


    /*
    Vertical Border Tab
*/

    .vertical-border-pill .nav-pills {
        width: 92px;
    }

    .vertical-border-pill .nav-pills a {
        padding-top: 15px;
        padding-bottom: 15px;
        position: relative;
    }

    .vertical-border-pill .nav-pills .nav-link {
        padding: .5rem 0;
        border: 1px solid #e0e6ed;
        border-radius: 0;
        border-bottom: none;
    }

    .vertical-border-pill .nav-pills .nav-link:last-child {
        border-bottom: 1px solid #e0e6ed;
    }

    .vertical-border-pill .nav-pills .nav-link.active,
    .vertical-border-pill .nav-pills .show>.nav-link {
        position: relative;
        color: #fff;
        background-color: #8dbf42;
    }


    /*
    Border Top Tab
*/

    .border-top-tab .nav-tabs {
        border-bottom: 1px solid transparent;
    }

    .border-top-tab .nav-tabs li a {
        border-radius: 0px;
        padding: 12px 30px;
        background: #f6f7f8;
        color: #0e1726;
        border-right: 1px solid transparent;
    }

    .border-top-tab .tab-content>.tab-pane {
        padding: 20px 0 0 0;
    }

    .border-top-tab .nav-tabs .nav-item.show .nav-link,
    .border-top-tab .nav-tabs .nav-link.active {
        color: #495057;
        border-radius: 0px;
        padding: 12px 30px;
        background: #f6f7f8;
        color: #5c1ac3;
        border: 1px solid transparent;
        border-top: 2px solid #5c1ac3;
    }

    .border-top-tab .nav-tabs .nav-link:focus,
    .border-top-tab .nav-tabs .nav-link:hover {
        border: 1px solid transparent;
        border-top: 2px solid #5c1ac3;
    }
</style>
@endslot
@endcomponent
