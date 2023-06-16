@section('header')
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <header class="main-header bg-white d-flex justify-content-between p-2">
            <div class="header-toggle">
                @role('Developer')
                <div class="dropdown dropdown">
                    <i class="fa-solid fa-gear text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="{{ route('users') }}"><i class="fa-solid fa-users"></i> Users</a>
                            <a href="{{ route('congregationSelect') }}"><i class="fa-solid fa-handshake"></i> Congregations</a>
                            <a href="{{ route('rolesPermissionsPage') }}"><i class="fa-solid fa-key"></i> Roles-Permissions</a>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
            <div class="header-part-right">
                <!-- Full screen toggle-->

                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
                <!-- Grid menu Dropdown-->

                @role('User')
                {{--<a href="{{ route('notifications') }}">
                    <i class="fa-solid fa-bell text-20 header-icon"></i>
                </a>--}}

                {{--<div class="dropdown dropleft">
                    <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="#"><i class="fa-solid fa-bell"></i> Home</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="#"><i class="i-Ambulance"></i> Support</a></div>
                    </div>
                </div>--}}
                @endrole

                {{--<div class="user col align-self-end">--}}
                    <div class="dropdown dropdown">
                        <button class="btn btn-outline-twitter m-1" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" x-placement="bottom-end">
                        <i class="mr-1 heading text-15">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </i>
                        </button>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-109px, 36px, 0px);">
                        {{--<a class="dropdown-item">Account settings</a>
                        <a class="dropdown-item">Billing history</a>--}}
                        <a class="dropdown-item text-center">
                            <button class="btn btn-outline-danger m-1" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                {{ __('Выход') }}
                            </button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
            </div>
                {{--</div>--}}
                {{--<button class="btn btn-outline-danger m-1" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                    {{ __('Выход') }}
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>--}}
            </div>
        </header>



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

                <!-- Grid menu Notifications-->
                <div class="dropdown dropleft">
                    <i class="fa-solid fa-bell header-icon text-20 m-1 text-primary" type="button" id="dropdownNotifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" x-placement="bottom-end"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownNotifications">
                        <div class="menu-icon-grid">
                            <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Success!</strong> Lorem ipsum dolor sit amet.
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i> Аккаунт</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>

                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
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
                            <a href="#"><div class="spinner spinner-primary mr-3"></div> Разработка</a>
                            <a href="#"><div class="spinner spinner-primary mr-3"></div> Разработка</a>
                            <a href="#"><div class="spinner spinner-primary mr-3"></div> Разработка</a>
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
        {{--<script src="../../dist-assets/js/custom/actionbutton.js"></script>--}}
