@component('application')
    @slot('body')
        @verbatim
        <div id="meApp">
            <div class="action-btn layout-top-spacing mb-2">
                <div class="page-header">
                    <div class="page-title">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-grid">
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
                <div class="col-md-4">
                    <div class="card mx-auto">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h4 class="card-title text-muted mb-0">Gestión de Roles</h4>
                            <button class="btn btn-primary btn-sm" @click="openModal('create')">
                                <i class="mdi mdi-plus me-1"></i> Crear Rol
                            </button>
                        </div>

                        <table id="table_basic" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in roles" :key="role.id">
                                    <td>{{ role.id }}</td>
                                    <td>{{ role.name }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" @click="openModal('update', role)">Editar</button>
                                        <button class="btn btn-danger btn-sm" @click="deleteRole(role.id)">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h4 class="card-title text-muted mb-0">Menús</h4>
                            <button class="btn btn-primary" @click="btnNuevoMenu(0)">
                                <i class="mdi mdi-plus me-1"></i> Nuevo
                            </button>
                        </div>

                        <div class="card-body row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <draggable
                                        v-model="menus"
                                        item-key="id"
                                        :move="checkMoveMenu"
                                        v-bind="dragOptions"
                                        @start="dragMenu = true"
                                        @end="dragMenu = false"
                                        handle=".handle"
                                    >
                                        <template #item="{ element: item }">
                                            <li
                                                class="list-group-item d-flex align-items-center justify-content-between my-2 rounded"
                                                :class="{'list-item-selected': itemSelectMenu && itemSelectMenu.id === item.id}"
                                                @click="btnItemMenu(item)"
                                            >
                                                <div class="d-flex align-items-center">
                                                    <span class="handle me-2"><i class="mdi mdi-drag-variant text-secondary"></i></span>
                                                    <span class="me-3">
                                                        <i :class="getMdiClass(item.icon_mdi)" class="fs-4 text-purple"></i>
                                                    </span>
                                                    <span class="fw-bold">{{ item.label }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-link text-danger p-0 me-2" @click.stop="btnItemMenuDelete(item)">
                                                        <i class="mdi mdi-delete-forever fs-5"></i>
                                                    </button>
                                                    <button class="btn btn-link text-primary p-0 me-2" @click.stop="btnItemMenuEdit(item)">
                                                        <i class="mdi mdi-pencil fs-5"></i>
                                                    </button>
                                                    <span class="badge rounded-pill bg-light text-dark p-2">{{ item.sub_menu_n1.length }}</span>
                                                    <i class="mdi mdi-chevron-right ms-2 fs-5"></i>
                                                </div>
                                            </li>
                                        </template>
                                    </draggable>
                                </ul>
                            </div>

                            <div class="col-md-6" v-if="itemSelectMenu">
                                <div class="card h-100 border-0">
                                    <div class="card-header border-0 py-3 d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-muted">{{ itemSelectMenu.label }}</h5>
                                        <button class="btn btn-primary btn-sm" @click="btnNuevoMenu(itemSelectMenu.id)">
                                            <i class="mdi mdi-plus me-1"></i> Nuevo
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <draggable
                                                v-model="subMenus"
                                                item-key="id"
                                                v-bind="dragOptions"
                                                :move="checkMoveMenu"
                                                @start="dragSubMenu = true"
                                                @end="dragSubMenu = false"
                                                handle=".handle">
                                                <template #item="{ element: item }">
                                                    <li class="list-group-item d-flex align-items-center justify-content-between my-2 rounded"
                                                        :class="{'list-item-selected': itemSelectSubMenu && itemSelectSubMenu.id === item.id}"
                                                        @click="btnItemSubMenu(item)">
                                                        <div class="d-flex align-items-center">
                                                            <span class="handle me-2"><i class="mdi mdi-drag-variant text-secondary"></i></span>
                                                            <span class="me-3"><i :class="getMdiClass(item.icon_mdi)" class="fs-4 text-purple"></i></span>
                                                            <span class="fw-bold">{{ item.label }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <button class="btn btn-link text-danger p-0 me-2" @click.stop="btnItemMenuDelete(item)">
                                                                <i class="mdi mdi-delete-forever fs-5"></i>
                                                            </button>
                                                            <button class="btn btn-link text-primary p-0 me-2" @click.stop="btnItemMenuEdit(item)">
                                                                <i class="mdi mdi-pencil fs-5"></i>
                                                            </button>
                                                        </div>
                                                    </li>
                                                </template>
                                            </draggable>
                                        </ul>
                                        <div class="mt-3" v-if="itemSelectSubMenu">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0 text-muted">{{ itemSelectSubMenu.label }} / Sub menús</h6>
                                                <button class="btn btn-primary btn-sm" @click="btnNuevoMenu(itemSelectSubMenu.id)">
                                                    <i class="mdi mdi-plus me-1"></i> Nuevo
                                                </button>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <draggable
                                                    v-model="grandMenus"
                                                    item-key="id"
                                                    v-bind="dragOptions"
                                                    :move="checkMoveMenu"
                                                    handle=".handle">
                                                    <template #item="{ element: item }">
                                                        <li class="list-group-item d-flex align-items-center justify-content-between my-2 rounded">
                                                            <div class="d-flex align-items-center">
                                                                <span class="handle me-2"><i class="mdi mdi-drag-variant text-secondary"></i></span>
                                                                <span class="me-3"><i :class="getMdiClass(item.icon_mdi)" class="fs-4 text-purple"></i></span>
                                                                <span class="fw-bold">{{ item.label }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <button class="btn btn-link text-danger p-0 me-2" @click.stop="btnItemMenuDelete(item)">
                                                                    <i class="mdi mdi-delete-forever fs-5"></i>
                                                                </button>
                                                                <button class="btn btn-link text-primary p-0 me-2" @click.stop="btnItemMenuEdit(item)">
                                                                    <i class="mdi mdi-pencil fs-5"></i>
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </template>
                                                </draggable>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" :class="{ 'show d-block': showModal }" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true" v-if="showModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ modalTitle }}</h5>
                            <button type="button" class="btn-close" @click="showModal = false"><i class="mdi mdi-close"></i></button>
                        </div>
                        <form @submit.prevent="saveRol">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="roleName" class="form-label">Nombre del Rol</label>
                                    <input type="text" class="form-control" id="roleName" v-model="roleForm.name" required>
                                    <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="showModal = false">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" :class="{ 'show': dialogMenu, 'd-block': dialogMenu }" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true" v-if="dialogMenu">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form @submit.prevent="submitMenu" ref="formMenu">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ isFormMenuEdit ? "Editar " : "Nuevo " }}
                                    {{ menuNivel == 0 ? "menu" : "sub menu" }}
                                </h5>
                                <button type="button" class="btn-close" @click="dialogMenu = false"><i class="mdi mdi-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3" v-if="itemSelectMenu && menuNivel != 0">
                                    <label for="menuPadre" class="form-label">Menú</label>
                                    <input type="text" class="form-control" id="menuPadre" :value="itemSelectMenu.label" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="nombreMenu" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreMenu" v-model="formMenu.label" required>
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
                                    <select ref="selectIcon" class="form-control select2-icons" id="iconoMenu" v-model="formMenu.icon" required>
                                        <option disabled value="">Seleccione un ícono</option>
                                        <option v-for="item in menuList" :value="item.icon" :data-icon="item.icon">
                                            {{ item.text }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="dialogMenu = false">Cerrar</button>
                                <button type="submit" class="btn btn-primary" :disabled="btnLoadingMenu">
                                    <span v-if="btnLoadingMenu" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    {{ isFormMenuEdit ? "GUARDAR CAMBIOS" : "GUARDAR" }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        @endverbatim
    @endslot

    @slot('script')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-results__option .mdi { margin-right: .5rem; font-size: 1.1rem; vertical-align: middle; }
            .select2-selection__rendered .mdi { margin-right: .35rem; vertical-align: middle; }
            .select2-container .select2-selection--single { height: calc(2.25rem + 2px); }
            .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 2.25rem; }
            .select2-container--default .select2-selection--single .select2-selection__arrow { height: 2.25rem; }
            /* Asegurar ancho correcto dentro del modal */
            .select2-container { width: 100% !important; }
            .select2-dropdown { width: 100% !important; min-width: 100% !important; box-sizing: border-box; }
            .select2-results__options { max-height: 280px !important; }
            /* Ajuste menor para la fila de preview */
            .icon-preview { display: flex; align-items: center; gap: .5rem; color: #6c757d; }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuedraggable@next/dist/vuedraggable.umd.js"></script>
        <script type="module">
        import Table from "{{ asset('config/dt.js') }}"
        import Block from "{{ asset('config/block.js') }}"
        const { createApp } = Vue
        const draggable = vuedraggable;
        
        let dt = new Table()
        let block = new Block()

        createApp({
            components: { draggable},
            data() {
                return {
                    roles: [],
                    menus: [],
                    subMenus: [],
                    itemSelectSubMenu: null,
                    grandMenus: [],
                    roleForm: { id: null, name: '' },
                    modalTitle: '',
                    editMode: false,
                    errors: {},
                    showModal: false,
                    itemSelectMenu: null,
                    dragOptions: { animation: 200 },
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
                this.getRoles();
                this.getMenus();
                this.loadMenu();
            },
            methods: {
                async getRoles() {
                    try {
                        let res = await axios.get("{{ url('api/rol') }}")
                        this.roles = res.data
                    } catch (e) {}
                },
                async getMenus() {
                    try {
                        let res = await axios.get("{{ url('api/menu') }}")
                        this.menus = res.data
                        if (this.itemSelectMenu) {
                            const menu_ = this.menus.find(x => x.id == this.itemSelectMenu.id)
                            this.subMenus = menu_ ? (menu_.sub_menu_n1 || []) : []
                            if (this.itemSelectSubMenu) {
                                const sub = this.subMenus.find(s => s.id == this.itemSelectSubMenu.id)
                                this.itemSelectSubMenu = sub || null
                                this.grandMenus = sub && sub.children ? sub.children : []
                            }
                        } else {
                            this.itemSelectSubMenu = null
                            this.grandMenus = []
                        }
                    } catch (e) {}
                },
                openModal(action, role = null) {
                    this.showModal = true
                    this.errors = {}
                    if (action === 'create') {
                        this.editMode = false
                        this.modalTitle = 'Crear Nuevo Rol'
                        this.roleForm = { id: null, name: '' }
                    } else {
                        this.editMode = true
                        this.modalTitle = 'Editar Rol'
                        this.roleForm = { ...role }
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
                        this.errors = { name: ['El nombre del rol es obligatorio.'] }
                        return
                    }
                    try {
                        if (this.editMode) {
                            await axios.put("{{ url('api/rol/') }}"+'/'+this.roleForm.id, this.roleForm)
                            swal({ title: 'Rol Actualizado', text: 'Se actualizó el rol', icon: 'warning',type:'warning', button: 'Aceptar' })
                        } else {
                            await axios.post("{{ url('api/rol') }}", this.roleForm)
                            swal({ title: 'Rol creado', text: 'Se creó el rol respectivo', icon: 'success',type:'success', button: 'Aceptar' })
                        }
                        this.vaciarModal();
                        this.getRoles();
                    } catch (e) {
                        swal({ title: 'Error', text: "Registro duplicado", icon: 'error',type:'error', button: 'Aceptar' })
                    }
                },
                btnItemMenu(item) {
                    this.itemSelectMenu = item
                    this.subMenus = item.sub_menu_n1
                    this.itemSelectSubMenu = null
                    this.grandMenus = []
                },
                btnItemSubMenu(item) {
                    this.itemSelectSubMenu = item
                    this.grandMenus = item.children || []
                },
                btnNuevoMenu(nivel) {
                    this.menuNivel = nivel;
                    this.formMenu = {
                        label: null,
                        icon: null,
                        route: null,
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
                    this.menuList = [
                        { icon: "account", text: "Account" },
                        { icon: "account-box", text: "Account Box" },
                        { icon: "account-box-multiple", text: "Account Box Multiple" },
                        { icon: "account-box-outline", text: "Account Box Outline" },
                        { icon: "account-check", text: "Account Check" },
                        { icon: "account-check-outline", text: "Account Check Outline" },
                        { icon: "account-circle", text: "Account Circle" },
                        { icon: "account-circle-outline", text: "Account Circle Outline" },
                        { icon: "account-details", text: "Account Details" },
                        { icon: "account-multiple", text: "Account Multiple" },
                        { icon: "account-multiple-minus", text: "Account Multiple Minus" },
                        { icon: "account-multiple-minus-outline", text: "Account Multiple Minus Outline" },
                        { icon: "account-multiple-plus", text: "Account Multiple Plus" },
                        { icon: "account-multiple-plus-outline", text: "Account Multiple Plus Outline" },
                        { icon: "account-music", text: "Account Music" },
                        { icon: "account-outline", text: "Account Outline" },
                        { icon: "account-plus", text: "Account Plus" },
                        { icon: "account-supervisor", text: "Account Supervisor" },
                        { icon: "account-supervisor-circle", text: "Account Supervisor Circle" },
                        { icon: "account-supervisor-circle-outline", text: "Account Supervisor Circle Outline" },
                        { icon: "account-voice", text: "Account Voice" },
                        { icon: "account-voice-off", text: "Account Voice Off" },
                        { icon: "air-purifier", text: "Air Purifier" },
                        { icon: "alarm", text: "Alarm" },
                        { icon: "alarm-check", text: "Alarm Check" },
                        { icon: "alarm-off", text: "Alarm Off" },
                        { icon: "alarm-plus", text: "Alarm Plus" },
                        { icon: "alarm-snooze", text: "Alarm Snooze" },
                        { icon: "alert", text: "Alert" },
                        { icon: "alert-circle", text: "Alert Circle" },
                        { icon: "alert-circle-outline", text: "Alert Circle Outline" },
                        { icon: "alert-decagram", text: "Alert Decagram" },
                        { icon: "alert-octagon", text: "Alert Octagon" },
                        { icon: "align-horizontal-center", text: "Align Horizontal Center" },
                        { icon: "align-horizontal-distribute", text: "Align Horizontal Distribute" },
                        { icon: "align-horizontal-left", text: "Align Horizontal Left" },
                        { icon: "align-vertical-bottom", text: "Align Vertical Bottom" },
                        { icon: "align-vertical-center", text: "Align Vertical Center" },
                        { icon: "all-inclusive", text: "All Inclusive" },
                        { icon: "anchor", text: "Anchor" },
                        { icon: "android", text: "Android" },
                        { icon: "android-messages", text: "Android Messages" },
                        { icon: "android-studio", text: "Android Studio" },
                        { icon: "animation", text: "Animation" },
                        { icon: "animation-play", text: "Animation Play" },
                        { icon: "antenna", text: "Antenna" },
                        { icon: "api", text: "Api" },
                        { icon: "apps", text: "Apps" },
                        { icon: "apps-box", text: "Apps Box" },
                        { icon: "arrow-bottom-left-thin-circle-outline", text: "Arrow Bottom Left Thin Circle Outline" },
                        { icon: "arrow-bottom-right-thin-circle-outline", text: "Arrow Bottom Right Thin Circle Outline" },
                        { icon: "arrow-collapse-horizontal", text: "Arrow Collapse Horizontal" },
                        { icon: "arrow-collapse-vertical", text: "Arrow Collapse Vertical" },
                        { icon: "arrow-down-drop-circle", text: "Arrow Down Drop Circle" },
                        { icon: "arrow-down-thin-circle-outline", text: "Arrow Down Thin Circle Outline" },
                        { icon: "arrow-right", text: "Arrow Right" },
                        { icon: "arrow-right-thin-circle-outline", text: "Arrow Right Thin Circle Outline" },
                        { icon: "arrow-top-left-thin-circle-outline", text: "Arrow Top Left Thin Circle Outline" },
                        { icon: "arrow-top-right-thin-circle-outline", text: "Arrow Top Right Thin Circle Outline" },
                        { icon: "arrow-up-thin-circle-outline", text: "Arrow Up Thin Circle Outline" },
                        { icon: "aspect-ratio", text: "Aspect Ratio" },
                        { icon: "assistant", text: "Assistant" },
                        { icon: "at", text: "At" },
                        { icon: "atm", text: "Atm" },
                        { icon: "attachment", text: "Attachment" },
                        { icon: "auto-fix", text: "Auto Fix" },
                        { icon: "auto-upload", text: "Auto Upload" },
                        { icon: "autorenew", text: "Autorenew" },
                        { icon: "av-timer", text: "Av Timer" },
                        { icon: "baby-carriage", text: "Baby Carriage" },
                        { icon: "baby-face", text: "Baby Face" },
                        { icon: "backspace", text: "Backspace" },
                        { icon: "backspace-outline", text: "Backspace Outline" },
                        { icon: "backup-restore", text: "Backup Restore" },
                        { icon: "badge-account-horizontal", text: "Badge Account Horizontal" },
                        { icon: "badge-account-horizontal-outline", text: "Badge Account Horizontal Outline" },
                        { icon: "bag-checked", text: "Bag Checked" },
                        { icon: "bag-suitcase", text: "Bag Suitcase" },
                        { icon: "bag-suitcase-off", text: "Bag Suitcase Off" },
                        { icon: "balcony", text: "Balcony" },
                        { icon: "ballot", text: "Ballot" },
                        { icon: "ballot-outline", text: "Ballot Outline" },
                        { icon: "bandage", text: "Bandage" },
                        { icon: "bank", text: "Bank" },
                        { icon: "barrel", text: "Barrel" },
                        { icon: "barrel-outline", text: "Barrel Outline" },
                        { icon: "basket", text: "Basket" },
                        { icon: "basket-outline", text: "Basket Outline" },
                        { icon: "basketball", text: "Basketball" },
                        { icon: "bed-outline", text: "Bed Outline" },
                        { icon: "bee", text: "Bee" },
                        { icon: "bee-flower", text: "Bee Flower" },
                        { icon: "bell", text: "Bell" },
                        { icon: "bell-circle", text: "Bell Circle" },
                        { icon: "bell-circle-outline", text: "Bell Circle Outline" },
                        { icon: "bell-off", text: "Bell Off" },
                        { icon: "bell-off-outline", text: "Bell Off Outline" },
                        { icon: "bell-outline", text: "Bell Outline" },
                        { icon: "bell-ring", text: "Bell Ring" },
                        { icon: "bell-ring-outline", text: "Bell Ring Outline" },
                        { icon: "bell-sleep-outline", text: "Bell Sleep Outline" },
                        { icon: "bike", text: "Bike" },
                        { icon: "blender", text: "Blender" },
                        { icon: "blinds-horizontal", text: "Blinds Horizontal" },
                        { icon: "blur", text: "Blur" },
                        { icon: "book-variant", text: "Book Variant" },
                        { icon: "bookmark", text: "Bookmark" },
                        { icon: "bookmark-check", text: "Bookmark Check" },
                        { icon: "bookmark-multiple", text: "Bookmark Multiple" },
                        { icon: "bookmark-outline", text: "Bookmark Outline" },
                        { icon: "bookmark-check", text: "Bookmark Check" },
                        { icon: "briefcase-outline", text: "Briefcase Outline" },
                        { icon: "briefcase-variant", text: "Briefcase Variant" },
                        { icon: "briefcase-variant-outline", text: "Briefcase Variant Outline" },
                        { icon: "brush", text: "Brush" },
                        { icon: "cached", text: "Cached" },
                        { icon: "cake-variant", text: "Cake Variant" },
                        { icon: "calculator-variant-outline", text: "Calculator Variant Outline" },
                        { icon: "calendar", text: "Calendar" },
                        { icon: "calendar-blank-outline", text: "Calendar Blank Outline" },
                        { icon: "calendar-check", text: "Calendar Check" },
                        { icon: "chart-box", text: "Chart Box" },
                        { icon: "chart-box-plus-outline", text: "Chart Box Plus Outline" },
                        { icon: "check", text: "Check" },
                        { icon: "check-circle", text: "Check Circle" },
                        { icon: "check-circle-outline", text: "Check Circle Outline" },
                        { icon: "check-outline", text: "Check Outline" },
                        { icon: "checkbook", text: "Checkbook" },
                        { icon: "checkbox-marked", text: "Checkbox Marked" },
                        { icon: "chevron-right", text: "Chevron Right" },
                        { icon: "chevron-left", text: "Chevron Left" },
                        { icon: "clipboard-account", text: "Clipboard Account" },
                        { icon: "clipboard-alert", text: "Clipboard Alert" },
                        { icon: "clipboard-arrow-down-outline", text: "Clipboard Arrow Down Outline" },
                        { icon: "clipboard-text", text: "Clipboard Text" },
                        { icon: "close-circle-outline", text: "Close Circle Outline" },
                        { icon: "cloud-download-outline", text: "Cloud Download Outline" },
                        { icon: "cloud-download", text: "Cloud Download" },
                        { icon: "cloud-off-outline", text: "Cloud Off Outline" },
                        { icon: "cloud-outline", text: "Cloud Outline" },
                        { icon: "cog", text: "Cog" },
                        { icon: "cogs", text: "Cogs" },
                        { icon: "contacts", text: "Contacts" },
                        { icon: "content-paste", text: "Content Paste" },
                        { icon: "delete", text: "Delete" },
                        { icon: "devices", text: "Devices" },
                        { icon: "download", text: "Download" },
                        { icon: "earth", text: "Earth" },
                        { icon: "elevator-passenger-outline", text: "Elevator Passenger Outline" },
                        { icon: "email-outline", text: "Email Outline" },
                        { icon: "equalizer", text: "Equalizer" },
                        { icon: "eye-off", text: "Eye Off" },
                        { icon: "face-man", text: "Face Man" },
                        { icon: "file-outline", text: "File Outline" },
                        { icon: "finance", text: "Finance" },
                        { icon: "folder", text: "Folder" },
                        { icon: "folder-account", text: "Folder Account" },
                        { icon: "folder-account-outline", text: "Folder Account Outline" },
                        { icon: "folder-move", text: "Folder Move" },
                        { icon: "folder-outline", text: "Folder Outline" },
                        { icon: "folder-plus-outline", text: "Folder Plus Outline" },
                        { icon: "google-my-business", text: "Google My Business" },
                        { icon: "help-circle", text: "Help Circle" },
                        { icon: "home", text: "Home" },
                        { icon: "inbox-multiple", text: "Inbox Multiple" },
                        { icon: "information-outline", text: "Information Outline" },
                        { icon: "label-outline", text: "Label Outline" },
                        { icon: "label-off-outline", text: "Label Off Outline" },
                        { icon: "label-variant", text: "Label Variant" },
                        { icon: "lead-pencil", text: "Lead Pencil" },
                        { icon: "library", text: "Library" },
                        { icon: "list-status", text: "List Status" },
                        { icon: "lock-outline", text: "Lock Outline" },
                        { icon: "message-badge", text: "Message Badge" },
                        { icon: "message-badge-outline", text: "Message Badge Outline" },
                        { icon: "message-bulleted", text: "Message Bulleted" },
                        { icon: "newspaper-variant", text: "Newspaper Variant" },
                        { icon: "picture-in-picture-bottom-right", text: "Picture In Picture Bottom Right" },
                        { icon: "refresh", text: "Refresh" },
                        { icon: "shield-account-variant", text: "Shield Account Variant" },
                        { icon: "shield-check", text: "Shield Check" },
                        { icon: "shield-plus", text: "Shield Plus" },
                        { icon: "shield-search", text: "Shield Search" },
                        { icon: "star-circle", text: "Star Circle" },
                        { icon: "star-face", text: "Star Face" },
                        { icon: "sticker-emoji", text: "Sticker Emoji" },
                        { icon: "weather-windy-variant", text: "Weather Windy Variant" }
                    ]
                },
                btnItemMenuEdit(item) {
                    this.isFormMenuEdit = true;
                    this.dialogMenu = true;
                    this.formMenu = { ...item };
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

                submitMenu: function () {
                    this.btnLoadingMenu = true;
                    const dataForm = this.formMenu;
                    if (this.isFormMenuEdit) {
                        const urlEdit = "{{ url('api/menu') }}/" + dataForm.id;
                        const dataUpdate = { ...dataForm, icon: this.normalizeIcon(dataForm.icon) };
                        axios
                            .put(urlEdit, dataUpdate)
                            .then((response) => {
                                this.getMenus();
                                this.dialogMenu = false;
                                this.btnLoadingMenu = false;
                                this.snackbar = { status: true, text: "Registro Editado", color: "primary" };
                            })
                            .catch((error) => { this.btnLoadingMenu = false; });
                    } else {
                        const dataSend = { ...dataForm, icon: this.normalizeIcon(dataForm.icon) };
                        if (this.menuNivel === 0) {
                            dataSend.menu_id = null;
                            dataSend.level = 0;
                            dataSend.order = this.menus.length + 1;
                        } else {
                            const parent = this.findMenuById(this.menuNivel);
                            dataSend.menu_id = this.menuNivel; // id del menú padre
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
                                // insertar en la colección adecuada según el nivel del padre
                                if (this.menuNivel === 0) {
                                    this.menus.push(response.data);
                                } else {
                                    const parent = this.findMenuById(this.menuNivel);
                                    if (parent) {
                                        if ((parent.level ?? 0) === 0) {
                                            this.subMenus.push(response.data);
                                        } else {
                                            if (!this.itemSelectSubMenu) this.itemSelectSubMenu = parent;
                                            if (!this.grandMenus) this.grandMenus = [];
                                            this.grandMenus.push(response.data);
                                        }
                                    }
                                }
                                this.getMenus();
                                this.dialogMenu = false;
                                this.btnLoadingMenu = false;
                                this.snackbar = { status: true, text: "Nuevo Registro", color: "primary" };
                            })
                            .catch((error) => { this.btnLoadingMenu = false; });
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
                            icon: 'warning',
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
                        swal({ title: 'Hecho', text: 'Menú desactivado', icon: 'success', button: 'OK' });
                    } catch (e) {
                        swal({ title: 'Error', text: 'No se pudo desactivar', icon: 'error', button: 'Aceptar' });
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
                    const $parent = window.jQuery(this.$refs.selectIcon).closest('.modal');
                    $el.select2({
                        width: '100%',
                        dropdownParent: $parent.length ? $parent : undefined,
                        templateResult: function (state) {
                            if (!state.id) return state.text;
                            const icon = state.element && state.element.dataset ? state.element.dataset.icon : '';
                            const cls = icon ? `mdi mdi-${icon}` : '';
                            const label = state.text || icon || '';
                            return window.jQuery(`<span><i class="${cls}"></i> ${label}</span>`);
                        },
                        templateSelection: function (state) {
                            if (!state.id) return state.text;
                            const icon = state.element && state.element.dataset ? state.element.dataset.icon : '';
                            const cls = icon ? `mdi mdi-${icon}` : '';
                            const label = state.text || icon || '';
                            return window.jQuery(`<span><i class="${cls}"></i> ${label}</span>`);
                        },
                        escapeMarkup: function (m) { return m; },
                        dropdownAutoWidth: false,
                        placeholder: 'Seleccione un ícono',
                    }).on('change', function () {
                        const val = $el.val();
                        if (self.formMenu.icon !== val) {
                            self.formMenu.icon = val;
                        }
                    }).on('select2:open', function () {
                        const inst = $el.data('select2');
                        if (inst && inst.$dropdown) {
                            const w = $el.outerWidth();
                            inst.$dropdown.css({ minWidth: w, width: w });
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

                btnItemMenuDelete(item) {
                },
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
@endcomponent
