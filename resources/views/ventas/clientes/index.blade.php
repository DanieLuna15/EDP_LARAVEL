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
                    </svg> Ventas / Clientes</p>
            </div>
            <div class="btn-group">
                <a href="./clientes/add" class="btn btn-success">Agregar</a>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Carga Masiva</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCrud">Carga Masiva</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row mb-4">
                                   <div class="col-12">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label>Subir Excel <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
                                            <input type="file" v-on:change="handleFileUpload()" ref="file" class="custom-file-container__custom-file__custom-file-input" accept="xlsx/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                        <button v-if="file!=''" @click="submitFile()" class="btn btn-success w-100">Cargar</button>
                                   </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                                <a :href="url('/download-template-cliente')" target="_blank" class="btn btn-dark">Descargar Plantilla</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
          <div class="table-responsive mb-4 mt-4">
            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Tipo</th>
                  <th>Grupo</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th>Creditos activos</th>
                  <th>Saldo</th>
                  <th>Limite Crediticio</th>
                  <th>Saldo</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{i+1}}</td>
                  <td>{{m.nombre}}</td>
                  <td>{{m.documento.name}} {{m.doc}}</td>
                  <td>{{m.tipocliente.name}}</td>
                  <td>{{ m.cinta_cliente && m.cinta_cliente.name ? m.cinta_cliente.name : 'Ninguno' }}</td>
                  <td>{{m.telefono}}</td>
                  <td>{{m.correo}}</td>
                  <td>{{m.creditos_activos}}</td>
                  <td>{{m.creditos_activos_saldo}}</td>
                  <td>{{m.limite_crediticio}}</td>
                  <td>{{m.saldo_limite_crediticio}}</td>
                  <td>
                    <div class="btn-group">
                      <a :href="'./clientes/edit/'+m.id" class="btn btn-warning btn-sm">Editar</a>
                      <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                        <a class="dropdown-item" :href="'./clientes/convenio/'+m.id" >Convenio</a>
                        <a class="dropdown-item" :href="'./clientes/precios/'+m.id" >Precios</a>
                        <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(m.id)">Eliminar</a>

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
                    file: '',

                }
            },
            methods: {
                async submitFile() {
                    try {
                        let self = this;
                        const formData = new FormData();
                        formData.append('file', this.file);

                        let url = "{{url('')}}/import-template-cliente";
                        const response = await axios.post(url, formData, { headers: { 'Content-Type': 'multipart/form-data' } });

                        // Verificar si hay errores
                        if (response.data.errors) {
                            let errorMsg = '';
                            // Concatenar los errores en un solo mensaje
                            response.data.errors.forEach((error, index) => {
                                errorMsg += `Fila ${index + 1}: ${error}\n`;
                            });

                            // Mostrar los errores en un Swal
                            Swal.fire({
                            type: 'error',
                                title: 'Errores en el archivo',
                                text: `Se encontraron los siguientes errores:\n${errorMsg}`,
                                showConfirmButton: true
                            });
                        } else {
                            // Si no hay errores, mostrar mensaje de éxito
                            Swal.fire({
                            type: 'success',
                                title: 'Carga exitosa',
                                text: 'Los clientes fueron importados correctamente.',
                                showConfirmButton: true
                            });
                            await self.load()
                        }

                    } catch (error) {
                        console.error('Error en la carga del archivo, por favor llenelo correctamente:', error);
                        Swal.fire({
                        type: 'error',
                            title: 'Error al cargar el archivo',
                            text: 'Hubo un error al procesar el archivo. Inténtalo de nuevo.',
                            showConfirmButton: true
                        });
                    }
                },


                handleFileUpload(e) {
                    this.file = this.$refs.file.files[0];
                },
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/clientes')}}";
                        if (this.add == false) {
                            url = "{{url('api/clientes')}}/"+this.model.id
                            let res = axios.put(url,this.model)
                        }else{
                            let res = axios.post(url,this.model)

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
                            await Promise.all([self.GET_DATA("{{url('api/clientes')}}")]).then((v) => {
                                self.data = v[0]
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


                                let url = "{{url('api/clientes')}}/"+id

                                await axios.delete(url)
                                dt.destroy()
                                await self.load()
                                dt.create()
                            } catch (e) {

                            }
                        }
                    })
                },
                url(path){
                    return "{{url('/')}}"+path
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
                        var firstUpload = new FileUploadWithPreview('myFirstImage')
                    }
                    // do whatever you want if console is [object object] then stringify the response




                })
            }
        }).mount('#meApp')
        </script>
@endslot
@endcomponent
