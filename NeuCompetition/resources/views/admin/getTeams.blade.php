@extends('layouts.dashboard')
@section('title')
    学生报名信息一览
@endsection
@section('content')
    <div class="col-xs-12" style="margin-top:10px;">
        {{--<div class="panel panel-default">--}}
        {{--<h3 class="text-center text-warning">团队竞赛类学生报名表</h3>--}}
        {{--</div>--}}
        <table class="table text-center">
            <tr class="bg-light-blue-active">
                <th class="">编号</th>
                <th class="">名称</th>
                <th class="">队长</th>
                <th class="">学院</th>
                <th class="">赛事</th>
                <th class="">备注</th>
            </tr>
            @foreach($teams as $team)
                <tr class="bg-gray-light">
                    <td class="">{{$team->id}}</td>
                    <td class="">{{$team->team_name}}</td>
                    <td class="">{{$team->captain}}</td>
                    <td class="">{{$team->college}}</td>
                    <td class="">{{$team->com_name}}</td>
                    <td class="">
                        @if(session('user')=='root'&&session('role')=='admin')
                            @if($team->team_status=='0')
                                <a class="btn btn-xs btn-warning" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">查看详情</a>
                            @elseif($team->team_status=='2')
                                <a class="btn btn-xs btn-success" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">审核通过</a>
                            @elseif($team->team_status=='-2')
                                <a class="btn btn-xs btn-danger" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">审核未通过</a>
                            @endif
                        @endif
                        @if(session('user')!='root'&&session('role')=='admin')
                            @if($team->team_status=='0')
                                <a class="btn btn-xs btn-warning" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">查看详情</a>
                            @elseif($team->team_status=='1'||$team->team_status=='2')
                                <a class="btn btn-xs btn-success" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">审核通过</a>
                            @elseif($team->team_status=='-1'||$team->team_status=='-2')
                                <a class="btn btn-xs btn-danger" href="{{route('teamCheck',['teamID'=>$team->teamID,'com_name'=>$team->com_name])}}">审核未通过</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @if(session('role')=='admin')
            @if(!empty($team->team_status))
                <p> </p>
                <a class="btn btn-warning btn-sm" href="{{route('teamExcel',['com_name'=>$team->com_name])}}">报名表打印导出</a>
            @endif
        @endif
    </div>
@endsection