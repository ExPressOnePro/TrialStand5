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
            @foreach($asftu as $asfu)
                <div class="col-md-4">
                    <div class="card card-icon mb-4">
                        <a href="{{ route('tableStand', $asfu->id) }}">
                            <div class="card-body text-center">
                                <p class="text-dark text-22 mt-2 mb-2">Стенд </p>
                                <p class="lead text-22 m-0">{{ $asfu->location }}</p>
                                {{--@if(Auth::id() = )
                                @endif--}}
                            </div>
                        </a>
                    </div>
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
