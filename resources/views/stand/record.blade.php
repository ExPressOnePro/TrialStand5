@extends('layouts.app')

@section('content')

    <div class="main-content pt-4">
    <div class="breadcrumb">
        <h1 class="mr-2">{{ $art }}</h1>
        <ul>
            <li><a href="">страница</a></li>
            <li></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>


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
                                <th class='not-sortable'>Возвещатель 1</th>
                                <th class='not-sortable'>Возвещатель 2</th>
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
                                                <th>{{$standPublishers->user->name}}</th>
                                                <th>{{$standPublishers->user2->name}}</th>
                                                <th>-</th>
                                                <th>-</th>
                                            @else
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-outline-success m-1" type="button">
                                                            Записаться</button>
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="">
                                                        <button class="btn btn-outline-success m-1" type="button">
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
