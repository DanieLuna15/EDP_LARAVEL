@component('application')
@slot('body')
@verbatim
<div id="block_ui">
  <div class="row justify-content-center p-2">
    <div class="col-lg-4 col-12">
      <div class="row">
        <div class="col-12 p-1">
          <div class="form-group ">
            <label>Lotes</label>

            <div class="input-group ">

              <select v-model="lote_id" class="form-control">

                <template v-for="(m,i) in consolidacions.reverse()">

                  <option v-if="m.lote==null" :value="m.id">{{m.fecha}} - {{m.nro_compra}} - {{m.nro}}</option>


                </template>

              </select>
              <button class="btn btn-success " @click="GetLote()" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg></button>
            </div>
          </div>

        </div>
        <!-- <div class="col-12 p-1">
          <div class="form-group ">
            <label>Precio Actual x Kg</label>

            <div class="input-group ">
              <input type="text" class="form-control" v-model="precio">
            </div>
          </div>

        </div> -->
        <div class="col-12 p-1" v-if="lote.hasOwnProperty('fecha')">

        </div>
       <div class="col-12" v-if="lote.hasOwnProperty('fecha')">
        <div class="row">
        <div class="col-6 p-1">
          <div class="widget widget-card-four ">
            <div class="widget-content">
              <div class="w-content">
                <div class="w-info">
                  <h6 class="value">{{Number(peso_total).toFixed(2)}} Kg</h6>
                  <p class="">Peso Total</p>
                </div>
                <div class="">
                  <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- <div class="col-6 p-1">
          <div class="widget widget-card-four ">
            <div class="widget-content">
              <div class="w-content">
                <div class="w-info">
                  <h6 class="value">{{Number(lote.sum_peso_neto).toFixed(2)}} Bs.</h6>
                  <p class="">Peso Neto</p>
                </div>
                <div class="">
                  <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> -->
        <div class="col-6 p-1">
          <div class="widget widget-card-four ">
            <div class="widget-content">
              <div class="w-content">
                <div class="w-info">
                  <h6 class="value">{{Number(total_pollos).toFixed(2)}}</h6>
                  <p class="">Total de pollos</p>
                </div>
                <div class="">
                  <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- <div class="col-6 p-1">
          <div class="widget widget-card-four ">
            <div class="widget-content">
              <div class="w-content">
                <div class="w-info">
                  <h6 class="value">{{Number(lote.sum_peso_bruto*precio).toFixed(2)}} Bs.</h6>
                  <p class="">Valor de Venta</p>
                </div>
                <div class="">
                  <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> -->
        <div class="col-12 p-1">
            <button class="btn btn-secondary w-100 btn-block" @click="Save()">VALIDAR LOTE</button>
        </div>
        </div>
       </div>
      </div>
    </div>
    <div class="col-lg-8 col-12 " v-if="lote.hasOwnProperty('detalles')">
      <div class="row">
        <div v-for="l in lote_detalle" class="col-6 p-2">
          <div class="widget-content widget-content-area br-6">
            <div class="section general-info">
              <div class="row">
                <div class="col-6">
                  <img :src="imgPollo" alt="" style="width: 100%;">
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-12">
                      <div class="timeline-line">

                        <div class="item-timeline timeline-primary" v-for="inte in internos">
                          <div class="t-dot" data-original-title="" title="">
                          </div>
                          <div class="t-text">
                            <p><span>{{inte.name}}</span></p>
                            <span class="badge badge-danger">{{Number(inte.peso*l.pollos ).toFixed(2)}} Kg</span>
                            <p class="t-time">Cant {{Number(l.pollos * inte.cantidad).toFixed(2)}}</p>
                          </div>
                        </div>




                      </div>
                    </div>
                 <div class="col-12">
                    <span class="badge badge-primary m-1"> Peso Bruto  {{Number(l.valor).toFixed(2)}} Kg </span>
                    <span class="badge badge-success m-1"> Peso Neto  {{Number((l.valor)-(l.taras)).toFixed(2)}} Kg </span>
                    <span class="badge badge-warning m-1"> Peso Taras  {{Number(l.taras).toFixed(2)}} Kg </span>




                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-action">
              <div class="d-flex">
                <div class="card-like px-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                    <polyline points="21 8 21 21 3 21 3 8"></polyline>
                    <rect x="1" y="3" width="22" height="5"></rect>
                    <line x1="10" y1="12" x2="14" y2="12"></line>
                  </svg>
                  <span class="px-1">{{Number(l.cajas)}} CAJAS</span>
                </div>
                <div class="card-like px-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                  </svg> <span class="px-1">{{Number(l.pollos)}} POLLOS</span>
                </div>
                <div class="card-like px-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                  </svg>
                  <span class="px-1">{{Number(l.valor)}} Kg</span>
                </div>
                <div class="card-like px-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                  </svg>
                  <span class="px-1">{{l.name}}</span>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h6>PIGMENTO: {{l.pigmento==1?'SI':'NO'}}</h3>
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
        lote_id: '',
        precio:10.12,
        consolidacions: [],
        lote: {
          valor_total: 0,
          peso_total: 0,

        },
        internos: []
      }
    },
    computed: {
      imgPollo() {
        return "{{url('')}}/img/pollo.jpg"
      },
      lote_detalle() {
        if (this.lote.hasOwnProperty('detalles')) {
          return this.lote.detalles
        }
        return []
      },
      total_pollos() {
        return this.categorias.reduce((a,b)=>a+b.pollos,0)
      },
      total_cajas() {
        return this.categorias.reduce((a,b)=>a+b.cajas,0)
      },
      peso_total() {
        return this.categorias.reduce((a,b)=>a+b.valor,0)
      },
      categorias() {
        if (this.lote.hasOwnProperty('detalles')) {
          let categorias = [...this.lote.detalles].map((c) => {
            c.nro_pollos = this.lote_detalle.reduce((a, b) => a + (c.categoria.id == b.categoria_id ? Number(b.nro) : 0), 0)
            c.nro_cajas = this.lote_detalle.reduce((a, b) => a + (c.categoria.id == b.categoria_id ? Number(b.cant) : 0), 0)
            c.peso_total = this.lote_detalle.reduce((a, b) => a + (c.categoria.id == b.categoria_id ? Number(b.valor) : 0), 0)
            return c
          })
          return categorias
        }
        return []
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

         let data = {
          compra_id:this.lote.id,
          precio_venta:this.precio,
          pollos:this.total_pollos,
          valor_venta:this.peso_total*this.precio,
          // valor_compra:this.lote.valor_total,
          cajas:this.total_cajas,
          valor_peso:this.peso_total,
          lote_detalle:this.lote_detalle,
         }
        let res =  await axios.post("{{url('api/lotes')}}",data)
         const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success btn-rounded',
            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
            buttonsStyling: false,
          })
          let compra = res.data
          swalWithBootstrapButtons({
            title: 'Lote Guardada',
            text: "Su Lote fue guardada",
            type: 'success',
            showCancelButton: true,
            confirmButtonText: 'PDF',
            cancelButtonText: 'REGRESAR',
            reverseButtons: true,
            padding: '2em'
          }).then(async (result) => {
            if (result.value) {
              try {


                window.open(compra.url_pdf, '_blank');
                this.back()
              } catch (e) {

              }
            } else {
              this.back()
            }
          })


        } catch (e) {

        }finally{
          block.unblock();
        }
      },
      async GetLote() {
        block.block();
        try {
          let res = await axios.get("{{url('api')}}/compras-lote/" + this.lote_id)
          this.lote = res.data
        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      KgCategoria(lote) {
        let categorias = this.categorias.filter((c) => c.categoria_id == lote.categoria_id)
        let total = categorias[0].suma_total
        let oficial = categorias[0].oficial
        let caja = Number((Number(lote.valor) * 100) / total).toFixed(2)
        let valor = Number((oficial * caja) / 100).toFixed(2)
        lote.lote_peso_oficial = valor
        return Number(valor).toFixed(2)
      },
      LoteCategoria(lote) {
        let categorias = this.categorias.filter((c) => c.categoria_id == lote.categoria_id)
        let total = categorias[0].suma_total
        let oficial = categorias[0].precio_compra
        let caja = Number((Number(lote.valor) * 100) / total).toFixed(2)
        let valor = Number((oficial * caja) / 100).toFixed(2)
        lote.lote_valor = valor
        return Number(valor).toFixed(2)
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



          await Promise.all([self.GET_DATA('compras'),self.GET_DATA('compoInternas')]).then((v) => {
            self.consolidacions = v[0]
            self.internos = v[1]

          })


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
  .timeline-line .item-timeline {
    display: flex;
    width: 100%;
    margin-bottom: 12px;
  }

  .timeline-line .item-timeline .t-dot {
    position: relative;
  }

  .timeline-line .item-timeline .t-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-radius: 50%;
    width: 8px;
    height: 8px;
    top: 5px;
    left: 5px;
    transform: translateX(-50%);
    border-color: #e0e6ed;
    background: #bfc9d4;
    z-index: 1;
  }

  .timeline-line .item-timeline .t-dot:after {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 1px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    left: 5px;
    transform: translateX(-50%);
    border-color: #e0e6ed;
    width: 0;
    height: auto;
    top: 12px;
    bottom: -19px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0;
  }

  .timeline-line .item-timeline.timeline-primary .t-dot:before {
    background-color: #1b55e2;
    border-color: rgb(164, 189, 247);
  }

  .timeline-line .item-timeline.timeline-success .t-dot:before {
    background-color: #009688;
    border-color: rgb(154, 210, 205);

  }

  .timeline-line .item-timeline.timeline-danger .t-dot:before {
    background-color: #e7515a;
    border-color: rgb(241, 172, 176);
  }

  .timeline-line .item-timeline.timeline-dark .t-dot:before {
    background-color: #3b3f5c;
    border-color: rgb(159, 163, 187);
  }

  .timeline-line .item-timeline.timeline-secondary .t-dot:before {
    background: #1b55e2;
    border-color: #c2d5ff;
  }

  .timeline-line .item-timeline.timeline-warning .t-dot:before {
    background-color: #e2a03f;
    border-color: rgb(222, 199, 165);
  }

  .timeline-line .item-timeline:last-child .t-dot:after {
    display: none;
  }

  .timeline-line .item-timeline .t-meta-time {
    margin: 0;
    min-width: 100px;
    max-width: 100px;
    font-size: 12px;
    font-weight: 700;
    color: #888ea8;
    align-self: center;
  }

  .timeline-line .item-timeline .t-text {
    align-self: center;
    margin-left: 20px;
    display: flex;
    width: 100%;
    justify-content: space-between;
  }

  .timeline-line .item-timeline .t-text p {
    font-size: 12px;
    margin: 0;
    color: #888ea8;
    font-weight: 400;
  }

  .timeline-line .item-timeline .t-text span.badge {
    position: absolute;
    right: 11px;
    padding: 2px 4px;
    font-size: 11px;
    letter-spacing: 1px;
    opacity: 0;
    font-weight: 400;
  }

  .timeline-line .item-timeline .t-text span.badge {
    transform: none;
  }

  .timeline-line .item-timeline:hover .t-text span.badge {
    opacity: 1;
  }

  .timeline-line .item-timeline .t-text p.t-time {
    text-align: right;
    color: #888ea8;
    font-size: 10px;
  }

  .timeline-line .item-timeline .t-time {
    margin: 0;
    min-width: 80px;
    max-width: 80px;
    font-size: 13px;
    font-weight: 600;
    color: #acb0c3;
    letter-spacing: 1px;
  }

  .w-action svg {
    color: #1b55e2;
    width: 20px;
    fill: #c2d5ff;
  }

  .w-action span {
    vertical-align: sub;
    font-weight: 700;
    color: #0e1726;
    letter-spacing: 1px;
  }

  .transactions-list:not(:last-child) {
    margin-bottom: 15px;
  }

  .transactions-list {
    padding: 12px 12px;
    border: 1px dashed #bfc9d4;
    border-radius: 6px;
    -webkit-transition: all 0.1s ease;
    transition: all 0.1s ease;
  }

  .transactions-list .t-item {
    display: flex;
    justify-content: space-between;
  }

  .transactions-list .t-item .t-company-name {
    display: flex;
  }

  .transactions-list .t-item .t-rate p {
    margin-bottom: 0;
    font-size: 13px;
    letter-spacing: 0px;
  }

  .transactions-list .t-item .t-rate.rate-dec p {
    color: #e7515a;
  }

  .transactions-list .t-item .t-icon {
    margin-right: 12px;
  }

  .transactions-list .t-item .t-icon .icon {
    position: relative;
    display: inline-block;
    padding: 10px;
    background-color: #ffeccb;
    border-radius: 50%;
  }

  .transactions-list .t-item .t-icon .icon svg {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 19px;
    height: 19px;
    color: #e2a03f;
    stroke-width: 2;
  }

  .transactions-list .t-item .t-name .meta-date {
    font-size: 12px;
    margin-bottom: 0;
    font-weight: 600;
    color: #888ea8;
  }

  .transactions-list .t-item .t-name h4 {
    font-size: 15px;
    letter-spacing: 0px;
    font-weight: 600;
    margin-bottom: 0;
  }

  .transactions-list .t-item .t-name {
    align-self: center;
  }
</style>
@endslot
@endcomponent
