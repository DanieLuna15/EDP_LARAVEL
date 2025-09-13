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
                <div class="col-sm-12 col-12">
                  <div class="form-group">
                    <label for="fullName">Nombre </label>
                    <input v-model="model.name" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Compra</label>
                    <input v-model="model.compra" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Venta</label>
                    <input v-model="model.venta" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Merma</label>
                    <input v-model="model.merma" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Tipo</label>
                    <select name="" id="" class="form-control" v-model="model.tipo">
                      <option value="1">PP</option>
                      <option value="2">PT</option>
                      <option value="3">SUB PT</option>
                    </select>
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
          name: "",
          compra: "",
          venta: "",
          merma: "",
          estado: 1

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

          let url = "url_path()api/items";
         await axios.put("{{url('api/items')}}/{{$id}}",this.model)
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



          await Promise.all([self.GET_DATA('documentos'),self.GET_DATA("items/{{$id}}")]).then((v) => {
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
