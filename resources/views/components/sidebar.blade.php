@php
    $sidebarMenus = [
        [
            'group' => null,
            'menus' => [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'fas fa-tachometer-alt',
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
                ],
                [
                    'name' => 'Users',
                    'route' => 'users.page',
                    'icon' => 'fas fa-users',
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
                ],
                [
                    'name' => 'Items',
                    'route' => 'items.page',
                    'icon' => 'fas fa-receipt',
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
                ],
                [
                    'name' => 'Transactions',
                    'route' => null,
                    'icon' => 'fas fa-money-bill',
                ],
            ],
        ],
    ];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">PWL POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-2">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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
                    @if ($sidebarMenu['group'])
                        <li class="nav-header">{{ $sidebarMenu['group'] }}</li>
                    @endif
                    @foreach ($sidebarMenu['menus'] as $menu)
                        <li class="nav-item">
                            <a
                                href="{{ $menu['route'] !== null ? route($menu['route']) : '#' }}"
                                @class([
                                    'nav-link',
                                    'active' => request()->routeIs($menu['route']),
                                ])
                            >
                                <i class="nav-icon {{ $menu['icon'] }}"></i>
                                <p>{{ $menu['name'] }}</p>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </nav>
        <!-- End of Sidebar Menu -->
    </div>
    <!-- End of Sidebar -->
</aside>
