{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<title>我的消息</title>--}}
{{--</head>--}}
{{--<body>--}}
@extends('layouts.master')
@section('title')
    我的消息
@endsection
@section('content')
<ul class="list-group">
    <li class="list-group-item text-center"><a href="{{route('message_personal')}}">个人消息@if($personal)<span class="glyphicon glyphicon-heart" style="color: red"><sup>有消息</sup></span>@endif</a></li>
    <li class="list-group-item text-center"><a href="{{route('message_team')}}">团队消息@if($team)<span class="glyphicon glyphicon-heart" style="color: red"><sup>有消息</sup></span>@endif</a></li>
    <li class="list-group-item text-center"><a href="{{route('message_all')}}">公共消息@if($all)<span class="glyphicon glyphicon-heart" style="color: red"><sup>有消息</sup></span>@endif</a></li>
</ul>
@endsection
{{--</body>--}}
{{--</html>--}}