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
              <div class="col-sm-3 col-6">
                <div class="form-group">
                  <label for="fullName">Abreviatura</label>
                  <input type="text" v-model="model.abreviatura" class="form-control mb-4" placeholder="">
                </div>
              </div>
              <div class="col-sm-3 col-6">


                <div class="form-group ">
                  <label>Activo</label>
                  <select v-model="model.inactivo" class="form-control">

                    <option value="1">Activo</option>
                    <option value="1">Inactivo</option>

                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-6">


                <div class="form-group ">
                  <label>Categoria</label>
                  <select v-model="model.categoria_id" class="form-control">

                    <option v-for="m in categorias" :value="m.id">{{m.name}}</option>

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
        model: {
          inactivo: 1,
          nombre: '',
          apellidos: '',
          documento_id: '',
          categoria_id: 1,
          doc: '',
          cargo: '',
          telefono: '',
          direccion: '',
          garante: '',
          dir_garante: '',
          cel_garante: '',

        },
        documentos: [],
        categorias: [],
        producto: {
          id: 0,
          name: '',
          medida_productos: []

        },
        medida: {
          id: 0,
          medida: {

          },
          sub_medidas: []
        },
        sub_medida: {

        },
        productos: [],
        sub_medidas: [],
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
      addSubMedida() {
        let sb = {...this.sub_medida}
        this.sub_medidas.push(sb)
      },
      async Save() {
        block.block();
        try {
          this.model.sub_medidas = this.sub_medidas
          let url = "url_path()api/proveedorComprasAves";
          await axios.post("{{url('api/proveedorComprasAves')}}", this.model)
          this.back()

        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      back() {
        window.location.replace(document.referrer);
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {



          await Promise.all([self.GET_DATA('documentos'),
            self.GET_DATA('categorias'),
            self.GET_DATA('productos')
          ]).then((v) => {
            self.documentos = v[0]
            self.categorias = v[1]
            self.productos = v[2]
          })
          if (self.documentos.length) {
            self.model.documento_id = self.documentos[0].id
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
