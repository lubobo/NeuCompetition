{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="process_url" content="{{route('invite_teacher_process')}}">
    {{--<title>Document</title>--}}
    <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
    <script type="text/javascript" rel="script" src="/js/get_teacher.js"></script>

{{--</head>--}}
{{--<body>--}}

@extends('layouts.master')
<script>
    $(document).ready(function () {
        $('#college').change(function () {
            alert($("#college option:selected").text());
        })
    })
</script>
@section('title')
    邀请老师
@endsection
@section('content')
    <div class="col-xs-4 col-xs-offset-4">
        <select class="form-control" id="college">
            <option style="display: none">{{$college_name}}</option>
            @foreach($colleges as $college)
                <option>
                    {{$college['college_name']}}
                </option>
            @endforeach
            <option></option>
        </select>
    <form class="form-group" method="post" id="form" action="{{route('invite_teacher_m')}}">
        {{csrf_field()}}
        <input class="form-control" type="hidden" value="{{$team_id}}" name="team_id">
        @foreach($teachers as $teacher)
            <p class="initial_tea"><label>{{$teacher->name.'老师'}}</label><input type="radio" name="teacher_num" value="{{$teacher->num}}"></p>
        @endforeach
        <p> </p>
        <input class="btn btn-block btn-success" type="submit" value="邀请～">
    </form>
    </div>
@endsection
{{--</body>--}}
{{--</html>--}}