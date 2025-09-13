@component('application')
@slot('body')
@verbatim
<div id="block_ui">

<div class="row">
  <div class="col-12 mb-4">
  <div class="widget-content widget-content-area br-6">
          <div class="section general-info">
            <div class="info">
              <h6 class="">Informacion General</h6>
              <div class="row">
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Nombre Completo</label>
                    <input :value="model.contrato.persona.nombre" type="text"  disabled class="form-control mb-4">
                  </div>
                </div>
                <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Fecha</label>
                    <input :value="model.fecha" type="text"  disabled class="form-control mb-4">
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
  </div>
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
                  <h5 class="card-user_name">{{m.stockdotaciondetail.dotacion.name}}</h5>
                  <p class="card-user_occupation">COD: {{m.stockdotaciondetail.dotacion.codigo}}</p>
                  <div class="card-star_rating">
                    <span class="badge badge-danger mr-2">Compra {{m.stockdotaciondetail.dotacion.costo}}</span>
                    <span class="badge badge-primary mt-2">Venta {{m.stockdotaciondetail.dotacion.venta}}</span>
                    <span class="badge badge-success mt-2 w-100">Cantidad {{m.cantidad}}</span>
                  </div>
                  <button @click="Agregar(m)"  :disabled="m.cantidad<=0"   class="btn btn-dark mt-4 btn-sm w-100">DEVOLVER</button>
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
              <p class="media-text">
                <span class="badge badge-danger mr-2">Compra {{Number(m.dotacion.costo).toFixed(2)}}</span>
                <span class="badge badge-primary mr-2">Venta {{Number(m.dotacion.venta).toFixed(2)}}</span>
                <span class="badge badge-success mr-2">Cantidad {{parseInt(m.cant)}}</span>

              </p>
              <hr>
              <div class="form-group col-md-6">
              <label for="inputEmail4">Cantidad</label>
              <input type="text" name="" class="form-control" v-model="m.cantidad" id="">
            </div>
              <hr>
              <div class="media-notation text-center">
              <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-primary">
                  DEVOLVER {{Number(m.cantidad)}}
                  </button>
                  <button type="button"  @click="m.cantidad--" :disabled="m.cantidad<=1" class="btn btn-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  </button>
                  <button type="button" @click="m.cantidad++" :disabled="m.cantidad>=m.cant" class="btn btn-dark">
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
      </div>
      <div class=" col-12 layout-spacing">
        <div class="widget-three">
          <div class="widget-content">

            <div class="order-summary">


            </div>
            <button @click="Save()" class="btn btn-block btn-primary mt-4"> GUARDAR DEVOLUCION </button>
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
          <div class="form-row mb-4" v-if="edit==true">

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
          <div class="form-row mb-4" v-else>


            <div class="form-group col-md-12">
              <label for="inputEmail4">Proveedor</label>
              <select v-model="dotacion_edit.proveedor" name="" class="custom-select" id="">
                <option v-for="(m,i) in proveedors" :value="m">{{m.nombre}}</option>
              </select>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>

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
        buscarType: true,
        buscar: '',
        model: {
          codigo: '',
          name: '',
          fecha: '',
          costo: 0,
          venta: 0,
          stock: 0,
          contrato:{
            persona:{

            }
          },
          salidotacontradetas:[]
        },
        dotacion_edit: {
          dotacion: {

          },
          proveedor: {}
        },
        data: [],
        dotaciones: [],
        proveedors: [],
        clientes: [],

      }
    },
    computed: {
      dotacionFilter() {
        if (this.buscar != '') {
          let buscar = this.buscar
          if (this.buscarType) {
            return this.model.salidotacontradetas.filter((d) => {
              let name = d.stockdotaciondetail.dotacion.hasOwnProperty('name') ? d.stockdotaciondetail.dotacion.name : '';
              return name.toLowerCase().indexOf(buscar.toLowerCase()) != -1
            })
          } else {
            return this.model.salidotacontradetas.filter((d) => {
              let codigo = d.stockdotaciondetail.dotacion.hasOwnProperty('codigo') ? d.stockdotaciondetail.dotacion.codigo : '';
              return codigo.toLowerCase().indexOf(buscar.toLowerCase()) != -1
            })
          }
        }
        return this.model.salidotacontradetas
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
        let buscar = this.dotaciones.filter((v,i)=>param.id == v.id);
        if(buscar.length==0){
          this.dotaciones.push({
            id:dotacion.id,
            dotacion: dotacion.stockdotaciondetail.dotacion,
            dotacion_id: dotacion.stockdotaciondetail.dotacion.id,
            dotacion_costo: dotacion.stockdotaciondetail.dotacion.costo,
            dotacion_venta: dotacion.stockdotaciondetail.dotacion.venta,
            cant: dotacion.cantidad,

            cantidad: 1,
            proveedor: {}
          })

        }
      },
      back() {
        window.location.replace(document.referrer);
      },
      async Save() {
        try {
          // let res = await axios.post(, this.model)

          this.model.dotaciones = this.dotaciones

          let url = "{{url('api/devosalidotacontras')}}";

          await axios.post(url,this.model);
         this.back();
        } catch (e) {

        }
      },
      async GET_DATA(path) {
        try {
          let res = await axios.get("{{url('')}}/" + path)
          return res.data
        } catch (e) {

        }
      },
      async load() {
        try {
          let self = this

          try {
            await Promise.all([self.GET_DATA('api/salidadotacioncontratos/{{$id}}'), self.GET_DATA('api/clientes')]).then((v) => {
              self.model = v[0]
              self.clientes = v[1]
            })

          } catch (e) {

          }
        } catch (e) {

        }
      },
      deleteItem(id) {
        let self = this
        const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success btn-rounded',
          cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
          buttonsStyling: false,
        })

        swalWithBootstrapButtons({
          title: 'Estas seguro?',
          text: "Este cambio es irreversible.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Eliminar!',
          cancelButtonText: 'No!',
          reverseButtons: true,
          padding: '2em'
        }).then(async (result) => {
          if (result.value) {
            try {

              const params = new URLSearchParams({});


              let url = "url_path()api/dotacions/" + id + "/delete"

              await axios({
                method: 'post',
                url: url,
                headers: {},
                data: params
              });
              dt.destroy()
              await self.load()
              dt.create()
            } catch (e) {

            }
          }
        })
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {
          await Promise.all([self.load()]).then((v) => {

          })
          dt.create()

        } catch (e) {

        } finally {
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
