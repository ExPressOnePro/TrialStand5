@extends('layouts.app')
@section('title') Meeper | Стенды @endsection
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
            @foreach($accessible_stands_for_the_user as $asfu)
                <div class="col-md-3">
                    <a  data-toggle="collapse" href="#collapse-link-collapsed{{ $asfu->id }}" aria-expanded="true">
                        <div class="card card-body ul-border__bottom mb-4">
                            <div class="text-center">
                                <h1 class="heading">{{ $asfu->name }}</h1>
                                <p class="mb-3 text-muted">Этот стенд находится - "{{ $asfu->location }}"</p>
                            </div>
                            <div class="collapse" id="collapse-link-collapsed{{ $asfu->id }}" style="">
                                <div class="mt-3">
                                    <a href="{{ route('currentWeekTable', $asfu->id) }}">
                                        <button class="btn btn-outline-success btn-block text-left" type="button">
                                            <h3 class="heading">
                                                <span><i class="fa fa-table"></i></span>
                                                Таблица записей
                                            </h3>
                                        </button>
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('StandSettings', $asfu->id) }}">
                                        <button class="btn btn-outline-success btn-block text-left" type="button">
                                            <h3 class="heading">
                                                <span><i class="fa fa-gear"></i></span>
                                                Настройка
                                            </h3>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    {{--@foreach ($templates as $template)
        <div class='d-flex align-items-center justify-content-between mt-40 mb-20'>
            <h4>
                --}}{{-- fix date week --}}{{--
                {{ \App\Enums\WeekDaysEnum::getWeekDay($template->day) }}
                {{ \App\Enums\WeekDaysEnum::getWeekDayDate($template->day) }}
                <span> "{{ $template->stand->name }}" </span>
            </h4>
        </div>

        <div class='card'>
            <div class='card-body pa-0'>
                <div class='table-wrap'>
                    <div class='table-responsive'>
                        <table class='table table-sm table-hover mb-0'>
                            <thead>
                            <tr>
                                <th class='not-sortable'>Время</th>
                                <th class='not-sortable'>Возвещатель</th>
                                <th class='not-sortable'>Возвещатель</th>
                                <th class='not-sortable'>Отчет</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($template->times_range as $time_range)
                                @if (!empty($template->standPublishers->toArray()))
                                    <tr>
                                        <th>{{ $time_range }}</th>
                                        @foreach($template->standPublishers as $standPublishers)
                                            @if(
                                                isset($standPublishers->user)
                                                && $time_range === $standPublishers->time
                                            )
                                                <th class="text-center">{{$standPublishers->user->name}}</th>
                                                <th class="text-center">{{$standPublishers->user2->name}}</th>
                                                <th>-</th>
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-outline-warning m-1" type="button">
                                                            Редактировать</button>
                                                    </a></th>
                                            @else
                                                <th>
                                                    <a href="--}}{{--{{ route('recToStand', $time_range) }}--}}{{--">
                                                        <button class="btn btn-success m-1" type="button">
                                                            Записаться</button>
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-success m-1" type="button">
                                                            Записаться</button>
                                                    </a>
                                                </th>
                                                <th>-</th>
                                                <th>-</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                @else
                                    <tr>
                                        <th>{{ $time_range }}</th>
                                        <th>-</th>
                                        <th>-</th>
                                        <th>-</th>
                                        <th>-</th>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach--}}
    </div>

@endsection
