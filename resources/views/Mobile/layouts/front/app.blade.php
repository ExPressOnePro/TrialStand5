<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{--@if(Request::is('*menu'))--}}
{{--    @include('Mobile.layouts.components.hub.blade.php-head')--}}
{{--@elseif(Request::is('*home'))--}}
{{--    @include('Mobile.layouts.components.hub.blade.php-head')--}}
{{--@else--}}
    @include('Mobile.layouts.components.front-head')
{{--@endif--}}

<body>

<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if(Request::is('stand*'))
    @include('Mobile.includes.headers.header-stand')
@elseif(Request::is('*menu'))
    @include('Mobile.includes.headers.header-menu')
@elseif(Request::is('*home'))
    @include('Mobile.includes.headers.header-home')
@elseif(Request::is('*contacts*'))
    @include('Mobile.includes.headers.header-contacts')
@elseif(Request::is('*congregation*'))
    @include('Mobile.includes.headers.header-congregation')
@endif

@include('Mobile.includes.menuBarPhone')

<main id="content" role="main" class="main mb-7">

    @yield('content')


    @if(Request::is('*stand/current*', '*stand/next*', '*menu/stand'))
        @include('Mobile.layouts.components.scripts.stand')
    @else
        @include('Mobile.layouts.components.front-scripts')
    @endif


</main>
</body>
</html>

