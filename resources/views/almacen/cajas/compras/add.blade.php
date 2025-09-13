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

              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Fecha </label>
                  <input v-model="model.fecha" id="datePicker" type="date" class="form-control mb-4">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group ">
                  <label>Almacen</label>
                  <div class="input-group mb-4">
                    <select v-model="model.almacen_id" class="form-control">


                      <option v-for="(m,i) in almacens" :value="m.id">{{m.name}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group ">
                  <label>Proveedor</label>
                  <div class="input-group mb-4">
                    <select v-model="model.caja_proveedor_id" class="form-control">


                      <option v-for="(m,i) in proveedors" :value="m.id">{{m.nombre}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group ">
                  <label>Tipo</label>
                  <div class="input-group mb-4">
                    <select v-model="model.tipo" class="form-control">
                    <option  :value="1">CONTADO</option>
                    <option  :value="2">CREDITO</option>
                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Monto </label>
                  <input v-model="model.monto" v-bind:disabled="model.tipo==1" type="text" class="form-control mb-4">
                </div>
              </div>

              <div class="col-3">
                <div class="form-group ">
                  <label>Banco</label>
                  <div class="input-group mb-4">
                    <select v-model="model.banco_id" class="form-control">


                      <option v-for="(m,i) in bancos" :value="m.id">{{m.name}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-12">
                <hr>

              </div>
              <div class="col-3">
                <div class="form-group ">
                  <label>Cajas</label>
                  <div class="input-group mb-4">
                    <select v-model="caja_model" @change="caja_model.cantidad=1" class="form-control">


                      <option v-for="(m,i) in cajas" :value="m">{{m.name}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Cantidad</label>
                  <input v-model.number="caja_model.cantidad" type="text" class="form-control mb-4">
                </div>
              </div>

              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Compra</label>
                  <input v-model.number="caja_model.compra" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Venta</label>
                  <input v-model.number="caja_model.venta" type="text" class="form-control mb-4">
                </div>
              </div>


              <div class="col-sm-12 col-12">
                <button class="btn btn-success w-100 mb-4" @click="AgregarProducto()" type="button">Agregar</button>
              </div>
              <div class="col-12">
                <div class="table-responsive mb-4 mt-4">
                  <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Compra</th>
                        <th>Venta</th>

                        <th class="text-center">Accion</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(m,i) in cajas_model">
                        <td>{{i+1}}</td>
                        <td>{{m.name}}</td>
                        <td class="td-c"> <input v-model.number="m.cantidad" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.compra" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.venta" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>


                          <td class="text-center"><svg @click="cajas_model.splice(i,1)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></td>
                      </tr>
                    </tbody>
                    <tfoot>

                      <tr class="table-default" >

                          <td colspan="4"  >Total</td>

                          <td colspan="3" class="text-left bg-white text-black">{{Number(Total).toFixed(2)}}</td>
                      </tr>


                    </tfoot>
                  </table>
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
        sucursal_id: 1,
        model: {
          inactivo: 1,
          tipo: 2,
          monto: 0,
          camion: '',
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
          banco_id: '',

          medidas: []
        },
        caja_model: {
          nro: 0,
          peso: 0,
          cantidad: 1,
        },
        producto: {
          name: '',
          medida_cajas: []
        },
        categoria: {

        },
        medida_producto: {

        },
        categorias: [],
        medidas: [],
        almacens: [],
        proveedors: [],
        data: [],
        bancos: [],
        cajas: [],
        cajas_model: [],
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
        block.block();
        try {

          this.model.total=this.Total
          this.model.user_id =this.user_id
          this.model.sucursal_id =this.sucursal_id

          this.model.cajas_model=this.cajas_model
          let res = await axios.post("{{url('api/compraCajas')}}", this.model)
          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        let compra = res.data
        swalWithBootstrapButtons({
          title: 'Compra Guardada',
          text: "Su Compra fue guardada",
          type: 'success',
          showCancelButton: true,
          confirmButtonText: 'PDF',
          cancelButtonText: 'REGRESAR',
          reverseButtons: true,
          padding: '2em'
        }).then(async (result) => {
          if (result.value) {
            try {


              window.open(compra.url_pdf, '_blank');
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



          await Promise.all([self.GET_DATA('categorias'), self.GET_DATA('medidas'), self.GET_DATA('cajas'), self.GET_DATA('almacens'), self.GET_DATA('cajaProveedors'),self.GET_DATA('bancos')]).then((v) => {
            self.categorias = v[0]
            self.medidas = v[1]
            self.cajas = v[2]
            self.almacens = v[3]
            self.proveedors = v[4]
            self.bancos = v[5]
            if(self.categorias.length){
              self.categoria = self.categorias[0]
            }
            if(self.cajas.length){
              self.caja_model = self.cajas[0]
              self.caja_model.cantidad =1
            }
            if(self.almacens.length){
              self.model.almacen_id = self.almacens[0].id
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
