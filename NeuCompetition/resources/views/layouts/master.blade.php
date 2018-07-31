<!Doctype html>
<html style="height:100%;padding: 0;margin: 0;">
<head>
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>
</head>
<body style="height:100%;padding-bottom: 0">
<div style="min-height:100%;height: auto !important;position: relative;">
    <div class="container" style="width: 100%;padding: 0">
        <div>
            @include('includes.header')
        </div>
        <div class="container" style="width:80%;margin: 0 auto;padding-bottom: 100px;">
            @yield('content')
        </div>
        <div style="position: absolute;width:100%;bottom:0;clear: both;">
            @include('includes.footer')
        </div>
    </div>
</div>
</body>
</html>
