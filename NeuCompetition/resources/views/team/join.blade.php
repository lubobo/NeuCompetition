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
    加入团队
@endsection
@section('content')
    <div class="panel panel-heading col-xs-4 col-xs-offset-4">
    <form id="form" class="form-group" action="{{route('team_join_process')}}" method="post">
        {{csrf_field()}}
        <h4 class="text-center text-warning">请输入TeamID:<p> </p><input type="text" class="form-control" id="teamID_join" name="team_id"></h4>
        <p> </p>
        <input class="btn btn-block btn-success" type="submit" value="申请加入">
    </form>
    <h5 class="text-center text-danger">{{session('message')?session('message'):''}}</h5>
    <?php session(['message'=>null]) ?>
    </div>
@endsection
{{--</body>--}}
{{--</html>--}}