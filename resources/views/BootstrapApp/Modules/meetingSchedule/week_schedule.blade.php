@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper | расписание {{$ms->id}} @endsection
@section('content')
    <style>
        @media print {
            .nav {
                display: none;
            }
        }
    </style>
{{--    <div class="content container-fluid">--}}
    <ul class="nav nav-pills row mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col-2" role="presentation">
            <a class="btn btn-outline-primary col" href="{{route('meetingSchedules.overview', $ms->meetingScheduleTemplate->congregation_id)}}">
                <i class="fa-solid fa-arrow-left fs-3"></i>
                Вернуться
            </a>
        </li>
        <li class="nav-item col-5" role="presentation" >
            <button id="downloadButton" class="col btn btn-danger">
                <i class="fa-solid fa-file-pdf fs-3"></i> Скачать
            </button>
        </li>
        <li class="nav-item col-5" role="presentation" >
            <a class="col btn btn-secondary" href="{{route('meetingSchedules.redaction', $ms->id)}}">
                <i class="fa-solid fa-pencil fs-3"></i> Редактировать
            </a>
        </li>
    </ul>
        <div class=" py-5">
            <div class="col-lg-10 col-md-12 col-sm-12 mb-5 mx-auto">
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekday')
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekend')
            </div>
        </div>
{{--    </div>--}}
    <script>
        // При загрузке страницы
        $(document).ready(function () {
            // При клике на кнопку
            $('#downloadButton').on('click', function () {
                // Скачать страницу
                downloadPage();

                // Открыть для печати
                printPage();
            });
        });

        function downloadPage() {
            // Ваш код для скачивания страницы
            // Например, можно использовать библиотеку jsPDF для создания PDF
        }

        function printPage() {
            // Открывает страницу для печати
            window.print();
        }
    </script>


@endsection
