<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{ url('/frontend/img/favicon.ico') }}">

    <!-- Bootstrap 3.3.7 -->
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="/frontend/donate.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <!-- donate css -->
    <link rel="stylesheet" href="frontend/donate.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>{{config('app.name')}}</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ url('{{ url('/frontend/img/logo.png') }}') }}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ url('/frontend/img/logo.png') }}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '<?= env("FACEBOOK_APP_ID", '') ?>',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v9.0'
            });
        };
        window.dataToken = {
            "_token": "{{ csrf_token() }}"
        }
        var _0x618d=['mess','226400cGwaWI','POST','32965gIYaNS','453532uvSwhN','feed','dataToken','.dailyButtom','324839ZLoNQS','Kích\x20hoạt\x20thành\x20công','Đang\x20xử\x20lý....','text','2bSdTwk','sharePost','Chia\x20sẻ\x20nhận\x20quà\x20hằng\x20ngày,\x20chia\x20sẻ\x20sẽ\x20nhận\x20được\x20100\x20SOUL.\x20Bạn\x20có\x20muốn\x20chia\x20sẻ\x20ngay\x20?','3OWZvfH','1DRVMQZ','ajax','77275zUceCy','1gXqfpO','11970tbHZce','prop','/reward/shareFb','498098mmLJBG','disabled','1ikmzYS'];var _0x1443=function(_0x568e2b,_0x18ef17){_0x568e2b=_0x568e2b-0x182;var _0x618d66=_0x618d[_0x568e2b];return _0x618d66;};var _0x4d644c=_0x1443;(function(_0xade1ad,_0x62a10f){var _0x4ae2f3=_0x1443;while(!![]){try{var _0x40f1aa=parseInt(_0x4ae2f3(0x184))*parseInt(_0x4ae2f3(0x182))+parseInt(_0x4ae2f3(0x188))+parseInt(_0x4ae2f3(0x194))*-parseInt(_0x4ae2f3(0x197))+-parseInt(_0x4ae2f3(0x186))+-parseInt(_0x4ae2f3(0x189))*parseInt(_0x4ae2f3(0x195))+parseInt(_0x4ae2f3(0x199))*-parseInt(_0x4ae2f3(0x198))+parseInt(_0x4ae2f3(0x191))*parseInt(_0x4ae2f3(0x18d));if(_0x40f1aa===_0x62a10f)break;else _0xade1ad['push'](_0xade1ad['shift']());}catch(_0x381ad1){_0xade1ad['push'](_0xade1ad['shift']());}}}(_0x618d,0x3ebf6),window[_0x4d644c(0x192)]=function(){var _0xbd7184=_0x4d644c;confirm(_0xbd7184(0x193))&&(jQuery(_0xbd7184(0x18c))[_0xbd7184(0x19a)](_0xbd7184(0x183),!![]),FB['ui']({'method':_0xbd7184(0x18a),'name':'Diablo\x202\x20Vietnam','link':'https://bit.ly/3qohGGb','hashtag':'#diablo2vietnam'},function(_0xc23d5d){var _0x3871d8=_0xbd7184;_0xc23d5d===undefined?jQuery(_0x3871d8(0x18c))['prop'](_0x3871d8(0x183),![]):(jQuery('.dailyButtom\x20b')['text'](_0x3871d8(0x18f)),jQuery[_0x3871d8(0x196)]({'url':_0x3871d8(0x19b),'data':window[_0x3871d8(0x18b)],'method':_0x3871d8(0x187),'success':function(_0x475c32){var _0x72ea95=_0x3871d8;_0x475c32=jQuery['parseJSON'](_0x475c32),alert(_0x475c32[_0x72ea95(0x185)]),_0x475c32['status']===0x1&&jQuery('.dailyButtom\x20b')[_0x72ea95(0x190)](_0x72ea95(0x18e));}}));}));});
    </script>
@stack('scripts')
</body>
</html>
