@extends('layouts.dashboard')
@section('title')
    竞赛管理
@endsection
@section('content')
    <div style="margin-top:10px;">
        <ul class="nav nav-pills nav-justified">
            <li class="col-xs-3"><a class="btn-default a1" style="color:#269abc;" href="{{route('getAdminLists')}}">所有比赛</a></li>
            <li class="col-xs-3"><a class="btn-default a1" style="color:#269abc;" href="{{route('getAdminOnTimeLists')}}">正在报名</a></li>
            <li class="col-xs-3"><a class="btn-default a1" style="color:#269abc;" href="{{route('getAdminNoTimeLists')}}">尚未开始</a></li>
            <li class="col-xs-3"><a class="btn-default a1" style="color:#269abc;" href="{{route('getAdminOverTimeLists')}}">报名结束</a></li>
            <p> </p>
            <li class="col-xs-12">
                <div class="navbar-collapse">
                    <table class="table text-center">
                        <tr class="bg-black-gradient">
                            <td class="">竞赛编号</td>
                            <td class="">竞赛状态</td>
                            <td class="">竞赛权限</td>
                            <td class="">竞赛限制</td>
                            <td class="">竞赛名称</td>
                            <td class="">报名开始</td>
                            <td class="">报名截止</td>
                            <td class="">竞赛开始</td>
                        </tr>
                        @foreach($competitions as $competition)
                            @if(strtotime(date('Y-m-d'))<strtotime($competition->start_time))
                                <tr class="bg-gray-light">
                                    <td class="">
                                        {{$competition->competition_id}}

                                        <img class="img-circle" width="30" height="30" src="{{ URL::to('uploads/competition/pics/'.$competition->competition_id.'.jpg')}}" alt="#">
                                    </td>
                                @if(session('user')=='root')
                                        <td class="">
                                            <a href="{{route('getUploadCompetition',['competition_id'=>$competition->competition_id])}}">
                                                <span class="badge btn-success">{{'编辑'}}</span>
                                            </a>
                                            <a href="{{route('getDeleteCompetition',['competition_id'=>$competition->competition_id])}}">
                                                <span class="badge btn-danger">{{'删除'}}</span>
                                            </a>
                                        </td>
                                    @endif
                                    @if(session('user')!='root')
                                        <td class="">
                                            @if(strtotime(date('Y-m-d'))<strtotime($competition->start_time))
                                                <span class="badge">{{'未开始'}}</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if($competition->grade=='0')
                                            <span class="badge btn-info">
                                            {{$competition->organizer}}
                                        </span>
                                        @else
                                            <span class="badge btn-warning">
                                            {{'校级管理'}}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="">{{$competition->student_num.' '.'人'}}</td>
                                    <td class=""><a class="center" href="{{route('competitions',['competition_id'=>$competition->competition_id])}}">
                                            {{$competition->name}}
                                        </a>
                                    </td>
                                    <td class="">{{$competition->start_time}}</td>
                                    <td class="">{{$competition->end_time}}</td>
                                    <td class="">{{$competition->com_time}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </li>
        </ul>
        <div class="col-xs-7 col-xs-offset-5">
            {!! $competitions->links() !!}
        </div>
    </div>
@endsection