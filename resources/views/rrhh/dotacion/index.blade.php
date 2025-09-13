@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
      <div class="page-header">
        <div class="page-title">
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
              <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
            </svg>
            Dotaciones
          </p>
        </div>
        <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name=''" class="btn btn-success">Agregar</button>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCrud">{{add==true?'Agregar':'Actualizar'}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-row mb-4">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Codigo</label>
                  <input type="text" v-model="model.codigo" class="form-control" placeholder="Codigo">
                </div>
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Nombre</label>
                  <input type="text" v-model="model.name" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Costo</label>
                  <input type="text" v-model.number="model.costo" class="form-control" placeholder="Costo">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Venta</label>
                  <input type="text" v-model.number="model.venta" class="form-control" placeholder="Venta">
                </div>
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Stock Minimo</label>
                  <input type="text" v-model.number="model.stock" class="form-control" placeholder="Stock">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Familia</label>
                    <select class="form-control" v-model="model.familia_id">
                        <option v-for="(f,i) in familias" :value="f.id">{{f.name}}</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
              <button type="button" data-dismiss="modal" @click="Save()" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                    <label for="">Familias</label>
                    <select class="form-control" v-model="familia_id" id="familia">
                        <option value="todos">Todos</option>
                        <option v-for="(f,i) in familias" :value="f.name">{{f.name}}</option>
                    </select>
                    </div>
                </div>
            </div>
          <div class="table-responsive mb-4 mt-4">
            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Familia</th>
                  <th>Costo</th>
                  <th>Venta</th>
                  <th>Stock Minimo</th>

                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in data">
                  <td>{{i+1}}</td>
                  <td>{{m.codigo}}</td>
                  <td>{{m.name}}</td>
                  <td>{{m.familia.name}}</td>
                  <td>{{m.costo}}</td>
                  <td>{{m.venta}}</td>
                  <td>{{m.stock}}</td>
                  <td>
                    <div class="btn-group">
                      <button data-toggle="modal" @click="add=false,model=m" data-target="#exampleModal" type="button" class="btn btn-warning btn-sm">Editar</button>
                      <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">

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
                        name: '',
                        familia_id:1,
                    },
                    data: [],
                    familias:[],
                    familia_id:'todos'

                }
            },
            methods: {
                async Save() {
                    try {
                        // let res = await axios.post(, this.model)
                        const params = new URLSearchParams(this.model);
                        let url = "{{url('api/dotacions')}}";
                        if (this.add == false) {
                            url = "{{url('api/dotacions')}}/"+this.model.id
                            let res = await axios.put(url,this.model)
                        }else{
                            let res = await axios.post(url,this.model)

                        }
                        dt.destroy()
                        await this.load()
                        let table = $('#table_dt').DataTable( {
                                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                    buttons: {
                                        buttons: [
                                            { extend: 'copy', className: 'btn' },
                                            { extend: 'csv', className: 'btn' },
                                            { extend: 'excel', className: 'btn' },
                                            { extend: 'print', className: 'btn' }
                                        ]
                                    },
                                    order:[[0,'desc']],
                                    "oLanguage": {"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                    "sSearchPlaceholder": "Buscar...",
                                "sLengthMenu": "Resultados :  _MENU_",},
                                    "stripeClasses": [],
                                    "lengthMenu": [70, 100],
                                    "pageLength": 70
                                } );
                                $('#familia').change( function() { table.draw(); } );
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
                            await Promise.all([self.GET_DATA("{{url('api/dotacions')}}")]).then((v) => {
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


                                let url = "{{url('api/dotacions')}}/"+id

                                await axios.delete(url)
                                dt.destroy()
                                await self.load()
                                let table = $('#table_dt').DataTable( {
                                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                    buttons: {
                                        buttons: [
                                            { extend: 'copy', className: 'btn' },
                                            { extend: 'csv', className: 'btn' },
                                            { extend: 'excel', className: 'btn' },
                                            { extend: 'print', className: 'btn' }
                                        ]
                                    },
                                    order:[[0,'desc']],
                                    "oLanguage": {"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                    "sSearchPlaceholder": "Buscar...",
                                "sLengthMenu": "Resultados :  _MENU_",},
                                    "stripeClasses": [],
                                    "lengthMenu": [70, 100],
                                    "pageLength": 70
                                } );
                                $('#familia').change( function() { table.draw(); } );
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
                        await Promise.all([self.load(),self.GET_DATA("{{url('api/familias')}}")]).then((v) => {
                            this.familias = v[1]
                        })


                    } catch (e) {

                    } finally {
                        block.unblock();
                        $.fn.dataTable.ext.search.push(
                            function( settings, data, dataIndex ) {



                                if (data[3]==self.familia_id || self.familia_id=='todos')
                                {
                                    return true;
                                }
                                return false;
                            }
                        );

                        let table = $('#table_dt').DataTable( {
                                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                    buttons: {
                                        buttons: [
                                            { extend: 'copy', className: 'btn' },
                                            { extend: 'csv', className: 'btn' },
                                            { extend: 'excel', className: 'btn' },
                                            { extend: 'print', className: 'btn' }
                                        ]
                                    },
                                    order:[[0,'desc']],
                                    "oLanguage": {"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                    "sSearchPlaceholder": "Buscar...",
                                "sLengthMenu": "Resultados :  _MENU_",},
                                    "stripeClasses": [],
                                    "lengthMenu": [70, 100],
                                    "pageLength": 70
                                } );
                                $('#familia').change( function() { table.draw(); } );
                    }
                    // do whatever you want if console is [object object] then stringify the response




                })
            }
        }).mount('#meApp')
        </script>
@endslot
@endcomponent
