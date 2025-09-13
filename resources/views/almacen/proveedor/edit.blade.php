@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Informacion General</h6>
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nombres</label>
                                                <input v-model="model.nombre" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">


                                            <div class="form-group ">
                                                <label>Documentos</label>
                                                <select v-model="model.documento_id" class="form-control">

                                                    <option v-for="m in documentos" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">N° Doc</label>
                                                <input type="text" v-model="model.doc" class="form-control mb-4" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Direccion</label>
                                                <input type="text" v-model="model.direccion" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Telefono</label>
                                                <input type="text" v-model="model.telefono" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Encargado</label>
                                                <input type="text" v-model="model.encargado" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Abreviatura</label>
                                                <input type="text" v-model="model.abreviatura" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Activo</label>
                                                <select v-model="model.inactivo" class="form-control">

                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            <div class="form-group ">
                                                <label>Categorias</label>
                                                <select v-model="model.categoria_id" class="form-control">

                                                    <option v-for="m in categorias" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-dark w-100" @click="back()">Regresar</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary w-100" @click="Save()">Guardar</button>
                                        </div>
                                        <div class="row" style="display: none">
                                            <div class="col-sm-6 col-6">
                                                <div class="form-group ">
                                                    <label>Producto</label>
                                                    <select v-model="producto" class="form-control">

                                                        <option v-for="m in productos" :value="m">{{ m . name }}
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <div class="form-group ">
                                                    <label>Medidas</label>
                                                    <select v-model="medida" class="form-control">

                                                        <option v-for="m in producto.medida_productos" :value="m">
                                                            {{ m . medida . name }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <div class="form-group ">
                                                    <label>Sub Medidas</label>
                                                    <select v-model="sub_medida" class="form-control">

                                                        <option v-for="m in medida.sub_medidas" :value="m">
                                                            {{ m . name }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-success w-100" type="button"
                                                    @click="addSubMedida">Agregar</button>
                                            </div>
                                            <div class="col-12 my-2">
                                                <ul class="list-group task-list-group">
                                                    <template v-for="(m,i) in sub_medidas_estado">
                                                        <li class="list-group-item list-group-item-action">
                                                            <div class="n-chk"><label
                                                                    class="new-control new-checkbox checkbox-primary w-100 justify-content-between"><input
                                                                        type="checkbox" class="new-control-input"><span
                                                                        class="new-control-indicator"></span><span
                                                                        class="ml-2"><b>{{ m . sub_medida . name }}</b></span><span
                                                                        class="ml-2">
                                                                        <ul class="table-controls">
                                                                            <li><a href="javascript:void(0);"
                                                                                    @click="m.estado = 0">


                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-trash-2">
                                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                                        <path
                                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                        </path>
                                                                                        <line x1="10" y1="11"
                                                                                            x2="10" y2="17"></line>
                                                                                        <line x1="14" y1="11"
                                                                                            x2="14" y2="17"></line>
                                                                                    </svg>
                                                                                </a></li>
                                                                        </ul>
                                                                    </span></label></div>
                                                        </li>
                                                    </template>


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 mt-3">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Categorias por Proveedor</h6>
                                    <div class="row">

                                        <div class="col-sm-12 ">


                                            <div class="form-group ">
                                                <label>Categorias</label>
                                                <select v-model="categoria_id" class="form-control">

                                                    <option v-for="m in categorias" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="button" @click="addCategoria">Agregar
                                                categoria al proveedor</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-for="m in model.proveedor_categorias" class="col-lg-8 col-12 mt-3">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">{{ m . categoria . name }}</h6>
                                    <div class="row">

                                        <div class="col-sm-6 col-6">
                                            <div class="form-group ">
                                                <label>Producto</label>
                                                <select v-model="producto" class="form-control">

                                                    <option v-for="p in productos" :value="p">{{ p . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            <div class="form-group ">
                                                <label>Medidas</label>
                                                <select v-model="medida" class="form-control">

                                                    <option v-for="me in producto.medida_productos" :value="me">
                                                        {{ me . medida . name }}</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-6">
                                            <div class="form-group ">
                                                <label>Sub Medidas</label>
                                                <select v-model="sub_medida" class="form-control">

                                                    <option v-for="su in medida.sub_medidas" :value="su">
                                                        {{ su . name }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="button"
                                                @click="addSubMedidaCategoria(m)">Agregar</button>
                                        </div>
                                        <div class="col-12 my-2">
                                            <ul class="list-group task-list-group">
                                                <template v-for="(mi,i) in m.proveedor_categoria_detalles">
                                                    <li class="list-group-item list-group-item-action">
                                                        <div class="n-chk"><label
                                                                class="new-control new-checkbox checkbox-primary w-100 justify-content-between"><input
                                                                    type="checkbox" class="new-control-input"><span
                                                                    class="new-control-indicator"></span><span
                                                                    class="ml-2"><b>{{ mi . sub_medida . name }}</b></span><span
                                                                    class="ml-2">
                                                                    <ul class="table-controls">
                                                                        <li><a href="javascript:void(0);"
                                                                                @click="deleteItemCategoriaDetalle(mi)">


                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-trash-2">
                                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                                    <path
                                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                    </path>
                                                                                    <line x1="10" y1="11"
                                                                                        x2="10" y2="17"></line>
                                                                                    <line x1="14" y1="11"
                                                                                        x2="14" y2="17"></line>
                                                                                </svg>
                                                                            </a></li>
                                                                    </ul>
                                                                </span></label></div>
                                                    </li>
                                                </template>


                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-danger w-100" type="button"
                                                @click="deleteCategoria(m)">Eliminar Categoria del Proveedor</button>
                                        </div>



                                    </div>
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
            let block = new Block()

            createApp({
                data() {
                    return {
                        model: {
                            inactivo: 1,
                            nombre: '',
                            apellidos: '',
                            documento_id: '',
                            doc: '',
                            cargo: '',
                            telefono: '',
                            direccion: '',
                            garante: '',
                            dir_garante: '',
                            cel_garante: '',
                            categoria_id: 1,
                        },
                        documentos: [],
                        categorias: [],
                        producto: {
                            id: 0,
                            name: '',
                            medida_productos: []

                        },
                        medida: {
                            id: 0,
                            medida: {

                            },
                            sub_medidas: []
                        },
                        sub_medida: {

                        },
                        productos: [],
                        sub_medidas: [],
                        categoria_id: 1,
                    }
                },
                computed: {
                    sub_medidas_estado() {
                        return this.sub_medidas.filter(m => m.estado == 1)
                    }
                },
                methods: {
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    addSubMedida() {
                        let sb = {

                            sub_medida: {
                                ...this.sub_medida
                            },
                        }
                        sb.estado = 1
                        this.sub_medidas.push(sb)
                    },
                    async addSubMedidaCategoria(c) {
                        block.block();
                        let self = this
                        try {
                            let data = {
                                proveedor_categoria_id: c.id,
                                proveedor_compra_id: this.model.id,
                                sub_medida: {
                                    ...this.sub_medida
                                }
                            }
                            await axios.post("{{ url('api/proveedorCategoriaDetalles') }}", data)
                            await Promise.all([self.GET_DATA("proveedorCompras/{{ $id }}"),

                            ]).then((v) => {

                                self.model = v[0]

                            })


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async deleteItemCategoriaDetalle(c) {
                        block.block();
                        let self = this
                        try {

                            await axios.delete("{{ url('api/proveedorCategoriaDetalles') }}/" + c.id)
                            await Promise.all([self.GET_DATA("proveedorCompras/{{ $id }}"),

                            ]).then((v) => {

                                self.model = v[0]

                            })


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async deleteCategoria(c) {
                        block.block();
                        let self = this
                        try {

                            await axios.delete("{{ url('api/proveedorCategorias') }}/" + c.id)
                            await Promise.all([self.GET_DATA("proveedorCompras/{{ $id }}"),

                            ]).then((v) => {

                                self.model = v[0]

                            })


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async addCategoria() {
                        block.block();
                        let self = this
                        try {
                            let data = {
                                categoria_id: this.categoria_id,
                                proveedor_compra_id: this.model.id
                            }
                            await axios.post("{{ url('api/proveedorCategorias') }}", data)
                            await Promise.all([self.GET_DATA("proveedorCompras/{{ $id }}"),

                            ]).then((v) => {

                                self.model = v[0]

                            })


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    async Save() {
                        block.block();
                        try {
                            this.model.sub_medidas = this.sub_medidas
                            let url = "url_path()api/proveedorCompras";
                            await axios.put("{{ url('api/proveedorCompras') }}/{{ $id }}", this.model)
                            this.back()

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    back() {
                        window.location.replace(document.referrer);
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {



                            await Promise.all([self.GET_DATA('documentos'), self.GET_DATA(
                                    "proveedorCompras/{{ $id }}"),
                                self.GET_DATA('categorias'),
                                self.GET_DATA('productos')
                            ]).then((v) => {
                                self.documentos = v[0]
                                self.model = v[1]
                                self.categorias = v[2]
                                self.productos = v[3]
                                self.sub_medidas = self.model.proveedor_compra_medidas
                            })
                            if (self.documentos.length) {
                                self.model.documento_id = self.documentos[0].id
                            }

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
