@extends('layouts.backend')
{{-- @section('title', 'Quản lý người dùng') --}}
@section('content')


<div class="row">
    @can('create', Modules\Payments\src\Models\Payments::class)
    <div class="col-2">
                
        <p ><a href="{{route('admin.payments.create')}}" class="btn btn-primary ">Thêm giao dịch </a></p>
        
    </div>
    @endcan()

   
</div>


@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif

<table id="datatable" class="table table-bordered">

    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Tên đại lý</th>
            <th>Số tiền nạp</th>
            <th >Mô tả</th>
            <th style="width:15%">Trạng thái</th>
            <th>Người chuyển</th>
            <th class="sorting">Thời gian nạp</th>
            @can('confirm', Modules\Payments\src\Models\Payment::class)
            <th style="">Xác nhận đã chuyển</th>
            @endcan()   

        </tr>
    </thead>
    <tfoot>
        <tr>
            {{-- <th>ID</th> --}}

            <th>Tên đại lý</th>
            <th>Số tiền nạp</th>
            <th style="">Mô tả</th>
            <th style="width:15%">Trạng thái</th>

            <th>Người chuyển</th>
            <th class="sorting">Thời gian nạp</th>
            @can('confirm', Modules\Payments\src\Models\Payment::class)
            <th style="">Xác nhận đã chuyển</th>
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
                url: "{{ route('admin.payments.data') }}",
                type: "GET",
                success: function(response) {
                    var columns = [
                        {'data': 'agent'},
                        {'data': 'amount'},
                        {'data': 'description'},
                        {'data': 'status'},
                        {'data': 'confirmer'},
                        {'data': 'created_at'},
                    ];

                    if (response.data.length > 0 && response.data[0].confirm !== '') {
                        columns.push({'data': 'confirm'});
                    }

                    new DataTable('#datatable', {
                        ajax: "{{route('admin.payments.data')}}",
                        processing: true,
                        serverSide: true,
                        "columns" : columns,
                        "order": [[5, 'desc']]
                    });
                }
            });
        });
    </script>
@endsection






