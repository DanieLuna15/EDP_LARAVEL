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

                      <option v-for="m in documentos" :value="m.id">{{m.name}}</option>

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
                    <input type="text" v-model="model.direccion" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Telefono</label>
                    <input type="text" v-model="model.telefono" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Encargado</label>
                    <input type="text" v-model="model.encargado" class="form-control mb-4" placeholder="">
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

        },
        documentos: []

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

          let url = "url_path()api/cajaProveedors";
         await axios.post("{{url('api/cajaProveedors')}}",this.model)
          this.back()

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



          await Promise.all([self.GET_DATA('documentos')]).then((v) => {
            self.documentos = v[0]
          })
          if(self.documentos.length){
            self.model.documento_id=self.documentos[0].id
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
