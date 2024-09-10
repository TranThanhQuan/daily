<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('admin.dashboards')}}">{{env('APP_NAME')}}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
    <!-- btn view as clients -->



    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        {{-- <a href="{{route('home')}}" class="btn btn-primary" target="_blank">Xem website</a> --}}
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <div class="d-flex gap-4 text-white align-items-center">
            <li >Chào đại lý: {{auth('agents')->user()->name}}</li>
            {{-- <li class=""><a class="btn btn-primary" href="#">Tài khoản</a></li> --}}
            <li ><a class="btn btn-primary" href="#" onclick="document['form-logout'].submit(); return false; ">Đăng xuất</a></li>
            <form name="form-logout" action="{{route('clients.logout')}}"  method="POST">
                @csrf
            </form>
        </div>
    </ul>



</nav>