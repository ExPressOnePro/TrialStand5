<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Mobile.layouts.components.head-bootsrtap')

<body class="mt-3 mb-3">


{{--<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>--}}
{{--<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>--}}

<main id="content" role="main" class="main mb-7">
    @yield('content')
{{--    @include('Mobile.layouts.components.hub.blade.php-scripts')--}}
</main>
{{--    @include('Mobile.includes.menuBarPhone')--}}
</body>
</html>
