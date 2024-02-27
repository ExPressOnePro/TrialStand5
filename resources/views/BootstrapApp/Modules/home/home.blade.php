@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')

    <div id="preloader" class="text-center" style="display: none;">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">...</span>
        </div>
    </div>

    <div id="dynamic-content"></div>

    <script>
        $(document).ready(function() {
            var homeContent = localStorage.getItem('homeContent');
            loadHomeContent(homeContent);

            if (homeContent) {
                loadHomeContent(homeContent);
            } else {
                loadHomeContent('main');
            }
        });
    </script>


@endsection
