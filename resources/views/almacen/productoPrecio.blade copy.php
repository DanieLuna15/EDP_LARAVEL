@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="action-btn layout-top-spacing mb-5">
                    <div class="page-header">
                        <div class="page-title">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg> Almacen / Productos Precios</p>
                        </div>
                        <div>
                            <button @click="formula=!formula" class="btn "
                                :class="formula == true ? 'btn-warning' : 'btn-danger'">{{ formula == true ? 'CON FORMULA' : 'SIN FORMULA' }}</button>
                            <button @click="activeDescuento=!activeDescuento" class="btn "
                                :class="activeDescuento == true ? 'btn-warning' : 'btn-danger'">{{ formula == true ? 'CON DESCUENTO' : 'SIN DESCUENTO' }}</button>

                            <button @click="activeEstado=!activeEstado" class="btn"
                                :class="activeEstado == true ? 'btn-info' : 'btn-secondary'">
                                {{ activeEstado == true ? 'CON ESTADO' : 'SIN ESTADO' }}
                            </button>
                            <button
                                v-if="activeEstado"
                                class="btn btn-danger"
                                @click="LimpiarEstadosGlobal"
                                title="Limpiar estados"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button @click="ActualizarPrecios" class="btn btn-success">Actualizar Precios</button>
                            <button data-toggle="modal" data-target="#exampleModal" @click="add=true,model.name='',model.venta_2=0"
                                class="btn btn-success">Agregar</button>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">{{ add == true ? 'Agregar' : 'Actualizar' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Nombre</label>
                                                                <select v-model="model.name" class="form-control">
                                                                    <option v-for="m in cintas" :value="m.name">
                                                                        {{ m . name }}</option>
                                                                    <option value="POLLO LIMPIO"> POLLO LIMPIO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Precio CBBA</label>
                                                                <input type="text" v-model="model.precio" class="form-control"
                                                                    placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="row">


                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 1 A 14 POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_1"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">OFICIAL (15 A 75 POLLOS)</label>
                                                                <input type="text" v-model.number="model.venta_2"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 76 A 150 POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_3"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>

                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">DE 151 A MAS POLLOS</label>
                                                                <input type="text" v-model="model_producto.venta_4"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">CUALQUIER CANTIDAD AL CONTADO</label>
                                                                <input type="text" v-model="model_producto.venta_5"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">VIP</label>
                                                                <input type="text" v-model="model_producto.venta_6"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">

                                                            <div class="form-group ">
                                                                <label for="inputEmail4">PRECIO OFERTA</label>
                                                                <input type="text" v-model="model_producto.venta_7"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button @click="Save()" type="button" data-dismiss="modal"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="loteModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">AGREGAR PRIORIDAD DE LOTE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Lote</label>
                                                                <select v-model="lote_prioridad.lote" class="form-control">
                                                                    <option v-for="m in lotes" :value="m">
                                                                        {{ m . compra . proveedor_compra . abreviatura }}-{{ m . compra . nro_compra }}
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Peso</label>
                                                                <input type="text" v-model="lote_prioridad.peso"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Precio</label>
                                                                <input type="text" v-model="lote_prioridad.precio"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center my-2">
                                                    <button @click="AgregarLote()" type="button" class="btn btn-success"
                                                        data-dismiss="modal">Agregar</button>
                                                </div>
                                                <hr>
                                                <div class="col-12">

                                                    <table class="table table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>LOTE</th>
                                                                <th>PESO</th>
                                                                <th>PRECIO</th>

                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(m,e) in model.producto_precio_lotes">
                                                                <td>{{ e + 1 }}</td>
                                                                <td>{{ m . lote . compra . proveedor_compra . abreviatura }}-{{ m . lote . compra . nro_compra }}
                                                                    | {{ model . name }}</td>
                                                                <td><input type="text" v-model="m.peso"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" v-model="m.precio"
                                                                        class="form-control form-control-sm"></td>

                                                                <td><button data-dismiss="modal" class="btn btn-danger btn-sm"
                                                                        @click="eliminarLote(m)"> Eliminar</button> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="subPtModal" tabindex="-1" role="dialog" aria-labelledby="modalCrud"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCrud">{{ pt . name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Nombre</label>
                                                                <select v-model="subpt.item" class="form-control">
                                                                    <template v-for="m in items">
                                                                        <option v-if="m.tipo==3" :value="m">
                                                                            {{ m . name }}</option>
                                                                    </template>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Peso</label>
                                                                <input type="text" v-model="subpt.peso" class="form-control"
                                                                    placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Precio</label>
                                                                <input type="text" v-model="subpt.precio" class="form-control"
                                                                    placeholder="10.00">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group ">
                                                                <label for="inputEmail4">Promedio</label>
                                                                <input type="text" v-model="subpt.promedio"
                                                                    class="form-control" placeholder="10.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Cancelar</button>
                                    <button @click="SaveSubPt()" type="button" data-dismiss="modal"
                                        class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>PRECIO CBBA</th>

                                            <th>

                                                DE 1 A 14 POLLOS
                                            </th>
                                            <th>

                                                OFICIAL (15 A 75 POLLOS)
                                            </th>
                                            <th>

                                                DE 76 A 150 POLLOS
                                            </th>
                                            <th>

                                                DE 151 A MAS POLLOS
                                            </th>
                                            <th>

                                                CUALQUIER CANTIDAD AL CONTADO
                                            </th>
                                            <th>

                                                VIP
                                            </th>
                                            <th>

                                                PRECIO OFERTA
                                            </th>
                                            <th>

                                                POLLO COMPLETO
                                            </th>
                                            <th>

                                                CAMBIOS DE PRECIO
                                            </th>

                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(m,i) in data_model_2">
                                            <tr>
                                                <td>{{ i + 1 }}</td>
                                                <td>{{ m . name }}</td>

                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.precio"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_1"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 4" v-model="m.venta_2_valor"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_3"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_4"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_5"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_6"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        v-model="m.venta_7_valor"></td>
                                                <td><input type="text" class="form-control form-control-sm"
                                                        v-model="m.venta_8"></td>

                                                <td>
                                                    <div class="icon-container">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #28a745;"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-check-circle">
                                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                        </svg><span class="icon-name"> </span>
                                                        {{ m . cambios }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="modal" @click="add=false,model=m"
                                                            data-target="#exampleModal" type="button"
                                                            class="btn btn-warning btn-sm">Editar</button>
                                                        <button type="button"
                                                            class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
                                                            :id="'menu' + i" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" :aria-labelledby="'menu' + i">

                                                            <a class="dropdown-item" data-toggle="modal" data-target="#loteModal"
                                                                @click="model=m" href="javascript:void(0)">Lote Prioridad</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                @click="deleteItem(m.id)">Eliminar</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-light-primary" v-if="activeDescuento">
                                                <td colspan="2">
                                                    PRECIO CON DESCUENTO
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_1">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_2">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_3">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_5">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_6">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_7">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_8">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_9">
                                                </td>
                                            </tr>

                                            <tr class="bg-light-success" v-if="activeEstado">
                                                <td colspan="7"></td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="5">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="6">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="7">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="8">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="null">
                                                        <span>Ninguno</span>
                                                    </label>
                                                </td>
                                            </tr>


                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div Class="col-lg-12 mt-2" align="right">
                        <button @click="formula=!formula" class="btn "
                            :class="formula == true ? 'btn-warning' : 'btn-danger'">{{ formula == true ? 'CON FORMULA' : 'SIN FORMULA' }}</button>
                        <button @click="activeDescuento=!activeDescuento" class="btn "
                            :class="activeDescuento == true ? 'btn-warning' : 'btn-danger'">{{ formula == true ? 'CON DESCUENTO' : 'SIN DESCUENTO' }}</button>

                        <button @click="activeEstado=!activeEstado" class="btn"
                            :class="activeEstado == true ? 'btn-info' : 'btn-secondary'">
                            {{ activeEstado == true ? 'CON ESTADO' : 'SIN ESTADO' }}
                        </button>
                        <button v-if="activeEstado" class="btn btn-danger" @click="LimpiarEstadosGlobal"
                            title="Limpiar estados">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>PRECIO CBBA</th>
                                            <th>PRECIO LPZ</th>
                                            <th>BS.</th>
                                            <th>PROMEDIO</th>
                                            <th>PRECIO ALTERNATIVO 1</th>
                                            <th>PRECIO ALTERNATIVO 2</th>
                                            <th>PRECIO ALTERNATIVO 3</th>
                                            <th>PRECIO ALTERNATIVO 4</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(m, i) in data_model_2">
                                            <tr>
                                                <td>{{ i + 1 }}</td>
                                                <td>{{ m.name }}</td>

                                                <td><input type="text" class="form-control form-control-sm" :disabled="formula" v-model="m.precio"></td>
                                                <td><input type="text" class="form-control form-control-sm" :disabled="formula" v-model="m.venta_1"></td>
                                                <td><input type="text" class="form-control form-control-sm" :disabled="m.cambios >= 4" v-model="m.venta_2_valor"></td>
                                                <td><input type="text" class="form-control form-control-sm" :disabled="formula" v-model="m.venta_3"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="m.precio_alternativo_1"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="m.precio_alternativo_2"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="m.precio_alternativo_3"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="m.precio_alternativo_4"></td>
                                                <td></td>
                                            </tr>

                                            <!-- Fila de descuentos -->
                                            <tr class="bg-light-primary" v-if="activeDescuento">
                                                <td colspan="2">PRECIO CON DESCUENTO</td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_1"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_2"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_3"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_4"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_alternativo_1"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_alternativo_2"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_alternativo_3"></td>
                                                <td><input type="text" class="form-control form-control-sm" v-model="m.descuento_alternativo_4"></td>
                                                <td></td>
                                            </tr>

                                            <!-- Fila de estados -->
                                            <tr class="bg-light-success" v-if="activeEstado">
                                                <td colspan="6"></td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'estado_precio_'+m.id" v-model="m.precio_estado_seleccionado" :value="5">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'estado_precio_'+m.id" v-model="m.precio_estado_seleccionado" :value="6">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'estado_precio_'+m.id" v-model="m.precio_estado_seleccionado" :value="7">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'estado_precio_'+m.id" v-model="m.precio_estado_seleccionado" :value="8">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'estado_precio_'+m.id" v-model="m.precio_estado_seleccionado" :value="null">
                                                        <span>Ninguno</span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>TOTAL PESO</td>
                                            <td>{{ Number(SumaPesoTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioCbbaTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioLpzTotal).toFixed(2) }}</td>
                                            <td></td>
                                            <td>{{ Number(SumaPrecioPromedioTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo1Total).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo2Total).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo3Total).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo4Total).toFixed(2) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>PRECIO PROMEDIO</td>
                                            <td>{{ Number(SumaPrecioPromedioTotal / SumaPesoTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo1 / SumaPesoTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo2 / SumaPesoTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo3 / SumaPesoTotal).toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioAlternativo4 / SumaPesoTotal).toFixed(2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-block btn-secondary" @click="AgregarTransformacionEspecial">AGREGAR TRANSFORMACION
                            ESPECIAL</button>
                    </div>
                    <div class="col-lg-12 mt-2" v-for="(t,ti) in TransformacionEspecial1">
                        <div class="widget-content p-4 widget-content-area br-6">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nombre de transformacion</label>
                                        <input type="text" v-model="t.name" class="form-control"
                                            placeholder="TRANS. FILETE DE ...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>PRESA</th>
                                                <th>PESO</th>
                                                <th>PRECIO LPZ</th>
                                                <th>BS.</th>
                                                <th>PROMEDIO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center"><button
                                                        @click="AgregarSubTransformacionEspecial(ti)" type="button"
                                                        class="btn btn-primary btn-sm"> Agregar Item</button></td>
                                            </tr>


                                            <template v-for="(td,si) in t.trans_especial_items">
                                                <tr>
                                                    <td>
                                                        <select v-model="td.item_id" class="form-control">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==3" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>

                                                        </select>
                                                    </td>
                                                    <td><input v-model.number="td.peso" type="text" class="form-control"
                                                            placeholder="10.00"></td>
                                                    <td><input v-model.number="td.precio" type="text" class="form-control"
                                                            placeholder="0.5"></td>
                                                    <td><input v-model.number="td.precio_2" type="text" class="form-control"
                                                            placeholder="0.5"></td>
                                                    <td class="bg-light-success"> <input disabled :value="td.promedio"
                                                            type="text" class="form-control" placeholder="0.5"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.trans_especial_items.splice(si,1)"> Eliminar Item</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>SUMA PESO</td>
                                                <td style="font-weight: bold;">{{ t . suma_peso }}</td>
                                                <td class="bg-light-warning">PRECIO</td>
                                                <td style="font-weight: bold">{{ t . suma_precio }}</td>
                                                <td style="font-weight: bold">{{ t . suma_promedio }}</td>
                                            </tr>
                                            <tr>
                                                <td>PRECIO APROX.</td>
                                                <td style="font-weight: bold;">{{ t . precio_aprox }}</td>
                                                <td class="bg-light-warning">
                                                    <select v-model="t.item_id" class="form-control">
                                                        <template v-for="m in items">
                                                            <option v-if="m.tipo==2" :value="m.id">{{ m . name }}
                                                            </option>
                                                        </template>

                                                    </select>
                                                </td>
                                                <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                <td>
                                                <td><button type="button" class="btn btn-danger btn-sm"
                                                        @click="trans_especials.splice(ti,1)"> Eliminar </button></td>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <template v-for="(t,ti) in TransformacionEspecial2">
                        <div class="col-lg-12 mt-2" v-if="t.estado==true">
                            <div class="widget-content p-4 widget-content-area br-6">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail4">Nombre de transformacion</label>
                                            <input type="text" v-model="t.name" class="form-control"
                                                placeholder="TRANS. FILETE DE ...">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>PRESA</th>
                                                    <th>PESO</th>
                                                    <th>PRECIO LPZ</th>
                                                    <th>BS.</th>
                                                    <th>PROMEDIO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td colspan="5" class="text-center"><button
                                                            @click="AgregarSubTransformacionEspecial2(ti)" type="button"
                                                            class="btn btn-primary btn-sm"> Agregar Item</button></td>
                                                </tr>
                                                <template v-for="(td,si) in t.trans_especial_items">
                                                    <tr v-if="td.estado==true">
                                                        <td>
                                                            <select v-model="td.item_id" class="form-control">
                                                                <template v-for="m in items">
                                                                    <option v-if="m.tipo==3" :value="m.id">
                                                                        {{ m . name }}</option>
                                                                </template>

                                                            </select>
                                                        </td>
                                                        <td><input v-model.number="td.peso" type="text" class="form-control"
                                                                placeholder="10.00"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio"
                                                                type="text" class="form-control" placeholder="0.5"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio_2"
                                                                type="text" class="form-control" placeholder="0.5"></td>
                                                        <td><input disabled :value="td.promedio"type="text" class="form-control"
                                                                placeholder="0.5"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm"
                                                                @click="td.estado=false"> Eliminar Item</button></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>SUMA PESO</td>
                                                    <td style="font-weight: bold;">{{ t . suma_peso }}</td>
                                                    <td class="bg-light-warning">PRECIO</td>
                                                    <td style="font-weight: bold">{{ t . suma_precio }}</td>
                                                    <td style="font-weight: bold">{{ t . suma_promedio }}</td>
                                                </tr>
                                                <tr>
                                                    <td>PRECIO APROX.</td>
                                                    <td style="font-weight: bold;">{{ t . precio_aprox }}</td>
                                                    <td class="bg-light-warning">
                                                        <select v-model="t.item_id" class="form-control">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==2" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>

                                                        </select>
                                                    </td>
                                                    <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                    <td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.estado=false"> Eliminar </button></td>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-block btn-secondary" @click="SaveTransformacionesEspeciales">GUARDAR
                            TRANSFORMACIONES ESPECIALES</button>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-block btn-success" @click="AgregarTransformacion">AGREGAR TRANSFORMACION</button>
                    </div>
                    <div class="col-lg-12 mt-2" v-for="(t,ti) in Transformacion1">
                        <div class="widget-content p-4 widget-content-area br-6">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nombre de transformacion</label>
                                        <input type="text" v-model="t.name" class="form-control"
                                            placeholder="TRANS. FILETE DE ...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>PRESA</th>
                                                <th>PESO</th>
                                                <th>PRECIO</th>
                                                <th>PROMEDIO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select v-model="t.item_id" class="form-control">
                                                        <template v-for="m in items">
                                                            <option v-if="m.tipo==2" :value="m.id">{{ m . name }}
                                                            </option>
                                                        </template>

                                                    </select>
                                                </td>
                                                <td><input v-model.number="t.peso" type="text" class="form-control"
                                                        placeholder="10.00"></td>
                                                <td class="bg-light-success"><input v-model.number="t.precio" type="text"
                                                        class="form-control" placeholder="0.5"></td>
                                                <td><input disabled :value="t.promedio" type="text" class="form-control"
                                                        placeholder="0.5"></td>
                                                <td><button type="button" class="btn btn-danger btn-sm"
                                                        @click="transformaciones_list.splice(ti,1)"> Eliminar Trans.</button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-center"><button
                                                        @click="AgregarSubTransformacion(ti)" type="button"
                                                        class="btn btn-primary btn-sm"> Agregar Item</button></td>
                                            </tr>
                                            <template v-for="(td,si) in t.trans_item_detalles">
                                                <tr>
                                                    <td>
                                                        <select v-model="td.item_id" class="form-control">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==3" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>

                                                        </select>
                                                    </td>
                                                    <td><input v-model.number="td.peso" type="text" class="form-control"
                                                            placeholder="10.00"></td>
                                                    <td class="bg-light-success"><input v-model.number="td.precio" type="text"
                                                            class="form-control" placeholder="0.5"></td>
                                                    <td><input disabled :value="td.promedio" type="text"
                                                            class="form-control" placeholder="0.5"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.trans_item_detalles.splice(si,1)"> Eliminar Item</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>PROM/{{ t . item . name }}</td>
                                                <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                <td></td>
                                                <td style="font-weight: bold">{{ t . suma_promedio }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <template v-for="(t,ti) in Transformacion2">
                        <div class="col-lg-12 mt-2" v-if="t.estado==true">
                            <div class="widget-content p-4 widget-content-area br-6">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail4">Nombre de transformacion</label>
                                            <input type="text" v-model="t.name" class="form-control"
                                                placeholder="TRANS. FILETE DE ...">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>PRESA</th>
                                                    <th>PESO</th>
                                                    <th>PRECIO</th>
                                                    <th>PROMEDIO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select v-model="t.item_id" class="form-control">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==2" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>

                                                        </select>
                                                    </td>
                                                    <td><input v-model.number="t.peso" type="text" class="form-control"
                                                            placeholder="10.00"></td>
                                                    <td class="bg-light-success"><input v-model.number="t.precio" type="text"
                                                            class="form-control" placeholder="0.5"></td>
                                                    <td><input disabled :value="t.promedio"type="text" class="form-control"
                                                            placeholder="0.5"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.estado=false"> Eliminar Trans.</button></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-center"><button
                                                            @click="AgregarSubTransformacion2(ti)" type="button"
                                                            class="btn btn-primary btn-sm"> Agregar Item</button></td>
                                                </tr>
                                                <template v-for="(td,si) in t.trans_item_detalles">
                                                    <tr v-if="td.estado==true">
                                                        <td>
                                                            <select v-model="td.item_id" class="form-control">
                                                                <template v-for="m in items">
                                                                    <option v-if="m.tipo==3" :value="m.id">
                                                                        {{ m . name }}</option>
                                                                </template>

                                                            </select>
                                                        </td>
                                                        <td><input v-model.number="td.peso" type="text" class="form-control"
                                                                placeholder="10.00"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio"
                                                                type="text" class="form-control" placeholder="0.5"></td>
                                                        <td><input disabled :value="td.promedio"type="text" class="form-control"
                                                                placeholder="0.5"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm"
                                                                @click="td.estado=false"> Eliminar Item</button></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>PROM/{{ t . item . name }}</td>
                                                    <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                    <td></td>
                                                    <td style="font-weight: bold">{{ t . suma_promedio }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-block btn-success" @click="SaveTransformaciones">GUARDAR TRANSFORMACIONES</button>
                    </div>
                </div>
            </div>
        @endverbatim
    @endslot
    @slot('script')
        <script type="module">
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"


            const {
                createApp
            } = Vue
            let dt = new Table()
            let block = new Block()
            createApp({
                data() {
                    return {
                        activeEstado: false,
                        add: true,
                        model: {
                            name: '',
                            cinta: 1,
                            precio: 0,
                            venta_1: 0,
                            venta_2: 0,
                            venta_3: 0,
                            venta_4: 0,
                            venta_5: 0,
                            venta_6: 0,
                            venta_7: 0,
                            venta_8: 0,
                            producto_precio_lotes: []
                        },
                        data: [],
                        formula: true,
                        sucursal: {},
                        usuario: {},
                        pollo: {
                            items: []
                        },
                        transformaciones: [],
                        producto_pollo: {

                        },
                        cintas: [],
                        pt: {

                        },
                        items: [],
                        subpt: {
                            item: {},
                            peso: 0,
                            precio: 0,
                            promedio: 0
                        },
                        lotes: [],
                        lote_prioridad: {
                            lote: {

                            },
                            peso: 0,
                            precio: 0
                        },
                        transformaciones_list: [],
                        transItems: [],
                        transformacion_especial_list: [],
                        transEspecials: [],
                        activeDescuento: false
                    }
                },
                computed: {
                    data_model() {
                        let self = this
                        if (self.formula == true) {
                            return self.data.map(function(m) {
                                let oficial = Number(m.venta_2_valor)
                                m.venta_1 = Number(oficial + 0.2).toFixed(2)
                                m.venta_3 = Number(oficial - 0.1).toFixed(2)
                                m.venta_4 = Number(oficial - 0.2).toFixed(2)
                                m.venta_5 = Number(oficial - 0.2).toFixed(2)
                                m.venta_6 = Number(oficial - 0.4).toFixed(2)
                                let cinta = self.cintas.findIndex(function(c) {
                                    return c.name == m.name
                                })
                                if (cinta != -1) {
                                    m.nro_orden = self.cintas[cinta].nro_orden
                                } else {
                                    m.nro_orden = -1
                                }
                                return m
                            })
                        }
                        return self.data
                    },
                    data_model_2() {
                        let self = this
                        return self.data_model.sort(function(a, b) {
                            let ordenA = (a.nro_orden === undefined || a.nro_orden === -1) ? Number.MAX_SAFE_INTEGER : a.nro_orden
                            let ordenB = (b.nro_orden === undefined || b.nro_orden === -1) ? Number.MAX_SAFE_INTEGER : b.nro_orden
                            return ordenA - ordenB
                        })
                    },
                    transformaciones_model() {
                        let self = this
                        if (self.formula == true) {
                            return self.transformaciones.map(function(m) {
                                if (m.tipo == 1) {
                                    m.transformacion_item.promedio = Number(m.transformacion_item.precio * m
                                        .transformacion_item.peso).toFixed(2)
                                }
                                m.detalles = m.detalles.map(function(s) {


                                    s.promedio = Number(s.precio * s.peso).toFixed(2)
                                    return s
                                })
                                m.promedio_peso = m.detalles.reduce(function(a, b) {
                                    return a + Number(b.peso);
                                }, 0)
                                m.promedio_precio = m.detalles.reduce(function(a, b) {
                                    return a + Number(b.precio);
                                }, 0)
                                m.promedio_promedio = m.detalles.reduce(function(a, b) {
                                    return a + Number(b.promedio);
                                }, 0)
                                return m
                            })
                        }
                        return self.transformaciones.map(function(m) {
                            m.promedio_peso = m.detalles.reduce(function(a, b) {
                                return a + Number(b.peso);
                            }, 0)
                            m.promedio_precio = m.detalles.reduce(function(a, b) {
                                return a + Number(b.precio);
                            }, 0)
                            m.promedio_promedio = m.detalles.reduce(function(a, b) {
                                return a + Number(b.promedio);
                            }, 0)
                            return m
                        })
                    },
                    model_producto() {
                        let self = this
                        let oficial = Number(this.model.venta_2)
                        this.model.venta_1 = Number(oficial + 0.2).toFixed(2)
                        this.model.venta_3 = Number(oficial - 0.1).toFixed(2)
                        this.model.venta_4 = Number(oficial - 0.2).toFixed(2)
                        this.model.venta_5 = Number(oficial - 0.2).toFixed(2)
                        this.model.venta_6 = Number(oficial - 0.4).toFixed(2)
                        this.model.venta_7 = this.model.venta_7
                        this.model.venta_8 = this.model.venta_8
                        return this.model
                    },
                    itemsPollos() {
                        let self = this
                        if (self.formula == true) {
                            return self.pollo.items.map(function(m) {
                                m.precio_cbba = Number(Math.round(m.peso * self.pollo.precio_cbba)).toFixed(2)
                                m.precio_lpz = Number(Math.round(m.peso * self.pollo.precio_lpz)).toFixed(2)
                                m.precio_promedio = Number(m.peso * m.precio).toFixed(2)


                                return m
                            })
                        }
                        return self.pollo.items
                    },
                    SumaPesoTotal() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.peso)
                        })
                        return suma
                    },
                    SumaPrecioCbbaTotal() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_cbba)
                        })
                        return suma
                    },
                    SumaPrecioLpzTotal() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_lpz)
                        })
                        return suma
                    },
                    SumaPrecioPromedioTotal() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_promedio)
                        })
                        return suma
                    },
                    SumaPrecioAlternativo1Total() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_alternativo_1)
                        })
                        return suma
                    },

                    SumaPrecioAlternativo2Total() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_alternativo_2)
                        })
                        return suma
                    },

                    SumaPrecioAlternativo3Total() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_alternativo_3)
                        })
                        return suma
                    },

                    SumaPrecioAlternativo4Total() {
                        let self = this
                        let suma = 0
                        self.itemsPollos.forEach(function(m) {
                            suma += Number(m.precio_alternativo_4)
                        })
                        return suma
                    },
                    Transformacion1() {

                        return this.transformaciones_list.map(function(m) {
                            m.promedio = Number(m.precio * m.peso).toFixed(3)
                            m.trans_item_detalles.map(function(s) {

                                s.promedio = Number(s.precio * s.peso).toFixed(3)
                            })
                            m.suma_promedio = m.trans_item_detalles.reduce(function(a, b) {
                                return a + Number(b.promedio);
                            }, 0)
                            m.suma_promedio = Number(m.suma_promedio).toFixed(3)
                            m.promedio_item = Number(m.suma_promedio / m.peso).toFixed(3)
                            return m
                        })
                    },
                    Transformacion2() {

                        return this.transItems.map(function(m) {
                            m.promedio = Number(m.precio * m.peso).toFixed(3)
                            m.trans_item_detalles.map(function(s) {

                                s.promedio = Number(s.precio * s.peso).toFixed(3)
                            })
                            m.suma_promedio = m.trans_item_detalles.reduce(function(a, b) {
                                return a + Number(b.promedio);
                            }, 0)
                            m.suma_promedio = Number(m.suma_promedio).toFixed(3)
                            m.promedio_item = Number(m.suma_promedio / m.peso).toFixed(3)
                            return m
                        })
                    },
                    TransformacionEspecial1() {

                        return this.transformacion_especial_list.map(function(m) {

                            m.trans_especial_items.map(function(s) {

                                s.promedio = Number(s.precio * s.precio_2).toFixed(3)
                            })
                            m.suma_peso = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.peso);
                            }, 0)
                            m.suma_precio = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.precio);
                            }, 0)
                            m.suma_promedio = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.promedio);
                            }, 0)
                            m.suma_promedio = Number(m.suma_promedio).toFixed(3)
                            m.precio_aprox = Number(m.suma_promedio / m.suma_peso).toFixed(2)
                            m.promedio_item = Number(m.suma_promedio / m.suma_precio).toFixed(2)
                            return m
                        })
                    },
                    TransformacionEspecial2() {

                        return this.transEspecials.map(function(m) {
                            m.trans_especial_items.map(function(s) {

                                s.promedio = Number(s.precio * s.precio_2).toFixed(3)
                            })
                            m.suma_peso = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.peso);
                            }, 0)
                            m.suma_precio = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.precio);
                            }, 0)
                            m.suma_promedio = m.trans_especial_items.reduce(function(a, b) {
                                return a + Number(b.promedio);
                            }, 0)
                            m.suma_promedio = Number(m.suma_promedio).toFixed(3)
                            m.precio_aprox = Number(m.suma_promedio / m.suma_peso).toFixed(2)
                            m.promedio_item = Number(m.suma_promedio / m.suma_precio).toFixed(2)
                            return m
                        })
                    },
                },
                methods: {
                    LimpiarEstadosGlobal() {
                        this.data.forEach(m => m.precio_estado_seleccionado = null)
                    },

                    async ActualizarPrecios() {
                        for (let i = 0; i < this.data.length; i++) {
                            let m = this.data[i];

                            let precios = [
                                { label: 'PRECIO CBBA', precio: Number(m.precio), descuento: Number(m.descuento_1) },
                                { label: 'DE 1 A 14 POLLOS', precio: Number(m.venta_1), descuento: Number(m.descuento_2) },
                                { label: 'OFICIAL (15 A 75 POLLOS)', precio: Number(m.venta_2_valor), descuento: Number(m.descuento_3) },
                                { label: 'DE 76 A 150 POLLOS', precio: Number(m.venta_3), descuento: Number(m.descuento_4) },
                                { label: 'DE 151 A MAS POLLOS', precio: Number(m.venta_4), descuento: Number(m.descuento_5) },
                                { label: 'CUALQUIER CANTIDAD AL CONTADO', precio: Number(m.venta_5), descuento: Number(m.descuento_6) },
                                { label: 'VIP', precio: Number(m.venta_6), descuento: Number(m.descuento_7) },
                                { label: 'PRECIO OFERTA', precio: Number(m.venta_7_valor), descuento: Number(m.descuento_8) },
                                { label: 'POLLO COMPLETO', precio: Number(m.venta_8), descuento: Number(m.descuento_9) },
                            ];
                            for (let j = 0; j < precios.length; j++) {
                                let p = precios[j];
                                if (!isNaN(p.descuento) && p.descuento !== 0 && p.descuento > p.precio) {
                                    await Swal.fire({
                                        type: 'error',
                                        title: 'Error de Descuento',
                                        html: `El valor de descuento: <b>(${p.descuento})</b> es mayor que el valor del precio: <b>(${p.precio})</b> en la cinta <b>${m.name}</b> - <b>${p.label}</b>`,
                                    });
                                    return;
                                }
                            }
                        }

                        try {
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/producto-precio-cambios') }}";
                            let data = {
                                sucursal_id: this.sucursal.id,
                                usuario_id: this.usuario.id,
                                data: this.data.map(function(m) {
                                    return {
                                        ...m,
                                        estado_precio_5: m.precio_estado_seleccionado == 5 ? 1 : 0,
                                        estado_precio_6: m.precio_estado_seleccionado == 6 ? 1 : 0,
                                        estado_precio_7: m.precio_estado_seleccionado == 7 ? 1 : 0,
                                        estado_precio_8: m.precio_estado_seleccionado == 8 ? 1 : 0,
                                    }
                                })
                            }
                            let res = await axios.post(url, data);

                            await this.load();

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'Precios Actualizados',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',
                                reverseButtons: true,
                                padding: '2em'
                            });
                            window.open(res.data.url_pdf, '_blank');
                        } catch (e) {
                            // Manejo de error (puedes agregar un Swal si quieres)
                        }
                    },

                    async savePollo() {
                        try {
                            for (let i = 0; i < this.itemsPollos.length; i++) {
                                let item = this.itemsPollos[i];
                                let descuentos = [
                                    { label: 'PRECIO CBBA', precio: item.precio_cbba, descuento: item.descuento_1 },
                                    { label: 'PRECIO LPZ', precio: item.precio_lpz, descuento: item.descuento_2 },
                                    { label: 'PRECIO', precio: item.precio, descuento: item.descuento_3 },
                                    { label: 'PRECIO PROMEDIO', precio: item.precio_promedio, descuento: item.descuento_4 },
                                    { label: 'PRECIO ALTERNATIVO 1', precio: item.precio_alternativo_1, descuento: item.descuento_alternativo_1 },
                                    { label: 'PRECIO ALTERNATIVO 2', precio: item.precio_alternativo_2, descuento: item.descuento_alternativo_2 },
                                    { label: 'PRECIO ALTERNATIVO 3', precio: item.precio_alternativo_3, descuento: item.descuento_alternativo_3 },
                                    { label: 'PRECIO ALTERNATIVO 4', precio: item.precio_alternativo_4, descuento: item.descuento_alternativo_4 }
                                ];
                                for (let j = 0; j < descuentos.length; j++) {
                                    let p = descuentos[j];
                                    if (!isNaN(p.descuento) && p.descuento > p.precio) {
                                        await Swal.fire({
                                            type: 'error',
                                            title: 'Error de Descuento',
                                            html: `El valor de descuento: <b>(${p.descuento})</b> es mayor o igual que el valor del precio: <b>(${p.precio})</b> en el producto <b>${item.name}</b> - <b>${p.label}</b>`,
                                        });
                                        return;
                                    }
                                }
                            }
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/pollo-sucursal-precio') }}";
                            let data = {
                                sucursal_id: this.sucursal.id,
                                usuario_id: this.usuario.id,
                                precio_cbba: this.pollo.precio_cbba,
                                precio_lpz: this.pollo.precio_lpz,
                                peso: this.pollo.peso,
                                items: this.itemsPollos
                            };

                            let res = await axios.post(url, data);

                            await this.load();

                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'Precios Actualizados',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',
                                reverseButtons: true,
                                padding: '2em'
                            });
                        } catch (e) {
                            console.error('Error al guardar los precios:', e);
                        }
                    },

                    async saveTransformacion() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/transformacion-sucursal-precio') }}";
                            let data = {
                                sucursal_id: this.sucursal.id,
                                transformaciones: this.transformaciones
                            }
                            let res = await axios.post(url, data)
                            await this.load()
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Precios Actualizados',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',

                                reverseButtons: true,
                                padding: '2em'
                            })


                        } catch (e) {

                        }
                    },
                    async Save() {
                        try {
                            // let res = await axios.post(, this.model)
                            const params = new URLSearchParams(this.model);
                            let url = "{{ url('api/productoPrecios') }}";
                            if (this.add == false) {
                                url = "{{ url('api/productoPrecios') }}/" + this.model.id
                                let res = await axios.put(url, this.model)

                                await this.load()

                            } else {
                                let res = await axios.post(url, this.model)

                                await this.load()


                            }
                        } catch (e) {

                        }
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async load() {
                        try {
                            let self = this


                            await Promise.all([
                                self.GET_DATA("{{ url('api/producto-precios-sucursal') }}/" + this.sucursal
                                    .id),
                                self.GET_DATA("{{ url('api/items-sucursal') }}/" + this.sucursal.id),
                                self.GET_DATA("{{ url('api/pollo-sucursal') }}/" + this.sucursal.id),
                                self.GET_DATA("{{ url('api/transformacions-sucursal') }}/" + this.sucursal
                                    .id),
                                self.GET_DATA("{{ url('api/lotes-general') }}"),
                                self.GET_DATA("{{ url('api/transItems') }}"),
                                self.GET_DATA("{{ url('api/transEspecials') }}"),


                            ]).then((v) => {
                                self.data = v[0].map(function(m) {
                                    if (m.estado_precio_5) m.precio_estado_seleccionado = 5;
                                    else if (m.estado_precio_6) m.precio_estado_seleccionado = 6;
                                    else if (m.estado_precio_7) m.precio_estado_seleccionado = 7;
                                    else if (m.estado_precio_8) m.precio_estado_seleccionado = 8;
                                    else m.precio_estado_seleccionado = null;
                                    return m;
                                });
                                self.items = v[1]
                                self.pollo = v[2]
                                self.transformaciones = v[3]
                                self.lotes = v[4]
                                self.transItems = v[5]
                                self.transEspecials = v[6]
                            })

                            this.formula = true

                        } catch (e) {

                        }
                    },
                    eliminarSubItem(sub) {
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


                                    let url = "{{ url('api/subItems') }}/" + sub.id

                                    await axios.delete(url)

                                    await self.load()

                                } catch (e) {

                                }
                            }
                        })
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


                                    let url = "{{ url('api/productoPrecios') }}/" + id

                                    await axios.delete(url)

                                    await self.load()

                                } catch (e) {

                                }
                            }
                        })
                    },
                    eliminarLote(lote) {
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


                                    let url = "{{ url('api/productoPrecioLotes') }}/" + lote.id

                                    await axios.delete(url)

                                    await self.load()
                                    const swalWithBootstrapButtons = swal.mixin({
                                        confirmButtonClass: 'btn btn-success btn-rounded',
                                        cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                        buttonsStyling: false,
                                    })

                                    swalWithBootstrapButtons({
                                        title: 'Lote eliminado',
                                        text: "Precios Actualizados Correctamente.",
                                        type: 'warning',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK!',

                                        reverseButtons: true,
                                        padding: '2em'
                                    })
                                } catch (e) {

                                }
                            }
                        })
                    },
                    async SaveSubPt() {
                        try {
                            let data = {
                                pt: this.pt,
                                sub_pt: this.subpt
                            }
                            let res = await axios.post("{{ url('api/subItems') }}", data)
                            await this.load()
                        } catch (e) {

                        }
                    },
                    async AgregarLote() {
                        try {
                            this.lote_prioridad.producto_precio_id = this.model.id
                            let res = await axios.post("{{ url('api/productoPrecioLotes') }}", this.lote_prioridad)
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })

                            swalWithBootstrapButtons({
                                title: 'Lote Agregado',
                                text: "Precios Actualizados Correctamente.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK!',

                                reverseButtons: true,
                                padding: '2em'
                            })

                            await this.load()
                        } catch (e) {

                        }
                    },
                    AgregarTransformacion() {
                        this.transformaciones_list.push({
                            name: '',
                            item_id: 0,
                            precio: 0,
                            peso: 0,
                            promedio: 0,
                            item: {},
                            trans_item_detalles: []
                        })
                    },
                    AgregarTransformacionEspecial() {
                        this.transformacion_especial_list.push({
                            name: '',
                            item_id: 0,
                            precio: 0,
                            precio_2: 0,
                            peso: 0,
                            promedio: 0,
                            item: {},
                            trans_especial_items: []
                        })
                    },
                    AgregarSubTransformacionEspecial(i) {
                        this.transformacion_especial_list[i].trans_especial_items.push({
                            item_id: 0,
                            precio: 0,
                            precio_2: 0,
                            peso: 0,
                            promedio: 0,
                        })
                    },
                    AgregarSubTransformacion(i) {
                        this.transformaciones_list[i].trans_item_detalles.push({
                            item_id: 0,
                            precio: 0,

                            peso: 0,
                            promedio: 0,
                        })
                    },
                    AgregarSubTransformacion2(i) {
                        this.transItems[i].trans_item_detalles.push({
                            item_id: 0,
                            precio: 0,
                            peso: 0,
                            promedio: 0,
                            estado: true
                        })
                    },
                    AgregarSubTransformacionEspecial2(i) {
                        this.transEspecials[i].trans_especial_items.push({
                            item_id: 0,
                            precio: 0,
                            precio_2: 0,
                            peso: 0,
                            promedio: 0,
                            estado: true
                        })
                    },
                    async SaveTransformaciones() {
                        try {
                            let data = {
                                transformaciones: this.Transformacion1,
                                trans_items: this.Transformacion2
                            }
                            let res = await axios.post("{{ url('api/transItem-masas') }}", data)
                            Swal.fire('Transformaciones Actualizadas', '', 'success')
                            window.open(res.data.pdf, '_blank');
                        } catch (e) {

                        }
                    },
                    async SaveTransformacionesEspeciales() {
                        try {
                            let data = {
                                transformaciones: this.TransformacionEspecial1,
                                trans_especials: this.TransformacionEspecial2
                            }
                            let res = await axios.post("{{ url('api/transEspecial-masas') }}", data)
                            Swal.fire('Transformaciones Actualizadas', '', 'success')
                            window.open(res.data.pdf, '_blank');
                        } catch (e) {

                        }
                    },
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {
                            let sucursal = localStorage.getItem('AppSucursal')
                            this.sucursal = JSON.parse(sucursal)
                            let usuario = localStorage.getItem('AppUser')
                            this.usuario = JSON.parse(usuario)
                            await Promise.all([self.load(),
                                self.GET_DATA("{{ url('api/productos/1') }}"),
                            ]).then((v) => {
                                this.producto_pollo = v[1]
                                if (this.producto_pollo.medida_productos.length) {
                                    this.cintas = this.producto_pollo.medida_productos[0]
                                        .sub_medidas
                                }
                            })


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
            .modal-lg,
            .modal-xl {
                max-width: 1000px;
            }

            .form-group label,
            label {
                font-size: 10px;
                color: #000000;
                font-weight: 700;
                letter-spacing: 1px;
            }

            .table thead th {
                vertical-align: middle !important;
                border-bottom: none;
            }

            .radio-estado {
                display: flex;
                align-items: center;
                gap: 4px;
                cursor: pointer;
                font-size: 13px;
            }
            .radio-estado input[type="radio"] {
                width: 28px;
                height: 28px;
                accent-color: #28a745; /*#267aff;*/
                margin-right: 6px;
                cursor: pointer;
            }
        </style>
    @endslot
@endcomponent
