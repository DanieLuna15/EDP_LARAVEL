@component('application')
    @slot('body')
        @verbatim
            <div id="meApp" class="container-fluid mt-4">
                <div id="block_ui">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-grid me-2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <h4 class="mb-0">Usuarios</h4>
                        </div>
                        <div>
                            <a href="./usuario/add" class="btn btn-success">Agregar</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4 ms-auto">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Buscar..." v-model="search">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="loading" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">...</span>
                                </div>
                            </div>
                            <div v-else class="table table-responsive">
                                <table id="table_dt" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">#</th>
                                            <th class="col-md-2">Usuario</th>
                                            <th class="col-md-3">Nombre</th>
                                            <th class="col-md-3">Correo</th>
                                            <th class="col-md-3">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in filteredUsers" :key="item.id">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ item.usuario }}</td>
                                            <td>{{ item.nombre }} {{ item.apellidos }}</td>
                                            <td>{{ item.correo }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button v-if="item.permissions.length > 0" class="btn btn-danger btn-sm"
                                                        @click="btnQuitarAcceso(item)">
                                                        Quitar Acceso
                                                    </button>
                                                    <button v-if="!item.permissions.length > 0" class="btn btn-success btn-sm"
                                                        @click="btnAgregarSistema(item)">
                                                        Agregar al Sistema
                                                    </button>
                                                    <button class="btn btn-info btn-sm" @click="btnAccesosPermisos(item)">
                                                        Permisos
                                                    </button>
                                                    <a :href="'./usuario/edit/' + item.id" class="btn btn-warning btn-sm">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0)" @click="deleteItem(item.id)"
                                                        :class="{ 'disabled': item.id === userId }"
                                                        :style="item.id === userId ? 'pointer-events: none; opacity: 0.5;' : ''">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" :class="{ 'show': permissionModal, 'd-block': permissionModal }" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true" v-if="permissionModal">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content permission-modal">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title m-0" id="permissionModalLabel"><i class="mdi mdi-shield-account-outline me-2"></i> Administrar Roles y Accesos</h5>
                                    <button type="button" class="btn-close btn-close-white" @click="permissionModal = false" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div v-if="selectUsuario">
                                        <div class="d-flex align-items-center gap-2 text-secondary fw-bold mb-2">
                                            <i class="mdi mdi-account-circle-outline fs-5"></i>
                                            <span>{{ selectUsuario.usuario }}</span>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <h6 class="section-title"><i class="mdi mdi-account-badge-outline me-2"></i>Rol</h6>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <button type="button" class="btn btn-outline-primary"
                                            v-for="role in roles" :key="role.id"
                                            :class="{'active btn-primary text-white': role.id === selectedItemRol}"
                                            style="border-radius: 50px;"
                                            @click="btnChipRol(role)">
                                            {{ role.name }}
                                        </button>
                                    </div>
                                    <div v-if="!selectedItemRol" class="alert alert-warning" role="alert">
                                        Seleccione un ROL
                                    </div>
                                    <hr class="mt-3 mb-2">
                                    <h6 class="fw-bold text-primary">SUCURSAL:</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div v-if="puntosVenta">
                                                <select id="selectPuntoVenta" v-model="selectPuntoVenta" @change="onChangePuntoVenta" class="form-control">
                                                    <option v-for="punto in puntosVenta" :value="punto.id" :key="punto.id">
                                                        {{ punto.nombre }} 
                                                    </option>
                                                </select>
                                            </div>
                                            <div v-else class="text-center">
                                                {{ puntosVenta }}
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 mb-0">
                                            <h6 class="section-title"><i class="mdi mdi-view-list-outline me-2"></i>Menús</h6>
                                            <div class="list-group">
                                                <button type="button" class="list-group-item list-group-item-action"
                                                    v-for="(menu, i) in menus" :key="i"
                                                    :class="{'active': i === selectedItemMenuIndex, 'disabled': !selectedItemRol}"
                                                    @click="btnItemMenu(menu, i)">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <span>{{ menu.label }}</span>
                                                        <small class="text-muted">({{ menu.progreso.countActive }}/{{ menu.progreso.total }})</small>
                                                    </div>
                                                    <div class="progress mt-2" style="height: 6px; border-radius: 4px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            :style="{ width: menu.progreso.porcentaje + '%' }"
                                                            :aria-valuenow="menu.progreso.porcentaje"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="section-title"><i class="mdi mdi-format-list-bulleted-square me-2"></i>Sub Menús</h6>
                                            <div v-if="subMenus && subMenus.length" class="mb-2">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <small class="text-muted">({{ subMenusProgress.countActive }}/{{ subMenusProgress.total }})</small>
                                                </div>
                                                <div class="progress mt-1" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        :style="{ width: subMenusProgress.porcentaje + '%' }"
                                                        :aria-valuenow="subMenusProgress.porcentaje"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="list-group scroll-submenu">
                                                <div v-if="subMenus">
                                                    <button type="button" class="list-group-item list-group-item-action"
                                                        v-for="(subMenu, j) in subMenus" :key="subMenu.id"
                                                        :class="{'active': j === selectedItemSubMenuIndex}"
                                                        @click="btnSelectSubMenu(subMenu, j)">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-truncate">{{ subMenu.label }}</span>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <small v-if="subMenu.children && subMenu.children.length" class="text-muted">({{ getProgress(subMenu).countActive }}/{{ getProgress(subMenu).total }})</small>
                                                                
                                                                <div class="form-check form-switch p-4">
                                                                    <input class="form-check-input ms-3" type="checkbox" role="switch"
                                                                        :id="'subMenuSwitch' + subMenu.id"
                                                                        :checked="subMenu.active"
                                                                        @change.stop="btnItemSubMenu(subMenu)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="subMenu.children && subMenu.children.length" class="mt-2">
                                                            <div class="progress" style="height: 4px; border-radius: 4px;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    :style="{ width: getProgress(subMenu).porcentaje + '%' }"
                                                                    :aria-valuenow="getProgress(subMenu).porcentaje"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="section-title"><i class="mdi mdi-subdirectory-arrow-right me-2"></i>Sub Menús N2</h6>
                                            <div class="list-group scroll-submenu">
                                                <div v-if="selectedItemSubMenuIndex === null && !subMenusN2" class="text-muted p-3">
                                                    Seleccione un sub menú.
                                                </div>
                                                <div v-else-if="subMenusN2 && subMenusN2.length">
                                                    <div class="list-group-item" v-for="child in subMenusN2" :key="child.id">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span>{{ child.label }}</span>
                                                            <div class="form-check form-switch m-0">
                                                                <input class="form-check-input ms-3" type="checkbox" role="switch"
                                                                    :id="'subMenuN2Switch' + child.id"
                                                                    :checked="child.active"
                                                                    @change="btnItemSubMenu(child)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="text-muted p-3">
                                                    No hay sub menús de segundo nivel.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer py-2">
                                    <button type="button" class="btn btn-light" @click="permissionModal = false">
                                        <i class="mdi mdi-close-circle-outline me-1"></i> Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endverbatim
    @endslot
    @slot('style')
        <style>
            .permission-modal .section-title { font-weight: 700; color: #0d6efd; display: flex; align-items: center; margin: 0 0 .5rem 0; }
            .permission-modal .scroll-submenu { max-height: 50vh; overflow-y: auto; }
            .permission-modal .list-group-item { border: 0; border-bottom: 1px solid #edf1f5; }
            .permission-modal .list-group-item:last-child { border-bottom: 0; }
            .permission-modal .list-group-item.active { background: #eef6ff; color: #0d6efd; border-color: transparent; }
            .permission-modal .form-check-input { cursor: pointer; }
        </style>
    @endslot
    @slot('script')
        <script type="module">
            import Block from "{{ asset('config/block.js') }}";
            const { createApp } = Vue;
            let block = new Block();

            const app = createApp({
                        data() {
                            return {
                                data: [],
                                search: '',
                                userId: {{ auth()->id() }},
                                loading: false,
                                // Datos para el modal de permisos
                                dialogPersmisos: null,
                                selectUsuario: null,
                                puntosVenta: null,
                                selectPuntoVenta: 0,
                                roles: null,
                                selectedItemRol: null,
                                menus: [],
                                selectedItemMenuIndex: null,
                                subMenus: null,
                                // Tercer nivel
                                selectedItemSubMenuIndex: null,
                                subMenusN2: null,
                                permissionModal:false,
                            };
                        },
                computed: {
                    filteredUsers() {
                        if (!this.search) {
                            return this.data;
                        }
                        const searchTerm = this.search.toLowerCase();
                        return this.data.filter(item => {
                            return (item.nombre && item.nombre.toLowerCase().includes(searchTerm)) ||
                                   (item.apellidos && item.apellidos.toLowerCase().includes(searchTerm)) ||
                                   (item.usuario && item.usuario.toLowerCase().includes(searchTerm)) ||
                                   (item.correo && item.correo.toLowerCase().includes(searchTerm));
                        });
                    },
                    subMenusProgress() {
                        const total = Array.isArray(this.subMenus) ? this.subMenus.length : 0;
                        const countActive = total ? this.subMenus.filter(s => !!s.active).length : 0;
                        const porcentaje = countActive === 0 || total === 0 ? 0 : (100 / (total / countActive));
                        return { porcentaje, countActive, total };
                    }
                },
                methods: {
                    getProgress(item) {
                        if (!item || !Array.isArray(item.children)) {
                            return { porcentaje: 0, countActive: 0, total: 0 };
                        }
                        const total = item.children.length;
                        const countActive = item.children.filter(c => !!c.active).length;
                        const porcentaje = total === 0 ? 0 : (countActive * 100) / total;
                        return { porcentaje, countActive, total };
                    },
                    async load() {
                        this.loading = true;
                        try {
                            const res = await axios.get("{{ url('api/users') }}");
                            this.data = res.data;
                        } catch (e) {
                            console.error("Error loading users:", e);
                        } finally {
                            this.loading = false;
                        }
                    },
                    deleteItem(id) {
                        if (id === this.userId) {
                            swal({
                                title: '¡Acción no permitida!',
                                text: 'No puedes eliminar tu propio usuario mientras estás logueado.',
                                icon: 'warning',
                                button: 'Aceptar'
                            });
                            return;
                        }

                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded me-3',
                            buttonsStyling: false,
                        });

                        swalWithBootstrapButtons({
                            title: '¿Estás seguro?',
                            text: "Este cambio es irreversible.",
                            type:'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Eliminar!',
                            cancelButtonText: 'No!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then(async (result) => {
                            if (result.value) {
                                try {
                                    let url = "{{ url('api/users') }}/" + id;
                                    await axios.delete(url);
                                    await this.load();
                                    swal({
                                        title: 'Eliminado!',
                                        text: 'El usuario ha sido eliminado.',
                                        icon: 'success',
                                        button: 'Aceptar'
                                    });
                                } catch (e) {
                                    if (e.response && e.response.data && e.response.data.error) {
                                        swal({
                                            title: 'Error',
                                            text: e.response.data.error,
                                            icon: 'error',
                                            button: 'Aceptar'
                                        });
                                    } else {
                                        swal({
                                            title: 'Error inesperado',
                                            text: 'No se pudo eliminar el usuario.',
                                            icon: 'error',
                                            button: 'Aceptar'
                                        });
                                    }
                                }
                            }
                        });
                    },
                    async btnQuitarAcceso(item) {
                        try {
                            const url = `{{ url('usuario/quitar-sistema') }}/${item.id}`;
                            const response = await axios.get(url);
                            if (response.data) {
                                swal("Acceso quitado!", response.data.message, "success");
                                this.load();
                            }
                        } catch (error) {
                            swal("Error!", "No se pudo quitar el acceso.", "error");
                        }
                    },
                    async btnAgregarSistema(item) {
                        try {
                            const url = `{{ url('usuario/agregar-sistema') }}/${item.id}`;
                            const response = await axios.get(url);
                            if (response.data) {
                                swal("Acceso agregado!", response.data.message, "success");
                                this.load();
                            }
                        } catch (error) {
                            swal("Error!", "No se pudo agregar al sistema.", "error");
                        }
                    },
                    async btnAccesosPermisos(item) {
                        this.selectUsuario = item;
                        this.selectedItemRol = null;
                        this.selectedItemMenuIndex = null;
                        this.subMenus = null;
                        this.menus = [];
                        // Inicializa y muestra el modal
                        this.permissionModal=true;
                        this.getPuntoVentaUser();
                        this.getPuntosVentas();
                        this.getRoles();
                    },
                    async getPuntoVentaUser() {
                        if (this.selectUsuario) {
                            var userId = this.selectUsuario.id;
                            axios
                              .get("{{ url('usuario/punto_venta_user') }}"+'/'+userId)
                              .then(response => {
                                var data = response.data;
                                if (data) {
                                  this.selectPuntoVenta = data.sucursal_id;
                                } else {
                                  this.selectPuntoVenta = null;
                                }
                              })
                              .catch(error => {
                                
                              })
                        }
                    },
                    async getPuntosVentas() {
                        try {
                            const response = await axios.get("{{ url('usuario/listar_punto_sesion') }}");
                            this.puntosVenta = response.data.data;
                        } catch (error) { 
                         this.puntosVenta=error.data.data;
                        }
                    },
                    async onChangePuntoVenta() {
                        if (this.selectUsuario) {
                            const userId = this.selectUsuario.id;
                            const puntosVentaId = this.selectPuntoVenta;
                            try {
                                await axios.get("{{ url('usuario/asignar-puntoventa/') }}"+'/'+userId+'/'+puntosVentaId);
                                swal("Asignacion Exitosa", "Se asigno la sucursal correctamente", "success");
                            } catch (error) { console.error('Error assigning punto de venta:', error); }
                        }
                    },
                    async getRoles() {
                        try {
                            const response = await axios.get("{{ url('usuario/rol-user/') }}"+'/'+this.selectUsuario.id);
                            this.roles = response.data.roles;
                            this.selectedItemRol = response.data.rolUser;
                            if (this.selectedItemRol) {
                                this.getMenuUser(this.selectedItemRol);
                            }
                        } catch (error) { console.error('Error fetching roles:', error); }
                    },
                    async btnChipRol(item) {
                        if (this.selectUsuario) {
                            const userId = this.selectUsuario.id;
                            const rolId = item.id;
                            const data = { rol_id: rolId, usuario_id: userId };
                            this.selectedItemMenuIndex = null;
                            this.subMenus = null;
                            try {
                                await axios.post("{{ url('usuario/rol-user') }}", data);
                                this.selectedItemRol = item.id;
                                this.getMenuUser(item.id);
                                swal("Rol cambiado!", "Se cambió el rol del usuario.", "success");
                            } catch (error) { console.error('Error assigning role:', error); }
                        }
                    },
                    btnItemMenu(item, index) {
                        this.selectedItemMenuIndex = index;
                        this.subMenus = item.sub_menu_n1;
                        // Reset selección de nivel 2
                        this.selectedItemSubMenuIndex = null;
                        this.subMenusN2 = null;
                    },
                    btnSelectSubMenu(item, index) {
                        this.selectedItemSubMenuIndex = index;
                        this.subMenusN2 = item.children || [];
                    },
                    async btnItemSubMenu(item) {
                        const estado_ = item.active;
                        if (this.selectedItemRol != null) {
                            const data = { menu_id: item.id, rol_id: this.selectedItemRol };
                            try {
                                await axios.post("{{ url('api/menu-rol') }}", data);
                                item.active = !estado_;
                                this.getMenuUser(this.selectedItemRol);
                            } catch (error) {
                                item.active = estado_;
                                swal("Error!", "No se pudo asignar el sub-menú.", "error");
                            }
                        } else {
                            swal("Error!", "Seleccione un rol primero.", "error");
                        }
                    },
                    async getMenuUser(rolId) {
                        try {
                            const response = await axios.get("{{ url('usuario/menu-rol') }}"+'/'+rolId);
                            this.menus = response.data.menus;
                        } catch (error) { console.error('Error fetching menus:', error); }
                    },
                },
                mounted() {
                    this.$nextTick(async () => { 
                        await this.load();
                        const message = sessionStorage.getItem('success_message');
                        if (message) {
                            swal({
                                title: "¡Éxito!",
                                text: message,
                                icon: "success",
                                button: "Aceptar"
                            });
                            sessionStorage.removeItem('success_message');
                        }
                    });
                },
            });
            app.mount('#meApp');
        </script>
    @endslot
@endcomponent
