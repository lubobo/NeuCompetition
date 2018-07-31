@extends('layouts.master')
@section('title')
    我的主页
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-default col-xs-3">
            <h4 class="text-center text-warning">我的信息</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <h5 class="text-left text-warning">姓名: {{$teacher->name}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">工资号: {{$teacher->num}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">学院: {{$teacher->College->college_name}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">学科: {{$teacher->subject}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">职位: {{$teacher->job}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">职称: {{$teacher->job_title}}</h5>
                </li>
                <li class="list-group-item">
                    <h5 class="text-left text-warning">邮箱: {{$teacher->email}}</h5>
                </li>
                {{--<li class="list-group-item">--}}
                    {{--<a href="{{route('team_list')}}"><h5 class="text-left text-danger">我的团队</h5></a>--}}
                {{--</li>--}}
                <li class="list-group-item">
                    <a href="{{route('message_view_list')}}"><h5 class="text-left text-danger">我的消息</h5></a>
                </li>
            </ul>
        </div>
        <div class="col-xs-9">
            <div class="panel panel-default"><h4 class="text-center text-danger">赛事概况</h4></div>
            <div class="panel panel-default">
                <table class="table nav">
                    <tr>
                        <th class="col-xs-1 text-center text-danger">赛事名称</th>
                        <th class="col-xs-1 text-center text-danger">赛事时间</th>
                        <th class="col-xs-1 text-center text-danger">赛事状态</th>
                    </tr>
                    @foreach($tea_coms as $tea_com)
                        <tr>
                            <td class="col-xs-1 text-center"><a class="text-success" href="{{route('getReview',['com_num'=>$tea_com->com_num])}}">{{$tea_com->com_name}}</a></td>
                            <td class="col-xs-1 text-center text-success">{{$tea_com->end_time}}</td>
                            <td class="col-xs-1 text-center text-success">评审教师</td>
                        </tr>
                    @endforeach
                    <?php $k=0;?>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td class="col-xs-1 text-center">
                                <a class="text-warning" href="{{route('getDirection',['com_name'=>$teacher->com_name,'teacher'=>$teacher->teacher])}}">{{$teacher->com_name}}</a>
                            </td>
                            <td class="col-xs-1 text-center text-warning">{{$map[$k++]}}</td>
                            <td class="col-xs-1 text-center text-warning">指导教师</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection