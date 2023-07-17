@extends('layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        @can('User. Stand. Open table')
            <div>
                {{--<div class="main-content pt-4">--}}
                <h1 class="heading text-center font-weight-bold">{{ $stand->name }}</h1>

                @if (session('error'))
                    <div class="alert alert-card alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-card alert-success">
                        {{ session('error') }}
                    </div>
            @endif

            <!-- текущая следующая неделя кнопки -->
                <div class="row mt-3">
                    <div class="col text-left ml-0">
                        <a href="{{ route('currentWeekTable', $stand->id) }}">
                            <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
                        </a>
                    </div>
                    <div class="col text-right ml-0">
                        <a href="{{ route('nextWeekTable', $stand->id) }}">
                            <button class="btn btn-info btn-block text-center">Следующая неделя</button>
                        </a>
                    </div>
                </div>

                <div class="separator-breadcrumb border-top"></div>
                <!-- Таблица следующей недели -->
                @if(date('N') . '-'. date('H:i') >= $StandTemplate->activation)
                <div class="row">
                    @foreach ($week_schedule as $day => $times)
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-header d-flex align-items-center" style="background: #ebdd9b">
                                    <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                    <h5 class="text-18 font-weight-600 card-title m-0">
                                        {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                        {{ $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($day) }}
                                    </h5>
                                    <h5 class="text-18 font-weight-700 card-title m-8">
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-sm'>
                                            <thead class="align-items-center text-center">
                                            <tr>
                                                <th class='not-sortable'>Время</th>
                                                <th>Возвещатель</th>
                                                <th >Возвещатель</th>
                                                @if(auth()->user()->can('User. can be recorded on stand'))
                                                    <th>Изменения</th>
                                                @endif
                                                <th class='sortable'>Отчет</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($times as $time)
                                                @php
                                                    $standPublisher = App\Models\StandPublishers::where('day', $day)
                                                        ->where('time', $time)
                                                        ->where('date', $gwe)
                                                        ->where('stand_template_id', $StandTemplate->id)
                                                        ->first();
                                                @endphp
                                                <tr class="text-nowrap align-items-center text-center">

                                                    <th class="value1">
                                                        <div class="align-items-center text-center">
                                                            <span class="text-center">{{$time}}</span>
                                                        </div>
                                                    </th>

                                                    <th class="value2">
                                                        @empty($standPublisher){{--если не создана запись--}}
                                                        @if(auth()->user()->can('User. Stand. Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#NewRecordStand1{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" data-id="new">
                                                                    Записаться
                                                                </button>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else
                                                            @empty(($standPublisher->user)){{--если создана но нет 1 пользователя запись--}}
                                                            @if(auth()->user()->can('User. Stand. Entry in table'))
                                                                @empty($standPublisher->user)
                                                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#record1{{$standPublisher->id }}" data-id="new">
                                                                        Записаться
                                                                    </button>
                                                                    <div class="modal fade" id="record1{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    <form id="recordStandFirst{{$standPublisher->id }}" method="post" action="{{ route('AddPublisherToStand1', $standPublisher->id) }}">
                                                                                        @csrf
                                                                                        <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                                            Дата {{$standPublisher->date }} <br> Время {{$standPublisher->time }}
                                                                                        </p>
                                                                                        <small class="text-muted"></small>
                                                                                        <div class="row mb-5">
                                                                                            <div class="col-md-12 mb-3 mb-sm-0">
                                                                                                <h5 class="font-weight-bold text-center">Первый возвещатель</h5>
                                                                                                <select class="form-control form-control-rounded" name="user_1" id="user_1">
                                                                                                    @foreach ($users as $user)
                                                                                                        @if (auth()->user()->id == $user->id)
                                                                                                            <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                        @else
                                                                                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                    <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand1', $standPublisher->id) }}"
                                                                                       onclick="event.preventDefault();
                                                                                           document.getElementById('recordStandFirst{{$standPublisher->id }}').submit();">
                                                                                        Записать
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endempty
                                                            @else
                                                                <p class="text-danger heading">Нет записи</p>
                                                            @endif
                                                            @else{{--если создана есть 1 пользователь--}}
                                                            @empty($standPublisher->user->mobile_phone)
                                                                {{$standPublisher->user->first_name}} {{$standPublisher->user->last_name}}
                                                            @else
                                                                <button class="btn btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user->mobile_phone}})">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </button>
                                                                {{$standPublisher->user->first_name}} {{$standPublisher->user ->last_name}}

                                                            @endempty
                                                            @endempty
                                                        @endempty
                                                    </th>

                                                    <th class="value3">
                                                        <div class="align-items-center">
                                                            @empty($standPublisher){{--если не создана запись--}}
                                                            @if(auth()->user()->can('User. Stand. Entry in table'))
                                                                @empty($standPublisher->user)
                                                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" data-id="new">
                                                                        Записаться
                                                                    </button>
                                                                @endempty
                                                            @else
                                                                <p class="text-danger heading">Нет записи</p>
                                                            @endif
                                                            @else
                                                                @empty(($standPublisher->user2)){{--если создана но нет 2 пользователя запись--}}
                                                                @if(auth()->user()->can('User. Stand. Entry in table'))
                                                                    @empty($standPublisher->user2)
                                                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#record2{{$standPublisher->id }}" data-id="new">
                                                                            Записаться
                                                                        </button>
                                                                        <div class="modal fade" id="record2{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="record2">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <form id="recordStandSecond{{$standPublisher->id }}" method="post" action="{{ route('AddPublisherToStand2', $standPublisher->id) }}">
                                                                                            @csrf
                                                                                            <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                                                Дата {{$standPublisher->date }} <br> Время {{$standPublisher->time }}
                                                                                            </p>
                                                                                            <small class="text-muted"></small>
                                                                                            <div class="row mb-5">
                                                                                                <div class="col-md-12 mb-3 mb-sm-0">
                                                                                                    <h5 class="font-weight-bold text-center">Второй возвещатель</h5>
                                                                                                    <select class="form-control form-control-rounded" name="user_2" id="user_2">
                                                                                                        @foreach ($users as $user)
                                                                                                            @if (auth()->user()->id == $user->id)
                                                                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @else
                                                                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                        <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand2', $standPublisher->id) }}"
                                                                                           onclick="event.preventDefault();
                                                                                               document.getElementById('recordStandSecond{{$standPublisher->id }}').submit();">
                                                                                            Записать
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endempty
                                                                @else
                                                                    <p class="text-danger heading">Нет записи</p>
                                                                @endif
                                                                @else{{--если создана есть 2 пользователь--}}
                                                                @empty($standPublisher->user2->mobile_phone)
                                                                    {{$standPublisher->user2->first_name}} {{$standPublisher->user2->last_name}}
                                                                @else
                                                                    <button class="btn btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user2->mobile_phone}})">
                                                                        <i class="fa-solid fa-phone"></i>
                                                                    </button>
                                                                    {{$standPublisher->user2->first_name}} {{$standPublisher->user2 ->last_name}}
                                                                @endempty
                                                                @endempty
                                                            @endempty
                                                        </div>
                                                    </th>

                                                    <th class="value4">
                                                        @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
                                                        @else
                                                            @if(auth()->user()->can('User. Stand. Entry in table'))
                                                                <div class="align-items-center">
                                                                    <button class="btn btn-primary m-1" type="button" data-toggle="modal" data-target="#redaction{{$standPublisher->id }}" data-id="new">
                                                                        Изменить
                                                                    </button>
                                                                </div>
                                                                <div class="modal fade" id="redaction{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <div class="card  mb-3">
                                                                                    <div class="card-body">
                                                                                        <h5 class="heading">Первый возвещатель</h5>
                                                                                        @if (is_null($standPublisher->user_1))
                                                                                            <h6 class="heading">Нет записи чтобы изменить</h6>
                                                                                        @else                                                                  <div class="row mb-3 mb-sm-0">
                                                                                            <div class="col-md-12">
                                                                                                <form id="changeForm" method="post" action="{{ route('recordRedactionChange1', ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                    @csrf
                                                                                                    <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">
                                                                                                        @foreach ($users as $user)
                                                                                                            @if ($standPublisher->user_1 == $user->id)
                                                                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @else
                                                                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col text-left mb-3 mb-sm-0">
                                                                                                        <a href="{{ route('recordRedactionDelete1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                            <button class="btn btn-danger m-1" type="button" >
                                                                                                                Выписать(ся)
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <div class="col text-right mb-3 mb-sm-0">
                                                                                                        <a href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"      onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                                                                                            <button class="btn btn-success m-1" type="button" >
                                                                                                                Изменить запись
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card  mb-3">
                                                                                    <div class="card-body">
                                                                                        <h5 class="heading">Второй возвещатель</h5>
                                                                                        @if (is_null($standPublisher->user_2))
                                                                                            <h6 class="heading">Нет записи чтобы изменить</h6>
                                                                                        @else
                                                                                            <div class="row mb-3 mb-sm-0">
                                                                                                <div class="col-md-12">
                                                                                                    <form id="changeForm2" method="post" action="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                        @csrf
                                                                                                        <select class="form-control form-control-rounded heading mb-4" name="2_user_id" id="2_user_id">
                                                                                                            @foreach ($users as $user)
                                                                                                                @if ($standPublisher->user_2 == $user->id)
                                                                                                                    <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                                @else
                                                                                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </form>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="row">
                                                                                                        <div class="col text-left mb-3 mb-sm-0">
                                                                                                            <a href="{{ route('recordRedactionDelete2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                                <button class="btn btn-danger m-1" type="button" >
                                                                                                                    Выписать(ся)
                                                                                                                </button>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <div class="col text-right mb-3 mb-sm-0">
                                                                                                            <a href="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
                                   document.getElementById('changeForm2').submit();">
                                                                                                                <button class="btn btn-success m-1" type="button" >
                                                                                                                    Изменить запись
                                                                                                                </button>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @endif
                                                        @endif
                                                    </th>

                                                    <th class="value5">
                                                        @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
                                                        @else
                                                            @if(auth()->user()->can('User. Stand. Entry in table'))
                                                                @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)
                                                                || is_null($standPublisher->user) && $standPublisher->user2->id != auth()->id()
                                                                || is_null($standPublisher->user2) && $standPublisher->user->id != auth()->id())
                                                                @else
                                                                    <div class="align-items-center">
                                                                        <button class="btn btn-dark m-1" type="button" data-toggle="modal" data-target="#hourReportModal{{$standPublisher->id }}">
                                                                            Отчет
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal fade" id="hourReportModal{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="personalReportModal-2">Отчет служения со стендом</h5>
                                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="modal-body">
                                                                                    {{--@if(is_null($StandReports) || $StandReports->StandPublishers_id != $StandPublishers->id)--}}
                                                                                    <form id="report" method="POST" action="{{ route('standReportSend', $StandTemplate->id) }}">
                                                                                        @csrf
                                                                                        <input type="hidden" name="day" id="day" value="{{$standPublisher->day }}">
                                                                                        <input type="hidden" name="time" id="time" value="{{$standPublisher->time }}">
                                                                                        <input type="hidden" name="date" id="date" value="{{$standPublisher->date }}">
                                                                                        <h5 class="heading text-success font-weight-bold line-height-1 mb-1" >
                                                                                            Дата {{$standPublisher->date }}
                                                                                        </h5>
                                                                                        <h5 class="heading text-success font-weight-bold line-height-1 mb-5">
                                                                                            Время {{$standPublisher->time }}
                                                                                        </h5>
                                                                                        <div class="d-flex flex-column">
                                                                                            <!-- Publications -->
                                                                                            <div class="form-group mb-3">
                                                                                                <h5 class="heading" >Публикации (печатные/электронные)</h5>
                                                                                                <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" value="0">
                                                                                                @error('publications')
                                                                                                <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <!-- Videos -->
                                                                                            <div class="form-group mb-3">
                                                                                                <h4 class="heading" >Видеоролики</h4>
                                                                                                <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" value="0">
                                                                                                @error('videos')
                                                                                                <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <!-- return visits -->
                                                                                            <div class="form-group mb-3">
                                                                                                <h4 class="heading">Повторные посещения</h4>
                                                                                                <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" value="0">
                                                                                                @error('return_visits')
                                                                                                <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <!-- bible studies -->
                                                                                            <div class="form-group mb-3">
                                                                                                <h4 class="heading">Изучения Библии</h4>
                                                                                                <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" value="0">
                                                                                                @error('bible_studies')
                                                                                                <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                                                                                @enderror
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                    <a class="btn btn-success" type="button" href="{{ route('standReportSend', $StandTemplate->id) }}"
                                                                                       onclick="event.preventDefault();
                                    document.getElementById('report').submit();">
                                                                                        Отправить
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @else
                                                            @endif
                                                        @endif
                                                    </th>
                                                </tr>

                                                <div class="modal fade" id="NewRecordStand1{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="record2"> Новая запись для стенда {{ $stand->name }}</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="NewRecordStand1{{$time,$gwe}}{{$day,$StandTemplate->id}}" method="post" action="{{ route('NewRecordStand1') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="time" id="time" value="{{$time}}">
                                                                    <input type="hidden" name="date" id="date" value="{{$gwe}}">
                                                                    <input type="hidden" name="day" id="day" value="{{$day}}">
                                                                    <input type="hidden" name="stand_template_id" id="stand_template_id" value="{{$StandTemplate->id}}">
                                                                    <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                        Дата {{ $gwe }} <br> Время {{$time }}
                                                                    </p>
                                                                    <small class="text-muted"></small>
                                                                    <div class="row mb-5">
                                                                        <div class="col-md-12 mb-3 mb-sm-0">
                                                                            <h5 class="font-weight-bold text-center">Первый возвещатель</h5>
                                                                            <select class="form-control form-control-rounded" name="user_1" id="user_1">
                                                                                @foreach ($users as $user)
                                                                                    @if (auth()->user()->id == $user->id)
                                                                                        <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                    @else
                                                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                <a class="btn btn-success" type="button" href="{{ route('NewRecordStand1') }}"
                                                                   onclick="event.preventDefault();
                                                                       document.getElementById('NewRecordStand1{{$time,$gwe}}{{$day,$StandTemplate->id}}').submit();">
                                                                    Записать
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="record2"> Новая запись для стенда {{ $stand->name }}</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}" method="post" action="{{ route('NewRecordStand2') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="time" id="time" value="{{$time}}">
                                                                    <input type="hidden" name="date" id="date" value="{{$gwe}}">
                                                                    <input type="hidden" name="day" id="day" value="{{$day}}">
                                                                    <input type="hidden" name="stand_template_id" id="stand_template_id" value="{{$StandTemplate->id}}">
                                                                    <p class="text-hidden text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                        Дата {{ $gwe }} <br> Время {{$time }}
                                                                    </p>
                                                                    <small class="text-muted"></small>
                                                                    <div class="row mb-5">
                                                                        <div class="col-md-12 mb-3 mb-sm-0">
                                                                            <h5 class="font-weight-bold text-center">Второй возвещатель</h5>
                                                                            <select class="form-control form-control-rounded" name="user_2" id="user_2">
                                                                                @foreach ($users as $user)
                                                                                    @if (auth()->user()->id == $user->id)
                                                                                        <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                    @else
                                                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                <a class="btn btn-success" type="button" href="{{ route('NewRecordStand2') }}"
                                                                   onclick="event.preventDefault();
                                                                       document.getElementById('NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}').submit();">
                                                                    Записать
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна в </h1>
                        @if($activation_value[0] == 1)
                            <p class="mb-5 text-muted text-20"><h1>Понедельник {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 2)
                            <p class="mb-5 text-muted text-20"><h1>Вторник {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 3)
                            <p class="mb-5 text-muted text-20"><h1>Среду {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 4)
                            <p class="mb-5 text-muted text-20"><h1>Четверг {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 5)
                            <p class="mb-5 text-muted text-20"><h1>Пятницу {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 6)
                            <p class="mb-5 text-muted text-20"><h1>Субботу {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 7)
                            <p class="mb-5 text-muted text-20"><h1>Воскресенье {{$activation_value[1]}}</h1>
                        @endif

                    </div>
                @endif
            </div>
        @endcan
    @else
        @can('User. Stand. Open table')
            <div class="main-content pt-4">
                @role('Developer')
                <div>
                    <a href="{{ route('ExampleUpdateCurrentNext', $stand->id) }}">
                        <button class="btn btn-light m-1" type="button">
                            Обновить Current-Next</button>
                    </a>
                </div>
                @endrole
                <h1 class="headint text-center font-weight-bold">{{ $stand->name }}</h1>

                @if (session('error'))
                    <div class="alert alert-card alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-card alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="row mt-3">
                    <div class="col text-left ml-0">
                        <a href="{{ route('currentWeekTable', $stand->id) }}">
                            <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
                        </a>
                    </div>
                    <div class="col text-right ml-0">
                        <a href="{{ route('nextWeekTable', $stand->id) }}">
                            <button class="btn btn-info btn-block text-center">Следующая неделя</button>
                        </a>
                    </div>
                </div>

                <div class="separator-breadcrumb border-top"></div>

                @if(date('N') . '-'. date('H:i') >= $StandTemplate->activation)
                <div class="row">
                    @foreach ($week_schedule as $day => $times)
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-header d-flex align-items-center" style="background: #ebdd9b">
                                    <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                    <h5 class="text-18 font-weight-600 card-title m-0">
                                        {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                        {{ $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($day) }}
                                    </h5>
                                    <h5 class="text-18 font-weight-700 card-title m-8">
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class='table table-sm table-hover mb-0'>
                                        <thead>
                                        <tr>
                                            <th>Время</th>
                                            <th>Возвещатель</th>
                                            <th>Возвещатель</th>
                                            @if(auth()->user()->can('User. Stand. Entry in table'))
                                                <th>Изменения</th>
                                            @endif
                                            <th>Отчет</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($times as $time)
                                            @php
                                                $standPublisher = App\Models\StandPublishers::where('day', $day)
                                                    ->where('time', $time)
                                                    ->where('date', $gwe)
                                                    ->where('stand_template_id', $StandTemplate->id)
                                                    ->first();
                                            @endphp
                                            <tr class="text-nowrap align-items-center text-left">

                                                <th class="value1">
                                                    <span class="text-center">{{$time}}</span>
                                                </th>

                                                <th class="value2">
                                                    @empty($standPublisher){{--если не создана запись--}}
                                                    @if(auth()->user()->can('User. Stand. Entry in table'))
                                                        @empty($standPublisher->user)
                                                            <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#NewRecordStand1{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" data-id="new">
                                                                Записаться
                                                            </button>
                                                        @endempty
                                                    @else
                                                        <p class="text-danger heading">Нет записи</p>
                                                    @endif
                                                    @else
                                                        @empty(($standPublisher->user)){{--если создана но нет 1 пользователя запись--}}
                                                        @if(auth()->user()->can('User. Stand. Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#record1{{$standPublisher->id }}" data-id="new">
                                                                    Записаться
                                                                </button>
                                                                <div class="modal fade" id="record1{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form id="recordStandFirst{{$standPublisher->id }}" method="post" action="{{ route('AddPublisherToStand1', $standPublisher->id) }}">
                                                                                    @csrf
                                                                                    <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                                        Дата {{$standPublisher->date }} <br> Время {{$standPublisher->time }}
                                                                                    </p>
                                                                                    <small class="text-muted"></small>
                                                                                    <div class="row mb-5">
                                                                                        <div class="col-md-12 mb-3 mb-sm-0">
                                                                                            <h5 class="font-weight-bold text-center">Первый возвещатель</h5>
                                                                                            <select class="form-control form-control-rounded" name="user_1" id="user_1">
                                                                                                @foreach ($users as $user)
                                                                                                    @if (auth()->user()->id == $user->id)
                                                                                                        <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                    @else
                                                                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand1', $standPublisher->id) }}"
                                                                                   onclick="event.preventDefault();
                                                                                       document.getElementById('recordStandFirst{{$standPublisher->id }}').submit();">
                                                                                    Записать
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else{{--если создана есть 1 пользователь--}}
                                                        @empty($standPublisher->user->mobile_phone)
                                                            {{$standPublisher->user->first_name}} {{$standPublisher->user->last_name}}
                                                        @else
                                                            <button class="btn btn-outline-secondary btn-icon" onclick="callNumber({{$standPublisher->user->mobile_phone}})">
                                                                        <span class="ul-btn__icon">
                                                                            <i class="fa-solid fa-phone"></i>
                                                                        </span>
                                                            </button>
                                                            {{$standPublisher->user->first_name}} {{$standPublisher->user->last_name}}
                                                        @endempty
                                                        @endempty
                                                    @endempty
                                                </th>

                                                <th class="value3">
                                                    @empty($standPublisher){{--если не создана запись--}}
                                                    @if(auth()->user()->can('User. Stand. Entry in table'))
                                                        @empty($standPublisher->user)

                                                            <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" data-id="new">
                                                                Записаться
                                                            </button>

                                                        @endempty
                                                    @else
                                                        <p class="text-danger heading">Нет записи</p>
                                                    @endif
                                                    @else
                                                        @empty(($standPublisher->user2)){{--если создана но нет 2 пользователя запись--}}
                                                        @if(auth()->user()->can('User. Stand. Entry in table'))
                                                            @empty($standPublisher->user2)
                                                                <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#record2{{$standPublisher->id }}" data-id="new">
                                                                    Записаться
                                                                </button>

                                                                <div class="modal fade" id="record2{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="record2">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form id="recordStandSecond{{$standPublisher->id }}" method="post" action="{{ route('AddPublisherToStand2', $standPublisher->id) }}">
                                                                                    @csrf
                                                                                    <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                                        Дата {{$standPublisher->date }} <br> Время {{$standPublisher->time }}
                                                                                    </p>
                                                                                    <small class="text-muted"></small>
                                                                                    <div class="row mb-5">
                                                                                        <div class="col-md-12 mb-3 mb-sm-0">
                                                                                            <h5 class="font-weight-bold text-center">Второй возвещатель</h5>
                                                                                            <select class="form-control form-control-rounded" name="user_2" id="user_2">
                                                                                                @foreach ($users as $user)
                                                                                                    @if (auth()->user()->id == $user->id)
                                                                                                        <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                    @else
                                                                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand2', $standPublisher->id) }}"
                                                                                   onclick="event.preventDefault();
                                                                                       document.getElementById('recordStandSecond{{$standPublisher->id }}').submit();">
                                                                                    Записать
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else{{--если создана есть 2 пользователь--}}
                                                        @empty($standPublisher->user2->mobile_phone)

                                                            {{$standPublisher->user2->first_name}} {{$standPublisher->user2->last_name}}

                                                        @else

                                                            <button class="btn btn-outline-secondary btn-icon" onclick="callNumber({{$standPublisher->user2->mobile_phone}})">
                                                                            <span class="ul-btn__icon">
                                                                                <i class="fa-solid fa-phone"></i>
                                                                            </span>
                                                            </button>
                                                            {{$standPublisher->user2->first_name}} {{$standPublisher->user2 ->last_name}}

                                                        @endempty
                                                        @endempty
                                                    @endempty
                                                </th>

                                                <th class="value4">
                                                    @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
                                                    @else
                                                        @if(auth()->user()->can('User. Stand. Entry in table'))
                                                            <div class="align-items-center">
                                                                <button class="btn btn-primary m-1" type="button" data-toggle="modal" data-target="#redaction{{$standPublisher->id }}" data-id="new">
                                                                    Изменить
                                                                </button>
                                                            </div>
                                                            <div class="modal fade" id="redaction{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card  mb-3">
                                                                                <div class="card-body">
                                                                                    <h5 class="heading">Первый возвещатель</h5>
                                                                                    @if (is_null($standPublisher->user_1))
                                                                                        <h6 class="heading">Нет записи чтобы изменить</h6>
                                                                                    @else                                                                  <div class="row mb-3 mb-sm-0">
                                                                                        <div class="col-md-12">
                                                                                            <form id="changeForm" method="post" action="{{ route('recordRedactionChange1', ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                @csrf
                                                                                                <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">
                                                                                                    @foreach ($users as $user)
                                                                                                        @if ($standPublisher->user_1 == $user->id)
                                                                                                            <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                        @else
                                                                                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="row">
                                                                                                <div class="col text-left mb-3 mb-sm-0">
                                                                                                    <a href="{{ route('recordRedactionDelete1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                        <button class="btn btn-danger m-1" type="button" >
                                                                                                            Выписать(ся)
                                                                                                        </button>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col text-right mb-3 mb-sm-0">
                                                                                                    <a href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"      onclick="event.preventDefault();
                                                            document.getElementById('changeForm').submit();">
                                                                                                        <button class="btn btn-success m-1" type="button" >
                                                                                                            Изменить запись
                                                                                                        </button>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="card  mb-3">
                                                                                <div class="card-body">
                                                                                    <h5 class="heading">Второй возвещатель</h5>
                                                                                    @if (is_null($standPublisher->user_2))
                                                                                        <h6 class="heading">Нет записи чтобы изменить</h6>
                                                                                    @else
                                                                                        <div class="row mb-3 mb-sm-0">
                                                                                            <div class="col-md-12">
                                                                                                <form id="changeForm2" method="post" action="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                    @csrf
                                                                                                    <select class="form-control form-control-rounded heading mb-4" name="2_user_id" id="2_user_id">
                                                                                                        @foreach ($users as $user)
                                                                                                            @if ($standPublisher->user_2 == $user->id)
                                                                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @else
                                                                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col text-left mb-3 mb-sm-0">
                                                                                                        <a href="{{ route('recordRedactionDelete2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                                                                            <button class="btn btn-danger m-1" type="button" >
                                                                                                                Выписать(ся)
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <div class="col text-right mb-3 mb-sm-0">
                                                                                                        <a href="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
                                       document.getElementById('changeForm2').submit();">
                                                                                                            <button class="btn btn-success m-1" type="button" >
                                                                                                                Изменить запись
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                        @endif
                                                    @endif
                                                </th>

                                                <th class="value5">
                                                    @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
                                                    @else
                                                        @if(auth()->user()->can('User. Stand. Entry in table'))
                                                            @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)
                                                            || is_null($standPublisher->user) && $standPublisher->user2->id != auth()->id()
                                                            || is_null($standPublisher->user2) && $standPublisher->user->id != auth()->id())
                                                            @else
                                                                <div class="align-items-center">
                                                                    <button class="btn btn-dark m-1" type="button" data-toggle="modal" data-target="#hourReportModal{{$standPublisher->id }}">
                                                                        Отчет
                                                                    </button>
                                                                </div>
                                                                <div class="modal fade" id="hourReportModal{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="personalReportModal-2">Отчет служения со стендом</h5>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                {{--@if(is_null($StandReports) || $StandReports->StandPublishers_id != $StandPublishers->id)--}}
                                                                                <form id="report" method="POST" action="{{ route('standReportSend', $StandTemplate->id) }}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="day" id="day" value="{{$standPublisher->day }}">
                                                                                    <input type="hidden" name="time" id="time" value="{{$standPublisher->time }}">
                                                                                    <input type="hidden" name="date" id="date" value="{{$standPublisher->date }}">
                                                                                    <h5 class="heading text-success font-weight-bold line-height-1 mb-1" >
                                                                                        Дата {{$standPublisher->date }}
                                                                                    </h5>
                                                                                    <h5 class="heading text-success font-weight-bold line-height-1 mb-5">
                                                                                        Время {{$standPublisher->time }}
                                                                                    </h5>
                                                                                    <div class="d-flex flex-column">
                                                                                        <!-- Publications -->
                                                                                        <div class="form-group mb-3">
                                                                                            <h5 class="heading" >Публикации (печатные/электронные)</h5>
                                                                                            <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" value="0">
                                                                                            @error('publications')
                                                                                            <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <!-- Videos -->
                                                                                        <div class="form-group mb-3">
                                                                                            <h4 class="heading" >Видеоролики</h4>
                                                                                            <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" value="0">
                                                                                            @error('videos')
                                                                                            <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <!-- return visits -->
                                                                                        <div class="form-group mb-3">
                                                                                            <h4 class="heading">Повторные посещения</h4>
                                                                                            <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" value="0">
                                                                                            @error('return_visits')
                                                                                            <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <!-- bible studies -->
                                                                                        <div class="form-group mb-3">
                                                                                            <h4 class="heading">Изучения Библии</h4>
                                                                                            <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" value="0">
                                                                                            @error('bible_studies')
                                                                                            <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                                                <a class="btn btn-success" type="button" href="{{ route('standReportSend', $StandTemplate->id) }}"
                                                                                   onclick="event.preventDefault();
                                        document.getElementById('report').submit();">
                                                                                    Отправить
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                        @endif
                                                    @endif
                                                </th>

                                            </tr>

                                            <div class="modal fade" id="NewRecordStand1{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="record2"> Новая запись для стенда {{ $stand->name }}</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="NewRecordStand1{{$time,$gwe}}{{$day,$StandTemplate->id}}" method="post" action="{{ route('NewRecordStand1') }}">
                                                                @csrf
                                                                <input type="hidden" name="time" id="time" value="{{$time}}">
                                                                <input type="hidden" name="date" id="date" value="{{$gwe}}">
                                                                <input type="hidden" name="day" id="day" value="{{$day}}">
                                                                <input type="hidden" name="stand_template_id" id="stand_template_id" value="{{$StandTemplate->id}}">
                                                                <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                    Дата {{ $gwe }} <br> Время {{$time }}
                                                                </p>
                                                                <small class="text-muted"></small>
                                                                <div class="row mb-5">
                                                                    <div class="col-md-12 mb-3 mb-sm-0">
                                                                        <h5 class="font-weight-bold text-center">Первый возвещатель</h5>
                                                                        <select class="form-control form-control-rounded" name="user_1" id="user_1">
                                                                            @foreach ($users as $user)
                                                                                @if (auth()->user()->id == $user->id)
                                                                                    <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                @else
                                                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                            <a class="btn btn-success" type="button" href="{{ route('NewRecordStand1') }}"
                                                               onclick="event.preventDefault();
                                                                   document.getElementById('NewRecordStand1{{$time,$gwe}}{{$day,$StandTemplate->id}}').submit();">
                                                                Записать
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="record2"> Новая запись для стенда {{ $stand->name }}</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}" method="post" action="{{ route('NewRecordStand2') }}">
                                                                @csrf
                                                                <input type="hidden" name="time" id="time" value="{{$time}}">
                                                                <input type="hidden" name="date" id="date" value="{{$gwe}}">
                                                                <input type="hidden" name="day" id="day" value="{{$day}}">
                                                                <input type="hidden" name="stand_template_id" id="stand_template_id" value="{{$StandTemplate->id}}">
                                                                <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                                                    Дата {{ $gwe }} <br> Время {{$time }}
                                                                </p>
                                                                <small class="text-muted"></small>
                                                                <div class="row mb-5">
                                                                    <div class="col-md-12 mb-3 mb-sm-0">
                                                                        <h5 class="font-weight-bold text-center">Второй возвещатель</h5>
                                                                        <select class="form-control form-control-rounded" name="user_2" id="user_2">
                                                                            @foreach ($users as $user)
                                                                                @if (auth()->user()->id == $user->id)
                                                                                    <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                @else
                                                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                                            <a class="btn btn-success" type="button" href="{{ route('NewRecordStand2') }}"
                                                               onclick="event.preventDefault();
                                                                   document.getElementById('NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}').submit();">
                                                                Записать
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="text-60">Следующая неделя будет доступна в </h1>
                        @if($activation_value[0] == 1)
                            <p class="mb-5 text-muted text-20"><h1>Понедельник {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 2)
                            <p class="mb-5 text-muted text-20"><h1>Вторник {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 3)
                            <p class="mb-5 text-muted text-20"><h1>Среду {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 4)
                            <p class="mb-5 text-muted text-20"><h1>Четверг {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 5)
                            <p class="mb-5 text-muted text-20"><h1>Пятницу {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 6)
                            <p class="mb-5 text-muted text-20"><h1>Субботу {{$activation_value[1]}}</h1>
                        @elseif($activation_value[0] == 7)
                            <p class="mb-5 text-muted text-20"><h1>Воскресенье {{$activation_value[1]}}</h1>
                        @endif

                    </div>
                @endif
            </div>
        @endcan
    @endif


    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>
@endsection
