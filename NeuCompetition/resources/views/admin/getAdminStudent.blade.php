@extends('layouts.dashboard')
@section('title')
    竞赛列表
@endsection
@section('content')
    <div class="col-xs-12" style="margin-top:10px;">
        {{--<div class="panel-default">--}}
            {{--<h4 class="text-center text-warning">赛事列表名单</h4>--}}
        {{--</div>--}}
        <table class="table text-center">
            <tr class="bg-green-active">
                <th class="">竞赛编号</th>
                <th class="">竞赛名称</th>
                <th class="">报名开始</th>
                <th class="">报名截止</th>
                <th class="">赛事开始</th>
            </tr>
        @foreach($competitions as $competition)
                <tr class="bg-gray-light">
                    <td class="">{{$competition->competition_id}}</td>
                    <td class="">
                        @if($competition->status=='0')
                            <a href="{{route('students',['com_name'=>$competition->name])}}">{{$competition->name}}</a>
                        @endif
                        @if($competition->status=='1')
                            <a href="{{route('teams',['com_name'=>$competition->name])}}">{{$competition->name}}</a>
                        @endif
                    </td>
                    <td class="">{{$competition->start_time}}</td>
                    <td class="">{{$competition->end_time}}</td>
                    <td class="">{{$competition->com_time}}</td>
                </tr>
        @endforeach
        </table>
    </div>
@endsection