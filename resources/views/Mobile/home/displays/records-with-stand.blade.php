@extends('Mobile.layouts.front.home')
@section('title') Meeper | записи со стендом @endsection
@section('content')

    <div class="content container-fluid">
        <div class="card border-secondary mb-3 mb-lg-5">
            <div class="card-header card-header-content-sm-between  border-secondary ">
                <h4 class="card-header-title mb-2 mb-sm-0 text-center">{{__('text.Мои записи на неделе')}}</h4>

                <ul class="nav nav-segment nav-fill" id="projectsTab" role="tablist">
                    <li class="nav-item" data-bs-toggle="chart" data-datasets="0" data-trigger="click" data-action="toggle" role="presentation">
                        <a class="nav-link active" href="#nav-mrfs_1" data-bs-toggle="tab" aria-selected="true" role="tab">{{__('text.Текущей')}}
                            @if($standPublishersCount>0)
                            <span class="badge bg-primary rounded-pill ms-1">{{$standPublishersCount}}</span>
                            @else
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="chart" data-datasets="1" data-trigger="click" data-action="toggle" role="presentation">
                        <a class="nav-link" href="#nav-mrfs_2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">{{__('text.Следующей')}}
                            @if($standPublishersCountNextWeek>0)
                            <span class="badge bg-primary rounded-pill ms-1">{{$standPublishersCountNextWeek}}</span>
                            @else
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-mrfs_1" role="tabpanel" aria-labelledby="nav-mrfs_1-tab">
                        <div class="row align-items-sm-center">
                            <ul class="list-group list-group-flush list-group-start-bordered">
                                @foreach ($standPublishers as $standPublisher)
                                    @foreach ($standPublisher->standTemplates as $standTemplate)
                                        <li class="list-group-item">
                                            <a class="list-group-item-action border-primary" href="
                                            @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)
                                            {{ route('stand.aio_current') }}
@else
    {{ route('stand.current', $standTemplate->stand_id) }}
@endif">

                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="fw-normal mb-1">
                                                        {{ \Carbon\Carbon::parse($standPublisher->date)->format('m.d.Y') }}
                                                        {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day)) }}
                                                        {{$standPublisher->time}}
                                                    </h2>
                                                    <h5 class="text-inherit mb-0">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</h5>
                                                </div>
                                                <div class="col-sm-auto align-self-sm-end">
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-mrfs_2" role="tabpanel" aria-labelledby="nav-mrfs_2-tab">
                        <div class="row align-items-sm-center">
                            <ul class="list-group list-group-flush list-group-start-bordered">
                                @foreach ($standPublishersNextWeek as $standPublisherNextWeek)
                                    @foreach ($standPublisherNextWeek->standTemplates as $standTemplateNextWeek)
                                        <li class="list-group-item">
                                            <a class="list-group-item-action border-primary" href="
                                        @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)
    {{ route('stand.aio_next') }}
@else
{{ route('stand.next', $standTemplateNextWeek->stand_id) }}
@endif">
                                                <div class="row">
                                                    <div class="col-sm mb-2 mb-sm-0">
                                                        <h2 class="fw-normal mb-1">
                                                            {{ \Carbon\Carbon::parse($standPublisherNextWeek->date)->format('m.d.Y') }}
                                                            {{ \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day) }}
                                                            {{ $standPublisherNextWeek->time }}</h2>
                                                        <h5 class="text-inherit mb-0">{{__('text.Стенд - ')}} {{ $standTemplateNextWeek->Stand->location }}</h5>
                                                    </div>
                                                    <div class="col-sm-auto align-self-sm-end">
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
