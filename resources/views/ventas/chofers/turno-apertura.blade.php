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
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label for="fullName">Nombres</label>
                  <input disabled v-model="model.nombre" type="text" class="form-control mb-4">
                </div>
              </div>



              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Placa</label>
                  <input v-model="model.placa" disabled type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Color</label>
                  <input v-model="model.color" disabled type="text" class="form-control mb-4">
                </div>
              </div>

              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Modelo</label>
                  <input v-model="model.modelo" disabled type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Zona/Ruta</label>
                  <input v-model="model.zona" disabled type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="form-group">
                  <label for="fullName">Capacidad</label>
                  <input v-model.number="model.capacidad" disabled type="text" class="form-control mb-4">
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-12 mt-2" v-if="model.turno_chofer!=null">
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">
            <h6 class="">Informacion de Turno</h6>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label for="">Fecha de Apertura</label>
                  <input disabled type="text" class="form-control" :value="model.turno_chofer.fecha">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="">Hora de Apertura</label>
                  <input disabled type="text" class="form-control" :value="model.turno_chofer.hora_inicio">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="">Capacidad Ocupada KG</label>
                  <input disabled type="text" class="form-control" :value="Number(model.capacidad_utilizada).toFixed(2)">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="">Capacidad disponible KG</label>
                  <input  disabled type="text" class="form-control" :value="Number(model.capacidad-model.capacidad_utilizada).toFixed(2)">
                </div>
              </div>
              <div class="col-12">
                <hr>
                <label for="">Capacidad Utilizada ({{capacidad}}%)</label>
                <div class="progress br-30">
                    <div class="progress-bar bg-gradient-primary" role="progressbar" :style="'width:'+capacidad+'%'" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <hr>
              </div>
              <div class="col">
                <a :href="model.turno_pdf" target="_blank" class="btn btn-block btn-danger w-100"> VER INFORME</a>
              </div>
              <div  class="col">
                  <button @click="CerrarTurno" class="btn btn-block btn-primary w-100">CERRAR TURNO</button>
                  </div>
              <div class="col-12 mt-2">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fecha E.</th>
                      <th>Hora E.</th>
                      <th>Cliente</th>
                      <th>Peso</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(m,i) in model.turno_chofer.venta_turno_chofer">
                      <td>{{i+1}}</td>
                      <td>{{m.venta.fecha_entrega}}</td>
                      <td>{{m.venta.hora_entrega}}</td>
                      <td>{{m.venta.cliente.nombre}}</td>
                      <td>{{m.peso}}</td>
                      <td>{{m.entregado==1?'NO ENTREGADO':'ENTREGADO'}}</td>
                      <td>
                    <div class="btn-group">
                      <a :href="'../venta-entregar/'+m.id" class="btn btn-dark btn-sm">Entregar</a>
                      <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                        <a :href="m.url_pdf" target="_blank" class="dropdown-item">Ver Venta</a>


                      </div>
                    </div>
                  </td>
                    </tr>
                  </tbody>
                </table>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-12 mt-2" v-else>
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">
            <h6 class="">DETALLE DE TURNO </h6>
            <div class="row">
              <div class="col">
                <button @click="AperturarTurno" class="btn btn-block btn-success w-100">APERTURAR</button>
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
          }
        },
        tipoclientes: [],
        documentos: [],
        cintaClientes: [],
        estadoCompraChofers: []
      }
    },
    computed:{
      capacidad(){
        return Number(this.model.capacidad_utilizada/this.model.capacidad*100).toFixed(2)
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
      async CerrarTurno() {
        block.block();
        let self = this
        try {


          let res = await axios.put("{{url('api/turnoChofers')}}/"+this.model.turno_chofer.id, this.model)
          await Promise.all([self.GET_DATA("chofers/{{$id}}")
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



          await Promise.all([self.GET_DATA('documentos'), self.GET_DATA("chofers/{{$id}}"), self.GET_DATA('tipoclientes'),
            self.GET_DATA('cintaClientes'),
            self.GET_DATA('estadoCompraChofers')
          ]).then((v) => {
            self.documentos = v[0]
            self.model = v[1]
            self.tipoclientes = v[2]
            self.cintaClientes = v[3]
            self.estadoCompraChofers = v[4]
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
@slot('style')
<style>
  #map {
    height: 280px;
  }
</style>
@endslot
@endcomponent
