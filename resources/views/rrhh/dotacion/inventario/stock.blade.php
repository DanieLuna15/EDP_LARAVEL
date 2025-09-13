@component('application')
@slot('body')
@verbatim
<div id="block_ui">

<div class="row">
  <div class="col-lg-6">
    <div class="row">
      <div class="col-12">
        <div class="input-group mb-4">
          <input type="text" v-model=buscar class="form-control" placeholder="Buscar" aria-label="}">
          <div class="input-group-append">
            <button v-if="buscarType==true" @click="buscarType=false" class="btn btn-primary" type="button">Nombre</button>
            <button v-else @click="buscarType=true" class="btn btn-info" type="button">Codigo</button>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-4" v-for="(m,i) in dotacionFilter">
            <div class="card component-card_4">
              <div class="card-body">

                <div class="user-info">
                  <h5 class="card-user_name">{{m.name}}</h5>
                  <p class="card-user_occupation">COD: {{m.codigo}}</p>
                  <div class="card-star_rating">
                    <span class="badge badge-danger mr-2">Compra {{m.costo}}</span>
                    <span class="badge badge-primary mt-2">Venta {{m.venta}}</span>
                  </div>
                  <button @click="Agregar(m)" class="btn btn-warning mt-4 btn-sm w-100">AGREGAR</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row">
      <div class="col-12 mb-2" v-for="(m,i) in dotaciones">
        <div class="widget-content widget-content-area notation-text-icon">

          <div class="media m-0">

            <div class="media-body">
              <h4 class="media-heading">{{m.dotacion.name}}</h4>

              <hr>
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Costo</label>
                        <input type="text" name="" class="form-control" v-model.number="m.dotacion.costo" id="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Venta</label>
                        <input type="text" name="" class="form-control" v-model.number="m.dotacion.venta" id="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Cantidad</label>
                        <input type="text" name="" class="form-control" v-model.number="m.cantidad" id="">
                    </div>
                </div>
              <hr>
              <div class="media-notation text-center">
              <div class="btn-group" role="group" aria-label="Basic example">

                  <button type="button"  @click="m.cantidad--" :disabled="m.cantidad<=1" class="btn btn-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  </button>
                  <button type="button" @click="m.cantidad++"  class="btn btn-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  </button>

                  <button type="button"  @click="dotaciones.splice(i,1)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                  </svg></button>
              </div>
              </div>
            </div>

            </div>
          </div>


        </div>

      <div class=" col-12 ">
        <div class="widget-three">
          <div class="widget-content">

            <div class="order-summary">

              <div class="summary-list">
                <div class="w-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                  </svg>
                </div>
                <div class="w-summary-details">

                  <div class="w-summary-info">
                    <h6>Valor Costo</h6>
                    <p class="summary-count">{{Number(dotacionesCosto).toFixed(2)}}</p>
                  </div>

                  <div class="w-summary-stats">
                    <div class="progress">
                      <div class="progress-bar bg-gradient-secondary" role="progressbar" :style="'width: '+percentCosto+'%'" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>

              </div>

              <div class="summary-list">
                <div class="w-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7" y2="7"></line>
                  </svg>
                </div>
                <div class="w-summary-details">

                  <div class="w-summary-info">
                    <h6>Valor Cantidad</h6>
                    <p class="summary-count">{{Number(dotacionesCantidad).toFixed(2)}}</p>
                  </div>

                  <div class="w-summary-stats">
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar" :style="'width: '+percentCantidad+'%'" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>

              </div>

              <div class="summary-list">
                <div class="w-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                  </svg>
                </div>
                <div class="w-summary-details">

                  <div class="w-summary-info">
                    <h6>Valor Venta</h6>
                    <p class="summary-count">{{Number(dotacionesVenta).toFixed(2)}}</p>
                  </div>

                  <div class="w-summary-stats">
                    <div class="progress">
                      <div class="progress-bar bg-gradient-warning" role="progressbar" :style="'width: '+percentVenta+'%'" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>

              </div>
              <div class="summary-list">
             <div class="row w-100">
             <div class="form-group col-md-6">
              <label for="inputEmail4">Forma de pago</label>
              <select v-model="model.formapago_id" name="" class="custom-select" id="">
                <option v-for="(m,i) in formapagos" :value="m.id">{{m.name}}</option>
              </select>
            </div>
             <div class="form-group col-md-6">
              <label for="inputEmail4">Proveedor</label>
              <select v-model="model.proveedor_id" name="" class="custom-select" id="">
                <option v-for="(m,i) in proveedors" :value="m.id">{{m.nombre}}</option>
              </select>
            </div>
             <div class="form-group col-md-6">
              <label for="inputEmail4">Fecha</label>
              <input type="date" name="" class="form-control" v-model="model.fecha" id="">
            </div>
             <div class="form-group col-md-6">
              <label for="inputEmail4">Lote</label>
              <input type="text" name="" class="form-control" v-model="model.lote" id="">
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">Motivo</label>
              <input type="text" v-model="motivo" class="form-control" placeholder="Motivo">
            </div>
             </div>

              </div>

            </div>
            <button @click="Save()" class="btn btn-block btn-primary mt-4"> GUARDAR </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCrud">Dotación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row mb-4" >

            <div class="form-group col-md-6">
              <label for="inputEmail4">Costo</label>
              <input type="text" v-model.number="dotacion_edit.dotacion.costo" class="form-control" placeholder="Costo">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Venta</label>
              <input type="text" v-model.number="dotacion_edit.dotacion.venta" class="form-control" placeholder="Venta">
            </div>
            <div class="form-group col-md-12">
              <label for="inputEmail4">Cantidad</label>
              <input type="text" v-model.number="dotacion_edit.cantidad" class="form-control" placeholder="Cantidad">
            </div>

          </div>
          <div class="form-row mb-4" >


            <div class="form-group col-md-12">
              <label for="inputEmail4">Proveedor</label>
              <select v-model="dotacion_edit.proveedor" name="" class="custom-select" id="">
                <option v-for="(m,i) in proveedors" :value="m">{{m.nombre}}</option>
              </select>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>

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
    let dt = new Table()
    let block = new Block()

  createApp({
    data() {
      return {
        edit: true,
        user_id:1,
        buscarType: true,
        buscar: '',
        motivo: '',
        model: {
          codigo: '',
          lote:'',
          formapago_id: '',
          proveedor_id: '',
          name: '',
          costo: 0,
          venta: 0,
          stock: 0,
        },
        dotacion_edit: {
          dotacion: {

          },
          proveedor: {}
        },
        data: [],
        dotaciones: [],
        proveedors: [],
        formapago: [],
        sucursal:{}
      }
    },
    computed: {
      dotacionFilter() {
        if (this.buscar != '') {
          let buscar = this.buscar
          if (this.buscarType) {
            return this.data.filter((d) => {
              let name = d.hasOwnProperty('name') ? d.name : '';
              return name.toLowerCase().indexOf(buscar.toLowerCase()) != -1
            })
          } else {
            return this.data.filter((d) => {
              let codigo = d.hasOwnProperty('codigo') ? d.codigo : '';
              return codigo.toLowerCase().indexOf(buscar.toLowerCase()) != -1
            })
          }
        }
        return this.data
      },
      dotacionesCosto() {
        return this.dotaciones.reduce((a, b) => a + Number(b.dotacion.costo) * Number(b.cantidad), 0)
      },
      dotacionesCantidad() {
        return this.dotaciones.reduce((a, b) => a + Number(b.cantidad), 0)
      },
      dotacionesVenta() {
        return this.dotaciones.reduce((a, b) => a + Number(b.dotacion.venta) * Number(b.cantidad), 0)
      },
      percentCosto() {
        if (this.dotacionesVenta > 0) {
          let valor = 100 * Number(this.dotacionesCosto)
          return valor / Number(this.dotacionesVenta)
        }
        return 0
      },
      percentCantidad() {
        if (this.dotacionesVenta > 0) {
          let valor = 100 * Number(this.dotacionesCantidad)
          return valor / Number(this.dotacionesVenta)
        }
        return 0
      },
      percentVenta() {
        if (this.dotacionesCosto > 0) {
          let valor = this.percentCosto * Number(this.dotacionesVenta)
          return valor / Number(this.dotacionesCosto)
        }
        return 0
      },
    },
    methods: {
      Agregar(param) {
        const dotacion = param;
        this.dotaciones.push({
          dotacion: {
            id: dotacion.id,
            name: dotacion.name,
            costo: dotacion.costo,
            familia_id: dotacion.familia_id,
            venta: dotacion.venta,
          },
          cantidad: 1,
          proveedor: {}
        })
      },
      back() {
        window.location.replace(document.referrer);
      },
      async Save() {
        try {
          // let res = await axios.post(, this.model)
          this.model.motivo = this.motivo
          this.model.user_id = this.user_id
          this.model.sucursal_id = this.sucursal.id
          this.model.dotaciones = this.dotaciones
          let res = await axios.post("{{url('api/stockdotacions')}}",this.model)
          let planilla = res.data
          const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })
        swalWithBootstrapButtons({
          title: 'Ingreso de stock Guardado',
          text: "Su Ingreso fue guardada",
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

        }
      },
      async GET_DATA(path) {
        try {
          let res = await axios.get("{{url('api')}}" + path)
          return res.data
        } catch (e) {

        }
      },
      async load() {
        try {
          let self = this

          try {
            await Promise.all([self.GET_DATA('/dotacions'), self.GET_DATA('/proveedors'), self.GET_DATA('/formapagos')]).then((v) => {
              self.data = v[0]
              self.proveedors = v[1]
              self.formapagos = v[2]
            })

          } catch (e) {

          }
        } catch (e) {

        }
      },

    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {
           let sucursal =  localStorage.getItem('AppSucursal')
           this.sucursal = JSON.parse(sucursal)
          await Promise.all([self.load()]).then((v) => {

          })
          dt.create()

        } catch (e) {

        } finally {
        //   let login_user = JSON.parse(login)
        // this.user_id = login_user.id
          block.unblock();
        }
        // do whatever you want if console is [object object] then stringify the response




      })
    }
  }).mount('#meApp')
</script>
@endslot
@slot('style')
<style>
  .widget-content-area {
    padding: 10px 20px;
  }

  .toggle-code-snippet {
    margin-bottom: -6px;
  }

  /*      Media Object      */

  .media {
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .media img {
    width: 50px;
    height: 50px;
    margin-right: 15px;
  }

  .media .media-body {
    align-self: center;
  }

  .media .media-body .media-heading {
    color: #3b3f5c;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 17px;
    letter-spacing: 1px;
  }

  .media .media-body .media-text {
    color: #515365;
    margin-bottom: 0;
    font-size: 14px;
    letter-spacing: 0;
  }


  /*      Right Aligned   */
  .media-right-aligned .media img {
    margin-right: 0;
    margin-left: 15px;
  }

  /* 	Media Notation 	*/

  .notation-text .media:first-child {
    border-top: none;
  }

  .notation-text .media {}

  .notation-text .media .media-body .media-notation {
    margin-top: 8px;
    margin-bottom: 9px;
  }

  .notation-text .media .media-body .media-notation a {
    color: #515365;
    font-size: 13px;
    font-weight: 700;
    margin-right: 8px;
  }

  /* 	Media Notation With Icon	*/

  .notation-text-icon .media:first-child {
    border-top: none;
  }

  .notation-text-icon .media {}

  .notation-text-icon .media .media-body .media-notation {
    margin-top: 8px;
    margin-bottom: 9px;
  }

  .notation-text-icon .media .media-body .media-notation a {
    color: #515365;
    font-size: 13px;
    font-weight: 700;
    margin-right: 8px;
  }

  .notation-text-icon .media .media-body .media-notation a svg {
    color: #888ea8;
    margin-right: 6px;
    vertical-align: sub;
    width: 18px;
    height: 18px;
    fill: rgba(0, 23, 55, 0.08);
  }

  /* 	With Labels	*/

  .m-o-label .media:first-child {
    border-top: none;
  }

  .m-o-label .media .badge {
    float: right;
  }

  /* 	Dropdown	*/

  .m-o-dropdown-list .media:first-child {
    border-top: none;
  }

  .m-o-dropdown-list .media .media-heading {
    display: flex;
    justify-content: space-between;
  }

  .m-o-dropdown-list .media .media-heading div.dropdown-list {
    cursor: pointer;
    color: #888ea8;
    font-size: 18px;
    float: right;
  }

  .m-o-dropdown-list .media .media-heading div.dropdown-list a.dropdown-item span {
    align-self: center;
  }

  .m-o-dropdown-list .media .media-heading div.dropdown-list a.dropdown-item svg {
    margin-left: 20px;
    color: #888ea8;
    align-self: center;
    width: 20px;
    height: 20px;
    fill: rgba(0, 23, 55, 0.08);
  }

  .m-o-dropdown-list .media .media-heading div.dropdown-list a.dropdown-item:hover svg {
    color: #1b55e2;
    fill: rgba(27, 85, 226, 0.23921568627450981);
  }

  .m-o-dropdown-list .dropdown-menu {
    border-radius: 6px;
    min-width: 9rem;
    border: 1px solid #ebedf2;
    box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.2);
    padding: 9px 0;
  }

  .m-o-dropdown-list .dropdown-item {
    font-size: 14px;
    color: #888ea8;
    padding: 5px 12px;
    display: flex;
    justify-content: space-between;
  }

  .m-o-dropdown-list .dropdown-item:hover {
    color: #e95f2b;
    text-decoration: none;
    background-color: #f1f2f3;
  }

  /* 	Label Icon	*/

  .m-o-label-icon .media:first-child {
    border-top: none;
  }

  .m-o-label-icon .media svg.label-icon {
    align-self: center;
    width: 30px;
    height: 30px;
    margin-right: 16px;
  }

  .m-o-label-icon .media svg.label-icon.label-success {
    color: #8dbf42;
  }

  .m-o-label-icon .media svg.label-icon.label-danger {
    color: #ee3d49;
  }

  .m-o-label-icon .media svg.label-icon.label-warning {
    color: #ffbb44;
  }

  /* 	Checkbox	*/

  .m-o-chkbox .media:first-child {
    border-top: none;
  }

  .m-o-chkbox .media .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
    background-color: #515365;
  }

  /* 	Checkbox	*/

  .m-o-radio .media:first-child {
    border-top: none;
  }

  .m-o-radio .media .custom-radio .custom-control-input:checked~.custom-control-label::before {
    background-color: #515365;
  }

  .custom-control-label::before {
    background-color: #d3d3d3;
  }

  .widget-three {
    position: relative;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    height: 100%;
    /*box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.09019607843137255), 0 1px 20px 0 rgba(0, 0, 0, 0.08), 0px 1px 11px 0px rgba(0, 0, 0, 0.06);*/
    border: 1px solid #e0e6ed;
    box-shadow: 0 0 40px 0 rgba(94, 92, 154, .06);
  }

  .widget-three .widget-heading {
    margin-bottom: 54px;
  }

  .widget-three .widget-heading h5 {
    font-size: 19px;
    display: block;
    color: #0e1726;
    font-weight: 600;
    margin-bottom: 0;
  }

  .widget-three .widget-content {
    font-size: 17px;
  }

  .widget-three .widget-content .summary-list {
    display: flex;
  }

  .widget-three .widget-content .summary-list:not(:last-child) {
    margin-bottom: 30px;
  }

  .widget-three .widget-content .w-icon {
    display: inline-block;
    padding: 8px 8px;
    border-radius: 50%;
    display: inline-flex;
    align-self: center;
    height: 34px;
    width: 34px;
    margin-right: 12px;
  }

  .widget-three .widget-content .w-icon svg {
    display: block;
    width: 17px;
    height: 17px;
  }

  .widget-three .widget-content .summary-list:nth-child(1) .w-icon {
    background: #dccff7;
  }

  .widget-three .widget-content .summary-list:nth-child(2) .w-icon {
    background: #e6ffbf;
  }

  .widget-three .widget-content .summary-list:nth-child(3) .w-icon {
    background: #ffeccb;
  }

  .widget-three .widget-content .summary-list:nth-child(1) .w-icon svg {
    color: #5c1ac3;
  }

  .widget-three .widget-content .summary-list:nth-child(2) .w-icon svg {
    color: #009688;
  }

  .widget-three .widget-content .summary-list:nth-child(3) .w-icon svg {
    color: #e2a03f;
  }

  .widget-three .widget-content .w-summary-details {
    width: 100%;
    align-self: center;
  }

  .widget-three .widget-content .w-summary-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1px;
  }

  .widget-three .widget-content .w-summary-info h6 {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 0;
    color: #888ea8;
  }

  .widget-three .widget-content .w-summary-info p {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 0;
    color: #888ea8;
  }

  .widget-three .widget-content .w-summary-stats .progress {
    margin-bottom: 0;
    height: 6px;
    border-radius: 20px;
    box-shadow: 0 2px 2px rgba(224, 230, 237, 0.4588235294117647), 1px 6px 7px rgba(224, 230, 237, 0.4588235294117647);
  }
</style>
@endslot
@endcomponent
