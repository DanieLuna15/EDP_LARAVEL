@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row">
                                <div class="col-sm-12 col-6">
                                    <div class="form-group">
                                        <label>Tipo de archivo</label>
                                        <select v-model="tipoarchivo_id" class="form-control">
                                            <option v-for="m in data" :value="m.id">{{ m . name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Subir archivo
                                            <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                                title="Clear Image">x</a>
                                        </label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file" v-on:change="handleFileUpload()" ref="file"
                                                class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    <button v-if="file!=''" @click="submitFile()" class="btn btn-success w-100">Cargar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Documento</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m,i) in model.file_monedas">
                                            <td>{{ i + 1 }}</td>
                                            <td>
                                                <div class="media">
                                                    <img :src="m.path_url" onerror="this.style.display='none'"
                                                        class="img-fluid" style="width: 100px;">
                                                </div>
                                            </td>
                                            <td>{{ m . tipoarchivo . name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                                        :id="'menu' + i" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-reference="parent">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu" :aria-labelledby="'menu' + i">
                                                        <a class="dropdown-item" :href="m.path_url" download>Descargar</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            @click="deleteItem(m.id)">Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            let block = new Block()

            createApp({
                data() {
                    return {
                        tipoarchivo_id: "",
                        data: [],
                        file: '',
                        model: {
                            file_monedas: []
                        }
                    }
                },
                methods: {
                    async submitFile() {
                        let self = this
                        let formData = new FormData();
                        formData.append('file', this.file);
                        formData.append('tipoarchivo_id', this.tipoarchivo_id);
                        let url = "{{ url('api/monedas') }}-{{ $id }}/image";
                        await axios.post(url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });
                        await self.load()
                    },
                    handleFileUpload() {
                        this.file = this.$refs.file.files[0];
                    },
                    async GET_DATA(path) {
                        let res = await axios.get("{{ url('') }}/" + path);
                        return res.data;
                    },
                    async load() {
                        let [moneda, tipos] = await Promise.all([
                            this.GET_DATA('api/monedas/{{ $id }}'),
                            this.GET_DATA('api/tipoarchivos')
                        ]);
                        this.model = moneda;
                        this.data = tipos;
                        if (this.data.length) {
                            this.tipoarchivo_id = this.data[0].id;
                        }
                    },
                    deleteItem(id) {
                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro?',
                            text: "Este cambio es irreversible.",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Eliminar',
                            cancelButtonText: 'Cancelar',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                await axios.post("{{ url('api/monedas-image-delete') }}/" + id);
                                await this.load();
                            }
                        });
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        block.block();
                        await this.load();
                        block.unblock();
                        new FileUploadWithPreview('myFirstImage');
                    });
                }
            }).mount('#meApp')
        </script>
    @endslot
@endcomponent
