@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-12">
        <div class="row justify-content-center">
          <div class="col-sm-12 col-12">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Planilla</h6>
                  <div class="row">
                    <div class="col-3">
                      <button class="btn btn-warning w-100" @click="back()">Regresar</button>
                    </div>
                    <div class="col-9">
                      <button data-toggle="modal" data-target="#modalCrud2" class="btn btn-success w-100">Seleccionar Persona</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="personaValidate" class="col-sm-6 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Informacion General</h6>
                  <div class="row">
                    <div class="col-sm-4 col-12">
                      <div class="form-group">
                        <label for="fullName">Nombre Completo</label>
                        <input :value="contrato.persona.nombre+' '+contrato.persona.apellidos" type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">
                      <div class="form-group">
                        <label for="fullName">Documento</label>
                        <input :value="contrato.persona.documento.name+' '+contrato.persona.doc" type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">
                      <div class="form-group">
                        <label for="fullName">Cargo</label>
                        <input :value="contrato.area.name" type="text" class="form-control mb-4">
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">
                      <div class="form-group">
                        <label for="fullName">Tipo de contrato</label>
                        <input :value="contrato.tipocontrato.name" type="text" class="form-control mb-4">
                      </div>
                    </div>

                    <div class="col-sm-4 col-6">
                      <div class="form-group">
                        <label for="fullName">Inicio Contrato</label>
                        <input type="date" v-model="contrato.inicio" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-4 col-6">
                      <div class="form-group">
                        <label for="fullName">Fin Contrato</label>
                        <input type="date" v-model="contrato.fin" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="form-group">
                        <label for="fullName">Planilla desde</label>
                        <input type="date" v-model="contrato.desde" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-3 col-6">
                      <div class="form-group">
                        <label for="fullName">Planilla hasta</label>
                        <input type="date" v-model="contrato.hasta" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-6 ">
                      <div class="form-group">
                        <label for="fullName">Planilla correspondiente</label>
                        <input type="text" v-model="contrato.mes" disabled class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Sueldo</label>
                        <input type="text" v-model="contrato.sueldo" class="form-control mb-4" placeholder="">

                      </div>
                    </div>
                    <div class="col-sm-6 col-12">
                      <div class="form-group">
                        <label for="fullName">Costo Fijos</label>
                        <input type="text" v-model="contrato.contratocostos_sum" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Sueldo Bruto</h5>
                      <h2>{{Number(SueldoBruto).toFixed(2)}}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="personaValidate" class="col-sm-6 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Detalle de pago</h6>
                  <div class="row">


                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Desde</label>
                        <input type="date" v-model="model.desde" class="form-control mb-4" placeholder="">
                      </div>
                    </div>


                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Hasta</label>
                        <input type="date" v-model="model.hasta" class="form-control mb-4" placeholder="">
                      </div>
                    </div>


                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Horas</label>
                        <input type="text" v-model.number="model.horas" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Horas Valor</label>
                        <input type="text" v-model.number="model.horas_valor" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-8 col-12">


                      <div class="form-group ">
                        <label>Motivo</label>
                        <input type="text" v-model="model.motivo" class="form-control mb-4" placeholder="">
                      </div>
                    </div>


                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Pago</h5>
                      <h2>{{Number(ValorPagoHoras).toFixed(2)}}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="personaValidate" class="col-sm-6 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Asignacion de costos variables</h6>
                  <div class="row">

                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Costos variables</label>
                        <select v-model="gasto" class="form-control">

                          <option v-for="m in costovariables" :value="m">{{m.name}} </option>

                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Costos Tipo</label>
                        <select v-model="tipogasto" class="form-control">

                          <option value="1">SUMAR</option>
                          <option value="2">RESTAR</option>

                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Monto de costo</label>
                        <input type="text" v-model.number="monto" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-12 col-12 mb-4">
                      <button class="btn btn-primary w-100" @click="addCosto(gasto)">Agregar</button>
                    </div>
                    <div class="col-12">

                      <div class="table-responsive">
                        <table class="table table-hover table-dark mb-4">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th>Nombre</th>
                              <th>Monto</th>

                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(m,i) in costos">
                              <td class="text-center">{{i+1}}</td>
                              <td>{{m.costo.name}}</td>
                              <td>{{m.monto}}</td>


                              <td class=" text-center">
                                <div class="icon-container" @click="costos.splice(i,1)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                  </svg>
                                </div>
                              </td>
                            </tr>

                          </tbody>
                          <tfoot>
                            <tr>
                              <td></td>
                              <td></td>
                              <td>{{Number(SumCostos).toFixed(2)}}</td>


                              <td class=" text-center">

                              </td>
                            </tr>

                          </tfoot>
                        </table>
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Sueldo Bruto</h5>
                      <h2>{{Number(SueldoBruto+SumCostos).toFixed(2)}}</h2>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="personaValidate" class="col-sm-6 col-12 mt-4">
            <div class="widget-content widget-content-area br-6">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">CONVENIO / ATRASOS / FALTAS / HORAS EXTRA / DESCUENTOS</h6>
                  <div class="row">
                    <div class="col-sm-6 col-12">

                      <label for="">Falta</label>
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" v-model.number="adicional.falta">
                        <div class="input-group-prepend">
                          <span class="input-group-text">=</span>
                          <span class="input-group-text">{{Number(ValorFaltas).toFixed(2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">

                      <label for="">Atrasos</label>
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" v-model.number="adicional.atrasos">
                        <div class="input-group-prepend">
                          <span class="input-group-text">=</span>
                          <span class="input-group-text">{{Number(ValorAtraso).toFixed(2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">

                      <label for="">Vendida Caja</label>
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" v-model.number="adicional.vendida">
                        <div class="input-group-prepend">
                          <span class="input-group-text">=</span>
                          <span class="input-group-text">{{Number(ValorVendidaCaja).toFixed(2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-12">

                      <label for="">Horas Extras</label>
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" v-model.number="adicional.extras">
                        <div class="input-group-prepend">
                          <span class="input-group-text">=</span>
                          <span class="input-group-text">{{Number(ValorExtras).toFixed(2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3 col-12">


                      <div class="form-group ">
                        <label>Atrasos</label>
                        <input type="text" v-model.number="adicional.falta" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-3 col-12">


                      <div class="form-group ">
                        <label>Vendida Caja</label>
                        <input type="text" v-model.number="adicional.falta" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-3 col-12">


                      <div class="form-group ">
                        <label>Horas Extras</label>
                        <input type="text" v-model.number="adicional.falta" class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="fullName">Observacion</label>
                        <input v-model="observacion" type="text" class="form-control mb-4">
                      </div>
                    </div>


                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Sueldo Bruto</h5>
                      <h2>{{Number(ValorBrutoPago).toFixed(2)}}</h2>
                    </div>

                    <div class="col-sm-12 col-12 mb-4">
                      <button class="btn btn-success w-100" @click="Save()">Guardar</button>
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
  <div class="modal fade" id="modalCrud2" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCrud">Seleccionar Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row mb-4">
            <div class="form-group col-md-12">
              <label for="inputEmail4">Buscar</label>
              <input type="text" v-model="buscar" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group col-md-12">
              <div class="table-responsive">
                <table class="table table-hover table-dark mb-4">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Documento</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(m,i) in filterPersonas">
                      <td class="text-center">{{i+1}}</td>
                      <td>{{m.persona.nombre}}</td>
                      <td>{{m.persona.apellidos}}</td>
                      <td>{{m.persona.doc}}</td>

                      <td class=" text-center">
                        <div class="icon-container" @click="contrato=m" data-dismiss="modal">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                            <polyline points="20 6 9 17 4 12"></polyline>
                          </svg>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
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
        let dt = new Table()
        let block = new Block()
        createApp({
    data() {
      return {
        buscar: '',
        user_id:1,
        sucursal_id:1,
        observacion:'',
        model: {
          horas_valor:0,
          horas:0,
          tipocontrato_id: '',
          area_id: '',
          inicio: '',
          desde: '',
          hasta: '',
          fin: '',
          sueldo: '',
          terminos: '',
          motivo: '',

        },
        contrato: {
          cog_planilla:{},
          finivacacionals:[]
        },
        gasto: {
          id: ''
        },
        areas: [],
        costos: [],
        monto_deuda: 0,
        pagos: 1,
        tipogasto: 1,
        contratos: [],
        costovariables: [],
        tipocontratos: [],
        pagosDeuda: [],
        adicional: {
          falta: 0,
          atrasos:0,
          vendida:0,
          extras:0
        }
      }
    },
    computed: {
      filterPersonas() {
        if (this.buscar != '') {
          let buscar = this.buscar
          return this.contratos.filter((p) => {
            let nombre = p.persona.nombre + ' ' + p.persona.apellidos
            let doc = p.persona.doc
            return nombre.toLowerCase().indexOf(buscar.toLowerCase()) != -1 || doc.toLowerCase().indexOf(buscar.toLowerCase()) != -1 && p.servicio==2
          })
        }
        return this.contratos.filter((p) =>p.servicio==2)
      },
      filterFinivacacional() {

          return this.finivacacional.filter((p) => {

            return p.estado==0
          })

      },
      finivacacional() {

          return this.contrato.finivacacionals.filter((p) => {

            return p.planilla==1
          })

      },
      personaValidate() {
        return this.contrato.hasOwnProperty('id')
      },
      ValorPagoHoras() {
        return Number(this.model.horas) *Number(this.model.horas_valor)
      },
      SueldoBruto() {
        return Number(this.contrato.sueldo) - Number( Number(this.contrato.sueldo)*(Number(this.contrato.contratocostos_sum) / 100))
      },
      SumFinivacacional() {
        return this.filterFinivacacional.reduce((a, b) => a + b.pago, 0)
      },
      SumCostos() {
        return this.costos.reduce((a, b) => a + b.monto, 0)
      },
      PagosDeudaValor() {
        return this.pagosDeuda.reduce((a, b) => a + (b.estado == true ? b.monto : 0), 0)
      },
      ValorFaltas() {
        let dias = parseInt(this.contrato.cog_planilla.dias_base);
        let falta = parseInt(this.adicional.falta);
        let monto = parseFloat(this.contrato.sueldo / dias)

        return 0-(falta*monto);
      },
      ValorExtras() {
        let dias = parseInt(this.contrato.cog_planilla.dividir_dia);
        let horas = parseInt(this.contrato.cog_planilla.dividir_hora);
        let extras = parseInt(this.adicional.extras);
        let monto = parseFloat(this.contrato.sueldo / dias)
        monto = parseFloat(monto / horas)

        return (extras*monto);
      },
      ValorAtraso() {
        let dias = parseInt(this.contrato.cog_planilla.dias_base);
        let atraso = parseInt(this.adicional.atrasos/this.contrato.cog_planilla.atraso);
        let monto = parseFloat(this.contrato.sueldo / dias)

        return 0-(atraso*monto);
      },
      ValorVendidaCaja() {
        let valor = parseInt(this.contrato.cog_planilla.multiplicar);
        let monto = parseFloat(this.adicional.vendida)

        return (valor*monto);
      },
      ValorBrutoPago(){
        let faltas = this.ValorFaltas
        let extras = this.ValorExtras
        let atraso = this.ValorAtraso
        let vendido = this.ValorVendidaCaja
        let ValorPagoHoras = this.ValorPagoHoras
        let finiquito = this.SumFinivacacional
        let valor = faltas+extras+atraso+vendido
        return this.SueldoBruto+valor+this.SumCostos-this.PagosDeudaValor+Number(finiquito)+ValorPagoHoras
      }
    },
    methods: {
      Crear() {
        let pagos = parseInt(this.pagos)
        let monto = parseFloat(this.monto_deuda / pagos)
        let formated = []

        for (let i = 0; i < pagos; i++) {

          formated.push({
            monto: monto,
            estado: false
          })
        }

        this.pagosDeuda = formated

      },
      async GET_DATA(path) {
        try {
          let res = await axios.get("{{url('')}}/" + path)
          return res.data
        } catch (e) {

        }
      },
      async Save() {
        block.block();
        try {
          this.model.user_id = this.user_id
          this.model.sucursal_id = this.sucursal_id
          this.model.contrato_id = this.contrato.id
          this.model.fijos = this.contrato.contratocostos_sum
          this.model.sueldo = this.contrato.sueldo
          this.model.bruto = this.ValorBrutoPago
          this.model.variables = this.SumCostos
          this.model.adeuda = this.monto_deuda
          this.model.plan = this.pagos
          this.model.costos = this.costos
          this.model.a_falta = this.adicional.falta
          this.model.a_extras = this.adicional.extras
          this.model.a_adicional = this.adicional.adicional
          this.model.a_vendida = this.adicional.vendida
          this.model.a_atrasos = this.adicional.atrasos
          this.model.pagos_deuda = this.pagosDeuda
          this.model.vendido_caja = this.ValorVendidaCaja
          this.model.valor_extra = this.ValorExtras
          this.model.valor_atraso = this.ValorAtraso
          this.model.valor_falta = this.ValorFaltas
          this.model.cuotas = this.pagosDeuda
          this.model.vacacionals = this.filterFinivacacional
          this.model.observacion = this.observacion

          let url = "{{url('api/planillaservicios')}}";
          let res = await axios({
            method: 'post',
            url: url,
            headers: {},
            data: this.model
          });
          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        let planilla = res.data
        swalWithBootstrapButtons({
          title: 'Planilla Guardada',
          text: "Su planilla fue guardada",
          type: 'success',
          showCancelButton: true,
          confirmButtonText: 'PDF',
          cancelButtonText: 'REGRESAR',
          reverseButtons: true,
          padding: '2em'
        }).then(async (result) => {
          if (result.value) {
            try {


              window.open(planilla.url_pdf, '_blank');
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
      },
      addCosto(m) {
        const costo = m
        const tipocosto = this.tipogasto
        let monto = this.monto
        if (tipocosto == 2) {
          monto -= monto * 2
        }
        this.costos.push({
          costo,
          monto
        })
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {



          await Promise.all([self.GET_DATA('api/contratos'), self.GET_DATA('api/tipocontratos'), self.GET_DATA('api/areas'), self.GET_DATA('api/costovariables')]).then((v) => {
            self.contratos = v[0]
            self.tipocontratos = v[1]
            self.areas = v[2]
            self.costovariables = v[3]
          })
          if (self.tipocontratos.length) {
            self.model.tipocontrato_id = self.tipocontratos[0].id
          }
          if (self.areas.length) {
            self.model.area_id = self.areas[0].id
          }
          if (self.costovariables.length) {
            self.gasto = self.costovariables[0]
          }

        } catch (e) {

        } finally {
          let login = localStorage.getItem('AppUser')
        if(login==null){

        }
        let login_user = JSON.parse(login)
        this.user_id = login_user.id
        let sucursal = localStorage.getItem('AppSucursal')
            if (sucursal != null) {
              this.sucursal_id = JSON.parse(sucursal);

            }
          block.unblock();

        }

      })
    }
  }).mount('#meApp')
        </script>
@endslot
@endcomponent
