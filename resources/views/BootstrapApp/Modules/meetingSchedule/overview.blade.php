@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')
    <style>
        .meeting-schedule-template:hover {
            border-color: #8a2be2;
            transition: border-color 0.01s ease;
        }
        .no-select {
            user-select: none;
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* полупрозрачный черный цвет */
            z-index: 9999; /* выше всех остальных элементов */
        }

        #form-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            z-index: 10000; /* поверх оверлея */
            width: 80%;
            max-width: 600px;
        }
    </style>



    <div class="content container-fluid">
        @include('BootstrapApp.includes.alerts')
        <div id="preloader" class="text-center" style="display: none;">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">...</span>
            </div>
        </div>
        <div id="dynamic-content-over-schedule"></div>
    </div>
    <script>
        $(document).ready(function () {
            // Загрузка страницы "dynamic.page" при помощи AJAX при загрузке документа
            loadDynamicContent('dynamic.page');
        });

        function loadDynamicContent(routeName) {
            $('#preloader').show();
            $.ajax({
                url: "{{ route('meetingSchedules.overviewAj', $congregation->id) }}",
                type: "GET",
                success: function (data) {
                    $('#preloader').hide();
                    $('#dynamic-content-over-schedule').html(data);
                },
                error: function (error) {
                    $('#preloader').hide();
                    console.error(error);
                }
            });
        }
    </script>

@endsection
