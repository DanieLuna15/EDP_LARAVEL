@component('application')
@slot('body')
@verbatim
<div  id="block_ui">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-12">
        <div class="row justify-content-center">
          <div class="col-sm-12 col-12">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Iniciar Contrato</h6>
                  <div class="row">
                    <div class="col-3">
                      <button class="btn btn-warning w-100" @click="back()">Regresar</button>
                    </div>
                    <div class="col-9">
                      <button data-toggle="modal" data-target="#modalCrud2" class="btn btn-success w-100">Seleccionar Persona</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="personaValidate" class="col-sm-12 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Informacion General</h6>
                  <div class="row">
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Nombre Completo</label>
                        <input :value="persona.nombre+' '+persona.apellidos" type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Documento</label>
                        <input :value="persona.documento.name+' '+persona.doc" type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">


                      <div class="form-group ">
                        <label>Tipo de contrato</label>
                        <select v-model="model.tipocontrato_id" class="form-control">

                          <option v-for="m in tipocontratos" :value="m.id">{{m.name}}</option>

                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">


                      <div class="form-group ">
                        <label>Contrato servicio</label>
                        <select v-model="model.servicio" class="form-control">

                          <option  :value="1">NO</option>
                          <option  :value="2">SI</option>

                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">


                      <div class="form-group ">
                        <label>Area</label>
                        <select v-model="model.area_id" class="form-control">

                          <option v-for="m in areas" :value="m.id">{{m.name}}</option>

                        </select>
                      </div>
                    </div>


                    <div class="col-sm-3 col-6">
                      <div class="form-group">
                        <label for="fullName">Inicio Contrato</label>
                        <input type="date" v-model="model.inicio" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="form-group">
                        <label for="fullName">Fin Contrato</label>
                        <input type="date" v-model="model.fin" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Sueldo</label>
                        <input type="text" v-model="model.sueldo" class="form-control mb-4" placeholder="">

                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Terminos</label>
                        <input type="text" v-model="model.terminos" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="personaValidate" class="col-sm-12 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Asignacion de costos fijos</h6>
                  <div class="row">

                    <div class="col-sm-12 col-12">


                      <div class="form-group ">
                        <label>Gastos Fijos</label>
                        <select v-model="gasto" class="form-control">

                          <option v-for="m in costofijos" :value="m">{{m.name}} - {{m.monto}}% </option>

                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-12 mb-4">
                      <button class="btn btn-primary w-100" @click="addCosto(gasto)">Agregar</button>
                    </div>
                    <div class="col-12">

                      <div class="table-responsive">
                        <table class="table table-hover table-dark mb-4">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th>Nombre</th>
                              <th>Monto</th>

                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(m,i) in costos">
                              <td class="text-center">{{i+1}}</td>
                              <td>{{m.name}}</td>
                              <td>{{m.monto}}%</td>


                              <td class=" text-center">
                                <div class="icon-container" @click="costos.splice(i,1)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                  </svg>
                                </div>
                              </td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-sm-12 col-12 mb-4">
                      <button class="btn btn-success w-100" @click="Save()">Guardar Contrato</button>
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
  <div class="modal fade" id="modalCrud2" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCrud">Seleccionar Persona</h5>
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
              <label for="inputEmail4">Buscar</label>
              <input type="text" v-model="buscar" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group col-md-12">
              <div class="table-responsive">
                <table class="table table-hover table-dark mb-4">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Documento</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(m,i) in filterPersonas">
                      <td class="text-center">{{i+1}}</td>
                      <td>{{m.nombre}}</td>
                      <td>{{m.apellidos}}</td>
                      <td>{{m.doc}}</td>

                      <td class=" text-center">
                        <div class="icon-container" @click="persona=m" data-dismiss="modal">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                            <polyline points="20 6 9 17 4 12"></polyline>
                          </svg>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
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
  let block = new Block()

  createApp({
    data() {
      return {
        buscar: '',
        user_id:1,
        sucursal_id:1,
        model: {

          tipocontrato_id: '',
          area_id: '',
          inicio: '',
          fin: '',
          sueldo: '',
          terminos: '',
          servicio:1
        },
        persona: {},
        gasto: {
          id: ''
        },
        areas: [],
        costos: [],
        personas: [],
        costofijos: [],
        tipocontratos: [],

      }
    },
    computed: {
      filterPersonas() {
        if (this.buscar != '') {
          let buscar = this.buscar
          return this.personas.filter((p) => {
            let nombre = p.nombre + ' ' + p.apellidos
            let doc = p.doc
            return nombre.toLowerCase().indexOf(buscar.toLowerCase()) != -1 || doc.toLowerCase().indexOf(buscar.toLowerCase()) != -1
          })
        }
        return this.personas
      },
      personaValidate() {
        return this.persona.hasOwnProperty('id')
      }
    },
    methods: {
      async GET_DATA(path) {
        try {
          let res = await axios.get("{{url('')}}/" + path)
          return res.data
        } catch (e) {

        }
      },
      async Save() {
        block.block();
        try {
          this.model.sucursal_id = this.sucursal_id

          this.model.persona_id = this.persona.id
          this.model.user_id = this.user_id
          this.model.costos = this.costos

          let url = "{{url('api/contratos')}}";
         let res = await axios.post(url,this.model)

          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        let planilla = res.data
        swalWithBootstrapButtons({
          title: 'Contrato Guardada',
          text: "Su Contrato fue guardada",
          type: 'success',
          showCancelButton: true,
          confirmButtonText: 'PDF',
          cancelButtonText: 'REGRESAR',
          reverseButtons: true,
          padding: '2em'
        }).then(async (result) => {
          if (result.value) {
            try {


              window.open(planilla.url_pdf, '_blank');
              this.back()
            } catch (e) {

            }
          }else{
             this.back()
          }
        })
        } catch (e) {

        } finally {
          // block.unblock();
        }
      },
      back() {
        window.location.replace(document.referrer);
      },
      addCosto(m) {
        const costo = m
        this.costos.push(costo)
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {



          await Promise.all([self.GET_DATA('api/personas'), self.GET_DATA('api/tipocontratos'), self.GET_DATA('api/areas'), self.GET_DATA('api/costofijos')]).then((v) => {
            self.personas = v[0]
            self.tipocontratos = v[1]
            self.areas = v[2]
            self.costofijos = v[3]
          })
          if (self.tipocontratos.length) {
            self.model.tipocontrato_id = self.tipocontratos[0].id
          }
          if (self.areas.length) {
            self.model.area_id = self.areas[0].id
          }
          if (self.costofijos.length) {
            self.gasto = self.costofijos[0]
          }

        } catch (e) {

        } finally {
          let login = localStorage.getItem('AppUser')
        if(login==null){

        }
        let sucursal = localStorage.getItem('AppSucursal')
            if (sucursal != null) {
              this.sucursal_id = JSON.parse(sucursal);

            }
        // let login_user = JSON.parse(login)
        // this.user_id = login_user.id
          block.unblock();
        }

      })
    }
  }).mount('#meApp')
        </script>
@endslot
@endcomponent
