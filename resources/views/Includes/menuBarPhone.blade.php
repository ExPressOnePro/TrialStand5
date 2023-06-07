@section('menuBarPhone')
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        {{--<nav class="amazing-tabs fixed-bottom">
            <div class="main-tabs-container">
                <div class="main-tabs-wrapper">
                    <ul class="main-tabs">
                        <li>
                            <a href="{{ route('home') }}">
                                <button class="round-button" style="--round-button-active-color: #9f34ff" data-translate-value="0">
                                    <span class="menu-phone">
                                        <i class="fa-solid fa-house text-20"></i>
                                    </span>
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('stand') }}">
                                <button class="round-button" style="--round-button-active-color: #2962ff" data-translate-value="100%">
                                   <span class="menu-phone">
                                        <i class="fa-solid fa-table text-20"></i>
                                   </span>
                                </button>
                            </a>
                        </li>
                        <li>
                            <button class="round-button" style="--round-button-active-color: #00c853" data-translate-value="200%" >
                                <span class="menu-phone">
                                    <i class="fa-solid fa-pen text-20"></i>
                                </span>
                            </button>
                        </li>
                        <li>
                            <button class="round-button" style="--round-button-active-color: #aa00ff" data-translate-value="300%">
                                <span class="menu-phone">
                                    <i class="fa-solid fa-address-book text-20"></i>
                                </span>
                            </button>
                        </li>
                        <li>
                            <button class="round-button" style="--round-button-active-color: #ff6d00" data-translate-value="400%" >
                                <span class="menu-phone">
                                    <i class="fa-solid fa-house text-20"></i>
                                </span>
                            </button>
                        </li>
                    </ul>
                    <div class="main-slider" aria-hidden="true">
                        <div class="main-slider-circle">&nbsp;</div>
                    </div>
                </div>
            </div>
        </nav>--}}
        <div class="icon-bar-bottom fixed-bottom">
            @if (request()->is('home', 'home/*'))
                <a href="{{ route('home') }}"><i class="choice fa fa-home"></i><p class="choice">Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif
            @if (request()->is('stand', 'stand/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="choice fa-solid fa-table"></i><p class="choice">Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif
            @if (request()->is('users', '/users/*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="choice fa-solid fa-address-book"></i><p class="choice">Контакты</p></a>
                    <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                    <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif

        </div>
    @elseif ($mobile_detect->isTablet())
        <div class="icon-bar fixed-bottom">
            @if (request()->is('home', 'home/*'))
                <a href="{{ route('home') }}"><i class="choice fa fa-home"></i><p class="choice">Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif
            @if (request()->is('stand', 'stand/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="choice fa-solid fa-table"></i><p class="choice">Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif
            @if (request()->is('UserControl', '/UserControl/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="choice fa-solid fa-address-book"></i><p class="choice">Контакты</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
            @endif

        </div>
    @else
    @endif

