@extends('layouts.master')
@section('title')
    提交比赛资料
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" id="panel-heading1">比赛资料提交</div>
        <div class="panel-body">
            <h3 class="text-warning text-center" id="com_name">{!! $com->name !!}</h3>
            <p class="p1">{!! $com->intro !!}</p>
        </div>
        <div class="panel-footer">
            @if($teacher_feedback=='0'||$teacher_feedback=='-1')
                <form action="{{route('PostFile',['status'=>$com->status])}}" enctype="multipart/form-data" method="POST">
                    @if(session('pic'))
                        @if(session('pic')==0)
                            <div class="form-group col-xs-2 col-xs-offset-0">
                                <span class="col-xs-0">竞赛图片(.jpg)</span>
                                <input name="pics" type="file">
                                <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        @else
                            <div class="form-group col-xs-2 col-xs-offset-0">
                                <span class="col-xs-0">竞赛图片(.jpg)</span>
                                <br>
                                <span class="col-xs-0 btn btn-xs btn-info" >已经提交</span>
                            </div>
                        @endif
                    @else
                        <div class="form-group col-xs-2 col-xs-offset-0">
                            <span class="col-xs-0">竞赛图片(.jpg)</span>
                            <input name="pics" type="file">
                            <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    @endif
                    @if(session('file'))
                        @if(session('file')==0)
                            <div class="form-group col-xs-5 col-xs-offset-3">
                                <span class="col-xs-0">竞赛文档(.word/.ppt)</span>
                                <input name="file" type="file">
                                <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        @else
                            <div class="form-group col-xs-2 col-xs-offset-3">
                                <span class="col-xs-0">竞赛文档(.word/.ppt)</span>
                                <br>
                                <span class="col-xs-0 btn btn-xs btn-info" >已经提交</span>
                            </div>
                        @endif
                    @else
                        <div class="form-group col-xs-5 col-xs-offset-3">
                            <span class="col-xs-0">竞赛文档(.word/.ppt)</span>
                            <input name="file" type="file">
                            <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    @endif
                    @if(session('video'))
                        @if(session('video')==0)
                            <div class="form-group col-xs-0 col-xs-offset-10">
                                <span class="col-xs-0">竞赛视频(.mp4)</span>
                                <input name="video" type="file">
                                <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        @else
                            <div class="form-group col-xs-5 col-xs-offset-10">
                                <span class="col-xs-0">竞赛视频(.mp4)</span>
                                <br>
                                <span class="col-xs-0 btn btn-xs btn-info" >已经提交</span>
                            </div>
                        @endif
                    @else
                        <div class="form-group col-xs-0 col-xs-offset-10">
                            <span class="col-xs-0">竞赛视频(.mp4)</span>
                            <input name="video" type="file">
                            <input type="hidden" name="com_id" value="{!! $com->competition_id !!}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    @endif
                    <div class="col-xs-5">
                        <a class="btn btn-success btn-sm" href="{{route('getFile',['team_num'=>$teacher->captain_num,'team_name'=>$teacher->team_name,'com_id'=>$com->competition_id,'status'=>$com->status,'type'=>'0'])}}">
                            <span class="glyphicon glyphicon-picture"> 查看图片</span>
                        </a>
                    </div>
                    <div class="col-xs-5">
                        <a class="btn btn-warning btn-sm" href="{{route('getFile',['team_num'=>$teacher->captain_num,'team_name'=>$teacher->team_name,'com_id'=>$com->competition_id,'status'=>$com->status,'type'=>'1'])}}">
                            <span class="glyphicon glyphicon-folder-open"> 查看文档</span>
                        </a>
                    </div>
                    <div class="col-xs-0">
                        <a class="btn btn-danger btn-sm" href="{{route('getFile',['team_num'=>$teacher->captain_num,'team_name'=>$teacher->team_name,'com_id'=>$com->competition_id,'status'=>$com->status,'type'=>'2'])}}">
                            <span class="glyphicon glyphicon-expand"> 查看视频</span>
                        </a>
                    </div>
                    <p> </p>
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-open"> {{'竞赛资料上传'}}</span></button>
                </form>
                <P> </P>
                {{--<h5 class="hidden" id="name">--}}
                {{--{{session('user')}}--}}
                {{--</h5>--}}
                {{--<a  class="btn btn-danger" onclick=finish(document.getElementById("com_name").firstChild.nodeValue,document.getElementById("name").firstChild.nodeValue)><span class="glyphicon glyphicon-share-alt"> {{'确认完成'}}</span></a>--}}
                <form action="{{route('finish_submit')}}" method="POST">
                    <input type="hidden" name="com_name" value="{{$com->name}}">
                    <input type="hidden" name="name" value="{{session('user')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-share-alt"> {{'确认完成上传'}}</span></button>
                </form>
                <div class="col-xs-0 col-xs-offset-10">
                    <a  class="btn btn-info" href="{{route('refresh',['team_num'=>$teacher->captain_num,'team_name'=>$teacher->team_name,'com_id'=>$com->competition_id,'status'=>$com->status,'type'=>'2'])}}">
                        <span class="glyphicon glyphicon-refresh"> 重新上传竞赛资料</span>
                    </a>
                </div>
            @elseif($teacher_feedback==2)
                <div class="col-xs-0 col-xs-offset-10">
                    <button class="btn btn-success btn-block">{{'资料已提交，等待审核'}}</button>
                </div>
            @elseif($teacher_feedback==1)
                <div class="col-xs-0 col-xs-offset-10">
                    <button class="btn btn-info btn-block">{{'资料已提交竞赛方'}}</button>
                </div>
                @if($award!=-1)
                    @if($award==1)
                        <div class="col-xs-0 col-xs-offset-10">
                            <button class="btn btn-danger btn-block">{{'竞赛没有获得奖项'}}</button>
                        </div>
                    @else
                        <div class="col-xs-0 col-xs-offset-10">
                            <button class="btn btn-warning btn-block">
                                <span class="glyphicon glyphicon-glass"> {{$award}}</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
    @if(count($errors)>0)
        <script language="JavaScript">
            alert("{{session('errors')}}");
        </script>
    @endif
@endsection
{{--<script language="JavaScript">--}}
{{--function finish(str1,str2) {--}}
{{--var xmlhttp;--}}
{{--if (window.XMLHttpRequest)--}}
{{--{// code for IE7+, Firefox, Chrome, Opera, Safari--}}
{{--xmlhttp=new XMLHttpRequest();--}}
{{--}--}}
{{--else--}}
{{--{// code for IE6, IE5--}}
{{--xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");--}}
{{--}--}}
{{--xmlhttp.open("GET","/finish_submit/"+'com_name='+str1+'/'+'name='+str2,true);--}}
{{--xmlhttp.send();--}}
{{--}--}}
{{--</script>--}}
