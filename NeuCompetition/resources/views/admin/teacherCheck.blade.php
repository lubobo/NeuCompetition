@extends('layouts.dashboard')
@section('title')
    审核教师选择
@endsection
@section('content')
    <script>
        $(document).ready(function () {
            $(".aaa").click(function () {
                $('#btn_aaa').html($(this).text());
            }) ;
        });
    </script>
    <div style="margin-top:10px;">
                <div class="btn-group">
                    <button type="button" id="btn_aaa" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        学院选择 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($colleges as $college)
                            <li><a href="{{route('tea_com',['college_id'=>$college->id,'com_name'=>$com_name,'com_id'=>$com_num])}}" class="aaa">{{$college->college_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <p> </p>
                <table class="table center">
                    <tr class="bg-light-blue-active">
                        <th class="col-xs-1">姓名</th>
                        <th class="col-xs-2">学院</th>
                        <th class="col-xs-2">学科</th>
                        <th class="col-xs-1">职称</th>
                        <th class="col-xs-2">工资号</th>
                        <th class="col-xs-2">评审备注</th>
                    </tr>
                    <?php $k=0 ?>
                    @foreach($teachers as $teacher)
                        <tr class="bg-gray-light">
                            <td class="col-xs-1">{{$teacher->name}}</td>
                            <td class="col-xs-2">{{$teacher->College->college_name}}</td>
                            <td class="col-xs-2">{{$teacher->subject}}</td>
                            <td class="col-xs-1">{{$teacher->job_title}}</td>
                            <td class="col-xs-2">{{$teacher->num}}</td>
                            <th class="col-xs-2">
                                @if(!$map[$k++])
                                    <form action="{{route('teacherCheck')}}" method="POST">
                                        <input name="tea_status" type="checkbox" value="{{$teacher->num}}">邀请
                                        <input name="com_name" type="hidden" value="{!! $com_name !!}">
                                        <input name="tea_num" type="hidden" value="{!! $teacher->num !!}">
                                        <input name="tea_name" type="hidden" value="{!! $teacher->name !!}">
                                        <input name="com_num" type="hidden" value="{!! $com_num !!}">
                                        <input type="hidden" name="_token" value="{!!  csrf_token() !!}">
                                        <button type="submit" class="btn btn-warning btn-xs">> 提交</button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-success btn-xs">> 已确认</button>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                </table>
            <div class="col-xs-offset-9">
                <h5 class="text-danger"><span class="glyphicon glyphicon-time">审核截止日期:</span></h5>
                <form action="{{route('timeCheck')}}" method="POST">
                    <input type="date" name="end_time">
                    <input name="com_name" type="hidden" value="{!! $com_name !!}">
                    <input type="hidden" name="_token" value="{!!  csrf_token() !!}"><br>
                    <p> </p>
                    <button type="submit" class="btn btn-danger btn-sm">> 确认教师及时间</button>
                </form>
            </div>
        </div>
    {{--</div>--}}
    {{--</div>--}}
@endsection