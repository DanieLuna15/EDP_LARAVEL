@component('preventista.template.master', ['title' => 'Preventista'])
    @slot('body')
        @verbatim
            <div v-if="!loading" class="osahan-body" id="app">
                <!-- categories -->
                <div class="p-3 osahan-categories">
                    <h6 class="mb-2">Clientes</h6>
                    <div class="row">
                        <div class="col-12">
                            <a href="./cliente/add" class="btn btn-success w-100"><i class="bi bi-plus-circle-fill"></i> Agregar</a>
                        </div>
                        <div class="col-lg-12">
                            <div class="bg-white shadow-sm rounded widget-content-area br-6">
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                        <thead class="bg-info ">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Nombre</th>
                                                <th class="text-white">Documento</th>
                                                <th class="text-white">Telefono</th>
                                                <th class="text-white">Creditos activos</th>
                                                <th class="text-white">Limite Crediticio</th>
                                                <th class="text-white">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(m,i) in data">
                                                <td>{{ i + 1 }}</td>
                                                <td>{{ m . id }}</td>
                                                <td>{{ m . nombre }}</td>
                                                <td>{{ m . documento . name }} {{ m . doc }}</td>
                                                <td>{{ m . telefono }}</td>
                                                <td>{{ m . creditos_activos }}</td>
                                                <td>{{ m . limite_crediticio }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a :href="'./cliente/edit/' + m.id"
                                                            class="btn bg-warning text-white btn-sm"><i
                                                                class="bi bi-pencil"></i></a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a :href="'./cliente/precios/' + m.id"
                                                            class="btn bg-success text-white btn-sm">Precios</a>
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
                        loading: true,
                        add: true,
                        model: {
                            name: ''
                        },
                        data: [],
                        file: '',

                    }
                },
                methods: {
                    async submitFile() {
                        let self = this
                        const params = new URLSearchParams(this.model);
                        let formData = new FormData();

                        /*
                            Add the form data we need to submit
                        */
                        formData.append('file', this.file);

                        let url = "{{ url('') }}/import-template-cliente";
                        await axios({
                            method: 'post',
                            url: url,
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            data: formData
                        });
                        dt.destroy()
                        await this.load()
                        dt.create()

                    },


                    handleFileUpload(e) {
                        this.file = this.$refs.file.files[0];
                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/clientes') }}";
                            if (this.add == false) {
                                url = "{{ url('api/clientes') }}/" + this.model.id
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
                        this.loading = true;
                        try {
                            let self = this

                            try {
                                await Promise.all([self.GET_DATA("{{ url('api/clientes') }}")]).then((v) => {
                                    self.data = v[0]
                                })

                            } catch (e) {

                            } finally {
                                this.loading = false;
                                const loader = document.querySelector('.loader-overlay');
                                if (loader && this.loading == false) {
                                    loader.style.display = 'none';
                                }
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


                                    let url = "{{ url('api/clientes') }}/" + id

                                    await axios.delete(url)
                                    dt.destroy()
                                    await self.load()
                                    dt.create()
                                } catch (e) {

                                }
                            }
                        })
                    },
                    url(path) {
                        return "{{ url('/') }}" + path
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {
                            await Promise.all([self.load()]).then((v) => {
                                // Crear DataTable sin botones de exportación
                                $('#table_dt').DataTable({
                                    dom: 'frtip', // No incluir la sección de botones
                                    buttons: [], // No agregar botones de exportación
                                    responsive: true,
                                    language: {
                                        "lengthMenu": "Mostrar _MENU_ registros por página",
                                        "zeroRecords": "No se encontraron resultados",
                                        "info": "Mostrando página _PAGE_ de _PAGES_",
                                        "infoEmpty": "No hay registros disponibles",
                                        "infoFiltered": "(filtrado de _MAX_ registros totales)"
                                    }
                                });
                            });

                        } catch (e) {

                        } finally {
                            block.unblock();
                            var firstUpload = new FileUploadWithPreview('myFirstImage')
                        }
                        // do whatever you want if console is [object object] then stringify the response




                    })
                }
            }).mount('#app')
        </script>
    @endslot
@endcomponent
