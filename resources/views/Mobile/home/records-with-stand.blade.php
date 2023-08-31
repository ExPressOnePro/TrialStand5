@extends('Mobile.layouts.front.home')
@section('title') Meeper | записи со стендом @endsection
@section('content')

    <div class="content container-fluid">
        <div class="card mb-3 mb-lg-5">
            <div class="card-header card-header-content-sm-between">
                <h4 class="card-header-title mb-2 mb-sm-0">Мои Записи</h4>

                <ul class="nav nav-segment nav-fill" id="projectsTab" role="tablist">
                    <li class="nav-item" data-bs-toggle="chart" data-datasets="0" data-trigger="click" data-action="toggle" role="presentation">
                        <a class="nav-link active" href="#nav-mrfs_1" data-bs-toggle="tab" aria-selected="true" role="tab">Текущая
                            <span class="badge bg-primary rounded-pill ms-1">{{$standPublishersCount}}</span>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="chart" data-datasets="1" data-trigger="click" data-action="toggle" role="presentation">
                        <a class="nav-link" href="#nav-mrfs_2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Следующая
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
                                            <a class="list-group-item-action border-primary" href="#">
                                                <div class="row">
                                                    <div class="col-sm mb-2 mb-sm-0">
                                                        <h2 class="fw-normal mb-1">{{ $standPublisher->date }} {{ \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day) }}
                                                            {{ date('H:i', strtotime($standPublisher->time . ':00')) }}</h2>
                                                        <h5 class="text-inherit mb-0">Стенд - {{ $standTemplate->Stand->location }}</h5>
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
                        <ul class="list-group list-group-flush list-group-start-bordered">
                            @foreach ($standPublishersNextWeek as $standPublisherNextWeek)
                                @foreach ($standPublisherNextWeek->standTemplates as $standTemplateNextWeek)
                                    <li class="list-group-item">
                                        <a class="list-group-item-action border-primary" href="#">
                                            <div class="row">
                                                <div class="col-sm mb-2 mb-sm-0">
                                                    <h2 class="fw-normal mb-1">{{ $standPublisherNextWeek->date }} {{ \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day) }}
                                                        {{ date('H:i', strtotime($standPublisherNextWeek->time . ':00')) }}</h2>
                                                    <h5 class="text-inherit mb-0">Стенд - {{ $standTemplateNextWeek->Stand->location }}</h5>
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
@endsection
