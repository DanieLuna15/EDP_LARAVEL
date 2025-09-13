@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
        <div class="page-header">
            <div class="page-title">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg> Promedio de Merma</p>
            </div>
            <button type="button" class="btn btn-success" @click="Save()">Guardar</button>
        </div>


    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
        <div class="row">
            <div class="col-12">
            <div class="alert alert-warning">
                 <div >
                 <strong >
                Advertencia!
            </strong>Este valor figura en el reporte de seguimiento de PP. Todo Cambio afectara el a ese reporte.
                </div>
            </div>
            </div>
            <div class="col-12">
            <label>Promedio Merma</label>
            <input type="text" class="form-control" v-model="model.promedio"/>
            </div>
        </div>
        </div>
      </div>
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
                        promedio: ''
                    },
                    sucursal:{},
                    data: []

                }
            },
            methods: {
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/promedioMermas')}}";
                        if (this.add == false) {
                            url = "{{url('api/promedioMermas')}}"
                            let res =  await axios.post(url,this.model)
                        }else{
                            let res = await  axios.post(url,this.model)

                        }
                       const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success btn-rounded',
                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                        title: 'Guardado',
                        text: "Se ha guardado los cambios",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Ok!',
                        cancelButtonText: 'No!',
                        reverseButtons: true,
                        padding: '2em'
                    })
                        await this.load()

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
                            await Promise.all([self.GET_DATA("{{url('api/promedioMermas')}}")]).then((v) => {
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


                                let url = "{{url('api/compras')}}/"+id

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


                    } catch (e) {

                    } finally {
                        let sucursal = localStorage.getItem('sucursal')
                        this.sucursal = JSON.parse(sucursal)
                        block.unblock();
                    }
                    // do whatever you want if console is [object object] then stringify the response




                })
            }
        }).mount('#meApp')
        </script>
@endslot
@endcomponent
