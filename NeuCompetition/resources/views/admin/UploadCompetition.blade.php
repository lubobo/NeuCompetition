@extends('layouts.dashboard')
@section('title')
    竞赛管理
@endsection
@section('content')
    <div style="margin-top:25px;">
        <div class="col-xs-12 row">
            {{--<nav class="nav navbar-default panel center li1"><h3>竞赛发布管理系统</h3></nav>--}}
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            <form class="form-group" action="{{route('UploadCompetition')}}" method="POST" style="width:60%" enctype="multipart/form-data">
                <div class="col-xs-3 col-xs-offset-0" style="margin-top:1%">
                    <div><span class="text-success">竞赛名称：</span>
                        <input class="form-control" name="com_name" onmouseout="checkName(this.value)" type="text" value="{{$competitions->name}}" placeholder="竞赛名称">
                        <h5 class="text-danger" id="name" ></h5>
                    </div>
                    {{--<div><span class="text-success">竞赛类型(团体|个人)：</span>--}}
                    {{--<br>--}}
                    {{--<input name="com_status" type="radio" value="0">个人赛--}}
                    {{--<input name="com_status" type="radio" value="1">团队赛--}}
                    {{--</div>--}}
                    <input name="com_status" type="hidden" value="1">
                    <div><span class="text-success">竞赛人数：</span>
                        <input class="form-control" name="student_num" onmouseout="checkNum(this.value)" type="text" value="{{$competitions->student_num}}" placeholder="竞赛人数">
                        <h5 class="text-danger" id="num"></h5>
                    </div>
                    <div><span class="text-success">竞赛地点：</span>
                        <input class="form-control" name="com_place" onmouseout="checkPlace(this.value)" type="text" value="{{$competitions->place}}" placeholder="竞赛地点">
                        <h5 class="text-danger" id="place"></h5>
                    </div>
                    <div><span class="text-success">赛事管理方：</span>
                        <select name="com_organizer" class="form-control">
                            <option>{{$competitions->organizer}}</option>
                            @foreach($colleges as $college)
                                <option>{{$college['college_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><span class="text-success">赛事时间：</span>
                        <input class="form-control" name="com_time" type="date" value="{{$competitions->com_time}}">
                    </div>
                    <div><span class="text-success">报名时段：</span>
                        <input class="form-control" name="start_time" type="date" value="{{$competitions->start_time}}">
                        <p> </p>
                        <input class="form-control" name="end_time" type="date" value="{{$competitions->end_time}}">
                    </div>
                    <div class="col-xs-12 thumbnail">
                        <img src="{{ URL::to('uploads/competition/pics/'.$competitions->competition_id.'.jpg')}}" alt="#">
                    </div>
                    <div><span class="text-success">管理权限：</span>
                        <br>
                        <input name="com_grade" type="radio" value="0">院级审核
                        <input name="com_grade" type="radio" value="1">校级审核
                        @if($competitions->grade=='0')
                            <span class="btn btn-xs btn-info">
                             院级
                            </span>
                        @else
                            <span class="btn btn-xs btn-info">
                             校级
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#identifier">
                            <span class="glyphicon glyphicon-picture"> 图片(.jpg)</span>
                            <p> </p>
                        </button>
                    </div>
                </div>
                <div class="col-xs-offset-3" style="width: 142%;">
                    <script type="text/javascript"  src="{{ URL::to('/ckeditor/ckeditor.js')}}"></script>
                    <textarea class="ckeditor" name="com_intro">{{$competitions->intro}}</textarea>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="competition_id" value="{{$com}}">
                </div>

                <div class="modal fade" id="identifier">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    ×
                                </button>
                                <h4 class="modal-title" id="myModalLabel">文章配图</h4>
                            </div>

                            <div class="modal-body">
                                <input type="file" name="com_file" id="file">
                                <p> </p>
                                <input type="text" class="form-control" name="pic" placeholder="pic name...">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">提交</button>
                            </div>
                        </div>
                    </div>
                    {{--<a class="btn btn-xs btn-danger" href="{{route('GetCompetition')}}">{{'< 返回上一级'}}</a>--}}
                </div>
            </form>
        </div>
    </div>
@endsection
<script language="JavaScript">
    function checkName(str) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "POST",
            url: '{{route('checkName')}}',
            data: {name: str},
            success: function (data) {
                document.getElementById('name').innerHTML=data;
            }
        })
    }
    function checkPlace(str) {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            },
            type:"POST",
            url:'{{route('checkPlace')}}',
            data:{place:str},
            success:function (data) {
                document.getElementById('place').innerHTML=data;
            }
        })
    }
    function checkNum(str) {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            },
            type:"POST",
            url:'{{route('checkNum')}}',
            data:{num:str},
            success:function (data) {
                document.getElementById('num').innerHTML=data;
            }
        })
    }
    function checkIntro(str) {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token]').attr('content')
            },
            type:"POST",
            url:'{{route('checkIntro')}}',
            data:{intro:str},
            success:function (data) {
                document.getElementById('intro').innerHTML=data;
            }
        })
    }
</script>