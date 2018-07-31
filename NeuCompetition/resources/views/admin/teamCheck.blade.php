@extends('layouts.dashboard')
@section('title')
    团队信息审核
@endsection
@section('content')
    <div style="margin-top:10px;">
        <div class="panel panel-default">
            <h4 class="text-center text-warning">团队信息审核</h4>
        </div>
        <ul class="list-group col-xs-4">
            <li class="list-group-item">
                <h4 class="text-warning">队伍名称：{{$team_com->team_name}}</h4>
            </li>
            <li class="list-group-item">
                <h4 class="text-warning">队长：{{$team_com->captain}}</h4>
            </li>
            <li class="list-group-item">
                <h4 class="text-warning">学号：{{$team->leaderID}}</h4>
            </li>
            <li class="list-group-item">
                <h4 class="text-warning">学院：{{$team_com->college}}</h4>
            </li>
            <li class="list-group-item">
                <h4 class="text-warning">专业：{{$team_com->major}}</h4>
            </li>
        </ul>
        <div class="col-xs-8">
            <ul class="list-group">
                <li class="list-group-item text-center text-warning"><h4>团队简介</h4></li>
                <li class="list-group-item">{{$team->team_info}}</li>
            </ul>
        </div>
        <div class="col-xs-12">
            <table class="table nav">
                <tr>
                    <th class="panel panel-success text-warning text-center"><h4>成员详情</h4></th>
                </tr>
            </table>
            <?php $k=0 ?>
            <table class="table nav">
                <tr>
                    @foreach($stu_teams as $stu_team)
                        <td class="panel panel-success col-xs-1 text-center">{{$map[$k++]['name']}}</td>
                    @endforeach
                </tr>
                <?php $k=0 ?>
                <tr>
                    @foreach($stu_teams as $stu_team)
                        <td class="panel panel-success col-xs-1 text-center">{{$map[$k++]['num']}}</td>
                    @endforeach
                </tr>
                <?php $k=0 ?>
                <tr>
                    @foreach($stu_teams as $stu_team)
                        <td class="panel panel-success col-xs-3 text-center">{{$map[$k++]->Major->College->college_name}}</td>
                    @endforeach
                </tr>
                <?php $k=0 ?>
                <tr>
                    @foreach($stu_teams as $stu_team)
                        <td class="panel panel-success col-xs-2 text-center">{{$map[$k++]->Major->major_name}}</td>
                    @endforeach
                </tr>
                <?php $k=0 ?>
                <tr>
                    @foreach($stu_teams as $stu_team)
                        <td class="panel panel-success col-xs-3 text-center">{{$team_com->com_name}}</td>
                    @endforeach
                </tr>
            </table>
        </div>
        <div class="col-xs-12">
            <div class="panel-default">
                <h4 class="text-center text-warning">审核意见</h4>
            </div>
                <div class="panel panel-body panel-success">
                    @if($team_com->team_status=='0')
                    <form action="{{route('postTeamCheck')}}" method="POST">
                        @if(session('role')=='admin'&&session('user')=='root')
                            <div class="col-xs-2 col-xs-offset-3">
                                <input type="radio" name="team_status" value="2">通过报名
                            </div>
                            <div class="col-xs-4 col-xs-offset-3">
                                <input type="radio" name="team_status" value="-2">未通过报名
                            </div>
                            <input type="hidden" name="com_name" value="{{$team_com->com_name}}">
                            <input type="hidden" name="team_name" value="{{$team_com->team_name}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-xs btn-block btn-success" type="submit">确定</button>
                        @endif
                        @if(session('role')=='admin'&&session('user')!='root')
                            <div class="col-xs-2 col-xs-offset-3">
                                <input type="radio" name="team_status" value="1">通过报名
                            </div>
                            <div class="col-xs-4 col-xs-offset-3">
                                <input type="radio" name="team_status" value="-1">未通过报名
                            </div>
                            <input type="hidden" name="com_name" value="{{$team_com->com_name}}">
                            <input type="hidden" name="team_name" value="{{$team_com->team_name}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-xs btn-block btn-success" type="submit">确定</button>
                        @endif
                    </form>
                    @else
                        <a class="btn btn-block btn-warning btn-sm" href="{{route('teams',['com_name'=>$team_com->com_name])}}">审核已经完成</a>
                    @endif
                </div>
        </div>
    </div>
@endsection