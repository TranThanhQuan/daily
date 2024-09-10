@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')

    @if (session('msg'))
            <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif

    <p><a href="{{route('admin.policy.index')}}" class="btn btn-primary">Xem chính sách</a></p>

    <form action="" method="POST">
        <div class="row">
            
            <div class="col-12">
                <div class="mb-3">
                    <label for=""></label>
                    <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror" placeholder="Nhập nội dung ..." rows="20">{{ old('content') ?? $policy->content }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            
            
            

        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('admin.policy.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>
    
  
@endsection
@section('scripts')
    <script> 
        ClassicEditor
        .create(document.querySelector('#editor'),{
            ckfinder:{
                uploadUrl: "{{route('admin.policy.upload',['_token' => csrf_token()])}}"
            }
        })
        .then(editor => {
            // console.log(editor);
        })
        .catch( error => {
            console.log(error);
        })
    </script>
@endsection