<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Mobile.layouts.components.front-head')

<body>

<script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>

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
