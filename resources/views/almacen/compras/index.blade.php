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
                    </svg> Almacen / Compras de Lotes</p>
            </div>
            <div>
                <a :href="urlAdd" class="btn btn-success">Nueva Compra Lote</a>
                <a :href="urlCerradas" class="btn btn-info">Compras Cerradas</a>
                <a :href="urlAnuladas" class="btn btn-danger">Compras Anuladas</a>
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

                  <th>ID</th>
                  <th>Proveedor</th>
                  <th>Nro Compra</th>
                  <th>Lote</th>
                  <th>Creacion</th>
                  <th>Fecha Registro</th>
                  <th>Fecha Salida</th>
                  <th>Fecha Llegada</th>
                  <th>Camion</th>
                  <th>PLaca</th>
                  <th>Chofer</th>
                  <th>Peso Neto</th>
                  <th>Peso Bruto</th>
                  <th>E. Recepcion</th>
                  <th>E. Despacho</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Anulado</th>

                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{m.id}}</td>
                  <td>{{m.proveedor_compra.abreviatura}}</td>
                  <td>{{m.nro_compra}}</td>
                  <td>{{m.nro}}</td>
                  <td>{{m.creacion}} </td>
                  <td>{{m.fecha}}</td>
                  <td>{{m.fecha_salida}}</td>
                  <td>{{m.fecha_llegada}}</td>
                  <td>{{m.camion}}</td>
                  <td>{{m.placa}}</td>
                  <td>{{m.chofer}}</td>
                  <td>{{m.sum_peso_bruto}}</td>
                  <td>{{m.sum_peso_neto}}</td>
                  <td>{{m.e_recepcion}}</td>
                  <td>{{m.e_despacho}}</td>
                  <td>{{m.user.nombre}}</td>
                  <td>
                      <span v-if="m.consolidacion!=null" class="badge bg-primary">Consolidado</span>
                    <span v-else class="badge bg-warning">Sin consolidar</span>
                  </td>
                  <td>
                      <span v-if="m.estado==1" class="badge bg-success">Vigente</span>
                    <span v-else class="badge bg-danger">Anulado</span>
                  </td>

                  <td>
                    <div class="btn-group">
                      <a :href="m.url_pdf_2" target="_blank" class="btn btn-primary btn-sm">PDF</a>
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                        <a :href="m.url_pdf_2"  target="_blank" class="dropdown-item">Ver Original PDF</a>
                        <a :href="m.url_categorizada_pdf"  target="_blank" class="dropdown-item">Ver Categorizada PDF</a>
                        <a :href="m.url_pdf" target="_blank"  class="dropdown-item">Ver Falsa PDF</a>
                        <a :href="m.url_sub_pdf" target="_blank"  class="dropdown-item">Ver Sub Totales PDF</a>
                        <a :href="m.url_ventas_pdf" target="_blank"  class="dropdown-item">Ver Ventas PDF</a>
                        <a :href="m.url_excel"  class="dropdown-item">Ver Excel</a>
                        <a :href="m.url_seguimiento_cliente_pdf" target="_blank"  class="dropdown-item bg-light-success"> SEGUIMIENTO DE CLIENTE</a>
                        <a :href="m.url_seguimiento_producto_pdf" target="_blank"  class="dropdown-item bg-light-success"> SEGUIMIENTO DE PRODUCTO</a>
                        <a :href="m.url_seguimiento_cronologico_pdf" target="_blank"  class="dropdown-item bg-light-success"> SEGUIMIENTO DE CRONOLOGICO</a>
                        <a :href="'./compras/edit/'+m.id" class="dropdown-item">Editar Compra Lote</a>
                        <a class="dropdown-item bg-light-danger" href="javascript:void(0)" @click="deleteItem(m.id)">Eliminar</a>
                        <a class="dropdown-item bg-light-warning" href="javascript:void(0)" @click="finalizarLote(m.id)">Finalizar Lote</a>
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
<script>
    window.urlAdd = "{{ url('/almacen/compras/add') }}";
    window.urlCerradas = "{{ url('/almacen/compras/compras-cerradas') }}";
    window.urlAnuladas = "{{ url('/almacen/compras/compras-anuladas') }}";
</script>
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
                  urlAdd: '',        // Se llenarán después
                  urlCerradas: '',
                  urlAnuladas: '',
                    add: true,
                    model: {
                        name: ''
                    },
                    data: []

                }
            },
            methods: {
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/proveedors')}}";
                        if (this.add == false) {
                            url = "{{url('api/proveedors')}}/"+this.model.id
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
                            await Promise.all([self.GET_DATA("{{url('api/compras-vigentes')}}")]).then((v) => {
                                self.data = v[0]
                            })

                        } catch (e) {

                        }
                    } catch (e) {

                    }
                },
                deleteItem(id) {
                    let self = this;

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
                        confirmButtonText: 'Eliminar!',
                        cancelButtonText: 'No!',
                        reverseButtons: true,
                        padding: '2em'
                    }).then(async (result) => {
                        if (result.value) {
                            try {
                                let url = "{{url('api/compras')}}/" + id;
                                let res = await axios.delete(url);

                                if (res.data.ok) {
                                    dt.destroy();
                                    await self.load();
                                    dt.create();
                                    swal.fire("Anulado", res.data.mensaje, "success");
                                } else {
                                    swal.fire("No permitido", res.data.mensaje, "error");
                                }

                            } catch (e) {
                                if (e.response && e.response.status === 422) {
                                    swal.fire("No permitido", e.response.data.mensaje, "error");
                                } else {
                                    swal.fire("Error", "Ocurrió un problema al anular la compra.", "error");
                                }
                            }
                        }
                    });
                },

                finalizarLote(id) {
                    let self = this;

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
                        confirmButtonText: 'Finalizar Lote!',
                        cancelButtonText: 'No!',
                        reverseButtons: true,
                        padding: '2em'
                    }).then(async (result) => {
                        if (result.value) {
                            try {
                                let url = "{{url('api/compras/finalizar')}}/" + id;
                                let res = await axios.post(url);

                                if (res.data.ok) {
                                    dt.destroy();
                                    await self.load();
                                    dt.create();
                                    swal.fire("Finalizado", res.data.mensaje, "success");
                                } else {
                                    swal.fire("No permitido", res.data.mensaje, "error");
                                }

                            } catch (e) {
                                if (e.response && e.response.status === 422) {
                                    swal.fire("No permitido", e.response.data.mensaje, "error");
                                } else {
                                    swal.fire("Error", "Ocurrió un problema al finalizar el lote.", "error");
                                }
                            }
                        }
                    });
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
                        this.urlAdd = window.urlAdd;
                        this.urlCerradas = window.urlCerradas;
                        this.urlAnuladas = window.urlAnuladas;
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
