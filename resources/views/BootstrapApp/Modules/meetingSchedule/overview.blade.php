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
        <div class="row">
            {{--        <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">--}}
            {{--            <div class="list-group list-group-flush rounded-2">--}}
            {{--                <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Обзор</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="{{ route('congregation.publishers', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Возвещатели</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="{{ route('congregation.stands', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Стенд (ы)</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="{{ route('meetingSchedules.overview', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Расписание встреч</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="{{ route('congregation.modules', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Модули</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--                <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">--}}
            {{--                    <div class="d-flex w-100 align-items-center justify-content-between">--}}
            {{--                        <strong class="mb-1">Настройки</strong>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--        </aside>--}}
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="px-4 py-3 rounded-2 bg-body-secondary text-end">
                    <p class="lead mb-4">Шаблоны для расписания встреч собрания</p>
                    <div class="row g-1 text-start">
                        @foreach($meeting_schedule_templates as $meeting_schedule_template)
                            <div class="col-md-3 col-6">
                                <a class="card text-decoration-none d-flex h-100 meeting-schedule-template no-select" data-bs-toggle="modal" data-bs-target="#msModal-{{ $meeting_schedule_template->id }}">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $meeting_schedule_template->template_name }}</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="modal fade" id="msModal-{{ $meeting_schedule_template->id }}" tabindex="-1" aria-labelledby="msModal-{{ $meeting_schedule_template->id }}" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $meeting_schedule_template->template_name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('meetingSchedules.create',[$congregation->id, 'ms_template_id' => $meeting_schedule_template->id]) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="dateInput" class="form-label">Дата:</label>
                                                    <input type="date" class="form-control" id="dateInput" name="dateInput" required>
                                                </div>
                                                <div class="row mt-5">
                                                    <button type="submit" class="btn btn-primary ">Создать</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <h3>Расписания встреч собрания</h3>

                    <div class="row text-start">
                        @foreach($weeklySchedule as $week => $weekData)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                @php
                                    $routeParams = [];
                                    if (isset($weekData['weekday_schedule']['id'])) {
                                        $routeParams['weekday_id'] = $weekData['weekday_schedule']['id'];
                                    } else {
                                        $routeParams['weekday_id'] = 0;
                                    }
                                    if (isset($weekData['weekend_schedule']['id'])) {
                                        $routeParams['weekend_id'] = $weekData['weekend_schedule']['id'];
                                    } else {
                                        $routeParams['weekend_id'] = 0;
                                    }
                                @endphp
                                <a class="card no-select mb-3 text-decoration-none meeting-schedule-card" href="{{ route('meetingSchedules.schedule', $routeParams) }}">
                                    <div class="card-header h4 text-center">
                                        {{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}
                                    </div>
                                    @if(isset($weekData['weekday_schedule']))
                                        <div class="card mb-3">
                                            <div class="card-body shadow link-body-emphasis text-decoration-none">
                                                <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">
                                                    <img class="bd-placeholder-img" height="96" src="{{ asset('images/workbook.svg') }}">
                                                    <div class="col-8">
                                                        <h4 class="text-muted">{{ $weekData['weekday_schedule']['template_name'] }}</h4>
                                                        <h5 class="mb-0">{{ $weekData['weekday_schedule']['date'] }}</h5>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="py-3 shadow text-center mb-3" style="background: #fff4d7">
                                                <h4 class="fw-bold text-body-emphasis">нет расписания</h4>
                                                <small class="lead mb-4">Жизнь и служение не добавлено для этой недели</small>
                                        </div>
                                    @endif

                                    @if(isset($weekData['weekend_schedule']))
                                        <div class="card">
                                            <div class="card-body shadow link-body-emphasis text-decoration-none">
                                                <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">
                                                    <img class="bd-placeholder-img" height="96" src="{{ asset('images/watchtower.svg') }}">
                                                    <div class="col-8">
                                                        <h4 class="text-muted">{{ $weekData['weekend_schedule']['template_name'] }}</h4>
                                                        <h5 class="mb-0">{{ $weekData['weekend_schedule']['date'] }}</h5>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="py-3 shadow-sm text-center" style="background: #fff4d7">
                                                <h4 class="fw-bold text-body-emphasis">нет расписания</h4>
                                                <small class="lead mb-4">Сторожевая башня не добавлена для этой недели</small>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>

                                        {{--                    <div class="row text-start">--}}
{{--                        @if(!$meetingSchedules->isEmpty())--}}
{{--                            <div class="col-4">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <div class="card-header h3 text-center">15-21 Января</div>--}}
{{--                                    <div class="card no-select mb-3">--}}
{{--                                        <a class="card-body shadow link-body-emphasis text-decoration-none">--}}
{{--                                            <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                <img class="bd-placeholder-img" height="96" src="{{ asset('images/workbook.svg') }}">--}}
{{--                                                <div class="col-8">--}}
{{--                                                    <h4 class="text-muted">Жизнь и служение</h4>--}}
{{--                                                    <h5 class="mb-0">январь 18, 2023</h5>--}}
{{--                                                    <p></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                    <div class="d-flex border-hover no-select gap-3 p-2 align-items-center py-3">--}}
{{--                                        <div class="py-3 shadow-sm text-center">--}}
{{--                                            <h4 class="fw-bold text-body-emphasis">нет расписания</h4>--}}
{{--                                            <p class="lead mb-4">Расписания сторожевой башни не добавлено для этой недели</p>--}}
{{--                                        </div>--}}




{{--                                        --}}{{--                                            <img class="bd-placeholder-img" height="96" src="{{ asset('images/watchtower.svg') }}">--}}
{{--                                        --}}{{--                                            <div class="col-8">--}}
{{--                                        --}}{{--                                                <h4 class="text-muted">Сторожевая башня</h4>--}}
{{--                                        --}}{{--                                                <h5 class="mb-0">январь 18, 2023</h5>--}}
{{--                                        --}}{{--                                                <p></p>--}}
{{--                                        --}}{{--                                            </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-4">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <div class="card-header h3 text-center">15-21 Января</div>--}}
{{--                                    <div class="card no-select mb-3">--}}
{{--                                        <a class="card-body shadow link-body-emphasis text-decoration-none">--}}
{{--                                            <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                <img class="bd-placeholder-img" height="96" src="{{ asset('images/workbook.svg') }}">--}}
{{--                                                <div class="col-8">--}}
{{--                                                    <h4 class="text-muted">Жизнь и служение</h4>--}}
{{--                                                    <h5 class="mb-0">январь 18, 2023</h5>--}}
{{--                                                    <p></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex border-hover no-select gap-3 p-2 align-items-center py-3">--}}
{{--                                        <div class="py-3 shadow-sm text-center">--}}
{{--                                            <h4 class="fw-bold text-body-emphasis">нет расписания</h4>--}}
{{--                                            <p class="lead mb-4">Расписания сторожевой башни не добавлено для этой недели</p>--}}
{{--                                        </div>--}}




{{--                                        --}}{{--                                            <img class="bd-placeholder-img" height="96" src="{{ asset('images/watchtower.svg') }}">--}}
{{--                                        --}}{{--                                            <div class="col-8">--}}
{{--                                        --}}{{--                                                <h4 class="text-muted">Сторожевая башня</h4>--}}
{{--                                        --}}{{--                                                <h5 class="mb-0">январь 18, 2023</h5>--}}
{{--                                        --}}{{--                                                <p></p>--}}
{{--                                        --}}{{--                                            </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}{{--                    <div class="row row-cols-1 row-cols-md-3 g-4 text-start mb-5">--}}
{{--                            --}}{{--                        @foreach($meetingSchedules as $meetingSchedule)--}}
{{--                            --}}{{--                            <div class="col">--}}
{{--                            --}}{{--                                <div class="card meeting-schedule-card no-select">--}}
{{--                            --}}{{--                                        <a class="card-body rounded-2 shadow link-body-emphasis text-decoration-none" href="{{ route('meetingSchedules.schedule', $meetingSchedule->id) }}">--}}
{{--                            --}}{{--                                        <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                            --}}{{--                                            @if (date('N', strtotime($meetingSchedule->date)) < 6)--}}
{{--                            --}}{{--                                                <img class="bd-placeholder-img" height="96" src="{{ asset('images/workbook.svg') }}">--}}
{{--                            --}}{{--                                                <div class="col-8">--}}
{{--                            --}}{{--                                                    <h4 class="text-muted">{{$meetingSchedule->meetingScheduleTemplate->template_name}}</h4>--}}
{{--                            --}}{{--                                                    <h5 class="mb-0">{{ \Carbon\Carbon::parse($meetingSchedule->date)->isoFormat('MMMM D, YYYY') }}</h5>--}}
{{--                            --}}{{--                                                    <p>{{ __('text.' . $weekday) }}  {{ $weekdayTime }}</p>--}}
{{--                            --}}{{--                                                </div>--}}
{{--                            --}}{{--                                            @else--}}
{{--                            --}}{{--                                                <img class="bd-placeholder-img" height="96" src="{{ asset('images/watchtower.svg') }}">--}}
{{--                            --}}{{--                                                <div class="col-8">--}}
{{--                            --}}{{--                                                    <h4 class="text-muted">{{$meetingSchedule->meetingScheduleTemplate->template_name}}</h4>--}}
{{--                            --}}{{--                                                    <h5 class="mb-0">{{ \Carbon\Carbon::parse($meetingSchedule->date)->isoFormat('MMMM D, YYYY') }}</h5>--}}
{{--                            --}}{{--                                                    <p>{{ __('text.' . $weekend) }}  {{ $weekendTime }}</p>--}}
{{--                            --}}{{--                                                </div>--}}
{{--                            --}}{{--                                            @endif--}}
{{--                            --}}{{--                                        </div>--}}
{{--                            --}}{{--                                    </a>--}}
{{--                            --}}{{--                                    <div class="card-footer">--}}
{{--                            --}}{{--                                        <div class="d-flex justify-content-between align-items-center">--}}
{{--                            --}}{{--                                            <small class="text-body-secondary">Создан: {{ \Carbon\Carbon::parse($meetingSchedule->updated_at)->isoFormat('MMMM D, YYYY') }}</small>--}}
{{--                            --}}{{--                                            <div class="dropdown">--}}
{{--                            --}}{{--                                                <i class="bi bi-three-dots-vertical dropdown custom-dropdown-icon btn btn-outline-secondary rounded-5" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>--}}
{{--                            --}}{{--                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                            --}}{{--                                                    <a class="dropdown-item" href="#">Редактировать</a>--}}
{{--                            --}}{{--                                                    <a class="dropdown-item" href="#">Удалить</a>--}}
{{--                            --}}{{--                                                </div>--}}
{{--                            --}}{{--                                            </div>--}}
{{--                            --}}{{--                                        </div>--}}
{{--                            --}}{{--                                    </div>--}}
{{--                            --}}{{--                                </div>--}}
{{--                            --}}{{--                            </div>--}}
{{--                            --}}{{--                        @endforeach--}}
{{--                            --}}{{--                    </div>--}}
{{--                        @else--}}
{{--                            <div class="py-3 shadow-sm text-center">--}}
{{--                                <h4 class="fw-bold text-body-emphasis">Форм нет</h4>--}}
{{--                                <p class="lead mb-4">Чтобы начать, выберите пустую форму или один из шаблонов выше</p>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>




{{--            <div class="row mb-2">--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="row my-custom-class g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                        <div class="col p-4 d-flex flex-column position-static">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3>{{ __('text.' . $weekday) }}</h3>--}}
{{--                                <h3>{{$dateForGivenWeekday}}</h3>--}}
{{--                            </div>--}}
{{--                            <div class="list-group-item">--}}
{{--                                <div class="row align-items-center border-bottom">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5>Время встречи:</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <h5 class="bg-soft-primary p-2">{{$weekdayTime}}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5>Неделя</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <h5 class="bg-soft-primary p-2">--}}
{{--                                            {{ \Carbon\Carbon::parse($resp->start_of_week)->format('d') }} ---}}
{{--                                            {{ \Carbon\Carbon::parse($resp->end_of_week)->format('d.m.Y') }}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @foreach($resp as $rees)--}}
{{--                <div class="col-md-4">--}}
{{--                    <a class="card meeting-card shadow text-decoration-none" href="{{route('meetingSchedules.overview', $congregation->id)}}">--}}
{{--                        <div class="card-body meeting-card-body">--}}
{{--                            <div class="meeting-day">{{ __('text.' . $weekday) }}  {{$weekdayTime}}</div>--}}
{{--                            <div class="meeting-date">{{$formattedDate}}</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                @endforeach--}}

@endsection
