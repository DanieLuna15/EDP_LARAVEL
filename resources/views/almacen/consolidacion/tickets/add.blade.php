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

              <div class="col-6">
                <div class="form-group ">
                  <label>Lotes</label>

                  <div class="input-group mb-4">

                    <select v-model="model.compra_id" class="form-control">

                      <template v-for="(m,i) in consolidacionPagos">

                        <option v-if="m.tipo==2&&m.adelanto!=m.suma_total" :value="m.id">{{m.fecha_limite}} -  Total: {{m.suma_total}} - Pendiente: {{m.suma_total-m.adelanto}}</option>


                      </template>

                    </select>
                    <button class="btn btn-success " @click="GetLote()" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                      </svg></button>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <hr>
                <div v-if="!lote.hasOwnProperty('suma_total')" class="alert alert-warning alert-dismissible fade show mb-4" role="alert">

                  <strong>Sin Consolidacion!</strong> Seleccione un consolidacion para comenzar con el pago.
                </div>
                <div v-else class="row">

                  <div class="col-xxl-10 col-xl-12 col-lg-10 col-md-10 col-sm-10 mx-auto">

                    <div class="card">
                      <div class="card-body">
                        <h4>Detalle de Consolidacion</h4>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive mb-4 mt-4">
                              <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                  <tr>
                                    <th>Fecha Compra</th>
                                    <th>Lote</th>
                                    <th>Peso Total</th>
                                    <th>Valor Total</th>




                                  </tr>
                                </thead>
                                <tbody>
                                  <tr  v-for="(m,i) in categoriaList">
                                    <td class="td-c">{{m.consolidacion.compra.fecha}} </td>
                                    <td class="td-c">{{m.consolidacion.compra.nro}} </td>

                                    <td class="td-c">{{m.consolidacion.peso_total}} </td>
                                    <td class="td-c">{{m.consolidacion.valor_total}} </td>




                                  </tr>
                                </tbody>

                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>

                </div>
              </div>


              <div v-if="lote.hasOwnProperty('suma_total')"  class="col-sm-2 col-12 m-4">
                <div class="form-group">
                  <label for="fullName">Valor Total</label>
                  <input :value="Number(lote.suma_total).toFixed(2)" disabled type="text" class="form-control mb-4">
                </div>
              </div>

              <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-2 col-12 m-4">
                <div class="form-group">
                  <label for="fullName">Valor Pagado</label>
                  <input :value="Number(lote.adelanto).toFixed(2)" disabled type="text" class="form-control mb-4">
                </div>
              </div>
              <div  v-if="lote.hasOwnProperty('suma_total')" class="col-sm-2 col-12 m-4">
                <div class="form-group">
                  <label for="fullName">Valor Pendiente</label>
                  <input :value="Number(lote.suma_total-lote.adelanto).toFixed(2)" disabled type="text" class="form-control mb-4">
                </div>
              </div>


              <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-2 col-12 m-4">
                <div class="form-group">
                  <label for="fullName">Valor a Pagar</label>
                  <input v-model="pagar.valor"  type="text" class="form-control mb-4">
                </div>
              </div>

              <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-2 m-4">
                        <label for="">Bancos</label>
                        <select class="form-control mb-4" v-model="pagar.banco_id">
                          <template v-for="(m,i) in bancos">

                            <option :value="m.id">{{m.name}} - {{m.titular}} - {{m.cuenta}}</option>


                          </template>
                        </select>
                      </div>
              <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-6">
                        <label for="">Formas de pago</label>
                        <select class="form-control mb-4" v-model="pagar.formapago_id">
                          <template v-for="(m,i) in formapagos">

                            <option :value="m.id">{{m.name}}</option>


                          </template>
                        </select>
                      </div>

                      <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-6">
                <div class="form-group">
                  <label for="fullName">Observaciones</label>
                  <input v-model="pagar.observaciones"  type="text" class="form-control mb-4">
                </div>
              </div>

              <div v-if="!lote" class="col-sm-12 col-12">
                <hr>
              </div>
              <div  v-else class="col-12">

              </div>

            <div class="col-sm-12 col-12">
              <hr>
            </div>
            <div v-if="lote.hasOwnProperty('suma_total')" class="col-sm-12 col-12">
              <h3>Lista de pagos Realizados</h3>
              <table class="table">
                <thead>
                  <tr>
                    <td>Fecha</td>
                    <td>Banco</td>
                    <td>Forma de pago</td>
                    <td>Observaciones</td>
                    <td>Monto</td>
                  </tr>
                </thead>
                  <tbody>
                    <tr v-for="m in lote.consolidacion_pago_tickets">
                        <td>{{m.fecha_hora}}</td>
                        <td>{{m.banco.name}}</td>
                        <td>{{m.formapago.name}}</td>
                        <td>{{m.observaciones}}</td>
                        <td>{{m.monto}}</td>
                      </tr>
                  </tbody>
              </table>
            </div>

            <div class="col-6">
              <button class="btn btn-dark w-100" @click="back()">Regresar</button>
            </div>
            <div class="col-6" v-if="lote.hasOwnProperty('suma_total')">
              <button v-if="pagar.valor>0&&pagar.valor<=Number(lote.suma_total-lote.adelanto)" class="btn btn-primary w-100" @click="Save()">Guardar</button>
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
          pagar: 1,
          camion: '',
          placa: '',
          chofer: '',
          e_recepcion: '',
          e_despacho: '',

          fecha: '',
          hora: '',
          almacen_id: '',
          compra_id: '',

          medidas: []
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
        paramConsolidacion: {

        },
        medida_producto: {

        },
        pago:{
          tipo:1,
          fecha:"",
          adelanto:0,
          banco_id:1,
        },
        pagar:{
            valor:0,
            banco_id:1,
            formapago_id:1,
            observaciones:""
        },
        lote: {
          consolidacion_pago_tickets:[]
        },
        consolidacionPagos: [],
        consolidacionParams: [],
        medidas: [],
        bancos: [],
        almacens: [],
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
        },
        formapagos:[]

      }
    },
    computed: {
      categoriaList() {
        if (!this.lote) {

          return []
        }

        return this.lote.consolidacion_pago_detalles
      },
      SumPeso() {
        return this.categoriaList.reduce((a, b) => a + Number(b.oficial), 0)
      },
      SumValor() {
        return this.categoriaList.reduce((a, b) => a + Number(b.precioCompra), 0)
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
      async GetLote() {
        block.block();
        try {
          let res = await axios.get("{{url('api')}}/consolidacionPagos/" + this.model.compra_id)
          this.lote = res.data
        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      AgregarProducto() {
        let medidas = this.medida_producto
        let bruto = Number(this.producto_model.peso) / Number(this.producto_model.nro)
        let neto = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.producto_model.cantidad)))
        let sub = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.producto_model.cantidad))) / Number(this.producto_model.nro)
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
          categoria: {},
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
        let neto = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.productos_model[i].producto_model.cantidad)))
        let sub = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida.retraccion) * Number(this.productos_model[i].producto_model.cantidad))) / Number(this.productos_model[i].producto_model.nro)
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
          this.pagar.id = this.lote.id
          this.pagar.total = this.lote.suma_total
          this.pagar.pendiente = this.lote.suma_total-this.lote.adelanto
          let res = await axios.post("{{url('api/consolidacionPagoTickets')}}",this.pagar)
          const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success btn-rounded',
            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
            buttonsStyling: false,
          })
          let consolidacion = res.data
          swalWithBootstrapButtons({
            title: 'Consolidacion Guardada',
            text: "Su Consolidacion fue guardada",
            type: 'success',
            showCancelButton: true,
            confirmButtonText: 'PDF',
            cancelButtonText: 'REGRESAR',
            reverseButtons: true,
            padding: '2em'
          }).then(async (result) => {
            if (result.value) {
              try {


                window.open(consolidacion.url_pdf, '_blank');
                this.back()
              } catch (e) {

              }
            } else {
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



          await Promise.all([self.GET_DATA('consolidacionPagos'), self.GET_DATA('consolidacionparams'), self.GET_DATA('productos'), self.GET_DATA('almacens'),
          self.GET_DATA('bancos'),
          self.GET_DATA('formapagos')
        ]).then((v) => {
            self.consolidacionPagos = v[0]
            self.consolidacionParams = v[1]
            self.productos = v[2]
            self.almacens = v[3]
            self.bancos = v[4]
            self.formapagos = v[5]
          })
          if (self.consolidacionParams.length) {
            self.paramConsolidacion = self.consolidacionParams[0]
          }
          if (self.bancos.length) {
            self.pago.banco_id = self.bancos[0].id
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
  .fm-ct {
    width: 100px;
  }

  td.td-c {
    width: 100px;
  }
</style>
@endslot
@endcomponent
