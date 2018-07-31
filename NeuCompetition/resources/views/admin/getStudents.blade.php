@extends('layouts.dashboard')
@section('title')
    学生报名信息一览
@endsection
@section('content')
    <div style="margin-top:10px;">
        {{--<div class="panel panel-default">--}}
            {{--<h3 class="text-center text-warning">个人竞赛类学生报名表</h3>--}}
        {{--</div>--}}
        <table class="table text-center">
            <tr class="bg-light-blue-active">
                <th class="">姓名</th>
                <th class="">学号</th>
                <th class="">学院</th>
                <th class="">专业</th>
                <th class="">赛事</th>
                <th class="">备注</th>
            </tr>
        @foreach($students as $student)
            <tr class="bg-gray-light">
                    <td class="">{{$student->stu_name}}</td>
                    <td class="">{{$student->stu_num}}</td>
                    <td class="">{{$student->stu_colleges}}</td>
                    <td class="">{{$student->stu_major}}</td>
                    <td class="">{{$student->com_name}}</td>
                    <td class="">
                        @if(session('user')=='root')
                            @if(empty($student->stu_status)||$student->stu_status=='1')
                                <form action="{{route('adminCheck')}}" method="POST">
                                    <input name="com_status" type="checkbox" value="2">通过
                                    <input name="com_status" type="checkbox" value="-2">不通过
                                    <input type="hidden" name="stu_name" value="{!! $student->stu_name !!}">
                                    <input type="hidden" name="com_name" value="{!! $student->com_name !!}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p> </p>
                                    <button type="submit" class="btn btn-warning btn-xs">> 审核提交</button>
                                </form>
                            @elseif($student->stu_status=='-2')
                                <button type="submit" class="btn btn-danger btn-xs">> 审核未通过</button>
                            @elseif($student->stu_status=='2')
                                <button type="submit" class="btn btn-success btn-xs">> 审核已通过</button>
                            @endif
                        @endif
                        @if(session('user')!='root')
                            @if(empty($student->stu_status))
                                <form action="{{route('adminCheck')}}" method="POST">
                                    <input name="com_status" type="checkbox" value="1">通过
                                    <input name="com_status" type="checkbox" value="-1">不通过
                                    <input type="hidden" name="stu_name" value="{!! $student->stu_name !!}">
                                    <input type="hidden" name="com_name" value="{!! $student->com_name !!}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p> </p>
                                    <button type="submit" class="btn btn-warning btn-xs">> 审核提交</button>
                                </form>
                            @elseif($student->stu_status=='-1'||$student->stu_status=='-2')
                                <button type="submit" class="btn btn-danger btn-xs">> 审核未通过</button>
                            @elseif($student->stu_status=='1'||$student->stu_status=='2')
                                <button type="submit" class="btn btn-success btn-xs">> 审核已通过</button>
                            @endif
                        @endif
                    </td>
                </tr>
            </table>
        @endforeach
        @if(session('role')=='admin')
            @if(!empty($student->stu_status))
                <p> </p>
                <a class="btn btn-warning btn-sm" href="{{route('signUpExport',['com_name'=>$student->com_name])}}">报名表打印导出</a>
            @endif
        @endif
    </div>
@endsection