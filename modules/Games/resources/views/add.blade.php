@extends('layouts.backend')
@section('content')

    <form action="" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid  @enderror" placeholder="Nhập tên game..." value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                        
                </div>
            </div>

        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>




@endsection







