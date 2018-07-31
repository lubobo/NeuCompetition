@extends('layouts.dashboard')
@section('title')
竞赛管理
@endsection
@section('content')

    <h3 class="text-warning text-center">{{$competition->name}}</h3>
    @if(session('role')=='admin')
        <div class="col-xs-12">
            <p class="p1">{!! $competition->intro !!}</p>
            <h5 class="text-danger"><span class="col-xs-2">报名开始：{{$competition->start_time}}</span></h5>
            <h5 class="text-danger"><span class="col-xs-2">报名截至：{{$competition->end_time}}</span></h5>
            <h5 class="text-danger">
                <span class="col-xs-3">
                            参赛对象：
                    @if($competition->organizer=='ALL')
                        全校
                    @else
                        {{$competition->organizer}}
                    @endif

                </span>
            </h5>
            <h5 class="text-danger"><span class="col-xs-2">参赛人数：{{$competition->student_num}}</span></h5>

            @if(session('role')=='admin'&&session('user')=='root')
                @if($tea_coms=='[]')
                    <span class="col-xs-3">
                    <a class="btn btn-warning" href="{{route('tea_com',['com_name'=>$competition->name,'com_id'=>$competition->competition_id])}}">
                        选择审核老师
                    </a>
                    </span>
                @endif
            @endif
        </div>
    @endif
    @if(session('role')=='admin'&&session('user')=='root')
        @if($tea_coms!='[]')
            <div class="col-xs-12"><p> </p></div>
            <div class=" col-xs-12">
                <table class="table">
                    <tr class="text-center bg-black">
                        <td>
                            评审时间
                        </td>
                        <td>
                            评审时间
                        </td>
                    </tr>
                    @foreach($tea_coms as $tea_com)
                        <tr class="text-center bg-danger">
                            <td>
                                {{ $tea_com->tea_name }}
                            </td>
                            <td>
                                {{ $tea_com->end_time }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    @endif
@endsection
{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
{{--<div class="modal-dialog" role="document">--}}
{{--<div class="modal-content">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--<h4 class="modal-title" id="myModalLabel">团队报名</h4>--}}
{{--</div>--}}
{{--<form class="form-inline" action="{{route('TeamSignUp')}}" method="POST">--}}
{{--<div class="modal-body" id="body_00">--}}
{{--<div class="form-group">--}}
{{--<label for="teamID">输入teamID</label>--}}
{{--<input type="text" class="form-control" id="teamID" name="team_id" placeholder="teamID">--}}
{{--<input type="hidden" name="com_name" value="{{$com_name}}">--}}
{{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--<button type="button" class="btn btn-warning" id="search_team">检索团队</button>--}}
{{--<a class="btn btn-primary" href="{{route('team_create')}}">创建团队</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="modal-footer">--}}
{{--<button type="submit" class="btn btn-primary" id="baoming" disabled >确认报名</button>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<script>--}}
{{--$(document).ready(function () {--}}
{{--$('#search_team').click(function () {--}}
{{--$.ajax({--}}
{{--type: 'POST',--}}
{{--url: '{{route('search_team')}}',--}}
{{--data: {--}}
{{--teamID:$('#teamID').val(),--}}
{{--student_num:'{{session('num')}}'--}}
{{--},--}}
{{--dataType: 'json',--}}
{{--headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },--}}
{{--success: function(data){--}}
{{--$('.ppp').remove();--}}
{{--if(data['status']=='false'){--}}
{{--$("#body_00").append('<p class="ppp text-warning">'+'检索团队失败请检查teamID并保证你是该团队队长'+'<p>')--}}
{{--$('#baoming').attr({--}}
{{--'disabled':'disabled'--}}
{{--});--}}
{{--}--}}
{{--else {--}}
{{--$("#body_00").append('<p class="ppp text-success">'+'团队成员：'+data['members']+'<p>');--}}
{{--$("#body_00").append('<p class="ppp text-success">'+'指导老师：'+data['teacher']+'<p>');--}}
{{--$("#body_00").append('<p class="ppp text-success">'+'团队名称：'+data['name']+'<p>');--}}
{{--$('#baoming').removeAttr('disabled');--}}
{{--}--}}
{{--},--}}
{{--error: function(xhr, type){--}}
{{--alert('Ajax error!');--}}
{{--}--}}
{{--});--}}
{{--})--}}
{{--})--}}
{{--</script>--}}

{{--{{route('SignUp',['com_id'=>$competition->competition_id])}}--}}