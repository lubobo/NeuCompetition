@extends('layouts.master')
@section('title')
    找回密码
@endsection
@section('content')
    <div class="col-xs-4 col-xs-offset-4">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    填写电话号码
                </a>
            </li>
            <li><a>输入短信验证码</a></li>
            <li><a>重新输入密码</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                {{--<div class="modal-content">--}}
                    <form class="form-group" action="https://sms.yunpian.com/v1/sms/send.json" method="post">
                        {{--<div class="modal-header">--}}
                            {{--<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-repeat"> 发送手机验证码</span></h4>--}}
                        {{--</div>--}}
                        <div class="modal-body">
                            <input type="text" name="mobile" class="form-control" placeholder="填写注册所用电话号码......">
                        </div>
                        <div class="modal-footer">
                            <input class="hidden" name="apikey" value="c756c83c4fd6e216a616e1f6ba652e43">
                            {{--<input class="form-control" type="text" name="mobile">--}}
                            <input class="hidden" name="text" value="【东大科技竞赛平台】欢迎您使用东北大学科技竞赛平台，您的短信验证码是#999999#">
                            <input class="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-primary">提交</button>
                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>--}}
                        </div>
                    </form>
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection