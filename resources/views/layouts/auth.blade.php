<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('public/favicon.ico') }}" sizes="any"><!-- 32×32 -->
    <link rel="apple-touch-icon" href="{{ asset('public/apple-touch-icon.png') }}"><!-- 180×180 -->
    <link rel="manifest" href="{{ asset('public/manifest.webmanifest') }}"> <!--Manifest -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />--}}
    <link href="../../dist-assets/css/themes/lite-purple.css" rel="stylesheet" />

    <!-- Style css -->
    <link href="../public/css/app.css" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>

</head>
<main>
    <body class="text-left" style="overflow: hidden">
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="app-admin-wrap">
            <div class="main-content-wrap">
                @if(Request::is(
                        '/',
                        'login',
                        'registration'
                        ))
                    @yield('content')
                @endif
                    @include('includes.footer')
            </div>
        </div>
    @elseif ($mobile_detect->isTablet())
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @yield('content')
        </div>
    @else
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @yield('content')
        </div>
    @endif
    </body>
</main>
</html>
