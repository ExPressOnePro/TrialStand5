<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{--@if(Request::is('*menu'))--}}
{{--    @include('Mobile.layouts.components.hub-head')--}}
{{--@elseif(Request::is('*home'))--}}
{{--    @include('Mobile.layouts.components.hub-head')--}}
{{--@else--}}
    @include('Mobile.layouts.components.front-head')
{{--@endif--}}

<body>

<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
{{--@if(Request::is('profile*'))--}}
{{--    @include('Mobile.includes.headers.header-profile')--}}
{{--@endif--}}
{{--@if(Request::is('home*'))--}}
{{--    @include('Mobile.includes.headers.header-home')--}}
{{--@endif--}}
@if(Request::is('menu/stand*'))
    @include('Mobile.includes.headers.header-stand')
@elseif(Request::is('*menu'))
    @include('Mobile.includes.headers.header-menu')
@elseif(Request::is('*home'))
    @include('Mobile.includes.headers.header-home')
@endif
{{--@if(Request::is('dev*'))--}}
{{--    @include('Mobile.includes.headers.header-developer')--}}
{{--    @include('Mobile.includes.asides.aside-developer')--}}
{{--@endif--}}
{{--@unless(Request::is('dev*'))--}}
{{--    @include('Mobile.includes.headers.header-home')--}}
{{--@endunless--}}
<main id="content" role="main" class="main mb-7">

    @yield('content')
{{--    @if(Request::is('*home', '*menu'))--}}
{{--        @include('Mobile.layouts.components.hub-scripts')--}}
{{--    @else--}}
        @include('Mobile.layouts.components.front-scripts')
{{--    @endif--}}


</main>
@include('Mobile.includes.menuBarPhone')
</body>
</html>
