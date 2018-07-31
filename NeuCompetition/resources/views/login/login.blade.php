@extends('layouts.master')
<script>
    function re_captcha() {
        $url = "{{ URL('kit/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
</script>
@section('title')
    登陆
@endsection
@section('content')

    <h5 class="text-center text-danger">{{session('error')}}</h5>
    <div class="col-xs-4 col-xs-offset-4">
        <form class="form-group" method="post" action="{{route("login_process")}}">
            {{csrf_field()}}
            <h4 class="text-center text-warning">用户登陆</h4>
            <h5>姓名：
                <select class="form-control" name="role">
                    @if(session('url')!=route('adminHome')||!session('middle'))
                        <option>Student</option>
                        <option>Teacher</option>
                    @endif
                    {{--<?php session(['middle'=>null]) ?>--}}
                    {{--<option>C_Admin</option>--}}
                    {{--<option>S_Admin</option>--}}
                </select>
            </h5>
            <h5>用户名：<input class="form-control" type="text" placeholder="学号/邮箱" name="name" value="{{session('name')}}"></h5>
            <h5>密码：<input class="form-control" type="password" name="password"></h5>
            <h5 style="line-height:30px;">
                验证码：
                <input class="form-control" type="text" name="captcha" class="form-control"><p> </p>
                <a onclick="javascript:re_captcha();" style="line-height: inherit">
                    <img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="100%" height="10%" id="c2c98f0de5a04167a9e427d883690ff6" border="0" style="vertical-align: middle">
                </a>
            </h5>
            {{--<a class="btn btn-sm btn-info" href="{{route('sendMail')}}">邮箱验证</a>--}}
            <p> </p>
            <input class="btn btn-block btn-success" type="submit" value="登陆">
            <a href="{{route('register')}}" class="btn btn-block btn-success">注册</a>
            {{--<a href="{{route('getBack')}}" class="btn btn-block btn-warning"></a>--}}

            {{--<input class="btn btn-block btn-warning" type="button" data-toggle="modal" data-target="#myModal" value="找回密码">--}}
            {{--<span class="glyphicon glyphicon-repeat">找回密码</span>--}}
            {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-block btn-warning">--}}
                {{--找回密码--}}
            {{--</a>--}}
            <a  href="{{route('getBack')}}" class="btn btn-block btn-warning">
                找回密码
            </a>
        </form>
        {{--<form action="https://sms.yunpian.com/v1/sms/send.json" method="post">--}}
        {{--<form action="{{route('getBack')}}" method="post">--}}
        {{--<input class="hidden" name="apikey" value="c756c83c4fd6e216a616e1f6ba652e43">--}}
        {{--<input class="hidden" name="mobile" value="18240438909">--}}
        {{--<input class="hidden" name="text" value="【东大科技竞赛平台】欢迎您使用东北大学科技竞赛平台，您的短信验证码是#999999#">--}}
        {{--<input class="hidden" name="_token" value="{{csrf_token()}}">--}}
        {{--<input class="btn btn-block btn-warning" type="submit" value="找回密码">--}}
        {{--</form>--}}
        <div id="collapseOne" class="panel-collapse collapse">
            <form action="#" method="post">
                手机验证码：<input name="code" type="text" class="form-control">
                <p> </p>
                <input class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal" value="获取验证码">
            </form>
        </div>
    </div>

    {{--模态框--}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-group" action="https://sms.yunpian.com/v1/sms/send.json" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-repeat"> 发送手机验证码</span></h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="mobile" class="form-control" placeholder="填写注册所用电话号码......">
                    </div>
                    <div class="modal-footer">
                        <input class="hidden" name="apikey" value="c756c83c4fd6e216a616e1f6ba652e43">
                        {{--<input class="form-control" type="text" name="mobile">--}}
                        <input class="hidden" name="text" value="【东大科技竞赛平台】欢迎您使用东北大学科技竞赛平台，您的短信验证码是#999999#">
                        <input class="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection