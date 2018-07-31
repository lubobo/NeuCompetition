@extends('layouts.master')
@section('title')
    {{$competition->name}}
@endsection
@section('content')
    <div class="panel panel-default container" style="width: 100%">
        <h3 class="text-warning text-center">{{$competition->name}}</h3>
        @if(session('role')!='admin')
            <div class="panel-default col-xs-10">
                {{--<div class="panel-heading" id="panel-heading1">竞赛简介</div>--}}
                <div class="panel-body">
                    <p class="p1">{!! $competition->intro !!}</p>
                </div>
            </div>
        @else
            <div class="panel-default">
                {{--<div class="panel-heading" id="panel-heading1">竞赛简介</div>--}}
                <div class="panel-body">
                    <p class="p1">{!! $competition->intro !!}</p>
                </div>
            </div>
        @endif
        @if(session('role')!='admin')
            <div class="col-xs-2">
                <ul class="nav nav-pills nav-stacked">
                    <br>
                    <li class="li1"><a href="#" class="center">竞赛信息<span class="badge">{{'0'}}</span></a></li>
                    <li class="li1"><a href="#" class="center">竞赛动态<span class="badge">{{'0'}}</span></a></li>
                    <li class="li1"><a href="#" class="center">参赛队伍<span class="badge">{{'0'}}</span></a></li>
                    <li class="li1"><a href="#" class="center">获奖情况<span class="badge">{{'0'}}</span></a></li>
                    <br>
                </ul>
                @if(session('role')!='admin')
                    <h5 class="text-warning col-xs-offset-1">分享竞赛:</h5>
                    <div class="share-component" data-disabled="google,twitter,facebook" data-description=""></div>
                @endif
            </div>
        @endif
        <div class="panel-default col-xs-10">
            {{--<div class="panel-heading" id="panel-heading1">报名须知</div>--}}
            <div class="panel-body">
                <span class="col-xs-3"><h4 class="text-danger">报名开始：{{$competition->start_time}}</h4></span>
                <span class="col-xs-3"><h4 class="text-danger">报名截至：{{$competition->end_time}}</h4></span>
                <span class="col-xs-4">
                        <h4 class="text-danger">
                            参赛对象：
                            @if($competition->organizer=='ALL')
                                全校
                            @else
                                {{$competition->organizer}}
                            @endif
                        </h4>
                </span>
                <span class="col-xs-3"><h4 class="text-danger">参赛人数：{{$competition->student_num}}</h4></span>
            </div>
        </div>

        @if(session('role')!='admin'&&session('role')!='teacher')
            <div class="col-xs-4">
                @if(strtotime(date('Y-m-d'))<strtotime($competition->start_time))
                    <a class="btn btn-primary" href="#">报名还未开始</a>
                @endif
                @if(strtotime(date('Y-m-d'))>strtotime($competition->end_time))
                    <a class="btn btn-danger" href="#">报名已经结束</a>
                @endif
                @if(strtotime(date('Y-m-d'))>=strtotime($competition->start_time)&&strtotime(date('Y-m-d'))<=strtotime($competition->end_time))
                    @if(session()->get('old')=='0'&&$competition->status=='1')
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-share-alt"> 点击报名</span>
                        </button>
                    @endif
                    @if(session()->get('old')=='0'&&$competition->status=='0')
                        <a class="btn btn-success" href="{{route('SignUp',['com_id'=>$competition->competition_id])}}">> 点击报名</a>
                    @endif
                    @if(session()->get('old')=='1'||session()->get('old')=='2')
                        <a class="btn btn-warning" href="#">你已报名,等待审核</a>
                    @endif
                @endif
                @endif
                <h1> </h1>
            </div>
            {{--@if(session('role')=='admin'&&session('user')=='root')--}}
                {{--@if(empty($tea_com))--}}
                    {{--<a class="btn btn-warning" href="{{route('tea_com',['com_name'=>$competition->name,'com_id'=>$competition->competition_id])}}">--}}
                        {{--选择审核老师--}}
                    {{--</a>--}}
                {{--@endif--}}
                {{--@if(!empty($tea_com))--}}
                    {{--<div class="panel panel-default col-xs-10">--}}
                        {{--<div class="panel-heading" id="panel-heading1">赛事评审老师及截至时间</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<h5 class="btn btn-sm btn-success col-xs-2 col-xs-offset-5">{{ $tea_com->tea_name }}</h5>--}}
                            {{--<h5 class="btn btn-sm btn-danger col-xs-2 col-xs-offset-5">{{ $tea_com->end_time }}</h5>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endif--}}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">团队报名</h4>
                </div>
                <form class="form-inline" action="{{route('TeamSignUp')}}" method="POST">
                    <div class="modal-body" id="body_00">
                        <div class="form-group">
                            <label for="teamID">输入teamID</label>
                            <input type="text" class="form-control" id="teamID" name="team_id" placeholder="teamID">
                            <input type="hidden" name="com_name" value="{{$competition->name}}">
                            <input type="hidden" name="com_id" value="{{$competition->competition_id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="button" class="btn btn-warning" id="search_team">检索团队</button>
                            <a class="btn btn-primary" href="{{route('team_create')}}">创建团队</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="baoming" disabled >确认报名</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#search_team').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('search_team')}}',
                    data: {
                        teamID:$('#teamID').val(),
                        student_num:'{{session('num')}}'
                    },
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    success: function(data){
                        $('.ppp').remove();
                        if(data['status']=='false'){
                            $("#body_00").append('<p class="ppp text-warning">'+'检索团队失败请检查teamID并保证你是该团队队长'+'<p>')
                            $('#baoming').attr({
                                'disabled':'disabled'
                            });
                        }
                        else {
                            $("#body_00").append('<p class="ppp text-success">'+'团队成员：'+data['members']+'<p>');
                            $("#body_00").append('<p class="ppp text-success">'+'指导老师：'+data['teacher']+'<p>');
                            $("#body_00").append('<p class="ppp text-success">'+'团队名称：'+data['name']+'<p>');
                            $('#baoming').removeAttr('disabled');
                        }
                    },
                    error: function(xhr, type){
                        alert('Ajax error!');
                    }
                });
            })
        })
    </script>
    @if(count($errors)>0)
        <script language="JavaScript">
            alert("{{session('errors')}}");
        </script>
    @endif
@endsection

{{--{{route('SignUp',['com_id'=>$competition->competition_id])}}--}}