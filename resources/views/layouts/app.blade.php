<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="../../dist-assets/css/themes/lite-purple.css" rel="stylesheet" />
    <link href="../../dist-assets/css/plugins/perfect-scrollbar.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist-assets/css/plugins/fontawesome-5.css" />
    <link href="../../dist-assets/css/plugins/metisMenu.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist-assets/css/plugins/sweetalert2.min.css" />
    <link rel="stylesheet" href="../../dist-assets/css/plugins/toastr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Style css -->
    {{--<link href="../public/css/style.css" rel="stylesheet">--}}
    <link href="../public/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>
    {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>
<main>
    <body class="text-left">
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
                @if(Request::is(
                    'dashboard-2',
                    'UserControl',
                    'UserControl/*',
                    'stand',
                    'users',
                    'stand/*',
                    'home',
                    'congregation',
                    'guest',
                    'roles',
                    'roles/*'
                    ))
                    @include('includes.header')
                    @include('includes.menuBarPhone')
                @endif
                    @yield('content')
                    @include('includes.footer')
            </div>
        </div>
    @elseif ($mobile_detect->isTablet())
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @if(Request::is(
                'dashboard-2',
                'UserControl',
                'UserControl/*',
                'stand',
                'stand/*',
                'home',
                'congregations',
                'guest'
                ))
                <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
                    @endif
                    @yield('content')
                </div>
                @include('includes.menuBarPhone')
                @include('includes.footer')
        </div>
    @else
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @if(Request::is(
                'profile',
                'users',
                'users/*',
                'dashboard-2',
                'UserControl',
                'UserControl/*',
                'stand',
                'stand/*',
                'home',
                'congregation',
                'congregation/*',
                'guest',
                'roles',
                'roles/*'
                ))
                <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
                    @include('includes.sidebar')
                    @include('includes.header')
                    @endif
                    @yield('content')
                    @include('includes.footer')
                </div>
        </div>
    @endif
    </body>
</main>
    <!--Scripts-->
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>--}}
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
    <script src="../../dist-assets/js/plugins/datatables.min.js"></script>
    <script src="../../dist-assets/js/scripts/contact-list-table.min.js"></script>
    <script src="../../dist-assets/js/scripts/datatables.script.min.js"></script>
    <script src="../../dist-assets/js/plugins/sweetalert2.min.js"></script>
    <script src="../../dist-assets/js/scripts/sweetalert.script.min.js"></script>
    <script src="../../dist-assets/js/plugins/toastr.min.js"></script>
    <script src="../../dist-../../dist-assets/js/plugins/datatables.min.js"></script>
    <script src="../../dist-../../dist-assets/js/scripts/tooltip.script.min.js"></script>


</body>

</html>
