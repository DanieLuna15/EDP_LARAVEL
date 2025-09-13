@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="row justify-content-center">

      <div class="col-lg-6 col-12">

        <div class="widget-content widget-content-area br-6">
          <div class="row">
            <div class="col-sm-12 col-6">


              <div class="form-group ">
                <label>Tipo de archivo</label>
                <select v-model="tipoarchivo_id" class="form-control">

                  <option v-for="m in data" :value="m.id">{{m.name}}</option>

                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>Subir archivo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file">
                  <input type="file" v-on:change="handleFileUpload()" ref="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
              </div>
              <button v-if="file!=''" @click="submitFile()" class="btn btn-success w-100">Cargar</button>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-6 col-12">

        <div class="widget-content widget-content-area br-6">
        <div class="table-responsive mb-4 mt-4">
            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Documento</th>

                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(m,i) in model.file_sucursals">
                  <td>{{i+1}}</td>
                  <td><div class="media">
                  <img :src="m.path_url"  onerror="this.style.display='none'" class="img-fluid"  alt="File" style="width: 100px;">

                        </div></td>
                  <td>{{m.tipoarchivo.name}}</td>

                  <td>
                    <div class="btn-group">

                      <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" :id="'menu'+i" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                          <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                      </button>
                      <div class="dropdown-menu" :aria-labelledby="'menu'+i">
                       <a class="dropdown-item" :href="m.path_url" download>Descargar</a>
                        <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(m.id)">Eliminar</a>

                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
        tipoarchivo_id: "",
        data: [],
        file: '',
        model:{
          file_sucursals:[]
        }
      }
    },
    methods: {
      async submitFile() {
        let self = this
        const params = new URLSearchParams(this.model);
        let formData = new FormData();

        /*
            Add the form data we need to submit
        */
        formData.append('file', this.file);
        formData.append('tipoarchivo_id', this.tipoarchivo_id);
        let url = "{{url('api/sucursals')}}-{{$id}}/image";
        await axios({
          method: 'post',
          url: url,
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          data: formData
        });
        await self.load()


      },


      handleFileUpload(e) {
        this.file = this.$refs.file.files[0];
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
            await Promise.all([self.GET_DATA('api/sucursals/{{$id}}'),self.GET_DATA('api/tipoarchivos')]).then((v) => {
            self.model = v[0]
            self.data = v[1]
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


              let url = "{{url('api/sucursals-image-delete')}}/" + id

              await axios({
                method: 'post',
                url: url,
                headers: {},
                data: params
              });

              await self.load()

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
          await Promise.all([self.GET_DATA('api/sucursals/{{$id}}'),self.GET_DATA('api/tipoarchivos')]).then((v) => {
            self.model = v[0]
            self.data = v[1]
          })

          if(self.data.length){
            self.tipoarchivo_id=self.data[0].id
          }
        } catch (e) {

        } finally {
          block.unblock();
          var firstUpload = new FileUploadWithPreview('myFirstImage')
        }

      })
    }
  }).mount('#meApp')
        </script>
@endslot
@endcomponent
