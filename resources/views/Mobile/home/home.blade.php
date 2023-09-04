@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
{{--        <div class="overflow-hidden gradient-radial-sm-primary">--}}
{{--            <div class="container-lg content-space-t-1 content-space-t content-space-b-1">--}}
{{--                <div class="w-lg-75 text-center mx-lg-auto text-center mx-auto">--}}
{{--                    <div class="mb-5 animated fadeInUp">--}}
{{--                        <h1 class="display-3 mb-3">Добро пожаловать</h1>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @role('Developer')
        <div class="row mb-4">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <a data-fslightbox="youtube-video" data-video-poster="../assets/img/1920x1080/img1.jpg" href="{{ asset('/front/video/1.mp4') }}">
                    <img class="img-fluid" src="{{ asset('/front/video/working-in-office.jpg') }}" alt="Image Description">

                </a>
            </div>
        </div>
        @endrole
        @include('Mobile.home.components.developer')
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-5">
                @can('module.stand')
                    @if($standPublishersCountAll > 0)
                    <div class="list-group d-flex align-items-center border border-primary">
                        <a class="list-group-item list-group-item-action" href="{{ route('home.recordsWithStandPage') }}">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">{{$standPublishersCountAll}}</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h1 text-inherit mb-0">Мои записи со стендом</span>
                                    <span class="d-block h5 text-inherit text-body mb-0">Просмотрите когда вы записались</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @else
                        <div class="list-group d-flex align-items-center border border-primary">
                            <a class="list-group-item list-group-item-action" href="{{ route('stand.hub') }}">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <span class="d-block h1 text-inherit mb-0">Нет записей</span>
                                        <span class="d-block h5 text-inherit text-body mb-0">Запишитесь в служение со стендом</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-5">
{{--                @can('module.schedule')--}}
{{--                        @if($standPublishersCountAll > 0)--}}
{{--                            <div class="list-group d-flex align-items-center border border-primary">--}}
{{--                                <a class="list-group-item list-group-item-action" href="{{ route('home.recordsWithStandPage') }}">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar avatar-sm avatar-soft-primary avatar-circle">--}}
{{--                                            <span class="avatar-initials"></span>--}}
{{--                                        </div>--}}
{{--                                        <div class="ms-3">--}}
{{--                                            <span class="d-block h1 text-inherit mb-0">Мои назначения в собрании</span>--}}
{{--                                            <span class="d-block h5 text-inherit text-body mb-0">Просмотрите когда вы записались</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="list-group d-flex align-items-center border border-primary">--}}
{{--                                <a class="list-group-item list-group-item-action" href="{{ route('stand.hub') }}">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="ms-3">--}}
{{--                                            <span class="d-block h1 text-inherit mb-0">Мои назначения в собрании</span>--}}
{{--                                            <span class="d-block h5 text-inherit text-body mb-0">Просмотрите какие задания вы имеете во время встречи собрания</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endcan--}}
            </div>
        </div>
    </div>

@endsection
