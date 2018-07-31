@extends('layouts.dashboard')
@section('title')
    学生管理
@endsection
@section('content')
    <div style="margin-top:10px;">
        <div class="col-xs-12 row">
            <form action="{{route('adminStudent')}}">
                <div class="col-xs-6">
                    <div class="col-xs-5">
                        <select class="form-control" name="college" style="outline: none" id="college_select">
                            <option style="display: none;" content='0'>选择学院</option>
                            {{--<option value="all" content="all">全部学院</option>--}}
                            @foreach($colleges as $college)
                                <option value="{{$college->college_name}}" content="{{$college->id}}">{{$college->college_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-5">
                        <select class="form-control" name="major" style="outline: none" id="major_select">
                            <option style="display: none;" id="select_major">选择专业</option>
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn col-xs-2 btn-sm btn-warning">
                        <span class="glyphicon glyphicon-cog"> 按专业管理</span>
                    </button>
                </div>
            </form>
            <div id="operate">
                <div class="col-xs-2">
                    {{--<form action="{{route('delete_all')}}" method="post">--}}
                    <input type="checkbox" id="quanqaun">全选
                    <input type="checkbox" id="fanxuan">反选
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-sm btn-danger" id="delete_info_btn">
                        <span class="glyphicon glyphicon-trash"> 删除</span>
                    </button>
                    <h6 class="text-warning">删除后请刷新界面</h6>
                    {{--</form>--}}
                </div>
                <div class="col-xs-3" id="page">
                    {!! $students->links() !!}
                </div>
                <div class="col-xs-0 btn btn-sm btn-info">
                    <span class="glyphicon glyphicon-user"> {{count($students).' '.'人'}}</span>
                </div>
            </div>
            <div class="col-xs-12">
                <table class="table text-center" id="table">
                    <tr class="bg-light-blue-active">
                        <td class="col-xs-1">序号</td>
                        <td class="col-xs-2">学院</td>
                        <td class="col-xs-2">专业</td>
                        <td class="col-lg-2">班级</td>
                        <td class="col-lg-1">姓名</td>
                        <td class="col-lg-1">学号</td>
                        <td class="col-xs-2">操作</td>
                    </tr>

                    @foreach($students as $student)
                        <tr class="bg-gray-light">
                            <form action="{{route('delete_student')}}" method="POST">
                                <td class="col-xs-1">
                                    <input type="checkbox" name="student_id" class="each_checkbox" value="{{$student->id}}">
                                    {{$student->id}}
                                </td>
                                <td class="col-xs-2">{{$student->Major->College->college_name}}</td>
                                <td class="col-xs-2">{{$student->Major->major_name}}</td>
                                <td class="col-lg-2">{{$student->class}}</td>
                                <td class="col-lg-1">{{$student->name}}</td>
                                <td class="col-lg-1">{{$student->num}}</td>
                                <td class="col-xs-2">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    {{--<button type="submit" class="btn btn-xs btn-danger">删除</button>--}}
                                    <a  class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-repeat"> 修改密码</span></a>
                                </td>
                            </form>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form class="form-group" action="{{route('change_student')}}" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-repeat">重置密码</span></h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="password" class="form-control" placeholder="请输入新密码....">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="id" value="{{$student->id}}">
                                                <button type="submit" class="btn btn-primary">提交</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            if(($('#quanqaun').is(':checked'))){
                $('#quanqaun').trigger('click');
            }
            if($('#fanxuan').is(':checked')){
                $('#fanxuan').trigger('click');
            }

            $('#college_select').change(function () {
                $('.info_data,.info_data + td').remove();
                $('#nn_nn').text(0);
                $('#refresh ').trigger('click');
                if ($('#college_select option:selected').val() == 'all') {
                    $('.major__').remove();
//                    $("#major_select").append('<option class="major__" selected=selected"" value="all" id="major_all">全部专业</option>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('get_major')}}',
                        data: {college: $("#college_select option:selected").val()},
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        success: function (data) {
                            $('.major__').remove();
//                            $("#major_select").append('<option class="major__" value="all" id="major_all">全部专业</option>');
                            for (var i = 0; i < data.length; i++) {
                                $("#major_select").append('<option class="major__" value="' + data[i] + '">' + data[i] + '</option>');
                            }
                            $('#major_all').attr('selected', 'selected');
                        },
                        error: function (xhr, type) {
                            alert('Ajax error!');
                        }
                    });
                }
            });

            $("#major_select").change(function () {
                $('.info_data,.info_data + td').remove();
                $('#nn_nn').text(0);
                $('#refresh ').trigger('click');
            });

            $('#fanxuan').click(function () {
                $('.each_checkbox').trigger('click');
            });
            $('#quanqaun').click(function () {
                if($('#quanqaun').is(':checked')){
                    $('.each_checkbox').not(':checked').trigger('click');
                }
                else {
                    $('.each_checkbox').each(function () {
                        if($(this).is(':checked')){
                            $(this).trigger('click');
                        }
                    });
                }

            });
            $('#delete_info_btn').click(function () {
                var data=[];
                var i=0;
                $('.each_checkbox').each(function () {
                    if($(this).is(':checked')){
                        data[i++]=$(this).attr('value');
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('delete_all')}}',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    data:{
                        data:data
                    }
                })
            });
        });
    </script>
@endsection