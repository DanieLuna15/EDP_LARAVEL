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
                                </svg> Truncate DB</p>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6 text-center">
                            <div class="widget-content widget-content-area br-6 text-center">
                                <div class="form-group">
                                    <label>Seleccione las tablas para vaciar</label>
                                    <select v-model="model.tables" multiple class="form-control">
                                        <option v-for="table in tables" :value="table">{{ table }}</option>
                                    </select>
                                </div>
                                <button @click="Truncate()" class="btn btn-primary">VACIAR TABLA SELECCIONADA DE LA BD</button>
                                <button @click="TruncateDefault()" class="btn btn-success">VACIAR TABLAS DE LA BD DEFAULT</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endverbatim
    @endslot
    @slot('script')
        <script type="module">
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"
            const {
                createApp
            } = Vue
            let dt = new Table()
            let block = new Block()
            createApp({
                data() {
                    return {
                        data: [],
                        tables: [],
                        model: {
                            backup_id: '',
                            tables: []
                        }

                    }
                },
                methods: {
                    async Truncate() {
                        block.block();
                        let self = this
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este proceso es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Descomponer!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    const params = new URLSearchParams();
                                    params.append('tables', this.model.tables);

                                    let url = "{{ url('api/backups/truncate') }}";

                                    const response = await axios.post(url, params);
                                    swal({
                                        title: 'Tablas Vaciadas',
                                        text: response.data.message,
                                        type: 'success',
                                        buttons: true,
                                    });


                                } catch (e) {
                                    console.error("Error truncando tablas", e);
                                    swal({
                                        title: 'Error',
                                        text: 'Hubo un error al vaciar las tablas.',
                                        type: 'error',
                                        buttons: true,
                                    });
                                } finally {
                                    block.unblock();
                                }
                            }
                            block.unblock();
                        })
                    },
                    async TruncateDefault() {
                        block.block();
                        let self = this
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons({
                            title: 'Estas seguro?',
                            text: "Este proceso es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Vaciar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {

                                    let url = "{{ url('api/backups/truncate-default') }}";
                                    const response = await axios.post(url);
                                    if (response.data && response.data.message) {
                                        swal({
                                            title: 'Tablas por Defecto Vaciadas',
                                            text: response.data.message,
                                            type: 'success',
                                            buttons: true,
                                        });
                                    } else {
                                        swal({
                                            title: 'Error',
                                            text: 'No se pudo vaciar las tablas por defecto.',
                                            type: 'error',
                                            buttons: true,
                                        });
                                    }


                                } catch (e) {
                                    console.error("Error truncando tablas por defecto", e);
                                    swal({
                                        title: 'Error',
                                        text: 'Hubo un error al vaciar las tablas por defecto.',
                                        type: 'error',
                                        buttons: true,
                                    });
                                } finally {
                                    block.unblock();
                                }
                            }
                            block.unblock();
                        })
                    },


                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async load() {
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA('api/backups')]).then((v) => {
                                    self.data = v[0];
                                    if (self.data.length > 0) {
                                        self.model.backup_id = self.data[
                                            0];
                                    }
                                })
                                await Promise.all([self.GET_DATA('api/backups/tables')]).then((v) => {
                                    self.tables = v[0];
                                });
                            } catch (e) {

                            }
                        } catch (e) {

                        }
                    },
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
                    })
                }

            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
