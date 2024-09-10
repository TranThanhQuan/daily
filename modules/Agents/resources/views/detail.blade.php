@extends('layouts.backend')
@section('content')




    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên đại lý</label>
                <input readonly type="text" name="name" class="form-control" value="{{$agent->name}}">
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input readonly type="text" name="email" class="form-control "  value="{{$agent->email}}">
                
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Mã đại lý</label>
                <input readonly type="text" name="code_agent" class="form-control" value="{{$agent->code_agent}}">
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Cú pháp nạp</label>
                <input readonly type="text" name="syntax" class="form-control " value="{{$agent->syntax}}">
            </div>
        </div>


        <div class="col-6">
            <div class="mb-3">
                <label for="">Điện thoại</label>
                <input readonly type="text" name="phone" class="form-control " value="{{$agent->phone}}">
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Facebook</label>
                <input readonly type="text" name="facebook" class="form-control"value="{{ $agent->facebook}}">
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Tài khoảng ngân hàng</label>
                <input readonly type="text" name="bank_account" class="form-control"value="{{$agent->bank_account}}">
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="">Game</label>
                @if ($games)
                        @foreach ($games as $game)
                            <div>
                                <input type="checkbox" onclick="return false;" {{ strpos($agent->game, $game->name) !== false ? 'checked' : false }}
                                name="games[]" id="game_{{$game->name}}" value="{{$game->name}}" class="form-check-input">
                                <label for="game_{{$game->name}}" class="form-check-label">{{$game->name}}</label>
                            </div>
                        @endforeach
                        
                    @endif
                
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.agents.index')}}" class="btn btn-primary">Trở lại</a>
        </div>
    </div>

@endsection







