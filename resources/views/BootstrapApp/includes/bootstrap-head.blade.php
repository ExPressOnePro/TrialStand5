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


    <!-- CSS Implementing Plugins -->
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">--}}

    {{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables.net.extensions/fixedColumns.dataTables.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables.net.extensions/dataTables.scroller.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/quill/dist/quill.snow.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">--}}

    <!-- CSS Front Template -->

    {{--    <link rel="stylesheet" href="{{ asset('front/css/themes.css') }}" data-hs-appearance="default" as="style">--}}
    {{--    <link rel="stylesheet" href="{{ asset('front/css/components/theme-home.min.css') }}" data-hs-appearance="default" as="style">--}}


    <link rel="stylesheet" href="{{ asset('front/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('bootstrapApp/dist/css/sidebars.css') }}">--}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

{{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables/media/js/jquery.dataTables.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables/media/js/jquery.dataTables.min.css') }}">--}}

    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
{{--    <link href="https://cdn.datatables.net/v/se/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/r-2.5.0/sb-1.6.0/sp-2.2.0/datatables.min.css" rel="stylesheet">--}}



    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">



    <script src="{{ asset('bootstrapApp/js/color-modes.js')}}"></script>




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Scripts -->
    {{--    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>--}}


    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>


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

</head>
