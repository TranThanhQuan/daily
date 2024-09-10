@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')

    @if (session('msg'))
            <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif

    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid  @enderror" placeholder="Nhập tên ..." value="{{old('name') ?? $user->name}}">
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
                    <input type="text" name="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Nhập email ..." value="{{old('email') ?? $user->email}}">
                    @error('email')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Nhóm</label>
                    <select name="group_id" id="" class="form-select @error('group_id') is-invalid  @enderror">
                        <option value="0">Chọn nhóm</option>
                        @if($groups->count()>0)
                            @foreach ($groups as $item)
                                <option value="{{$item->id}}" {{$user->group_id == $item->id || old('group_id') == $item->id ?'selected':false}} >{{$item->name}}</option>
                            @endforeach
                        @endif

                    </select>
                    @error('group_id')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Nhập mật khẩu ..." value="">
                    @error('password')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>

    
@endsection
