@php
    $sidebarMenus = [
        [
            'group' => null,
            'menus' => [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'levels' => ['ADM', 'MNG', 'STF'],
                ],
            ],
        ],
        [
            'group' => 'Users Data',
            'menus' => [
                [
                    'name' => 'User Levels',
                    'route' => 'levels.page',
                    'icon' => 'fas fa-database',
                    'levels' => ['ADM'],
                ],
                [
                    'name' => 'Users',
                    'route' => 'users.page',
                    'icon' => 'fas fa-users',
                    'levels' => ['ADM'],
                ],
            ],
        ],
        [
            'group' => 'Items Data',
            'menus' => [
                [
                    'name' => 'Categories',
                    'route' => 'categories.page',
                    'icon' => 'fas fa-bookmark',
                    'levels' => ['ADM', 'MNG'],
                ],
                [
                    'name' => 'Items',
                    'route' => 'items.page',
                    'icon' => 'fas fa-receipt',
                    'levels' => ['ADM', 'MNG'],
                ],
            ],
        ],
        [
            'group' => 'Transactions Data',
            'menus' => [
                [
                    'name' => 'Stocks',
                    'route' => 'stocks.page',
                    'icon' => 'fas fa-receipt',
                    'levels' => ['ADM', 'MNG'],
                ],
                [
                    'name' => 'Transactions',
                    'route' => null,
                    'icon' => 'fas fa-money-bill',
                    'levels' => ['STF'],
                ],
            ],
        ],
    ];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">PWL-POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-2">
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
                @foreach ($sidebarMenus as $sidebarMenu)
                    @php
                        $visibleMenus = array_filter($sidebarMenu['menus'], function ($menu) {
                            return isset($menu['levels']) && in_array(Auth::user()->level->level_code, $menu['levels']);
                        });
                    @endphp

                    @if (count($visibleMenus) > 0)
                        @if ($sidebarMenu['group'])
                            <li class="nav-header">{{ $sidebarMenu['group'] }}</li>
                        @endif

                        @foreach ($visibleMenus as $menu)
                            <li class="nav-item">
                                <a href="{{ $menu['route'] !== null ? route($menu['route']) : '#' }}"
                                    @class(['nav-link', 'active' => request()->routeIs($menu['route'])])>
                                    <i class="nav-icon {{ $menu['icon'] }}"></i>
                                    <p>{{ $menu['name'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- End of Sidebar Menu -->
    </div>
    <!-- End of Sidebar -->
</aside>
