<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ URL::to('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Apanya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @foreach ($menus as $menu)
                    @php
                        $isActive =
                            Request::routeIs($menu->route) ||
                            $menu->submenus->contains(function ($submenu) {
                                return Request::routeIs($submenu->route);
                            });
                    @endphp
                    @if ($menu->submenus->count() > 0)
                        @php
                            $submenuPermissions = $menu->submenus->pluck('permission.name')->toArray();
                        @endphp
                        @canany($submenuPermissions)
                            <li class="nav-item {{ $isActive ? 'menu-open' : '' }}">
                                <a href="@if ($menu->route == '#') #
                                    @else
                                        {{ route($menu->route) }} @endif"
                                    class="nav-link {{ $isActive ? 'active' : '' }}">
                                    <i class="nav-icon {{ $menu->icon }}"></i>
                                    <p>
                                        {{ $menu->name }}
                                        <i class="right fas fa-angle-left"></i>
                                        @if ($menu->created_at && $menu->created_at->diffInDays(now()) <= 7)
                                            <span class="right badge badge-danger">New</span>
                                        @endif
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($menu->submenus as $submenu)
                                        @can($submenu->permission->name)
                                            <li class="nav-item">
                                                <a href="{{ route($submenu->route) }}"
                                                    class="nav-link {{ Request::routeIs($submenu->route) ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $submenu->name }}
                                                        @if ($menu->created_at && $menu->created_at->diffInDays(now()) <= 7)
                                                            <span class="right badge badge-danger">New</span>
                                                        @endif
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    @endforeach
                                </ul>
                            </li>
                        @endcanany
                    @else
                        @if (!empty($menu->permission->name))
                            @can($menu->permission->name)
                                <li class="nav-item">
                                    <a href="@if ($menu->route == '#') #
                            @else
                                {{ route($menu->route) }} @endif"
                                        class="nav-link {{ $isActive ? 'active' : '' }}">
                                        <i class="nav-icon {{ $menu->icon }}"></i>
                                        <p>
                                            {{ $menu->name }}
                                            @if ($menu->created_at && $menu->created_at->diffInDays(now()) <= 7)
                                                <span class="right badge badge-danger">New</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        @else
                            <li class="nav-item">
                                <a href="@if ($menu->route == '#') #
                                    @else
                                        {{ route($menu->route) }} @endif"
                                    class="nav-link {{ $isActive ? 'active' : '' }}">
                                    <i class="nav-icon {{ $menu->icon }}"></i>
                                    <p>
                                        {{ $menu->name }}
                                        @if ($menu->created_at && $menu->created_at->diffInDays(now()) <= 7)
                                            <span class="right badge badge-danger">New</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
