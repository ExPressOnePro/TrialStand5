<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Desktop.layouts.components.front-head')
{{--@include('Desktop.layouts.components.head')--}}

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">

{{--    @include('includes.sidebar')--}}
{{--            @include('includes.header')--}}
    @yield('content')

    <!-- scripts -->
    @include('Desktop.layouts.components.front-scripts')

</body>
</html>
