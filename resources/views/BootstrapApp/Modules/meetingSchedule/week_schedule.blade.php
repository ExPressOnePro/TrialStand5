@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper | расписание {{$ms->id}} @endsection
@section('content')
    <style>
        @media print {
            .nav-control {
                display: none;
            }
        }
    </style>
    @if(!empty($data))
    <ul class="nav nav-control nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col mb-2" role="presentation">
            <a class="btn btn-outline-primary col" href="{{route('meetingSchedules.overview', $ms->meetingScheduleTemplate->congregation_id)}}">
                <i class="fa-solid fa-arrow-left fs-3"></i>
                Вернуться
            </a>
        </li>
        <li class="nav-item col mb-2" role="presentation" >
            <button id="downloadButton" class="col btn btn-primary">
                <i class="fa-solid fa-file-pdf fs-3"></i> Скачать
            </button>
        </li>
        <li class="nav-item col mb-2" role="presentation" >
            <a class="col btn btn-secondary" href="{{route('meetingSchedules.redaction', $ms->id)}}">
                <i class="fa-solid fa-pencil fs-3"></i> Редактировать
            </a>
        </li>

        <li class="nav-item col mb-2" role="presentation">
            <form method="post" action="{{ route('meetingSchedules.publish', $ms->id) }}">
                @csrf
                <button type="submit" class="col btn btn-success">
                    <i class="fa-solid fa-bullhorn fs-3"></i> {{ $ms->published ? 'Снять с публикации' : 'Опубликовать' }}
                </button>
            </form>
        </li>

        <li class="nav-item col mb-2" role="presentation">
            <form method="post" action="{{ route('meetingSchedules.delete', $ms->id) }}">
                @csrf
                <button type="submit" class="col btn btn-danger">
                    <i class="fa-solid fa-trash-can fs-3"></i> {{ $ms->deleted ? 'Восстановить' : 'Удалить' }}
                </button>
            </form>
        </li>
    </ul>
        <div>
            <div class="col-lg-10 col-md-12 col-sm-12 mb-5 mx-auto">
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekday')
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekend')
            </div>
        </div>

    <script>
        $(document).ready(function () {
            $('#downloadButton').on('click', function () {
                window.print();
            });
        });
    </script>
    @else
        нет данных
    @endif

@endsection
