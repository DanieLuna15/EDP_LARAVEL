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
                                </svg> Restore DB</p>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label>Backups</label>
                                        <select v-model="model.backup_id" class="form-control">
                                            <option v-for="m in data" :value="m">{{ m }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button @click="Restore()" class="btn btn-primary ">RESTAURAR COPIA DE SEGURIDAD DB</button>
                            <button @click="Download()" class="btn btn-success ">DESCARGAR COPIA DE SEGURIDAD DB</button>

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
                    async Restore() {
                        block.block();
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/backups/restore') }}";

                            await axios.post(url, this.model);
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Backup',
                                text: "Backup restaurada.",
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                            await this.load()

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async Download() {
                        block.block();
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/backups/download') }}/";

                            location.href = url + this.model.backup_id;


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async Save() {
                        block.block();
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/backups') }}";

                            await axios({
                                method: 'post',
                                url: url,
                                headers: {},
                                data: params
                            });
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Backup',
                                text: "Backup creada.",
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!',
                                reverseButtons: true,
                                padding: '2em'
                            })
                            await this.load()

                        } catch (e) {

                        } finally {
                            block.unblock();
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
                        // do whatever you want if console is [object object] then stringify the response




                    })
                }

            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
