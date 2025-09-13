@component('application')
@slot('body')
@verbatim
<div id="block_ui">
  <div class="row justify-content-center">
    <div class="col-lg-12 col-12">
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">
          <div class="info">
            <h6 class="">Informacion General</h6>
            <div class="row">


              <div class="col-3">
                <div class="form-group ">
                  <label>Compra</label>
                  <div class="input-group mb-4">
                    <select v-model="model"  class="form-control">


                      <option v-for="(m,i) in compras" :value="m">{{m.nro}} - {{m.fecha}}</option>

                    </select>

                  </div>
                </div>
              </div>
               <div class="col-3">
                <div class="form-group">
                  <label>Almacén Origen</label>
                  <select
                    v-model="almacen_o_id"
                    @change="caja_almacen = { cantidad:1, cantidad_total:0 }"
                    class="form-control mb-4"
                  >
                    <option
                      v-for="(m, i) in origenAlmacenes"
                      :key="m.id"
                      :value="m.id"
                    >
                      {{ m.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group ">
                  <label>Almacen Destino</label>
                  <div class="input-group mb-4">
                    <select v-model="model.almacen_id" class="form-control">
                      <template v-for="(m,i) in almacens" >
                          <option v-if="m.id == model.almacen_id" :value="m.id">{{m.name}}</option>

                      </template>


                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Cajas x Lote</label>
                  <input v-model.number="model.sum_cant_envases" type="text" class="form-control mb-4" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group ">
                  <label>Cajas</label>
                  <div class="input-group mb-4">
                    <select v-model="caja_almacen" class="form-control">

                    <template v-for="(m,i) in cajas" >
                    <option  v-if="m.almacen_id == almacen_o_id"  :value="m">{{m.caja.name}}</option>

                      </template>


                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Cantidad de cajas</label>
                  <input v-model.number="cajas_select.cantidad" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Stock</label>
                  <input :value="caja_almacen.cantidad_total" disabled type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-12 col-12">
                <button v-if="cajas_select.cantidad<=caja_almacen.cantidad_total&&cajas_select.cantidad>0" class="btn btn-success w-100 mb-4" @click="AgregarCaja()" type="button">Agregar Caja</button>
              </div>
              <div class="col-sm-12 col-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Almacen Origen</th>
                        <th>Cajas</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(m,i) in cajas_almacens">
                        <td>{{m.almacen.name}}</td>
                        <td>{{m.cantidad}}</td>
                         <td ><svg @click="cajas_almacens.splice(i,1)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="col-sm-12 col-12">
                <div class="form-group">
                  <label for="fullName">Motivo</label>
                  <input v-model="model.motivo" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label for="fullName">Chofer</label>
                  <input v-model="model.chofer" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label for="fullName">Placa</label>
                  <input v-model="model.placa" type="text" class="form-control mb-4">
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
        user_id: 1,
        almacen_o_id: 1,
        sucursal_id: 1,
        model: {
          inactivo: 1,
          tipo: 2,
          sum_cant_envases:0,
          monto: 0,
          camion: '',
          motivo: '',
          placa: '',
          nro: '',
          chofer: '',
          e_recepcion: '',
          e_despacho: '',
          caja_proveedor_id:'',
          fecha: '',
          fecha2: '',
          hora: '',
          almacen_id: '',
          almacen_destino_id: '',
          banco_id: '',

          medidas: []
        },
        caja_almacen:{
          cantidad: 1,
          cantidad_total:0
        },
        caja_model: {
          nro: 0,
          peso: 0,
          cantidad: 1,
          cantidad_total:0
        },
        producto: {
          name: '',
          medida_cajas: []
        },
        categoria: {

        },
        medida_producto: {

        },
        cajas_select:{
          cantidad:0
        },
        categorias: [],
        medidas: [],
        almacens: [],
        proveedors: [],
        data: [],
        bancos: [],
        compras: [],
        cajas: [],
        cajas_model: [],
        cajas_almacens: [],
        submedida: {
          name: '',
          valor_1: 0,
          valor_2: 0,
          categoria: {
            name: ''
          }
        }

      }
    },
    computed:{

      Total() {
        return this.cajas_model.reduce((a, b) => a + Number(Number(b.cantidad)*(Number(b.compra))), 0)
      },
      origenAlmacenes() {
        // elimina del listado el que ya está en model.almacen_id
        return this.almacens.filter(a => a.id !== this.model.almacen_id)
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
      AgregarProducto() {
        let caja = {...this.caja_model}
        this.cajas_model.push(caja)
      },
      AgregarCaja(){
        let caja = {...this.caja_almacen}
        caja.cantidad = this.cajas_select.cantidad
        this.cajas_almacens.push(caja);
      },
      CambioProducto() {

        this.medida_producto = this.producto.medida_cajas[0]
        this.caja_model.nro = this.caja_model.cantidad * Number(this.medida_producto.valor)
      },
      AgregarSubmedida(i) {
        const submedida = {
          name: this.submedida.name,
          valor_1: this.submedida.valor_1,
          valor_2: this.submedida.valor_2,
          categoria: this.submedida.categoria,
        }
        this.model.medidas[i].submedidas.push(submedida)
      },

      async Save() {
        if (this.cajas_almacens.length === 0) {
          swal.fire({
            type: 'warning',
            title: '¡Atención!',
            text: 'Por favor agrega al menos una caja al contenedor de cajas antes de guardar.',
            confirmButtonText: 'OK',
          });
          return;
        }
        block.block();
        try {


          this.model.caja  =this.caja_almacen
          this.model.almacen_o_id  =this.almacen_o_id
          this.model.stock_cajas = this.caja_almacen.cantidad_total
          this.model.cajas_model=this.cajas_model
          this.model.cajas_almacens=this.cajas_almacens

          let res = await axios.post("{{url('api/cajaCompras')}}", this.model)
          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        let compra = res.data

        swalWithBootstrapButtons({
          title: 'Peticion Guardada',
          text: "Su Peticion fue guardada",
          type: 'success',
          showCancelButton: true,
          confirmButtonText: 'PDF A4 Y 8mm',
          cancelButtonText: 'REGRESAR',
          reverseButtons: true,
          padding: '2em'
        }).then(async (result) => {
          if (result.value) {
            try {
              window.open(compra.url_pdf, '_blank');
              window.open(compra.url_pdfTicket, '_blank');
              this.back()
            } catch (e) {

            }
          }else{
             this.back()
          }
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



          await Promise.all([self.GET_DATA('categorias'), self.GET_DATA('medidas'), self.GET_DATA('cajaInventarios'), self.GET_DATA('almacens'), self.GET_DATA('cajaProveedors'),self.GET_DATA('bancos'),self.GET_DATA('compras-validar-caja')]).then((v) => {
            self.categorias = v[0]
            self.medidas = v[1]
            self.cajas = v[2]
            self.almacens = v[3]
            self.proveedors = v[4]
            self.bancos = v[5]
            self.compras = v[6]
            if(self.categorias.length){
              self.categoria = self.categorias[0]
            }
            if (self.cajas.length) {
              self.caja_model = self.cajas[0]
              self.caja_almacen = self.cajas[0]
              self.caja_model.cantidad = 1
            }

            if(self.proveedors.length){
              self.model.caja_proveedor_id = self.proveedors[0].id
            }
            if(self.bancos.length){
              self.model.banco_id = self.bancos[0].id
            }

          })
          var f1 = flatpickr(document.getElementById('datePicker'));
          this.model.fecha = moment().format('YYYY-MM-DD')

        } catch (e) {

        } finally {
          let login = localStorage.getItem('AppUser')
          let login_user = JSON.parse(login)
          this.user_id = login_user.id
          let sucursal = localStorage.getItem('AppSucursal')
            if (sucursal != null) {
              sucursal = JSON.parse(sucursal);
              this.sucursal_id =sucursal.id;

            }
          block.unblock();
        }

      })
    }
  }).mount('#meApp')
</script>

@endslot
@slot('style')
<style>
  .fm-ct {
    width: 100px;
  }

  td.td-c {
    width: 100px;
  }
</style>
@endslot
@endcomponent
