@extends('layouts.master')
@section('title')
    审核资料
@endsection
@section('content')
    <div class="panel panel-default" id="panel-body2">
        <h4 class="text-center text-danger">参赛团队列表</h4>
    </div>
    <ul class="list-group">
        @foreach($teams as $team)
            <li class="list-group-item">
                <div class="row container">
                    <div class="col-xs-9">
                        <h5 class="text-center text-danger">{{$team->team_name}}</h5>
                    </div>
                    <div class="col-xs-offset-0">
                        <a style="margin-top: 0.5%" class="text-center btn btn-success btn-xs" href="{{route('getDirectionIn',['team_num'=>$team->captain_num,'com_id'=>$com->competition_id,'com_name'=>$com->name,'status'=>$com->status])}}">
                            <span class="glyphicon glyphicon-arrow-right"> 查看详情</span>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection