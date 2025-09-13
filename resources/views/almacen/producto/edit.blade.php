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
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Nombre</label>
                  <input v-model="model.name" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Complemento</label>
                  <input v-model="model.complemento" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Tipo</label>
                  <select v-model="model.tipo" class="form-control">

                      <option value="1">POLLO</option>
                      <option value="0">PRESA</option>
                      <option value="2">AVE</option>

                    </select>
                </div>
              </div>
              <div class="col-12">
                <hr>

              </div>
              <div class="col-12">
                <div class="form-group ">
                  <label>Cajas</label>
                  <div class="input-group mb-4">
                    <select v-model="medida" class="form-control">


                      <option v-for="(m,i) in medidas" :value="m">{{m.name}}</option>

                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-primary" @click="AgregarMedida()" type="button">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div id="iconsAccordion" class="accordion-icons">
                  <div class="card" v-for="(m,i) in model.medida_productos">
                    <div class="card-header" id="headingOne3">
                      <section class="mb-0 mt-0">
                        <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionOne" aria-expanded="true" aria-controls="iconAccordionOne">
                          <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                              <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                              <polygon points="12 15 17 21 7 21 12 15"></polygon>
                            </svg></div>
                          {{m.medida.name}}
                          <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                              <polyline points="18 15 12 9 6 15"></polyline>
                            </svg></div>
                        </div>
                      </section>
                    </div>

                    <div id="iconAccordionOne" class="collapse show" aria-labelledby="headingOne3" data-parent="#iconsAccordion" style="">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6 col-12">
                            <div class="form-group">
                               <label for="fullName">Cantidad de pollos x {{m.medida.name}}</label>
                              <input v-model="m.valor" type="text" class="form-control mb-4">
                            </div>
                          </div>
                          <div class="col-sm-6 col-12">
                            <div class="form-group">
                              <label for="fullName">Retraccion</label>
                              <input :value="m.medida.retraccion" type="text" disabled class="form-control mb-4">
                            </div>
                          </div>
                          <div class="col-12">
                            <hr>

                          </div>
                          <div class="col-12">
                            <div class="row">
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Nombre</label>
                                  <input v-model="submedida.name" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Peso Inicio</label>
                                  <input v-model="submedida.valor_1" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Peso Fin</label>
                                  <input v-model="submedida.valor_2" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">N° Orden</label>
                                  <input v-model="submedida.nro_orden" type="text" class="form-control mb-4">
                                </div>
                              </div>


                              <div class="col-12">


                                <button class="btn btn-success w-100" @click="AgregarSubmedida(m)" type="button">Agregar</button>


                              </div>
                              <div class="col-12">
                                <hr>
                              </div>
                           <div class="col-12" v-if="submedida_edit.hasOwnProperty('id')">
                            <div class="row">
                            <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Nombre</label>
                                  <input v-model="submedida_edit.name" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Peso Inicio</label>
                                  <input v-model="submedida_edit.valor_1" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Peso Fin</label>
                                  <input v-model="submedida_edit.valor_2" type="text" class="form-control mb-4">
                                </div>
                              </div>
                              <div class="col-sm-3 col-12">
                                <div class="form-group">
                                  <label for="fullName">Peso Fin</label>
                                  <input v-model="submedida_edit.nro_orden" type="text" class="form-control mb-4">
                                </div>
                              </div>


                              <div class="col-12">
                                <div class="row">
                                  <div class="col-6">
                                    <button class="btn btn-primary w-100" @click="ActualizarSubmedida()" type="button">Actualizar</button>

                                  </div>
                                  <div class="col-6">
                                    <button class="btn btn-danger w-100" @click="EliminarSubmedida()" type="button">Eliminar</button>

                                  </div>
                                </div>



                              </div>
                            </div>
                           </div>
                              <div class="col-12">
                                <hr>
                              </div>
                              <div class="col-12">

                              <ul class="list-group task-list-group">
                                  <li class="list-group-item list-group-item-action" v-for="(s,e) in m.sub_medidas">
                                    <div class="n-chk">
                                      <label class="new-control new-checkbox checkbox-primary w-100 justify-content-between">
                                        <input type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span>
                                        <span class="ml-2">
                                        <b>{{s.name}}</b> | <b>Peso Inicio:</b>{{s.valor_1}} | <b>Peso Fin:</b>{{s.valor_2}} | <b>N° Orden:</b>{{s.nro_orden}}
                                        </span>
                                        <span class="ml-2">
                                          <ul class="table-controls">
                                              <li><a href="javascript:void(0);" @click="submedida_edit=s" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                          </ul>
                                        </span>

                                      </label>
                                    </div>
                                  </li>

                                </ul>

                              </div>
                              <div class="col-12 mt-4">
                              <button class="btn btn-dark w-100" @click="EliminarMedida(m)" type="button">Eliminar Medida</button>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

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
        model:{
          inactivo:1,
          nombre:'',
          apellidos:'',
          documento_id:'',
          doc:'',
          cargo:'',
          telefono:'',
          direccion:'',
          garante:'',
          dir_garante:'',
          cel_garante:'',
          medida_productos:[],
          tipo:1
        },
        categorias: [],
        medidas: [],
        submedida: {
          name: '',
          valor_1: 0,
          valor_2: 0,
          nro_orden:0
        },
        submedida_edit:{

        },
        medida:{

        }
      }
    },
    methods: {
      async GET_DATA(path) {
        try {
          let res = await axios.get("{{url('api')}}/" + path)
          return res.data
        } catch (e) {

        }
      },
      async Save() {
        block.block();
        try {


         await axios.put("{{url('api/productos')}}/{{$id}}",this.model)
          this.back()

        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async EliminarSubmedida() {
        block.block();
        let self = this
        try {


         await axios.delete("{{url('api/subMedidas')}}/"+this.submedida_edit.id)
         this.submedida_edit ={}
         await Promise.all([self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.model = v[0]
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async EliminarMedida(m) {
        block.block();
        let self = this
        try {


         await axios.delete("{{url('api/medidaProductos')}}/"+m.id)
         this.submedida_edit ={}
         await Promise.all([self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.model = v[0]
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async AgregarMedida() {
        block.block();
        let self = this
        try {


         await axios.post("{{url('api/medidaProductos')}}",{medida_id:this.medida.id,producto_id:this.model.id})
         this.submedida_edit ={}
         await Promise.all([self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.model = v[0]
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async AgregarSubmedida(m) {
        block.block();
        let self = this
        try {

        let medida = {...m}
        medida.name= this.submedida.name
        medida.valor_1= this.submedida.valor_1
        medida.valor_2= this.submedida.valor_2
        medida.nro_orden= this.submedida.nro_orden
         await axios.post("{{url('api/subMedidas')}}",medida)
         this.submedida_edit ={}
         await Promise.all([self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.model = v[0]
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async ActualizarSubmedida() {
        block.block();
        let self = this
        try {


         await axios.put("{{url('api/subMedidas')}}/"+this.submedida_edit.id,this.submedida_edit)
         this.submedida_edit ={}
         await Promise.all([self.GET_DATA('categorias'),self.GET_DATA('medidas'),self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.categorias = v[0]
            self.medidas = v[1]
            self.model = v[2]
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      back(){
        window.location.replace(document.referrer);
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {



          await Promise.all([self.GET_DATA('categorias'),self.GET_DATA('medidas'),self.GET_DATA("productos/{{$id}}")]).then((v) => {
            self.categorias = v[0]
            self.medidas = v[1]
            self.model = v[2]
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
