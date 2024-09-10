@extends('layouts.clients')

@section('content')

    <table class="table table-bordered">
        <tr>
            <td width= "20%">Tên đại lý</td>
            <td width= >{{$agent->name}}</td>
        </tr>

        <tr>
            <td width= "20%">Email</td>
            <td width= >{{$agent->email}}</td>
        </tr>

        <tr>
            <td width= "20%">Mã đại lý</td>
            <td width= >{{$agent->code_agent}}</td>
        </tr>

        <tr>
            <td width= "20%">Game</td>
            <td width= >{{$agent->game}}</td>
        </tr>

        <tr>
            <td width= "20%">Cú pháp nạp</td>
            <td width= >{{$agent->syntax}}</td>
        </tr>

        <tr>
            <td width= "20%">Điện thoại</td>
            <td width= >{{$agent->phone}}</td>
        </tr>

        <tr>
            <td width= "20%">Facebook</td>
            <td width= >{{$agent->facebook}}</td>
        </tr>

        <tr>
            <td width= "20%">Tài khoản ngân hàng</td>
            <td width= >{{$agent->bank_account}}</td>
        </tr>

        <tr>
            <td width= "20%" class="thisMonth-1"></td>
            <td width= >{{$agent->tongNapThangNay}}</td>
        </tr>
        <tr>
            <td width= "20%" class="thisMonth-2"></td>
            <td width= >{{$agent->hoaHongThangNay}}</td>
        </tr>

        <tr>
            <td width= "20%" class="previousMonth-1"></td>
            <td width= >{{$agent->tongNap1thangtruoc}}</td>
        </tr>
        <tr>
            <td width= "20%" class="previousMonth-2"></td>
            <td width= >{{$agent->hoaHong1ThangTruoc}}</td>
        </tr>


        <tr>
            <td width= "20%" class="twoMonthsAgo-1"></td>
            <td width= >{{$agent->tongNap2thangtruoc}}</td>
        </tr>

        <tr>
            <td width= "20%" class="twoMonthsAgo-2"></td>
            <td width= >{{$agent->hoaHong2ThangTruoc}}</td>
        </tr>
    </table>
  

{{-- @include('parts.clients.delete') --}}
@endsection

@section('scripts')
    <script>
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
</script>
@endsection






