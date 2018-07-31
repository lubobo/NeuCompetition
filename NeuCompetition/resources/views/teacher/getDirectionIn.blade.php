@extends('layouts.master')
@section('title')
    查看资料
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <h4 class="text-center text-warning">团队参赛资料审核</h4>
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
        <div class="col-xs-12 panel panel-default">
            <div class="panel-default">
                <h4 class="text-center text-warning">查看资料</h4>
            </div>
            <div class="col-xs-5">
                <a class="btn btn-warning btn-sm" href="{{route('getFile',['team_num'=>$team_num,'team_name'=>$team_name,'com_id'=>$com_id,'status'=>$status,'type'=>'0'])}}">
                    <span class="glyphicon glyphicon-picture"> 查看图片</span>
                </a>
            </div>
            <div class="col-xs-5">
                <a class="btn btn-success btn-sm" href="{{route('getFile',['team_num'=>$team_num,'team_name'=>$team_name,'com_id'=>$com_id,'status'=>$status,'type'=>'1'])}}">
                    <span class="glyphicon glyphicon-folder-open"> 查看文档</span>
                </a>
            </div>
            <div class="col-xs-0">
                <a class="btn btn-danger btn-sm" href="{{route('getFile',['team_num'=>$team_num,'team_name'=>$team_name,'com_id'=>$com_id,'status'=>$status,'type'=>'2'])}}">
                    <span class="glyphicon glyphicon-expand"> 查看视频</span>
                </a>
            </div>
            <p> </p>
            <div class="container" style="width:50%">:wwq
                @if($teacher_feedback=='2')
                    <div class="col-xs-5 col-xs-offset-1">
                        <form action="{{route('sendData')}}" method="POST">
                            <input name="captain" value="{{$team_com->captain}}" type="hidden">
                            <input name="com_name" value="{{$team_com->com_name}}" type="hidden">
                            <input name="_token" value="{{csrf_token()}}" type="hidden">
                            <button class=" btn btn-info btn-block">
                                <span class="glyphicon glyphicon-cloud-upload"> 确认上传竞赛资料</span>
                            </button>
                        </form>
                    </div>
                    <div class="col-xs-5">
                        <form action="{{route('backData')}}" method="POST">
                            <input name="captain" value="{{$team_com->captain}}" type="hidden">
                            <input name="com_name" value="{{$team_com->com_name}}" type="hidden">
                            <input name="_token" value="{{csrf_token()}}" type="hidden">
                            <button class=" btn btn-danger btn-block">
                                <span class="glyphicon glyphicon-send"> 返回修改竞赛资料</span>
                            </button>
                        </form>
                    </div>
                @elseif(isset($back)||$teacher_feedback=='-1')
                    <button class=" btn btn-danger btn-block">
                        <span class="glyphicon glyphicon-bell"> 该团队资料已被返回修改</span>
                    </button>
                @elseif($teacher_feedback=='1')
                    <button class=" btn btn-info btn-block">
                        <span class="glyphicon glyphicon-ban-circle"> 竞赛资料已确认提交</span>
                    </button>
                @elseif($teacher_feedback=='0')
                    <button class=" btn btn-success btn-block">
                        <span class="glyphicon glyphicon-bell"> 该团队还未曾上传资料</span>
                    </button>
                @endif
            </div>
            <p> </p>
        </div>
    </div>
    @if(count($errors)>0)
        <script language="JavaScript">
            alert("{{session('errors')}}");
        </script>
    @endif
@endsection