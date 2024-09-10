@extends('layouts.auth')

@section('content')
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">{{$pageTitle}}</h3></div>
    <div class="card-body">
        <form method="POST" action="{{route('login')}}">
            <div class="form-floating mb-3">
                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" value="{{old('email')}}"/>
                <label for="inputEmail">Email ...</label>
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Mật khẩu..." />
                <label for="inputPassword">Mật khẩu ... </label>
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            {{-- <div class="form-check mb-3">
                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                <label class="form-check-label" for="inputRememberPassword">Ghi nhớ mật khẩu</label>
            </div> --}}
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="small" href="#">Quên mật khẩu?</a>
                <button class="btn btn-primary" type="submit"> Đăng nhập</button>
            </div>
            @csrf
        </form>
    </div>
    {{-- <div class="card-footer text-center py-3">
        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
    </div> --}}
</div>
@endsection
