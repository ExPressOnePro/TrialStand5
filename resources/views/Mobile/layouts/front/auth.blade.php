<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Mobile.layouts.components.hub-head')

<body class="mt-3">

<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>

@include('Mobile.includes.headers.header-auth')
<main id="content" role="main" class="main mb-5">
    @yield('content')
{{--    @include('Mobile.layouts.components.front-scripts')--}}
</main>
</body>
</html>
