@extends('Mobile.layouts.app')
@section('title') Meeper | Настройки @endsection
@section('content')
    <div class="main-content pt-4">
        <h1 class="heading text-center font-weight-bold">{{ $stand_id->name }}</h1>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h1 class="heading float-left card-title m-0">Время в которое отображается таблица</h1>
                        <span>по умолчанию четверг 8:00
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('timeActivation', ['id' => $stand_id->id]) }}" method="post" id="timeActivation">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control text-left" id="day" name="day">
                                        <option value="1">Понедельник</option>
                                        <option value="2">Вторник</option>
                                        <option value="3">Среда</option>
                                        <option value="4">Четверг</option>
                                        <option value="5">Пятница</option>
                                        <option value="6">Суббота</option>
                                        <option value="7">Воскресенье</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-control text-center" id="time" name="time">
                                        @for($hour = 0; $hour < 24; $hour++)
                                            @for($minute = 0; $minute < 60; $minute += 15)
                                                @php
                                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                                @endphp
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('timeActivation',['id' => $stand_id->id] ) }}"
                           onclick="event.preventDefault();
                                   document.getElementById('timeActivation').submit();">
                            <button class="btn btn-success btn-block mb-3" type="submit">
                                {{ __('Применить') }}</button>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h1 class="heading float-left card-title m-0">Активное время</h1>
                    </div>
                    <div class="card-body align-items-center">
                        <form action="{{ route('StandTimeNext', ['id' => $stand_id->id]) }}" method="post">
                            @csrf
                            <div class="table-responsive">
                            <table>
                                <tr>
                                    <th>День</th>
                                    @for($i = 6; $i <= 21; $i++)
                                        <th>{{ $i }}:00</th>
                                    @endfor
                                </tr>
                                @foreach($template->week_schedule as $day => $times)
                                    <tr>
                                        <td>День {{ $day }}</td>
                                        @for($i = 6; $i <= 21; $i++)
                                            <td>
                                                <label class="switch switch-success ">
                                                    <input type="checkbox" name="schedule[{{ $day }}][]" value="{{ $i }}" {{ in_array($i, $times) ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            </table>
                            </div>

                            <div class="text-right mt-2">
                                <button class="btn btn-success mb-3" type="submit" href="{{ route('StandTimeNext',['id' => $stand_id->id] ) }}">
                                    {{ __('Изменения со следующей недели') }}</button>
                            </div>
                        </form>
                        <div class="text-right">
                            <a href="{{ route('StandTimeNextToCurrent', ['id' => $stand_id->id]) }}">
                                <button class="btn btn-danger mb-3" type="submit">{{ __('Изменения с текущей недели') }}</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
