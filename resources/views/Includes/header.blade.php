@section('header')
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    @inject('mobile_detect', 'Mobile_Detect')
        @if ($mobile_detect->isMobile())
            <header class="main-header bg-white d-flex justify-content-between p-2">
            <div class="header-toggle">
                <div class="menu-toggle mobile-menu-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="header-part-right">
                <!-- Full screen toggle--><i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
                <!-- Grid menu Dropdown-->
                <div class="dropdown dropleft">
                    <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="#"><i class="i-Shop-4"></i> Home</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="#"><i class="i-Ambulance"></i> Support</a></div>
                    </div>
                </div>
                <div class="user col align-self-end">
                    <div class="dropdown-header" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="i-Lock-User mr-1 heading text-18">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-109px, 36px, 0px);">
                        <a class="dropdown-item">Account settings</a>
                        <a class="dropdown-item">Billing history</a>
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
            <header class="main-header fixed-bottom bg-white d-flex justify-content-between p-2">
                <div class="header-toggle">
                    <div class="menu-toggle mobile-menu-icon">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="header-part-right">
                    <!-- Full screen toggle--><i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
                    <!-- Grid menu Dropdown-->
                    <div class="dropdown dropleft">
                        <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div class="menu-icon-grid">
                                <a href="#"><i class="i-Shop-4"></i> Home</a>
                                <a href="#"><i class="i-Library"></i> UI Kits</a>
                                <a href="#"><i class="i-Drop"></i> Apps</a>
                                <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                                <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                                <a href="#"><i class="i-Ambulance"></i> Support</a></div>
                        </div>
                    </div>
                    <div class="user col align-self-end">
                        <div class="dropdown-header border-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="i-Lock-User mr-1 heading text-18">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @endif
                            </i>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-109px, 36px, 0px);">
                            <a class="dropdown-item">Account settings</a>
                            <a class="dropdown-item">Billing history</a>

                            <button class="btn btn-outline-danger m-1" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                {{ __('Выход') }}
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </div>
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

        @endif
        {{--<script src="../../dist-assets/js/custom/actionbutton.js"></script>--}}
