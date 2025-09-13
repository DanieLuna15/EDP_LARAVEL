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


                  <div class="form-group ">
                    <label>Estado Compra Chofer</label>
                    <select v-model="model.estado_compra_chofer_id" class="form-control">

                      <option v-for="m in estadoCompraChofers" :value="m.id">{{m.name}}</option>

                    </select>
                  </div>
                </div>

                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">N° Doc</label>
                    <input type="text" v-model="model.doc" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Placa</label>
                    <input v-model="model.placa" type="text" class="form-control mb-4">
                  </div>
                </div>
              <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Color</label>
                    <input v-model="model.color" type="text" class="form-control mb-4">
                  </div>
                </div>

              <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Modelo</label>
                    <input v-model="model.modelo" type="text" class="form-control mb-4">
                  </div>
                </div>
              <div class="col-sm-4 col-12">
                  <div class="form-group">
                    <label for="fullName">Zona/Ruta</label>
                    <input v-model="model.zona" type="text" class="form-control mb-4">
                  </div>
                </div>
              <div class="col-sm-3 col-12">
                  <div class="form-group">
                    <label for="fullName">Capacidad</label>
                    <input v-model.number="model.capacidad" type="text" class="form-control mb-4">
                  </div>
                </div>
                <div class="col-12 mt-2">
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
          tipocliente_id:1,
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
          correo:'',
          latitud:'',
          longitud:'',
          creditos_activos:0,
          dias_horas:"",
          limite_crediticio:0,
          cinta_cliente_id:1,
          estado_compra_chofer_id:1,
        },
        documentos: [],
        tipoclientes: [],
        cintaClientes: [],
        estadoCompraChofers: [],
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

          let url = "url_path()api/chofers";
         await axios.post("{{url('api/chofers')}}",this.model)
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



          await Promise.all([self.GET_DATA('documentos'),self.GET_DATA('tipoclientes'),

          self.GET_DATA('cintaClientes'),
          self.GET_DATA('estadoCompraChofers'),
        ]).then((v) => {
            self.documentos = v[0]
            self.tipoclientes = v[1]
            self.cintaClientes = v[2]
            self.estadoCompraChofers = v[3]
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


@slot('style')
<style>
  #map { height: 280px; }
</style>
@endslot
@endcomponent
