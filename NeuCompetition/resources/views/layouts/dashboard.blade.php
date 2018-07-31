{{--<!Doctype html>--}}
{{--<html style="height:100%;padding: 0;margin: 0;">--}}
{{--<head>--}}
{{--<title>@yield('title')</title>--}}
{{--<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>--}}
{{--<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>--}}
{{--<link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.min.css">--}}
{{--<link rel="stylesheet" href="{{ URL::to('/src/css/main.css')}}">--}}
{{--<script type="text/javascript" src="{{ URL::to('/ckeditor/ckeditor.js')}}"></script>--}}
{{--<script src="/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>--}}
{{--<script type="text/javascript" rel="script" src="/js/get_major.js"></script>--}}
{{--<script type="text/javascript" rel="script" src="/js/confirm.js"></script>--}}
{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>--}}
{{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--<meta name="_token" content="{!! csrf_token() !!}"/>--}}
{{--</head>--}}
{{--<body style="height:100%;padding-bottom: 0">--}}
{{--<div style="height:100%;position: relative;">--}}
{{--<div style="height: 9%; padding: 0">--}}
{{--@include('dashboard.header')--}}
{{--</div>--}}
{{--<div class="col-xs-2 container" style="height: 91%;padding: 0;margin: 0 auto;">--}}
{{--@include('dashboard.right')--}}
{{--</div>--}}
{{--<div style="height: 800px;overflow: scroll;margin: 0">--}}
{{--<div style="width: 100%;margin: 0 auto;">--}}
{{--<div style="width:95%;margin: 0 auto;padding-bottom: 30px;">--}}
{{--@yield('content')--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div style="position: absolute;width:100%;bottom:0;clear: both;">--}}
{{--@include('dashboard.footer')--}}
{{--</div>--}}
{{--</div>--}}
{{--<div style="min-height:100%;height: auto !important;position: relative;">--}}
{{--<div class="container" style="width: 100%;padding: 0">--}}
{{--<div>--}}
{{--@include('dashboard.header')--}}
{{--</div>--}}
{{--<div class="container col-xs-2" style="position: absolute; left: -15px; width:20%;margin: 0 auto;padding-bottom: 100px;">--}}
{{--@include('dashboard.right')--}}
{{--</div>--}}
{{--<div class="container col-xs-2" style="width:80%;margin: 0 auto;padding-bottom: 100px;">--}}
{{--@yield('content')--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
{{--height: auto !important;--}}
{{--background-color:#d4d4d4--}}

{{--<div style="height:100%;position: relative;">--}}
{{--<div style="height: 9%; padding: 0">--}}
{{--@include('dashboard.header')--}}
{{--</div>--}}
{{--<div class="col-xs-2 container" style="height: 91%;padding: 0;margin: 0 auto;">--}}
{{--@include('dashboard.right')--}}
{{--</div>--}}
{{--<div class="container" style="width: 100%;margin: 0 auto;padding-bottom: 50px;">--}}
{{--<div style="width:80%;margin: 0 auto;">--}}
{{--@yield('content')--}}
{{--</div>--}}
{{--<div style="position: absolute;width:100%;bottom:0;clear: both;">--}}
{{--@include('dashboard.footer')--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}


        <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('/src/css/main.css')}}">
    <!-- share.css -->
    <link rel="stylesheet" href="/social-share/dist/css/share.min.css">
    <script type="text/javascript" src="{{ URL::to('/ckeditor/ckeditor.js')}}"></script>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
    <script src="/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" rel="script" src="/js/get_major.js"></script>
    <script type="text/javascript" rel="script" src="/js/confirm.js"></script>
    <!-- share.js -->
    <script src="/social-share/dist/js/social-share.min.js"></script>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/Font-Awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-2.3.6/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="/AdminLTE-2.3.6/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="/AdminLTE-2.3.6/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    {{--<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">--}}

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="_token" content="{!! csrf_token() !!}"/>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('adminHome')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>N</b>EU</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>NEU</b>COMPETITION</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/uploads/Neu.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{session('user')}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/uploads/Neu.jpg" class="img-circle" alt="User Image">

                                <p>
                                    东北大学竞赛管理后台
                                    <small>创新创业学院</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="icon-cogs"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/uploads/Neu.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>东北大学竞赛管理后台</p>
                    <!-- Status -->
                    <a href="{{route('adminHome')}}"><i class="fa fa-circle text-success"></i> 创新创业学院</a>
                </div>
            </div>

            <ul class="sidebar-menu">

                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="{{route('adminHome')}}"><i class="icon-home"></i> <span>后台首页</span></a></li>

                @if(session('user')=='root')
                    <li class="treeview">
                        <a href="#"><i class="icon-folder-open-alt"></i> <span>竞赛管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('AddCompetition')}}">发布竞赛系统</a></li>
                            <li><a  href="{{route('GetCompetition')}}">更新竞赛系统</a></li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#"><i class="icon-reorder"></i> <span>信息管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('getAdminStudent')}}">参赛学生管理系统</a></li>
                            <li><a  href="{{route('getAdminTeam')}}">参赛团队管理系统</a></li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#"><i class="icon-trophy"></i> <span>奖项管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('getAward')}}" >竞赛奖项颁布</a></li>
                            <li><a  href="{{route('info_main_page')}}" >竞赛获奖查询</a></li>
                            <li><a  href="{{route('import_index')}}" >获奖信息导入</a></li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#"><i class="icon-group"></i> <span>人员管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('adminStudent')}}" >注册学生管理</a></li>
                            <li><a  href="{{route('adminTeacher')}}" >注册教师管理</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('getAdminHelp')}}"><i class="icon-wrench"></i> <span>使用帮助</span></a></li>
                @else
                    <li class="treeview">
                        <a href="#"><i class="icon-reorder"></i> <span>信息管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('getAdminStudent')}}">参赛学生管理系统</a></li>
                            <li><a  href="{{route('getAdminTeam')}}">参赛团队管理系统</a></li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#"><i class="icon-trophy"></i> <span>奖项管理</span>
                            <span class="pull-right-container">
<i class="icon-angle-right"></i>
</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a  href="{{route('getAward')}}" >竞赛奖项颁布</a></li>
                            <li><a  href="{{route('info_main_page')}}" >竞赛获奖查询</a></li>
                            <li><a  href="{{route('import_index')}}" >获奖信息导入</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('getAdminHelp')}}"><i class="icon-wrench"></i> <span>使用帮助</span></a></li>
                @endif
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Your Page Content Here -->
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            东北大学科技竞赛平台
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">NEU</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">

        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            {{--<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>--}}
            {{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="" id="control-sidebar-home-tab">
                {{--<h3 class="control-sidebar-heading">Recent Activity</h3>--}}
                <ul class="control-sidebar-menu">
                </ul>
                <!-- /.control-sidebar-menu -->
            </div>
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 2.2.3 -->
<script src="/AdminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLTE-2.3.6/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="/AdminLTE-2.3.6/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/AdminLTE-2.3.6/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/AdminLTE-2.3.6/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="/AdminLTE-2.3.6/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/AdminLTE-2.3.6/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/AdminLTE-2.3.6/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/AdminLTE-2.3.6/dist/js/demo.js"></script>
</body>
</html>