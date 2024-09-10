@extends('layouts.backend')
@section('content')

@if (session('msg'))
    <div class="alert alert-success text-center">{{ session('msg') }}</div>
@endif

@if (isset($msg))
    <div class="alert alert-success text-center">{{$msg}}</div>
@endif

@if (isset($error))
    <div class="alert alert-danger text-center">{{$error}}</div>
@endif



    <form action="" method="POST">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Chọn đại lý</label>
                    <select name="agent" id="select_agent"  class="form-select @error('agent') is-invalid @enderror">
                        <option value="0" {{ (isset($data['agent']) && $data['agent'] == '0') || (old('agent') == '0' && !isset($data['agent'])) ?'selected' : '' }}>Chọn đại lý </option>

                        <option value="all" 
                            {{ 
                                (isset($data['agent']) && $data['agent'] == 'all') || 
                                (old('agent') == 'all' && !isset($data['agent'])) ? 'selected' : '' 
                            }}>
                            Tất cả đại lý
                        </option>

                        

                        @if ($agents)
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->name }}" 
                                    {{ 
                                        (isset($data['agent']) && $data['agent'] == $agent->name) || 
                                        (old('agent') == $agent->name && !isset($data['agent'])) ? 'selected' : '' 
                                    }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        @endif

                        <option value="error"
                            {{ 
                                (isset($data['agent']) && $data['agent'] == 'error') || 
                                (old('agent') == 'error' && !isset($data['agent'])) ? 'selected' : '' 
                            }}>
                            Giao dịch lỗi
                        </option>

                    </select>
                    
                    @error('name')
                        <div class="invalid-feedback ">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="start_date">Ngày bắt đầu</label>
                    <input type="date" 
                           name="start_date" 
                           id="start_date" 
                           class="form-control select_date @error('start_date') is-invalid @enderror" 
                           placeholder="Chọn ngày bắt đầu..." 
                           value="{{ isset($data['start_date']) ? $data['start_date'] : old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="col-4">
                <div class="mb-3">
                    <label for="end_date">Ngày kết thúc</label>
                    <input type="date" 
                           name="end_date" 
                           id="end_date" 
                           class="form-control select_date @error('end_date') is-invalid @enderror" 
                           placeholder="Chọn ngày kết thúc..." 
                           value="{{ isset($data['end_date']) ? $data['end_date'] : old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Xem dữ liệu</button>
        </div>
        @csrf
    </form>


    @if (isset($dataReport))
        <div class="row data">
            <div class="col-12" style="margin-top:10px">
                <p>
                    <a class="btn btn-primary"
                       href="{{ route('admin.payments.export', [
                           'agent' => $data['agent'],
                           'start_date' => $data['start_date'],
                           'end_date' => $data['end_date']
                       ]) }}">
                       Xuất Excel
                    </a>
                </p>
            </div>
            
            
        </div>

        <div class="row data">
            <div class="col-12" style="margin:20px 0; ">
                Tổng nạp: {{$dataReport['sumPayments']}}
            </div>
        </div>


        <div class="row data">
            <div class="col-12">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên đại lý</th>
                            <th class="text-center">Số tiền nạp</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Thời gian nạp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataReport['data'] as $key => $data)
                            <tr>
                                <td class="text-center" >{{ $key +1}}</td>
                                <td class="text-center">{{ $data['agent'] }}</td>
                                <td class="text-end">{{ $data['amount'] }}</td>
                                <td>{{ $data['description'] }}</td>
                                <td class="text-center">{{ $data['created_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    
                    
                    <tfoot>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên đại lý</th>
                            <th class="text-center">Số tiền nạp</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Thời gian nạp</th>
                        </tr>
                    </tfoot>
                
                </table>  
            </div>
        </div>
    @endif

    


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
        $('#select_agent, .select_date').on('change', function() {
            $('.data').hide();
        });
        });
    </script>
@endsection





