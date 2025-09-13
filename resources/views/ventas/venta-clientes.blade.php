@component('application')
@slot('body')
@verbatim
<div id="block_ui">
    <div class="action-btn layout-top-spacing mb-5">
        <div class="page-header">
            <div class="page-title">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg> Ventas / Reporte semanal por cliente</p>
            </div>

        </div>


    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="widget-content widget-content-area br-6">
          <div class="table-responsive mb-4 mt-4">
            <div class="row">
                <div class="col-3">
                <div class="form-group ">
                        <label>Zona despacho</label>
                        <div class="input-group mb-4">
                        <select v-model="buscar_zona_despacho" class="form-control" id="buscar_area1">

                            <option value="all">Todos</option>
                            <option v-for="(m,i) in zona_despachos"  :value="m.name">{{m.name}}</option>

                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                <div class="form-group ">
                        <label>Forma Pedidos</label>
                        <div class="input-group mb-4">
                        <select v-model="buscar_forma_pedido" class="form-control" id="buscar_area1">

                            <option value="all">Todos</option>
                            <option v-for="(m,i) in forma_pedidos"  :value="m.name">{{m.name}}</option>

                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                <div class="form-group ">
                        <label>Tipo de negocios</label>
                        <div class="input-group mb-4">
                        <select v-model="buscar_tipo_negocio" class="form-control" id="buscar_area1">

                            <option value="all">Todos</option>
                            <option v-for="(m,i) in tipo_negocios"  :value="m.name">{{m.name}}</option>

                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                <div class="form-group ">
                        <label>Choferes</label>
                        <div class="input-group mb-4">
                        <select v-model="buscar_chofer" class="form-control" id="buscar_area1">

                            <option value="all">Todos</option>
                            <option v-for="(m,i) in chofers"  :value="m.id">{{m.nombre}}</option>

                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control form-control-sm" v-model="fecha_inicio">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control form-control-sm" v-model="fecha_fin">
                            </div>
                        </div>
                <div class="col-3">
                    <div class="form-group ">
                        <label>Preventista</label>
                        <div class="input-group mb-4">
                            <select v-model="buscar_preventista" class="form-control">

                            <option value="all">Todos</option>
                            <option v-for="(m,i) in users"  :value="m.id">{{m.nombre}}</option>

                            </select>
                            <div class="input-group-append">
                            <button class="btn btn-primary" @click="Consultar()" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 pt-1">
                    <div class="btn-group mt-4">
                        <a :href="urlreport('excel')" class="btn btn-success" target="_blank">EXCEL</a>
                        <a :href="urlreport('pdf')" class="btn btn-danger" target="_blank">PDF</a>
                    </div>
                </div>
                <div class="col-12">

                </div>
            </div>

            <table id="table_dt" class="table table-hover non-hover" style="width:100%">
              <thead>
                <tr>
                <th align="left" class="bold" ><strong>SIS</strong></th>
<th align="left" class="bold" ><strong>NOMBRE</strong></th>
<th align="left" class="bold" ><strong>PREVENTISTA</strong></th>
<th align="left" class="bold" ><strong>ZONA</strong></th>
<th align="left" class="bold" ><strong>DIRECCION</strong></th>
<th align="left" class="bold" ><strong>TIPO DE NEGOCIO</strong></th>
<th align="left" class="bold" ><strong>CHOFER</strong></th>
<th align="left" class="bold" ><strong>FORMA DE PAGO</strong></th>
<th align="left" class="bold" ><strong># CELULAR</strong></th>
<th align="left" class="bold" ><strong>FORMA DE PEDIDO</strong></th>
<th align="left" class="bold" ><strong>HORARIO DE PEDIDO</strong></th>
<th align="left" class="bold" ><strong>HORARIO DE PREFERENCIA DE ENTREGA DEL CLIENTE</strong></th>

<template v-for="m in data.fechas">
    <th align="left" class="bold" ><strong>
        {{m.fecha_sort}}
    {{m.fecha_sort_date}}
</strong></th>
</template>
<th align="left" class="bold" ><strong>CATEGORIA DE PRECIOS</strong></th>
<th align="left" class="bold" ><strong>QUE PRODUCTO PIDE</strong></th>
<th align="left" class="bold" ><strong>OBSERVACIONES</strong></th>

                </tr>
              </thead>
              <tbody>
              <template v-for="m in data.ventas">
                        <tr>
                            <td></td>
                            <td>{{m.cliente.nombre}}</td>
                            <td>{{m.preventista.nombre}}</td>
                            <td>{{m.cliente.zona_despacho.name}}</td>
                            <td>{{m.cliente.direccion}}</td>
                            <td>{{m.cliente.tipo_negocio.name}}</td>
                            <td>{{m.chofer.nombre}}</td>
                            <td>{{m.cliente.tipopago.name}}</td>
                            <td>{{m.cliente.telefono}}</td>
                            <td>{{m.cliente.forma_pedido.name}}</td>

                            <td>{{m.cliente.horario_pedido}}</td>
                            <td>{{m.cliente.horario_preferencia}}</td>
                            <template v-for="f in m.ventas_fecha">
                            <td :class="f.ventas>0?'bg-warning text-white':''">{{f.ventas>0?'X':''}}</td>
</template>


                            <td>{{m.lista_grupo_pps_text}}</td>
                            <td>{{m.lista_venta_detalle_pps_text}}</td>
                            <td></td>

                        </tr>
                    </template>
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
        let dt = new Table()
        let block = new Block()
        createApp({
            data() {
                return {
                    add: true,
                    contrato_id:"all",
                    data: {
                        fechas:[],
                        ventas:[]
                    },
                    users: [],
                    areas: [],
                    contratos: [],
                    buscar_area:'all',
                    buscar_zona_despacho:'all',
                    buscar_tipo_negocio:'all',
                    buscar_forma_pedido:'all',
                    buscar_chofer:'all',
                    buscar_preventista:'all',
                    fecha_inicio: '',
                    fecha_fin: '',
                    zona_despachos:[],
                    tipo_negocios:[],
                    forma_pedidos:[],
                    chofers:[],
                    preventistas:[]

                }
            },
            methods: {
                async Consultar() {
                    let self = this
                    try {
                        // dt.destroy()
                        // await Promise.all([ self.GET_DATA('api/reportes/contratos/planillas/'+this.contrato_id)]).then((v) => {

                        //     self.data = v[0]
                        // })

                        // dt.create()
                        let data = {
                            fecha_inicio: this.fecha_inicio,
                            fecha_fin: this.fecha_fin,
                            chofer: this.buscar_chofer,
                            preventista: this.buscar_preventista,
                            zona_despacho: this.buscar_zona_despacho,
                            tipo_negocio: this.buscar_tipo_negocio,
                            forma_pedido: this.buscar_forma_pedido

                        }

                        let res = await axios.post("{{url('api/venta-clientes-post')}}",data).then((v) => {
                                self.data = v.data
                            })

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
                            await Promise.all([
                            self.GET_DATA('api/zonaDespachos'),
                            self.GET_DATA('api/formaPedidos'),
                            self.GET_DATA('api/tipoNegocios'),
                            self.GET_DATA('api/chofers'),
                            self.GET_DATA('api/users'),
                        ]).then((v) => {

                                self.zona_despachos = v[0]
                                self.forma_pedidos = v[1]
                                self.tipo_negocios = v[2]
                                self.chofers = v[3]
                                self.users = v[4]
            })

                        } catch (e) {

                        }
                    } catch (e) {

                    }
                },
                urlreport(type) {
                    let fecha_inicio = this.fecha_inicio==''?'all':this.fecha_inicio
                    let fecha_fin = this.fecha_fin==''?'all':this.fecha_fin
                    let url = "{{url('reportes/venta-clientes')}}/zona-"+this.buscar_zona_despacho+"/tipo-"+this.buscar_tipo_negocio+"/chofer-"+this.buscar_chofer+"/preventista-"+this.buscar_preventista+"/forma-"+this.buscar_forma_pedido+"/fecha_inicio-"+fecha_inicio+"/fecha_fin-"+fecha_fin+"/"+type
                    return url
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


                                let url = "{{url('api/proveedors')}}/"+id

                                await axios.delete(url)
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
                        await self.load()
                        // $.fn.dataTable.ext.search.push(
                        //     function( settings, data, dataIndex ) {
                        //         var area = $('#buscar_area1').val()

                        //         if ( (data[3]==area) || (area=="all") )
                        //         {
                        //             return true;
                        //         }
                        //         return false;
                        //     }
                        // );
                        // // Event listener to the two range filtering inputs to redraw on input
                        // $('#buscar_area1').change( function() {
                        //         dt.destroy()

                        //         dt.create();
                        //      } );

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
@endcomponent
