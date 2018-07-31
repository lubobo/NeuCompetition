{{--<!DOCTYPE HTML>--}}
{{--<html>--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<meta name="viewport"--}}
{{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<meta name="_token" content="{!! csrf_token() !!}"/>--}}
{{--<meta name="url" content="{{route('team_verify')}}">--}}

{{--<title>创建团队</title>--}}
{{--<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>--}}
{{--<script type="text/javascript" rel="script" src="/js/get_major.js"></script>--}}
{{--<script type="text/javascript" rel="script" src="/js/confirm.js"></script>--}}
{{--</head>--}}
{{--<body>--}}
@extends('layouts.master')
<meta name="url" content="{{route('team_verify')}}">
@section('title')
    创建团队
@endsection
@section('content')
    @if(session('error'))
        <h5 class="text-center text-danger">保存出错</h5>
    @endif
    <div class="col-xs-4 col-xs-offset-4">
        <form class="form-group" action="{{route('team_store')}}" method="post" id="form">
            {{csrf_field()}}
            <h4 class="text-center text-warning">团队名称<p> </p>
                <input class="form-control" type="text" id="team_name" name="name" value="{{session('name')}}">
            </h4>
            <h4 class="text-center text-warning">团队介绍<p> </p>
                <script type="text/javascript"  src="{{ URL::to('/ckeditor/ckeditor.js')}}"></script>
                <textarea class="form-control" name="info" rows="15">{{session('info')?session('info'):''}}</textarea>
            </h4>
            <br>
            <input class="btn btn-block btn-success" type="button" id="btn" value="创建">
        </form>
    </div>
    <?php session(['name'=>null,'info'=>null,'error'=>null]);?>
@endsection

{{--</body>--}}
{{--</html>--}}