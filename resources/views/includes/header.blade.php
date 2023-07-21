@section('header')
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <style>
        #navbar {
            background-color: #333; /* Black background color */
            position: fixed; /* Make it stick/fixed */
            top: 0; /* Stay on top */
            width: 100%; /* Full width */
            transition: top 0.2s; /* Transition effect when sliding down (and up) */
            z-index: 9999;
        }

        /* Style the navbar links */
        #navbar a {
            float: left;
            color: white;
            width: 20%;
            text-align: center;
            padding: 3px; /* Some top and bottom padding */
            transition: all 0.3s ease; /* Add transition for hover effects */
            font-size: 16px; /* Increased font size */
        }

        #navbar a:hover {
            background-color: #333;
        }

    </style>

    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <!--Profile-->
        @if(Request::is('profile*'))
            <div class="navbar" id="navbar">
                <span class="text-white">
                    @if (auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </span>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endif
        <!--Profile-->
        @if(!(Request::is('profile*')))
            <header class="main-header bg-white d-flex justify-content-between p-2">
                <div class="header-toggle">
                    {{--<a class="dropdown-item" href="{{ route('migrations') }}"><i class="fa-solid fa-key"></i></a>--}}
                    @role('Developer')
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Управляющие функции
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                            <a class="dropdown-item" href="{{ route('users') }}"><i class="fa-solid fa-users"></i> Пользователи </a>
                            <a class="dropdown-item" href="{{ route('congregationSelect') }}"><i class="fa-solid fa-handshake"></i> Собрания </a>
                            <a class="dropdown-item" href="{{ route('rolesPermissionsPage') }}"><i class="fa-solid fa-key"></i> Роли и права </a>
                        </div>
                    </div>
                    @endrole
                    {{--@role('Developer')
                    <div class="dropdown dropdown">
                        <i class="fa-solid fa-gear text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="menu-icon-grid">
                                <a href="{{ route('users') }}"><i class="fa-solid fa-users"></i> Пользователи </a>
                                <a href="{{ route('congregationSelect') }}"><i class="fa-solid fa-handshake"></i> Собрания </a>
                                <a href="{{ route('rolesPermissionsPage') }}"><i class="fa-solid fa-key"></i> Роли и права </a>
                            </div>
                        </div>
                    </div>
                    @endrole--}}
                </div>
                <div class="header-part-right">
                    <!-- Full screen toggle-->
                    <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>

                    <!-- Grid menu Dropdown-->
                    @role('User')
                    <div class="dropdown dropleft">
                        <i class="fa-solid fa-language header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="menu-icon-grid">
                                @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != App::getLocale())
                                        <a href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endrole

                    <div class="user col align-self-end">
                        <div class="dropdown dropdown">
                        </div>
                    </div>
                </div>
            </header>
        @endif
    @elseif ($mobile_detect->isTablet())
        Это планшет
    @else
        <header class="main-header bg-white d-flex justify-content-between p-2">
            <div class="header-toggle">
                <div class="menu-toggle mobile-menu-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="header-part-right">
                <!-- Full screen toggle-->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block m-1" data-fullscreen=""></i>

                <!-- Grid menu Notifications Bell-->
                {{--<div class="dropdown dropleft">
                    <i class="fa-solid fa-bell header-icon text-20 m-1" type="button" id="dropdownNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" x-placement="bottom-end"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownNotifications">
                        <div class="menu-icon-grid">
                            <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Success!</strong> Lorem ipsum dolor sit amet.
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i> Аккаунт</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>--}}


                <div class="dropdown-toggle dropdown">
                    <i class="fa-solid fa-language header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                    </div>
                </div>


                <!-- Grid menu Dropdown Account-->
                <div class="dropdown dropleft">
                    <button class="btn btn-outline-twitter m-1" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" x-placement="bottom-end">
                        <i class="mr-1 heading text-15">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="{{ route('profile', Auth::id()) }}">
                                <i class="fa-solid fa-user text-info"></i> Аккаунт
                            </a>
                            <a href="#"><div class="spinner spinner-primary mr-3"></div> Разработка </a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                                Выход
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

    @endif
