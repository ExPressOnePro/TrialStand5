@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
        @can('module.stand')
                <div class="row py-3 row-cols-1 row-cols-lg-3">
                    @foreach($accessible_stands_for_the_user as $asfu)
                        <div class="col mb-3 mb-lg-3">
                            <div class="card border-left-empty rounded-3 text-decoration-none shadow">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="
                        @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)
                            {{ route('stand.aio_current2') }}
                        @else
                            {{ route('stand.current2', $asfu->id) }}
                        @endif"
                                           class="text-decoration-none">
                                            <h4 class="fw-bold mb-0 text-body-emphasis">{{ $asfu->name }}</h4>
                                            <p class="m-0">{{ $asfu->location }}</p>
                                        </a>
                                    </div>
                                    @can('stand.settings')
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">
                                                @can('stand.settings')
                                                    <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Настройки') }}</a>
                                                @endcan
                                                @can('stand.history')
                                                    <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.История') }}</a>
                                                @endcan
                                                <div class="dropdown-divider"></div>
                                                {{-- <a class="dropdown-item text-danger" href="#">Delete</a> --}}
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{--                    @foreach($accessible_stands_for_the_user as $asfu)--}}
{{--                        <div class="col mb-3 mb-lg-3">--}}
{{--                            <a class="card border-left-empty rounded-3 text-decoration-none shadow p-4"--}}
{{--                               href="--}}
{{--                            @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--               {{ route('stand.aio_current2') }}--}}
{{--            @else--}}
{{--                {{ route('stand.current2', $asfu->id) }}--}}
{{--            @endif">--}}
{{--                                <div class="d-flex justify-content-left">--}}
{{--                                    <p class="text-decoration-none">--}}
{{--                                    <div class="col align-items-center m-auto">--}}
{{--                                        <h4 class="fw-bold mb-0 text-body-emphasis">{{ $asfu->name }}</h4>--}}
{{--                                        <p class="m-auto">{{ $asfu->location }}</p>--}}
{{--                                    </div>--}}
{{--                                    </p>--}}
{{--                                    @can('stand.settings')--}}
{{--                                        <div class="dropdown ms-auto">--}}
{{--                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                <i class="fa-solid fa-ellipsis-vertical"></i>--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">--}}
{{--                                                @can('stand.settings')--}}
{{--                                                    <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Настройки') }}</a>--}}
{{--                                                @endcan--}}
{{--                                                @can('stand.history')--}}
{{--                                                    <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.История') }}</a>--}}
{{--                                                @endcan--}}
{{--                                                <div class="dropdown-divider"></div>--}}
{{--                                                <a class="dropdown-item text-danger" href="#">Delete</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endcan--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
        @endcan
{{--        @can('stand.create')--}}
{{--            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="exampleModalLabel">Новый стенд</h5>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <form id="NewStand" method="POST" action="{{ route('createNewStand') }}">--}}
{{--                                @csrf--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 form-group mb-3">--}}
{{--                                        <label for="name">Название стенда</label>--}}
{{--                                        <input class="form-control form-control-rounded @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Введите название стенда">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        @error('name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 form-group mb-3">--}}
{{--                                        <label for="location">Локация стенда</label>--}}
{{--                                        <input class="form-control form-control-rounded  @error('location') is-invalid @enderror" name="location" id="location" type="text" placeholder="Введите локацию стенда">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        @error('location')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 form-group mb-3">--}}
{{--                                        <label for="congregation">Собрание</label>--}}
{{--                                        <select class="form-control form-control-rounded" id="congregation" name="congregation" type="text">--}}
{{--                                            <option id="congregation" value="{{ $congregation->id }}">{{ $congregation->name }}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">закрыть</button>--}}
{{--                            <a class="btn btn-success" type="button" href="{{ route('createNewStand') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                    document.getElementById('NewStand').submit();">--}}
{{--                                Создать--}}
{{--                            </a>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endcan--}}
    </div>

@endsection
