@extends('layouts.backend')
@section('content')

    <form action="" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Tên đại lý</label>
                    <select name="agent" id="" class="form-select @error('agent') is-invalid  @enderror">
                        <option value="0">Chọn đại lý</option>
                        @if ($agents)
                            @foreach ($agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('name')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Số tiền</label>
                    <input type="text" name="amount" class="form-control  @error('amount') is-invalid  @enderror" placeholder="Nhập số tiền ..." value="{{old('amount')}}">
                    @error('amount')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                        
                </div>
            </div>


            <div class="col-12">
                <div class="mb-3">
                    <label for="">Mô tả</label>
                    <input type="text" name="description" class="form-control  @error('description') is-invalid  @enderror" placeholder="Nhập mô tả ..." value="{{old('description')}}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                        
                </div>
            </div>

            

            
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{route('admin.payments.index')}}" class="btn btn-danger">Hủy</a>
        </div>
        @csrf
    </form>




@endsection







