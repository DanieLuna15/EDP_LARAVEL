@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-12">
        <div class="widget-content widget-content-area br-6">
          <div class="section general-info">
            <div class="info">
              <h6 class="">Mapa de Clientes</h6>
              <div class="row">

                <div class="col-12">
                <div id="map"></div>
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
        model:{
          inactivo:1,
          tipocliente_id:1,
          nombre:'',
          apellidos:'',
          documento_id:'',
          doc:'',
          cargo:'',
          telefono:'',
          direccion:'',
          garante:'',
          dir_garante:'',
          cel_garante:'',
          correo:'',
          latitud:'',
          longitud:'',
          creditos_activos:0,
          dias_horas:"",
          limite_crediticio:0,
        },
        clientes: [],
        tipoclientes: [],

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
         await axios.post("{{url('api/clientes')}}",this.model)
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
        block.block();
        try {



          await Promise.all([self.GET_DATA('clientes')]).then((v) => {
            self.clientes = v[0]

          })


        } catch (e) {

        } finally {
          var map = L.map('map').setView([-16.5205315,-68.2066501], 13);
          L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
          }).addTo(map);
          const popup = L.popup()

          this.clientes.map((v)=>{
            if(v.latitud!="" && v.longitud!=""){
            const marker = L.marker([{...v}.latitud, {...v}.longitud]).addTo(map)
              .bindPopup('<b>'+v.nombre+'</b> <b>'+v.documento.name+' '+v.doc+'</b><br />').openPopup();

                  }

          })
          function onMapClick(e) {

            }

          map.on('click', onMapClick);
          block.unblock();
        }

      })
    }
  }).mount('#meApp')
        </script>
@endslot


@slot('style')
<style>
  #map { height: 80vh; }
</style>
@endslot
@endcomponent
