@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')
{{--    <div class="container">--}}
{{--        <div class="row align-items-md-stretch">--}}
{{--            @include('BootstrapApp.Modules.home.includes.FAQ')--}}
{{--            @include('BootstrapApp.Modules.home.includes.myRecordsOnStand')--}}

{{--        </div>--}}
{{--        @include('BootstrapApp.Modules.home.includes.modal_all_records_with_stand')--}}
{{--    </div>--}}
    <div id="preloader" class="text-center" style="display: none;">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">...</span>
        </div>
    </div>
    <div id="dynamic-content-container-home">
        <!-- Загрузка содержимого страницы "dynamic.page" при помощи AJAX -->
    </div>

    <script>
        $(document).ready(function () {
            // Загрузка страницы "dynamic.page" при помощи AJAX при загрузке документа
            loadDynamicContent('dynamic.page');
        });

        function loadDynamicContent(routeName) {
            $('#preloader').show();
            $.ajax({
                url: "{{ route('home2') }}",
                type: "GET",
                success: function (data) {
                    $('#preloader').hide();
                    $('#dynamic-content-container-home').html(data);
                },
                error: function (error) {
                    $('#preloader').hide();
                    console.error(error);
                }
            });
        }
    </script>

@endsection
