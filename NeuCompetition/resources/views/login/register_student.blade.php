@extends('layouts.master')
@section('title')
    完善信息
@endsection
<script>
    function re_captcha() {
        $url = "{{ URL('kit/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
</script>
@section('content')
    <div class="col-xs-4 col-xs-offset-4">
        <form class="form-group" action="/register/store" method="post" id="form">
            {!! csrf_field() !!}
            <input type="hidden" value="student" name="role">
            <h4 class="text-center text-warning">学生注册</h4>
            <h5>姓名：<input class="form-control" type="text" name="name" id="name" value="{{session('name')}}"></h5>
            <h5>学号：<input class="form-control" type="text" name="num" id="num" value="{{session('num')}}"></h5>
            <h5>学院：
                <select class="form-control" name="college" id="college">
                    <option value='no' selected="selected" disabled="disabled" style="display: none">请选择</option>
                    @foreach($colleges as $college)
                        <option value="{{$college['college_name']}}">{{$college['college_name']}}</option>
                    @endforeach
                </select></h5>
            <h5>班级：<input class="form-control" type="text" id="class" name="class" value="{{session('class')}}"></h5>
            <h5>身份证号：<input class="form-control" type="text" id="cardID" name="cardID" value="{{session('job')}}"></h5>
            <h5>邮箱：<input class="form-control" type="text" id="email" name="email" value="{{session('email')}}"></h5>
            <h5>密码：<input class="form-control" type="password" name="password" id="password"></h5>
            <h5>确认密码：<input class="form-control" type="password" id="password_"></h5>
            <h5>手机号：<input class="form-control" type="text" id="phone_num" name="phone_num" value="{{session('phone_num')}}"></h5>
            <h5>QQ：<input class="form-control" type="text" id="qq_num" name="qq_num" value="{{session('qq_num')}}"></h5>
            <h5 style="line-height:30px;">
                验证码：
                <input class="form-control" type="text" name="captcha" id="captcha" onchange="checkOut(this.value)"><p> </p>
                <h5 class="text-warning" id="checkBack"></h5>
                <a onclick="javascript:re_captcha();" style="line-height: inherit">
                    <img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="100%" height="10%" id="c2c98f0de5a04167a9e427d883690ff6" border="0" style="vertical-align: middle">
                </a>
            </h5>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h5><input class="btn btn-block btn-danger"  type="button" id="btn" value="注册"></h5>
        </form>
        {{--<form action="https://sms.yunpian.com/v1/sms/send.json" method="post">--}}
            {{--<input class="hidden" name="apikey" value="c756c83c4fd6e216a616e1f6ba652e43">--}}
            {{--<input class="hidden" name="mobile" value="18240438909">--}}
            {{--<input class="hidden" name="text" value="【东大科技竞赛平台】欢迎您使用东北大学科技竞赛平台，您的短信验证码是#999999#">--}}
            {{--<input class="btn btn-block btn-success" type="submit" value="短信验证">--}}
        {{--</form>--}}
    </div>
@endsection
<script language="JavaScript">
    function checkOut(str) {
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type:"POST",
            url:'{{route('checkCaptcha')}}',
            data:{captcha:str},
            success:function (data) {
                document.getElementById('checkBack').innerHTML=data;
            }
        })
    }
</script>