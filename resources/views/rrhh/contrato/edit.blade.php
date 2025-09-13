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
                  <h6 class="">Editar Contrato</h6>

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
                        <input :value="model.persona.nombre+' '+model.persona.apellidos" disabled type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Documento</label>
                        <input :value="model.persona.documento.name+' '+model.persona.doc" disabled type="text" class="form-control mb-4">
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
                            <tr v-for="(m,i) in model.detalles">
                              <td class="text-center">{{i+1}}</td>
                              <td>{{m.costofijo.name}}</td>
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
                      <button class="btn btn-success w-100" @click="Save()">Guardar</button>
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
        model: {

          tipocontrato_id: '',
          area_id: '',
          inicio: '',
          fin: '',
          sueldo: '',
          terminos: '',
          persona: {},
          detalles:[]
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

      personaValidate() {
        return this.model.persona.hasOwnProperty('id')
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




          let res = await axios.put("{{url('/api/contratos')}}/"+this.model.id,this.model)
          this.back()

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



          await Promise.all([self.GET_DATA("api/contratos/{{$id}}"), self.GET_DATA('api/tipocontratos'), self.GET_DATA('api/areas'), self.GET_DATA('api/costofijos')]).then((v) => {
            self.model = v[0]
            self.tipocontratos = v[1]
            self.areas = v[2]
            self.costofijos = v[3]
          })


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
