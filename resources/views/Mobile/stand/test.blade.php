@extends('Mobile.layouts.app')
@section('title') Meeper | dasd @endsection
@section('content')
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

                    <!--  projects -->
                @foreach ($week_schedule as $day => $times)
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" style="background: rgb(232,237,231)">
                            <div class="card-header d-flex align-items-center" style="background: #ffedb6">
                                <h5 class="text-18 font-weight-600 card-title m-0">
                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}
                                </h5>
                                <h5 class="text-18 font-weight-700 card-title m-8">
                                </h5>
                            </div>
                                @foreach ($times as $time)
                                    @php
                                        $standPublisher = App\Models\StandPublishers::where('day', $day)
                                            ->where('time', $time)
                                            ->where('date', $gwe)
                                            ->where('stand_template_id', $StandTemplate->id)
                                            ->first();
                                    @endphp
                                @if(isset($standPublisher->user) && isset($standPublisher->user2))
                                    <div class="card m-1" style="background: rgba(136,167,149,0.38)">
                                        <div class="m-2">
                                            <div class="d-flex justify-content-between text-center align-items-center">
                                                <div class="flex-grow text-left mr-2">
                                                    <h5 class="heading text-center">
                                                        {{ date('H:i', strtotime($time . ':00')) }}<br>

                                                    </h5>
                                                </div>
                                                <div class="flex-fill text-left">
                                                    @empty($standPublisher){{--если не создана запись--}}
                                                    @if(auth()->user()->can('Stand-Entry in table'))
                                                        @empty($standPublisher->user)
                                                            <a id="create_record1" href="#"
                                                               class="create_record1"
                                                               data-id="{{ $StandTemplate->id }}"
                                                               data-time="{{ $time }}"
                                                               data-gwe="{{ $gwe }}"
                                                               data-day="{{ $day }}">
                                                                <button class="btn btn-success btn-block">Записаться</button>
                                                            </a>
                                                        @endempty
                                                    @else
                                                        <p class="text-danger heading">Нет записи</p>
                                                    @endif
                                                    @else
                                                        @empty($standPublisher->user){{--если создана но нет 1 пользователя запись--}}
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <a id="update_record1" href="#"
                                                                   class="update_record1"
                                                                   data-template="{{ $StandTemplate->id }}"
                                                                   data-publishers="{{ $standPublisher->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-block">Записаться</button>
                                                                </a>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else{{--если создана есть 1 пользователь--}}
                                                        @empty($standPublisher->user->mobile_phone)
                                                            {{$standPublisher->user->first_name}} {{$standPublisher->user->last_name}}
                                                        @else
                                                            <button class="btn btn-sm btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user->mobile_phone}})">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </button>
                                                            {{$standPublisher->user->first_name}} {{$standPublisher->user ->last_name}}
                                                        @endempty
                                                        @endempty
                                                    @endempty
                                                    <div class="border-bottom mt-1 mb-1"></div>
                                                    @empty($standPublisher){{--если не создана запись--}}
                                                    @if(auth()->user()->can('Stand-Entry in table'))
                                                        @empty($standPublisher->user)
                                                            <a id="create_record1" href="#"
                                                               class="create_record1"
                                                               data-id="{{ $StandTemplate->id }}"
                                                               data-time="{{ $time }}"
                                                               data-gwe="{{ $gwe }}"
                                                               data-day="{{ $day }}">
                                                                <button class="btn btn-success btn-block">Записаться</button>
                                                            </a>
                                                        @endempty
                                                    @else
                                                        <p class="text-danger heading">Нет записи</p>
                                                    @endif
                                                    @else
                                                        @empty($standPublisher->user2){{--если создана но нет 2 пользователя запись--}}
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user2)
                                                                <a id="update_record2" href="#"
                                                                   class="update_record2"
                                                                   data-template="{{ $StandTemplate->id }}"
                                                                   data-publishers="{{ $standPublisher->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-success btn-block">Записаться</button>
                                                                </a>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else{{--если создана есть 2 пользователь--}}
                                                        @empty($standPublisher->user2->mobile_phone)
                                                            {{$standPublisher->user2->first_name}} {{$standPublisher->user2->last_name}}
                                                        @else
                                                            <button class="btn btn-sm btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user2->mobile_phone}})">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </button>
                                                            {{$standPublisher->user2->first_name}} {{$standPublisher->user2 ->last_name}}
                                                        @endempty
                                                        @endempty
                                                    @endempty
                                                </div>
                                                <div class="flex-grow text-right text-30 ml-2">
                                                    <a href="{{ route('recordRedactionPage',['id' => $standPublisher->id]) }}">
                                                        <i class="fa-solid fa-pen text-dark"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card m-1">
                                            <div class="m-2">
                                                <div class="d-flex justify-content-between text-center align-items-center">
                                                    <div class="flex-grow text-left mr-2">
                                                        <h5 class="heading text-center">
                                                            {{ date('H:i', strtotime($time . ':00')) }}<br>

                                                        </h5>
                                                    </div>
                                                    <div class="flex-fill text-left">
                                                        @empty($standPublisher){{--если не создана запись--}}
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <a id="create_record1" href="#"
                                                                   class="create_record1"
                                                                   data-id="{{ $StandTemplate->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-success btn-block">Записаться</button>
                                                                </a>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else
                                                            @empty($standPublisher->user){{--если создана но нет 1 пользователя запись--}}
                                                            @if(auth()->user()->can('Stand-Entry in table'))
                                                                @empty($standPublisher->user)
                                                                    <a id="update_record1" href="#"
                                                                       class="update_record1"
                                                                       data-template="{{ $StandTemplate->id }}"
                                                                       data-publishers="{{ $standPublisher->id }}"
                                                                       data-time="{{ $time }}"
                                                                       data-gwe="{{ $gwe }}"
                                                                       data-day="{{ $day }}">
                                                                        <button class="btn btn-block" style="background: rgba(55,116,91,0.4)">Записаться</button>
                                                                    </a>
                                                                @endempty
                                                            @else
                                                                <p class="text-danger heading">Нет записи</p>
                                                            @endif
                                                            @else{{--если создана есть 1 пользователь--}}
                                                            @empty($standPublisher->user->mobile_phone)
                                                                {{$standPublisher->user->first_name}} {{$standPublisher->user->last_name}}
                                                            @else
                                                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user->mobile_phone}})">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </button>
                                                                {{$standPublisher->user->first_name}} {{$standPublisher->user ->last_name}}
                                                            @endempty
                                                            @endempty
                                                        @endempty
                                                        <div class="border-bottom mt-1 mb-1"></div>
                                                        @empty($standPublisher){{--если не создана запись--}}
                                                        @if(auth()->user()->can('Stand-Entry in table'))
                                                            @empty($standPublisher->user)
                                                                <a id="create_record1" href="#"
                                                                   class="create_record1"
                                                                   data-id="{{ $StandTemplate->id }}"
                                                                   data-time="{{ $time }}"
                                                                   data-gwe="{{ $gwe }}"
                                                                   data-day="{{ $day }}">
                                                                    <button class="btn btn-success btn-block">Записаться</button>
                                                                </a>
                                                            @endempty
                                                        @else
                                                            <p class="text-danger heading">Нет записи</p>
                                                        @endif
                                                        @else
                                                            @empty($standPublisher->user2){{--если создана но нет 2 пользователя запись--}}
                                                            @if(auth()->user()->can('Stand-Entry in table'))
                                                                @empty($standPublisher->user2)
                                                                    <a id="update_record2" href="#"
                                                                       class="update_record2"
                                                                       data-template="{{ $StandTemplate->id }}"
                                                                       data-publishers="{{ $standPublisher->id }}"
                                                                       data-time="{{ $time }}"
                                                                       data-gwe="{{ $gwe }}"
                                                                       data-day="{{ $day }}">
                                                                        <button class="btn btn-success btn-block">Записаться</button>
                                                                    </a>
                                                                @endempty
                                                            @else
                                                                <p class="text-danger heading">Нет записи</p>
                                                            @endif
                                                            @else{{--если создана есть 2 пользователь--}}
                                                            @empty($standPublisher->user2->mobile_phone)
                                                                {{$standPublisher->user2->first_name}} {{$standPublisher->user2->last_name}}
                                                            @else
                                                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="callNumber({{$standPublisher->user2->mobile_phone}})">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                </button>
                                                                {{$standPublisher->user2->first_name}} {{$standPublisher->user2 ->last_name}}
                                                            @endempty
                                                            @endempty
                                                        @endempty
                                                    </div>
                                                    <div class="flex-grow text-right text-30 ml-2">
                                                        @isset($standPublisher)
                                                        <a href="{{ route('recordRedactionPage',['id' => $standPublisher->id]) }}">
                                                            <i class="fa-solid fa-pen text-dark"></i>
                                                        </a>
                                                        @else
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endisset
                                @endforeach

                        </div>
                    </div>
                @endforeach
                    <!--  end:projects -->


            </div>
        </div>

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

@endsection
