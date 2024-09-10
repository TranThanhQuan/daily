<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                {{-- <a class="nav-link" href={{route('admin.dashboards')}}>
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a> --}}
                @can('payments')
                    @include('parts.backend.menu_item', [
                        'title' => 'Quản lý nạp', 
                        'name' => 'payments' 
                    ])
                @endcan 


                @can('agents')
                    @include('parts.backend.menu_item', [
                        'title' => 'Quản lý đại lý', 
                        'name' => 'agents' 
                    ])
                @endcan 

                @can('users')
                    @include('parts.backend.menu_item', [
                        'title' => 'Quản lý người dùng', 
                        'name' => 'users' 
                    ])
                @endcan 

                @can('games')
                    @include('parts.backend.menu_item', [
                        'title' => 'Quản lý Games', 
                        'name' => 'games' 
                        ])
                @endcan 

                @can('groups')
                    @include('parts.backend.menu_item', [
                        'title' => 'Quản lý nhóm', 
                        'name' => 'groups' 
                        ])
                @endcan


                {{-- chính sách --}}
                @can('policy')
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsepolicy" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Chính sách
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    
                    <div class="collapse {{request()->is(trim(route('admin.policy.index', [], false), '/') . '/*') || request()->is(trim(route('admin.policy.index', [], false), '/')) ? 'show' : false }}" id="collapsepolicy" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('admin.policy.index')}}">Xem</a>
                            @can('update', Modules\Policy\src\Models\Policy::class)
                                <a class="nav-link" href="{{route('admin.policy.edit')}}">Chỉnh sửa</a>
                            @endcan
                        </nav>
                    </div>
                @endcan

                @can('report', Modules\Payments\src\Models\Payments::class)
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsereport" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Đối soát đại lý
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    
                    <div class="collapse {{request()->is(trim(route('admin.policy.index', [], false), '/') . '/*') || request()->is(trim(route('admin.policy.index', [], false), '/')) ? 'show' : false }}" id="collapsereport" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            
                                <a class="nav-link" href="{{route('admin.payments.report')}}">Xem đối soát</a>
                            
                        </nav>
                    </div>
                @endcan

      {{--            
                @include('parts.backend.menu_item', [
                    'title' => 'chuyên mục', 
                    'name' => 'categories' 
                    ]) --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            {{-- <div class="small">Đăng nhập bởi:</div>
            {{Auth::user()->name}} --}}
        </div>
    </nav>
</div>