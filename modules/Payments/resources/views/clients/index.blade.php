@extends('layouts.clients')

@section('content')


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
            

        </tr>
    </thead>
    <tfoot>
        <tr>

            <th>Tên đại lý</th>
            <th>Số tiền nạp</th>
            <th style="">Mô tả</th>
            <th style="width:15%">Trạng thái</th>
            <th>Người chuyển</th>
            <th class="sorting">Thời gian nạp</th>
           
        </tr>
    </tfoot>

    
   
</table>    

@include('parts.clients.delete')
@endsection

@section('scripts')
    <script> 
        $(document).ready( function(){
            $.ajax({
                url: "{{route('payments.data')}}",
                
                type: "GET",
                success: function(response) {
                    console.log(response);

                    var columns = [
                        {'data': 'agent'},
                        {'data': 'amount'},
                        {'data': 'description'},
                        {'data': 'status'},
                        {'data': 'confirmer'},
                        {'data': 'created_at'},
                    ];


                    new DataTable('#datatable', {
                        ajax: "{{route('payments.data')}}",
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






