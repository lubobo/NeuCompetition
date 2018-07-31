<!Doctype html>
<html style="height:80%;padding: 0;margin: 0;">
<head>
    <title>欢迎登录</title>
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('/src/css/main.css')}}">
    <script type="text/javascript" src="{{ URL::to('/ckeditor/ckeditor.js')}}"></script>
    <script src="/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" rel="script" src="/js/get_major.js"></script>
    <script type="text/javascript" rel="script" src="/js/confirm.js"></script>
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>--}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <script>
        function re_captcha() {
            $url = "{{ URL('kit/captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
        }
    </script>
</head>
<body style="height:100%;padding-bottom: 0;background-color: #3c3c3c">
<div class="container col-xs-offset-4" style="width: 30%;margin-top: 5%;background-color: #bbbbbb">
    <div class="panel panel-default" style="margin-top: 3.8%">
        <div class="panel panel-title" style="background-color: #1b6d85">
            <h4 class="text-center" style="color: #ffffee">
                <span class="glyphicon glyphicon-user"> 管理员后台登录</span>
            </h4>
        </div>
        <form class="form-group col-xs-offset-2" style="width: 65%" method="post" action="{{route("login_process")}}">
            {{csrf_field()}}
            <h5>姓名：
                <select class="form-control" name="role">
                    <?php session(['middle'=>null]) ?>
                    <option>院级管理</option>
                    <option>校级管理</option>
                </select>
            </h5>
            <h5>用户名：<input class="form-control" type="text" placeholder="学号/邮箱" name="name" value="{{session('name')}}"></h5>
            <h5>密码：<input class="form-control" type="password" name="password"></h5>
            <h5 style="line-height:30px;">
                验证码：
                <input class="form-control" type="text" name="captcha" class="form-control"><p> </p>
                <a onclick="javascript:re_captcha();" style="line-height: inherit">
                    <img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="100%" id="c2c98f0de5a04167a9e427d883690ff6" border="0" style="vertical-align: middle">
                </a>
            </h5>
            {{--<a class="btn btn-sm btn-info" href="{{route('sendMail')}}">邮箱验证</a>--}}
            <p> </p>
            <button class="btn btn-block btn-success" type="submit">
                <span class="glyphicon glyphicon-send">
                    登陆管理
                </span>
            </button>
            {{--<a href="{{route('register')}}" class="btn btn-block btn-success">注册</a>--}}
            <br>
        </form>
    </div>
</div>
</body>
</html>
