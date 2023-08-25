<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Mobile.layouts.components.front-head')

<body class="mt-3">

<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
@if(Request::is('profile*'))
    @include('Mobile.includes.headers.header-profile')
@endif
<main id="content" role="main" class="main mb-7">

    @yield('content')

    @include('Mobile.layouts.components.front-scripts')

</main>
@include('Mobile.includes.menuBarPhone')
</body>
</html>
