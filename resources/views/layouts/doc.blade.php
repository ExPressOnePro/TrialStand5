<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

{{--@if(Request::is('*menu'))--}}
{{--    @include('Mobile.layouts.components.hub.blade.php-head')--}}
{{--@elseif(Request::is('*home'))--}}
{{--    @include('Mobile.layouts.components.hub.blade.php-head')--}}
{{--@else--}}
@include('BootstrapApp.includes.bootstrap-head')
{{--<link href="{{asset('bootstrapApp/dist/css/cheatsheet.css')}}" rel="stylesheet">--}}
{{--@endif--}}

<body class="bg-body-tertiary">

@include('BootstrapApp.includes.bootstrap-header')

    <main class="container">

    @yield('content')
    @include('BootstrapApp.includes.navBottomBar')

    </main>

    <script src="{{asset('bootstrapApp/js/cheatsheet.js')}}"></script>

</body>
</html>

