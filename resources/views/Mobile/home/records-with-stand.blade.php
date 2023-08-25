@extends('Mobile.layouts.front.home')
@section('title') Meeper | записи со стендом @endsection
@section('content')

    <div class="content container-fluid">

        <div class="row">
            @foreach ($standPublishers as $standPublisher)
                @foreach ($standPublisher->standTemplates as $standTemplate)
                    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                        <a class="card card-hover-shadow h-100" href="#">
                            <div class="card-body">
                                <div class="d-flex align-items-center">

                                    <div class="flex-grow-1 ms-4">
                                        <h3 class="text-inherit mb-1">{{ $standPublisher->date }}</h3>
                                        <h3 class="text-inherit mb-1">
                                            {{ \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day) }}
                                            {{ date('H:i', strtotime($standPublisher->time . ':00')) }}
                                        </h3>
                                        <span class="h3 text-secondary">{{ $standTemplate->Stand->location }}</span>
                                    </div>

                                    <div class="ms-2 text-end">
                                        <i class="bi-chevron-right text-body text-inherit"></i>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>

@endsection
