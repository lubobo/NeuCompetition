@extends('layouts.dashboard')
@section('title')
    数据导入信息
@endsection
@section('content')
    {{--<style>--}}
        {{--span{--}}
            {{--color: #0000cc;--}}
        {{--}--}}
        {{--span:hover{--}}
            {{--color: #9ad717;--}}
            {{--cursor: pointer;--}}
        {{--}--}}
    {{--</style>--}}
    <div style="margin-top:10px;">
        <div class="col-xs-12">
            <div class="col-xs-12">
                <h2 class="text-center">文件导入须知</h2>
                <h4>1、不可随意导入文件，只能导入Excel表格文件</h4>
                <h4>2、Excel表格内容必须完全按照模板内容填写，否则无法导入文件</h4>
                <h4>3、学院、专业的名称必须填写规范（如：计算机科学与工程学院而不是计算机学院）</h4>
                <h4>4、学生、老师必须是已经注册过的才能被写入</h4>
                <h4>5、竞赛可以是在本平台发布过的，也可以是新建立的</h4>
                <h4>6、指导老师不存在时请填写“None”</h4>
                <h4>7、
                    <span id="college" class="lead" style="color: #0000cc" data-toggle="modal" data-target="#myModal">学院</span>、
                    <span id="major" class="lead" style="color: #0000cc" data-toggle="modal" data-target="#myModal">专业</span>、
                    <span id="competition" class="lead" style="color: #0000cc" data-toggle="modal" data-target="#myModal">竞赛 </span>可以用其对应的ID进行输入（如计算机学院可以直接输入16，点击对应字段即可查看）</h4>
                <h4>8、如导入大量数据（可一次性导入5000+数据,因此3条以上为大量数据）请耐心等待，不要对数据导入过程进行干扰</h4>
            </div>
            <div class="col-xs-offset-5">
                <div class="col-xs-2 col-xs-offset-2">
                    <a class="btn btn-warning" href="{{route('download_model')}}">查看模板，点击下载</a>
                </div>
                <div class="col-xs-2 col-xs-offset-2">
                    <button class="btn btn-primary" id="sub_btn" >已经写好，直接上传</button>
                </div>
            </div>
        </div>
        <div>
            <form method="post" action="{{route('import')}}" id="form__" enctype="multipart/form-data">
                <input type="file" style="display: none" id="file_" name="file">
                {{csrf_field()}}
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('#sub_btn').click(function () {
                $('#file_').trigger('click');
            }) ;
            $('#file_').change(function () {
                $('#form__').submit();
            })
        });
    </script>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="model_title">已完成：</h4>
                </div>
                <div class="modal-body" id="body_0_00">
                    <div class="progress" id="process">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#college').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('get_competition')}}',
                    data: {value:'college'},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function (data) {
                        $('.competition_id,.competition_id + br').remove();
                        $('#model_title').text('学院ID');
                        $('#process').remove();
                        if (data[0].id) {
                            var k = 0;
                            for (var i in data) {
                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success btn-block" content="' + data[k].id + '">' + data[k].id + ':' + data[k].name + '</button><br>');
//                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success btn-block">23</button><br>');
                                k++;
                            }
                        } else {
                            alert('暂时不存在任何信息');
                        }
                    },
                    error: function (xhr, type) {
                        alert('Ajax error!');
                    }
                });
            });
            $('#major').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('get_competition')}}',
                    data: {value:'major'},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function (data) {
                        $('.competition_id,.competition_id + br').remove();
                        $('#model_title').text('专业ID');
                        $('#process').remove();
                        if (data[0].id) {
                            var k = 0;
                            for (var i in data) {
                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success" content="' + data[k].id + '">' + data[k].id + ':' + data[k].name + '</button>');
//                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success btn-block">23</button><br>');
                                k++;
                            }
                        } else {
                            alert('暂时不存在任何信息');
                        }
                    },
                    error: function (xhr, type) {
                        alert('Ajax error!');
                    }
                });
            });
            $('#competition').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('get_competition')}}',
                    data: {},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    success: function (data) {
                        $('.competition_id,.competition_id + br').remove();
                        $('#model_title').text('竞赛ID');
                        $('#process').remove();
                        if (data[0].id) {
                            var k = 0;
                            for (var i in data) {
                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success btn-block" content="' + data[k].id + '">' + data[k].id + ':' + data[k].name + '</button><br>');
//                                $('#body_0_00').append('<button type="button" class="competition_id btn btn-success btn-block">23</button><br>');
                                k++;
                            }
                        } else {
                            alert('暂时不存在任何信息');
                        }
                    },
                    error: function (xhr, type) {
                        alert('Ajax error!');
                    }
                });
            });
            $('#ddd').click(function () {
                $('#body_0_00').append('<div class="progress" id="process">'+
                        '<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 63%">'+
                        '<span class="sr-only">60% Complete (warning)</span>'+
                        '</div>'+
                        '</div>');
                $('.competition_id,.competition_id + br').remove();
                $('#process').remove();
                $('#model_title').text('已完成：63%');
                {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: '{{route('test')}}',--}}
                {{--dataType: 'text',--}}
                {{--headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},--}}
                {{--success: function (data) {--}}
                {{--$('#model_title').text('已完成：'+data);--}}
                {{--}--}}
                {{--});--}}
            });
        });
    </script>
@endsection