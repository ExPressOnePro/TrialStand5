<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('Desktop.layouts.components.head')
<main>
    <body class="text-left" style="overflow: hidden">
        <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
            @yield('content')
        </div>
    </body>
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
</main>
</html>
