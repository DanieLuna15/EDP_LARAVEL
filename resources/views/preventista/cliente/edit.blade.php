@component('preventista.template.master', ['title' => 'Preventista'])
@slot('body')
@verbatim
<div v-if="!loading" class="osahan-body" id="app">
    <!-- categories -->
    <div class="p-3 osahan-categories">
        <h6 class="mb-2">VER CLIENTE</h6>
        <div class="bg-white shadow-sm rounded widget-content-area br-6 p-3">
        <div class="row">
              <div class="col-sm-6 col-12">
                  <div class="form-group">
                    <label for="fullName">Nombres</label>
                    <input v-model="model.nombre" type="text" class="form-control mb-4">
                  </div>
                </div>

                <div class="col-sm-3 col-6">


                  <div class="form-group ">
                    <label>Documentos</label>
                    <select v-model="model.documento_id" class="form-control">

                      <option v-for="m in documentos" :value="m.id">{{m.name}}</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-6">


                  <div class="form-group ">
                    <label>Tipo cliente</label>
                    <select v-model="model.tipocliente_id" class="form-control">

                      <option v-for="m in tipoclientes" :value="m.id">{{m.name}}</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-6">


                  <div class="form-group ">
                    <label>Grupo cliente</label>
                    <select v-model="model.cinta_cliente_id" class="form-control">

                      <option v-for="m in cintaClientes" :value="m.id">{{m.name}}</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-6">


                        <div class="form-group ">
                        <label>Caja Cerrada</label>
                        <select v-model="model.caja_cerrada" class="form-control">

                            <option :value="1">SI</option>
                            <option :value="2">NO</option>

                        </select>
                        </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">N° Doc</label>
                    <input type="text" v-model="model.doc" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Telefono</label>
                    <input type="text" v-model="model.telefono" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Correo</label>
                    <input type="text" v-model="model.correo" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Limite Crediticio</label>
                    <input type="text" v-model="model.limite_crediticio" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Creditos Activos</label>
                    <input type="text" v-model="model.creditos_activos" class="form-control mb-4" placeholder="">
                  </div>
                </div>
                <div class="col-sm-3 col-6">
                  <div class="form-group">
                    <label for="fullName">Dias/horas</label>
                    <input type="text" v-model="model.dias_horas" class="form-control mb-4" placeholder="">
                  </div>
                </div>

                <div class="col-sm-4 col-6">
                  <div class="form-group">
                    <label for="fullName">Latitud</label>
                    <input type="text" v-model="model.latitud" class="form-control mb-4" placeholder="">
                  </div>
                </div>


                <div class="col-sm-4 col-6">
                  <div class="form-group">
                    <label for="fullName">Longitud</label>
                    <input type="text" v-model="model.longitud" class="form-control mb-4" placeholder="">
                  </div>
                </div>

                <div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName">Dinero a Cuenta</label>
                  <input type="text" v-model="model.dinero_cuenta" class="form-control mb-4" placeholder="">
                </div>
              </div>
              <div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName">Horario de Preferencia</label>
                  <input type="text" v-model="model.horario_preferencia" class="form-control mb-4" placeholder="">
                </div>
              </div>
              <div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName">Horario de Pedido</label>
                  <input type="text" v-model="model.horario_pedido" class="form-control mb-4" placeholder="">
                </div>
              </div>
              <div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName">Deuda Heredada</label>
                  <input type="text" v-model="model.deuda_heredada" class="form-control mb-4" placeholder="">
                </div>
              </div>

              <div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName">Interes</label>
                  <input type="text" v-model="model.interes" class="form-control mb-4" placeholder="">
</div>
</div>
<div class="col-sm-8 col-6">


<div class="form-group ">
  <label>Tipo cliente Pollo Limpio </label>
  <select v-model="model.tipo_pollo_limpia" class="form-control">

  <option value="1">DE 1 A 14 POLLOS</option>
    <option value="2">OFICIAL (15 A 75 POLLOS)</option>
    <option value="3">DE 76 A 150 POLLOS</option>
    <option value="4">DE 151 A MAS POLLOS</option>
    <option value="5">CUALQUIER CANTIDAD AL CONTADO</option>
    <option value="6">VIP</option>

  </select>
</div>
</div>
<div class="col-sm-6 col-6">


<div class="form-group ">
  <label>Chofer </label>
  <select v-model="model.chofer_id" class="form-control">

<option v-for="m in chofers" :value="m.id">{{m.nombre}}</option>

</select>
</div>
</div>
<div class="col-sm-6 col-6">


<div class="form-group ">
  <label>Acuerdo </label>
  <select v-model="model.acuerdo_cliente_id" class="form-control">

<option v-for="m in acuerdoClientes" :value="m.id">{{m.name}}</option>

</select>
</div>
</div>
<div class="col-sm-6 col-6">


<div class="form-group ">
  <label>Tipo de pagos </label>
  <select v-model="model.tipopago_id" class="form-control">

<option v-for="m in tipopagos" :value="m.id">{{m.name}}</option>

</select>
</div>
</div>
<div class="col-sm-6 col-6">


<div class="form-group ">
  <label>Zona despacho </label>
  <select v-model="model.zona_despacho_id" class="form-control">

<option v-for="m in zona_despachos" :value="m.id">{{m.name}}</option>

</select>
</div>
</div>
<div class="col-sm-4 col-6">


<div class="form-group ">
  <label>Tipo de negocio </label>
  <select v-model="model.tipo_negocio_id" class="form-control">

<option v-for="m in tipo_negocios" :value="m.id">{{m.name}}</option>

</select>
</div>
</div>
<div class="col-sm-4 col-6">


<div class="form-group ">
  <label>Forma de pedido </label>
  <select v-model="model.forma_pedido_id" class="form-control">

<option v-for="m in forma_pedidos" :value="m.id">{{m.name}}</option>

</select>
</div>
</div>
              <div class=" col-4">


<div class="form-group ">
  <label>ACTIVO </label>
  <select v-model="model.activo" class="form-control">

  <option value="0">NO</option>
  <option value="1">SI</option>


  </select>
</div>
</div>
<div class="col-sm-4 col-6">
                <div class="form-group">
                  <label for="fullName"><div class="n-chk">
    <label class="new-control new-checkbox checkbox-primary">
      <input type="checkbox" class="new-control-input" v-model="model.is_iva">
      <span class="new-control-indicator"></span>IVA
    </label>
</div></label>
                  <input type="text" value="true" :disabled="!model.is_iva" v-model="model.iva" class="form-control mb-4" placeholder="">
</div>
</div>
                <div class="col-12">
                <div id="map"></div>
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
        loading: true,
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
          iva: 0,
          is_iva:false,
          chofer_id:1,
          forma_pedido_id:1,
          zona_despacho_id:1,
          tipo_negocio_id:1,
          horario_preferencia:"",
          horario_pedido:""
        },
        documentos: [],
        tipoclientes: [],
        cintaClientes: [],
        cajacerradaClientes: [],
        acuerdoClientes: [],
        tipoClientePps: [],
        tipopagos: [],
        tipoClientePpLimpios: [],
        forma_pedidos:[],
        zona_despachos:[],
        tipo_negocios:[],
        chofers:[]
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
      async Save() {
        block.block();
        try {

          let url = "url_path()api/clientes";
         await axios.put("{{url('api/clientes')}}/{{$id}}",this.model)
          this.back()

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
        this.loading = true;
        try {



          await Promise.all([self.GET_DATA('documentos'),self.GET_DATA("clientes/{{$id}}"),self.GET_DATA('tipoclientes'),

          self.GET_DATA('cintaClientes'),
            self.GET_DATA('cajacerradaClientes'),
            self.GET_DATA('acuerdoClientes'),
            self.GET_DATA('tipoClientePps'),
            self.GET_DATA('tipoClientePpLimpios'),
            self.GET_DATA('tipopagos'),
            self.GET_DATA('formaPedidos'),
            self.GET_DATA('zonaDespachos'),
            self.GET_DATA('tipoNegocios'),
            self.GET_DATA('chofers'),

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
            self.forma_pedidos = v[9]
            self.zona_despachos = v[10]
            self.tipo_negocios = v[11]
            self.chofers = v[12]
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
          this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
        }

      })
    }
  }).mount('#app')
        </script>
@endslot


@endcomponent
