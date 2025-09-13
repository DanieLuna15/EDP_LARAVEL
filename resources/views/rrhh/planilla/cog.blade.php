@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-12">
        <div class="widget-content widget-content-area br-6">
          <div class="section general-info">
            <div class="info">
              <h6 class="">Configuracion General Planilla</h6>
              <div class="row">
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Dias Base</label>
                    <input v-model="model.dias_base" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Equivale a trasos</label>
                    <input v-model="model.atraso" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Multiplicar por:</label>
                    <input v-model="model.multiplicar" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Horas Extra Monto Base :</label>
                    <input v-model="model.sueldo_base" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Dividiar por dias:</label>
                    <input v-model="model.dividir_dia" type="text" class="form-control mb-4">
                  </div>
                </div>

                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Dividiar por Horas:</label>
                    <input v-model="model.dividir_hora" type="text" class="form-control mb-4">
                  </div>
                </div>

                <div class="col-6">
                  <button class="btn btn-warning w-100" @click="back()">Regresar</button>
                </div>
                <div class="col-6">
                  <button class="btn btn-success w-100" @click="Save()">Guardar</button>
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

          let url = "url_path()api/proveedors";
         await axios.put("{{url('api/cogplanillas')}}/1",this.model)
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



          await Promise.all([self.GET_DATA('documentos'),self.GET_DATA("cogplanillas/1")]).then((v) => {
            self.documentos = v[0]
            self.model = v[1]
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
