@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')


@can('create', Modules\User\src\Models\User::class)
<p><a href="{{route('admin.users.create')}}" class="btn btn-primary">Thêm mới </a></p>
@endcan()


@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif

<table id="datatable" class="table table-bordered">


    <thead>
        
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            
            @can('update', Modules\User\src\Models\User::class)
                <th style="width:10%">Sửa</th>
            @endcan()   
            @can('delete', Modules\User\src\Models\User::class)
            <th style="width:10%">Xóa</th>
            @endcan()   

        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            @can('update', Modules\User\src\Models\User::class)
            <th style="width:10%">Sửa</th>
            @endcan()   
            @can('delete', Modules\User\src\Models\User::class)
            <th style="width:10%">Xóa</th>
            @endcan()   
        </tr>
    </tfoot>
   
</table>    

@include('parts.backend.delete')
@endsection

@section('scripts')
    <script> 
        $(document).ready( function(){
            $.ajax({
                url: "{{ route('admin.users.data') }}",
                type: "GET",
                success: function(response) {
                    // Define the base columns
                    var columns = [
                        {'data': 'name'},
                        {'data': 'email'},
                        {'data': 'group_id'},
                        {'data': 'created_at'}
                    ];

                    // Check if the response contains "edit" data in the first row
                    if (response.data.length > 0 && response.data[0].edit !== '') {
                        columns.push({'data': 'edit'});
                    }

                    // Check if the response contains "delete" data in the first row
                    if (response.data.length > 0 && response.data[0].delete !== '') {
                        columns.push({'data': 'delete'});
                    }

                    new DataTable('#datatable', {
                        ajax: "{{route('admin.users.data')}}",
                        processing: true,
                        serverSide: true,
                        "columns" : columns
                    });
                }
            });
        });
    </script>
@endsection






