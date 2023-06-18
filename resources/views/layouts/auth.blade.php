<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <script>
        const swJsFiles = "/js/sw.js";
        const installAppIcons = {
            "192x192": "{{ asset('/images/icons/icon-192x192.png') }}",
            "512x512": "{{ asset('/images/icons/icon-512x512.png') }}"
        };
    </script>

</head>
<main>
    <body class="text-left" style="overflow: hidden">
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="app-admin-wrap">
            <div class="main-content-wrap">
                <div id="install-app" style="display: none;"></div>
                @include('register-sw')
                @if(Request::is(
                        '/',
                        'login',
                        'registration'
                        ))
                    @yield('content')
                @endif
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
