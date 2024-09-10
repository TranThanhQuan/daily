@extends('layouts.auth_clients')
@section('content')

<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div class="home-back">
            <a class="" href="#" onclick="document['form-logout'].submit(); return false; "><i class="fa-solid fa-circle-arrow-left"></i> Thoát</a>
            <form name="form-logout" action="{{route('clients.logout')}}"  method="POST">
                @csrf
            </form>
        </div>

        @if (session('msg'))
                <div class="alert alert-danger text-center">{{session('msg')}}</div>
        @endif

        <div id="login-row" class="row justify-content-center align-items-center">
           <h1>Tài khoản của bạn đã bị vô hiệu hóa</h1>
           <h2>Vui lòng liên hệ admin để được hỗ trợ</h2>
        </div>
    </div>
</div>
@endsection