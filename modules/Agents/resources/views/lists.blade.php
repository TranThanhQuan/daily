@extends('layouts.backend')
@section('content')


@can('create', Modules\Agents\src\Models\Agent::class)
<p><a href="{{route('admin.agents.create')}}" class="btn btn-primary">Thêm đại lý </a></p>
@endcan()


@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif

<table id="datatable" class="table table-bordered ">
    <thead>
        <tr>
            <th>Tên đại lý</th>

            <th class="twoMonthsAgo-1 text-center"></th>

            <th class="twoMonthsAgo-2 text-center"></th>

            <th class="previousMonth-1 text-center"></th>

            <th class="previousMonth-2 text-center"></th>
            
            <th class="thisMonth-1 text-center"></th>

            <th class="thisMonth-2 text-center"></th>

            @can('viewAny', Modules\Agents\src\Models\Agent::class)
            <th style="">Thông tin</th>
            @endcan() 
            
            @can('update', Modules\Agents\src\Models\Agent::class)
                <th style="">Sửa</th>
            @endcan()   

            @can('delete', Modules\Agents\src\Models\Agent::class)
            <th style="">Xóa</th>
            @endcan()   

        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên đại lý</th>
            <th class="twoMonthsAgo-1 text-center"></th>
            <th class="twoMonthsAgo-2 text-center"></th>
            <th class="previousMonth-1 text-center"></th>
            <th class="previousMonth-2 text-center"></th>
            <th class="thisMonth-1 text-center"></th>
            <th class="thisMonth-2 text-center"></th>
            @can('update', Modules\Agents\src\Models\Agent::class)
                <th style="">Thông tin</th>
            @endcan() 
            @can('update', Modules\Agents\src\Models\Agent::class)
                <th style="">Sửa</th>
            @endcan()   
            @can('delete', Modules\Agents\src\Models\Agent::class)
            <th style="">Xóa</th>
            @endcan()    
        </tr>
    </tfoot>
   
</table>    

@include('parts.backend.delete')
@endsection

@section('scripts')
    <script> 
        $(document).ready( function(){
            // Lấy tháng hiện tại và các tháng trước
            var currentMonth = new Date().getMonth() + 1; // JavaScript trả về tháng từ 0-11
            var lastMonth = (currentMonth - 1 <= 0) ? 12 : currentMonth - 1; 
            var twoMonthsAgo = (lastMonth - 1 <= 0) ? 12 : lastMonth - 1;

            // Gán nội dung cho các phần tử
            $('.twoMonthsAgo-1').html(`Tổng nạp tháng ${twoMonthsAgo}`);
            $('.twoMonthsAgo-2').html(`Hoa hồng tháng ${twoMonthsAgo}`);
            $('.previousMonth-1').html(`Tổng nạp tháng ${lastMonth}`);
            $('.previousMonth-2').html(`Hoa hồng tháng ${lastMonth}`);
            $('.thisMonth-1').html(`Tổng nạp tháng ${currentMonth}`);
            $('.thisMonth-2').html(`Hoa hồng tháng ${currentMonth}`);


            $.ajax({
                url: "{{ route('admin.agents.data') }}",
                type: "GET",
                success: function(response) {
                    // Define the base columns
                    var columns = [
                        {'data': 'name'},
                        {'data': 'twoMonthsAgo'},
                        {'data': 'commissionTwoMonthsAgo'},
                        {'data': 'previousMonth'},
                        {'data': 'commissionPreviousMonth'},
                        {'data': 'thisMonth'},
                        {'data': 'commissionThisMonth'},
                        {'data': 'detail'},

                        
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
                        ajax: "{{route('admin.agents.data')}}",
                        processing: true,
                        serverSide: true,
                        "columns" : columns
                    });
                }
            });
        });
    </script>
@endsection






