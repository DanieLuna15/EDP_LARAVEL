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
                  <h6 class="">Contrato</h6>
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
                    <div class="col-12 text-center">
                      <hr>
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>DESDE</th>
                            <th>HASTA</th>
                            <th>MES</th>
                            <th>SUELDO</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(m) in contrato.planilla_lista">
                            <td>{{m.desde}}</td>
                            <td>{{m.hasta}}</td>
                            <td>{{m.mes}}</td>
                            <td>{{m.sueldo}}</td>
                          </tr>
                        </tbody>
                      </table>
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
                  <h6 class="">Finiquito Anual</h6>
                  <div class="row">

                    <div class="col-sm-4 col-12">


                      <div class="form-group ">
                        <label>Nro de meses trabajados</label>
                        <input type="text" :value="contrato.planilla_lista.length" class="form-control mb-4" disabled placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-8 col-12">


                      <div class="form-group ">
                        <label>Estado</label>
                        <input type="text" :value="contrato.planilla_lista.length<12?'NO APTO PARA FINIQUITO ANUAL':'APTO PARA FINIQUITO ANUAL'" disabled class="form-control mb-4" placeholder="">
                      </div>
                    </div>
                    <div v-if="contrato.planilla_lista.length>0" class="col-12 ">
                     <div class="row">
                     <div class="col-sm-6 col-12">


<div class="form-group ">
  <label>Desde</label>
  <input type="text" :value="contrato.planilla_lista[0].desde" class="form-control mb-4" disabled placeholder="">

</div>
</div>
<div class="col-sm-6 col-12">


<div class="form-group ">
  <label>Hasta</label>
  <input type="text" :value="contrato.planilla_lista[contrato.planilla_lista.length-1].hasta" class="form-control mb-4" disabled placeholder="">
</div>
</div>
                     </div>
                    </div>
                    <div class="col-12 text-center">
                      <hr>
                      <h5 class="text-primary">Valor Finiquito</h5>
                      <h2>{{Number(ValorFiniquito).toFixed(2)}}</h2>
                    </div>
                    <div v-if="contrato.planilla_lista.length>=12" class="col-sm-12 col-12 mb-4">
                      <button class="btn btn-primary w-100" @click="save()">Guardar</button>
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
  let block = new Block()

  createApp({
    data() {
      return {
        buscar: '',
        user_id: 1,
        model: {

          tipocontrato_id: '',
          area_id: '',
          inicio: '',
          fin: '',
          sueldo: '',
          terminos: '',

        },
        contrato: {
          planilla_lista:[],
          cog_planilla:{}
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
            return nombre.toLowerCase().indexOf(buscar.toLowerCase()) != -1 || doc.toLowerCase().indexOf(buscar.toLowerCase()) != -1
          })
        }
        return this.contratos
      },
      personaValidate() {
        return this.contrato.hasOwnProperty('id')
      },
      ValorFiniquito() {
        return this.contrato.planilla_lista.reduce((a, b) => a + Number(b.sueldo), 0)/this.contrato.planilla_lista.length
      },
      SueldoBruto() {
        return Number(this.contrato.sueldo) - Number( Number(this.contrato.sueldo)*(Number(this.contrato.contratocostos_sum) / 100))
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
        let valor = faltas+extras+atraso+vendido
        return this.SueldoBruto+valor+this.SumCostos-this.PagosDeudaValor
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
      async save() {
        block.block();
        try {
          this.model.user_id = this.user_id
          this.model.contrato_id = this.contrato.id
          this.model.pago = this.ValorFiniquito
          this.model.fechainicio = this.contrato.planilla_lista[this.contrato.planilla_lista.length-1].hasta
          this.model.fecha = this.contrato.planilla_lista[this.contrato.planilla_lista.length-1].fecha
          this.model.planillas =this.contrato.planilla_lista

          let url = "{{url('api/finiquitoanuals')}}";
          let res = await axios.post(url,this.model)
          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        let planilla = res.data
        swalWithBootstrapButtons({
          title: 'Finiquito anual Guardado',
          text: "Su Finiquito fue guardado",
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



          await Promise.all([self.GET_DATA('api/contratos-finiquitoanuals'), self.GET_DATA('api/tipocontratos'), self.GET_DATA('api/areas'), self.GET_DATA('api/costovariables')]).then((v) => {
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
        //   let login_user = JSON.parse(login)
        // this.user_id = login_user.id
          block.unblock();

        }

      })
    }
  }).mount('#meApp')
        </script>
@endslot
@endcomponent
