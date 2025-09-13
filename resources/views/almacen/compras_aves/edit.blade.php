@component('application')
    @slot('body')
        @verbatim
            <div id="block_ui">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Verifique bien los datos antes de EDITAR la compra de este Lote</h6>
                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nro de compra:</label>
                                                <input v-model="model.nro" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Fecha:</label>
                                                <input v-model="model.fecha" type="date" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Fecha Salida:</label>
                                                <input v-model="model.fecha_salida" type="date" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Fecha Llegada:</label>
                                                <input v-model="model.fecha_llegada" type="date" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label>Almacen:</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="model.almacen_id" class="form-control">
                                                        <option v-for="(m,i) in almacens" :value="m.id">{{ m . name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Hora:</label>
                                                <input v-model="model.hora" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Chofer:</label>
                                                <input v-model="model.chofer" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Camion:</label>
                                                <input v-model="model.camion" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Placa:</label>
                                                <input v-model="model.placa" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">E. Despacho:</label>
                                                <input v-model="model.e_despacho" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">E. Recepcion:</label>
                                                <input v-model="model.e_recepcion" type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label>Proveedor:</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="model.proveedor_compra_id" class="form-control">


                                                        <option v-for="(m,i) in proveedors" :value="m.id">
                                                            {{ m . nombre }}</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>

                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Cantidad de Jaulas</label>
                                                <input v-model="producto_model.cantidad"
                                                    @change="producto_model.nro=producto_model.cantidad*Number(medida_producto.valor)"
                                                    type="text" class="form-control mb-4">
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Peso Bruto</label>
                                                <input v-model="producto_model.peso" type="text" class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12" style="display: none">
                                            <div class="form-group">
                                                <label for="fullName">Cinta</label>
                                                <select name="" id="" class="form-control" :value="cintaSelected"
                                                    v-model="cinta" @change="CambiarCinta"
                                                    :disabled="producto.tipo == 0 || (producto_model.categoria && producto_model
                                                        .categoria.name === 'PRIMERA')">
                                                    <template v-for="(c,e) in medida_producto.sub_medidas">
                                                        <option v-if="cintaSelected == c.name || c.name == 'AVE'"
                                                            :value="c.name">{{ c . name }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12" style="display: none">
                                            <div class="form-group">
                                                <label for="fullName">Categoria</label>
                                                <select v-model="producto_model.categoria" class="form-control">
                                                    <option v-for="(c,e) in categorias" :value="c">{{ c . name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Productos</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="producto" disabled class="form-control">
                                                        <option v-for="m in productos.slice().reverse()" :value="m"
                                                            :key="m.id">
                                                            {{ m . name }}
                                                        </option>
                                                    </select>
                                                    <input type="hidden" name="producto_id" :value="producto.id" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label>Cajas</label>
                                                <div class="input-group mb-4">
                                                    <select v-model="medida_producto" disabled class="form-control">
                                                        <option v-for="(m,i) in producto.medida_productos" :value="m">
                                                            {{ m . medida . name }}
                                                        </option>
                                                    </select>
                                                    <input type="hidden" name="medida_producto_id"
                                                        :value="medida_producto.id" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="fullName">Nro Aves</label>
                                                <input v-model="producto_model.nro" :disabled="producto.tipo == 0" type="text"
                                                    class="form-control mb-4">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12" style="display: none">
                                            <div class="form-group">
                                                <label for="fullName">Pigmento</label>
                                                <select name="" id="" class="form-control"
                                                    v-model="producto_model.pigmento">
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12" style="display: none">
                                            <div class="form-group">
                                                <label for="fullName">Tipo</label>
                                                <select name="" id="" class="form-control"
                                                    v-model="producto_model.tipo_pollo">
                                                    <option value="1">POLLO</option>
                                                    <option value="0">PRESA</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-12">
                                            <button class="btn btn-success w-100 mb-4" @click="AgregarProducto(i)"
                                                type="button">Agregar</button>
                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive mb-4 mt-4">
                                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre</th>
                                                            <th>Cant Jaulas</th>
                                                            <th>Peso Bruto</th>
                                                            <th>Peso Neto</th>
                                                            <th>Nro Aves</th>
                                                            <th>Peso Uni</th>
                                                            <th style="display: none">Cinta Falsa</th>
                                                            <th style="display: none">Cinta Original</th>
                                                            <th style="display: none">Categoria</th>
                                                            <th style="display: none">Pigmento</th>
                                                            <th style="display: none">Tipo</th>
                                                            <th class="text-center">Accion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(m,i) in productos_model_computed" class="table-danger">
                                                            <td>{{ m . index + 1 }}</td>
                                                            <td>{{ m . producto . name }}</td>
                                                            <td class="td-c"> <input v-model.number="m.producto_model.cantidad"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input v-model.number="m.producto_model.peso"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input disabled
                                                                    :value="m.producto_model.peso - (Number(m.medida_producto
                                                                        .medida.retraccion) * Number(m
                                                                        .producto_model.cantidad))"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input v-model.number="m.producto_model.nro"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    v-if="m.tipo_pollo==1" class="fm-ct form-control "></td>
                                                            <td class="td-c">
                                                                <span v-if="m.tipo_pollo==1">
                                                                    {{ Number(Number(m . producto_model . peso - Number(m . medida_producto . medida . retraccion) * Number(m . producto_model . cantidad)) / Number(m . producto_model . nro)) . toFixed(3) }}

                                                                </span>
                                                            </td>
                                                            <td style="display: none"> <select v-model="m.sub_medida" class="form-control"
                                                                    v-if="m.tipo_pollo==1">


                                                                    <option v-for="(c,e) in m.medida_producto.sub_medidas"
                                                                        :value="c">{{ c . name }}</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.sub_medida_2" class="form-control"
                                                                    v-if="m.tipo_pollo==1">


                                                                    <option v-for="(c,e) in m.medida_producto.sub_medidas"
                                                                        :value="c">{{ c . name }}</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.categoria" class="form-control">


                                                                    <option v-for="(c,e) in categorias" :value="c">
                                                                        {{ c . name }}
                                                                    </option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.producto_model.pigmento" class="form-control">


                                                                    <option value="1">SI</option>
                                                                    <option value="2">NO</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.producto_model.tipo_pollo"
                                                                    v-if="m.tipo_pollo==1" class="form-control">


                                                                    <option value="1">POLLO</option>
                                                                    <option value="2">PRESA</option>

                                                                </select></td>
                                                            <td class="text-center"><svg @click="eliminarProducto(i)"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="feather feather-trash-2 icon text-danger">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg></td>
                                                        </tr>
                                                        <tr v-for="(m,i) in detalles_computed">
                                                            <td>{{ m . index + 1 }}</td>
                                                            <td>{{ m . inventario . producto . name }}</td>
                                                            <td class="td-c"> <input v-model.number="m.cant"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input v-model.number="m.valor"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input disabled
                                                                    :value="m.valor - (Number(m.sub_medida.medida_producto
                                                                        .medida.retraccion) * Number(m.cant))"
                                                                    @change="ChangeProducto(i)" type="text"
                                                                    class="fm-ct form-control "></td>
                                                            <td class="td-c"> <input v-model.number="m.nro"
                                                                    v-if="m.tipo_pollo==1" @change="ChangeProducto(i)"
                                                                    type="text" class="fm-ct form-control "></td>
                                                            <td class="td-c">
                                                                <span v-if="m.tipo_pollo==1">
                                                                    {{ Number(Number(m . valor - Number(m . sub_medida . medida_producto . medida . retraccion) * Number(m . cant)) / Number(m . nro)) . toFixed(3) }}
                                                                </span>
                                                            </td>

                                                            <td style="display: none"> <select v-model="m.sub_medida_id"
                                                                    class="form-control" v-if="m.tipo_pollo==1">
                                                                    <option v-for="(c,e) in m.medida_producto.sub_medidas"
                                                                        :value="c.id">{{ c . name }}</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.sub_original_id"
                                                                    class="form-control" v-if="m.tipo_pollo==1">


                                                                    <option v-for="(c,e) in m.medida_producto.sub_medidas"
                                                                        :value="c.id">{{ c . name }}</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.categoria"
                                                                    class="form-control">


                                                                    <option v-for="(c,e) in categorias" :value="c">
                                                                        {{ c . name }}
                                                                    </option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.pigmento"
                                                                    class="form-control">


                                                                    <option value="1">SI</option>
                                                                    <option value="2">NO</option>

                                                                </select></td>
                                                            <td style="display: none"> <select v-model="m.tipo_pollo"
                                                                    class="form-control" v-if="m.tipo_pollo==1">


                                                                    <option value="1">POLLO</option>
                                                                    <option value="0">PRESA</option>

                                                                </select></td>
                                                            <td class="text-center"><svg @click="m.estado=0"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="feather feather-trash-2 icon text-danger">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg></td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-default">

                                                            <td colspan="4">Cantidad de Pollos</td>

                                                            <td colspan="4" class="text-left bg-white text-black">
                                                                {{ parseInt(SumCantPollos) }}
                                                            </td>
                                                        </tr>
                                                        <tr class="table-default">

                                                            <td colspan="4">Cantidad de Jaulas</td>

                                                            <td colspan="4" class="text-left bg-white text-black">
                                                                {{ SumCantEnvases }}
                                                            </td>
                                                        </tr>
                                                        <tr class="table-default">

                                                            <td colspan="4">Peso Bruto Total</td>

                                                            <td colspan="4" class="text-left bg-white text-black">
                                                                {{ Number(SumPesoBruto) . toFixed(3) }}</td>
                                                        </tr>
                                                        <tr class="table-primary">

                                                            <td colspan="4">Retraccion de Tara</td>

                                                            <td colspan="4" class="text-left bg-white text-black">
                                                                -{{ Number(SumRetraccion) . toFixed(3) }}</td>
                                                        </tr>
                                                        <tr class="table-default">

                                                            <td colspan="4">Peso Neto Total</td>

                                                            <td colspan="4" class="text-left bg-white text-black">
                                                                {{ Number(SumPesoNeto) . toFixed(3) }}</td>
                                                        </tr>


                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-12" style="display: none">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Almacen Origen</th>
                                                        <th>Cajas</th>
                                                        <th>Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(m,i) in model.caja_compras">
                                                        <td>{{ m . caja_inventario . almacen . name }}</td>
                                                        <td><input v-model.number="m.caja_inventario.cantidad" type="text"
                                                                class="form-control "></td>
                                                        <td>
                                                            <svg @click="editarCaja(m)" style="cursor:pointer"
                                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-edit-2">
                                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                </path>
                                                            </svg>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-dark w-100" @click="back()">Regresar</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary w-100" @click="Save()">Guardar</button>
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
                            camion: '',
                            placa: '',
                            nro: '',
                            chofer: '',
                            e_recepcion: '',
                            e_despacho: '',
                            proveedor_compra_id: '',
                            fecha: '',
                            fecha_llegada: '',
                            fecha_salida: '',
                            hora: '',
                            almacen_id: '',

                            medidas: [],
                            compra_inventarios: [],
                            caja_compras: []
                        },
                        producto_model: {
                            nro: 0,
                            peso: 0,
                            pigmento: 1,
                            cantidad: 0,
                            tipo_pollo: 1,
                            tipo: 1,
                            // cantidad: 1,
                            categoria: {

                            }
                        },
                        producto: {
                            name: '',
                            medida_productos: []
                        },
                        categoria: {

                        },
                        medida_producto: {
                            medida: {
                                retraccion: 0
                            },
                            sub_medidas: []
                        },
                        categorias: [],
                        medidas: [],
                        almacens: [],
                        proveedors: [],
                        data: [],
                        productos: [],
                        productos_model: [],
                        submedida: {
                            name: '',
                            valor_1: 0,
                            valor_2: 0,
                            categoria: {
                                name: ''
                            }
                        },
                        cinta: ""

                    }
                },
                computed: {
                    productos_model_computed() {
                        return this.productos_model.map((e, i) => {
                            e.producto_model.cantidad = parseInt(e.producto_model.cantidad)
                            e.index = i
                            return e
                        }).reverse()
                    },
                    detalles() {
                        return this.model.compra_inventarios.filter((e) => e.estado == 1);
                    },
                    detalles_computed() {
                        return this.detalles.map((e, i) => {
                            e.cant = parseInt(e.cant)
                            e.index = i
                            return e
                        }).reverse()
                    },
                    SumCantPollos() {
                        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.nro)), 0)
                        return mas + this.detalles.reduce((a, b) => a + Number(Number(b.nro)), 0)
                    },
                    SumCantEnvases() {
                        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.cantidad)),
                            0)
                        return mas + this.detalles.reduce((a, b) => a + Number(Number(b.cant)), 0)
                    },
                    SumPesoBruto() {
                        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.peso)), 0)

                        return mas + this.detalles.reduce((a, b) => a + Number(Number(b.valor)), 0)
                    },
                    SumPesoNeto() {
                        let mas = this.productos_model.reduce((a, b) => a + Number(Number(b.producto_model.peso) - (
                            Number(b.medida_producto.medida.retraccion) * Number(b.producto_model.cantidad)
                        )), 0)

                        return mas + this.detalles.reduce((a, b) => a + Number(Number(b.valor) - (Number(b.sub_medida
                            .medida_producto.medida.retraccion) * Number(b.cant))), 0)
                    },
                    SumRetraccion() {
                        let mas = this.productos_model.reduce((a, b) => a + (Number(b.medida_producto.medida
                            .retraccion) * Number(b.producto_model.cantidad)), 0)

                        return mas + this.detalles.reduce((a, b) => a + (Number(b.sub_medida.medida_producto.medida
                            .retraccion) * Number(b.cant)), 0)
                    },
                    cintaSelected() {
                        if (this.producto_model.categoria && this.producto_model.categoria.name === "PRIMERA") {
                            let amarilla = this.medida_producto.sub_medidas.find(e => e.name === "AVE")
                            if (amarilla) {
                                this.cinta = amarilla.name
                                return amarilla.name
                            }
                            return ""
                        }
                        let medidas = {
                            ...this.medida_producto
                        }
                        let sub_medidas = medidas.sub_medidas
                        let sub = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(
                            this.producto_model.cantidad))) / Number(this.producto_model.nro)
                        let unit = {}

                        sub_medidas.map(e => {
                            if (Number(e.valor_1) <= sub && Number(e.valor_2) >= sub) {
                                unit = e
                            }
                        })
                        this.cinta = unit.name
                        return unit.name

                    }
                },
                methods: {
                    eliminarProducto(i) {
                        let data = [...this.productos_model_computed]
                        data.splice(i, 1)
                        this.productos_model = data.reverse()
                    },
                    async GET_DATA(path) {
                        try {
                            let res = await axios.get("{{ url('api') }}/" + path)
                            return res.data
                        } catch (e) {

                        }
                    },
                    AgregarProducto() {
                        if (!this.producto_model.nro || !this.producto_model.peso || !this.producto_model
                            .cantidad) {
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            });

                            swalWithBootstrapButtons({
                                title: 'Error!',
                                text: "Por favor complete todos los campos antes de agregar el producto.",
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                padding: '2em',
                            });
                            return;
                        }
                        let medidas = this.medida_producto
                        let bruto = Number(this.producto_model.peso) / Number(this.producto_model.nro)
                        let neto = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) *
                            Number(this.producto_model.cantidad)))
                        let sub = Number(Number(this.producto_model.peso) - (Number(medidas.medida.retraccion) * Number(
                            this.producto_model.cantidad))) / Number(this.producto_model.nro)
                        let unit = {}
                        medidas.sub_medidas.map((a) => {
                            let valor_1 = Number(a.valor_1)
                            let valor_2 = Number(a.valor_2)
                            if (sub >= valor_1 && sub <= valor_2) {
                                unit = a
                            }
                        })

                        let categoria = this.producto_model.categoria
                        if (categoria.name == "PRIMERA") {
                            let amarilla = medidas.sub_medidas.filter(e => e.name == "AVE")[0]
                            const producto = {
                                sub_medida: amarilla,
                                sub_medida_2: {
                                    ...amarilla
                                },
                                producto: {
                                    name: this.producto.name,
                                    id: this.producto.id,
                                },
                                categoria: {
                                    ...this.producto_model.categoria
                                },
                                medida_producto: medidas,
                                producto_model: {
                                    pigmento: this.producto_model.pigmento,
                                    tipo_pollo: this.producto_model.tipo_pollo,
                                    peso: this.producto_model.peso,
                                    neto: neto,
                                    nro: this.producto_model.nro,
                                    cantidad: this.producto_model.cantidad,
                                },
                                tipo: this.producto.tipo
                            }
                            this.productos_model.push(producto)
                        } else {
                            const producto = {
                                sub_medida: unit,
                                sub_medida_2: {
                                    ...unit
                                },
                                producto: {
                                    name: this.producto.name,
                                    id: this.producto.id,
                                },
                                categoria: {
                                    ...this.producto_model.categoria
                                },
                                medida_producto: medidas,
                                producto_model: {
                                    pigmento: this.producto_model.pigmento,
                                    tipo_pollo: this.producto_model.tipo_pollo,
                                    peso: this.producto_model.peso,
                                    neto: neto,
                                    nro: this.producto_model.nro,
                                    cantidad: this.producto_model.cantidad,
                                },
                                tipo: this.producto.tipo
                            }
                            this.productos_model.push(producto)
                        }
                        this.producto_model.categoria = this.categorias[0]
                    },
                    ChangeProducto(i) {
                        let medidas = this.productos_model[i].medida_producto
                        this.productos_model[i].producto_model.nro = this.productos_model[i].medida_producto.valor *
                            this.productos_model[i].producto_model.cantidad

                        let bruto = Number(this.productos_model[i].producto_model.peso) / Number(this.productos_model[i]
                            .producto_model.nro)
                        let neto = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida
                            .retraccion) * Number(this.productos_model[i].producto_model.cantidad)))
                        let sub = Number(Number(this.productos_model[i].producto_model.peso) - (Number(medidas.medida
                            .retraccion) * Number(this.productos_model[i].producto_model.cantidad))) / Number(this
                            .productos_model[i].producto_model.nro)
                        let unit = {}
                        medidas.sub_medidas.map((a) => {
                            let valor_1 = Number(a.valor_1)
                            let valor_2 = Number(a.valor_2)
                            if (sub >= valor_1 && sub <= valor_2) {
                                unit = a
                            }
                        })

                        this.productos_model[i].producto_model.neto = neto
                        this.productos_model[i].sub_medida = unit
                    },
                    CambioProducto() {

                        this.medida_producto = this.producto.medida_productos[0]
                        this.producto_model.nro = this.producto_model.cantidad * Number(this.medida_producto.valor)
                    },
                    AgregarSubmedida(i) {
                        const submedida = {
                            name: this.submedida.name,
                            valor_1: this.submedida.valor_1,
                            valor_2: this.submedida.valor_2,
                            categoria: this.submedida.categoria,
                        }
                        this.model.medidas[i].submedidas.push(submedida)
                    },

                    async Save() {
                        block.block();
                        try {
                            this.model.sum_cant_pollos = this.SumCantPollos
                            this.model.sum_cant_envases = this.SumCantEnvases
                            this.model.sum_peso_bruto = this.SumPesoBruto
                            this.model.sum_peso_neto = this.SumPesoNeto
                            this.model.sum_retraccion = this.SumRetraccion
                            this.model.productos_model = this.productos_model
                            let res = await axios.put("{{ url('api/compras-aves') }}/{{ $id }}", this
                                .model)
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',
                                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                buttonsStyling: false,
                            })
                            let compra = res.data
                            swalWithBootstrapButtons({
                                title: 'Compra Editada Actualizada',
                                text: "Su Compra fue guardada",
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'IMPRIMIR PDF',
                                cancelButtonText: 'REGRESAR',
                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {
                                    try {


                                        window.open(compra.url_pdf_2, '_blank');
                                        this.back()
                                    } catch (e) {

                                    }
                                } else {
                                    this.back()
                                }
                            })

                        } catch (e) {

                        } finally {
                            block.unblock();
                        }
                    },
                    back() {
                        window.location.replace(document.referrer);
                    },
                    async editarCaja(caja) {
                        try {
                            let res = await axios.put("{{ url('api') }}/cajaCompras/" + caja.id, caja)
                            const swalWithBootstrapButtons = swal.mixin({
                                confirmButtonClass: 'btn btn-success btn-rounded',

                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons({
                                title: 'Compra Actualizada',
                                text: "Su Compra fue guardada",
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK',

                                reverseButtons: true,
                                padding: '2em'
                            }).then(async (result) => {
                                if (result.value) {}
                            })
                        } catch (e) {

                        }
                    },
                    CambiarCinta() {
                        let categoria = this.categorias.find((a) => a.name == "PRIMERA")
                        this.producto_model.categoria = categoria
                    }
                },
                watch: {
                    'producto_model.categoria'(val) {
                        if (val && val.name === "PRIMERA") {
                            let amarilla = this.medida_producto.sub_medidas.find(e => e.name === "AVE")
                            if (amarilla) {
                                this.cinta = amarilla.name
                            }
                        }
                    }
                },
                mounted() {
                    this.$nextTick(async () => {
                        let self = this
                        block.block();
                        try {



                            await Promise.all([self.GET_DATA('categorias'), self.GET_DATA('medidas'), self
                                .GET_DATA('productos'), self.GET_DATA('almacens'), self.GET_DATA(
                                    'proveedorComprasAves'), self.GET_DATA(
                                    "compras-aves/{{ $id }}")
                            ]).then((v) => {
                                self.categorias = v[0]
                                self.medidas = v[1]
                                self.productos = v[2]
                                self.producto = self.productos.slice().reverse()[0] || null
                                if (self.producto && self.producto.medida_productos.length) {
                                    self.medida_producto = self.producto.medida_productos[0]
                                }
                                self.almacens = v[3]
                                self.proveedors = v[4]
                                self.model = v[5]


                                // Alert con los datos recibidos
                                // alert("Datos recibidos: \n" +

                                //     "Modelo: " + JSON.stringify(self.model));
                                if (self.categorias.length) {
                                    self.producto_model.categoria = self.categorias[0]
                                }
                                const productosInvertidos = self.productos.slice().reverse();
                                self.producto = productosInvertidos[0];
                                if (self.producto.medida_productos.length) {
                                    self.medida_producto = self.producto.medida_productos[0];
                                }


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
            .fm-ct {
                width: 100px;
            }

            td.td-c {
                width: 100px;
            }
        </style>
    @endslot
@endcomponent
