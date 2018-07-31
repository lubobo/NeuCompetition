{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<title>个人消息</title>--}}
{{--</head>--}}
{{--<body>--}}
@extends('layouts.master')
@section('title')
    个人消息
@endsection
@section('content')
<ul class="list-group">
    <li class="list-group-item text-center text-danger"><h4>未读消息</h4>
        <ul class="list-group">
            @if(count($noreads)==0)
                <li class="list-group-item">暂无</li>
            @endif
            @foreach($noreads as $noread)
                    <li class="list-group-item row">
                        <div class="col-xs-6 col-xs-offset-3">
                            <a href="{{$noread->message_url.'/'.$noread->id}}">{{'('.$noread->created_at.')'.$noread->message_info}}</a>
                        </div>
                            {{--@if($noread->message_sorts_id==1)--}}
                                {{--<a href="{{route('message_operate',[$noread->id,1])}}">忽略</a>--}}
                                {{--<a href="{{route('message_operate',[$noread->id,'0-n'])}}">删除</a>--}}
                            {{--@elseif($noread->message_sorts_id==(4||3))--}}
                                {{--<a href="{{route('message_operate',[$noread->id,1])}}">标记为已读</a>--}}
                            {{--@endif--}}
                        <div class="col-xs-offset-10">
                            <a class="btn btn-xs btn-success" href="{{route('message_operate',[$noread->id,1])}}">标记为已读</a>
                            <a class="btn btn-xs btn-danger" href="{{route('message_operate',[$noread->id,'0-n'])}}">删除</a>
                        </div>
                    </li>
            @endforeach
        </ul>
    </li>
    <li class="list-group-item text-center text-success"><h4>已读消息</h4>
        <ul class="list-group">
            @if(count($reads)==0)
                <li class="list-group-item">暂无</li>
            @endif
            @foreach($reads as $read)
                    <li class="list-group-item">
                        <div class="col-xs-6 col-xs-offset-3 row">
                            <a href="{{$read->message_url.'/R_R'}}">{{'('.$read->updated_at.')'.$read->message_info}}</a>
                        </div>
                        <div class="col-xs-offset-9">
                            <a class="btn btn-xs btn-danger" href="{{route('message_operate',[$read->id,'0-r'])}}">删除</a>
                        </div>
                    </li>
            @endforeach
        </ul>
    </li>
</ul>
@endsection
{{--</body>--}}
{{--</html>--}}