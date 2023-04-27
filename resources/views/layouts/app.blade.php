<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="../../dist-assets/css/themes/lite-purple.css" rel="stylesheet" />
    <link href="../../dist-assets/css/plugins/perfect-scrollbar.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist-assets/css/plugins/fontawesome-5.css" />
    <link href="../../dist-assets/css/plugins/metisMenu.min.css" rel="stylesheet" />
    <!-- Style css -->
    <link href="/public/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>

        <main>
            <body class="text-left">
                <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
                        @if(Request::is(
                            'dashboard-3',
                            'UserControl',
                            'stand',
                            'home',
                            'congregations'
                        ))
                            @include('includes.sidebar')

                    <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
                        @include('includes.header')
                        @endif

                        @yield('content')
                    </div>
                </div>
            </body>
        </main>


    <!--**********************************
       Scripts
   ***********************************-->
    <!-- Required vendors -->
    <script src="../../dist-assets/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="../../dist-assets/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="../../dist-assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../dist-assets/js/scripts/tooltip.script.min.js"></script>
    <script src="../../dist-assets/js/scripts/script.min.js"></script>
    <script src="../../dist-assets/js/scripts/script_2.min.js"></script>
    <script src="../../dist-assets/js/scripts/sidebar.large.script.min.js"></script>
    <script src="../../dist-assets/js/plugins/feather.min.js"></script>
    <script src="../../dist-assets/js/plugins/metisMenu.min.js"></script>
    <script src="../../dist-assets/js/scripts/layout-sidebar-vertical.min.js"></script>
        <script src="../../dist-assets/js/custom/actionbutton.js"></script>
</body>

</html>
