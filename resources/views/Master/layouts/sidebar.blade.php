<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{route('dashboard')}}"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        @foreach($sidebarMenus as $menu)
                            @if($menu->submenus->isEmpty())
                                <li class="sidebar-item {{ $menu->isActive() ? 'active' : '' }}">
                                    <a href="{{ $menu->route ? route($menu->route) : '#' }}" class='sidebar-link'>
                                        @if($menu->icon)
                                            <i class="{{ $menu->icon }}"></i>
                                        @endif
                                        <span>{{ $menu->name }}</span>
                                    </a>
                                </li>
                            @else
                                <li class="sidebar-item has-sub {{ $menu->isActive() ? 'active' : '' }}">
                                    <a href="#" class='sidebar-link'>
                                        @if($menu->icon)
                                            <i class="{{ $menu->icon }}"></i>
                                        @endif
                                        <span>{{ $menu->name }}</span>
                                    </a>
                                    <ul class="submenu {{ $menu->isActive() ? 'active' : '' }}">
                                        @foreach($menu->submenus as $submenu)
                                            @if($submenu->is_active)
                                                <li class="submenu-item {{ $submenu->isActive() ? 'active' : '' }}">
                                                    <a href="{{ $submenu->route ? route($submenu->route) : '#' }}">{{ $submenu->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link text-danger' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>