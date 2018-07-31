@extends('layouts.dashboard')
@section('title')
    获奖信息查询
@endsection
@section('content')
    <div style="margin-top:10px;">
        <div class="col-xs-12">
            <div class="col-xs-2">
                <div class="input-group">
                    <span class="input-group-addon" >年份</span>
                    <input type="text" id="year" value="2016" class="form-control" placeholder="year" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-xs-3">
                <select class="form-control" style="outline: none" id="college_select">
                    <option style="display: none;" content='0'>选择学院</option>
                    <option value="all" content="all">全部学院</option>
                    @foreach($colleges as $college)
                        <option value="{{$college->college_name}}" content="{{$college->id}}">{{$college->college_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control" style="outline: none" id="major_select">
                    <option style="display: none;" id="select_major">选择专业</option>
                </select>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                    <a tabindex="0" class="input-group-addon btn btn-lg" role="button" data-toggle="modal" data-target="#myModal">竞赛编号</a>
                    <input type="text" value="0" id="comcomcom" class="form-control" placeholder="我知道你不知道" aria-describedby="basic-addon1" data-toggle="popover" data-trigger="hover" title="提示" data-placement="left"  data-content="点击可选择竞赛编号">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                    <input type="text" id="search__" class="form-control" placeholder="学号/姓名" aria-describedby="basic-addon1" aria-describedby="basic-addon1" data-toggle="popover" data-trigger="hover" title="老牛逼了！" data-placement="bottom"  data-content="支持学院、专业、姓名、学号、指导老师、竞赛名称查询 暂不支持模糊查询">
                    <span id="search_" class="input-group-addon glyphicon glyphicon-search" style="cursor: pointer;position: relative;top: -0.5px;" ></span>
                </div>
            </div>
            <div class="col-xs-12">
                <p> </p>
            </div>
            <div id="operate">
                <div class="col-xs-5">
                    <button class="btn btn-danger" id="delete_info_btn">删除</button>
                    <label><input type="checkbox" id="quanqaun">全选</label>
                    <label><input type="checkbox" id="fanxuan">反选</label>
                </div>
                <div class="col-xs-4" id="page">
                    <button class="btn btn-success refresh" content="up">上一页</button>
                    <h4 style="display: inline">第<span id="nn_nn">0</span>页</h4>
                    <button class="btn btn-success refresh" content="down">下一页</button>
                </div>
                <div class="col-xs-3">
                    <button class="btn btn-warning" id="export_data">导出信息表</button>
                    <button class="btn btn-primary refresh" content="refresh" id="refresh">刷新</button>
                </div>
            </div>
            <div class="row">
                <table class="table text-center" id="table">
                    <tr class="bg-navy-active">
                        <td>序号</td>
                        <td>学院</td>
                        <td>专业</td>
                        <td>班级</td>
                        <td>姓名</td>
                        <td>学号</td>
                        <td>指导老师</td>
                        <td>竞赛名称</td>
                        <td>竞赛成绩</td>
                        <td>获奖信息</td>
                        <td>证书</td>
                        <td>年份</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" id="body_0_00">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
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
                        $("#major_select").append('<option class="major__" selected=selected"" value="all" id="major_all">全部专业</option>');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '{{route('get_major')}}',
                            data: {college: $("#college_select option:selected").val()},
                            dataType: 'json',
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            //headers: {
                            //'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            //},
                            success: function (data) {
                                $('.major__').remove();
                                $("#major_select").append('<option class="major__" value="all" id="major_all">全部专业</option>');
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
                $('#myModal').on('show.bs.modal', function (e) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('get_competition')}}',
                        data: {},
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        //headers: {
                        //'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        //},
                        success: function (data) {
                            $('.competition_id,.competition_id + br').remove();
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
                $('#body_0_00').on('click', '.competition_id', function () {
                    $('#comcomcom').val($(this).attr('content'));
                    $('#myModal').modal('hide');
                    $('.info_data,.info_data + td').remove();
                    $('#nn_nn').text(0);
                    $('#refresh ').trigger('click');
                });
                $('.refresh').on('click',function () {
                    var page=parseInt($('#nn_nn').text());
                    var operate=$(this).attr('content');
                    if(operate=='up'){
                        if(--page==-1) return 0;
                        else if(page==0) {
                            alert('这是首页,OK??');
                            return 0;
                        }
                    }else if(operate=='down'){
                        if(++page==1) return 0;
                    }
                    //The page is very 巧妙
                    //因为分页处理机制，page=0或者page=0时所请求的页面都是第一页
                    //巧妙利用该特点，初始的页面设置为0
                    //这样的话刷新时若在第0页，则会请求数据即跳转到第一页
                    //若在非0页，点击刷新请求的仍然是本页
                    refresh(page);
                });
                $('#export_data').click(function () {
                    var length = $("#table tr").length;
                    if (length == 1) {
                        alert('你难道看不见没有数据吗？？？？');
                    } else {
                        var data = {};
                        var j = 0;
                        $("#table").find(".info_data td").each(function (i) {
//                        data[parseInt(j/11)][j%11]=$(this).text();
                            data[j] = $(this).text();
                            j++;
                        });
                        $.ajax({
                            type: 'POST',
                            url: '{{route('export')}}',
                            data: {
                                data: JSON.stringify(data)
                            },
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            success: function (response) {
                                window.location.href = response.url;
//                            alert('123');
                            }
                        });
                    }
                });
                $('#search_').click(function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('get_info')}}',
                        data: {
                            year :$('#year').val(),
                            value:$('#search__').val()
                        },
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        success: function(data){
                            $('.info_data,.info_data + td').remove();
                            if(data.status=='true'){
                                var k=0;
                                for(var i in data){
                                    $('#table').append(
                                            '<tr class="info_data">' +
                                            '<td>'+(k+1)+'</td>' +
                                            '<td>'+data[k].college+'</td>' +
                                            '<td>'+data[k].major+'</td>' +
                                            '<td>'+data[k].class+'</td>' +
                                            '<td>'+data[k].name+'</td>' +
                                            '<td>'+data[k].num+'</td>' +
                                            '<td>'+data[k].teacher+'</td>' +
                                            '<td>'+data[k].competition_name+'</td>' +
                                            '<td>'+data[k].competition_result+'</td>' +
                                            '<td>'+data[k].award_info+'</td>' +
                                            '<td><a href="'+data[k].diploma_url+'">查看证书</a></td>' +
                                            '</tr>'
                                    );
                                    k++;
                                }
                            }else {
                                alert('无法找到任何信息');
                            }
                        },
                        error: function(xhr, type){
                            alert('Ajax error!');
                        }
                    });
                });
                function refresh(page) {
                    if(($('#quanqaun').is(':checked'))){
                        $('#quanqaun').trigger('click');
                    }
                    if($('#fanxuan').is(':checked')){
                        $('#fanxuan').trigger('click');
                    }
                    var year = $('#year').val();
                    var college_id = $('#college_select option:selected').attr('content');
                    var major_name = $("#major_select option:selected").val();
                    var competition_id = $("#comcomcom").val();
//                alert(college_id+major_name);
                    if (college_id != '0' || major_name != '选择专业' || competition_id != '0') {
                        $.ajax({
                            type: 'POST',
                            url: '{{route('get_info')}}',
                            data: {
                                year: year,
                                college_id: college_id,
                                major_name: major_name,
                                competition_id: competition_id,
                                page:page
                            },
                            dataType: 'json',
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            //headers: {
                            //'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            //},
                            success: function (data) {
                                if (data.status == 'true') {
                                    $('.info_data,.info_data + td').remove();
                                    var k = 0;
                                    if(page==0){
                                        $('#nn_nn').text(1);
                                    }else {
                                        if(page==1){
                                        }
                                        $('#nn_nn').text((page).toString());
                                    }
                                    for (var i in data) {
                                        $('#table').append(
                                                '<tr class="info_data">' +
                                                '<td>' + (k + 1) +'<input type="checkbox" class="each_checkbox" value="'+data[k].id+'"></td>' +
                                                '<td>' + data[k].college + '</td>' +
                                                '<td>' + data[k].major + '</td>' +
                                                '<td>' + data[k].class + '</td>' +
                                                '<td>' + data[k].name + '</td>' +
                                                '<td>' + data[k].num + '</td>' +
                                                '<td>' + data[k].teacher + '</td>' +
                                                '<td>' + data[k].competition_name + '</td>' +
                                                '<td>' + data[k].competition_result + '</td>' +
                                                '<td>' + data[k].award_info + '</td>' +
                                                '<td><a href="' + data[k].diploma_url + '">查看证书</a></td>' +
                                                '<td>' + data[k].year + '</td>'+
                                                '</tr>'
                                        );
                                        k++;
                                    }
                                } else {
                                    if(page>1){
                                        alert('已到达末页');
                                    }else {
                                        if(page){
                                            $('#nn_nn').text(0);
                                        }
                                        $('.info_data,.info_data + td').remove();
                                        alert('暂时不存在任何信息');
                                    }
                                }
                            },
                            error: function (xhr, type) {
                                alert('Ajax error!');
                            }
                        });
                    } else {
                        alert('抱歉，没有查询数据')
                    }
                }

                $("#major_select").change(function () {
                    $('.info_data,.info_data + td').remove();
                    $('#nn_nn').text(0);
                    $('#refresh ').trigger('click');
                });

                $('#search__').keypress(function (e) {
                    if(e && e.keyCode==13){
                        $('#search_').trigger('click');
                    }
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
                        url:'{{route('delete_info')}}',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data:{
                            data:data
                        },
                        success:function () {
                            $('#refresh').trigger('click');
                        }
                    })
                });
            });
        </script>
@endsection