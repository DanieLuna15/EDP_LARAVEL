@component('application')
@slot('body')
@verbatim
<div id="block_ui">
  <div class="row">
    <div class="col-lg-12 col-12">
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">
            <h6 class="">Informacion del Chofer</h6>
            <div class="row">
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Fecha Entrega</label>
                  <input disabled v-model="model.venta.fecha_entrega" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Hora Entrega</label>
                  <input disabled v-model="model.venta.hora_entrega" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Peso Total KG</label>
                  <input disabled v-model="model.peso" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-9 col-12">
                <div class="form-group">
                  <label for="fullName">Cliente</label>
                  <input disabled v-model="model.venta.cliente.nombre" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Venta N°</label>
                  <input disabled v-model="model.venta.id" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div v-if="model.entregado==1" class="col">
                  <button @click="EntregarVenta" class="btn btn-block btn-primary w-100">ENTREGAR A CLIENTE</button>
                  </div>
                  <div class="col">
                  <a :href="model.venta.url_pdf" target="_blank" class="btn btn-block btn-danger w-100">VER PDF</a>
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
        model: {
          inactivo: 1,
          cinta_cliente_id: 1,
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
          estado_compra_chofer_id: 1,
          turno_chofer:{
            fecha:'',
            hora_inicio:'',
            venta_turno_chofers:[]
          },
          venta:{
            fecha_entrega:'',
            hora_entrega:'',
            cliente:{
              nombre:'',
              apellidos:'',
              documento:{
                name:'',
                abreviacion:''
              }
            }
          }
        },
        tipoclientes: [],
        documentos: [],
        cintaClientes: [],
        estadoCompraChofers: []
      }
    },
    computed:{

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
          await axios.put("{{url('api/chofers')}}/{{$id}}", this.model)
          this.back()

        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      async AperturarTurno() {
        block.block();
        let self = this
        try {


          let res = await axios.post("{{url('api/turnoChofers')}}", this.model)
          await Promise.all([self.GET_DATA("chofers/{{$id}}")
          ]).then((v) => {

            self.model = v[0]

          })


        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      async EntregarVenta() {
        block.block();
        let self = this
        try {


          let res = await axios.put("{{url('api/ventaTurnoChofers')}}/"+this.model.id, this.model)
          await Promise.all([self.GET_DATA("ventaTurnoChofers/{{$id}}")
          ]).then((v) => {

            self.model = v[0]

          })


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



          await Promise.all([ self.GET_DATA("ventaTurnoChofers/{{$id}}")
          ]).then((v) => {

            self.model = v[0]

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
@slot('style')
<style>
  #map {
    height: 280px;
  }
</style>
@endslot
@endcomponent
