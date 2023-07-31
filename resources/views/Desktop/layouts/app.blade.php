<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('Desktop.layouts.components.head')
<body>
<main>
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            @include('includes.sidebar')
            @include('includes.header')
            @yield('content')
        </div>
    </div>
</main>
    <!-- scripts -->
    @include('Desktop.layouts.components.scripts')
</body>

</html>
