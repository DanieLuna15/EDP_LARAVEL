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
        <ul class="list-unstyled menu-categories scrollbar" id="topAccordion">
            @foreach ($menus as $menu)
                @if (count($menu['sub_menu']) > 0)
                    <li class="menu single-menu @if ($menu['id'] == 1)  @endif">
                        <a href="#menu-{{ $menu['id'] }}" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">
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
                        @if (!empty($menu['sub_menu']))
                            <ul class="collapse submenu list-unstyled" id="menu-{{ $menu['id'] }}"
                                data-parent="#topAccordion">
                                @foreach ($menu['sub_menu'] as $subMenu)
                                    @if (!empty($subMenu['sub_menu']))
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
                                            {{-- Aquí se corrige la clase para la sub-sublista --}}
                                            <ul class="collapse list-unstyled sub-submenu"
                                                id="submenu-{{ $subMenu['id'] }}"
                                                data-parent="#menu-{{ $menu['id'] }}">
                                                @foreach ($subMenu['sub_menu'] as $grandChild)
                                                    <li>
                                                        <a href="{{ url($grandChild['route']) }}">
                                                            <i class="mdi {{ $grandChild['icon_mdi'] }}"></i>
                                                            {{ $grandChild['label'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ url($subMenu['route']) }}">
                                                <i class="mdi {{ $subMenu['icon_mdi'] }}"></i> {{ $subMenu['label'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
