@component('application')
@slot('body')
@verbatim
<div id="block_ui">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row">

      <div class="col-12 mt-2">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                      <thead>
                        <tr>

                        <th colspan="13" class="text-center bg-primary text-white">CAJAS CERRADAS</th>

                        </tr>
                        <tr>

                        <th>Lote</th>
                        <th>N Compra</th>
                        <th>Cinta</th>
                        <th>Pigmento</th>
                        <th>Cajas</th>
                        <th>Pollos</th>
                        <th>Peso Bruto</th>
                        <th>Peso Neto</th>
                        <th>P. Bruto U.</th>
                        <th>P. Neto U.</th>
                        <th>Precio Kg </th>
                        <th>Total Bs/ </th>

                        <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(l,i) in cart_lotes">
                          <td>{{l.compra.proveedor_compra.abreviatura}}-{{l.compra.nro}}</td>
                          <td>{{l.compra.proveedor_compra.abreviatura}}-{{l.compra.nro_compra}}</td>
                          <td :class="'bg-'+bandera(l)+' text-white'">{{l.cinta}}</td>
                          <td>{{l.pigmento==1?'SI':'NO'}}</td>
                          <td>
                            <input type="text" name="" id="" readonly :value="l.cajas" @change="changeCajas(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" readonly :value="l.equivalente" @change="changeLote(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" readonly :value="l.peso_mod_bruto" @change="changeLoteM(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" readonly :value="l.peso_mod_neto" @change="changeLoteM(l)" class="form-control">
                          </td>

                          <td>{{l.peso_unitario_bruto}}</td>
                          <td>{{l.peso_unitario_neto}}</td>
                          <td>{{Number(l.valor_precio).toFixed(2)}}</td>
                          <td>{{Number(l.total).toFixed(2)}}</td>


                          <td>
                            <button class="btn btn-danger p-1" @click="cart_lotes.splice(i,1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                            </button>
                          </td>
                        </tr>

                      </tbody>
                    </table>



                  </div>
                </div>
              </div>


              <div class="col-12 mt-2">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">

                      <thead>
                      <tr>
                          <th colspan="10" class="text-center bg-primary text-white">
                            ITEMS PP
                          </th>
                        </tr>
                        <tr>
                        <th>PP</th>
                        <th>Pollos</th>
                        <th>Cajas</th>
                        <th>P.Bruto</th>
                        <th>Taras</th>
                        <th>P. Neto</th>
                        <th>P. Neto U</th>
                        <th>Precio KG</th>
                        <th>Total Bs/.</th>


                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(l,i) in cart_pps">
                          <td>PP-{{l.pp.nro}}</td>

                            <td>
                                <input type="text" class="form-control form-control-sm" readonly :value="l.pollos_vender" @change="ChangePollosPp(l)">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" readonly :value="l.cajas_vender" @change="ChangeCajasPp(l)">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" readonly :value="l.peso_bruto_vender">
                            </td>
                            <td>{{Number(l.peso_bruto_vender - l.peso_neto_vender).toFixed(2)}}</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" readonly :value="l.peso_neto_vender">
                            </td>



                          <td>{{Number(l.peso_neto_unit).toFixed(2)}}</td>
                          <td>{{Number(l.precio_acuerdo).toFixed(2)}}</td>
                          <td>{{Number(l.total).toFixed(2)}}</td>



                          <td>
                            <button class="btn btn-danger p-1" @click="cart_pps.splice(i,1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                            </button>
                          </td>
                        </tr>

                      </tbody>
                    </table>



                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th colspan="8" class="text-center bg-primary text-white">
                            ITEMS PT
                          </th>
                        </tr>
                        <tr>

                          <th>
                            PT
                          </th>
                          <th>
                            ITEM
                          </th>
                          <th>
                            CAJAS
                          </th>
                          <th>
                            P. BRUTO KG
                          </th>
                          <th>
                            P. TARA KG
                          </th>
                          <th>
                            P. NETO KG
                          </th>
                          <th>
                            TOTAL Bs/
                          </th>
                          <th>

                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item,i) in cart_pts" class="tr-hover">
                          <td>PT-{{item.nro}}</td>
                          <td>{{item.item.name}}</td>
                          <td> <input type="text" class="form-control" readonly :value="item.cajas_vender" @change="changeCajasItem(item)"> </td>
                          <td> <input type="text" class="form-control" readonly :value="item.peso_bruto_vender" @change="changePesoBrutoItem(item)"> </td>
                          <td> <input type="text" class="form-control" readonly :value="item.tara_vender"> </td>
                          <td> <input type="text" class="form-control" readonly :value="item.peso_neto_vender" @change="changePesoNetoItem(item)"> </td>
                          <td>{{Number(item.item.venta*item.peso_neto_vender).toFixed(2)}}</td>
                          <td>
                          <button class="btn btn-danger p-1" @click="cart_pts.splice(i,1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                            </button>
                          </td>
                        </tr>
                    </tbody>
                    </table>



                  </div>
                </div>
              </div>
    </div>
    </div>
    <div class="col-lg-8 col-12 mt-4">
      <div class="row">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCrud">{{detalle_lote.name}}</h5>
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
                                <label for="inputEmail4">Producto Precio</label>
                                <select name="" id="" class="form-control" v-model="producto_precio">
                                  <option v-for="m in productos_precios" :value="m">{{m.name}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Aplicado Precio</label>
                                <input type="text" class="form-control" :value="tipo_precio[cliente.tipo_caja_cerrada]">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Valor Precio</label>
                                <input type="text" class="form-control" :value="valor_precio">
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button @click="AddDetalleLote()" type="button" data-dismiss="modal" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="widget-content widget-content-area br-6">
        <div class="section general-info">

          <div class="info">
            <div class="row">
              <div class="col-3">

                <div class="form-group ">
                  <label>Cod Cliente</label>
                  <div class="input-group">
                    <select v-model="model.cliente_id" class="form-control select_codigo_cliente">
                      <option v-for="m in clientes" :value="m.id">{{m.id}} - {{m.documento.name}} {{m.doc}}</option>

                    </select>

                  </div>

                </div>
              </div>
              <div class="col-3">

                <div class="form-group ">
                  <label>Clientes</label>
                  <div class="input-group">
                    <select v-model="model.cliente_id" class="form-control select_cliente">
                      <option v-for="m in clientes" :value="m.id">{{m.nombre}} {{m.documento.name}} {{m.doc}}</option>

                    </select>

                  </div>
                  <label for="" class="text-danger" v-if="cliente.id==''">Selecciona un cliente</label>
                </div>
              </div>
              <div class="col-3">

                <div class="form-group ">
                  <label>Grupo Cliente</label>
                  <select v-model="cliente.cinta_cliente.id":value="" class="form-control">
                      <option value="" disabled selected>Seleccionar</option>
                      <option v-for="m in cintaClientes" :value="m.id">{{m.name}}</option>

                    </select>

                </div>
              </div>
              <div class="col-3">

                <div class="form-group ">
                  <label>Caja Cerrada</label>
                  <select v-model="cliente.caja_cerrada":value="" class="form-control">
                      <option value="1" >SI</option>
                      <option value="2" >NO</option>


                    </select>

                </div>
              </div>
              <div class="col-3">

                <div class="form-group ">
                  <label>Choferes</label>
                  <div class="input-group">
                    <select v-model="chofer" class="form-control">
                      <option value="" disabled selected>Seleccionar</option>
                      <template v-for="m in chofers">
                      <option :disabled="m.turno_chofer==null" :class="m.turno_chofer==null?'op_disabled':'op_enabled'"  :value="m">{{m.nombre}} {{m.documento.name}} {{m.doc}}</option>
                      </template>


                    </select>

                  </div>
                  <label for="" class="text-danger" v-if="!chofer.hasOwnProperty('id')">Selecciona un chofer</label>
                </div>
              </div>

              <div class="col-12">

                <div class="form-group ">
                  <label>Observacion</label>
                  <input type="text" class="form-control" v-model="entrega.observacion">
                </div>
              </div>
              <div class="col-12">
                <hr>
              </div>
              <div class="col-12 text-center">
              <label>BUSCAR ITEMS PARA VENDER</label>
              </div>
              <div class="col-12 ">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group ">
                            <label>Caja cerrada</label>
                            <div class="input-group">
                                <select v-model="caja_cerrada_id" class="form-control select_cajas_cerradas">

                                    <option v-for="m in cajas_cerrada" :value="m.id">{{m.compra.proveedor_compra.abreviatura}}-{{m.compra.nro_compra}}*{{m.compra.proveedor_compra.abreviatura}}-{{m.compra.nro}}*{{m.cinta}}</option>

                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label>Item PT</label>
                            <div class="input-group">
                                <select v-model="pt_item_id" class="form-control select_pt_item">
                                    <template v-for="m in pts_model" >
                                        <option v-if="m.cajas>0" :value="m.id">PT-{{m.ptm.nro}} * {{m.item.name}}</option>

                                    </template>

                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label>Item PP</label>
                            <div class="input-group">
                                <select v-model="pp_item_id" class="form-control select_pp_item">
                                    <template v-for="m in pps" >
                                        <option  :value="m.pp.id">PP-{{m.pp.nro}} * {{m.pollos}} POLLOS ENTEROS</option>

                                    </template>

                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <template v-for="d_pp in venta_pps">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-2">
                              <div class="form-group">
                                <label for="">PP N°</label>
                                <input type="text" class="form-control" :value="'PP-'+d_pp.pp.nro" readonly>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label for="">CAJAS DIS.</label>
                                <input type="text" class="form-control" :value="d_pp.cajas" readonly>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label for="">POLLOS DIS.</label>
                                <input type="text" class="form-control" :value="d_pp.pollos" readonly>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">PESO PRUTO</label>
                                <input type="text" class="form-control" :value="Number(d_pp.peso_bruto).toFixed(2)" readonly>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">PESO NETO</label>
                                <input type="text" class="form-control" :value="Number(d_pp.peso_neto).toFixed(2)" readonly>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">CAJAS</label>
                                <input type="text" class="form-control" v-model="d_pp.cajas_vender" @change="ChangeCajasPp(d_pp)">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">POLLOS</label>
                                <input type="text" class="form-control" v-model="d_pp.pollos_vender" @change="ChangePollosPp(d_pp)">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">PESO BRUTO</label>
                                <input type="text" class="form-control" v-model="d_pp.peso_bruto_vender">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">PESO NETO</label>
                                <input type="text" class="form-control" v-model="d_pp.peso_neto_vender">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">PRECIO UNIT</label>
                                <input type="text" class="form-control" v-model="ItemSelect.venta">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label for="">SUBTOTAL</label>
                                <input type="text" class="form-control" :value="Number(ItemSelect.venta*d_pp.peso_bruto_vender).toFixed(2)">
                              </div>
                            </div>
                            <div v-if="d_pp.sobra" class="col-3">
                              <div class="form-group">
                                <label for="">DESCRIPCION SOBRA</label>
                                <input type="text" class="form-control" v-model="d_pp.sobra_descripcion">
                              </div>
                            </div>
                            <div v-if="d_pp.sobra" class="col-3">
                              <div class="form-group">
                                <label for="">PESO SOBRA</label>
                                <input type="text" class="form-control" v-model="d_pp.sobra_peso">
                              </div>
                            </div>
                            <div class="col-12">
                              <button class="btn btn-success" @click="AddPpDetalle(d_pp)">AGREGAR</button>
                              <button class="btn btn-primary" @click="d_pp.sobra=!d_pp.sobra">PESO SOBRA</button>
                              <button class="btn btn-danger" @click="venta_pps = []">CANCELAR</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </template>

                </div>
              </div>

              <div class="col-12 mt-2" v-if="DetalleVentaLotes.length">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                      <thead>
                        <tr>

                        <th colspan="13" class="text-center bg-primary text-white">CAJAS CERRADAS</th>

                        </tr>
                        <tr>

                        <th>Lote</th>
                        <th>N Compra</th>
                        <th>Cinta</th>
                        <th>Pigmento</th>
                        <th>Cajas</th>
                        <th>Pollos</th>
                        <th>Peso Bruto</th>
                        <th>Peso Neto</th>
                        <th>P. Bruto U.</th>
                        <th>P. Neto U.</th>
                        <th>Precio Kg </th>
                        <th>Total Bs/ </th>

                        <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(l,i) in DetalleVentaLotes">
                          <td>{{l.compra.proveedor_compra.abreviatura}}-{{l.compra.nro}}</td>
                          <td>{{l.compra.proveedor_compra.abreviatura}}-{{l.compra.nro_compra}}</td>
                          <td :class="'bg-'+bandera(l)+' text-white'">{{l.cinta}}</td>
                          <td>{{l.pigmento==1?'SI':'NO'}}</td>
                          <td>
                            <input type="text" name="" id="" v-model="l.cajas" @change="changeCajas(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" v-model="l.equivalente" @change="changeLote(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" v-model="l.peso_mod_bruto" @change="changeLoteM(l)" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="" id="" v-model="l.peso_mod_neto" @change="changeLoteM(l)" class="form-control">
                          </td>

                          <td>{{l.peso_unitario_bruto}}</td>
                          <td>{{l.peso_unitario_neto}}</td>
                          <td>{{Number(l.valor_precio).toFixed(2)}}</td>
                          <td>{{Number(l.total).toFixed(2)}}</td>


                          <td>
                            <div class="btn-group">
                                <button class="btn btn-danger p-1" @click="detalle_vente_lotes.splice(i,1)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                  </svg>
                                </button>
                                <button class="btn btn-success p-1" @click="addVentaLoteCarrito(l)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>
                            </div>
                          </td>
                        </tr>
                        <tr class="sub_t">
                          <td colspan="4">SUB TOTALES</td>
                          <td>
                            {{Number(total_detalles.cajas)}}
                          </td>

                          <td>
                            {{Number(total_detalles.pollos)}}
                          </td>
                          <td>
                            {{Number(total_detalles.peso_bruto).toFixed(2)}}
                          </td>
                          <td>
                            {{Number(total_detalles.peso_neto).toFixed(2)}}
                          </td>


                          <td>
                            {{Number(total_detalles.peso_unitario_bruto).toFixed(2)}}
                          </td>
                          <td>
                            {{Number(total_detalles.peso_unitario_neto).toFixed(2)}}
                          </td>
                          <td>

                          </td>
                          <td>
                            {{Number(total_detalles.total).toFixed(2)}}
                          </td>
                          <td></td>

                        </tr>
                      </tbody>
                    </table>



                  </div>
                </div>
              </div>


              <div class="col-12 mt-2" v-if="PpItemsModel.length">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">

                      <thead>
                      <tr>
                          <th colspan="10" class="text-center bg-primary text-white">
                            ITEMS PP
                          </th>
                        </tr>
                        <tr>
                        <th>PP</th>
                        <th>Pollos</th>
                        <th>Cajas</th>
                        <th>P.Bruto</th>
                        <th>Taras</th>
                        <th>P. Neto</th>
                        <th>P. Neto U</th>
                        <th>Precio KG</th>
                        <th>Total Bs/.</th>


                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(l,i) in PpItemsModel">
                          <td>PP-{{l.pp.nro}}</td>

                            <td>
                                <input type="text" class="form-control form-control-sm" v-model="l.pollos_vender" @change="ChangePollosPp(l)">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" v-model="l.cajas_vender" @change="ChangeCajasPp(l)">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" v-model="l.peso_bruto_vender">
                            </td>
                            <td>{{Number(l.peso_bruto_vender - l.peso_neto_vender).toFixed(2)}}</td>
                            <td>
                                <input type="text" class="form-control form-control-sm" v-model="l.peso_neto_vender">
                            </td>



                          <td>{{Number(l.peso_neto_unit).toFixed(2)}}</td>
                          <td>{{Number(l.precio_acuerdo).toFixed(2)}}</td>
                          <td>{{Number(l.total).toFixed(2)}}</td>



                          <td>
                            <div class="btn-group">
                                <button class="btn btn-danger p-1" @click="detalle_venta_pp.splice(i,1)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                  </svg>
                                </button>
                                <button class="btn btn-success p-1" @click="addVentaPpCarrito(l)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>
                            </div>
                          </td>
                        </tr>

                      </tbody>
                    </table>

                       <div class="row p-2">
                         <div class="col-4">

                            <div class="form-group ">
                                <label>Items</label>
                                <div class="input-group">
                                    <select v-model="item_id" class="form-control basic">

                                    <option v-for="m in items" :value="m.id">{{m.name}}</option>

                                    </select>

                                </div>
                            </div>
                       </div>
                         <div class="col-4">

                            <div class="form-group ">

                                <div class="d-flex">
                                    <template v-for="m in acuerdos">
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-primary">
                                            <input type="radio" v-model="acuerdo" :value="m" class="new-control-input" >
                                            <span class="new-control-indicator"></span>{{m.name}}
                                            </label>
                                        </div>

                                    </template>

                                </div>
                            </div>
                       </div>
                         <div class="col-4">

                            <div class="d-flex justify-content-between">
                                <div class="form-group text-center">
                                    <label for="" class="text-primary fw-bold">KG</label>
                                    <input type="text" v-model="peso_acuerdo" class="form-control" style="width:70px" >
                                </div>
                                <div class="form-group text-center" style="width: 80px; padding:2px">
                                    <label for="" class="text-primary fw-bolder">X</label>
                                  <label for="" class="" style="width:70px" >{{ModelAcuerdo.cantidad}}</label>
                                </div>
                                <div class="form-group text-center" style="width:70px">
                                    <label for="" class="text-primary fw-bolder">T.Des</label>
                                      <label for="" class="" style="width:70px" >{{Number(ModelAcuerdo.t_des).toFixed(2)}}</label>
                                </div>
                                <div class="form-group text-center" style="width:70px">
                                    <label for="" class="text-primary fw-bolder">Total</label>
                                    <label for="" class="" style="width:70px" >{{Number(ModelAcuerdo.total).toFixed(2)}}</label>
                                </div>
                            </div>
                       </div>

                    </div>

                  </div>
                </div>
              </div>
              <div class="col-12 mt-2" v-if="venta_items.length">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th colspan="8" class="text-center bg-primary text-white">
                            ITEMS PT
                          </th>
                        </tr>
                        <tr>

                          <th>
                            PT
                          </th>
                          <th>
                            ITEM
                          </th>
                          <th>
                            CAJAS
                          </th>
                          <th>
                            P. BRUTO KG
                          </th>
                          <th>
                            P. TARA KG
                          </th>
                          <th>
                            P. NETO KG
                          </th>
                          <th>
                            TOTAL Bs/
                          </th>
                          <th>

                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item,i) in venta_items" class="tr-hover">
                          <td>PT-{{item.nro}}</td>
                          <td>{{item.item.name}}</td>
                          <td> <input type="text" class="form-control" v-model="item.cajas_vender" @change="changeCajasItem(item)"> </td>
                          <td> <input type="text" class="form-control" v-model="item.peso_bruto_vender" @change="changePesoBrutoItem(item)"> </td>
                          <td> <input type="text" class="form-control" v-model="item.tara_vender"> </td>
                          <td> <input type="text" class="form-control" v-model="item.peso_neto_vender" @change="changePesoNetoItem(item)"> </td>
                          <td>{{Number(item.item.venta*item.peso_neto_vender).toFixed(2)}}</td>
                          <td>
                            <div class="btn-group">
                            <button class="btn btn-danger p-1" @click="venta_items.splice(i,1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                            </button>
                            <button class="btn btn-success p-1" @click="addVentaPtCarrito(item)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </button>
                            </div>
                          </td>
                        </tr>
                    </tbody>
                    </table>



                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content widget-content-area border-tab p-0">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th colspan="4" class="text-center bg-primary text-white">
                            GASTOS
                          </th>
                        </tr>
                        <tr>

                          <th>

                          </th>
                          <th>
                            DETALLE
                          </th>
                          <th>
                            VALOR
                          </th>

                          <th>

                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <template v-for="(item,i) in gastos">
                        <tr class="tr-hover">
                          <td>
                          <button @click="addGasto()" class="btn btn-success p-1" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-plus">
                                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        </svg>
                                                    </button>
                          </td>

                          <td> <input type="text" class="form-control" v-model="item.detalle"> </td>
                          <td> <input type="text" class="form-control" v-model.number="item.valor"> </td>
                            <td>
                          <button class="btn btn-danger p-1" v-if="i>0" @click="gastos.splice(i,1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                              </svg>
                            </button>
                          </td>
                        </tr>
                      </template>
                    </tbody>
                    </table>



                  </div>
                </div>
              </div>
              <div class="col-12 text-center p-0 mt-2">
                <button @click="Vender" class="btn btn-success btn-block w-100 p-4">
                  <h4 class="text-white">FINALIZAR DESPACHO DE NDD (F7)</h4>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="row">
        <div class="col-12">
      <div class="row">
        <div class="col-12">
                <table class="table table-bordered">

                            <table class="table table-bordered">
                                <thead>
                                    <th>Nro Compra</th>
                                    <th>Lote</th>
                                    <template v-for="m in listaCintasCajaCerrada">
                                        <th>{{m}}</th>
                                    </template>

                                </thead>
                                <tbody>
                                    <template v-for="m in cajaCerradaFiltro">

                                        <tr >
                                            <td>{{m.compra.proveedor_compra.abreviatura}}-{{m.compra.nro_compra}}</td>
                                            <td>{{m.compra.proveedor_compra.abreviatura}}-{{m.compra.nro}}</td>
                                            <template v-for="c in m.filtro_cintas_cajas">
                                               <td>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                    {{Number(c.lote_detalle.cajas-c.envios)}} ({{Number(c.lote_detalle.promedio).toFixed(2)}})

                                                    </div>
                                                <button v-if="c.lote_detalle.cajas>0"  :disabled="cliente.id==''"  data-toggle="modal" data-target="#exampleModal"  class="btn btn-success p-1" @click="AddDetalle(c.lote_detalle,c.compra,c.cinta,c.dias)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-plus">
                                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                               </td>
                                            </template>


                                        </tr>

                                    </template>




                                </tbody>

                            </table>

        </div>

      </div>
    </div>
            <div class="col-12">
                <div class="widget-content widget-content-area br-6">
                    <div class="section general-info">
                    <div class="info">
                        <h6 class="">ITEMS KG</h6>
                        <div class="row px-0">
                        <div class="col-12 px-0">
                            <table class="table table-bordered">
                            <thead>
                                <tr>

                                <th>
                                    PT
                                </th>
                                <th>
                                    ITEM
                                </th>

                                <th>
                                    KG
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template  v-for="ptm in pts">
                                    <template v-for="item in ptm.items">
                                    <tr v-if="item.cajas>0" @click="AddPtItem(item,ptm)" class="tr-hover">
                                        <td>PT-{{ptm.nro}}</td>
                                        <td>{{item.item.name}}</td>

                                        <td>{{Number(item.peso_bruto).toFixed(2)}} KG</td>
                                    </tr>
                                    </template>
                                </template>


                            </table>
                        </div>
                        <div class="col-12 px-0" v-if="pp.hasOwnProperty('pp')" >
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>
                                    N°
                                </th>
                                <th>
                                    PRODUCTO
                                </th>
                                <th>
                                    SALDO
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="m in pps">
                                    <tr @click="AddPp(m)" class="tr-hover">
                                        <td>PP-{{m.pp.nro}}</td>
                                        <td>{{m.pollos}} POLLOS ENTEROS</td>
                                        <td>{{Number(m.peso_neto).toFixed(2)}} KG</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="p-0">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            GRUPO
                                                        </th>
                                                        <th>
                                                            SAL
                                                        </th>
                                                        <th>
                                                            DIS
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                        <tr class="bg-light-primary" v-for="g in m.pp.pp_traspaso_pp_cinta_list">
                                                            <td class="font-weight-bold text-primary">{{g.cinta_cliente.name}}</td>
                                                            <td class="font-weight-bold text-primary">-</td>
                                                            <td class="font-weight-bold text-primary">-</td>
                                                        </tr>

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </template>
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
        },
        documentos: [],
        tipoclientes: [],
        lote_id: '',
        lotes: [],
        chofer:{
          capacidad_utilizada:0,
          turno_chofer:{
            capacidad_disponible:0
          }
        },
        sucursal: {},
        user: {},
        pp: {
          pp: {}
        },
        pt: {
          items: []
        },
        venta_pps: [],
        lote: {
          lote_detalles: [],
          pp_detalles: [],
          pt_detalles: [],
          pp_descomposicion_detalles: [],
        },
        lotes: [],
        banderas: [],
        detalle_vente_lotes: [],
        detalle_venta_pp: [],
        clientes: [],
        formapagos: [],
        chofers: [],
        items: [],
        venta_items: [],
        item_select: '1',
        cliente: {
          cinta_cliente:{

          }
        },
        chofer_id: '',
        formapago_id: 1,
        entrega: {
          fecha: '',
          hora: ''
        },
        productos_precios: [],
        detalle_lote:{

        },
        producto_precio:{

        },
        tipo_precio:{
          1:'DE 1 A 14 POLLOS',
          2:'OFICIAL (15 A 75 POLLOS)',
          3:'DE 76 A 150 POLLOS',
          4:'DE 151 A MAS POLLOS',
          5:'CUALQUIER CANTIDAD AL CONTADO',
          6:'vip',
        },
        cintaClientes:[],
        pps:[],
        pts:[],
        banderas:[],
        caja_cerrada_id:0,
        pp_item_id:0,
        pt_item_id:0,
        item_id:1,
        acuerdos:[],
        acuerdo:{},
        gastos:[
            {
                detalle:'',
                valor:0
            }
        ],
        peso_acuerdo:0,
        caja_busqueda:'',
        cart_lotes:[],
        cart_pps:[],
        cart_pts:[],
      }
    },
    computed: {
      valor_precio(){
        if(this.cliente.tipo_caja_cerrada==1){
          return this.producto_precio.venta_1
        }
        if(this.cliente.tipo_caja_cerrada==2){
          return this.producto_precio.venta_2
        }
        if(this.cliente.tipo_caja_cerrada==3){
          return this.producto_precio.venta_3
        }
        if(this.cliente.tipo_caja_cerrada==4){
          return this.producto_precio.venta_4
        }
        if(this.cliente.tipo_caja_cerrada==5){
          return this.producto_precio.venta_5
        }
        if(this.cliente.tipo_caja_cerrada==6){
          return this.producto_precio.venta_6
        }
      },
      ItemSelect() {
        let item = this.items.find(i => i.id == this.item_select)
        if (item) {
          return item
        }
        return {
          venta: 0

        }
      },
      imgPollo() {
        return "{{url('')}}/img/pollo.jpg"
      },
      model_detalles() {
        return this.lotes.map((l) => {

          l.cajas_disponibles = l.lote_detalles.reduce((a, b) => a + (b.cajas > 0 ? b.cajas : 0), 0)
          l.pollos_disponibles = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? b.equivalente : 0), 0)
          l.peso_neto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (b.peso_total - b.cajas * 2) : 0), 0)
          l.peso_bruto_disponible = l.lote_detalles.reduce((a, b) => a + (b.equivalente > 0 ? (b.peso_total) : 0), 0)

          return l

        })
      },
      total_detalles() {
        let cajas = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.cajas), 0)
        let pollos = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.equivalente), 0)
        let peso_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)
        let peso_neto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_neto), 0)
        let merma_bruta = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.merma_bruta), 0)
        let merma_neta = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.merma_neta), 0)
        let peso_unitario_bruto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_unitario_bruto), 0)
        let peso_unitario_neto = this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_unitario_neto), 0)
        let total = this.DetalleVentaLotes.reduce((a, b) => a + Number(b.total), 0)
        return {
          cajas: cajas,
          pollos: pollos,
          peso_bruto: peso_bruto,
          peso_neto: peso_neto,
          merma_bruta: merma_bruta,
          merma_neta: merma_neta,
          peso_unitario_bruto: peso_unitario_bruto,
          peso_unitario_neto: peso_unitario_neto,
          total: total,
        }
      },
      venta_items_peso_bruto(){
        return this.venta_items.reduce((a, b) => a + Number(b.peso_bruto_vender), 0)

      },
      detalle_vente_lotes_peso_bruto(){
        return this.detalle_vente_lotes.reduce((a, b) => a + Number(b.peso_mod_bruto), 0)

      },
      detalle_venta_pp_peso_bruto(){
        return this.detalle_venta_pp.reduce((a, b) => a + Number(b.peso_bruto_vender), 0)
      },
      peso_bruto_total(){
        return Number(this.venta_items_peso_bruto + this.detalle_vente_lotes_peso_bruto + this.detalle_venta_pp_peso_bruto).toFixed(2)
      },
       lista_cintas1(){

                let cintas_detalles = [];
                this.model_detalles.forEach(compra => {
                    compra.lote_detalles.forEach(detalle => {
                        let pigmento = detalle.pigmento == 1? 'CP' : 'SP'
                        let buscar_cinta =cintas_detalles.filter((e)=>{
                            return e.name==detalle.producto+'/'+pigmento
                        })
                        if (buscar_cinta.length==0) {
                        cintas_detalles.push({id:detalle.compra_inventario.sub_original_id,name:detalle.producto+'/'+pigmento});
                        }
                    });
                });
                return cintas_detalles
            },
            lista_cintas(){

                let lista= this.lista_cintas1.sort(function(a, b) {
                            return a.id - b.id;
                            });
                return lista.map((e)=>e.name)
            },
   model_cintas1(){
                let model = this.model_detalles.map((compra)=>{
                    compra.cintas = [...this.lista_cintas]
                    let cintas_cajas = compra.cintas.map((cinta)=>{
                        let lote_detalles = compra.lote_detalles.filter((detalle)=>{
                            let pigmento = detalle.pigmento == 1? 'CP' : 'SP'
                            return detalle.name+'/'+pigmento == cinta
                        })
                        lote_detalles = lote_detalles.sort((a, b)=>{
                        return b.peso_total - a.peso_total;
                        })
                        if(lote_detalles.length>0){

                            let lote_detalle = lote_detalles[0]
                            lote_detalle.cajas = lote_detalles.reduce((a,b)=>a+b.cajas,0)
                            lote_detalle.total_pollos = lote_detalles.reduce((a,b)=>a+b.equivalente,0)
                            lote_detalle.total_peso = lote_detalles.reduce((a,b)=>a+b.peso_total,0)
                            lote_detalle.promedio = lote_detalle.total_peso / (lote_detalle.total_pollos<=0?1:lote_detalle.total_pollos)

                            let detalle = {
                                lote_detalles,
                                cinta,
                                lote_detalle
                            }
                            return detalle
                        }else{
                            let detalle = {
                                cinta,
                                lote_detalle :{
                                    cajas: 0,
                                    promedio:0
                                }
                            }
                            return detalle
                        }
                    })
                    compra.cinta_cajas = cintas_cajas
                    compra.total_cajas = cintas_cajas.reduce((a,b)=>a+b.lote_detalle.cajas,0)
                    return compra
                })
                return model
            },
             model_cintas(){
                let self = this
                let id = 1
                let model = this.model_detalles.map((compra)=>{
                    compra.cintas = [...this.lista_cintas]
                    let cintas_cajas = compra.cintas.map((cinta)=>{
                        let lote_detalles = compra.lote_detalles.filter((detalle)=>{
                            let pigmento = detalle.pigmento == 1? 'CP' : 'SP'
                            return detalle.producto+'/'+pigmento == cinta
                        })

                        let cajas_envio = [...self.detalle_vente_lotes].filter((detalle)=>{
                            let pigmento = detalle.pigmento == 1? 'CP' : 'SP'
                            return detalle.producto+'/'+pigmento == cinta && detalle.compra_id ==compra.id
                        })
                        // let envios = 0
                        let envios = cajas_envio.reduce((a,b)=>a+Number(b.cajas),0)
                        lote_detalles = lote_detalles.sort((a, b)=>{
                        return b.peso_total - a.peso_total;
                        })
                        if(lote_detalles.length>0){

                            let lote_detalle = {...lote_detalles[0]}
                            lote_detalle.cajas = lote_detalles.reduce((a,b)=>a+b.cajas,0)
                            lote_detalle.total_pollos = lote_detalles.reduce((a,b)=>a+b.equivalente,0)
                            lote_detalle.total_peso = lote_detalles.reduce((a,b)=>a+b.peso_total,0)
                            lote_detalle.promedio = lote_detalle.total_peso / (lote_detalle.total_pollos<=0?1:lote_detalle.total_pollos)

                            let detalle = {

                                lote_detalles,
                                compra:compra.compra,
                                cinta,
                                dias:compra.dias,
                                lote_detalle,
                                envios:envios
                            }
                            return detalle
                        }else{
                            let detalle = {

                                cinta,
                                compra:compra.compra,
                                dias:compra.dias,
                                envios:envios,
                                lote_detalle :{
                                    cajas: 0,
                                    promedio:0,
                                    envios:[]
                                },

                            }
                            return detalle
                        }

                    })
                    compra.cinta_cajas = cintas_cajas.map((c)=>{
                        c.id = id


                        id = id+1
                        return c
                    });

                    compra.total_envios = cintas_cajas.reduce((a,b)=>a+b.envios,0)
                    compra.total_cajas = cintas_cajas.reduce((a,b)=>a+b.lote_detalle.cajas,0) - compra.total_envios
                    compra.cerrar = compra.total_cajas==0?true:false
                    return compra
                })
                return model
            },
             totales_cintas(){
                let cintas = [...this.lista_cintas]
                let cinta_totales = cintas.map((cinta)=>{
                    let total_cajas = 0
                    let model_cintas = [...this.model_cintas].map((model)=>{
                        let buscar_cinta = model.cinta_cajas.filter((b)=>b.cinta==cinta)
                        if(buscar_cinta){
                            total_cajas += buscar_cinta.reduce((a,b)=>a+b.lote_detalle.cajas,0)

                        }
                    })
                    return {
                        name:cinta,
                        total_cajas:total_cajas
                    }
                })
                return cinta_totales
            },
            total_cinta(){
                return this.totales_cintas.reduce((a,b)=>a+b.total_cajas,0)
            },
            lotes_cerrar(){
                return this.model_cintas.filter((l)=>l.cerrar==true)
            },
            cajas_cerrada(){
                return this.model_cintas.flatMap((l)=>l.cinta_cajas)
            },
            pts_model(){
                let id = 1
                let pts = [...this.pts]
                pts.map((pt)=>{
                    pt.items = pt.items.map((item)=>{
                        item.ptm = {
                            id:pt.id,
                            nro:pt.nro
                        }
                        item.id = id
                        id = id+1
                        return item
                    })
                    return pt
                })
                return pts.flatMap((pt)=>pt.items)
            },
            PpItemsModel(){
                let acuerdo = this.acuerdo
                return this.detalle_venta_pp.map((d)=>{
                    d.precio_acuerdo = acuerdo.precio
                    d.total = Number(d.peso_neto_vender*d.precio_acuerdo)
                    return d
                })
            },
            ModelAcuerdo(){
                let acuerdo = this.acuerdo
                if(acuerdo.hasOwnProperty('id')){
                    let pollos = this.PpItemsModel.reduce((a,b)=>a+b.pollos_vender,0)
                    let total = this.PpItemsModel.reduce((a,b)=>a+b.total,0)
                    let peso = Number(acuerdo.peso*pollos)
                    if(acuerdo.digitar==0){
                        this.peso_acuerdo = peso
                    }
                    let t_des = Number(this.peso_acuerdo)*Number(acuerdo.cantidad)
                    return {
                        kg: this.peso_acuerdo,
                        cantidad:Number(acuerdo.cantidad),
                        t_des:t_des,
                        total:Number(total)-t_des
                    }

                }
                return{
                    kg: 0,
                    cantidad:0,
                    t_des:0,
                    total:0
                }
            },
            DetalleVentaLotes(){

                return this.detalle_vente_lotes.map((d)=>{
                    d.valor_precio = d.valor_precio
                    d.total = Number(d.peso_mod_neto*d.valor_precio)
                    return d
                })
            },
            totalGastos(){
                return this.gastos.reduce((a,b)=>a+b.valor,0)
            },
            listaCintasCajaCerrada(){
                return this.lista_cintas.filter((b)=>b.toLowerCase().indexOf(this.caja_busqueda) != -1).slice(0, 1)
            },
            cajaCerradaFiltro(){
                return this.model_cintas.map((c)=>{
                    c.filtro_cintas = c.cintas.filter((b)=>b.toLowerCase().indexOf(this.caja_busqueda) != -1).slice(0, 1)
                    c.filtro_cintas_cajas = c.cinta_cajas.filter((b)=>b.cinta.toLowerCase().indexOf(this.caja_busqueda) != -1).slice(0, 1)
                    return c
                })
            }
    },
    methods: {
        addVentaLoteCarrito(d){
            let item = {...d}

            this.cart_lotes.push(item)
        },
        addVentaPpCarrito(d){
            let item = {...d}

            this.cart_pps.push(item)
        },
        addVentaPtCarrito(d){
            let item = {...d}

            this.cart_pts.push(item)
        },
        addGasto(){
          this.gastos.push({
            detalle:'',
            valor:0
          })
        },
      AddPpDetalle(d) {

            let pp_detalle = {
              ...d
            }
            pp_detalle.item = {
              ...this.ItemSelect
            }
            this.detalle_venta_pp.push(pp_detalle)
            this.venta_pps = []



      },
      AddPtItem(d,pt) {
        let pt_detalle = {
          ...d
        }
        pt_detalle.pt_id = pt.id
        pt_detalle.nro = pt.nro
        pt_detalle.peso_bruto_x_caja = Number(pt_detalle.peso_bruto / pt_detalle.cajas).toFixed(2)
        pt_detalle.peso_neto_x_caja = Number(pt_detalle.peso_neto / pt_detalle.cajas).toFixed(2)
        pt_detalle.cajas_vender = 1
        pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
        pt_detalle.peso_neto_vender = pt_detalle.peso_neto_x_caja * pt_detalle.cajas_vender
        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender

        this.venta_items.push(pt_detalle)
      },
      changeCajasItem(pt_detalle) {
        let cajas = pt_detalle.cajas_vender*2
        pt_detalle.peso_bruto_vender = pt_detalle.peso_bruto_x_caja * pt_detalle.cajas_vender
        pt_detalle.peso_neto_vender = pt_detalle.peso_bruto_x_caja - cajas
        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
      },
      changePesoBrutoItem(pt_detalle) {
        let cajas = pt_detalle.cajas_vender*2
        pt_detalle.peso_neto_vender =pt_detalle.peso_bruto_vender - cajas
        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
      },
      changePesoNetoItem(pt_detalle) {
        let cajas = pt_detalle.cajas_vender*2
        pt_detalle.peso_neto_vender =pt_detalle.peso_bruto_vender - cajas
        pt_detalle.tara_vender = pt_detalle.peso_bruto_vender - pt_detalle.peso_neto_vender
      },
      bandera(d) {
        let b = this.banderas.find(b => d.dias >= b.min && d.dias <= b.max)
        if (b) {
            return b.name
        }
        return ''
    },
      changeCajas(d) {
        d.equivalente = Math.round(Number(d.cajas * d.pollos))
         let cajas = d.cajas *2
        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
        d.peso_actual_neto = Number(d.peso_actual_bruto-cajas).toFixed(2)
        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
      },
      changeLote(d) {
        let cajas = d.cajas *2
        d.peso_actual_bruto = Number(d.equivalente * d.peso_unitario_bruto).toFixed(2)
        d.peso_actual_neto = Number(d.peso_actual_bruto-cajas).toFixed(2)
        d.peso_mod_bruto = Number(d.peso_actual_bruto).toFixed(2)
        d.peso_mod_neto = Number(d.peso_actual_neto).toFixed(2)
        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
      },
      changeLoteM(d) {

        d.merma_bruta = Number(d.peso_actual_bruto - d.peso_mod_bruto).toFixed(2)
        d.merma_neta = Number(d.peso_actual_neto - d.peso_mod_neto).toFixed(2)
      },
      AddDetalle(i, compra,cinta,dias) {
        let item = {
          ...i
        }
        item.compra = {
          ...compra
        }
        item.peso_unitario_bruto = Number(item.peso_total / item.equivalente).toFixed(2)
        item.peso_neto = Number(item.peso_total - item.cajas * 2).toFixed(2)
        item.peso_unitario_neto = Number(item.peso_neto / item.equivalente).toFixed(2)
        item.peso_actual_bruto = Number(item.equivalente * item.peso_unitario_bruto).toFixed(2)
        item.peso_actual_neto = Number(item.equivalente * item.peso_unitario_neto).toFixed(2)
        item.peso_mod_bruto = Number(item.peso_actual_bruto).toFixed(2)
        item.peso_mod_neto = Number(item.peso_actual_neto).toFixed(2)
        item.merma_bruta = Number(item.peso_actual_bruto - item.peso_mod_bruto).toFixed(2)
        item.merma_neta = Number(item.peso_actual_neto - item.peso_mod_neto).toFixed(2)
        item.cinta = cinta
        item.dias = dias
        this.detalle_lote = item
        console.log(this.detalle_lote)
      },
      AddDetalleLote(){
        let item = {
          ...this.detalle_lote
        }
        item.producto_precio = {
          ...this.producto_precio}
          item.valor_precio =this.valor_precio
        this.detalle_vente_lotes.push(item)
      },
      CambioPeso() {
        this.envio.bruto = Number(this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes).toFixed(2)
        this.envio.neto = Number(this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes).toFixed(2)
        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) - {
          ...this.envio
        }.bruto).toFixed(2)
        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) - {
          ...this.envio
        }.neto).toFixed(2)


      },
      CambioPesoMerma() {
        this.envio.merma_bruta = Number((this.detalle_lote.peso_unit_pollo * this.detalle_vente_lotes) - {
          ...this.envio
        }.bruto).toFixed(2)
        this.envio.merma_neta = Number((this.detalle_lote.peso_neto_pollo * this.detalle_vente_lotes) - {
          ...this.envio
        }.neto).toFixed(2)


      },
      async FinalizarLote(id) {
        try {
          // let res = await axios.post(, this.model)
          const params = new URLSearchParams(this.model);
          let url = "{{url('api/lotes-finalizar')}}/" + id;
          let res = await  axios.post(url, {
            id
          })

          await this.load()

        } catch (e) {

        }
      },
      async Vender() {
         if (!this.cliente || !this.cliente.id) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'No hay Cliente',
                                text: "Selecciona un cliente primero.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            return;
                        }

                        if (!this.chofer || !this.chofer.id) {
                            swal.fire({
                                title: 'Chofer no asignado',
                                text: 'Debe seleccionar un chofer antes de continuar con la venta.',
                                type: 'warning',
                                confirmButtonText: 'Aceptar',
                                confirmButtonClass: 'btn btn-danger'
                            });
                            return;
                        }
        block.block()
        let self = this
        try {
          let data = {
            sucursal_id: self.sucursal.id,
            cliente_id: self.cliente.id,
            cinta_cliente_id:self.cliente.cinta_cliente.id,
            chofer_id: self.chofer.id,
            turno_chofer_id: self.chofer.turno_chofer.id,
            venta_pps: self.cart_pps,
            detalle_vente_lotes: self.cart_lotes,
            venta_items: self.cart_pts,
            peso_bruto_total: self.peso_bruto_total,
            fecha_entrega: self.entrega.fecha,
            hora_entrega: self.entrega.hora,
            lotes:this.lotes_cerrar,
            acuerdo:this.acuerdo,
            observacion:this.entrega.observacion
          }
          let res = await axios.post("{{url('api/ventas')}}", data)
          self.detalle_vente_lotes = []
          self.venta_pps = []
          self.venta_items = []
          self.detalle_venta_pp = []
          self.cart_pps = []
          self.cart_lotes = []
          self.cart_pts = []
          self.entrega = {
            fecha: '',
            hora: ''
          }
          self.chofer={
            capacidad_utilizada:0,
            turno_chofer:{
              capacidad_disponible:0
            }
          }
          window.open(res.data.url_pdf, '_blank');
          await this.load()
        } catch (e) {
            console.log(e)
        } finally {
          block.unblock()
        }
      },
      ChangeCajasPp(item) {
        let cajas = Number(item.cajas_vender)

        let pollos_x_caja = Number(item.pollos_x_caja)
        item.pollos_vender = Math.round(cajas * pollos_x_caja)
        item.peso_bruto_vender = Number(item.pollos_vender * item.peso_bruto_unit).toFixed(2)
        item.peso_neto_vender = Number(item.pollos_vender * item.peso_neto_unit).toFixed(2)

      },
      ChangePollosPp(item) {

        let pollos_vender = Number(item.pollos_vender)
        item.peso_bruto_vender = Number(pollos_vender * item.peso_bruto_unit).toFixed(2)
        item.peso_neto_vender = Number(pollos_vender * item.peso_neto_unit).toFixed(2)

      },
      AddPp(m) {

        let pp = {
          ...m
        }
        let pollos_x_caja = Number(pp.pollos) / Number(pp.cajas)
        pp.cajas_vender = pp.cajas
        pp.peso_bruto_vender = Number(pp.peso_bruto).toFixed(2)
        pp.peso_neto_vender = Number(pp.peso_neto).toFixed(2)
        pp.pollos_vender = pp.pollos
        pp.pollos_x_caja = pollos_x_caja
        pp.peso_bruto_unit = Number(pp.peso_bruto) / Number(pp.pollos)
        pp.peso_neto_unit = Number(pp.peso_neto) / Number(pp.pollos)
        pp.sobra = false
        pp.sobra_descripcion = ''
        pp.sobra_peso = 0
        // if (this.venta_pps.length == 0) {
        //   this.venta_pps.push(pp)
        // }
        this.AddPpDetalle(pp)
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

          let url = "url_path()api/clientes";
          await axios.post("{{url('api/clientes')}}", this.model)
          this.back()

        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      async GetLote() {
        block.block();
        try {
          let res = await axios.get("{{url('api')}}/lotes-pos/" + this.lote_id)
          this.lote = res.data
        } catch (e) {

        } finally {
          block.unblock();
        }
      },
      back() {
        window.location.replace(document.referrer);
      },
      async load() {
        try {
          let self = this

          try {
            await Promise.all([self.GET_DATA("pps/curso-pos/" + this.sucursal.id),
              self.GET_DATA("lotes-general"),
              self.GET_DATA("banderas"),
              self.GET_DATA("clientes"),
              self.GET_DATA("chofers-turno"),
              self.GET_DATA("formapagos"),
              self.GET_DATA("items"),
              self.GET_DATA("pts/curso-pos/" + this.sucursal.id),
              self.GET_DATA("producto-precios-sucursal/"+this.sucursal.id),
              self.GET_DATA("cintaClientes"),
              self.GET_DATA("acuerdoClientes")
            ]).then((v) => {
              self.pps = v[0]
              self.lotes = v[1]
              self.banderas = v[2]
              self.clientes = v[3]
              self.chofers = v[4]
              self.formapagos = v[5]

              let items = v[6]
              self.items = items.filter((v) => v.tipo == 1)
              self.pts = v[7]
              self.productos_precios = v[8]
              self.cintaClientes = v[9]
              self.acuerdos = v[10]
            })

          } catch (e) {

          }
        } catch (e) {

        }
      },
      TeclaPress(e) {
        //tecla F8
          if (e.keyCode == 118) {
              this.Vender
          }

      },
      async preventRefresh(event) {
        if (event.key === 'F5' || (event.ctrlKey && event.key === 'r')) {
            event.preventDefault();

        }
        if(event.key === 'F7'){
            await this.Vender()
        }
    }
    },
    mounted() {
      this.$nextTick(async () => {
        let self = this

        try {



          let sucursal = localStorage.getItem('AppSucursal')
          this.sucursal = JSON.parse(sucursal)
          let user = localStorage.getItem('AppUser')
          this.user = JSON.parse(user)
          await Promise.all([self.load()]).then((v) => {

          })

        } catch (e) {

        } finally {
            $(".select_cliente").select2({
                tags: true,
                placeholder: "Seleccione un cliente",
            }).change((v) => {
                self.model.cliente_id = v.target.value
                let buscar_cliente = self.clientes.find((v) => v.id == self.model.cliente_id)
                self.cliente = buscar_cliente
                self.acuerdo = self.cliente.acuerdo_cliente
                $('.select_codigo_cliente').val(v.target.value).trigger('change');
            })
            $(".select_codigo_cliente").select2({
                tags: true,
                placeholder: "Buscar un codigo",
            }).change((v) => {
                self.model.cliente_id = v.target.value
                let buscar_cliente = self.clientes.find((v) => v.id == self.model.cliente_id)
                self.cliente = buscar_cliente
                $('.select_cliente').val(v.target.value).trigger('change');
            })
            $(".select_cajas_cerradas").select2({
                tags: true,
                placeholder: "Buscar",
            }).change((v) => {
                self.cajas_cerrada_id = v.target.value
                let buscar_caja = self.cajas_cerrada.find((v) => v.id == self.cajas_cerrada_id)
                self.AddDetalle(buscar_caja.lote_detalle,buscar_caja.compra,buscar_caja.cinta,buscar_caja.dias)
                $("#exampleModal").modal("show")
            })
            $('.select_cajas_cerradas').on('select2:open', function(e) {
                // Encuentra el input de búsqueda
                let searchField = document.querySelector('.select2-search__field');

                // Escucha el evento 'keyup' en el input de búsqueda
                searchField.addEventListener('keyup', function(event) {
                    self.caja_busqueda = event.target.value
                });
            });
            $(".select_pt_item").select2({
                tags: true,
                placeholder: "Buscar",
            }).change((v) => {
                self.pt_item_id = v.target.value
                let buscar = self.pts_model.find((v) => v.id == self.pt_item_id)
                self.AddPtItem(buscar,buscar.ptm)
            })
            $(".select_pp_item").select2({
                tags: true,
                placeholder: "Buscar",
            }).change((v) => {
                self.pp_item_id = v.target.value
                let buscar = self.pps.find((v) => v.pp.id == self.pp_item_id)
                self.AddPp(buscar)
            })

            document.addEventListener('keydown', (event) => {
                self.TeclaPress(event)
            })
             window.addEventListener('keydown', this.preventRefresh);
        }

      })
    }
  }).mount('#meApp')
</script>
@endslot


@slot('style')
<style>
  #map {
    height: 280px;
  }

  .tr-hover {
    cursor: pointer;
  }

  .tr-hover:hover {
    background-color: #f2f2f2;
  }

  .tb-pos th {
    font-size: 10px !important;
    padding: 5px !important;
  }

  .tb-pos td {
    font-size: 9px !important;
    padding: 5px !important;
  }
  option.op_enabled{

    background: #28a745 !important;
    color: white !important;
  }
  option.op_disabled{

    background: #dc3545 !important;
    color: white !important;
  }
  .disabled_bg.bg-success {
    background-color: #8dbf42!important;
    border-color: #8dbf42;
    color: #fff;
  }
  .disabled_bg.bg-danger {
    background-color: #dc3545!important;
    border-color: #dc3545;
    color: #fff;
  }
</style>
@endslot
@endcomponent
