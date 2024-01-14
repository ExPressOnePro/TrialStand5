<head>
    <meta charset="utf-8">
    <!-- разрешение экрана -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icon -->
    {{--    <link rel="icon" href="{{ asset('public/favicon.ico') }}" sizes="any"><!-- 32×32 -->--}}
    {{--    <link rel="apple-touch-icon" href="{{ asset('public/apple-touch-icon.png') }}"><!-- 180×180 -->--}}
    {{--    <link rel="manifest" href="{{ asset('public/manifest.json') }}"> <!--Manifest -->--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('front/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrapApp/js/color-modes.js')}}"></script>



    <!-- PWA  -->
    <meta name="theme-color" content="#8ca3b4"/>
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

{{--    @vite('resources/js/app.js')--}}

</head>
