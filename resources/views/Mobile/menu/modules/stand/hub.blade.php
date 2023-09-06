@extends('Mobile.layouts.front.app')
@section('title') Meeper | Таблица @endsection
@section('content')



    <div class="content container-fluid">
{{--        @can('module.stand')--}}
{{--            <div class="list-group d-flex justify-content-between align-items-start mt-3">--}}
{{--                <div class="list-group-item list-group-item-action border-secondary">--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <a href="" class="text-decoration-none">--}}
{{--                            <div class="ms-1">--}}
{{--                                <span class="d-block h1 text-inherit mb-0">{{ $asfu->name }}</span>--}}
{{--                                <span class="d-block h5 text-inherit text-body mb-0">{{ $asfu->location }}</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        @can('stand.settings')--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    <i class="bi-three-dots-vertical"></i>--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">--}}
{{--                                    @can('stand.settings')--}}
{{--                                        <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Settings') }}</a>--}}
{{--                                    @endcan--}}
{{--                                    @can('Stand-Open history stand')--}}
{{--                                        <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.History') }}</a>--}}
{{--                                    @endcan--}}
{{--                                    <div class="dropdown-divider"></div>--}}
{{--                                    <a class="dropdown-item text-danger" href="#">Delete</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endcan--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endcan--}}
        @can('module.stand')
        @foreach($accessible_stands_for_the_user as $asfu)
            <div class="list-group d-flex justify-content-between align-items-start mt-3">
                <div class="list-group-item list-group-item-action border-secondary">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('currentWeekTableFront', $asfu->id) }}" class="text-decoration-none">
                            <div class="ms-1">
                                <span class="d-block h1 text-inherit mb-0">{{ $asfu->name }}</span>
                                <span class="d-block h5 text-inherit text-body mb-0">{{ $asfu->location }}</span>
                            </div>
                        </a>
                        @can('stand.settings')
                            <div class="dropdown ms-auto">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">
                                    @can('stand.settings')
                                        <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Settings') }}</a>
                                    @endcan
                                    @can('stand.history')
                                        <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.History') }}</a>
                                    @endcan
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
        @endcan
{{--            @else--}}
{{--                @foreach($accessible_stands_for_the_user as $asfu)--}}
{{--                    <div class="col mb-3">--}}
{{--                        <div class="card card-body">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <a class="d-flex align-items-center me-2" href="{{ route('currentWeekTableFront', $asfu->id) }}">--}}
{{--                                    <div class="flex-grow-1">--}}
{{--                                        <h5 class="text-hover-primary mb-0">{{ $asfu->name }}</h5>--}}
{{--                                        <span class="fs-6 text-body">{{ $asfu->location }}</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}

{{--                                <div class="ms-auto d-flex justify-content-between">--}}
{{--                                    <a class="btn btn-primary me-2" href="{{ route('currentWeekTableFront', $asfu->id) }}">--}}
{{--                                        открыть--}}
{{--                                    </a>--}}

{{--                                    @can('Stand-Open settings stand')--}}
{{--                                        <div class="dropdown">--}}
{{--                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                <i class="bi-three-dots-vertical"></i>--}}
{{--                                            </button>--}}
{{--                                            @can('Stand-Open settings stand')--}}
{{--                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">--}}
{{--                                                    @can('Stand-Open settings stand')--}}
{{--                                                        <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Settings') }}</a>--}}
{{--                                                    @endcan--}}
{{--                                                    @can('Stand-Open history stand')--}}
{{--                                                        <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }} ">{{ __('text.History') }}</a>--}}
{{--                                                    @endcan--}}

{{--                                                    <div class="dropdown-divider"></div>--}}
{{--                                                    <a class="dropdown-item text-danger" href="#">Delete</a>--}}
{{--                                                </div>--}}
{{--                                            @endcan--}}
{{--                                        </div>--}}
{{--                                    @endcan--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

    </div>

@endsection
