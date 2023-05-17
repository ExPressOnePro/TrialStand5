@extends('layouts.app')
@section('title')Stand | таблица@endsection
@section('content')

    <div class="main-content pt-4">
    <div class="breadcrumb">
        <h1 class="mr-2">Стенд</h1>
        <ul>
            <li><a href="">страница</a></li>
            <li></li>
        </ul>
    </div>
        <a href="{{ route('test') }}">
            <button class="btn btn-success m-1" type="button">
                тест</button>
        </a>

    <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xl-10  mb-4 mt-4 offset-md-1">
                <div class="col ul-widget__head ">
                    <div class="ul-widget__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#__g-widget4-tab1-content" role="tab" aria-selected="true">Текущая неделя</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#__g-widget4-tab2-content" role="tab" aria-selected="false">Следующая неделя</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ul-widget__body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="__g-widget4-tab1-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
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
                                                                        $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                                        && $template->status === '1'
                                                                        && $template->type === 'current'
                                                                        )

                                                                            <th>
                                                                                <div class="mt-2">
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
                                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
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
                                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
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
                                                                                            :</button>
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
                        </div>
                        <div class="tab-pane" id="__g-widget4-tab2-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
                                                {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                                {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
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
                                                                         $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                                        && $template->status === '1'
                                                                        )

                                                                            <th>
                                                                                <div class="mt-2">
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
                                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
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
                                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
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
                                                                                            :</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
