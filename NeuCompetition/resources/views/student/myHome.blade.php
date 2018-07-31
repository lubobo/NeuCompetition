@extends('layouts.master')
@section('title')
    个人中心
@endsection
@section('content')
    <div class="panel-default">
        <div id="panel-heading1"><h4>个人信息库</h4></div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <div class="col-xs-3">
                <ul class="list-group">
                    <li class="list-group-item"><h5 class="text-warning">姓名:{{$stu->name}}</h5></li>
                    <li class="list-group-item"><h5 class="text-success">专业:{{$stu->Major->major_name}}</h5></li>
                    <li class="list-group-item"><h5 class="text-success">学院:{{$stu->Major->College->college_name}}</h5></li>
                    <li class="list-group-item"><h5 class="text-success">班级:{{$stu->class}}</h5></li>
                    <li class="list-group-item"><h5 class="text-success">学号:{{$stu->num}}</h5></li>
                    <li class="list-group-item"><h5 class="text-success">邮箱:{{$stu->email}}</h5></li>
                    <li class="list-group-item"><a class="text-danger text-center" href="{{route('team_list')}}">我的团队</a></li>
                    <li class="list-group-item"><a class="text-danger text-center" href="{{route('message_view_list')}}">我的消息</a></li>
                </ul>
            </div>
            <div class="col-xs-9">
                <ul class="list-group panel">
                    {{--<li class="list-group-item"><h4 class="text-warning text-center"><strong>赛事参与情况一览</strong></h4></li>--}}
                    <li class="btn btn-xs btn-block btn-warning" id="flip"><h5 class="text-center">个人赛事情况</h5></li>
                    @if(!$students->items()==[])
                        <?php $k=0 ?>
                        @foreach($students as $student)
                            <li class="list-group-item" id="panel0" style="height: 50px;">
                                @if($map[$k++]==1)
                                    @if($student->stu_status==2)
                                        <a href="{{route('SubmitData',['com_id'=>$student->com_id,'stu_id'=>$student->stu_num])}}">
                                            <h5 class="text-primary text-left">{{$student->com_name}}</h5>
                                        </a>
                                    @endif
                                    @if($student->stu_status==-2||$student->stu_status==-1)
                                        <h5 class="text-danger text-left">{{$student->com_name}}</h5>
                                    @endif
                                    @if(!$student->stu_status)
                                        <h5 class="text-success text-left">{{$student->com_name}}</h5>
                                    @endif

                                    @if($student->stu_status==-2||$student->stu_status==-1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核未通过'}}</span>
                                    @endif
                                    @if($student->stu_status==2)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核已通过'}}</span>
                                    @endif
                                    @if(!$student->stu_status)
                                        <span class="badge" style="margin-top: -4%">{{'未开始审核'}}</span>
                                    @endif
                                @elseif($map[$k-1]==0)
                                    @if($student->stu_status==1)
                                        <a href="{{route('SubmitData',['com_id'=>$student->com_id,'stu_id'=>$student->stu_num])}}">
                                            <h5 class="text-primary text-left">{{$student->com_name}}</h5>
                                        </a>
                                    @endif
                                    @if($student->stu_status==-1)
                                        <h5 class="text-danger text-left">{{$student->com_name}}</h5>
                                    @endif
                                    @if(!$student->stu_status)
                                        <h5 class="text-success text-left">{{$student->com_name}}</h5>
                                    @endif

                                    @if($student->stu_status==-1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核未通过'}}</span>
                                    @endif
                                    @if($student->stu_status==1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核已通过'}}</span>
                                    @endif
                                    @if(!$student->stu_status)
                                        <span class="badge" style="margin-top: -4%">{{'未开始审核'}}</span>
                                    @endif
                                @endif
                            </li>
                            <?php $k++?>
                        @endforeach
                    @else <li class="list-group-item" id="panel0" style="height: 50px;">
                        <h5 class="text-danger text-left">暂时还未参加赛事</h5>
                        <span class="badge" style="margin-top: -4%">
                            <a style="color:#ffffff;" href="{{route('getLists')}}">点击此处，浏览竞赛信息</a>
                        </span>
                    </li>
                    @endif
                    <li class="btn btn-xs btn-block btn-danger" id="flip1"><h5 class="text-center">团体赛事情况</h5></li>
                    @if(!$teams->items()==[])
                        <?php $n=0 ?>
                        @foreach($teams as $team)
                            <li class="list-group-item" id="panel1" style="height: 50px;">
                                @if($map1[$n++]==1)
                                    @if($team->team_status==2)
                                        <a href="{{route('SubmitData',['com_name'=>$team->com_name,'team'=>$team->team_name])}}">
                                            <h5 class="text-primary text-left">{{$team->com_name}}</h5>
                                        </a>
                                    @endif
                                    @if($team->team_status==-2||$team->team_status==-1)
                                        <h5 class="text-danger text-left">{{$team->com_name}}</h5>
                                    @endif
                                    @if(!$team->team_status)
                                        <h5 class="text-success text-left">{{$team->com_name}}</h5>
                                    @endif

                                    @if($team->team_status==-2||$team->team_status==-1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核未通过'}}</span>
                                    @endif
                                    @if($team->team_status==2)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核已通过'}}</span>
                                    @endif
                                    @if(!$team->team_status)
                                        <span class="badge" style="margin-top: -4%">{{'未开始审核'}}</span>
                                    @endif
                                @elseif($map1[$n-1]==0)
                                    @if($team->team_status==1)
                                        <a href="{{route('SubmitData',['com_name'=>$team->com_name,'team'=>$team->team_name])}}">
                                            <h5 class="text-primary text-left">{{$team->com_name}}</h5>
                                        </a>
                                    @endif
                                    @if($team->team_status==-1)
                                        <h5 class="text-danger text-left">{{$team->com_name}}</h5>
                                    @endif
                                    @if(!$team->team_status)
                                        <h5 class="text-success text-left">{{$team->com_name}}</h5>
                                    @endif

                                    @if($team->team_status==-1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核未通过'}}</span>
                                    @endif
                                    @if($team->team_status==1)
                                        <span class="badge" style="margin-top: -4%">{{'报名审核已通过'}}</span>
                                    @endif
                                    @if(!$team->team_status)
                                        <span class="badge" style="margin-top: -4%">{{'未开始审核'}}</span>
                                    @endif
                                @endif
                            </li>
                            <?php $n++?>
                        @endforeach
                    @else <li class="list-group-item" id="panel1" style="height: 50px;">
                        <h5 class="text-danger text-left">暂时还未参加赛事</h5>
                        <span class="badge" style="margin-top: -4%">
                            <a style="color:#ffffff;" href="{{route('getLists')}}">点击此处，浏览竞赛信息</a>
                        </span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        $(function () {
            @if($message)
                $('#myModal').modal('show');
            @endif
        });
        $(document).ready(function () {
            $('#flip').click(function () {
                $('#panel0').slideToggle('fast')
            });
            $('#flip1').click(function () {
                $('#panel1').slideToggle('fast')
            })
        });
    </script>
    <style type="text/css">
        #panel0,#panel1{
            display: none;
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">你有未处理的消息</h4>
                </div>
                <div class="modal-body">
                    <h2>有未处理的消息，请前往处理</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">稍后处理</button>
                    <a type="button" class="btn btn-primary" href="{{route('message_view_list')}}">点击前往</a>
                </div>
            </div>
        </div>
    </div>
@endsection