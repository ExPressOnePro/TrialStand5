<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('Mobile.layouts.components.head')
<body>
<main>
    <body class="text-left">
{{--    --}}{{--@inject('mobile_detect', 'Mobile_Detect')--}}
{{--    @if ($mobile_detect->isMobile())--}}
{{--        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">--}}
{{--            @include('includes.header')--}}
{{--            <div class="main-content-wrap mobile-menu-content bg-off-white m-0">--}}
{{--                @if(Request::is(--}}
{{--                    'profile*',--}}
{{--                    'UserControl*',--}}
{{--                    'stand*',--}}
{{--                    'users*',--}}
{{--                    'stand*',--}}
{{--                    'home*',--}}
{{--                    'congregation*',--}}
{{--                    'guest*',--}}
{{--                    'RolesPermissions*',--}}
{{--                    'DevTools*'--}}
{{--                    ))--}}
{{--                    @yield('content')--}}
{{--                    @include('includes.menuBarPhone')--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @if(Request::is(
                'profile*',
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
                'RolesPermissions*',
                'DevTools*'
                ))
                <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
                    @include('includes.sidebar')
                    @include('includes.header')
                    @endif
                    @yield('content')

                </div>
        </div>
    {{--@endif--}}
    </body>
{{--    @include('includes.footer')--}}
</main>
    <!--Scripts-->


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
    <script src="../../dist-../../dist-assets/js/scripts/tooltip.script.min.js"></script>
    <script src="../../dist-assets/js/custom/nav.js"></script>
    <script src="../../dist-assets/js/plugins/datatables.min.js"></script>
    <script src="../../dist-assets/js/scripts/datatables.script.min.js"></script>
    <script src="../../dist-assets/js/scripts/smart.wizard.script.min.js"></script>
<script src="../../dist-assets/js/plugins/jquery.smartWizard.min.js"></script>
</body>

</html>
