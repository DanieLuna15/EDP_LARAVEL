@component('preventista.template.master', ['title' => 'Precios'])
    @slot('body')
        @verbatim
            <div v-if="!loading" class="osahan-body p-3" id="appPrecios">
                <div>
                    <h6 class="mb-3">Precios de Productos</h6>
                    <div class="">
                        <button class="btn bg-info text-white w-100 mb-2" @click="nuevoProducto">
                            <i class="bi bi-plus-circle-fill"></i> Agregar Producto
                        </button>
                        <div class="row mb-2">
                            <div class="col-12 pr-1">
                                <button class="btn bg-orange text-white w-100" @click="formula = !formula" style="display: none;">
                                    <i class="bi bi-calculator-fill"></i> {{ formula ? 'CON FORMULA' : 'SIN FORMULA' }}
                                </button>
                            </div>
                            <div class="col-6 pl-1">
                                <button style="display: none;" class="btn bg-warning text-white w-100" @click="activeDescuento = !activeDescuento">
                                    <i class="bi bi-newspaper"></i> {{ activeDescuento ? 'CON DESCUENTO' : 'SIN DESCUENTO' }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div :class="activeEstado ? 'col-10 pl-1' : 'col-12 pl-1'">
                                <button class="btn bg-purple text-white w-100" @click="activeEstado = !activeEstado">
                                    <i class="bi bi-newspaper"></i>
                                    {{ activeEstado ? 'CON ESTADO' : 'SIN ESTADO' }}
                                </button>
                            </div>
                            <div v-if="activeEstado" class="col-2 pl-1">
                                <button
                                    class="btn btn-danger w-100"
                                    @click="LimpiarEstadosGlobal"
                                    title="Limpiar estados">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 pl-1">
                                <button class="btn bg-success text-white w-100 mb-2" @click="ActualizarPrecios">
                                    <i class="bi bi-arrow-clockwise"></i> Actualizar Precios
                                </button>
                            </div>
                            <div class="col-6 pl-1">
                                <a class="btn bg-dark text-white w-100 mb-2" href="/preventista/productoPrecio/cambios">
                                    <i class="bi bi-list"></i> Ver Cambios
                                </a>
                            </div>
                        </div>
                    </div>
                    <div v-if="data_model.length == 0" class="text-center text-muted mt-5">
                        No hay productos registrados.
                    </div>

                    <div v-if="showModalProducto" class="modal fade show d-block" tabindex="-1"
                        style="background: rgba(0,0,0,0.4)">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">{{ add ? 'Agregar Producto' : 'Actualizar Producto' }}</h5>
                                    <button type="button" class="btn-close" @click="showModalProducto = false"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label fw-bold mb-1">Nombre</label>
                                                <select v-model="selectedProduct" class="form-control form-control-lg" @change="loadMedidas">
                                                            <option v-for="producto in productos" :key="producto.id" :value="producto.id">
                                                                {{ producto.name }}
                                                            </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label fw-bold mb-1">Nombre Medida</label>
                                                <select v-model="model.name" class="form-control form-control-lg">
                                                    <option v-for="m in cintas" :value="m.name">{{ m.name }}</option>
                                                    <option v-if="producto_pollo.id === 1" value="POLLO LIMPIO">POLLO LIMPIO</option>
                                                    <option v-if="producto_pollo.id === 1" value="POLLO COMPLETO">POLLO COMPLETO</option>
                                                </select>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label class="form-label fw-bold mb-1">Precio CBBA</label>
                                                <input type="text" v-model="model.precio" class="form-control form-control-lg"
                                                    placeholder="10.00">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row gy-3">
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">DE 1 A 14 POLLOS</label>
                                                        <input type="text" v-model="model_producto.venta_1"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">OFICIAL (15 A 75 POLLOS)</label>
                                                        <input type="text" v-model.number="model.venta_2"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">DE 76 A 150 POLLOS</label>
                                                        <input type="text" v-model="model_producto.venta_3"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">DE 151 A MAS POLLOS</label>
                                                        <input type="text" v-model="model_producto.venta_4"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">CUALQUIER CANTIDAD AL CONTADO</label>
                                                        <input type="text" v-model="model_producto.venta_5"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display:none">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">VIP</label>
                                                        <input type="text" v-model="model_producto.venta_6"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. OFICIAL</label>
                                                        <input type="text" v-model="model_producto.venta_7"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. POR MAYOR</label>
                                                        <input type="text" v-model="model_producto.venta_8"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. OFERTA</label>
                                                        <input type="text" v-model="model_producto.venta_9"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. LIQUIDACIÓN</label>
                                                        <input type="text" v-model="model_producto.venta_10"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. C/FACTURA</label>
                                                        <input type="text" v-model="model_producto.venta_11"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold mb-1">P. SUCURSAL</label>
                                                        <input type="text" v-model="model_producto.venta_12"
                                                            class="form-control form-control-lg" placeholder="10.00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                                    <button class="btn btn-danger"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                        @click="showModalProducto = false">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                    <button class="btn btn-success"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;"
                                        @click="Save()">
                                        <i class="bi bi-check-circle"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="showModalLote" class="modal fade show d-block" tabindex="-1"
                        style="background: rgba(0,0,0,0.4)">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">AGREGAR PRIORIDAD DE LOTE</h5>
                                    <button type="button" class="btn-close" @click="showModalLote = false"></button>
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
                                                                        @click="eliminarLote(m)"> <i
                                                                            class="bi bi-trash-fill"></i></button> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                                    <button class="btn btn-danger"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                        @click="showModalLote = false">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
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

                                <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                                    <button class="btn btn-danger"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-right: 5px;"
                                        @click="showModalPt = false">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                    <button class="btn btn-success"
                                        style="flex: 1; padding: 15px 0; font-size: 18px; font-weight: bold; border-radius: 8px; margin-left: 5px;"
                                        @click="SaveSubPt()">
                                        <i class="bi bi-check-circle"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive mb-4">
                                <table id="table_dt" class="table table-hover non-hover table-precios" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th style="display: none">PRECIO CBBA</th>
                                            <th style="display: none">
                                                DE 1 A 14 POLLOS
                                            </th>
                                            <th style="display: none">
                                                OFICIAL (15 A 75 POLLOS)
                                            </th>
                                            <th style="display: none">
                                                DE 76 A 150 POLLOS
                                            </th>
                                            <th style="display: none">
                                                DE 151 A MAS POLLOS
                                            </th>
                                            <th style="display: none">
                                                CUALQUIER CANTIDAD AL CONTADO
                                            </th>
                                            <th  style="display: none">
                                                VIP
                                            </th>
                                            <th>
                                                P. OFICIAL
                                            </th>
                                            <th>
                                                P. POR MAYOR
                                            </th>
                                            <th>
                                                P. OFERTA
                                            </th>
                                            <th>
                                                P. LIQUIDACION
                                            </th>
                                            <th>
                                                P. C/FACTURA
                                            </th>
                                            <th>
                                                P. SUCURSAL
                                            </th>
                                            <th>
                                                CAMBIOS DE PRECIO
                                            </th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(m,i) in data_model">
                                            <tr>
                                                <td>{{ i + 1 }}</td>
                                                <td>{{ m . name }}</td>

                                                <td style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.precio"></td>
                                                <td style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_1"></td>
                                                <td style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_2_valor"></td>
                                                <td style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_3"></td>
                                                <td style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_4"></td>
                                                <td  style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_5"></td>
                                                <td  style="display: none;"><input type="text" class="form-control form-control-sm"
                                                        :disabled="formula" v-model="m.venta_6_valor"></td>
                                                <td><input type="text"  style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_7_valor" ></td>
                                                <td><input type="text"  style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_8" ></td>
                                                <td><input type="text" style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_9" ></td>
                                                <td><input type="text"  style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_10"></td>
                                                <td><input type="text"  style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_11"></td>
                                                <td><input type="text"  style="min-width:80px;"class="form-control form-control-sm"
                                                        :disabled="m.cambios >= 8" v-model="m.venta_12"></td>


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
                                                        <button @click="editarProducto(m)" type="button"
                                                            class="btn bg-warning text-white btn-sm"> <i
                                                                class="bi bi-pencil"></i></button>
                                                        <button @click="abrirLoteModal(m)" type="button"
                                                            class="btn bg-info text-white btn-sm">Lote Prioridad</button>
                                                        <button @click="deleteItem(m.id)" type="button"
                                                            class="btn bg-danger text-white btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr class="bg-light-primary" v-if="activeDescuento">
                                                <td colspan="2">
                                                    PRECIO CON DESCUENTO
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_1">
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_2">
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_3">
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_4">
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_5">
                                                </td>
                                                <td style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_6">
                                                </td>
                                                <td  style="display: none">
                                                    <input type="text" class="form-control form-control-sm"
                                                        v-model="m.descuento_7">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_8">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_9">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_10">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_11">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_12">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                       :disabled="m.cambios >= 7" v-model="m.descuento_13">
                                                </td>
                                            </tr>
                                            <tr class="bg-light-success" v-if="activeEstado">
                                                <td colspan="2"></td>
                                                <td  style="display: none">
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="5">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td  style="display: none">
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
                                               <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="9">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="10">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="11">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                               <td>
                                                    <label class="radio-estado">
                                                        <input type="radio"
                                                            :name="'estado_precio_'+m.id"
                                                            v-model="m.precio_estado_seleccionado"
                                                            :value="12">
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
                    <div class="">
                        <div class="row mb-2">
                            <div class="col-12 pr-1">
                                <button class="btn bg-orange text-white w-100" @click="formula = !formula">
                                    <i class="bi bi-calculator-fill"></i> {{ formula ? 'CON FORMULA' : 'SIN FORMULA' }}
                                </button>
                            </div>
                            <div class="col-6 pl-1" style="display:none">
                                <button class="btn bg-warning text-white w-100" @click="activeDescuento = !activeDescuento">
                                    <i class="bi bi-newspaper"></i> {{ activeDescuento ? 'CON DESCUENTO' : 'SIN DESCUENTO' }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div :class="activeEstadoPollos ? 'col-10 pl-1' : 'col-12 pl-1'">
                                <button class="btn bg-purple text-white w-100" @click="activeEstadoPollos = !activeEstadoPollos">
                                    <i class="bi bi-newspaper"></i>
                                    {{ activeEstadoPollos ? 'CON ESTADO' : 'SIN ESTADO' }}
                                </button>
                            </div>
                            <div v-if="activeEstadoPollos" class="col-2 pl-1">
                                <button
                                    class="btn btn-danger w-100"
                                    @click="LimpiarEstadosPollos"
                                    title="Limpiar estados">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="widget-content p-0 widget-content-area br-6">
                            <div class="table-responsive">

                                <table class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">N°</th>
                                            <th rowspan="2">PESO DE UN POLLO</th>
                                            <th rowspan="2"></th>
                                            <th>PRECIO CBBA</th>
                                            <th>PRECIO LPZ</th>
                                            <th>BS.</th>
                                            <th>PROMEDIO</th>
                                             <th>P. POR MAYOR</th>
                                                <th>P. OFERTA</th>
                                                <th>P. LIQUIDACIÓN</th>
                                                <th>P. C/FACTURA</th>
                                                <th>P. SUCURSAL</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" v-model="pollo.precio_cbba" style="min-width:80px;"
                                                    class="form-control form-control-sm"></th>
                                            <th><input type="text" v-model="pollo.precio_lpz" style="min-width:80px;"
                                                    class="form-control form-control-sm"></th>
                                            <th><input type="text" :value="Number(pollo.peso * pollo.precio_lpz).toFixed(2)"
                                                    disabled class="form-control form-control-sm" style="min-width:80px;"></th>
                                            <th><input type="text" style="min-width:80px;"
                                                    :value="Number(SumaPrecioPromedioTotal / SumaPesoTotal).toFixed(2)" disabled
                                                    class="form-control form-control-sm"></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" style="min-width:80px;" v-model="pollo.peso"
                                                    class="form-control form-control-sm">
                                            </th>
                                            <th>PESO</th>
                                            <th></th>
                                            <th></th>
                                            <th>PRECIO EQUIVALENTE</th>
                                            <th>BS.</th>
                                            <th>BS.</th>
                                            <th>BS.</th>
                                            <th>BS.</th>
                                            <th>BS.</th>
                                            <th>BS.</th>
                                            <th>Accion</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>PRODUCTO</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(item,i) in itemsPollos">
                                            <tr>
                                                <td>{{ i + 1 }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mx-2"> {{ item . name }}</div>
                                                    </div>
                                                </td>
                                                <td><input type="text" v-model.number="item.peso" style="min-width:80px;"
                                                        class="form-control form-control-sm"></td>
                                                <td><input type="text" :disabled="formula" v-model="item.precio_cbba"
                                                        style="min-width:80px;" class="form-control form-control-sm"></td>
                                                <td><input type="text" :disabled="formula" v-model="item.precio_lpz"
                                                        style="min-width:80px;" class="form-control form-control-sm"></td>
                                                <td><input type="text" v-model.number="item.precio" style="min-width:80px;"
                                                        class="form-control form-control-sm"></td>
                                                <td><input type="text" :disabled="formula" v-model="item.precio_promedio"
                                                        style="min-width:80px;" class="form-control form-control-sm"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="item.precio_alternativo_1"  style="min-width:80px;"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="item.precio_alternativo_2"  style="min-width:80px;"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="item.precio_alternativo_3"  style="min-width:80px;"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="item.precio_alternativo_4"  style="min-width:80px;"></td>
                                                <td><input type="text" class="form-control form-control-sm"  v-model="item.precio_alternativo_5"  style="min-width:80px;"></td>
                                            </tr>
                                            <tr class="bg-light-primary" v-if="activeDescuento==true">
                                                <td colspan="2">
                                                    PRECIO CON DESCUENTO
                                                </td>
                                                <td></td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_1">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_2">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_3">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_alternativo_1">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_alternativo_2">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_alternativo_3">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_alternativo_4">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" v-model="item.descuento_alternativo_5">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr class="bg-light-success" v-if="activeEstadoPollos">
                                                <td colspan="7"></td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_alternativo_' + item.id" v-model="item.precio_estado_seleccionado" :value="1">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_alternativo_' + item.id" v-model="item.precio_estado_seleccionado" :value="2">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_alternativo_' + item.id" v-model="item.precio_estado_seleccionado" :value="3">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_alternativo_' + item.id" v-model="item.precio_estado_seleccionado" :value="4">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_alternativo_' + item.id" v-model="item.precio_estado_seleccionado" :value="5">
                                                        <span>Activo</span>
                                                    </label>
                                                </td>
                                                <td >
                                                    <label class="radio-estado">
                                                        <input type="radio" :name="'pollos_estado_precio_' + item.id" v-model="item.precio_estado_seleccionado" :value="null">
                                                        <span> Ninguno</span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>TOTAL PESO</td>
                                            <td>{{ Number(SumaPesoTotal) . toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioCbbaTotal) . toFixed(2) }}</td>
                                            <td>{{ Number(SumaPrecioLpzTotal) . toFixed(2) }}</td>
                                            <td></td>
                                            <td>{{ Number(SumaPrecioPromedioTotal) . toFixed(2) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>PRECIO</td>
                                            <td>{{ Number(SumaPrecioPromedioTotal / SumaPesoTotal) . toFixed(2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row p-1">
                                <div class="col-6 mb-2">
                                    <a :href="pollo.url_pdf" target="_blank" class="btn bg-danger text-white w-100">
                                        <i class="bi bi-file-pdf-fill"></i> PROMEDIO DE PRECIOS PDF
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a :href="pollo.url_pdf_2" target="_blank" class="btn bg-dark text-white w-100">
                                        <i class="bi bi-file-pdf-fill"></i>PROMEDIO DE PREVENTISTA PDF
                                    </a>
                                </div>
                                <div class="col-12">
                                    <button class="btn bg-success text-white w-100" @click="savePollo">
                                        <i class="bi bi-check-circle-fill"></i> GUARDAR
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 mt-2 mb-2" style="display: none">
                        <button class="btn bg-info text-white w-100" @click="AgregarTransformacionEspecial"> <i
                                class="bi bi-plus-circle-fill"></i> AGREGAR TRANSFORMACION
                            ESPECIAL</button>
                    </div>

                    <div class="" style="display: none">
                        <div class="row mb-2">
                            <div :class="activeEstadoTransEspecial ? 'col-10 pl-1' : 'col-12 pl-1'">
                                <button class="btn bg-purple text-white w-100" @click="activeEstadoTransEspecial = !activeEstadoTransEspecial">
                                    <i class="bi bi-newspaper"></i>
                                    {{ activeEstadoTransEspecial ? 'CON ESTADO' : 'SIN ESTADO' }}
                                </button>
                            </div>
                            <div v-if="activeEstadoTransEspecial" class="col-2 pl-1">
                                <button
                                    class="btn btn-danger w-100"
                                    @click="LimpiarEstadosTransformacionesEspeciales"
                                    title="Limpiar estados">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mt-2" v-for="(t,ti) in TransformacionEspecial1" style="display: none">
                        <div class="widget-content p-4 widget-content-area br-6">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nombre de transformacion</label>
                                        <input type="text" v-model="t.name" class="form-control"
                                            placeholder="TRANS. FILETE DE ...">
                                    </div>
                                </div>
                                <div class="col-12 table-responsive">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>PRESA</th>
                                                <th>PESO</th>
                                                <th>PRECIO LPZ</th>
                                                <th>BS.</th>
                                                <th>PROMEDIO</th>
                                                 <th>P. POR MAYOR</th>
                                                <th>P. OFERTA</th>
                                                <th>P. LIQUIDACIÓN</th>
                                                <th>P. C/FACTURA</th>
                                                <th>P. SUCURSAL</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center"><button
                                                        @click="AgregarSubTransformacionEspecial(ti)" type="button"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill"></i>
                                                        Agregar Item</button></td>
                                            </tr>
                                            <template v-for="(td,si) in t.trans_especial_items">
                                                <tr>
                                                    <td>
                                                        <select v-model="td.item_id" class="form-control"
                                                            style="min-width:100px;">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==3" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>
                                                        </select>
                                                    </td>
                                                    <td><input v-model.number="td.peso" type="text" class="form-control"
                                                            style="min-width:80px;" placeholder="10.00"></td>
                                                    <td><input v-model.number="td.precio" type="text" class="form-control"
                                                            style="min-width:80px;" placeholder="0.5"></td>
                                                    <td><input v-model.number="td.precio_2" type="text" class="form-control"
                                                            style="min-width:80px;" placeholder="0.5"></td>
                                                    <td class="bg-light-success"> <input disabled :value="td.promedio"
                                                            style="min-width:80px;" type="text" class="form-control"
                                                            placeholder="0.5"></td>
                                                    <td><input v-model.number="td.precio_alternativo_1" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_2" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_3" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_4" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_5" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.trans_especial_items.splice(si,1)"><i
                                                                class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                                <tr class="bg-light-info" v-if="activeEstadoTransEspecial">
                                                        <td colspan="5"></td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="1">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="2">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="3">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="4">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="5">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_' + td.id" v-model="td.precio_estado_seleccionado" :value="null">
                                                                <span>Ninguno</span>
                                                            </label>
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
                                                    <select v-model="t.item_id" class="form-control" style="min-width:100px;">
                                                        <template v-for="m in items">
                                                            <option v-if="m.tipo==2" :value="m.id">{{ m . name }}
                                                            </option>
                                                        </template>

                                                    </select>
                                                </td>
                                                <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                <td>
                                                <td colspan="6"><button type="button" class="btn btn-danger btn-sm"
                                                        @click="trans_especials.splice(ti,1)"> <i class="bi bi-trash-fill"></i>
                                                    </button></td>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <template v-for="(t,ti) in TransformacionEspecial2" style="display: none">
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
                                    <div class="col-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>PRESA</th>
                                                    <th>PESO</th>
                                                    <th>PRECIO LPZ</th>
                                                    <th>BS.</th>
                                                    <th>PROMEDIO</th>
                                                      <th>P. POR MAYOR</th>
                                                <th>P. OFERTA</th>
                                                <th>P. LIQUIDACIÓN</th>
                                                <th>P. C/FACTURA</th>
                                                <th>P. SUCURSAL</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5" class="text-center"><button
                                                            @click="AgregarSubTransformacionEspecial2(ti)" type="button"
                                                            class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill"></i>
                                                            Agregar Item</button></td>
                                                </tr>
                                                <template v-for="(td,si) in t.trans_especial_items">
                                                    <tr v-if="td.estado==true">
                                                        <td>
                                                            <select v-model="td.item_id" class="form-control"
                                                                style="min-width:100px;">
                                                                <template v-for="m in items">
                                                                    <option v-if="m.tipo==3" :value="m.id">
                                                                        {{ m . name }}</option>
                                                                </template>

                                                            </select>
                                                        </td>
                                                        <td><input v-model.number="td.peso" type="text" class="form-control"
                                                                style="min-width:80px;" placeholder="10.00"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio"
                                                                style="min-width:80px;" type="text" class="form-control"
                                                                placeholder="0.5"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio_2"
                                                                style="min-width:80px;" type="text" class="form-control"
                                                                placeholder="0.5"></td>
                                                        <td><input disabled :value="td.promedio"type="text" class="form-control"
                                                                style="min-width:80px;" placeholder="0.5"></td>
                                                        <td><input v-model.number="td.precio_alternativo_1" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><input v-model.number="td.precio_alternativo_2" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><input v-model.number="td.precio_alternativo_3" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><input v-model.number="td.precio_alternativo_4" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><input v-model.number="td.precio_alternativo_5" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm"
                                                                @click="td.estado=false"> <i
                                                                    class="bi bi-trash-fill"></i></button></td>
                                                    </tr>
                                                    <tr class="bg-light-info" v-if="activeEstadoTransEspecial">
                                                        <td colspan="5"></td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="1">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="2">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="3">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="4">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="5">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_especial_estado_precio_' + td.id" v-model="td.precio_estado_seleccionado" :value="null">
                                                                <span>Ninguno</span>
                                                            </label>
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
                                                        <select v-model="t.item_id" class="form-control"
                                                            style="min-width:100px;">
                                                            <template v-for="m in items">
                                                                <option v-if="m.tipo==2" :value="m.id">
                                                                    {{ m . name }}</option>
                                                            </template>

                                                        </select>
                                                    </td>
                                                    <td style="font-weight: bold;color:red">{{ t . promedio_item }}</td>
                                                    <td>
                                                    <td colspan="6"><button type="button" class="btn btn-danger btn-sm"
                                                            @click="t.estado=false"> <i class="bi bi-trash-fill"></i> </button>
                                                    </td>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="col-lg-12 mt-2 w-100"  style="display: none">
                        <button class="btn bg-success text-white w-100" @click="SaveTransformacionesEspeciales"><i
                                class="bi bi-check-circle-fill"></i> GUARDAR
                            TRANSFORMACIONES ESPECIALES</button>
                    </div>
                    <div class="col-lg-12 mt-2 mb-2">
                        <button class="btn bg-info text-white w-100" @click="AgregarTransformacion"> <i
                                class="bi bi-plus-circle-fill"></i> AGREGAR
                            TRANSFORMACION</button>
                    </div>
                    <div class="">
                        <div class="row mb-2">
                            <div :class="activeEstadoTrans ? 'col-10 pl-1' : 'col-12 pl-1'">
                                <button class="btn bg-purple text-white w-100" @click="activeEstadoTrans = !activeEstadoTrans">
                                    <i class="bi bi-newspaper"></i>
                                    {{ activeEstadoTrans ? 'CON ESTADO' : 'SIN ESTADO' }}
                                </button>
                            </div>
                            <div v-if="activeEstadoTrans" class="col-2 pl-1">
                                <button
                                    class="btn btn-danger w-100"
                                    @click="LimpiarEstadosTransformaciones"
                                    title="Limpiar estados">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
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
                                <div class="col-12 table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>PRESA</th>
                                                <th>PESO</th>
                                                <th>PRECIO</th>
                                                <th>PROMEDIO</th>
                                                  <th>P. POR MAYOR</th>
                                                <th>P. OFERTA</th>
                                                <th>P. LIQUIDACIÓN</th>
                                                <th>P. C/FACTURA</th>
                                                <th>P. SUCURSAL</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select v-model="t.item_id" class="form-control" style="min-width:100px;">
                                                        <template v-for="m in items">
                                                            <option v-if="m.tipo==2" :value="m.id">{{ m . name }}
                                                            </option>
                                                        </template>

                                                    </select>
                                                </td>
                                                <td><input v-model.number="t.peso" type="text" class="form-control"
                                                        style="min-width:100px;" placeholder="10.00"></td>
                                                <td class="bg-light-success"><input v-model.number="t.precio" type="text"
                                                        style="min-width:100px;" class="form-control" placeholder="0.5"></td>
                                                <td><input disabled :value="t.promedio" type="text" class="form-control"
                                                        style="min-width:100px;" placeholder="0.5"></td>

                                                <td><button type="button" class="btn btn-danger btn-sm"
                                                        @click="transformaciones_list.splice(ti,1)"> <i
                                                            class="bi bi-trash-fill"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-center"><button
                                                        @click="AgregarSubTransformacion(ti)" type="button"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill"></i>
                                                        Agregar Item</button></td>
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
                                                            style="min-width:100px;" placeholder="10.00"></td>
                                                    <td class="bg-light-success"><input v-model.number="td.precio" type="text"
                                                            style="min-width:100px;" class="form-control" placeholder="0.5"></td>
                                                    <td><input disabled :value="td.promedio" type="text"
                                                            style="min-width:100px;" class="form-control" placeholder="0.5"></td>
                                                    <td><input v-model.number="td.precio_alternativo_1" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_2" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_3" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_4" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_5" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm"
                                                            style="min-width:100px;" @click="t.trans_item_detalles.splice(si,1)">
                                                            <i class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                                <tr class="bg-light-info" v-if="activeEstadoTrans">
                                                        <td colspan="4"></td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="1">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="2">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="3">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="4">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="5">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_' + td.id" v-model="td.precio_estado_seleccionado" :value="null">
                                                                <span>Ninguno</span>
                                                            </label>
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
                                    <div class="col-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>PRESA</th>
                                                    <th>PESO</th>
                                                    <th>PRECIO</th>
                                                    <th>PROMEDIO</th>
                                                    <th>P. POR MAYOR</th>
                                                <th>P. OFERTA</th>
                                                <th>P. LIQUIDACIÓN</th>
                                                <th>P. C/FACTURA</th>
                                                <th>P. SUCURSAL</th>
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
                                                            @click="t.estado=false"> <i class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-center"><button
                                                            @click="AgregarSubTransformacion2(ti)" type="button"
                                                            class="btn btn-primary btn-sm"><i class="bi bi-plus-circle-fill"></i>
                                                            Agregar Item</button></td>
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
                                                                style="min-width:80px;" placeholder="10.00"></td>
                                                        <td class="bg-light-success"><input v-model.number="td.precio"
                                                                style="min-width:80px;" type="text" class="form-control"
                                                                placeholder="0.5"></td>
                                                        <td><input disabled :value="td.promedio"type="text" class="form-control"
                                                                style="min-width:80px;" placeholder="0.5"></td>
                                                                 <td><input v-model.number="td.precio_alternativo_1" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_2" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_3" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_4" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                    <td><input v-model.number="td.precio_alternativo_5" type="text" class="form-control" placeholder="0.00" style="min-width:80px;"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm"
                                                                @click="td.estado=false"> <i
                                                                    class="bi bi-trash-fill"></i></button></td>
                                                    </tr>
                                                    <tr class="bg-light-info" v-if="activeEstadoTrans">
                                                        <td colspan="4"></td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="1">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="2">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="3">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="4">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_alternativo_' + td.id" v-model="td.precio_estado_seleccionado" :value="5">
                                                                <span>Activo</span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="radio-estado">
                                                                <input type="radio" :name="'trans_estado_precio_' + td.id" v-model="td.precio_estado_seleccionado" :value="null">
                                                                <span>Ninguno</span>
                                                            </label>
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
                    </template>
                    <div class="col-lg-12 mt-2">
                        <button class="btn bg-success text-white w-100" @click="SaveTransformaciones"> <i
                                class="bi bi-check-circle-fill"></i> GUARDAR TRANSFORMACIONES</button>
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
                        activeEstadoPollos: false,
                        activeEstadoTransEspecial: false,
                        activeEstadoTrans: false,
                        showModalProducto: false,
                        showModalLote: false,
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
                            venta_9: 0,
                            venta_10: 0,
                            venta_11: 0,
                            venta_12: 0,
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
                        selectedProduct: 1,
                        productos: [],
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
                        if (!this.formula) return this.data;

                        return this.data.map(m => {
                            const oficial = Number(m.venta_2_valor || 0);
                            const cinta = this.cintas.find(c => c.name === m.name);
                            return {
                            ...m,
                            venta_1: Number(oficial + 0.2).toFixed(2),
                            venta_3: Number(oficial - 0.1).toFixed(2),
                            venta_4: Number(oficial - 0.2).toFixed(2),
                            venta_5: Number(oficial - 0.2).toFixed(2),
                            venta_6: Number(oficial - 0.4).toFixed(2),
                            nro_orden: cinta ? cinta.nro_orden : -1,
                            };
                        });
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
                        this.model.venta_9 = this.model.venta_9
                        this.model.venta_10 = this.model.venta_10
                        this.model.venta_11 = this.model.venta_11
                        this.model.venta_12 = this.model.venta_12
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
                    LimpiarTransformaciones() {
                        this.transformaciones_list = [];
                        this.transformacion_especial_list = [];
                        this.transItems.forEach(t => {
                            (t.trans_item_detalles || []).forEach(td => td.precio_estado_seleccionado = null);
                        });

                        this.transEspecials.forEach(t => {
                            (t.trans_especial_items || []).forEach(td => td.precio_estado_seleccionado = null);
                        });
                    },

                     async loadProductos() {
                        try {
                            const response = await this.GET_DATA("{{ url('api/productos') }}");
                            this.productos = response;
                        } catch (e) {
                            console.error(e);
                        }
                    },
                    async loadMedidas() {
                        if (this.selectedProduct) {
                            try {
                                const response = await this.GET_DATA(`{{ url('api/productos') }}/${this.selectedProduct}`);
                                this.producto_pollo = response;
                                if (this.producto_pollo.medida_productos && this.producto_pollo.medida_productos.length > 0) {
                                    this.cintas = this.producto_pollo.medida_productos[0].sub_medidas;
                                } else {
                                    this.cintas = [];
                                }

                            } catch (e) {
                                console.error(e);
                            }
                        }
                    },
                    LimpiarEstadosGlobal() {
                        this.data.forEach(m => m.precio_estado_seleccionado = null)
                    },
                    LimpiarEstadosPollos() {
                        this.pollo.items.forEach(item => {
                            item.precio_estado_seleccionado = null;
                        });
                    },
                    LimpiarEstadosTransformacionesEspeciales() {
                        this.TransformacionEspecial1.forEach(t => {
                            t.trans_especial_items.forEach(td => {
                                td.precio_estado_seleccionado = null;
                            });
                        });

                        this.TransformacionEspecial2.forEach(t => {
                            t.trans_especial_items.forEach(td => {
                                td.precio_estado_seleccionado = null;
                            });
                        });
                    },
                    LimpiarEstadosTransformaciones() {

                        this.Transformacion1.forEach(t => {
                            if (t.trans_item_detalles) {
                                t.trans_item_detalles.forEach(td => {
                                    td.precio_estado_seleccionado = null;
                                });
                            }
                        });

                        this.Transformacion2.forEach(t => {
                            if (t.trans_item_detalles) {
                                t.trans_item_detalles.forEach(td => {
                                    td.precio_estado_seleccionado = null;
                                });
                            }
                        });
                    },

                    abrirLoteModal(producto) {
                        this.model = producto;
                        this.showModalLote = true;
                    },
                    nuevoProducto() {
                        this.model = {
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
                            venta_9: 0,
                            venta_10: 0,
                            venta_11: 0,
                            venta_12: 0,
                            producto_precio_lotes: []
                        };
                        this.add = true;
                        this.showModalProducto = true;
                    },
                    editarProducto(m) {
                        this.model = {
                            ...m
                        };
                        this.add = false;
                        this.showModalProducto = true;
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
                                { label: 'PRECIO OFICIAL', precio: Number(m.venta_7_valor), descuento: Number(m.descuento_8) },
                                { label: 'PRECIO POR MAYOR', precio: Number(m.venta_8), descuento: Number(m.descuento_9) },
                                { label: 'PRECIO OFERTA', precio: Number(m.venta_9), descuento: Number(m.descuento_10) },
                                { label: 'PRECIO LIQUIDACIÓN', precio: Number(m.venta_10), descuento: Number(m.descuento_11) },
                                { label: 'PRECIO C/FACTURA', precio: Number(m.venta_11), descuento: Number(m.descuento_12) },
                                { label: 'PRECIO SUCURSAL', precio: Number(m.venta_12), descuento: Number(m.descuento_13) },
                            ];
                            if (this.activeDescuento) {
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
                                        estado_precio_9: m.precio_estado_seleccionado == 9 ? 1 : 0,
                                        estado_precio_10: m.precio_estado_seleccionado == 10 ? 1 : 0,
                                        estado_precio_11: m.precio_estado_seleccionado == 11 ? 1 : 0,
                                        estado_precio_12: m.precio_estado_seleccionado == 12 ? 1 : 0,
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
                                    { label: 'PRECIO ALTERNATIVO 4', precio: item.precio_alternativo_4, descuento: item.descuento_alternativo_4 },
                                    { label: 'PRECIO ALTERNATIVO 5', precio: item.precio_alternativo_5, descuento: item.descuento_alternativo_5 }
                                ];
                                if (this.activeDescuento) {
                                    for (let j = 0; j < descuentos.length; j++) {
                                        let p = descuentos[j];
                                        if (!isNaN(p.descuento) && Number(p.descuento) > Number(p.precio)) {
                                            await Swal.fire({
                                                type: 'error',
                                                title: 'Error de Descuento',
                                                html: `El valor de descuento: <b>(${p.descuento})</b> es mayor o igual que el valor del precio: <b>(${p.precio})</b> en el producto <b>${item.name}</b> - <b>${p.label}</b>`,
                                            });
                                            return;
                                        }
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

                                items: this.itemsPollos.map(function(item) {
                                    return {
                                        ...item,

                                        estado_precio_alternativo_1: item.precio_estado_seleccionado == 1 ? 1 : 0,
                                        estado_precio_alternativo_2: item.precio_estado_seleccionado == 2 ? 1 : 0,
                                        estado_precio_alternativo_3: item.precio_estado_seleccionado == 3 ? 1 : 0,
                                        estado_precio_alternativo_4: item.precio_estado_seleccionado == 4 ? 1 : 0,
                                        estado_precio_alternativo_5: item.precio_estado_seleccionado == 5 ? 1 : 0,
                                    };
                                })
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
                            this.LimpiarTransformaciones();
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
                            if (!this.model.name || this.model.name === '') {
                            await Swal.fire({ type:'error', title:'Error', html:'Por favor selecciona un nombre válido.' });
                            return;
                            }

                            if (this.add === true) {
                            const nombreExistente = this.data.some(m => m.name === this.model.name);
                            if (nombreExistente) {
                                await Swal.fire({ type:'error', title:'Error', html:`Ya existe un precio para el producto: <b>${this.model.name}</b>.` });
                                return;
                            }
                            } else {
                            const nombreExistente = this.data.some(m => m.name === this.model.name && m.id !== this.model.id);
                            if (nombreExistente) {
                                await Swal.fire({ type:'error', title:'Error', html:`Ya existe un precio para el producto: <b>${this.model.name}</b> en otro registro.` });
                                return;
                            }
                            }

                            let url = "{{ url('api/productoPrecios') }}";
                            let res;
                            if (this.add === false) {
                            url = "{{ url('api/productoPrecios') }}/" + this.model.id;
                            res = await axios.put(url, this.model);
                            } else {
                            res = await axios.post(url, this.model);
                            }

                            await this.load();

                            if (res && res.data) {
                            await Swal.fire({
                                type: 'success',
                                title: 'Éxito',
                                html: `El producto ha sido ${this.add ? 'creado' : 'actualizado'} correctamente.`,
                                allowOutsideClick: false, backdrop: 'static', confirmButtonText: 'OK'
                            });
                            } else {
                            await Swal.fire({
                                type: 'error',
                                title: 'Error',
                                html: `Hubo un problema al guardar el producto. Por favor, intenta nuevamente.`,
                                allowOutsideClick: false, backdrop: 'static', confirmButtonText: 'OK'
                            });
                            }
                        } catch (e) {
                            console.error(e);
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
                            this.loading = true;

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
                                    else if (m.estado_precio_9) m.precio_estado_seleccionado = 9;
                                    else if (m.estado_precio_10) m.precio_estado_seleccionado = 10;
                                    else if (m.estado_precio_11) m.precio_estado_seleccionado = 11;
                                    else if (m.estado_precio_12) m.precio_estado_seleccionado = 12;
                                    else m.precio_estado_seleccionado = null;
                                    return m;
                                });
                                self.items = v[1]
                                self.pollo = v[2]
                                self.pollo.items.forEach(function(item) {
                                    // Valores alternativos
                                    item.precio_cbba = Number(item.precio_cbba || 0).toFixed(2);
                                    item.precio_lpz = Number(item.precio_lpz || 0).toFixed(2);
                                    item.precio = Number(item.precio || 0).toFixed(2);
                                    item.precio_promedio = Number(item.precio_promedio || 0).toFixed(2);
                                    item.precio_alternativo_1 = Number(item.precio_alternativo_1 || 0).toFixed(2);
                                    item.precio_alternativo_2 = Number(item.precio_alternativo_2 || 0).toFixed(2);
                                    item.precio_alternativo_3 = Number(item.precio_alternativo_3 || 0).toFixed(2);
                                    item.precio_alternativo_4 = Number(item.precio_alternativo_4 || 0).toFixed(2);
                                    item.precio_alternativo_5 = Number(item.precio_alternativo_5 || 0).toFixed(2);

                                    // Descuentos
                                    item.descuento_1 = Number(item.descuento_1 || 0).toFixed(2);
                                    item.descuento_2 = Number(item.descuento_2 || 0).toFixed(2);
                                    item.descuento_3 = Number(item.descuento_3 || 0).toFixed(2);
                                    item.descuento_4 = Number(item.descuento_4 || 0).toFixed(2);
                                    item.descuento_alternativo_1 = Number(item.descuento_alternativo_1 || 0).toFixed(2);
                                    item.descuento_alternativo_2 = Number(item.descuento_alternativo_2 || 0).toFixed(2);
                                    item.descuento_alternativo_3 = Number(item.descuento_alternativo_3 || 0).toFixed(2);
                                    item.descuento_alternativo_4 = Number(item.descuento_alternativo_4 || 0).toFixed(2);
                                    item.descuento_alternativo_5 = Number(item.descuento_alternativo_5 || 0).toFixed(2);

                                    // Estado
                                    if (item.estado_precio_alternativo_1) item.precio_estado_seleccionado = 1;
                                    else if (item.estado_precio_alternativo_2) item.precio_estado_seleccionado = 2;
                                    else if (item.estado_precio_alternativo_3) item.precio_estado_seleccionado = 3;
                                    else if (item.estado_precio_alternativo_4) item.precio_estado_seleccionado = 4;
                                    else if (item.estado_precio_alternativo_5) item.precio_estado_seleccionado = 5;
                                    else item.precio_estado_seleccionado = null;
                                });

                                self.transformaciones = v[3]
                                self.lotes = v[4]
                                self.transItems = v[5]
                                self.transEspecials = v[6]
                                self.transEspecials.forEach(function(t) {
                                    t.trans_especial_items.forEach(function(td) {
                                        if (td.estado_precio_alternativo_1) td.precio_estado_seleccionado = 1;
                                        else if (td.estado_precio_alternativo_2) td.precio_estado_seleccionado = 2;
                                        else if (td.estado_precio_alternativo_3) td.precio_estado_seleccionado = 3;
                                        else if (td.estado_precio_alternativo_4) td.precio_estado_seleccionado = 4;
                                        else if (td.estado_precio_alternativo_5) td.precio_estado_seleccionado = 5;
                                        else td.precio_estado_seleccionado = null;
                                    });
                                });
                                self.transItems.forEach(function(t) {
                                    t.trans_item_detalles.forEach(function(td) {
                                        if (td.estado_precio_alternativo_1) td.precio_estado_seleccionado = 1;
                                        else if (td.estado_precio_alternativo_2) td.precio_estado_seleccionado = 2;
                                        else if (td.estado_precio_alternativo_3) td.precio_estado_seleccionado = 3;
                                        else if (td.estado_precio_alternativo_4) td.precio_estado_seleccionado = 4;
                                        else if (td.estado_precio_alternativo_5) td.precio_estado_seleccionado = 5;
                                        else td.precio_estado_seleccionado = null;
                                    });
                                });
                            })
                            this.formula = true
                        } catch (e) {

                        } finally {
                            this.loading = false;
                            const loader = document.querySelector('.loader-overlay');
                            if (loader && this.loading == false) {
                                loader.style.display = 'none';
                            }
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
                                    self.showModalLote = false
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
                            this.showModalLote = false;
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
                    if (this.isSaving) return;
                    this.isSaving = true;
                    try {
                        const data = {
                        transformaciones: this.Transformacion1.map(t => ({
                            ...t,
                            trans_item_detalles: t.trans_item_detalles.map(td => ({
                            ...td,
                            estado_precio_alternativo_1: td.precio_estado_seleccionado == 1 ? 1 : 0,
                            estado_precio_alternativo_2: td.precio_estado_seleccionado == 2 ? 1 : 0,
                            estado_precio_alternativo_3: td.precio_estado_seleccionado == 3 ? 1 : 0,
                            estado_precio_alternativo_4: td.precio_estado_seleccionado == 4 ? 1 : 0,
                            estado_precio_alternativo_5: td.precio_estado_seleccionado == 5 ? 1 : 0,
                            precio_alternativo_1: td.precio_alternativo_1 || 0.00,
                            precio_alternativo_2: td.precio_alternativo_2 || 0.00,
                            precio_alternativo_3: td.precio_alternativo_3 || 0.00,
                            precio_alternativo_4: td.precio_alternativo_4 || 0.00,
                            precio_alternativo_5: td.precio_alternativo_5 || 0.00,
                            })),
                        })),
                        trans_items: this.Transformacion2.map(t => ({
                            ...t,
                            trans_item_detalles: t.trans_item_detalles.map(td => ({
                            ...td,
                            estado_precio_alternativo_1: td.precio_estado_seleccionado == 1 ? 1 : 0,
                            estado_precio_alternativo_2: td.precio_estado_seleccionado == 2 ? 1 : 0,
                            estado_precio_alternativo_3: td.precio_estado_seleccionado == 3 ? 1 : 0,
                            estado_precio_alternativo_4: td.precio_estado_seleccionado == 4 ? 1 : 0,
                            estado_precio_alternativo_5: td.precio_estado_seleccionado == 5 ? 1 : 0,
                            precio_alternativo_1: td.precio_alternativo_1 || 0.00,
                            precio_alternativo_2: td.precio_alternativo_2 || 0.00,
                            precio_alternativo_3: td.precio_alternativo_3 || 0.00,
                            precio_alternativo_4: td.precio_alternativo_4 || 0.00,
                            precio_alternativo_5: td.precio_alternativo_5 || 0.00,
                            })),
                        })),
                        };

                        const res = await axios.post("{{ url('api/transItem-masas') }}", data);

                        await this.load();                         // <— sincroniza servidor -> UI
                        this.transformaciones_list = [];           // <— limpia temporales
                        this.LimpiarTransformaciones();


                        Swal.fire('Transformaciones Actualizadas', '', 'success');
                        if (res?.data?.pdf) window.open(res.data.pdf, '_blank');
                    } catch (e) {
                        console.error('Error al guardar las transformaciones:', e);
                    } finally {
                        this.isSaving = false;
                    }
                    },


                    async saveTransformacionesEspeciales() {
                        if (this.isSaving) return;
                        this.isSaving = true;
                        try {
                            const data = {
                            transformaciones: this.TransformacionEspecial1.map(t => ({
                                ...t,
                                trans_especial_items: t.trans_especial_items.map(td => ({
                                ...td,
                                estado_precio_alternativo_1: td.precio_estado_seleccionado == 1 ? 1 : 0,
                                estado_precio_alternativo_2: td.precio_estado_seleccionado == 2 ? 1 : 0,
                                estado_precio_alternativo_3: td.precio_estado_seleccionado == 3 ? 1 : 0,
                                estado_precio_alternativo_4: td.precio_estado_seleccionado == 4 ? 1 : 0,
                                estado_precio_alternativo_5: td.precio_estado_seleccionado == 5 ? 1 : 0,
                                precio_alternativo_1: td.precio_alternativo_1 || 0.00,
                                precio_alternativo_2: td.precio_alternativo_2 || 0.00,
                                precio_alternativo_3: td.precio_alternativo_3 || 0.00,
                                precio_alternativo_4: td.precio_alternativo_4 || 0.00,
                                precio_alternativo_5: td.precio_alternativo_5 || 0.00,
                                })),
                            })),
                            trans_especials: this.TransformacionEspecial2.map(t => ({
                                ...t,
                                trans_especial_items: t.trans_especial_items.map(td => ({
                                ...td,
                                estado_precio_alternativo_1: td.precio_estado_seleccionado == 1 ? 1 : 0,
                                estado_precio_alternativo_2: td.precio_estado_seleccionado == 2 ? 1 : 0,
                                estado_precio_alternativo_3: td.precio_estado_seleccionado == 3 ? 1 : 0,
                                estado_precio_alternativo_4: td.precio_estado_seleccionado == 4 ? 1 : 0,
                                estado_precio_alternativo_5: td.precio_estado_seleccionado == 5 ? 1 : 0,
                                precio_alternativo_1: td.precio_alternativo_1 || 0.00,
                                precio_alternativo_2: td.precio_alternativo_2 || 0.00,
                                precio_alternativo_3: td.precio_alternativo_3 || 0.00,
                                precio_alternativo_4: td.precio_alternativo_4 || 0.00,
                                precio_alternativo_5: td.precio_alternativo_5 || 0.00,
                                })),
                            })),
                            };

                        const res = await axios.post("{{ url('api/transEspecial-masas') }}", data);

                        await this.load();                               // <—
                        this.transformacion_especial_list = [];          // <—
                        this.LimpiarTransformaciones();

                            Swal.fire('Transformaciones Actualizadas', '', 'success');
                            if (res?.data?.pdf) window.open(res.data.pdf, '_blank');
                        } catch (e) {
                            console.error('Error al guardar las transformaciones:', e);
                        } finally {
                            this.isSaving = false;
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
                            // await Promise.all([self.load(),
                            //     self.GET_DATA("{{ url('api/productos/1') }}"),
                            // ]).then((v) => {
                            //     this.producto_pollo = v[1]
                            //     if (this.producto_pollo.medida_productos.length) {
                            //         this.cintas = this.producto_pollo.medida_productos[0]
                            //             .sub_medidas
                            //     }
                            // })
                            await Promise.all([
                                self.load(),
                                self.GET_DATA("{{ url('api/productos/1') }}"),
                                self.loadProductos(),
                                self.loadMedidas()
                            ]);


                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                        // do whatever you want if console is [object object] then stringify the response




                    })
                }
            }).mount('#appPrecios')
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
