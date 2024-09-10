@extends('layouts.backend')
@section('content')
@if (session('msg'))
        <div class="alert alert-danger text-center">{{session('msg')}}</div>
@endif
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên đại lý</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid  @enderror" placeholder="Nhập tên đại lý..." value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                        
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Nhập email ..." value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã đại lý</label>
                    <input type="text" name="code_agent" class="form-control @error('code_agent') is-invalid  @enderror" placeholder="Nhập mã đại lý ..." value="{{old('code_agent')}}">
                    @error('code_agent')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Cú pháp nạp</label>
                    <input type="text" name="syntax" class="form-control @error('syntax') is-invalid  @enderror" placeholder="Nhập cú pháp ..." value="{{old('syntax')}}">
                    @error('syntax')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="col-6">
                <div class="mb-3">
                    <label for="">Điện thoại</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid  @enderror" placeholder="Nhập số điện thoại ..." value="{{old('phone')}}">
                    @error('phone')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Facebook</label>
                    <input type="text" name="facebook" class="form-control @error('facebook') is-invalid  @enderror" placeholder="Nhập facebook ..." value="{{old('facebook')}}">
                    @error('facebook')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>



            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài khoảng ngân hàng</label>
                    <input type="text" name="bank_account" class="form-control @error('bank_account') is-invalid  @enderror" placeholder="Nhập tài khoản ngân hàng ..." value="{{old('bank_account')}}">
                    @error('bank_account')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>


            

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Nhập mật khẩu ..." value="{{old('password')}}">
                    @error('password')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Chọn game</label>
                    @if ($games)
                            @foreach ($games as $game)
                                <div>
                                    <input type="checkbox" name="games[]" id="game_{{$game->name}}" value="{{$game->name}}" class="form-check-input @error('games') is-invalid @enderror">
                                    <label for="game_{{$game->name}}" class="form-check-label">{{$game->name}}</label>
                                </div>
                                {{-- <option value="{{$game->id}}">{{$game->name}}</option> --}}
                            @endforeach
                            
                        @endif
                    @error('games')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{route('admin.agents.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>




@endsection







