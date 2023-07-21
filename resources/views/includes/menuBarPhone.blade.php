@section('menuBarPhone')
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        @if( Auth::user()->congregation_id != 1 )
            <div class="icon-bar-bottom fixed-bottom">
                @if (request()->is('home*'))
                    <a href="{{ route('home') }}"><i class="text-primary fa fa-home"></i><p class="text-primary">Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                @if (request()->is('stand*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="text-primary fa-solid fa-table"></i><p class="text-primary">Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                @if (request()->is('users*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="text-primary fa-solid fa-address-book"></i><p class="text-primary">Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                @if (request()->is('UserControl*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="text-primary fa-solid fa-user-tie"></i><p class="text-primary">UserControl</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                @if (request()->is('profile*', 'profile/*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="text-primary fa-solid fa-user"></i><p class="text-primary">Аккаунт</p></a>
                @endif
                {{--@if (!request()->is('home', 'home/*','stand', 'stand/*','users*', 'users/*', 'profile*', 'UserControl*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class=" fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif--}}
            </div>
        @else

        {{--<div class="icon-bar-bottom fixed-bottom">
            @if (request()->is('home', 'home/*'))
                <a href="{{ route('home') }}"><i class="choice fa fa-home"></i><p class="choice">Главная</p></a>

            @endif
            @if (request()->is('stand*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="choice fa-solid fa-table"></i><p class="choice">Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href=""><i class="fa-solid fa-pen"></i><p>Встречи</p></a>
                <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif
            @if (request()->is('users*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="choice fa-solid fa-address-book"></i><p class="choice">Контакты</p></a>
                <a href=""><i class="fa-solid fa-pen"></i><p>Встречи</p></a>
                <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif
            @if (request()->is('UserControl*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href=""><i class="choice fa-solid fa-pen"></i><p class="choice">UserControl</p></a>
                <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif
            @if (request()->is('profile*', 'profile/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href=""><i class="fa-solid fa-pen"></i><p>UserControl</p></a>
                <a href="{{ route('profile', Auth::id()) }}"><i class="choice fa-solid fa-user"></i><p class="choice">Аккаунт</p></a>
            @endif
            @if (!request()->is('home', 'home/*','stand', 'stand/*','users*', 'users/*', 'profile*', 'UserControl*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>

            @endif

        </div>--}}
        @endif
    @elseif ($mobile_detect->isTablet())
        <div class="icon-bar fixed-bottom">
            @if (request()->is('home', 'home/*'))
                <a href="{{ route('home') }}"><i class="choice fa fa-home"></i><p class="choice">Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
                <a href="#"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif
            @if (request()->is('stand', 'stand/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="choice fa-solid fa-table"></i><p class="choice">Стенд</p></a>
                <a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
                <a href="{{ route('account', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif
            @if (request()->is('UserControl', '/UserControl/*'))
                <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                <a href="{{ route('users') }}"><i class="choice fa-solid fa-address-book"></i><p class="choice">Контакты</p></a>
                <a href="#"><i class="fa-solid fa-pen"></i><p>Записи</p></a>
                <a href="{{ route( 'account', Auth::id() ) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
            @endif

        </div>
    @else
    @endif

