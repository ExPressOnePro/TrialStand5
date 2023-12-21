@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')

    <div class="container">
        <div class="row align-items-md-stretch">
            @include('BootstrapApp.Modules.home.includes.FAQ')
            @include('BootstrapApp.Modules.home.includes.myRecordsOnStand')
        </div>

        <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">Все записи со стендом</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

{{--                        <ul class="nav nav-pills nav-fill rounded-3 shadow-sm" id="eventsTab" role="tablist" style="--}}
{{--    /*--bs-nav-link-color: var(--bs-black);*/--}}
{{--    --bs-nav-pills-link-active-color: var(--bs-white);--}}
{{--    --bs-nav-pills-link-active-bg: rgba(108, 117, 125, 0.5); /* Adjust the alpha value (0.0 to 1.0) for transparency */--}}
{{--">--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link active" id="this-week-tab" data-bs-toggle="tab" href="#this-week"--}}
{{--                                   role="tab" aria-selected="true">--}}
{{--                                    Текущая--}}
{{--                                    @if($standPublishersCount>0)--}}
{{--                                        <span class="badge bg-primary ms-1">{{$standPublishersCount}}</span>--}}
{{--                                    @else--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link" id="next-week-tab" data-bs-toggle="tab" href="#next-week" role="tab"--}}
{{--                                   aria-selected="false" tabindex="-1">--}}
{{--                                    Следующая--}}
{{--                                    @if($standPublishersCountNextWeek>0)--}}
{{--                                        <span class="badge bg-primary ms-1">{{$standPublishersCountNextWeek}}</span>--}}
{{--                                    @else--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}

                        <div class="tab-content mt-2" id="eventsTabContent">
                            <div class="tab-pane fade active show" id="this-week" role="tabpanel"
                                 aria-labelledby="this-week-tab">
                                @foreach ($standPublishers as $standPublisher)
                                    @foreach ($standPublisher->standTemplates as $standTemplate)
                                        @php
                                            $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1
                                                ? route('stand.aio_current2')
                                                : route('stand.current2', $standTemplate->stand_id);
                                        @endphp
                                        <div class="d-flex list-group text-body-secondary pt-3">
                                            <div class="list-group-item align-items-center pb-3 mb-0 small lh-sm w-100">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="col p-1 d-flex flex-column position-static">
                                                        <strong class="d-inline-block mb-2 text-success">Текущая неделя</strong>
                                                        <h3 class="mb-0">
                                                            {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day)) }}
                                                            {{ \Carbon\Carbon::parse($standPublisher->time)->format('H:i') }}</h3>
                                                        <div class="h5 mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($standPublisher->date)->format('d.m.Y') }}</div>
                                                        <p class="mb-auto">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</p>
                                                    </div>
{{--                                                    <div>--}}
{{--                                                        <strong class="d-inline-block mb-2 text-success-emphasis">Текущая</strong>--}}
{{--                                                        <a class="text-gray-dark text-decoration-none h4" href="{{$link}}">--}}
{{--                                                            {{ \Carbon\Carbon::parse($standPublisher->date)->format('d.m.Y') }}--}}
{{--                                                                <b>   {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day)) }}</b>--}}
{{--                                                            {{ \Carbon\Carbon::parse($standPublisher->time)->format('H:i') }}--}}
{{--                                                        </a>--}}
{{--                                                        <span class="d-block">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</span>--}}
{{--                                                    </div>--}}
                                                    <a class="btn" href="{{$link}}"><i class="bi-chevron-right text-body text-inherit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                                    @foreach ($standPublishersNextWeek as $standPublisherNextWeek)
                                        @foreach ($standPublisherNextWeek->standTemplates as $standTemplate)
                                            @php
                                                $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1
                                                    ? route('stand.aio_next2')
                                                    : route('stand.next2', $standTemplate->stand_id);
                                            @endphp
                                            <div class="d-flex list-group text-body-secondary pt-3">
                                                <div class="list-group-item pb-3 mb-0 small lh-sm w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="col p-1 d-flex flex-column position-static">
                                                            <strong class="d-inline-block mb-2 text-primary">Следующая неделя</strong>
                                                            <h3 class="mb-0">
                                                                {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day)) }}
                                                                {{ \Carbon\Carbon::parse($standPublisherNextWeek->time)->format('H:i') }}</h3>
                                                            <div class="h5 mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($standPublisherNextWeek->date)->format('d.m.Y') }}</div>
                                                            <p class="mb-auto">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</p>
                                                        </div>
{{--                                                        <div>--}}
{{--                                                            <a class="text-gray-dark text-decoration-none h4"--}}
{{--                                                               href="{{$link}}">--}}
{{--                                                                <b>{{ \Carbon\Carbon::parse($standPublisherNextWeek->date)->format('d.m.Y') }}--}}
{{--                                                                    {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day)) }}</b>--}}
{{--                                                                {{ \Carbon\Carbon::parse($standPublisherNextWeek->time)->format('H:i') }}--}}
{{--                                                            </a>--}}
{{--                                                            <span--}}
{{--                                                                class="d-block">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</span>--}}
{{--                                                        </div>--}}
                                                        <a class="btn" href="{{$link}}"><i
                                                                class="bi-chevron-right text-body text-inherit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                            </div>

{{--                            <div class="tab-pane fade" id="next-week" role="tabpanel" aria-labelledby="next-week-tab">--}}
{{--                                @foreach ($standPublishersNextWeek as $standPublisherNextWeek)--}}
{{--                                    @foreach ($standPublisherNextWeek->standTemplates as $standTemplate)--}}
{{--                                        @php--}}
{{--                                            $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1--}}
{{--                                                ? route('stand.aio_current')--}}
{{--                                                : route('stand.current', $standTemplate->stand_id);--}}
{{--                                        @endphp--}}
{{--                                        <div class="d-flex list-group text-body-secondary pt-3">--}}
{{--                                            <div class="list-group-item pb-3 mb-0 small lh-sm w-100">--}}
{{--                                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                    <div>--}}
{{--                                                        <a class="text-gray-dark text-decoration-none h4"--}}
{{--                                                           href="{{$link}}">--}}
{{--                                                            <b>{{ \Carbon\Carbon::parse($standPublisherNextWeek->date)->format('d.m.Y') }}--}}
{{--                                                                {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day)) }}</b>--}}
{{--                                                            {{ \Carbon\Carbon::parse($standPublisherNextWeek->time)->format('H:i') }}--}}
{{--                                                        </a>--}}
{{--                                                        <span--}}
{{--                                                            class="d-block">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</span>--}}
{{--                                                    </div>--}}
{{--                                                    <a class="btn" href="{{$link}}"><i--}}
{{--                                                            class="bi-chevron-right text-body text-inherit"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row col-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
