@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <style>
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
    </style>

    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="px-4 py-3 rounded-2 bg-body-secondary text-end mb-3">
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
                                            <form method="post" id="createWeek-{{ $meeting_schedule_template->id }}" action="{{ route('meetingSchedules.create', $congregation->id) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="weekPicker" class="form-label">Выберите неделю:</label>
                                                    <input type="week" id="weekPicker" class="form-control" name="weekPicker" required>
                                                    <input type="hidden" id="ms_template_id" class="form-control" name="ms_template_id" value="{{ $meeting_schedule_template->id }}" required>
                                                </div>

                                                <div class="row mt-5">
                                                    <button type="submit" class="btn btn-primary" >Создать</button>
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
                    <div class="row align-items-center mb-5">
                        <div class="col">
                            <h3 class="mb-0">Расписания встреч собрания</h3>
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                            <!-- Nav -->
                            <ul class="nav nav-pills" id="profileTeamsTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="false" title="Column view" tabindex="-1">
                                        <i class="bi-grid"></i>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="list-tab" data-bs-toggle="pill" href="#list" role="tab" aria-controls="list" aria-selected="true" title="List view">
                                        <i class="bi-view-list"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="tab-content" id="profileTeamsTabContent">
                        <div class="tab-pane fade active show" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                                @foreach($weeklySchedule as $week => $weekData)
                                <div class="col mb-3 mb-lg-5">
                                    <div class="card rounded-4 h-100">
                                        <div class="card-header rounded-top-4">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-9">
                                                    <h4>{{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}
                                                    </h4>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">
                                                            <a class="dropdown-item" href="#">Опубликовать</a>
                                                            <a class="dropdown-item" href="#">Редактировать</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Удалить</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="card rounded-0 rounded-bottom-4 meeting-schedule-template pb-0 text-decoration-none" href="{{ route('meetingSchedules.schedule', $weekData['id']) }}">
                                            <div class="d-flex border-hover border-bottom gap-3 p-2 align-items-center justify-content-between py-3">
                                                <img class="bd-placeholder-img  ms-3" height="50" src="{{ asset('images/workbook.svg') }}">
                                                <div class="col">
                                                    <h4 class="text-muted">Жизнь и служение</h4>
                                                    <h6 class="mb-0 text-muted">{{$weekData['weekday']}}</h6>
                                                </div>
                                            </div>
                                            <div class="d-flex border-hover gap-3 p-2 align-items-center justify-content-between py-3">
                                                <img class="bd-placeholder-img ms-3" height="50" src="{{ asset('images/watchtower.svg') }}">
                                                <div class="col">
                                                    <h4 class="text-muted">Сторожевая башня</h4>
                                                    <h6 class="mb-0 text-muted">{{$weekData['weekend']}}</h6>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="card-footer pt-0">
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-body-secondary">Тип недели</small>
                                                    @if($weekData['template_name'] == 'Посещение районного старейшины')
                                                        <small class="text-danger fw-bold">{{$weekData['template_name']}}</small>
                                                    @else
                                                        <small class="text-body-secondary">{{$weekData['template_name']}}</small>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-body-secondary">Последнее обновление </small>
                                                    <small class="text-body-secondary">{{$weekData['updated']}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <div class="row justify-content-between align-items-center flex-grow-1 mb-3">
                                        <!-- End Header -->
                                        <div class="col-md">
                                            <form>
                                                <!-- Search -->
                                                <div class="input-group input-group-merge ">
                                                    <div class="input-group-prepend input-group-text">
                                                        <i class="bi-search"></i>
                                                    </div>
                                                    <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">
                                                </div>
                                                <!-- End Search -->
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                    <div class="table-responsive datatable-custompy-3">
                                        <table id="schedules" class="table table-thead-bordered card-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Неделя</th>
                                                <th>Время встреч</th>
                                                <th>Тип недели</th>
                                                <th>Последнее обновление</th>
                                                <th>Опции</th>
                                            </tr>
                                            </thead>
                                            <tbody class="align-items-center text-center">
                                            @foreach($weeklySchedule as $week => $weekData)
                                                <tr>
                                                    <td>
                                                        <h6>{{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}</h6>
                                                    </td>
                                                    <td>
                                                        <a class="meeting-schedule-template text-decoration-none" href="{{ route('meetingSchedules.schedule', $weekData['id']) }}">
                                                            <div class="d-flex align-items-center justify-content-between border-bottom">
                                                                <div class="col">
                                                                    <h6 class="mb-0 text-muted">Жизнь и служение</h6>
                                                                </div>
                                                                <div class="col">
                                                                    <span class="mb-0 text-muted">{{ $weekData['weekday'] }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="col">
                                                                    <h6 class="mb-0 text-muted">Сторожевая башня</h6>
                                                                </div>
                                                                <div class="col">
                                                                    <span class="mb-0 text-muted">{{ $weekData['weekend'] }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($weekData['template_name'] == 'Посещение районного старейшины')
                                                            <span class="text-danger fw-bold">{{ $weekData['template_name'] }}</span>
                                                        @else
                                                            <span>{{ $weekData['template_name'] }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $weekData['updated'] }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown{{ $week }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi-three-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown{{ $week }}">
                                                                <a class="dropdown-item" href="#">Опубликовать</a>
                                                                <a class="dropdown-item" href="#">Редактировать</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="#">Удалить</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="row text-start">--}}
{{--                        @foreach($weeklySchedule as $week => $weekData)--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="card mb-3">--}}
{{--                                    <div class="card-header">--}}
{{--                                        <div class="d-flex justify-content-between align-items-center py-1">--}}
{{--                                            <div class="col">--}}
{{--                                                <h4>{{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-auto">--}}
{{--                                                <a class="btn btn-outline-secondary" >--}}
{{--                                                    <i class="bi bi-pencil"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a class="card rounded-bottom rounded-0 meeting-schedule-template text-decoration-none" href="{{ route('meetingSchedules.schedule', $weekData['id']) }}">--}}
{{--                                        <div class="card-body bg">--}}
{{--                                            <div class="d-flex border-hover border-bottom gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                <img class="bd-placeholder-img  ms-3" height="50" src="{{ asset('images/workbook.svg') }}">--}}
{{--                                                <div class="col">--}}
{{--                                                    <h4 class="text-muted">Жизнь и служение</h4>--}}
{{--                                                    <h6 class="mb-0 text-muted">{{$weekData['weekday']}}</h6>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="d-flex border-hover gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                <img class="bd-placeholder-img ms-3" height="50" src="{{ asset('images/watchtower.svg') }}">--}}
{{--                                                <div class="col">--}}
{{--                                                    <h4 class="text-muted">Сторожевая башня</h4>--}}
{{--                                                    <h6 class="mb-0 text-muted">{{$weekData['weekend']}}</h6>--}}
{{--                                                    <p></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <small class="text-body-secondary">Тип недели</small>--}}
{{--                                                @if($weekData['template_name'] == 'Посещение районного старейшины')--}}
{{--                                                 <small class="text-danger fw-bold">{{$weekData['template_name']}}</small>--}}
{{--                                                @else--}}
{{--                                                    <small class="text-body-secondary">{{$weekData['template_name']}}</small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <small class="text-body-secondary">Последнее обновление </small>--}}
{{--                                                <small class="text-body-secondary">{{$weekData['updated']}}</small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <a class="card no-select mb-3 text-decoration-none meeting-schedule-card" >--}}
{{--                                    <div class="card-header h4 text-center">--}}
{{--                                        {{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}--}}
{{--                                    </div>--}}
{{--                                        <div class="card mb-3">--}}
{{--                                            <div class="card-body shadow link-body-emphasis text-decoration-none">--}}
{{--                                                <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                    <img class="bd-placeholder-img" height="96" src="{{ asset('images/workbook.svg') }}">--}}
{{--                                                    <div class="col">--}}
{{--                                                        <h4 class="text-muted">Жизнь и служение</h4>--}}
{{--                                                        <h5 class="mb-0">{{$weekData['weekday']}}, {{$weekData['weekday_time']}}</h5>--}}
{{--                                                        <p></p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}




{{--                                        <div class="card">--}}
{{--                                            <div class="card-body shadow link-body-emphasis text-decoration-none">--}}
{{--                                                <div class="d-flex border-hover no-select gap-3 p-2 align-items-center justify-content-between py-3">--}}
{{--                                                    <img class="bd-placeholder-img" height="96" src="{{ asset('images/watchtower.svg') }}">--}}
{{--                                                    <div class="col-8">--}}
{{--                                                        <h4 class="text-muted">Сторожевая башня</h4>--}}
{{--                                                        <h5 class="mb-0">{{$weekData['weekend']}}, {{$weekData['weekend_time']}}</h5>--}}
{{--                                                        <p></p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    @else--}}
{{--                        <div class="py-3 shadow-sm text-center">--}}
{{--                            <p class="lead text-body-emphasis">Ничего не найдено.</p>--}}
{{--                            <p class="small">Чтобы начать, выберите один из шаблонов выше</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}

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
    <script>

        $(document).ready(function() {
            $('#schedules').DataTable( {
                dom: 'Blt',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                paging: false, // Disable paging
                searching: true
            } );
            // Ваш поиск DataTables
            $('#datatableWithSearchInput').on('keyup', function () {
                $('#schedules').DataTable().search($(this).val()).draw();
            });
        } );

    </script>

    <script>
        function createWeek(templateId) {
            const formElement = document.getElementById(`createWeek-${templateId}`);
            var formData = new FormData(formElement);

            formData.append('_token', '{{ csrf_token() }}');
            formData.append('ms_template_id', templateId);

            $.ajax({
                url: '{{ route('meetingSchedules.create', $congregation->id) }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.error) {
                        console.log('Server error:', response.error);
                    } else {
                        console.log('Success:', true);

                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;

                    $(".form-error").remove();

                    for(error in errors) {
                        var input = $('input[name=' + error + ']');
                        input.parent('.form-control').after('<span class="form-error text-danger">' + errors[error][0] + '</span>');
                    }
                }
            });
        }
    </script>

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
