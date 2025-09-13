@component('application')
@slot('body')
@verbatim
<div id="block_ui">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-12">
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">

            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-6">
                  <div class="input-group input-group-sm mt-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Nombre Producto</span>
                      </div>
                      <input type="text" class="form-control form-control-sm">
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="input-group input-group-sm mt-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Cod. Producto</span>
                      </div>
                      <input type="text" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
               <div class="row mt-2">
                <div class="col-3">
                  <div class="card">
                    <div class="card-header p-2">
                      <div class="badge badge-primary">54564564asd</div>
                    </div>
                    <div class="card-body">
                        image
                    </div>
                    <div class="card-footer p-0">
                      <div class="row p-2">
                        <div class="col-12">
                          Nomberwe
                        </div>
                        <div class="col-6">
                        <div class="badge badge-secondary">Bs 40.5</div>
                        </div>
                        <div class="col-6 text-right">
                        <div class="badge badge-success">54 Kg</div>
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
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">

            <div class="row">
              <div class="col-12 p-2">
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Buscar</span>
                  </div>
                  <input type="text" class="form-control form-control-sm" v-model="model.nombre" placeholder="Nombre">
                </div>
                <div class="input-group input-group-sm mt-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Cliente</span>
                  </div>
                  <select class="form-control form-control-sm" name="" id="">
                    <option value="">Cliente</option>
                  </select>
                </div>
                <div class="input-group input-group-sm mt-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Comprobante</span>
                  </div>
                  <select class="form-control form-control-sm" name="" id="">
                    <option value="">Ticket</option>
                  </select>
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
        model: {
          inactivo: 1,
          tipocliente_id: 1,
          nombre: '',
          apellidos: '',
          documento_id: '',
          doc: '',
          cargo: '',
          telefono: '',
          direccion: '',
          garante: '',
          dir_garante: '',
          cel_garante: '',
          correo: '',
          latitud: '',
          longitud: '',
          creditos_activos: 0,
          dias_horas: "",
          limite_crediticio: 0,
        },
        documentos: [],
        tipoclientes: [],
        lote_id: '',
        lotes: [],
        lote: {
          lote_detalles: [],
          pp_detalles: [],
          pt_detalles: [],
          pp_descomposicion_detalles: [],
        }
      }
    },
    computed: {
      imgPollo() {
        return "{{url('')}}/img/pollo.jpg"
      },
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

          let url = "url_path()api/clientes";
          await axios.post("{{url('api/clientes')}}", this.model)
          this.back()

        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      async GetLote() {
        block.block();
        try {
          let res = await axios.get("{{url('api')}}/lotes-pos/" + this.lote_id)
          this.lote = res.data
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

        try {



          await Promise.all([self.GET_DATA('lotes')]).then((v) => {
            self.lotes = v[0]

          })


        } catch (e) {

        } finally {

        }

      })
    }
  }).mount('#meApp')
</script>
@endslot


@slot('style')
<style>
  #map {
    height: 280px;
  }
</style>
@endslot
@endcomponent
