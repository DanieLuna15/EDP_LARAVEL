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
          <div class="alert  mb-4" :class="contrato.apto==true?'alert-success':'alert-danger'" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Nota!</strong> {{contrato.apto==true?'El personal esta apto para cobrar la siguiente planilla':'El personal aun no esta apto para cobrar la siguiente planilla'}}. </div>
          <div class="alert alert-dark mb-4"  role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Nota!</strong> Falta {{contrato.fincontrato}} meses para finalizar el contrato. </div>

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
                      <button class="btn btn-success w-100" @click="addCosto(gasto)">Agregar</button>
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
                  <h6 class="">Finiquitos vacacionales disponibles</h6>
                  <div class="row">

                    <div class="col-12">

                      <div class="table-responsive">
                        <table class="table table-hover table-dark mb-4">
                          <thead>
                            <tr>
                              <th class="text-center">#</th>
                              <th>Fecha Inicio</th>
                              <th>Fecha Fin</th>
                              <th>Monto</th>

                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(m,i) in finivacacionals">
                              <td class="text-center">{{i+1}}</td>
                              <td>{{m.fecha_inicio}}</td>
                              <td>{{m.fecha_fin}}</td>
                              <td>{{m.pago}}</td>


                              <td class=" text-center">
                                <div v-if="m.estado==0" class="icon-container" @click="m.estado=1">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                  </svg>
                                </div>
                                <div v-else class="icon-container" @click="m.estado=0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>

                                </div>
                              </td>
                            </tr>

                          </tbody>
                          <tfoot>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>{{Number(SumFinivacacional).toFixed(2)}}</td>


                              <td class=" text-center">

                              </td>
                            </tr>

                          </tfoot>
                        </table>
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Finiquito vacacional</h5>
                      <h2>{{Number(SumFinivacacional).toFixed(2)}}</h2>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="personaValidate" class="col-sm-6 col-12 mt-4">
            <div class="widget-content widget-content-area br-6 " :class="ValorBrutoPago<0?'bg-dark':''">
              <div class="section general-info">
                <div class="info">
                  <h6 class="">Adeudos</h6>
                  <div class="row">


                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Monto</label>
                        <input type="text" v-model.number="monto_deuda" class="form-control mb-4" placeholder="">
                      </div>
                    </div>



                    <div class="col-sm-8 col-12">

                    <label>Plan de pagos</label>
                      <div class="input-group mb-4">
                        <input type="text" v-model.number="pagos" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username">
                        <div class="input-group-append">
                          <button class="btn btn-primary" @click="Crear()" type="button">Generar</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">

                    <label>Motivo de adeudo</label>
                    <input type="text" v-model.number="model.motivo_adeudo" class="form-control"  >

                    </div>
                    <div v-for="n in pagosDeuda" class="col-4 text-left">
                      <label>Monto a pagar</label>
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <label class="switch s-primary mb-0">
                              <input type="checkbox" v-model="n.estado" :disabled="n.estado!=true&&(ValorBrutoPago-n.monto)<0" checked="">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <input type="text" v-model.number="n.monto" class="form-control" placeholder="Switch" aria-label="switch">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                      <div class="col-6 text-center">
                      <hr>
                      <h5 class="text-primary">Adeudo a Pagar</h5>
                      <h2>{{Number(PagosDeudaValor).toFixed(2)}}</h2>
                    </div>
                    <div class="col-6 text-center">
                      <hr>
                      <h5 class="text-danger">Adeudo Pendiente</h5>
                      <h2>{{Number(monto_deuda-PagosDeudaValor).toFixed(2)}}</h2>
                    </div>

                      </div>
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
                  <h6 class="">HISTORIAL DE ADEUDOS</h6>
                  <div class="row">
                    <div class="col-sm-12 col-12">
                    <select v-model="adeudohistorial" @change="recorreradeudo()" class="form-control">

<option v-for="m in contrato.adeudas" :value="m">{{m.fecha}} - {{m.monto}} - {{m.plan}} cuotas  </option>

</select>
                    </div>

                    <div v-for="n in adeudohistorial.adeudacuotas" class="col-4 text-left">
                      <label>Monto a pagar</label>
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <label class="switch  mb-0" :class="n.pagado==1?'s-danger':'s-primary'">
                              <input type="checkbox" v-model="n.pagar" :disabled="n.pagado==1" checked="">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <input type="text" v-model.number="n.monto" class="form-control" placeholder="Switch" aria-label="switch">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Monto a pagar</h5>
                      <h2>{{Number(SumPagoHistorialAdeudos).toFixed(2)}}</h2>
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
        user_id: 1,
        sucursal_id:1,
        model: {
          terminos:'',
          tipocontrato_id: '',
          area_id: '',
          inicio: '',
          fin: '',
          sueldo: '',
          terminos: '',
          motivo_adeudo: '',
        },
        observacion:'',
        contrato: {
          cog_planilla:{},
          finivacacionals:[],
          adeudas:[],
          persona:{

          }
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
        },
        adeudohistorial:{
          adeudacuotas:[]
        }
      }
    },
    computed: {
      filterPagoAdeudos() {
        if (this.contrato.adeudas.length>0) {
          return this.contrato.adeudas.flatMap(
            a=>a.adeudacuotas.filter((p) => {

                return p.pagar==true&&p.pagado!="1"
              }
          ))
        }
        return []
      },
      SumPagoHistorialAdeudos() {
        return this.filterPagoAdeudos.reduce((a, b) => a + Number(b.monto), 0)
      },
      filterPersonas() {
        if (this.buscar != '') {
          let buscar = this.buscar
          return this.contratos.filter((p) => {
            let nombre = p.persona.nombre + ' ' + p.persona.apellidos
            let doc = p.persona.doc
            return nombre.toLowerCase().indexOf(buscar.toLowerCase()) != -1 || doc.toLowerCase().indexOf(buscar.toLowerCase()) != -1
          })
        }
        return this.contratos
      },
      filterFinivacacional() {

          return this.finivacacionals.filter((p) => {

            return p.estado==0
          })

      },
      finivacacionals() {

          return this.contrato.finivacacionals.filter((p) => {

            return p.planilla==1
          })
        // return []
      },
      personaValidate() {
        return this.contrato.hasOwnProperty('id')
      },
      SueldoBruto() {
        return Number(this.contrato.sueldo) - Number( Number(this.contrato.sueldo)*(Number(this.contrato.contratocostos_sum) / 100))
      },
      SumFinivacacional() {

        return this.filterFinivacacional.reduce((a, b) => a + Number(b.pago), 0)
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
        let monto = parseFloat(this.contrato.cog_planilla.sueldo_base / dias)
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
        let finiquito = this.SumFinivacacional
        let SumPagoHistorialAdeudos = this.SumPagoHistorialAdeudos
        let valor = faltas+extras+atraso+vendido
        return this.SueldoBruto+valor+this.SumCostos-this.PagosDeudaValor+Number(finiquito)-SumPagoHistorialAdeudos
      }
    },
    methods: {
      recorreradeudo(){
        return this.adeudohistorial.adeudacuotas.forEach(c => {
          if(!c.hasOwnProperty('pagar')){

            c.pagar = c.pagado=="1"?true:false;
          }else{

          }
        });
      },
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
          this.model.sucursal_id = this.sucursal_id

          this.model.user_id = this.user_id
          this.model.contrato_id = this.contrato.id
          this.model.fijos = this.contrato.contratocostos_sum
          this.model.sueldo = this.contrato.sueldo
          this.model.bruto = this.ValorBrutoPago
          this.model.variables = this.SumCostos
          this.model.adeuda = this.monto_deuda
          this.model.desde = this.contrato.desde
          this.model.hasta = this.contrato.hasta
          this.model.plan = this.pagos
          this.model.costos = this.costos
          this.model.a_falta = this.adicional.falta
          this.model.a_extras = this.adicional.extras
          this.model.a_adicional = this.adicional.adicional
          this.model.a_vendida = this.adicional.vendida
          this.model.valor_vacaciones = this.SumFinivacacional
          this.model.a_atrasos = this.adicional.atrasos
          this.model.pagos_deuda = this.pagosDeuda
          this.model.vendido_caja = this.ValorVendidaCaja
          this.model.valor_extra = this.ValorExtras
          this.model.valor_atraso = this.ValorAtraso
          this.model.valor_falta = this.ValorFaltas
          this.model.cuotas = this.pagosDeuda
          this.model.vacacionals = this.filterFinivacacional
          this.model.pago_adeudos = this.filterPagoAdeudos
          this.model.observacion = this.observacion

          let url = "{{url('api/planillas')}}";
          let res = await axios.post(url,this.model);
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
        //   let login = localStorage.getItem('AppUser')
        // if(login==null){

        // }
        // let login_user = JSON.parse(login)
        // this.user_id = login_user.id
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
