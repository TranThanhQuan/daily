@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')

@can('create', Modules\Groups\src\Models\Groups::class)
<p><a href="{{route('admin.groups.create')}}" class="btn btn-primary">Thêm mới </a></p>
@endcan()
@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif


<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Tên nhóm</th>
            
            @can('permission', Modules\Groups\src\Models\Group::class)
                <th style="width:20%">Phân quyền</th>
            @endcan()   
            @can('update', Modules\Groups\src\Models\Group::class)
                <th style="width:10%">Sửa</th>
            @endcan()   
            @can('delete', Modules\Groups\src\Models\Group::class)
                <th style="width:10%">Xóa</th>
            @endcan() 
        </tr>
    </thead>
    <tfoot>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Tên nhóm</th>
            @can('permission', Modules\Groups\src\Models\Group::class)
                <th style="width:20%">Phân quyền</th>
            @endcan()   
            @can('update', Modules\Groups\src\Models\Group::class)
                <th style="width:10%">Sửa</th>
            @endcan()   
            @can('delete', Modules\Groups\src\Models\Group::class)
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
                url: "{{ route('admin.groups.data') }}",
                type: "GET",
                success: function(response) {
                    // Define the base columns
                    var columns = [
                        // {'data': 'id'},
                        {'data': 'name'},
                    ];
                    if (response.data.length > 0 && response.data[0].permissions !== '') {
                        columns.push({'data': 'permissions'});
                    }
                    // // Check if the response contains "edit" data in the first row
                    if (response.data.length > 0 && response.data[0].edit !== '') {
                        columns.push({'data': 'edit'});
                    }

                    // // Check if the response contains "delete" data in the first row
                    if (response.data.length > 0 && response.data[0].delete !== '') {
                        columns.push({'data': 'delete'});
                    }

                    

                    new DataTable('#datatable', {
                        ajax: "{{route('admin.groups.data')}}",
                        processing: true,
                        serverSide: true,
                        "columns" : columns
                    });
                }
            });


        });
    </script>
@endsection






