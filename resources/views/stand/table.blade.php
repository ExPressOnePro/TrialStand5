@extends('layouts.app')

@section('content')

    <div class="main-content pt-4">
    <div class="breadcrumb">
        <h1 class="mr-2">Стенд</h1>
        <ul>
            <li><a href="">страница</a></li>
            <li></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            {{--@foreach($asftu as $asfu)
                <div class="col-md-4">
                    <div class="card card-icon mb-4">
                        <a href="">
                            <div class="card-body text-center">
                                <p class="text-muted text-22 mt-2 mb-2">Стенд </p>
                                <p class="lead text-22 m-0">{{ $asfu->location }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach--}}
        </div>

        <a href="{{ route('test') }}">
            <button class="btn btn-success m-1" type="button">
                Записаться</button>
        </a>

        <a href="{{ route('test') }}">
            <button class="btn btn-danger m-1" type="button">
                Insert</button>
        </a>

        <a href="{{ route('testtemp') }}">
            <button class="btn btn-secondary m-1" type="button">
                Insert temp</button>
        </a>

    @foreach ($active_day as $actday)
        <div class='card o-hidden col-md-8 mb-4 offset-md-1'>
            <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                <h5 class="text-18 font-weight-600 card-title m-0">
                    {{-- fix date week--}}
                    {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                    {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
                </h5>
                <h5 class="text-18 font-weight-700 card-title m-8">
                    <span class="text-black text-22">{{ $actday->stand }} </span>
                </h5>
            </div>
            <div class='card-body pa-0'>
                <div class='table-wrap'>
                    <div class='table-responsive'>
                        <table class='table table-sm table-hover mb-0'>
                            <thead>
                                <tr>
                                    <th class='not-sortable'>Время</th>
                                    <th class='not-sortable'>Возвещатель</th>
                                    <th class='not-sortable'>Возвещатель</th>
                                    {{--<th class='not-sortable'>Отчет</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                    @if (

                                            !empty($template->standPublishers)
                                            && $template->day === $actday->day
                                        )
                                        @foreach($template->standPublishers as $standPublishers)
                                            <tr>
                                                @if(
                                                    $template->time === $standPublishers->period
                                                    && $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                    && $template->status === '1'
                                                )
                                                    <th>
                                                        <div class="mt-2 text-center">
                                                            {{ $template->time }}
                                                        </div>
                                                    </th>
                                                    <th>
                                                        @if(
                                                            is_null($standPublishers->user)
                                                        )
                                                            <a href="{{ route('recToStand') }}">
                                                                <button class="btn btn-success m-1" type="button">
                                                                    Записаться</button>
                                                            </a>
                                                        @else
                                                            <div class="mt-2 text-center">{{$standPublishers->user->name}}</div>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        @if(
                                                            is_null($standPublishers->user_2)
                                                        )
                                                            <a href="{{ route('recToStand') }}">
                                                                <button class="btn btn-success m-1" type="button">
                                                                    Записаться</button>
                                                            </a>
                                                        @else
                                                            <div class="mt-2 text-center">{{$standPublishers->user2->name}}</div>
                                                        @endif
                                                    </th>
                                                    <th>
                                                        @if(
                                                            ($standPublishers->user === null)
                                                            && $standPublishers->user2 === null
                                                        )

                                                        @else
                                                            <a href="">
                                                                <button class="btn btn-outline-warning m-1" type="button">
                                                                    Редактировать</button>
                                                            </a>
                                                        @endif
                                                    </th>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
