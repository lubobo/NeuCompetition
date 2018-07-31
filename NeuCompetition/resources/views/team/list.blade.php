@extends('layouts.master')
@section('title')
    我的团队
@endsection
@section('content')
    <ul class="list-group">
        <h3 class="text-center text-warning">我的团队</h3>
        <li class="list-group-item">
            <h4 class="text-warning text-center">
                <a href="{{route('team_create')}}">
                    <span class="glyphicon glyphicon-plus"> 创建团队</span>
                </a>
            </h4>
            <ul class="list-group">
                @if(!$creates->first())
                    <li class="list-group-item">
                        <span class="col-xs-offset-5">
                            暂无信息--->
                            <a class="btn btn-xs btn-success" href="{{route('team_create')}}">
                                <span class="glyphicon glyphicon-hand-right"> 创建一个？</span>
                            </a>
                        </span>
                    </li>
                @endif
                @foreach($creates as $create)
                    <li class="list-group-item">
                        <span class=" col-xs-offset-5">
                            <div class="col-xs-1 col-xs-offset-1">
                            <a class="btn btn-xs btn-warning" href="{{route('my_team',['creator',$create['id']])}}">
                                <span class="glyphicon glyphicon-user"> {{$create->name}}</span>
                            </a>
                            </div>
                            <a class="btn-danger btn btn-xs" href="{{route('team_dissolved',[$create['teamID']])}}">
                                <span class="glyphicon glyphicon-trash"> 解散团队</span>
                            </a>
                            <h5 class="text-right" style="display: inline">TeamID:{{$create->teamID}}</h5>
                        </span>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="list-group-item">
            <h4 class="text-warning text-center">
                <a href="{{route('team_join')}}">
                    <span class="glyphicon glyphicon-share-alt"> 加入团队</span>
                </a>
            </h4>
            <ul class="list-group">
                @if(!$joins->first())
                    <li class="list-group-item">
                        <span class="col-xs-offset-5">
                            暂无信息--->
                            <a class="btn btn-xs  btn-success" href="{{route('team_join')}}">
                                <span class="glyphicon glyphicon-hand-right"> 加入一个？</span>
                            </a>
                        </span>
                    </li>
                @endif
                @foreach($joins as $join)
                    <li class="list-group-item">
                        <span class=" col-xs-offset-5">
                            <div class="col-xs-1 col-xs-offset-1">
                        <a class="btn btn-xs btn-warning" href="{{route('my_team',['joiner',$join['id']])}}">
                            <span class="glyphicon glyphicon-user"> {{$join->name}}</span>
                        </a>
                        <a class="btn-danger btn-xs btn" href="{{route('team_quit',[$join['teamID']])}}">
                            <span class="glyphicon glyphicon-trash"> 退出团队</span>
                        </a>
                        <h5 style="display: inline">TeamID:{{$join->teamID}}</h5>
                       </span>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
@endsection
