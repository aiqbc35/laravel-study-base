<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TEST DEM @yield('title')</title>
    <style type="text/css">
        body{
            margin: 0;
            padding: 0;
        }
        .header{
            width: 100%;
            height: 69px;
            margin-bottom: 10px;
            background-color: #5bc0de;
        }
        .nav{
            width: 100%;
            margin-bottom: 10px;
            height: 300px;
        }
        .sidebar{
            width: 30%;
            height: 100%;
            float: left;
            background-color: #5bc0de;
        }
        .content{
            width: 65%;
            height: 100%;
            float: right;
            background-color: #5bc0de;
        }
        .footer{
            width: 100%;
            height: 50px;
            background-color: #5bc0de;
        }
    </style>
</head>
<body>
<div class="header">
    @section('header')
    头部
    @show
</div>
<div class="nav">
    <div class="sidebar">
        @section('sidebar')
        侧边栏
        @show
    </div>
    <div class="content">
        @yield('content','内容')

    </div>
</div>

<div class="footer">
    @section('footer')
    底部
    @show
</div>
</body>
</html>