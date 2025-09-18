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
                                        <div class="col-sm-2 col-12">
                                            <div class="form-group">
                                                <label for="fullName">ID </label>
                                                <input :value="id_cliente" disabled type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nombres</label>
                                                <input v-model="model.nombre" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-6">


                                            <div class="form-group ">
                                                <label>Documentos</label>
                                                <select v-model="model.documento_id" class="form-control">
                                                    <option v-for="m in documentos" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group ">
                                                <label>Tipo cliente</label>
                                                <select v-model="model.tipocliente_id" class="form-control">
                                                    <option v-for="m in tipoclientes" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">


                                            <div class="form-group ">
                                                <label>Grupo cliente</label>
                                                <select v-model="model.cinta_cliente_id" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option v-for="m in cintaClientes" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">


                                            <div class="form-group ">
                                                <label>Caja Cerrada</label>
                                                <select v-model="model.caja_cerrada" class="form-control">
                                                    <option :value="0">Ninguno</option>
                                                    <option :value="1">SI</option>
                                                    <option :value="2">NO</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">N° Doc</label>
                                                <input type="text" v-model="model.doc" class="form-control mb-4" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Telefono</label>
                                                <input type="text" v-model="model.telefono" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Correo</label>
                                                <input type="text" v-model="model.correo" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Limite Crediticio</label>
                                                <input type="text" v-model="model.limite_crediticio" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Creditos Activos</label>
                                                <input type="text" v-model="model.creditos_activos" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Dias/horas</label>
                                                <input type="text" v-model="model.dias_horas" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Latitud</label>
                                                <input type="text" v-model="model.latitud" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>


                                        <div class="col-sm-4 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Longitud</label>
                                                <input type="text" v-model="model.longitud" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Horario de Preferencia</label>
                                                <input type="text" v-model="model.horario_preferencia" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Horario de Pedido</label>
                                                <input type="text" v-model="model.horario_pedido" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Dinero a Cuenta</label>
                                                <input type="text" v-model="model.dinero_cuenta" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Deuda Heredada</label>
                                                <input type="text" v-model="model.deuda_heredada" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-6">
                                            <div class="form-group">
                                                <label for="fullName">Interes</label>
                                                <input type="text" v-model="model.interes" class="form-control mb-4"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">


                                            <div class="form-group ">
                                                <label>Tipo cliente Caja Cerrada</label>
                                                <select v-model="model.tipo_caja_cerrada" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option value="7">P. OFICIAL</option>
                                                    <option value="8">P. POR MAYOR</option>
                                                    <option value="9">P. OFERTA</option>
                                                    <option value="10">P. LIQUIDACIÓN</option>
                                                    <option value="11">P. C/FACTURA</option>
                                                    <option value="12">P. SUCURSAL</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">


                                            <div class="form-group ">
                                                <label>Tipo cliente PP </label>
                                                <select v-model="model.tipo_pollo_limpia" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option value="7">P. OFICIAL</option>
                                                    <option value="8">P. POR MAYOR</option>
                                                    <option value="9">P. OFERTA</option>
                                                    <option value="10">P. LIQUIDACIÓN</option>
                                                    <option value="11">P. C/FACTURA</option>
                                                    <option value="12">P. SUCURSAL</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Tipo cliente PT </label>
                                                <select v-model="model.tipo_pt" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option value="7">P. OFICIAL</option>
                                                    <option value="8">P. POR MAYOR</option>
                                                    <option value="9">P. OFERTA</option>
                                                    <option value="10">P. LIQUIDACIÓN</option>
                                                    <option value="11">P. C/FACTURA</option>
                                                    <option value="12">P. SUCURSAL</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Tipo cliente Transformaciones </label>
                                                <select v-model="model.tipo_trans" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option value="7">P. OFICIAL</option>
                                                    <option value="8">P. POR MAYOR</option>
                                                    <option value="9">P. OFERTA</option>
                                                    <option value="10">P. LIQUIDACIÓN</option>
                                                    <option value="11">P. C/FACTURA</option>
                                                    <option value="12">P. SUCURSAL</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label>Preventista</label>
                                                <div class="input-group mb-4">
                                                    <select class="form-control" v-model="model.preventista_id">
                                                        <option disabled value="">Seleccione un Preventista</option>
                                                        <template v-for="m in users">
                                                            <option :value="m.id">{{ m . nombre }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6" style="display: none">
                                            <div class="form-group">
                                                <label>Distribuidor</label>
                                                <div class="input-group mb-4">
                                                    <select class="form-control" v-model="model.distribuidor_id">
                                                        <option disabled value="">Seleccione un Distribuidor</option>
                                                        <template v-for="m in users">
                                                            <option :value="m.id">{{ m . nombre }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Acuerdo </label>
                                                <select v-model="model.acuerdo_cliente_id" class="form-control">
                                                    <option value="0">Ninguno</option>
                                                    <option v-for="m in acuerdoClientes" :value="m.id">{{ m . name }}
                                                    </option>

                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Método de pago</label>
                                                <select v-model="model.tipopago_id" class="form-control">
                                                    <option v-for="m in tipopagos" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Tipo de negocio </label>
                                                <select v-model="model.tipo_negocio_id" class="form-control">
                                                    <option v-for="m in tipo_negocios" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Forma de pedido </label>
                                                <select v-model="model.forma_pedido_id" class="form-control">
                                                    <option v-for="m in forma_pedidos" :value="m.id">{{ m . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Chofer </label>
                                                <select v-model="model.chofer_id" class="form-control">
                                                    <option v-for="m in chofers" :value="m.id">{{ m . nombre }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-6">
                                            <div class="form-group ">
                                                <label>Zona de despacho </label>
                                                <select v-model="model.zona_despacho_id" class="form-control">
                                                    <option v-for="m in zona_despachos" :value="m.id">
                                                        {{ m . name }}</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-3 col-6">
                                            <div class="form-group">
                                                <label for="fullName">
                                                    <div class="n-chk">
                                                        <label class="new-control new-checkbox checkbox-primary">
                                                            <input type="checkbox" class="new-control-input"
                                                                v-model="model.is_iva">
                                                            <span class="new-control-indicator"></span>IVA
                                                        </label>
                                                    </div>
                                                </label>
                                                <input type="text" value="true" :disabled="!model.is_iva"
                                                    v-model="model.iva" class="form-control mb-4" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div id="map"></div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-4 col-12 mt-3">
                                                    <div id="iconsAccordion" class="accordion-icons">
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <section class="mb-0 mt-0">
                                                                    <div role="menu" class="" data-toggle="collapse"
                                                                        data-target="#iconAccordionOne" aria-expanded="true"
                                                                        aria-controls="iconAccordionOne">
                                                                        <div class="accordion-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-airplay">
                                                                                <path
                                                                                    d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1">
                                                                                </path>
                                                                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                                                            </svg>
                                                                        </div>
                                                                        CAJAS CERRADAS
                                                                        <div class="icons">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-chevron-up">
                                                                                <polyline points="18 15 12 9 6 15"></polyline>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div id="iconAccordionOne" class="collapse show"
                                                                aria-labelledby="headingOne" data-parent="#iconsAccordion">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Producto</label>
                                                                                <select class="form-control"
                                                                                    v-model="precio_producto">
                                                                                    <template v-for="m in precio_productos">
                                                                                        <option :value="m">
                                                                                            {{ m . name }}</option>
                                                                                    </template>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Valor</label><input
                                                                                    type="text" v-model="valor"
                                                                                    class="form-control mb-4" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button class="btn btn-success w-100" type="button"
                                                                                @click="addCajaCerrada()">
                                                                                Agregar
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>
                                                                        <div class="col-12 table-responsive">
                                                                            <table i class="table table-hover non-hover"
                                                                                style="width: 100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>NOMBRE</th>
                                                                                        <th>VALOR</th>
                                                                                        <th>ACCION</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(m,i) in cajas_cerradas">
                                                                                        <td>{{ i + 1 }}</td>
                                                                                        <td>{{ m . precio_producto . name }}</td>
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                class="form-control form-control-sm"
                                                                                                v-model="m.valor" />
                                                                                        </td>
                                                                                        <td>
                                                                                            <button class="btn btn-danger btn-sm"
                                                                                                @click="cajas_cerradas.splice(i,1)">Eliminar</button>
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
                                                                    <div role="menu" class="" data-toggle="collapse"
                                                                        data-target="#iconAccordionOne2" aria-expanded="true"
                                                                        aria-controls="iconAccordionOne2">
                                                                        <div class="accordion-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-airplay">
                                                                                <path
                                                                                    d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1">
                                                                                </path>
                                                                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                                                            </svg>
                                                                        </div>
                                                                        PP
                                                                        <div class="icons">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-chevron-up">
                                                                                <polyline points="18 15 12 9 6 15"></polyline>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div id="iconAccordionOne2" class="collapse show"
                                                                aria-labelledby="headingOne2" data-parent="#iconsAccordion2">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Item</label>
                                                                                <select class="form-control" v-model="item">
                                                                                    <template v-for="m in items">
                                                                                        <option v-if="m.tipo==1"
                                                                                            :value="m">
                                                                                            {{ m . name }}</option>
                                                                                    </template>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Valor</label><input
                                                                                    type="text" v-model="valor"
                                                                                    class="form-control mb-4" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button class="btn btn-success w-100" type="button"
                                                                                @click="addPP()">
                                                                                Agregar
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>
                                                                        <div class="col-12 table-responsive">
                                                                            <table i class="table table-hover non-hover"
                                                                                style="width: 100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>NOMBRE</th>
                                                                                        <th>VALOR</th>
                                                                                        <th>ACCION</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(m,i) in pps">
                                                                                        <td>{{ i + 1 }}</td>
                                                                                        <td>{{ m . item . name }}</td>
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                class="form-control form-control-sm"
                                                                                                v-model="m.valor" />
                                                                                        </td>
                                                                                        <td>
                                                                                            <button class="btn btn-danger btn-sm"
                                                                                                @click="pps.splice(i,1)">Eliminar</button>
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
                                                                    <div role="menu" class="" data-toggle="collapse"
                                                                        data-target="#iconAccordionOne3" aria-expanded="true"
                                                                        aria-controls="iconAccordionOne3">
                                                                        <div class="accordion-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-airplay">
                                                                                <path
                                                                                    d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1">
                                                                                </path>
                                                                                <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                                                            </svg>
                                                                        </div>
                                                                        PT
                                                                        <div class="icons">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="feather feather-chevron-up">
                                                                                <polyline points="18 15 12 9 6 15"></polyline>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div id="iconAccordionOne3" class="collapse show"
                                                                aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Producto</label>
                                                                                <select class="form-control" v-model="item">
                                                                                    <template v-for="m in items">
                                                                                        <option v-if="m.tipo == 2 || m.tipo == 3"
                                                                                            :value="m">
                                                                                            {{ m . name }}</option>
                                                                                    </template>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="fullName">Valor</label><input
                                                                                    type="text" v-model="valor"
                                                                                    class="form-control mb-4" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button class="btn btn-success w-100" type="button"
                                                                                @click="addPT()">
                                                                                Agregar
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>
                                                                        <div class="col-12 table-responsive">
                                                                            <table i class="table table-hover non-hover"
                                                                                style="width: 100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>NOMBRE</th>
                                                                                        <th>VALOR</th>
                                                                                        <th>ACCION</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(m,i) in pts">
                                                                                        <td>{{ i + 1 }}</td>
                                                                                        <td>{{ m . item . name }}</td>
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                class="form-control form-control-sm"
                                                                                                v-model="m.valor" />
                                                                                        </td>
                                                                                        <td>
                                                                                            <button class="btn btn-danger btn-sm"
                                                                                                @click="pts.splice(i,1)">Eliminar</button>
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
                                        <div class="col-12 mt-2">
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
            import Table from "{{ asset('config/dt.js') }}"
            import Block from "{{ asset('config/block.js') }}"


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
                            acuerdo_cliente_id: 0,
                            cajacerrada_cliente_id: 1,
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
                            cinta_cliente_id: 0,
                            deuda_heredada: 0,
                            dinero_cuenta: 0,
                            tipo_caja_cerrada: 0,
                            tipo_cliente_pp: 0,
                            caja_cerrada: 0,
                            tipo_pollo_limpia: 0,
                            tipo_pt: 0,
                            tipo_trans: 0,
                            tipo_cliente_pp_id: 1,
                            tipopago_id: 1,
                            tipo_cliente_pp_limpio_id: 1,
                            acuerdo: 1,
                            iva: 0,
                            interes: 0,
                            is_iva: false,
                            forma_pedido_id: 1,
                            zona_despacho_id: 1,
                            tipo_negocio_id: 1,
                            chofer_id: 1,
                            horario_pedido: "",
                            horario_preferencia: "",
                            preventista_id: 0,
                            distribuidor_id: 0,
                        },
                        documentos: [],
                        tipoclientes: [],
                        tipopagos: [],
                        cintaClientes: [],
                        cajacerradaClientes: [],
                        acuerdoClientes: [],
                        tipoClientePps: [],
                        tipoClientePpLimpios: [],
                        clientes: [],
                        id_cliente: 0,
                        sucursal: {
                            id: 0
                        },
                        precio_productos: [],
                        precio_producto: {

                        },
                        valor: 0,
                        cajas_cerradas: [],
                        item: {},
                        items: [],
                        pts: [],
                        pps: [],
                        forma_pedidos: [],
                        zona_despachos: [],
                        tipo_negocios: [],
                        user: {},
                        chofers: [],
                        users: [],
                        userSelected: '',
                    }
                },
                methods: {
                    addPT() {
                        let data = {
                            valor: this.valor,
                            item: this.item
                        }
                        this.pts.push(data)
                    },
                    addPP() {
                        let data = {
                            valor: this.valor,
                            item: this.item
                        }
                        this.pps.push(data)
                    },
                    addCajaCerrada() {
                        let data = {
                            valor: this.valor,
                            precio_producto: this.precio_producto
                        }
                        this.cajas_cerradas.push(data)
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    async Save() {
                        block.block();
                        try {
                            if (!this.model.preventista_id || this.model.preventista_id === 0) {
                                await Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'Debe seleccionar un preventista antes de guardar.',
                                });
                                return;
                            }
                            if (!this.model.distribuidor_id || this.model.distribuidor_id === 0) {
                                await Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'Debe seleccionar un preventista antes de guardar.',
                                });
                                return;
                            }
                            this.model.cajas_cerradas = this.cajas_cerradas
                            this.model.pts = this.pts
                            this.model.pps = this.pps

                            let url = "url_path()api/clientes";
                            await axios.post("{{ url('api/clientes') }}", this.model)
                            this.back()

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    back() {
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
                            let user = localStorage.getItem('AppUser')
                            if (user != null) {
                                this.user = JSON.parse(user);
                            }

                            await Promise.all([self.GET_DATA('documentos'), self.GET_DATA('tipoclientes'),

                                self.GET_DATA('cintaClientes'),
                                self.GET_DATA('cajacerradaClientes'),
                                self.GET_DATA('acuerdoClientes'),
                                self.GET_DATA('tipoClientePps'),
                                self.GET_DATA('tipoClientePpLimpios'),
                                self.GET_DATA('clientes'),
                                self.GET_DATA('tipopagos'),
                                self.GET_DATA('producto-precios-sucursal/' + this.sucursal.id),
                                self.GET_DATA('items-sucursal/' + this.sucursal.id),
                                self.GET_DATA('formaPedidos'),
                                self.GET_DATA('tipoNegocios'),
                                self.GET_DATA('zonaDespachos'),
                                self.GET_DATA('chofers'),
                                self.GET_DATA('users'),
                            ]).then((v) => {
                                self.documentos = v[0]
                                self.tipoclientes = v[1]
                                self.cintaClientes = v[2]
                                self.cajacerradaClientes = v[3]
                                self.acuerdoClientes = v[4]
                                self.tipoClientePps = v[5]
                                self.tipoClientePpLimpios = v[6]
                                self.clientes = v[7]
                                self.tipopagos = v[8]
                                self.precio_productos = v[9]
                                self.items = v[10]
                                self.forma_pedidos = v[11]
                                self.tipo_negocios = v[12]
                                self.zona_despachos = v[13]
                                self.chofers = v[14]
                                self.users = v[15];
                            })

                            if (self.documentos.length) {
                                self.model.documento_id = self.documentos[0].id
                            }
                            let clientes = [...this.clientes].reverse()
                            if (clientes.length) {
                                this.id_cliente = clientes[0].id + 1
                            } else {
                                this.id_cliente = 1
                            }
                        } catch (e) {

                        } finally {
                            var map = L.map('map').setView([-16.5205315, -68.2066501], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);
                            const popup = L.popup()

                            function onMapClick(e) {
                                self.model.latitud = e.latlng.lat
                                self.model.longitud = e.latlng.lng
                                popup
                                    .setLatLng(e.latlng)
                                    .setContent(`Hiciste Click en ${e.latlng.toString()}`)
                                    .openOn(map);
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
            #map {
                height: 280px;
            }
        </style>
    @endslot
@endcomponent
