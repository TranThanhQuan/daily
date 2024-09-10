@extends('layouts.backend')
@section('title', 'Quản lý người dùng')
@section('content')


@can('update', Modules\Policy\src\Models\Policy::class)
<p><a href="{{route('admin.policy.edit')}}" class="btn btn-warning">Chỉnh sửa</a></p>
@endcan()
<hr>

@if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif


<div class="content">
    {!! $policy->content !!}
</div>


@include('parts.backend.delete')
@endsection






