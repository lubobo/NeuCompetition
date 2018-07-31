{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<title>Document</title>--}}
    {{--<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>--}}
@extends('layouts.master')
<script>
    $(document).ready(function () {
        $('#btn').click(function () {
            $("#status").val(0);
            $('#form').submit();
        })
    })
</script>
@section('title')
    邀请老师
@endsection
{{--</head>--}}
{{--<body>--}}
@section('content')
    <div class="panel panel-default">
        <h5 class="text-center text-success">{{$team->name}}邀请我成为其指导老师</h5>
    </div>
    <form class="form-group" method="post" action="{{route('invite_teacher_process_m')}}" id="form">
        {{csrf_field()}}
        <input type="hidden" value="{{$team->id}}" name="team_id">
        <input type="hidden" value="{{$message_id}}" name="message_id">
        <input type="hidden" value="1" name="status" id="status">
        @if($message_id!='R_R')
            <div class="col-xs-6 col-xs-offset-10">
                <input class="btn btn-success btn-sm" type="submit" value="同意">
                <input class="btn btn-danger btn-sm" type="button" value="拒绝" id="btn">
            </div>
        @else
            <h4 class="text-center text-danger"><del>同意 拒绝</del><span>(消息已经处理)</span></h4>
        @endif
    </form>
@endsection
{{--</body>--}}
{{--</html>--}}