@extends('layouts.master')
@section('title')
    评审详情
@endsection
@section('content')
    <div class="panel panel-body"><h4 class="text-center text-danger">评审意见</h4>
        <form action="{{route('postReviewIn')}}" method="POST" class="form-group">
            <h5 class="text-center text-warning col-xs-2 col-xs-offset-5">评审成绩
                <input class="form-control" type="text" name="score" placeholder="成绩(分数)">
            </h5>
            <h5 class="text-center text-danger col-xs-4 col-xs-offset-4">评审备注 (选填)
                <textarea class="form-control" name="status" placeholder="意见(备注)" rows="15"></textarea>
            </h5>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="stu_id" value="{{$stu_id}}">
            <input type="hidden" name="type" value="{{$type}}">
            <input type="hidden" name="com_name" value="{{$com_name}}">
            <input type="hidden" name="com_id" value="{{$com_id}}">
            <input type="hidden" name="grade" value="{{$grade}}">
            <div class="col-xs-4 col-xs-offset-4">
                <button type="submit" class="btn btn-sm btn-block btn-success">提交</button>
            </div>
        </form>
    </div>
    <div class="panel panel-body col-xs-12"><h4 class="text-center text-danger">选择资料评审</h4>
        <div class="col-xs-4 col-xs-offset-4">
            <a class="btn btn-block btn-info" id="pic" href="{{route('getFile',['team_num'=>$stu_id,'com_id'=>$com_id,'status'=>$type,'team_name'=>$team->team_name,'type'=>'0'])}}">查看图片</a>
        </div>
        <div class="col-xs-12"><p> </p></div>
        <div class="col-xs-4 col-xs-offset-4">
            <a class="btn btn-block btn-warning" id="text" href="{{route('getFile',['team_num'=>$stu_id,'com_id'=>$com_id,'status'=>$type,'team_name'=>$team->team_name,'type'=>'1'])}}">查看文档</a>
        </div>
        <div class="col-xs-12"><p> </p></div>
        <div class="col-xs-4 col-xs-offset-4">
            <a class="btn btn-block btn-danger" id="video" href="{{route('getFile',['team_num'=>$stu_id,'com_id'=>$com_id,'status'=>$type,'team_name'=>$team->team_name,'type'=>'2'])}}">查看视频</a>
        </div>
    </div>
@endsection
<script language="JavaScript">
    $(document).ready(function () {
        
    })
</script> 