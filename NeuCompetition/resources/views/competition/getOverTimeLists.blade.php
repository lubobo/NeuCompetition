@extends('layouts.master')
@section('title')
    竞赛列表
@endsection
@section('content')
    <ul class="nav nav-pills nav-justified" id="navbar-left4">
        <li><a class="btn-default a1" style="color:#269abc;" href="{{route('getLists')}}">所有比赛</a></li>
        <li><a class="btn-default a1" style="color:#269abc;" href="{{route('getOnTimeLists')}}">正在报名</a></li>
        <li><a class="btn-default a1" style="color:#269abc;" href="{{route('getNoTimeLists')}}">尚未开始</a></li>
        <li><a class="btn-default a1" style="color:#269abc;" href="{{route('getOverTimeLists')}}">报名结束</a></li>
    </ul>
    <div class="navbar-collapse">
        <table class="table1">
            @if(session('user')=='root')
                <a class="btn btn-danger" href="{{route('GetCompetition')}}">{{'< 返回上一级'}}</a>
                <p> </p>
            @endif
            <tr>
                <td class="td0 td1 td2">竞赛状态</td><td class="td0 td1 td3">竞赛名称</td>
                <td class="td0 td1 td2">报名开始</td><td class="td0 td1 td2">报名截止</td>
                <td class="td0 td1 td2">竞赛开始</td>
            </tr>
        </table>
        @foreach($competitions as $competition)
            @if(strtotime(date('Y-m-d'))>strtotime($competition->end_time))
                <table class="table1">
                    <tr>
                        @if(session('user')=='root')
                            <td class="td1 td2">
                                <a href="{{route('getUploadCompetition',['competition_id'=>$competition->competition_id])}}">
                                    <span class="badge btn-success">{{'编辑'}}</span>
                                </a>
                                <a href="{{route('getDeleteCompetition',['competition_id'=>$competition->competition_id])}}">
                                    <span class="badge btn-danger">{{'删除'}}</span>
                                </a>
                            </td>
                        @endif
                        @if(session('user')!='root')
                            <td class="td1 td2">
                                @if(strtotime(date('Y-m-d'))>strtotime($competition->end_time))
                                    <span class="badge">{{'已结束'}}</span>
                                @endif
                            </td>
                        @endif
                        <td class="td1 td3 td4"><a class="center" href="{{route('competitions',['competition_id'=>$competition->competition_id])}}">
                                {{$competition->name}}
                            </a></td>
                        <td class="td1 td2 td4 td5">{{$competition->start_time}}</td><td class="td1 td2 td4 td6">{{$competition->end_time}}</td>
                        <td class="td1 td2 td4">{{$competition->com_time}}</td>
                    </tr>
                </table>
            @endif
        @endforeach
    </div>
    <div class="col-xs-7 col-xs-offset-5">
        {!! $competitions->links() !!}
    </div>
@endsection