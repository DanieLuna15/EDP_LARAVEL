@component('preventista.template.master', ['title' => 'Backups'])
    @slot('body')
        @verbatim
            <div v-if="!loading" class="osahan-body" id="appBackup">
                <div class="p-4 osahan-categories">
                    <h6 class="mb-2">Backup / Restore DB</h6>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget-content widget-content-area br-6 text-center shadow-lg p-4">
                                <button @click="Save()" class="btn btn-primary btn-lg w-100 mb-4"><i
                                        class="bi bi-cloud-arrow-down-fill"></i> CREAR COPIA DE SEGURIDAD</button>

                                <div class="form-group mb-3">
                                    <label class="form-label">Seleccione la tabla para vaciar</label>
                                    <select v-model="model.tables" multiple class="form-control">
                                        <option v-for="table in tables" :value="table">{{ table }}</option>
                                    </select>
                                </div>

                                <button @click="Truncate()" class="btn bg-orange btn-lg text-white mb-2 w-100"><i
                                        class="bi bi-trash"></i> VACIAR TABLA SELECCIONADA</button>
                                <button @click="TruncateDefault()" class="btn bg-success text-white btn-lg mb-2 w-100"><i
                                        class="bi bi-trash"></i> VACIAR TABLAS POR DEFECTO</button>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="widget-content widget-content-area br-6 shadow-lg p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Backups</label>
                                    <select v-model="model.backup_id" class="form-control">
                                        <option v-for="m in data" :value="m">{{ m }}</option>
                                    </select>
                                </div>
                                <button @click="Restore()" class="btn bg-purple text-white btn-lg mb-2 w-100"><i
                                        class="bi bi-arrow-clockwise"></i> RESTAURAR COPIA DE SEGURIDAD</button>
                                <button @click="Download()" class="btn bg-info  text-white btn-lg w-100"><i
                                        class="bi bi-download"></i> DESCARGAR COPIA DE SEGURIDAD</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endverbatim
    @endslot

    @slot('script')
        <script type="module">
            import Table from "{{ asset('config/dt.js') }}";
            import Block from "{{ asset('config/block.js') }}";

            const {
                createApp
            } = Vue;
            let dt = new Table();
            let block = new Block();

            createApp({
                data() {
                    return {
                        loading: true,
                        data: [],
                        tables: [],
                        model: {
                            backup_id: '',
                            tables: []
                        }
                    };
                },
                methods: {
                    async Truncate() {

                        try {

                            const result = await swal({
                                title: '¿Estás seguro?',
                                text: 'Esta acción eliminará las tablas seleccionadas. ¿Quieres continuar?',
                                type: 'warning',
                                buttons: ['Cancelar', 'Confirmar'],
                                dangerMode: true,
                            });
                            if (result) {
                                this.loading = true;
                                const loader = document.querySelector('.loader-overlay');
                                const spinner = document.querySelector('.spinner');
                                if (loader && this.loading == true) {
                                    loader.style.display = 'block';
                                    const loaderRect = loader.getBoundingClientRect();
                                    const spinnerWidth = spinner.offsetWidth;
                                    const spinnerHeight = spinner.offsetHeight;
                                    spinner.style.position = 'absolute';
                                    spinner.style.top =
                                        `${(loaderRect.height - spinnerHeight) / 2}px`;
                                    spinner.style.left =
                                        `${(loaderRect.width - spinnerWidth) / 2}px`;
                                }
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
                            } else {
                                swal({
                                    title: 'Acción cancelada',
                                    text: 'No se realizaron cambios en las tablas.',
                                    type: 'info',
                                    buttons: true,
                                });
                            }
                        } catch (e) {
                            console.error("Error truncando tablas", e);
                            swal({
                                title: 'Error',
                                text: 'Hubo un error al vaciar las tablas.',
                                type: 'error',
                                buttons: true,
                            });
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    },
                    async TruncateDefault() {
                        try {
                            const result = await swal({
                                title: '¿Estás seguro?',
                                text: 'Esta acción eliminará todas las tablas por defecto. ¿Quieres continuar?',
                                type: 'warning',
                                buttons: ['Cancelar', 'Confirmar'],
                                dangerMode: true,
                            });

                            if (result) {
                                this.loading = true;
                                const loader = document.querySelector('.loader-overlay');
                                const spinner = document.querySelector('.spinner');
                                if (loader && this.loading == true) {
                                    loader.style.display = 'block';
                                    const loaderRect = loader.getBoundingClientRect();
                                    const spinnerWidth = spinner.offsetWidth;
                                    const spinnerHeight = spinner.offsetHeight;
                                    spinner.style.position = 'absolute';
                                    spinner.style.top =
                                        `${(loaderRect.height - spinnerHeight) / 2}px`;
                                    spinner.style.left =
                                        `${(loaderRect.width - spinnerWidth) / 2}px`;
                                }
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
                            } else {
                                swal({
                                    title: 'Acción cancelada',
                                    text: 'No se realizaron cambios en las tablas.',
                                    type: 'info',
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
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    },
                    async Restore() {
                        try {
                            this.loading = true;
                            const loader = document.querySelector('.loader-overlay');
                            const spinner = document.querySelector('.spinner');
                            if (loader && this.loading == true) {
                                loader.style.display = 'block';
                                const loaderRect = loader.getBoundingClientRect();
                                const spinnerWidth = spinner.offsetWidth;
                                const spinnerHeight = spinner.offsetHeight;
                                spinner.style.position = 'absolute';
                                spinner.style.top =
                                    `${(loaderRect.height - spinnerHeight) / 2}px`;
                                spinner.style.left =
                                    `${(loaderRect.width - spinnerWidth) / 2}px`;
                            }
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/backups/restore') }}";
                            await axios.post(url, this.model);
                            swal({
                                title: 'Backup',
                                text: "Backup restaurada.",
                                type: 'success',
                                buttons: ['Ok'],
                                timer: 2000
                            });
                            await this.load();
                        } catch (e) {
                            console.error("Error during restore", e);
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    },
                    async Download() {
                        try {
                            this.loading = true;
                            const loader = document.querySelector('.loader-overlay');
                            const spinner = document.querySelector('.spinner');
                            if (loader && this.loading == true) {
                                loader.style.display = 'block';
                                const loaderRect = loader.getBoundingClientRect();
                                const spinnerWidth = spinner.offsetWidth;
                                const spinnerHeight = spinner.offsetHeight;
                                spinner.style.position = 'absolute';
                                spinner.style.top =
                                    `${(loaderRect.height - spinnerHeight) / 2}px`;
                                spinner.style.left =
                                    `${(loaderRect.width - spinnerWidth) / 2}px`;
                            }
                            let url = "{{ url('api/backups/download') }}/";
                            location.href = url + this.model.backup_id;
                        } catch (e) {
                            console.error("Error during download", e);
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    },
                    async Save() {
                        try {
                            this.loading = true;
                            const loader = document.querySelector('.loader-overlay');
                            const spinner = document.querySelector('.spinner');
                            if (loader && this.loading == true) {
                                loader.style.display = 'block';
                                const loaderRect = loader.getBoundingClientRect();
                                const spinnerWidth = spinner.offsetWidth;
                                const spinnerHeight = spinner.offsetHeight;
                                spinner.style.position = 'absolute';
                                spinner.style.top =
                                    `${(loaderRect.height - spinnerHeight) / 2}px`;
                                spinner.style.left =
                                    `${(loaderRect.width - spinnerWidth) / 2}px`;
                            }
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/backups') }}";
                            await axios.post(url, params);
                            swal({
                                title: 'Backup',
                                text: "Backup creada.",
                                type: 'success',
                                buttons: ['Ok'],
                                timer: 2000
                            });
                            await this.load();
                        } catch (e) {
                            console.error("Error saving backup", e);
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('') }}/" + path);
                            return res.data;
                        } catch (e) {
                            console.error("Error fetching data", e);
                        }
                    },
                    async load() {
                        this.loading = true;
                        try {
                            let self = this;
                            await Promise.all([self.GET_DATA('api/backups')]).then((v) => {
                                self.data = v[0];
                                if (self.data.length > 0) {
                                    self.model.backup_id = self.data[0];
                                }
                            });
                            await Promise.all([self.GET_DATA('api/backups/tables')]).then((v) => {
                                self.tables = v[0];
                            });
                        } catch (e) {
                            console.error("Error loading data", e);
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this;
                        try {
                            this.loading = true;
                            const loader = document.querySelector('.loader-overlay');
                            const spinner = document.querySelector('.spinner');
                            if (loader && this.loading == true) {
                                loader.style.display = 'block';
                                const loaderRect = loader.getBoundingClientRect();
                                const spinnerWidth = spinner.offsetWidth;
                                const spinnerHeight = spinner.offsetHeight;
                                spinner.style.position = 'absolute';
                                spinner.style.top =
                                    `${(loaderRect.height - spinnerHeight) / 2}px`;
                                spinner.style.left =
                                    `${(loaderRect.width - spinnerWidth) / 2}px`;
                            }
                            await Promise.all([self.load()]).then(() => {
                                dt.create();
                            });
                        } catch (e) {
                            console.error("Error during mounted", e);
                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
                        }
                    });
                }
            }).mount('#appBackup');
        </script>
    @endslot
@endcomponent
