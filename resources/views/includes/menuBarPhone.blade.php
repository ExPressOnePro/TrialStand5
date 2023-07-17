@section('menuBarPhone')
    @if( Auth::user()->congregation_id != 1 )
            <div class="icon-bar-bottom fixed-bottom">
                @if (request()->is('home*'))
                    <a href="{{ route('home') }}"><i class="text-primary fa fa-home"></i><p class="text-primary">Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    {{--<a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>--}}
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                @if (request()->is('stand*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="text-primary fa-solid fa-table"></i><p class="text-primary">Стенд</p></a>
                    {{--<a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>--}}
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
                {{--@if (request()->is('users*'))
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
                @endif--}}
                @if (request()->is('profile*', 'profile/*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    {{--<a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>--}}
                    <a href="{{ route('profile', Auth::id()) }}"><i class="text-primary fa-solid fa-user"></i><p class="text-primary">Аккаунт</p></a>
                @endif
                @if (!request()->is('home*','stand*','users*', 'profile*', 'UserControl*'))
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i><p>Главная</p></a>
                    <a href="{{ route('stand') }}"><i class="fa-solid fa-table"></i><p>Стенд</p></a>
                    {{--<a href="{{ route('users') }}"><i class="fa-solid fa-address-book"></i><p>Контакты</p></a>
                    <a href=""><i class="fa-solid fa-user-tie"></i><p>Встречи</p></a>--}}
                    <a href="{{ route('profile', Auth::id()) }}"><i class=" fa-solid fa-user"></i><p>Аккаунт</p></a>
                @endif
            </div>
    @endif

