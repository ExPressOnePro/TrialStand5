<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Desktop.layouts.components.front-head')
{{--@include('Desktop.layouts.components.head')--}}
<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">

{{--    @include('includes.sidebar')--}}
{{--            @include('includes.header')--}}

    <script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
    <script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
{{--    @include('Desktop.includes.header')--}}
    @include('Desktop.includes.aside')
    <main id="content" role="main" class="main">
        @yield('content')
        @include('Desktop.layouts.components.front-scripts')
    </main>
</body>

</html>
