@extends('layouts.master')
{{--<script type="text/javascript" rel="script" src="/js/get_major.js"></script>--}}
{{--<script type="text/javascript" rel="script" src="/js/confirm.js"></script>--}}
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
            <input type="hidden" value="teacher" name="role">
            <h4 class="text-center text-warning">教师注册</h4>
            <h5>姓名：<input class="form-control" type="text" name="name" id="name"></h5>
            <h5>工资号：<input class="form-control" type="text" name="num" id="num_tea"></h5>
            <h5>学院：
                <select name="college" class="form-control">
                    @foreach($colleges as $college)
                        <option>{{$college['college_name']}}</option>
                    @endforeach
                </select></h5>
            <h5>学科：<input class="form-control" type="text" name="subject" id="subject"></h5>
            <h5>职位：<input class="form-control" type="text" name="job" id="job"></h5>
            <h5>职称：<input class="form-control" type="text" name="job_title" id="job"></h5>
            <h5>邮箱：<input class="form-control" type="text" name="email" id="email"></h5>
            <h5>密码：<input class="form-control" type="password" name="password" id="password"></h5>
            <h5>确认密码：<input class="form-control" type="password" id="password_"></h5>
            <h5>手机号：<input class="form-control" type="text" name="phone_num" id="phone_num"></h5>
            <h5>QQ：<input class="form-control" type="text" name="qq_num" id="qq_num"></h5>
            <h5 style="line-height:30px;">
                验证码：
                <input class="form-control" type="text" name="captcha" id="captcha" onchange="checkOut(this.value)"><p> </p>
                <h5 class="text-warning" id="checkBack"></h5>
                <a onclick="javascript:re_captcha();" style="line-height: inherit">
                    <img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="100%" height="10%" id="c2c98f0de5a04167a9e427d883690ff6" border="0" style="vertical-align: middle">
                </a>
            </h5>
            <p> </p>
            <input class="btn btn-block btn-danger" type="button" id="btn" value="注册">
        </form>
        {{--<form action="https://sms.yunpian.com/v2/sms/single_send.json" method="post">--}}
            {{--<input class="hidden" name="apikey" value="c756c83c4fd6e216a616e1f6ba652e43">--}}
            {{--<input class="hidden" name="mobile" value="18240438909">--}}
            {{--<input class="hidden" name="text" value="[东北大学科技竞赛平台],欢迎注册东大科技竞赛平台，您的验证码是{{rand(10000,99999)}}">--}}
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