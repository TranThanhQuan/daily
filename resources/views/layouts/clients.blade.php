<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ $pageTitle ?? 'Có lỗi xảy ra' }} - Dashboard Đại Lý</title>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('clients/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        @include('parts.clients.header')

        <div id="layoutSidenav">
            
            @include('parts.clients.sidebar')

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        @include('parts.clients.page_title')

                        @yield('content')


                    </div>
                </main>


                @include('parts.clients.footer')

               
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('clients/js/scripts.js')}}"></script>
        


           
        @yield('scripts')
    </body>
</html>
