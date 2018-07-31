@extends('layouts.master')
@section('title')
    审核列表
@endsection
@section('content')
    <div class="panel panel-default"><h4 class="text-center text-warning">{{$com_name.'---审核名单'}}</h4></div>
    <?php $k=1?>
    <?php $m=0?>
    <ul class="list-group">
        @foreach($students as $student)
            <li class="list-group-item">
                <div class="row container">
                    <div class="col-xs-9 col-xs-offset-2">
                        <h5 class="text-warning">{{'参赛选手 '.$k++}}</h5>
                    </div>
                    <div class="col-xs-offset-0">
                        <h5>
                            @if($map[$m++]=='')
                                @if($type=='1')
                                    <a class="btn btn-sm btn-warning" href="{{route('getReviewIn',['com_id'=>$com_id,'com_name'=>$com_name,'type'=>$type,'stu_id'=>$student->captain_num,'grade'=>$grade])}}">
                                        <span class="glyphicon glyphicon-arrow-right"> 进行打分</span>
                                    </a>
                                @endif
                                @if($type=='0')
                                    <a class="btn btn-sm btn-warning" href="{{route('getReviewIn',['com_id'=>$com_id,'com_name'=>$com_name,'type'=>$type,'stu_id'=>$student->stu_num,'grade'=>$grade])}}">
                                        <span class="glyphicon glyphicon-arrow-right"> 进行打分</span>
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-xs btn-danger" href="#">
                                    <span class="glyphicon glyphicon-saved"> 已评审</span></a>
                            @endif
                        </h5>
                    </div>
                </div>
        @endforeach
    </ul>
@endsection