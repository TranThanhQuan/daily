@extends('layouts.backend')
@section('content')
@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif
<form action="" method="POST">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="20%">Module</th>
                <th>Quyền</th>
            </tr>
        </thead>
        <tbody>
    
            @if($modules->count()>0)
                @foreach ($modules as $module)
                    <tr>
                        <td>{{$module->title}}</td>
                        <td>
                            <div class="row">
                                @if (!empty($roleListArr))
                                    @foreach ($roleListArr as $roleName => $roleLable)
                                        <div class="col-2">
                                            <lable for="role_{{$module->name}}_{{$roleName}}"> 
                                                <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_{{$roleName}}" 
                                                value="{{$roleName}}" {{isRole($roleArr, $module->name, $roleName) ? 'checked':false}}>
                                                {{$roleLable}}
                                            </lable>
                                        </div>
                                    @endforeach
    
                                @endif
    
    
    
                                @if ($module->name == 'groups')
                                    <div class="col-2">
                                        <lable for="role_{{$module->name}}_permission"> 
                                            <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_permission" value="permission" {{isRole($roleArr, $module->name, 'permission') ? 'checked':false}}>
                                            Phân quyền
                                        </lable>
                                    </div>
                                @endif

                                @if ($module->name == 'payments')
                                    <div class="col-2">
                                        <lable for="role_{{$module->name}}_confirm"> 
                                            <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_confirm" value="confirm" {{isRole($roleArr, $module->name, 'confirm') ? 'checked':false}}>
                                            Xác nhận chuyển GP
                                        </lable>
                                    </div>

                                    <div class="col-2">
                                        <lable for="role_{{$module->name}}_report"> 
                                            <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_report" value="report" {{isRole($roleArr, $module->name, 'report') ? 'checked':false}}>
                                            Đối soát
                                        </lable>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Lưu phân quyền</button>
    @csrf
</form>



@endsection







