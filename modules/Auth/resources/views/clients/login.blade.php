@extends('layouts.auth_clients')
@section('content')

<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        {{-- <div class="home-back">
            <a href="{{route('home')}}">
                <span><i class="fa-solid fa-arrow-left"></i></span> Về trang chủ
            </a>
        </div> --}}

        @if (session('msg'))
                <div class="alert alert-danger text-center">{{session('msg')}}</div>
        @endif

        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">{{$pageTitle}}</h3>
                        <div class="form-group">
                            <label for="inputEmail">Email ...</label>
                            <input class="form-control" name="email" id="inputEmail" type="text" placeholder="Email ..." value="{{old('email')}}"/>
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Mật khẩu ... </label>
                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Mật khẩu..." />
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <input class="form-check-input" id="inputRememberPassword" name="remember" type="checkbox" value="1" />
                            <label class="form-check-label" for="inputRememberPassword">Ghi nhớ mật khẩu</label>
                        </div>
                        {{-- <div id="register-link" class="text-right">
                            <a href="#" class="text-info">Register here</a>
                        </div> --}}

                        <div class="d-flex align-items-center justify-content-center mb-0 text-center">
                            {{-- <a class="small" href="#">Quên mật khẩu?</a> --}}
                            <button class="btn btn-primary" type="submit"> Đăng nhập</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection