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
                                                <label for="nombre" class="required-label">Nombres</label>
                                                <input id="nombre" v-model="model.nombre" type="text"
                                                    class="form-control mb-4" required>
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


                                            <div class="form-group ">
                                                <label>Estado Compra Chofer</label>
                                                <select v-model="model.estado_compra_chofer_id" class="form-control">

                                                    <option v-for="m in estadoCompraChofers" :value="m.id">
                                                        {{ m . name }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="doc" class="required-label">N° Doc</label>
                                                <input id="doc" type="text" v-model="model.doc" class="form-control mb-4"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="placa" class="required-label">Placa</label>
                                                <input id="placa" v-model="model.placa" type="text" class="form-control mb-4"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input id="password" v-model="model.contrasenia" type="text"
                                                    class="form-control mb-4" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Color</label>
                                                <input v-model="model.color" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Modelo</label>
                                                <input v-model="model.modelo" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12" style="display: none">
                                            <div class="form-group">
                                                <label for="fullName">Zona/Ruta</label>
                                                <input v-model="model.zona" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-6">
                                            <div class="form-group ">
                                                <label>Zona/Ruta</label>
                                                <select v-model="model.zona_despacho_id" class="form-control">
                                                    <option v-for="m in zona_despachos" :value="m.id">
                                                        {{ m . name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Capacidad</label>
                                                <input v-model.number="model.capacidad" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button class="btn btn-dark w-100" @click="back()">Regresar</button>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-primary w-100" @click="Save()">Guardar</button>
                                                </div>
                                            </div>
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
                            cinta_cliente_id: 1,
                            tipocliente_id: 1,
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
                            correo: '',
                            latitud: '',
                            longitud: '',
                            creditos_activos: 0,
                            dias_horas: "",
                            limite_crediticio: 0,
                            estado_compra_chofer_id: 1,
                            zona_despacho_id: 1,
                            contrasenia: '',
                        },
                        tipoclientes: [],
                        documentos: [],
                        cintaClientes: [],
                        estadoCompraChofers: [],
                        zona_despachos: [],
                    }
                },
                watch: {
                    'model.doc': function() {
                        this.generatePassword();
                    },
                    'model.nombre': function() {
                        this.generatePassword();
                    },
                    'model.placa': function() {
                        this.generatePassword();
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
                    generatePassword() {
                        const rawDoc = (this.model.doc || '').toString();
                        const docDigits = rawDoc.replace(/\D+/g, '');
                        const lastDocDigits = docDigits.slice(-3);

                        const fullName = (this.model.nombre || '').trim();
                        const nameInitials = fullName ?
                            fullName
                            .split(/\s+/)
                            .filter(Boolean)
                            .map(part => part.charAt(0).toLowerCase())
                            .join('') :
                            '';

                        const plate = (this.model.placa || '').trim().toLowerCase();
                        const normalizedPlate = plate.replace(/\s+/g, '');
                        const firstPlateChars = normalizedPlate.slice(0, 3);

                        if (lastDocDigits && nameInitials && firstPlateChars) {
                            this.model.contrasenia = `${lastDocDigits}-${nameInitials}-${firstPlateChars}`;
                        } else {
                            this.model.contrasenia = '';
                        }
                    },
                    validatePasswordRequirements() {
                        this.generatePassword();

                        const missingFields = [];
                        if (!((this.model.nombre || '').trim())) {
                            missingFields.push('Nombres');
                        }

                        const docDigits = ((this.model.doc || '').toString()).replace(/\D+/g, '').slice(-3);
                        if (!docDigits) {
                            missingFields.push('N° Doc');
                        }

                        if (!((this.model.placa || '').trim())) {
                            missingFields.push('Placa');
                        }

                        if (!this.model.contrasenia || missingFields.length) {
                            const fieldList = missingFields.length ? missingFields.join(', ') :
                                'Nombres, N° Doc y Placa';
                            alert(`Complete los campos obligatorios (${fieldList}) para generar la contraseña.`);
                            return false;
                        }

                        return true;
                    },
                    async Save() {
                        if (!this.validatePasswordRequirements()) {
                            return;
                        }
                        block.block();
                        try {
                            let url = "url_path()api/chofers";
                            await axios.put("{{ url('api/chofers') }}/{{ $id }}", this.model)
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
                                    "chofers/{{ $id }}"), self.GET_DATA('tipoclientes'),
                                self.GET_DATA('cintaClientes'),
                                self.GET_DATA('estadoCompraChofers'),
                                self.GET_DATA('zonaDespachos'),
                            ]).then((v) => {
                                self.documentos = v[0]
                                self.model = v[1]
                                self.tipoclientes = v[2]
                                self.cintaClientes = v[3]
                                self.estadoCompraChofers = v[4]
                                self.zona_despachos = v[5]
                                if (!self.model.contrasenia) {
                                    self.model.contrasenia = ''
                                }

                                self.generatePassword()
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
    @slot('style')
        <style>
            #map {
                height: 280px;
            }

            .required-label::after {
                content: ' *';
                color: #e74c3c;
                font-weight: bold;
            }
        </style>
    @endslot
@endcomponent
