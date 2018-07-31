@extends('layouts.dashboard')
@section('title')
    颁布奖项
@endsection
@section('content')
    <div class="col-xs-12" style="margin-top:10px;">
    {{--<div class="panel-default">--}}
        {{--<h4 class="text-center text-danger">奖项颁布名单</h4>--}}
    {{--</div>--}}
    <table class="table text-center">
        <tr class="bg-olive-active">
            <th class="col-xs-4">竞赛名称</th>
            <th class="col-xs-1">奖项设置</th>
        </tr>
        @foreach($coms as $com)
            <tr class="bg-gray-light">
                <td class="col-xs-4 text-warning">{{$com->name}}</td>
                <td class="col-xs-1"><a class="btn btn-xs btn-success" href="{{route('getAwardIn',['com_name'=>$com->name,'com_id'=>$com->competition_id,'grade'=>$com->status])}}">查看详情</a></td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection