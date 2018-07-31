@extends('layouts.dashboard')
@section('title')
    竞赛管理
@endsection
@section('content')
    <div style="margin-top:10px;">
        <div class="col-xs-12 row">
            @if(!empty($competitions))
                @foreach($competitions as $competition)
                    <div class="col-xs-6 col-xs-3">
                        <a href="{{route('AdminCompetitions',['competition_id'=>$competition->competition_id])}}" class="thumbnail">
                            <img src="{{ URL::to('uploads/competition//pics/'.$competition->competition_id.'.jpg')}}" style="width:340px;height:262.5px;" alt="显示错误">
                        </a>
                        <a class="thumbnail center" href="{{route('competitions',['competition_id'=>$competition->competition_id])}}">
                            {{$competition->competition_id}}. {{$competition->name}}
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-xs-7 col-xs-offset-5">
            {!! $competitions->links() !!}
        </div>
    </div>
@endsection