{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<title>Document</title>--}}
{{--</head>--}}
{{--<body>--}}
@extends('layouts.master')
@section('title')
    我的团队
@endsection
@section('content')
    <div class="panel panel-default">
        <h4 class="text-center text-danger">队伍名称: {{$team_name}}</h4>
    </div>
    @if(!$team_teacher)
        <div class="panel panel-body">
            <h5 class="text-center text-success">指导老师：暂无@if($role=='creator')<a href={{route("invite_teacher",[$team->teamID])}}>邀请？</a>@endif</h5>
            @else
                <h5 class="text-center text-success">指导老师：{{$team_teacher}}</h5>
            @endif
            <div class="panel panel-body">
                <h5 class="text-warning text-center">参加的比赛:</h5>
                <ul class="list-group text-center">
                    <?php $k=0 ?>
                    <li class="list-group-item"><b>队长：{{$leader}}</b></li>
                    @foreach($students as $student)
                        <li class="list-group-item col-xs-12">
                            <div class="col-xs-4 col-xs-offset-4">
                                队员<?php $k++ ?>:{{$student[1]}}
                                <div class="col-xs-12">
                                    @if($role=='creator')
                                        <a class="btn btn-xs btn-danger" href="{{route('fire',[$student[0],$teamID])}}">
                                            踢出去
                                        </a>
                                    @else
                                        <a class="btn btn-xs btn-danger" href="{{route('team_quit',[$teamID])}}">
                                            退出
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection
{{--</body>--}}
{{--</html>--}}
