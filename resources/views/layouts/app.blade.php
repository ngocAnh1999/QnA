<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    @stack('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/content.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid" id="app">
        <div class="row header text-white">
                <div class="col-sm-3 left">
                    <div class="genaral"></div>
                    <div class="q-a">Question & Answer</div>
                </div>
                @guest
                
                    <div class="ml-auto mr-4">
                        <a class="text-white m-2 p-2 bg-dark shadow" href="{{ route('login') }}">Login</a>
                        <a class="text-white p-2 bg-dark shadow" href="{{ route('register') }}">Register</a>
                    </div>
                
                @else
                <div class="col">
                    <div class="quanly nav-link dropdown-toggle p-3 shadow-lg" data-toggle="dropdown">Quản lý</div>
                    <ul class="dropdown-menu dropdown-menu-right px-4">
                        <li role="presentation" class="text-left"><a role="menuitem" href="{{ route('qna','all') }}">Phiên hỏi đáp</a></li>
                        <li class="dropdown-divider"></li>
                        <li role="presentation" class="text-left"><a role="menuitem" href="{{ route('survey') }}">Thống kê</a></li>
                    </ul>
                </div>

                <div class="col-md-2 user">
                        <div class="avatar"><img class="rounded-circle" src="{{ asset('storage/image/default_avata.png') }}" /></div>                
                    <div class="user-account">
                    <div class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</div>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li role="presentation" class="text-center"><a 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            role="menuitem"
                            href="{{ route('logout') }}">Đăng xuất</a></li>

                            <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
                @endguest
        </div>
        <main class="py-4">
            @if(Auth::check())
                @yield('content')
            @else
                @yield('guest')
            @endif
        </main>
        <div class="row footer fixed-bottom">
            <h3 class="text-white m-auto">Được tạo bởi nhóm 12 - CNTT</h3>
        </div>
    </div>
</body>
</html>