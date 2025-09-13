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
                <div class="col-sm-12 col-12">
                  <div class="form-group">
                    <label for="fullName">Nombres</label>
                    <input v-model="model.nombre" type="text" class="form-control mb-4" disabled>
                  </div>
                </div>




                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-4 col-12 mt-3">
                            <div id="iconsAccordion" class="accordion-icons">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                    <section class="mb-0 mt-0">
                                        <div
                                        role="menu"
                                        class=""
                                        data-toggle="collapse"
                                        data-target="#iconAccordionOne"
                                        aria-expanded="true"
                                        aria-controls="iconAccordionOne"
                                        >
                                        <div class="accordion-icon">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-airplay"
                                            >
                                            <path
                                                d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                                            ></path>
                                            <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                            </svg>
                                        </div>
                                        CAJAS CERRADAS
                                        <div class="icons">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-chevron-up"
                                            >
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                            </svg>
                                        </div>
                                        </div>
                                    </section>
                                    </div>
                                    <div
                                    id="iconAccordionOne"
                                    class="collapse show"
                                    aria-labelledby="headingOne"
                                    data-parent="#iconsAccordion"
                                    >
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Producto</label
                                            >
                                            <select class="form-control" v-model="cajas_cerradas_form.precio_producto">
                                                <template v-for="m in precio_productos">
                                                    <option :value="m">{{ m.name }}</option>
                                                </template>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Valor</label
                                            ><input type="text" v-model="cajas_cerradas_form.valor" class="form-control mb-4" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="button" @click="addCajaCerrada()">
                                            Agregar
                                            </button>
                                        </div>
                                        <div class="col-12"><hr /></div>
                                        <div class="col-12 table-responsive" >
                                            <table i class="table table-hover non-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>NOMBRE</th>
                                                    <th>VALOR</th>
                                                    <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(m,i) in caja_cerradas_model">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.producto_precio.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="m.estado=0">Eliminar</button>
                                                        </td>

                                                    </tr>
                                                    <tr v-for="(m,i) in cajas_cerradas">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.precio_producto.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="cajas_cerradas.splice(i,1)">Eliminar</button>
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

                        </div>
                        <div class="col-sm-4 col-12 mt-3">
                            <div id="iconsAccordion2" class="accordion-icons">
                                <div class="card">
                                    <div class="card-header" id="headingOne2">
                                    <section class="mb-0 mt-0">
                                        <div
                                        role="menu"
                                        class=""
                                        data-toggle="collapse"
                                        data-target="#iconAccordionOne2"
                                        aria-expanded="true"
                                        aria-controls="iconAccordionOne2"
                                        >
                                        <div class="accordion-icon">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-airplay"
                                            >
                                            <path
                                                d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                                            ></path>
                                            <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                            </svg>
                                        </div>
                                        PP
                                        <div class="icons">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-chevron-up"
                                            >
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                            </svg>
                                        </div>
                                        </div>
                                    </section>
                                    </div>
                                    <div
                                    id="iconAccordionOne2"
                                    class="collapse show"
                                    aria-labelledby="headingOne2"
                                    data-parent="#iconsAccordion2"
                                    >
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Item</label
                                            >
                                            <select class="form-control" v-model="pp_form.item">
                                            <template v-for="m in items">
                                                <option v-if="m.tipo==1" :value="m">{{ m.name }}</option>
                                            </template>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Valor</label
                                            ><input type="text" v-model="pp_form.valor" class="form-control mb-4" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="button" @click="addPP()">
                                            Agregar
                                            </button>
                                        </div>
                                        <div class="col-12"><hr /></div>
                                        <div class="col-12 table-responsive" >
                                            <table i class="table table-hover non-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>NOMBRE</th>
                                                    <th>VALOR</th>
                                                    <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(m,i) in pp_model">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.item.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="m.estado=0">Eliminar</button>
                                                        </td>

                                                    </tr>
                                                    <tr v-for="(m,i) in pps">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.item.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="pps.splice(i,1)">Eliminar</button>
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

                        </div>
                        <div class="col-sm-4 col-12 mt-3">
                            <div id="iconsAccordion3" class="accordion-icons">
                                <div class="card">
                                    <div class="card-header" id="headingOne3">
                                    <section class="mb-0 mt-0">
                                        <div
                                        role="menu"
                                        class=""
                                        data-toggle="collapse"
                                        data-target="#iconAccordionOne3"
                                        aria-expanded="true"
                                        aria-controls="iconAccordionOne3"
                                        >
                                        <div class="accordion-icon">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-airplay"
                                            >
                                            <path
                                                d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                                            ></path>
                                            <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                            </svg>
                                        </div>
                                        PT
                                        <div class="icons">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-chevron-up"
                                            >
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                            </svg>
                                        </div>
                                        </div>
                                    </section>
                                    </div>
                                    <div
                                    id="iconAccordionOne3"
                                    class="collapse show"
                                    aria-labelledby="headingOne3"
                                    data-parent="#iconsAccordion3"
                                    >
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Producto</label
                                            >
                                            <select class="form-control" v-model="pt_form.item">
                                                <template v-for="m in items">
                                                    <option v-if="m.tipo == 2 || m.tipo == 3"  :value="m">{{ m.name }}</option>
                                                </template>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                            <label for="fullName">Valor</label
                                            ><input type="text" v-model="pt_form.valor" class="form-control mb-4" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="button" @click="addPT()">
                                            Agregar
                                            </button>
                                        </div>
                                        <div class="col-12"><hr /></div>
                                        <div class="col-12 table-responsive">
                                            <table i class="table table-hover non-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>NOMBRE</th>
                                                    <th>VALOR</th>
                                                    <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(m,i) in pt_model">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.item.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="m.estado=0">Eliminar</button>
                                                        </td>

                                                    </tr>
                                                    <tr v-for="(m,i) in pts">
                                                        <td>{{i+1}}</td>
                                                        <td>{{m.item.name}}</td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" v-model="m.valor" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" @click="pts.splice(i,1)">Eliminar</button>
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

                        </div>
                    </div>
                </div>

                    <div class="col-12 mt-4">
                    <div class="row">
                    <div class="col-6">
                            <button class="btn btn-dark w-100" @click="back()">Regresar</button>
                        </div>
                        <div class="col-6">
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
        tipocliente_id: 1,
        acuerdo_cliente_id: 1,
        cajacerrada_cliente_id: 1,
        activo: 1,
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
        cinta_cliente_id: 1,
        deuda_heredada: 0,
        dinero_cuenta: 0,
        tipo_caja_cerrada: 1,
        tipo_cliente_pp: 1,
        tipo_pollo_limpia: 1,
        tipo_cliente_pp_limpio: 1,
        tipo_cliente_pp_id: 1,
        tipo_cliente_pp_limpio_id: 1,
        acuerdo: 1,
        interes: 0,
        cliente_cajacerradas: [],
        cliente_pps: [],
        cliente_pts: []
        },
        documentos: [],
        tipoclientes: [],
        cintaClientes: [],
        cajacerradaClientes: [],
        acuerdoClientes: [],
        tipoClientePps: [],
        tipopagos: [],
        tipoClientePpLimpios: [],
        sucursal: {
        id: 0
        },
        precio_productos: [],
        items: [],
        cajas_cerradas: [],
        pts: [],
        pps: [],
        // ========== AGREGADO PARA FORMULARIOS INDEPENDIENTES ==========
        cajas_cerradas_form: {
        valor: '',
        precio_producto: {}
        },
        pp_form: {
        valor: '',
        item: {}
        },
        pt_form: {
        valor: '',
        item: {}
        }
        // ==============================================================
    }
    },
    computed: {
        caja_cerradas_model(){
            return this.model.cliente_cajacerradas.filter((x)=>x.estado==1)
        } ,
        pp_model(){
            return this.model.cliente_pps.filter((x)=>x.estado==1)
        },
        pt_model(){
            return this.model.cliente_pts.filter((x)=>x.estado==1)
        }
    },
    methods: {
        addCajaCerrada() {
            let data = {
            valor: this.cajas_cerradas_form.valor,
            precio_producto: this.cajas_cerradas_form.precio_producto
            }
            this.cajas_cerradas.push(data)
            this.cajas_cerradas_form.valor = ''
            this.cajas_cerradas_form.precio_producto = {}
        },
        addPP() {
            let data = {
            valor: this.pp_form.valor,
            item: this.pp_form.item
            }
            this.pps.push(data)
            this.pp_form.valor = ''
            this.pp_form.item = {}
        },
        addPT() {
            let data = {
            valor: this.pt_form.valor,
            item: this.pt_form.item
            }
            this.pts.push(data)
            this.pt_form.valor = ''
            this.pt_form.item = {}
        },
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
            this.model.cajas_cerradas=this.cajas_cerradas
            this.model.pts=this.pts
            this.model.pps=this.pps
          let url = "url_path()api/clientes";
         await axios.put("{{url('api/clientes')}}-precios/{{$id}}",this.model)
           Swal.fire({
      title: "Guardado",
      text: "Los precios se guardaron correctamente.",
      type: "success",
      confirmButtonText: "OK"
    }).then(() => {
      this.back();
    });

        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      back(){
        window.location.replace(document.referrer);
      }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this
        block.block();
        try {


            let sucursal = localStorage.getItem('AppSucursal')
            if (sucursal != null) {
              this.sucursal = JSON.parse(sucursal);

            }

          await Promise.all([self.GET_DATA('documentos'),self.GET_DATA("clientes/{{$id}}"),self.GET_DATA('tipoclientes'),

          self.GET_DATA('cintaClientes'),
            self.GET_DATA('cajacerradaClientes'),
            self.GET_DATA('acuerdoClientes'),
            self.GET_DATA('tipoClientePps'),
            self.GET_DATA('tipoClientePpLimpios'),
            self.GET_DATA('tipopagos'),
            self.GET_DATA('producto-precios-sucursal/'+this.sucursal.id),
            self.GET_DATA('items-sucursal/'+this.sucursal.id),

          ]).then((v) => {
            self.documentos = v[0]
            self.model = v[1]
            self.tipoclientes = v[2]
            self.cintaClientes = v[3]
            self.cajacerradaClientes = v[4]
            self.acuerdoClientes = v[5]
            self.tipoClientePps = v[6]
            self.tipoClientePpLimpios = v[7]
            self.tipopagos = v[8]
            self.precio_productos = v[9]
            self.items = v[10]

          })
          if(self.documentos.length){
            self.model.documento_id=self.documentos[0].id
          }
          var map = L.map('map').setView([-16.5205315,-68.2066501], 13);
          L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
          }).addTo(map);
          if(this.model.latitud!=null && this.model.longitud!=null){
            const marker = L.marker([{...this.model}.latitud, {...this.model}.longitud]).addTo(map)
      .bindPopup('<b>Ubicacion</b><br />').openPopup();

          }
          const popup = L.popup()
          function onMapClick(e) {
            self.model.latitud = e.latlng.lat
            self.model.longitud = e.latlng.lng
              popup
                .setLatLng(e.latlng)
                .setContent(`Laa nueva ubicacion sera aqui ${e.latlng.toString()}`)
                .openOn(map);
            }

            map.on('click', onMapClick);
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
  #map { height: 280px; }
</style>
@endslot
@endcomponent
