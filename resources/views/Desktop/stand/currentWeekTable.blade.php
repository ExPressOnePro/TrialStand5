@extends('Desktop.layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')


    @can('Stand-Open stand table')
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

            @include('Desktop.includes.alerts')
            @include('Desktop.stand.components.switchWeek')

            <div class="row mt-4">
                @foreach ($week_schedule as $day => $times)
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-header d-flex align-items-center" style="background: #e0d18a">
                                <h5 class="text-18 font-weight-600 card-title m-0">
                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <table class='table table-sm table-hover mb-0'>
                                    <thead>
                                    <tr>
                                        <th>Время</th>
                                        <th>Возвещатель</th>
                                        <th>Возвещатель</th>
                                        @if(auth()->user()->can('Stand-Entry in table'))
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
                                            @include('Desktop.stand.components.th1')
                                            @include('Desktop.stand.components.th2')
                                            @include('Desktop.stand.components.th3')
                                            @include('Desktop.stand.components.th4')
                                            @include('Desktop.stand.components.th5')
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
                                                            <input type="hidden" name="time1" id="time" value="{{$time}}">
                                                            <input type="hidden" name="date1" id="date" value="{{$gwe}}">
                                                            <input type="hidden" name="day1" id="day" value="{{$day}}">
                                                            <input type="hidden" name="stand_template_id1" id="stand_template_id" value="{{$StandTemplate->id}}">
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
                                                            <input type="hidden" name="time2" id="time" value="{{$time}}">
                                                            <input type="hidden" name="date2" id="date" value="{{$gwe}}">
                                                            <input type="hidden" name="day2" id="day" value="{{$day}}">
                                                            <input type="hidden" name="stand_template_id2" id="stand_template_id" value="{{$StandTemplate->id}}">
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
{{--                                        <div class="modal fade" id="NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}"--}}
{{--                                             tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">--}}
{{--                                            <div class="modal-dialog" role="document">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-header">--}}
{{--                                                        <h5 class="modal-title" id="record2"> Новая запись для стенда {{ $stand->name }}</h5>--}}
{{--                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                                                            <span aria-hidden="true">×</span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-body">--}}
{{--                                                        <form id="NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}" method="post" action="{{ route('NewRecordStand2') }}">--}}
{{--                                                            @csrf--}}
{{--                                                            <input type="hidden" name="time" id="time" value="{{$time}}">--}}
{{--                                                            <input type="hidden" name="date" id="date" value="{{$gwe}}">--}}
{{--                                                            <input type="hidden" name="day" id="day" value="{{$day}}">--}}
{{--                                                            <input type="hidden" name="stand_template_id" id="stand_template_id" value="{{$StandTemplate->id}}">--}}
{{--                                                            <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">--}}
{{--                                                                Дата {{ $gwe }} <br> Время {{$time }}--}}
{{--                                                            </p>--}}
{{--                                                            <small class="text-muted"></small>--}}
{{--                                                            <div class="row mb-5">--}}
{{--                                                                <div class="col-md-12 mb-3 mb-sm-0">--}}
{{--                                                                    <h5 class="font-weight-bold text-center">Второй возвещатель</h5>--}}
{{--                                                                    <select class="form-control form-control-rounded" name="user_2" id="user_2">--}}
{{--                                                                        @foreach ($users as $user)--}}
{{--                                                                            @if (auth()->user()->id == $user->id)--}}
{{--                                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                                                            @else--}}
{{--                                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-footer">--}}
{{--                                                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>--}}
{{--                                                        <a class="btn btn-success" type="button" href="{{ route('NewRecordStand2') }}"--}}
{{--                                                           onclick="event.preventDefault();--}}
{{--                                                               document.getElementById('NewRecordStand22{{$time,$gwe}}{{$day,$StandTemplate->id}}').submit();">--}}
{{--                                                            Записать--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan


{{--    <div class="modal" id="createModal1">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title"> Новая запись для стенда {{ $stand->name }}</h5>--}}
{{--                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="NewRecordStand1" method="post" action="{{ route('NewRecordStand1') }}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="Valuetime1" id="Valuetime1">--}}
{{--                        <input type="hidden" name="Valueday1" id="Valueday1">--}}
{{--                        <input type="hidden" name="Valuegwe1" id="Valuegwe1">--}}
{{--                        <input type="hidden" name="Valuestand_template_id1" id="Valuestand_template_id1">--}}

{{--                        <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">--}}
{{--                            Дата: <span id="gwe1"></span><br>--}}
{{--                            Время: <span id="time1"></span>--}}
{{--                        </p>--}}
{{--                        <small class="text-muted"></small>--}}
{{--                        <div class="row mb-5">--}}
{{--                            <div class="col-md-12 mb-3 mb-sm-0">--}}
{{--                                <h5 class="font-weight-bold text-center">Первый возвещатель</h5>--}}
{{--                                <select class="form-control form-control-rounded" name="user_1" id="user_1">--}}
{{--                                    @foreach ($users as $user)--}}
{{--                                        @if (auth()->user()->id == $user->id)--}}
{{--                                            <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>--}}
{{--                    <a class="btn btn-success" type="button" href="{{ route('NewRecordStand1') }}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                           document.getElementById('NewRecordStand1').submit();">--}}
{{--                        Записать--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="modal" id="updateModal1">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № <span id="updateModal_1_standPublishers_id"></span></h5>--}}
{{--                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--                <div class="modal-body">--}}
{{--                    <form id="form_update_record_1" method="post" action="{{ route('AddPublisherToStand1') }}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" id="updateModal_1_Value_standPublishers_id" name="updateModal_1_Value_standPublishers_id">--}}

{{--                        <p class="text-20 text-success text-left font-weight-bold line-height-1 mb-5">--}}
{{--                            Дата: <span id="updateModal_1_gwe"></span><br>--}}
{{--                            Время: <span id="updateModal_1_time"></span>--}}
{{--                        </p>--}}
{{--                        <small class="text-muted"></small>--}}
{{--                        <div class="row mb-5">--}}
{{--                            <div class="col-md-12 mb-3 mb-sm-0">--}}
{{--                                <h5 class="font-weight-bold text-center">Первый возвещатель</h5>--}}
{{--                                <select class="form-control form-control-rounded" name="user_1" id="user_1">--}}
{{--                                    @foreach ($users as $user)--}}
{{--                                        @if (auth()->user()->id == $user->id)--}}
{{--                                            <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>--}}
{{--                    <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand1') }}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                           document.getElementById('form_update_record_1').submit();">--}}
{{--                        Записать--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.create_record1').click(function(event) {--}}
{{--                event.preventDefault();--}}
{{--                // Получение данных из атрибутов кнопки--}}
{{--                var id = $(this).data('id');--}}
{{--                var time = $(this).data('time');--}}
{{--                var gwe = $(this).data('gwe');--}}
{{--                var day = $(this).data('day');--}}

{{--                // Отображение данных в модальном окне--}}
{{--                $('#stand_template_id1').text(id);--}}
{{--                $('#time1').text(time);--}}
{{--                $('#gwe1').text(gwe);--}}
{{--                $('#day1').text(day);--}}

{{--                $('#Valuestand_template_id1').val(id);--}}
{{--                $('#Valuetime1').val(time);--}}
{{--                $('#Valuegwe1').val(gwe);--}}
{{--                $('#Valueday1').val(day);--}}

{{--                // Открытие модального окна--}}
{{--                $('#createModal1').modal('show');--}}
{{--            });--}}
{{--        });--}}

{{--        $(document).ready(function() {--}}
{{--            $('.update_record1').click(function(event) {--}}
{{--                event.preventDefault();--}}
{{--                // Получение данных из атрибутов кнопки--}}
{{--                var id = $(this).data('id');--}}
{{--                var template = $(this).data('template');--}}
{{--                var publishers = $(this).data('publishers');--}}
{{--                var time = $(this).data('time');--}}
{{--                var gwe = $(this).data('gwe');--}}
{{--                var day = $(this).data('day');--}}

{{--                // Отображение данных в модальном окне--}}
{{--                $('#updateModal_1_stand_publisher_id').text(id);--}}
{{--                $('#updateModal_1_standTemplate_id').text(template);--}}
{{--                $('#updateModal_1_standPublishers_id').text(publishers);--}}
{{--                $('#updateModal_1_time').text(time);--}}
{{--                $('#updateModal_1_gwe').text(gwe);--}}
{{--                $('#updateModal_1_day').text(day);--}}

{{--                $('#updateModal_1_Value_standTemplate_id').val(template);--}}
{{--                $('#updateModal_1_Value_standPublishers_id').val(publishers);--}}
{{--                $('#updateModal_1_Value_time').val(time);--}}
{{--                $('#updateModal_1_Value_gwe').val(gwe);--}}
{{--                $('#updateModal_1_Value_day').val(day);--}}

{{--                // Открытие модального окна--}}
{{--                $('#updateModal1').modal('show');--}}
{{--            });--}}
{{--        });--}}

{{--        $(document).ready(function() {--}}
{{--            $('.open-modal').click(function(event) {--}}
{{--                event.preventDefault();--}}
{{--                // Получение данных из атрибутов кнопки--}}
{{--                var id = $(this).data('id');--}}
{{--                var time = $(this).data('time');--}}
{{--                var gwe = $(this).data('gwe');--}}
{{--                var day = $(this).data('day');--}}

{{--                // Отображение данных в модальном окне--}}
{{--                $('#modalId').text(id);--}}
{{--                $('#modalTime').text(time);--}}
{{--                $('#modalGwe').text(gwe);--}}
{{--                $('#modalDay').text(day);--}}

{{--                // Открытие модального окна--}}
{{--                $('#myModal').modal('show');--}}
{{--            });--}}
{{--        });--}}

{{--        function callNumber(phoneNumber) {--}}
{{--            window.location.href = 'tel:' + phoneNumber;--}}
{{--        }--}}
{{--    </script>--}}
@endsection
