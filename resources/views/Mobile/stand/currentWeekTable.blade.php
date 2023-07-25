@extends('layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')
    @can('Stand-Open stand table')

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
                    {{ session('success') }}
                </div>
            @endif

            <!-- текущая следующая неделя кнопки -->
            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $stand->id) }}">
                        <button class="btn btn-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $stand->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Следующая неделя</button>
                    </a>
                </div>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <!-- Таблица текущей недели -->
            <div class="row">
                @foreach ($week_schedule as $day => $times)
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-header d-flex align-items-center" style="background: #ebdd9b">
                                <h5 class="text-18 font-weight-600 card-title m-0">
                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}
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
                                            @if(auth()->user()->can('Stand-Entry in table'))
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
                                            <tr class="text-nowrap align-items-center text-left">

                                                <th class="value1">
                                                    <div class="align-items-center text-center">
                                                        <span class="text-center">{{$time}}</span>
                                                    </div>
                                                </th>

                                                <th class="value2">
                                                    @empty($standPublisher){{--если не создана запись--}}
                                                    @if(auth()->user()->can('Stand-Entry in table'))
                                                        @empty($standPublisher->user)
                                                            <a id="create_record1" href="#"
                                                               class="create_record1"
                                                               data-id="{{ $StandTemplate->id }}"
                                                               data-time="{{ $time }}"
                                                               data-gwe="{{ $gwe }}"
                                                               data-day="{{ $day }}">
                                                                <button class="btn btn-success">Записаться</button>
                                                            </a>
                                                        @endempty
                                                    @else
                                                        <p class="text-danger heading">Нет записи</p>
                                                    @endif
                                                    @else
                                                        @empty(($standPublisher->user)){{--если создана но нет 1 пользователя запись--}}
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <a id="update_record1" href="#"
                                                                   class="update_record1"
                                                                   data-template="{{ $StandTemplate->id }}"
                                                                   data-publishers="{{ $standPublisher->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-success">Записаться</button>
                                                                </a>
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
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <a id="create_record2" href="#"
                                                                   class="create_record2"
                                                                   data-id="{{ $StandTemplate->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-success">Записаться</button>
                                                                </a>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else
                                                            @empty(($standPublisher->user2)){{--если создана но нет 2 пользователя запись--}}
                                                            @if(auth()->user()->can('Stand-Entry in table'))
                                                                @empty($standPublisher->user2)
                                                                    <a id="update_record2" href="#"
                                                                       class="update_record2"
                                                                       data-template="{{ $StandTemplate->id }}"
                                                                       data-publishers="{{ $standPublisher->id }}"
                                                                       data-time="{{ $time }}"
                                                                       data-gwe="{{ $gwe }}"
                                                                       data-day="{{ $day }}">
                                                                        <button class="btn btn-success">Записаться</button>
                                                                    </a>
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
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            <a href="{{ route('recordRedactionPage',['id' => $standPublisher->id]) }}">
                                                                <button class="btn btn-primary m-1" type="button">
                                                                    Изменить</button>
                                                            </a>

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
                                                                                    @else                                                                 <div class="row mb-3 mb-sm-0">
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
                                                                                                    <a href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"
                                                                                                       onclick="event.preventDefault();
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
                                                            </div
                                                        @else
                                                        @endif
                                                    @endif
                                                </th>

                                                <th class="value5">
                                                    @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
                                                    @else
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)
                                                            || is_null($standPublisher->user) && $standPublisher->user2->id != auth()->id()
                                                            || is_null($standPublisher->user2) && $standPublisher->user->id != auth()->id())
                                                        @else
                                                                <div class="align-items-center">
                                                                    <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#hourReportModal{{$standPublisher->id }}">
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
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan



    @can('Stand-Entry in table')
        <div class="modal" id="createModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Новая запись для стенда {{ $stand->name }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="NewRecordStand1" method="post" action="{{ route('NewRecordStand1') }}">
                            @csrf
                            <input type="hidden" name="Valuetime1" id="Valuetime1">
                            <input type="hidden" name="Valueday1" id="Valueday1">
                            <input type="hidden" name="Valuegwe1" id="Valuegwe1">
                            <input type="hidden" name="Valuestand_template_id1" id="Valuestand_template_id1">

                            <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">
                                Дата: <span id="gwe1"></span><br>
                                Время: <span id="time1"></span>
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
                           document.getElementById('NewRecordStand1').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="createModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Новая запись для стенда {{ $stand->name }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="NewRecordStand2" method="post" action="{{ route('NewRecordStand2') }}">
                            @csrf
                            <input type="hidden" name="Valuetime2" id="Valuetime2">
                            <input type="hidden" name="Valueday2" id="Valueday2">
                            <input type="hidden" name="Valuegwe2" id="Valuegwe2">
                            <input type="hidden" name="Valuestand_template_id2" id="Valuestand_template_id2">

                            <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">
                                Дата: <span id="gwe2"></span><br>
                                Время: <span id="time2"></span>
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
                           document.getElementById('NewRecordStand2').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="updateModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № <span id="updateModal_1_standPublishers_id"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="form_update_record_1" method="post" action="{{ route('AddPublisherToStand1') }}">
                            @csrf
                            <input type="hidden" id="updateModal_1_Value_standPublishers_id" name="updateModal_1_Value_standPublishers_id">

                            <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">
                                Дата: <span id="updateModal_1_gwe"></span><br>
                                Время: <span id="updateModal_1_time"></span>
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
                        <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand1') }}"
                           onclick="event.preventDefault();
                           document.getElementById('form_update_record_1').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="updateModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Запись для стенда {{ $stand->name }} № <span id="updateModal_2_standPublishers_id"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="form_update_record_2" method="post" action="{{ route('AddPublisherToStand2') }}">
                            @csrf
                            <input type="hidden" id="updateModal_2_Value_standPublishers_id" name="updateModal_2_Value_standPublishers_id">

                            <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">
                                Дата: <span id="updateModal_2_gwe"></span><br>
                                Время: <span id="updateModal_2_time"></span>
                            </p>
                            <small class="text-muted"></small>
                            <div class="row mb-5">
                                <div class="col-md-12 mb-3 mb-sm-0">
                                    <h5 class="font-weight-bold text-center">Первый возвещатель</h5>
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
                        <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand2') }}"
                           onclick="event.preventDefault();
                           document.getElementById('form_update_record_2').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.create_record1').click(function(event) {
                    event.preventDefault();
                    // Получение данных из атрибутов кнопки
                    var id = $(this).data('id');
                    var time = $(this).data('time');
                    var gwe = $(this).data('gwe');
                    var day = $(this).data('day');

                    // Отображение данных в модальном окне
                    $('#stand_template_id1').text(id);
                    $('#time1').text(time);
                    $('#gwe1').text(gwe);
                    $('#day1').text(day);

                    $('#Valuestand_template_id1').val(id);
                    $('#Valuetime1').val(time);
                    $('#Valuegwe1').val(gwe);
                    $('#Valueday1').val(day);

                    // Открытие модального окна
                    $('#createModal1').modal('show');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.create_record2').click(function(event) {
                    event.preventDefault();
                    // Получение данных из атрибутов кнопки
                    var id = $(this).data('id');
                    var time = $(this).data('time');
                    var gwe = $(this).data('gwe');
                    var day = $(this).data('day');

                    // Отображение данных в модальном окне
                    $('#stand_template_id2').text(id);
                    $('#time2').text(time);
                    $('#gwe2').text(gwe);
                    $('#day2').text(day);

                    $('#Valuestand_template_id2').val(id);
                    $('#Valuetime2').val(time);
                    $('#Valuegwe2').val(gwe);
                    $('#Valueday2').val(day);

                    // Открытие модального окна
                    $('#createModal2').modal('show');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.update_record1').click(function(event) {
                    event.preventDefault();
                    // Получение данных из атрибутов кнопки
                    var id = $(this).data('id');
                    var template = $(this).data('template');
                    var publishers = $(this).data('publishers');
                    var time = $(this).data('time');
                    var gwe = $(this).data('gwe');
                    var day = $(this).data('day');

                    // Отображение данных в модальном окне
                    $('#updateModal_1_stand_publisher_id').text(id);
                    $('#updateModal_1_standTemplate_id').text(template);
                    $('#updateModal_1_standPublishers_id').text(publishers);
                    $('#updateModal_1_time').text(time);
                    $('#updateModal_1_gwe').text(gwe);
                    $('#updateModal_1_day').text(day);

                    $('#updateModal_1_Value_standTemplate_id').val(template);
                    $('#updateModal_1_Value_standPublishers_id').val(publishers);
                    $('#updateModal_1_Value_time').val(time);
                    $('#updateModal_1_Value_gwe').val(gwe);
                    $('#updateModal_1_Value_day').val(day);

                    // Открытие модального окна
                    $('#updateModal1').modal('show');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.update_record2').click(function(event) {
                    event.preventDefault();
                    // Получение данных из атрибутов кнопки
                    var id = $(this).data('id');
                    var template = $(this).data('template');
                    var publishers = $(this).data('publishers');
                    var time = $(this).data('time');
                    var gwe = $(this).data('gwe');
                    var day = $(this).data('day');

                    // Отображение данных в модальном окне
                    $('#updateModal_2_stand_publisher_id').text(id);
                    $('#updateModal_2_standTemplate_id').text(template);
                    $('#updateModal_2_standPublishers_id').text(publishers);
                    $('#updateModal_2_time').text(time);
                    $('#updateModal_2_gwe').text(gwe);
                    $('#updateModal_2_day').text(day);

                    $('#updateModal_2_Value_standTemplate_id').val(template);
                    $('#updateModal_2_Value_standPublishers_id').val(publishers);
                    $('#updateModal_2_Value_time').val(time);
                    $('#updateModal_2_Value_gwe').val(gwe);
                    $('#updateModal_2_Value_day').val(day);

                    // Открытие модального окна
                    $('#updateModal2').modal('show');
                });
            });
        </script>


    @endcan


    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>
@endsection
