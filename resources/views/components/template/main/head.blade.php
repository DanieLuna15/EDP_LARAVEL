<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="navbar-nav theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
                <a href="{{ url('/') }}">
                    <img src="/assets/assets/img/logo2.svg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="" class="nav-link">EDP</a>
            </li>
        </ul>

        @php
            use App\Helpers\MenuUrl;

            // Contexto por defecto: parámetros de la ruta actual
            $__routeCtx = request()->route()?->parameters() ?? [];

            // Si algún controlador pasa contexto adicional, se fusiona
            if (isset($menuContext) && is_array($menuContext)) {
                $__routeCtx = array_merge($__routeCtx, $menuContext);
            }

            // Resolver href desde string de ruta (con {param}) y contexto
            $__resolveHref = function (?string $tpl) use ($__routeCtx) {
                if (!$tpl) return null;
                try {
                    $h = MenuUrl::fromTemplate($tpl, $__routeCtx);
                    return $h === '#' ? null : url($h);
                } catch (\Throwable $e) {
                    return null; // evita reventar el HTML si falta contexto en prod
                }
            };

            // Valida permiso si existe la clave 'permission'; si no, lo da por bueno
            $__can = function ($maybePerm) {
                return empty($maybePerm) || (auth()->check() && auth()->user()->can($maybePerm));
            };
        @endphp

        <ul class="list-unstyled menu-categories scrollbar" id="topAccordion">
            @foreach ($menus as $menu)
                @continue(($menu['estado'] ?? 0) !== 1)
                @if (!empty($menu['sub_menu']) && count($menu['sub_menu']) > 0)
                    <li class="menu single-menu @if (($menu['id'] ?? null) == 1) @endif">
                        <a href="#menu-{{ $menu['id'] }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="mdi {{ $menu['icon_mdi'] }}"></i>
                                <span>{{ $menu['label'] }}</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>

                        <ul class="collapse submenu list-unstyled" id="menu-{{ $menu['id'] }}" data-parent="#topAccordion">
                            @foreach ($menu['sub_menu'] as $subMenu)
                                @continue(($subMenu['estado'] ?? 0) !== 1)
                                @php
                                    $subHasChildren = !empty($subMenu['sub_menu']);
                                @endphp

                                @if ($subHasChildren)
                                    <li class="sub-sub-submenu-list">
                                        <a href="#submenu-{{ $subMenu['id'] }}" data-toggle="collapse"
                                           aria-expanded="false" class="dropdown-toggle">
                                            <i class="mdi {{ $subMenu['icon_mdi'] }}"></i> {{ $subMenu['label'] }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-chevron-right">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>

                                        <ul class="collapse list-unstyled sub-submenu"
                                            id="submenu-{{ $subMenu['id'] }}"
                                            data-parent="#menu-{{ $menu['id'] }}">
                                            @foreach ($subMenu['sub_menu'] as $grandChild)
                                                @continue(($grandChild['estado'] ?? 0) !== 1)
                                                @php
                                                    $permOk = $__can($grandChild['permission'] ?? null);
                                                    $href = $__resolveHref($grandChild['route'] ?? null);
                                                @endphp

                                                @if ($permOk)
                                                    <li>
                                                        @if ($href)
                                                            <a href="{{ $href }}">
                                                                <i class="mdi {{ $grandChild['icon_mdi'] }}"></i>
                                                                {{ $grandChild['label'] }}
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" class="opacity-50 pointer-events-none"
                                                               title="Falta contexto para esta acción">
                                                                <i class="mdi {{ $grandChild['icon_mdi'] }}"></i>
                                                                {{ $grandChild['label'] }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    @php
                                        $permOk = $__can($subMenu['permission'] ?? null);
                                        $href = $__resolveHref($subMenu['route'] ?? null);
                                    @endphp

                                    @if ($permOk)
                                        <li>
                                            @if ($href)
                                                <a href="{{ $href }}">
                                                    <i class="mdi {{ $subMenu['icon_mdi'] }}"></i>
                                                    {{ $subMenu['label'] }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="opacity-50 pointer-events-none"
                                                   title="Falta contexto para esta acción">
                                                    <i class="mdi {{ $subMenu['icon_mdi'] }}"></i>
                                                    {{ $subMenu['label'] }}
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
