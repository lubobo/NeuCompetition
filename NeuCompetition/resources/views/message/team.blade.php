{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<title>团队消息</title>--}}
{{--</head>--}}
{{--<body>--}}
@extends('layouts.master')
@section('title')
    团队消息
@endsection
@section('content')
    <ul class="list-group">
        <li class="list-group-item"><h4 class="text-center text-warning">未读消息</h4>
            <ul class="list-group">
                @if(count($noreads)==0)
                    <li class="list-group-item text-center text-danger">暂无</li>
                @endif
                @foreach($noreads as $noread)
                    <li class="list-group-item text-center text-success">
                        <a href="{{$noread->message_url.'/'.$noread->id}}">{{$noread->message_info}}</a>
                        {{--@if($noread->message_sorts_id==1)--}}
                        {{--<a href="{{route('message_operate',[$noread->id,1])}}">忽略</a>--}}
                        {{--<a href="{{route('message_operate',[$noread->id,'0-n'])}}">删除</a>--}}
                        {{--@elseif($noread->message_sorts_id==(4||3))--}}
                        {{--<a href="{{route('message_operate',[$noread->id,1])}}">标记为已读</a>--}}
                        {{--@endif--}}
                        <a href="{{route('message_operate',[$noread->id,3])}}">标记为已读</a>
                        <a href="{{route('message_operate',[$noread->id,'2-n'])}}">删除</a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="list-group-item"><h4 class="text-center text-warning">已读消息</h4>
            <ul class="list-group">
                @if(count($reads)==0)
                    <li class="list-group-item text-center text-danger">暂无</li>
                @endif
                @foreach($reads as $read)
                    <li class="list-group-item text-center text-success">
                        <a href="{{$read->message_url.'/R_R'}}">{{$read->message_info}}</a>
                        <a href="{{route('message_operate',[$read->id,'2-r'])}}">删除</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
@endsection
{{--</body>--}}
{{--</html>--}}