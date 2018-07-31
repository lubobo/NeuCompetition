@extends('layouts.dashboard')
@section('title')
    数据导入信息
@endsection
@section('content')
    <div style="margin-top:10px;">
        <h3 class="text-center">导入信息反馈</h3>
        <h5>共申请导入数据：{{$all}}条</h5>
        <h5>导入成功:{{$success}}条</h5>
        <h5>导入失败:{{$failed}}条</h5>
        @if($failed)
            <h6>失败信息：</h6>
            @foreach($errors as $error)
                <h4>{{$error}}</h4>
            @endforeach
        @endif
    </div>
@endsection
