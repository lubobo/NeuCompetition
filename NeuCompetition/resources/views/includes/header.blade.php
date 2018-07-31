<header class="wrapper">
    <div class="navbar navbar-default navbar1" id="navbar-default1">
        <div class="navbar-header" id="navbar-header1">
            <div class="col-xs-6 col-xs-offset-2">
               <h3 style="color:#FFFFff;">
                   东北大学科技竞赛平台
               </h3>
            </div>
        </div>
        <div class="collapse navbar-collapse navbar-collapse1" id="bs-example-navbar-collapse-1 navbar-collapse1">
            <ul class="nav nav-pills nav-justified" id="navbar-left1">
                <li><a class="a1"  href="{{route('welcome')}}">竞赛平台</a></li>
                <li><a class="a1"  href="#">学科竞赛</a></li>
                <li><a class="a1"  href="{{route('getLists')}}">竞赛列表</a></li>
                <li><a class="a1"  href="{{route('getHelp')}}">使用帮助</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{route('PostSearch')}}" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="post_name" placeholder="Search......" id="form-control1" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>
                <button type="submit" class="btn btn-default glyphicon glyphicon-search" id="btn-default1"></button>
                <ul class="nav nav-pills nav-justified " id="navbar-left2">
                    @if(session('user'))
                        @if(session('role')=='student')
                            <li><a class="a3 glyphicon glyphicon-home" href="{{route('myHome')}}"></a></li>
                            <li><a class="a3" href="#">{{session('user')}}</a></li>
                            <li><a class="a3" href="{{route('logout')}}">退出</a></li>
                        @endif
                        @if(session('role')=='admin')
                            <li><a class="a3 glyphicon glyphicon-home" href="{{route('adminHome')}}"></a></li>
                            <li><a class="a3" href="#">{{session('user')}}</a></li>
                            <li><a class="a3" href="{{route('logout')}}">退出</a></li>
                        @endif
                        @if(session('role')=='teacher')
                            <li><a class="a3 glyphicon glyphicon-home" href="{{route('teacherHome')}}"></a></li>
                            <li><a class="a3" href="#">{{session('user')}}</a></li>
                            <li><a class="a3" href="{{route('logout')}}">退出</a></li>
                        @endif
                    @else
                        <li><a class="a3" href="/login">登陆</a></li>
                        <li><a class="a3" href="/register">注册</a></li>
                    @endif
                </ul>
            </form>
        </div>
    </div>
</header>