@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <style>
        .my-custom-class.shadow-sm:hover {
            background-color: #e6f7ff;
            transition: background-color 0.3s ease;
            transform: scale(1.05);
        }

        .my-custom-class.shadow-sm {
            transition: transform 0.3s ease;
        }
        .meeting-schedule-card:hover {
            border-color: #8a2be2;
            transition: border-color 0.01s ease;
        }
        .meeting-schedule-template:hover {
            border-color: #8a2be2;
            transition: border-color 0.01s ease;
        }
        .no-select {
            user-select: none;
        }
        .custom-dropdown-icon {
            outline: none; /* Отключение стандартной обводки */
            border: none; /* Отключение границы */
            background-color: transparent; /* Прозрачный фон */
            cursor: pointer; /* Задание курсора */
        }
    </style>
    <div class="content container-fluid">
        <div class="container">
            <div class="col-lg-10 col-md-12 col-sm-12 mb-5 mx-auto">
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekday')


                <div class="row card meeting-schedule-template mb-4">
                    <div class="px-4 py-5 my-5 text-center text-muted">
                        <h1 class="">нет данных</h1>
                        <div class="col-lg-6 mx-auto">
                            <p class="lead mb-4">расписание для сторожевой башни на выбранную неделю не создано</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
