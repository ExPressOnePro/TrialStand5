<head>
    <meta charset="utf-8">
    <!-- разрешение экрана -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icon -->
    <link rel="icon" href="{{ asset('public/favicon.ico') }}" sizes="any"><!-- 32×32 -->
    <link rel="apple-touch-icon" href="{{ asset('public/apple-touch-icon.png') }}"><!-- 180×180 -->
    <link rel="manifest" href="{{ asset('public/manifest.json') }}"> <!--Manifest -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" />

    <!-- Style css dist-assets -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/themes/lite-purple.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/fontawesome-5.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

</head>
