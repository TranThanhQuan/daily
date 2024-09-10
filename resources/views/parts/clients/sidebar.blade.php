<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>

                <a class="nav-link justify-content-between align-items-center" href="{{route('payments.index')}}">
                    <div class="">
                        <i class="fa-solid fa-credit-card"></i>
                        Danh sách nạp 
                    </div>
                    
                    <div><i class="fa-solid fa-angle-right"></i></div>
                </a>

                <a class="nav-link justify-content-between align-items-center" href="{{route('agents.policy.index')}}">
                    <div class="">
                        <i class="fa-solid fa-book-open"></i>
                        Chính sách đại lý 
                    </div>
                    
                    <div><i class="fa-solid fa-angle-right"></i></div>
                </a>

                <a class="nav-link justify-content-between align-items-center" href="{{route('agents.account.account_profile')}}">
                    <div class="">
                        <i class="fa-solid fa-user"></i>
                        Thông tin đại lý
                    </div>
                    
                    <div><i class="fa-solid fa-angle-right"></i></div>
                </a>

                {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsereport" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Thông tin đại lý
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                
                
                {{-- <div class="collapse {{request()->is(trim(route('admin.policy.index', [], false), '/') . '/*') || request()->is(trim(route('admin.policy.index', [], false), '/')) ? 'show' : false }}" id="collapsereport" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('agents.account.account_profile')}}">Thông tin cá nhân</a>
                            <a class="nav-link" href="{{route('agents.account.account_report')}}">Xem đối soát</a>
                    </nav>
                </div> --}}

            </div>
        </div>
        <div class="sb-sidenav-footer">
            {{-- <div class="small">Đăng nhập bởi:</div> --}}
            {{-- <li class=""><a class="nav-link collapsed" href="#">Đăng xuất</a></li> --}}

            {{-- {{Auth::agents()->name}} --}}
        </div>
    </nav>
</div>