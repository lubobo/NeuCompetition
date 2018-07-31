<div style="background-color:#1b6d85;height: 100%">
    <ul class="list-group" style="width: 100.5%">
        @if(session('user')=='root')

            <div class="center li1" id="flip">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-th-list"> 竞赛管理</span></h5>
            </div>
            <div id="panel">
                <a class="center" style="color: #3e3e3e" href="{{route('AddCompetition')}}"><li class="li1"><h5>发布竞赛系统</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('GetCompetition')}}"><li class="li1"><h5>更新竞赛系统</h5></li></a>
            </div>
            <div class="center li1" id="flip1">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-user"> 信息管理</span></h5>
            </div>
            <div id="panel1">
                <a class="center" style="color: #3e3e3e" href="{{route('getAdminStudent')}}"><li class="li1"><h5>参赛学生管理系统</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('getAdminTeam')}}"><li class="li1"><h5>参赛团队管理系统</h5></li></a>
            </div>
            <div class="center li1" id="flip2">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-glass"> 奖项管理</span></h5>
            </div>
            <div id="panel2">
                <a class="center" style="color: #3e3e3e" href="{{route('getAward')}}" ><li class="li1"><h5>竞赛奖项颁布</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('info_main_page')}}" ><li><h5>竞赛获奖查询</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('import_index')}}" ><li class="li1"><h5>获奖信息导入</h5></li></a>
            </div>
            <div class="center li1" id="flip3">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-home"> 人员管理</span></h5>
            </div>
            <div id="panel3">
                <a class="center" style="color: #3e3e3e" href="{{route('adminStudent')}}" ><li class="li1"><h5>注册学生管理</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('adminTeacher')}}" ><li class="li1"><h5>注册教师管理</h5></li></a>
                {{--<a class="center" style="color: #3e3e3e" href="{{route('import_index')}}" ><li class="li1"><h5>获奖信息导入</h5></li></a>--}}
            </div>
        <div id="panel2">
            <a class="center" style="color: #9c3328;" href="{{route('getAdminHelp')}}" >
                <li class="li1">
                    <h5>
                        <span class="glyphicon glyphicon-compressed"> 使用帮助</span>
                    </h5>
                </li>
            </a>
        </div>
        @else
            <div class="center li1" id="flip1">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-user"> 信息管理</span></h5>
            </div>
            <div id="panel1">
                <a class="center" style="color: #3e3e3e" href="{{route('getAdminStudent')}}"><li class="li1"><h5>参赛学生审核</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('getAdminTeam')}}"><li class="li1"><h5>参赛团队审核</h5></li></a>
            </div>
            <div class="center li1" id="flip2">
                <h5 style="color:#d0e9c6"><span class="glyphicon glyphicon-glass"> 奖项管理</span></h5>
            </div>
            <div id="panel2">
                <a class="center" style="color: #3e3e3e" href="{{route('getAward')}}" ><li class="li1"><h5>竞赛奖项颁布</h5></li></a>
                <a class="center" style="color: #3e3e3e" href="{{route('info_main_page')}}" ><li class="li1"><h5>竞赛获奖查询</h5></li></a>
            </div>
        @endif
    </ul>
</div>
<script language="JavaScript">
    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("fast");
        });
        $("#flip1").click(function(){
            $("#panel1").slideToggle("fast");
        });
        $("#flip2").click(function(){
            $("#panel2").slideToggle("fast");
        });
        $("#flip3").click(function(){
            $("#panel3").slideToggle("fast");
        });
    });
</script>
<style type="text/css">
    #panel,#panel1,#panel2,#panel3
    {
        text-align:center;
        background-color:#e5eecc;
        width: 99.5%
    }
    /*#panel,#panel1,#panel2*/
    /*{*/
    /*display:none;*/
    /*}*/
</style>