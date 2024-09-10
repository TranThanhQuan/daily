@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')

    @if (session('msg'))
            <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif

    <form action="" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid  @enderror" placeholder="Nhập tên ..." value="{{old('name') ?? $group->name}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                        
                </div>
            </div>

        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('admin.groups.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>
@endsection
