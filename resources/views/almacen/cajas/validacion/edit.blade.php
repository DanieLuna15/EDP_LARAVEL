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
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Nro de compra</label>
                  <input v-model="model.nro" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Fecha</label>
                  <input v-model="model.fecha" type="date" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Hora</label>
                  <input v-model="model.hora" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">Chofer</label>
                  <input v-model="model.chofer" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Camion</label>
                  <input v-model="model.camion" type="text" class="form-control mb-4">
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
                  <label for="fullName">E. Despacho</label>
                  <input v-model="model.e_despacho" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-3 col-12">
                <div class="form-group">
                  <label for="fullName">E. Recepcion</label>
                  <input v-model="model.e_recepcion" type="text" class="form-control mb-4">
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
                    <select v-model="model.proveedor_compra_id" class="form-control">


                      <option v-for="(m,i) in proveedors" :value="m.id">{{m.nombre}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-12">
                <hr>

              </div>
              <div class="col-3">
                <div class="form-group ">
                  <label>Productos</label>
                  <div class="input-group mb-4">
                    <select v-model="producto" @change="CambioProducto()" class="form-control">


                      <option v-for="(m,i) in productos" :value="m">{{m.name}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Cantidad de cajas</label>
                  <input v-model="producto_model.cantidad" @change="producto_model.nro=producto_model.cantidad*Number(medida_producto.valor)" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group ">
                  <label>Cajas</label>
                  <div class="input-group mb-4">
                    <select v-model="medida_producto" class="form-control">


                      <option v-for="(m,i) in producto.medida_productos" :value="m">{{m.medida.name}}</option>

                    </select>

                  </div>
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Nro Pollos</label>
                  <input v-model="producto_model.nro" type="text" class="form-control mb-4">
                </div>
              </div>
              <div class="col-sm-2 col-12">
                <div class="form-group">
                  <label for="fullName">Peso Bruto</label>
                  <input v-model="producto_model.peso" type="text" class="form-control mb-4">
                </div>
              </div>


              <div class="col-sm-12 col-12">
                <button class="btn btn-success w-100 mb-4" @click="AgregarProducto(i)" type="button">Agregar</button>
              </div>
              <div class="col-12">
                <div class="table-responsive mb-4 mt-4">
                  <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cant Caja</th>
                        <th>Peso Bruto</th>
                        <th>Peso Neto</th>
                        <th>Nro Pollos</th>
                        <th>Peso Uni</th>
                        <th>Tipo de cinta</th>
                        <th>Categoria</th>
                        <th class="text-center">Accion</th>

                      </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(m,i) in productos_model" class="table-danger">
                        <td>{{i+1}}</td>
                        <td>{{m.producto.name}}</td>
                        <td class="td-c"> <input v-model.number="m.producto_model.cantidad" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.producto_model.peso" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input disabled :value="m.producto_model.peso-(Number(m.medida_producto.medida.retraccion)*Number(m.producto_model.cantidad))" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.producto_model.nro" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> {{Number(Number(m.producto_model.peso-(Number(m.medida_producto.medida.retraccion)*Number(m.producto_model.cantidad)))/Number(m.producto_model.nro)).toFixed(2)}} </td>

                        <td> <select v-model="m.sub_medida" class="form-control">


                            <option v-for="(c,e) in m.medida_producto.sub_medidas" :value="c">{{c.name}}</option>

                          </select></td>
                          <td> <select v-model="m.categoria" class="form-control">


                                                  <option v-for="(c,e) in categorias" :value="c">{{c.name}}</option>

                              </select></td>
                          <td class="text-center"><svg @click="productos_model.splice(i,1)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></td>
                      </tr>
                      <tr v-for="(m,i) in detalles">
                        <td>{{i+1}}</td>
                        <td>{{m.inventario.producto.name}}</td>
                        <td class="td-c"> <input v-model.number="m.cant" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.valor" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input disabled :value="m.valor-(Number(m.sub_medida.medida_producto.medida.retraccion)*Number(m.cant))" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> <input v-model.number="m.nro" @change="ChangeProducto(i)" type="text" class="fm-ct form-control "></td>
                        <td class="td-c"> {{Number(Number(m.valor-(Number(m.sub_medida.medida_producto.medida.retraccion)*Number(m.cant)))/Number(m.nro)).toFixed(2)}} </td>

                        <td> <select v-model="m.sub_medida.id" class="form-control">


                            <option v-for="(c,e) in m.medida_producto.sub_medidas" :value="c.id">{{c.name}}</option>

                          </select></td>
                          <td> <select v-model="m.categoria" class="form-control">


                                                  <option v-for="(c,e) in categorias" :value="c">{{c.name}}</option>

                              </select></td>
                          <td class="text-center"><svg @click="m.estado=0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr class="table-default" >

                          <td colspan="5"  >Cantidad de Pollos</td>

                          <td colspan="4" class="text-left bg-white text-black">{{SumCantPollos}}</td>
                      </tr>
                      <tr class="table-default" >

                          <td colspan="5"  >Cantidad de Cajas</td>

                          <td colspan="4" class="text-left bg-white text-black">{{SumCantEnvases}}</td>
                      </tr>
                      <tr class="table-default" >

                          <td colspan="5"  >Peso Bruto Total</td>

                          <td colspan="4" class="text-left bg-white text-black">{{Number(SumPesoBruto).toFixed(2)}}</td>
                      </tr>
                      <tr  class="table-primary" >

                          <td colspan="5"  >Retraccion de Tara</td>

                          <td colspan="4" class="text-left bg-white text-black">-{{Number(SumRetraccion).toFixed(2)}}</td>
                      </tr>
                      <tr class="table-default" >

                          <td colspan="5"  >Peso Neto Total</td>

                          <td colspan="4" class="text-left bg-white text-black">{{Number(SumPesoNeto).toFixed(2)}}</td>
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
        model: {
          inactivo: 1,
          camion: '',
          placa: '',
          nro: '',
          chofer: '',
          e_recepcion: '',
          e_despacho: '',
          proveedor_compra_id:'',
          fecha: '',
          hora: '',
          almacen_id: '',

          medidas: [],
          compra_inventarios: [],
        },
        producto_model: {
          nro: 0,
          peso: 0,
          cantidad: 1,
        },
        producto: {
          name: '',
          medida_productos: []
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
        productos: [],
        productos_model: [],
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

      detalles() {
        return this.model.compra_inventarios.filter((e)=>e.estado==1);
      },
      SumCantPollos() {
        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.cantidad)*Number(b.medida_producto.valor)), 0)
        return mas+ this.detalles.reduce((a, b) => a + Number(Number(b.cant)*Number(b.valor)), 0)
      },
      SumCantEnvases() {
        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.cantidad)), 0)
        return mas+ this.detalles.reduce((a, b) => a + Number(Number(b.cant)), 0)
      },
      SumPesoBruto() {
        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.peso)), 0)

        return mas+ this.detalles.reduce((a, b) => a + Number(Number(b.valor)), 0)
      },
      SumPesoNeto() {
        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.peso)-(Number(b.medida_producto.medida.retraccion)*Number(b.producto_model.cantidad))), 0)

        return mas+ this.detalles.reduce((a, b) => a + Number(Number(b.valor)-(Number(b.sub_medida.medida_producto.medida.retraccion)*Number(b.cant))), 0)
      },
      SumRetraccion() {
        let mas = this.productos_model.reduce((a, b) => a + (Number(b.medida_producto.medida.retraccion)*Number(b.producto_model.cantidad)), 0)

        return mas+ this.detalles.reduce((a, b) => a + (Number(b.sub_medida.medida_producto.medida.retraccion)*Number(b.cant)), 0)
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
        let medidas = this.medida_producto
        let bruto = Number(this.producto_model.peso) / Number(this.producto_model.nro)
        let neto = Number(Number(this.producto_model.peso)-(Number(medidas.medida.retraccion)*Number(this.producto_model.cantidad)))
        let sub = Number(Number(this.producto_model.peso)-(Number(medidas.medida.retraccion)*Number(this.producto_model.cantidad)))/ Number(this.producto_model.nro)
        let unit = {}
        medidas.sub_medidas.map((a) => {
          let valor_1 = Number(a.valor_1)
          let valor_2 = Number(a.valor_2)
          if (sub >= valor_1 && sub <= valor_2) {
            unit = a
          }
        })
        const producto = {
          sub_medida: unit,
          producto: {
            name: this.producto.name,
            id: this.producto.id,
          },
          categoria:{...this.categoria},
          medida_producto: medidas,
          producto_model: {
            peso: this.producto_model.peso,
            neto: neto,
            nro: this.producto_model.nro,
            cantidad: this.producto_model.cantidad,
          },

        }
        this.productos_model.push(producto)
      },
      ChangeProducto(i) {
        let medidas = this.productos_model[i].medida_producto
        this.productos_model[i].producto_model.nro = this.productos_model[i].medida_producto.valor * this.productos_model[i].producto_model.cantidad

        let bruto = Number(this.productos_model[i].producto_model.peso) / Number(this.productos_model[i].producto_model.nro)
        let neto = Number(Number(this.productos_model[i].producto_model.peso)-(Number(medidas.medida.retraccion)*Number(this.productos_model[i].producto_model.cantidad)))
        let sub = Number(Number(this.productos_model[i].producto_model.peso)-(Number(medidas.medida.retraccion)*Number(this.productos_model[i].producto_model.cantidad)))/ Number(this.productos_model[i].producto_model.nro)
        let unit = {}
        medidas.sub_medidas.map((a) => {
          let valor_1 = Number(a.valor_1)
          let valor_2 = Number(a.valor_2)
          if (sub >= valor_1 && sub <= valor_2) {
            unit = a
          }
        })

        this.productos_model[i].producto_model.neto = neto
        this.productos_model[i].sub_medida = unit
      },
      CambioProducto() {

        this.medida_producto = this.producto.medida_productos[0]
        this.producto_model.nro = this.producto_model.cantidad * Number(this.medida_producto.valor)
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
          this.model.sum_cant_pollos=this.SumCantPollos
          this.model.sum_cant_envases=this.SumCantEnvases
          this.model.sum_peso_bruto=this.SumPesoBruto
          this.model.sum_peso_neto=this.SumPesoNeto
          this.model.sum_retraccion=this.SumRetraccion
          this.model.productos_model=this.productos_model
          let res = await axios.put("{{url('api/compras')}}/{{$id}}", this.model)
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



          await Promise.all([self.GET_DATA('categorias'), self.GET_DATA('medidas'), self.GET_DATA('productos'), self.GET_DATA('almacens'), self.GET_DATA('proveedorCompras'),self.GET_DATA("compras/{{$id}}")]).then((v) => {
            self.categorias = v[0]
            self.medidas = v[1]
            self.productos = v[2]
            self.almacens = v[3]
            self.proveedors = v[4]
            self.model = v[5]
            if(self.categorias.length){
              self.categoria = self.categorias[0]
            }
            if(self.productos.length){
              self.producto = self.productos[0]
              if(self.producto.medida_productos.length){
                self.medida_producto = self.producto.medida_productos[0]
              }
            }
            if(self.almacens.length){
              self.model.almacen_id = self.almacens[0].id
            }
            if(self.proveedors.length){
              self.model.proveedor_compra_id = self.proveedors[0].id
            }
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
  .fm-ct {
    width: 100px;
  }

  td.td-c {
    width: 100px;
  }
</style>
@endslot
@endcomponent
