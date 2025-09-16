@component('application')
    @slot('body')
        @verbatim
            <div id="meApp">
                <div id="block_ui">

                    <div class="action-btn layout-top-spacing mb-2">
                        <div class="page-header">
                            <div class="page-title">
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-grid">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                    Admin / Control Accesos / Roles y Permisos
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mx-auto">
                                <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <h4 class="card-title text-muted p-3">Gestión de Roles</h4>
                                    <button class="btn btn-primary btn-sm" @click="openModal('create')">
                                        <i class="mdi mdi-plus me-1"></i> Crear Rol
                                    </button>
                                </div>

                                <div class="p-3">
                                    <div class="role-grid">
                                        <div class="card role-card" v-for="role in roles" :key="role.id">
                                            <div class="card-body d-flex align-items-center justify-content-between py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="role-avatar me-3">
                                                        <i class="mdi mdi-account-badge-outline"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ role . name }}</div>
                                                        <small class="text-muted">ID: {{ role . id }}</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-light btn-sm border" title="Editar"
                                                        @click="openModal('update', role)"><i class="mdi mdi-pencil"></i></button>
                                                    <button class="btn btn-light btn-sm border text-danger" title="Eliminar"
                                                        @click="deleteRole(role.id)"><i class="mdi mdi-delete-forever"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <h4 class="card-title text-muted p-3">Menús</h4>
                                    <button class="btn btn-primary" @click="btnNuevoMenu(0)">
                                        <i class="mdi mdi-plus me-1"></i> Nuevo
                                    </button>
                                </div>

                                <div class="card-body">
                                    <!-- Agregar breadcrumb aquí -->
                                    <div class="menu-breadcrumb">
                                        <span class="menu-breadcrumb-item" :class="{ active: !selectedPath.length }">
                                            <i class="mdi mdi-menu"></i> Menú Principal
                                        </span>
                                        <template v-for="(item, index) in selectedPath" :key="index">
                                            <span class="menu-breadcrumb-item"
                                                :class="{ active: index === selectedPath.length - 1 }">
                                                <i :class="getMdiClass(item.icon_mdi)"></i> {{ item . label }}
                                            </span>
                                        </template>
                                    </div>

                                    <div class="menu-container">
                                        <div class="levels" :class="levelContainerClass">
                                            <div class="level-col" v-for="(col, idx) in columns" :key="'col-' + idx">
                                                <!-- Reemplazar el header de cada columna con: -->
                                                <div class="level-header d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="mb-0 text-muted">
                                                        {{ idx === 0 ? 'Menú Principal' : (selectedPath[idx - 1] ? selectedPath[idx - 1] . label : `Nivel ${idx + 1}`) }}
                                                    </h6>
                                                    <button class="btn btn-primary btn-sm" v-if="showAddButton(idx)"
                                                        @click="btnNuevoMenu(getParentIdForLevel(idx))">
                                                        <i class="mdi mdi-plus"></i>
                                                    </button>
                                                </div>

                                                <draggable :list="col" item-key="id" v-bind="dragOptions"
                                                    :move="checkMoveMenu" handle=".handle" tag="div" class="level-list">
                                                    <template #item="{ element: item }">
                                                        <div class="mini-card"
                                                            :class="{
                                                                'selected': selectedPath[idx] && selectedPath[idx]
                                                                    .id === item
                                                                    .id
                                                            }"
                                                            @click="onSelect(idx, item)">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="handle cursor-move">
                                                                        <i class="mdi mdi-drag-vertical text-muted"></i>
                                                                    </span>
                                                                    <i :class="getMdiClass(item.icon_mdi)"
                                                                        class="text-primary"></i>
                                                                    <span class="fw-medium">{{ item . label }}</span>
                                                                </div>
                                                                <div class="d-flex gap-1">
                                                                    <button class="btn btn-light btn-sm"
                                                                        @click.stop="btnItemMenuEdit(item)">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </button>
                                                                    <button class="btn btn-light btn-sm text-danger"
                                                                        @click.stop="btnItemMenuDelete(item)">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </draggable>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" :class="{ 'show d-block': showModal }" tabindex="-1" role="dialog"
                        style="background-color: rgba(0,0,0,0.5);" aria-hidden="true" v-if="showModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ modalTitle }}</h5>
                                    <button type="button" class="btn-close" @click="showModal = false"><i
                                            class="mdi mdi-close"></i></button>
                                </div>
                                <form @submit.prevent="saveRol">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="roleName" class="form-label">Nombre del Rol</label>
                                            <input type="text" class="form-control" id="roleName" v-model="roleForm.name"
                                                required>
                                            <div v-if="errors.name" class="text-danger">{{ errors . name[0] }}</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            @click="showModal = false">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" :class="{ 'show': dialogMenu, 'd-block': dialogMenu }" tabindex="-1" role="dialog"
                        style="background-color: rgba(0,0,0,0.5);" aria-hidden="true" v-if="dialogMenu">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form @submit.prevent="submitMenu" ref="formMenu">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            {{ isFormMenuEdit ? 'Editar ' : 'Nuevo ' }}
                                            {{ menuNivel == 0 ? 'menu' : 'sub menu' }}
                                        </h5>
                                        <button type="button" class="btn-close" @click="dialogMenu = false"><i
                                                class="mdi mdi-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3" v-if="itemSelectMenu && menuNivel != 0">
                                            <label for="menuPadre" class="form-label">Menú</label>
                                            <input type="text" class="form-control" id="menuPadre"
                                                :value="itemSelectMenu.label" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombreMenu" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombreMenu" v-model="formMenu.label"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="rutaMenu" class="form-label">Ruta</label>
                                            <input type="text" class="form-control" id="rutaMenu" v-model="formMenu.route">
                                        </div>

                                        <div class="mb-3">
                                            <label for="iconoMenu" class="form-label">Ícono</label>
                                            <div class="icon-preview mb-2">
                                                <i :class="getMdiClass(formMenu.icon)" class="fs-3"></i>
                                                <small>Vista previa</small>
                                            </div>
                                            <select ref="selectIcon" class="form-control select2-icons" id="iconoMenu"
                                                v-model="formMenu.icon" required>
                                                <option disabled value="">Seleccione un ícono</option>
                                                <option v-for="item in menuList" :value="item.icon" :data-icon="item.icon">
                                                    {{ item .icon }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            @click="dialogMenu = false">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" :disabled="btnLoadingMenu">
                                            <span v-if="btnLoadingMenu" class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            {{ isFormMenuEdit ? 'GUARDAR CAMBIOS' : 'GUARDAR' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endverbatim
    @endslot

    @slot('script')
        <script type="module">
            import TableDate from "{{ asset('config/dtdate.js') }}"
            import Block from "{{ asset('config/block.js') }}"

            const {
                createApp
            } = Vue
            const draggable = vuedraggable;

            let dt = new TableDate()
            let block = new Block()

            createApp({
                components: {
                    draggable
                },
                data() {
                    return {
                        roles: [],
                        menus: [],
                        subMenus: [],
                        itemSelectSubMenu: null,
                        grandMenus: [],
                        selectedPath: [],
                        roleForm: {
                            id: null,
                            name: ''
                        },
                        modalTitle: '',
                        editMode: false,
                        errors: {},
                        showModal: false,
                        itemSelectMenu: null,
                        dragOptions: {
                            animation: 200
                        },
                        dragMenu: false,
                        dragSubMenu: false,
                        dialogMenu: false,
                        validMenu: false,
                        isFormMenuEdit: false,
                        formMenu: {
                            label: null,
                            icon: null,
                            route: null,
                        },
                        btnLoadingMenu: false,
                        dataMenuDelete: null,
                        menuNivel: null,
                        menuList: [],
                    }
                },
                mounted() {
                    this.init()
                },
                methods: {
                    async init() {
                        // Muestra el bloqueo mientras cargan roles y menús (con guardas)
                        try {
                            block.block()
                        } catch (e) {}
                        try {
                            await Promise.all([this.getRoles(), this.getMenus()])
                            this.loadMenu()
                        } finally {
                            // Oculta el bloqueo cuando todo terminó (éxito o error)
                            try {
                                block.unblock()
                            } catch (e) {}
                        }
                    },

                    async getRoles() {
                        block.block();
                        try {
                            const res = await axios.get("{{ url('api/rol') }}")
                            this.roles = res.data
                        } catch (e) {
                            // opcional: manejar error
                        } finally {
                            // block.unblock()

                        }
                    },
                    async getMenus() {
                        block.block();
                        try {

                            const res = await axios.get("{{ url('api/menu') }}")
                            this.menus = res.data
                            this.rebuildSelection()
                        } catch (e) {
                            // opcional: manejar error
                        } finally{
                            block.unblock();
                        }
                    },
                    openModal(action, role = null) {
                        this.showModal = true
                        this.errors = {}
                        if (action === 'create') {
                            this.editMode = false
                            this.modalTitle = 'Crear Nuevo Rol'
                            this.roleForm = {
                                id: null,
                                name: ''
                            }
                        } else {
                            this.editMode = true
                            this.modalTitle = 'Editar Rol'
                            this.roleForm = {
                                ...role
                            }
                        }
                    },
                    vaciarModal() {
                        this.showModal = false
                        this.editMode = false
                        this.modalTitle = ''
                        this.roleForm = {}
                    },
                    async saveRol() {
                        if (!this.roleForm.name.trim()) {
                            this.errors = {
                                name: ['El nombre del rol es obligatorio.']
                            }
                            return
                        }
                        try {
                            if (this.editMode) {
                                await axios.put("{{ url('api/rol/') }}" + '/' + this.roleForm.id, this.roleForm)
                                swal({
                                    title: 'Rol Actualizado',
                                    text: 'Se actualizó el rol',
                                    icon: 'warning',
                                    type: 'warning',
                                    button: 'Aceptar'
                                })
                            } else {
                                await axios.post("{{ url('api/rol') }}", this.roleForm)
                                swal({
                                    title: 'Rol creado',
                                    text: 'Se creó el rol respectivo',
                                    icon: 'success',
                                    type: 'success',
                                    button: 'Aceptar'
                                })
                            }
                            this.vaciarModal();
                            this.getRoles();
                        } catch (e) {
                            swal({
                                title: 'Error',
                                text: "Registro duplicado",
                                icon: 'error',
                                type: 'error',
                                button: 'Aceptar'
                            })
                        }
                    },
                    btnItemMenu(item) {
                        this.onSelect(0, item)
                    },
                    btnItemSubMenu(item) {
                        this.onSelect(1, item)
                    },
                    btnNuevoMenu(parentOrZero) {
                        // parentOrZero: 0 para raíz, o ID del padre
                        const parentId = parentOrZero === 0 ? null : parentOrZero;
                        const parent = parentId ? this.findMenuById(parentId) : null;
                        const parentIndex = parent ? (this.selectedPath.findIndex(p => p && p.id === parent.id)) : -1;
                        const computedLevel = parent ? ((parent.level != null ? parent.level : parentIndex) + 1) : 0;

                        this.menuNivel = parentId ? parentId : 0; // conservar comportamiento previo

                        this.formMenu = {
                            label: null,
                            icon: null,
                            route: null,
                            menu_id: parentId,
                            level: computedLevel
                        };

                        this.isFormMenuEdit = false;
                        this.dialogMenu = true;
                        this.$nextTick(() => {
                            this.initSelect2Icons();
                        });
                    },
                    btnNuevoSubMenu(menuId) {
                        const menu = this.menus.find(m => m.id === menuId)
                        if (!menu) return
                        const nuevo = {
                            id: Date.now(),
                            label: "Nuevo Submenú",
                            icon_mdi: "file",
                            order: menu.sub_menu_n1.length + 1,
                            parent_id: menuId
                        }
                        menu.sub_menu_n1.push(nuevo)
                        this.subMenus = menu.sub_menu_n1
                    },
                    checkMoveMenu(e) {
                        var data = {
                            dragged_id: e.draggedContext.element.id,
                            dragged_order: e.draggedContext.element.order,
                            related_id: e.relatedContext.element.id,
                            related_order: e.relatedContext.element.order,
                        };
                        axios.post("{{ url('api/menu/change/cambiar-orden') }}", data)
                            .then((response) => {})
                            .catch((error) => {})
                    },
                    loadMenu() {
                        this.menuList = [{
                                icon: "account",
                                text: "Account"
                            },
                            {
                                icon: "account-box",
                                text: "Account Box"
                            },
                            {
                                icon: "account-box-multiple",
                                text: "Account Box Multiple"
                            },
                            {
                                icon: "account-box-outline",
                                text: "Account Box Outline"
                            },
                            {
                                icon: "account-check",
                                text: "Account Check"
                            },
                            {
                                icon: "account-check-outline",
                                text: "Account Check Outline"
                            },
                            {
                                icon: "account-circle",
                                text: "Account Circle"
                            },
                            {
                                icon: "account-circle-outline",
                                text: "Account Circle Outline"
                            },
                            {
                                icon: "account-details",
                                text: "Account Details"
                            },
                            {
                                icon: "account-multiple",
                                text: "Account Multiple"
                            },
                            {
                                icon: "account-multiple-minus",
                                text: "Account Multiple Minus"
                            },
                            {
                                icon: "account-multiple-minus-outline",
                                text: "Account Multiple Minus Outline"
                            },
                            {
                                icon: "account-multiple-plus",
                                text: "Account Multiple Plus"
                            },
                            {
                                icon: "account-multiple-plus-outline",
                                text: "Account Multiple Plus Outline"
                            },
                            {
                                icon: "account-music",
                                text: "Account Music"
                            },
                            {
                                icon: "account-outline",
                                text: "Account Outline"
                            },
                            {
                                icon: "account-plus",
                                text: "Account Plus"
                            },
                            {
                                icon: "account-supervisor",
                                text: "Account Supervisor"
                            },
                            {
                                icon: "account-supervisor-circle",
                                text: "Account Supervisor Circle"
                            },
                            {
                                icon: "account-supervisor-circle-outline",
                                text: "Account Supervisor Circle Outline"
                            },
                            {
                                icon: "account-voice",
                                text: "Account Voice"
                            },
                            {
                                icon: "account-voice-off",
                                text: "Account Voice Off"
                            },
                            {
                                icon: "air-purifier",
                                text: "Air Purifier"
                            },
                            {
                                icon: "alarm",
                                text: "Alarm"
                            },
                            {
                                icon: "alarm-check",
                                text: "Alarm Check"
                            },
                            {
                                icon: "alarm-off",
                                text: "Alarm Off"
                            },
                            {
                                icon: "alarm-plus",
                                text: "Alarm Plus"
                            },
                            {
                                icon: "alarm-snooze",
                                text: "Alarm Snooze"
                            },
                            {
                                icon: "alert",
                                text: "Alert"
                            },
                            {
                                icon: "alert-circle",
                                text: "Alert Circle"
                            },
                            {
                                icon: "alert-circle-outline",
                                text: "Alert Circle Outline"
                            },
                            {
                                icon: "alert-decagram",
                                text: "Alert Decagram"
                            },
                            {
                                icon: "alert-octagon",
                                text: "Alert Octagon"
                            },
                            {
                                icon: "align-horizontal-center",
                                text: "Align Horizontal Center"
                            },
                            {
                                icon: "align-horizontal-distribute",
                                text: "Align Horizontal Distribute"
                            },
                            {
                                icon: "align-horizontal-left",
                                text: "Align Horizontal Left"
                            },
                            {
                                icon: "align-vertical-bottom",
                                text: "Align Vertical Bottom"
                            },
                            {
                                icon: "align-vertical-center",
                                text: "Align Vertical Center"
                            },
                            {
                                icon: "all-inclusive",
                                text: "All Inclusive"
                            },
                            {
                                icon: "anchor",
                                text: "Anchor"
                            },
                            {
                                icon: "android",
                                text: "Android"
                            },
                            {
                                icon: "android-messages",
                                text: "Android Messages"
                            },
                            {
                                icon: "android-studio",
                                text: "Android Studio"
                            },
                            {
                                icon: "animation",
                                text: "Animation"
                            },
                            {
                                icon: "animation-play",
                                text: "Animation Play"
                            },
                            {
                                icon: "antenna",
                                text: "Antenna"
                            },
                            {
                                icon: "api",
                                text: "Api"
                            },
                            {
                                icon: "apps",
                                text: "Apps"
                            },
                            {
                                icon: "apps-box",
                                text: "Apps Box"
                            },
                            {
                                icon: "arrow-bottom-left-thin-circle-outline",
                                text: "Arrow Bottom Left Thin Circle Outline"
                            },
                            {
                                icon: "arrow-bottom-right-thin-circle-outline",
                                text: "Arrow Bottom Right Thin Circle Outline"
                            },
                            {
                                icon: "arrow-collapse-horizontal",
                                text: "Arrow Collapse Horizontal"
                            },
                            {
                                icon: "arrow-collapse-vertical",
                                text: "Arrow Collapse Vertical"
                            },
                            {
                                icon: "arrow-down-drop-circle",
                                text: "Arrow Down Drop Circle"
                            },
                            {
                                icon: "arrow-down-thin-circle-outline",
                                text: "Arrow Down Thin Circle Outline"
                            },
                            {
                                icon: "arrow-right",
                                text: "Arrow Right"
                            },
                            {
                                icon: "arrow-right-thin-circle-outline",
                                text: "Arrow Right Thin Circle Outline"
                            },
                            {
                                icon: "arrow-top-left-thin-circle-outline",
                                text: "Arrow Top Left Thin Circle Outline"
                            },
                            {
                                icon: "arrow-top-right-thin-circle-outline",
                                text: "Arrow Top Right Thin Circle Outline"
                            },
                            {
                                icon: "arrow-up-thin-circle-outline",
                                text: "Arrow Up Thin Circle Outline"
                            },
                            {
                                icon: "aspect-ratio",
                                text: "Aspect Ratio"
                            },
                            {
                                icon: "assistant",
                                text: "Assistant"
                            },
                            {
                                icon: "at",
                                text: "At"
                            },
                            {
                                icon: "atm",
                                text: "Atm"
                            },
                            {
                                icon: "attachment",
                                text: "Attachment"
                            },
                            {
                                icon: "auto-fix",
                                text: "Auto Fix"
                            },
                            {
                                icon: "auto-upload",
                                text: "Auto Upload"
                            },
                            {
                                icon: "autorenew",
                                text: "Autorenew"
                            },
                            {
                                icon: "av-timer",
                                text: "Av Timer"
                            },
                            {
                                icon: "baby-carriage",
                                text: "Baby Carriage"
                            },
                            {
                                icon: "baby-face",
                                text: "Baby Face"
                            },
                            {
                                icon: "backspace",
                                text: "Backspace"
                            },
                            {
                                icon: "backspace-outline",
                                text: "Backspace Outline"
                            },
                            {
                                icon: "backup-restore",
                                text: "Backup Restore"
                            },
                            {
                                icon: "badge-account-horizontal",
                                text: "Badge Account Horizontal"
                            },
                            {
                                icon: "badge-account-horizontal-outline",
                                text: "Badge Account Horizontal Outline"
                            },
                            {
                                icon: "bag-checked",
                                text: "Bag Checked"
                            },
                            {
                                icon: "bag-suitcase",
                                text: "Bag Suitcase"
                            },
                            {
                                icon: "bag-suitcase-off",
                                text: "Bag Suitcase Off"
                            },
                            {
                                icon: "balcony",
                                text: "Balcony"
                            },
                            {
                                icon: "ballot",
                                text: "Ballot"
                            },
                            {
                                icon: "ballot-outline",
                                text: "Ballot Outline"
                            },
                            {
                                icon: "bandage",
                                text: "Bandage"
                            },
                            {
                                icon: "bank",
                                text: "Bank"
                            },
                            {
                                icon: "barrel",
                                text: "Barrel"
                            },
                            {
                                icon: "barrel-outline",
                                text: "Barrel Outline"
                            },
                            {
                                icon: "basket",
                                text: "Basket"
                            },
                            {
                                icon: "basket-outline",
                                text: "Basket Outline"
                            },
                            {
                                icon: "basketball",
                                text: "Basketball"
                            },
                            {
                                icon: "bed-outline",
                                text: "Bed Outline"
                            },
                            {
                                icon: "bee",
                                text: "Bee"
                            },
                            {
                                icon: "bee-flower",
                                text: "Bee Flower"
                            },
                            {
                                icon: "bell",
                                text: "Bell"
                            },
                            {
                                icon: "bell-circle",
                                text: "Bell Circle"
                            },
                            {
                                icon: "bell-circle-outline",
                                text: "Bell Circle Outline"
                            },
                            {
                                icon: "bell-off",
                                text: "Bell Off"
                            },
                            {
                                icon: "bell-off-outline",
                                text: "Bell Off Outline"
                            },
                            {
                                icon: "bell-outline",
                                text: "Bell Outline"
                            },
                            {
                                icon: "bell-ring",
                                text: "Bell Ring"
                            },
                            {
                                icon: "bell-ring-outline",
                                text: "Bell Ring Outline"
                            },
                            {
                                icon: "bell-sleep-outline",
                                text: "Bell Sleep Outline"
                            },
                            {
                                icon: "bike",
                                text: "Bike"
                            },
                            {
                                icon: "blender",
                                text: "Blender"
                            },
                            {
                                icon: "blinds-horizontal",
                                text: "Blinds Horizontal"
                            },
                            {
                                icon: "blur",
                                text: "Blur"
                            },
                            {
                                icon: "book-variant",
                                text: "Book Variant"
                            },
                            {
                                icon: "bookmark",
                                text: "Bookmark"
                            },
                            {
                                icon: "bookmark-check",
                                text: "Bookmark Check"
                            },
                            {
                                icon: "bookmark-multiple",
                                text: "Bookmark Multiple"
                            },
                            {
                                icon: "bookmark-outline",
                                text: "Bookmark Outline"
                            },
                            {
                                icon: "bookmark-check",
                                text: "Bookmark Check"
                            },
                            {
                                icon: "briefcase-outline",
                                text: "Briefcase Outline"
                            },
                            {
                                icon: "briefcase-variant",
                                text: "Briefcase Variant"
                            },
                            {
                                icon: "briefcase-variant-outline",
                                text: "Briefcase Variant Outline"
                            },
                            {
                                icon: "brush",
                                text: "Brush"
                            },
                            {
                                icon: "cached",
                                text: "Cached"
                            },
                            {
                                icon: "cake-variant",
                                text: "Cake Variant"
                            },
                            {
                                icon: "calculator-variant-outline",
                                text: "Calculator Variant Outline"
                            },
                            {
                                icon: "calendar",
                                text: "Calendar"
                            },
                            {
                                icon: "calendar-blank-outline",
                                text: "Calendar Blank Outline"
                            },
                            {
                                icon: "calendar-check",
                                text: "Calendar Check"
                            },
                            {
                                icon: "chart-box",
                                text: "Chart Box"
                            },
                            {
                                icon: "chart-box-plus-outline",
                                text: "Chart Box Plus Outline"
                            },
                            {
                                icon: "check",
                                text: "Check"
                            },
                            {
                                icon: "check-circle",
                                text: "Check Circle"
                            },
                            {
                                icon: "check-circle-outline",
                                text: "Check Circle Outline"
                            },
                            {
                                icon: "check-outline",
                                text: "Check Outline"
                            },
                            {
                                icon: "checkbook",
                                text: "Checkbook"
                            },
                            {
                                icon: "checkbox-marked",
                                text: "Checkbox Marked"
                            },
                            {
                                icon: "chevron-right",
                                text: "Chevron Right"
                            },
                            {
                                icon: "chevron-left",
                                text: "Chevron Left"
                            },
                            {
                                icon: "clipboard-account",
                                text: "Clipboard Account"
                            },
                            {
                                icon: "clipboard-alert",
                                text: "Clipboard Alert"
                            },
                            {
                                icon: "clipboard-arrow-down-outline",
                                text: "Clipboard Arrow Down Outline"
                            },
                            {
                                icon: "clipboard-text",
                                text: "Clipboard Text"
                            },
                            {
                                icon: "close-circle-outline",
                                text: "Close Circle Outline"
                            },
                            {
                                icon: "cloud-download-outline",
                                text: "Cloud Download Outline"
                            },
                            {
                                icon: "cloud-download",
                                text: "Cloud Download"
                            },
                            {
                                icon: "cloud-off-outline",
                                text: "Cloud Off Outline"
                            },
                            {
                                icon: "cloud-outline",
                                text: "Cloud Outline"
                            },
                            {
                                icon: "cog",
                                text: "Cog"
                            },
                            {
                                icon: "cogs",
                                text: "Cogs"
                            },
                            {
                                icon: "contacts",
                                text: "Contacts"
                            },
                            {
                                icon: "content-paste",
                                text: "Content Paste"
                            },
                            {
                                icon: "delete",
                                text: "Delete"
                            },
                            {
                                icon: "devices",
                                text: "Devices"
                            },
                            {
                                icon: "download",
                                text: "Download"
                            },
                            {
                                icon: "earth",
                                text: "Earth"
                            },
                            {
                                icon: "elevator-passenger-outline",
                                text: "Elevator Passenger Outline"
                            },
                            {
                                icon: "email-outline",
                                text: "Email Outline"
                            },
                            {
                                icon: "equalizer",
                                text: "Equalizer"
                            },
                            {
                                icon: "eye-off",
                                text: "Eye Off"
                            },
                            {
                                icon: "face-man",
                                text: "Face Man"
                            },
                            {
                                icon: "file-outline",
                                text: "File Outline"
                            },
                            {
                                icon: "finance",
                                text: "Finance"
                            },
                            {
                                icon: "folder",
                                text: "Folder"
                            },
                            {
                                icon: "folder-account",
                                text: "Folder Account"
                            },
                            {
                                icon: "folder-account-outline",
                                text: "Folder Account Outline"
                            },
                            {
                                icon: "folder-move",
                                text: "Folder Move"
                            },
                            {
                                icon: "folder-outline",
                                text: "Folder Outline"
                            },
                            {
                                icon: "folder-plus-outline",
                                text: "Folder Plus Outline"
                            },
                            {
                                icon: "google-my-business",
                                text: "Google My Business"
                            },
                            {
                                icon: "help-circle",
                                text: "Help Circle"
                            },
                            {
                                icon: "home",
                                text: "Home"
                            },
                            {
                                icon: "inbox-multiple",
                                text: "Inbox Multiple"
                            },
                            {
                                icon: "information-outline",
                                text: "Information Outline"
                            },
                            {
                                icon: "label-outline",
                                text: "Label Outline"
                            },
                            {
                                icon: "label-off-outline",
                                text: "Label Off Outline"
                            },
                            {
                                icon: "label-variant",
                                text: "Label Variant"
                            },
                            {
                                icon: "lead-pencil",
                                text: "Lead Pencil"
                            },
                            {
                                icon: "library",
                                text: "Library"
                            },
                            {
                                icon: "list-status",
                                text: "List Status"
                            },
                            {
                                icon: "lock-outline",
                                text: "Lock Outline"
                            },
                            {
                                icon: "message-badge",
                                text: "Message Badge"
                            },
                            {
                                icon: "message-badge-outline",
                                text: "Message Badge Outline"
                            },
                            {
                                icon: "message-bulleted",
                                text: "Message Bulleted"
                            },
                            {
                                icon: "newspaper-variant",
                                text: "Newspaper Variant"
                            },
                            {
                                icon: "picture-in-picture-bottom-right",
                                text: "Picture In Picture Bottom Right"
                            },
                            {
                                icon: "refresh",
                                text: "Refresh"
                            },
                            {
                                icon: "shield-account-variant",
                                text: "Shield Account Variant"
                            },
                            {
                                icon: "shield-check",
                                text: "Shield Check"
                            },
                            {
                                icon: "shield-plus",
                                text: "Shield Plus"
                            },
                            {
                                icon: "shield-search",
                                text: "Shield Search"
                            },
                            {
                                icon: "star-circle",
                                text: "Star Circle"
                            },
                            {
                                icon: "star-face",
                                text: "Star Face"
                            },
                            {
                                icon: "sticker-emoji",
                                text: "Sticker Emoji"
                            },
                            {
                                icon: "weather-windy-variant",
                                text: "Weather Windy Variant"
                            }
                        ]
                    },
                    onSelect(level, item) {
                        const path = this.selectedPath.slice(0, level)
                        path[level] = item
                        this.selectedPath = path

                        // Actualizar selección del primer nivel
                        this.itemSelectMenu = this.selectedPath[0] || null
                        this.subMenus = this.itemSelectMenu ? this.getChildren(this.itemSelectMenu) : []

                        // Actualizar selección del segundo nivel
                        this.itemSelectSubMenu = this.selectedPath[1] || null
                        this.grandMenus = this.itemSelectSubMenu ? this.getChildren(this.itemSelectSubMenu) : []

                        // Actualizar la propiedad level del ítem seleccionado
                        if (item) {
                            item.level = level;
                        }
                    },
                    getChildren(item) {
                        if (!item) return []

                        // Asegurarse de que los hijos tengan el nivel correcto
                        const children = item.sub_menu_n1 ? item.sub_menu_n1 : (item.children || []);
                        const parentLevel = item.level || 0;

                        return children.map(child => {
                            return {
                                ...child,
                                level: parentLevel + 1
                            };
                        });
                    },
                    rebuildSelection() {
                        const ids = (this.selectedPath || []).map(i => i && i.id).filter(Boolean)
                        const newPath = []
                        let list = this.menus || []
                        for (let i = 0; i < ids.length; i++) {
                            const id = ids[i]
                            const found = (list || []).find(x => x.id == id)
                            if (!found) break
                            newPath.push(found)
                            list = this.getChildren(found)
                        }
                        this.selectedPath = newPath
                        this.itemSelectMenu = this.selectedPath[0] || null
                        this.subMenus = this.itemSelectMenu ? this.getChildren(this.itemSelectMenu) : []
                        this.itemSelectSubMenu = this.selectedPath[1] || null
                        this.grandMenus = this.itemSelectSubMenu ? this.getChildren(this.itemSelectSubMenu) : []
                    },
                    btnItemMenuEdit(item) {
                        this.isFormMenuEdit = true;
                        this.dialogMenu = true;
                        this.formMenu = {
                            ...item
                        };
                        const current = item.icon_mdi || ''
                        this.formMenu.icon = current.replace(/^mdi-/, '')
                        this.$nextTick(() => {
                            this.initSelect2Icons();
                            if (this.$refs.selectIcon && window.jQuery) {
                                const $el = window.jQuery(this.$refs.selectIcon);
                                if ($el.length && $el.data('select2')) {
                                    $el.val(this.formMenu.icon).trigger('change.select2');
                                }
                            }
                        });
                    },

                    submitMenu: function() {
                        this.btnLoadingMenu = true;
                        const dataForm = this.formMenu;

                        if (this.isFormMenuEdit) {
                            const urlEdit = "{{ url('api/menu') }}/" + dataForm.id;
                            const dataUpdate = {
                                ...dataForm,
                                icon: this.normalizeIcon(dataForm.icon)
                            };
                            axios
                                .put(urlEdit, dataUpdate)
                                .then((response) => {
                                    this.getMenus();
                                    this.dialogMenu = false;
                                    this.btnLoadingMenu = false;
                                    this.snackbar = {
                                        status: true,
                                        text: "Registro Editado",
                                        color: "primary"
                                    };
                                })
                                .catch((error) => {
                                    this.btnLoadingMenu = false;
                                });
                        } else {
                            const dataSend = {
                                ...dataForm,
                                icon: this.normalizeIcon(dataForm.icon)
                            };

                            // Obtener el padre
                            const parent = this.findMenuById(this.menuNivel);

                            // Validar si se puede agregar más elementos a este nivel
                            if (parent && !this.canAddChild(parent)) {
                                swal({
                                    title: 'Límite alcanzado',
                                    text: 'No se pueden agregar más elementos en este nivel',
                                    icon: 'warning',
                                    button: 'Aceptar'
                                });
                                this.btnLoadingMenu = false;
                                return;
                            }

                            if (this.menuNivel === 0) {
                                dataSend.menu_id = null;
                                dataSend.level = 0;
                                dataSend.order = this.menus.length + 1;
                            } else {
                                dataSend.menu_id = this.menuNivel;
                                const parentLevel = parent && parent.level != null ? parent.level : 0;
                                dataSend.level = parentLevel + 1;

                                if (parentLevel === 0) {
                                    dataSend.order = this.subMenus.length + 1;
                                } else {
                                    dataSend.order = (this.grandMenus ? this.grandMenus.length : 0) + 1;
                                }
                            }

                            axios
                                .post("{{ url('api/menu') }}", dataSend)
                                .then((response) => {
                                    // Actualizar las colecciones correspondientes
                                    if (this.menuNivel === 0) {
                                        this.menus.push(response.data);
                                    } else {
                                        const parent = this.findMenuById(this.menuNivel);
                                        if (parent) {
                                            if (!parent.sub_menu_n1) parent.sub_menu_n1 = [];
                                            parent.sub_menu_n1.push(response.data);

                                            // Actualizar las colecciones según el nivel
                                            if ((parent.level ?? 0) === 0) {
                                                if (!this.subMenus) this.subMenus = [];
                                                this.subMenus.push(response.data);
                                            } else {
                                                if (!this.grandMenus) this.grandMenus = [];
                                                this.grandMenus.push(response.data);
                                            }
                                        }
                                    }

                                    this.getMenus();
                                    this.dialogMenu = false;
                                    this.btnLoadingMenu = false;
                                    this.snackbar = {
                                        status: true,
                                        text: "Nuevo Registro",
                                        color: "primary"
                                    };
                                })
                                .catch((error) => {
                                    this.btnLoadingMenu = false;
                                    swal({
                                        title: 'Error',
                                        text: 'No se pudo crear el menú',
                                        icon: 'error',
                                        button: 'Aceptar'
                                    });
                                });
                        }
                    },
                    normalizeIcon(icon) {
                        const val = icon || ''
                        return val.startsWith('mdi-') ? val : `mdi-${val}`
                    },
                    async btnItemMenuDelete(item) {
                        try {
                            const will = await swal({
                                title: 'Desactivar',
                                text: `¿Desea desactivar "${item.label}"?`,
                                type: 'warning',
                                buttons: ['Cancelar', 'Sí'],
                                dangerMode: true
                            });
                            if (!will) return;
                            await axios.delete(`{{ url('api/menu') }}/${item.id}`)
                            // limpiar selección si aplica
                            if (this.itemSelectMenu && this.itemSelectMenu.id === item.id) {
                                this.itemSelectMenu = null;
                                this.subMenus = [];
                                this.itemSelectSubMenu = null;
                                this.grandMenus = [];
                            }
                            if (this.itemSelectSubMenu && this.itemSelectSubMenu.id === item.id) {
                                this.itemSelectSubMenu = null;
                                this.grandMenus = [];
                            }
                            await this.getMenus();
                            swal({
                                title: 'Hecho',
                                text: 'Menú desactivado',
                                icon: 'success',
                                button: 'OK'
                            });
                        } catch (e) {
                            swal({
                                title: 'Error',
                                text: 'No se pudo desactivar',
                                icon: 'error',
                                button: 'Aceptar'
                            });
                        }
                    },
                    getMdiClass(iconOrSlug) {
                        const val = iconOrSlug || ''
                        const slug = val.startsWith('mdi-') ? val : (val ? `mdi-${val}` : '')
                        return slug ? `mdi ${slug}` : ''
                    },
                    initSelect2Icons() {
                        const el = this.$refs.selectIcon;
                        if (!el || !window.jQuery) return;
                        const $el = window.jQuery(el);
                        try {
                            if ($el.data('select2')) {
                                $el.select2('destroy');
                            }
                        } catch (e) {}
                        const self = this;
                        // Usar .modal-content como parent para evitar que el dropdown tome el ancho de toda la ventana (.modal)
                        const $parent = window.jQuery(this.$refs.selectIcon).closest('.modal-content');
                        $el.select2({
                            width: '100%',
                            dropdownParent: $parent.length ? $parent : undefined,
                            dropdownAutoWidth: true,
                            templateResult: function(state) {
                                if (!state.id) return state.text;
                                const icon = state.element && state.element.dataset ? state.element.dataset
                                    .icon : '';
                                const cls = icon ? `mdi mdi-${icon}` : '';
                                const label = state.text || icon || '';
                                return window.jQuery(
                                    `<span class="s2-icon-option" title="${label}"><i class="${cls}"></i></span>`
                                );
                            },
                            templateSelection: function(state) {
                                if (!state.id) return state.text;
                                const icon = state.element && state.element.dataset ? state.element.dataset
                                    .icon : '';
                                const cls = icon ? `mdi mdi-${icon}` : '';
                                const label = state.text || icon || '';
                                return window.jQuery(
                                    `<span class="s2-icon-option" title="${label}"><i class="${cls}"></i></span>`
                                );
                            },
                            escapeMarkup: function(m) {
                                return m;
                            },
                            placeholder: 'Seleccione un ícono',
                        }).on('change', function() {
                            const val = $el.val();
                            if (self.formMenu.icon !== val) {
                                self.formMenu.icon = val;
                            }
                        }).on('select2:open', function() {
                            const inst = $el.data('select2');
                            if (inst && inst.$dropdown) {
                                const w = $el.outerWidth();
                                inst.$dropdown.css({
                                    minWidth: w,
                                    maxWidth: w,
                                    width: w
                                });
                            }
                        });
                        if (this.formMenu && this.formMenu.icon) {
                            $el.val(this.formMenu.icon).trigger('change.select2');
                        }
                    },
                    destroySelect2Icons() {
                        const el = this.$refs.selectIcon;
                        if (!el || !window.jQuery) return;
                        const $el = window.jQuery(el);
                        try {
                            if ($el.data('select2')) {
                                $el.select2('destroy');
                            }
                        } catch (e) {}
                    },

                    // btnItemMenuDelete duplicado eliminado (ya existe versión completa arriba)
                    // Buscar un menú por id en todo el árbol
                    findMenuById(id) {
                        for (const m of this.menus) {
                            if (m.id === id) return m;
                            const found = (m.sub_menu_n1 || []).find(sm => sm.id === id) || null;
                            if (found) return found;
                            // revisar nietos si ya están cargados en sub_menu_n1.children
                            for (const sm of (m.sub_menu_n1 || [])) {
                                if (sm.children) {
                                    const g = sm.children.find(ch => ch.id === id);
                                    if (g) return g;
                                }
                            }
                        }
                        return null;
                    },
                    showAddButton(level) {
                        if (level === 0) return true; // Menú raíz
                        if (level === 1) return !!this.selectedPath[0]; // Requiere selección en nivel 1
                        if (level === 2) return !!this.selectedPath[
                            1]; // Debe haber selección en nivel 2, sin importar si hay hijos
                        return false;
                    },

                    getParentIdForLevel(level) {
                        if (level === 0) return 0;
                        if (level === 1) return this.selectedPath[0]?.id;
                        if (level === 2) return this.selectedPath[1]?.id;
                        return null;
                    },

                    getMaxAllowedChildren(level) {
                        // Sin límites de cantidad por nivel
                        return null;
                    },

                    canAddChild(parent) {
                        if (!parent) return true;
                        const level = parent.level || 0;
                        const maxChildren = this.getMaxAllowedChildren(level);
                        if (maxChildren === null) return true;

                        const children = this.getChildren(parent);
                        return !children || children.length < maxChildren;
                    }
                },
                computed: {
                    columns() {
                        const cols = []
                        // Columna raíz
                        cols.push(this.menus || [])
                        // Columna nivel 2 si hay selección de raíz
                        if (this.selectedPath[0]) {
                            cols.push(this.getChildren(this.selectedPath[0]) || [])
                        }
                        // Columna nivel 3 si hay selección de nivel 2
                        if (this.selectedPath[1]) {
                            cols.push(this.getChildren(this.selectedPath[1]) || [])
                        }
                        return cols
                    },

                    levelContainerClass() {
                        const len = this.columns.length
                        return {
                            'cols-1': len === 1,
                            'cols-2': len === 2,
                            'cols-3': len >= 3
                        }
                    }
                },
                watch: {
                    dialogMenu(val) {
                        if (!val) {
                            this.destroySelect2Icons();
                        }
                    },
                    'formMenu.icon'(val) {
                        const el = this.$refs.selectIcon;
                        if (!el || !window.jQuery) return;
                        const $el = window.jQuery(el);
                        if ($el.data('select2') && $el.val() !== val) {
                            $el.val(val).trigger('change.select2');
                        }
                    }
                }
            }).mount('#meApp')
        </script>
    @endslot

    @slot('style')
        <style>
            /* Estilos mejorados para el menú */
            .menu-container {
                position: relative;
                width: 100%;
                min-height: 500px;
                background: #f8f9fa;
                border-radius: 8px;
                padding: 1rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .levels {
                display: flex;
                gap: 1.5rem;
                overflow-x: auto;
                padding: 0.5rem;
                /* scroll-behavior: smooth; */
                height: 100%;
                min-height: 500px;
                /* scrollbar-width: thin; */
            }

            /* .levels::-webkit-scrollbar {
                                                                                height: 6px;
                                                                            }

                                                                            .levels::-webkit-scrollbar-track {
                                                                                background: #f1f1f1;
                                                                                border-radius: 3px;
                                                                            }

                                                                            .levels::-webkit-scrollbar-thumb {
                                                                                background: #888;
                                                                                border-radius: 3px;
                                                                            } */

            .level-col {
                flex: 0 0 320px;
                max-width: 100%;
                transition: all 0.3s ease;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .levels.cols-1 .level-col {
                flex: 1 1 0;
            }

            .levels.cols-2 .level-col {
                flex: 0 0 calc(50% - .75rem);
            }

            .levels.cols-3 .level-col {
                flex: 0 0 calc(33.333% - 1rem);
            }

            .level-list {
                background: #fff;
                border-radius: 0 0 8px 8px;
                padding: 1rem;
                height: calc(100% - 60px);
                /* 60px es el alto del nuevo header */
                overflow-y: auto;
                /* scrollbar-width: thin; */
            }

            /* .level-list::-webkit-scrollbar {
                                                                                width: 6px;
                                                                            }

                                                                            .level-list::-webkit-scrollbar-track {
                                                                                background: #f1f1f1;
                                                                                border-radius: 3px;
                                                                            }

                                                                            .level-list::-webkit-scrollbar-thumb {
                                                                                background: #888;
                                                                                border-radius: 3px;
                                                                            } */

            /* Estilo para el header de cada columna */
            .level-header {
                padding: 1rem;
                background: #f8f9fa;
                border-radius: 8px 8px 0 0;
                border-bottom: 2px solid #e9ecef;
            }

            .level-header h6 {
                font-size: 0.875rem;
                font-weight: 600;
                color: #495057;
                margin: 0;
            }

            /* Roles como cards */
            .role-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: .45rem;
                max-width: 380px;
                margin: 0 auto;
            }

            .role-card {
                border: 1px solid #eee;
                border-radius: .5rem;
                transition: box-shadow .15s ease;
            }

            .role-card:hover {
                box-shadow: 0 6px 16px rgba(0, 0, 0, .08);
            }

            .role-card .card-body {
                padding: .45rem .55rem;
            }

            .role-avatar {
                width: 24px;
                height: 24px;
                border-radius: 6px;
                background: #f3f1ff;
                display: grid;
                place-items: center;
                color: #6f42c1;
                font-size: 13px;
            }

            /* Listas y selección */
            .list-group-item {
                border-radius: .5rem !important;
            }

            .list-item-selected {
                background: #f6f7ff;
                border-color: #d9dcff;
            }

            /* Grid de nietos (3 columnas) */
            .grid-3 {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: .75rem;
            }

            .mini-card {
                background: #fff;
                border: 1px solid #e9ecef;
                border-radius: 8px;
                padding: 1rem;
                margin-bottom: 0.75rem;
                cursor: pointer;
                transition: all 0.2s ease;
                position: relative;
                overflow: hidden;
            }

            .mini-card:before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background: transparent;
                transition: all 0.2s ease;
            }

            .mini-card:hover {
                background: #f8f9fa;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .mini-card:hover:before {
                background: #6c757d;
            }

            .mini-card.selected {
                background: #e7f1ff;
                border-color: #b8daff;
                box-shadow: 0 2px 8px rgba(0, 123, 255, 0.15);
            }

            .mini-card.selected:before {
                background: #0d6efd;
            }

            .mini-card .btn-light {
                background: transparent;
                border: none;
                padding: 0.25rem 0.5rem;
                color: #6c757d;
                transition: all 0.2s ease;
            }

            .mini-card .btn-light:hover {
                background: rgba(0, 0, 0, 0.05);
                color: #495057;
            }

            .mini-card .btn-light.text-danger:hover {
                color: #dc3545 !important;
                background: rgba(220, 53, 69, 0.1);
            }

            .mini-card .mdi {
                font-size: 1.1rem;
                width: 1.5rem;
                text-align: center;
            }

            .mini-card .cursor-move {
                cursor: move;
                opacity: 0.5;
                transition: opacity 0.2s ease;
            }

            .mini-card:hover .cursor-move {
                opacity: 1;
            }

            .mini-card .d-flex {
                gap: 0.5rem;
            }

            .mini-card .fw-medium {
                font-weight: 500;
                color: #495057;
            }

            .menu-breadcrumb {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.75rem 1rem;
                margin-bottom: 1rem;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                border: 1px solid #e9ecef;
            }

            .menu-breadcrumb-item {
                display: flex;
                align-items: center;
                color: #6c757d;
                font-size: 0.875rem;
                transition: all 0.2s ease;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
            }

            .menu-breadcrumb-item:not(:last-child):after {
                content: '→';
                margin: 0 0.5rem;
                color: #adb5bd;
                font-size: 0.875rem;
            }

            .menu-breadcrumb-item.active {
                color: #0d6efd;
                font-weight: 500;
                background: #e7f1ff;
            }

            .menu-breadcrumb .mdi {
                margin-right: 0.25rem;
                font-size: 1rem;
                vertical-align: middle;
            }

            .select2-results__option .mdi {
                margin-right: .5rem;
                font-size: 1.1rem;
                vertical-align: middle;
            }
            /* Icon-only: centrar y sin margen extra */
            .s2-icon-option {
                justify-content: center;
            }
            .s2-icon-option .mdi {
                margin-right: 0 !important;
            }

            .select2-selection__rendered .mdi {
                margin-right: .35rem;
                vertical-align: middle;
            }
            .select2-container--default .select2-selection--single .s2-icon-option .mdi {
                margin-right: 0 !important;
            }

            .select2-container .select2-selection--single {
                height: calc(2.25rem + 2px);
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 2.25rem;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 2.25rem;
            }

            /* Asegurar ancho correcto dentro del modal */
            .select2-container {
                width: 100% !important;
            }

            .select2-dropdown {
                /* No forzar al ancho del parent (.modal). Se ajusta por JS al ancho del select */
                width: auto;
                min-width: 0;
                max-width: none;
                box-sizing: border-box;
            }

            .select2-results__options {
                max-height: 320px !important;
                overflow-y: auto !important;
            }

            .select2-results__options[role="listbox"] {
                display: grid;
                /* Hacer responsivo el número de columnas para evitar dropdown gigante */
                grid-template-columns: 1fr;
                gap: .25rem .5rem;
                padding: .25rem;
            }
            @media (min-width: 420px) {
                .select2-results__options[role="listbox"] {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
            @media (min-width: 640px) {
                .select2-results__options[role="listbox"] {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            .select2-results__option {
                white-space: normal;
                padding: .35rem .5rem;
            }

            .s2-icon-option {
                display: flex;
                align-items: center;
                gap: .5rem;
            }

            .s2-icon-option .mdi {
                font-size: 1.25rem;
            }

            /* Ajuste menor para la fila de preview */
            .icon-preview {
                display: flex;
                align-items: center;
                gap: .5rem;
                color: #6c757d;
            }
        </style>
    @endslot
@endcomponent
